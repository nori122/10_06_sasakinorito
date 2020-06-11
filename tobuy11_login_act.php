<!-------------- 
    PHP要素
 -------------->


<?php
// var_dump($_POST);
// exit();

// 外部ファイル読み込み
session_start();
include('functions.php');
check_session_id();

// DB接続します
$pdo = connect_to_db();

// データ受け取り
$user_id = $_POST['user_id'];
$password = $_POST['password'];
// $user_id = $_POST['user_id'];
// $user_id = $_POST['user_id'];


// データ取得SQL作成
$sql = 'SELECT * FROM tobuy_users_table
WHERE user_id=:user_id 
AND password=:password 
AND is_deleted=0';


//実行
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':user_id', $user_id, PDO::PARAM_STR);
$stmt->bindValue(':password', $password, PDO::PARAM_STR);
$status = $stmt->execute();


// SQL実行時にエラーがある場合はエラーを表示して終了
if ($status == false) {
  // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
  $error = $stmt->errorInfo();
  echo json_encode(["error_msg" => "{$error[2]}"]);
  exit();
} else {
  // うまくいったらデータ（1レコード）を取得
  $val = $stmt->fetch(PDO::FETCH_ASSOC);
}

// ユーザ情報が取得できない場合はメッセージを表示
if (!$val) {
  echo "<p>ログイン情報に誤りがあります．</p>";
  echo '<a href="tobuy10_login.php">login</a>';
  exit();
} else {
  // ログインできたら情報をsession領域に保存して一覧ページへ移動
  $_SESSION = array(); // セッション変数を空にする 
  $_SESSION["session_id"] = session_id();
  $_SESSION["is_admin"] = $val["is_admin"];
  $_SESSION["user_id"] = $val["user_id"];
  header("Location:tobuy50_read.php");
  exit();
}
