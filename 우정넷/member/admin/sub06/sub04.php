<?
include $_SERVER['DOCUMENT_ROOT']."/admin/inc/header.php";
?>

<?
if($_GET[idx])$data_m=mysql_fetch_array(mysql_query("select * from config_layer where idx='$_GET[idx]'"));
?>

<style>
.ui-datepicker select.ui-datepicker-month{ width:30%;  }
.ui-datepicker select.ui-datepicker-year{ width:40%; }
</style>

<script type="text/javascript">
function del(idx){
	if(confirm('�����Ͻðڽ��ϱ�?')){
		location.href="del.php?idx="+idx;
	}
}
</script>

<body leftmargin="0" topmargin="0" rightmargin="0" bottommargin="0">
<iframe name="HiddenFrm" style="display:none;" width=800 height=150></iframe>
<table width="100%" border="0" cellpadding="0" cellspacing="0" height='100%'>
	<tr>
		<td valign='top'>
			<!--�ΰ� & ž�޴�-->
		  <? include "$DOCUMENT_ROOT/admin/inc/top.php";?>
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td width='130' align='center' valign="top" style='font-size:14px;'><? include "$DOCUMENT_ROOT/admin/inc/sm_sub06_04.php";?></td>
                <td width="1" height="750" valign="top" bgcolor="d7d7d7"><img src="../img/sb.gif" width="1" height="1" /></td>
                <td valign="top" style='padding:10px;'><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td><table width="99%" border="0" cellpadding="0" cellspacing="0">
                      <tr>
                        <td height='30'><img src='../img/icon.gif' alt=""> ��ġ : ȯ�漳�� &gt; <strong>���̾��˾�</strong></td>
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
                    <td align="right"><table width="100%"  border="1" cellpadding="0" cellspacing="0" bordercolor="d9d9d9" style="border-collapse:collapse;text-align:center;" class='pad_10'>
<form name="subMain" method="post" action="pop_ok.php"  enctype="multipart/form-data" target="HiddenFrm">
<input type="hidden" name="qcommon" value="<?=$qcommon?>">
<input type="hidden" name="idx" value="<?=$_GET[idx]?>" />
                      <tr>
                        <td width="9%" height="30" bgcolor="#E6E6E6"><strong>����</strong></td>
                        <td width="82%" align="left" bgcolor="#FFFFFF" style="padding-left:10px;"><input type="text" style="width:80%" value="<?=$data_m[code2]?>" name="code2"></td>
                        <td width="9%" rowspan="4" align="center" bgcolor="#FFFFFF"><span style="padding-left:3px">
                        <input type="submit" class="btn_pink" value="���/����" >
                        </span></td>
                      </tr>
                      <tr>
                        <td height="30" bgcolor="#E6E6E6"><strong>�̹�������</strong></td>
                        <td align="left" bgcolor="#FFFFFF" style="padding-left:10px;"><table border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="500"><input name="upfile" type="file" style="width:100%"></td>
                            <td style="padding-top:3px;"> * �̹��� ����ũ��� 1000 �Դϴ� </td>
                          </tr>
                        </table>                        </td>
                      </tr>
                      <tr>
                        <td height="30" bgcolor="#E6E6E6"><strong>��ũ�ּ�</strong></td>
                        <td align="left" bgcolor="#FFFFFF" style="padding-left:10px;">
                          <input type="text" style="width:80%" value="<?=$data_m[homepage]?>" name="homepage"> ��: www.naver.com</td>
                      </tr>
                      <tr>
                        <td height="30" bgcolor="#E6E6E6"><strong>����</strong></td>
                        <td  align="left" bgcolor="#FFFFFF" style="padding-left:10px;"><table border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td><input type="radio" name="code" value="1" <? if($data_m[code]=="1")echo "checked"; ?>></td>
                            <td style="padding-top:3px;">����</td>
                            <td><input type="radio" name="code" value="2" <? if($data_m[code]=="2")echo "checked"; ?>></td>
                            <td style="padding-top:3px;">����</td>
                          </tr>
                        </table>                        </td>
                      </tr>
</form>
                    </table></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td height="30" style="color:#0066CC"><strong>������ġ: ��� �������� ��ܿ� �������� ����˴ϴ�</strong></td>
                  </tr>
                  <tr>
                    <td><table width="100%"  border="1" cellpadding="0" cellspacing="0" bordercolor="d9d9d9" style="border-collapse:collapse;text-align:center;" class='pad_10'>
                      <tr>
                        <td width="75%" bgcolor="#E6E6E6"><strong>�̹���</strong></td>
                        <td width="11%" bgcolor="#E6E6E6"><strong>����</strong></td>
                        <td width="9%" bgcolor="#E6E6E6"><strong>���</strong></td>
                      </tr>

<?
if($_GET[page] && $_GET[page] > 0){
    $page = $_GET[page];
}else{
    $page = 1;
}
// �� �������� ���� �� ��
$page_row = 20;
// ���ٿ� ������ ������ ��
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

$sql = "select count(*) as cnt from config_layer where $wh ";
$total_count = sql_total($sql);
$paging_str = paging2($page, $page_row, $page_scale, $total_count,$_SERVER['PHP_SELF']."?"."sear=".$sear."&user_type2=$_GET[user_type2]&pay_type=$pay_type&sear=$sear");
$from_record = ($page - 1) * $page_row;

$sql="select * from config_layer where $wh order by regdate desc  limit ".$from_record.", ".$page_row;
$result=sql_query($sql);
$i=$page_row*($page-1);
$k=0;
while($data=mysql_fetch_array($result)){
?>
                      <tr style="cursor:hand" onMouseOver="this.style.backgroundColor='#EFACE8'" onMouseOut="this.style.backgroundColor='#FFF'" onblur="this.style.backgroundColor='#EFACE8'" onfocus="this.style.backgroundColor='#FFF'">
                        <td align="left" style="padding:5px;" ><?=$data[code2]?><BR>
                        ��ũ�ּ�:<?=$data[homepage]?><BR><img src="/images/banner/<?=$data[upfile]?>" width="1000" height="100"></td>
                        <td align="center" ><? if($data[code]=="1"){echo "����";}else if($data[code]=="2"){echo "����";} ?></td>
                        <td >
                          <input name="input" type="button" class="btn_pink" value="����" onClick="window.location='sub04.php?idx=<?=$data[idx]?>'">
                          <input name="input3" type="button" class="btn_blue" value="����" onClick="del('<?=$data[idx]?>')">        </td>
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
	      <!--/�ΰ� & ž�޴�-->		
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
