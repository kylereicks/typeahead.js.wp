<?php
if(!class_exists('Typeahead_Admin_Settings')){
  class Typeahead_Admin_Settings{

    function __construct(){
      if(is_admin()){
        add_action('admin_menu', array($this, 'add_typeahead_settings_page'));
        add_action('admin_init', array($this, 'init_typeahead_settings'));
      }
    }

    function add_typeahead_settings_page(){
      add_plugins_page(
        'Typeahead Settings',
        'Typeahead Settings',
        'manage_options',
        'typeahead_autocomplete_settings_page',
        array($this, 'typeahead_autocomplete_settings_page_view')
      );
    }

    function typeahead_autocomplete_settings_page_view(){
      ?>
      <div class="wrap">
        <?php screen_icon(); ?>
        <h2>Typeahead Settings</h2>
        <form method="post" action="options.php">
        <?php
          settings_fields('typeahead_autocomplete_settings_group');
          do_settings_sections('typeahead_autocomplete_settings_page');
        ?>
        <?php submit_button(); ?>
        </form>
      </div>
      <?php
    }

    function init_typeahead_settings(){
      // dataset settings
      register_setting(
        'typeahead_autocomplete_settings_group',
        '_typeahead_datasets'
      );

      add_settings_section(
        'dataset_settings_section',
        'Datasets',
        array($this, 'dataset_settings_section_info'),
        'typeahead_autocomplete_settings_page'
      );

      add_settings_field(
        'datasets',
        'Datasets',
        array($this, 'datasets_field_view'),
        'typeahead_autocomplete_settings_page',
        'dataset_settings_section',
        array(
          'Tags' => 'tags',
          'Categories' => 'categories',
          'Post Titles' => 'post_titles',
          'Page Titles' => 'page_titles',
          'Authors' => 'authors',
          'Contributors' => 'contributors',
          'Editors' => 'editors'
        )
      );
    }

    // section info
    function dataset_settings_section_info(){
      echo 'Choose the datasets to be included in the autocomplete search.';
    }

    // fields
    function datasets_field_view($datasets){
      $settings = (array) get_option('_typeahead_datasets');
      foreach($datasets as $datasetName => $dataset){
        $selected = isset($settings[$dataset]) && $settings[$dataset] == 1 ? true : false;
        ?>
          <input type="checkbox" name="_typeahead_datasets[<?php echo $dataset; ?>]" id="checkbox_<?php echo $dataset; ?>" value="1"<?php echo $selected ? ' checked' : ''; ?> /> <label for="checkbox_<?php echo $dataset; ?>"><?php echo $datasetName; ?></label><br />
        <?php
      }
    }
  }
}
