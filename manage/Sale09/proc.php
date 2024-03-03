<?
	include "$_SERVER[DOCUMENT_ROOT]/lib/common.php";
	$connect = dbconn();
	
	
	
	if($mode == "delete"){
		
		if(count($check) == 0 ){MsgMov("선택된 자료가 없습니다.","Sale_list.php");exit;}
		for($i=0;$i<count($check);$i++){

			Query_string("DELETE FROM admin_log WHERE idx = '$check[$i]'");
		}	
				
		
		msg("선택된 정보가 삭제 되었습니다.");
		ParentReload();
	}
	
	
?>