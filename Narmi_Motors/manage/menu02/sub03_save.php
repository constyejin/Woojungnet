<?
include "../inc/header.php";

if($del_idx){
	$query="update option_basic set del='Y' where idx=$del_idx ";
	mysql_query($query);
	parent_reload();
	exit;
}

$basic_price=str_replace(",","",$basic_price);

if(!$idx){
	$query="insert into option_basic set 
	basic_type1='$car_type1', 
	basic_type2='$car_type2', 
	basic_list='$basic_list', 
	basic_name='$basic_name', 
	basic_price='$basic_price', 
	basic_regdate=now() 
	";
	mysql_query($query);

	msg("등록완료");
	parent_reload();
}else{
	$mod_basic=sql_fetch("select * from option_basic where idx=$idx ");
	$query="update option_basic set 
	basic_type1='$car_type1', 
	basic_type2='$car_type2', 
	basic_list='$basic_list', 
	basic_name='$basic_name', 
	basic_price='$basic_price' 
	where idx=$idx
	";
	mysql_query($query);
	if(!$basic_price){
		$query="update option_basic set 
		basic_type1='$car_type1', 
		basic_type2='$car_type2', 
		basic_name='$basic_name' 
		where basic_name='$mod_basic[basic_name]'
		";
		mysql_query($query);
	}

	alert_p("수정완료","sub03.php");
}
?>