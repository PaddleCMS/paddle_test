<?php

/**
 * @file
 * Functions and hooks related to the apps module.
 */

/**
 * Implements hook_apps_app_info().
 */
function paddle_quiz_apps_app_info() {
  return array(
    'configure form' => 'paddle_quiz_configuration_form',
  );
}

/**
 * App configuration form callback.
 *
 * @return array
 *   Form render array.
 */
function paddle_quiz_configuration_form() {
  // Set the page title.
  drupal_set_title(t('Manage quizzes'));

  // Initialize the form array. Add a wrapper div so we can easily target the
  // form when we need to replace it with ajax when a quiz is deleted.
  $form = array(
    '#prefix' => '<div id="paddle-quiz-configuration-form-wrapper">',
    '#suffix' => '</div>',
  );

  // Get all quiz ids, sorted by their title.
  $query = new EntityFieldQuery();
  $query->entityCondition('entity_type', 'paddle_quiz')
    ->propertyOrderBy('title');
  $results = $query->execute();

  // Load the actual quiz objects.
  $quizzes = array();
  if (!empty($results['paddle_quiz'])) {
    $quiz_ids = array_keys($results['paddle_quiz']);
    $quizzes = entity_load('paddle_quiz', $quiz_ids);
  }

  // Display the quizzes table.
  $form['quizzes'] = array(
    '#type' => 'container',
    '#tree' => TRUE,
    '#theme' => 'paddle_quiz_table_list',
  );
  foreach ($quizzes as $quiz) {
    /* @var \QuizEntity $quiz  */

    ctools_include('ajax');
    ctools_include('modal');
    ctools_modal_add_js();

    $export_path = 'admin/content/paddle_quiz/' . $quiz->qid . '/export/nojs';
    $export = l(t('Export results'), $export_path, array(
      'attributes' => array(
        'class' => array('ctools-use-modal', 'paddle-quiz-export-link'),
      ),
    ));

    $actions = '';
    $action_classes = array('ui-icon', 'ui-icon-hiddentext');

    $edit_path = 'admin/content/paddle_quiz/' . $quiz->qid . '/edit';

    $preview_path = $edit_path . '/preview';
    $preview_class = $action_classes;
    $preview_class[] = 'ui-icon-visit';
    $actions .= l(t('Preview'), $preview_path, array(
      'attributes' => array(
        'class' => $preview_class,
      ),
    ));

    $edit_class = $action_classes;
    $edit_class[] = 'ui-icon-edit';
    $actions .= l(t('Edit'), $edit_path, array(
      'attributes' => array(
        'class' => $edit_class,
      ),
    ));

    $delete_path = 'admin/content/paddle_quiz/' . $quiz->qid . '/delete/nojs';
    $delete_class = $action_classes;
    $delete_class[] = 'ui-icon-delete';
    $delete_class[] = 'ctools-use-modal';
    $actions .= l(t('Delete'), $delete_path, array(
      'attributes' => array(
        'class' => $delete_class,
      ),
    ));

    $form['quizzes'][$quiz->qid] = array(
      '#type' => 'container',
    );
    $form['quizzes'][$quiz->qid]['title'] = array(
      '#type' => 'item',
      '#markup' => $quiz->title,
    );
    $form['quizzes'][$quiz->qid]['status'] = array(
      '#type' => 'checkbox',
      '#title' => t('Status'),
      '#default_value' => $quiz->status,
    );
    $form['quizzes'][$quiz->qid]['export'] = array(
      '#type' => 'item',
      '#markup' => $export,
      '#access' => ($quiz->countParticipations() > 0),
    );
    $form['quizzes'][$quiz->qid]['actions'] = array(
      '#type' => 'item',
      '#markup' => $actions,
    );
  }

  // Save button. Don't use the one generated by system_settings_form() as it
  // would save the quiz statuses as a serialized variable.
  $form['save'] = array(
    '#type' => 'submit',
    '#value' => t('Save'),
    '#attributes' => array(
      'id' => 'quiz-configuration-save',
      'class' => array('hidden'),
    ),
  );

  // "Create quiz" button.
  $form['create'] = array(
    '#type' => 'item',
    '#markup' => l(t('Create quiz'), 'admin/content/paddle_quiz/add', array(
      'attributes' => array(
        'class' => array('button'),
      ),
    )),
  );

  // Move buttons to contextual toolbar if available.
  if (module_exists('paddle_contextual_toolbar')) {
    $form['#after_build'][] = 'paddle_quiz_contextual_actions_configuration_form';
  }

  return $form;
}

/**
 * Submit function for the paddle quiz configuration form.
 *
 * @param array $form
 *   Form array.
 * @param array $form_state
 *   Form state array.
 */
function paddle_quiz_configuration_form_submit($form, &$form_state) {
  // Loop over all submitted quizzes.
  foreach ($form_state['values']['quizzes'] as $qid => $values) {
    $status = $values['status'];
    $quiz = paddle_quiz_load($qid);

    // If the quizzes status is not the same as the status of the checkbox,
    // overwrite and save it.
    if ($quiz->status != $status) {
      $quiz->status = $status;
      $quiz->save();
    }
  }

  drupal_set_message(t('The changes have been saved.'));
}

/**
 * Provides markup for the quizzes table list, or a placeholder text.
 *
 * @param array $vars
 *   Theme variables.
 *
 * @return string
 *   HTML markup for the table of quizzes.
 */
function theme_paddle_quiz_table_list($vars) {
  $element = $vars['element'];

  // Give the table a HTML id.
  $table = array(
    'attributes' => array('id' => 'quiz-list'),
  );

  // Table header.
  $table['header'] = array(
    array(
      'data' => t('Title'),
    ),
    array(
      'data' => t('Published'),
    ),
    array(
      'data' => '',
    ),
    array(
      'data' => t('Actions'),
    ),
  );

  // Table rows.
  foreach (element_children($element) as $qid) {
    $quiz_element = $element[$qid];

    // Hide the label of the status checkbox.
    $quiz_element['status']['#title_display'] = 'invisible';

    $table['rows'][] = array(
      'data' => array(
        // Title cell.
        array(
          'data' => drupal_render($quiz_element['title']),
          'class' => 'quiz-title',
        ),
        // Status cell.
        array(
          'data' => drupal_render($quiz_element['status']),
          'class' => 'quiz-status',
        ),
        // Export cell.
        array(
          'data' => drupal_render($quiz_element['export']),
          'class' => 'quiz-export',
        ),
        // Actions cell.
        array(
          'data' => drupal_render($quiz_element['actions']),
          'class' => 'quiz-actions',
        ),
      ),
      'data-quiz-id' => $qid,
    );
  }

  // Placeholder text in case there are no rows.
  $table['empty'] = t('You have no quizzes yet. You can create one using the "Create quiz" button above.');

  // Return the final markup.
  return theme('table', $table);
}

/**
 * After-build function of the quiz configuration form.
 *
 * @param array $form
 *   Form render array.
 * @param array $form_state
 *   Form state array.
 *
 * @return array
 *   Updated form render array.
 */
function paddle_quiz_contextual_actions_configuration_form($form, &$form_state) {
  // Hide the "create quiz" button underneath the configuration form.
  unset($form['create']);

  // Hide the save button.
  $form['save']['#attributes']['class'][] = 'hidden';

  $actions = paddle_contextual_toolbar_actions();

  // Add a save button to the contextual toolbar.
  $actions[] = array(
    'action' => l(t('Save'), '', array(
      'attributes' => array(
        'data-paddle-contextual-toolbar-click' => 'quiz-configuration-save',
        'class' => array('ui-icon', 'fa-check'),
      ),
    )),
    'class' => array('save'),
    'weight' => 5,
  );

  // Add a contextual toolbar button to create a new quiz. Put it in a separate
  // group so it doesn't stick to the cancel and save buttons.
  $actions[] = array(
    'action' => l(t('Create quiz'), 'admin/content/paddle_quiz/add', array(
      'attributes' => array(
        'class' => array('ui-icon', 'fa-plus'),
      ),
    )),
    'class' => array('add'),
    'weight' => 5,
    'group' => 'crud',
  );

  paddle_contextual_toolbar_actions($actions);

  return $form;
}
