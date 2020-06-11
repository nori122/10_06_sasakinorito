<!---------------------
     php 要素
--------------------->


<?php

// 送信データのチェック
// var_dump($_POST);
// exit();

// 関数ファイルの読み込み
include('functions.php');

// 送信データ受け取り
$id = $_POST['id'];
$item = $_POST['item'];
$store = $_POST['store'];
$priority = $_POST['priority'];



// DB接続
$pdo = connect_to_db();

// UPDATE文を作成
$sql = "UPDATE tobuy_table SET item=:item, store=:store, priority=:priority Where id=:id";

// sql文を実行
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':item', $item, PDO::PARAM_STR);
$stmt->bindValue(':store', $store, PDO::PARAM_STR);
$stmt->bindValue(':priority', $priority, PDO::PARAM_STR);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();



// データ登録処理後
if ($status == false) {
  // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
  $error = $stmt->errorInfo();
  echo json_encode(["error_msg" => "{$error[2]}"]);
  exit();
} else {
  // 正常にSQLが実行された場合は一覧ページファイルに移動し，一覧ページの処理を実行する
  header("Location:tobuy_read.php");
  exit();
}
