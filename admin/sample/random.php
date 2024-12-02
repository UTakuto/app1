<?php

//ランダムな文字列を1文字ずつ設定して生成する
$token = "";
for($i = 0; $i < 12 ; $i++){
    //文字列を並べ替える
    $randStr = str_shuffle('1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ');
    //文字列の先頭だけ残して取得
    $token .= substr($randStr, 0,1);
}
print $token;

print "<hr>";

//ランダムな文字列を生成する
$randStr = random_bytes(32);
//ランダムな文字列をbase64に変換する
$base64RandStr = base64_encode($randStr);
//不要な記号を削除する
$base64RandStr = str_replace(["+" , "/" , "="], "" , $base64RandStr);
//先頭から n 文字以下を削除
$base64RandStr = substr($base64RandStr, 0, 4);
print $randStr;
print "<hr>";
print $base64RandStr;