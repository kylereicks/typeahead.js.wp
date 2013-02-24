<?php
if(!class_exists(Typeahead_WP_JSON_API)){
  class Typeahead_WP_JSON_API{

    function __construct(){
      if(!empty($_GET['data']) && method_exists($this, $_GET['data'])){
        require('../../../../wp-load.php');
        header('Content-Type: application/json');
        echo $this->$_GET['data']();
      }
    }

    function tags(){
      $tag_names = array();
      $tags = get_tags();
      foreach($tags as $tag){
        array_push($tag_names, $tag->name);
      }
      return json_encode($tag_names);
    }

    function categories(){
      $category_names = array();
      $categories = get_categories();
      foreach($categories as $category){
        array_push($category_names, $category->name);
      }
      return json_encode($category_names);
    }
  }
}
