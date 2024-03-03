<?
session_start();
include $_SERVER["DOCUMENT_ROOT"]."/lib/func.php"; 
dbconn();

$query="insert into receive set conten='".$wc_idx."', regdate=now() ";
mysql_query($query);

?>
