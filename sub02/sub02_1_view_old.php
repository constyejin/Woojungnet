<?
include "../inc/header.php"; 

$query = mysql_query("select * from woojung_member where userId = '$loginId' limit 1");
$member_new = mysql_fetch_array($query);

if(!$user_level && (!$loginId || $loginUsort=="indi" || $loginUsort=="company1" || $loginUsort=="company2" || $loginUsort=="premium1" || $loginUsort=="premium3" || $loginUsort=="premium4") ){
	echo "<script>alert('사용 권한이 없습니다.');history.back();</script>";
}


?>

<div id="new_wrap">

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

/*
$query = $db->query("select * from woojung_auction where idx='$_GET[idx]' limit 1"); 
$row = mysql_fetch_object($query);
$idx			= $row->idx;
$param_auct_idx			= $row->auct_idx;


$bid_call = Row_string("SELECT * FROM woojung_bid WHERE auct_idx = '$param_auct_idx' and bid_sort = 'Y'");


$car_gear			= $carGear_array[$row->car_gear];
$buy_type		= $buy_type_array[$row->buy_type];
*/

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
echo $total_secs ;


$bidQry = "SELECT bid_price  FROM woojung_bid where auct_key=$idx and userId='$loginId' and sale_type='2' ";
$bquery = $db->query($bidQry);
$brow = mysql_fetch_object($bquery);
$bid_price1		= number($brow->bid_price);

$bidQry = "SELECT bid_price  FROM woojung_bid where auct_key=$idx and userId='$loginId' and sale_type='1' ";
$bquery = $db->query($bidQry);
$brow = mysql_fetch_object($bquery);
$bid_price2		= number($brow->bid_price);


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
	$wc_go_cost = $row->wc_go_cost;
	$total_amt = $row->wc_go_cost;
}else{
	$wc_go_cost = 0;
	$total_amt = 0;
}

if($row->wc_gubun3=="2"){$kk="경매파손차량";}
if($row->wc_gubun3=="3"){$kk="공매파손차량";}
if($row->wc_gubun3=="4"){$kk="경매도난회수";}
if($row->wc_gubun3=="5"){$kk="공매도난회수";}

?>

	<div id="main_wrap">
		<div id="cha_contents">

	<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
			<tr>
			<td height="180" align="center" bgcolor="F6F6F6" style="background:url('/images/center_com_img.jpg') repeat-x; background-position: center; height:180px; width:100%;" class="Scor-font-500 center-com-img">
					매각차량<br />
					<span style="color:#fff; font-size:16px">보험사잔존물,일반경공매등 공정하고 투명하게 진행합니다</span>
				</td>
			</tr>
		</table>
        <div class="join_img_head" style="margin-top:0;" align="center">
        
        	<div class="div_basic">
<? 
if($gubun3=="2"){
 $on4 = "class='on'";
}else if($gubun3=="6"){
 $on3 = "class='on'";
}else if($gubun3=="3"){
 $on2 = "class='on'";
}else{
 $on1 = "class='on'";
} 
?>
			<div class="tab_type01">
				<ul>
                    <li <?=$on1 ?>><a href="/sub02/sub02_1.php"><span>매각차량(전체)</span></a></li>
					<li <?=$on2 ?>><a href="/sub02/sub02_1.php?gubun2=2&gubun3=3"><span>공매(파손/도난)</span></a></li>
					<li <?=$on3 ?>><a href="/sub02/sub02_1.php?gubun2=2&gubun3=6"><span>공매(침수차량)</span></a></li>
					<li <?=$on4 ?>><a href="/sub02/sub02_1.php?gubun2=2&gubun3=2"><span>경매(파손/도난)</span></a></li>
				</ul>
			</div>


			</div>
			
				<!---->
              <table width="1200px" border="0" cellspacing="0" cellpadding="0" style="margin-top:25px;">
                <tr>
                  <td height="20" align="left" valign="middle" ><font color="#0033CC" style="padding:3 10 0 0"></font></td>
                  <script type="text/javascript">


function detailView(pic) {
		
	var no = document.getElementById('zoomimgno').value;
	if(!pic)
	{
		pic = no;
	}	

	window.open('../inc/popup_pic.php?pic='+pic+'&'+'idx='+<?=$idx?>,'imageWin','top=100,left=100,width=910,height=900');

}





    //onkeyup 이벤트 발생시 호출되는 함수 
    function getHttprequest(URL,param_auct_idx) { 
    
    	document.all.price.value = 'Loading..';
        req = newXMLHttpRequest(); //request 객체 생성 
        req.onreadystatechange = processReqChange;// 요청후 처리될 콜백함수를 정의합니다. 
        req.open("POST", "../inc/getprice.php", true); //POST방식으로 sample.php 에 요청한다는것을 정의합니다. 
        req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");//요청헤더의 정의 
        var p_auct_idx = param_auct_idx;

        req.send("p_auct_idx="+p_auct_idx);  // sample.php에 값을 넘깁니다. 
        // 중요!!: sample.php에 값이 넘어갈때에는 UTF-8로 인코딩되어 넘어갑니다. 
    } 
//request객체생성 함수 
// function from http://www-128.ibm.com/developerworks/kr/library/j-ajax1/index.html 
function newXMLHttpRequest() { 

  var xmlreq = false; 

  if (window.XMLHttpRequest) { //파이어폭스나 맥의 사파리의 경우처리 
    // Create XMLHttpRequest object in non-Microsoft browsers 
    xmlreq = new XMLHttpRequest(); 
  } else if (window.ActiveXObject) { //IE계열의 브라우져의 경우 
    // Create XMLHttpRequest via MS ActiveX 
    try { 
      // Try to create XMLHttpRequest in later versions 
      // of Internet Explorer 
      xmlreq = new ActiveXObject("Msxml2.XMLHTTP"); 
    } catch (e1) { 
      // Failed to create required ActiveXObject 
      try { 
        // Try version supported by older versions 
        // of Internet Explorer 
        xmlreq = new ActiveXObject("Microsoft.XMLHTTP"); 
      } catch (e2) { 
        // Unable to create an XMLHttpRequest with ActiveX 
      } 
    } 
  } 
  return xmlreq; 
} 

// kin()에서 정의될 콜백함수의 정의 
// function from http://developer.apple.com/internet/webcontent/xmlhttpreq.html 
// handle onreadystatechange event of req object 
function processReqChange() { 
    // only if req shows "loaded" 
    if (req.readyState == 4) { 
        // only if "OK" 
        if (req.status == 200) { 
            printData(); //kin()의 요청이 정상적으로 처리되고 출력된 값을 어떻게 처리할지의 함수 
        } else { 
            alert("There was a problem retrieving the XML data:\n" + req.statusText); 
        } 
    } 
} 
//sample.php에서 출력된 내용을 어떻게 처리할것인지? 
function printData(txt) { 
    document.all.price.value = req.responseText; 
    
} 

function zoomView(f, n){
	var obj = document.getElementById('zoomimg');
	obj.src = f;
	if(obj.width > 400){
		obj.style.width=400;
	}else{
		obj.style.width=obj.width;
	}
	

	if(obj.height > 328){
		obj.style.height=328;
	}else{
		obj.style.height=obj.height;
	}
	document.getElementById('zoomimgno').value = n;	
}



function ReSizeImg(){
	var obj = document.getElementById('zoomimg');
	var width = 400;
	var height = 328

	//if(obj.width > width){
	//	obj.style.width=width;
	//}else{
	//	obj.style.width=obj.width;
	//}

	//if(obj.height > height){
	//	obj.style.height=height;
	//}else{
	//	obj.style.height=obj.height;
	//}
}

function zzim(){
	var f = document.signform;
	f.target="hiddenframe";
	f.action="/inc/myzzim.php";
	f.submit();
}


              </script>
                  <style type="text/css">
<!--
.style1 {color: #3399FF}
.style2 {color: #FF0000}
-->
              </style>
                  <script type="text/javascript" src="/common/js/form.js"></script>
                  <?if($row->sang_type=="1"){?>
                  <script type="text/javascript">
function bidCount() {
	var f = document.auctForm;
	if(f.bid_price.value)if(!isNumeric(f.bid_price))return;
<? if($row->vat=="2"){ ?>
	var vatp=0.1;
<? }else{ ?>
	var vatp=0;
<? } ?>
	
	if(f.bid_price.value) {		
/*
			if(f.bid_price.value>=10 && f.bid_price.value<500){
				f.sang_price.value=addComma('<?=$info->sang1?>');
				sang="<?=$info->sang1?>";
			}else if(f.bid_price.value>=500 && f.bid_price.value<1000){
				f.sang_price.value=addComma('<?=$info->sang2?>');
				sang="<?=$info->sang2?>";
			}else if(f.bid_price.value>=1000 && f.bid_price.value<2000){
				f.sang_price.value=addComma('<?=$info->sang3?>');
				sang="<?=$info->sang3?>";
			}else if(f.bid_price.value>=2000 && f.bid_price.value<2850){
				f.sang_price.value=addComma('<?=$info->sang4?>');
				sang="<?=$info->sang4?>";
			}else if(f.bid_price.value>=2850){
				f.sang_price.value=addComma('<?=$info->sang5?>');
				sang="<?=$info->sang5?>";
			}else{
				f.sang_price.value="";
				sang=0;
			}
*/
				sang=0;		
		var price1 = f.bid_price.value * 10000;	
		var sub_bid_price = auction_per(price1);
		//var succ_bid_sub_p = document.getElementById('succ_bid_sub_price').value;

		var result = parseInt(<?=$total_amt?>) + parseInt(<?=$cunserting_amt?>) + parseInt(sub_bid_price) + parseInt(price1) + parseInt(sang) ;
		
	
	} else {
		var price1 = 0;
		var result = 0;
	}
	vat=vatp*price1;
	result += parseInt(vat);
	f.vat_bid_price.value = addComma(vat);	
	f.c_bid_price.value = addComma(price1);
	f.last_bid_price.value = addComma(result);
}
              </script>
                  <?}else{?>
                  <script type="text/javascript">
function bidCount() {
	var f = document.auctForm;
	if(f.bid_price.value)if(!isNumeric(f.bid_price))return;
<? if($row->vat=="2"){ ?>
	var vatp=0.1;
<? }else{ ?>
	var vatp=0;
<? } ?>
	
	if(f.bid_price.value) {		

			//f.sang_price.value="";
			sang=0;
		
		var price1 = f.bid_price.value * 10000;	
		var sub_bid_price = auction_per(price1);
		//var succ_bid_sub_p = document.getElementById('succ_bid_sub_price').value;

		var result = parseInt(<?=$total_amt?>) + parseInt(<?=$cunserting_amt?>) + parseInt(sub_bid_price) + parseInt(price1) + parseInt(sang) ;
		
	
	} else {
		var price1 = 0;
		var result = 0;
	}
	vat=vatp*price1;
	result += parseInt(vat);
	f.vat_bid_price.value = addComma(vat);	
	f.c_bid_price.value = addComma(price1);
	f.last_bid_price.value = addComma(result);
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

	if(f.agree.checked!=true){
		alert("상기 내용에 동의하셔야 입찰에 참여할실 수 있습니다.");
		return false;
	}
	
	if(f.goSale[0].checked == false && f.goSale[1].checked == false){
		alert("매각유형을 선택해 주세요");
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

              </script>
                  <script language="JavaScript" type="text/JavaScript">
<!--
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}

function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
//-->
              </script>
                  <td align="right" valign="middle"> </td>
                </tr>
                <?
/*
	경매진행인 경우
	출품번호:
	차량명:
	매각유형:
	입찰마감일시:
	남은시간:
	경매시작가
	입찰최고가
	나의입찰가

	공매진행인 경우
	출품번호:
	차량명:
	매각유형:
	입찰마감일시:
	남은시간:
	나의입찰가

	시간종료 또는 낙찰된경우
	남은 시간: 종료되었습니다.
	낙찰가: 이 낙찰가는 정산관리에 낙찰가를 불러오면 됩니다.
	입찰하기 버튼은 사라지던지 누리면 입찰이 종료되었습니다.라는 문구가 나오면 됩니다.
	낙찰일시는 표출하지 않습니다. 
*/
?>
                <tr>
                  <td colspan="2"><table width="755" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="362" align="center" valign="top"><table width="340" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td><table width="340" height="329" border="1" cellpadding="0" cellspacing="1" bordercolor="BABABA" bgcolor="BABABA">
                                  <tr>
                                    <td align="center" bgcolor="#FFFFFF"><div id='picDisplay'><img id="zoomimg"  onerror="this.src='/auction/img/noImage_auction.gif'"  width="520" height="328" onclick="detailView()" src="<?=$defaultFile?>"  onload="ReSizeImg()" style="cursor:pointer;"/></div>
                                        <input type="hidden" name="zoomimgno" id="zoomimgno" value="1" /></td>
                                  </tr>
                              </table></td>
                            </tr>
                            <tr>
                              <td height="7"></td>
                            </tr>
                            <tr>
                              <td><!-- 추가사항 이미지 클릭시 위에 큰 이미지로 확대된 이미지가 보여지면 됨.
				이미지가 없을시는 /auction/img/bg01.gif 이미지가 보여지면 됨
				-->
                                  <table width="360" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                      <?
for($i=1; $i<=24; $i++) {

	$fileName = $row->{"wc_img_".$i};
	$real_name = explode('/', $fileName);	
	
	if(strlen($real_name[0]) == 0)
	{
		$fileName = '/images/box02.jpg';
		$script = "";
		
	}
	else
	{
		$fileName = $site_u[home_url]."/data/".$real_name[0];
		$script = " onClick=\"detailView($i)\" onmouseover=\"zoomView('$fileName', $i)\" style=\"cursor:pointer;\" ";
	}
?>
                                      <td width="57" height="44" align="center" bgcolor="BABABA"><img src="<?=$fileName?>" width="84" height="60" <?=$script?> /></td>
                                      <td width="2"></td>
                                      <?
					  if($i%6 == 0){
							echo "</tr>
								  <tr><td colspan=13 height=3></td></tr>							
								  <tr>";  
					  }
}	
?>
                                    </tr>
                                </table></td>
                            </tr>
                            <tr>
                              <td height="30" align="center" class="txt04">이미지를 클릭하시면 큰 화면으로 
                                보실수 있습니다.</td>
                            </tr>
                        </table></td>
                        <td width="10">&nbsp;</td>
                        <td width="383" valign="top"><table width="328" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td align="right"><!--// 공매 진행 Start //-->
                                  <table width="360" border="1" cellpadding="0" cellspacing="1" bordercolor="#666666" class="join_form">
                                    <tr>
                                      <td width="115" height="30" align="right" bgcolor="#f2f2f2" style="padding-right: 5px;  padding-top: 2px;">출품번호 
                                        : </td>
                                      <td bgcolor="#FFFFFF"style="padding-left: 5px; padding-top: 2px; text-align:left; font-size:13px;"><font color="#000000;" face="sans-serif" ><?=$row->wc_orderno?>
<?
if($row->wc_gubun2=="2"||$row->wc_gubun2=="3"){
	if($row->wc_gubun3=="3"){

		if($row->wc_gubun3=="2"){$kkkk="3";}
		if($row->wc_gubun3=="3"){$kkkk="1";}
		if($row->wc_gubun3=="4"){$kkkk="4";}
		if($row->wc_gubun3=="5"){$kkkk="2";}
?>
                                          <img src="/images/icon_<?=$kkkk?>.gif" />
<?
	}
}
?>
										  <img src="/images/icon_8.gif" onclick="zzim()" style="cursor:pointer;"/> </font></td>
                                    </tr>
                                    <tr>
                                      <td width="95" height="30" align="right" bgcolor="#f2f2f2" style="padding-right: 5px;  padding-top: 2px;">모델명 
                                        : </td>
                                      <td bgcolor="#FFFFFF" class="text07" style="padding-left: 5px; padding-top: 2px; text-align:left; font-weight:bold;"><?=$row->wc_model?> <?if($row->wc_model2) echo "/".$row->wc_model2;?>                                      </td>
                                    </tr>
                                    <tr>
                                      <td height="30" align="right" bgcolor="#f2f2f2" style="padding-right: 5px; padding-top: 2px;">마감일시 
                                        : </td>
                                      <td bgcolor="#FFFFFF" style="padding-left: 5px;  padding-top: 2px; text-align:left; "><font color="#000000"><?=$last_end_date2?>
                                          <?if($row->end_3 && $row->wc_go_end_date == date("Y-m-d")){?>
                                        <img src="/images/icon_<?=$row->end_3+2?>.gif" />
                                        <?}?>       </font>                               </td>
                                    </tr>
                                    <tr>
                                      <td height="30" align="right" bgcolor="#f2f2f2" style="padding-right: 5px; padding-top: 2px;">남은시간 
                                        : </td>
                                      <td bgcolor="#FFFFFF" style="padding-left: 5px;  padding-top: 2px; text-align:left;font-weight:bold;"><input type="text" size="20" id="counter" name="counter" style='border-width:0; border-color:#7C7A84;font-weight:bold; border-style:solid;color:#FF0000' readonly="readonly" />
                                          <input name="text" type="text" class="text07" id="end_maker" style='border-width:0; border-color:#7C7A84;font-weight:bold; border-style:solid;color:#FF0000' size="9" readonly="readonly" />                                      </td>
                                      <script language="JavaScript" type="text/javascript"> 
					<!-- 
					        // 자바스크립트 코드 
					function Timer(diff_in_secs, diff_in_mins, diff_in_hours, diff_in_days,mm,dd,yy)        { 
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
 
							document.getElementById('counter').value = '경매가 종료되었습니다.';  
					        }
 
 
					} 
					function Timer1() { 
					if(tda == 1 )document.all.end_maker.value = '[금일마감]';  					        	 	
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
					    	document.getElementById('counter').value = '경매가 종료되었습니다.';   
							document.getElementById('sb_img').style.display = "none";
							document.all.end_maker.value = '';
					    	clearTimeout('Timer1()');
					        return; 
					        } 
					if(day < 0) { 
					        //일:0 시간:0 분:0 초:0 이라면 종료메세지 출력 
					    	document.getElementById('counter').value = '경매가 종료되었습니다.';   
							document.getElementById('sb_img').style.display = "none";
							document.all.end_maker.value = '';
					    	clearTimeout('Timer1()');
					        return; 
					        } 
						document.all.counter.value = day + '일 ' + hour + '시간 ' + min + '분 ' + sec + '초 '; 
				        //1초당 한번씩 timer1()을 호출하여 실행 
						window.setTimeout('Timer1()',1000); 
					} 
					
					//window.attachEvent( 'onload', Timer(42,35,11,0));
					//document.onload=Timer(42,35,11,0);
					
					
					document.onload=Timer(<?=$diff_in_secs?>,<?=$diff_in_mins?>,<?=$diff_in_hours?>,<?=$diff_in_days?>,<?=$month?>,<?=$day?>,<?=$year?>);
					
					//--> 
					</script>
                                    </tr>
                                    <tr>
                                      <td height="30" align="right" bgcolor="#f2f2f2" style="padding-right: 5px; padding-top: 2px;">매각유형 
                                        : </td>
                                      <td bgcolor="#FFFFFF" style="padding-left: 5px;  padding-top: 2px; text-align:left;"><font color="#000000"><?WriteArrHTML('radio', 'Arrgubun2', $ArrgoSale, $row->wc_go_type, '', '' , 'direct', '');?></font></td>
                                    </tr>
                                    <tr>
                                      <td height="30" align="right" bgcolor="#f2f2f2" style="padding-right: 5px; padding-top: 2px;">견인,보관외 
                                        : </td>
                                      <td bgcolor="#FFFFFF" style="padding-left: 5px;  padding-top: 2px; text-align:left;"><strong>
                                        <?=number_format($wc_go_cost)?>
                                      </strong>원 </td>
                                    </tr>

<?if($row->wc_gubun3=="2" || $row->wc_gubun3=="4"){?>									
									<tr>
                                      <td height="30" align="right" bgcolor="#f2f2f2" style="padding-right: 5px; padding-top: 2px;">경매시작가
                                        : </td>
                                      <td bgcolor="#FFFFFF" style="padding-left: 5px;  padding-top: 2px; text-align:left;"><strong><font color="#000000"><?=number($row->wc_go_first_price)?>
                                        원</font></strong></td>
                                    </tr>
                                    <tr>
                                      <td height="30" align="right" bgcolor="#f2f2f2" style="padding-right: 5px; padding-top: 2px;"><?if( $row->wc_gubun2=="5"){echo "현재최저가";}else{echo "현재최고가";}?>
                                        : </td>
                                      <td bgcolor="#FFFFFF" style="padding-left: 5px;  padding-top: 2px; text-align:left;"><input name="text" type=text id=price style='color:#FF0000;font-weight:bolder;border-width:0; border-color:#7C7A84; border-style:solid; ' value="<?=number_format($selMax[bid_price])?>" size=10 readonly/>
                                       <font color="#000000"> 원 (자동업로드됨)</font></td>
                                    </tr>
<?}?>
									
									<tr>
                                      <td height="30" align="right" bgcolor="#f2f2f2" style="padding-right: 5px; padding-top: 2px;">나의입찰가<font color="#ff0000">(폐차) </font>
                                        :</td>
                                      <td bgcolor="#FFFFFF" style="padding-left: 5px;  padding-top: 2px; text-align:left;"><strong><font color="#000000"><?=$bid_price2?> 원</font></strong></td>
                                    </tr>
									<tr>
									  <td height="30" align="right" bgcolor="#f2f2f2" style="padding-right: 5px; padding-top: 2px;">나의입찰가<font color="#ff0000">(명의이전)</font>:</td>
									  <td bgcolor="#FFFFFF" style="padding-left: 5px;  padding-top: 2px; text-align:left;"><strong><font color="#000000"><?=$bid_price1?> 원</font></strong></td>
								    </tr>
                                  </table>
                                <!--// 공매 진행 End //-->
                              </td>
                            </tr>
                            <tr>
                              <td style="padding:10 10 10 10">&nbsp;</td>
                          </tr>
                          </table>
                            <!--<p style="text-align:center; margin:20px 0;">
					<input name="agree" type="checkbox"/>입찰동의사항을 확인하고 동의함
				</p>
				<table width="360" class="join_form" bordercolor="#666666" border="1" cellspacing="1" cellpadding="0" style="margin-bottom:20px;">
					<tr>
						<td bgcolor="#f2f2f2" style="padding:5px" width="95" >매각유형:</td>
						<td style="text-align:left; padding:0 0 0 10px;">
							<input name="goSale" id="gu" onclick="bidCount()" type="radio" value="2"/>구제&nbsp;&nbsp;
							<input name="goSale" onclick="bidCount()" type="radio" value="1"/>폐차
						</td>
						<td rowspan="2" width="">
							<button type="button" style="padding:20px;">
								입찰하기
							</button>
						</td>
					</tr>
					<tr>
						<td bgcolor="#f2f2f2" style="padding:5px 0;">입찰금액:</td>
						<td style="text-align:left; padding-left:10px"><input name="c_bid_price" class="input" id="c_bid_price" style="text-align:left; color: #000;" type="text" size="15" readonly=""/>원</td>
					</tr>
				</table>-->
                          <br />
                          <br />
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
                              <table width="360" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td><input name="agree" type="checkbox"/>
                                      <font color="#0033CC"><strong>입찰약관내용을 확인하고 동의함</strong></font><a href="javascript:;" onclick="javascript:window.open('/inc/sub02_1_popup.php', 'open','width=450,height=550,statusbar=0,scrollbars=0')"> [입찰약관보기]</a></td>
                                </tr>
                                <tr>
                                  <td height="10"></td>
                                </tr>
                                <tr>
                                  <td align="left"> * 입찰금액 단위는 <font color="#FF0000">만원</font>입니다. (예:<font color="#FF0000">3,500,000</font>원의 경우 <strong><font color="#FF0000">350</font></strong> 입력)<br />
                                  <font color="#ff0000"> * <strong><font color="#0033CC">폐차</font></strong>와 <strong><font color="#0033CC">명의이전</font></strong> 둘다 개별(각각) 입찰이 가능합니다</font></td>
                                </tr>
                              </table>
                              <table width="360" class="join_form" bordercolor="#666666" border="1" cellspacing="1" cellpadding="0">
                                <tr>
                                  <td width="142" height="20" bgcolor="#f2f2f2" style="padding:5px; text-align:right;" >입찰유형:</td>
                                  <td width="209" style="text-align:center; padding:0 0 0 10px;"><b>
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
                                  </b></td>
                                </tr>
                                <tr>
                                  <td width="142" height="20" bgcolor="#f2f2f2" style="padding:5px; text-align:right;" >나의입찰금액(만원):</td>
                                  <td style="text-align:left; padding-left:10px"><input name="bid_price" class="input" id="bid_price" style="padding-right:5px;text-align:right; color: #000;" type="text" size="19" maxlength="9" onkeyup="bidCount()" required value=""/>
                                      <input name="c_bid_price" class="input" id="c_bid_price" style="padding-right:5px;text-align:right; color: #000;" type="hidden" size="19" readonly=""/>
                                    만원</td>
                                </tr>
                                <tr>
                                  <td width="142" height="20" bgcolor="#f2f2f2" style="padding:5px; text-align:right;" >법인차량부가세:</td>
                                  <td style="text-align:left; padding-left:10px"><input name="vat_bid_price" class="input" id="vat_bid_price" style="padding-right:5px;text-align:right; color: #000;" type="text" size="19" maxlength="11" readonly/>
                                  원</td>
                                </tr>
                                <tr>
                                  <td height="20" bgcolor="#f2f2f2" style="padding:5px; text-align:right;">낙찰수수료(VAT포함): </td>
                                  <td style="text-align:left;padding-left:10px"><input name="succ_bid_sub_price" class="input" id="succ_bid_sub_price" style="padding-right:5px;text-align:right; color: #000;" type="text" size="19"  readonly/>
                                    원</td>
                                </tr>
                                <tr>
                                  <td width="142" height="20" bgcolor="#f2f2f2" style="padding:5px; text-align:right;" >견인,보관,견적비 외:</td>
                                  <td style="text-align:left;padding-left:10px"><input name="bid_total_price" class="input" id="bid_total_price" style="padding-right:5px;text-align:right; color: #000;" type="text" size="19" readonly value="<?=number($wc_go_cost)?>"/>
                                    원</td>
                                </tr>
                                <!--tr>
                                  <td height="20" bgcolor="#f2f2f2" style="padding:5px; text-align:right;">서류법적비/상사이전: </td>
                                  <td style="text-align:left;padding-left:10px"><input name="sang_price" class="input" id="sang_price" style="padding-right:5px;text-align:right; color: #000;" type="text" size="19" readonly/>
                                    원</td>
                                </tr-->
                                <tr>
                                  <td height="20" bgcolor="#f2f2f2" style="padding:5px; text-align:right;">낙찰자입금합계: </td>
                                  <td style="text-align:left;padding-left:10px"><input name="last_bid_price" class="input" id="last_bid_price" style="padding-right:5px;text-align:right; color: #000;" type="text" size="19" readonly/>
                                    원</td>
                                </tr>
                              </table>
                              <br />
                              <table align="center">
                                <tr>
                                  <td height="15" align="center"><span style="padding-top: 6px;"> <img src="/images/bt05.jpg" style="cursor:pointer;" onclick="history.back();"/>&nbsp;&nbsp;
								  <?if($row->wc_gubun4==2||$loginId=="drg1038"){?>
								  <?
									if($user_level && ($loginUsort=="premium2"|| $loginUsort=="jisajang"||$loginUsort=="jisajang2"||$loginUsort=="superadmin") ){
								   ?>
                                        <input type='image' src="/images/bt04.jpg"  border="0" style="cursor:pointer; height:35" id="sb_img" />
									<?
									  }
								     ?>
									<?}?>
                                    <!--input type="button" value="입찰하기" name="submitButton" id="submitButton" class="btn_blue"/></span>&nbsp;&nbsp;
								<input type="button" name="Button" value="관심목록저장" class="btn_red" /-->
                                  </span></td>
                                </tr>
                              </table>
                            </form></td>
                      </tr>
                  </table></td>
                </tr>
                <tr>
                  <td colspan="2">&nbsp;</td>
                </tr>
                <!--td colspan="2" align="center"><input type="button" name="Button" value="목록" class="btn_blue" /></td-->
                <tr>
                  <td height="30" colspan="2" class="title"><img src="/images/icon.jpg"  align="absmiddle" /> 차량정보</td>
                </tr>
                <tr>
            <?
			$team_cate=mysql_fetch_array(mysql_query("select * from team_cate where idx='".$row->wc_prog_etc."'"));
			?>
                  <td colspan="2"><table width="755" border="1" cellpadding="0" cellspacing="1" bordercolor="#666666" bgcolor="#CCCCCC" style="padding:3 0 0 0;word-break:break-all;">
                      <!--tr>
                        <td height="30" align="center" bgcolor="f6f6f6">차량번호</td>
                        <td bgcolor="#FFFFFF" style="padding:3 0 0 10">
						*******
                        </td>
                        <td width="100" align="center" bgcolor="f6f6f6">보 험 사</td>
                        <td bgcolor="#FFFFFF" style="padding:3 0 0 10"><?=$team_cate[name]?></td>
                      </tr-->
                      <tr>
                        <td width="100" height="30" align="center" bgcolor="f6f6f6">제조사</td>
                        <td width="280" bgcolor="#FFFFFF" style="padding:3 0 0 10">
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
                        </td>
                        <td width="100" align="center" bgcolor="f6f6f6">모 델 명</td>
                        <td width="275" bgcolor="#FFFFFF" style="padding:3 0 0 10"><?=$row->wc_model ?>
                        <?if($row->wc_model2) echo "/".$row->wc_model2;?></td>
                      </tr>
                      <tr>
                        <td height="30" align="center" bgcolor="f6f6f6">년 식</td>
                        <td bgcolor="#FFFFFF" style="padding:3 0 0 10"><?if($row->wc_age)?>
                            <?=substr($row->wc_age,0,4)?>
                          년
                          <?=substr($row->wc_age,4,2)?>
                          월</td>
                        <td align="center" bgcolor="f6f6f6">변 속 기</td>
                        <td bgcolor="#FFFFFF" style="padding:3 0 0 10"><?=$row->wc_mem_name=="동부"?$row->trans_dong:$row->wc_trans ?>
                        </td>
                      </tr>
                      <tr>
                        <td height="30" align="center" bgcolor="f6f6f6">연 료</td>
                        <td bgcolor="#FFFFFF" style="padding:3 0 0 10"><?=$row->wc_mem_name=="동부"?$row->fual_dong:$row->wc_fual ?>
                        </td>
                        <td align="center" bgcolor="f6f6f6">배 기 량</td>
                        <td bgcolor="#FFFFFF" style="padding:3 0 0 10"><?=number($row->wc_cc)?>
                          cc </td>
                      </tr>
                      <tr>
                        <td height="30" align="center" bgcolor="f6f6f6">주행거리</td>
                        <td bgcolor="#FFFFFF" style="padding:3 0 0 10"><?=number($row->wc_mileage)  ?>
                          km </td>
                        <td align="center" bgcolor="f6f6f6">세전출고가</td>
                        <td bgcolor="#FFFFFF" style="padding:3 0 0 10"><?=number($row->wc_price )?>
                          원 </td>
                      </tr>
                      <tr>
                        <td height="30" align="center" bgcolor="f6f6f6">예상수리비</td>
                        <td bgcolor="#FFFFFF" style="padding:3 0 0 10"><?=number($row->wc_cost)?> 원
                        </td>
                        <td align="center" bgcolor="f6f6f6">사고발생일</td>
                        <td bgcolor="#FFFFFF" style="padding:3 0 0 10"><?=$row->wc_acc_date?></td>
                      </tr>
	  <? /* 기본옵션1,2 감춤 220429 
                      <tr>
                        <td height="30" align="center" bgcolor="f6f6f6">기본옵션</td>
                        <td width="655" height="90" colspan="3" align="center" bgcolor="#FFFFFF" style="padding-left:10px; line-height:20px;"><?
			//== /lib/code.php 안에 있음
			WriteArrHTML('checkbox', 'carOption[]', $ArrcarOption, $row->wc_option, '', 6, 'all', '');
		   ?></td>
                      </tr>
	  */ ?>
                      <tr>
                        <td height="50" align="center" bgcolor="f6f6f6">참고사항</td>
                        <td colspan="3" align="left" bgcolor="#FFFFFF" style="padding-left:10px;"><?=$row->wc_option_add?></td>
                      </tr>
                      <tr>
                        <td height="60" align="center" bgcolor="f6f6f6">파손설명</td>
                        <td colspan="3" align="left" bgcolor="#FFFFFF" style="padding-left:10px;"><?=nl2br($row->wc_damage)?></td>
                      </tr>
                      <?
if($row->wc_keep_area2){
	
	$wc_keep_place = $row->wc_keep_place2;
	$wc_keep_tel = $row->wc_keep_tel2;
	$wc_keep_name = $row->wc_keep_name2;
}else{
	
	$wc_keep_place = $row->wc_keep_place1;
	$wc_keep_tel = $row->wc_keep_tel1;
	$wc_keep_name = $row->wc_keep_name1;

}

?>
                      <tr>
                        <td height="30" align="center" bgcolor="f6f6f6">보관지역</td>
                        <td bgcolor="#FFFFFF" style="padding:3 0 0 10"><?
			if($row->wc_keep_area2){
				$keep_area = WriteArrHTML('select', 'area1', $ArrcarPlace , $row->wc_keep_area2, '', '' , 'direct', '' );
			}else{
				$keep_area = WriteArrHTML('select', 'area1', $ArrcarPlace , $row->wc_keep_area1, '', '' , 'direct', '' );
			}
			
			
			
			?>
                        </td>
                        <td width="100" align="center" bgcolor="f6f6f6">보관장소상세</td>
                        <td bgcolor="#FFFFFF" style="padding:3 0 0 10"><?=$row->moveKeepReq?>
                        </td>
                      </tr>
                      <!--tr>
                        <td height="30" align="center" bgcolor="f6f6f6">보관소연락처</td>
                        <td bgcolor="#FFFFFF" style="padding:3 0 0 10"><?=$wc_keep_tel?>
                        </td>
                        <td align="center" bgcolor="f6f6f6">담 당 자</td>
                        <td bgcolor="#FFFFFF" style="padding:3 0 0 10"><?=$wc_keep_name?></td>
                      </tr-->
                  </table></td>
                </tr>
                <tr>
                  <td colspan="2">&nbsp;</td>
                </tr>
                <tr>
                  <td colspan="2" align="left" style="line-height:20px;"><img src="/images/tip.jpg"  /><br />
                    * 본 사이트에서 제공된 정보는 법적인 효력이 없으므로 참고 자료로만 활용하시기 바랍니다.<br />
                    * 정해진 기한내에 입찰 횟수 제한은 없습니다. <br />
                    * 반드시 실물 확인후 입찰에 참가를 요하며 미확인으로 인하여 발생하는 문제는 당사에서 책임지지 않습니다. <br />
                    * 낙찰후 금액조정은 일체 허용되지 않습니다. <br />
                    * 차량 출고후 일어나는 모든사항은 당사에서 책임지지 않습니다. <br />
                    * 낙찰 포기시 위약금 10%가 적용이됨과 동시에 페널티가 적용이 됩니다.<br />
                    * 낙찰포기시 회원의 자격을 해지할 수 있으며, 차순위 입찰자로 낙찰결정 진행시 차감되는 금액을 낙찰포기 회원이 책임질시 회원의 자격은 유지가능합니다.<br />
                    * 낙찰자의무:낙찰 통보일로 부터 익일12시까지 낙찰정산 금액을 입금하여야하며, 만일 기일 내 미납시 낙찰물건의 권리 및 보증보험의 권리를 포기하는 것으로 간주합니다. </td>
                </tr>
              </table>


			</div>
		</div>
	</div>
	<!-- footer -->
	<div class="cha_footer"><? include "../inc/bottom.php" ?></div>
</div>

<iframe name="HiddenFrm" style="display:none;"></iframe>
<iframe name="hiddenframe" style="display:none;"></iframe>
<form name='signform' method='post' action='myzzim.php'>
	<input type="hidden" name="no" value="<?=$idx?>">
	<input type="hidden" name="userid" value="<?=$loginId?>">
</form>

</body>
</html>

<script type="text/javascript">
function auctionView(idx) {
	window.location.href="sub02_1_view.php?idx="+idx;
}
</script>


<script>
var co=<?=$selMax[bid_price]?$selMax[bid_price]:0?>;
function re(){
	location.reload(); //페이지를 리로드
}

//tid=setTimeout(re,2000); //3초후re함수실행
//win.scrollTop=win.scrollHeight;

</script>
<script language="javascript">


function createRequestObject() //object 생성이 가능한 브라우저인지 확인.
{
    var req;
    // 
    if(window.XMLHttpRequest) // 브라우져가 XMLHttpRequest 객체를 가지고 있는지 판단
    {
        // Firefox, Safari, Opera...
        req = new XMLHttpRequest();
    }
    else if(window.ActiveXObject) // 브라우가 ActiveX 를 받아올 수 있는지 판단
    {
        // Internet Explorer 5+
        req = new ActiveXObject("Microsoft.XMLHTTP");
    }
    else // HTTP 통신을 할수 없는 브라우져인 경우
    {
        alert("Your Browser Does Not Support This Script - Please Upgrade Your Browser ASAP");
    }
    return req; // 브라우져에 맞는 HTTP 객체를 가져와 객체 리턴
}


// XMLHttpRequest object생성 [위의 함수로 브라우저에 맞는 객체를 받아옴]
var http = createRequestObject();


function sendRequest(page) // 데이터 페이지 불러오기
{
    // get 방식으로 파라미터로 넘겨받은 객체를 가져오도록 셋팅
    http.open('get', page);
    http.setRequestHeader("If-Modified-Since", "Sat, 1 Jan 2000 00:00:00 GMT"); //캐싱방지ㅋ
    // 페이지로부터의 onreadystatechange 즉 읽어들일 수 있다는 상태값을 받으면 handleResponse 함수를 실행하도록 함
    http.onreadystatechange = handleResponse;
    // 페이지를 가져오도록 호출
    http.send(null);
}


function handleResponse() // 불러온값 처리
{
    // http.readyState 4 인경우 객체를 호출한 페이지로부터 읽어들일 준비가 됐다는 말이고
    // http.status 가 200 인 경우는 에러가 발생하지 않고 온전히 컨텐츠가 로딩됐음을 의미 합니다.
    // http.status 상태는 여러가지가 있을수 있는데 페이지를 찾을수 없을경우 404 컴파일이 안됐을경우 500
    // 페이지 접속 권한이 없을경우 403 등의 오류등을 가져옵니다.
    if(http.readyState == 4 && http.status == 200)
    {
        // Text returned FROM the PHP script
        // http 객체로 받아온 페이지의 컨텐츠 TEXT 를 받아와 response 변수에 저장
        var response = http.responseText;
        // 받아온 값이 유효하면
        if(response!=co)
        {
            // 페이지에서 불러온 값을 id 가 dbstatus 인객체에 표시
			co=response;
            document.getElementById("price").value = addComma(response);
//            document.getElementById("sb_img").style.display = "none";
//			location.reload(); //페이지를 리로드

        }
    }
}


function repeatloop() //최종적으로 처리해서 보여주기
{
    // sendRequest 함수를 호출하며 파라미터로 호출할 페이지 명을 넘겨줌
    sendRequest('pricedb.php'); // 값을 받아올 php의 위치
    // 1초후에 자기 함수를 다시 호출 재귀함수
    setTimeout("repeatloop()", 1000); //refresh 빈도 1000 = 1초
}


// 브라우져가 실행될때 repeatloop 함수를 실행
window.onload=function()
{
    // repeatloop 함수 호출
    repeatloop();
}


</script>
