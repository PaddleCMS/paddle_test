<?php
/**
 * @file
 * paddle_ebl.features.field_instance_sync.inc
 */

/**
 * Implements hook_field_instance_sync_defaults().
 */
function paddle_ebl_field_instance_sync_defaults() {
  $field_data = array();

  $field_data['node-paddle_ebl_page-body'] = array(
    'synced' => TRUE,
    'slave' => TRUE,
  );
  $field_data['node-paddle_ebl_page-field_paddle_featured_image'] = array(
    'synced' => TRUE,
    'slave' => TRUE,
  );
  $field_data['node-paddle_ebl_page-field_paddle_general_tags'] = array(
    'synced' => TRUE,
    'slave' => TRUE,
  );
  $field_data['node-paddle_ebl_page-field_paddle_seo_description'] = array(
    'synced' => TRUE,
    'slave' => TRUE,
  );
  $field_data['node-paddle_ebl_page-field_paddle_seo_title'] = array(
    'synced' => TRUE,
    'slave' => TRUE,
  );
  $field_data['node-paddle_ebl_page-field_paddle_show_next_level'] = array(
    'synced' => TRUE,
    'slave' => TRUE,
  );
  $field_data['node-paddle_ebl_page-field_paddle_tags'] = array(
    'synced' => TRUE,
    'slave' => TRUE,
  );
  $field_data['node-paddle_ebl_page-field_page_responsible_author'] = array(
    'synced' => TRUE,
    'slave' => TRUE,
  );
  $field_data['node-paddle_ebl_page-field_show_breadcrumb'] = array(
    'synced' => TRUE,
    'slave' => TRUE,
  );

  return $field_data;
}
