<!---------------------
     php 要素
--------------------->



<?php
// 送信データのチェック
// var_dump($_GET);
// exit();

// 関数ファイルの読み込み
session_start();
include('functions.php');
check_session_id();



// idの受け取り
$id = $_GET['id'];


// DB接続
$pdo = connect_to_db();


// データ取得SQL作成
$sql = 'SELECT * FROM tobuy_table WHERE id=:id';


// SQL準備&実行
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();




// データ登録処理後
if ($status == false) {
  // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
  $error = $stmt->errorInfo();
  echo json_encode(["error_msg" => "{$error[2]}"]);
  exit();
} else {
  // 正常にSQLが実行された場合は指定の11レコードを取得
  // fetch()関数でSQLで取得したレコードを取得できる
  $record = $stmt->fetch(PDO::FETCH_ASSOC);
}

?>



<!---------------------
     HTML 要素
--------------------->



<!DOCTYPE html>
<html lang="ja">

<head>
  <link rel="stylesheet" href="styles.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css" integrity="sha384-Bfad6CLCknfcloXFOyFnlgtENryhrpZCe29RTifKEixXQZ38WheV+i/6YWSzkz3V" crossorigin="anonymous">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>お買い物リスト（編集画面）</title>
</head>

<body>
  <form action="tobuy61_update.php" method="POST">
    <fieldset>
      <legend>リスト編集</legend>
      <div>
        買うもの: <input type="text" name="item" value="<?= $record["item"] ?>">
      </div>
      <div class="container">
        <div>
          <select class="form" name="store">
            <option class="input" value="<?= $record["store"] ?>" selected disabled>どこで買う
            </option>
            <option>スーパー</option>
            <option>ドラッグストア</option>
            <option>ネット</option>
          </select>
        </div>
        <div>
          <select class="form" name="priority">
            <option class="input" value="<?= $record["priority"] ?>" selected disabled> 優先度</option>
            <option>ASAP</option>
            <option>安ければ</option>
            <option>検討中</option>
          </select>
        </div>
      </div>
      <div>
        <input type="hidden" name="id" value="<?= $record["id"] ?>">
      </div>
      <div>
        <button class='register'>編集完了</button>
      </div>

    </fieldset>
    <a href="tobuy50_read.php">一覧画面へ</a>

  </form>

</body>

</html>