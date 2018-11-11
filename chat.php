<?php
// セッション開始
session_start();
if (!isset($_SESSION["NAME"])) {
    header("Location: logout.php");
    exit;
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
        </div>
    </div>
</body>
</html>