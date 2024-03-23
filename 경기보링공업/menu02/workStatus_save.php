<?php
include $_SERVER['DOCUMENT_ROOT']."/inc/header.php";

  if(!$_SESSION[login_level]||$_SESSION[login_level]>"40"){
	  alert("권한이 없습니다.","/");
	  exit;
  }

if($mode == 'regist' || $mode == 'modify') {
	$wc_go_idx= $_POST['wc_go_idx'];
	//신청구분접수
	$gubun1 = $_POST['gubun1'];
	//call_tel,call_tel2,call_tel3 일반전화
	$call_tel1		= $_POST['call_tel'];
	$call_tel2		= $_POST['call_tel2'];
	$call_tel3		= $_POST['call_tel3'];
	$call_tel   = $call_tel1 ."-".  $call_tel2 ."-".  $call_tel3;
	//call_pcs1,call_pcs2,call_pcs3 휴대전화
	$call_name		= trim(str_replace(' ','',$_POST['call_name']));
	$call_pcs1 		= $_POST['call_pcs1'];
	$call_pcs2		= $_POST['call_pcs2'];
	$call_pcs3 		= $_POST['call_pcs3'];
	$call_pcs   = $call_pcs1 ."-".  $call_pcs2 ."-".  $call_pcs3;
	//wc_mem_etc 기타
	$wc_mem_etc		= $_POST['wc_mem_etc'];
	//fax1,fax2,fax3 기타
	$call_fax1		= $_POST['fax1'];
	$call_fax2		= $_POST['fax2'];
	$call_fax3		= $_POST['fax3'];
	$call_fax   = $call_fax1 ."-".  $call_fax2 ."-".  $call_fax3;
	//carno 차량번호
	$carno			= $_POST['carno'];
	//car_cate 보험사
	$wc_prog_etc	= $_POST['car_cate'];
	//made 제조사
	$carmade		= $_POST['made'];
	//car_name 모델명
	$car_name		= $_POST['car_name'];
	$car_name2		= $_POST['car_name2'];
	//car_year_yy 년식
	$car_year		= $_POST['car_year_yy'];
	//car_year_mm 월식
	$car_month		= $_POST['car_year_mm'];

	$caryear	  = $car_year.$car_month;
	//trans 변속기
	$car_gear		= $_POST['trans'];
	//fual 연료
	$carFual		= $_POST['fual'];
	//carcc 배기량
	$carCC			= str_replace(",", "", $_POST['carcc']);
	//carmile 주행거리
	$carMile		= str_replace(",", "", $_POST['carmile']);
	//carprice 세전출고가
	$carprice		= str_replace(",", "", $_POST['carprice']);
	//carcost 예상수리비
	$carcost		= str_replace(",", "", $_POST['carcost']);

	$wc_keep_tel1= str_replace(",", "", $_POST['wc_keep_tel1']);
	//caraccdate 사고발생일
	$caraccdate		= $_POST['caraccdate'];
	//carOption[] 기본옵션
	$carOption		= $_POST['carOption'];
	//carOptionadd 추가옵션
	$carOptionadd   = $_POST['carOptionadd'];
	//car_memo 파손설명
	$cardamage		= $_POST['car_memo'];
	//area1 보관장소1
	$area1			= $_POST['area1'];
	//place1 보관장소상세
	$place1			= $_POST['place1'];
	//areatel1_1,areatel1_2,areatel1_3 보관소연락처
	$areatel1_1		= $_POST['areatel1_1'];
	$areatel1_2		= $_POST['areatel1_2'];
	$areatel1_3		= $_POST['areatel1_3'];
	$areatel1 = $areatel1_1 ."-".  $areatel1_2 ."-".  $areatel1_3;
	//keep_name1 담당자
	$keep_name1		= $_POST['keep_name1'];
	//ArrcarOwner 소유형태
	$ArrcarOwner    = $_POST['ArrcarOwner'];
	//owner_name 차주명
	$owner_name		= $_POST['owner_name'];
	//owner_tel1,owner_tel2,owner_tel3 차주연락처
	$owner_tel1		= $_POST['owner_tel1'];
	$owner_tel2		= $_POST['owner_tel2'];
	$owner_tel3		= $_POST['owner_tel3'];
	$owner_tel   = $owner_tel1 ."-".  $owner_tel2 ."-".  $owner_tel3;

	if($mode == 'regist') {
		$nowdate = substr(date("Y"), -2);
		$cntQry = "select max( substring(wc_orderno, 6, 12) ) + 1 as maxCnt from woojung_part where substring(wc_orderno, 1, 2)='{$nowdate}' and wc_gubun1='1' ";
		$selQuery = mysql_query($cntQry);
		$selRow = mysql_fetch_row($selQuery);		
		$AllCnt = (int)$selRow[0];
		$OrderNum = substr(date("Y"), -2).'-'.date("m").str_pad($AllCnt, 5, "0", STR_PAD_LEFT);
		$sql = "insert into woojung_part set 
				wc_orderno	  = '$OrderNum',
				wc_mem_idx	  = '$loginIdx',
				wc_mem_id	  = '$loginId',";
	} else if($mode == 'modify') {
		$sql = "update woojung_part set ";
		$row = mysql_fetch_array(mysql_query("SELECT * FROM woojung_part WHERE wc_idx = '$wc_idx'"));
		
		$max = 0;
		for($s=1; $s<=60; $s++) {
		    if(strlen($row["wc_img_".$s]) == 0 )
		    {
		    	$max =  $s;
		    	break; 
		    }
		}
	}
	$sql.= "	wc_gubun1 = '1' ,
				wc_gubun2 = '$gubun2' ,
				wc_gubun3 = '$gubun3' ,
				wc_gubun4 = '$gubun4' ,
				wc_model = '$car_name',
				wc_model2 = '$wc_model2',
				calltype='$calltype', 
				wc_kind		  = '$wc_kind',
				wc_adminidx  = '$admidx' ,
				wc_adminName = '$adminName' ,
				wc_mem_name = '$call_name' ,
				wc_mem_phone = '$call_tel' ,
				wc_mem_mobile = '$call_pcs' ,
				wc_mem_fax = '$call_fax' ,
				wc_mem_etc = '$wc_mem_etc' ,
				wc_no = '$carno' ,
				wc_made = '$carmade' ,
				wc_age = '$wc_age' ,
				wc_trans = '$car_gear' ,
				wc_fual = '$carFual' ,
				wc_cc = '$carCC' ,
				wc_mileage = '$carMile' ,
				wc_price = '$carprice' ,
				wc_cost = '$wc_cost' ,
				wc_acc_date = '$caraccdate' ,
				wc_keep_area1 = '$wc_keep_area1' ,
				wc_keep_place1 = '$wc_keep_place1' ,
				wc_keep_tel1 = '$wc_keep_tel1' ,
				wc_keep_name1 = '$keep_name1' ,
				wc_keep_area2 = '$area2' ,
				wc_keep_place2 = '$place2' ,
				wc_keep_tel2 = '$areatel2' ,
				wc_keep_name2 = '$keep_name2' ,
				wc_option = '". @implode(",",$carOption) ."' ,
				wc_option_add = '$carOptionadd' ,
				wc_damage = '$wc_damage' ,
				wc_ownertype = '$ArrcarOwner' ,
				wc_owner = '$owner_name' ,
				wc_owner_tel = '$owner_tel' ,
				wc_memo = '$wc_memo' ,
				wc_prog_request_date		= '$wc_prog_request_date', 
				wc_prog_receipt_date		= '$wc_prog_receipt_date', 
				wc_prog_receipt_name		= '$wc_prog_receipt_name', 
				wc_prog_delive_date			= '$wc_prog_delive_date', 
				wc_prog_paper_no			= '$wc_prog_paper_no', 
				wc_prog_erasure_date		= '$wc_prog_erasure_date', 
				wc_prog_erasure_name		= '$wc_prog_erasure_name', 
				wc_prog_paper_content		= '$wc_prog_paper_content', 
				wc_prog_carowner_goods		= '$wc_prog_carowner_goods', 
				wc_prog_car_registno		= '$wc_prog_car_registno', 
				wc_prog_car_key				= '$wc_prog_car_key', 
				wc_prog_car_no				= '$wc_prog_car_no', 
				wc_prog_paper_ask			= '$wc_prog_paper_ask', 
				wc_prog_cost				= '$wc_prog_cost', 
				wc_prog_insure_cost			= '$wc_prog_insure_cost', 
				wc_prog_area_price			= '$wc_prog_area_price', 
				wc_prog_etc					= '$wc_prog_etc',
				";
	if($wc_idx){
		for($i=0;$i<60;$i++){
			$imgName = 'wc_img_'.($i+1);
			if($row[$imgName]){
				$imgcnt++;
			}
		}
	}
	for ($i=0;$i<sizeof($_FILES[upfile][name]);$i++) {
		if($imgcnt>60) break;
		if($_FILES[upfile][name][$i]&&in_array($i,$tmpfile)) {
			$file1 = $_FILES[upfile][tmp_name][$i];
			$file1_name = $_FILES[upfile][name][$i];
			$file1_size = $_FILES[upfile][size][$i];
			$file1_type = $_FILES[upfile][type][$i];

			$imgName = 'wc_img_'.($imgcnt+1);

			$copyday=time();
			$full_filename = explode(".", $file1_name);
			$extension = $full_filename[sizeof($full_filename)-1];
			$extension = strtolower($extension);
			$copyname = $copyday . $i . "." . $extension;
			$k=1;
			while (file_exists($_SERVER[DOCUMENT_ROOT]."/data/".$copyname)) {
				$copyname=$copyday."_".$k.".".$extension;
				$k++;
			}
			thumbnail($file1, $copyname, $_SERVER[DOCUMENT_ROOT]."/data/", 1280, 960);

			$sql.=  $imgName." =  '".$copyname."', ";	


			$kk++;$imgcnt++;
		}
	}

	if($mode == 'regist') {
		$sql.= "wc_regdate		  = now()";	
		$msg = '저장';
	} else if($mode == 'modify') {
		$sql.= " ss_etc='' where wc_idx='$wc_idx' "; 
		$msg = '수정';
	}
	mysql_query($sql)or die(mysql_error()); 

}
	
	goto_url("workStatus_list.php");
?>