<?
include $_SERVER['DOCUMENT_ROOT']."/admin/inc/header.php";
?>
<iframe name="HiddenFrm" style="display:none;" width=800 height=150></iframe>
		  <? include "$DOCUMENT_ROOT/admin/inc/top.php";?>
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td height="600" align='center' valign="top" style='font-size:14px; padding:10px'><table width="900" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td><table width="100%" border="0" cellpadding="0" cellspacing="0">
                      <tr>
                        <td height='30'><img src='../img/icon.gif' alt=""> 위치 : 년중계획서 &gt;<strong><a href="sub01.php"><font color="#FF0000">일별</font></a>&nbsp;&nbsp;/&nbsp;&nbsp;<a href="sub02.php">월별</a></strong></td>
                        <td align='right'><a href="write.php"><font color="#FF0000">등록하기</font></a></td>
                      </tr>
                    </table>                      </td>
              </tr>
                  <tr>
                    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td width="12%" height="25" align="center">&nbsp;</td>
                          <td width="73%" align="center"><table border="0" cellspacing="0" cellpadding="3">
                            <tr>
                              <td><img src="/admin/img/news05_h01.gif" /></td>
                              <td style="font-size:14px; font-weight:bold"> 2017년 01월 25일 수요일 </td>
                              <td><img src="/admin/img/news05_h02.gif" /></td>
                            </tr>
                          </table></td>
                          <td width="15%" align="right">인쇄하기</td>
                      </tr>
                        <tr>
                          <td height="5" colspan="3" align="left"></td>
                        </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td><table width="100%"  border="1" cellpadding="0" cellspacing="0" bordercolor="d9d9d9" style="border-collapse:collapse;text-align:center;" class='pad_10'>
					  <tr>
                        <td width="5%" height="30" bgcolor="f4f4f4"><strong>
                          <input type="checkbox" name="checkbox" id="checkbox" />
                        </strong></td>
                        <td width="6%" bgcolor="f4f4f4"><strong>no</strong></td>
                        <td width="89%" bgcolor="f4f4f4"><strong>일정</strong><strong></strong></td>
                      </tr>
                      <tr style="cursor:hand">
                        <td height="30"><strong>
                          <input type="checkbox" name="checkbox2" id="checkbox2" />
                        </strong></td>
                        <td>1</td>
                        <td align="left" style="padding:5px;"><strong>제목 :</strong> 제목이 나옴<br />
                          내용이 나옴                        </td>
                      </tr>
                      <tr style="cursor:hand">
                        <td height="30"><strong>
                          <input type="checkbox" name="checkbox3" id="checkbox3" />
                        </strong></td>
                        <td>2</td>
                        <td align="left" style="padding:5px;"><strong>제목 :</strong> 제목이 나옴<br />
내용이 나옴 </td>
                      </tr>                      
                    </table></td>
                  </tr>
                  <tr>
                    <td align="left" height="40"><input type="button" value="선택삭제" class='btn_blue' onclick='allDel();' /></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                </table></td>
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
