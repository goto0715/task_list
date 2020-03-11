<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>TASK LIST|業務をスマートに管理するWebアプリ</title>
        <link rel="stylesheet" href="css/todolist.css">
        <link rel="stylesheet" href="css/sp.css" media="screen and (max-width:600px)">
        <meta name="description" content="HTML/CSS、JavaScript、PHPを使用して実装されたWebアプリです。">
        <!--TwitterなどのSNSでシェアされた時のタグ-->
        <meta property="og:site_name" content="TASK LIST-業務をスマートに管理するWebアプリ-" />
        <meta property="og:type" content="website" />
        <meta property="og:title" content="TASK LIST-業務をスマートに管理するWebアプリ-">
        <meta property="og:description" content="HTML/CSS、JavaScript、PHPを使用して実装されたWebアプリです。">
        <meta property="og:url" content="http://yosuke-goto.com/search.php">
        <meta property="og:image" content="http://yosuke-goto.com/image/tasklist.jpg">
        <meta name="twitter:card" content="summary_large_image" />
        <meta name="twitter:site" content="@gotoh_pg" />
        <meta property="og:url" content="http://yosuke-goto.com/search.php" />
        <meta property="og:title" content="TASK LIST-業務をスマートに管理するWebアプリ-" />
        <meta property="og:description" content="HTML/CSS、JavaScript、PHPを使用して実装されたWebアプリです。" />
        <meta property="og:image" content="http://yosuke-goto.com/image/tasklist.jpg" />
        <script type="text/javascript" src="js/todolist.js"></script>
        <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
        <link href="https://fonts.googleapis.com/css?family=Noto+Sans+JP:300&display=swap" rel="stylesheet">
    </head>
    <body>
<!--ヘッダーここから-->
        <header class="search-header">
            <h1 class="title"><a href="search.php">TASK LIST</a></h1>
            <nav class="global-nav search-nav">
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
<!--業務内容を入力-->
                <section class="in">
                    <h2 class="icon">業務内容を入力</h2>
                    <form method="post" action="tasklist.php">
                        <div class="form-title">
                            <p>New Task</p>
                        </div>
                        <div class="form-box">
                            <input type="text" name="work_name" onkeyup="ShowLength1(value);" class="task-name"required>
                            <p id="inputlength1">0/<?php print WORK_NAME_LENGTH; ?></p>
                        </div>
                        <div class="form-title">
                            <p>Description</p>
                        </div>
                        <div class="form-box">
                            <textarea name="work_detail"rows="4" cols="40" onkeyup="ShowLength2(value);" placeholder="例:仕事内容や担当者など"required></textarea>
                            <p id="inputlength2">0/<?php print WORK_DESCRIPTION_LENGTH; ?></p>
                        </div>
                        <button type="submit" class="btn" name="">ADD TASK</button>
                        <input type="hidden" name="sql_kind" value="add_task">
                    </form>
                </section>
<!--検索フォーム-->
                <section class="search">
                    <h2 class="icon">業務内容を検索</h2>
                    <div class="search-area form-box">
                        <form method="post" action="tasklist.php">
                            <div class="form-title">
                                <p>Search keyword</p>
                            </div>
                            <div class="form-box">
                                <input type="text" id="search-text" name="search_keyword" placeholder="検索ワードを入力"required>
                            </div>
                            <button type="submit" class="btn search-btn" name="">SEARCH</button>
                            <input type="hidden" name="sql_kind" value="search_task">
                        </form>
                        <div class="search-result">
                            <div class="search-result__hit-num"></div>
                            <div id="search-result__list"></div>
                        </div>
                    </div>
                </section>
<!--検索フォームここまで-->
<!--メッセージBOX-->
                <section class="msg">
<?php if (count($err_msg) > 0) { ?> 
                    <ul class="err-box">
    <?php foreach ($err_msg as $value) { ?>
                        <li><?php print $value; ?></li>
    <?php } ?>
                    </ul>
<?php } ?>

<?php if (count($msg) > 0) { ?> 
                    <ul class="msg-box">
    <?php foreach ($msg as $value) { ?>
                        <li><?php print $value; ?></li>
    <?php } ?>
                    </ul>
<?php } ?>
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