<?php
//セッションスタート
session_start();
//////////////////////////////////////////////////
// データ取得
//////////////////////////////////////////////////
// 接続用ファイルの読み込み
require_once('./db_connect.php');

// idがセットされていない時は、TOPページの表示
if (!isset($_POST["id"])||($_POST["id"]==="")){
    try {
    $pdo = new db();
    $pdo = $pdo->connect();
    
    // SQL文作成
    $sql = "SELECT id, store_name, curry_name, impression FROM CurryInfo ORDER BY rand() LIMIT 9";
    // プリペアドステートメントを作る
    $stm = $pdo->prepare($sql);
    // SQL文実行
    $stm->execute();
    // 連想配列で結果を取得
    $result = $stm->fetchAll(PDO::FETCH_ASSOC);
    //   echo json_encode("データ取得できました。");
    echo json_encode($result);
    // return $link;

    } catch (Exception $e) {
    echo json_encode("データベース接続に失敗しました。".$e->getMessage()); 
    }
} else {
    // idがセットされている時は詳細画面遷移の時
    $id = $_POST["id"];
    $mode = $_POST["mode"];
    try {
        $pdo = new db();
        $pdo = $pdo->connect();
        
      // SQL文作成
      $sql = "SELECT store_name, curry_name, hot_level, impression, address, lat, lng
              FROM  CurryInfo
              WHERE id = :id";
      // プリペアドステートメントを作る
      $stm = $pdo->prepare($sql);
      // プレースホルダに値をバインドする
      $stm->bindValue(':id', $id, PDO::PARAM_INT);
        // SQL文実行
        $stm->execute();
        
        // 連想配列で結果を取得
        $result = $stm->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $row) {
        $_SESSION["store_name"]=$row["store_name"];
        $_SESSION["curry_name"]=$row["curry_name"];
        $_SESSION["hot_level"]=$row["hot_level"];
        $_SESSION["impression"]=$row["impression"];
        $_SESSION["address"]=$row["address"];
        $_SESSION["lat"]=$row["lat"];
        $_SESSION["lng"]=$row["lng"];
        $_SESSION["mode"]=$mode;
        }

        // // 確認ページにリダイレクト
        // $url = "http://". $_SERVER['HTTP_HOST']. dirname($_SERVER['PHP_SELF']);
        // header("Location:". $url. "/confirm.php");
        // exit();

        // $_SESSION["store_name"]=$result["store_name"];
        // $_SESSION["curry_name"]=$result["curry_name"];
        // $_SESSION["hot_level"]=$result["hot_level"];
        // $_SESSION["impression"]=$result["impression"];
        // $_SESSION["address"]=$result["address"];
        // $_SESSION["lat"]=$result["lat"];
        // $_SESSION["lng"]=$result["lng"];
          echo json_encode("成功");

        // echo json_encode($result);

        // return $link;
    
        } catch (Exception $e) {
        echo json_encode("データベース接続に失敗しました。".$e->getMessage()); 
        }
}
?>