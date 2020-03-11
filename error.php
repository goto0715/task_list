<?php
// 設定ファイル読み込み
require_once 'const.php';

$err_msg = array();
$msg = array();

?>
<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>業務管理リスト</title>
        <link rel="stylesheet" href="css/todolist.css">
        <link rel="stylesheet" href="css/sp.css" media="screen and (max-width:600px)">
        <script type="text/javascript" src="js/todolist.js"></script>
        <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
        <link href="https://fonts.googleapis.com/css?family=Noto+Sans+JP:300&display=swap" rel="stylesheet">
    </head>
    <body>
<!--ヘッダーここから-->
        <header class="search-header">
            <h1 class="title">TASK LIST</h1>
        </header>
<!--ヘッダーここまで-->
        <div id="wrap">
            <div class="contents">
                <section class="msg">
                    <ul class="err-box">
                        <li>【エラー発生】</li>
                        <li>New Taskは<?php print WORK_NAME_LENGTH; ?>以内、Descriptionは<?php print WORK_DESCRIPTION_LENGTH ?>以内で入力してください</li>
                    </ul>
                    <a href="search.php">登録画面に戻る</a>
<!--メッセージBOXここまで-->
                </section>
            </div>
        </div>
<!--フッター-->
        <footer class="search-footer">
            <small>(C)2020 Yosuke Goto</small>
        </footer>
<!--フッターここまで-->
    </body>
</html>