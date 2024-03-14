<?
include $_SERVER['DOCUMENT_ROOT']."/admin/inc/header.php";
?>
<?
if($_GET[a_idx]){
	$sql="select * from admin_table where a_idx='$_GET[a_idx]' ";
	$data=sql_fetch($sql);
}
?>
<iframe name="HiddenFrm" style="display:none;" width=800 height=150></iframe>
			<!--로고 & 탑메뉴-->
		  <? include "$DOCUMENT_ROOT/admin/inc/top.php";?>
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td width='130' align='center' valign="top" style='font-size:14px;'><? include "$DOCUMENT_ROOT/admin/inc/sm_sub06_02.php";?></td>
                <td width="1" height="750" valign="top" bgcolor="d7d7d7"><img src="../img/sb.gif" width="1" height="1" /></td>
                <td valign="top" style='padding:10px;'><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td><table width="99%" border="0" cellpadding="0" cellspacing="0">
                      <tr>
                        <td height='30'><img src='../img/icon.gif' alt=""> 위치 : 환경설정 &gt; <strong>게시판관리</strong></td>
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
<form name="cform" method="post" enctype="multipart/form-data" target="HiddenFrm" action="sub02_save.php">
<input type="hidden" name="a_idx" value="<?=$_GET[a_idx]?>">
                    <td><table width="1000"  border="1" cellpadding="0" cellspacing="0" bordercolor="d9d9d9" style="border-collapse:collapse;text-align:center;" class='pad_10'>
                      <TR>
                          <TD width="150" height="30" align="center" bgcolor="#ebebeb"><STRONG>게시판명</STRONG></TD>
                          <TD align="left" bgcolor="#ffffff" style="padding-left:10px;"><INPUT name="a_title" type="text" size="30" maxlength="20" readonly="" value="<?=$data[a_title]?>"></TD>
                       </TR>
                        <TR>
                          <TD height="30" align="center" bgcolor="#ebebeb"><STRONG>ID&amp;CODE</STRONG></TD>
                          <TD align="left" bgcolor="#ffffff" style="padding-left:10px;"><INPUT name="a_name" type="text" size="30" maxlength="20" readonly="" value="<?=$data[a_name]?>"></TD>
                       </TR>
                        <!--TR>
                          <TD height="30" align="center" bgcolor="#ebebeb"><STRONG>레이아웃</STRONG></TD>
                          <TD align="left" bgcolor="#ffffff" style="padding-left:10px;"><INPUT name="a_skinname" type="text" size="30" maxlength="20" value="">
                              <INPUT onClick="javascript:window.open('skin_popup.php', 'open','width=930,height=900,statusbar=0,scrollbars=1')" type="button" value="스킨선택">
                          </TD>
                       </TR-->
                        <TR>
                          <TD height="30" align="center" bgcolor="#ebebeb"><STRONG>쓰기권한</STRONG></TD>
                          <TD align="left" bgcolor="#ffffff" style="padding-left:10px;">
						  <SELECT name="a_write_level">
                              <OPTION value="" selected="">:: 회원구분 ::</OPTION>
                              <OPTION value="10" <? if($data[a_write_level]=="10") echo "selected"; ?>>비회원</OPTION>
                                <OPTION value="9" <? if($data[a_write_level]=="9") echo "selected"; ?>>일반회원</OPTION>
                                <OPTION value="1" <? if($data[a_write_level]=="1") echo "selected"; ?>>최고관리자</OPTION>
                              </SELECT></TD>
                       </TR>
                        <TR>
                          <TD height="30" align="center" bgcolor="#ebebeb"><STRONG>보기권한</STRONG></TD>
                          <TD align="left" bgcolor="#ffffff" style="padding-left:10px;">
						  <SELECT name="a_level">
                              <OPTION value="" selected="">:: 회원구분 ::</OPTION>
                              <OPTION value="10" <? if($data[a_level]=="10") echo "selected"; ?>>비회원</OPTION>
                                <OPTION value="9" <? if($data[a_level]=="9") echo "selected"; ?>>일반회원</OPTION>
                                <OPTION value="1" <? if($data[a_level]=="1") echo "selected"; ?>>최고관리자</OPTION>
                              </SELECT></TD>
                       </TR>
                        <!--TR>
                          <TD height="30" align="center" bgcolor="#ebebeb"><STRONG>댓글사용</STRONG></TD>
                          <TD align="left" bgcolor="#ffffff" style="padding-left:10px;"><table border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td><input name="application" type="radio" checked="checked" value="1"></td>
                                <td style="padding-top:4px;">노출</td>
                                <td><input name="application" type="radio" value="0"></td>
                                <td style="padding-top:4px;">감춤</td>
                              </tr>
                            </table></TD>
                       </TR-->
                        <TR>
                          <TD height="30" align="center" bgcolor="#ebebeb"><STRONG>첨부파일</STRONG></TD>
                          <TD align="left" bgcolor="#ffffff" style="padding-left:10px;">
						  <SELECT name="a_file_use">
                              <OPTION value="">선택</OPTION>
                              <OPTION value="0" <? if($data[a_file_use]=="0") echo "selected"; ?>>0</OPTION>
                              <OPTION value="1" <? if($data[a_file_use]=="1") echo "selected"; ?>>1</OPTION>
                              <OPTION value="2" <? if($data[a_file_use]=="2") echo "selected"; ?>>2</OPTION>
                              <OPTION value="3" <? if($data[a_file_use]=="3") echo "selected"; ?>>3</OPTION>
                              <OPTION value="4" <? if($data[a_file_use]=="4") echo "selected"; ?>>4</OPTION>
                              <OPTION value="5" <? if($data[a_file_use]=="5") echo "selected"; ?>>5</OPTION>
                              <OPTION value="6" <? if($data[a_file_use]=="6") echo "selected"; ?>>6</OPTION>
                              <OPTION value="7" <? if($data[a_file_use]=="7") echo "selected"; ?>>7</OPTION>
                              <OPTION value="8" <? if($data[a_file_use]=="8") echo "selected"; ?>>8</OPTION>
                              <OPTION value="9" <? if($data[a_file_use]=="9") echo "selected"; ?>>9</OPTION>
                              <OPTION value="10" <? if($data[a_file_use]=="10") echo "selected"; ?>>10</OPTION>
                            </SELECT>
                          </TD>
                       </TR>
                        <TR>
                          <TD height="30" align="center" bgcolor="#ebebeb"><STRONG>타이틀</STRONG></TD>
                          <TD align="left" bgcolor="#ffffff" style="padding-left:10px;"><table border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td><input name="application" type="radio" checked="checked" value="1"></td>
                                <td style="padding-top:4px;">자동</td>
                                <td><input name="application" type="radio" value="0"></td>
                                <td style="padding-top:4px;">이미지경로</td>
                                <td style="padding-left:4px;"><input  type="text" size="30" value=""></td>
                              </tr>
                            </table>
                            </TD>
                      </TR>
                        <TR>
                          <TD height="30" align="center" bgcolor="#ebebeb"><STRONG>헤터인크루드</STRONG></TD>
                          <TD align="left" bgcolor="#ffffff" style="padding-left:10px;"><INPUT type="text" size="30" value=""></TD>
                       </TR>
                        <TR>
                          <TD height="30" align="center" bgcolor="#ebebeb"><STRONG>풋터인크루드</STRONG></TD>
                          <TD align="left" bgcolor="#ffffff" style="padding-left:10px;"><INPUT type="text" size="30" value=""></TD>
                       </TR>
                        <TR>
                          <TD height="30" align="center" bgcolor="#ebebeb"><STRONG>레프트인크루드</STRONG></TD>
                          <TD align="left" bgcolor="#ffffff" style="padding-left:10px;"><INPUT type="text" size="30" value=""></TD>
                       </TR>
                        <TR>
                          <TD height="30" align="center" bgcolor="#ebebeb"><STRONG>이미지위삽입</STRONG></TD>
                          <TD align="left" bgcolor="#ffffff" style="padding:10px;"><TEXTAREA  style="width:100%; height:100px;"></TEXTAREA></TD>
                       </TR>
                      </table>
                    </td>
</form>
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
                              <input name="input" type="button" class="btn_blue" value="목록보기" onClick="window.location='sub02.php'">
                            </span></td>
                            <td><span style="padding-left:3px">
                              <input name="input2" type="button" class="btn_pink" value="등록하기" onClick="window.location='sub02.php'">
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
