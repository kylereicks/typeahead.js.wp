if(typeahead.datasets.length){
  typeahead.data = [];
  for(i = 0, arrayLength = typeahead.datasets.length; i < arrayLength; i++){
    typeahead.data[i] = {
      name: typeahead.datasets[i],
      prefetch: typeahead.dataUrl + '?data=' + typeahead.datasets[i]
    };
  }
  jQuery(document).ready(function($){
    $('#searchform input[type=text], #searchform input[type=search]').typeahead(typeahead.data);
  });
}
