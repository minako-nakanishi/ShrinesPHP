<!DOCTYPE html>
<html>
    <head>
        <title>新規登録画面</title>
        <meta charset="UTF-8">
    </head>
    <body>
        <div style="font-size: 22px;">新規登録画面</div>
        <hr>
        <form name="insert" method="post" action="list.php">
            <div>
                <label>　神社名　：<input type="text" name="name" maxlength="50"></label>
            </div>
            <div>
                <label>　ふりがな：<input type="text" name="kana" maxlength="100"></label>
            </div>
            <div>
                <label>　都道府県：<input type="text" name="prefecture" maxlength="20"></label>
            </div>
            <div>
                <label>　最寄駅　：<input type="text" name="station" maxlength="50"></label>
            </div>
            <div>
                <input type="submit" value="更新" style="margin-left: 200px;">
            </div>
        </form>
    </body>
</html>
