<?php

/**
 * @file
 * Contains \Drupal\photoswipe\Plugin\Field\FieldFormatter\PhotoswipeFieldFormatter.
 */

namespace Drupal\photoswipe\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Plugin implementation of the 'photoswipe_field_formatter' formatter.
 *
 * @FieldFormatter(
 *   id = "photoswipe_field_formatter",
 *   label = @Translation("Photoswipe"),
 *   field_types = {
 *     "image"
 *   }
 * )
 */
class PhotoswipeFieldFormatter extends FormatterBase {
  /**
   * {@inheritdoc}
   */
  public static function defaultSettings() {
    return array(
      'photoswipe_node_style' => '',
      'photoswipe_image_style' => '',
    ) + parent::defaultSettings();
  }

  /**
   * {@inheritdoc}
   */
  public function settingsForm(array $form, FormStateInterface $form_state) {
    $image_styles = image_style_options(FALSE);
    $image_styles_hide = $image_styles;
    $image_styles_hide['hide'] = t('Hide (do not display image)');
    $element['photoswipe_node_style'] = array(
      '#title' => t('Node image style'),
      '#type' => 'select',
      '#default_value' => $this->getSetting('photoswipe_node_style'),
      '#empty_option' => t('None (original image)'),
      '#options' => $image_styles_hide,
      '#description' => t('Image style to use in the node.'),
    );
    $element['photoswipe_image_style'] = array(
      '#title' => t('Photoswipe image style'),
      '#type' => 'select',
      '#default_value' => $this->getSetting('photoswipe_image_style'),
      '#empty_option' => t('None (original image)'),
      '#options' => $image_styles,
      '#description' => t('Image style to use in the Photoswipe.'),
    );

    return $element + parent::settingsForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function settingsSummary() {
    $summary = [];

    $image_styles = image_style_options(FALSE);
    // Unset possible 'No defined styles' option.
    unset($image_styles['']);
    // Styles could be lost because of enabled/disabled modules that defines
    // their styles in code.
    if (isset($image_styles[$this->getSetting('photoswipe_node_style')])) {
      $summary[] = t('Node image style: @style', array('@style' => $image_styles[$this->getSetting('photoswipe_node_style')]));
    }
    else if ($this->getSetting('photoswipe_node_style') == 'hide') {
      $summary[] = t('Node image style: Hide');
    }
    else {
      $summary[] = t('Node image style: Original image');
    }

    if (isset($image_styles[$this->getSetting('photoswipe_image_style')])) {
      $summary[] = t('Photoswipe image style: @style', array('@style' => $image_styles[$this->getSetting('photoswipe_image_style')]));
    }
    else {
      $summary[] = t('photoswipe image style: Original image');
    }

    return $summary;
  }

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    $elements = [];
    $settings = $this->getSettings();

    if (!empty($items)) {
      $elements = array(
        '#attributes' => array('class' => array('photoswipe-gallery')),
      );
      photoswipe_load_assets($elements);
    }

    foreach ($items as $delta => $item) {
      $elements[$delta] = array(
        '#theme' => 'photoswipe_image_formatter',
        '#item' => $item,
        '#display_settings' => $settings,
      );
    }

    return $elements;
  }

}
