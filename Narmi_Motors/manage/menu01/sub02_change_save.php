<?
include "../inc/header.php";

$query="update estimate set est_state='$val' where idx='$idx' ";
mysql_query($query);
?>