<?php
//セッションスタート
session_start();
// ========================================================
// データ取得
// ========================================================
// 接続用ファイルの読み込み
require_once('./db_connect.php');

// idがセットされていない時は、TOPページの表示
if (!isset($_POST["id"])||($_POST["id"]==="")){
    try {
    $pdo = new db();
    $pdo = $pdo->connect();
    
    // SQL文作成
    $sql = "SELECT id, store_name, curry_name, impression FROM curry_app.CurryInfo ORDER BY rand() LIMIT 9";
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
      $sql = "SELECT id, store_name, curry_name, hot_level, impression, address, lat, lng
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
        $_SESSION["id"]=$row["id"];
        $_SESSION["store_name"]=$row["store_name"];
        $_SESSION["curry_name"]=$row["curry_name"];
        $_SESSION["hot_level"]=$row["hot_level"];
        $_SESSION["impression"]=$row["impression"];
        $_SESSION["address"]=$row["address"];
        $_SESSION["lat"]=$row["lat"];
        $_SESSION["lng"]=$row["lng"];
        $_SESSION["old_photo"]=$row["curry_name"];
        $_SESSION["mode"]=$mode;
        }

          echo json_encode("成功");
    
        } catch (Exception $e) {
        echo json_encode("データベース接続に失敗しました。".$e->getMessage()); 
        }
}
?>