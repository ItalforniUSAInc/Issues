<?php
/**
 * @file
 * Contains the theme's functions to manipulate Drupal's default markup.
 *
 * Complete documentation for this file is available online.
 * @see https://drupal.org/node/1728096
 */


/**
 * Override or insert variables into the maintenance page template.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("maintenance_page" in this case.)
 */
/* -- Delete this line if you want to use this function
function italforniusa_preprocess_maintenance_page(&$variables, $hook) {
  // When a variable is manipulated or added in preprocess_html or
  // preprocess_page, that same work is probably needed for the maintenance page
  // as well, so we can just re-use those functions to do that work here.
  italforniusa_preprocess_html($variables, $hook);
  italforniusa_preprocess_page($variables, $hook);
}
// */

/**
 * Override or insert variables into the html templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("html" in this case.)
 */
/* -- Delete this line if you want to use this function
function italforniusa_preprocess_html(&$variables, $hook) {
  $variables['sample_variable'] = t('Lorem ipsum.');

  // The body tag's classes are controlled by the $classes_array variable. To
  // remove a class from $classes_array, use array_diff().
  //$variables['classes_array'] = array_diff($variables['classes_array'], array('class-to-remove'));
}
// */

/**
 * Override or insert variables into the page templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("page" in this case.)
 */
function italforniusa_preprocess_page(&$variables, $hook) {
  
   if(isset($variables['node'])){
  
    $node = $variables['node'];
    $type = $node->type;
    
    // theme home_page content type
    if($type === 'home_page'){
      
      $variables['title'] = '';
      unset($variables['tabs']);
      //unset($variables['page']);
      unset($variables['page']['bottom']);
      
    }
  }
  
}
// */

/**
 * Override or insert variables into the node templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("node" in this case.)
 */

function italforniusa_preprocess_node(&$variables, $hook) {
  
  // submitted
  if ($variables['submitted']) {
    $variables['submitted'] = t('!datetime', array( '!datetime' => format_date($variables['node']->created, 'short')));
  }
  
  // Optionally, run node-type-specific preprocess functions, like
  // italforniusa_preprocess_node_page() or italforniusa_preprocess_node_story().
  $function = __FUNCTION__ . '_' . $variables['node']->type;
  if (function_exists($function)) {
    $function($variables, $hook);
  }
}
// */


function italforniusa_preprocess_node_home_page(&$variables, $hook) {

  $nid = $variables['nid'];
  $node = node_load($nid);
  
  // top
  $variables['hp_top_center_img'] = field_view_field('node', $node, 'field_tc_image', 'full');
  $variables['hp_top_center_title'] = field_view_field('node', $node, 'field_tc_title', 'full');
  $variables['hp_top_center_link'] = field_view_field('node', $node, 'field_tc_url', 'full');
  
  // middle
  $variables['hp_middle_left_img'] = field_view_field('node', $node, 'field_ml_image', 'full');
  $variables['hp_middle_left_title'] = field_view_field('node', $node, 'field_ml_title', 'full');
  $variables['hp_middle_left_link'] = field_view_field('node', $node, 'field_ml_url', 'full');
  
  $variables['hp_middle_center_img'] = field_view_field('node', $node, 'field_mc_image', 'full');
  $variables['hp_middle_center_title'] = field_view_field('node', $node, 'field_mc_title', 'full');
  $variables['hp_middle_center_link'] = field_view_field('node', $node, 'field_mc_url', 'full');
  
  $variables['hp_middle_right_img'] = field_view_field('node', $node, 'field_mr_image', 'full');
  $variables['hp_middle_right_title'] = field_view_field('node', $node, 'field_mr_title', 'full');
  $variables['hp_middle_right_link'] = field_view_field('node', $node, 'field_mr_url', 'full');
  
  // bottom
  $variables['hp_bottom_center_img'] = field_view_field('node', $node, 'field_bc_image', 'full');
  $variables['hp_bottom_center_title'] = field_view_field('node', $node, 'field_bc_title', 'full');
  $variables['hp_bottom_center_link'] = field_view_field('node', $node, 'field_bc_url', 'full');

}

/**
 * Override or insert variables into the comment templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("comment" in this case.)
 */
/* -- Delete this line if you want to use this function
function italforniusa_preprocess_comment(&$variables, $hook) {
  $variables['sample_variable'] = t('Lorem ipsum.');
}
// */

/**
 * Override or insert variables into the region templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("region" in this case.)
 */
/* -- Delete this line if you want to use this function
function italforniusa_preprocess_region(&$variables, $hook) {
  // Don't use Zen's region--sidebar.tpl.php template for sidebars.
  //if (strpos($variables['region'], 'sidebar_') === 0) {
  //  $variables['theme_hook_suggestions'] = array_diff($variables['theme_hook_suggestions'], array('region__sidebar'));
  //}
}
// */

/**
 * Override or insert variables into the block templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("block" in this case.)
 */
/* -- Delete this line if you want to use this function
function italforniusa_preprocess_block(&$variables, $hook) {
  // Add a count to all the blocks in the region.
  // $variables['classes_array'][] = 'count-' . $variables['block_id'];

  // By default, Zen will use the block--no-wrapper.tpl.php for the main
  // content. This optional bit of code undoes that:
  //if ($variables['block_html_id'] == 'block-system-main') {
  //  $variables['theme_hook_suggestions'] = array_diff($variables['theme_hook_suggestions'], array('block__no_wrapper'));
  //}
}
// */


/**
 * Theme views
 */
function italforniusa_preprocess_views_view(&$variables) {
  if(isset($variables['view']->name)) {
    $function = __FUNCTION__  . '__' . $variables['view']->name . '__' . $variables['view']->current_display;
    // dsm($function);
		if(function_exists($function)){
      $function($variables);
    }
  }
}

/**
 * Theme views field
 */
function italforniusa_preprocess_views_view_fields(&$variables) {
  if (isset($variables['view']->name)) {
    $function = __FUNCTION__ . '__' . $variables['view']->name . '__' . $variables['view']->current_display;
		// dsm($function);
    if (function_exists($function)) {
      $function($variables);
    }
  }
}

function italforniusa_preprocess_views_view_fields__media__page(&$variables) {

  // dsm($variables);

}
 
 
/**
 * Theme function for thumbnails.
 */
function italforniusa_youtube_thumbnail($variables) {
  $id = $variables['video_id'];
  $style = $variables['image_style'];

  // Get YouTube settings - TODO is this needed?
  $size = variable_get('youtube_size', '420x315');
  $dimensions = youtube_get_dimensions($size);

  $files = variable_get('file_public_path', conf_path() . '/files');
  $youtube = variable_get('youtube_thumb_dir', 'youtube');
  $dest = $files . '/' . $youtube . '/' . $id . '.png';

  // Check to see if a thumbnail exists locally.
  if (!file_exists($dest)) {
    // Retrieve the image from YouTube.
    if (!youtube_get_remote_image($id)) {
      // Use the remote source if local copy fails.
      $src = youtube_build_remote_image_path($id);
      return theme('image', array('path' => $src));
    }
  }

  if ($style) {
    $uri = 'public://' . $youtube . '/' . $id . '.png';
    $image = theme('image_style', array('style_name' => $style, 'path' => $uri));
  }
  else {
    $path = $files . '/' . $youtube . '/' . $id . '.png';
    $image = theme('image', array('path' => $path));
  }

  // Check if an url path is provided
  if ($variables['image_link'] != NULL) {
    $url_path = $variables['image_link']['path'];
    $options = $variables['image_link']['options'];
    $image = l($image . '<span class=\'btn-youtube\'></span>', $url_path, $options);
  }

  return $image;
}
