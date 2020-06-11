<!---------------------
     php 要素
--------------------->


<?php
// セッション使うので必ず記述
session_start();

// SESSIONを初期化（空にする）
$_SESSION = array();

// Cookieに保存してある"SessionIDの保存期間を過去にして破棄
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time() - 42000, '/');
}
// クッキーの保持期限を過去にする 
// exit();

// サーバ側での、セッションIDの破棄
session_destroy(); // セッションの破棄 


// 処理後、index.phpへリダイレクト
header('Location:tobuy10_login.php');// ログインページヘ移動
