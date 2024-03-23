<?php
include "../inc/header.php";

  if(!$_SESSION[login_level]||$_SESSION[login_level]>"40"){
	  alert("권한이 없습니다.","/");
	  exit;
  }


	if($mode == "delete"){
		
		if(count($check) == 0 ){alert("선택된 자료가 없습니다.","Sale_list.php");exit;}
		for($i=0;$i<count($check);$i++){

			$sql="select * from woojung_part WHERE wc_idx = '$check[$i]' ";
			$result=mysql_query($sql);
			$data=mysql_fetch_array($result);
			for($im=1;$im<61;$im++){
				$imname="wc_img_".$im;
				if($data[$imname]){
					$delimg=explode("/" , $data[$imname]);
					unlink($_SERVER['DOCUMENT_ROOT'].'/data/'.$delimg[0]);
				}
			}

			mysql_query("DELETE FROM woojung_part WHERE wc_idx = '$check[$i]'");
		}	
				
		if($back_url=="o"){
			parent_reload();
//		alert("선택된 정보가 삭제 되었습니다.","/sub07/sub07_1.php?page=$page&gubun4=$gubun4");
		}else{
			parent_reload();
//		alert("선택된 정보가 삭제 되었습니다.","Sale_list.php?page=$page&gubun4=$gubun4");
		}
	}
	
	
?>