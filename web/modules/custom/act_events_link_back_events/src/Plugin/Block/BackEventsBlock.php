<?php

namespace Drupal\act_events_link_back_events\Plugin\Block;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Block\BlockPluginInterface;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a 'Back to all events' Block.
 *
 * @Block(
 *   id = "act_events_link_back_events",
 *   admin_label = @Translation("Back to all events"),
 * )
 *
 */
class BackEventsBlock extends BlockBase implements BlockPluginInterface{

  public function blockAccess(AccountInterface $account) {
    $node = \Drupal::routeMatch()->getParameter('node');
    if (isset($node) && $node->getType() == 'act_events') {
      return AccessResult::allowed();
    }
    return AccessResult::forbidden("Access is restricted to act_events content type");
  }

  /**
   * {@inheritdoc}
   */


  public function build() {

    $config = $this->getConfiguration();
    $route_view_events= \Drupal::service('act_path.path_view_news_events');


    $request = \Drupal::request();
    if ($request->query->has('mode')) {
      $path = 'events-'.$request->query->get('mode');
    }elseif(isset($config['act_events_link_back_events']) && !empty($config['act_events_link_back_events'])) {
      $path = $config['act_events_link_back_events'];
    }else{
      if($route_view_events->getRouteNameEventsList() != false){
        $path = 'events-list';
      }else{
        $path='events-grid';
      }

    }

    return [
      '#type' => 'markup',
      '#markup' => $this->t('<a href="/@path">Back to all events</a>',array('@path' =>  $path)),
      '#title' => '',
    ];
  }
  /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state) {
    $form = parent::blockForm($form, $form_state);

    $config = $this->getConfiguration();

    # Options to display in our form radio buttons
    $options = array(
      'events-list' => t('List'),
      'events-grid' => t('Grid'),
    );

    $form['act_events_link_back_events'] = array(
      '#type' => 'radios',
      '#title' => $this->t('View mode'),
      '#options' => $options,
      '#description' => $this->t('Specify the default view mode (list or grid). The link "Back to all events" will display this view mode.'),
      '#default_value' => isset($config['act_events_link_back_events']) ? $config['act_events_link_back_events'] : '',
    );

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    parent::blockSubmit($form, $form_state);
    $values = $form_state->getValues();
    $this->configuration['act_events_link_back_events'] = $values['act_events_link_back_events'];

  }


}