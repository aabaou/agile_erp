<?php

/**
 * @file
 * Contains \Drupal\act_events\Plugin\Field\FieldFormatter\ImageTitleCaption
 */

namespace Drupal\act_events\Plugin\Field\FieldFormatter;


use Drupal\responsive_image\Plugin\Field\FieldFormatter\ResponsiveImageFormatter;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Url;

/**
 * Plugin implementation of the 'act_events_image_formatter' formatter.
 *
 * @FieldFormatter(
 *   id = "act_events_image_formatter",
 *   label = @Translation("Image formatter for Events"),
 *   field_types = {
 *     "image"
 *   }
 * )
 */
class ActEventsImageFormatter extends ResponsiveImageFormatter {
  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode ) {
    $elements = parent::viewElements($items, $langcode);
    $current_path = \Drupal::service('act_path.path_view_news_events');

    if($current_path ->isEventsGrid()){
      $mode=  'grid';
    }elseif($current_path ->isEventsList()){
      $mode=  'list';
    }

    if(isset($mode)){
      $mode_display= ['mode' => $mode];
    }

    foreach ($elements as &$element) {
      if (isset($element['#url'])) {

        $route_name=$element['#url']->getRouteName();
        $parameters = $element['#url']->getRouteParameters();

        //add the display mode (grid or list) in the parameters
        if(isset($mode)) {
          array_push($parameters, $mode_display);
        }

        $uri= url::fromRoute($route_name,$parameters);
        $element['#url']=$uri;
      }
    }
    return $elements;
  }
}
