<?
	include $_SERVER['DOCUMENT_ROOT'].'/manage/inc/header.php';
	include $_SERVER['DOCUMENT_ROOT'].'/manage/inc/top_menu.php';
	include $_SERVER['DOCUMENT_ROOT'].'/manage/inc/global.php';
	$pno=3;
?>
<script type="text/javascript">
<!--
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}
//-->

// 팝업
function popup() {  
 var newwin,
  w_url = '/manage/Sale10/pop_buy.php',
  w_name = '',
  w_width = 1000,
  w_height = 700,
  w_left = (screen.width - w_width)/2,
  w_top = (screen.height - w_height)/2,
  w_options = 'width='+ w_width +', height='+ w_height +', left='+ w_left +', top='+ w_top +', scrollbars=yes';

 newwin = open(w_url, w_name, w_options);
 if(window.focus) newwin.focus();
};

// 팝업
function popup1(no) {  
 var newwin,
  w_url = '/admin/pop_buy.php?no='+no,
  w_name = 'a',
  w_width = 730,
  w_height = 600,
  w_left = (screen.width - w_width)/2,
  w_top = (screen.height - w_height)/2,
  w_options = 'width='+ w_width +', height='+ w_height +', left='+ w_left +', top='+ w_top +', scrollbars=yes';

 newwin = open(w_url, w_name, w_options);
 if(window.focus) newwin.focus();
};


</script>
<style>
  .btn_pink {
    cursor: pointer;
    background-color: #fae3e3;
    color: #ff0000;
    border: #ff0000 1px solid;
  }
  .btn_blue {
    cursor: pointer;
    background-color: #e7f1f9;
    color: #084573;
    border: #636563 1px solid;
  }
  </style>
<table width="100%" border="0" cellpadding="0" cellspacing="0" height='100%' >
	<tr>
		<td valign='top'>
		                <table width="100%" border="0" cellpadding="0" cellspacing="0" >
                          <tr>
							<!-- <td width='145' align='center' valign="top" style='font-size:14px;'>
							<-? // left ?>	
							<-? include "../inc/sm_calculate.php";?>
							</td> -->
                <!-- <td width="1" height="400" valign="top" style="background-color:#bbb;"></td> -->
                            <td valign="top" style='padding:10px;' >
                            <table width="1200" cellspacing="0" cellpadding="0" border="0" style="margin:0 auto" >
                              <tr>
                                <td height="5"><table width="1200">
                                  <tr>
                                    <td  align="left">등록일:<?=date("Y-m-d")?></td>
                                    <td  align="right">등록자: <?=$drow[0]?></td>
                                  </tr>
                                </table></td>
                              </tr>
                              <tr>
                                <td valign="top">
								
<form name="cform" method=post action="regexc.php" target="HiddenFrm" style="margin:0px;" onsubmit="return false;">
<input type=hidden name=mode value=reg>
<input type=hidden name="sale_idx">
								<table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#626262" frame="border or box " style="border-collapse:collapse; border-color:rgb(194, 194, 194);" class='pad_10'>
                                    <tr>
                                      <td height="30" colspan="2" align="center" bgcolor="f3f3f3" class="p_tt"><strong>차량정보</strong></td>
<td colspan="2" align="center" bgcolor="f3f3f3" style="padding-left:170px;" class="p_tt"><strong>매입정보</strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="button" id="button2" value="선택" onClick="popup();" class="btn_pink"></td>
                                  </tr>
                                    <tr>
                                      <td width="15%" height="30" align="center" bgcolor="f7f7f7">차&nbsp;량&nbsp;명</td>
                                      <td width="35%" height="25" align="left" style="padding-left:10px"><input  type="text" class="ipip" name="carname" vvalue="K5" size="35"></td>
                                      <td width="15%" align="center" bgcolor="f7f7f7">매&nbsp;입&nbsp;처</td>
                                      <td align="left"><span id="salepalce"></span></td>
                                    </tr>
                                    <tr>
                                      <td height="30" align="center" bgcolor="f7f7f7">차량번호</td>
                                      <td height="25" align="left"  style="padding-left:10px"><input type="text" class="ipip" name="carnum" vvalue="01 가 1234" size="35"></td>
                                      <td align="center" bgcolor="f7f7f7" >연&nbsp;락&nbsp;처</td>
                                      <td align="left"><span id="salephone"></span></td>
                                    </tr>
                                    <tr>
                                      <td height="30" align="center" bgcolor="f7f7f7">년&nbsp;&nbsp;&nbsp;&nbsp;식</td>
                                      <td height="25" align="left"  style="padding-left:10px"><input type="text" class="ipip" name="carym1" vvalue="2010" size="10" maxlength="4">
                                        년 &nbsp;&nbsp;
                                        <input type="text" class="ipip" vvalue="5" name="carym2" size="8" maxlength="2">
                                        월</td>
                                      <td align="center" bgcolor="f7f7f7">담&nbsp;당&nbsp;자</td>
                                      <td height="25" align="left"  style="padding-left:10px"><input type="text" class="ipip" name="charge" vvalue="홍길동" size="20"></td>
                                    </tr>
                                    <tr>
                                      <td height="30" align="center" bgcolor="f7f7f7">연&nbsp;&nbsp;&nbsp;&nbsp;료</td>
                                      <td align="left"    style="padding-left:5px"><input type="radio" name="oil" id="checkbox2" value="1"/>
                                        휘발유
                                        <input type="radio" name="oil" id="checkbox2" value="2"/>
                                        디젤
                                        <input type="radio" name="oil" id="checkbox2" value="3"/>
                                        LPG
                                        <input type="radio" name="oil" id="checkbox2" value="4"/>
                                        겸용 
                                        <input type="radio" name="oil" id="checkbox2" value="5"/>
                                        하이브리드 </td>
                                      <td align="center" bgcolor="f7f7f7">매입유형</td>
                                      <td align="left"    style="padding-left:5px"><input type="radio" name="saletype" id="checkbox9" value="1"/>
                                        폐차/수출
                                        <input type="radio" name="saletype" id="checkbox9" value="2"/>
                                        구제/보관</td>
                                    </tr>
                                </table>
                                <tr>
                                <td height="10" valign="top"></td>
                              </tr>
                              <tr>
                                <td valign="top"><table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#626262" frame="border or box " style="border-collapse:collapse; border-color:rgb(194, 194, 194);" class='pad_10'>
                                    <tr>
                                      <td height="30" colspan="3" align="center" bgcolor="f3f3f3" class="p_tt"><strong>차주정보</strong></td>
                                      <td colspan="2" align="center" bgcolor="f3f3f3" class="p_tt"><strong>출고지정보</strong></td>
                                </tr>
                                    <tr>
                                      <td width="15%" height="30" align="center" bgcolor="f7f7f7" >소 유 자</td>
                                      <td width="17%" height="25" align="left"  style="padding-left:10px"><input type="text" name="owner" vvalue="홍길동" size="17"></td>
                                      <td width="18%" align="left"  style="padding-left:10px"><input type="text" class="ipip" name="ownernum1" vvalue="690920" size="6" maxlength="6">
                                        -
                                        <input type="text" class="ipip" name="ownernum2" vvalue="1234567" size="7" maxlength="7"></td>
                                      <td width="15%" align="center" bgcolor="f7f7f7">출 고 처</td>
                                      <td align="left"  style="padding-left:10px"><input type="text" class="ipip" name="outcom" vvalue="카카오토" size="35"></td>
                                    </tr>
                                    <tr>
                                      <td height="30" align="center" bgcolor="f7f7f7">공동명의자</td>
                                      <td height="25" align="left"  style="padding-left:10px"><input type="text" size="17" name="commname"></td>
                                      <td align="left"  style="padding-left:10px"><input type="text" class="ipip" size="6" name="commnum1" maxlength="6">
                                        -
                                        <input type="text" class="ipip" size="7" maxlength="7" name="commnum2"></td>
                                      <td align="center" bgcolor="f7f7f7">연&nbsp;락&nbsp;처</td>
                                      <td align="left"  style="padding-left:10px"><p>
                                          <input type="text" class="ipip" vvalue="010" size="6" maxlength="6" name="outphone1">
                                        -
                                        <input type="text" class="ipip" vvalue="1234" size="6" maxlength="4" name="outphone2">
                                        -
                                        <input type="text" class="ipip" vvalue="5678" size="6" maxlength="4" name="outphone3">
                                      </p></td>
                                    </tr>
                                    <tr>
                                      <td height="30" align="center" bgcolor="f7f7f7">소유자연락처</td>
                                      <td height="25" colspan="2" align="left"  style="padding-left:10px"><input type="text" class="ipip" name="ownerphone1" vvalue="010" size="6" maxlength="4">
                                        -
                                        <input type="text" class="ipip" vvalue="1234" size="6" maxlength="4" name="ownerphone2">
                                        -
                                        <input type="text" class="ipip" vvalue="5678" size="6" maxlength="4" name="ownerphone3"></td>
                                      <td align="center" bgcolor="f7f7f7">주&nbsp;&nbsp;&nbsp;&nbsp;소</td>
                                      <td height="25" align="left"  style="padding-left:10px"><input type="text" class="ipip" name="outadd" vvalue="서울시 영등포구 신길동" size="35"></td>
                                    </tr>
                                    <tr>
                                      <td height="30" align="center" bgcolor="f7f7f7">소유형태</td>
                                      <td colspan="2" align="left"    style="padding-left:5px"><input type="radio" name="ownertype" value=1>
                                        사업자
                                        <input type="radio" name="ownertype" value=2>
                                        법인
                                        <input type="radio" name="ownertype" value=3>
                                        개인
                                        <input type="radio" name="ownertype" value=4>
                                        영업용</td>
                                      <td align="center" bgcolor="f7f7f7">비&nbsp;&nbsp;&nbsp;&nbsp;고</td>
                                      <td align="left"  style="padding-left:10px"><input type="text" class="ipip" name="outetc" size="35"></td>
                                    </tr>
                                </table></td>
                              </tr>
                              <tr>
                                <td height="10" valign="top"></td>
                              </tr>
                              <tr>
                                <td valign="top"><table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#626262" frame="border or box " style="border-collapse:collapse; border-color:rgb(194, 194, 194);" class='pad_10'>
                                    <tr>
                                      <td height="30" colspan="4" align="center" bgcolor="f3f3f3" class="p_tt"><strong>차량관리</strong></td>
                                </tr>
                                    <tr>
                                      <td width="15%" height="30" align="center" bgcolor="f7f7f7">입고유무</td>
                                      <td height="25" align="left"   style="padding-left:5px"><input type="radio" name="stokeor" id="checkbox10" value=1>
                                        입고
                                        <input type="radio" name="stokeor" id="checkbox10" value=2>
                                        미입고 </td>
                                      <td height="25" align="center" bgcolor="f7f7f7">입고일자</td>
                                      <td height="25"  style="padding-left:10px"><input type="text" class="ipip" name="stokeday1" vvalue="2011" size="6" maxlength="4">
                                        년
                                        <input type="text" class="ipip" name="stokeday2" vvalue="10" size="6" maxlength="2">
                                        월
                                        <input type="text" class="ipip" name="stokeday3" vvalue="10" size="6" maxlength="2">
                                        일</td>
                                    </tr>
                                    <tr>
                                      <td height="30" align="center" bgcolor="f7f7f7">입고유형</td>
                                      <td width="35%" height="25" align="left"    style="padding-left:5px"><input type="radio" name="stoketype" id="checkbox11" value=1>
                                        일반폐차
                                        <input type="radio" name="stoketype" id="checkbox12" value=2>
                                        차령초과
                                        <input type="radio" name="stoketype" id="checkbox13" value=3>
                                        조기폐차</td>
                                      <td width="15%" align="center" bgcolor="f7f7f7">진행일자</td>
                                      <td height="25" align="left"  style="padding-left:10px"><input type="text" class="ipip" vvalue="2011" name="progday1" size="6" maxlength="4">
                                        년
                                        <input type="text" class="ipip" vvalue="10" name="progday2" size="6" maxlength="2">
                                        월
                                        <input type="text" class="ipip" vvalue="10" name="progday3" size="6" maxlength="2">
                                        일</td>
                                    </tr>
                                    <tr>
                                      <td width="15%" height="30" align="center" bgcolor="f7f7f7">번&nbsp;호&nbsp;판</td>
                                      <td height="25" align="left"  style="padding-left:10px" ><input type="text" class="ipip" vvalue="2" name="numpan" size="3" maxlength="3">
                                        개 </td>
                                      <td height="25" align="center" bgcolor="f7f7f7">등&nbsp;록&nbsp;증</td>
                                      <td height="25" align="left"    style="padding-left:5px"><input type="radio" name="reglicence" id="checkbox14" value=1>
                                        유
                                        <input type="radio" name="reglicence"  id="checkbox14" value=2>
                                        무</td>
                                    </tr>
                                    <tr>
                                      <td height="30" align="center" bgcolor="f7f7f7">저&nbsp;&nbsp;&nbsp;&nbsp;당</td>
                                      <td height="25" align="left"  style="padding-left:10px"><input type="text" class="ipip" name="collateral" vvalue="2" size="3" maxlength="3">
                                        건</td>
                                      <td height="25" align="center" bgcolor="f7f7f7">압&nbsp;&nbsp;&nbsp;&nbsp;류</td>
                                      <td height="25" align="left"  style="padding-left:10px"><input type="text" class="ipip" name="seize" vvalue="3" size="3" maxlength="3">
                                        건</td>
                                    </tr>
                                    <tr>
                                      <td height="30" align="center" bgcolor="f7f7f7">폐&nbsp;차&nbsp;증</td>
                                      <td height="25" align="left"    style="padding-left:5px"><input type="radio" name="junkcar" id="checkbox" value=1>
발급
  <input type="radio" name="junkcar" id="checkbox" value=2>
미발급 </td>
                                      <td height="25" align="center" bgcolor="f7f7f7">품의번호</td>
                                      <td height="25"  style="padding-left:10px"><input type="text" class="ipip" size="35" name="consulnum"></td>
                                    </tr>
                                </table></td>
                              </tr>
                              <tr>
                                <td height="10" valign="top"></td>
                              </tr>
                              
                              <tr>
                                <td height="10"></td>
                              </tr>
                              <tr>
                                <td height="20" valign="top" class="p_tt"><strong>지급요청내역</strong></td>
                              </tr>
                              <tr>
                                <td valign="top">
								<table width="100%" border="1"  bordercolor="#626262"  cellpadding="0" cellspacing="0" frame="border or box " style="border-collapse:collapse; border-color:rgb(194, 194, 194);" class='pad_10'>
                                    <tr>
                                      <td height="30" align="center" bgcolor="f3f3f3" class="p_tt" >NO</td>
                                      <td align="center" bgcolor="f3f3f3" class="p_tt">거래처</td>
                                      <td height="30" align="center" bgcolor="f3f3f3" class="p_tt">은행명</td>
                                      <td width="15%" height="30" align="center" bgcolor="f3f3f3" class="p_tt">계좌번호</td>
                                      <td height="30" align="center" bgcolor="f3f3f3" class="p_tt">예금주</td>
                                      <td height="30" align="center" bgcolor="f3f3f3" class="p_tt">지급내역</td>
                                      <td height="30" align="center" bgcolor="f3f3f3" class="p_tt">청구금액</td>
                                      <td width="10%" height="30" align="center" bgcolor="f3f3f3" class="p_tt">구분</td>
                                    </tr> 
									<?for($i=1;$i<7;$i++){?>
									<input type="hidden" name="admcom_idx<?=$i?>">
                                    <tr>
                                      <td width="4%" height="30" align="center"><?=$i?></td>
                                      <td width="15%" height="30" align="center"><input type="text" class="ipip" name="company<?=$i?>" vvalue="지급처1" size="13" onClick="popup1(<?=$i?>);"></td>
                                      <td width="12%" height="30" align="center"><span id="bankname<?=$i?>"></span></td>
                                      <td height="30" align="center"><span id="banknum<?=$i?>"></span></td>
                                      <td width="15%" height="30" align="center"><span id="bname<?=$i?>"></span></td>
                                      <td width="15%" height="30" align="center"><input type="text" name="payinfo<?=$i?>" vvalue="출" size="21"></td>
                                      <td width="14%" height="30" align="center"><input type="text" name="callpay<?=$i?>" vvalue="10,000,000" size="20" onKeyUp="javascript:calc1(callpay<?=$i?>);"></td>
                                      <td height="30" align="center">
									  <select name="cardiv<?=$i?>" id="select2">
                                          <option value=1>일부</option>
                                          <option value=2>종결</option>
                                          <option value=3>추가</option>
                                      </select>
									  </td>
                                    </tr>
                                   <?}?>
								    <tr>
                                            <td height="30" colspan="2" align="center" bgcolor="f7f7f7" class="p_tt"><strong>매입가격</strong></td>
<td height="30" colspan="2" align="center"><input type="text" name="carbody" onKeyUp="dataintComma(this);" class="ipip" size="25">
                                              원</td>
                                            <td height="30" colspan="2" align="center" bgcolor="f7f7f7" class="p_tt"><strong>청구합계액</strong></td>
                                      <td height="30" align="center" class="p_tt">
                                        <input style="font-weight:700" type="text" name="sumcallpay" size="19" readonly value="<?=number_format($totalpay1)?>"></td>
                                            <td height="30" align="center" class="p_tt">&nbsp;</td>
                                          </tr>
                                </table>
								<br>
								<center>
                  <input type="button" class="btn_blue" value="목록보기"  onClick="document.location.href='/manage/Sale10/Sale_list.php'">
							   <input type="button" id="button2" class="btn_pink" value="등록하기"  onClick="document.cform.submit();">
                </center>
								</td>
                              </tr>
                            </table>
                          </tr>
                          <tr>
                            <td bgcolor='dddddd' height='1' colspan='3'></td>
                          </tr>
                        </table>                <!--/로고 & 탑메뉴-->	  </td>
	</tr>
	<tr>
		<td height='100%'>
			<!--body-->			
			<!--/body-->
		</td>
	</tr>
</table>



</body>
</html>