<?php
$dir = $_SERVER['DOCUMENT_ROOT'];
include $dir.'/lib/session.php';
include $dir.'/lib/basicdb.class.php';
include $dir.'/lib/scriptAlert.class.php';
?>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Incaron</title>
  <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
  <link rel="stylesheet" type="text/css" href="/common/css/base.css?v=221208"/>

	<link rel="stylesheet" type="text/css" href="/common/css/style.css"/>
	<link rel="stylesheet" type="text/css" href="/common/css/add_style.css?v=2212081209"/>  <!-- 2022.11.25 css추가  -->
	<link rel="stylesheet" type="text/css" href="/common/css/incaron_style.css"/>  <!-- 2022.11.25 css추가  -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
	
	<!-- swiper.js css-->
	<link
		rel="stylesheet"
		href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css"
	/>
	<!-- swiper.js js-->
	<script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>

  <script src="/common/js/incaron_ui.js"></script>
  <script src="/common/js/front.js"></script>
</head>
<?
$db		= new basicdb();
$script = new scriptAlert();
if(!$loginId){$script->alert('잘못된 접근입니다');}
$mode = $_POST['mode'];
if(!$mode)$script->alert('잘못된 접근입니다');
if($mode == 'modify'){
	if(!$_POST['idx'])$script->alert('idx값이 존재하지않습니다');
}

	function thumbnail($file, $save_filename, $save_path, $max_width, $max_height)
	{
		// 전송받은 이미지 정보를 받는다
		$img_info = getImageSize($file);

		// 전송받은 이미지의 포맷값 얻기 (gif, jpg png)
		if($img_info[2] == 1) 
			$src_img = ImageCreateFromGif($file);
		else if($img_info[2] == 2)
			$src_img = ImageCreateFromJPEG($file);
		else if($img_info[2] == 3)
			$src_img = ImageCreateFromPNG($file);
		else
			return 0;

		// 전송받은 이미지의 실제 사이즈 값얻기
		$img_width = $img_info[0];
		$img_height = $img_info[1];

		if($img_width <= $max_width)
		{
			$max_width = $img_width;
			$max_height = $img_height;
		}

		if($img_width > $max_width)
			$max_height = ceil(($max_width / $img_width) * $img_height);

		// 새로운 트루타입 이미지를 생성
		$dst_img = imagecreatetruecolor($max_width, $max_height);

		// R255, G255, B255 값의 색상 인덱스를 만든다
		ImageColorAllocate($dst_img, 255, 255, 255);

		// 이미지를 비율별로 만든후 새로운 이미지 생성
		ImageCopyResampled($dst_img, $src_img, 0, 0, 0, 0, $max_width, $max_height, ImageSX($src_img),ImageSY($src_img));

		// 알맞는 포맷으로 저장
		if($img_info[2] == 1)
	 {
			ImageInterlace($dst_img);
			ImageGif($dst_img, $save_path.$save_filename);
		}
		else if($img_info[2] == 2)
	 {
			ImageInterlace($dst_img);
			ImageJPEG($dst_img, $save_path.$save_filename);
		}
	 else if($img_info[2] == 3)
	 {
			ImagePNG($dst_img, $save_path.$save_filename);
	 }

		// 임시 이미지 삭제
		ImageDestroy($dst_img);
		ImageDestroy($src_img);
		return true;
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
	$sms_pcs   = $call_pcs1 .  $call_pcs2 .  $call_pcs3;
	//wc_mem_etc 기타
	$wc_mem_etc		= $_POST['wc_mem_etc'];
	//fax1,fax2,fax3 기타
	$call_fax1		= $_POST['fax1'];
	$call_fax2		= $_POST['fax2'];
	$call_fax3		= $_POST['fax3'];
	$call_fax   = $call_fax1 ."-".  $call_fax2 ."-".  $call_fax3;
	//보관소연락처
	$wc_keep_tel1= $wc_keep_tel_1 ."-".  $wc_keep_tel_2 ."-".  $wc_keep_tel_3;
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

	$wc_clerkTel = $wc_clerkTel1 ."-".  $wc_clerkTel2 ."-".  $wc_clerkTel3;
	$botel = $botel1 ."-".  $botel2 ."-".  $botel3;
	$dambo3 = $dambo3_1 ."/".  $dambo3_2 ."/".  $dambo3_3;

	if($mode == 'regist') {
		$nowdate = substr(date("Y"), -2)."-".date("md");
		$cntQry = "select max( substring(wc_orderno, 8, 12) ) + 1 as maxCnt from woojung_car where substring(wc_orderno, 1, 7)='{$nowdate}'";
		$selQuery = $db->query($cntQry);
		$selRow = mysql_fetch_row($selQuery);		
		$AllCnt = (int)$selRow[0];
		$OrderNum = substr(date("Y"), -2).'-'.date("md").str_pad($AllCnt, 3, "0", STR_PAD_LEFT);
		$sql = "insert into woojung_car set 
				wc_orderno	  = '$OrderNum',
				wc_kind		  = '$call_type',
				wc_mem_idx	  = '$loginIdx',
				wc_mem_id	  = '$loginId',";
	} else if($mode == 'modify') {
		$sql = "update woojung_car set ";
	}
	$sql.= "	wc_gubun1 = '$gubun1' ,
				wc_gubun2 = '$gubun2' ,
				wc_gubun3 = '$gubun3' ,
				wc_gubun4 = '$gubun4' ,
				sang_type='1',
				orm='$orm', 
				orm2='$orm2', 
				evalAmt_type='$evalAmt_type', 
				dambo1='$dambo1', 
				dambo2='$dambo2', 
				dambo3='$dambo3', 
				wc_model = '$car_name',
				wc_model2 = '$car_name2',
				calltype='$calltype', 
				calltype2='$calltype2', 
				acctype='".@implode(",",$acctype)."', 
				attnConts='$attnConts',
				wrhsDate='$wrhsDate', 
				wc_clerkTel='$wc_clerkTel', 
				botel='$botel', 
				bodam='$bodam', 
				jnumber='$jnumber',
				moveKeepReq='$moveKeepReq',
				wc_clerkName='$wc_clerkName', 
				wc_adminidx  = '$admidx' ,
				wc_adminName = '$adminName' ,
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
				car_cate2 = '$car_cate2' ,
				wc_cc = '$carCC' ,
				wc_mileage = '$carMile' ,
				wc_price = '$carprice' ,
				wc_cost = '$carcost' ,
				wc_acc_date = '$caraccdate' ,
				wc_keep_area1 = '$area1' ,
				wc_keep_place1 = '$place1' ,
				wc_keep_tel1 = '$wc_keep_tel1' ,
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
	
	$kk=1;
	for ($i=0;$i<sizeof($upfile);$i++) {
		if($_FILES[upfile][tmp_name]&&in_array($i,$tmpfile)) {
			$file1 = $_FILES[upfile][tmp_name][$i];
			$file1_name = $_FILES[upfile][name][$i];
			$file1_size = $_FILES[upfile][size][$i];
			$file1_type = $_FILES[upfile][type][$i];

			$copyday=date("Ymd")."_".time();
			$full_filename = explode(".", $file1_name);
			$extension = $full_filename[sizeof($full_filename)-1];
			$extension = strtolower($extension);
			$copyname = $copyday . $i . "." . $extension;
			$k=1;
			while (file_exists($_SERVER[DOCUMENT_ROOT]."/data/".$copyname)) {
				$copyname=$copyday."_".$k.".".$extension;
				$k++;
			}
			thumbnail($file1, $copyname, $_SERVER[DOCUMENT_ROOT]."/data/", 1000, 1000);
			copy($_SERVER[DOCUMENT_ROOT]."/data/".$copyname,"../../data/".$copyname);

			$imgName = 'wc_img_'.$kk;
			$sql.= $imgName." = '".$copyname."',";		

			$kk++;$imgcnt++;
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
	$wged=explode("-" ,$_POST['wc_go_end_date']);
	$wged=sprintf("%04d",$wged[0])."-".sprintf("%02d",$wged[1])."-".sprintf("%02d",$wged[2]);
	$wc_go_end_date   = $wged;
	//wc_go_end_hh 종료시
	$wc_go_end_hh     = $_POST['wc_go_end_hh'];
	//wc_go_end_mm 종료분
	$wc_go_end_mm     = $_POST['wc_go_end_mm'];

	if($_POST['hidFileName']) {
		$car_img_arr = explode("|:|",$_POST['hidFileName']);
		for($k=1; $k<=48; $k++) {
			
			$imgName = 'wc_img_'.$k;
			if($car_img_arr[$k-1])$sql.= $imgName." = '".$car_img_arr[$k-1]."',";		
		}
	
	}
	if($mode == 'regist') {
		$wc_idx=mysql_insert_id();
	}
	

	if($wc_go_idx){
		$sSQL = "update woojung_car_go set ";
		$eSQL = " where  wc_go_idx  = '$wc_go_idx' and wcg_wcidx  = '$wc_idx' ";
	}else{
		$sSQL = "insert into woojung_car_go set 
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
MsgMov("자료가 ".$msg."되었습니다.","/sub02/sub02_1.php");
?>