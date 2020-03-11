<?php

// 設定ファイル読み込み
require_once 'const.php';

// 初期化する変数
$err_msg = array();
$msg = array();
$work = array();
$search_keyword = '';
$sql_kind = '';
$work_name = '';
$work_detail = '';
$work_id = '';

// POSTから変数を取得
if ($_SERVER['REQUEST_METHOD'] === 'POST' && count($err_msg) === 0) {
    
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
    
    if ($sql_kind === 'add_task') {
        
        //エラーチェック
        if (mb_strlen($work_name) === 0){
            $err_msg['work_name'] = '業務内容を入力してください';   
        } else if (mb_strlen($work_name) > WORK_NAME_LENGTH) {
            $err_msg['work_name'] = '業務内容は' . WORK_NAME_LENGTH . '文字以内で入力してください';
        }
        
         if (mb_strlen($work_detail) === 0){
            $err_msg['work_detail'] = '業務内容を入力してください';   
        } else if (mb_strlen($work_detail) > WORK_DESCRIPTION_LENGTH) {
            $err_msg['work_detail'] = '業務内容は' . WORK_DESCRIPTION_LENGTH . '文字以内で入力してください';
        }
    }       
}

// 商品一覧テンプレートファイル読み込み
include_once 'search_view.php';