<!---------------------
     HTML 要素
--------------------->


<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css" integrity="sha384-Bfad6CLCknfcloXFOyFnlgtENryhrpZCe29RTifKEixXQZ38WheV+i/6YWSzkz3V" crossorigin="anonymous">

  <title>お買い物リスト新規ユーザー登録</title>
</head>

<body>
  <form action="tobuy21_register_act.php" method="POST">
    <fieldset>
      <legend>新規ユーザー登録</legend>
      <div>
        user_name: <input type="text" name="user_name">
      </div>
      <div>
        user_id: <input type="text" name="user_id">
      </div>
      <div>
        password: <input type="text" name="password">
      </div>
      <div>
        <button>Register</button>
      </div>
      <a href="tobuy10_login.php">or login</a>
    </fieldset>
  </form>

</body>

</html>