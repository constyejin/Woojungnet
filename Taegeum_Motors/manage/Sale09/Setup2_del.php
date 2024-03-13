<?
include $_SERVER['DOCUMENT_ROOT'].'/manage/inc/header.php';

$sql="select * from admin_table where a_idx='$idx'";
$result=mysql_query($sql,$connect);
$data=mysql_fetch_array($result);
$dbname=$data[a_name];

$sql="delete from admin_table where a_idx='$idx'";
if (mysql_query($sql)) {
	$drop_table="drop table $dbname";
	mysql_query($drop_table);
	$drop_table2="drop table ".$dbname."_comments";
	mysql_query($drop_table2);
} else { die ("DB 에러1"); }

movepage ("/manage/Sale09/Setup2.php");
?>