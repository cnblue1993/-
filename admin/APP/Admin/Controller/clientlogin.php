<?php
include("conn.php");
// $json=$_GET ['json'];
$json = file_get_contents ( 'php://input' );
$obj = json_decode ( $json );

$result = mysql_query ( "select * from user where u_nickname='" . $obj->{'UserName'} . "' and u_pwd='" . $obj->{'PassWord'} . "'" );
mysql_close ( $con );

//��GB2312������ת����utf-8�����ʽ
$success = iconv("GB2312","UTF-8//IGNORE","��½�ɹ�");
$error = iconv("GB2312","UTF-8//IGNORE","��½ʧ��");

header ( 'Content-type: application/json;charset=UTF-8' );

if (mysql_num_rows ( $result ) < 1) {
	$response ["success"] = 1;
	$response ["message"] = $error;
} else {
	$response ["success"] = 0;
	$response ["message"] = $success;
}

//���json_encode�������������
foreach ( $response as $key => $value ) {
	$newData[$key] = urlencode( $value );
// 	$newData [$key] ['message'] = urlencode ( $value ['message'] );
}

echo urldecode ( json_encode ( $newData ) );

?>