<?
include $_SERVER['DOCUMENT_ROOT']."/admin/inc/header.php";
?>
<?
if($_GET[idx]){
	$sql="select * from plan where idx='$_GET[idx]' ";
	$data=sql_fetch($sql);
}
?>

<script type="text/JavaScript">
<!--
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}
//-->
</script>

<script>
function wr(){
	f=document.cform;
	f.action="sub01_save.php";
	submitContents();
	f.submit();
}
function del(idx){
	if(confirm("���� �Ͻðڽ��ϱ�?")){
		location.href="sub01_del.php?idx="+idx;
	}
}
</script>

<iframe name="HiddenFrm" style="display:none;" width=800 height=150></iframe>
		  <? include "$DOCUMENT_ROOT/admin/inc/top.php";?>
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td height="600" align='center' valign="top" style='font-size:14px; padding:10px'><table width="900" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td><table width="99%" border="0" cellpadding="0" cellspacing="0">
                      <tr>
                        <td height='30'><img src='../img/icon.gif' alt=""> ��ġ : ���߰�ȹ�� &gt;<strong>����ϱ�</strong></td>
                        <td align='right'>&nbsp;</td>
                      </tr>
                    </table>                      </td>
              </tr>
                  <tr>
                    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td height="40" align="left"><span style="color:#FF0000">����:������ ���°��� �ſ� ���� ���� ��ϵǾ�� ��<br />
�⺰:�⺰�� ���°��� �⵵�� �������ڿ� ����� </span></td>
                      </tr>
                        <tr>
                          <td height="5" align="left"></td>
                        </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td><table width="100%"  border="1" cellpadding="0" cellspacing="0" bordercolor="d9d9d9" style="border-collapse:collapse;text-align:center;" class='pad_10'>

<form name="cform" method="post" enctype="multipart/form-data" target="HiddenFrm" action="sub01_memo_save.php">
<input type="hidden" name="idx" value="<?=$_GET[idx]?>">
					  <tr>
                        <td width="9%" height="30" bgcolor="f4f4f4"><strong>����</strong></td>
                        <td width="91%" align="left" bgcolor="#FFFFFF" style="padding-left:10px;">
						<table border="0" cellpadding="2" cellspacing="0">
						<tr>
						<td valign="top"><input name="plan_type" type="radio" value="1" <? if($data[plan_type]=="1") echo "checked"; ?>/></td>
                        <td>������� : �ſ�</td>
                        <td><span class="table_text">
                          <select name="pday1" class="input_site">
							<? for($i=1;$i<32;$i++){ ?>
							<option value='<?=$i?>'  <? if($data[plan_type]=="1"&&$data[pday]==$i) echo "selected"; ?>><?=$i?></option>
							<? } ?>
                          </select>
                        </span></td>
                        <td>�Ͽ� ��� </td>
                        <td valign="top"><input name="plan_type" type="radio" value="2" <? if($data[plan_type]=="2") echo "checked"; ?>/> </td>
                        <td>�⺰��� : �ų� </td>
                        <td><span class="table_text">
                          <select name="pmonth" class="input_site">
							<? for($i=1;$i<13;$i++){ ?>
							<option value='<?=$i?>'  <? if($data[plan_type]=="2"&&$data[pmonth]==$i) echo "selected"; ?>><?=$i?></option>
							<? } ?>
                          </select>
                        </span></td>
                        <td>�� </td>
                        <td><span class="table_text">
                          <select name="pday2" class="input_site">
							<? for($i=1;$i<32;$i++){ ?>
							<option value='<?=$i?>'  <? if($data[plan_type]=="2"&&$data[pday]==$i) echo "selected"; ?>><?=$i?></option>
							<? } ?>
                          </select>
                        </span></td>
                        <td>�Ͽ� ���</td>
						</tr>
						</table></td>
                      </tr><tr>
                        <td height="30" bgcolor="f4f4f4"><strong>����</strong></td>
                        <td align="left" style="padding-left:10px;">
                          <input type="subject" size="55" name="title" style='width:380' class='input_basic'  value='<?=$data[title]?>' />
                        </td>
                      </tr>
                      <tr>
                        <td height="30" bgcolor="f4f4f4"><strong>����</strong></td>
                        <td align="left" style="padding:10px;">
          <textarea rows=12 name="memo" id="ir1" style="width:100%; height:180px;display:none;" wrap="physical"><?=$data[memo]?></textarea>
<script type="text/javascript" src="/board/smarteditor2/js/HuskyEZCreator.js" charset="utf-8"></script>
<script type="text/javascript">
var oEditors = [];

// �߰� �۲� ���
//var aAdditionalFontSet = [["MS UI Gothic", "MS UI Gothic"], ["Comic Sans MS", "Comic Sans MS"],["TEST","TEST"]];

nhn.husky.EZCreator.createInIFrame({
	oAppRef: oEditors,
	elPlaceHolder: "ir1",
	sSkinURI: "/board/smarteditor2/SmartEditor2Skin.html",	
	htParams : {
		bUseToolbar : true,				// ���� ��� ���� (true:���/ false:������� ����)
		bUseVerticalResizer : true,		// �Է�â ũ�� ������ ��� ���� (true:���/ false:������� ����)
		bUseModeChanger : true,			// ��� ��(Editor | HTML | TEXT) ��� ���� (true:���/ false:������� ����)
		//aAdditionalFontList : aAdditionalFontSet,		// �߰� �۲� ���
		fOnBeforeUnload : function(){
			//alert("�Ϸ�!");
		}
	}, //boolean
	fOnAppLoad : function(){
		//���� �ڵ�
		//oEditors.getById["ir1"].exec("PASTE_HTML", ["�ε��� �Ϸ�� �Ŀ� ������ ���ԵǴ� text�Դϴ�."]);
	},
	fCreator: "createSEditor2"
});

function pasteHTML() {
	var sHTML = "<span style='color:#FF0000;'>�̹����� ���� ������� �����մϴ�.<\/span>";
	oEditors.getById["ir1"].exec("PASTE_HTML", [sHTML]);
}

function showHTML() {
	var sHTML = oEditors.getById["ir1"].getIR();
	alert(sHTML);
}
	
function submitContents(elClickedObj) {
	oEditors.getById["ir1"].exec("UPDATE_CONTENTS_FIELD", []);	// �������� ������ textarea�� ����˴ϴ�.
	
	// �������� ���뿡 ���� �� ������ �̰����� document.getElementById("ir1").value�� �̿��ؼ� ó���ϸ� �˴ϴ�.
	
	try {
		elClickedObj.form.submit();
	} catch(e) {}
}

function setDefaultFont() {
	var sDefaultFont = '�ü�';
	var nFontSize = 24;
	oEditors.getById["ir1"].setDefaultFont(sDefaultFont, nFontSize);
}
</script>
      </td>
                      </tr>
                      
                    </table></td>
                  </tr>
</form>
				  <tr>
                    <td align="center" height="40"><input name="input2" type="button" class="btn_blue" value="��Ϻ���" onclick="window.location='sub01.php'" />
                    <input type="button" class="btn_pink" value="����ϱ�" onClick="wr();"> 
					<? if($_GET[idx]){ ?>
					<input type="button" class="btn_pink" value="�����ϱ�" onClick="del('<?=$_GET[idx]?>');">
					<? } ?>
					</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
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
