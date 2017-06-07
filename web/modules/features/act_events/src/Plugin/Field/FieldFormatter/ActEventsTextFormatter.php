<?php

/**
 * @file
 * Contains \Drupal\act_events\Plugin\Field\FieldFormatter\ImageTitleCaption
 */

namespace Drupal\act_events\Plugin\Field\FieldFormatter;


use Drupal\smart_trim\Plugin\Field\FieldFormatter\SmartTrimFormatter;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Url;
use Drupal\Core\Link;
use Drupal\smart_trim\Truncate\TruncateHTML;

/**
 * Plugin implementation of the 'image_formatter' formatter.
 *
 * @FieldFormatter(
 *   id = "events_text_formatter",
 *   label = @Translation("Text formatter for Events"),
 *   field_types = {
 *     "text",
 *     "text_long",
 *     "text_with_summary"
 *   }
 * )
 */
class ActEventsTextFormatter extends SmartTrimFormatter {
  
  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode = NULL) {

    $element = array();
    $setting_trim_options = $this->getSetting('trim_options');
    $settings_summary_handler = $this->getSetting('summary_handler');
    $entity = $items->getEntity();

    $current_path= \Drupal::service('act_path.path_view_news_events');

    if($current_path ->isEventsGrid()){
      $mode=  'grid';
    }elseif($current_path ->isEventsList()){
      $mode=  'list';
    }

    if(isset($mode)){
      $mode_display= ['mode' => $mode];
    }

    foreach ($items as $delta => $item) {
      if ($settings_summary_handler != 'ignore' && !empty($item->summary)) {
        $output = $item->summary_processed;
      }
      else {
        $output = $item->processed;
      }

      // Process additional options (currently only HTML on/off).
      if (!empty($setting_trim_options)) {
        if (!empty($setting_trim_options['text'])) {
          // Strip tags.
          $output = strip_tags(str_replace('<', ' <', $output));

          // Strip out line breaks.
          $output = preg_replace('/\n|\r|\t/m', ' ', $output);

          // Strip out non-breaking spaces.
          $output = str_replace('&nbsp;', ' ', $output);
          $output = str_replace("\xc2\xa0", ' ', $output);

          // Strip out extra spaces.
          $output = trim(preg_replace('/\s\s+/', ' ', $output));
        }
      }

      // Make the trim, provided we're not showing a full summary.
      if ($this->getSetting('summary_handler') != 'full' || empty($item->summary)) {
        $truncate = new TruncateHTML();
        $length = $this->getSetting('trim_length');
        $ellipse = $this->getSetting('trim_suffix');
        if ($this->getSetting('trim_type') == 'words') {
          $output = $truncate->truncateWords($output, $length, $ellipse);
        }
        else {
          $output = $truncate->truncateChars($output, $length, $ellipse);
        }
      }

      // Add the link, if there is one!
      $link = '';
      $uri = $entity->toUrl();
      $route_name=$uri->getRouteName();
      $parameters = $uri->getRouteParameters();

      //add the display mode (grid or list) in the parameters
      if(isset($mode)) {
        array_push($parameters, $mode_display);
      }

      $uri= url::fromRoute($route_name,$parameters);
      // But wait! Don't add a more link if the field ends in <!--break-->.
      if ($uri && $this->getSetting('more_link') && strpos(strrev($output), strrev('<!--break-->')) !== 0) {
        $more = $this->getSetting('more_text');
        $class = $this->getSetting('more_text');

        $project_link = Link::fromTextAndUrl($more, $uri);
        $project_link = $project_link->toRenderable();
        $project_link['#attributes'] = array(
          'class' => array(
            $class,
          ),
        );
        $link = render($project_link);
      }
      $output .= $link;
      $element[$delta] = array('#markup' => $output);
    }
    return $element;
  }
}
