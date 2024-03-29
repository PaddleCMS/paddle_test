<?php
/**
 * @file
 * Main panel pane template.
 *
 * Variables available:
 * - $pane->type: the content type inside this pane
 * - $pane->subtype: The subtype, if applicable. If a view it will be the
 *   view name; if a node it will be the nid, etc.
 * - $title: The title of the content
 * - $content: The actual content
 * - $links: Any links associated with the content
 * - $more: An optional 'more' link (destination only)
 * - $admin_links: Administrative links associated with the content
 * - $feeds: Any feed icons or associated with the content
 * - $display: The complete panels display object containing all kinds of
 *   data including the contexts and all of the other panes being displayed.
 *
 * Change compared to parent template file:
 * Added 'typography' CSS class to wrapper around content that comes from a
 * WYSIWYG editor.
 */
?>
<?php if ($pane_prefix): ?>
  <?php print $pane_prefix; ?>
<?php endif; ?>
  <!-- We only want to add the region class to our pane if it actually contains
     content. We add this change to the panels-pane template so that every pane
     in the web universe theme receives the 'region' class when required. -->
  <div class="<?php if (!empty($content)): print 'region'; endif; ?>">
    <div class="<?php print $classes; ?>" <?php print $id; ?> <?php print $attributes; ?>>
      <?php if ($admin_links): ?>
        <?php print $admin_links; ?>
      <?php endif; ?>
      <?php if ($uuid): ?>
        <a name="<?php print $uuid; ?>"></a>
      <?php endif; ?>
      <?php print render($title_prefix); ?>
      <?php if ($title): ?>
        <h2<?php print $title_attributes; ?>><?php print $title; ?></h2>
      <?php endif; ?>
      <?php print render($title_suffix); ?>

      <?php if ($feeds): ?>
        <div class="feed">
          <?php print $feeds; ?>
        </div>
      <?php endif; ?>

      <?php $rendered_content = render($content); ?>
      <?php if (!empty($rendered_content)): ?>
        <div class="typography">
          <?php print $rendered_content; ?>
        </div>
      <?php endif; ?>

      <?php if ($links): ?>
        <div class="links">
          <?php print $links; ?>
        </div>
      <?php endif; ?>

      <?php if ($more): ?>
        <div class="more-link">
          <?php print $more; ?>
        </div>
      <?php endif; ?>
    </div>
  </div>
<?php if ($pane_suffix): ?>
  <?php print $pane_suffix; ?>
<?php endif; ?>
