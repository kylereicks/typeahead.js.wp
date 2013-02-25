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

    private function tags(){
      $tag_names = array();
      $tags = get_tags();
      foreach($tags as $tag){
        array_push($tag_names, $tag->name);
      }
      return json_encode($tag_names);
    }

    private function categories(){
      $category_names = array();
      $categories = get_categories();
      foreach($categories as $category){
        array_push($category_names, $category->name);
      }
      return json_encode($category_names);
    }

    private function post_titles(){
      $all_post_titles = array();
      $post_id_query = new WP_Query(array('post_type' => 'any', 'posts_per_page' => -1, 'fields' => 'ids'));
      foreach($post_id_query->posts as $id){
        array_push($all_post_titles, get_the_title($id));
      }
      return json_encode($all_post_titles);
    }

    private function users($role){
      $user_names = array();
      $user_query = new WP_User_Query(array('role' => $role));
      foreach($user_query->results as $user){
        array_push($user_names, $user->data->display_name);
      }
      return json_encode($user_names);
    }

     private function authors(){
      return $this->users('Author');
    }

    private function contributors(){
      return $this->users('Contributor');
    }

    private function editors(){
      return $this->users('Editor');
    }
  }
}
