<style>
.ui-datepicker select.ui-datepicker-month{ width:30%;  }
.ui-datepicker select.ui-datepicker-year{ width:40%; }
</style>


<body leftmargin="0" topmargin="0" rightmargin="0" bottommargin="0">
<iframe name="HiddenFrm" style="display:none;" width=800 height=150></iframe>
<table width="100%" border="0" cellpadding="0" cellspacing="0" height='100%'>
	<tr>
		<td valign='top'>
			<!--로고 & 탑메뉴-->
		  <? include "$DOCUMENT_ROOT/admin/inc/top.php";?>
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td height="750" align='center' valign="top" style='font-size:14px; padding:20px'><img src="../img/sb.gif" width="1" height="1" />                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td><table width="99%" border="0" cellpadding="0" cellspacing="0">
                      <tr>
                        <td height='30'><img src='../img/icon.gif' alt=""> 위치 : 서버관리 &gt; <strong>서버관리</strong></td>
                        <td align='right'>&nbsp;</td>
                      </tr>
                    </table>                      </td>
              </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td><table width="100%"  border="1" cellpadding="4" cellspacing="0" bordercolor="d9d9d9" style="border-collapse:collapse;text-align:center;" class='pad_10'>
                      <tr>
                        <td height="2" colspan="4" bgcolor="d9d9d9"></td>
                      </tr>
                      <tr>
                        <td width="20%" bgcolor="f7f7f7"><strong>서버회사</strong></td>
                        <td align="left" style="padding-left:10px;">
                        서버회사</td>
                        <td align="center" bgcolor="f7f7f7"><strong>서버명</strong></td>
                        <td align="left" style="padding-left:10px;">서버이름                        </td>
                      </tr>
                      <tr >
                        <td bgcolor="f7f7f7"><strong>아이피</strong></td>
                        <td align="left" style="padding-left:10px;">
                          111.00.00.0                       </td>
                        <td align="center" bgcolor="f7f7f7"><strong>비밀번호</strong></td>
                        <td align="left" style="padding-left:10px;">dfrgre234</td>
                      </tr>
                      <tr >
                        <td width="20%" bgcolor="f7f7f7"><strong>IP</strong></td>
                        <td width="30%" align="left" id="enddate" style="padding-left:10px;">아이피</td>
                        <td width="20%" bgcolor="f7f7f7"><strong>root</strong></td>
                        <td width="30%" align="left"  style="padding-left:10px;">&nbsp;</td>
                      </tr>
                      <tr >
                        <td bgcolor="f7f7f7"><strong>신청일</strong></td>
                        <td align="left" id="enddate8" style="padding-left:10px;">2016-1-01</td>
                        <td bgcolor="f7f7f7"><strong>연장일</strong></td>
                        <td align="left"  style="padding-left:10px;">매월
                          1
일</td>
                      </tr>
                      <tr >
                        <td colspan="4" bgcolor="#FFFFFF" style="padding:10px;">&nbsp;</td>
                      </tr>

                    </table></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="center"><input name="input" type="button" class="btn_blue" value="목록보기" onClick="window.location='sub01.php'">                    </td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td><table width="100%"  border="1" cellpadding="4" cellspacing="0" bordercolor="d9d9d9" style="border-collapse:collapse;text-align:center;" class='pad_10'>
                      <tr>
                        <td height="2" colspan="2" bgcolor="d9d9d9"></td>
                      </tr>
                      <tr>
                        <td width="20%" bgcolor="f7f7f7"><strong>메모</strong></td>
                        <td align="left" style="padding-left:10px;"><input type="text" style="width:90%">
                        <input name="input2" type="button" class="btn_pink" value="등록" onClick="window.location='sub01_write.php'"></td>
                      </tr>
                      <tr >
                        <td bgcolor="#FFFFFF">2016-01-01</td>
                        <td align="left" style="padding-left:10px;">메모내용 <font color="#FF0000">삭제</font></td>
                      </tr>
                      <tr >
                        <td width="20%" bgcolor="#FFFFFF">2016-01-01</td>
                        <td align="left" id="enddate7" style="padding-left:10px;">메모내용 <font color="#FF0000">삭제</font></td>
                      </tr>
                    </table></td>
                  </tr>
                </table></td>
                </tr>
              <tr>
                <td bgcolor='dddddd' height='1'></td>
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
