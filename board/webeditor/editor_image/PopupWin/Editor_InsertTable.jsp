<%@ page language="java" contentType="text/html; charset=euc-kr" %>
<html style="width:410; height:460;">

<head>
<meta http-equiv="Content-Language" content="ko">
<meta name="GENERATOR" content="Microsoft FrontPage 5.0">
<meta name="ProgId" content="FrontPage.Editor.Document">
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<title>ǥ ���ԡ���������������������������������������������������������������������������������������������������������������������������������������������������������������������.</title>
</head>

<style type="text/css">
	body	{font-size: 9pt; font-family: ����, ����; font-style:  normal; font-weight: normal;}
	td		{font-size: 9pt; font-family: ����, ����; font-style:  normal; font-weight: normal;}
	pre		{font-size: 9pt; font-family: ����, ����; font-style:  normal; font-weight: normal;}
	input, select, textarea, button	{font-size: 9pt; font-family: ����, ����; font-style:  normal; font-weight: normal;}
	
	input, select	{width:90%;}
	textarea		{width:100%; height:50;}
	button			{width:75; cursor:hand;}
	
	.threedface	{background-color: threedface;}
</style>

<script language="JScript">
	//**	�⺻ ȯ�� �ҷ� ����
		var opener = window.dialogArguments;
		var Editor_Root_Dir	= opener.Editor_Root_Dir;
		var ObjName			= location.search.substring(1,location.search.length);
		
		var Config			= opener.document.all[ObjName].Config;						//**	���� ����
		var EditorObj		= opener.document.all['Editor__'+ ObjName +'__EditorPad'];	//**	������ ��ü
		var EditorDoc		= EditorObj.contentWindow.document;
		
	//**	���
		function FUN_Cancle(){
			window.close();
			return;
		}
		
	//**	Ȯ��
		function FUN_Ok(){
			var FormObj	=	document.forms[0];
			
			var Rows		=	FormObj.Rows.value;			//**	��
			var	Cols		=	FormObj.Cols.value;			//**	��
			var	Align		=	FormObj.Align.value;		//**	���� - 0:�⺻��, left:����, right:������, center:���
			var	Border		=	FormObj.Border.value;		//**	�׵θ�ũ��
			var Bordercolor	=	FormObj.Bordercolor.value;		//**	���� �÷�
			var Bordercolorlight	=	FormObj.Bordercolorlight.value;		//**	���� ���� �÷�
			var Bordercolordark		=	FormObj.Bordercolordark.value;		//**	��ο� ���� �÷�
			var	Cellpadding	=	FormObj.Cellpadding.value;	//**	������ ����
			var	Cellspacing	=	FormObj.Cellspacing.value;	//**	������
			var	WidthUse	=	FormObj.WidthUse.checked;	//**	�ʺ����� ����
			var	Width		=	FormObj.Width.value;		//**	�ʺ�
			var	WidthType	=	(FormObj.WidthType[0].checked ? FormObj.WidthType[0].value : FormObj.WidthType[1].value);	//**	�ʺ���� - '':�ȼ�, %:��з�
			var	HeightUse	=	FormObj.HeightUse.checked;	//**	�������� ����
			var	Height		=	FormObj.Height.value;		//**	���̰�
			var	HeightType	=	(FormObj.HeightType[0].checked ? FormObj.HeightType[0].value : FormObj.HeightType[1].value);	//**	���̴��� - '':�ȼ�, %:��з�
			var	StyleUse	=	FormObj.StyleUse.checked;	//**	��Ÿ�� ���� ����
			var	Style		=	FormObj.Style.value;		//**	��Ÿ��
			
			var TableHtml, TableHtmlStart, TableHtmlEnd;
			
			//**	���̺� �ױ� �ۼ�
				TableHtml		=	'<table ';
				TableHtmlStart	=	'';
				TableHtmlEnd	=	'</table>\n';
				
				
				//**	���� �ۼ�
					if(Align != 0){
						TableHtmlStart	+=	'<div align="'+ Align +'">\n';
						TableHtmlEnd	+=	'</div>\n';
					}
				//**	�׵θ� ũ�� �ۼ�
					if(!isNaN(Border) && Border>=0){
						TableHtml	+=	'border="'+ Border +'" ';
					}
				//**	�׵θ� �÷� �ۼ�
					if(Bordercolor.substring(0,1) == '#' && Bordercolor.length == 7){
						TableHtml	+=	'bordercolor="'+ Bordercolor +'" ';
					}
				//**	���� �׵θ� �÷� �ۼ�
					if(Bordercolorlight.substring(0,1) == '#' && Bordercolorlight.length == 7){
						TableHtml	+=	'bordercolorlight="'+ Bordercolorlight +'" ';
					}
				//**	£�� �׵θ� �÷� �ۼ�
					if(Bordercolordark.substring(0,1) == '#' && Bordercolordark.length == 7){
						TableHtml	+=	'bordercolordark="'+ Bordercolordark +'" ';
					}
				//**	�����ʿ��� �ۼ�
					if(!isNaN(Cellpadding) && Cellpadding>=0){
						TableHtml	+=	'cellpadding="'+ Cellpadding+'" ';
					}
				//**	������ �ۼ�
					if(!isNaN(Cellspacing) && Cellspacing>=0){
						TableHtml	+=	'cellspacing="'+ Cellspacing +'" ';
					}
				//**	�ʺ� ����
					if(WidthUse && !isNaN(Width) && Width>=0){
						TableHtml	+=	'width="'+ Width + WidthType +'" ';
					}
				//**	���� ����
					if(HeightUse && !isNaN(Height) && Height>=0){
						TableHtml	+=	'height="'+ Height+ HeightType +'" ';
					}
				//**	��Ÿ�� ����
					if(StyleUse && Style!=''){
						TableHtml	+=	'style="'+ Style +'" ';
					}
				TableHtml	+=	'>\n';
				
				//**	tr, td �ۼ�
					if(!isNaN(Rows) && Rows>0 && !isNaN(Cols) && Cols>0){
						for(i=1; i<=Rows; i++){
							TableHtml	+=	'	<tr>\n';
							
							for(j=1; j<=Cols; j++){
								TableHtml	+=	'		<td width=100> </td>\n';
							}
							
							TableHtml	+=	'	</tr>\n';
						}
					}else{
						alert('���̺��� ��, ���� ���� �߸��Ǿ� �ֽ��ϴ�.\n0���� ū ���ڸ� �Է� �Ͻñ� �ٶ��ϴ�.');
						return;
					}
				
				//**	���̺� �ױ� ����
					TableHtml	=	TableHtmlStart + TableHtml + TableHtmlEnd;
				
			//**	������ â�� HTML �ҽ� ����
				opener.Editor_InsertHTML(ObjName, TableHtml);
			
			//**	â�ݱ�
				window.close();
		}
	
	//**	�ʺ� ���� ����
		function FUN_WidthUse(This){
				
			var FormObj	= This.form;
			//**	üũ�� �Ǿ� ������
				if(This.checked){
					FormObj.Width.disabled			= false;
					FormObj.Width.className			= '';
					FormObj.WidthType[0].disabled	= false;
					FormObj.WidthType[1].disabled	= false;
			
			//**	üũ�� �Ǿ� ���� ������
				}else{
					FormObj.Width.disabled			= true;
					FormObj.Width.className			= 'threedface';
					FormObj.WidthType[0].disabled	= true;
					FormObj.WidthType[1].disabled	= true;
				}
		}

	//**	���� ���� ����
		function FUN_HeightUse(This){
				
			var FormObj	= This.form;
			//**	üũ�� �Ǿ� ������
				if(This.checked){
					FormObj.Height.disabled				= false;
					FormObj.Height.className			= '';
					FormObj.HeightType[0].disabled		= false;
					FormObj.HeightType[1].disabled		= false;
			
			//**	üũ�� �Ǿ� ���� ������
				}else{
					FormObj.Height.disabled				= true;
					FormObj.Height.className			= 'threedface';
					FormObj.HeightType[0].disabled		= true;
					FormObj.HeightType[1].disabled		= true;
				}
		}
	
	//**	��Ÿ�� ���� ����
		function FUN_StyleUse(This){
			var FormObj	= This.form;
			
			//**	üũ�� �Ǿ� ������
				if(This.checked){
					FormObj.Style.disabled	= false;
					FormObj.Style.className	= '';
					FormObj.Style.value		= '';
			
			//**	üũ�� �ȵǾ� ������
				}else{
					FormObj.Style.disabled	= true;
					FormObj.Style.className	= 'threedface';
					FormObj.Style.value		= '��Ÿ���� �����ּ���.';
				}
		}
	
	
	//**	���� �÷� ����
		function FUN_Bordercolor(){
		
			var OldColor	=	document.all['Bordercolor'].value;
			var NewColor	=	showModalDialog('./Editor_SelectColor.htm', OldColor, 'resizable: no; help: no; status: no; scroll: no;');
			
			NewColor	=	'#' + NewColor;
			
			document.all['Bordercolor'].value	=	NewColor;
			
			if(NewColor.substring(0,1) != '#' || NewColor.length != 7){
				document.all['Bordercolor'].value	=	'�ڵ�';
				document.all['Bordercolor'].style.backgroundColor	=	'#FFFFFF';
				document.all['Bordercolor'].style.color	=	'#000000';
				
				return;
			}
			
			document.all['Bordercolor'].style.backgroundColor	=	NewColor;
			document.all['Bordercolor'].style.color	=	FUN_Complementary(NewColor);
		
		}
	
	
	//**	���� �׵θ� �÷� ����
		function FUN_Bordercolorlight(){
		
			var OldColor	=	document.all['Bordercolorlight'].value;
			var NewColor	=	showModalDialog('./Editor_SelectColor.htm', OldColor, 'resizable: no; help: no; status: no; scroll: no;');
			
			NewColor	=	'#' + NewColor;
			
			document.all['Bordercolorlight'].value	=	NewColor;
			
			if(NewColor.substring(0,1) != '#' || NewColor.length != 7){
				document.all['Bordercolorlight'].value	=	'�ڵ�';
				document.all['Bordercolorlight'].style.backgroundColor	=	'#FFFFFF';
				document.all['Bordercolorlight'].style.color	=	'#000000';
				
				return;
			}
			
			document.all['Bordercolorlight'].style.backgroundColor	=	NewColor;
			document.all['Bordercolorlight'].style.color	=	FUN_Complementary(NewColor);
		
		}
	
	
	//**	£�� �׵θ� �÷� ����
		function FUN_Bordercolordark(){
		
			var OldColor	=	document.all['Bordercolordark'].value;
			var NewColor	=	showModalDialog('./Editor_SelectColor.htm', OldColor, 'resizable: no; help: no; status: no; scroll: no;');
			
			NewColor	=	'#' + NewColor;
			
			document.all['Bordercolordark'].value	=	NewColor;
			
			if(NewColor.substring(0,1) != '#' || NewColor.length != 7){
				document.all['Bordercolordark'].value	=	'�ڵ�';
				document.all['Bordercolordark'].style.backgroundColor	=	'#FFFFFF';
				document.all['Bordercolordark'].style.color	=	'#000000';
				
				return;
			}
			
			document.all['Bordercolordark'].style.backgroundColor	=	NewColor;
			document.all['Bordercolordark'].style.color	=	FUN_Complementary(NewColor);
		
		}
	
	//**	���� ���ϱ�
		function FUN_Complementary(HexRGB){
			
			if(HexRGB.substring(0,1) == '#'){
				HexRGB	=	HexRGB.substring(1);
			}
			
			//**	�빮�ڷ� ��ȯ
				HexRGB	=	HexRGB.toUpperCase();
			
			//**	RGB �и�
				var Red		=	HexRGB.substring(0, 2);
				var Green	=	HexRGB.substring(2, 4);
				var Blue	=	HexRGB.substring(4, 6);
			
			//**	Hex -> Dec ��ȯ
				Red		=	parseInt(Red, 16);
				Green	=	parseInt(Green, 16);
				Blue	=	parseInt(Blue, 16);
			
			//**	���� ����
				Red		=	255 - Red;
				Green	=	255 - Green;
				Blue	=	255 - Blue;
			
			
			
			//**	������ Dec -> Hex �� ��ȯ
				if(Red < 16){
					Red		= '0' + Red.toString(16);
				}else{
					Red		= Red.toString(16);
				}
			
				if(Green < 16){
					Green	= '0' + Green.toString(16);
				}else{
					Green	= Green.toString(16);
				}
			
				if(Blue < 16){
					Blue	= '0' + Blue.toString(16);
				}else{
					Blue	= Blue.toString(16);
				}
			
			//**	���� �빮�ڷ� ��ȯ
				HexRGB	=	'#' + Red + Green + Blue;
				HexRGB	=	HexRGB.toUpperCase();
				
			//**	���� ��ȯ
				return HexRGB;
		}
	
	//**	�Է�â�� HexRGB �Է½� ó��
		function FUN_InputHexRGB(This){
			
			var HexRGB	=	This.value;
			
			if(HexRGB.substring(0,1) != '#' || HexRGB.length != 7){
				return;
			}
			
			//**	�Է�â���� esc���궧 �ڵ����� ����
				if(event.keyCode == 27){
					This.value	=	'�ڵ�';
					This.style.backgroundColor	=	'#FFFFFF';
					This.style.color	=	'#000000';
				}
			
			HexRGB		=	HexRGB.toUpperCase();
			
			This.value	=	HexRGB;
			
			This.style.backgroundColor	=	HexRGB;
			This.style.color	=	FUN_Complementary(HexRGB);
		
		}
</script>

<body style="background: threedface; color: windowtext; margin: 0px; border-style: none;">

<form name="InsertTable">

<table border="0" cellpadding="5" cellspacing="0" style="border-collapse: collapse" width="400" height="300">
	<tr>
		<td valign="top">
		<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="390">
			<tr>
				<td width="100%" height="20">
				<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" width="390">
					<tr>
						<td width="30">ũ��</td>
						<td width="360"><hr></td>
					</tr>
				</table>
				</td>
			</tr>
			<tr>
				<td width="100%" align="center">
				<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" width="90%">
					<tr>
						<td width="25%">��:</td>
						<td width="25%">
						<input type="text" name="Rows" size="20" value="2"></td>
						<td width="25%">��</td>
						<td width="25%">
						<input type="text" name="Cols" size="20" value="2"></td>
					</tr>
				</table>
				</td>
			</tr>
			<tr>
				<td width="100%" height="20">
				<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" width="390">
					<tr>
						<td width="52">���̾ƿ�</td>
						<td width="338"><hr></td>
					</tr>
				</table>
				</td>
			</tr>
			<tr>
				<td width="100%" align="center">
				<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" width="90%">
					<tr>
						<td width="25%">����:</td>
						<td width="25%"><select size="1" name="DivAlign">
						<option value="0">�⺻��</option>
						<option value="left">����</option>
						<option value="right">������</option>
						<option value="center">���� ���</option>
						</select></td>
						<td width="25%">
						<input type="checkbox" name="WidthUse" value="1" style="width:20; cursor:hand;" OnClick="javascript:FUN_WidthUse(this);" unselectable="on">�ʺ�����:</td>
						<td width="25%" valign="bottom">
						<input type="radio" value="" name="WidthType" style="width:20; cursor:hand;" unselectable="on" disabled>�ȼ� 
						����</td>
					</tr>
					<tr>
						<td width="25%">��ġ:</td>
						<td width="25%">
						<select size="1" name="Align">
						<option value="0">�⺻��</option>
						<option value="left">����</option>
						<option value="right">������</option>
						<option value="center">���� ���</option>
						</select></td>
						<td width="25%">
						<input type="text" name="Width" size="20" value="100" style="width: 90%; font-size: 9pt; font-family: ����, ����; font-style: normal; font-weight: normal" disabled></td>
						<td width="25%" valign="bottom">
						<input type="radio" value="%" checked name="WidthType" style="width:20; cursor:hand;" unselectable="on" disabled>�����</td>
					</tr>
					<tr>
						<td width="25%">�� ���� ����:</td>
						<td width="25%">
						<input type="text" name="Cellpadding" size="20" value="0"></td>
						<td width="25%">
						<input type="checkbox" name="HeightUse" value="1" style="width:20; cursor:hand;" OnClick="javascript:FUN_HeightUse(this);" unselectable="on">��������:</td>
						<td width="25%" valign="bottom">
						<input type="radio" value="" name="HeightType" style="width:20; cursor:hand;" unselectable="on" disabled>�ȼ� 
						����</td>
					</tr>
					<tr>
						<td width="25%">�� ����:</td>
						<td width="25%">
						<input type="text" name="Cellspacing" size="20" value="0"></td>
						<td width="25%">
						<input type="text" name="Height" size="20" value="100" class="threedface" disabled></td>
						<td width="25%" valign="bottom">
						<input type="radio" value="%" checked name="HeightType" style="width:20; cursor:hand;" unselectable="on" disabled>�����</td>
					</tr>
					<tr>
						<td width="25%">��</td>
						<td width="25%">��</td>
						<td width="25%">��</td>
						<td width="25%">
						��</td>
					</tr>
				</table>
				</td>
			</tr>
			<tr>
				<td width="100%" height="20">
				<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" width="390">
					<tr>
						<td width="44">�׵θ�</td>
						<td width="346"><hr></td>
					</tr>
				</table>
				</td>
			</tr>
			<tr>
				<td width="100%" height="20" align="center">
				<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" width="90%">
					<tr>
						<td width="25%">ũ��:</td>
						<td width="25%">
						<input type="text" name="Border" size="20" value="1"></td>
						<td width="25%">���� �׵θ�:</td>
						<td width="25%">
						<table border="1" width="90%" style="border-style: inset; border-width: 0;" bgcolor="threedface">
							<tr>
								<td>
								<input type="text" name="Bordercolorlight" size="20" value="�ڵ�" style="border-style:solid; border-width:0; width:70%" OnKeyUp="javascript:FUN_InputHexRGB(this);" maxlength="7">
								<button name="BordercolorlightSelect" style="width:30%; height:17; paddimg:0 0 0 0;" unselectable="on" OnCliCk="javascript:FUN_Bordercolorlight();">��</button></td>
							</tr>
						</table>
						</td>
					</tr>
					<tr>
						<td width="25%">��:</td>
						<td width="25%">
						<table border="1" width="90%" style="border-style: inset; border-width: 0;" bgcolor="threedface">
							<tr>
								<td>
								<input type="text" name="Bordercolor" size="20" value="�ڵ�" style="border-style:solid; border-width:0; width:70%" OnKeyUp="javascript:FUN_InputHexRGB(this);" maxlength="7"><button name="BordercolorSelect" style="width:30%; height:17; paddimg:0 0 0 0;" unselectable="on" OnCliCk="javascript:FUN_Bordercolor();">��</button></td>
							</tr>
						</table>
						</td>
						<td width="25%">£�� �׵θ�:</td>
						<td width="25%">
						<table border="1" width="90%" style="border-style: inset; border-width: 0;" bgcolor="threedface">
							<tr>
								<td>
								<input type="text" name="Bordercolordark" size="20" value="�ڵ�" style="border-style:solid; border-width:0; width:70%" OnKeyUp="javascript:FUN_InputHexRGB(this);" maxlength="7">
								<button name="BordercolordarkSelect" style="width:30%; height:17; paddimg:0 0 0 0;" unselectable="on" OnCliCk="javascript:FUN_Bordercolordark();">��</button></td>
							</tr>
						</table>
						</td>
					</tr>
					<tr>
						<td width="100%" colspan="4">
						<input type="checkbox" name="StyleUse1" value="border-collapse: collapse;" style="width:20; cursor:hand;" unselectable="on"> 
						���� �׵θ� ��� ǥ��</td>
					</tr>
				</table>
				</td>
			</tr>
			<tr>
				<td width="100%" height="20">
				<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" width="390">
					<tr>
						<td width="30">����</td>
						<td width="360"><hr></td>
					</tr>
				</table>
				</td>
			</tr>
			<tr>
				<td width="100%" align="center">
				<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" width="90%">
					<tr>
						<td width="100%">
						<input type="checkbox" name="StyleUse" value="1" style="width:20; cursor:hand;" OnClick="javascript:FUN_StyleUse(this);" unselectable="on">��ǥ�� 
						��Ÿ�� ����</td>
					</tr>
					<tr>
						<td width="100%">
						<textarea rows="2" name="Style" cols="20" class="threedface" disabled>��Ÿ���� �����ּ���.</textarea></td>
					</tr>
					<tr>
						<td width="100%">��</td>
					</tr>
				</table>
				</td>
			</tr>
			<tr>
				<td width="100%"><hr></td>
			</tr>
			<tr>
				<td width="100%" align="right">
				<button name="InsertTable_Ok" OnCLick="javascript:FUN_Ok();" unselectable="on">Ȯ��</button>
				&nbsp;
				<button name="InsertTable_Calcle" OnClick="javascript:FUN_Cancle();" unselectable="on">���</button>
				</td>
			</tr>
		</table>
		</td>
	</tr>
</table>

</form>

</body>

</html>