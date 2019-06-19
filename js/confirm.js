var lat;
var lng;

$(function () {
//////////////////////////////////////////////////
// YOLP用意
//////////////////////////////////////////////////
var $ = Y.useJQuery();
var map = new Y.Map('map');

// セットされた緯度経度取得
lat = $('#lat').val();
lng = $('#lng').val();

// console.log(coordinates);
map.drawMap(new Y.LatLng(lat,lng), 15);
map.addControl(new Y.LayerSetControl());
map.addControl(new Y.SliderZoomControlVertical());
// map.addControl(new Y.SearchControl());
lating = map.getCenter();
var label = new Y.Label(lating, 'ここ！');
map.addFeature(label);
map.SearchControl


  //////////////////////////////////////////////////
  // 投稿ボタン押下
  //////////////////////////////////////////////////
  $('#new_post').on('click', function () {
    // 既存エラーメッセージの削除
    $('.result').empty();
    // 入力値の取得
    var store_name = $('#store_name').val(); //店名
    var curry_name = $('#curry_name').val(); //カレーの名前
    var hot_level = $('input[name="hot_level"]:checked').val(); //辛さ
    var impression = $('#impression').val(); //感想
    var address = $('#address').val(); //場所
    var mode = 'check'; // 確認 or 登録判断用変数
    console.log(store_name);
    // // イメージファイルセット
    var fd = new FormData();
    // // var fd = new FormData($('.form-group').get(0));
    // fd.append('file', $('#customFile').prop('files')[0]);

    // その他入力データのセット
    fd.append('store_name', store_name);
    fd.append('curry_name', curry_name);
    fd.append('hot_level', hot_level);
    fd.append('impression', impression);
    fd.append('address', address);
    fd.append('lat', lat);
    fd.append('lng', lng);

    $.ajax({
      url: '../register.php',
      type: 'POST',
      data: fd,
      cache: false,
      contentType: false,
      processData: false,
      dataType: 'json'
    })
      // Ajax成功
      .done((data) => {
        if (data === '成功') {
          // window.location.href = '../register.php';
          // $('.result').append('<li>' + data + '</li>');
          $('.result').append('<li>投稿が完了しました。</li>');
        } else {
          $('.result').append(data);
        }
        console.log(data);
      })
      // Ajax失敗
      .fail((data) => {
        $('.result').append('<li>通信に失敗しました。</li>');
        console.log(data);
      })
      // Ajax成功・失敗どちらでも
      .always((data) => {
      });
  });
});
