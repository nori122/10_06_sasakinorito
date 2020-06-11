<!---------------------
     php 要素
--------------------->


<?php

// 送信確認
// var_dump($_POST);
// exit();

// 項目入力のチェック
// 値が存在しないor空で送信されてきた場合はNGにする
if (
  !isset($_POST['item']) || $_POST['item'] == '' ||
  !isset($_POST['store']) || $_POST['store'] == '' ||
  !isset($_POST['priority']) || $_POST['priority'] == ''
) {
  // 項目が入力されていない場合はここでエラーを出力し，以降の処理を中止する
  echo json_encode(["error_msg" => "no input"]);
  exit();
}

// 受け取ったデータを変数に入れる
$item = $_POST['item'];
$store = $_POST['store'];
$priority = $_POST['priority'];

// DB接続の設定 
// DB名は`gsacf_x00_00`にする
$dbn = 'mysql:dbname=gsacf_l03_06;charset=utf8;port=3306;host=localhost';
$user = 'root';
$pwd = '';

try {
  // ここでDB接続処理を実行する
  $pdo = new PDO($dbn, $user, $pwd);
} catch (PDOException $e) {
  // DB接続に失敗した場合はここでエラーを出力し，以降の処理を中止する
  echo json_encode(["db error" => "{$e->getMessage()}"]);
  exit();
}

// データ登録SQL作成
// `created_at`と`updated_at`には実行時の`sysdate()`関数を用いて実行時の日時を入力する
$sql = 'INSERT INTO tobuy_table(id, item, store, priority) VALUES(NULL, :item, :store, :priority)';

// SQL準備&実行
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':item', $item, PDO::PARAM_STR);
$stmt->bindValue(':store', $store, PDO::PARAM_STR);
$stmt->bindValue(':priority', $priority, PDO::PARAM_STR);
$status = $stmt->execute();

// データ登録処理後
if ($status == false) {
  // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
  $error = $stmt->errorInfo();
  echo json_encode(["error_msg" => "{$error[2]}"]);
  exit();
} else {
  // 正常にSQLが実行された場合は入力ページファイルに移動し，入力ページの処理を実行する
  header("Location:tobuy40_input.php");
  exit();
}
