<?php 
//GDを使ったサムネイル画像の生成
//画像ファイルとして返却

// 生成したいサムネイルのファイル名
$fileName = filter_input( INPUT_GET , "image_name" );
$resize = filter_input( INPUT_GET , "size" , FILTER_VALIDATE_INT );

if( !$fileName ){
    print "サムネイルのファイル名がありません";
}


$imageSrc = "../../storage/{$fileName}";
$imageSize = getimagesize($imageSrc);

//サムネイル画像のサイズを設定
if(  $imageSize[0] > $imageSize[1] ){
    //横向き
    $scale               = 720 / $imageSize[0];
    $thumbSize["width"]  = 720;
    $thumbSize["height"] = (int)($imageSize[1] * $scale);
}else{
    //縦向き
    $scale               = 720 / $imageSize[1];
    $thumbSize["width"]  = (int)($imageSize[0] * $scale);
    $thumbSize["height"] = 720;
}

// 　画像キャンバスの作成
//imagecreatetruecolor(width , height)
$canvas = imagecreatetruecolor( $thumbSize["width"], $thumbSize["height"] );


//スクリーン画像を生成
switch( $imageSize["mime"] ){
    case "image/jpeg":
        $exe = "jpeg";
        $screen = imagecreatefromjpeg($imageSrc);
        break;
    case "image/png" :
        $exe = "png";
        $screen = imagecreatefrompng($imageSrc);
        break;
    case "image/gif" :
        $exe = "gif";
        $screen = imagecreatefromgif($imageSrc);
        break;
    case "image/webp":
        $exe = "webp";
        $screen = imagecreatefromwebp($imageSrc);
        break;
}
// $screen = imagecreatefrompng($imageSrc);

//キャンバスにスクリーンを貼り付ける
imagecopyresampled(
    $canvas, 
    $screen, 
    0, 0, //キャンバスのx , y座標
    0, 0, //スクリーンのx , y座標
    $thumbSize["width"], $thumbSize["height"], //キャンバスのwidth,height
    $imageSize[0], $imageSize[1]
);

if( $imageSize["mime"] === "image/png" ){
    //透過を有効にする
    imagesavealpha($canvas , true);
}

//キャンバスの画像を名前をつけて保存
switch( $imageSize["mime"] ){
    case "image/jpeg" : imagejpeg( $canvas , "../../storage/thumb.jpeg" ) ; break;
    case "image/png"  : imagepng(  $canvas , "../../storage/thumb.png" ) ; break;
    case "image/gif"  : imagegif(  $canvas , "../../storage/thumb.gif" ) ; break;
    case "image/webp" : imagewebp( $canvas , "../../storage/thumb.webp") ; break;
}
//pngの透過を有効にする
// imagesavealpha($canvas ,  true);
//image***(キャンバス , 出力先のパス , 圧縮率)
// imagepng($canvas, "../../storage/thumb.{$exe}");

//メモリ内のキャンバスを解放
imagedestroy($canvas);

//出力したサムネイル画像の読み込み
$image = file_get_contents("../../storage/thumb.{$exe}");

// printf("<img src='%s'>", "data:image/png;base64," . base64_encode($image));

//仮に出力したサムネイルファイルを削除
unlink("../../storage/thumb.{$exe}");

//画像のヘッダー情報を設定
header("Content-Type: image/{$exe}");
print $image;