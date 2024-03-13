<?
	include_once "../inc/header.php"; 
	$connect = dbconn();
	
	
	$dir = $_SERVER['DOCUMENT_ROOT'];
	include $dir.'/lib/scriptAlert.class.php';
	$script = new scriptAlert();
	
	if($mode == 'modify'){
		if(!$_POST['wc_idx'])$script->alert('idx값이 존재하지않습니다');
	}
?>
<iframe name="HiddenFrm_n" id="HiddenFrm_n" style="display:none;"></iframe>
<?
		
	if($mode == 'modify'){
	
	$qry = "select * from woojung_car 		
			where wc_idx = '$wc_idx'  ";
	$row = Row_string($qry);

	$qry2 = "select * from woojung_car_go 		
			where wcg_wcidx = '$wc_idx'  ";
	$row2 = Row_string($qry2);


	if($row[wc_gubun4]!=$_POST['gubun4']){
		$SQL_log = "select  * from woojung_car_log where wc_idx='$wc_idx' and ch_gubun4='6' ";
		$SQL_data = Row_string($SQL_log);
		if(!$SQL_data[idx]&&$_POST['gubun4']=="6"){
			$query="update woojung_car set wc_auction='".date("Y-m-d")."' where wc_idx='$wc_idx' ";
			mysql_query($query);
		}
		$query="insert into woojung_car_log set wc_idx='$wc_idx', user_id='$loginIdx', o_gubun4='$row[wc_gubun4]', ch_gubun4='$_POST[gubun4]', regdate=now() ";
		mysql_query($query);
	}

	if($row[wc_gubun4]=="4"&&$_POST['gubun4']=="2"){
		$query="update woojung_car set nak_ok='' where wc_idx='$wc_idx' ";
		mysql_query($query);
	}
	// 입금완료
	if($row[wc_gubun4]!="10"&&$_POST['gubun4']=="10"){
		$query="update woojung_car set im_date='".date("Y-m-d H:i:s")."' where wc_idx='$wc_idx' ";
		mysql_query($query)or die(mysql_error()); 

		$aucSQL = "select  idx, name, userId, auc_orderno  from woojung_bid where auct_key='$wc_idx' and bid_sort='Y' ";
		$arow = Row_string($aucSQL);

		$sql_nak2="select pcs,name from woojung_member where userId='$arow[userId]' ";
		$que_nak2=mysql_query($sql_nak2);
		$row_nak2=mysql_fetch_row($que_nak2);

		$data_web=mysql_fetch_array(mysql_query("select * from js_webconfig where no=1"));
		$data_sms=mysql_fetch_array(mysql_query("select * from sms where idx=1"));
		$sms_b=str_replace("(낙찰자)",$row_nak2[1],$data_sms[auto2]);
		$sms_b=str_replace("차량명",$row[wc_model2],$sms_b);
		$sms_b=str_replace("차량번호",$row[wc_no],$sms_b);
		$ssss=$data_web[sms_id].$row_nak2[0].$data_web[number].$sms_b;
?>

		<iframe name="HiddenFrm" style="display:none;"></iframe>
		<form name="sendsms" method='post' action='https://www.skysms.co.kr/apiSend/sendApi_UTF8.php' target="HiddenFrm">
			<input type='hidden' name='sUserid' value='<?=$data_web[sms_id]?>'>	<!-- 회원 UserId, 필수입력정보 9원문자 회원가입 시 발급-->
			<input type='hidden' name='authKey' value='<?=$data_web[shop_onlineno]?>'>	<!-- 회원 인증키, 필수입력정보 9원문자 회원가입,연동신청  후 발급 -->
			<input type='hidden' name='sendMsg' value='<?=$sms_b?>'>	<!-- 전송할 메세지 내용, 필수입력정보 -->
			<input type='hidden' name='destNum' value='<?=$row_nak2[0]?>'>	<!-- 받는분 휴대폰번호, 필수입력정보 대량전송의 경우 |로 구분하여 입력해주시기 바랍니다. 01000000000|01000000001|01000000002 -->
			<input type='hidden' name='callNum' value='<?=$data_sms[number]?>'>	<!-- 보내는분 전화번호, 필수입력정보 -->
			<input type='hidden' name='sMode' value='Real'>	<!-- 실제전송과 테스트전송을 구분하는 변수, 필수입력정보, 테스트전송(Test) or 실전송(Real) 기본값 : Test  -->
			<input type='hidden' name='sendDate' value=''>	<!-- 전송시간설정(예약), 선택옵션 입력정보, 값이없거나 지난 시간의 경우 즉시발송 형식을 지켜주시기 바랍니다.-->
			<input type='hidden' name='returnURL' value='http://<?=$_SERVER['SERVER_NAME']?>/inc/sms_count.php'>	<!-- 전송 후 이동할 사이트 URL, 선택옵션 입력정보, 결과코드,완료건수,실패건수,남은건수등을 받아볼수 있습니다. -->
			<input type='hidden' name='customVal' value=''>	<!-- 사용자정의 변수, 선택옵션 입력정보, 회원님께서 임의로 지정한 변수를 사용할수 있습니다. 변수명^값|변수명^값-->	
			<input type='hidden' name='sType' value='SMS'>	<!-- 짧은문자와 장문문자를 구분하는 변수, 선택입력정보, 짧은문자(SMS) or 장문문자(LMS) 기본값 : SMS -->
			<input type='hidden' name='sSubject' value=''>	<!-- sType의 값이 LMS일 경우만 사용, 장문문자의 제목, 최대길이 한글20자이내설정, 기본값:장문메세지 -->	
		</form>

		<SCRIPT LANGUAGE="JavaScript">
		document.sendsms.submit();
		</SCRIPT>
<?
	}

	if($row2[wc_go_end_hh]!=$_POST[wc_go_end_hh] ||$row2[wc_go_end_mm]!=$_POST[wc_go_end_mm] ||$row2[wc_go_end_date]!=$_POST[wc_go_end_date] ){
		$log_data=$row2[wc_go_end_date]." ".$row2[wc_go_end_hh].":".$row2[wc_go_end_mm];
		$log_data2=date("Y-m-d H:i");
		$query="insert into woojung_car_log2 set wc_idx='$wc_idx', user_id='$loginIdx', o_enddate='$log_data', ch_enddate='$log_data2', regdate=now() ";
		mysql_query($query);
	}

	if($row[im_date]!=$im_date){

		$aucSQL = "select  idx, name, userId, auc_orderno  from woojung_bid where auct_key='$wc_idx' and bid_sort='Y' ";
		$arow = Row_string($aucSQL);

?>

		<iframe name="HiddenFrm" style="display:none;"></iframe>
<form name="sendsms" method='post' action='https://www.skysms.co.kr/apiSend/sendApi_UTF8.php' target="HiddenFrm">
	<input type='hidden' name='sUserid' value='<?=$data_web[sms_id]?>'>	<!-- 회원 UserId, 필수입력정보 9원문자 회원가입 시 발급-->
	<input type='hidden' name='authKey' value='<?=$data_web[shop_onlineno]?>'>	<!-- 회원 인증키, 필수입력정보 9원문자 회원가입,연동신청  후 발급 -->
	<input type='hidden' name='sendMsg' value='<?=$sms_b?>'>	<!-- 전송할 메세지 내용, 필수입력정보 -->
	<input type='hidden' name='destNum' value='<?=$row_nak2[0]?>'>	<!-- 받는분 휴대폰번호, 필수입력정보 대량전송의 경우 |로 구분하여 입력해주시기 바랍니다. 01000000000|01000000001|01000000002 -->
	<input type='hidden' name='callNum' value='<?=$data_sms[number]?>'>	<!-- 보내는분 전화번호, 필수입력정보 -->
	<input type='hidden' name='sMode' value='Real'>	<!-- 실제전송과 테스트전송을 구분하는 변수, 필수입력정보, 테스트전송(Test) or 실전송(Real) 기본값 : Test  -->
	<input type='hidden' name='sendDate' value=''>	<!-- 전송시간설정(예약), 선택옵션 입력정보, 값이없거나 지난 시간의 경우 즉시발송 형식을 지켜주시기 바랍니다.-->
	<input type='hidden' name='returnURL' value='http://<?=$_SERVER['SERVER_NAME']?>/inc/sms_count.php'>	<!-- 전송 후 이동할 사이트 URL, 선택옵션 입력정보, 결과코드,완료건수,실패건수,남은건수등을 받아볼수 있습니다. -->
	<input type='hidden' name='customVal' value=''>	<!-- 사용자정의 변수, 선택옵션 입력정보, 회원님께서 임의로 지정한 변수를 사용할수 있습니다. 변수명^값|변수명^값-->	
	<input type='hidden' name='sType' value='SMS'>	<!-- 짧은문자와 장문문자를 구분하는 변수, 선택입력정보, 짧은문자(SMS) or 장문문자(LMS) 기본값 : SMS -->
	<input type='hidden' name='sSubject' value=''>	<!-- sType의 값이 LMS일 경우만 사용, 장문문자의 제목, 최대길이 한글20자이내설정, 기본값:장문메세지 -->	
</form>

		<SCRIPT LANGUAGE="JavaScript">
		document.sendsms.submit();
		</SCRIPT>

<?
	}


	$wc_idx		= $_POST['wc_idx'];
	$gubun1		= $_POST['gubun1'];
	$gubun2 	= $_POST['gubun2'];
	$gubun3		= $_POST['gubun3'];
	$gubun4 	= $_POST['gubun4'];

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
	
	//보관소연락처
	$wc_keep_tel1= $wc_keep_tel_1 ."-".  $wc_keep_tel_2 ."-".  $wc_keep_tel_3;

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
	$car_cate=$_POST['car_cate'];
	
	
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

	$areatel2 = $areatel2_1 ."-".  $areatel2_2 ."-".  $areatel2_3;

	$ArrcarOwner    = $_POST['ArrcarOwner'];	
	$wc_memo		= $_POST['wc_memo'];

	$aucidx			= $_POST['aucidx']; // 낙찰 고유번호 woojung_bid 
	$aucorderNo		= $_POST['aucorderNo']; // 낙찰 번호 woojung_bid 
	
	
	// 낙찰고유번호가 있는데 낙찰 번호가 없다면 새로 생성한다. 
	if($aucidx && (trim($aucorderNo) == "") && $gubun4 == "4" ){
			
			$nowdate = substr(date("Y"), -2);
			$cntQry = "select IFNULL(max( substring(wc_auction, 7, 12) ),0) + 1 as maxCnt from woojung_car where substring(wc_auction, 2, 2)='{$nowdate}'";
			$selRow = Row_string($cntQry);
			$AllCnt = (int)$selRow[maxCnt];

			$AucOrderNum = 'N'.substr(date("Y"), -2).'-'.date("m").str_pad($AllCnt, 5, "0", STR_PAD_LEFT);

			//$query2 = "update woojung_bid set auc_orderno='$AucOrderNum' where  idx='$aucidx' and auct_key='$wc_idx'";
			//@mysql_query($query2);	
						
	}



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
	$wc_prog_etc				= $_POST['wc_prog_etc'];

			// 감정평가금액
				$wcj_price  	= str_replace(",", "", $_POST['wcj_price']);
				$wcj_cost   	= str_replace(",", "", $_POST['wcj_cost']);
				$wcj_gubun  	= $_POST['wcj_gubun'];
				$wcj_memo		= $_POST['wcj_memo'];
				$wcj_regdate	= $_POST['wcj_regdate'];
				$wcj_type	= $_POST['wcj_type'];

	$wc_clerkTel = $wc_clerkTel1 ."-".  $wc_clerkTel2 ."-".  $wc_clerkTel3;
	$botel = $botel1 ."-".  $botel2 ."-".  $botel3;
	$dambo3 = $dambo3_1 ."/".  $dambo3_2 ."/".  $dambo3_3;
	//evalAmt 차량가액
	$evalAmt			= str_replace(",", "", $_POST['evalAmt']);

	
	if($admidx) $adminName = SaleAdmin('direct', $admidx);
		

		if($gubun1 == "2"){
			$gubun2 = "";
			$gubun3 = "";
			$gubun4 = "";
		}

		if($gubun4=="5"&&!$row[wcj_view]){
			$wcj_view=date("Y-m-d");
		}else{
			$wcj_view=$row[wcj_view];
		}

		$sql = "update woojung_car set ";

		if($aucidx && (trim($aucorderNo) == "") && ( $gubun4 == "4" || $gubun4 == "6" || $gubun4 == "7"  ) ){
			//$sql.= "wc_auction = '$AucOrderNum' ,	";
			//$sql.= "wc_auction_date  = now() ,	";	
		}

		$sql.= "wc_gubun1 = '$gubun1' ,
				wc_gubun2 = '$gubun2' ,
				wc_gubun3 = '$gubun3' ,
				wc_gubun4 = '$gubun4' ,
				evalAmt_type='$evalAmt_type', 
				wc_memo2='$wc_memo2', 
				wc_memo3='$wc_memo3', 
				md_date='$md_date', 
				wcj_view='$wcj_view', 
				pr_1='$pr_1', 
				pr_2='$pr_2', 
				pr_3='$pr_3', 
				pr_4='$pr_4', 
				vat = '$vat', 
				dambo1='$dambo1', 
				dambo2='$dambo2', 
				dambo3='$dambo3', 
				orm='$orm', 
				orm2='$orm2', 
				evalAmt='$evalAmt', 
				accd_etc='$accd_etc',
				made_dong='$made_dong', 
				trans_dong='$trans_dong', 
				fual_dong='$fual_dong', 
				in_name='$in_name', 
				end_3	= '$end_3',
				sang_type	= '$sang_type',
				calltype='$calltype', 
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
				wc_model = '$carmodel' ,
				wc_model2 = '$carmodel2' ,
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
		}else{

			$qry_new = "select * from woojung_car 		
					where wc_idx = '$wc_idx'  ";
			$row_new = Row_string($qry_new);
	
			// woojung_car_go 안에 업데이트 되야 한다.
			// 진행방식
				$wc_go_idx= $_POST['wc_go_idx'];
				$wc_go_first_price= str_replace(",", "", $_POST['wc_go_first_price']);
				$wc_go_type       = $_POST['wc_go_type'];
				$wc_go_cost_type  = $_POST['wc_go_cost_type'];
				$wc_go_cost       = str_replace(",", "", $_POST['wc_go_cost']);
				$wc_go_cost1      = str_replace(",", "", $_POST['wc_go_cost1']);
				$wc_go_cost2      = str_replace(",", "", $_POST['wc_go_cost2']);
				$wc_go_cost3      = str_replace(",", "", $_POST['wc_go_cost3']);				
				$wc_go_start_date = $_POST['wc_go_start_date'];
				$wc_go_start_hh   = $_POST['wc_go_start_hh'];
				$wc_go_start_mm   = $_POST['wc_go_start_mm'];
				$wc_go_end_date   = $_POST['wc_go_end_date'];
				$wc_go_end_hh     = $_POST['wc_go_end_hh'];
				$wc_go_end_mm     = $_POST['wc_go_end_mm'];
				$wc_go_etc        = $_POST['wc_go_etc'];

				//추가
				$wc_mi_chk        = $_POST['wc_mi_chk'];
			

			// 정산금액
				$wc_accepted_priceA   = str_replace("," , "", $_POST['wc_accepted_priceA'] );
				$wc_accepted_priceB   = str_replace("," , "", $_POST['wc_accepted_priceB'] );
				$wc_accepted_priceC   = str_replace("," , "", $_POST['wc_accepted_priceC'] );
				$wc_accepted_priceD   = str_replace("," , "", $_POST['wc_accepted_priceD'] );
				$wc_accepted_priceE   = str_replace("," , "", $_POST['wc_accepted_priceE'] );
				$wc_accepted_priceF   = str_replace("," , "", $_POST['wc_accepted_priceF'] );
				$wc_accepted_priceG   = str_replace("," , "", $_POST['wc_accepted_priceG'] );
				$wc_accepted_priceS   = str_replace("," , "", $_POST['wc_accepted_priceS'] );
				$wc_accepted_date     = $_POST['wc_accepted_date'];
				$wc_accepted_real_date= $_POST['wc_accepted_real_date'];				
			
				$wc_insure_priceG     = str_replace("," , "", $_POST['wc_insure_priceG'] );
				$wc_gale_priceH       = str_replace("," , "", $_POST['wc_gale_priceH'] );
				$wc_etc1_priceI       = str_replace("," , "", $_POST['wc_etc1_priceI'] );
				$wc_etc2_priceJ       = str_replace("," , "", $_POST['wc_etc2_priceJ'] );
				$wc_tot_priceK        = str_replace("," , "", $_POST['wc_tot_priceK'] );
				$wc_pay_date          = $_POST['wc_pay_date'];
				$wc_pay_bank          = $_POST['wc_pay_bank'];
				$wc_pay_bank_name     = $_POST['wc_pay_bank_name'];
				$wc_pay_bank_no       = $_POST['wc_pay_bank_no'];				
				$wc_pay_memo          = $_POST['wc_pay_memo'];

				$wc_pay_date1=$_POST['wc_pay_date1'];
				$wc_pay_bank1=$_POST['wc_pay_bank1'];
				$wc_pay_bank_no1=$_POST['wc_pay_bank_no1'];
				$wc_pay_bank_name1=$_POST['wc_pay_bank_name1'];
				$wc_pay_cost1=str_replace("," , "", $_POST['wc_pay_cost1'] );
				$wc_pay_memo1=$_POST['wc_pay_memo1'];
				$wc_pay_date2=$_POST['wc_pay_date2'];
				$wc_pay_bank2=$_POST['wc_pay_bank2'];
				$wc_pay_bank_no2=$_POST['wc_pay_bank_no2'];
				$wc_pay_bank_name2=$_POST['wc_pay_bank_name2'];
				$wc_pay_cost2=str_replace("," , "", $_POST['wc_pay_cost2'] );
				$wc_pay_memo2=$_POST['wc_pay_memo2'];
				$wc_pay_date3=$_POST['wc_pay_date3'];
				$wc_pay_bank3=$_POST['wc_pay_bank3'];
				$wc_pay_bank_no3=$_POST['wc_pay_bank_no3'];
				$wc_pay_bank_name3=$_POST['wc_pay_bank_name3'];
				$wc_pay_cost3=str_replace("," , "", $_POST['wc_pay_cost3'] );
				$wc_pay_memo3=$_POST['wc_pay_memo3'];
				$wc_pay_date4=$_POST['wc_pay_date4'];
				$wc_pay_bank4=$_POST['wc_pay_bank4'];
				$wc_pay_bank_no4=$_POST['wc_pay_bank_no4'];
				$wc_pay_bank_name4=$_POST['wc_pay_bank_name4'];
				$wc_pay_cost4=str_replace("," , "", $_POST['wc_pay_cost4'] );
				$wc_pay_memo4=$_POST['wc_pay_memo4'];
				$wc_pay_date5=$_POST['wc_pay_date5'];
				$wc_pay_bank5=$_POST['wc_pay_bank5'];
				$wc_pay_bank_no5=$_POST['wc_pay_bank_no5'];
				$wc_pay_bank_name5=$_POST['wc_pay_bank_name5'];
				$wc_pay_cost5=str_replace("," , "", $_POST['wc_pay_cost5'] );
				$wc_pay_memo5=$_POST['wc_pay_memo5'];

				$wc_pay_date6=$_POST['wc_pay_date6'];
				$wc_pay_bank6=$_POST['wc_pay_bank6'];
				$wc_pay_bank_no6=$_POST['wc_pay_bank_no6'];
				$wc_pay_bank_name6=$_POST['wc_pay_bank_name6'];
				$wc_pay_cost6=str_replace("," , "", $_POST['wc_pay_cost6'] );
				$wc_pay_memo6=$_POST['wc_pay_memo6'];
				$wc_pay_title5=$_POST['wc_pay_title5'];
				$wc_pay_title6=$_POST['wc_pay_title6'];
				$wc_pay_title7=$_POST['wc_pay_title7'];
				$wc_pay_cost7=str_replace("," , "", $_POST['wc_pay_cost7'] );
				$wc_pay_memo7=$_POST['wc_pay_memo7'];
				$wc_pay_date7=$_POST['wc_pay_date7'];



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
							wc_go_etc        	= '$wc_go_etc',

							wc_pay_date1='$wc_pay_date1', 
							wc_pay_bank1='$wc_pay_bank1', 
							wc_pay_bank_no1='$wc_pay_bank_no1', 
							wc_pay_bank_name1='$wc_pay_bank_name1', 
							wc_pay_cost1='$wc_pay_cost1', 
							wc_pay_memo1='$wc_pay_memo1', 
							wc_pay_date2='$wc_pay_date2', 
							wc_pay_bank2='$wc_pay_bank2', 
							wc_pay_bank_no2='$wc_pay_bank_no2', 
							wc_pay_bank_name2='$wc_pay_bank_name2', 
							wc_pay_cost2='$wc_pay_cost2', 
							wc_pay_memo2='$wc_pay_memo2', 
							wc_pay_date3='$wc_pay_date3', 
							wc_pay_bank3='$wc_pay_bank3', 
							wc_pay_bank_no3='$wc_pay_bank_no3', 
							wc_pay_bank_name3='$wc_pay_bank_name3', 
							wc_pay_cost3='$wc_pay_cost3', 
							wc_pay_memo3='$wc_pay_memo3', 

							wc_pay_date4='$wc_pay_date4', 
							wc_pay_bank4='$wc_pay_bank4', 
							wc_pay_bank_no4='$wc_pay_bank_no4', 
							wc_pay_bank_name4='$wc_pay_bank_name4', 
							wc_pay_cost4='$wc_pay_cost4', 
							wc_pay_memo4='$wc_pay_memo4', 
							wc_pay_date5='$wc_pay_date5', 
							wc_pay_bank5='$wc_pay_bank5', 
							wc_pay_bank_no5='$wc_pay_bank_no5', 
							wc_pay_bank_name5='$wc_pay_bank_name5', 
							wc_pay_cost5='$wc_pay_cost5', 
							wc_pay_memo5='$wc_pay_memo5', 

							wc_pay_date6='$wc_pay_date6', 
							wc_pay_bank6='$wc_pay_bank6', 
							wc_pay_bank_no6='$wc_pay_bank_no6', 
							wc_pay_bank_name6='$wc_pay_bank_name6', 
							wc_pay_cost6='$wc_pay_cost6', 
							wc_pay_memo6='$wc_pay_memo6', 
							wc_pay_title5='$wc_pay_title5', 
							wc_pay_title6='$wc_pay_title6', 

							wc_pay_title7='$wc_pay_title7', 
							wc_pay_cost7='$wc_pay_cost7', 
							wc_pay_memo7='$wc_pay_memo7', 
							wc_pay_date7='$wc_pay_date7', 

							wc_accepted_priceA   = '$wc_accepted_priceA',
							wc_accepted_priceB   = '$wc_accepted_priceB',
							wc_accepted_priceC   = '$wc_accepted_priceC',
							wc_accepted_priceD   = '$wc_accepted_priceD',
							wc_accepted_priceE   = '$wc_accepted_priceE',
							wc_accepted_priceF   = '$wc_accepted_priceF',
							wc_accepted_priceG   = '$wc_accepted_priceG',
							wc_accepted_priceS   = '$wc_accepted_priceS',
							wc_accepted_date     = '$wc_accepted_date',							
							wc_accepted_real_date= '$wc_accepted_real_date',						
							wc_insure_priceG     = '$wc_insure_priceG',
							wc_gale_priceH       = '$wc_gale_priceH',
							wc_etc1_priceI       = '$wc_etc1_priceI',
							wc_etc2_priceJ       = '$wc_etc2_priceJ',
							wc_tot_priceK        = '$wc_tot_priceK',
							wc_pay_date          = '$wc_pay_date',
							wc_pay_bank          = '$wc_pay_bank',
							wc_pay_bank_name     = '$wc_pay_bank_name',
							wc_pay_bank_no       = '$wc_pay_bank_no',
							wc_pay_memo          = '$wc_pay_memo',
							wc_mi_chk			 = '$wc_mi_chk'
							
												
						";
				 
				//echo "<pre>".$sSQL.$eSQL."</pre>";
				//exit;

				$sSQL = $sSQL.$eSQL;

				$result = mysql_query($sSQL, $connect) or die(mysql_error());
				if(!$result){
					msg("수정시 오류가 발생했습니다. 잠시후 다시 시도해주세요!");
				}

		}


		//MsgMov("자료가 수정되었습니다.","view.php?wc_idx=$wc_idx");
		MsgMov("수정되었습니다.","/manage/Sale02/view.php?wc_idx=$wc_idx&$href");
	}
	
?>