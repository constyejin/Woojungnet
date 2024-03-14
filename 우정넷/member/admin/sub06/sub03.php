<?
include $_SERVER['DOCUMENT_ROOT']."/admin/inc/header.php";
?>

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
                    <td align="left">&nbsp;</td>
                  </tr>
                  <tr>
                    <td height="30"><input name="input2" type="button" class="btn_pink" value="등록하기" onClick="window.location='sub03_write.php'"></td>
                  </tr>
                  <tr>
                    <td><table width="100%"  border="1" cellpadding="0" cellspacing="0" bordercolor="d9d9d9" style="border-collapse:collapse;text-align:center;" class='pad_10'>
                      <tr>
                        <td width="5%" bgcolor="#E6E6E6"><input type='checkbox' name='allchk' id='allchk' style='vertical-align:middle;border:solid 0' onclick='chkall();'></td>
                        <td width="4%" bgcolor="#E6E6E6"><strong>no.</strong></td>
                        <td width="14%" bgcolor="#E6E6E6"><strong>사진</strong></td>
                        <td width="42%" bgcolor="#E6E6E6"><strong>제목</strong></td>
                        <td width="8%" bgcolor="#E6E6E6"><strong>노출</strong></td>
                        <td width="8%" bgcolor="#E6E6E6"><strong>스크롤</strong></td>
                        <td width="9%" bgcolor="#E6E6E6"><strong>하루적용</strong></td>
                        <td width="10%" bgcolor="#E6E6E6"><strong>창닫기</strong></td>
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

if($user_type2){
	$wh .= " and user_type2='$user_type2' ";
}
if($pay_type){
	$wh .= " and pay_type='$pay_type' ";
}
if($sear){
	$wh .= " and ( com_name like '%$sear%' or mobile like '%$sear%' ) ";
}

$sql = "select count(*) as cnt from config_popup where $wh ";
$total_count = sql_total($sql);
$paging_str = paging2($page, $page_row, $page_scale, $total_count,$_SERVER['PHP_SELF']."?"."sear=".$sear."&user_type2=$_GET[user_type2]&pay_type=$pay_type&sear=$sear");
$from_record = ($page - 1) * $page_row;

$sql="select * from config_popup where $wh order by regdate desc  limit ".$from_record.", ".$page_row;
$result=sql_query($sql);
$i=$page_row*($page-1);
$k=0;
while($data=mysql_fetch_array($result)){
?>
                      <tr style="cursor:hand" onMouseOver="this.style.backgroundColor='#EFACE8'" onMouseOut="this.style.backgroundColor='#FFF'" onblur="this.style.backgroundColor='#EFACE8'" onfocus="this.style.backgroundColor='#FFF'">
                        <td><input type="checkbox" name="check[]" class="text2" value='<?=$data[idx]?>'></td>
                        <td onClick="window.location='sub03_write.php?idx=<?=$data[idx]?>'"><?=$total_count--;?></td>
                        <td onClick="window.location='sub03_write.php?idx=<?=$data[idx]?>'" style="padding:5px;"><img src="/images/popup/<?=$data[image1]?>" width=100></td>
                        <td onClick="window.location='sub03_write.php?idx=<?=$data[idx]?>'"><?=$data[subject]?></td>
                        <td onClick="window.location='sub03_write.php?idx=<?=$data[idx]?>'"><?=textout($data[application])?></td>
                        <td onClick="window.location='sub03_write.php?idx=<?=$data[idx]?>'"><?=textout($data[scroll])?></td>
                        <td align="center" onClick="window.location='sub03_write.php?idx=<?=$data[idx]?>'"><?=textout($data[oneday])?></td>
                        <td onClick="window.location='sub03_write.php?idx=<?=$data[idx]?>'"><?=textout($data[close])?></td>
                      </tr>
<?
	$i++;
}
?>

                    </table></td>
                  </tr>
                  <tr>
                    <td align="center" height="40"><?=$paging_str?></td>
                  </tr>
                  <tr>
                    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="33%"><input name="input" type="button" class="btn_blue" value="선택삭제"></td>
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
