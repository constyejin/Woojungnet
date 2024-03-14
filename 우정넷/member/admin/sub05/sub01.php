<?
include $_SERVER['DOCUMENT_ROOT']."/admin/inc/header.php";
?>

<style>
.ui-datepicker select.ui-datepicker-month{ width:30%;  }
.ui-datepicker select.ui-datepicker-year{ width:40%; }
</style>

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
                    <td colspan="2"><table width="99%" border="0" cellpadding="0" cellspacing="0">
                      <tr>
                        <td height='30'><img src='../img/icon.gif' alt=""> 위치 : 서버관리 &gt; <strong>서버관리</strong></td>
                        <td align='right'>&nbsp;</td>
                      </tr>
                    </table>                      </td>
              </tr>
                  <tr>
                    <td height="30" style="color:#FF0000">1.서버호스팅만 고객소유임 (거래중단시만 오픈할것)<br>
                    2.용량= 서버의 하드가 거의 다 찬 상태로 추가계정을 만들면 안됨/(70%)이상 사용금지<br>
                    3.오버=트리픽오버로 더 이상 추가로 올리지 말고 매월 트리픽을 검사해야 함 /(70%)이상 사용금지</td>
                    <td align="right" valign="bottom" style="color:#FF0000"><img src="../img/btnl_excel.gif" align="absmiddle" onClick="exl_down('<?=base64_encode($whereis)?>')" style="cursor:pointer;"></td>
                  </tr>
                  <tr>
                    <td colspan="2">&nbsp;</td>
                  </tr>
                  <tr>
                    <td colspan="2"><table width="100%"  border="1" cellpadding="0" cellspacing="0" bordercolor="d9d9d9" style="border-collapse:collapse;text-align:center;" class='pad_10'>
                      
<form name="cform" method="post" enctype="multipart/form-data" target="HiddenFrm">
<input type="hidden" name="idx" value="">
<input type="hidden" name="state" value="">
                      <tr>
                        <td width="3%" height="30" bgcolor="E6E6E6"><input type='checkbox' name='allchk' id='allchk' style='vertical-align:middle;border:solid 0' onclick='chkall();'></td>
                        <td width="3%" bgcolor="E6E6E6"><strong>no.</strong></td>
                        <td width="11%" bgcolor="E6E6E6"><strong>신청일</strong></td>
                        <td width="8%" bgcolor="E6E6E6"><strong>서버명</strong></td>
                        <td width="13%" bgcolor="E6E6E6"><strong>서버회사</strong></td>
                        <td width="11%" bgcolor="E6E6E6"><strong>아이디</strong></td>
                        <td width="11%" bgcolor="E6E6E6"><strong>비밀번호</strong></td>
                        <td width="10%" bgcolor="E6E6E6"><strong>IP</strong></td>
                        <td width="8%" bgcolor="E6E6E6"><strong>root</strong></td>
                        <td width="7%" bgcolor="E6E6E6"><strong>root db</strong></td>
                        <td width="6%" bgcolor="E6E6E6"><strong>결제일</strong></td>
                        <td width="9%" bgcolor="E6E6E6"><strong>진행상태</strong></td>
                      </tr>
<?
if($_GET[page] && $_GET[page] > 0){
    $page = $_GET[page];
}else{
    $page = 1;
}
// 한 페이지에 보일 글 수
$page_row = 50;
// 한줄에 보여질 페이지 수
$page_scale = 10;
$paging_str = "";

$wh=" 1 ";

$sql = "select count(*) as cnt from server where $wh ";
$total_count = sql_total($sql);
$paging_str = paging2($page, $page_row, $page_scale, $total_count,$_SERVER['PHP_SELF']."?"."sear=".$sear."&lev=$_GET[lev]&");
$from_record = ($page - 1) * $page_row;

$sql="select * from server where $wh order by sdate asc  limit ".$from_record.", ".$page_row;
$result=sql_query($sql);
$i=$page_row*($page-1);
$k=0;
while($data=mysql_fetch_array($result)){
?>
					  <tr onblur="this.style.backgroundColor='#EFACE8'" onfocus="this.style.backgroundColor='#FFF'" onMouseOver="this.style.backgroundColor='#EFACE8'" onMouseOut="this.style.backgroundColor='#FFF'" style="cursor:hand">
                        <td height="30"><input type="checkbox" name="check[]" class="text2" value='<?=$data[idx]?>'></td>
                        <td onClick="window.location='sub01_write.php?idx=<?=$data[idx]?>'"><?=$total_count-$i?></td>
                        <td onClick="window.location='sub01_write.php?idx=<?=$data[idx]?>'"><?=$data[sdate]?></td>
                        <td><strong><font color="#0066CC"><?=cate($data[type2])?></font></strong></td>
                        <td align="center" onClick="window.location='sub01_write.php?idx=<?=$data[idx]?>'"><?=cate($data[type1])?></td>
                        <td onClick="window.location='sub01_write.php?idx=<?=$data[idx]?>'"><?=$data[server_id]?></td>
                        <td onClick="window.location='sub01_write.php?idx=<?=$data[idx]?>'"><?=$data[server_pass]?></td>
                        <td onClick="window.location='sub01_write.php?idx=<?=$data[idx]?>'"><?=cate($data[type3])?></td>
                        <td onClick="window.location='sub01_write.php?idx=<?=$data[idx]?>'"><?=$data[root_pass]?></td>
                        <td onClick="window.location='sub01_write.php?idx=<?=$data[idx]?>'"><?=$data[root_db_pass]?></td>
                        <td><?=$data[edate]?>일</td>
                        <td>
							<select onChange="change_s('<?=$data[idx]?>',this.value);">
							<option value="">::상태::</option>
							<option value="1" <? if($data[state]=="1")echo "selected"; ?>>사용</option>
							<option value="2" <? if($data[state]=="2")echo "selected"; ?>>용량</option>
							<option value="3" <? if($data[state]=="3")echo "selected"; ?>>오버</option>
							<option value="4" <? if($data[state]=="4")echo "selected"; ?>>이전</option>
							<option value="5" <? if($data[state]=="5")echo "selected"; ?>>중지</option>
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
                    <td colspan="2" align="center" height="40"><?=$paging_str?></td>
                  </tr>
                  <tr>
                    <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="200" valign="top"><input type="button" value="선택삭제" class='btn_blue' onclick='allDel();'></td>
                        <td align="center">&nbsp;</td>
                      <td width="200" align="right"><span style="padding-left:3px">
                          <input name="input2" type="button" class="btn_pink" value="등록하기" onClick="window.location='sub01_write.php'">
                        </span></td>
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
