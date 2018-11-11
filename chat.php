<?php
// セッション開始
session_start();
if (!isset($_SESSION["NAME"])) {
    header("Location: logout.php");
    exit;
}
$_SESSION['page']='talks';



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
                    <div id="bms_status_icon"></div>
                    <!--ユーザー名-->
                    <div id="bms_chat_user_name"></div>
                </div>
            </div>

            <!-- タイムライン部分③ -->
            <?php if ($page === 'talks'): ?>
                <div id="bms_talks">
                    <?php
                        $talks = Array();
                        $pdo = new PDO ( 'mysql:dbname=chat; host=localhost;port=3306; charset=utf8', 'root', 'Zaq12wsx!' );
                        $cmd = 'SELECT t_talk.talk_name,t_member.member_name FROM t_auth inner join t_member on t_auth.member_id = t_member.member_id
                                inner join t_talk on t_talk.talk_id = t_auth.talk_id and t_member.member_id="' .$_SESSION['NAME'] .'";';
                        foreach($pdo->query($cmd) as $row){
                            $talks[] = $row['talk_name'];
                        }
                        foreach($talks as $talk){
                            print '<div class="bms_talk_box">';
                            print '<div>' .$talk .'</div>';
                            print '</div>';
                        }
                    ?>
                    <div>kkkkkk</div>
                </div>
            <?php elseif ($page === 'talk'): ?>
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
            <?php endif;?>
        </div>
    </div>
</body>
</html>