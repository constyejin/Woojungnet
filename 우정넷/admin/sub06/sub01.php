<?
include $_SERVER['DOCUMENT_ROOT']."/admin/inc/header.php";
?>

<style>
.ui-datepicker select.ui-datepicker-month{ width:30%;  }
.ui-datepicker select.ui-datepicker-year{ width:40%; }
</style>

<script>
function wr(idx){
	f=document.cform;
	f.idx.value=idx;
	f.action="sub01_save.php";
	f.submit();
}
function chkall(){
	var cobj = document.getElementById('allchk');
	var obj = document.getElementsByName('check[]');
	for(var i=0; i < obj.length ; i++){
		if (cobj.checked == true)
		{
			obj[i].checked = true;
		}else{
			obj[i].checked = false;
		}
	}
}
function allDel(){
	var c=0;
	var obj = document.getElementsByName('check[]');
	for(var i=0; i < obj.length ; i++){
		if (obj[i].checked == true){
			c++;
		}
	}
	if(c<1){
	}else{
		if(confirm("삭제하시겠습니까?")){
			f=document.cform;
			f.action="sub01_del.php";
			f.submit();
		}
	}
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
                    <td align="right">&nbsp;</td>
                  </tr>
                  <tr>
                    <td><table width="100%"  border="1" cellpadding="0" cellspacing="0" bordercolor="d9d9d9" style="border-collapse:collapse;text-align:center;" class='pad_10'>

<form name="cform" method="post" enctype="multipart/form-data" target="HiddenFrm">
<input type="hidden" name="idx" value="">
					  <tr>
                        <td width="4%" bgcolor="#E6E6E6"><input type='checkbox' name='allchk' id='allchk' style='vertical-align:middle;border:solid 0' onclick='chkall();'></td>
                        <td width="4%" bgcolor="#E6E6E6"><strong>no.</strong></td>
                        <td width="17%" bgcolor="#E6E6E6"><strong>이름</strong></td>
                        <td width="20%" bgcolor="#E6E6E6"><strong>아이디</strong></td>
                        <td width="20%" bgcolor="#E6E6E6"><strong>비번</strong></td>
                        <td width="20%" bgcolor="#E6E6E6"><strong>연락처</strong></td>
                        <td width="15%" bgcolor="#E6E6E6"><strong>비고</strong></td>
                      </tr>

<?
if($_GET[page] && $_GET[page] > 0){
    $page = $_GET[page];
}else{
    $page = 1;
}
// 한 페이지에 보일 글 수
$page_row = 20;
// 한줄에 보여질 페이지 수
$page_scale = 10;
$paging_str = "";

$wh=" 1 ";

$sql = "select count(*) as cnt from member where $wh ";
$total_count = sql_total($sql);
$paging_str = paging2($page, $page_row, $page_scale, $total_count,$_SERVER['PHP_SELF']."?"."sear=".$sear."&lev=$_GET[lev]&");
$from_record = ($page - 1) * $page_row;

$sql="select * from member where $wh order by idx desc  limit ".$from_record.", ".$page_row;
$result=sql_query($sql);
$i=$page_row*($page-1);
$k=0;
while($data=mysql_fetch_array($result)){
	$user_mobile=explode("-",$data[user_mobile]);
?>
                      <tr style="cursor:hand" onMouseOver="this.style.backgroundColor='#EFACE8'" onMouseOut="this.style.backgroundColor='#FFF'" onblur="this.style.backgroundColor='#EFACE8'" onfocus="this.style.backgroundColor='#FFF'">
                        <td><input type="checkbox" name="check[]" class="text2" value='<?=$data[idx]?>'></td>
                        <td ><?=$data[idx]?></td>
                        <td ><input type="text" name="user_name[]" style="width:90%" value="<?=$data[user_name]?>"></td>
                        <td ><input type="text" name="user_id[]" style="width:90%" value="<?=$data[user_id]?>"></td>
                        <td ><input type="text" name="user_pass[]" style="width:90%" value="<?=$data[user_pass]?>"></td>
                        <td >
						<input type="text" name="user_mobile1[]" style="width:20%" value="<?=$user_mobile[0]?>">
						-
						<input type="text" name="user_mobile2[]" style="width:20%" value="<?=$user_mobile[1]?>">
						-
						<input type="text" name="user_mobile3[]" style="width:20%" value="<?=$user_mobile[2]?>">
						</td>
                        <td ><span style="padding-left:3px">
                          <input type="button" class="btn_pink" value="등록" onClick="wr('<?=$data[idx]?>')">
                        </span></td>
                      </tr>
<?
}
?>
</form>                     

                    </table></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="33%"><input type="button" class="btn_blue" value="선택삭제" onclick='allDel();'></td>
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
