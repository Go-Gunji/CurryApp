<?php
    header('Content-type: text/plain; charset= UTF-8');
    if(isset($_POST['store_name'])){
        $store_name = $_POST['store_name'];
        $curry_name = $_POST['curry_name'];
        $hot_level=$_POST['hot_level'];

        $str = '店名:'.$store_name.'カレーの名前:'.$curry_name.'辛さ:'.$hot_level;
        $result = nl2br($str);
        echo $result;
    }else{
        echo 'FAIL TO AJAX REQUEST';
    }
?>