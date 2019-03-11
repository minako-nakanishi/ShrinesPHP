<?php
session_start(); //セッションの開始.
?>

<!DOCTYPE html>
<html>
    <head>
        <title>更新画面</title>
        <meta charset="UTF-8">
    </head>
    <body>
      <?php
      require_once("PDO.php"); //DB接続用PHPを読み込む.
      $pdoU = db_connect(); //DB接続用関数の呼び出し.
      
      if(isset($_GET['id'])&& $_GET['id']>0){
          $_SESSION['id'] = $_GET['id']; //セッション変数にidmを格納.
          $id = $_SESSION['id'];
          
      }else{
          print "パラメーターが不正です.";
      }
          /* 指定したidを元に全件検索を実施 */
          try {
              $pdoU->beginTransaction(); //トランザクションの開始
              $sql = "SELECT * FROM shrines WHERE id = :id"; //idを元に全件検索
              $stml = $pdoU->prepare($sql);//sqlの解析
              $stml->bindValue(':id', $id,PDO::PARAM_INT);
              $stml->execute();
              $pdoU->commit();
              $count = $stml->rowCount(); //検索結果数をカウントする.
          } catch (PDOException $Exception) {
              $pdoU->rollBack(); //エラー発生時は元に戻す.
              print "エラー：".$Exception->getMessage();
          }
          
          if($count<1){
              print "更新データがありません";
          }else{
              $row = $stml->fetch(PDO::FETCH_ASSOC); //検索した結果を一行ずつ取り出す.
          }
      ?>
        
        <div style="font-size: 22px;">新規登録画面</div>
        <hr>
        <form name="update" method="post" action="update.php">
            <div>
                <label>　神社名　：<input type="text" name="name" value="<?= htmlspecialchars($row['name'],ENT_QUOTES)?>" maxlength="50"></label>
            </div>
            <div>
                <label>　ふりがな：<input type="text" name="kana" value="<?= htmlspecialchars($row['kana'],ENT_QUOTES)?>" maxlength="100"></label>
            </div>
            <div>
                <label>　都道府県：<input type="text" name="prefecture" value="<?= htmlspecialchars($row['prefecture'],ENT_QUOTES)?>" maxlength="20"></label>
            </div>
            <div>
                <label>　最寄駅　：<input type="text" name="station" value="<?= htmlspecialchars($row['station'],ENT_QUOTES)?>" maxlength="50"></label>
            </div>
            <div>
                <a href="index.php">検索一覧画面へ戻る</a>
                <input type="submit" value="更新" style="margin-left: 150px;;">
            </div>
        </form>
    </body>
</html>
