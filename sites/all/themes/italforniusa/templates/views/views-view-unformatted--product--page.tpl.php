<?php

/**
 * @file
 * Default simple view template to display a list of rows.
 *
 * @ingroup views_templates
 */
?>
<?php if (!empty($title)): ?>
  <?php
    $id = strtolower($title);
    $id = str_replace(" ", "-", $id);
  ?>
  <h3 id="<?php print $id; ?>" class="accordion"><?php print t($title); ?></h3>
<?php endif; ?>

<div>
<?php foreach ($rows as $id => $row): ?>
  <div<?php if ($classes_array[$id]) { print ' class="' . $classes_array[$id] .'"';  } ?>>
    <?php print $row; ?>
  </div>
<?php endforeach; ?>
</div>