<?php
namespace Drupal\block_annuaire_des_membres\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\node\Entity\NodeType;

/**
 *
 * @Block(
 *   id = "block_annuaire_des_membres",
 *   admin_label = @Translation("Block annuaire des membres")
 * )
 */
class HomePageBlockMembers extends BlockBase {


  public function blockForm($form, FormStateInterface $form_state) {

    $form['node_block_title'] = array(
      '#type' => 'textfield',
      '#title' => t('Title'),
      '#default_value' => $this->configuration['title_annuaire_des_membres'],
    );

    $form['node_block_text'] = array(
      '#type' => 'textarea',
      '#title' => t('Text'),
      '#default_value' => $this->configuration['text_annuaire_des_membres'],
    );

    $form['node_block_button'] = array(
      '#type' => 'textfield',
      '#title' => t('Button name'),
      '#default_value' => $this->configuration['button_annuaire_des_membres'],
    );


    $form['node_block_link'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('URL'),
      '#default_value' => $this->configuration['link_annuaire_des_membres'],
    );
    return $form;

  }

  public function blockSubmit($form, FormStateInterface $form_state) {
    $this->configuration['title_annuaire_des_membres'] = $form_state->getValue('node_block_title');
    $this->configuration['text_annuaire_des_membres'] = $form_state->getValue('node_block_text');
    $this->configuration['button_annuaire_des_membres'] = $form_state->getValue('node_block_button');
    $this->configuration['link_annuaire_des_membres'] = $form_state->getValue('node_block_link');
  }

  /**
   * @return array
   */
  public function build() {
    $block_storage = \Drupal::entityTypeManager()->getStorage('block')->load('blockannuairedesmembres');
    $data = $block_storage->get("settings");
    $build = [
      '#theme' => 'block_annuaire_des_membres',
      '#titre' => $data['title_annuaire_des_membres'],
      '#text' => $data['text_annuaire_des_membres'],
      '#bouton' => $data['button_annuaire_des_membres'],
      '#link' => $data['link_annuaire_des_membres'],
    ];
    return $build;
  }
}