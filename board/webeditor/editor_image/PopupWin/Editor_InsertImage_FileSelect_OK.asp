<!--#include virtual="/inc/config/function.asp"//-->
<OBJECT RUNAT=server PROGID=ADODB.Connection id=db></object>

<style type="text/css">
	body	{font-size: 9pt; font-family: 굴림, 돋음; font-style:  normal; font-weight: normal;}
	td		{font-size: 9pt; font-family: 굴림, 돋음; font-style:  normal; font-weight: normal;}
	pre		{font-size: 9pt; font-family: 굴림, 돋음; font-style:  normal; font-weight: normal;}
	input, select, textarea, button	{font-size: 9pt; font-family: 굴림, 돋음; font-style:  normal; font-weight: normal;}
	
	input, select	{width:90%;}
	textarea		{width:100%; height:50;}
	button			{width:75; cursor:hand;}
	
	image			{cursor:hand;}
	
	.threedface	{background-color: threedface;}
	.align_select	{border: 2px solid #000080;}
</style>

<body style="background: threedface; color: windowtext; margin: 0px; border-style: none;">

<%
	



	Dim comABCUpload, scFso, EnableUploadFIleType ,uploadform
	Dim RQ_Src, RQ_Alt
	Dim Dir, Dir_Root, Dir_Folder, Dir_FullPath
	Dim FileName, FileExt, SaveFileFullPath, ReturnFileFullPath
	
	'**	업로드 가능한 파일
		EnableUploadFIleType	= "gif, jpg, jpeg, png, bmp, tif, tiff, pcx"
	
	'**	upload  설정
		Set uploadform = Server.CreateObject("DEXT.FileUpload")  
'		uploadform.DefaultPath =  Server.MapPath("/")&"\upload\edu\" 
		uploadform.DefaultPath	=	file_up_path&"\edu\"

		path=file_up_path&"\edu\"

	'**	입력값 확인
		file			= UploadForm("Src")
		RQ_Alt		= UploadForm("Alt")
		FileExt = right(file,4)
		response.write file
		response.write rq_alt
		if (INSTR(EnableUploadFIleType, LCASE(replace(FileExt,".",""))) <= 0 or file = "") then
			Response.Write("<script language='JScript'>alert('그림 파일만 선택할수 있습니다.\n\n확인 바랍니다.');parent.document.all['File_Check'].value=1;parent.document.all['FileUploading_Box'].style.display='none';location.href='Editor_InsertImage_FileSelect.htm';</script>")
			Response.End
		end if

		file_name = UploadForm("Src")
		file_size = uploadForm("src").FileLen
		file_width = uploadform("src").imagewidth
		file_name = uploadform("src").Save( ,false)
		file_name = Mid(file_name, InstrRev(file_name, "\")+1)		
		ReturnFileFullPath=path&file_name
%>



<br>
<center>업로드 완료..</center>
<script language="javascript" for="window" event="onload">

	parent.document.all['Src'].value	= '<%=REPLACE(ReturnFileFullPath, "\", "\\")%>';
	parent.document.all['Alt'].value	= '<%=RQ_Alt%>';
	
	parent.document.all['FileUploading_Box'].style.display	= 'none';
	parent.document.all['File_Check'].value	= 1;
	
	parent.FUN_Ok();
</script>



