<?
include $_SERVER['DOCUMENT_ROOT']."/admin/inc/header.php";
?>

<?
if($_GET[idx]){
	$sql="select * from est where idx='$_GET[idx]' ";
	$data=sql_fetch($sql,$connect);
}
?>

<script>
function memo_del(idx){ 
	if(confirm('�����Ͻðڽ��ϱ�?')){
		location.href="sub01_memo_del.php?idx="+idx;
	}
} 
</script>

<body leftmargin="0" topmargin="0" rightmargin="0" bottommargin="0">
<iframe name="HiddenFrm" style="display:none;" width=800 height=150></iframe>
		  <? include "$DOCUMENT_ROOT/admin/inc/top.php";?>
<table width="100%" border="0" cellpadding="0" cellspacing="0" height='100%'>
	<tr>
		<td valign='top'>
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td height="750" align='center' valign="top" style='font-size:14px; padding:10px'>                  <table width="1000" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td><table width="99%" border="0" cellpadding="0" cellspacing="0">
                      <tr>
                        <td height='30'><img src='../img/icon.gif' alt=""> ��ġ : �������� &gt; <strong>��������</strong></td>
                        <td align='right'>&nbsp;</td>
                      </tr>
                    </table>                      </td>
              </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="center"><table width="100%"  border="1" cellpadding="0" cellspacing="0" bordercolor="d9d9d9" style="border-collapse:collapse;text-align:center;" class='pad_10'>
                      <tr>
                        <td width="180" height="30" align="center" bgcolor="E6E6E6"><strong>�� ��</strong></td>
                        <td align="left" style="padding-left:10px;"><?=$data[est_name]?></td>
                      </tr>
                      <tr>
                        <td width="180" height="30" align="center" bgcolor="E6E6E6"><strong>�޴���ȭ</strong></td>
                        <td width="814" align="left" style="padding-left:10px;"><?=$data[est_mobile]?></td>
                      </tr>
                      <tr>
                        <td height="30" align="center" bgcolor="E6E6E6"><strong>Ȩ�������뵵</strong></td>
                        <td align="left" style="padding-left:10px;"><?=$array_est_type1[$data[type1]]?></td>
                      </tr>
                      <tr>
                        <td height="30" align="center" bgcolor="E6E6E6"><strong>������</strong></td>
                        <td align="left" style="padding-left:10px;"><?=$data[pay]?>����</td>
                      </tr>
                      <tr>
                        <td height="30" align="center" bgcolor="E6E6E6"><strong>��������</strong></td>
                        <td align="left" style="padding-left:10px;"><?=$array_est_type2[$data[type2]]?></td>
                      </tr>
                      <tr>
                        <td width="180" height="30" align="center" bgcolor="E6E6E6"><strong>�������Ʈ1</strong></td>
                        <td align="left" style="padding-left:10px;"><?=$data[site1]?></td>
                      </tr>
                      <tr>
                        <td height="30" align="center" bgcolor="E6E6E6"><strong>�������Ʈ2</strong></td>
                        <td align="left" style="padding-left:10px;"><?=$data[site2]?></td>
                      </tr>
                      <tr>
                        <td height="30" align="center" bgcolor="E6E6E6"><strong>�������Ʈ3</strong></td>
                        <td align="left" style="padding-left:10px;"><?=$data[site3]?></td>
                      </tr>
                      <tr>
                        <td height="30" align="center" bgcolor="E6E6E6"><strong>���ǻ���</strong></td>
                        <td align="left" style="padding-left:10px;"><?=nl2br($data[memo])?></td>
                      </tr>

                    </table></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="center"><input name="input3" type="button" class="btn_blue" value="��Ϻ���" onClick="window.location='sub01.php'"></td>
                  </tr>
                  <tr>
                    <td align="center">&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="center"><table width="1000"  border="1" cellpadding="0" cellspacing="0" bordercolor="d9d9d9" style="border-collapse:collapse;text-align:center;" class='pad_10'>
<form name="cform_memo" method="post" enctype="multipart/form-data" target="HiddenFrm" action="sub01_memo_save.php">
<input type="hidden" name="server_idx" value="<?=$_GET[idx]?>">
                      <tr>
                        <td width="150" height="30" bgcolor="E6E6E6"><strong>�޸�</strong></td>
                        <td align="left" style="padding-left:10px;"><input name="memo" type="text" style="width:85%">
                        <input type="button" class="btn_pink" value="���" onclick="document.cform_memo.submit();"></td>
                      </tr>
</form>
<?
$sql="select * from est_memo where server_idx='$_GET[idx]' order by regdate desc ";
$result=sql_query($sql);
while($data_memo=mysql_fetch_array($result)){
?>
					  <tr >
                        <td height="30" bgcolor="#FFFFFF"><?=substr($data_memo[regdate],0,10)?></td>
                        <td align="left" style="padding-left:10px;"><?=$data_memo[memo]?> <font style="cursor:pointer;" color="#FF0000" onclick="memo_del('<?=$data_memo[idx]?>')">����</font></td>
                      </tr>
<?
}
?>
                    </table></td>
                  </tr>
                  <tr>
                    <td align="center">&nbsp;</td>
                  </tr>
                </table></td>
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
