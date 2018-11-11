<?php
$id = $_POST['member_id'];

// データベース接続
try {
    $pdo = new PDO ( 'mysql:dbname=chat; host=localhost;port=3306; charset=utf8', 'root', 'Zaq12wsx!' );
} catch (PDOException $e) {
    var_dump($e->getMessage());
 exit;
}
// データ取得
$memberList = array();
$cmd = 'SELECT * FROM t_member where member_id="' .$id .'";';
foreach($pdo->query($cmd) as $row){
    $memberList[]=$row;
}

//jsonとして出力
header('Content-type: application/json');
echo json_encode($memberList,JSON_UNESCAPED_UNICODE);