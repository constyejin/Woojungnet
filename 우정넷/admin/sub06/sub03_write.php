<?
include $_SERVER['DOCUMENT_ROOT']."/admin/inc/header.php";
?>

<?
if ($_GET[idx])$data=mysql_fetch_assoc(mysql_query("select * from config_popup where idx='$_GET[idx]'"));
?>

<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script> 
<script language="javascript" type="text/javascript">
 $(document).ready(function() {

  //******************************************************************************
  // �󼼰˻� �޷� ��ũ��Ʈ
  //******************************************************************************
  var clareCalendar = {
   monthNamesShort: ['1��','2��','3��','4��','5��','6��','7��','8��','9��','10��','11��','12��'],
   dayNamesMin: ['��','��','ȭ','��','��','��','��'],
   weekHeader: 'Wk',
   dateFormat: 'yy-mm-dd', //����(20120303)
   autoSize: false, //���丮������(body�� �����±��� ������ ������)
   changeMonth: true, //�����氡��
   changeYear: true, //�⺯�氡��
   showMonthAfterYear: true, //�� �ڿ� �� ǥ��
   buttonImageOnly: true, //�̹���ǥ��
   buttonText: '�޷¼���', //��ư �ؽ�Ʈ ǥ��
   buttonImage: '/images/icon_data.gif', //�̹����ּ�
   showOn: "both", //������Ʈ�� �̹��� ���� ���(both,button)
   yearRange: '2010:2020' //1990����� 2020�����
  };
  $("#sdate").datepicker(clareCalendar);
  $("#edate").datepicker(clareCalendar);
  $("#adate").datepicker(clareCalendar);
  $("#bdate").datepicker(clareCalendar);
  $("img.ui-datepicker-trigger").attr("style","margin-left:5px; vertical-align:middle; cursor:pointer;"); //�̹�����ư style����
  $("#ui-datepicker-div").hide(); //�ڵ����� �����Ǵ� div��ü ����  
 });
</script>
<style>
.ui-datepicker select.ui-datepicker-month{ width:30%;  }
.ui-datepicker select.ui-datepicker-year{ width:40%; }
</style>

<script>
function wr(){
	f=document.cform;
	f.action="sub03_save.php";
	f.submit();
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
                <td width='130' align='center' valign="top" style='font-size:14px;'><? include "$DOCUMENT_ROOT/admin/inc/sm_sub06_03.php";?></td>
                <td width="1" height="750" valign="top" bgcolor="d7d7d7"><img src="../img/sb.gif" width="1" height="1" /></td>
                <td valign="top" style='padding:10px;'><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td><table width="99%" border="0" cellpadding="0" cellspacing="0">
                      <tr>
                        <td height='30'><img src='../img/icon.gif' alt=""> ��ġ : ȯ�漳�� &gt; <strong>�˾�����</strong></td>
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
                    <td><table width="1000"  border="1" cellpadding="0" cellspacing="0" bordercolor="d9d9d9" style="border-collapse:collapse;text-align:center;" class='pad_10'>
<form name="cform" method="post" enctype="multipart/form-data" target="HiddenFrm">
<input type="hidden" name="idx" value="<?=$_GET[idx]?>">
                      <TR>
                        <TD width="150" height="30" align="center" bgcolor="#E6E6E6"><STRONG>���⿩��</STRONG></TD>
                      <TD width="350" align="left" style="padding-left:10px;"><table border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td><input name="application" type="radio" checked="checked" value="1" <?=($data[application]==1)?"checked":""?>></td>
                              <td style="padding-top:4px;">����</td>
                              <td><input name="application" type="radio" value="0" <?=(!$data[application])?"checked":""?>></td>
                              <td style="padding-top:4px;">����</td>
                            </tr>
                          </table></TD>
                        <TD width="150" align="center" bgcolor="#f7f7f7"><STRONG>��ũ�ѹ�</STRONG></TD>
                        <TD width="350" align="left" style="padding-left:10px;"><table border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td><input name="scroll" type="radio" checked="checked" value="1" <?=($data[scroll]==1)?"checked":""?>></td>
                            <td style="padding-top:4px;">���</td>
                            <td><input name="scroll" type="radio" value="0" <?=(!$data[scroll])?"checked":""?>></td>
                            <td style="padding-top:4px;">�̻��</td>
                          </tr>
                        </table></TD>
                      </TR>
                      <TR>
                        <TD height="30" align="center" bgcolor="#E6E6E6"><STRONG>�˾��Ⱓ</STRONG></TD>
                        <TD colspan="3" align="left" style="padding-left:10px;"><table border="0" cellspacing="0" cellpadding="2">
                            <tr>
                              <td><input name="sdate" id="sdate" size="12" maxlength="12" value="<?=$data[sdate]?>"></td>
                              <td>~</td>
                              <td><input name="edate" id="edate" size="12" maxlength="12" value="<?=$data[edate]?>"></td>
                            </tr>
                          </table></TD>
                      </TR>
                      <TR>
                        <TD height="30" align="center" bgcolor="#E6E6E6"><STRONG>â��ġ</STRONG></TD>
                        <TD colspan="3" align="left" style="padding-left:10px;">�������κ��� :
                          <INPUT name="pleft" size="4" maxlength="4" value="<?=($data[pleft])?$data[pleft]:""?>">
                          �ȼ�(pixel) / ���κ��� :
                          <INPUT name="ptop" size="4" maxlength="4" value="<?=($data[ptop])?$data[ptop]:""?>">
                          �ȼ�(pixel)</TD>
                      </TR>
                      <TR>
                        <TD height="30" align="center" bgcolor="#E6E6E6"><STRONG>â������</STRONG></TD>
                        <TD colspan="3" align="left" style="padding-left:10px;">���� :
                          <INPUT name="width" size="4" maxlength="4" value="<?=($data[width])?$data[width]:""?>">
                          �ȼ�(pixel) / ���� :
                          <INPUT name="height" size="4" maxlength="4" value="<?=($data[height])?$data[height]:""?>">
                          �ȼ�(pixel)</TD>
                      </TR>
                      <TR>
                        <TD height="30" align="center" bgcolor="#E6E6E6"><STRONG>�˾�â ����</STRONG></TD>
                        <TD colspan="3" align="left" style="padding-left:10px;"><INPUT name="subject" type="text" size="90" value="<?=($data[subject])?$data[subject]:""?>"></TD>
                      </TR>
                      <TR>
                        <TD height="30" align="center" bgcolor="#E6E6E6"><STRONG>�� ũ</STRONG></TD>
                        <TD colspan="3" align="left" style="padding-left:10px;"><INPUT name="link" type="text" size="90" value="<?=($data['link'])?$data['link']:""?>"></TD>
                      </TR>
                      <TR>
                        <TD height="30" align="center" bgcolor="#E6E6E6"><STRONG>�̹���</STRONG></TD>
                        <TD colspan="3" align="left" style="padding-left:10px;"><table border="0" cellspacing="0" cellpadding="2">
                            <tr>
                              <td><input name="pop_file1" type="file" size="70"></td>
							<?if ($data[image1]){?>
                              <td style="padding-top:4px; color:#0066CC"><?=$data[image1]?></td>
                              <td><input name="delete1" type="checkbox" value="<?=$data[image1]?>"></td>
                              <td style="padding-top:4px; color:#FF0000">����</td>
							<?}?>
                          </tr>
                          </table></TD>
                      </TR>
                      <TR>
                        <TD height="30" align="center" bgcolor="#E6E6E6"><STRONG>��Ÿ�ɼ�</STRONG></TD>
                        <TD colspan="3" align="left" style="padding-left:10px;"><INPUT name="new_win" type="checkbox" value="1" <?=($data[new_win] == 1)?"checked":""?>>
                          ��â���θ�ũ
                          <INPUT name="oneday" type="checkbox" value="1" <?=($data[oneday] == 1)?"checked":""?>>
                          �Ϸ絿��â�����������
                          <INPUT name="close" type="checkbox" value="1" <?=($data[close] == 1)?"checked":""?>>
                          â�ݱ��ư </TD>
                      </TR>
</form>
                    </table>                    </td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td width="1000" align="left"><table width="1000" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td align="center"><table border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td><span style="padding-left:3px">
                              <input name="input" type="button" class="btn_blue" value="��Ϻ���" onClick="window.location='sub03.php'">
                            </span></td>
                            <td><span style="padding-left:3px">
                              <input name="input2" type="button" class="btn_pink" value="����ϱ�" onClick="wr();">
                            </span></td>
                          </tr>
                        </table></td>
                      </tr>
                    </table>
                    </td>
                  </tr>
                  <tr>
                    <td height="30"><strong>�̸�����</strong></td>
                  </tr>
                  <tr>
                    <td><table width="1000"  border="1" cellpadding="0" cellspacing="0" bordercolor="d9d9d9" style="border-collapse:collapse;text-align:center;" class='pad_10'>
                      <tr>
                        <td width="4%" height="300" bgcolor="#FFFFFF">&nbsp;</td>
                      </tr>


                    </table></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
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
