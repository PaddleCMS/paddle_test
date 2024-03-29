<?php
/**
 * @file
 * paddle_holiday_participation.features.field_instance_sync.inc
 */

/**
 * Implements hook_field_instance_sync_defaults().
 */
function paddle_holiday_participation_field_instance_sync_defaults() {
  $field_data = array();

  $field_data['node-offer-body'] = array(
    'synced' => TRUE,
    'slave' => TRUE,
  );
  $field_data['node-offer-field_paddle_featured_image'] = array(
    'synced' => TRUE,
    'slave' => TRUE,
  );
  $field_data['node-offer-field_paddle_general_tags'] = array(
    'synced' => TRUE,
    'slave' => TRUE,
  );
  $field_data['node-offer-field_paddle_seo_description'] = array(
    'synced' => TRUE,
    'slave' => TRUE,
  );
  $field_data['node-offer-field_paddle_seo_title'] = array(
    'synced' => TRUE,
    'slave' => TRUE,
  );
  $field_data['node-offer-field_paddle_show_next_level'] = array(
    'synced' => TRUE,
    'slave' => TRUE,
  );
  $field_data['node-offer-field_paddle_tags'] = array(
    'synced' => TRUE,
    'slave' => TRUE,
  );
  $field_data['node-offer-field_page_responsible_author'] = array(
    'synced' => TRUE,
    'slave' => TRUE,
  );
  $field_data['node-offer-field_show_breadcrumb'] = array(
    'synced' => TRUE,
    'slave' => TRUE,
  );

  return $field_data;
}
