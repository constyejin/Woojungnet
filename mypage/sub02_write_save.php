<?php
$dir = $_SERVER['DOCUMENT_ROOT'];
include $dir.'/lib/session.php';
include $dir.'/lib/_class/basicdb.class.php';
include $dir.'/lib/_class/scriptAlert.class.php';

$db		= new basicdb();
$script = new scriptAlert();

$mode = $_POST['mode'];
if(!$mode)$script->alert('잘못된 접근입니다');
if($mode == 'modify'){
	if(!$_POST['idx'])$script->alert('idx값이 존재하지않습니다');
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
	$car_cate	= $_POST['car_cate'];
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


				$wc_price = str_replace(",", "", $_POST['wc_price']);

	if($mode == 'regist') {
		$nowdate = substr(date("Y"), -2);
		$cntQry = "select max( substring(wc_orderno, 7, 5) ) + 1 as maxCnt from woojung_car2 where substring(wc_orderno, 2, 2)='{$nowdate}'";
		$selQuery = $db->query($cntQry);
		$selRow = mysql_fetch_row($selQuery);		
		$AllCnt = (int)$selRow[0];
		$OrderNum = "D".substr(date("Y"), -2).'-'.date("m").str_pad($AllCnt, 5, "0", STR_PAD_LEFT);
		$sql = "insert into woojung_car2 set 
				wc_orderno	  = '$OrderNum',
				wc_kind		  = '$call_type',
				wc_mem_idx	  = '$loginIdx',
				wc_mem_id	  = '$loginId',";
	} else if($mode == 'modify') {
		$sql = "update woojung_car2 set ";
	}
	$sql.= "	wc_gubun1 = '$gubun1' ,
				wc_gubun2 = '$gubun2' ,
				wc_gubun3 = '$gubun3' ,
				wc_gubun4 = '$gubun4' ,
					end_3	= '$end_3',
				calltype='$calltype', 
				wc_model = '$car_name',
				wc_model2 = '$car_name2',
				wc_adminidx  = '$admidx' ,
				wc_adminName = '$wc_adminName' ,
				wc_mem_name = '$call_name' ,
				wc_mem_phone = '$call_tel' ,
				wc_mem_mobile = '$call_pcs' ,
				wc_mem_fax = '$call_fax' ,
				wc_mem_etc = '$wc_mem_etc' ,
				wc_no = '$carno' ,
				wc_made = '$carmade' ,
				wc_age = '$caryear' ,
				wc_trans = '$car_gear' ,
				wc_fual = '$carFual' ,
				car_cate = '$car_cate' ,
				wc_cc = '$carCC' ,
				wc_mileage = '$carMile' ,
				wc_price = '$wc_price' ,
				wc_cost = '$carcost' ,
				wc_acc_date = '$caraccdate' ,
				wc_keep_area1 = '$area1' ,
				wc_keep_place1 = '$place1' ,
				wc_keep_tel1 = '$areatel1' ,
				wc_keep_name1 = '$keep_name1' ,
				wc_keep_area2 = '$area2' ,
				wc_keep_place2 = '$place2' ,
				wc_keep_tel2 = '$areatel2' ,
				wc_keep_name2 = '$keep_name2' ,
				wc_option = '". @implode(",",$carOption) ."' ,
				wc_option_add = '$carOptionadd' ,
				wc_damage = '$cardamage' ,
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
	
	if($_POST['hidFileName']) {
		$car_img_arr = explode("|:|",$_POST['hidFileName']);
		for($k=1; $k<=24; $k++) {
			
			$imgName = 'wc_img_'.$k;
			if($car_img_arr[$k-1])$sql.= $imgName." = '".$car_img_arr[$k-1]."',";		
		}
	
	}

	if($mode == 'regist') {
		$sql.= "wc_regdate		  = now()";	
		$msg = '저장';
	} else if($mode == 'modify') {
		$msg = '수정';
	}
	
	mysql_query($sql);

	//wc_go_type 매각유형
	$wc_go_type       = $_POST['wc_go_type'];
	//wc_go_cost_type 비용정산
	$wc_go_cost_type  = $_POST['wc_go_cost_type'];
	//wc_go_cost,wc_go_cost1,wc_go_cost2,wc_go_cost3 발생비용
	$wc_go_cost       = str_replace(",", "", $_POST['wc_go_cost']);
	$wc_go_cost1      = str_replace(",", "", $_POST['wc_go_cost1']);
	$wc_go_cost2      = str_replace(",", "", $_POST['wc_go_cost2']);
	$wc_go_cost3      = str_replace(",", "", $_POST['wc_go_cost3']);
	

	//wc_go_start_date 입찰시작일
	$wc_go_start_date = $_POST['wc_go_start_date'];
	//wc_go_start_hh 시작시
	$wc_go_start_hh   = $_POST['wc_go_start_hh'];
	//wc_go_start_mm 시작분
	$wc_go_start_mm   = $_POST['wc_go_start_mm'];
	//wc_go_end_date 입찰종료일
	$wc_go_end_date   = $_POST['wc_go_end_date'];
	//wc_go_end_hh 종료시
	$wc_go_end_hh     = $_POST['wc_go_end_hh'];
	//wc_go_end_mm 종료분
	$wc_go_end_mm     = $_POST['wc_go_end_mm'];

	if($_POST['hidFileName']) {
		$car_img_arr = explode("|:|",$_POST['hidFileName']);
		for($k=1; $k<=24; $k++) {
			
			$imgName = 'wc_img_'.$k;
			if($car_img_arr[$k-1])$sql.= $imgName." = '".$car_img_arr[$k-1]."',";		
		}
	
	}
	if($mode == 'regist') {
		$wc_idx=mysql_insert_id();
	}
	

	if($wc_go_idx){
		$sSQL = "update woojung_car2_go set ";
		$eSQL = " where  wc_go_idx  = '$wc_go_idx' and wcg_wcidx  = '$wc_idx' ";
	}else{
		$sSQL = "insert into woojung_car2_go set 
				 wcg_wcidx 				= '$wc_idx',";
		$eSQL = "";
	}

	// 손상차, 특수차일경우만 적용함
	if($gubun2 == "2" || $gubun2 == "3"){
		$sSQL .= "wcg_gubun2			= '$gubun2',";		
	}
	$sSQL .= "							
				wc_go_first_price	= '$wc_go_first_price',
				wc_go_type       	= '$wc_go_type',
				wc_go_cost_type  	= '$wc_go_cost_type',
				wc_go_cost       	= '$wc_go_cost',
				wc_go_cost1      	= '$wc_go_cost1',
				wc_go_cost2      	= '$wc_go_cost2',
				wc_go_cost3      	= '$wc_go_cost3',							
				wc_go_start_date 	= '$wc_go_start_date',
				wc_go_start_hh   	= '$wc_go_start_hh',
				wc_go_start_mm   	= '$wc_go_start_mm',
				wc_go_end_date   	= '$wc_go_end_date',
				wc_go_end_hh     	= '$wc_go_end_hh',
				wc_go_end_mm     	= '$wc_go_end_mm',
				wc_go_etc        	= '$wc_go_etc'
			";
	$sSQL = $sSQL.$eSQL;
	$result = mysql_query($sSQL);
}
	
$db->dbclose();
		MsgMov("등록되었습니다.","sub02.php");
?>