<?php
/*
Plugin Name: Typeahead.WP
Plugin URI: http://github.com/kylereicks/typeahead.wp
Description: A wordpress plugin to add Typeahead.js autocomplete to the wordpress search form.
Author: Kyle Reicks
Version: 0.1
Author URI: http://kylereicks.me
*/

if(!class_exists('Typeahead_WP')){
  class Typeahead_WP{

    function __construct(){
      
      add_action('wp_enqueue_scripts', array($this, 'typeahead_scripts'));

    }

    function typeahead_scripts(){

      // register styles
      wp_register_style('typeahead_style', plugins_url('typeahead.js/css/typeahead.css', __FILE__));

      // register scripts
      wp_register_script('typeahead_script', plugins_url('typeahead.js/js/typeahead.js', __FILE__), array('jquery'), 0.8, true);
      wp_register_script('typeahead_activation', plugins_url('js/typeahead-activation.js', __FILE__), array('typeahead_script'), 1.0, true);

      // enqueue styles
      wp_enqueue_style('typeahead_style');

      // enqueue scripts
      wp_enqueue_script('typeahead_activation');

      // localize variables
      $data_url = array('dataUrl' => plugins_url('data/json.php', __FILE__));
      wp_localize_script('typeahead_activation', 'typeaheadPlugin', $data_url);

      $datasets = array('datasets' => array('tags', 'categories', 'post_titles', 'authors', 'contributors', 'editors'));
      wp_localize_script('typeahead_activation', 'typeahead', $datasets);

    }
  }

  $typehead_wp = new Typeahead_WP();
}
