<?
include $_SERVER['DOCUMENT_ROOT']."/inc/lib.php";

if(!$_SESSION[user_id]){
	alert("관리자만 사용 가능합니다.","/");
	exit;
}

?>

