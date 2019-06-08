<?php
//セッションスタート
session_start();

//投稿内容の入力チェック
// エラーチェック用配列用意
$errors = [];

//エラーチェック
if (!isset($_POST["store_name"])||($_POST["store_name"]==="")){
  $errors[] = "お店の名前を入れてください。";
}
if (!isset($_POST["curry_name"])||($_POST["curry_name"]==="")){
  $errors[] = "カレーの名前を入れてください。";
}
if (!isset($_POST["hot_level"])||($_POST["hot_level"]==="")){
  $errors[] = "辛さを選択してください。";
}
if (!isset($_POST["impression"])||($_POST["impression"]==="")){
  $errors[] = "一言でもいいので感想を教えてください。";
}
if (!isset($_POST["address"])||($_POST["address"]==="")){
  $errors[] = "お店の場所をセットしてください。";
}
// if (empty($_FILES["file"]["tmp_name"])){
//   $errors[] = "写真を選択してください。";
// }
// else{
//   $imginfo = getimagesize($_FILES["file"]["tmp_name"]); // 写真
//   // 拡張子チェック
// if($imginfo["mime"] == "image/jpeg"){ $extension = ".jpg"; }
// if($imginfo["mime"] == "image/png"){ $extension = ".png"; }
// if($imginfo["mime"] == "image/gif"){ $extension = ".gif"; }
// if(empty($extension)){
//   $errors[] = "写真の拡張子はjpegか、pngか、gifでお願いします。";
// }
// }

// エラーがあった時
if (count($errors)>0){
    $json1 = json_encode($errors);
    echo $json1;
  exit();
}
// // 画像登録処理
// $file_tmp = "./img/tmp_img/" . $_POST["curry_name"];
// // $file_name = $_POST["curry_name"]. $extension; // アップロード時のファイル名を設定
// $file_save = "./img/" . $_POST["curry_name"]; // アップロード対象のディレクトリを指定
// move_uploaded_file($file_tmp, $file_save); // アップロード処理

// ファイルをvarディレクトリに移動する
rename("./img/tmp_img/". $_POST["curry_name"].".jpg", "./img/" . $_POST["curry_name"].".jpg");
// // 配列を用意
// $ary = array('store_name'=>$_POST['store_name'],
// 'curry_name'=>$_POST['curry_name'],
// 'hot_level'=>$_POST['hot_level'],
// 'impression'=>$_POST['impression'],
// 'address'=>$_POST['address'] );
// 配列をjson_encode関数でJSON形式に変換
// $json = json_encode($ary);
// // $str = '店名:'.$store_name.'カレーの名前:'.$curry_name.'辛さ:'.$hot_level.'感想:'.$impression.'場所:'.$address;
// // $result = nl2br($str);

// // echo $result;
// echo $json;
$json2 = json_encode("成功");
echo $json2;

$_SESSION["store_name"] = $_POST["store_name"];
$_SESSION["curry_name"] = $_POST["curry_name"];
$_SESSION["hot_level"] = $_POST["hot_level"];
$_SESSION["impression"] = $_POST["impression"];
$_SESSION["address"] = $_POST["address"];
$_SESSION["lat"] = $_POST["lat"];
$_SESSION["lng"] = $_POST["lng"];
?>
