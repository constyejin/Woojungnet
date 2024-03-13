<?
include "../inc/header.php";

if($db_name){
	for($i=0;$i<count($checkidx);$i++){
		$del_data=sql_fetch("select * from $db_name where idx='$checkidx[$i]' ");
		$query="delete from $db_name WHERE idx = '$checkidx[$i]' ";
		mysql_query($query);
		if($db_name=="sale_car"){
			$query="delete from sale_car_trim WHERE car_idx = '$checkidx[$i]' ";
			mysql_query($query);
		}
		if($db_name=="sale_out"){
			$query="delete from sale_out_trim WHERE car_idx = '$checkidx[$i]' ";
			mysql_query($query);
		}
		if($db_name=="estimate"){
			$query="delete from sale_est WHERE idx = '$del_data[car_idx]' ";
			mysql_query($query);
		}
	}
	parent_reload();
}
?>