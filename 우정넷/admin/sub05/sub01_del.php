<?
include $_SERVER['DOCUMENT_ROOT']."/admin/inc/header.php";
?>

<?

	$check=$_POST[check]	;
	for($i=0;$i<count($check);$i++){
		$query="delete from server where idx='$check[$i]' ";
		mysql_query($query) or die(mysql_error()); 
	}

    echo "<script language='JavaScript'> parent.document.location.reload(); </script>";

?>