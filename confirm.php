<?php
session_start();
// 共通クラスの読み込み
require_once('./common.php');
// セッションに保持した値取り出し
if (empty($_SESSION['id'])) {
  $id = "";
} else {
  $id = $_SESSION['id']; 
}
$store_name = $_SESSION['store_name'];  //店名
$curry_name = $_SESSION["curry_name"];  //カレーの名前
$hot_level = $_SESSION["hot_level"];  //辛さ
$impression = $_SESSION['impression'];  //感想
$address = $_SESSION['address'];  //場所
$lat = $_SESSION['lat'];  //緯度
$lng = $_SESSION['lng'];  //経度
if (isset($_SESSION['old_photo'])) {
$old_photo = $_SESSION['old_photo'];  //古いほうの写真
}
else {
  $old_photo = "";
}
$mode = $_SESSION['mode'];  //新規 or 詳細　確認用変数
// $killer = new common();
// $killer->kill_session();
?>

<!doctype html>
<html lang="ja">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <!-- CSS -->
    <link rel="stylesheet" href="css/common.css">
    <link rel="stylesheet" href="css/location.css">
    <script src="https://map.yahooapis.jp/js/V1/jsapi?appid=OY1oDxsr" type="text/javascript"  charset="UTF-8" ></script>
    <title>Hello, world!</title>
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
            <strong>カレー部</strong>
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
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
            <a href="post.php" class="btn btn-danger my-2">教えてあげたい</a>
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
            <input class="form-control" type="text" id="store_name" value="<?php echo $store_name; ?>" readonly>
          </div>
          <div class="form-group">
            <label class="control-label">カレーの名前</label>
            <input class="form-control" type="text" id="curry_name" value="<?php echo $curry_name; ?>" readonly>
          </div>
          <div class="form-group">
            <label class="control-label">辛さレベル</label>
              <input class="form-control" type="text" id="hot_level" value="<?php echo $hot_level; ?>" readonly>
          </div>
          <div class="form-group">
            <label class="control-label">感想</label>
            <textarea class="form-control" rows="3" maxlength="80" id="impression" readonly><?php echo $impression; ?></textarea>
          </div>
 
          <div class="form-group">
            <label class="control-label">場所</label>
            <div id="map" class="col-12 col-sm-12" style="width:600px; height:380px; position: relative;"></div>
            <input class="form-control" type="text" id="address" value= "<?php echo $address; ?>" readonly>
          </div>

          <label class="control-label">写真</label>
          <div>
          <?php 
          if ($mode === "new") {
            echo '<img src="./img/tmp_img/', $curry_name, '.jpg" class="img-responsive" width="300" height="300">';
          }
          else if ($mode === "detail") {
            echo '<img src="./img/', $curry_name, '.jpg" class="img-thumbnail" width="300" height="300">';
          }
          ?>
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
              <input class="form-control" type="text" id="old_photo" value="<?php echo $old_photo; ?>" readonly>
          </div>

          <?php
          // 新規データ作成の時は、投稿ボタンと戻るボタンのみ
          if ($mode === "new") {
            echo '<button type="button" id="return" class="btn btn-outline-info">戻る</button>';
            echo '<button type="button" id="new_post" class="btn btn-outline-info">投稿</button>';
          }
          // 詳細画面の時は、修正ボタンと削除ボタンのみ
          else if ($mode === "detail") {
            echo '<button type="button" id="detail_post" class="btn btn-outline-info">修正</button>';
            echo '<button type="button" id="delete" class="btn btn-outline-info">削除</button>';
          }
          ?>

          <!-- <button type="button" id="postdata" class="btn btn-outline-info">投稿</button> -->
          <!-- </form> -->
        </div>
      </div>
    </div>

    </main>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="js/confirm.js"></script>
  </body>
</html>
