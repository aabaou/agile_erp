<?php

namespace Drupal\act_link_back_top\Plugin\Block;


use Drupal\Core\Block\BlockBase;
use Drupal\Core\Block\BlockPluginInterface;
use Drupal\Core\Form\FormStateInterface;


/**
 * Provides a 'Back to the top' Block.
 *
 * @Block(
 *   id = "act_link_back_top",
 *   admin_label = @Translation("Back to the top"),
 * )
 *
 */
class ActBackTopBlock extends BlockBase implements BlockPluginInterface{

  public function build() {

    $config = $this->getConfiguration();

    //Defines the value of the data_position attribute
    if(isset($config['act_link_back_top_position']) && !empty($config['act_link_back_top_position'])) {
      if( 'static' == $config['act_link_back_top_position']){
        $data_position='static';
      }elseif( 'dynamic' == $config['act_link_back_top_position']){
        $data_position='dynamic';
      }
    }else{
      $data_position='';
    }

    //Defines the value of the data_duration attribute
    if(isset($config['act_link_back_top_duration_effect']) && !empty($config['act_link_back_top_duration_effect'])) {
        $data_duration=$config['act_link_back_top_duration_effect'];
    }else{
      $data_duration='';
    }


    if (isset($config['act_link_back_top_link']['picture']) && !empty($config['act_link_back_top_link']['picture'])) {
      $base_url = \Drupal::request()->getSchemeAndHttpHost();
      $imageid = $config['act_link_back_top_link']['picture'];
      $file = file_load($imageid[0]);
      $file_alt=$config['act_link_back_top_link']['picture_alt'];

      return [
        '#type' => 'markup',
       '#markup' =>'<p class="act-link-back-top"><a href="#main-content"  data-position="' . $data_position . '" data-duration="' . $data_duration . '"><img src="' . $base_url . '/sites/default/files/images/' . $file->getFilename() . '" alt="' . $file_alt . '" /></a></p>',
        '#title' => '',
        '#attached' => array(
          'library' => array('act_link_back_top/act_link_back_top'),
        ),
      ];

    }elseif(isset($config['act_link_back_top_link']['text']) && !empty($config['act_link_back_top_link']['text'])) {
      $text_link = $config['act_link_back_top_link']['text'];

    }else{
      $text_link='Back to the top';
    }

    return [
      '#type' => 'markup',
      '#markup' => $this->t('<p class="act-link-back-top"><a href="#main-content" data-position="@data_position" data-duration="@data_duration">@text_link</a></p>',array('@text_link' =>  $text_link,'@data_position' =>  $data_position,'@data_duration' =>  $data_duration)),
      '#title' => '',
      '#attached' => array(
        'library' => array('act_link_back_top/act_link_back_top'),
      ),

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
      'static' => t('Static'),
      'dynamic' => t('Dynamic'),
    );

    $form['act_link_back_top_position'] = array(
      '#type'            => 'radios',
      '#title'           => $this->t('Position of the link "Back to the top"'),
      '#options'         => $options,
      '#description'     => $this->t('Specify the position of the "Back to the top" link. If the link is of dynamic type, the link will be displayed during the scroll of the page.'),
      '#default_value'   => isset($config['act_link_back_top_position']) ? $config['act_link_back_top_position'] : '',
    );

    $form['act_link_back_top_duration_effect'] = array(
      '#type'           => 'number',
      '#title'          => $this->t('Duration of the ascent effect'),
      '#description'    => $this->t('Indicate the animation duration (ms) to return to the top of the page.'),
      '#default_value'  => isset($config['act_link_back_top_duration_effect']) ? $config['act_link_back_top_duration_effect'] : '',
    );

    $form['act_link_back_top_link'] = array(
      '#type' => 'fieldset',
      '#title' => t('Link'),
      // Make the fieldset collapsible.
      '#collapsible' => TRUE, // Added
      '#collapsed' => FALSE, // Added
    );

    $form['act_link_back_top_link']['text'] = [
      '#type'           => 'textfield',
      '#size'           => 45,
      '#title'          => $this->t('Link Text'),
      '#default_value'  => isset($config['act_link_back_top_link']['text']) ? $config['act_link_back_top_link']['text'] : $this->t('Back to the top'),
    ];

    $form['act_link_back_top_link']['picture'] = array(
      '#type'           => 'managed_file',
      '#title'          => $this->t('Picture'),
      '#description'    => $this->t('You can select an image to replace the text "Back to the top".'),
      '#default_value'  => isset($config['act_link_back_top_link']['picture']) ? $config['act_link_back_top_link']['picture'] : '',
      '#upload_location' => 'public://images/',
      '#upload_validators'  => array(
        'file_validate_extensions'  => array('gif png jpg jpeg'),
        'file_validate_size'        => array(25600000),
      ),

    );


    $form['act_link_back_top_link']['picture_alt'] = [
      '#type'           => 'textfield',
      '#size'           => 45,
      '#title'          => $this->t('Alternative text'),
      '#required'       => TRUE,
      '#default_value'  => isset($config['act_link_back_top_link']['picture_alt']) ? $config['act_link_back_top_link']['picture_alt'] : '',
      '#description'    => $this->t('This text will be used by screen readers, search engines, or when the image can not be loaded.'),
      '#states' => array(
        'invisible' => array(
          // Displays the field only if the ['act_link_back_top_link']['picture'] field is specified
          ':input[name="files[settings_act_link_back_top_link_picture]"]' => array('value' => ''),
        ),
      ),
    ];


    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    parent::blockSubmit($form, $form_state);
    $values = $form_state->getValues();
    $this->configuration['act_link_back_top_position'] = $values['act_link_back_top_position'];
    $this->configuration['act_link_back_top_duration_effect'] = $values['act_link_back_top_duration_effect'];
    $this->configuration['act_link_back_top_link']['text'] = $values['act_link_back_top_link']['text'];
    $this->configuration['act_link_back_top_link']['picture'] = $values['act_link_back_top_link']['picture'];
    $this->configuration['act_link_back_top_link']['picture_alt'] = $values['act_link_back_top_link']['picture_alt'];

  }


}