<?php

/**
* Returns HTML for a "more" link, like those used in blocks.
*
* @param $variables
* An associative array containing:
* - url: The url of the main page.
* - title: A descriptive verb for the link, like 'Read more'.
*/
function drupal_mods_more_link($variables) {
return '<div class="more">' . l(t('Show me MORE!'), $variables['url'],
array('attributes' => array('title' => $variables['title']))) . '</div>';
}


function drupal_mods_item_list__current_posts($variables){
	  $items = $variables['items'];
  $title = $variables['title'];
  $type = $variables['type'];
  $attributes = $variables['attributes'];

  // Only output the list container and title, if there are any list items.
  // Check to see whether the block title exists before adding a header.
  // Empty headers are not semantic and present accessibility challenges.
  $output = '<div class="item-list-by-clair">';

  if (!empty($items)) {
    $output .= "<div class='current-post-links'>";
    $num_items = count($items);
    $i = 0;
    foreach ($items as $item) {
      $attributes = array();
      $data = '';
      $i++;
      if (is_array($item)) {
        foreach ($item as $key => $value) {
          if ($key == 'data') {
            $data = $value;
          }
          else {
            $attributes[$key] = $value;
          }
        }
      }
      else {
        $data = $item;
      }
 
      $output .= '<span>' . $data . "</span><br/ >";
    }
    $output .= "</div>";
  }
  $output .= '</div>';
  return $output;
}

function drupal_mods_field__field_tags__article($variables){
	 $output = '';

  // Render the label, if it's not hidden.
  if (!$variables['label_hidden']) {
    $output .= '<h3 class="field-label hi clair">Our Tags: </h3>';
  }

  // Render the items.
  $output .= ($variables['element']['#label_display'] == 'inline') ? '<ul class="links inline">' : '<ul class="current-posts-list links">';
  foreach ($variables['items'] as $delta => $item) {
    $output .= '<li class="special_class taxonomy-term-reference-' . $delta . '"' . $variables['item_attributes'][$delta] . '>' . drupal_render($item) . '</li>';
  }
  $output .= '</ul>';

  // Render the top-level DIV.
  $output = '<div class="' . $variables['classes'] . (!in_array('clearfix', $variables['classes_array']) ? ' clearfix' : '') . '"' . $variables['attributes'] .'>' . $output . '</div>';

  return $output;
}
