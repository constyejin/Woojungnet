<%@ page language="java" contentType="text/html; charset=euc-kr" %>
<html style="width:410; height:460;">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<title>�׸����ԡ���������������������������������������������������������������������������������������������������������������������������������������������������������������������.
</title>
<style type="text/css">
	body	{font-size: 9pt; font-family: ����, ����; font-style:  normal; font-weight: normal;}
	td		{font-size: 9pt; font-family: ����, ����; font-style:  normal; font-weight: normal;}
	pre		{font-size: 9pt; font-family: ����, ����; font-style:  normal; font-weight: normal;}
	input, select, textarea, button	{font-size: 9pt; font-family: ����, ����; font-style:  normal; font-weight: normal;}
	
	input, select	{width:90%;}
	textarea		{width:100%; height:50;}
	button			{width:75; cursor:hand;}
	
	image			{cursor:hand;}
	
	.threedface	{background-color: threedface;}
	.align_select	{border: 2px solid #000080;}
</style>
</head>

<script language="JScript">
	//**	�⺻ ȯ�� �ҷ� ����
		var opener 			= window.dialogArguments;
		var Editor_Root_Dir	= opener.Editor_Root_Dir;
		var ObjName			= location.search.substring(1,location.search.length);
		
		var Config			= opener.document.all[ObjName].Config;						//**	���� ����
		var EditorObj		= opener.document.all['Editor__'+ ObjName +'__EditorPad'];	//**	������ ��ü
		var EditorDoc		= EditorObj.contentWindow.document;
		
	//**	���
		function FUN_Cancle(){
			if(document.all['File_Check'].value==1)
			{
				window.close();
				return;
			}
		}


	//**	Ȯ��
		function FUN_Ok(){
			var FormObj	=	document.forms[0];
			Src			=	FormObj.Src.value;
			Alt			=	FormObj.Alt.value;
			Align		=	FormObj.Align.value;
			Border		=	FormObj.Border.value;
			Hspace		=	FormObj.Hspace.value;
			Vspace		=	FormObj.Vspace.value;
			Sizeappoint	=	FormObj.Sizeappoint.checked;
			Width		=	FormObj.Width.value;
			WidthType	=	FormObj.WidthType[0].checked ? FormObj.WidthType[0].value : FormObj.WidthType[1].value;
			Height		=	FormObj.Height.value;
			HeightType	=	FormObj.HeightType[0].checked ? FormObj.HeightType[0].value : FormObj.HeightType[1].value;
			Link		=	FormObj.Link.value;
			Target		=	FormObj.Target.value;
			
			var ImageHTML = '';
			var ImageLink = '';
			
			if(!document.images['tmpImage'].complete){
				var Answer = confirm('�Է��Ͻ� ��ο� �׸� ������ �����ϴ�.\n�ٽ� �Է� �Ͻðڽ��ϱ�?');
				if(Answer){
					if(document.all['Check'].value==0)
					{
						FormObj.Src.focus();
					}
					else
					{
						document.all['ImgUpload_IFrame'].contentWindow.document.all['Src'].focus();
					}
						
					return;
				}else{
					if(document.all['File_Check'].value==1)
						window.close();
					return;
				}
			}else{
				//**	��� ����
					ImageHTML += '<img src="'+ Src +'" ';
				//**	��ü���� ����
					if(Alt != ''){
						ImageHTML += 'alt="'+ Alt +'" ';
					}
				//**	���� ����
					if(Align != ''){
						ImageHTML += 'align="'+ Align +'" ';
					}
				//**	�β� ����
					if(!isNaN(Border) && Border >= 0){
						ImageHTML += 'Border="'+ Border +'" ';
					}
				//**	���� ���� ����
					if(!isNaN(Hspace) && Hspace > 0){
						ImageHTML += 'hspace="'+ Hspace +'" ';
					}
				//**	���ΰ��� ����
					if(!isNaN(Vspace) && Vspace > 0){
						ImageHTML += 'vspace="'+ Vspace +'" ';
					}
				//**	ũ�� ����
					if(Sizeappoint){
						if(Width > 0){
							ImageHTML += 'width="'+ Width + WidthType +'" ';
						}
						if(Height > 0){
							ImageHTML += 'height="'+ Height + HeightType +'" ';
						}
					}
					
					ImageHTML += '>';
				
				//**	��ũ ����
					if(Link != '' && Link.toLowerCase() != 'http://'){
						ImageLink = '<a href="'+ Link +'" ';
						
						if(Target != ''){
							ImageLink	+= 'target="'+ Target +'">';
						}else{
							ImageLink	+= 'target="_blank">';
						}
						
						ImageHTML = ImageLink + ImageHTML + '</a>';
					}
				
				//**	������ â�� HTML �ҽ� ����
					opener.Editor_InsertHTML(ObjName, ImageHTML);
			
				//**	â�ݱ�
					window.close();
			}
			
		}
	
	//**	ũ�� ����
		function FUN_Sizeappoint(This){
			var FormObj	=	This.form;
			
			if(This.checked){
				FormObj.Width.disabled			= false;
				FormObj.Width.className			= '';
				FormObj.Height.disabled			= false;
				FormObj.Height.className		= '';
				FormObj.WidthType[0].disabled	= false;
				FormObj.WidthType[1].disabled	= false;
				FormObj.HeightType[0].disabled	= false;
				FormObj.HeightType[1].disabled	= false;
				FormObj.Sizemaintain.disabled	= false;
			}else{
				FormObj.Width.disabled			= true;
				FormObj.Width.className			= 'threedface';
				FormObj.Height.disabled			= true;
				FormObj.Height.className		= 'threedface';
				FormObj.WidthType[0].disabled	= true;
				FormObj.WidthType[1].disabled	= true;
				FormObj.HeightType[0].disabled	= true;
				FormObj.HeightType[1].disabled	= true;
				FormObj.Sizemaintain.disabled	= true;
			}
		
		}
	//**	���� ����
		function FUN_AlignSelect(This, Align){
			var FormObj		=	document.forms[0];

			document.images['ImageAlign_'].className	= '';
			document.images['ImageAlign_left'].className	= '';
			document.images['ImageAlign_right'].className	= '';
			
			This.className	= 'align_select';
			
			for(i=0; FormObj.Align.length; i++){
				if(FormObj.Align.options[i].value == Align){
					FormObj.Align.options[i].selected	= true;
					break;
				}
			}
		}
		
		function FUN_AlignChange(Value){
			
			for(i=0; i<document.images.length; i++){
				if(document.images[i].id == 'ImageAlign_'+ Value){
					document.images[i].className	= 'align_select';
				}else{
					document.images[i].className	= '';
				}
			}
		}
		
	//**	�̹��� �ּ�
		function FUN_ImageSrc(This){
			var ImageSrc	= This.value;
			
			if(ImageSrc != 'http://'){
				document.images['tmpImage'].src	=	ImageSrc;
			}
		}
	
	//**	�̹��� �ε� �Ϸ�
		function FUN_ImageOnLoad(){
			var FormObj		=	document.forms[0];
			var ImageObj	=	document.images['tmpImage'];

			FormObj.Width.value		= ImageObj.width;
			FormObj.Height.value	= ImageObj.height;
		}
	
	//**	�̹��� �ε� ����
		function FUN_ImageOnError(){
			var FormObj	=	document.forms[0];
			
			if(document.readyState == 'complete'){
				FormObj.Width.value		= '';
				FormObj.Height.value	= '';
			}
		}

	//**	�̹��� ������ ����
		var Edit_Times = 0;
		
		function FUN_ImageResize(This, Type){
			
			var FormObj		=	document.forms[0];
			var ImageObj	=	document.images['tmpImage'];
			var SizemaintainObj	= FormObj.Sizemaintain;

			if(Edit_Times != Type || !SizemaintainObj.checked){
				return;
			}
						
				var ImageWidth	= ImageObj.width;
				var ImageHeight	= ImageObj.height;
			
			var WidthObj		= FormObj.Width;
			var HeightObj		= FormObj.Height;
			
			if(This.name=='Width'){
				HeightObj.value	= parseInt(ImageHeight * This.value / ImageWidth);
			}else if(This.name=='Height'){
				WidthObj.value	= parseInt(ImageWidth * This.value / ImageHeight);
			}
		}


	//**	�׸����� ��������
	function FUN_Image_Src_Type(nType)
	{
		if(nType==0)
		{
			document.all['Check'].value	= 0;
			
			document.all['ImgLink_Box'].style.display	= 'block';
			document.all['ImgUpload_Box'].style.display	= 'none';
			document.all['Src'].value	= 'http://';
			
			document.all['ImgLink'].style.color		= '#000000';
			document.all['ImgUpload'].style.color	= '#777777';
			
			return;
		}
		else
		{
			document.all['Check'].value	= 1;
			
			document.all['ImgLink_Box'].style.display	= 'none';
			document.all['ImgUpload_Box'].style.display	= 'block';
			document.all['Src'].value	= '';
			
			document.all['ImgLink'].style.color		= '#777777';
			document.all['ImgUpload'].style.color	= '#000000';
			
			return;
		}
	}
	
	//**	Ȯ�� ��ư Ŭ��
	function FUN_Ok_Click()
	{
		var Check	= document.all['Check'].value;
		
		if (Check==0)
		{
			FUN_Ok();
			return;
		}
		else
		{
			document.all['File_Check'].value	= 0;
			
			if(document.all['Src'].value != '' && document.all['Src'].value.toLowerCase() != 'http://')
			{
				document.all['FileUploading_Box'].style.display	= 'block';
				//document.all['ImgUpload_IFrame'].contentWindow.document.KNEditor_InsertImage_FileUpload.submit();
				document.all['ImgUpload_IFrame'].contentWindow.FUN_FileUpload_Submit();
			}
		}
	}

</script>

<body style="background: threedface; color: windowtext; margin: 0px; border-style: none;">

<form name="Insert_Image">

<input type="hidden" name="Check" value="1">
<input type="hidden" name="File_Check" value="1">

<table border="0" cellpadding="5" cellspacing="1" width="400">
	<tr>
		<td valign="top">
		<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" width="390">
			<tr>
				<td height="20">
				<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" width="390">
					<tr>
						<td align="center" width="80"  id="ImgLink" onclick="javascript:FUN_Image_Src_Type(0);" title="���� �ִ� �׸������� �ҷ��ɴϴ�." style="color : #777777; cursor : hand;"><b>[������]</b></td>
						<td width="5"><span style="border: 1px inset; width: 1px; height: 100%; margin: 0 3 0 3"></span></td>
						<td align="center" width="80" id="ImgUpload" onclick="javascript:FUN_Image_Src_Type(1);" title="�� ��ǻ�Ϳ� �ִ� �׸������� �ҷ��ɴϴ�." style="color : #000000; cursor : hand;"><b>[��������]</b></td>
						<td width="325"><= �޴��� Ŭ���Ͽ� ���ε� ����� �����ϼ���</td>
					</tr>
				</table>
				</td>
			</tr>

			<tr>
				<td align="center" id="ImgLink_Box" style="display : none;">
				<table border="0" cellpadding="0" cellspacing="0" width="90%" height="45" style="border-collapse: collapse">
					<tr>
						<td width="100%" colspan="2" height="1"></td>
					</tr>
					<tr>
						<td width="20%">���:</td>
						<td width="80%">
						<input type="text" name="Src" size="20" value="http://" style="width:100%;" OnPropertyChange="javascript:FUN_ImageSrc(this);" OnFocus="javascript:this.select();"></td>
					</tr>
					<tr>
						<td width="20%">��ü ����:</td>
						<td width="80%">
						<input type="text" name="Alt" size="20" style="width:100%;"></td>
					</tr>
				</table>
				</td>
			</tr>
			<tr>
				<td align="center" id="ImgUpload_Box" style="display : block;">
				<table border="0" cellpadding="0" cellspacing="0" width="90%" height="45" style="border-collapse: collapse">
					<tr>
						<td>
						<iframe name="ImgUpload_IFrame" marginwidth="0" marginheight="0" height="100%" width="100%" scrolling="no" border="0" frameborder="0" src="Editor_InsertImage_FileSelect.jsp"></iframe>
						</td>
					</tr>
				</table>
				</td>
			</tr>
			<tr>
				<td height="20">
				<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" width="390">
					<tr>
						<td width="59">ȭ�� ǥ��</td>
						<td width="331"><hr></td>
					</tr>
				</table>
				</td>
			</tr>
			<tr>
				<td align="center">
				<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" width="90%">
					<tr>
						<td width="100%" colspan="3" height="20">��ġ��Ÿ��</td>
					</tr>
					<tr>
						<td width="33%" align="center" height="60">
						<img border="0" id="ImageAlign_" src="../icon_img_align_none.gif" class="align_select" OnClick="javascript:FUN_AlignSelect(this, '');" width="51" height="52"></td>
						<td width="33%" align="center" height="60">
						<img border="0" id="ImageAlign_left" src="../icon_img_align_left.gif" OnClick="javascript:FUN_AlignSelect(this, 'left');" width="51" height="52"></td>
						<td width="34%" align="center" height="60">
						<img border="0" id="ImageAlign_right" src="../icon_img_align_right.gif" OnClick="javascript:FUN_AlignSelect(this, 'right');" width="51" height="52"></td>
					</tr>
					<tr>
						<td width="33%" align="center">����</td>
						<td width="33%" align="center">����</td>
						<td width="34%" align="center">������</td>
					</tr>
				</table>
				</td>
			</tr>
			<tr>
				<td height="20">
				<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" width="390">
					<tr>
						<td width="55">���̾ƿ�</td>
						<td width="335"><hr></td>
					</tr>
				</table>
				</td>
			</tr>
			<tr>
				<td align="center">
				<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" width="90%">
					<tr>
						<td width="12%">����:</td>
						<td width="37%" colspan="2">
						<select size="1" name="Align" OnChange="javascript:FUN_AlignChange(this.options[this.selectedIndex].value);">
								<option value="">�⺻��</option>
								<option value="left">����</option>
								<option value="right">������</option>
								<option value="top">����</option>
								<option value="texttop">�ؽ�Ʈ ����</option>
								<option value="middle">���� ���</option>
								<option value="absmiddle">���� ������ ���</option>
								<option value="baseline">����۲� ���ؼ�</option>
								<option value="bottom">�Ʒ���</option>
								<option value="absbottom">���� ������ �Ʒ���</option>
								<option value="center">���� ���</option>
								</select></td>
						<td width="25%">���� ���� ����:</td>
						<td width="25%">
						<input type="text" name="Hspace" size="20" value="0"></td>
					</tr>
					<tr>
						<td width="25%" colspan="2">�׵θ� �β�:</td>
						<td width="25%">
						<input type="text" name="Border" size="20" value="0"></td>
						<td width="25%">���� ���� ����:</td>
						<td width="25%">
						<input type="text" name="Vspace" size="20" value="0"></td>
					</tr>
				</table>
				</td>
			</tr>
			<tr>
				<td height="20">
				<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" width="390">
					<tr>
						<td width="31">ũ��</td>
						<td width="359"><hr></td>
					</tr>
				</table>
				</td>
			</tr>
			<tr>
				<td align="center">
				<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" width="90%">
					<tr>
						<td width="33%">
						<input type="checkbox" name="Sizeappoint" value="1" style="width:20; cursor:hand;" unselectable="on" OnClick="javascript:FUN_Sizeappoint(this);">ũ������</td>
						<td width="10%">�ʺ�:</td>
						<td width="23%">
						<input type="text" name="Width" size="20" class="threedface" OnPropertyChange="javascript:FUN_ImageResize(this, 1)" OnFocus="javascript:Edit_Times=1;" disabled></td>
						<td width="10%">����:</td>
						<td width="24%">
						<input type="text" name="Height" size="20" class="threedface" OnPropertyChange="javascript:FUN_ImageResize(this, 2)" OnFocus="javascript:Edit_Times=2;" disabled></td>
					</tr>
					<tr>
						<td width="33%">��</td>
						<td width="33%" colspan="2">
						<input type="radio" value="" name="WidthType" style="width:20; cursor:hand;" unselectable="on" disabled checked>�ȼ� 
						����</td>
						<td width="34%" colspan="2">
						<input type="radio" value="" name="HeightType" style="width:20; cursor:hand;" unselectable="on" disabled checked>�ȼ� 
						����</td>
					</tr>
					<tr>
						<td width="33%">��</td>
						<td width="33%" colspan="2">
						<input type="radio" value="%" name="WidthType" style="width:20; cursor:hand;" unselectable="on" disabled>�����</td>
						<td width="34%" colspan="2">
						<input type="radio" value="%" name="HeightType" style="width:20; cursor:hand;" unselectable="on" disabled>�����</td>
					</tr>
					<tr>
						<td width="100%" colspan="5">
						<input type="checkbox" name="Sizemaintain" value="1" style="width:20; cursor:hand;" unselectable="on" disabled checked>���� 
						���� ���� ����</td>
					</tr>
				</table>
				</td>
			</tr>
			<tr>
				<td height="20">
				<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" width="390">
					<tr>
						<td width="101">�⺻ ������ ��ũ</td>
						<td width="289"><hr></td>
					</tr>
				</table>
				</td>
			</tr>
			<tr>
				<td height="20" align="center">
						<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" width="90%">
							<tr>
								<td width="70%">
						<input type="text" name="Link" size="20" value="http://"></td>
								<td width="30%"><select size="1" name="Target">
								<option value="_self">���� ������</option>
								<option value="_top">��ü ������</option>
								<option value="_blank" selected>�� â</option>
								<option value="_parent">���� ������</option>
								</select></td>
							</tr>
						</table>
				</td>
			</tr>			
			<tr>
				<td height=3></td>
			</tr>
			<tr>
				<td width="100%" style="padding-left:5px;">* �� �����۸�ũ�� �̹����� ��ũ�Ǵ� �ּ��Դϴ�.</td>
			</tr>
			<tr>
				<td width="100%"><hr></td>
			</tr>
			<tr>
				<td width="100%" align="right">
				<button name="InsertTable_Ok" OnCLick="javascript:FUN_Ok_Click();" unselectable="on">Ȯ��</button>
				&nbsp;
				<button name="InsertTable_Calcle" OnClick="javascript:FUN_Cancle();" unselectable="on">���</button>
				</td>
			</tr>
		</table>
		</td>
	</tr>
</table>

</form>

<!--	�̹���	-->
	<img id="tmpImage" border="0" src="/images/blankimage.gif" OnLoad="javascript:FUN_ImageOnLoad();" OnError="javascript:FUN_ImageOnError();">
<!--	�̹���	-->

<div style="position: absolute; width: 100px; height: 190px; z-index: 1; left: 63px; top: 33px; display:none" id="FileUploading_Box">
	<table border="1" width="250" height="80" cellspacing="0" cellpadding="0" bgcolor="">
		<tr>
			<td align="center"><font color="#940000">���� ���ε� ���Դϴ�.<br><br>��ø� ��ٷ� �ּ���.<br><br>
			</font><b><font color="#FF0000">�ƹ��͵� Ŭ���Ͻ��� ���ñ� �ٶ��ϴ�.</font></b></td>
		</tr>
	</table>
</div>

</body>

</html>