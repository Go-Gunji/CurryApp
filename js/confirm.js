var lat;
var lng;

$(function () {
  // ========================================================
  // YOLP用意
  // ========================================================
  // var $ = Y.useJQuery();
  var map = new Y.Map('map');
  console.log($('#lat').val());
  // セットされた緯度経度取得
  lat = $('#lat').val();
  lng = $('#lng').val();

  // console.log(coordinates);
  map.drawMap(new Y.LatLng(lat, lng), 15);
  map.addControl(new Y.LayerSetControl());
  map.addControl(new Y.SliderZoomControlVertical());
  // map.addControl(new Y.SearchControl());
  lating = map.getCenter();
  var label = new Y.Label(lating, 'ここ！');
  map.addFeature(label);
  map.SearchControl


  // ========================================================
  // 投稿ボタン押下
  // ========================================================
  $(document).on('click', '#new_post', function () {
    // 既存エラーメッセージの削除
    $('.result').empty();
    // 入力値の取得
    var id = $('#id').val(); //ID
    var store_name = $('#store_name').val(); //店名
    var curry_name = $('#curry_name').val(); //カレーの名前
    var hot_level = $('#hot_level').val(); //辛さ
    var impression = $('#impression').val(); //感想
    var address = $('#address').val(); //場所
    var old_photo = $('#old_photo').val(); //古いほうの写真
    var mode = 'check'; // 確認 or 登録判断用変数
    console.log(store_name);
    // // イメージファイルセット
    var fd = new FormData();
    // // var fd = new FormData($('.form-group').get(0));
    // fd.append('file', $('#customFile').prop('files')[0]);

    // その他入力データのセット
    fd.append('id', id);
    fd.append('store_name', store_name);
    fd.append('curry_name', curry_name);
    fd.append('hot_level', hot_level);
    fd.append('impression', impression);
    fd.append('address', address);
    fd.append('lat', lat);
    fd.append('lng', lng);

    // 新規作成か修正か判断
    if (old_photo === "") {
      var url = '../register.php';
    } else {
      var url = '../modification.php';
      fd.append('id', id);

    }

    $.ajax({
      url: url,
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

  // ========================================================
  // 戻るボタン押下
  // ========================================================
  $(document).on('click', '#return', function () {
    window.location.href = '/post.php';
  });
  // ========================================================
  // 削除ボタン押下
  // ========================================================
  $(document).on('click', '#delete', function () {
    // 既存エラーメッセージの削除
    $('.result').empty();
    // 入力値の取得
    var id = $('#id').val(); //ID
    $.ajax({
      url: '../delete.php',
      type: 'POST',
      dataType: 'json',
      data: { id: id }
    })
      // Ajax成功
      .done((data) => {
        if (data === '削除完了') {
          window.location.href = '../index.html';
        }
        console.log(data);
      })
      // Ajax失敗
      .fail((data) => {
        $('.result').append('<li>通信に失敗したぞ。</li>');
        console.log(data);
      })
      // Ajax成功・失敗どちらでも
      .always((data) => {
      });

  });
  // ========================================================
  // 修正ボタン押下
  // ========================================================
  $(document).on('click', '#detail_post', function () {
    window.location.href = '/post.php';
  });
});
