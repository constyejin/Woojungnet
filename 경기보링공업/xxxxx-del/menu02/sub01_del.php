<?
include "../inc/header.php";

if($trim_idx){
	$query="delete from sale_car_trim where idx=$trim_idx";
	mysql_query($query);
	$mod_car_trim=sql_fetch("select * from sale_car_trim where car_idx='".$idx."' order by trim_list asc ");
	alert_p("삭제완료","sub01_view.php?idx=".$idx."&trim_idx=".$mod_car_trim[idx]);
	exit;
}

	
?>