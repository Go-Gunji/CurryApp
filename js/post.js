//マップAPI
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

//クリックイベントを定義
function onClicked(latlng){
  //クリック位置の緯度経度を指定して、リバースジオコーディングを実行
  var geocoder = new Y.GeoCoder();
  geocoder.execute( { latlng :latlng} , function( result ) {
      if ( result.features.length > 0 ) {
          //リバースジオコーディング結果を表示
          document.getElementById('address').innerHTML = result.features[0].property.Address;
      }
  });
}

$(function () {
  //投稿ボタン押下
  $('#postdata').on('click',function(){
    console.log($('input[name="hot_level"]:checked').val());
    $.ajax({
      url:'../error_check.php',
      type:'POST',
      data:{
          'store_name':$('#store_name').val(),
          'curry_name':$('#curry_name').val(),
          'hot_level':$('input[name="hot_level"]:checked').val()
      }
  })
  // Ajaxリクエストが成功した時発動
  .done( (data) => {
      $('.result').html(data);
      console.log(data);
  })
  // Ajaxリクエストが失敗した時発動
  .fail( (data) => {
      $('.result').html(data);
      console.log(data);
  })
  // Ajaxリクエストが成功・失敗どちらでも発動
  .always( (data) => {

  });

  });
});
