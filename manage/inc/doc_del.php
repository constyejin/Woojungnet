<?
include $_SERVER[DOCUMENT_ROOT]."/manage/inc/header.php";


if($idx){
	$Qry = "SELECT * FROM dongbu2 WHERE idx='$idx' ";
	$row = Row_string($Qry);

	if(is_file($_SERVER['DOCUMENT_ROOT'].'/manage/file/'.$row['filename'])){
	unlink($_SERVER['DOCUMENT_ROOT'].'/manage/file/'.$row['filename']);
	}

	$query="delete from dongbu2 where idx='$idx' ";
	mysql_query($query);

}
?>

<script>
parent.document.location.reload(); 
</script>