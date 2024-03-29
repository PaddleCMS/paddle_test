<?php
/**
 * @file
 * paddle_overview_page.features.inc
 */

/**
 * Implements hook_ctools_plugin_api().
 */
function paddle_overview_page_ctools_plugin_api($module = NULL, $api = NULL) {
  if ($module == "page_manager" && $api == "pages_default") {
    return array("version" => "1");
  }
  if ($module == "panelizer" && $api == "panelizer") {
    return array("version" => "1");
  }
  if ($module == "strongarm" && $api == "strongarm") {
    return array("version" => "1");
  }
}

/**
 * Implements hook_node_info().
 */
function paddle_overview_page_node_info() {
  $items = array(
    'paddle_overview_page' => array(
      'name' => t('Overview page'),
      'base' => 'node_content',
      'description' => '',
      'has_title' => '1',
      'title_label' => t('Title'),
      'help' => t('Page displaying the different items.'),
    ),
  );
  drupal_alter('node_info', $items);
  return $items;
}
