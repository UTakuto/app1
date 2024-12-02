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
    0, 0, 
    0, 0, 
    720, 720, 
    getimagesize($imageSrc)[0], getimagesize($imageSrc)[1]
);

printf("<img src='%s'>", $imageSrc);