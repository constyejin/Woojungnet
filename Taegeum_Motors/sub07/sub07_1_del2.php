<?
	include "$_SERVER[DOCUMENT_ROOT]/lib/common.php";
	$connect = dbconn();
	
	if($wc_idx){
		$qry = "select * from woojung_part where wc_idx = '$wc_idx'  ";
		$row = mysql_fetch_array(mysql_query($qry));
	}
	
	if($loginId==$row[wc_mem_id]||$loginUsort == "admin" || $loginUsort=="superadmin"){ 	
		Query_string("DELETE FROM woojung_part WHERE wc_idx = '$wc_idx'");
		MsgMov("삭제 되었습니다.","sub08_1.php");
	}
	
	
?>