<?
$dir = $_SERVER['DOCUMENT_ROOT'];
include $dir.'/lib/session.php';
include $dir.'/lib/_class/basicdb.class.php';
include $dir.'/lib/_class/scriptAlert.class.php';

$db		= new basicdb();
$script = new scriptAlert();
	
	
	
	if($mode == 'modify'){
		if(!$_POST['wc_idx'])$script->alert('idx값이 존재하지않습니다');
	}
	

	//wRequest();
	//exit;
		
	
		
	if($mode == 'modify'){
	
	$wc_idx		= $_POST['wc_idx'];
	$gubun1		= $_POST['gubun1'];
	$gubun3		= $_POST['gubun3'];
	$gubun4 	= $_POST['gubun4'];
	$keeping 	= $_POST['keeping'];

	$admidx			= $_POST['admidx'];
	$call_name		= $_POST['call_name'];

	$call_tel1		= $_POST['call_tel'];
	$call_tel2		= $_POST['call_tel2'];
	$call_tel3		= $_POST['call_tel3'];

	$call_tel   = $call_tel1 ."-".  $call_tel2 ."-".  $call_tel3;

	$call_pcs1		= $_POST['call_pcs1'];
	$call_pcs2		= $_POST['call_pcs2'];
	$call_pcs3		= $_POST['call_pcs3'];

	$call_pcs   = $call_pcs1 ."-".  $call_pcs2 ."-".  $call_pcs3;
	
	
	$wc_mem_etc		= $_POST['wc_mem_etc'];


	$call_fax1		= $_POST['fax1'];
	$call_fax2		= $_POST['fax2'];
	$call_fax3		= $_POST['fax3'];

	$call_fax   = $call_fax1 ."-".  $call_fax2 ."-".  $call_fax3;
	
	$carno			= $_POST['carno'];
	$carmade		= $_POST['made'];
	$carmodel		= $_POST['car_name'];
	$carmodel2		= $_POST['car_name2'];

	$car_year		= $_POST['car_year_yy'];
	$car_month		= $_POST['car_year_mm'];

	$caryear	  = $car_year.$car_month;

	$car_gear		= $_POST['trans'];
	$carFual		= $_POST['fual'];
	$carCC			= str_replace(",", "",$_POST['carcc']);
	$carMile		= str_replace(",", "",$_POST['carmile']);
	
	
	$carprice		= str_replace(",", "", $_POST['carprice']);
	$carcost		= str_replace(",", "", $_POST['carcost']);
	$caraccdate		= $_POST['caraccdate'];

	$carOption		= $_POST['carOption'];
	$carOptionadd   = $_POST['carOptionadd'];
	$cardamage		= $_POST['car_memo'];
	$carOwner		= $_POST['carOwner'];

	$owner_name		= $_POST['owner_name'];
	$owner_tel1		= $_POST['owner_tel1'];
	$owner_tel2		= $_POST['owner_tel2'];
	$owner_tel3		= $_POST['owner_tel3'];

	$owner_tel   = $owner_tel1 ."-".  $owner_tel2 ."-".  $owner_tel3;



	$area1			= $_POST['area1'];
	$place1			= $_POST['place1'];
	$areatel1_1		= $_POST['areatel1_1'];
	$areatel1_2		= $_POST['areatel1_2'];
	$areatel1_3		= $_POST['areatel1_3'];
	$keep_name1		= $_POST['keep_name1'];
	
	$areatel1 = $areatel1_1 ."-".  $areatel1_2 ."-".  $areatel1_3;

	$area2			= $_POST['area2'];
	$place2			= $_POST['place2'];
	$areatel2_1		= $_POST['areatel2_1'];
	$areatel2_2		= $_POST['areatel2_2'];
	$areatel2_3		= $_POST['areatel2_3'];
	$keep_name2		= $_POST['keep_name2'];
	$car_cate=$_POST['car_cate'];

	$areatel2 = $areatel2_1 ."-".  $areatel2_2 ."-".  $areatel2_3;

	$ArrcarOwner    = $_POST['ArrcarOwner'];	
	$wc_memo		= $_POST['wc_memo'];


// 진행상황 정보

	$wc_prog_request_date		= $_POST['wc_prog_request_date'];
	$wc_prog_receipt_date		= $_POST['wc_prog_receipt_date'];
	$wc_prog_receipt_name		= $_POST['wc_prog_receipt_name'];
	$wc_prog_delive_date		= $_POST['wc_prog_delive_date'];
	$wc_prog_paper_no			= $_POST['wc_prog_paper_no'];
	$wc_prog_erasure_date		= $_POST['wc_prog_erasure_date'];
	$wc_prog_erasure_name		= $_POST['wc_prog_erasure_name'];
	$wc_prog_paper_content		= $_POST['wc_prog_paper_content1']."|".$_POST['wc_prog_paper_content2'];
	$wc_prog_carowner_goods		= $_POST['wc_prog_carowner_goods'];
	$wc_prog_car_registno		= $_POST['wc_prog_car_registno'];
	$wc_prog_car_key			= $_POST['wc_prog_car_key'];
	$wc_prog_car_no				= $_POST['wc_prog_car_no'];
	$wc_prog_paper_ask			= $_POST['wc_prog_paper_ask'];
	$wc_prog_cost				= $_POST['wc_prog_cost'];
	$wc_prog_insure_cost		= $_POST['wc_prog_insure_cost'];
	$wc_prog_area_price			= $_POST['wc_prog_area_price'];
	$wc_prog_etc	= $_POST['wc_prog_etc'];


			// 감정평가금액
				$wcj_price  	= str_replace(",", "", $_POST['wcj_price']);
				$wcj_cost   	= str_replace(",", "", $_POST['wcj_cost']);
				$wcj_gubun  	= $_POST['wcj_gubun'];
				$wcj_memo		= $_POST['wcj_memo'];
				$wcj_regdate	= $_POST['wcj_regdate'];
				$wcj_type	= $_POST['wcj_type'];

				$car_price  	= str_replace(",", "", $_POST['car_price']);
				$wc_price = str_replace(",", "", $_POST['wc_price']);
	
	if($admidx) $adminName = SaleAdmin('direct', $admidx);
		

		if($gubun1 == "2"){
			$gubun2 = "";
			$gubun3 = "";
			$gubun4 = "";
		}

		$sql = "update woojung_car2 set ";
		$sql.= "
				wc_gubun3 = '$gubun3' ,
				wc_gubun4 = '$gubun4' ,
					end_3	= '$end_3',
					sang_type	= '$sang_type',
				calltype='$calltype', 
				keeping = '$keeping' ,
				wc_adminidx  = '$admidx' ,
				wc_adminName = '$wc_adminName' ,
				wc_mem_name = '$call_name' ,
				wc_mem_phone = '$call_tel' ,
				wc_mem_mobile = '$call_pcs' ,
				wc_mem_fax = '$call_fax' ,
				wc_mem_etc = '$wc_mem_etc' ,
				wc_no = '$carno' ,
				car_cate = '$car_cate' ,
				wc_made = '$carmade' ,
				wc_model = '$carmodel' ,
				wc_model2 = '$carmodel2' ,
				wc_age = '$caryear' ,
				wc_trans = '$car_gear' ,
				wc_fual = '$carFual' ,
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
							wcj_price  		= '$wcj_price', 
							wcj_cost   		= '$wcj_cost', 
							wcj_gubun  		= '$wcj_gubun', 
							wcj_memo  		= '$wcj_memo', 
							wcj_regdate		= '$wcj_regdate', 
							wcj_type		= '$wcj_type', 

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
				wc_prog_etc					= '$wc_prog_etc' 
							
				";	


		$sql .= " WHERE wc_idx = '$wc_idx'";
		

		$result = mysql_query($sql, $connect) or die(mysql_error());
		if(!$result){
			msg("수정시 오류가 발생했습니다. 잠시후 다시 시도해주세요!");
		}
		
		$wc_go_first_price		= str_replace(",", "", $_POST['wc_go_first_price']);
		$wc_go_type			= $_POST['wc_go_type'];
		$wc_go_cost_type			= $_POST['wc_go_cost_type'];
		$wc_go_cost       = str_replace(",", "", $_POST['wc_go_cost']);
		$wc_go_cost1      = str_replace(",", "", $_POST['wc_go_cost1']);
		$wc_go_cost2      = str_replace(",", "", $_POST['wc_go_cost2']);
		$wc_go_cost3      = str_replace(",", "", $_POST['wc_go_cost3']);

		$wc_go_start_date			= $_POST['wc_go_start_date'];
		$wc_go_start_hh			= $_POST['wc_go_start_hh'];
		$wc_go_start_mm			= $_POST['wc_go_start_mm'];
		$wc_go_end_date			= $_POST['wc_go_end_date'];
		$wc_go_end_hh			= $_POST['wc_go_end_hh'];
		$wc_go_end_mm			= $_POST['wc_go_end_mm'];
		$wc_go_etc			= $_POST['wc_go_etc'];

		$sSQL = "update woojung_car2_go set ";
		$eSQL = " where  wc_go_idx  = '$wc_go_idx' and wcg_wcidx  = '$wc_idx' ";
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

		MsgMov("수정되었습니다.","sub02.php");
	}
	
?>