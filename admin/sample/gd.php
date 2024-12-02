<?php 
//GDを使った画像処理

$imageSrc = "../../storage/aaa.png";

// 　牙城キャンバスの作成
//imagecreatetruecolor(width , height)
$canvas = imagecreatetruecolor( 720 , 720 );

//スクリーン画像を生成
$screen = imagecreatefrompng($imageSrc);

//キャンバスにスクリーンを貼り付ける
imagecopyresampled(
    $canvas, 
    $screen, 
    0, 0, //キャンバスのx , y座標
    0, 0, //スクリーンのx , y座標
    720, 720, //キャンバスのwidth,height
    getimagesize($imageSrc)[0], getimagesize($imageSrc)[1]
);

//キャンバスの画像を名前をつけて保存
//pngの透過を有効にする
imagesavealpha($canvas ,  true);
//image***(キャンバス , 出力先のパス , 圧縮率)
imagepng($canvas, "../../storage/thumb.png");

//メモリ内のキャンバスを解放
imagedestroy($canvas);

//出力したサムネイル画像の読み込み
$image = file_get_contents("../../storage/thumb.png");

// printf("<img src='%s'>", "data:image/png;base64," . base64_encode($image));

//仮に出力したサムネイルファイルを削除
unlink("../../storage/thumb.png");