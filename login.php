<?php
// セッション開始
session_start();
// エラーメッセージの初期化
$errorMessage = "";
// ログインボタンが押された場合
if (isset($_POST["login"])) {
    // 1. ユーザIDの入力チェック
    if (empty($_POST["memberid"])) {  // emptyは値が空のとき
        $errorMessage = 'ユーザIDが未入力です。';
    } else if (empty($_POST["password"])) {
        $errorMessage = 'パスワードが未入力です。';
    }
 
    if (!empty($_POST["memberid"]) && !empty($_POST["password"])) {
        $memberid = $_POST["memberid"];
        $password = $_POST["password"];
        try {
            $pdo = new PDO ( 'mysql:dbname=chat; host=localhost;port=3306; charset=utf8', 'root', 'Zaq12wsx!' );
            $cmd = 'SELECT password FROM t_pass WHERE member_id ="' .$memberid .'";';
            foreach($pdo->query($cmd) as $row){
                $dbpassword = $row[0];
            }
            if ($password==$dbpassword) {
                session_regenerate_id(true);
                $_SESSION["member"] = $memberid; 
                header("Location: chat.php");  // メイン画面へ遷移
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
  <div><font color="#ff0000"><?php echo htmlspecialchars($errorMessage, ENT_QUOTES); ?></font></div>
  <form class="login-container" action="#" method="POST">
    <p><input type="text" name="memberid" placeholder="User ID"></p>
    <p><input type="password" name="password" placeholder="Password"></p>
    <p><input type="submit" name="login" value="Log in"></p>
  </form>
</div>
</body>
</html>