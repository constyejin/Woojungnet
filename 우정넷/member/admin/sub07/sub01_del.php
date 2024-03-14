<?
include $_SERVER['DOCUMENT_ROOT']."/admin/inc/header.php";
?>

<?
$query="delete from plan where idx='$_GET[idx]' ";
mysql_query($query);
goto_url("sub01.php");
?>

