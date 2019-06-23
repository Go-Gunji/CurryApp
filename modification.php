<?php
//セッションスタート
session_start();

//投稿内容の入力チェック
// エラーチェック用配列用意
$errors = [];

//エラーチェック
if (empty($_POST["store_name"])){
  $errors[] = "お店の名前を入れてください。";
}
if (empty($_POST["curry_name"])){
  $errors[] = "カレーの名前を入れてください。";
}
if (empty($_POST["hot_level"])){
  $errors[] = "辛さを選択してください。";
}
if (empty($_POST["impression"])){
  $errors[] = "一言でもいいので感想を教えてください。";
}
if (empty($_POST["address"])){
  $errors[] = "お店の場所をセットしてください。";
}

// エラーがあった時処理抜ける
if (count($errors)>0){
    $json1 = json_encode($errors);
    echo $json1;
  exit();
}

// セッションから値取り出す
$id = $_POST["id"];
$store_name = $_POST["store_name"];
$curry_name = $_POST["curry_name"];
$hot_level = $_POST["hot_level"];
$impression = $_POST["impression"];
$address = $_POST["address"];
$lat = $_POST["lat"];
$lng = $_POST["lng"];

//////////////////////////////////////////////////
// 投稿データ登録
//////////////////////////////////////////////////
// 接続用ファイルの読み込み
require_once('./db_connect.php');
  try {
      $pdo = new db();
      $pdo = $pdo->connect();
      
      // SQL文作成
      $sql = "UPDATE CurryInfo SET store_name = :store_name, curry_name = :curry_name, hot_level = :hot_level, impression = :impression, address = :address, lat = :lat, lng = :lng) 
              WHERE (id = :id)";
      // プリペアドステートメントを作る
      $stm = $pdo->prepare($sql);
      // プレースホルダに値をバインドする
      $stm->bindValue(':id', $id, PDO::PARAM_INT);
      $stm->bindValue(':store_name', $store_name, PDO::PARAM_STR);
      $stm->bindValue(':curry_name', $curry_name, PDO::PARAM_STR);
      $stm->bindValue(':hot_level', $hot_level, PDO::PARAM_INT);
      $stm->bindValue(':impression', $impression, PDO::PARAM_STR);
      $stm->bindValue(':address', $address, PDO::PARAM_STR);
      $stm->bindValue(':lat', $lat, PDO::PARAM_STR);
      $stm->bindValue(':lng', $lng, PDO::PARAM_STR);
      // SQL文実行
      $stm->execute();

      // 画像ファイルを確定ディレクトリに移動する
      rename("./img/tmp_img/". $curry_name. ".jpg", "./img/". $curry_name. ".jpg");
      
      echo json_encode("データベースに接続しました。");
      // return $link;
    
  } catch (Exception $e) {
      echo json_encode("データベース接続に失敗しました。".$e->getMessage()); 
  }
?>
