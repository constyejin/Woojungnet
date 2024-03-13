<?
include "../inc/header.php";

if($idx){
	$query="update sale_out set car_list='$car_list' where idx='$idx' ";
	mysql_query($query);
}

msg('완료');
parent_reload();	
?>