// 緯度経度グローバル変数用意
var lat;  //緯度
var lng;  //経度

$(function () {
  // ========================================================
  // YOLP用意
  // ========================================================
  // var $ = Y.useJQuery();
  var map = new Y.Map('map');

  // セットされた緯度経度取得
  lat = $('#lat').val();
  lng = $('#lng').val();
  if (lat == "") {
    lat = 33.590184;
  }
  if (lng == "") {
    lng = 130.401689;
  }

  map.drawMap(new Y.LatLng(lat, lng), 15);
  map.addControl(new Y.LayerSetControl());
  map.addControl(new Y.SliderZoomControlVertical());
  map.addControl(new Y.SearchControl());
  map.SearchControl

  // クリックイベントを設定
  map.bind('click', function (latlng) { onClicked(latlng); });

  //クリックイベントを定義
  function onClicked(latlng) {
    //クリック位置の緯度経度を指定して、リバースジオコーディングを実行
    var geocoder = new Y.GeoCoder();

    geocoder.execute({ latlng: latlng }, function (result) {
      map.clearFeatures();
      console.log(result.features[0].property.Address);
      if (result.features.length > 0) {
        //リバースジオコーディング結果を表示
        document.getElementById('address').value = result.features[0].property.Address;
        var label = new Y.Label(latlng, 'ここ！');
        map.addFeature(label);
        lat = latlng.lat();
        lng = latlng.lng();
        console.log(lat);
        console.log(lng);
      }
    });
  }


  // ========================================================
  // 場所表示
  // ========================================================
  $('.custom-file-input').on('change', function () {
    $(this).next('.custom-file-label').html($(this)[0].files[0].name);
  })

  // ========================================================
  // 投稿ボタン押下
  // ========================================================
  $('#postdata').on('click', function () {
    // ========================================================
    // 新規作成の時
    // ========================================================
    if ($('#id').val() === "") {
      // 既存エラーメッセージの削除
      $('.result').empty();

      // 入力値の取得
      var store_name = $('#store_name').val(); //店名
      var curry_name = $('#curry_name').val(); //カレーの名前
      var hot_level = $('input[name="hot_level"]:checked').val(); //辛さ
      var impression = $('#impression').val(); //感想
      var address = $('#address').val(); //場所
      var mode = 'new'; // 新規 or 詳細　判断用変数
      console.log(store_name);
      // イメージファイルセット
      var fd = new FormData();
      // var fd = new FormData($('.form-group').get(0));
      fd.append('file', $('#customFile').prop('files')[0]);

      // その他入力データのセット
      fd.append('store_name', store_name);
      fd.append('curry_name', curry_name);
      fd.append('hot_level', hot_level);
      fd.append('impression', impression);
      fd.append('address', address);
      fd.append('lat', lat);
      fd.append('lng', lng);
      fd.append('mode', mode);

      $.ajax({
        url: '../error_check.php',
        type: 'POST',
        data: fd,
        cache: false,
        contentType: false,
        processData: false,
        dataType: 'json'
      })
        // Ajax成功
        .done((data) => {
          console.log(data);
          if (data === '成功') {
            window.location.href = '../confirm.php';
            $('.result').append('<li>' + data + '</li>');
          } else {
            for (let i = 0; i < data.length; i++) {
              console.log(data[i]);
              $('.result').append('<li>' + data[i] + '</li>');
            }
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
    } else {
      // ========================================================
      // 修正の時
      // ========================================================
      // 既存エラーメッセージの削除
      $('.result').empty();

      // 入力値の取得
      var store_name = $('#store_name').val(); //店名
      var curry_name = $('#curry_name').val(); //カレーの名前
      var hot_level = $('input[name="hot_level"]:checked').val(); //辛さ
      var impression = $('#impression').val(); //感想
      var address = $('#address').val(); //場所
      var id = $('#id').val(); //ID
      var old_photo = $('#old_photo').val(); //古いほうの写真
      var mode = 'new'; // 新規 or 詳細　判断用変数
      console.log(store_name);


      // イメージファイルセット
      var fd = new FormData();
      // var fd = new FormData($('.form-group').get(0));
      fd.append('file', $('#customFile').prop('files')[0]);

      // その他入力データのセット
      fd.append('store_name', store_name);
      fd.append('curry_name', curry_name);
      fd.append('hot_level', hot_level);
      fd.append('impression', impression);
      fd.append('address', address);
      fd.append('lat', lat);
      fd.append('lng', lng);
      fd.append('id', id);
      fd.append('old_photo', old_photo);
      fd.append('mode', mode);

      $.ajax({
        url: '../error_check.php',
        type: 'POST',
        data: fd,
        cache: false,
        contentType: false,
        processData: false,
        dataType: 'json'
      })
        // Ajax成功
        .done((data) => {
          console.log(data);
          if (data === '成功') {
            window.location.href = '../confirm.php';
            
          } else {
            for (let i = 0; i < data.length; i++) {
              console.log(data[i]);
              $('.result').append('<li>' + data[i] + '</li>');
            }
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
    }
  });
});
