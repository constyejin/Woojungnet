<?include "../inc/header.php" ?>
              <?
	// 출품자 정보를 불러온다.
	$Qry = "SELECT a.*, 
				b.team_code, b.team_name, b.team_subname, b.team_subname_etc ,
				b.company_tel, b.tel, b.pcs, b.fax, b.company_name, 
				b.company_sort, b.company_subsort , b.usort , c.*
			FROM woojung_car2 as a 
				left join woojung_member as b  on a.wc_mem_id = b.userId  
				left join woojung_car_go as c on a.wc_idx = c.wcg_wcidx 			
			WHERE a.wc_idx = '$idx'  ";

	$row = mysql_fetch_array(mysql_query($Qry));
	

	// 제휴 회원이라면
	if( substr($row['usort'], 0, 3) == "com" ){
		$companyNm = $row[team_name];
		$companysubNm = $row[team_subname];
		$wc_mem_etc = $row[wc_mem_etc];	
		$companyInfo = $companyNm ." / ".$companysubNm;
	}else{ // 일반출품 or 구매회원
		$companyInfo = "";
		$wc_mem_etc = $row[wc_mem_etc];		
	}
	




$wc_car_img1 = explode("/",$row[wc_img_1]);
$defaultFile = "/data/".$wc_car_img1[0];
 ?>


<? $menuNow ="?pageNum=1&subNum=1"; ?>

<script type="text/javascript">


function detailView(pic) {
		
	var no = document.getElementById('zoomimgno').value;
	if(!pic)
	{
		pic = no;
	}	

	window.open('/inc/popup_pic2.php?pic='+pic+'&'+'idx='+<?=$idx?>,'imageWin','top=100,left=100,width=810,height=1000');

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
//	document.getElementById('zoomimgno').value = n;	
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
.join_img_body table.join_form tr th { background:#f7f7f7; border:1px solid #666666; font-weight:normal;font-color:#FF0000; }
    .style3 {font-size: 16px}
    .style4 {
	color: #FF0000;
	font-weight: bold;
}
.style8 {font-size: 11px}
    </style>


<div id="new_wrap">

	<div id="main_wrap">
		<div id="cha_contents">
			<!-- login -->
			<div id="con_left">
<?include "../inc/login.php";?>
				<!-- 좌측 서브 메뉴 start -->
<?include "mypage_menu.php";?>
				<!-- 좌측 서브 메뉴 end -->
			</div>
			<div id="con_right">
				<h1><img src="/images/img_sub1.jpg"></h1>
				<table width="760" border="0" cellspacing="0" cellpadding="0">
					<tr> 
						<td height="1"></td>
					</tr>
					<tr> 
						<td height="38" align="left" valign="bottom"><img src="/images/img_mypage_2_bar.gif" /></td>
					</tr>
				</table>	
			<!--컨텐츠 부분-->
			    <table width="755" border="0" cellspacing="0" cellpadding="0">
                   <tr>
                    <td height="20" colspan="2" align="left" valign="middle">&nbsp;</td>
                  </tr>
                  <tr>
                    <td height="20" align="left" valign="middle"><strong>진행상태:</strong><font color="#0033CC"><strong><?=$row[calltype]?></strong></font></td>
                    <td align="right" valign="middle">최종수정일:<?=$row[wc_regdate]?></td>
                  </tr>
                  <tr>
                    <td colspan="2"><table width="755" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td width="362" align="center" valign="top"><table width="340" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td><table width="340" height="329" border="1" cellpadding="0" cellspacing="1" bordercolor="BABABA" bgcolor="BABABA">
                                  <tr>
                                    <td align="center" bgcolor="#FFFFFF"><div id='picDisplay'><img id="zoomimg" src="<?=$defaultFile?>" width="385" height="338" /></div>
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
                                    <table width="340" border="0" cellspacing="0" cellpadding="0">
                                      <tr>
                                      <?
for($i=1; $i<=24; $i++) {

	$fim="wc_img_".$i;
	$fileName = $row[$fim];
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
                                        <td width="57" height="44" align="center" bgcolor="BABABA"><img src="<?=$fileName?>" width="62" height="44"    <?=$script?> /></td>
                                        <td width="3"></td>
                                      <?
					  if($i%6 == 0){
							echo "</tr>
								  <tr><td colspan=13 height=3></td></tr>							
								  <tr>";  
					  }
}	
?>
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
                                        <td width="95" height="25" align="right" bgcolor="#f2f2f2" style="padding-right: 5px;  padding-top: 2px;">출품번호 
                                          : </td>
                                        <td height="25" bgcolor="#FFFFFF" class="text04" style="padding-left: 5px; padding-top: 2px; text-align:left; font-weight:normal;"> <?=$row[wc_orderno]?> </td>
                                      </tr>
                                      <tr>
                                        <td width="95" height="25" align="right" bgcolor="#f2f2f2" style="padding-right: 5px;  padding-top: 2px;">모델명 
                                          : </td>
                                        <td height="25" bgcolor="#FFFFFF" class="text04 style3" style="padding-left: 5px; padding-top: 2px; text-align:left; font-weight:bold;"><?
$sql="select * from cate2 where idx='$row[wc_made]' ";
$result_made=mysql_query($sql);
$data_made=mysql_fetch_array($result_made);
echo $data_made[name];
?>

 / <?=$row[wc_model ]?> <?if($row[wc_model2]) echo "/".$row[wc_model2];?> </td>

                                      </tr>
                                      <tr>
                                        <td height="25" align="right" bgcolor="#f2f2f2" style="padding-right: 5px; padding-top: 2px;">판매가격 
                                          : </td>
                                        <td height="25" bgcolor="#FFFFFF" style="padding-left: 5px;  padding-top: 2px; text-align:left;"><span class="style4"><?=number_format($row[wc_price])?></span> 원 </td>
                                      </tr>
                                      <tr>
                                        <td height="25" align="right" bgcolor="#f2f2f2" style="padding-right: 5px; padding-top: 2px;">년식 :</td>
                                        <td height="25" bgcolor="#FFFFFF" style="padding-left: 5px;  padding-top: 2px; text-align:left;"> <?=substr($row[wc_age],0,4)?>년 <?=substr($row[wc_age],2,2)?>월</td>
                                      </tr>
                                      <tr>
                                        <td height="25" align="right" bgcolor="#f2f2f2" style="padding-right: 5px; padding-top: 2px;">변속기 :</td>
                                        <td height="25" bgcolor="#FFFFFF" style="padding-left: 5px;  padding-top: 2px; text-align:left;"><?=$row[wc_trans]?></td>
                                      </tr>
                                      <tr>
                                        <td height="25" align="right" bgcolor="#f2f2f2" style="padding-right: 5px; padding-top: 2px;"> 연료 :</td>
                                        <td height="25" bgcolor="#FFFFFF" style="padding-left: 5px;  padding-top: 2px; text-align:left;"><?=$row[wc_fual]?></td>
                                      </tr>
                                      <tr>
                                        <td height="25" align="right" bgcolor="#f2f2f2" style="padding-right: 5px; padding-top: 2px;">배기량 :</td>
                                        <td height="25" bgcolor="#FFFFFF" style="padding-left: 5px;  padding-top: 2px; text-align:left;"><?=number_format($row[wc_cc])?> cc</td>
                                      </tr>
                                      <tr>
                                        <td height="25" align="right" bgcolor="#f2f2f2" style="padding-right: 5px; padding-top: 2px;"> 주행거리 :</td>
                                        <td height="25" bgcolor="#FFFFFF" style="padding-left: 5px;  padding-top: 2px; text-align:left;"><?=number_format($row[wc_mileage])?> km</td>
                                      </tr>
                                      <tr>
                                        <td height="25" align="right" bgcolor="#f2f2f2" style="padding-right: 5px; padding-top: 2px;">사고유무 :</td>
                                        <td height="25" bgcolor="#FFFFFF" style="padding-left: 5px;  padding-top: 2px; text-align:left;"><?=$row[wc_acc_date]?></td>
                                      </tr>
                                    </table>
                                <!--// 공매 진행 End //-->                                </td>
                            </tr>
                              <tr>
                                <td style="padding:10 10 10 10"><table width="100%" border="0" cellspacing="0" cellpadding="1">
                                    <!--<tr>
                                  <td width="15" valign="top" style="padding-top:3px;">※</td>
                                  <td>
									<table width="100%" border="0" cellspacing="0" cellpadding="1">
                                      <tr>
                                        <td>경매의 경우 입찰급액 수정은 3회로 제한되오니 신중히 입찰바랍니다.</td>
                                      </tr>
                                  </table></td>
                                </tr>-->
                                    <tr>
                                      <td valign="top" style="padding-top:3px;">※</td>
                                      <td rowspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="1">
                                          <tr>
                                            <td align="left"><p>차량정보는 판매자가 직접올린것이므로 당사와 무관합니다</p></td>
                                          </tr>
                                          <tr>
                                            <td align="left">모든 차량에 정확한 정보는 판매자와 상의하세요</td>
                                          </tr>
                                      </table></td>
                                    </tr>
                                    <tr>
                                      <td valign="top" style="padding-top:3px;">※</td>
                                    </tr>
                                </table></td>
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
                              <table width="360" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td height="10"></td>
                                </tr>
                                <tr>
                                  <td align="left"><strong><span class="title"><img src="/images/icon.jpg"  align="absmiddle" /></span> 판매자정보</strong></td>
                                </tr>
                              </table>
                            <table width="360" class="join_form" bordercolor="#FF0000" border="1" cellspacing="1" cellpadding="0">
                        <tr>
                                  <td width="83" height="20" bgcolor="#FED3FC" style="padding:5px; text-align:right;">상호명:</td>
                                  <td width="268" style="text-align:left; padding:0 0 0 10px;"><strong><?=$row[wc_adminName]?></strong></td>
                              </tr>
                                <tr>
                                  <td width="83" height="20" bgcolor="#FED3FC" style="padding:5px; text-align:right;;" >일반전화:</td>
                                  <td style="text-align:left; padding-left:10px;"><strong><?=$row[wc_mem_phone]?></strong></td>
                              </tr>
                                <tr>
                                  <td height="20" bgcolor="#FED3FC" style="padding:5px; text-align:right;;">휴대전화: </td>
                                  <td style="text-align:left; padding-left:10px;"><strong><?=$row[wc_mem_mobile]?></strong></td>
                              </tr>
                                <tr>
                                  <td width="83" height="20" bgcolor="#FED3FC" style="padding:5px; text-align:right;;" >담당자:</td>
                                  <td style="text-align:left; padding-left:10px;"><strong><?=$row[wc_mem_name]?></strong></td>
                              </tr>
                                <tr>
                                  <td height="20" bgcolor="#FED3FC" style="padding:5px; text-align:right;;">이메일: </td>
                                  <td style="text-align:left; padding-left:10px;"><strong><?=$row[wc_mem_etc]?></strong></td>
                              </tr>
                            </table>
                          <br /></td>
                        </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td colspan="2">&nbsp;</td>
                  </tr>
    <td colspan="2" align="center"><a href="/mypage/sub02.php"><img src="/images/bt05.jpg" border="0" /></a>&nbsp;&nbsp;<a href="/mypage/sub02_modify.php?wc_idx=<?=$idx?>"><img src="/images/bt06.jpg" border="0" /></a></td>
  </tr>
  <tr>
    <td height="30" colspan="2" class="title"><img src="/images/icon.jpg"  align="absmiddle" /> <strong>추가정보</strong></td>
  </tr>
  <tr>
    <td colspan="2"><table width="755" border="1" cellpadding="0" cellspacing="1" bordercolor="#666666" bgcolor="#CCCCCC" style="padding:3 0 0 0;word-break:break-all;">
      <tr>
        <td width="92" height="30" align="center" bgcolor="f6f6f6">기본옵션</td>
        <td width="654" height="90" align="center" bgcolor="#FFFFFF" style="padding-left:10px; line-height:18px;">
		   <?
			//== /lib/code.php 안에 있음
			WriteArrHTML('checkbox', 'carOption[]', $ArrcarOption, $row[wc_option], '', 6, 'all', '');
		   ?>		</td>
      </tr>
      <tr>
        <td height="50" align="center" bgcolor="f6f6f6">추가옵션</td>
        <td align="left" bgcolor="#FFFFFF" style="padding-left:10px;" ><?=$row[wc_option_add]?></td>
      </tr>
      <tr>
        <td height="60" align="center" bgcolor="f6f6f6">설명문구</td>
        <td align="left" bgcolor="#FFFFFF" style="padding-left:10px;" > <?=nl2br($row[wc_damage])?> </td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" align="center"><a href="/mypage/sub02.php"><img src="/images/bt05.jpg" border="0" /></a>&nbsp;&nbsp;<a href="/mypage/sub02_modify.php?wc_idx=<?=$idx?>"><img src="/images/bt06.jpg" border="0" /></a></td>
  </tr>
  <tr>
    <td colspan="2" align="left">&nbsp;</td>
  </tr>
                </table>



			</div>
		</div>
	</div>
	<!-- footer -->
	<div class="cha_footer"><? include "../inc/bottom.php" ?></div>
</div>

</body>
</html>

