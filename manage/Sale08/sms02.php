<?
	include $_SERVER['DOCUMENT_ROOT'].'/manage/inc/header.php';
	include $_SERVER['DOCUMENT_ROOT'].'/manage/inc/top_menu.php';
	include $_SERVER['DOCUMENT_ROOT'].'/manage/inc/global.php';

if (!$connect) $connect=dbconn();
//if(!eregi($HTTP_HOST,$HTTP_REFERER)) Error("잘못된 접근입니다.");
$a_board=rfile("skin/admin_board.htm");
$tmp_board=explode("[loop]",$a_board);
$a_board=$tmp_board[0];

if($rCode=="0000"){
$query="update js_webconfig set	sms_count='$uCount' where no='1' ";
mysql_query($query);
}

$data=mysql_fetch_array(mysql_query("select * from sms where idx=1"));

?>

<table width="970" border="0" cellpadding="0" cellspacing="0">
<tr> 
    <td>
      <table width="900" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td>
            <table border="0" cellpadding="0" cellspacing="0" width="900">    
              <tr>
                <td height="20" align="left" style="color:#333399"> <font size="-4"> ▶ </font>위치 : 개별(SMS)문자</td>
              </tr>
              <tr> 
                <td width="755" height="1" colspan="2" bgcolor="#333399"></td>
              </tr>
              <tr> 
                <td height="20">&nbsp;</td>
              </tr>
            </table>
          </td> 
        </tr>
      </table>
    </td>
  </tr>

	<tr>
		<td valign='top' align="center">
			
			<table width="100%" border="0" cellpadding="0" cellspacing="0" align="left">
				<tr>
					<td valign="top">
            <table width="900" border="0" cellspacing="0" cellpadding="0">
					  <tr>
					    <td height="30" align="left"><p><span class="title"><img src="/manage/img/icon02.gif" width="15" height="15" align="absmiddle" /> <strong>개별문자</strong></span></p></td>
				      </tr>
					  <tr>
					    <td height="31" align="left">1.문자서비스는 문자천국에 항상 잔고가 있는지 여부를 확인하십시요. <b>(<a href="http://www.skysms.co.kr" target="_blank">문자천국:www.skysms.co.kr</a>)</b>
                        <p><font color="#FF0000">
                        2.발신번호는 반드시 문자천국에 발신등록 된 번호만 발신이 가능합니다</p></font></td>
				      </tr>
					  <tr>
					    <td height="25"><table width="755" border="0" cellspacing="0" cellpadding="0">
					      <tr>
					        <td height="499" valign="top"><table width="755" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td width="400" height="499" valign="top"><table width="222" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                      <td height="30" align="center"><strong><u>자주쓰는내용 1</u></strong></td>
                                    </tr>
                                    <tr>
                                      <td><table width="222" border="0" cellspacing="0" cellpadding="0" background="../img/sms_bg.jpg">
                                        <tr>
                                          <td height="50" colspan="2" align="center">&nbsp;</td>
                                        </tr>
                                        <tr>
                                          <td height="10" colspan="2" align="center">&nbsp;</td>
                                        </tr>
                                        <tr>
                                          <td width="84" height="5" align="center"></td>
                                          <td width="170" height="5"></td>
                                        </tr>
		<iframe name="HiddenFrm" style="display:none;"></iframe>
                                        <form action="sms_save.php" method="post" enctype="multipart/form-data" name="cform1" id="cform1" target="HiddenFrm">
                                          <input type="hidden" name="ty" value="1" />
                                          <tr align="center">
                                            <td height="25" colspan="2" style="padding:0 0 0 10">발신번호
                                              <input type="text" name="num1" style="width:120px" value="<?=$data[num1]?>"/></td>
                                          </tr>
                                          <tr>
                                            <td height="25" colspan="2" align="left" style=" padding-left:80px;"> (- 없이 번호입력)</td>
                                          </tr>
                                          <tr>
                                            <td height="25" colspan="2" valign="bottom"   align="left" style=" padding-left:23px;">내용을 입력하세요.(<strong><input id="by1" size="3" style="border:0px;whidth:10px;background:#e8fafe;color:black;font-weight:bolder;text-align:right;" readonly value="<?=strlen($data[con1])?>"></strong>/80byte)</td>
                                          </tr>
                                          <tr>
                                            <td height="105" colspan="2"   align="left" style=" padding-left:23px;"><textarea name="con1" style="width:180px; height:105px" onkeyup="getStrLen(this.value);"><?=$data[con1]?></textarea></td>
                                          </tr>
                                          <tr>
                                            <td height="30"  valign="bottom"   align="left" style=" padding-left:23px;">수신번호 </td>
                                            <td height="25" style="padding:0 0 0 10">&nbsp;</td>
                                          </tr>
                                          <tr>
                                            <td height="13" colspan="2"  align="left" style=" padding-left:23px;"><span class="p_tt">
                                              <select name="sms_level" class="select">
                                                <option value="">::회원레벨별문자::</option>
                      <option value="indi" >일반회원</option>
                      <option value="company1" >제휴회원</option>
                      <option value="company2" >중고차 딜러</option>
                      <option value="premium1" >입찰대기</option>
                      <option value="premium2" >입찰승인</option>
					  <option value="jisajang" >프리미엄</option>
					  <option value="jisajang2" >추천회원</option>
                      <option value="premium3" >입찰종료</option>
                      <option value="premium4" >입찰중지</option>
                      <option value="admin" >관리자</option>
                      <option value="superadmin" >최고관리자</option>
                                              </select>
                                            </span></td>
                                          </tr>
                                          <tr>
                                            <td height="64" colspan="2" align="center"><input type="submit" name="button3"value="보내기" class="button33" style="cursor:pointer; background-color:#FFFFFF; color:#084573; border:#636563 1px solid; padding:5 3 3 3; font-weight:bold" /></td>
                                          </tr>
                                        </form>
                                        <tr>
                                          <td>&nbsp;</td>
                                          <td height="20">&nbsp;</td>
                                        </tr>
                                      </table></td>
                                    </tr>
                                  </table>
                                <br /></td>
                                <td width="249" valign="top"><table width="222" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td height="30" align="center"><strong><u>자주쓰는내용 2</u></strong></td>
                                  </tr>
                                  <tr>
                                    <td><table width="222" border="0" cellspacing="0" cellpadding="0" background="../img/sms_bg.jpg">
                                        <tr>
                                          <td height="50" colspan="2" align="center">&nbsp;</td>
                                        </tr>
                                        <tr>
                                          <td height="10" colspan="2" align="center">&nbsp;</td>
                                        </tr>
                                        <tr>
                                          <td width="84" height="5" align="center"></td>
                                          <td width="170" height="5"></td>
                                        </tr>
                                        <form action="sms_save.php" method="post" enctype="multipart/form-data" name="cform1" id="cform2" target="HiddenFrm">
                                          <input type="hidden" name="ty" value="2" />
                                          <tr align="center">
                                            <td height="25" colspan="2" style="padding:0 0 0 10">발신번호
                                              <input type="text" name="num2" style="width:120px" value="<?=$data[num2]?>"/></td>
                                          </tr>
                                          <tr>
                                            <td height="25" colspan="2" align="left" style=" padding-left:80px;"> (- 없이 번호입력)</td>
                                          </tr>
                                          <tr>
                                            <td height="25" colspan="2" valign="bottom"   align="left" style=" padding-left:23px;">내용을 입력하세요.(<strong><input id="by2" size="3" style="border:0px;whidth:10px;background:#e8fafe;color:black;font-weight:bolder;text-align:right;" readonly value="<?=strlen($data[con2])?>"></strong>/80byte)</td>
                                          </tr>
                                          <tr>
                                            <td height="105" colspan="2"   align="left" style=" padding-left:23px;"><textarea name="con2" style="width:180px; height:105px" onkeyup="getStrLen2(this.value);"><?=$data[con2]?></textarea></td>
                                          </tr>
                                          <tr>
                                            <td height="30" colspan="2"   align="left"  valign="bottom" style=" padding-left:23px;">수신번호 :(- 없이 번호입력)</td>
                                          </tr>
                                          <tr>
                                            <td height="13" colspan="2"  align="left" style=" padding-left:23px;">
                                              <input type="text" name="to2" style="width:180px; height:20px" value="<?=$data[to2]?>"/></td>
                                          </tr>
                                          <tr>
                                            <td height="64" colspan="2" align="center"><input type="submit" name="button2"value="보내기" class="button33" style="cursor:pointer; background-color:#FFFFFF; color:#084573; border:#636563 1px solid; padding:5 3 3 3; font-weight:bold" /></td>
                                          </tr>
                                        </form>
                                      <tr>
                                          <td>&nbsp;</td>
                                        <td height="20">&nbsp;</td>
                                      </tr>
                                    </table></td>
                                  </tr>
                                </table></td>
                                <td width="211" valign="top">&nbsp;</td>
                                <td>&nbsp;</td>
                              </tr>
                            </table></td>
				          </tr>
				        </table></td>
				      </tr>
					  <tr>
					    <td height="25">&nbsp;</td>
				      </tr>
				    </table></td>
				</tr>
			</table>	
	</td>
	</tr>
</table>

<? include_once "../inc/footer.php";?>

<script>
function getStrLen(str){
	if(str==null || str=='') return 0;
	var strlen=0;
	for(var i=0; i<str.length; i++){
	var c=str.charCodeAt(i);
	if( c < 0xac00 || 0xd7a3 < c ) strlen++;
	else strlen+=2; 
	}
	document.getElementById('by1').value=strlen;
}
function getStrLen2(str){
	if(str==null || str=='') return 0;
	var strlen=0;
	for(var i=0; i<str.length; i++){
	var c=str.charCodeAt(i);
	if( c < 0xac00 || 0xd7a3 < c ) strlen++;
	else strlen+=2; 
	}
	document.getElementById('by2').value=strlen;
}
</script>