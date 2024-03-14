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
                <td height="600" align='center' valign="top" style='font-size:14px; padding:10px'><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td><table width="99%" border="0" cellpadding="0" cellspacing="0">
                      <tr>
                        <td height='15'><img src='../img/icon.gif' alt=""> 위치 : 계정관리 &gt; <strong>계정관리</strong> / <font color="#FF0000">*서버정보는 거래중단시만 오픈할것</font></td>
                        <td rowspan="4" align='right'>&nbsp;</td>
                      </tr>
                      <tr>
                        <td height='5'></td>
                      </tr>
                      <tr>
                        <td height='4'>&nbsp;</td>
                      </tr>
                      <tr>
                        <td height='5'></td>
                      </tr>
                    </table>                      </td>
              </tr>
                  <tr>
                    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td height="25" align="left"><span style="padding-left:3px">
                            <input name="input2" type="button" class="btn_pink" value="등록하기" onClick="window.location='sub01_write.php'">
                          </span>정렬: <font color="#0066CC"><a href="sub01.php?ord=1">FTP순</a> / <a href="sub01.php">결제일순</a></font></td>
                          <td align="right"><table border="0" cellspacing="0" cellpadding="2">
<form name="sform" method="get" >
                            <tr>
                              <td><select name="user_type2" onChange="document.sform.submit();">
                                  <option value="">:::서버명:::</option>
<?
		$sql="select * from config_category where CHAR_LENGTH(code)=4  ";
		$result=mysql_query($sql);
		while($data_c=mysql_fetch_array($result)){
?>
                          <option value="<?=$data_c[code]?>" <?if($data_c[code]==$user_type2)echo "selected";?>><?=$data_c[name]?></option>
<?
		}
?>
                                </select>
                                <select name="pay_type" onChange="document.sform.submit();">
                                  <option value="">:::납부:::</option>
                                  <option value="1" <?if($pay_type=="1")echo "selected";?>>월납</option>
                                  <option value="2" <?if($pay_type=="2")echo "selected";?>>년납</option>
                                  <option value="3" <?if($pay_type=="3")echo "selected";?>>무료</option>
                                </select></td>
                              <td><input name="sear" type="text" style="width:150px;" value="<?=$sear?>"></td>
                              <td ><img src="../img/search.jpg" onClick="document.sform.submit()"></td>
                              <td><img src="../img/btnl_excel.gif" align="absmiddle" onClick="exl_down('<?=base64_encode($whereis)?>')" style="cursor:pointer;"></td>
                            </tr>
</form>
                          </table>
                          </td>
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
                        <td width="2%" height="30" bgcolor="#E6E6E6"><input type='checkbox' name='allchk' id='allchk' style='vertical-align:middle;border:solid 0' onclick='chkall();'></td>
                        <td width="3%" bgcolor="#E6E6E6"><strong>no.</strong></td>
                        <td width="13%" bgcolor="#E6E6E6"><strong>업체명</strong></td>
                        <td width="6%" bgcolor="#E6E6E6"><strong>연결하기</strong></td>
                        <td width="8%" bgcolor="#E6E6E6"><strong>홈페이지</strong></td>
                        <td width="7%" bgcolor="#E6E6E6"><strong>담당자</strong></td>
                        <td width="8%" bgcolor="#E6E6E6"><strong>서버명</strong></td>
                        <td width="8%" bgcolor="#E6E6E6"><strong>IP</strong></td>
                        <!--td width="8%" bgcolor="#E6E6E6"><strong>FTP비번</strong></td-->
                        <td width="8%" bgcolor="#E6E6E6"><strong>FTP ID</strong></td>
                        <!--td width="9%" bgcolor="#E6E6E6"><strong>IP</strong></td-->
                        <td width="6%" bgcolor="#E6E6E6"><strong>호스팅</strong></td>
                        <td width="6%" bgcolor="#E6E6E6"><strong>납부</strong></td>
                        <td width="7%" bgcolor="#E6E6E6"><strong>합계(VAT포함)</strong></td>
                        <td width="8%" bgcolor="#E6E6E6"><strong>결제일</strong></td>
                        <td width="10%" bgcolor="#E6E6E6"><strong>보안인증서버</strong></td>
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

if($ord=="1"){
	$order=" order by ftp_id asc ";
}else{
	$order=" order by pay_date asc ";
}

$sql = "select count(*) as cnt from user where $wh ";
$total_count = sql_total($sql);
$paging_str = paging2($page, $page_row, $page_scale, $total_count,$_SERVER['PHP_SELF']."?"."sear=".$sear."&user_type2=$_GET[user_type2]&pay_type=$pay_type&sear=$sear");
$from_record = ($page - 1) * $page_row;

$sql="select * from user where $wh $order  ";
$result=sql_query($sql);
$i=$page_row*($page-1);
$k=0;
while($data=mysql_fetch_array($result)){
	if($data[pay_type]<"4"){
		$pt=$array_pay[$data[pay_type]];
	}else if($data[pay_type]=="4"){
		$pt='<input name="pay_type" type="button" style="background-color:#FF0000; color:#FFFFFF; border:1px solid #FF0000" class="btn_blue" value="중단">';
	}else if($data[pay_type]=="5"){
		$pt='<input name="button" type="button" style="background-color:#1f75cd; color:#FFFFFF;border:1px solid #1f75cd" class="btn_pink" value="보관">';
	}else if($data[pay_type]=="6"){
		$pt='<input name="button" type="button" style="background-color:#FF00FF; color:#FFFFFF;border:1px solid #FF00FF" class="btn_pink" value="부속">';
	}else{
		$pt="";
	}
?>
                      <tr onblur="this.style.backgroundColor='#EFACE8'" onfocus="this.style.backgroundColor='#FFF'" onMouseOver="this.style.backgroundColor='#EFACE8'" onMouseOut="this.style.backgroundColor='#FFF'" style="cursor:hand">
                        <td height="30"><input type="checkbox" name="check[]" class="text2" value='<?=$data[idx]?>'></td>
                        <td onClick="window.location='sub01_write.php?user_type2=<?=$user_type2?>&pay_type=<?=$pay_type?>&sear=<?=$sear?>&idx=<?=$data[idx]?>'"><?=$total_count-$i?></td>
                        <td align="left" style="font-weight:bold; padding-left:10px;" onClick="window.location='sub01_write.php?user_type2=<?=$user_type2?>&pay_type=<?=$pay_type?>&sear=<?=$sear?>&idx=<?=$data[idx]?>'"><font color="#0066CC"><?=$data[com_name]?></font></td>
                        <td align="center">
						<? if($data[virtual_url]){ ?>
						<input type="button" class='btn_blue' value="연결" onClick="window.open('http://<?=$data[virtual_url]?>');">
						<? } ?>						</td>
                        <td align="left" >
						<a href="http://<?=trim($data[domain])?>" target="_blank"><?=$data[domain]?></a>
						</td>
                        <td align="center" style="font-weight:bold;" onClick="window.location='sub01_write.php?user_type2=<?=$user_type2?>&pay_type=<?=$pay_type?>&sear=<?=$sear?>&idx=<?=$data[idx]?>'"><?=$data[dam_name]?></td>
                        <td onClick="window.location='sub01_write.php?user_type2=<?=$user_type2?>&pay_type=<?=$pay_type?>&sear=<?=$sear?>&idx=<?=$data[idx]?>'"><strong><?=cate($data[user_type2])?></strong></td>
                        <td onClick="window.location='sub01_write.php?user_type2=<?=$user_type2?>&pay_type=<?=$pay_type?>&sear=<?=$sear?>&idx=<?=$data[idx]?>'"><?=cate($data[user_type3])?></td>
                        <td onClick="window.location='sub01_write.php?user_type2=<?=$user_type2?>&pay_type=<?=$pay_type?>&sear=<?=$sear?>&idx=<?=$data[idx]?>'"><strong><font color="#0066CC"><?=$data[ftp_id]?></font></strong></td>
                        <td align="center" onClick="window.location='sub01_write.php?user_type2=<?=$user_type2?>&pay_type=<?=$pay_type?>&sear=<?=$sear?>&idx=<?=$data[idx]?>'"><?=$array_host_type[$data[host_type]]?></td>
                        <td onClick="window.location='sub01_write.php'"><?=$pt?></td>
                        <td><?=number($data[cost5])?></td>
                        <td><?=$data[pay_date]?></td>
                        <td><?=$data[secure_date]?></td>
                      </tr>
<?
	$i++;
	$total_pay+=$data[cost5];
}
?>
					<tr>
						<td height="30" colspan="11">합 계</td>
						<td><?=number($total_pay)?></td>
						<td></td>
					    <td></td>
					</tr>
</form>
                    </table></td>
                  </tr>
                  <tr>
                    <td align="center" height="40"></td>
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
