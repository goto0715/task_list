<?php

// 設定ファイル読み込み
require_once 'const.php';
// 関数ファイル読み込み

// 初期化する変数
$err_msg = array();
$work = array();
$search_keyword = '';
$sql_kind = '';
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
    
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
         // トランザクション開始
        mysqli_autocommit($link , false);
        // タスクを完了済みから、work_historyに移動した後削除
        $query = "INSERT INTO work_history(work_id, work_name, work_detail) 
        VALUES('" . $work_id . "', '" . $work_name . "', '" . $work_detail . "')";
        // クエリ実行
        if (mysqli_query($link, $query) === TRUE) {
            $query = "DELETE FROM work_completed_table WHERE work_id = '" . $work_id . "'";
            mysqli_query($link, $query);
        }
        
        // トランザクション終了 
        if (count($err_msg) === 0) {
        mysqli_commit($link);
        } else {
            mysqli_rollback($link);
            $err_msg[] = 'トランザクション失敗';
        }
        
    }
    
    
    $query ='SELECT * FROM work_completed_table';
    
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

// 商品一覧テンプレートファイル読み込み
include_once 'comptask_view.php';
