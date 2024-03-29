<?php
/**
 * @file
 * Class for the Panelizer paddle_mega_dropdown entity plugin.
 */

/**
 * Panelizer Entity paddle_mega_dropdown plugin class.
 *
 * Handles paddle_mega_dropdown specific functionality for Panelizer.
 * Based on PanelizerEntityNode, as hinted by README.txt.
 *
 * @see PanelizerEntityNode.class.php
 */
class PanelizerEntityPaddleMegaDropdown extends PanelizerEntityDefault {
  public $entity_admin_root = 'admin/structure/types/manage/%panelizer_node_type';
  public $uses_page_manager = TRUE;
  public $entity_admin_bundle = FALSE;

  /**
   * Checks access rights.
   */
  public function entity_access($op, $entity) {
    // This must be implemented by the extending class.
    return entity_access($op, 'paddle_mega_dropdown', $entity);
  }

  /**
   * Implements the save function for the entity.
   */
  public function entity_save($entity) {
    $entity->save();
  }

  /**
   * Displays on the context configuration page.
   */
  public function entity_identifier($entity) {
    return t('This Paddle mega dropdown');
  }

  /**
   * Displays on the panelize configuration overview page.
   */
  public function entity_bundle_label() {
    return t('Paddle mega dropdown');
  }

  /**
   * Implements a delegated hook_page_manager_handlers().
   *
   * This makes sure that all panelized entities have the proper entry
   * in page manager for rendering.
   * It gets called by the Submit button on admin/config/content/panelizer.
   */
  public function hook_default_page_manager_handlers(&$handlers) {
    $handler = new stdClass();
    $handler->disabled = FALSE; /* Edit this to true to make a default handler disabled initially */
    $handler->api_version = 1;
    $handler->name = 'paddle_mega_dropdown_panel';
    $handler->task = 'page';
    $handler->subtask = '';
    $handler->label = 'Paddle Mega Dropdown page';
    $handler->handler = 'panelizer_node';
    $handler->weight = -100;
    $handler->conf = array(
      'title' => t('Paddle mega dropdown panelizer'),
      'context' => 'argument_entity_id:node_1',
      'access' => array(),
    );
    $handlers['paddle_mega_dropdown_page'] = $handler;

    return $handlers;
  }

  /**
   * Implements a delegated hook_permission().
   *
   * This makes sure that the needed permissions exist.
   */
  public function hook_permission(&$items) {
    $items['administer panelizer paddle_mega_dropdown paddle_mega_dropdown content'] = array(
      'title' => t('Paddle Mega Dropdown Paddle Mega Dropdown: Administer Panelizer content'),
    );
  }
}
