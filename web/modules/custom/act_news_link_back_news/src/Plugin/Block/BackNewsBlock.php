<?php

namespace Drupal\act_news_link_back_news\Plugin\Block;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Block\BlockPluginInterface;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a 'Back to all news' Block.
 *
 * @Block(
 *   id = "act_news_link_back_news",
 *   admin_label = @Translation("Back to all news"),
 * )
 *
 */
class BackNewsBlock extends BlockBase implements BlockPluginInterface{

  public function blockAccess(AccountInterface $account) {
    $node = \Drupal::routeMatch()->getParameter('node');
    if (isset($node) && $node->getType() == 'act_node_news') {
      return AccessResult::allowed();
    }
    return AccessResult::forbidden("Access is restricted to act_node_news content type");
  }

  /**
   * {@inheritdoc}
   */


  public function build() {

    $config = $this->getConfiguration();
    $route_view_news= \Drupal::service('act_path.path_view_news_events');



    $request = \Drupal::request();
    if ($request->query->has('mode')) {
      $path = 'news-'.$request->query->get('mode');
    }elseif(isset($config['act_news_link_back_news']) && !empty($config['act_news_link_back_news'])) {
      $path = $config['act_news_link_back_news'];
    }else{
      if($route_view_news->getRouteNameNewsList() != false){
        $path = 'news-list';
      }else{
        $path = 'news-grid';
      }

    }

    return [
      '#type' => 'markup',
      '#markup' => $this->t('<a href="/@path">Back to all news</a>',array('@path' =>  $path)),
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
      'news-list' => t('List'),
      'news-grid' => t('Grid'),
    );

    $form['act_news_link_back_news'] = array(
      '#type' => 'radios',
      '#title' => $this->t('View mode'),
      '#options' => $options,
      '#description' => $this->t('Specify the default view mode (list or grid). The link "Back to all news" will display this view mode.'),
      '#default_value' => isset($config['act_news_link_back_news']) ? $config['act_news_link_back_news'] : '',
    );

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    parent::blockSubmit($form, $form_state);
    $values = $form_state->getValues();
    $this->configuration['act_news_link_back_news'] = $values['act_news_link_back_news'];

  }


}