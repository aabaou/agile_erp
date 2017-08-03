<?php
/**
 * @file Provides a service that retrieves the path or name of the route from the news view or events view.
 *
 * Note: The path of the news view can not be retrieved by \ Drupal :: service ('path.current') -> getPath ();
 * The news view uses ajax. When loading the ajax page, the path to the view is "//news-grid" or "//views/ajax" for the grid view mode.
 */
namespace  Drupal\act_path;

class PathServices {

  protected $current_path;


  public function __construct() {

    $this->current_path = \Drupal::service('path.current')->getPath();

  }

  public function isNewsGrid(){
    if (strstr( $this->current_path, '/news-grid')
      || (isset($_POST['view_name']) && ('act_news_grid' == $_POST['view_name'] || 'act_news_grid_highlight' == $_POST['view_name'])) ){
      return true;

    }
    else {
      return false;
    }
  }

  public function isNewsList(){
    if (strstr( $this->current_path, '/news-list')
      || (isset($_POST['view_name']) && ('act_news_list' == $_POST['view_name'] || 'act_news_list_highlight' == $_POST['view_name'])) ){
      return true;
    }
    else {
      return false;
    }
  }


  public function getRouteNameNewsGrid(){

    $route_provider = \Drupal::service('router.route_provider');

    if (count($route_provider->getRoutesByNames(['view.act_news_grid_highlight.page_1'])) === 1) {
      $route_name = 'view.act_news_grid_highlight.page_1';
    }elseif (count($route_provider->getRoutesByNames(['view.act_news_grid.page_1'])) === 1) {
      $route_name = 'view.act_news_grid.page_1';
    }else{
      return false;
    }

    return $route_name;
  }

  public function getRouteNameNewsList(){

    $route_provider = \Drupal::service('router.route_provider');

    if (count($route_provider->getRoutesByNames(['view.act_news_list_highlight.page_1'])) === 1) {
      $route_name = 'view.act_news_list_highlight.page_1';
    }elseif (count($route_provider->getRoutesByNames(['view.act_news_list.page_1'])) === 1) {
      $route_name = 'view.act_news_list.page_1';
    }else{
      return false;
    }

    return $route_name;
  }

  public function getRouteNameNewsView(){


    $request = \Drupal::request();


    if($this->isNewsGrid()) {
      $route_name = $this->getRouteNameNewsGrid();

    }elseif($this ->isNewsList()){
      $route_name = $this->getRouteNameNewsList();

    }elseif ($request->query->has('mode')) {

      if('grid' == $request->query->get('mode')){

        $route_name = $this->getRouteNameNewsGrid();

      }else{

        $route_name = $this->getRouteNameNewsList();
      }
    }else{
      if($this->getRouteNameNewsList() != false ){
        $route_name = $this->getRouteNameNewsList();
      }elseif($this->getRouteNameNewsGrid() != false){
        $route_name = $this->getRouteNameNewsGrid();
      }

    }

    if(isset($route_name)){
      return $route_name;
    }else{
      return false;
    }


  }


  public function isEventsGrid(){
    if (strstr( $this->current_path, '/events-grid')
      || (isset($_POST['view_name']) && ('act_events_grid' == $_POST['view_name'] || 'act_events_grid_highlight' == $_POST['view_name'])) ){
      return true;

    }
    else {
      return false;
    }
  }

  public function isEventsList(){
    if (strstr( $this->current_path, '/events-list')
      || (isset($_POST['view_name']) && ('act_events_list' == $_POST['view_name'] || 'act_events_list_highlight' == $_POST['view_name'])) ){
      return true;
    }
    else {
      return false;
    }
  }


  public function getRouteNameEventsGrid(){

    $route_provider = \Drupal::service('router.route_provider');

    if (count($route_provider->getRoutesByNames(['view.act_events_grid_highlight.page_1'])) === 1) {
      $route_name = 'view.act_events_grid_highlight.page_1';
    }elseif (count($route_provider->getRoutesByNames(['view.act_events_grid.page_1'])) === 1) {
      $route_name = 'view.act_events_grid.page_1';
    }else{
      return false;
    }

    return $route_name;
  }

  public function getRouteNameEventsList(){

    $route_provider = \Drupal::service('router.route_provider');

    if (count($route_provider->getRoutesByNames(['view.act_events_list_highlight.page_1'])) === 1) {
      $route_name = 'view.act_events_list_highlight.page_1';
    }elseif (count($route_provider->getRoutesByNames(['view.act_events_list.page_1'])) === 1) {
      $route_name = 'view.act_events_list.page_1';
    }else{
      return false;
    }

    return $route_name;
  }

  public function getRouteNameEventsView(){


    $request = \Drupal::request();


    if($this->isEventsGrid()) {
      $route_name = $this->getRouteNameEventsGrid();

    }elseif($this ->isEventsList()){
      $route_name = $this->getRouteNameEventsList();

    }elseif ($request->query->has('mode')) {

      if('grid' == $request->query->get('mode')){

        $route_name = $this->getRouteNameEventsGrid();

      }else{

        $route_name = $this->getRouteNameEventsList();
      }
    }else{
      if($this->getRouteNameEventsList() != false ){
        $route_name = $this->getRouteNameEventsList();
      }elseif($this->getRouteNameEventsGrid() != false){
        $route_name = $this->getRouteNameEventsGrid();
      }

    }

    if(isset($route_name)){
      return $route_name;
    }else{
      return false;
    }


  }
}