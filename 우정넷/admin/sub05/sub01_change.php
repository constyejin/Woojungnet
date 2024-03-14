<?
include $_SERVER['DOCUMENT_ROOT']."/admin/inc/header.php";
?>

<?
	$query="update server set 
	state='$state' 
	where idx='$_POST[idx]'
	";
	mysql_query($query);

	echo "<script language='JavaScript'> parent.document.location.reload(); </script>";
?>

