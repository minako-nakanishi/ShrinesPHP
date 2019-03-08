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
        $dsns = "$db_type:host=$db_host;dbname=$db_name;charset=utf8";
        $pdos = new PDO($dsns,$db_user,$db_pass); //DBへ接続
        $pdos->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //エラー発生時は例外処理を実施
        $pdos->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        //print "接続に成功しました";
    
    } catch (PDOException $Exception){
        die("エラー：".$Exception->getMessage());
    }
    return $pdos;
}

?>