<?php
//�⺻ �����̷�Ʈ
echo $_REQUEST["htImageInfo"];

$url = $_REQUEST["callback"] .'?callback_func='. $_REQUEST["callback_func"];
$bSuccessUpload = is_uploaded_file($_FILES['Filedata']['tmp_name']);
if (bSuccessUpload) { //���� �� ���� ������� URL ����
	
	$tmp_name = $_FILES['Filedata']['tmp_name'];
	$name = $_FILES['Filedata']['name'];
	$new_path = "../upload/".urlencode($_FILES['Filedata']['name']);
	@move_uploaded_file($tmp_name, $new_path);
	$url .= "&bNewLine=true";
	$url .= "&sFileName=".urlencode(urlencode($name));
	//$url .= "&size=". $_FILES['Filedata']['size'];
	//�Ʒ� URL�� �����Ͻø� �˴ϴ�.
	$url .= "&sFileURL=http://".$_SERVER['SERVER_NAME']."/board/popup/upload/".urlencode(urlencode($name));
	echo "<script>window.close();</script>";
} else { //���н� errstr=error ����
	$url .= '&errstr=error';
}
header('Location: '. $url);
?>