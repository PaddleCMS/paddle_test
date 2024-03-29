<?php

/**
 * @file
 * Email notifier plugin class.
 */

/**
 * Email notifier.
 */
class MessageNotifierEmail extends MessageNotifierBase {

  /**
   * Implements MessageNotifierInterface::deliver().
   */
  public function deliver(array $output = array()) {
    $plugin = $this->plugin;
    $message = $this->message;

    $options = $plugin['options'];

    $account = user_load($message->uid);
    $mail = $options['mail'] ? $options['mail'] : $account->mail;

    $languages = language_list();
    if (!$options['language override']) {
      $lang = !empty($account->language) && $account->language != LANGUAGE_NONE ? $languages[$account->language] : language_default();
    }
    else {
      $lang = $languages[$message->language];
    }
    // Start with basic clean-up to remove line-feeds etc.
    $output['message_notify_email_subject'] = trim($output['message_notify_email_subject']);
    // The subject in an email can't be with HTML, so strip it.
    $output['message_notify_email_subject'] = strip_tags($output['message_notify_email_subject']);
    // Decode entities.
    $output['message_notify_email_subject'] = html_entity_decode($output['message_notify_email_subject']);

    // Pass the message entity along to hook_drupal_mail().
    $output['message_entity'] = $message;

    $result = drupal_mail('message_notify', $message->type, $mail, $lang, $output);

    return $result['result'];
  }

}
