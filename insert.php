<?php

require_once("PDO.php"); //DB接続処理ファイルを読み込む.

$pdos= db_connect(); //DBへ接続

// インサート処理
try {
    $pdos->beginTransaction();//トランザクションの開始
    $sql = "INSERT INTO shrines(name,kana,prefecture,station)VALUE(:name,:kana,:prefecture,:station)"; //sql文の生成
    $stmh = $pdos->prepare($sql); //sqlの解析
    /* 入力値をsqlにセットする */
    $stmh->bindValue(':name', $_POST['name'],PDO::PARAM_STR);
    $stmh->bindValue(':kana', $_POST['kana'],PDO::PARAM_STR);
    $stmh->bindValue(':prefecture', $_POST['prefecture'],PDO::PARAM_STR);
    $stmh->bindValue(':station', $_POST['station'],PDO::PARAM_STR);
    $stmh->execute();//sql確定
    $pdos->commit();
    // 登録したらポップアップ画面を表示する.
    $test_alert = "<script type='text/javascript'>alert('神社を登録しました。');</script>";
    print $test_alert;
    
    
} catch (PDOException $Exception) {
    $pdos->rollBack(); //エラーになったら元の状態に戻す.
    print "エラー：".$Exception->getMessage();
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf8"/>
    </head>
    <body>
        <a href="index.php">検索・一覧画面へ戻る</a>
    </body>
</html>



