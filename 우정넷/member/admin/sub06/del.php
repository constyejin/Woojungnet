<?
include $_SERVER['DOCUMENT_ROOT']."/admin/inc/header.php";
?>

<?
if($_GET[idx]){
	$query="delete from config_layer where idx='$_GET[idx]' ";
	//echo $query;
	mysql_query($query) or die(mysql_error()); 
}
?>

<script>history.back();</script>