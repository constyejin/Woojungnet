<?php 
require_once "../lib/common.php";
//loginCheck();
include $_SERVER['DOCUMENT_ROOT'].'/lib/_class/phpfun.class.php';
include_once	'../lib/global.php';	
$phpfun = new phpfun();

$idx = $_GET['idx'];
if(!$idx)$mode = 'regist';
else $mode = 'modify';


$SID = session_id();
if(!$user_level){
	echo "<script>alert('사용 권한이 없습니다.');history.back();</script>";
}
?>
<? $menuNow ="?pageNum=1&subNum=1"; ?>
	<? include "../inc/header.php" ?>
	<script type="text/javascript">
<!--
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
//-->
    </script>
	<style type="text/css">
.join_img_body table.join_form tr th { background:#f7f7f7; border:1px solid #666666; font-weight:normal;font-color:#FF0000; }
    .style2 {font-weight: bold}
    .style3 {font-size: 16px}
    </style>

	
	
	<div id="sub_contents">
		<div id="sub_L">
			<? include "../inc/left_mypage.php" ?>
		</div>
            
                       
            
            <!--center start-->
<?php
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
		left join woojung_bid as d on a.wc_idx = d.auct_key 
		WHERE a.wc_idx=$idx and d.userId='$loginId' ";

$query = $db->query($Qry);
$row = mysql_fetch_object($query);

if(!$row->wc_idx) echo "<script>alert('사용 권한이 없습니다.');history.back();</script>";

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
$defaultFile = "/data/".$wc_car_img1[0];


$date1=mktime($hour,$min,'00',$month,$day,$year); 
//$date1=mktime(18,1,59,9,4,2009); 
//정의 int mktime(int hour, int minute, int second, int month, int day, int year) 
$date2=mktime(); //mktime은 초로 계산된 시간 125125212초 이런식 
//echo "최종수정일:".$row->wc_regdate;

$total_secs=$date1 - $date2; 
//$total_secs=abs($date1 - $date2); 
$diff_in_days = floor($total_secs / 86400); 
$rest_hours = $total_secs % 86400; 



$diff_in_hours = floor($rest_hours / 3600); 
$rest_mins = $rest_hours % 3600; 

$diff_in_mins = floor($rest_mins / 60); 
$diff_in_secs = floor($rest_mins % 60); 


$bidQry = "SELECT bid_price  FROM woojung_bid where auct_key=$idx and userId='$loginId'  ";


$bquery = $db->query($bidQry);
$brow = mysql_fetch_object($bquery);
$bid_price		= number($brow->bid_price);


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
$salePercent = $info->sale_percent; //경매,공매
$salePercent1 = $info->sale_percent1; // 도난경매, 도난 공매
$salehighprice = $info->sale_highprice; // 수수료 최고
$salelowprice = $info->sale_lowprice; // 수수료 최저값


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
            
            
		<div id="sub_Con">
			<ul class="subTitBox">
				<li class="left">▣ 낙찰차량 </li>
				<li class="right">HOME > 마이페이지 > 낙찰차량</li>
			</ul>
            
            <div id="sub_Con2">
              <table width="755" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td height="20" align="left" valign="middle"><font color="#0033CC" style="padding:3 10 0 0"><strong>구분 
                    :
                    <!-- 추가부분 -->
                          <?
		//== /lib/code.php 안에 있음
		WriteArrHTML('select', 'gubun1', $Arrgubun1, $row->wc_gubun1, '', '' , 'direct', '');
?>
                    &gt;
                    <?

		//== /lib/code.php 안에 있음
		//$onscript = "onchange=\"if(this.value)CallsubGubun('SearchGubun3','select', 'gubun3', this.value, '".$row[wc_gubun3]."', '', '', 'all', '::선택::');\"";
		WriteArrHTML('select', 'gubun2', $Arrgubun2, $row->wc_gubun2, $onscript, '' , 'direct', '');
?>
                    &gt; <span id='SearchGubun3'>
                      <?
		//== /lib/code.php 안에 있음
		if($row->wc_gubun2) WriteArrHTML('select', 'gubun3', ${"Arrgubun3_".$row->wc_gubun2}, $row->wc_gubun3, '', '' , 'direct', '');
?>
                      </span> &gt;
                    <?
		//== /lib/code.php 안에 있음
		WriteArrHTML('select', 'gubun4', $Arrgubun4, $row->wc_gubun4, '', '' , 'direct' , '');
?>
                  </strong></font></td>
                  <script type="text/javascript">


function detailView(pic) {
		
	var no = document.getElementById('zoomimgno').value;
	if(!pic)
	{
		pic = no;
	}	

	window.open('../inc/popup_pic.php?pic='+pic+'&'+'idx='+<?=$idx?>,'imageWin','top=100,left=100,width=810,height=650');

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
                  <script type="text/javascript" src="../common/js/form.js"></script>
                  <?if($row->sang_type=="1"){?>
                  <script type="text/javascript">
function bidCount() {
	var f = document.auctForm;
	if(f.bid_price.value)if(!isNumeric(f.bid_price))return;
	
	if(f.bid_price.value) {		

			if(f.bid_price.value>=10 && f.bid_price.value<500){
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
		
		var price1 = f.bid_price.value * 10000;	
		var sub_bid_price = auction_per(price1);
		//var succ_bid_sub_p = document.getElementById('succ_bid_sub_price').value;

		var result = parseInt(<?=$total_amt?>) + parseInt(<?=$cunserting_amt?>) + parseInt(sub_bid_price) + parseInt(price1) + parseInt(sang) ;
		
	
	} else {
		var price1 = 0;
		var result = 0;
	}

	
	f.c_bid_price.value = addComma(price1);
	f.last_bid_price.value = addComma(result);
}
              </script>
                  <?}else{?>
                  <script type="text/javascript">
function bidCount() {
	var f = document.auctForm;
	if(f.bid_price.value)if(!isNumeric(f.bid_price))return;
	
	if(f.bid_price.value) {		

			f.sang_price.value="";
			sang=0;
		
		var price1 = f.bid_price.value * 10000;	
		var sub_bid_price = auction_per(price1);
		//var succ_bid_sub_p = document.getElementById('succ_bid_sub_price').value;

		var result = parseInt(<?=$total_amt?>) + parseInt(<?=$cunserting_amt?>) + parseInt(sub_bid_price) + parseInt(price1) + parseInt(sang) ;
		
	
	} else {
		var price1 = 0;
		var result = 0;
	}

	
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
	var salePecrcent = "<?=$sPercent?>";
		
	var sum = salePecrcent * price;
	
	

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
/*	


	if(	rs(f.c_bid_price.value) < <?=$auction_strt_amt?>)
	{
		var strt_amt	= '<?=number_format($auction_strt_amt)?>';
		alert("입찰금액이 경매시작가 ("+strt_amt+"원) 보다 작을수 없습니다.");
		return false;
		
	}
	*/
	var strt_amt_j	= '<?=$auction_strt_amt?>';
	if(strt_amt_j>rs(f.c_bid_price.value)){
		var strt_amt	= '<?=number_format($auction_strt_amt)?>';
		alert("입찰금액이 경매시작가 ("+strt_amt+"원) 보다 작을수 없습니다.");
		return false;
	}

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

	alert('경매가 종료되었습니다.');
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
                  <td align="right" valign="middle"> 최종수정일:
                      <?=$row->wc_regdate?></td>
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
                                    <td align="center" bgcolor="#FFFFFF"><div id='picDisplay'><img id="zoomimg"  onerror="this.src='/auction/img/noImage_auction.gif'"  width="400" height="328" onclick="detailView()" src="<?=$defaultFile?>"  onload="ReSizeImg()" style="cursor:pointer;"/></div>
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
		$fileName = "/data/".$real_name[0];
		$script = " onClick=\"detailView($i)\" onmouseover=\"zoomView('$fileName', $i)\" style=\"cursor:pointer;\" ";
	}
?>
                                      <td width="57" height="44" align="center" bgcolor="BABABA"><img src="<?=$fileName?>" width="65" height="60" <?=$script?> /></td>
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
                                      <td width="95" height="30" align="right" bgcolor="#f2f2f2" style="padding-right: 5px;  padding-top: 2px;">출품번호 
                                        : </td>
                                      <td bgcolor="#FFFFFF" class="text04" style="padding-left: 5px; padding-top: 2px; text-align:left; font-weight:bold;"><?=$row->wc_orderno?>
                                          <?
if($row->wc_gubun3=="2"){$kkkk="3";}
if($row->wc_gubun3=="3"){$kkkk="1";}
if($row->wc_gubun3=="4"){$kkkk="4";}
if($row->wc_gubun3=="5"){$kkkk="2";}
?>
                                          <img src="/images/icon_<?=$kkkk?>.gif" /> <img src="/images/icon_8.gif" onclick="zzim()" style="cursor:pointer;"/> </td>
                                    </tr>
                                    <tr>
                                      <td width="95" height="30" align="right" bgcolor="#f2f2f2" style="padding-right: 5px;  padding-top: 2px;">모델명 
                                        : </td>
                                      <td bgcolor="#FFFFFF" class="text04 style3" style="padding-left: 5px; padding-top: 2px; text-align:left; font-weight:bold;"><?=$row->wc_model?> <?if($row->wc_model2) echo "/".$row->wc_model2;?>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td height="30" align="right" bgcolor="#f2f2f2" style="padding-right: 5px; padding-top: 2px;">매각유형 
                                        : </td>
                                      <td bgcolor="#FFFFFF" style="padding-left: 5px;  padding-top: 2px; text-align:left;"><?WriteArrHTML('radio', 'Arrgubun2', $ArrgoSale, $row->wc_go_type, '', '' , 'direct', '');?>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td height="30" align="right" bgcolor="#f2f2f2" style="padding-right: 5px; padding-top: 2px;">견인,보관외 
                                        : </td>
                                      <td bgcolor="#FFFFFF" style="padding-left: 5px;  padding-top: 2px; text-align:left;"><strong>
                                        <?=number_format($row->wc_go_cost)?>
                                      </strong>원 </td>
                                    </tr>
                                    <!--tr>
                                    <td height="30" align="right" bgcolor="#f2f2f2" style="padding-right: 5px; padding-top: 2px;">경매시작가
                                      : </td>
                                    <td bgcolor="#FFFFFF" style="padding-left: 5px;  padding-top: 2px; text-align:left;"><strong> </strong>원</td>
                                  </tr-->
                                  <tr>
                                    <td height="30" align="right" bgcolor="#f2f2f2" style="padding-right: 5px; padding-top: 2px;">입찰마감일시
                                      : </td>
                                    <td bgcolor="#FFFFFF" style="padding-left: 5px;  padding-top: 2px; text-align:left;"><?=$last_end_date?></td>
                                  </tr>
                                    <tr>
                                      <td height="30" align="right" bgcolor="#f2f2f2" style="padding-right: 5px; padding-top: 2px;">나의입찰가 
                                        :</td>
                                      <td bgcolor="#FFFFFF" style="padding-left: 5px;  padding-top: 2px; text-align:left;"><span class="style2" id='my_bid_price'> </span><strong>
                                        <?=$bid_price?>
                                      </strong>원</td>
                                    </tr>
                                    <tr>
                                      <td height="30" align="right" bgcolor="#f2f2f2" style="padding-right: 5px; padding-top: 2px;">낙찰가 
                                        :</td>
                                      <td bgcolor="#FFFFFF" style="padding-left: 5px;  padding-top: 2px; text-align:left;"><span class="style2" id='my_bid_price'> </span><strong>
                                        <?=number($row->wc_accepted_priceA)?>
                                      </strong>원</td>
                                    </tr>
                                  </table>
                                <!--// 공매 진행 End //-->
                              </td>
                            </tr>
                          </table>
                          <br />
                          <br />
                              <br />
                            </td>
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
$sql="select * from cate2 where idx='$row->wc_made' ";
$result_made=mysql_query($sql);
$data_made=mysql_fetch_array($result_made);
echo $data_made[name];
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
                        <td bgcolor="#FFFFFF" style="padding:3 0 0 10"><?=$row->wc_trans ?>
                        </td>
                      </tr>
                      <tr>
                        <td height="30" align="center" bgcolor="f6f6f6">연 료</td>
                        <td bgcolor="#FFFFFF" style="padding:3 0 0 10"><?=$row->wc_fual ?>
                        </td>
                        <td align="center" bgcolor="f6f6f6">배 기 량</td>
                        <td bgcolor="#FFFFFF" style="padding:3 0 0 10"><?=number_format($row->wc_cc)?>
                          cc </td>
                      </tr>
                      <tr>
                        <td height="30" align="center" bgcolor="f6f6f6">주행거리</td>
                        <td bgcolor="#FFFFFF" style="padding:3 0 0 10"><?=number_format($row->wc_mileage)  ?>
                          km </td>
                        <td align="center" bgcolor="f6f6f6">세전출고가</td>
                        <td bgcolor="#FFFFFF" style="padding:3 0 0 10"><?=number_format($row->wc_price )?>
                          원 </td>
                      </tr>
                      <tr>
                        <td height="30" align="center" bgcolor="f6f6f6">예상수리비</td>
                        <td bgcolor="#FFFFFF" style="padding:3 0 0 10"><?=number_format($row->wc_cost)?>
                        </td>
                        <td align="center" bgcolor="f6f6f6">사고발생일</td>
                        <td bgcolor="#FFFFFF" style="padding:3 0 0 10"><?=$row->wc_acc_date?></td>
                      </tr>
                      <tr>
                        <td height="30" align="center" bgcolor="f6f6f6">기본옵션</td>
                        <td width="655" height="90" colspan="3" align="center" bgcolor="#FFFFFF" style="padding-left:10px; line-height:20px;"><?
			//== /lib/code.php 안에 있음
			WriteArrHTML('checkbox', 'carOption[]', $ArrcarOption, $row->wc_option, '', 6, 'all', '');
		   ?></td>
                      </tr>
                      <tr>
                        <td height="50" align="center" bgcolor="f6f6f6">추가옵션</td>
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
                        <td height="30" align="center" bgcolor="f6f6f6">보관장소</td>
                        <td bgcolor="#FFFFFF" style="padding:3 0 0 10"><?
			if($row->wc_keep_area2){
				$keep_area = WriteArrHTML('select', 'area1', $ArrcarPlace , $row->wc_keep_area2, '', '' , 'direct', '' );
			}else{
				$keep_area = WriteArrHTML('select', 'area1', $ArrcarPlace , $row->wc_keep_area1, '', '' , 'direct', '' );
			}
			
			
			
			?>
                        </td>
                        <td width="100" align="center" bgcolor="f6f6f6">보관장소상세</td>
                        <td bgcolor="#FFFFFF" style="padding:3 0 0 10"><?=$wc_keep_place?>
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
                  <td height="30" colspan="2" class="title"><img src="http://wj10467.woojungnet.co.kr/img/sub/icon.jpg"  align="absmiddle" /> <strong>특이사항</strong></td>
                </tr>
                <tr>
                  <td colspan="2"><table width="755" border="1" cellpadding="0" cellspacing="1" bordercolor="#666666" bgcolor="dadada" style="padding:3 0 0 0">
                      <tr>
                        <td width="100" height="30" align="center" bgcolor="f6f6f6">메 모</td>
                        <td width="655" align="left" bgcolor="#FFFFFF" style="padding-left:10px;"><p>
                          <?=nl2br($row->wc_memo)?>
                        </p></td>
                      </tr>
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
                    * 낙찰 1회 포기시-한 달 입찰자격 정지, 2번 포기시-두 달, 3회 포기시-회원자격 박탈<br />
                    * 낙찰자의무:낙찰 통보일로 부터 24시간 이내에 잔여금을 납입하여야 하며, 만일 기일 내 미납시 입찰보증금 및 낙찰물건에
                    대하여<br />
                    가지는 일체의 권리를 포기하는 것으로 간주합니다. </td>
                </tr>
              </table>
            </div>
	  </div>
	</div>

	<? include "../inc/bottom.php" ?>
</div>
<iframe name="HiddenFrm" style="display:none;"></iframe>
<form name='signform' method='post' action='myzzim.php'>
	<input type="hidden" name="no" value="<?=$idx?>">
	<input type="hidden" name="userid" value="<?=$loginId?>">
</form>
<iframe width=0 height=0 name='hiddenframe' style='display:none;'></iframe></body>
</html>
