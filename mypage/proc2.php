<?
	include "$_SERVER[DOCUMENT_ROOT]/lib/common.php";
	$connect = dbconn();
	
	
	
	if($mode == "delete"){
		
		if(count($check) == 0 ){MsgMov("선택된 자료가 없습니다.","Sale_list.php");exit;}
		for($i=0;$i<count($check);$i++){

			$sql="select * from woojung_car WHERE wc_idx = '$check[$i]' ";
			$result=mysql_query($sql);
			$data=mysql_fetch_array($result);
			for($im=1;$im<15;$im++){
				$imname="wc_img_".$im;
				if($data[$imname]){
					$delimg=explode("/" , $data[$imname]);
					unlink($_SERVER['DOCUMENT_ROOT'].'/data/'.$delimg[0]);
				}
			}

			Query_string("DELETE FROM woojung_car2 WHERE wc_idx = '$check[$i]'");
//			Query_string("DELETE FROM woojung_car_go WHERE wcg_wcidx = '$check[$i]'");
//			Query_string("DELETE FROM woojung_car_judgment WHERE wcj_wcidx  = '$check[$i]'");
//			Query_string("DELETE FROM woojung_car_scrap  WHERE wc_sidx  = '$check[$i]'");
		}	
				
		
		MsgMov("선택된 정보가 삭제 되었습니다.","sub02.php?page=$page");
	}
	
	
?>