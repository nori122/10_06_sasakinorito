<!-------------- 
    PHP要素
 -------------->


<?php
session_start();
include('functions.php');
check_session_id();

// DB接続の設定
// DB名は`gsacf_x00_00`にする
$pdo = connect_to_db();

/* ---------------------------------- */
/* Case1:supermarket                  */
/* ---------------------------------- */


// データ取得SQL作成
$sql = 'SELECT * FROM tobuy_table WHERE store="スーパー"';

// SQL準備&実行
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();

// データ登録処理後
if ($status == false) {
  // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
  $error = $stmt->errorInfo();
  echo json_encode(["error_msg" => "{$error[2]}"]);
  exit();
} else {
  // 正常にSQLが実行された場合は入力ページファイルに移動し，入力ページの処理を実行する
  // fetchAll()関数でSQLで取得したレコードを配列で取得できる
  $s_result = $stmt->fetchAll(PDO::FETCH_ASSOC);  // データの出力用変数（初期値は空文字）を設定
  $s_output = "";
  // var_dump($s_result);
  // exit();

  // <tr><td>deadline</td><td>tobuy</td><tr>の形になるようにforeachで順番に$s_outputへデータを追加
  // `.=`は後ろに文字列を追加する，の意味
  foreach ($s_result as $record) {
    $s_output .= "<tr>";
    // $s_output .= "<td class='column'>{$record["store"]}</td>";
    $s_output .= "<td class='itemColumn'>{$record["item"]}</td>";
    $s_output .= "<td class='priorityColumn'>{$record["priority"]}</td>";
    // edit deleteリンクを追加
    $s_output .= "<td><a href='tobuy60_edit.php?id={$record["id"]}'><i class='fas fa-edit my-white'></a></td>";
    $s_output .= "<td><a href='tobuy70_delete.php?id={$record["id"]}'><i class='far fa-trash-alt my-white'></i></a></td>";
    $s_output .= "</tr>";
  }
  // $valueの参照を解除する．解除しないと，再度foreachした場合に最初からループしない
  // 今回は以降foreachしないので影響なし
  unset($record);
}

/* ---------------------------------- */
/* Case2:drugstore                   */
/* ---------------------------------- */

// データ取得SQL作成
$sql = 'SELECT * FROM tobuy_table WHERE store="ドラッグストア"';

// SQL準備&実行
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();

// データ登録処理後
if ($status == false) {
  // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
  $error = $stmt->errorInfo();
  echo json_encode(["error_msg" => "{$error[2]}"]);
  exit();
} else {
  // 正常にSQLが実行された場合は入力ページファイルに移動し，入力ページの処理を実行する
  // fetchAll()関数でSQLで取得したレコードを配列で取得できる
  $d_result = $stmt->fetchAll(PDO::FETCH_ASSOC);  // データの出力用変数（初期値は空文字）を設定
  $d_output = "";
  // var_dump($d_result);
  // exit();

  // <tr><td>deadline</td><td>tobuy</td><tr>の形になるようにforeachで順番に$d_outputへデータを追加
  // `.=`は後ろに文字列を追加する，の意味
  foreach ($d_result as $record) {
    $d_output .= "<tr>";
    // $d_output .= "<td class='column'>{$record["store"]}</td>";
    $d_output .= "<td class='itemColumn'>{$record["item"]}</td>";
    $d_output .= "<td class='priorityColumn'>{$record["priority"]}</td>";
    // edit deleteリンクを追加
    $d_output .= "<td><a href='tobuy60_edit.php?id={$record["id"]}'><i class='fas fa-edit my-white'></a></td>";
    $d_output .= "<td><a href='tobuy70_delete.php?id={$record["id"]}'><i class='far fa-trash-alt my-white'></i></a></td>";
    $d_output .= "</tr>";
  }
  // $valueの参照を解除する．解除しないと，再度foreachした場合に最初からループしない
  // 今回は以降foreachしないので影響なし
  unset($record);
}

/* ---------------------------------- */
/* Case3:E-commerce                   */
/* ---------------------------------- */

// データ取得SQL作成
$sql = 'SELECT * FROM tobuy_table WHERE store="ネット"';

// SQL準備&実行
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();

// データ登録処理後
if ($status == false) {
  // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
  $error = $stmt->errorInfo();
  echo json_encode(["error_msg" => "{$error[2]}"]);
  exit();
} else {
  // 正常にSQLが実行された場合は入力ページファイルに移動し，入力ページの処理を実行する
  // fetchAll()関数でSQLで取得したレコードを配列で取得できる
  $n_result = $stmt->fetchAll(PDO::FETCH_ASSOC);  // データの出力用変数（初期値は空文字）を設定
  $n_output = "";
  // var_dump($n_result);
  // exit();

  // <tr><td>deadline</td><td>tobuy</td><tr>の形になるようにforeachで順番に$n_outputへデータを追加
  // `.=`は後ろに文字列を追加する，の意味
  foreach ($n_result as $record) {
    $n_output .= "<tr>";
    // $n_output .= "<td class='column'>{$record["store"]}</td>";
    $n_output .= "<td class='itemColumn'>{$record["item"]}</td>";
    $n_output .= "<td class='priorityColumn'>{$record["priority"]}</td>";
    // edit deleteリンクを追加
    $n_output .= "<td><a href='tobuy60_edit.php?id={$record["id"]}'><i class='fas fa-edit my-white'></i>

</a></td>";
    $n_output .= "<td><a href='tobuy70_delete.php?id={$record["id"]}'><i class='far fa-trash-alt my-white'></i></a></td>";
    $n_output .= "</tr>";
  }
  // $valueの参照を解除する．解除しないと，再度foreachした場合に最初からループしない
  // 今回は以降foreachしないので影響なし
  unset($record);
}


?>




<!---------------------
     HTML 要素
--------------------->





<!DOCTYPE html>
<html lang="ja">

<head>
  <link rel="stylesheet" href="styles.css">
  <link href="https://fonts.googleapis.com/earlyaccess/hannari.css" rel="stylesheet">
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css" integrity="sha384-Bfad6CLCknfcloXFOyFnlgtENryhrpZCe29RTifKEixXQZ38WheV+i/6YWSzkz3V" crossorigin="anonymous">

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>お買い物リスト</title>
</head>

<body>
  <!-- <fieldset> -->
  <span style="margin-left:10px;">(<?= $_SESSION["user_name"] ?>用)</span>
  <legend>お買い物リスト</legend>
  <br>






  <!-- タブ -->
  <div class="tab">
    <button class="tablinks" onclick="openTab(event, 'supermarket')" id="defaultOpen">スーパー</button>
    <button class="tablinks" onclick="openTab(event, 'drugstore')">ドラッグストア</button>
    <button class="tablinks" onclick="openTab(event, 'ecommerce')">ネット</button>
  </div>


  <!-- スーパー -->
  <div id="supermarket" class="tabcontent">
    <table>
      <thead>
        <tr>
          <!-- <th>どこで買う</th> -->
          <th>商品</th>
          <th>優先度</th>
          <th></th>
          <th></th>
        </tr>
      </thead>
      <!-- <Hr> -->
      <tbody>
        <!-- ここに<tr><td>deadline</td><td>tobuy</td><tr>の形でデータが入る -->
        <?= $s_output ?>
      </tbody>
    </table>
  </div>


  <!-- ドラッグストア -->
  <div id="drugstore" class="tabcontent">
    <table>
      <thead>
        <tr>
          <!-- <th>どこで買う</th> -->
          <th>商品</th>
          <th>優先度</th>
          <th></th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <!-- ここに<tr><td>deadline</td><td>tobuy</td><tr>の形でデータが入る -->
        <?= $d_output ?>
      </tbody>
    </table>
  </div>


  <!-- ネット -->
  <div id="ecommerce" class="tabcontent">
    <table>
      <thead>
        <tr>
          <!-- <th>どこで買う</th> -->
          <th>商品</th>
          <th>優先度</th>
          <th></th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <!-- ここに<tr><td>deadline</td><td>tobuy</td><tr>の形でデータが入る -->
        <?= $n_output ?>
      </tbody>
    </table>
  </div>

  <br>
  <a href="tobuy40_input.php">新規登録画面へ</a>
  <br>
  <a href="tobuy30_logout.php">logout</a>


  <!---------------------
       javascript 要素
  --------------------->


  <script>
    function openTab(evt, storeLocation) {
      var i, tabcontent, tablinks;
      tabcontent = document.getElementsByClassName("tabcontent");
      for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
      }
      tablinks = document.getElementsByClassName("tablinks");
      for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
      }
      document.getElementById(storeLocation).style.display = "block";
      evt.currentTarget.className += " active";
    }
    document.getElementById("defaultOpen").click();
  </script>

</body>

</html>