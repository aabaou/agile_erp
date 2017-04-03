<?php

namespace Drupal\form_organisme_et_utilisateur\Controller;

use Drupal\Core\Controller\ControllerBase;

class OrganismeUserController extends ControllerBase{

  public function getFormOrganisme(){
    $myentity = $this->entityManager()->getStorageController('organisme')->create(array());
    return $this->entityFormBuilder()->getForm($myentity, 'default');
  }

}