<?php
// セッション開始
session_start();
// エラーメッセージの初期化
$errorMessage = "";
// ログインボタンが押された場合
if (isset($_POST["login"])) {
    // 1. ユーザIDの入力チェック
    if (empty($_POST["userid"])) {  // emptyは値が空のとき
        $errorMessage = 'ユーザIDが未入力です。';
    } else if (empty($_POST["password"])) {
        $errorMessage = 'パスワードが未入力です。';
    }
 
    if (!empty($_POST["userid"]) && !empty($_POST["password"])) {
        $userid = $_POST["userid"];
        $password = $_POST["password"];
        try {
            $pdo = new PDO ( 'mysql:dbname=koenji; host=localhost;port=3306; charset=utf8', 'root', 'Zaq12wsx!' );
            $cmd = 'SELECT * FROM t_master WHERE id ="' .$userid .'";';
            foreach($pdo->query($cmd) as $row){
                $dbuserid = $row['id'];
                $dbpassword = $row['password'];
            }
            if ($password==$dbpassword) {
                session_regenerate_id(true);
                $_SESSION["NAME"] = $userid; 
                if ($_SESSION["NAME"] == "takuto") { 
                    $_SESSION["table"] = "t_a_product" ;
                //hayato
                } elseif ($_SESSION["NAME"] == "hayato") {
                    $_SESSION["table"] = "t_m_product" ;
                //daiki
                } elseif ($_SESSION["NAME"] == "daiki") {
                    $_SESSION["table"] = "t_y_product" ;
                //三人以外はエラー返す
                }
                header("Location: master.php");  // メイン画面へ遷移
                exit();  // 処理終了
            } else {
                // 認証失敗
                $errorMessage = 'ユーザIDあるいはパスワードに誤りがあります。';
            }
        } catch (PDOException $e) {
            $errorMessage = 'データベースエラー';
        }
    }
}


?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" rel="stylesheet" href="style/style.css" />
    <title>chat</title>
</head>
<body>
<div class="login">
  <div class="login-triangle"></div>
  
  <h2 class="login-header">Log in</h2>

  <form class="login-container">
    <p><input type="userid" placeholder="user ID"></p>
    <p><input type="password" placeholder="Password"></p>
    <p><input type="submit" name="login" value="Log in"></p>
  </form>
</div>
</body>
</html>