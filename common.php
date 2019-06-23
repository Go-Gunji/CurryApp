<?php
// ========================================================
// 共通クラス
// ========================================================
class common {
    function __construct() {

    }

    // セッション破壊
    function kill_session() {
        // セッション変数を空にする
        $_SESSION = [];
        // セッションクッキーを破壊
        if (isset($_COOKIE[session_name()])) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time()-3600, $params['path']);
        }
        session_destroy();
    }

    // セッション空チェック
    function check_session() {
        
    }
}