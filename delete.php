<?php
//セッションスタート
session_start();
// ========================================================
// データ取得
// ========================================================
// 接続用ファイルの読み込み
require_once('./db_connect.php');
// 共通クラスの読み込み
require_once('./common.php');
$id = $_POST["id"];
$killer = new common();
$killer->kill_session();

try {
    $pdo = new db();
    $pdo = $pdo->connect();

    // SQL文作成
    $sql = "DELETE FROM CurryInfo WHERE id = :id";

    // プリペアドステートメントを作る
    $stm = $pdo->prepare($sql);
    // プレースホルダに値をバインドする
    $stm->bindValue(':id', $id, PDO::PARAM_INT);
    // SQL文実行
    $stm->execute();
    echo json_encode("削除完了");
    // return $link;

    } catch (Exception $e) {
    echo json_encode("データベース接続に失敗しました。".$e->getMessage()); 
    }
?>