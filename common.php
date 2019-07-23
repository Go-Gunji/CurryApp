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

    // コンボボックスチェック関数
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

    // 引数に対してhtmlspecialchars()
    function es ($data, $encode="UTF-8") {
        // $dataが配列のとき
        if (is_array($data)) {
            // 再帰呼び出し
            return array_map(__METHOD__, $data);
        } else {
            // HTMLエスケープを行う
            return htmlspecialchars($data, ENT_QUOTES, $encode);
        }
    }
