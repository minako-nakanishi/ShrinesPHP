<!DOCTYPE html>
<html>
    <head>
        <title>削除処理</title>
        <meta charset="utf8"/>
    </head>
    <body>
        <?php
        require_once("PDO.php"); //DB接続用ファイルを読み込む.
        $pdoD = db_connect(); //DB接続
        
        $id = $_GET['id']; //削除したい神社のid
        
        try {
            $pdoD->beginTransaction(); //トランザクションの開始
            $sql = "DELETE FROM shrines WHERE id = :id";
            $stml = $pdoD->prepare($sql);
            $stml->bindValue(':id', $id,PDO::PARAM_INT);
            $stml->execute(); //sqlの解析
            $pdoD->commit();
            print "削除処理が完了しました。<br>";
        } catch (PDOException $Exception) {
            $pdoD->rollBack(); //エラーが発生した際に元に戻す.
            print "エラー：".$Exception->getMessage();
        }
        ?>
        <a href="index.php">検索・一覧画面へ戻る</a>
    </body>
</html>