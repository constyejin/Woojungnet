<?
include $_SERVER['DOCUMENT_ROOT']."/admin/inc/header.php";
?>
<?
$query="delete from est where est_name='' and est_mobile='--' ";
mysql_query($query);
?>

<script>
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
		alert('삭제 항목을 선택해 주세요.');
	}else{
		if(confirm("삭제하시겠습니까?")){
			f=document.cform;
			f.action="sub01_del.php";
			f.submit();
		}
	}
}
function change_s(idx,state){
		if(confirm("변경 하시겠습니까?")){
			f=document.cform;
			f.idx.value=idx;
			f.state.value=state;
			f.action="sub01_change.php";
			f.submit();
		}else{
			document.location.reload();
		}
}

</script>

<iframe name="HiddenFrm" style="display:none;" width=800 height=150></iframe>
		  <? include "$DOCUMENT_ROOT/admin/inc/top.php";?>
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td height="600" align='center' valign="top" style='font-size:14px; padding:10px'><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td><table width="99%" border="0" cellpadding="0" cellspacing="0">
                      <tr>
                        <td height='30'><img src='../img/icon.gif' alt=""> 위치 : 견적문의 &gt; <strong>온라인견적문의</strong></td>
                        <td align='right'>&nbsp;</td>
                      </tr>
                    </table>                      </td>
              </tr>
                  <tr>
                    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td height="25" align="left">&nbsp;</td>
                          <td align="right">&nbsp;</td>
                      </tr>
                        <tr>
                          <td height="5" colspan="2" align="left"></td>
                        </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td><table width="100%"  border="1" cellpadding="0" cellspacing="0" bordercolor="d9d9d9" style="border-collapse:collapse;text-align:center;" class='pad_10'>

<form name="cform" method="post" enctype="multipart/form-data" target="HiddenFrm">
<input type="hidden" name="idx" value="">
<input type="hidden" name="state" value="">
					  <tr>
                        <td width="5%" height="30" bgcolor="#E6E6E6"><input type='checkbox' name='allchk' id='allchk' style='vertical-align:middle;border:solid 0' onclick='chkall();'></td>
                        <td width="4%" bgcolor="#E6E6E6"><strong>no.</strong></td>
                        <td width="14%" bgcolor="#E6E6E6"><strong>신청일</strong></td>
                        <td width="13%" bgcolor="#E6E6E6"><strong>이름</strong></td>
                        <td width="15%" bgcolor="#E6E6E6"><strong>연락처</strong></td>
                        <td width="14%" bgcolor="#E6E6E6"><strong>용도</strong></td>
                        <td width="11%" bgcolor="#E6E6E6"><strong>질문유형</strong></td>
                        <td width="11%" bgcolor="#E6E6E6"><strong>예상비용</strong></td>
                        <td width="13%" bgcolor="#E6E6E6"><strong>진행상태</strong></td>
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

$sql = "select count(*) as cnt from est where $wh ";
$total_count = sql_total($sql);
$paging_str = paging2($page, $page_row, $page_scale, $total_count,$_SERVER['PHP_SELF']."?"."sear=".$sear."&");
$from_record = ($page - 1) * $page_row;

$sql="select * from est where $wh order by regdate desc  limit ".$from_record.", ".$page_row;
$result=sql_query($sql);
$i=$page_row*($page-1);
$k=0;
while($data=mysql_fetch_array($result)){
?>
                      <tr style="cursor:hand" onMouseOver="this.style.backgroundColor='#EFACE8'" onMouseOut="this.style.backgroundColor='#FFF'" onblur="this.style.backgroundColor='#EFACE8'" onfocus="this.style.backgroundColor='#FFF'">
                        <td height="30"><input type="checkbox" name="check[]" class="text2" value='<?=$data[idx]?>'></td>
                        <td onClick="window.location='view.php?idx=<?=$data[idx]?>'"><?=$total_count-$i?></td>
                        <td onClick="window.location='view.php?idx=<?=$data[idx]?>'"><?=$data[regdate]?></td>
                        <td onClick="window.location='view.php?idx=<?=$data[idx]?>'"><?=$data[est_name]?></td>
                        <td onClick="window.location='view.php?idx=<?=$data[idx]?>'"><?=$data[est_mobile]?></td>
                        <td onClick="window.location='view.php?idx=<?=$data[idx]?>'"><?=$array_est_type1[$data[type1]]?></td>
                        <td onClick="window.location='view.php?idx=<?=$data[idx]?>'"><?=$array_est_type2[$data[type2]]?></td>
                        <td align="center" onClick="window.location='view.php?idx=<?=$data[idx]?>'"><?=number($data[pay])?>만원</td>
                        <td >
							<select onchange="change_s('<?=$data[idx]?>',this.value);">
							<option value="1" <? if($data[state]=="1")echo "selected"; ?>>신규</option>
							<option value="2" <? if($data[state]=="2")echo "selected"; ?>>완료</option>
							</select>
						</td>
                      </tr>
<?
	$i++;
}
?>
</form>
                      
                    </table></td>
                  </tr>
                  <tr>
                    <td align="center" height="40"><?=$paging_str?></td>
                  </tr>
                  <tr>
                    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="200" valign="top"><input type="button" value="선택삭제" class='btn_blue' onclick='allDel();'></td>
                        <td align="center">&nbsp;</td>
                        <td width="200" align="right">&nbsp;</td>
                      </tr>
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
