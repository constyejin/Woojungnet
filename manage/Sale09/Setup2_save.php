<?
include $_SERVER['DOCUMENT_ROOT'].'/manage/inc/header.php';
?>

<?
if($no){
	$sql="update admin_table set 
	a_name='$a_name', 
	a_skinname='$a_skinname', 
	a_file_use='$a_file_use',
	a_level='$a_level',
	a_write_level='$a_write_level',
	a_title='$a_title',
	a_comment_level='$a_comment_level', 
	a_header='$a_header',
	a_header2='$a_header2',
	a_footer='$a_footer', 
	a_table='$a_table'
	where a_idx=$no";
	mysql_query($sql)or die(mysql_error());
}else{
	$sql="insert into admin_table(a_include,a_name,a_title,a_skinname,a_header,a_header2,a_footer,a_file_use,a_img,a_level,a_write_level,a_comment_use,a_comment_level,a_table) values('$a_include','$a_name','$a_title','$a_skinname','$a_header','$a_header2','$a_footer','$a_file_use','$a_img','$a_level','$a_write_level','$a_comment_use','$a_comment_level','$a_table')";
	mysql_query($sql)or die(mysql_error());
}
?>
<script>
location.href='Setup2.php';
</script>