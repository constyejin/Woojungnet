<?
include "../inc/header.php";

$query="update consult set consult_step='$val' where idx='$idx' ";
mysql_query($query);
?>