<?
	include "$_SERVER[DOCUMENT_ROOT]/lib/common.php";
	$connect = dbconn();
	
	
	
	if($mode == "delete"){
		if($loginUsort == "admin" || $loginUsort=="superadmin"){ 	
		
		if(count($check) == 0 ){MsgMov("선택된 자료가 없습니다.","sub08_1.php");exit;}
		for($i=0;$i<count($check);$i++){

			$sql="select * from woojung_part WHERE wc_idx = '$check[$i]' ";
			$result=mysql_query($sql);
			$data=mysql_fetch_array($result);
			for($im=1;$im<30;$im++){
				$imname="wc_img_".$im;
				if($data[$imname]){
					$delimg=explode("/" , $data[$imname]);
					unlink($_SERVER['DOCUMENT_ROOT'].'/data2/'.$delimg[0]);
				}
			}

			Query_string("DELETE FROM woojung_part WHERE wc_idx = '$check[$i]'");
		}	
				
		
		MsgMov("선택된 정보가 삭제 되었습니다.","sub07_1.php?page=$page");
		}
	}
	
	
?>