<?php

/* DB接続用 */
function db_connect(){
    $db_type = "mysql"; //DBの種類
    $db_name = "shrinedb"; //DB名
    $db_host = "localhost"; //ホスト名
    $db_user = "sample"; //ユーザ名
    $db_pass = "password"; //パスワード
    
    try{
        //PDOの引数に渡す情報を変数へ格納
        $dsn = "$db_type:host=$db_host;dbname=$db_name;charset=utf8";
        $pdo = new PDO($dsn,$db_user,$db_pass); //DBへ接続
        print "接続に成功しました";
    
    } catch (PDOException $Exception){
        print "エラー：".$Exception->getMessage();
    }
}

?>