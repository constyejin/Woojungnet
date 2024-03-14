<?
include $_SERVER['DOCUMENT_ROOT']."/admin/inc/header.php";
?>

<?
	$query="delete from server_memo where idx='$_GET[idx]'	";
	mysql_query($query);

    echo "<script language='JavaScript'>history.back();</script>";
?>

