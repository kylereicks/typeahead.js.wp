jQuery(document).ready(function($){
  $('#searchform input[type=text], #searchform input[type=search]').typeahead({
    name: 'trends',
    local: ['something', 'something else', 'autofill']
  });
});
