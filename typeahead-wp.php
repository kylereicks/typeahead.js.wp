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

      wp_register_style('typeahead_style', plugins_url('typeahead.js/css/typeahead.css', __FILE__));
      wp_register_script('typeahead_script', plugins_url('typeahead.js/js/typeahead.js', __FILE__), array('jquery'), 0.8, true);
      wp_register_script('typeahead_activation', plugins_url('js/typeahead-activation.js', __FILE__), array('typeahead_script'), 1.0, true);

      wp_enqueue_style('typeahead_style');
      wp_enqueue_script('typeahead_activation');

    }
  }

  $typehead_wp = new Typeahead_WP();
}
