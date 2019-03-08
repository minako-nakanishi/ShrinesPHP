<!DOCTYPE html>
<html>
    <head>
        <title>メイン画面</title>
        <meta charset="UTF-8">
    </head>
    <body>
        <span style="font-size: 22px;">検索・一覧画面</span>&nbsp;
        <span><a href="insert.html">新規登録画面</a></span>
        <hr>
        <form name="main" method="post" action="index.php">
            <label>名前：<input type="text" name="search" required></label>
            <input type="submit" value="検索">
        </form>
        <?php
        require_once('PDO.php'); //DB接続用phpの読み込み
        $pdoM = db_connect();
        try {
           $pdoM->beginTransaction();//トランザクション
           $sql = "SELECT * FROM shrines";
           $stml = $pdoM->prepare($sql); //sqlの解析
           $stml->execute();//sqlの実行
        } catch (PDOException $Exception) {
            $pdoM->rollBack();
            die('エラー：'.$Exception->getMessage());
        }
        $count = $stml->rowCount(); //件数のカウント
        if($count<1){
          print "登録されているデータはありません";  
        }else{
        ?>
        <br><br>
        <table border="1">
            <tbody>
                <tr><th>神社名</th><th>都道府県</th><th>最寄駅</th></tr>
                <?php
                while($row=$stml->fetch(PDO::FETCH_ASSOC)){
                ?>
                <tr>
                    <td><?= htmlspecialchars($row['name'],ENT_QUOTES)?></td>
                    <td><?= htmlspecialchars($row['prefecture'],ENT_QUOTES)?></td>
                    <td><?= htmlspecialchars($row['station'],ENT_QUOTES)?></td>
                </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
        <?php
        }
        ?>
    </body>
</html>