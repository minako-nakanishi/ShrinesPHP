<?php
session_start(); //セッション開始
?>
<!DOCTYPE html>
<html>
    <head>
        <title>更新画面</title>
        <meta charset="utf8"/>
    </head>
    <body>
        <?php
        require_once("PDO.php"); //DB接続用ファイルの読み込み
        $pdoUP = db_connect(); //DB接続を行う.
        
        // セッション変数から、idを受け取る.
        $id = $_SESSION['id'];
        
        try {
            $pdoUP->beginTransaction(); //トランザクションの開始
            $sql = "UPDATE shrines SET name = :name, kana = :kana, prefecture = :prefecture, station = :station WHERE id = :id";
            $stmh = $pdoUP->prepare($sql); //sqlの解析
            /* POSTで送られてきた更新する値をsqlにセットする */
            $stmh->bindValue(':name',$_POST['name'],PDO::PARAM_STR);
            $stmh->bindValue(':kana', $_POST['kana'],PDO::PARAM_STR);
            $stmh->bindValue(':prefecture', $_POST['prefecture'],PDO::PARAM_STR);
            $stmh->bindValue(':station', $_POST['station'],PDO::PARAM_STR);
            $stmh->bindValue(':id', $id,PDO::PARAM_INT);
            $stmh->execute(); //sqlの実行
            $pdoUP->commit();
            print $stmh->rowCount()."件、更新しました。<br>";
            
        } catch (PDOException $Exception) {
            $pdoUP->rollBack(); //エラー発生時に元に戻す
            print "エラー：".$Exception->getMessage();
        }
        ?>
        <a href="index.php">検索・一覧画面へ戻る</a>
    </body>
</html>