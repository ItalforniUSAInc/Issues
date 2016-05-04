<?php
/**
 * @file
 * Returns the HTML for a node.
 *
 * Complete documentation for this file is available online.
 * @see https://drupal.org/node/1728164
 */
?>
<article class="node-<?php print $node->nid; ?> <?php print $classes; ?> clearfix"<?php print $attributes; ?>>

  <div class="hp-top wrapper">
    <div class="cont center">
      <?php print drupal_render($hp_top_center_img); ?>
      <?php print drupal_render($hp_top_center_title); ?>
      <?php print drupal_render($hp_top_center_link); ?>
    </div>
  </div>
  
  <div class="hp-middle wrapper">
    <div class="cont left">
      <?php print drupal_render($hp_middle_left_img); ?>
      <?php print drupal_render($hp_middle_left_title); ?>
      <?php print drupal_render($hp_middle_left_link); ?>
    </div>
     <div class="cont center">
      <?php print drupal_render($hp_middle_center_img); ?>
      <?php print drupal_render($hp_middle_center_title); ?>
      <?php print drupal_render($hp_middle_center_link); ?>
    </div>
     <div class="cont right">
      <?php print drupal_render($hp_middle_right_img); ?>
      <?php print drupal_render($hp_middle_right_title); ?>
      <?php print drupal_render($hp_middle_right_link); ?>
    </div>
  </div>
  
  <div class="hp-bottom wrapper">
    <div class="cont center">
      <?php print drupal_render($hp_bottom_center_img); ?>
      <?php print drupal_render($hp_bottom_center_title); ?>
      <?php print drupal_render($hp_bottom_center_link); ?>
    </div>
  </div>

</article>
