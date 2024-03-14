<?
include $_SERVER['DOCUMENT_ROOT']."/admin/inc/header.php";
?>

<?
if(strlen($ccode)==2){
	$code1=$ccode;
	$sql="select * from config_category where CHAR_LENGTH(code)=2 and code1='$code1' ";
	$result=mysql_query($sql);
	$now_code1 = mysql_fetch_assoc($result);
}
if(strlen($ccode)==4){
	$code1=substr($ccode,0,2);
	$code2=substr($ccode,2,2);
	$sql="select * from config_category where CHAR_LENGTH(code)=2 and code1='$code1' ";
	$result=mysql_query($sql);
	$now_code1 = mysql_fetch_assoc($result);
	$sql="select * from config_category where CHAR_LENGTH(code)=4 and code1='$code1' and code2='$code2' ";
	$result=mysql_query($sql);
	$now_code2 = mysql_fetch_assoc($result);
}
?>

<script>
function wr(){
	f=document.cform;
	f.category.value="reg";
	f.submit();
}
function del(a){
	f=document.cform;
	f.category.value="del";
	f.code.value=a;
	f.submit();
}
function mod(a){
	f=document.cform;
	f.category.value="edit";
	f.code.value=a;
	f.submit();
}
</script>

<style>
.ui-datepicker select.ui-datepicker-month{ width:30%;  }
.ui-datepicker select.ui-datepicker-year{ width:40%; }
.pad_10 td {height:30px;}
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
                <td height="750" align='center' valign="top" style='font-size:14px; padding:10px'>                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td><table width="99%" border="0" cellpadding="0" cellspacing="0">
                      <tr>
                        <td height='30'><img src='../img/icon.gif' alt=""> 위치 : 그룹설정 &gt; <strong>그룹설정</strong></td>
                        <td align='right'>&nbsp;</td>
                      </tr>
                    </table>                      </td>
              </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
<form name="cform" method="post" enctype="multipart/form-data" action="category_save.php" target="HiddenFrm">
<input type="hidden" name="code" value="">
<input type="hidden" name="ccode" value="<?=$ccode?>">
<input type="hidden" name="code1" value="<?=$code1?>">
<input type="hidden" name="code2" value="<?=$code2?>">
<input type="hidden" name="code3" value="<?=$code3?>">
<input type="hidden" name="category" value="reg">
                  <tr>
                    <td align="center"><table width="100%"  border="1" cellpadding="0" cellspacing="0" bordercolor="d9d9d9" style="border-collapse:collapse;text-align:center;" class='pad_10'>
                        <TR>
                          <TD height="30" colspan="4" align="center" bgcolor="E6E6E6">선택한 상위 디렉토리 : <strong><A href="/admin/sub03/sub01.php">최상위</A> 
							<?
							if($code1){
								echo "> ".$now_code1[name];
							}
							?>
							<?
							if($code2){
								echo "> ".$now_code2[name];
							}
							?>
						  </strong>
						  </TD>
                          <TD colspan="5" align="center" bgcolor="E6E6E6">좌측에 선택한 위치에 등록됨
                            <INPUT name="cname" type="text">
                              <INPUT onClick="wr();" type="button" class="btn_pink" value="등록하기"></TD>
                        </TR>
                        <TR>
                          <TD width="6%" height="30" align="center" bgcolor="E6E6E6">정렬</TD>
                          <TD width="22%" align="center" bgcolor="E6E6E6">1차 카테고리</TD>
                          <TD width="7%" align="center" bgcolor="E6E6E6">비고</TD>
                          <TD width="6%" align="center" bgcolor="E6E6E6">정렬</TD>
                          <TD align="center" bgcolor="E6E6E6">2차 카테고리</TD>
                          <TD width="7%" align="center" bgcolor="E6E6E6">비고</TD>
                          <TD width="6%" align="center" bgcolor="E6E6E6">정렬</TD>
                          <TD width="20%" align="center" bgcolor="E6E6E6">3차 카테고리</TD>
                          <TD width="7%" align="center" bgcolor="E6E6E6">비고</TD>
                        </TR>
<?
$sql="select * from config_category where CHAR_LENGTH(code)=2 order by sortno,name";
$result=mysql_query($sql);
$data = mysql_fetch_assoc($result);

$sql2="select * from config_category where CHAR_LENGTH(code)=4 and code1='$code1' order by sortno,name";
$result2=mysql_query($sql2);
$data2 = mysql_fetch_assoc($result2);

$sql3="select * from config_category where CHAR_LENGTH(code)=6 and code1='$code1' and code2='$code2' order by sortno,name";
$result3=mysql_query($sql3);
$data3 = mysql_fetch_assoc($result3);

while($data[idx] || $data2[idx] || $data3[idx]){
	$row = mysql_fetch_array(mysql_query("select count(idx) from config_category where (code >= '".$data[code]."01' and code <= '".$data[code]."99') and CHAR_LENGTH(code)=4 "));
	$row2 = mysql_fetch_array(mysql_query("select count(idx) from config_category where code1='$code1' and code2='".$data2[code2]."' and CHAR_LENGTH(code)=6 "));
?>
						<tr>
<?
		if($_GET[idx]&&$_GET[idx]==$data[idx]){
?>
							<td class="li_st2">
								<input name="sortno" value="<?=$data[sortno]?>" style="width:20px;">
							</td>
							<td class="li_st2" style="text-align:left;">&nbsp;
								<input name="name" value="<?=$data[name]?>">
							</td>
							<td class="li_st2">
								<input type="button" value="변경" onClick="mod('<?=$data[code]?>');">
								<input type="button" value="취소" onClick="history.back();">
							</td>
<?
		}else{
?>
							<td class="li_st2">
							<?
							if($data[idx]){
								echo $data[sortno];
							}else{
								echo '&nbsp;';
							}
							?>
							</td>
							<td class="li_st2" style="text-align:left;" onClick="location.href='sub01.php?ccode=<?=$data[code]?>';">&nbsp;
							<?
							if($data[idx]){
								if($code1==$data[code1]){
									echo '<span style="cursor:pointer;color:red;">';
									echo '<img src="../img/open.gif">';
								}else{
									echo '<span style="cursor:pointer;">';
									echo '<img src="../img/close.gif">';
								}
								echo $data[name]."(".$row[0].")";
								echo '</span>';
							}
							?>
							</td>
							<td class="li_st2">
							<?
							if($data[idx]){
								echo '<a href="sub01.php?ccode='.$ccode.'&idx='.$data[idx].'">수정</a>';
								if($row[0]==0){
								echo ' / <span onClick="if(confirm(\'정말로삭제하시겠습니까?\')){del(\''.$data[code].'\');};" style="cursor:pointer;">삭제</span>';
								}
							}else{
								echo '&nbsp;';
							}
							?>
							</td>
<?
		}
?>
<?
		if($_GET[idx]&&$_GET[idx]==$data2[idx]){
?>
							<td class="li_st2">
								<input name="sortno" value="<?=$data2[sortno]?>" style="width:20px;">
							</td>
							<td class="li_st2" style="text-align:left;">&nbsp;
								<input name="name" value="<?=$data2[name]?>">
							</td>
							<td class="li_st2">
								<input type="button" value="변경" onClick="mod('<?=$data2[code]?>');">
								<input type="button" value="취소" onClick="history.back();">
							</td>
<?
		}else{
?>
							<td class="li_st2">
							<?
							if($data2[idx]){
								echo $data2[sortno];
							}else{
								echo '&nbsp;';
							}
							?>
							</td>
							<td class="li_st2" style="text-align:left;" onClick="location.href='sub01.php?ccode=<?=$data2[code]?>';">&nbsp; 
							<?
							if($data2[idx]){
								if($code2==$data2[code2]){
									echo '<span style="cursor:pointer;color:red;">';
								}else{
									echo '<span style="cursor:pointer;">';
								}
								echo '<img src="../img/edit.png">';
								echo $data2[name]."(".$row2[0].")";
								echo '</span>';
							}
							?>
							</td>
							<td class="li_st2">
							<?
							if($data2[idx]){
								echo '<a href="sub01.php?ccode='.$ccode.'&idx='.$data2[idx].'">수정</a>';
								if($row2[0]==0){
								echo ' / <span onClick="if(confirm(\'정말로삭제하시겠습니까?\')){del(\''.$data2[code].'\');};" style="cursor:pointer;">삭제</span>';
								}
							}else{
								echo '&nbsp;';
							}
							?>
							</td>
<?
		}
?>
<?
		if($_GET[idx]&&$_GET[idx]==$data3[idx]){
?>
							<td class="li_st2">
								<input name="sortno" value="<?=$data3[sortno]?>" style="width:20px;">
							</td>
							<td class="li_st2" style="text-align:left;">&nbsp;
								<input name="name" value="<?=$data3[name]?>">
							</td>
							<td class="li_st2">
								<input type="button" value="변경" onClick="mod('<?=$data3[code]?>');">
								<input type="button" value="취소" onClick="history.back();">
							</td>
<?
		}else{
?>
							<td class="li_st2">
							<?
							if($data3[idx]){
								echo $data3[sortno];
							}else{
								echo '&nbsp;';
							}
							?>
							</td>
							<td class="li_st2" style="text-align:left">&nbsp;
							<?
							if($data3[idx]){
								echo '<img src="../img/edit.png">';
								echo $data3[name];
							}
							?>
							</td>
							<td class="li_st3">
							<?
							if($data3[idx]){
								echo '<a href="sub01.php?ccode='.$ccode.'&idx='.$data3[idx].'">수정</a> / <span onClick="if(confirm(\'정말로삭제하시겠습니까?\')){del(\''.$data3[code].'\');};" style="cursor:pointer;">삭제</span>';
							}else{
								echo '&nbsp;';
							}
							?>
							</td>
<?
		}
?>
						</tr>
<?
	$data = mysql_fetch_assoc($result);
	$data2 = mysql_fetch_assoc($result2);
	$data3 = mysql_fetch_assoc($result3);
}
?>
                    </TABLE>
                    </td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                </table></td>
                </tr>
            </table>
		</td>
  </tr>
</form>
	<tr>
		<td height='100%'>
			<!--body-->			
			<!--/body-->
		</td>
	</tr>
</table>
</body>
