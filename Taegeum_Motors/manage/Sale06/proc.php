<?
include_once "../inc/header.php"; 
$connect = dbconn();
	
if($mode=="delete"){
	mysql_query("delete from woojung_car_q where wc_idx='".$wc_idx."'");
	
	MsgMov("삭제 처리되었습니다","Scrap_app_list.php");
}
if($mode=="alldelete"){
	if(count($check) == 0 ){MsgMov("선택된 자료가 없습니다.","Scrap_app_list.php");exit;}
	for($i=0;$i<count($check);$i++){
		mysql_query("DELETE FROM woojung_car_q WHERE wc_idx = '$check[$i]'");
	}	
			
	
	MsgMov("선택된 정보가 삭제 되었습니다.","Scrap_app_list.php");
}
?>