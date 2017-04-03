<?php
namespace Drupal\block_annuaire_des_formations\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\node\Entity\NodeType;

/**
 *
 * @Block(
 *   id = "block_annuaire_des_formations",
 *   admin_label = @Translation("Block annuaire des formations")
 * )
 */
class HomePageBlock extends BlockBase {


  public function blockForm($form, FormStateInterface $form_state) {

    $form['node_block_title'] = array(
      '#type' => 'textfield',
      '#title' => t('Title'),
      '#default_value' => $this->configuration['title_p'],
    );

    $form['node_block_text'] = array(
      '#type' => 'textarea',
      '#title' => t('Text'),
      '#default_value' => $this->configuration['text_p'],
    );

    $form['node_block_button'] = array(
      '#type' => 'textfield',
      '#title' => t('Button name'),
      '#default_value' => $this->configuration['button_p'],
    );


    $form['node_block_link'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('URL'),
      '#default_value' => $this->configuration['link_p'],
    );
    return $form;

  }

  public function blockSubmit($form, FormStateInterface $form_state) {
    $this->configuration['title_p'] = $form_state->getValue('node_block_title');
    $this->configuration['text_p'] = $form_state->getValue('node_block_text');
    $this->configuration['button_p'] = $form_state->getValue('node_block_button');
    $this->configuration['link_p'] = $form_state->getValue('node_block_link');
  }

  /**
   * @return array
   */
  public function build() {
    $block_storage = \Drupal::entityTypeManager()->getStorage('block')->load('blockannuairedesformations');
    $data = $block_storage->get("settings");
    $build = [
      '#theme' => 'block_annuaire_des_formations',
      '#titre' => $data['title_p'],
      '#text' => $data['text_p'],
      '#bouton' => $data['button_p'],
      '#link' => $data['link_p'],
    ];

    return $build;
  }
}