<?php
/**
 * @file
 * Template that displays the spotlight version of a node.
 */
?>
<a href="<?php print $output['link']; ?>">
  <div class="node-spotlight">
    <div class="node-spotlight-image">
      <?php print $output['image']; ?>
    </div>
    <div class="node-content">
      <div class="node-header">
        <h4>
          <?php print $output['title']; ?>
        </h4>
      </div>
      <p>
        <?php print $output['text']; ?>
      </p>
    </div>
  </div>
</a>
