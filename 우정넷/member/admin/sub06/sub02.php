<?
include $_SERVER['DOCUMENT_ROOT']."/admin/inc/header.php";
?>
			<!--�ΰ� & ž�޴�-->
		  <? include "$DOCUMENT_ROOT/admin/inc/top.php";?>
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td width='130' align='center' valign="top" style='font-size:14px;'><? include "$DOCUMENT_ROOT/admin/inc/sm_sub06_02.php";?></td>
                <td width="1" height="750" valign="top" bgcolor="d7d7d7"><img src="../img/sb.gif" width="1" height="1" /></td>
                <td valign="top" style='padding:10px;'><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td colspan="2"><table width="99%" border="0" cellpadding="0" cellspacing="0">
                      <tr>
                        <td height='30'><img src='../img/icon.gif' alt=""> ��ġ : ȯ�漳�� &gt; <strong>�Խ��ǰ���</strong></td>
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
                    <td align="right">&nbsp;</td>
                  </tr>
                  <tr>
                    <td>����1: �Խ��Ǹ��� Ŭ���ϸ� �ܺο� ����Ǵ� ȭ���� ��â���� �����ϴ�<BR>
����2: ����/����/��� �� ������ �̻󷹺����� �����ϴٴ� ���Դϴ�</td>
                    <td align="right"><span style="padding-left:3px">
                      <input name="input2" type="button" class="btn_pink" value="����ϱ�" onClick="window.location='sub02_write.php'">
                    </span></td>
                  </tr>
                  <tr>
                    <td colspan="2"><table width="100%"  border="1" cellpadding="0" cellspacing="0" bordercolor="d9d9d9" style="border-collapse:collapse;text-align:center;" class='pad_10'>
                      <tr>
                        <td width="3%" bgcolor="#E6E6E6"><input type='checkbox' name='allchk' id='allchk' style='vertical-align:middle;border:solid 0' onclick='chkall();'></td>
                        <td width="3%" bgcolor="#E6E6E6"><strong>no.</strong></td>
                        <td width="10%" bgcolor="#E6E6E6"><strong>�Խ��Ǹ�</strong></td>
                        <td width="7%" bgcolor="#E6E6E6"><strong>�ڵ�</strong></td>
                        <td width="7%" bgcolor="#E6E6E6"><strong>��Ų��</strong></td>
                        <td width="12%" bgcolor="#E6E6E6"><strong>����</strong></td>
                        <td width="12%" bgcolor="#E6E6E6"><strong>����</strong></td>
                        <td width="9%" bgcolor="#E6E6E6"><strong>���</strong></td>
                        <td width="9%" bgcolor="#E6E6E6"><strong>����</strong></td>
                        <td width="8%" bgcolor="#E6E6E6"><strong>��б�</strong></td>
                        <td width="9%" bgcolor="#E6E6E6"><strong>��ϼ�</strong></td>
                        <td width="11%" bgcolor="#E6E6E6"><strong>���</strong></td>
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


$sql = "select count(*) as cnt from admin_table where $wh ";
$total_count = sql_total($sql);
$paging_str = paging2($page, $page_row, $page_scale, $total_count,$_SERVER['PHP_SELF']."?"."sear=".$sear."&user_type2=$_GET[user_type2]&pay_type=$pay_type&sear=$sear");
$from_record = ($page - 1) * $page_row;

$sql="select * from admin_table where $wh order by a_idx desc  limit ".$from_record.", ".$page_row;
$result=sql_query($sql);
$i=$page_row*($page-1);
$k=0;
while($data=mysql_fetch_array($result)){
	$sql="select count(no) from $data[a_name]";
	$result2=mysql_query($sql);
	$t_count=mysql_result($result2,0);
?>
					  <tr style="cursor:hand" onMouseOver="this.style.backgroundColor='#EFACE8'" onMouseOut="this.style.backgroundColor='#FFF'" onblur="this.style.backgroundColor='#EFACE8'" onfocus="this.style.backgroundColor='#FFF'">
                        <td><input type="checkbox" name="chk[]" class="text2" value='<?=$data[a_idx]?>'></td>
                        <td ><?=$total_count-$i?></td>
                        <td ><?=$data[a_title]?></td>
                        <td ><?=$data[a_name]?></td>
                        <td ><?=$data[a_skinname]?></td>
                        <td align="center" >�Ϲ�ȸ��</td>
                        <td >�Ϲ�ȸ��</td>
                        <td >���</td>
                        <td ><?=$data[a_file_use]?></td>
                        <td >0</td>
                        <td ><?=$t_count?></td>
                        <td onClick="window.location='sub02_write.php?a_idx=<?=$data[a_idx]?>'"><font color="#FF0000">����</font></td>
                      </tr>
<?
	$i++;
}
?>

					</table></td>
                  </tr>
                  <tr>
                    <td colspan="2">&nbsp;</td>
                  </tr>
                  <tr>
                    <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="33%">&nbsp;</td>
                        <td width="33%" align="center">&nbsp;</td>
                        <td width="33%">&nbsp;</td>
                      </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td colspan="2">&nbsp;</td>
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
