<?
	include "$_SERVER[DOCUMENT_ROOT]/manage/inc/header.php";
	
	if($mode == "delete"){
		
		if(count($check) == 0 ){MsgMov("선택된 자료가 없습니다.","Sale_list.php");exit;}
		for($i=0;$i<count($check);$i++){

			$sql="select * from woojung_car WHERE wc_idx = '$check[$i]' ";
			$result=mysql_query($sql);
			$data=mysql_fetch_array($result);
			for($im=1;$im<=100;$im++){
				$imname="wc_img_".$im;
				if($data[$imname]){
					$delimg=explode("/" , $data[$imname]);
					if(is_file($_SERVER['DOCUMENT_ROOT'].'/data/'.$delimg[0])){
					unlink($_SERVER['DOCUMENT_ROOT'].'/data/'.$delimg[0]);
					}
				}
			}

			Query_string("DELETE FROM woojung_car WHERE wc_idx = '$check[$i]'");
			Query_string("DELETE FROM woojung_car_go WHERE wcg_wcidx = '$check[$i]'");
			Query_string("DELETE FROM woojung_car_judgment WHERE wcj_wcidx  = '$check[$i]'");
			Query_string("DELETE FROM woojung_car_scrap  WHERE wc_sidx  = '$check[$i]'");
			Query_string("DELETE FROM woojung_bid WHERE auct_key = '$check[$i]'");
			Query_string("DELETE FROM woojung_car_comment WHERE wc_idx = '$check[$i]'");
			Query_string("DELETE FROM dongbu2 WHERE wc_idx = '$check[$i]'");
			Query_string("DELETE FROM woojung_company_memo WHERE wc_idx = '$check[$i]'");
			Query_string("DELETE FROM woojung_bid_log WHERE auct_key = '$check[$i]'");
		}	
				
		
		msg("선택된 정보가 삭제 되었습니다.");
		echo "<script>parent.document.location.reload();</script>";
	}
	
	
?>