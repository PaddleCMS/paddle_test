<?php
/**
 * @file
 * Template file for the example display.
 *
 * Variables available:
 *
 * $plugin: The pager plugin object. This contains the view.
 *
 * $plugin->view
 *   The view object for this navigation.
 *
 * $nav_title
 *   The formatted title for this view. In the case of block
 *   views, it will be a link to the full view, otherwise it will
 *   be the formatted name of the year, month, day, or week.
 *
 * $prev_url
 * $next_url
 *   Urls for the previous and next calendar pages. The links are
 *   composed in the template to make it easier to change the text,
 *   add images, etc.
 *
 * $prev_options
 * $next_options
 *   Query strings and other options for the links that need to
 *   be used in the l() function, including rel=nofollow.
 */
?>
<?php if (!empty($pager_prefix)) : print $pager_prefix; endif; ?>
<div class="date-nav-wrapper clearfix<?php if (!empty($extra_classes)) : print $extra_classes; endif; ?>">
  <div class="date-nav item-list">
    <div class="date-heading">
      <h3><?php print $nav_title ?></h3>
    </div>
    <ul class="pager">
    <?php if (!empty($prev_url)) : ?>
      <li class="date-prev">
        <a href="<?php print url($prev_url, $prev_options); ?>" <?php print drupal_attributes($prev_options['attributes']); ?>>
          <i class="fa fa-chevron-left"></i>
          <span class="element-invisible element-focusable"><?php print t('Previous', array(), array('context' => 'date_nav')); ?></span>
        </a>
      </li>
    <?php endif; ?>
    <?php if (!empty($next_url)) : ?>
      <li class="date-next">
        <a href="<?php print url($next_url, $next_options); ?>" <?php print drupal_attributes($next_options['attributes']); ?>>
          <i class="fa fa-chevron-right"></i>
          <span class="element-invisible element-focusable"><?php print t('Next', array(), array('context' => 'date_nav')); ?></span>
        </a>
      </li>
    <?php endif; ?>
    </ul>
  </div>
</div>
