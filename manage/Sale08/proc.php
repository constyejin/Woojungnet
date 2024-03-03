<?
	include $_SERVER['DOCUMENT_ROOT'].'/manage/inc/header.php';

if($loginUsort != "admin" && $loginUsort != "admin1" && $loginUsort != "admin2" && $loginUsort != "admin3" && $loginUsort != "superadmin" && $loginUsort != "jisajang2"){
	movepage("/index.php", "관리자 로그인이 필요합니다.");
	MsgMov("관리자 로그인이 필요합니다.","/index.php");
	exit;
}
	
	
	
	if($mode == "delete"){
		
		if(count($check) == 0 ){MsgMov("선택된 자료가 없습니다.","poplist.php");exit;}
		for($i=0;$i<count($check);$i++){

			$data=mysql_fetch_array(mysql_query("select * from js_popup where pop_no='$check[$i]'"));
			if($data[pop_image1]){
				unlink($_SERVER['DOCUMENT_ROOT'].'/images/popup/'.$data[pop_image1]);
			}

			Query_string("DELETE FROM js_popup WHERE pop_no = '$check[$i]'");
		}	
				
		
		MsgMov("선택된 자료가 삭제 되었습니다.","poplist.php?page=$page");
	}
	
	
?>