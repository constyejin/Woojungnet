<?
include "../inc/header.php";

if($del_idx){
	$query="update option_basic set del='Y' where idx=$del_idx ";
	mysql_query($query);
	parent_reload();
	exit;
}

$mod_basic=sql_fetch("select * from option_basic where basic_name='$basic_name' ");

if(!$idx){
	$query="insert into option_basic set 
	basic_type1='$mod_basic[basic_type1]', 
	basic_type2='$mod_basic[basic_type2]', 
	basic_list='$basic_list', 
	basic_name='$basic_name', 
	basic_price='$basic_price', 
	basic_regdate=now() 
	";
	mysql_query($query);

	msg("등록완료");
	parent_reload();
}else{
	$query="update option_basic set 
	basic_list='$basic_list', 
	basic_name='$basic_name', 
	basic_price='$basic_price' 
	where idx=$idx
	";
	mysql_query($query);

	$query="update sale_car_trim set trim_list='$basic_list' where trim_idx='$idx' ";
	mysql_query($query);

	alert_p("수정완료","sub03.php");
}
?>