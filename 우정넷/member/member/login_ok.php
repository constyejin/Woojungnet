<?php
include $_SERVER['DOCUMENT_ROOT']."/inc/header.php";
?>

<?
$sql="select * from member where user_id='$_POST[user_id]' and user_pass='".$_POST[user_pass]."'   ";
$result=mysql_query($sql);
$data=mysql_fetch_array($result);

if($data[user_id]){


	$_SESSION[user_id]=$data[user_id];
	$_SESSION[user_name]=$data[user_name];
	$_SESSION[nick_name]=$data[nick_name];
	$_SESSION[mb_type]=$data[mb_type];
	$_SESSION[idx]=$data[member_srl];
	$_SESSION[user_level]=$data[user_level];
	$_SESSION[company]=$data[company];
	$_SESSION[last_login]=$dat;
	$_SESSION[is_admin]="Y";
	$_SESSION[change_ch]=$data[change_ch];
	$_SESSION[company_group]=$data[company_group];
	$_SESSION[user_mobile]=$data[mobile];
	$_SESSION[login_level]="1";
	$_SESSION["login_id"]=$data[user_id];
	$_SESSION["login_name"]=$data[user_name];

	parent_url("/admin/sub04/sub01.php");
}else{
	msg("아이디 / 비밀번호를 확인해 주세요.");
}

?>