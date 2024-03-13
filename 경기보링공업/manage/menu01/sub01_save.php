<?
include "../inc/header.php";

if($idx){
	$query="update consult set 
	consult_step=2, 
	consult_admin='$consult_admin' 
	where idx=$idx
	";
	mysql_query($query);

	msg("등록완료");
	parent_reload();
}
?>