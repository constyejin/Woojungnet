<?
include $_SERVER['DOCUMENT_ROOT']."/admin/inc/header.php";
?>

<?
$sdate=$sy."-".$sm."-".$sd;

if($_POST[idx]){
	$query="update server set 
	type1='$type1', 
	type2='$type2', 
	type3='$type3', 
	server_id='$server_id', 
	server_pass='$server_pass', 
	root_pass='$root_pass', 
	root_db_pass='$root_db_pass', 
	sdate='$sdate', 
	edate='$edate', 
	memo='$memo' 
	where idx='$_POST[idx]'
	";
	mysql_query($query);
	msg("수정완료");
}else{
	$query="insert into server set 
	type1='$type1', 
	type2='$type2', 
	type3='$type3', 
	server_id='$server_id', 
	server_pass='$server_pass', 
	root_pass='$root_pass', 
	root_db_pass='$root_db_pass', 
	sdate='$sdate', 
	edate='$edate', 
	memo='$memo', 
	state='1', 
	user_id='$_SESSION[user_id]', 
	regdate=now()  
	";
	mysql_query($query);
	alert_p("등록완료","sub01.php");
}
?>

