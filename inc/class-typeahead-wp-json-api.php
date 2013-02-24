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

    function post_titles(){
      $all_post_titles = array();
      $post_titles_query = new WP_Query(array('post_type' => 'post', 'posts_per_page' => -1, 'fields' => 'ids'));
      foreach($post_titles_query->posts as $id){
        array_push($all_post_titles, get_the_title($id));
      }
      return json_encode($all_post_titles);
    }
  }
}
