<?
include $_SERVER['DOCUMENT_ROOT']."/lib/common.php";
include $_SERVER['DOCUMENT_ROOT']."/lib/basicdb.class.php";
include $_SERVER['DOCUMENT_ROOT']."/lib/scriptAlert.class.php";

if($loginUsort != "admin" && $loginUsort != "admin1" && $loginUsort != "admin2" && $loginUsort != "admin3" && $loginUsort != "superadmin" && $loginUsort != "jisajang2"){
	movepage("/index.php", "관리자 로그인이 필요합니다.");
	MsgMov("관리자 로그인이 필요합니다.","/index.php");
	exit;
}

?>
<!DOCTYPE HTML>
<html>
<head>
<title></title>
<meta property="og:type" content="website">
<meta property="og:title" content="incaron">
<meta property="og:description" content="자동차경공매전문, 폐차,중고차,자동차부품">
<meta property="og:image" content="http://www.incaron.co.kr/myimage.jpg">
<meta property="og:url" content="http://www.incaron.co.kr/">
<meta name="robots" content="자동차경공매전문, 폐차,중고차,자동차부품">
<meta name="description" content="자동차경공매전문, 폐차,중고차,자동차부품">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<?
	$script = new scriptAlert();
	$db		= new basicdb();
	$connect = dbconn();
	
	
	if($_POST[mode] == 'bidprice'){
			
			// 수수료 정보를 불러온다.
			$infoQry = "SELECT * FROM 	js_webconfig  where no=1 ";
			$infoquery = $db->query($infoQry);
			$info = mysql_fetch_object($infoquery);


			//sale_percent  sale_percent1  sale_highprice  sale_lowprice  
			$salePercent2 = $info->charge02; //경매,공매
			$salePercent3 = $info->charge03; //경매,공매
			$salePercent4 = $info->charge04; //경매,공매
			$salePercent5 = $info->charge05; //경매,공매
			$salePercent1 = $info->charge06; // 도난경매, 도난 공매
			$salehighprice = $info->charge07; // 수수료 최고
			$salelowprice = $info->charge01; // 수수료 최저값
			$salePercent8 = $info->charge08; //공매(기타)

			$auct_idx_main = $_POST[auct_idx];


			for($i=0;$i<count($wcb_idx);$i++){

				$bidPrice = str_replace(",", "", $bid_price[$i]);
				if($gubun3 == "4" || $gubun3 == "5") { 
					$sPercent = $salePercent1/100;
				}else{
					if($bidPrice<=999000){
						$sPercent = $salePercent2/100;
					}else if($bidPrice<=9999999){
						$sPercent = $salePercent3/100;
					}else if($bidPrice<=29999999){
						$sPercent = $salePercent4/100;
					}else{
						$sPercent = $salePercent5/100;
					}
				}
				$succ_bid_sub_price=$bidPrice*$sPercent;
				if($succ_bid_sub_price<$salelowprice){
					$succ_bid_sub_price=$salelowprice;
				}
				if($succ_bid_sub_price>$salehighprice){
					$succ_bid_sub_price=$salehighprice;
				}
				$query = "update woojung_bid set bid_price = '$bidPrice' , succ_bid_sub_price='$succ_bid_sub_price', bid_sort_date = now() where idx='$wcb_idx[$i]'";
				//echo $query."<br>".$row[0]."<br>";
				@mysql_query($query);
				$bidPrice = 0;

				$query = "update woojung_bid set total_price=bid_price+bid_total_price+succ_bid_sub_price+succ_etc_total_price+sang_price+vat_price where idx='$wcb_idx[$i]' ";
				@mysql_query($query);

				$sql="select 
				auc_orderno,
				bid_price,
				succ_bid_sub_price,
				bid_total_price,
				total_price,
				sang_price,
				auct_key , 
				sale_type,
				succ_etc_total_price, 
				vat_price
				from woojung_bid where idx='".$wcb_idx[$i]."' and bid_sort='Y'";
				$que=mysql_query($sql);
				$row=mysql_fetch_array($que);
				//wc_accepted_priceA 낙찰금액 = bid_price = $row[1]
				//wc_accepted_priceB 부가세 = vat_price = $row[9]
				//wc_accepted_priceC 수수료 succ_bid_sub_price  = $row[2]
				//wc_accepted_priceD 대지급금(발생비용) bid_total_price = $row[3]
				//wc_accepted_priceE 상사이전비 sang_price = $row[5]
				//wc_accepted_priceF 서류대행비 succ_etc_total_price = $row[8]
				//wc_accepted_priceG 기타비용 
				if($row[0]){
                    if($row[sale_type] == '1'){
					   $priceBD = 0;
					}else{
					   $priceBD = $row[3];
					}
					$total_bid_pprice=$row[1]+$row[3]+$row[2];
					//bid_price(입찰금액)+bid_total_price(기타비용)+succ_bid_sub_price(낙찰수수료)
					$query_wc = "update woojung_car_go set 
					wc_accepted_priceA = '".$row[1]."',
					wc_accepted_priceB = '".$row[9]."',
					wc_accepted_priceC='".$row[2]."',
					wc_accepted_priceD='".$row[3]."',
					wc_accepted_priceE='".$row[5]."',
					wc_accepted_priceF='".$row[8]."'
					where wcg_wcidx='".$row[auct_key]."'";
					//echo $query_wc;
					@mysql_query($query_wc);
				}

			}
			
			echo "<script>opener.document.location.reload();</script>";
			MsgMov("입찰금액이 변경 되었습니다.","popup_02.php?auct_idx=".$auct_idx_main);

	}
	
	
	if($_POST[mode] == 'update')
	{
	
		$auct_idx_main = $_POST[auct_idx];
		
		$sql="select auc_orderno,bid_price from woojung_bid where auct_key='".$auct_idx_main."'";
		$que=mysql_query($sql);
		$row=mysql_fetch_row($que);
		
		if(!$row[0]){
			$nowdate = substr(date("Y"), -2);
			$cntQry = "select IFNULL(max( substring(wc_auction, 7, 12) ),0) + 1 as maxCnt from woojung_car where substring(wc_auction, 2, 2)='{$nowdate}'";
			$selRow_1 = mysql_query($cntQry);
			$selRow = mysql_fetch_array($selRow_1);
			$AllCnt = (int)$selRow[maxCnt];

			$AucOrderNum = 'N'.substr(date("Y"), -2).'-'.date("m").str_pad($AllCnt, 5, "0", STR_PAD_LEFT);
			$wherq_up=" ,auc_orderno='".$AucOrderNum."' ";
		}
		
		$sql_wc="select wc_accepted_priceA from woojung_car_go where wcg_wcidx='".$auct_idx_main."'";
		$que_wc=@mysql_query($sql_wc);
		$res_wc=mysql_fetch_row($que_wc);
		//if(!$res_wc[0]){
			$query_wc = "update woojung_car_go set wc_accepted_priceA = '".$row[1]."',wc_accepted_priceF='".$row[1]."',wc_tot_priceK='".$row[1]."' where wcg_wcidx='".$auct_idx_main."'";
			@mysql_query($query_wc);
		//}


		$query = "update woojung_bid set bid_sort = 'N' ,bid_sort_date = '' ".$wherq_up." where auct_key='$auct_idx_main'";
		@mysql_query($query);
		

		//$query2 = "update woojung_car set wc_auction = 'N' , wc_auction_date = ''  where wc_idx='$auct_idx_main'";		
		//@mysql_query($query2);
		

		//낙찰
		if(count($check) == 1 )
		{
		
			$date = date("Ymd",time());
			for($i=0;$i<count($check);$i++){

				$query = "update woojung_bid set bid_sort = 'Y' , bid_sort_date = now() where idx='$check[$i]'";
				//echo $query."<BR>";
				@mysql_query($query);	
				
				$query2 = "update woojung_car set wc_gubun4 = '4' , wc_auction_date = now() where wc_idx='$auct_idx_main'";
				@mysql_query($query2);	

				$sql_nak="select userId from woojung_bid where idx='$check[$i]' ";
				$que_nak=mysql_query($sql_nak);
				$row_nak=mysql_fetch_row($que_nak);
				$sql_car="select * from woojung_car where wc_idx='$auct_idx_main' ";
				$que_car=mysql_query($sql_car);
				$row_car=mysql_fetch_array($que_car);
				$sql_nak2="select pcs,name from woojung_member where userId='$row_nak[0]' ";
				$que_nak2=mysql_query($sql_nak2);
				$row_nak2=mysql_fetch_row($que_nak2);

$data_web=mysql_fetch_array(mysql_query("select * from js_webconfig where no=1"));
$data_sms=mysql_fetch_array(mysql_query("select * from sms where idx=1"));
$sms_b=str_replace("(낙찰자)",$row_nak2[1],$data_sms[auto1]);
$sms_b=str_replace("차량명)",$row_car[wc_model],$sms_b);
$sms_b=str_replace("(차량번호",$row_car[wc_no],$sms_b);
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
		}
		
		$sql="select 
		auc_orderno,
		bid_price,
		succ_bid_sub_price,
		bid_total_price,
		total_price,
		sang_price,
		auct_key , 
		sale_type,
		succ_etc_total_price, 
		vat_price
		from woojung_bid where auct_key='".$auct_idx_main."' and bid_sort='Y'";
		$que=mysql_query($sql);
		$row=mysql_fetch_row($que);
		//print_r( $row);


		//wc_accepted_priceA 낙찰금액 = bid_price = $row[1]
		//wc_accepted_priceB 부가세 = vat_price = $row[9]
		//wc_accepted_priceC 수수료 succ_bid_sub_price  = $row[2]
		//wc_accepted_priceD 대지급금(발생비용) 
		//wc_accepted_priceE 상사이전비 sang_price = $row[5]
		//wc_accepted_priceF 서류대행비 succ_etc_total_price = $row[8]
		//wc_accepted_priceG 기타비용 bid_total_price = $row[3]

		$sale_type = $row[7];
        //20221016 수정 
		if($row[7] == "1"){
		$total_bid_pprice=$row[1]+$row[2];
		 $priceD = 0 ;   //대지급금
		 $payMemo = $row_car[dambo3] . $row_car[bodam];
		}else{
		$total_bid_pprice=$row[1]+$row[3]+$row[2];
		 $priceD = $row[3] ;  //대지급금
		 $payMemo = "";
		}
		//bid_price(입찰금액)+bid_total_price(기타비용)+succ_bid_sub_price(낙찰수수료)

        //20221016 수정
		$query_wc = "update woojung_car_go set 
					wc_accepted_priceA = '".$row[1]."',
					wc_accepted_priceB = '".$row[9]."',
					wc_accepted_priceC='".$row[2]."',
					wc_accepted_priceD='".$row[3]."',
					wc_accepted_priceE='".$row[5]."',
					wc_accepted_priceF='".$row[8]."',
		wc_pay_memo1 = '" .$payMemo ."'   
		where wcg_wcidx='".$auct_idx_main."'";
		@mysql_query($query_wc)or die(mysql_error()); 
		//echo $query_wc;exit;
/*		
		MsgMov("낙찰이 변경 되었습니다.","auction_popup.php?auct_idx=".$auct_idx_main);
*/

		$qry = "select * from woojung_car as a 
				left join woojung_car_go as b on a.wc_idx = b.wcg_wcidx 		
				where a.wc_idx = '$auct_idx_main'  ";
		$row_car = mysql_fetch_array(mysql_query($qry));

		if($row_car[is_ss]=="Y"){

			if($row_car[nak2]=="N"){

				$query="update woojung_car set nak2='Y' where  wc_idx = '$auct_idx_main' ";
				mysql_query($query) or die(mysql_error()); 

				$aucSQL = "select  *  from woojung_bid where auct_key='$auct_idx_main' and bid_sort='Y' ";
				$arow = mysql_fetch_array(mysql_query($aucSQL));

				$aucSQL = "select  *  from woojung_member where userId='$arow[userId]' ";
				$arow2 = mysql_fetch_array(mysql_query($aucSQL));
			}

		}


		echo "<script>opener.document.location.reload();</script>";
		MsgMov("변경 되었습니다1.","popup_02.php?auct_idx=".$auct_idx_main);
	}


	if($_GET[wc_idx])
	{
		$idx = $_GET[idx];
		$query = "delete from  woojung_bid where idx='$wc_idx'";
		
		
		$auct_idx_main = $_GET[auct_idx];
		
		@mysql_query($query);	
		MsgMov("삭제 되었습니다.","popup_02.php?auct_idx=".$auct_idx_main);
	}
	



?>