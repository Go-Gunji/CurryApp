$('.custom-file-input').on('change',function(){
    $(this).next('.custom-file-label').html($(this)[0].files[0].name);
  })


  var $ = Y.useJQuery();
  var map = new Y.Map("map");
  map.drawMap(new Y.LatLng(33.590184,130.401689), 15);
  map.addControl(new Y.LayerSetControl());
  map.addControl(new Y.SliderZoomControlVertical());
  map.addControl(new Y.SearchControl());
  map.SearchControl

  //クリックイベントを設定
map.bind("click", function(latlng){onClicked(latlng);});