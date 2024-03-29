<?php
/**
 * @file
 * Default Elysia Cron rules.
 */

/**
 * Implements hook_default_elysia_cron_rules().
 */
function paddle_notifications_default_elysia_cron_rules() {
  $cron_rules = array();

  $cron_rule = new stdClass;
  $cron_rule->disabled = FALSE; /* Edit this to true to make a default cron_rule disabled initially */
  $cron_rule->api_version = 1;
  $cron_rule->name = 'paddle_notifications_cron';
  $cron_rule->disable = NULL;
  $cron_rule->rule = '4 0 * * *';
  $cron_rule->weight = NULL;
  $cron_rule->context = NULL;
  $cron_rules['paddle_notifications_cron'] = $cron_rule;

  return $cron_rules;
}
