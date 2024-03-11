<?php
$dir = $_SERVER['DOCUMENT_ROOT'];
include $dir.'/lib/session.php';
include $dir.'/lib/basicdb.class.php';
include $dir.'/lib/scriptAlert.class.php';

$db		= new basicdb();
$script = new scriptAlert(); 

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
		$cntQry = "select max( substring(wc_orderno, 6, 12) ) + 1 as maxCnt from woojung_part where substring(wc_orderno, 1, 2)='{$nowdate}'";
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
		$row = Row_string("SELECT * FROM woojung_part WHERE wc_idx = '$wc_idx'");
		
		$max = 0;
		for($s=1; $s<=60; $s++) {
		    if(strlen($row["wc_img_".$s]) == 0 )
		    {
		    	$max =  $s;
		    	break; 
		    }
		}
	}
	$sql.= "	wc_gubun1 = '2' ,
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
			while (file_exists($_SERVER[DOCUMENT_ROOT]."/data1/".$copyname)) {
				$copyname=$copyday."_".$k.".".$extension;
				$k++;
			}
			thumbnail($file1, $copyname, $_SERVER[DOCUMENT_ROOT]."/data1/", 1280, 960);

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
	
	movepage("sub08_1.php");
?>