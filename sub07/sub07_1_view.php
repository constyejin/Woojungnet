<?include "../inc/header.php" ?>
<?
$idx=$wc_idx;
if($wc_idx){
	$qry = "select * from woojung_part where wc_idx = '$wc_idx'  ";
	$row = mysql_fetch_array(mysql_query($qry));
	$wc_car_img1 = explode("/",$row[wc_img_1]);
	$defaultFile = "/data2/".$wc_car_img1[0];
	$qry = "select * from woojung_member where userId = '$row[wc_mem_id]'  ";
	$row_m = mysql_fetch_array(mysql_query($qry));

	$cate1=mysql_fetch_array(mysql_query("select * from cate2 where idx='".$row[wc_made]."'"));
	$cate3=mysql_fetch_array(mysql_query("select * from cate3 where idx='".$row[wc_trans]."'"));

	// 오늘 본 상품 세션에 상품번호(p_no) 저장하기
	if(empty($_SESSION['VISIT'][0]) || is_null($_SESSION['VISIT'][0])) {
		$_SESSION['VISIT'][0] = $wc_idx;
	} elseif(!in_array($wc_idx, $_SESSION['VISIT'])) {
		$temp_p_no = $_SESSION['VISIT'][0];

		// 상품 밀기
		$_SESSION['VISIT'][0] = $wc_idx;
		$_SESSION['VISIT'][3] = $_SESSION['VISIT'][2];
		$_SESSION['VISIT'][2] = $_SESSION['VISIT'][1];
		$_SESSION['VISIT'][1] = $temp_p_no;
	}

}

?>
<? $menuNow ="?pageNum=1&subNum=1"; ?>
<script language="JavaScript" src="/admin/inc/default.js"></script>
<script type="text/javascript" src="/common/js/form.js"></script>
 <script type="text/javascript">


function detailView(pic, e) {
	
	var no = document.getElementById('zoomimgno').value;
	if(!pic)
	{
		pic = no;
	}	

	window.open('../inc/popup_pic3.php?pic='+pic+'&'+'idx='+<?=$idx?>,'imageWin','top=100,left=100,width=910,height=800,scrollbars=yes');

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

function zoomView(f, n, e){
  $('.img-wrap').css('border', 'none');
	$(e).parent('span').css('border', '2px solid #00b5ff');
	var obj = document.getElementById('zoomimg');
	obj.src = f;
	// if(obj.width > 400){
	// 	obj.style.width=400;
	// }else{
	// 	obj.style.width=obj.width;
	// }
	

	// if(obj.height > 328){
	// 	obj.style.height=328;
	// }else{
	// 	obj.style.height=obj.height;
	// }
	document.getElementById('zoomimgno').value = n;	
}



function ReSizeImg(){
	var obj = document.getElementById('zoomimg');
	var width = 780;
	var height = 600;

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
.info-table td{
  border-bottom: 1px solid #cccccc;
}


</style>
<script type="text/javascript" src="/common/js/form.js"></script>

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
	var bid_c = rs(f.c_bid_price.value);
	var bid_p = bid_c.replace(/^\$|,/g,"");
	if(parseInt(strt_amt_j) > parseInt(bid_p)  ){
		var strt_amt	= '<?=number_format($auction_strt_amt)?>';
		alert("입찰금액이 경매시작가 ("+strt_amt	+"원) 보다 작을수 없습니다.");
		return false;
	}

	var but = document.getElementById('bidButton').disabled;
	if(!validate(f)) {
		return false;
		but = false;
	}
	
		return true;
	
	
}

function part_del(idx){
	if(confirm('삭제 하시겠습니까?')){
		location.href="sub07_1_del2.php?wc_idx="+idx;
	}
}
</script>

  <div id="contents_basic">
 
    <div class="co_car_all">

  	<div class="sub-visual">
			<div class="sub-text">
        <p class="catch-phrase">
          중고차 / 보유차량
        </p>
        <p class="description-text">
          중고차 / 사고차 / 수출차량을 다량 보유하고 있습니다.
        </p>
			</div>
		</div>
        
   <div class="div_basic car-info-view">

    <table style="width:1200px;heidght:50px; margin:20 auto;">

    <tbody>

      <tr>
        <td heigth="50" colspan="3" align="center">
				<table width="140" border="0" cellpadding="5" cellspacing="0" style=" width:140px;margin-bottom: 40px;margin-top: 20px;">
                  <tr>
                    <td width="65">
                      <a href="sub07_1.php" style="display:inline-flex; justify-content: center; align-items:center;border: 2px solid #0066CC; border-radius: 20px; min-width: 80px; height: 32px;font-size: 12px;font-weight: 600;color:#0066CC; ">
                        목록보기
                      </a>
                    </td>
                    <td width="65">
<?
if($loginUsort == "admin" || $loginUsort == "admin2" || $loginUsort == "admin3" || $loginUsort == "superadmin" || $loginUsort == "jisajang2"){
?>
        <a href="sub07_1_write.php?wc_idx=<?=$wc_idx?>" style="display:inline-flex; justify-content: center; align-items:center;border: 2px solid #cc3535; border-radius: 20px; min-width: 80px; height: 32px;font-size: 12px;font-weight: 600;color: #cc3535;margin-left: 10px; ">
				수정하기
			</a>
<?
}
?>
					</td>
                  </tr>

                </table>                  
          
          
          
          <table>
        

     </tr>

</tbody>

</table>


   <div class="div_information">
    <table style="width:1200px;margin: 0 auto; margin-top:0px;" border="0" cellspacing="0" cellpadding="0">
      <thead>
        <tr>
          <td width="100%" height="50" align="left" colspan="4" bgcolor="#2cade2" style="padding-left : 20px ;padding-right: 5px; padding-top: 2px; color: #fff; font-size: 16px;">
            <span class="label">No :</span><span class="dd"><?=$row['wc_orderno']?></span> &nbsp;/&nbsp;
            <span class="dd"><?=$row['wc_mem_etc']?></span> &nbsp;/&nbsp;
            <span class="dd"><?=$row[wc_no]?></span> &nbsp;/&nbsp;
            <span class="dd"><?=$arr_wc_damage[$row[wc_damage]]?></span> &nbsp;/&nbsp;
            <span class="dd"><?=$row[wc_age]?> 년 <?=$row[wc_kind]?sprintf("%02d",$row[wc_kind]):""?> 월</span> &nbsp;/&nbsp;
            <span class="dd"><?=$row[wc_trans]?></span> &nbsp;/&nbsp;
            <span class="dd"><?=$row[wc_fual]?></span> &nbsp;/&nbsp;
            <span class="dd"><?=number($row[wc_cc])?>cc</span> &nbsp;/&nbsp;
            <span class="dd"><?=number($row[wc_mileage])?>km</span>
          </td>
        </tr>
        
        <tr>
          <td colspan="4">
            <!-- 차량이미지 -->
            <div class="car-image for-parts">
              <div class="img-wrap bxslider">
<?
$imgCnt = 0;
for($i=1; $i<=60; $i++) {

	$fim="wc_img_".$i;
	$fileName = $row[$fim];
	$real_name = explode('/', $fileName);	
	
	if(strlen($real_name[0]) == 0)
	{
		$fileName = '';
		$script = "";
		break;
	}
	else
	{
		$imgCnt++;
		$fileName = $site_u[home_url]."/data2/".$real_name[0];
		$script = " onClick=\"detailView($i)\" onmouseover=\"zoomView('$fileName', $i)\" style=\"cursor:pointer;\" ";
	}
?>
                <div data-hash="<?=$i?>" class="slide">
                  <img src="<?=$fileName?>" alt="차량이미지">
                </div> 
<?
	$cnt++;
}	
?>
              </div>
              <!-- <a href="javascript:void(0)" onclick="openLayerPop()" class="btn-zoom">더보기</a> -->
            </div>
            <!-- //차량이미지 -->

            <!-- 차량이미지 리스트 -->
            <div class="img-list-wrap view-thumb">
              <div class="img-list">
                <ul> 
<?
$imgCnt = 0;
for($i=1; $i<=60; $i++) {

	$fim="wc_img_".$i;
	$fileName = $row[$fim];
	$real_name = explode('/', $fileName);	
	
	if(strlen($real_name[0]) == 0)
	{
		$fileName = '';
		$script = "";
		break;
	}
	else
	{
		$imgCnt++;
		$fileName = $site_u[home_url]."/data2/".$real_name[0];
		$script = " onClick=\"detailView($i)\" onmouseover=\"zoomView('$fileName', $i)\" style=\"cursor:pointer;\" ";
	}
?>
                  <li data-thumb="<?=$i?>" <?=$i==1?'class="active"':''?>><img src="<?=$fileName?>" alt="차량이미지 썸네일"></li> 
<?
	$cnt++;
}	
?>
                </ul>
              </div>
            </div>
          </td>
        </tr>

        <tr style="display : block; margin-bottom : 10px"></tr>
      </thead>

      <tbody style="border: 1px solid #cccccc;"> 
        <tr style="border-top : 1px solid #ccc;">
          <td width="127" height="50" align="center" bgcolor="#f2f2f2" style="padding-right: 5px;  padding-top: 2px; border-right:1px solid #CCCCCC; border-bottom:1px solid #CCCCCC;color: #888888;font-size: 14px;font-weight: bold">고유번호 No.</td>

          <td width="200" height="50"  align="center" bgcolor="#FFFFFF" style="padding-left: 5px; padding-top: 2px; border-right:1px solid #CCCCCC;border-bottom:1px solid #CCCCCC; font-size: 15px;font-weight: bold;"><?=$row['wc_orderno']?></td>

          <td width="127" height="50" align="center" bgcolor="#f2f2f2" style="padding-right: 5px;  padding-top: 2px; border-right:1px solid #CCCCCC; border-bottom:1px solid #CCCCCC;color: #888888;font-size: 14px;font-weight: bold">판매상태 Sales status</td>

          <td width="200" height="50"  align="center" colspan="3" bgcolor="#FFFFFF" style="padding-left: 5px; padding-top: 2px; border-right:1px solid #CCCCCC;border-bottom:1px solid #CCCCCC; font-size: 13px;font-weight: bold">

            <div class="btn-group">
              <? if($row[calltype]=="1"){ ?>
              <a href class="btn btn-sm btn-red btn-round">sale</a>
              <? }else if($row[calltype]=="2"){ ?>
              <a href class="btn btn-sm btn-black btn-round">soldout</a>
              <? } ?>
            </div>
          </td>
        </tr>

        <tr>
          <td width="127" height="50" align="center" bgcolor="#f2f2f2" style="padding-right: 5px;  padding-top: 2px; border-right:1px solid #CCCCCC; border-bottom:1px solid #CCCCCC;color: #888888;font-size: 14px;font-weight: bold">차량명 Vehicle name</td>
          <td width="200" height="50"  align="center" colspan="3" bgcolor="#FFFFFF" style="padding-left: 5px; padding-top: 2px; text-align:left;border-bottom:1px solid #CCCCCC; font-size: 16px;font-weight: bold; padding-left:150px;"><?=$row['wc_mem_etc']?></td>
        </tr>

        <tr>
          <td width="127" height="50" align="center" bgcolor="#f2f2f2" style="padding-right: 5px;  padding-top: 2px; border-right:1px solid #CCCCCC; border-bottom:1px solid #CCCCCC;color: #888888;font-size: 14px;font-weight: bold">차량번호 Registration number</td>
          <td width="200" height="50"  align="center"  bgcolor="#FFFFFF" style="padding-left: 5px; padding-top: 2px; border-right:1px solid #CCCCCC;border-bottom:1px solid #CCCCCC; font-size: 15px;font-weight: bold"><?=$row[wc_no]?></td>
          <td width="127" height="50" align="center" bgcolor="#f2f2f2" style="padding-right: 5px;  padding-top: 2px; border-right:1px solid #CCCCCC; border-bottom:1px solid #CCCCCC;color: #888888;font-size: 14px;font-weight: bold">사고이력 History of accidents</td>
          <td width="200" height="50"  align="center"  bgcolor="#FFFFFF" style="padding-left: 5px; padding-top: 2px;  border-right:1px solid #CCCCCC;border-bottom:1px solid #CCCCCC; font-size: 15px;font-weight: bold"><?=$arr_wc_damage[$row[wc_damage]]?></td>
        </tr>

        <tr>
          <td width="127" height="50" align="center" bgcolor="#f2f2f2" style="padding-right: 5px;  padding-top: 2px; border-right:1px solid #CCCCCC; border-bottom:1px solid #CCCCCC;color: #888888;font-size: 14px;font-weight: bold">제조사 Manufacturer</td>
          <td width="200" height="50"  align="center"  bgcolor="#FFFFFF" style="padding-left: 5px; padding-top: 2px; border-right:1px solid #CCCCCC;border-bottom:1px solid #CCCCCC; font-size: 15px;font-weight: bold"><?=$cate1[name]?></td>
          <td width="127" height="50" align="center" bgcolor="#f2f2f2" style="padding-right: 5px;  padding-top: 2px; border-right:1px solid #CCCCCC; border-bottom:1px solid #CCCCCC;color: #888888;font-size: 14px;font-weight: bold">모델명 Model</td>
          <td width="200" height="50"  align="center"  bgcolor="#FFFFFF" style="padding-left: 5px; padding-top: 2px;  border-right:1px solid #CCCCCC;border-bottom:1px solid #CCCCCC; font-size: 15px;font-weight: bold"><?=$row[wc_model]?></td>
        </tr>

        <tr>
          <td width="127" height="50" align="center" bgcolor="#f2f2f2" style="padding-right: 5px;  padding-top: 2px; border-right:1px solid #CCCCCC; border-bottom:1px solid #CCCCCC;color: #888888;font-size: 14px;font-weight: bold">년식 Model year</td>
          <td width="200" height="50"  align="center"  bgcolor="#FFFFFF" style="padding-left: 5px; padding-top: 2px;  border-right:1px solid #CCCCCC;border-bottom:1px solid #CCCCCC; font-size: 15px;font-weight: bold"><?=$row[wc_age]?> 
          <span style="font-weight: normal; margin-right : 8px">년</span>
		  <?=$row[wc_kind]?>
          <span style="font-weight: normal">월</span>
        </td>
          <td width="127" height="50" align="center" bgcolor="#f2f2f2" style="padding-right: 5px;  padding-top: 2px; border-right:1px solid #CCCCCC; border-bottom:1px solid #CCCCCC;color: #888888;font-size: 14px;font-weight: bold">변속기 Transmission</td>
          <td width="200" height="50"  align="center"  bgcolor="#FFFFFF" style="padding-left: 5px; padding-top: 2px; border-right:1px solid #CCCCCC;border-bottom:1px solid #CCCCCC; font-size: 15px;font-weight: bold"><?=$row[wc_trans]?></td>
        </tr>

        <tr>
          <td width="127" height="50" align="center" bgcolor="#f2f2f2" style="padding-right: 5px;  padding-top: 2px; border-right:1px solid #CCCCCC; border-bottom:1px solid #CCCCCC;color: #888888;font-size: 14px;font-weight: bold">연료 Fuel Type</td>
          <td width="200" height="50"  align="center"  bgcolor="#FFFFFF" style="padding-left: 5px; padding-top: 2px;  border-right:1px solid #CCCCCC;border-bottom:1px solid #CCCCCC; font-size: 15px;font-weight: bold"><?=$row[wc_fual]?></td>
          <td width="127" height="50" align="center" bgcolor="#f2f2f2" style="padding-right: 5px;  padding-top: 2px; border-right:1px solid #CCCCCC; border-bottom:1px solid #CCCCCC;color: #888888;font-size: 14px;font-weight: bold">배기량 Displacement</td>
          <td width="200" height="50"  align="center"  bgcolor="#FFFFFF" style="padding-left: 5px; padding-top: 2px;  border-right:1px solid #CCCCCC;border-bottom:1px solid #CCCCCC; font-size: 15px;font-weight: bold"><?=number($row[wc_cc])?> <span style="font-weight: normal">cc</span></td>
        </tr>

        <tr>
          <td width="127" height="50" align="center" bgcolor="#f2f2f2" style="padding-right: 5px;  padding-top: 2px; border-right:1px solid #CCCCCC; border-bottom:1px solid #CCCCCC;color: #888888;font-size: 14px;font-weight: bold">주행거리 Odometer</td>
          <td width="200" height="50"  align="center"  bgcolor="#FFFFFF" style="padding-left: 5px; padding-top: 2px; border-right:1px solid #CCCCCC;border-bottom:1px solid #CCCCCC; font-size: 15px;font-weight: bold"><?=number($row[wc_mileage])?> <span style="font-weight: normal">km</span></td>
          <td width="127" height="50" align="center" bgcolor="#f2f2f2" style="padding-right: 5px;  padding-top: 2px; border-right:1px solid #CCCCCC; border-bottom:1px solid #CCCCCC;color: #888888;font-size: 14px;font-weight: bold">판매가격 Price</td>
          <td width="200" height="50"  align="center"  bgcolor="#FFFFFF" style="padding-left: 5px; padding-top: 2px; border-right:1px solid #CCCCCC;border-bottom:1px solid #CCCCCC; font-size: 15px;font-weight: bold"><?=number($row[wc_keep_tel1])?>만원 <?=$row[wc_cost]!="1"?"":"할부가능"?></td>
        </tr>

        <tr>
          <td width="100%" height="50" align="center" colspan="4" bgcolor="#f2f2f2" style="padding-right: 5px;  padding-top: 2px; border-right:1px solid #CCCCCC; border-bottom:1px solid #CCCCCC;color: #888888;font-size: 14px;font-weight: bold">상세설명 Sale Information</td>
        </tr>

        <tr>
          <td colspan="4" height="100" style="padding: 20px;">
            <?=$row[wc_option_add]?>
          </td>
        </tr>
      </tbody>

      </table>
      <script>
        // swiper
        // 차량이미지 swipe기능
        $(function(){
          var bx = $('.bxslider').bxSlider({
            mode: 'fade',
            speed: 100,
            slideWidth: 1200,
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
    </div>
  
				<table width="140" border="0" cellpadding="5" cellspacing="0" style=" width:140px;margin-bottom: 40px;margin-top: 20px;">
                  <tr>
                    <td width="65">
                      <!--<a href="sub07_1.php"><img src="/images/list_bt.jpg" /></a>-->
                      <a href="sub07_1.php" style="display:inline-flex; justify-content: center; align-items:center;border: 2px solid #0066CC; border-radius: 20px; min-width: 80px; height: 32px;font-size: 12px;font-weight: 600;color:#0066CC; ">
                        목록보기
                      </a>
                    </td>
                    <td width="65">
<?
if($loginUsort == "admin" || $loginUsort == "admin2" || $loginUsort == "admin3" || $loginUsort == "superadmin" || $loginUsort == "jisajang2"){
?>
				<!--<a href="sub07_1_write.php?wc_idx=<?=$wc_idx?>"><img src="/images/edit_bt.jpg" /></a>-->
        <a href="sub07_1_write.php?wc_idx=<?=$wc_idx?>" style="display:inline-flex; justify-content: center; align-items:center;border: 2px solid #cc3535; border-radius: 20px; min-width: 80px; height: 32px;font-size: 12px;font-weight: 600;color: #cc3535;margin-left: 10px; ">
				수정하기
			</a>
<?
}
?>
					</td>
                  </tr>

                </table>                  
                </table>                  




	<!-- footer -->
  <div class="cha_footer"><? include "../inc/bottom.php" ?></div>
</div>
</body>
</html>
