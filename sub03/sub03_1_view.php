<?
include "../inc/header.php"; 

$query = mysql_query("select * from woojung_member where userId = '$loginId' limit 1");
$member_new = mysql_fetch_array($query);

if(!$user_level && (!$loginId || $loginUsort=="indi") ){
	echo "<script>alert('로그인후 사용 가능합니다.');location.href='/login/login.php';</script>";
}
if($loginUsort=="indi" || $loginUsort=="company1" || $loginUsort=="company2" || $loginUsort=="premium1" || $loginUsort=="premium2" || $loginUsort=="premium3" || $loginUsort=="premium4") {
	echo "<script>alert('사용 권한이 없습니다.');history.back();</script>";
	exit;
}
 
?> 

<?
$sql="select * from woojung_view where user_id='$loginId' ";
$result=mysql_query($sql);
$data=mysql_fetch_array($result);
if($data[idx]){
	$query="update woojung_view set user_id='$loginId',car_no='$idx',regdate=now() where idx='$data[idx]' ";
	mysql_query($query) or die(mysql_error()); 
}else{
	$query="insert into woojung_view set user_id='$loginId',car_no='$idx',regdate=now() ";
	mysql_query($query) or die(mysql_error()); 
}


$connect = dbconn(); 

$Qry = "SELECT * FROM 	woojung_car  as a
		left join woojung_member as b  on a.wc_mem_idx = b.idx 
		left join woojung_car_go as c on a.wc_idx = c.wcg_wcidx	
		WHERE wc_idx=$idx ";

$query = $db->query($Qry);
$row = mysql_fetch_object($query);

	$query = mysql_query("select * from woojung_member where userId = '$loginId' limit 1");
	$member_new = mysql_fetch_array($query);
	if($row->wc_go_type=="1"){
		if($member_new[power]=="1"||$member_new[power]=="3"){
			$onc="auctionView('$row->wc_idx');";
		}else{
			echo "<script>alert('입찰권한이 없습니다. 운영자에게 문의하세요');history.back();</script>";
			exit;
		}
	}else if($row->wc_go_type=="2"){
		if($member_new[power]=="2"||$member_new[power]=="3"){
			$onc="auctionView('$row->wc_idx');";
		}else{
			echo "<script>alert('입찰권한이 없습니다. 운영자에게 문의하세요');history.back();</script>";
			exit;
		}
	}else if($row->wc_go_type=="3"){
		$onc="auctionView('$row->wc_idx');";
	}

$site_u = mysql_fetch_array(mysql_query("select * from recruit as a left join woojung_member as b on a.code=b.code left join woojung_car as c on b.userId=c.wc_mem_id where c.wc_idx='".$row->wc_idx."' "));

if($row->wc_gubun2!="5"){
	$MaxQuery = $db->query("select * from woojung_bid  where auct_idx = '$row->wc_orderno' order by bid_price desc ");
}else{
	$MaxQuery = $db->query("select * from woojung_bid  where auct_idx = '$row->wc_orderno' order by bid_price asc ");
}
$selMax = mysql_fetch_array($MaxQuery);

$auctionTrue = $row->wc_auction; //낙찰유무

$param_auct_idx = $row->wc_idx;
$sale_type		= $row->sale_type;
$end_time		= $row->wc_go_end_date;
$year			= cutStr($row->wc_go_end_date,0,4);
$month			= cutStr($row->wc_go_end_date,5,2);
$day			= cutStr($row->wc_go_end_date,8,2);
$hour			= $row->wc_go_end_hh;
$min			= $row->wc_go_end_mm;
$last_end_date2 = $year.'년 '.$month.'월 '.$day.'일  '.$hour.'시 '.$min.'분';

$wc_car_img1 = explode("/",$row->wc_img_1);
$defaultFile = $site_u[home_url]."/data/".$wc_car_img1[0]; 

$date1=mktime($hour,$min,'00',$month,$day,$year); 
//$date1=mktime(18,1,59,9,4,2009); 
//정의 int mktime(int hour, int minute, int second, int month, int day, int year) 
$date2=time(); //mktime은 초로 계산된 시간 125125212초 이런식 
//echo "최종수정일:".$row->wc_regdate;

$total_secs=$date1 - $date2; 
//$total_secs=abs($date1 - $date2); 
$diff_in_days = floor($total_secs / 86400); 
$rest_hours = $total_secs % 86400;  

$diff_in_hours = floor($rest_hours / 3600); 
$rest_mins = $rest_hours % 3600; 

$diff_in_mins = floor($rest_mins / 60); 
$diff_in_secs = floor($rest_mins % 60);  

$bidQry = "SELECT bid_price,total_price  FROM woojung_bid where auct_key=$idx and userId='$loginId' and sale_type='2' ";
$bquery = $db->query($bidQry);
$brow = mysql_fetch_object($bquery);
$bid_price1		= number($brow->bid_price);
$bid_price1_total		= number($brow->total_price);

$bidQry = "SELECT bid_price,total_price  FROM woojung_bid where auct_key=$idx and userId='$loginId' and sale_type='1' ";
$bquery = $db->query($bidQry);
$brow = mysql_fetch_object($bquery);
$bid_price2		= number($brow->bid_price); 
$bid_price2_total		= number($brow->total_price); 

// 경매 버튼 제어 
$now_date = date("YmdHi");

$start_time		= $row->wc_go_start_date;
$syear			= cutStr($start_time,0,4);
$smonth			= cutStr($start_time,5,2);
$sday			= cutStr($start_time,8,2);
$shour			= $row->wc_go_start_hh;
$smin			= $row->wc_go_start_mm;
$auctionStartDate = $syear.$smonth.$sday.$shour.$smin;
$auctionEndDate = $year.$month.$day.$hour.$min; 

if($now_date < $auctionStartDate){ // 경공매 진행 전
	$btn = "";
}elseif($now_date >= $auctionStartDate && $now_date <= $auctionEndDate){ // 경공매 진행
	$btn = " <img src=\"img/bt01.gif\" border=\"0\" name=\"btnAuction\" id=\"btnAuction\" onClick=\"MM_openBrWindow('../inc/bid.php?idx=$idx','auctWin','width=900,height=720')\" /> ";
}else{ // 경공매 종료
	$btn = "";
}


$start_date = $syear.$smonth.$sday.$shour.$smin;
$end_time		= $row->wc_go_end_date;
$year			= cutStr($end_time,0,4);
$month			= cutStr($end_time,5,2);
$day			= cutStr($end_time,8,2);
$hour			= $row->wc_go_end_hh;
$min			= $row->wc_go_end_mm;
$last_end_date = $year.$month.$day.$hour.$min;

$rcpt_strt_dt = $now_date;
$car_auction_end_dt = $last_end_date;

$cunserting_amt = 0;


$auction_strt_amt = $row->wc_go_first_price; //경매시작가
$gubun3				= $row->wc_gubun3; // 경매1, 공매2, 도난경매3, 도난공매4
 
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


if($gubun3 == "4" || $gubun3 == "5") { // 도난경, 공매일경우
	$sPercent = $salePercent1/100;
}else{ // 그외 모두 
	$sPercent = $salePercent/100;	
	
} 

if($row->wc_go_cost_type == "2"){ // 낙찰자 부담일 경우만 금액 적어준다
	if(!$row->wc_go_cost) $row->wc_go_cost=0;
	$wc_go_cost = $row->wc_go_cost;
	$total_amt = $row->wc_go_cost;
}else{
	$wc_go_cost = 0;
	$total_amt = 0;
}

if($row->wc_gubun2=="2"){$kk="보험경공매";}
if($row->wc_gubun2=="3"){$kk="스페셜매물";}
if($row->wc_gubun2=="4"){$kk="일반경공매";}

?>

<div class="sub-visual">
	<div class="sub-text">
		<p class="catch-phrase">
			<?=$kk?>
		</p>
		<p class="description-text">
			공정하고 투명하며 신속, 정확한 정보를 제공합니다.
		</p>
	</div>
</div>

<div class="car-info-view">

	<!-- location -->
	<div class="location-wrap">
		<a href="">홈</a>&nbsp;&gt;&nbsp;
		<a href=""><?=$kk?></a>
	</div>
	<!-- //location -->
	<!-- 차량정보요약 -->
<script type="text/javascript">
//sample.php에서 출력된 내용을 어떻게 처리할것인지? 
function printData(txt) { 
    document.all.price.value = req.responseText; 
    
} 

function zzim(){
	var f = document.signform;
	f.target="hiddenframe";
	f.action="/inc/myzzim.php";
	f.submit();
}
 </script>
 
<script type="text/javascript" src="/common/js/form.js"></script>
<?if($row->sang_type=="1"){?>
<script type="text/javascript">
function bidCount() {
	var f = document.auctForm;
	var seo=0;
	if(f.goSale[0].checked == false && f.goSale[1].checked == false){
		alert("입찰유형을 선택해 주세요");
		f.bid_price.value = "";
		return;
	}

	if(f.bid_price.value)if(!isNumeric(f.bid_price))return;
<? if($row->vat=="2"){ ?>
	var vatp=0.1;
<? }else{ ?>
	var vatp=0;
<? } ?>
	
	if(f.bid_price.value) {		 
		if(f.bid_price.value>=1 && f.bid_price.value<500){
			f.sang_price.value=addComma('<?=$info->sang1?>');
			sang="<?=$info->sang1?>";
		}else if(f.bid_price.value>=500 && f.bid_price.value<1000){
			f.sang_price.value=addComma('<?=$info->sang2?>');
			sang="<?=$info->sang2?>";
		}else if(f.bid_price.value>=1000 && f.bid_price.value<2000){
			f.sang_price.value=addComma('<?=$info->sang3?>');
			sang="<?=$info->sang3?>";
		}else if(f.bid_price.value>=2000 && f.bid_price.value<3000){
			f.sang_price.value=addComma('<?=$info->sang4?>');
			sang="<?=$info->sang4?>";
		}else if(f.bid_price.value>=3000){
			f.sang_price.value=addComma('<?=$info->sang5?>');
			sang="<?=$info->sang5?>";
		}else{
			f.sang_price.value="";
			sang=0;
		}

		var mylen=f.goSale.length;
		if(mylen=="undefined") mylen=1;
		for(i=0;i<mylen;i++)
		{
			if(f.goSale[i].checked==true) gsv=f.goSale[i].value;
		}
		if(gsv=="1"){
				f.sang_price.value="";
				sang=0;
				seo="<?=$salePercent8?>";
				var vatp=0.1;
		}else if(gsv=="2"){
//				var vatp=0;
		}

		f.seo_price.value=addComma(seo);
		var price1 = f.bid_price.value * 10000;	
		var sub_bid_price = auction_per(price1);
		//var succ_bid_sub_p = document.getElementById('succ_bid_sub_price').value;

		var result = parseInt(<?=$total_amt?>) + parseInt(<?=$cunserting_amt?>) + parseInt(sub_bid_price) + parseInt(price1) + parseInt(sang) + parseInt(seo) ;
		
	
	} else {
		var price1 = 0;
		var result = 0;
	}
	vat=vatp*price1;
	result += parseInt(vat);
	f.vat_bid_price.value = addComma(vat);	
	f.c_bid_price.value = addComma(price1);
	f.last_bid_price.value = addComma(result);
	document.getElementById('last_bid_price_html').innerHTML=f.last_bid_price.value;
}
 </script>
<?}else{?>
<script type="text/javascript">
function bidCount() {
	var f = document.auctForm;
	var seo=0;
	if(f.goSale[0].checked == false && f.goSale[1].checked == false){
		alert("입찰유형을 선택해 주세요");
		f.bid_price.value = "";
		return;
	}

	if(f.bid_price.value)if(!isNumeric(f.bid_price))return;
<? if($row->vat=="2"){ ?>
	var vatp=0.1;
<? }else{ ?>
	var vatp=0;
<? } ?>
	
	if(f.bid_price.value) {		

		var mylen=f.goSale.length;
		if(mylen=="undefined") mylen=1;
		for(i=0;i<mylen;i++)
		{
			if(f.goSale[i].checked==true) gsv=f.goSale[i].value;
		}
		if(gsv=="1"){
				seo="<?=$salePercent8?>";
				var vatp=0.1;
		}else if(gsv=="2"){
//				var vatp=0;
		}
			f.sang_price.value="";
			sang=0;
		
		f.seo_price.value=addComma(seo);
		var price1 = f.bid_price.value * 10000;	
		var sub_bid_price = auction_per(price1);
		//var succ_bid_sub_p = document.getElementById('succ_bid_sub_price').value;

		var result = parseInt(<?=$total_amt?>) + parseInt(<?=$cunserting_amt?>) + parseInt(sub_bid_price) + parseInt(price1) + parseInt(sang) + parseInt(seo) ;
		
	
	} else {
		var price1 = 0;
		var result = 0;
	}
	vat=vatp*price1;
	result += parseInt(vat);
	f.vat_bid_price.value = addComma(vat);	
	f.c_bid_price.value = addComma(price1);
	f.last_bid_price.value = addComma(result);
	document.getElementById('last_bid_price_html').innerHTML=f.last_bid_price.value;
}
</script>
<?}?>
<script type="text/javascript">
function addComma (str)
{
 var input_str = str.toString();

 if (input_str == '') return false;
 input_str = parseInt(input_str.replace(/[^0-9]/g, '')).toString();
 if (isNaN(input_str)) { return false; }

 var sliceChar = ',';
 var step = 3;
 var step_increment = -1;
 var tmp  = '';
 var retval = '';
 var str_len = input_str.length;

 for (var i=str_len; i>=0; i--)
 {
  tmp = input_str.charAt(i);
  if (tmp == sliceChar) continue;
  if (step_increment%step == 0 && step_increment != 0) retval = tmp + sliceChar + retval;
  else retval = tmp + retval;
  step_increment++;
 }

 return retval;
}
 

/////////////////////////////////////////////////////
/////////////////////////경매요율 설정 //////////////
/////////////////////////////////////////////////////
function auction_per(price) {
	
	var min_price = "<?=$salelowprice?>";
	var max_price = "<?=$salehighprice?>";
	var returnsum = 0;
	<? if($gubun3 == "4" || $gubun3 == "5") { ?>
		var salePecrcent = "<?=$salePercent1/100?>";
	<? }else{ ?>
	if(price<=999000){
		var salePecrcent = "<?=$salePercent2/100?>";
	}else if(price<=9999999){
		var salePecrcent = "<?=$salePercent3/100?>";
	}else if(price<=29999999){
		var salePecrcent = "<?=$salePercent4/100?>";
	}else{
		var salePecrcent = "<?=$salePercent5/100?>";
	}
	<? } ?>
		
	var sum = salePecrcent * price;
	sum=Math.floor(sum/10)*10;
	
	<? if($gubun3 == "7" ) { ?>
	sum="<?=$salePercent8?>";
	<? } ?>

	if("<?=$gubun3?>"=="7"){
		document.all.succ_bid_sub_price.value = addComma(sum);
		returnsum = sum;
	}else{
		if(sum <= <?=$salelowprice?> )
		{
		
			returnsum = '<?=$salelowprice?>';
			document.all.succ_bid_sub_price.value = addComma('<?=$salelowprice?>');
			
		}
		else
		{
			if(  sum >= <?=$salehighprice?> ){ // 최고값보다크다면
				sum = <?=$salehighprice?>;
				
				document.all.succ_bid_sub_price.value = addComma(<?=$salehighprice?>);
				returnsum = sum;
				
			}else{
				document.all.succ_bid_sub_price.value = addComma(sum);
				returnsum = sum;
				
			}
		}
	}
	
	
	return returnsum;
}

function rs(str)
{
   
    str = str.replace(/,/g, "");
    return str;
}


function bid_submit() {

	var f = document.auctForm;
	
	if(f.goSale[0].checked == false && f.goSale[1].checked == false){
		alert("매각유형을 선택해 주세요");
		f.bid_price.value = "";
		return;
	}
	if(f.agree.checked!=true){
		alert("입찰약관에 동의하셔야 입찰이 됩니다.");
		return false;
	}
 
<?if($row->wc_gubun3=="2" || $row->wc_gubun3=="4"){?>									

	var strt_amt_j	= '<?=$auction_strt_amt?>';
	var bid_c = rs(f.c_bid_price.value);
	var bid_p = bid_c.replace(/^\$|,/g,"");
	if(parseInt(strt_amt_j) > parseInt(bid_p)  ){
		var strt_amt	= '<?=number_format($auction_strt_amt)?>';
		alert("입찰금액이 경매시작가 ("+strt_amt	+"원) 보다 작을수 없습니다.");
		return false;
	}
<?}?>

	var but = document.getElementById('bidButton').disabled;
	if(!validate(f)) {
		return false;
		but = false;
	}
	return true;
}
function popup()
{
	if(<?=$rcpt_strt_dt?> > <?=$car_auction_end_dt?>)
	{

	alert('입찰이 종료되었습니다.');
	self.close();
	}
	
}

function zzim(idx){
	var f = document.signform;
	f.no.value=idx;
	f.target="hiddenframe";
	f.action="/inc/myzzim.php";
	f.submit();
} 
function zzim2(idx){
	var f = document.signform;
	f.no.value=idx;
	f.target="hiddenframe";
	f.action="/inc/myzzimDel.php";
	f.submit();
} 
 </script>
 <style type="text/css"> 
input[type="text"].counter{
	background: transparent;
	font-family: "SUIT","Malgun Gothic",sans-serif;
	font-size: 12px;
	width: 100%;
	text-align: center;
}
</style>
	<div class="car-info-summary aside">
		<div class="summary-header">
			<div class="car-name">
                        <?if($row->wc_model) echo $row->wc_model;?>
                        <?if($row->wc_model2) echo $row->wc_model2;?>
			</div>
			<div class="summary-info">
				<span class="car-years"><?if($row->wc_age)?>
                            <?=substr($row->wc_age,0,4)?>년
                            <?=substr($row->wc_age,4,2)?>월</span>
				<span class="transmission-type"><?=$row->wc_mem_name=="동부"?$row->trans_dong:$row->wc_trans ?></span> 
				<span class="fuel-type"><?=$row->wc_mem_name=="동부"?$row->fual_dong:$row->wc_fual ?></span>
				<span class="engine-size"><?=number($row->wc_cc)?> cc</span>
				<span class="distance"><?=number($row->wc_mileage)  ?> km</span>
			</div>
		</div>
		<div class="summary-body">
			<div class="body-topper">
				<div class="prefix">
					<?=$row->wc_orderno?>
				</div>
				<div class="center">
					</div>
					<div class="suffix">
					<span class="damage-type"><?=$row->evalAmt_type?></span>
					<span class="bid-type">
					<?  	WriteArrHTML('select', 'gubun3', ${"Arrgubun3_".$row->wc_gubun2}, $row->wc_gubun3, '', '' , 'direct', '');  	?>
					<? //WriteArrHTML('radio', 'Arrgubun2', $ArrgoSale, $row->wc_go_type, '', '' , 'direct', '');?></span>
                    <?
					$sql="select * from car_zzim where no='".$row->wc_idx."' and userid='".$loginId."'";
					$que=mysql_query($sql);
					$rowZim=mysql_fetch_array($que);
					if(!$rowZim[idx]){ 
					?>
					<a href="javascript:zzim('<?=$row->wc_idx?>')"">
						<span class="icon-heart"></span> 관심차량
					</a>
					<?}else{?>
				     <a href="javascript:zzim2('<?=$row->wc_idx?>')"" class="on">
						<span class="icon-heart"></span> 관심차량
					</a>
						<i class="ico_carheart on" onclick="zzim2('<?=$row->wc_idx?>')"></i>
					<?} ?>
					
				</div>
			</div>

			<div class="detail-info-table bar-gray">
				<ul>
					<li>
						<div class="label">제조ㅣ모델</div>
						<div class="data"><?
						if($row->wc_mem_name=="동부"){
							echo $row->made_dong;
						}else{
							$sql="select * from cate2 where idx='$row->wc_made' ";
							$result_made=mysql_query($sql);
							$data_made=mysql_fetch_array($result_made);
							echo $data_made[name];
						}
						?> ㅣ  <?if($row->wc_model) echo $row->wc_model;?> <?if($row->wc_model2) echo $row->wc_model2;?></div>
					</li>
					<li>
						<div class="label">마감시간</div>
						<div class="data"><?=$last_end_date2?></div>
					</li>
					<li>
						<div class="label">남은시간</div>
						<div class="data"><span id="counter<?=$num?>" style="color:#FF0000;"></span>
                        <input name="end_maker" type="hidden" class="counter" id="end_maker" style='border-width:0; border-color:#7C7A84;font-weight:bold; border-style:solid;color:#FF0000' size="1" readonly="readonly" /></div>
                    <script language="JavaScript" type="text/javascript"> 
					<!-- 
					        // 자바스크립트 코드 
					function Timer(diff_in_secs, diff_in_mins, diff_in_hours, diff_in_days,mm,dd,yy) { 
					        //남은시간 실시간으로 보여지는 부분 
					        day=diff_in_days;    //일단 남은 날짜와 시간을 받아온다음에 timer1을 호출한다 
					        hour=diff_in_hours; 
					        min=diff_in_mins; 
					        sec=diff_in_secs; 
							dt = new Date();
					        nyy=dt.getFullYear();
					        nmm=dt.getMonth()+1;
							ndd=dt.getDate();
							if(yy==nyy&&mm==nmm&&dd==ndd){
								tda=1;
							}else{
								tda=0;
							}

					        if(day >= 0 )
					      	{
							 Timer1(); 								
					        } 
					        
					        else
					        { 
							document.getElementById('counter').innerHTML = '입찰이 마감되었습니다.';  
					        }
 
 
					} 
					function Timer1() { 
					//if(tda == 1 )document.all.end_maker.value = '[금일마감]';  					        	 	
					sec=sec-1;        //1초식 감소 하다가 -1이되면 1분을 뺀다은 초를 59초로 초기화 
        				if(sec == -1) { 
				        sec = 59; 
				        min = min-1; 
				        } 
					if(min == -1) {        //1분씩 감소 하다가 -1이되면 1시간을 뺀다음 분을 59분으로 초기화 
					        min=59; 
					        hour = hour - 1; 
					        } 
					if(hour == -1) {  //1시간씩 감소 하다가 -1이되면 1일을 뺀다음 날짜 초기화 
					        hour = 23; 
					        day = day - 1; 
					        } 
					if(sec == 0 && min == 0 && hour == 0 && day == 0) { 
					        //일:0 시간:0 분:0 초:0 이라면 종료메세지 출력 
					    	document.getElementById('counter').innerHTML = '입찰이 마감되었습니다.';   
							document.getElementById('sb_img').style.display = "none";
							document.all.end_maker.value = '';
					    	clearTimeout('Timer1()');
					        return; 
					        } 
					if(day < 0) { 
					        //일:0 시간:0 분:0 초:0 이라면 종료메세지 출력 
					    	document.getElementById('counter').innerHTML = '입찰이 마감되었습니다.';   
							document.getElementById('sb_img').style.display = "none";
							document.all.end_maker.value = '';
					    	clearTimeout('Timer1()');
					        return; 
					        } 
						document.all.counter.innerHTML = day + '일 ' + hour + '시간 ' + min + '분 ' + sec + '초 '; 
				        //1초당 한번씩 timer1()을 호출하여 실행 
						window.setTimeout('Timer1()',1000); 
					} 
					
					//window.attachEvent( 'onload', Timer(42,35,11,0));
					//document.onload=Timer(42,35,11,0);
					
					
					document.onload=Timer(<?=$diff_in_secs?>,<?=$diff_in_mins?>,<?=$diff_in_hours?>,<?=$diff_in_days?>,<?=$month?>,<?=$day?>,<?=$year?>);
					
					//--> 
					</script>
					</li>
<?if($row->wc_gubun3=="2" || $row->wc_gubun3=="4"){?>	
					<li>
						<div class="label">경매시작가</div>
						<div class="data"><?=number($row->wc_go_first_price)?><span class="unit">원</span></div>
					</li> 
					<li>
						<div class="label"><?if( $row->wc_gubun2=="5"){echo "최저입찰가";}else{echo "최고입찰가";}?></div>
						<div class="data"><?=number_format($selMax[bid_price])?><span class="unit">원</span></div>
					</li>
<?}?>
					<li>
						<div class="label">나의 <em class="fc-emphas">폐차</em>입찰가</div>
						<div class="data"><?=$bid_price2?><span class="unit">원</span> / <span style="color:red"><?=$bid_price2_total?></span> 원</div>
					</li>
					<li>
						<div class="label">나의 <em class="fc-emphas">이전</em>입찰가</div>
						<div class="data"><?=$bid_price1?><span class="unit">원</span> / <span style="color:red"><?=$bid_price1_total?></span> 원</div>
					</li>
				</ul>
			</div>

			<p class="notice-small">입금금액은 <em class="fc-emphas">만원</em>단위입니다 (예 <em class="fc-emphas">3,500,000</em>원인경우 <span class="fw-bold fc-primary">350</span> 입력)</p>

<?if($row->wc_gubun2!="5"){?>
	<?if($row->wc_gubun3=="2" || $row->wc_gubun3=="4"){?>									
                            <form name="auctForm" method="post" action="/ssfire/bid_regist.php" onsubmit="return bid_submit()" target="HiddenFrm">
	<?}else{?>
                            <form name="auctForm" method="post" action="/ssfire/bid_regist2.php" onsubmit="return bid_submit()" target="HiddenFrm">
	<?}?>
<?}else{?>
	<?if($row->wc_gubun3=="2" || $row->wc_gubun3=="4"){?>									
                            <form name="auctForm" method="post" action="/ssfire/bid_regist_r.php" onsubmit="return bid_submit()" target="HiddenFrm">
	<?}else{?>
                            <form name="auctForm" method="post" action="/ssfire/bid_regist_r2.php" onsubmit="return bid_submit()" target="HiddenFrm">
	<?}?>
<?}?>
                              <input type='hidden' name='idx' value='<?=$_GET['idx']?>' />
                              <input type='hidden' name='mode' value='regist' />
			<div class="price-list bar-gray">
				<ul>
					<li>
						<div class="label">입찰유형</div>
						<div class="data flex-type">

					<?
					//echo $member_new[power];
					if($row->wc_go_type == "1" ){
						if($member_new[power]=="2"){
							echo "&nbsp;&nbsp;&nbsp;&nbsp;<input type='radio' name='goSale' value='1' readonly onclick='this.checked=false;alert(\"명의이전 권한만 있습니다.\");'> 폐차";
						}else{
							echo "<input type='radio' name='goSale' checked value='".$row->wc_go_type."'><input type='radio' name='goSale' id='gu' value='' style='display:none;'>";
							WriteArrHTML('radio', 'goSale', $ArrgoSale, $row->wc_go_type, '', '' , 'direct', '');
						}
					}elseif($row->wc_go_type == "2" ){
						if($member_new[power]=="1"){
							echo "<input type='radio' name='goSale' id='gu' value='2' onclick='this.checked=false;alert(\"폐차 권한만 있습니다.\");'> 명의이전";
						}else{
							echo "<input type='radio' name='goSale' checked value='".$row->wc_go_type."'><input type='radio' name='goSale' id='gu' value='' style='display:none;'>";
							WriteArrHTML('radio', 'goSale', $ArrgoSale, $row->wc_go_type, '', '' , 'direct', '');
						}
					}elseif($row->wc_go_type == "3"){
						if($member_new[power]=="1"){
							echo "<input type='radio' name='goSale' id='gu' value='2' onclick='this.checked=false;alert(\"폐차 권한만 있습니다.\");'> 명의이전";
							echo "&nbsp;&nbsp;&nbsp;&nbsp;<input type='radio' name='goSale' value='1' onclick='bidCount()'> 폐차";
						}else if($member_new[power]=="2"){
							echo "<input type='radio' name='goSale' id='gu' value='2' onclick='bidCount()'> 명의이전";
							echo "&nbsp;&nbsp;&nbsp;&nbsp;<input type='radio' name='goSale' value='1' readonly onclick='this.checked=false;alert(\"명의이전 권한만 있습니다.\");'> 폐차";
						}else if($member_new[power]=="3"){
							echo "<input type='radio' name='goSale' id='gu' value='2' onclick='bidCount()'> 명의이전";
							echo "&nbsp;&nbsp;&nbsp;&nbsp;<input type='radio' name='goSale' value='1' onclick='bidCount()'> 폐차";
						}
					}
					?> 
						</div>
					</li>
					<li>
						<div class="label">입찰금액</div>
						<div class="data has-input">
							<input type="text" class="form_control" name="bid_price" id="bid_price" maxlength="9" onkeyup="bidCount()" required />
							<span class="unit">만원</span>
							<input name="c_bid_price"  id="c_bid_price" type="hidden" readonly=""/>
						</div>
					</li>
					<li>
						<div class="label">부가세</div>
						<div class="data"><input type="text" class="form_control" name="vat_bid_price" id="vat_bid_price" maxlength="9" readonly /><span class="unit">원</span></div>
					</li>
					<li>
						<div class="label">수수료</div>
						<div class="data"><input type="text" class="form_control" name="succ_bid_sub_price" id="succ_bid_sub_price" maxlength="9" readonly /><span class="unit">원</span></div>
					</li>
					<li>
						<div class="label">견인,보관외</div>
						<div class="data"><input type="text" class="form_control" name="bid_total_price" id="bid_total_price" maxlength="9" readonly value="<?=number($wc_go_cost)?>" /><span class="unit">원</span></div>
					</li>
					<li>
						<div class="label">상사이전비</div>
						<div class="data"><input type="text" class="form_control" name="sang_price" id="" readonly /><span class="unit">원</span></div>
					</li>
					<li>
						<div class="label">서류대행비</div>
						<div class="data"><input type="text" class="form_control" name="seo_price" id="" readonly /><span class="unit">원</span></div>
					</li>
					<li class="total">
						<div class="label">입찰합계</div>
						<div class="data"><input type="text" class="form_control" name="last_bid_price" id="last_bid_price" maxlength="9" readonly style="display:none;"/><span id="last_bid_price_html"></span><span class="unit">원</span></div>
					</li>
				</ul>
			</div>
			<p class="notice-small bold">
				<input type="checkbox" id="agree" style="width: 15px; height: 15px">
				<label for="agree" class="vlign-m">
					입찰약관내용을 확인하고 동의합니다 <a href="javascript:void(0)" onclick="javascript:window.open('/inc/sub02_1_popup.php', 'open','width=700,height=750,statusbar=0,scrollbars=0')">[입찰약관보기]</a>
				</label>
			</p>
		</div>
		<div class="summary-footer">
			<div class="button-wrap button-bottom-fix">
				<a href="javascript:history.back();" class="btn-primary btn-outline">목록보기</a>
                <?if($row->wc_gubun4==2){?>
			    <?
				 if($user_level && ($loginUsort=="premium2"|| $loginUsort=="jisajang"||$loginUsort=="admin"||$loginUsort=="admin1"||$loginUsort=="admin2"||$loginUsort=="superadmin") ){
			   ?> 
					<input type='submit' class="btn-primary btn-fill" id="sb_img" value="입찰하기" style="cursor:pointer;" />
				<?
				  }
				 ?>
				<?}?>
				
			</div>
		</div>
	</div>
	</form>
	<!-- //차량정보요약 -->

	<!-- 좌측컨테이너 -->
	<div class="view-container">

		<!-- 차량이미지 -->
		<div class="car-image">
			<div class="img-wrap bxslider">
			<?
for($i=1; $i<=100; $i++) {

	$fileName = $row->{"wc_img_".$i};
	$real_name = explode('/', $fileName);	
	if(strlen($real_name[0]) == 0) break;
    $fileName = $site_u[home_url]."/data/".$real_name[0]; 
?>
					<div data-hash="<?=$i?>" class="slide">
						<img src="<?=$fileName?>" alt="차량이미지">
					</div> 
<? 
}	
?>  
			</div>
			<a href="javascript:void(0)" onclick="openLayerPop()" class="btn-zoom">더보기</a>
		</div>
		<!-- //차량이미지 -->
		
		<!-- 차량이미지 리스트 -->
		<div class="img-list-wrap view-thumb">
			<div class="img-list">
				<ul> 
<?
for($i=1; $i<=100; $i++) {

	$fileName = $row->{"wc_img_".$i};
	$real_name = explode('/', $fileName);	
	if(strlen($real_name[0]) == 0) break;
    $fileName = $site_u[home_url]."/data/".$real_name[0]; 
?>
  <li data-thumb="<?=$i?>" <?if($i == 1){?>class="active"<?}?>><img src="<?=$fileName?>" alt="차량이미지 썸네일"></li> 
<? 
}	
?>
				</ul>
			</div>
		</div>
		<!-- //차량이미지 리스트 --> 
		<!-- 차량상세정보 -->
		<h3>차량상세정보</h3>
		<div class="detail-info">
			<dl>
				<dt class="label">제조사</dt>
				<dd class="info-data">
<?
if($row->wc_mem_name=="동부"){
	echo $row->made_dong;
}else{
	$sql="select * from cate2 where idx='$row->wc_made' ";
	$result_made=mysql_query($sql);
	$data_made=mysql_fetch_array($result_made);
	echo $data_made[name];
}
?>	
				</dd>
				<dt class="label">모델명</dt>
				<dd class="info-data"><?=$row->wc_model ?>
                         <?if($row->wc_model2) echo $row->wc_model2;?></dd>
				<dt class="label">차대번호</dt>
				<dd class="info-data"><?=$row->wc_prog_area_price?></dd>
				<dt class="label">전손/분손</dt>
				<dd class="info-data"><?=$row->evalAmt_type?></dd>
				<dt class="label">년식</dt>
				<dd class="info-data"><?if($row->wc_age)?>
                            <?=substr($row->wc_age,0,4)?>년
                            <?=substr($row->wc_age,4,2)?>월
			    </dd>
				<dt class="label">변속기</dt>
				<dd class="info-data"><?=$row->wc_mem_name=="동부"?$row->trans_dong:$row->wc_trans ?></dd>
				<dt class="label">연료</dt>
				<dd class="info-data"><?=$row->wc_mem_name=="동부"?$row->fual_dong:$row->wc_fual ?></dd>
				<dt class="label">배기량</dt>
				<dd class="info-data"><?=number($row->wc_cc)?>cc</dd>
				<dt class="label">주행거리</dt>
				<dd class="info-data"><?=number($row->wc_mileage)  ?>km</dd>
				<dt class="label">세전출고가</dt>
				<dd class="info-data"><?=number($row->wc_price )?>원</dd>
				<dt class="label">예상수리비</dt>
				<dd class="info-data"><?=number($row->wc_cost)?>원</dd>
				<dt class="label">사고발생일</dt>
				<dd class="info-data"><?=$row->wc_acc_date?></dd>
				<dt class="label">발생비용</dt>
				<dd class="info-data"><?=number_format($wc_go_cost)?> 원</dd>
				<dt class="label">소유형태</dt>
				<dd class="info-data"><? WriteArrHTML('radio', 'ArrcarOwner', $ArrcarOwner, $row->wc_ownertype, '', '', 'direct', ''); ?></dd>
				<dt class="label">보관장소</dt>
				<dd class="info-data stretch">
				<?
				echo WriteArrHTML('select', 'area1', $ArrcarPlace , $row->wc_keep_area1, '', '' , 'direct', '' );
				echo " | ";
				if($row->wc_keep_place1){
					echo $row->wc_keep_place1;
				}else{
					echo $row->moveKeepReq;
				} 
				?>				
				</dd>
				<dt class="label">참고사항</dt>
				<dd class="info-data stretch"><?=nl2br($row->wc_option_add)?></dd>
				<dt class="label">차량설명</dt>
				<dd class="info-data stretch"><?=nl2br($row->wc_damage)?></dd>
			</dl>
		</div>
		<!-- //차량상세정보 -->
		<!-- 필독사항 -->
		<h3>필독사항</h3>
		<div class="notice-must">
			<ul>
				<li>* 본 사이트에서 제공된 정보는 법적인 효력이 없으므로 참고 자료로만 활용하시기 바랍니다.</li>
				<li>* 정해진 기한내에 입찰 횟수 제한은 없습니다.</li>
				<li>* 반드시 실물 확인후 입찰에 참가를 요하며 미확인으로 인하여 발생하는 문제는 당사에서 책임지지 않습니다.</li>
				<li>* 낙찰후 금액조정은 일체 허용되지 않습니다.</li>
				<li>* 차량 출고후 일어나는 모든사항은 당사에서 책임지지 않습니다.</li>
				<li>* 낙찰 포기시 바로 패널티가 적용이 됩니다.</li>
				<li>* 낙찰포기시 회원의 자격을 해지할 수 있으며, 차순위 입찰자로 낙찰결정 진행시 차감되는 금액을 낙찰포기 회원이 책임질시 회원의 자격은 유지가능합니다.</li>
				<li>* 낙찰자의무:낙찰 통보일로 부터 익일12시까지 낙찰정산 금액을 입금하여야하며 만일 기일 내 미납시 낙찰물건의 권리 및 보증보험의 권리를 포기하는 것으로 간주합니다.</li>
			</ul>
		</div>
		<!-- //필독사항 -->

	</div>
	<!-- //좌측컨테이너 -->
</div>
<iframe name="HiddenFrm" style="display:none;"></iframe>
<iframe name="hiddenframe" style="display:none;"></iframe>
<form name='signform' method='post' action='myzzim.php'>
	<input type="hidden" name="no" value="<?=$idx?>">
	<input type="hidden" name="userid" value="<?=$loginId?>">
</form>
<script>
	function detailView(pic) {
		
		var no = document.getElementById('zoomimgno').value;
		if(!pic)
		{
			pic = no;
		}	
	
		window.open('../inc/popup_pic.php?pic='+pic+'&'+'idx='+<?=$idx?>,'imageWin','top=100,left=100,width=910,height=900');
	
	}

	// swiper
	// 차량이미지 swipe기능
	$(function(){
		var bx = $('.bxslider').bxSlider({
			mode: 'fade',
			speed: 100,
			slideWidth: 780,
			pagerType: 'short',
			nextText: '',
			prevText: '',
			pager: true,
			infiniteLoop: false,
			onSlideAfter: function($slideElement, oldIndex, newIndex){
				console.log('bx', newIndex);
				$('.view-thumb .img-list > ul > li[data-thumb="'+(newIndex+1)+'"]').addClass('active').siblings().removeClass('active');
			}
		});
		
		$('.view-thumb .img-list > ul > li').on('mouseenter',function(e){
			var target = $(this).data('thumb');
			$(this).addClass('active').siblings().removeClass('active');
			console.log(target);
			bx.goToSlide(target-1);
		});

	})
</script>
<!-- footer -->
<div class="cha_footer"><? include "../inc/bottom.php" ?></div>
<?
$info = Row_string("SELECT * FROM woojung_car WHERE wc_idx = '$idx'");

$site_u = mysql_fetch_array(mysql_query("select * from recruit as a left join woojung_member as b on a.code=b.code left join woojung_car as c on b.userId=c.wc_mem_id where c.wc_idx='".$info[wc_idx]."' "));

if($pic)
{
	$wc_car_img1 = explode("/",$info["wc_img_".$pic]);
	$defaultFile = $site_u[home_url]."/data/".$wc_car_img1[0]; 
}

?>

<!-- layerPopup -->
<!-- 차량이미지 상세보기 -->
<div class="layer-popup-wrap">
	<div class="popup-content">
		<div class="popup-header">
			<p class="summary">
				<span class="label">No :</span><span class="dd"><?=$info[wc_orderno]?></span> &nbsp;/&nbsp;
				<span class="dd"><?=$info[wc_model]?></span> &nbsp;/&nbsp;
				<span class="dd"><?if($info[wc_age])?> <?=substr($info[wc_age],0,4)?> 년 <?=substr($info[wc_age],4,2)?>월</span> &nbsp;/&nbsp;
				<span class="dd"><?=$info[wc_mem_name]=="동부"?$info[trans_dong]:$info[wc_trans] ?></span> &nbsp;/&nbsp;
				<span class="dd"><?=$info[wc_mem_name]=="동부"?$info[fual_dong]:$info[wc_fual] ?></span> &nbsp;/&nbsp;
				<span class="dd"><?=number_format($info[wc_cc])?>cc</span> &nbsp;/&nbsp;
				<span class="dd"><?=number_format($info[wc_mileage])?>km</span>
			</p>
			<a href="javascript:void()" class="close-popup">닫기</a>
		</div>
		<div class="popup-body">
			<!-- 차량이미지 -->
			<div class="car-image">
				<div class="img-wrap bxslider-popup img-large">
<?
for($i=1; $i<=100; $i++) {

	$fileName = $row->{"wc_img_".$i};
	$real_name = explode('/', $fileName);	
	if(strlen($real_name[0]) == 0) break;
		$fileName = $site_u[home_url]."/data/".$real_name[0]; 
?>
					<div data-hash="<?=$i?>" class="slide">
						<img src="<?=$fileName?>" alt="차량이미지">
					</div> 
<? 
}	
?>  
				</div>
			</div>
			<!-- //차량이미지 -->

			<!-- 차량이미지 리스트 -->
			<div class="img-list-wrap">
				<div class="img-list">
					<ul>
<?
for($i=1; $i<=100; $i++) {

	$fileName = $row->{"wc_img_".$i};
	$real_name = explode('/', $fileName);	
	if(strlen($real_name[0]) == 0) break;
    $fileName = $site_u[home_url]."/data/".$real_name[0]; 
?>
  <li data-thumb="<?=$i?>" <?if($i == 1){?>class="active"<?}?>><img src="<?=$fileName?>" alt="차량이미지 썸네일"></li> 
<? 
}	
?>
					</ul>
				</div>
			</div>
			<!-- //차량이미지 리스트 -->
		</div>
		<div class="popip-footer">

		</div>
	</div>
	<script>
		// 팝업 swiper
		// 차량이미지 swipe기능
		$(function(){
			var PopBx = $('.bxslider-popup').bxSlider({
				mode: 'fade',
				speed: 100,
				slideWidth: 1280,
				pagerType: 'short',
				nextText: '',
				prevText: '',
				pager: true,
				infiniteLoop: false,
				onSlideAfter: function($slideElement, oldIndex, newIndex){
					console.log('bx', newIndex);
					$('.layer-popup-wrap .img-list > ul > li[data-thumb="'+(newIndex+1)+'"]').addClass('active').siblings().removeClass('active');
				}
			});
			
			$('.layer-popup-wrap .img-list > ul > li').on('click',function(e){
				var target = $(this).data('thumb');
				$(this).addClass('active').siblings().removeClass('active');
				console.log(target);
				PopBx.goToSlide(target-1);
			});

			$('.view-thumb .img-list > ul > li').on('click',function(e){
				var target = $(this).data('thumb');
				// $(this).addClass('active').siblings().removeClass('active');
				// console.log(target);
				$('.layer-popup-wrap .img-list > ul > li[data-thumb="'+target+'"]').addClass('active').siblings().removeClass('active');
				PopBx.goToSlide(target-1);
				openLayerPop();
			});

		})
		// 팝업 닫기
		$('.layer-popup-wrap .close-popup').on('click', function(){
			$('.layer-popup-wrap').removeClass('open')
		});
		// 팝업 열기
		function openLayerPop(){
			$('.layer-popup-wrap').addClass('open');
		}
	</script>
</div>
<!-- //차량이미지 상세보기 -->
<!-- //layerPopup -->
