<?php

/**
 * @file
 * Photoswipe theme functions.
 */

/**
 * Returns HTML for an Photoswipe image field formatter.
 *
 * @param $variables
 *   An associative array containing:
 *   - item: An array of image data.
 *   - image_style: An optional image style.
 *   - path: An array containing the link 'path' and link 'options'.
 *
 * @ingroup themeable
 */
function theme_photoswipe_image_formatter($variables) {
  $item = $variables['item'];
  $node = $variables['node'];
  $field = $variables['field'];
  $settings = $variables['display_settings'];
  $alt = !empty($item['alt']) ? $item['alt'] : '';
  $title = !empty($item['title']) ? $item['title'] : '';

  if (empty($alt) && !empty($item['field_file_image_alt_text'][\Drupal\Core\Language\Language::LANGCODE_NOT_SPECIFIED])) {
    $alt = $item['field_file_image_alt_text'][\Drupal\Core\Language\Language::LANGCODE_NOT_SPECIFIED][0]['value'];
  }
  if (empty($title) && !empty($item['field_file_image_title_text'][\Drupal\Core\Language\Language::LANGCODE_NOT_SPECIFIED])) {
    $title = $item['field_file_image_title_text'][\Drupal\Core\Language\Language::LANGCODE_NOT_SPECIFIED][0]['value'];
  }
  $image = array(
    'path' => $item['uri'],
    'alt' => $alt,
    'title' => $title,
    'style_name' => $settings['photoswipe_node_style'],
  );

  $dimensions = array();
  if (isset($item['width']) && isset($item['height'])) {
    $image['width'] = $dimensions['width'] = $item['width'];
    $image['height'] = $dimensions['height'] = $item['height'];
  }

  if ($style_name = $settings['photoswipe_image_style']) {
    $path = image_style_url($style_name, $image['path']);
    $dimensions = array(
      'width' => $item['width'],
      'height' => $item['height'],
    );
    image_style_transform_dimensions($style_name, $dimensions);
  }
  else {
    $path = file_create_url($image['path']);
  }

  // @FIXME
// theme() has been renamed to _theme() and should NEVER be called directly.
// Calling _theme() directly can alter the expected output and potentially
// introduce security issues (see https://www.drupal.org/node/2195739). You
// should use renderable arrays instead.
// 
// 
// @see https://www.drupal.org/node/2195739
// return theme('photoswipe_imagefield', array('image' => $image, 'path' => $path, 'dimensions' => $dimensions['width'] . 'x' . $dimensions['height']));

}


/**
 * Returns HTML for an image using a specific Photoswipe image style.
 *
 * @param $variables
 *   An associative array containing:
 *   - image: image item as array.
 *   - path: The path of the image that should be displayed in the Photoswipe.
 *
 * @ingroup themeable
 */
function theme_photoswipe_imagefield($variables) {
  $class = array('photoswipe');
  if (!empty($variables['image']['style_name'])) {
    // @FIXME
// theme() has been renamed to _theme() and should NEVER be called directly.
// Calling _theme() directly can alter the expected output and potentially
// introduce security issues (see https://www.drupal.org/node/2195739). You
// should use renderable arrays instead.
// 
// 
// @see https://www.drupal.org/node/2195739
// $image = theme('image_style', $variables['image']);

  }
  else {
    // @FIXME
// theme() has been renamed to _theme() and should NEVER be called directly.
// Calling _theme() directly can alter the expected output and potentially
// introduce security issues (see https://www.drupal.org/node/2195739). You
// should use renderable arrays instead.
// 
// 
// @see https://www.drupal.org/node/2195739
// $image = theme('image', $variables['image']);

  }

  $options = array(
    'html' => TRUE,
    'attributes' => array(
      'class' => implode(' ', $class),
      'data-size' => $variables['dimensions'],
      'data-overlay-title' => $variables['image']['alt']
    )
  );

  // @FIXME
// l() expects a Url object, created from a route name or external URI.
// return l($image, $variables['path'], $options);

}
