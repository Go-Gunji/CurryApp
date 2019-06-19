<?php
//セッションスタート
session_start();

//投稿内容の入力チェック
// エラーチェック用配列用意
$errors = [];

//エラーチェック
if (empty($_SESSION["store_name"])){
  $errors[] = "お店の名前を入れてください。";
}
if (empty($_SESSION["curry_name"])){
  $errors[] = "カレーの名前を入れてください。";
}
if (empty($_SESSION["hot_level"])){
  $errors[] = "辛さを選択してください。";
}
if (empty($_SESSION["impression"])){
  $errors[] = "一言でもいいので感想を教えてください。";
}
if (empty($_SESSION["address"])){
  $errors[] = "お店の場所をセットしてください。";
}

// エラーがあった時処理抜ける
if (count($errors)>0){
    $json1 = json_encode($errors);
    echo $json1;
  exit();
}

// セッションから値取り出す
$store_name = $_SESSION["store_name"];
$curry_name = $_SESSION["curry_name"];
$hot_level = $_SESSION["hot_level"];
$impression = $_SESSION["impression"];
$address = $_SESSION["address"];
$lat = $_SESSION["lat"];
$lng = $_SESSION["lng"];

// 画像ファイルを確定ディレクトリに移動する
rename("./img/tmp_img/". $curry_name. ".jpg", "./img/". $curry_name. ".jpg");

//////////////////////////////////////////////////
// 投稿データ登録
//////////////////////////////////////////////////
// 接続用ファイルの読み込み
require_once('./db_connect.php');
  try {
      $pdo = new db();
      $pdo = $pdo->connect();
      
      // SQL文作成
      $sql = "INSERT INTO CurryInfo (store_name, curry_name, hot_level, impression, address, lat, lng) 
              VALUES (:store_name, :curry_name, :hot_level, :impression, :address, :lat, :lng)";
      // プリペアドステートメントを作る
      $stm = $pdo->prepare($sql);
      // プレースホルダに値をバインドする
      $stm->bindValue(':store_name', $store_name, PDO::PARAM_STR);
      $stm->bindValue(':curry_name', $curry_name, PDO::PARAM_STR);
      $stm->bindValue(':hot_level', $hot_level, PDO::PARAM_INT);
      $stm->bindValue(':impression', $impression, PDO::PARAM_STR);
      $stm->bindValue(':address', $address, PDO::PARAM_STR);
      $stm->bindValue(':lat', $lat, PDO::PARAM_STR);
      $stm->bindValue(':lng', $lng, PDO::PARAM_STR);
      // SQL文実行
      $stm->execute();
      echo json_encode("データベースに接続しました。");
      // return $link;
    
  } catch (Exception $e) {
      echo json_encode("データベース接続に失敗しました。".$e->getMessage()); 
  }
?>
