<?
include $_SERVER['DOCUMENT_ROOT'].'/manage/inc/header.php';

	mysql_query("update woojung_car_q set wcj_type='$wcj_type' where wc_idx='".$wc_idx."'");
	
	MsgMov("변경완료","Scrap_app_list.php");
?>