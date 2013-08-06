<?php
/*
Plugin Name: Typeahead.WP
Plugin URI: http://github.com/kylereicks/typeahead.js.wp
Description: A wordpress plugin to add Typeahead.js autocomplete to the wordpress search form.
Author: Kyle Reicks
Version: 0.1
Author URI: http://kylereicks.me
*/

if(!class_exists('Typeahead_WP')){
  class Typeahead_WP{

    function __construct(){
      require('php/class-typeahead-admin-settings.php');
      $typeahead_settings = new Typeahead_Admin_Settings();
      add_action('wp_enqueue_scripts', array($this, 'typeahead_scripts'), 99);
    }

    function typeahead_scripts(){
      // register scripts
      wp_register_script('typeahead_script', plugins_url('typeahead.js/js/typeahead.js', __FILE__), array('jquery'), '0.9.3', true);
      wp_register_script('typeahead_activation', plugins_url('js/typeahead-activation.js', __FILE__), array('typeahead_script'), 1.0, true);

      $this->check_min_jquery_version('1.9.0');

      // enqueue scripts
      wp_enqueue_script('typeahead_activation');

      // localize variables
      $datasets = $this->get_dataset_array();
      $data = array('dataUrl' => plugins_url('data/json.php', __FILE__), 'datasets' => $datasets);
      wp_localize_script('typeahead_activation', 'typeahead', $data);
    }

    private function check_min_jquery_version($version_number){
      global $wp_scripts;

      if($wp_scripts->registered['jquery']->ver < $version_number){

        wp_deregister_script('jquery');

        // jquery use cdn if available
        $url = 'http://ajax.googleapis.com/ajax/libs/jquery/' . $version_number . '/jquery.min.js';
        $test_url = @fopen($url,'r');
        if($test_url !== false){
          wp_register_script('jquery', $url, false, $version_number, true);
        }else{
          wp_register_script('jquery', plugins_url('js/libs/jquery.min.js', __FILE__), $version_number, true);
        }
      }
    }

    private function get_dataset_array(){
      $datasets = array();
      $dataset_settings = get_option('_typeahead_datasets');
      foreach($dataset_settings as $dataset => $include){
        if($include == 1){
          array_push($datasets, $dataset);
        }
      }
      return $datasets;
    }
  }

  $typehead_wp = new Typeahead_WP();
}
