<?php
/**
 * @file
 * Returns the HTML for a block.
 *
 * Complete documentation for this file is available online.
 * @see https://drupal.org/node/1728246
 * block-views-technical-support-video-block-2
 */
?>
<div id="<?php print $block_html_id; ?>" class="<?php print $classes; ?>"<?php print $attributes; ?>>

  <?php
    $id = strtolower($title);
    $id = str_replace(" ", "-", $id);
  ?>
  <h3 id="<?php print $id; ?>" class="accordion"><?php print $title; ?></h3>

  <?php print $content; ?>

</div>
