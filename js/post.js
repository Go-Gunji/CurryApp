var $ = Y.useJQuery();
var map = new Y.Map("map");
map.drawMap(new Y.LatLng(33.590184, 130.401689), 15);
map.addControl(new Y.LayerSetControl());
map.addControl(new Y.SliderZoomControlVertical());
map.addControl(new Y.SearchControl());
map.SearchControl

//クリックイベントを設定
map.bind("click", function (latlng) { onClicked(latlng); });

//クリックイベントを定義
function onClicked(latlng) {
  //クリック位置の緯度経度を指定して、リバースジオコーディングを実行
  var geocoder = new Y.GeoCoder();

  geocoder.execute({ latlng: latlng }, function (result) {
    map.clearFeatures();
    console.log(result.features[0].property.Address);
    if (result.features.length > 0) {
      //リバースジオコーディング結果を表示
      document.getElementById("address").value = result.features[0].property.Address;
      var label = new Y.Label(latlng, "ここ！");
      map.addFeature(label);
    }
  });
}

$(function () {

  $('.custom-file-input').on('change',function(){
    $(this).next('.custom-file-label').html($(this)[0].files[0].name);
  })
  //投稿ボタン押下
  $('#postdata').on('click', function () {

    // 入力値の取得
    var store_name = $('#store_name').val(); //店名
    var curry_name = $('#curry_name').val(); //カレーの名前
    var hot_level = $('input[name="hot_level"]:checked').val(); //辛さ
    var impression = $('#impression').val(); //感想
    var address = $('#address').val(); //住所

    // 必須チェック
    if (store_name != "" && curry_name != "" && hot_level != "" && impression != "" && address != "") {
      // イメージファイルセット
      var fd = new FormData();
      // var fd = new FormData($('.form-group').get(0));
      fd.append("file",$("#customFile").prop("files")[0]);
      for (value of fd.entries()) { 
        console.log(value); 
    }

      // その他入力データのセット
      fd.append('store_name', store_name);
      fd.append('curry_name', curry_name);
      fd.append('hot_level', hot_level);
      fd.append('impression', impression);
      fd.append('address', address);

      
    }

    $.ajax({
      url: '../error_check.php',
      type: 'POST',
      data: fd,
      cache: false,
      contentType: false,
      processData: false,
      dataType: 'html'
    })
      // Ajaxリクエストが成功した時発動
      .done((data) => {
        $('.result').html(data);
        console.log(data);
      })
      // Ajaxリクエストが失敗した時発動
      .fail((data) => {
        $('.result').html(data);
        console.log(data);
      })
      // Ajaxリクエストが成功・失敗どちらでも発動
      .always((data) => {

      });

  });
});
