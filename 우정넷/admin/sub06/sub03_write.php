<?
include $_SERVER['DOCUMENT_ROOT']."/admin/inc/header.php";
?>

<?
if ($_GET[idx])$data=mysql_fetch_assoc(mysql_query("select * from config_popup where idx='$_GET[idx]'"));
?>

<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script> 
<script language="javascript" type="text/javascript">
 $(document).ready(function() {

  //******************************************************************************
  // 상세검색 달력 스크립트
  //******************************************************************************
  var clareCalendar = {
   monthNamesShort: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
   dayNamesMin: ['일','월','화','수','목','금','토'],
   weekHeader: 'Wk',
   dateFormat: 'yy-mm-dd', //형식(20120303)
   autoSize: false, //오토리사이즈(body등 상위태그의 설정에 따른다)
   changeMonth: true, //월변경가능
   changeYear: true, //년변경가능
   showMonthAfterYear: true, //년 뒤에 월 표시
   buttonImageOnly: true, //이미지표시
   buttonText: '달력선택', //버튼 텍스트 표시
   buttonImage: '/images/icon_data.gif', //이미지주소
   showOn: "both", //엘리먼트와 이미지 동시 사용(both,button)
   yearRange: '2010:2020' //1990년부터 2020년까지
  };
  $("#sdate").datepicker(clareCalendar);
  $("#edate").datepicker(clareCalendar);
  $("#adate").datepicker(clareCalendar);
  $("#bdate").datepicker(clareCalendar);
  $("img.ui-datepicker-trigger").attr("style","margin-left:5px; vertical-align:middle; cursor:pointer;"); //이미지버튼 style적용
  $("#ui-datepicker-div").hide(); //자동으로 생성되는 div객체 숨김  
 });
</script>
<style>
.ui-datepicker select.ui-datepicker-month{ width:30%;  }
.ui-datepicker select.ui-datepicker-year{ width:40%; }
</style>

<script>
function wr(){
	f=document.cform;
	f.action="sub03_save.php";
	f.submit();
}
</script>

<body leftmargin="0" topmargin="0" rightmargin="0" bottommargin="0">
<iframe name="HiddenFrm" style="display:none;" width=800 height=150></iframe>
<table width="100%" border="0" cellpadding="0" cellspacing="0" height='100%'>
	<tr>
		<td valign='top'>
			<!--로고 & 탑메뉴-->
		  <? include "$DOCUMENT_ROOT/admin/inc/top.php";?>
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td width='130' align='center' valign="top" style='font-size:14px;'><? include "$DOCUMENT_ROOT/admin/inc/sm_sub06_03.php";?></td>
                <td width="1" height="750" valign="top" bgcolor="d7d7d7"><img src="../img/sb.gif" width="1" height="1" /></td>
                <td valign="top" style='padding:10px;'><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td><table width="99%" border="0" cellpadding="0" cellspacing="0">
                      <tr>
                        <td height='30'><img src='../img/icon.gif' alt=""> 위치 : 환경설정 &gt; <strong>팝업관리</strong></td>
                        <td align='right'><table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
 					   <td height="30" align="right">&nbsp;</td>
					</tr>
				</table></td>
                      </tr>
                    </table>                      </td>
              </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td><table width="1000"  border="1" cellpadding="0" cellspacing="0" bordercolor="d9d9d9" style="border-collapse:collapse;text-align:center;" class='pad_10'>
<form name="cform" method="post" enctype="multipart/form-data" target="HiddenFrm">
<input type="hidden" name="idx" value="<?=$_GET[idx]?>">
                      <TR>
                        <TD width="150" height="30" align="center" bgcolor="#E6E6E6"><STRONG>노출여부</STRONG></TD>
                      <TD width="350" align="left" style="padding-left:10px;"><table border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td><input name="application" type="radio" checked="checked" value="1" <?=($data[application]==1)?"checked":""?>></td>
                              <td style="padding-top:4px;">노출</td>
                              <td><input name="application" type="radio" value="0" <?=(!$data[application])?"checked":""?>></td>
                              <td style="padding-top:4px;">감춤</td>
                            </tr>
                          </table></TD>
                        <TD width="150" align="center" bgcolor="#f7f7f7"><STRONG>스크롤바</STRONG></TD>
                        <TD width="350" align="left" style="padding-left:10px;"><table border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td><input name="scroll" type="radio" checked="checked" value="1" <?=($data[scroll]==1)?"checked":""?>></td>
                            <td style="padding-top:4px;">사용</td>
                            <td><input name="scroll" type="radio" value="0" <?=(!$data[scroll])?"checked":""?>></td>
                            <td style="padding-top:4px;">미사용</td>
                          </tr>
                        </table></TD>
                      </TR>
                      <TR>
                        <TD height="30" align="center" bgcolor="#E6E6E6"><STRONG>팝업기간</STRONG></TD>
                        <TD colspan="3" align="left" style="padding-left:10px;"><table border="0" cellspacing="0" cellpadding="2">
                            <tr>
                              <td><input name="sdate" id="sdate" size="12" maxlength="12" value="<?=$data[sdate]?>"></td>
                              <td>~</td>
                              <td><input name="edate" id="edate" size="12" maxlength="12" value="<?=$data[edate]?>"></td>
                            </tr>
                          </table></TD>
                      </TR>
                      <TR>
                        <TD height="30" align="center" bgcolor="#E6E6E6"><STRONG>창위치</STRONG></TD>
                        <TD colspan="3" align="left" style="padding-left:10px;">왼쪽으로부터 :
                          <INPUT name="pleft" size="4" maxlength="4" value="<?=($data[pleft])?$data[pleft]:""?>">
                          픽셀(pixel) / 위로부터 :
                          <INPUT name="ptop" size="4" maxlength="4" value="<?=($data[ptop])?$data[ptop]:""?>">
                          픽셀(pixel)</TD>
                      </TR>
                      <TR>
                        <TD height="30" align="center" bgcolor="#E6E6E6"><STRONG>창사이즈</STRONG></TD>
                        <TD colspan="3" align="left" style="padding-left:10px;">가로 :
                          <INPUT name="width" size="4" maxlength="4" value="<?=($data[width])?$data[width]:""?>">
                          픽셀(pixel) / 세로 :
                          <INPUT name="height" size="4" maxlength="4" value="<?=($data[height])?$data[height]:""?>">
                          픽셀(pixel)</TD>
                      </TR>
                      <TR>
                        <TD height="30" align="center" bgcolor="#E6E6E6"><STRONG>팝업창 제목</STRONG></TD>
                        <TD colspan="3" align="left" style="padding-left:10px;"><INPUT name="subject" type="text" size="90" value="<?=($data[subject])?$data[subject]:""?>"></TD>
                      </TR>
                      <TR>
                        <TD height="30" align="center" bgcolor="#E6E6E6"><STRONG>링 크</STRONG></TD>
                        <TD colspan="3" align="left" style="padding-left:10px;"><INPUT name="link" type="text" size="90" value="<?=($data['link'])?$data['link']:""?>"></TD>
                      </TR>
                      <TR>
                        <TD height="30" align="center" bgcolor="#E6E6E6"><STRONG>이미지</STRONG></TD>
                        <TD colspan="3" align="left" style="padding-left:10px;"><table border="0" cellspacing="0" cellpadding="2">
                            <tr>
                              <td><input name="pop_file1" type="file" size="70"></td>
							<?if ($data[image1]){?>
                              <td style="padding-top:4px; color:#0066CC"><?=$data[image1]?></td>
                              <td><input name="delete1" type="checkbox" value="<?=$data[image1]?>"></td>
                              <td style="padding-top:4px; color:#FF0000">삭제</td>
							<?}?>
                          </tr>
                          </table></TD>
                      </TR>
                      <TR>
                        <TD height="30" align="center" bgcolor="#E6E6E6"><STRONG>기타옵션</STRONG></TD>
                        <TD colspan="3" align="left" style="padding-left:10px;"><INPUT name="new_win" type="checkbox" value="1" <?=($data[new_win] == 1)?"checked":""?>>
                          새창으로링크
                          <INPUT name="oneday" type="checkbox" value="1" <?=($data[oneday] == 1)?"checked":""?>>
                          하루동안창열지않음사용
                          <INPUT name="close" type="checkbox" value="1" <?=($data[close] == 1)?"checked":""?>>
                          창닫기버튼 </TD>
                      </TR>
</form>
                    </table>                    </td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td width="1000" align="left"><table width="1000" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td align="center"><table border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td><span style="padding-left:3px">
                              <input name="input" type="button" class="btn_blue" value="목록보기" onClick="window.location='sub03.php'">
                            </span></td>
                            <td><span style="padding-left:3px">
                              <input name="input2" type="button" class="btn_pink" value="등록하기" onClick="wr();">
                            </span></td>
                          </tr>
                        </table></td>
                      </tr>
                    </table>
                    </td>
                  </tr>
                  <tr>
                    <td height="30"><strong>미리보기</strong></td>
                  </tr>
                  <tr>
                    <td><table width="1000"  border="1" cellpadding="0" cellspacing="0" bordercolor="d9d9d9" style="border-collapse:collapse;text-align:center;" class='pad_10'>
                      <tr>
                        <td width="4%" height="300" bgcolor="#FFFFFF">&nbsp;</td>
                      </tr>


                    </table></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="33%">&nbsp;</td>
                        <td width="33%" align="center">&nbsp;</td>
                        <td width="33%">&nbsp;</td>
                      </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                </table>
                </tr>
              <tr>
                <td bgcolor='dddddd' height='1' colspan='3'></td>
              </tr>
            </table>
	      <!--/로고 & 탑메뉴-->		
		</td>
  </tr>
	<tr>
		<td height='100%'>
			<!--body-->			
			<!--/body-->
		</td>
	</tr>
</table>
</body>
