<?php
// セッション開始
session_start();
$_SESSION["page"] ='login';
if (isset($_POST["login"])) {
    if (!empty($_POST["userid"])) {
        $userid = $_POST["userid"];

        $pdo = new PDO ( 'mysql:dbname=chat; host=localhost;port=3306; charset=utf8', 'root', 'Zaq12wsx!' );
        $cmd = 'SELECT member_name FROM chat.t_member WHERE member_id ="' .$userid .'";';
        foreach($pdo->query($cmd) as $row){
            $member_name = $row['member_name'];
        }
        if ($member_name != '') {
            session_regenerate_id(true);
            $_SESSION["NAME"] = $member_name; 
            $_SESSION["page"]='chat';
            $_SESSION["talk"]='test_talk_id';
            //header("Location: index.php");
            exit();  // 処理終了
        }else{

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
    <div id="your_container">
        <!-- チャットの外側部分① -->
        <div id="bms_messages_container">
            <?php if ($_SESSION["page"] == 'login'): ?>
                <form id="loginForm" name="loginForm" action="" method="POST">  
                        <label for="userid">ユーザーID</label><input type="text" id="userid" name="userid" placeholder="ユーザーIDを入力" value="<?php if (!empty($_POST["userid"])) {echo htmlspecialchars($_POST["userid"], ENT_QUOTES);} ?>">
                        <br>
                        <input type="submit" id="login" name="login" value="ログイン">
                </form>
            <?php elseif ( $_SESSION["page"] == 'chat' ): ?>
                <h1>HEY</h1>

            <?php elseif ( $_SESSION["page"] == 'talk' ): ?>
                <!-- ヘッダー部分② -->
                <div id="bms_chat_header">
                    <!--ステータス-->
                    <div id="bms_chat_user_status">
                        <!--ステータスアイコン-->
                        <div id="bms_status_icon">●</div>
                        <!--ユーザー名-->
                        <div id="bms_chat_user_name">ユーザー</div>
                    </div>
                </div>

                <!-- タイムライン部分③ -->
                <div id="bms_messages">
                    <?php
                        //<!--メッセージ１（左側）-->
                        print '<div class="bms_message bms_left">';
                        print  '<div class="bms_message_box">';
                        print  '<div class="bms_message_content">';
                        print  '<div class="bms_message_text">ほうほうこりゃー便利じゃないか</div>';
                        print  '</div>';
                        print  '</div>';
                        print  '</div>';
                        print  '<div class="bms_clear"></div>';//<!-- 回り込みを解除（スタイルはcssで充てる） -->

                        //<!--メッセージ２（右側）-->
                        print  '<div class="bms_message bms_right">';
                        print  '<div class="bms_message_box">';
                        print  '<div class="bms_message_content">';
                        print  '<div class="bms_message_text">うん、まあまあいけとるな</div>';
                        print  '</div>';
                        print  '</div>';
                        print  '</div>';
                        print  '<div class="bms_clear"></div>'; //<!-- 回り込みを解除（スタイルはcssで充てる） -->
                    ?>
                </div>

                <!-- テキストボックス、送信ボタン④ -->
                <div id="bms_send">
                    <textarea id="bms_send_message"></textarea>
                    <div id="bms_send_btn">送信</div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>