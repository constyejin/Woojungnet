<%@ page language="java" contentType="text/html; charset=euc-kr" %>
<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=ks_c_5601-1987">
<title>�׸����ϼ���â</title>

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


<script language="javascript">


	//**	���� ���ý� ���� ��θ� �θ�â�� Src�� ����
		function FUN_FileSelect()
		{
			var Obj		= document.all['Src'];
			var P_Obj	= parent.document.all['Src'];
			
			P_Obj.value	= Obj.value;
			return;
		}
		
	//**	���� ��ü���ڸ� �θ�â�� Alt�� ����
		function FUN_AltInput()
		{
			var Obj		= document.all['Alt'];
			var P_Obj	= parent.document.all['Alt'];
			
			P_Obj.value	= Obj.value;
			return;
		}
		
		function FUN_FileUpload_Submit()
		{
			var Obj	= document.all['KNEditor_InsertImage_FileUpload'];
			
			if(Obj.Src.value == '')
			{
				alert('������ ������ �ּ���');
				Obj.Src.focus();
				return;
			}
			Obj.submit();
		}
</script>


<body style="background: threedface; color: windowtext; margin: 0px; border-style: none;">

<form name="KNEditor_InsertImage_FileUpload" method="post" enctype="multipart/form-data" action="Editor_InsertImage_FileSelect_OK.jsp">

	<table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%" style="border-collapse: collapse">
		<tr>
			<td width="20%">���:</td>
			<td width="80%">
			<input type="file" name="Src" size="20" style="width:100%;" onPropertyChange="javascript:FUN_FileSelect();"></td>
		</tr>
		<tr>
			<td width="20%">��ü ����:</td>
			<td width="80%">
			<input type="text" name="Alt" size="20" style="width:100%;" onPropertyChange="javascript:FUN_AltInput();"></td>
		</tr>
	</table>

</form>

</body>

</html>