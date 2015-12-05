<?php /**
 * @file
 * Contains \Drupal\photoswipe\Plugin\Field\FieldFormatter\Photoswipe.
 */

namespace Drupal\photoswipe\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FormatterBase;

/**
 * @FieldFormatter(
 *  id = "photoswipe",
 *  label = @Translation("Photoswipe"),
 *  field_types = {"image"}
 * )
 */
class Photoswipe extends FormatterBase {

  /**
   * @FIXME
   * Move all logic relating to the photoswipe formatter into this
   * class. For more information, see:
   *
   * https://www.drupal.org/node/1805846
   * https://api.drupal.org/api/drupal/core%21lib%21Drupal%21Core%21Field%21FormatterInterface.php/interface/FormatterInterface/8
   * https://api.drupal.org/api/drupal/core%21lib%21Drupal%21Core%21Field%21FormatterBase.php/class/FormatterBase/8
   */

}
