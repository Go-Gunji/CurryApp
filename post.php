<?php
session_start();
//////////////////////////////////////////////////
// 確認画面から戻ってきた時
//////////////////////////////////////////////////
//セッション変数から値を取り出す
if (empty($_SESSION['id'])) {
  $id = "";
} else {
  $id = $_SESSION['id']; 
}
if (empty($_SESSION['store_name'])) {
  $store_name = "";
} else {
  $store_name = $_SESSION['store_name']; 
}
if (empty($_SESSION['curry_name'])) {
  $curry_name = "";
} else {
  $curry_name = $_SESSION['curry_name'];
  // img用tmpフォルダから写真削除
  if (file_exists("./img/tmp_img/". $curry_name. ".jpg")) {
  unlink("./img/tmp_img/". $curry_name. ".jpg");
  }
}
if (empty($_SESSION['hot_level'])) {
  $hot_level = "";
} else {
  $hot_level = $_SESSION['hot_level']; 
}
if (empty($_SESSION['impression'])) {
  $impression = "";
} else {
  $impression = $_SESSION['impression']; 
}
if (empty($_SESSION['address'])) {
  $address = "";
} else {
  $address = $_SESSION['address']; 
}
if (empty($_SESSION['lat'])) {
  $lat = "";
} else {
  $lat = $_SESSION['lat']; 
}
if (empty($_SESSION['lng'])) {
  $lng = "";
} else {
  $lng = $_SESSION['lng']; 
}

// コンボボックスチェック
function checked($value, $question) {
  if (is_array($question)) {
    $isChecked = in_array($value, $question);
  } else {
    $isChecked = ($value===$question);
  }
  if ($isChecked) {
    echo "checked";
  } else {
    echo "";
  }
}
?>

<!doctype html>
<html lang="ja">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
    integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <!-- CSS -->
  <link rel="stylesheet" href="css/common.css">
  <link rel="stylesheet" href="css/post.css">
  <script src="https://map.yahooapis.jp/js/V1/jsapi?appid=dj00aiZpPVNYc1JXcXBvb2NMMCZzPWNvbnN1bWVyc2VjcmV0Jng9MDQ-"
    type="text/javascript" charset="UTF-8"></script>
  <title>カレー部</title>
</head>

<body>
  <header>
    <div class="collapse bg-dark" id="navbarHeader">
      <div class="container">
        <div class="row">
          <div class="col-sm-8 col-md-7 py-4">
            <h4 class="text-white">About</h4>
            <p class="text-muted">福岡のカレー屋さんを、もっと知りたい、知ってもらいたい。そんな人のための場所です。気軽に投稿してみてください。</p>
          </div>
        </div>
      </div>
    </div>
    <div class="navbar navbar-dark bg-dark box-shadow">
      <div class="container d-flex justify-content-between">
        <a href="index.html" class="navbar-brand d-flex align-items-center">
          <!-- <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path><circle cx="12" cy="13" r="4"></circle></svg> -->
          <strong>カレー部</strong>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarHeader"
          aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      </div>
    </div>
  </header>

  <main role="main">

    <section class="jumbotron">
      <div class="container">
        <h1 class="jumbotron-heading">福岡カレー巡り</h1>
        <p class="lead">福岡のカレーをただひたすら紹介し合う場所です。</p>
        <p>
          <!-- <a href="location.html" class="btn btn-info my-2">場所を知りたい</a> -->
        </p>
      </div>
    </section>

    <div class="container">
      <div class="panel panel-default">
        <div class="result"></div>
        <div class="panel-heading">あなたのオススメのカレーは？</div>
        <div class="panel-body">
          <!-- <form> -->
          <div class="form-group">
            <label class="control-label">店名</label>
            <input class="form-control" type="text" maxlength="15" id="store_name" value="<?php echo $store_name; ?>">
          </div>
          <div class="form-group">
            <label class="control-label">カレーの名前</label>
            <input class="form-control" type="text" maxlength="15" id="curry_name" value="<?php echo $curry_name; ?>">
          </div>
          <div class="form-group">
            <label class="control-label">辛さレベル</label>
            <div class="radio">
              <label><input type="radio" name="hot_level" value="1" <?php checked(1, $hot_level);?>>1</label>
              <label><input type="radio" name="hot_level" value="2" <?php checked(2, $hot_level);?>>2</label>
              <label><input type="radio" name="hot_level" value="3" <?php checked(3, $hot_level);?>>3</label>
              <label><input type="radio" name="hot_level" value="4" <?php checked(4, $hot_level);?>>4</label>
              <label><input type="radio" name="hot_level" value="5" <?php checked(5, $hot_level);?>>5</label>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label">感想</label>
            <textarea class="form-control" rows="3" maxlength="55" id="impression"><?php echo $impression; ?></textarea>
          </div>
          <div class="form-group">
            <label class="control-label">場所</label>
            <div id="map" class="col-12 col-sm-12" style="width:600px; height:380px; position: relative;"></div>
            <input class="form-control" type="text" id="address" value= "<?php echo $address; ?>" readonly>
          </div>
          <div class="form-group">
            <label class="control-label">写真</label>
            <div class="custom-file">
              <input type="file" name="file1" class="custom-file-input" id="customFile" lang="ja">
              <label class="custom-file-label" for="customFile">ファイル選択...</label>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label">テスト用緯度</label>
              <input class="form-control" type="text" id="lat" value="<?php echo $lat; ?>" readonly>
          </div>
          <div class="form-group">
            <label class="control-label">テスト用経度</label>
              <input class="form-control" type="text" id="lng" value="<?php echo $lng; ?>" readonly>
          </div>
          <div class="form-group">
            <label class="control-label">テストID</label>
              <input class="form-control" type="text" id="id" value="<?php echo $id; ?>" readonly>
          </div>
          <div class="form-group">
            <label class="control-label">現写真名</label>
              <input class="form-control" type="text" id="old_photo" value="<?php echo $curry_name; ?>" readonly>
          </div>

          <button type="button" id="postdata" class="btn btn-outline-info">確認</button>
          <!-- </form> -->
        </div>
      </div>
    </div>

    <!-- Begin Yahoo! JAPAN Web Services Attribution Snippet -->
    <!-- <a href="https://developer.yahoo.co.jp/about">
    <img src="https://s.yimg.jp/images/yjdn/yjdn_attbtn2_105_17.gif" width="105" height="17" title="Webサービス by Yahoo! JAPAN" alt="Webサービス by Yahoo! JAPAN" border="0" style="margin:15px 15px 15px 15px"></a> -->
    <!-- End Yahoo! JAPAN Web Services Attribution Snippet -->

  </main>


  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"crossorigin="anonymous"></script>
  <script src="js/post.js"></script>
</body>
</html>