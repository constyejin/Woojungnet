<?
include "../inc/header.php";

if($del_idx){
	$query="delete from web_table where idx=$del_idx ";
	mysql_query($query);
	parent_reload();
	exit;
}

if(!$idx){
	$query="insert into web_table set 
	table_title='$table_title', 
	table_id='$table_id', 
	table_regdate=now() 
	";
	mysql_query($query);

	msg("등록완료");
	parent_reload();
}else{
	$query="update web_table set 
	table_skin='$table_skin', 
	table_editor='$table_editor', 
	table_file='$table_file', 
	table_list='$table_list', 
	table_write='$table_write', 
	table_view='$table_view', 
	table_reply='$table_reply', 
	table_comment='$table_comment', 
	table_secret='$table_secret' 
	where idx=$idx
	";
	mysql_query($query);

	msg("수정완료");
}
?>