<?php
require('../../../../wp-load.php');
header('Content-Type: application/json');
if($_GET['data'] == 'tags'){
  $tag_names = array();
  $tags = get_tags();
  foreach($tags as $tag){
    array_push($tag_names, $tag->name);
  }
  echo json_encode($tag_names);
}
