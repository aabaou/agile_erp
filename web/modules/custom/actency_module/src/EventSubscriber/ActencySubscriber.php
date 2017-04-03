<?php

/**
 * @file
 * Contains \Drupal\my_event_subscriber\EventSubscriber\MyEventSubscriber.
 */

namespace Drupal\actency_module\EventSubscriber;

use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Event Subscriber MyEventSubscriber.
 */
class ActencySubscriber implements EventSubscriberInterface {

  /**
   * Code that should be triggered on event specified
   */
  public function onRespond(FilterResponseEvent $event) {
    // The RESPONSE event occurs once a response was created for replying to a request.
    // For example you could override or add extra HTTP headers in here


    $current_path = \Drupal::service('path.current')->getPath();
    $path_args = explode('/', $current_path);
    
    $user = \Drupal\user\Entity\User::load(\Drupal::currentUser()->id());

    if(isset($path_args[3])){
      if($path_args[1] == "node" && $path_args[3] == "edit"){
        $response = $event->getResponse();
        $response->headers->set('X-Custom-Header', 'MyValue');
      }
      elseif($path_args[1] == "user" && $path_args[3] == "edit"){
        $response = $event->getResponse();
        $response->headers->set('X-Custom-Header', 'MyValue');
      }else{
        _redirect_condition_required_field($user,'init');
      }
    }else{
      _redirect_condition_required_field($user,'init');
    }
  }

  /**
   * {@inheritdoc}
   */
  public static function getSubscribedEvents() {
    // For this example I am using KernelEvents constants (see below a full list).
    $events[KernelEvents::RESPONSE][] = ['onRespond'];
    return $events;
  }

}


