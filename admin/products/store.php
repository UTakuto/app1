<?php
// admin\products\store.php

require "../config.php";

var_dump($_POST);
print "<hr>";
var_dump($_FILES);

// Request Method が Post かのチェック
if( $_SERVER[ "REQUEST_METHOD" ] !== "POST" ){
    header( "Location: create.php" );
    exit;
}

try{

    $db = new PDO( DB_DSN, DB_USER, DB_PASS );

    //トランザクションの有効化
    $db -> beginTransaction();

    

}
catch( PDOException $error ){
    print $error -> getMessage();
}
catch( Exception $error ){
    print $error -> getMessage();
}
