<?
include $_SERVER['DOCUMENT_ROOT']."/admin/inc/header.php";
?>

<?
if($_GET[idx]){
	$sql="select * from user where idx='$_GET[idx]' ";
	$data=sql_fetch($sql,$connect);
	$mobile=explode("-",$data[mobile]);
	$co_date=explode("-",$data[co_date]);
	$op_date=explode("-",$data[op_date]);
	$pay_date=explode("-",$data[pay_date]);
	$secure_date=explode("-",$data[secure_date]);
}
?>

<style>
.ui-datepicker select.ui-datepicker-month{ width:30%;  }
.ui-datepicker select.ui-datepicker-year{ width:40%; }
</style>

<script>
function wr(){
	f=document.cform;
	f.action="sub01_save.php";
	f.submit();
}
function cate1(z){ 
	var tmp = z.options[z.selectedIndex].value; 
	document.cform.type2.options[0].selected="true";
	gufrm.location.href = "/admin/sub05/cate_ch.php?tmp="+tmp;  
} 
function cate2(z){ 
	var tmp = z.options[z.selectedIndex].value; 
	document.cform.type3.options[0].selected="true";
	gufrm.location.href = "/admin/sub05/cate_ch2.php?tmp="+tmp;  
} 
function memo_del(idx){ 
	if(confirm('삭제하시겠습니까?')){
		location.href="sub01_memo_del.php?idx="+idx;
	}
} 
function f_down(idx,idx2){
/*
	f=document.cform;
	f.file_down_name.value=idx;
	f.action="file_down.php";
	f.submit();
*/
	location.href="file_down.php?file_down_name="+idx+"&ofile_down_name="+idx2;
}
</script>

<body leftmargin="0" topmargin="0" rightmargin="0" bottommargin="0">
<iframe name="HiddenFrm" style="display:none;" width=800 height=150></iframe>
<iframe name="gufrm" style="display:none;" ></iframe>
<table width="100%" border="0" cellpadding="0" cellspacing="0" height='100%'>
	<tr>
		<td valign='top'>
			<!--로고 & 탑메뉴-->
		  <? include "$DOCUMENT_ROOT/admin/inc/top.php";?>
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td height="750" align='center' valign="top" style='font-size:14px; padding:20px'><img src="../img/sb.gif" width="1" height="1" />                  <table width="1000" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td><table width="99%" border="0" cellpadding="0" cellspacing="0">
                      <tr>
                        <td height='30'><img src='../img/icon.gif' alt=""> 위치 : 계정관리 &gt; <strong>계정관리</strong></td>
                        <td align='right'>&nbsp;</td>
                      </tr>
                    </table>                      </td>
              </tr>
                  <tr align="center">
                    <td><input name="input2" type="button" class="btn_blue" value="목록보기" onClick="window.location='sub01.php'">
                      <input type="button" class="btn_pink" value="등록하기" onClick="wr();"></td>
                  </tr>

                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="center"><table width="1000"  border="1" cellpadding="0" cellspacing="0" bordercolor="d9d9d9" style="border-collapse:collapse;text-align:center;" class='pad_10'>
<form name="cform_memo" method="post" enctype="multipart/form-data" target="HiddenFrm" action="sub01_memo_save.php">
<input type="hidden" name="server_idx" value="<?=$_GET[idx]?>">
                      <tr>
                        <td width="150" height="30" bgcolor="E6E6E6" style="color:#0066CC; font-weight:bold"><strong>메모</strong></td>
                        <td align="left" style="padding-left:10px;"><input name="memo" type="text" style="width:85%">
                        <input type="button" class="btn_pink" value="등록" onClick="document.cform_memo.submit();"></td>
                      </tr>
</form>
<?
$sql="select * from user_memo where server_idx='$_GET[idx]' order by regdate desc ";
$result=sql_query($sql);
while($data_memo=mysql_fetch_array($result)){
?>
					  <tr >
                        <td height="30" bgcolor="#FFFFFF"><?=substr($data_memo[regdate],0,10)?></td>
                        <td align="left" style="padding-left:10px;"><font color="#0066CC"><?=$data_memo[memo]?></font> <font style="cursor:pointer;" color="#FF0000" onclick="memo_del('<?=$data_memo[idx]?>')">삭제</font></td>
                      </tr>
<?
}
?>
                    </table></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
				  
				  
				  <tr>
                    <td height="30"><strong>고객정보
                    </strong></td>
                  </tr>
                  <tr>
                    <td align="center"><table width="1000"  border="1" cellpadding="0" cellspacing="0" bordercolor="d9d9d9" style="border-collapse:collapse;text-align:center;" class='pad_10'>
                     
<form name="cform" method="post" enctype="multipart/form-data" target="HiddenFrm">
<input type="hidden" name="idx" value="<?=$_GET[idx]?>">
<input type="hidden" name="file_down_name" value="">
<input type="hidden" name="user_type2" value="<?=$user_type2?>">
<input type="hidden" name="spay_type" value="<?=$pay_type?>">
<input type="hidden" name="sear" value="<?=$sear?>">
                      <tr>
                        <td width="150" height="30" bgcolor="E6E6E6"><strong>업체명</strong></td>
                        <td width="350" align="left" style="padding-left:10px;">
                        <input type="text" name="com_name" style="width:95%" value="<?=$data[com_name]?>"></td>
                        <td width="150" align="center" bgcolor="E6E6E6"><strong>대표자</strong></td>
                        <td width="350" align="left" style="padding-left:10px;"  ><input type="text" name="owner" style="width:95%" value="<?=$data[owner]?>"></td>
                      </tr>
                      <tr >
                        <td height="30" bgcolor="E6E6E6"><strong>계약일</strong></td>
                        <td align="left" id="enddate" style="padding-left:10px;">
                        <input type="text" name="co_date1" size="6" maxlength="4" value="<?=$co_date[0]?>">
						년
						<input type="text" name="co_date2"  size="3" maxlength="2" value="<?=$co_date[1]?>">
						월
						<input type="text" name="co_date3"  size="3" maxlength="2" value="<?=$co_date[2]?>">
						일						</td>
                        <td bgcolor="E6E6E6"><strong>오픈일</strong></td>
                        <td align="left"  style="padding-left:10px;">
                        <input name="op_date1" type="text" size="6" maxlength="4" value="<?=$op_date[0]?>">
						년
						<input name="op_date2" type="text"  size="3" maxlength="2" value="<?=$op_date[1]?>">
						월
						<input name="op_date3" type="text"  size="3" maxlength="2" value="<?=$op_date[2]?>">
						일						</td>
                      </tr>

                      <tr>
                        <td width="150" height="30" bgcolor="E6E6E6"><strong>담당자</strong></td>
                        <td width="350" align="left" style="padding-left:10px;">
                        <input type="text" name="dam_name" style="width:95%" value="<?=$data[dam_name]?>"></td>
                        <td width="150" align="center" bgcolor="E6E6E6"><strong>연락처</strong></td>
                        <td width="350" align="left" style="padding-left:10px;"  >
						<input type="text" name="mobile1" size="6" maxlength="4"  value="<?=$mobile[0]?>"> - <input type="text" name="mobile2" size="6" maxlength="4" value="<?=$mobile[1]?>"> - <input type="text" name="mobile3" size="6" maxlength="4"  value="<?=$mobile[2]?>"></td>
                      </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td height="30"><strong>결제정보</strong>(고객이 서버와 도메인을 직불하는 경우는 유지비만 청구)</td>
                  </tr>
                  <tr>
                    <td align="center"><table width="1000"  border="1" cellpadding="0" cellspacing="0" bordercolor="d9d9d9" style="border-collapse:collapse;text-align:center;" class='pad_10'>
                        
            <tr>
                          <td width="150" height="30" bgcolor="E6E6E6"><strong>호스팅구분</strong></td>
                <td width="350" align="left" style="padding-left:10px;"><table border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td><input type="radio" name="host_type" id="radio12" value="1" <? if($data[host_type]=="1")echo "checked"; ?>></td>
                              <td style="padding-top:3px;">서버호스팅</td>
                              <td><input type="radio" name="host_type" id="radio13" value="2" <? if($data[host_type]=="2")echo "checked"; ?>></td>
                              <td style="padding-top:3px;">웹호스팅</td>
                              <td><input type="radio" name="host_type" id="radio13" value="3" <? if($data[host_type]=="3")echo "checked"; ?>></td>
                              <td style="padding-top:3px;">고객납부</td>
                            </tr>
                          </table></td>
                          <td width="150" align="center" bgcolor="E6E6E6"><strong>납부구분</strong></td>
                  <td width="350" align="left" style="padding-left:10px;"><table border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td><input type="radio" name="pay_type" id="radio3" value="1" <? if($data[pay_type]=="1")echo "checked"; ?>></td>
                                <td style="padding-top:3px;">월납</td>
                                <td><input type="radio" name="pay_type" id="radio4" value="2" <? if($data[pay_type]=="2")echo "checked"; ?>></td>
                                <td style="padding-top:3px;">년납</td>
                                <td><input type="radio" name="pay_type" id="radio7" value="3" <? if($data[pay_type]=="3")echo "checked"; ?>></td>
                                <td style="padding-top:3px;">무료</td>
                                <td><input type="radio" name="pay_type" id="radio7" value="4" <? if($data[pay_type]=="4")echo "checked"; ?>></td>
                                <td style="padding-left:3px;"><input name="pay_type" type="button" style="background-color:#FF0000; color:#FFFFFF; border:1px solid #FF0000" class="btn_blue" value="중단"></td>
                                <td><input type="radio" name="pay_type" id="radio7" value="5" <? if($data[pay_type]=="5")echo "checked"; ?>></td>
                                <td style="padding-left:3px;"><input name="button" type="button" style="background-color:#1f75cd; color:#FFFFFF;border:1px solid #1f75cd" class="btn_pink" value="보관"></td>
                                <td><input type="radio" name="pay_type" id="radio7" value="6" <? if($data[pay_type]=="6")echo "checked"; ?>></td>
                                <td style="padding-left:3px;"><input name="button" type="button" style="background-color:#FF00FF; color:#FFFFFF;border:1px solid #FF00FF" class="btn_pink" value="부속"></td>
                            </tr>
                            </table></td>
                      </tr>
                        <tr >
                          <td height="30" bgcolor="E6E6E6"><strong>계산서</strong></td>
                          <td align="left" style="padding-left:10px;"><table border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td><input type="radio" name="tax_bill" id="radio5" value="1" <? if($data[tax_bill]=="1")echo "checked"; ?>></td>
                              <td style="padding-top:3px;">세금계산서</td>
                              <td><input type="radio" name="tax_bill" id="radio6" value="2" <? if($data[tax_bill]=="2")echo "checked"; ?>></td>
                              <td style="padding-top:3px;">계산서</td>
                              <td><input type="radio" name="tax_bill" id="radio14" value="3" <? if($data[tax_bill]=="3")echo "checked"; ?>></td>
                              <td style="padding-top:3px;">일반영수증</td>
                              <td><input type="radio" name="tax_bill" id="radio15" value="4" <? if($data[tax_bill]=="4")echo "checked"; ?>></td>
                              <td style="padding-top:3px;">없음</td>
                            </tr>
                          </table>                          </td>
                          <td align="center" bgcolor="E6E6E6"><strong>결제일</strong></td>
                          <td align="left" style="padding-left:10px;"><input name="pay_date1" type="text" size="6" maxlength="4" value="<?=$pay_date[0]?>">
							년
							  <input name="pay_date2" type="text"  size="3" maxlength="2" value="<?=$pay_date[1]?>">
							월
							<input name="pay_date3" type="text"  size="3" maxlength="2" value="<?=$pay_date[2]?>">
							일</td>
                        </tr>
                        <tr >
                          <td height="30" bgcolor="E6E6E6"><strong>관리비용</strong></td>
                          <td colspan="3" align="left" id="enddate6" style="padding-left:10px;">서버비
                            <input name="cost1" type="text" value="<?=$data[cost1]?>" size="10" maxlength="10">
                            +유지비
                            <input name="cost2" type="text" value="<?=$data[cost2]?>" size="10" maxlength="10">
                            +도메인
                            <input name="cost3" type="text" value="<?=$data[cost3]?>" size="10" maxlength="10">
                            + 보안설정
                            <input name="cost4" type="text" value="<?=$data[cost4]?>" size="10" maxlength="10">
                            + 부가세
                            <input name="cost6" type="text" value="<?=$data[cost6]?>" size="10" maxlength="10">
                          = <font color="#FF0000"><?=number($data[cost5])?> </font>원</td>
                        </tr>
                        <tr >
                          <td height="30" bgcolor="E6E6E6"><strong>보안인증서버</strong></td>
                          <td colspan="3" align="left" id="enddate6" style="padding-left:10px;"><input name="secure_date1" type="text" size="6" maxlength="4" value="<?=$secure_date[0]?>">
년
  <input name="secure_date2" type="text"  size="3" maxlength="2" value="<?=$secure_date[1]?>">
월
<input name="secure_date3" type="text"  size="3" maxlength="2" value="<?=$secure_date[2]?>">
일 / 비고
<input name="secure_etc" type="text" size="80" value="<?=$data[secure_etc]?>"></td>
                        </tr>
                        <tr >
                          <td height="30" bgcolor="E6E6E6"><strong>첨부파일1</strong></td>
                          <td colspan="3" align="left" id="enddate6" style="padding-left:10px;"><table border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td width="500"><input name="upfile1" type="file" style="width:100%"></td>
                              <td style="padding-top:3px;">&nbsp;</td>
                              <? if($data[file1]){ ?>
                              <td style="padding-top:3px;padding-left:3px;"><span style="cursor:pointer;" onClick="f_down('<?=$data[file1]?>','<?=$data[ofile1]?>');"><font color="#0066CC"><?=$data[ofile1]?></font></span></td>
                              <td><input type="checkbox" name="del1" id="checkbox22" value="<?=$data[file1]?>"></td>
                              <td style="padding-top:3px;"><font color="#FF0000">삭제</font></td>
                              <? } ?>
                            </tr>
                          </table></td>
                        </tr>
                        <tr >
                          <td height="30" bgcolor="E6E6E6"><strong>첨부파일2</strong></td>
                          <td colspan="3" align="left" id="enddate6" style="padding-left:10px;"><table border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td width="500"><input name="upfile2" type="file" style="width:100%"></td>
                              <td style="padding-top:3px;">&nbsp;</td>
                              <? if($data[file2]){ ?>
                              <td style="padding-top:3px;padding-left:3px;"><span style="cursor:pointer;" onClick="f_down('<?=$data[file2]?>','<?=$data[ofile2]?>');"><font color="#0066CC"><?=$data[ofile2]?></font></span></td>
                              <td><input type="checkbox" name="del2" id="checkbox2" value="<?=$data[file2]?>"></td>
                              <td style="padding-top:3px;"><font color="#FF0000">삭제</font></td>
                              <td style="padding-top:3px;">&nbsp;</td>
                              <? } ?>
                            </tr>
                          </table></td>
                        </tr>
                    </table></td>
                  </tr>

                  <tr>
                    <td height="30" align="right"><span style="padding-top:3px;"><span style="padding-top:3px;padding-left:3px;"><font color="#0066CC">청색첨부파일명 클릭시 다운로드됨</font></span></span></td>
                  </tr>
                  <tr>
                    <td height="30"><strong>서버정보</strong></td>
                  </tr>
                  <tr>
                    <td align="center"><table width="1000"  border="1" cellpadding="0" cellspacing="0" bordercolor="d9d9d9" style="border-collapse:collapse;text-align:center;" class='pad_10'>
                     
                      <tr>
                        <td width="150" height="30" bgcolor="E6E6E6"><strong>서버구분</strong></td>
                        <td colspan="3" align="left" style="padding-left:10px;"><table width="98%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td><select name="type1" onChange="cate1(this)">
                              <option value="">:::서버회사:::</option>
                              <?
	$sql="select * from config_category where CHAR_LENGTH(code)=2 order by sortno  ";
	$result=mysql_query($sql);
	while($data_c=mysql_fetch_array($result)){
?>
                              <option value="<?=$data_c[code]?>" <?if($data_c[code]==$data[user_type1])echo "selected";?>>
                                <?=$data_c[name]?>
                                </option>
                              <?
	}
?>
                            </select>
                              <select name="type2" onChange="cate2(this)">
                                <option value="">:::서버명:::</option>
                                <?
	if($data[user_type1]){
		$sql="select * from config_category where CHAR_LENGTH(code)=4 and code like '$data[type1]%' order by sortno ";
		$result=mysql_query($sql);
		while($data_c=mysql_fetch_array($result)){
?>
                                <option value="<?=$data_c[code]?>" <?if($data_c[code]==$data[user_type2])echo "selected";?>>
                                  <?=$data_c[name]?>
                                </option>
                                <?
		}
	}
?>
                              </select>
                              <select name="type3">
                                <option value="">:::아이피:::</option>
                                <?
	if($data[user_type2]){
		$sql="select * from config_category where CHAR_LENGTH(code)=6 and code like '$data[user_type2]%' order by sortno ";
		$result=mysql_query($sql);
		while($data_c=mysql_fetch_array($result)){
?>
                                <option value="<?=$data_c[code]?>" <?if($data_c[code]==$data[user_type3])echo "selected";?>>
                                  <?=$data_c[name]?>
                                </option>
                                <?
		}
	}
?>
                              </select></td>
                            <td align="right"><strong>
                              <input type="checkbox" name="checkbox3" id="checkbox3" style="vertical-align:middle">
                              <img src="/admin/img/h.jpg" width="16" height="16" style="vertical-align:middle">
                              <input type="checkbox" name="checkbox2" id="checkbox4" style="vertical-align:middle">
                              <img src="/admin/img/m.jpg" width="16" height="16" style="vertical-align:middle">
                              <input type="checkbox" name="checkbox4" id="checkbox5" style="vertical-align:middle">
                              <img src="/admin/img/w.jpg" width="16" height="16" style="vertical-align:middle"> </strong></td>
                          </tr>
                        </table></td>
                      </tr>
                      <tr >
                        <td height="30" bgcolor="E6E6E6"><strong>FTP ID</strong></td>
                        <td width="350" align="left" style="padding-left:10px;"><input type="text" name="ftp_id" style="width:95%" value="<?=$data[ftp_id]?>"></td>
                        <td width="150" align="center" bgcolor="E6E6E6"><strong>비밀번호</strong></td>
                        <td width="350" align="left" style="padding-left:10px;"><input type="text" name="ftp_pass" style="width:95%" value="<?=$data[ftp_pass]?>"></td>
                      </tr>
                      <tr >
                        <td height="30" bgcolor="E6E6E6"><strong>DB ID</strong></td>
                        <td align="left" id="enddate2" style="padding-left:10px;"><input type="text" name="db_id" style="width:95%" value="<?=$data[db_id]?>"></td>
                        <td bgcolor="E6E6E6"><strong>비밀번호</strong></td>
                        <td align="left"  style="padding-left:10px;"><input type="text" name="db_pass" style="width:95%" value="<?=$data[db_pass]?>"></td>
                      </tr>
                      <tr >
                        <td height="30" bgcolor="E6E6E6"><strong>가상주소</strong></td>
                        <td colspan="3" align="left" id="enddate4" style="padding-left:10px;"><input name="virtual_url" type="text" style="width:95%" value="<?=$data[virtual_url]?>"></td>
                      </tr>
                      <tr >
                        <td height="30" bgcolor="E6E6E6"><strong>도메인</strong></td>
                        <td colspan="3" align="left" id="enddate4" style="padding-left:10px;"><input name="domain" type="text" style="width:95%" value="<?=$data[domain]?>"></td>
                      </tr>
                      <tr >
                        <td bgcolor="E6E6E6" style="padding:10px;"><strong>중요정보</strong></td>
                        <td colspan="3" align="left" bgcolor="#FFFFFF" style="padding:10px;"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                            <tr>
                              <td  align="left"><textarea name="memo" style="width:98%; height:200px;"><?=$data[memo]?></textarea></td>
                              <td width="230" align="right"><table width="230" border="0" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
                                <tr>
                                  <td height="200">
							  	  <? if($data[p_file]){ ?>
								  <img src="/images/portfolio/<?=$data[p_file]?>" style="width:230px;height:200px;">
								  <? } ?>								  </td>
                                </tr>
                              </table></td>
                            </tr>
                          </table></td>
                      </tr>
                      <tr >
                        <td height="30" bgcolor="E6E6E6"><strong>포트폴리오</strong></td>
                        <td colspan="3" align="left" id="enddate15" style="padding-left:10px;"><table border="0" cellspacing="0" cellpadding="0">
    <tr>
                              <td><input type="radio" name="portfolio" id="radio" value="1" <? if($data[portfolio]=="1")echo "checked"; ?>></td>
                              <td style="padding-top:3px;">노출</td>
                              <td><input type="radio" name="portfolio" id="radio2" value="2" <? if($data[portfolio]=="2")echo "checked"; ?>></td>
                              <td style="padding-top:3px;">감춤</td>
							  <td width="500"><input name="upfile" type="file" style="width:100%"></td>
							  <td style="padding-top:3px;"><font color="#0066CC"><?=$data[p_file]?></font></td>
							  <td style="padding-top:3px;padding-left:3px;">(230*200)</td>
							  <? if($data[p_file]){ ?>
							  <td><input type="checkbox" name="checkbox" id="checkbox"></td>
							  <td style="padding-top:3px;"><font color="#FF0000">삭제</font></td>
							  <? } ?>
							</tr>
						  </table></td>
                      </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr align="center">
                    <td><input type="button" class="btn_blue" value="목록보기" onClick="window.location='sub01.php'"> 
                      <input type="button" class="btn_pink" value="등록하기" onClick="wr();">                    </td>
                  </tr>
</form>
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
