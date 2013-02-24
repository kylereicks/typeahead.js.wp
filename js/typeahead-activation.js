typeahead.dataSrc = typeaheadPlugin.dataUrl;
typeahead.data = [];
for(var i = 0; i < typeahead.datasets.length; i++){
  typeahead.data[i] = {
    name: typeahead.datasets[i],
    prefetch: typeahead.dataSrc + '?data=' + typeahead.datasets[i]
  };
}
jQuery(document).ready(function($){
  $('#searchform input[type=text], #searchform input[type=search]').typeahead(typeahead.data);
});
