<?
include $_SERVER['DOCUMENT_ROOT']."/admin/inc/header.php";
?>

<?

if($_POST[idx]){
	$updir=$_SERVER['DOCUMENT_ROOT']."/images/banner/";
	if($_FILES[upfile]["name"]){
		$imgname = FileUpload($_FILES[upfile]["name"],$_FILES[upfile][tmp_name],$updir);
		$upfile_d="upfile='$imgname', ";
	}

	$query="update config_layer set 
	type='$type', 
	code='$code', 
	code2='$code2', 
	homepage='$homepage', 
	$upfile_d
	list_num='$list_num'  
	where idx='$_POST[idx]'
	";
	//echo $query;
	mysql_query($query) or die(mysql_error()); 
}else{
	$updir=$_SERVER['DOCUMENT_ROOT']."/images/banner/";
	if($_FILES[upfile]["name"]){
		$imgname = FileUpload($_FILES[upfile]["name"],$_FILES[upfile][tmp_name],$updir);
		$upfile_d="upfile='$imgname', ";
	}

	$query="insert into config_layer set 
	type='$type', 
	code='$code', 
	code2='$code2', 
	homepage='$homepage', 
	$upfile_d
	list_num='$list_num' , 
	regdate=now()
	";
	//echo $query;
	mysql_query($query) or die(mysql_error()); 
}

?>

<script>parent.document.location.reload();</script>
