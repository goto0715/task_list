<?php

// 設定ファイル読み込み
require_once 'const.php';
// 関数ファイル読み込み

// 初期化する変数
$err_msg = array();
$msg = array();
$work = array();
$search_keyword = '';
$sql_kind = '';
$work_name = '';
$work_detail = '';
$work_id = '';
$work_name = '';
$work_detail = '';

if(count($err_msg) > 0) {
    header('Location: http://' . $_SERVER['HTTP_HOST'] . ERROR);
}


$link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWD, DB_NAME);

if($link){
    
    // 文字化け防止
    mysqli_set_charset($link, 'utf8');
    
    if (isset($_POST['search_keyword']) === TRUE) {
        $search_keyword = $_POST['search_keyword'];
    }
    
    // hiddenで取得する変数
    if (isset($_POST['sql_kind']) === TRUE) {
        $sql_kind = $_POST['sql_kind'];
    }
    
    // new task
    if (isset($_POST['work_name']) === TRUE ){
        $work_name = $_POST['work_name'];
    }
    
    // description
    if (isset($_POST['work_detail']) === TRUE ){
        $work_detail = $_POST['work_detail'];
    }
    
    // work_idの取得と正規表現チェック
    if(isset($_POST['work_id']) === TRUE) {
        $work_id = trim($_POST['work_id']);
    }
   
    $check_work_id = '/^[0-9]+$/';
    if(mb_strlen($work_id) !== 0 && preg_match($check_work_id, $work_id) !== 1) {
        $err_msg[] = '不正な操作が行われました';
    }
    
    // 未完了リストの内容取得
    if(isset($_POST['work_name']) === TRUE) {
        $work_name = trim($_POST['work_name']);
    }
    
    if(isset($_POST['work_detail']) === TRUE) {
        $work_detail = trim($_POST['work_detail']);
    }
    
    
    if ($sql_kind === 'add_task') {
        
        //エラーチェック
        if (mb_strlen($work_name) === 0){
            $err_msg['work_name'] = 'Taskを入力してください';   
        } else if (mb_strlen($work_name) > WORK_NAME_LENGTH) {
            $err_msg['work_name'] = 'Taskは' . WORK_NAME_LENGTH . '文字以内で入力してください';
        }
        
         if (mb_strlen($work_detail) === 0){
            $err_msg['work_detail'] = 'Descriptionを入力してください';   
        } else if (mb_strlen($work_detail) > WORK_DESCRIPTION_LENGTH) {
            $err_msg['work_detail'] = 'Descriptionは' . WORK_DESCRIPTION_LENGTH . '文字以内で入力してください';
        }
        
        $date = date('Y-m-d H:i:s');
        $query = "INSERT INTO 
        work_table(work_name, work_detail, date)
        VALUES( '" . mysqli_real_escape_string($link, $work_name) . "' , '" 
        . mysqli_real_escape_string($link, $work_detail) . "' , '" . $date . "')";

        // クエリ実行
        if (count($err_msg) === 0) {
            mysqli_query($link, $query);
            //二重投稿防止で現在のページにリダイレクト
            header('Location: http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
            exit;
        } 
    } else if ($sql_kind === 'search_task') {
        // タスク検索表示
        $query = 'SELECT work_table.work_id, work_name, work_detail, date FROM work_table ';
        if (mb_strlen($search_keyword) > 0) {
            $query .= " WHERE work_name LIKE '%". $search_keyword . "%' 
            OR work_detail LIKE '%". $search_keyword . "%'";
        }
            $result = mysqli_query($link, $query);
            $i = 0;
            while ($row = mysqli_fetch_assoc($result)) {
                $work[$i]['work_id'] = htmlspecialchars($row['work_id'], ENT_QUOTES, 'UTF-8');
                $work[$i]['work_name'] = htmlspecialchars($row['work_name'], ENT_QUOTES, 'UTF-8');
                $work[$i]['work_detail'] = htmlspecialchars($row['work_detail'], ENT_QUOTES, 'UTF-8');
                $work[$i]['date'] = htmlspecialchars($row['date'], ENT_QUOTES, 'UTF-8');
                $i++;
            }
            
            mysqli_free_result($result);
            mysqli_close($link);
            $work = array_reverse($work);
            
        // タスク検索表示ここまで
    } else if ($sql_kind === 'completed_task') {
        // トランザクション開始
        mysqli_autocommit($link , false);
        // 削除フラグキー(status)によりタスクを未完了から完了済みに移動
        $query = "INSERT INTO work_completed_table(work_id, work_name, work_detail) 
        VALUES('" . $work_id . "', '" . $work_name . "', '" . $work_detail . "')";
        // クエリ実行
        if (mysqli_query($link, $query) === TRUE) {
            $query = "DELETE FROM work_table WHERE work_id = '" . $work_id . "'";
            mysqli_query($link, $query);
        }
        
        // トランザクション終了 
        if (count($err_msg) === 0) {
        mysqli_commit($link);
        } else {
            mysqli_rollback($link);
            $err_msg[] = 'トランザクション失敗';
        }
        
        //二重投稿防止で現在のページにリダイレクト
        header('Location: http://' . $_SERVER['HTTP_HOST'] . COMPTASK);
        exit;
        
    } else {
        $query = 'SELECT work_table.work_id, work_name, work_detail, date FROM work_table';
        $result = mysqli_query($link, $query);
            $i = 0;
            while ($row = mysqli_fetch_assoc($result)) {
                $work[$i]['work_id'] = htmlspecialchars($row['work_id'], ENT_QUOTES, 'UTF-8');
                $work[$i]['work_name'] = htmlspecialchars($row['work_name'], ENT_QUOTES, 'UTF-8');
                $work[$i]['work_detail'] = htmlspecialchars($row['work_detail'], ENT_QUOTES, 'UTF-8');
                $work[$i]['date'] = htmlspecialchars($row['date'], ENT_QUOTES, 'UTF-8');
                $i++;
            }
            
            mysqli_free_result($result);
            mysqli_close($link);
            $work = array_reverse($work);
    }
} else {
    $err_msg[] = 'DB接続失敗';
}

// 商品一覧テンプレートファイル読み込み
include_once 'tasklist_view.php';