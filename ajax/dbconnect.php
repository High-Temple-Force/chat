<?php
$text = $_POST['text'];
$talk_id = $_POST['talk'];
$member_id = $_POST['member'];

// データベース接続
try {
    $pdo = new PDO ( 'mysql:dbname=chat; host=localhost;port=3306; charset=utf8', 'root', 'Zaq12wsx!' );
} catch (PDOException $e) {
    var_dump($e->getMessage());
 exit;
}
// データ取得
$memberList = array();
$cmd = 'insert into chat.t_message (member_id,talk_id,m_text) values ("' .$member_id .'","' .$talk_id .'","' .$text .'");';
foreach($pdo->query($cmd) as $row){
    $memberList[]=$row;
}

//jsonとして出力
header('Content-type: application/json');
echo json_encode($memberList,JSON_UNESCAPED_UNICODE);

?>