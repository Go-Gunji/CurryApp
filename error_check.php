<?php
    header('Content-type: text/plain; charset= UTF-8');
    if(!empty($_POST['store_name'])
    && !empty($_POST['curry_name'])
    && !empty($_POST['hot_level'])
    && !empty($_POST['impression'])
    && !empty($_POST['address'])
    ){
        $imginfo = getimagesize($_FILES['file']['tmp_name']);
        if($imginfo['mime'] == 'image/jpeg'){ $extension = ".jpg"; }
        if($imginfo['mime'] == 'image/png'){ $extension = ".png"; }
        if($imginfo['mime'] == 'image/gif'){ $extension = ".gif"; }

        if(!empty($extension)){
			
            /* 画像登録処理 */
            $file_tmp = $_FILES['file']['tmp_name'];
            $file_name = $_POST['curry_name']. $extension; // アップロード時のファイル名を設定
            $file_save = "./img/" . $file_name; // アップロード対象のディレクトリを指定
            move_uploaded_file($file_tmp, $file_save); // アップロード処理
        
            echo "success"; // jquery側にレスポンス
            
          } else {
            
            echo "fail"; // jquery側にレスポンス
            
          }
    }
    // $store_name = $_POST['store_name'];
        // $curry_name = $_POST['curry_name'];
        // $hot_level=$_POST['hot_level'];
        // $impression = $_POST['impression'];
        // $address = $_POST['address'];


        // $str = '店名:'.$store_name.'カレーの名前:'.$curry_name.'辛さ:'.$hot_level.'感想:'.$impression.'住所:'.$address;
        // $result = nl2br($str);
        // echo $result;
    // }else{
    //     echo 'FAIL TO AJAX REQUEST';
?>