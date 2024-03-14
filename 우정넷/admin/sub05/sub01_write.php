<?
include $_SERVER['DOCUMENT_ROOT']."/admin/inc/header.php";
?>

<?
if($_GET[idx]){
	$sql="select * from server where idx='$_GET[idx]' ";
	$data=sql_fetch($sql,$connect);
	$sdate=explode("-",$data[sdate]);
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
	gufrm.location.href = "cate_ch.php?tmp="+tmp;  
} 
function cate2(z){ 
	var tmp = z.options[z.selectedIndex].value; 
	document.cform.type3.options[0].selected="true";
	gufrm.location.href = "cate_ch2.php?tmp="+tmp;  
} 
function memo_del(idx){ 
	if(confirm('삭제하시겠습니까?')){
		location.href="sub01_memo_del.php?idx="+idx;
	}
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
                <td height="750" align='center' valign="top" style='font-size:14px; padding:10px'>                  <table width="1000" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td><table width="99%" border="0" cellpadding="0" cellspacing="0">
                      <tr>
                        <td height='30'><img src='../img/icon.gif' alt=""> 위치 : 서버관리 &gt; <strong>서버관리</strong></td>
                        <td align='right'>&nbsp;</td>
                      </tr>
                    </table>                      </td>
              </tr>
                  <tr>
                    <td align="center"><input type="button" class="btn_blue" value="목록보기" onClick="window.location='sub01.php'">
                      <input type="button" class="btn_pink" value="등록하기" onClick="wr();">                    </td>
                  </tr>
                  <tr>
                    <td align="center">&nbsp;</td>
                  </tr>
<form name="cform" method="post" enctype="multipart/form-data" target="HiddenFrm">
<input type="hidden" name="idx" value="<?=$_GET[idx]?>">
				  <tr>
                    <td><table width="100%"  border="1" cellpadding="0" cellspacing="0" bordercolor="d9d9d9" style="border-collapse:collapse;text-align:center;" class='pad_10'>
                      <tr>
                        <td width="150" height="30" bgcolor="E6E6E6"><strong>서버구분</strong></td>
                        <td colspan="3" align="left" style="padding-left:10px;">
                        <select name="type1" onchange="cate1(this)">
                          <option value="">:::서버회사:::</option>
<?
	$sql="select * from config_category where CHAR_LENGTH(code)=2 order by sortno ";
	$result=mysql_query($sql);
	while($data_c=mysql_fetch_array($result)){
?>
                          <option value="<?=$data_c[code]?>" <?if($data_c[code]==$data[type1])echo "selected";?>><?=$data_c[name]?></option>
<?
	}
?>
						</select>
                        <select name="type2" onchange="cate2(this)">
						<option value="">:::서버명:::</option>
<?
	if($data[type1]){
		$sql="select * from config_category where CHAR_LENGTH(code)=4 and code like '$data[type1]%' order by sortno ";
		$result=mysql_query($sql);
		while($data_c=mysql_fetch_array($result)){
?>
                          <option value="<?=$data_c[code]?>" <?if($data_c[code]==$data[type2])echo "selected";?>><?=$data_c[name]?></option>
<?
		}
	}
?>
						</select>
                        <select name="type3">
                          <option value="">:::아이피:::</option>
<?
	if($data[type2]){
		$sql="select * from config_category where CHAR_LENGTH(code)=6 and code like '$data[type2]%' order by sortno ";
		$result=mysql_query($sql);
		while($data_c=mysql_fetch_array($result)){
?>
                          <option value="<?=$data_c[code]?>" <?if($data_c[code]==$data[type3])echo "selected";?>><?=$data_c[name]?></option>
<?
		}
	}
?>
                        </select></td>
                      </tr>
                      <tr >
                        <td height="30" bgcolor="E6E6E6"><strong>서버회사아이디</strong></td>
                        <td width="350" align="left" style="padding-left:10px;">
                          <input type="text" name="server_id" style="width:95%" value="<?=$data[server_id]?>"></td>
                        <td width="150" align="center" bgcolor="E6E6E6"><strong>서버회사비번</strong></td>
                        <td width="350" align="left" style="padding-left:10px;"><input type="text" name="server_pass" style="width:95%" value="<?=$data[server_pass]?>"></td>
                      </tr>
                      <tr >
                        <td height="30" bgcolor="E6E6E6"><strong>root 비번</strong></td>
                        <td align="left" id="enddate" style="padding-left:10px;"><input type="text" name="root_pass" style="width:95%" value="<?=$data[root_pass]?>"></td>
                        <td bgcolor="E6E6E6"><strong>root db 비번</strong></td>
                        <td align="left"  style="padding-left:10px;"><input type="text" name="root_db_pass" style="width:95%" value="<?=$data[root_db_pass]?>"></td>
                      </tr>
                      <tr >
                        <td height="30" bgcolor="E6E6E6"><strong>신청일</strong></td>
                        <td align="left" id="enddate8" style="padding-left:10px;">
                         <input name="sy" type="text" size="6" maxlength="4" value="<?=$sdate[0]?>"> 
                         년
                          <input name="sm" type="text"  size="3" maxlength="2" value="<?=$sdate[1]?>">
						월
						<input name="sd" type="text"  size="3" maxlength="2" value="<?=$sdate[2]?>">
						일</td>
                        <td bgcolor="E6E6E6"><strong>연장일</strong></td>
                        <td align="left"  style="padding-left:10px;">매월
                          <input name="edate" type="text"  size="3" maxlength="2" value="<?=$data[edate]?>">
						일</td>
                      </tr>
                      <tr >
                        <td bgcolor="E6E6E6" style="padding:10px;"><strong>중요사항</strong></td>
                        <td colspan="3" bgcolor="#FFFFFF" style="padding:10px;"><textarea name="memo" rows="5" style="width:100%; height:200px;"><?=$data[memo]?></textarea></td>
                      </tr>

                    </table></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="center"><input name="input3" type="button" class="btn_blue" value="목록보기" onClick="window.location='sub01.php'">
                      <input type="button" class="btn_pink" value="등록하기" onClick="wr();">                    </td>
                  </tr>
</form>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td><table width="100%"  border="1" cellpadding="0" cellspacing="0" bordercolor="d9d9d9" style="border-collapse:collapse;text-align:center;" class='pad_10'>
<form name="cform_memo" method="post" enctype="multipart/form-data" target="HiddenFrm" action="sub01_memo_save.php">
<input type="hidden" name="server_idx" value="<?=$_GET[idx]?>">
                      <tr>
                        <td width="150" height="30" bgcolor="E6E6E6"><strong>메모</strong></td>
                        <td align="left" style="padding-left:10px;"><input name="memo" type="text" style="width:85%">
                        <input type="button" class="btn_pink" value="등록" onclick="document.cform_memo.submit();"></td>
                      </tr>
</form>
<?
$sql="select * from server_memo where server_idx='$_GET[idx]' order by regdate desc ";
$result=sql_query($sql);
while($data_memo=mysql_fetch_array($result)){
?>
					  <tr >
                        <td height="30" bgcolor="#FFFFFF"><?=substr($data_memo[regdate],0,10)?></td>
                        <td align="left" style="padding-left:10px;"><?=$data_memo[memo]?> <font style="cursor:pointer;" color="#FF0000" onclick="memo_del('<?=$data_memo[idx]?>')">삭제</font></td>
                      </tr>
<?
}
?>
                    </table></td>
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
