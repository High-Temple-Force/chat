<?php
// セッション開始
session_start();
if (!isset($_SESSION["NAME"])) {
    header("Location: logout.php");
    exit;
}
$_SESSION['page']='talks';

$talks = Array();
$pdo = new PDO ( 'mysql:dbname=chat; host=localhost;port=3306; charset=utf8', 'root', 'Zaq12wsx!' );
$cmd = 'SELECT t_talk.talk_id,t_talk.talk_name,t_member.member_name FROM t_auth inner join t_member on t_auth.member_id = t_member.member_id
        inner join t_talk on t_talk.talk_id = t_auth.talk_id and t_member.member_id="' .$_SESSION['NAME'] .'";';
foreach($pdo->query($cmd) as $row){
    $talks[] = $row;
}

if (isset($_POST["open_talk"])) {
    $_SESSION['page'] = 'talk';
    $_SESSION['talk'] = $_POST['open_talk'];
    $pdo = new PDO ( 'mysql:dbname=chat; host=localhost;port=3306; charset=utf8', 'root', 'Zaq12wsx!' );
    $cmd = 'select * from t_message where talk_id = "' .$_POST['open_talk'] .'";';
    foreach($pdo->query($cmd) as $row){
        $messages[] = $row;
    }
}
if (isset($_POST["sent"])) {
    $_SESSION['page'] = 'talk';
    if($_POST['text']!=''){
        $pdo = new PDO ( 'mysql:dbname=chat; host=localhost;port=3306; charset=utf8', 'root', 'Zaq12wsx!' );
        $cmd = 'insert into chat.t_message (member_id,talk_id,m_text) values ("' .$_SESSION['NAME'] 
        .'","' .$_SESSION['talk'] .'","' .$_POST['text'] .'");';
        $pdo->query($cmd);
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
            <?php if ($_SESSION['page'] == 'talks'): ?>
                <div id="bms_talks">
                    <?php
                        foreach($talks as $talk){
                            print '<div class="bms_talk_box">';
                            print '<form action="#" method="POST">';
                            print '<button type="submit" class="btn" name="open_talk" value="' .$talk[0] .'">' .$talk[1] .'</button>';
                            print '</form>';
                            print '</div>';
                        }
                    ?>
                </div>
            <?php elseif ($_SESSION['page'] == 'talk'): ?>
                <div id="bms_messages">
                    <?php
                        foreach($messages as $message){
                            if($message[1]!=$_SESSION["NAME"]){
                                //<!--メッセージ１（左側）-->
                                print '<div class="bms_message bms_left">';
                                print  '<div class="bms_message_box">';
                                print  '<div class="bms_message_content">';
                                print  '<div class="bms_message_text">' .$message[4] .'</div>';
                                print  '</div>';
                                print  '</div>';
                                print  '</div>';
                                print  '<div class="bms_clear"></div>';//<!-- 回り込みを解除（スタイルはcssで充てる） -->
                            }elseif($message[1]==$_SESSION["NAME"]){

                                //<!--メッセージ２（右側）-->
                                print  '<div class="bms_message bms_right">';
                                print  '<div class="bms_message_box">';
                                print  '<div class="bms_message_content">';
                                print  '<div class="bms_message_text">' .$message[4] .'</div>';
                                print  '</div>';
                                print  '</div>';
                                print  '</div>';
                                print  '<div class="bms_clear"></div>'; //<!-- 回り込みを解除（スタイルはcssで充てる） -->
                            }
                        }
                    ?>
                </div>
            

                <!-- テキストボックス、送信ボタン④ -->
                <form action="#" method="POST">
                    <div id="bms_send">
                        <textarea id="bms_send_message" name="text"></textarea>
                        <button type="submit" id="bms_send_btn" name="sent">送信</button>
                    </div>
                </form>
            <?php endif;?>
        </div>
    </div>
</body>
</html>