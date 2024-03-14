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
                <td width='130' align='center' valign="top" style='font-size:14px;'><? include "$DOCUMENT_ROOT/admin/inc/sm_sub06_01.php";?></td>
                <td width="1" height="750" valign="top" bgcolor="d7d7d7"><img src="../img/sb.gif" width="1" height="1" /></td>
                <td valign="top" style='padding:10px;'><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td><table width="99%" border="0" cellpadding="0" cellspacing="0">
                      <tr>
                        <td height='30'><img src='../img/icon.gif' alt=""> 위치 : 환경설정 &gt; <strong>회원관리</strong></td>
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
                    <td> <table width="1000"  border="1" cellpadding="0" cellspacing="0" bordercolor="d9d9d9" style="border-collapse:collapse;text-align:center;" class='pad_10'>
                      <TR>
                        <TD width="150" height="30" align="center" bgcolor="#E6E6E6"><strong>가입일</strong></TD>
                        <TD width="350" height="30" align="left" style="padding-left:10px;">2016-07-18</TD>
                        <TD width="150" align="center" bgcolor="#E6E6E6"><strong>회원레벨 </strong></TD>
                        <TD width="350" height="30" align="left" style="padding-left:10px;"><SELECT name="mLel1_input">
                          <OPTION value="10">비회원</OPTION>
                            <OPTION value="9" selected="">일반회원</OPTION>
                            <OPTION value="8">교육회원</OPTION>
                            <OPTION value="7">제휴회원</OPTION>
                            <OPTION value="5">광고회원</OPTION>
                            <OPTION value="1">관리자</OPTION>
                          </SELECT>
                            <!--input type="submit" value="탈퇴시키기" class='btn_violet'--></TD>
                      </TR>
                      <TR>
                        <TD height="30" align="center" bgcolor="#E6E6E6"><strong>이름</strong></TD>
                        <TD height="30" align="left" style="padding-left:10px;">조수빈</TD>
                        <TD align="center" bgcolor="#E6E6E6"><strong>생년월일</strong></TD>
                        <TD height="30" align="left" style="padding-left:10px;">1993-01-12</TD>
                      </TR>
                      <TR>
                        <TD height="30" align="center" bgcolor="#E6E6E6"><strong>아이디</strong></TD>
                        <TD height="30" align="left" style="padding-left:10px;">sb930112</TD>
                        <TD align="center" bgcolor="#E6E6E6"><strong>패스워드</strong></TD>
                        <TD height="30" align="left" style="padding-left:10px;">wjsb1212</TD>
                      </TR>
                      <TR>
                        <TD height="30" align="center" bgcolor="#E6E6E6"><strong>전화번호</strong></TD>
                        <TD height="30" align="left" style="padding-left:10px;">010-4388-0644</TD>
                        <TD align="center" bgcolor="#E6E6E6"><strong>핸드폰</strong></TD>
                        <TD height="30" align="left" style="padding-left:10px;">010-4388-0644</TD>
                      </TR>
                      <TR>
                        <TD height="30" align="center" bgcolor="#E6E6E6"><strong>주소</strong></TD>
                        <TD height="30" colspan="3" align="left" style="padding-left:10px;">[17086] 경기 용인시 기흥구 기흥단지로24번길 46 (고매동, 씨뉴어하우스) 104호</TD>
                      </TR>
                      <TR>
                        <TD height="30" align="center" bgcolor="#E6E6E6"><strong>이메일</strong></TD>
                        <TD height="30" colspan="3" align="left" style="padding-left:10px;"><table border="0" cellspacing="0" cellpadding="2">
                            <tr>
                              <td>whtnqlsdldia@naver.com / 수신여부                              </td>
                              <td style="padding-bottom:4px;"><input name="mMailOk" type="radio" checked="" value="1"></td>
                              <td>예</td>
                              <td style="padding-bottom:4px;"><input name="mMailOk" type="radio" checked="" value="0"></td>
                              <td>아니오</td>
                            </tr>
                          </table>
                          
                          </TD>
                      </TR>
                      <TR>
                        <TD height="30" align="center" bgcolor="#E6E6E6"><strong>최근접속일</strong></TD>
                        <TD height="30" align="left" style="padding-left:10px;">2016-07-18 16:19:37</TD>
                        <TD align="center" bgcolor="#E6E6E6"><strong>탈퇴일자</strong></TD>
                        <TD height="30" colspan="3" align="left" style="padding-left:10px;">0000-00-00</TD>
                      </TR>
                    </table>
                    </td>
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
                              <input name="input" type="button" class="btn_blue" value="목록보기" onClick="window.location='sub01.php'">
                            </span></td>
                            <td><span style="padding-left:3px">
                              <input name="input2" type="button" class="btn_pink" value="수정하기" onClick="window.location='sub01_write.php'">
                            </span></td>
                          </tr>
                        </table></td>
                      </tr>
                    </table>
                    </td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
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
