<?
include $_SERVER['DOCUMENT_ROOT']."/admin/inc/header.php";
?>

<?
	$query="insert into server_memo set 
	server_idx='$server_idx', 
	memo='$memo', 
	user_id='$_SESSION[user_id]', 
	regdate=now()  
	";
	mysql_query($query);

    echo "<script language='JavaScript'> parent.document.location.reload(); </script>";
?>

