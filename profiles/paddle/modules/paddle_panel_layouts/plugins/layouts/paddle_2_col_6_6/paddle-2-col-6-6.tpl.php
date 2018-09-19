<?php
/**
 * @file
 * Template for a 6/6 two column layout
 *
 * Variables:
 * - $content: An array of content, each item in the array is keyed to one
 *   panel of the layout. This layout supports the following sections:
 *   - $content['left']: The left panel in the layout.
 *   - $content['right']: The right panel in the layout.
 */

?>

<div class="row paddle-layout-paddle_2_col_6_6 <?php print $classes; ?>">
  <div class="col-md-6 root-column panel-region-left">
    <div><?php print $content['left']; ?></div>
  </div>
  <div class="col-md-6 root-column panel-region-right">
    <div><?php print $content['right']; ?></div>
  </div>
</div>
