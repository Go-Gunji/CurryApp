<?php
//セッションスタート
session_start();
// 共通クラスの読み込み
require_once('./common.php');
$killer = new common();
$killer->kill_session();
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
  <link rel="stylesheet" href="css/top.css">
  <meta name="viewport" content="initial-scale=1.0,user-scalable=no">
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
        <a href="index.php" class="navbar-brand d-flex align-items-center">
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
        <p class="lead">
          福岡のカレーをただひたすら紹介し合う場所です。<br>
          みんなのおすすめカレーがランダムで表示されます。
        </p>
        <a href="post.php" class="btn btn-danger my-2">教えてあげたい</a>
      </div>
    </section>
    <div class="result"></div>
    <div class="album py-5 bg-light">
      <div class="container">
        <div class="row" id="curry_info">
      <!-- ここにapp.jsで生成したHTMLが入る -->
      </div>
    </div>
  </main>
  <footer class="footer">
    <div class="container">
    <p class="text-muted">© 2019　go.gunji</p>
    </div>
  </footer>

  <script src="https://code.jquery.com/jquery-3.4.1.min.js"
    integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
    crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
    integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
    integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
    crossorigin="anonymous"></script>
  <script src="js/app.js"></script>
</body>
</html>