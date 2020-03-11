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
        <header>
            <h1 class="title"><a href="search.php">TASK LIST</a></h1>
            <nav class="global-nav">
                <ul>
                    <li><a href="search.php">タスクの登録・検索</a></li>
                    <li><a href="tasklist.php">未完了のタスク一覧</a></li>
                    <li><a href="comptask.php">完了済みのタスク一覧</a></li>
                </ul>
            </nav>
        </header>
        
<!--ヘッダーここまで-->
        <div id="wrap">
            <div class="contents">
<?php if (count($err_msg) > 0) { 
    header('Location: http://' . $_SERVER['HTTP_HOST'] . ERROR);
} ?>

<!--メッセージBOXここまで-->
                </section>
<!--業務内容を入力ここまで-->
<!--現在のタスク一覧-->
                <section class="tasklist">
                    <h2 class="icon">完了済みのタスク一覧</h2>
                    <table>
                        <thead>
                            <tr>
                                <th><strong>ID</strong></th>
                                <th><strong>Task</strong></th>
                                <th><strong>Description</strong></th>
                                <th><strong>Completed Time</strong></th>
                                <th><strong>Update</strong></th>
                            </tr>
                        </thead>
<?php foreach($work as $value){ ?>
                        <tr class="target-area">
                            <td><?php print $value['work_id']; ?></td>
                            <td><?php print $value['work_name']; ?></td>
                            <td class="detail"><?php print $value['work_detail']; ?></td>
                            <td><?php print $value['date']; ?></td>
                            <td>
                                <form method="post">
                                    <button type="submit" class="btn list-btn" name="">Delete</button>
                                    <input type="hidden" name="work_id" value="<?php print $value['work_id']; ?>">
                                    <input type="hidden" name="work_name" value="<?php print $value['work_name']; ?>">
                                    <input type="hidden" name="work_detail" value="<?php print $value['work_detail']; ?>">
                                </form>
                            </td>
                        </tr>
<?php } ?>
                    </table>
                </section>
<!--現在のタスク一覧ここまで-->
            </div>
        </div>
        
        <footer>
            <small>(C)2020 Yosuke Goto</small>
        </footer>
    </body>
</html>