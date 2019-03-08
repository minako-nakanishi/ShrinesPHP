<!DOCTYPE html>
<html>
    <head>
        <title>検索・一覧画面</title>
        <meta charset="UTF-8">
    </head>
    <body>
        <span style="font-size: 22px;">検索・一覧画面</span>&nbsp;
        <span><a href="insert.html">新規登録画面</a></span>
        <hr>
        <!--検索機能-->
        <form name="main" method="post" action="index.php">
            <label>名前：<input type="text" name="search"></label>
            <input type="submit" value="検索">
        </form>
        <?php
        require_once('PDO.php'); //DB接続用phpの読み込み
        $pdoM = db_connect();
        try {
           $pdoM->beginTransaction();//トランザクション開始
           if(isset($_POST['search']) && $_POST['search'] != ""){
               $search_key = '%'.$_POST['search'].'%';
               $sql = "SELECT * FROM shrines WHERE name like :name OR prefecture like :prefecture OR station like :station";
               $stml = $pdoM->prepare($sql); //sqlの解析
               $stml->bindValue(':name', $search_key,PDO::PARAM_STR);
               $stml->bindValue(':prefecture', $search_key,PDO::PARAM_STR);
               $stml->bindValue(':station', $search_key,PDO::PARAM_STR);
               
           }else{
               $sql = "SELECT * FROM shrines";
               $stml = $pdoM->prepare($sql); //sqlの解析
           }
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
        
        <!-- 初期表示の一覧画面(全件検索) -->
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