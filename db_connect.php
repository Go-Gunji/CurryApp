<?php
// ========================================================
// DB接続
// ========================================================
class db {
    function __construct() {
        require_once('target/db_config.php');
        // ユーザー
        $this->user = $user;
        $this->password = $password;
        // データベース
        $this->dbName = $dbName;
        // MySQLサーバ
        $this->host = $host;
        // MySQLのDSN文字列
        $this->dsn = $dsn;
    }

    function connect() {
        $pdo = new PDO($this->dsn, $this->user, $this->password);
        // プリペアドステートメントのエミュレーションを無効にする
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        // 例外がスローされる設定にする
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $pdo;
    }
}

// // Close
// function close($link) {
//     mysql_close($link);
// }

// // Prepare
// function prepare ($value) {

//     return mysql_real_escape_string($value);
// }