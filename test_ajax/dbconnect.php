<?php
$id = $_POST['id'];

// データベース接続
try {
    $pdo = new PDO ( 'mysql:dbname=chat; host=localhost;port=3306; charset=utf8', 'root', 'Zaq12wsx!' );
} catch (PDOException $e) {
    var_dump($e->getMessage());
 exit;
}
// データ取得
$sql = "SELECT * FROM t_member where member_id='Takuto' ";
$stmt = ($dbh->prepare($sql));
$stmt->execute(array($id));

//あらかじめ配列を生成しておき、while文で回します。
$memberList = array();
while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
 $memberList[]=array(
  'member_id' =>$row['member_id'],
  'member_name'=>$row['member_name']
 );
}

//jsonとして出力
header('Content-type: application/json');
echo json_encode($memberList,JSON_UNESCAPED_UNICODE);