<%@ page contentType="text/html;charset=euc-kr"%>
<%@ page language="java" import="java.io.*,java.util.*,java.net.*"%>
<%@ page import="java.text.SimpleDateFormat,java.util.Calendar,java.util.Date"%>
<%@ page import="javax.servlet.*,javax.servlet.http.*"%>
<%@ page import="org.apache.commons.fileupload.FileUpload"%>
<%@ page import="org.apache.commons.fileupload.DiskFileUpload"%>
<%@ page import="org.apache.commons.fileupload.FileItem"%>
<%@ page import="dev.kc2.lib.util.Util"%>
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

<body style="background: threedface; color: windowtext; margin: 0px; border-style: none;">



<%
 //String savePath="/home/hansung/upload/editor"; // ������ ���丮 (������)

 //String savePath="/nyj/gpms/upload"; // ������ ���丮 (������)

String savePath="S:/file_server/upload/editor"; // ������ ���丮 (������)

 int sizeLimit = 3 *1024  * 1024 ; // 2�Ⱑ ���� �Ѿ�� ���ܹ߻� 1024000(1�ް�)

 String uploadDate = Util.dateFormat("yyyy-MM-dd-HHmmss");

String uploadDir = new StringBuffer()
.append(savePath)
//.append(File.separator)
.append("/")
.append(uploadDate.substring(0,4))
//.append(File.separator)
.append("/")
.append(uploadDate.substring(5,7)).append("/").toString();

out.println(uploadDir);

 File f = new File(uploadDir);

 String rq_alt="";
String ReturnFileFullPath="";
 if(!f.exists()){f.mkdirs();}


 	String sFileName="";
	long file_size=0;
	String reName="";

        try {

                
                DiskFileUpload dfuUpload = new DiskFileUpload();
                
                dfuUpload.setHeaderEncoding("EUC_KR");
                
                List lsItems = dfuUpload.parseRequest(request);
                Iterator iterator = lsItems.iterator();
                
                while (iterator.hasNext())
				{

                    FileItem fItem = (FileItem) iterator.next();

					
                        if (fItem.getSize() > 0)
						{
							file_size=fItem.getSize();
							//���� �̸��� �����´� 
							String ext = fItem.getName().substring(fItem.getName().lastIndexOf("\\") + 1);
							         ext = ext.substring(ext.lastIndexOf(".") + 1);

								//out.println(ext);
							if((!"jpg".equals(ext))||(!"gif".equals(ext))||(!"png".equals(ext)))
							{

										rq_alt="";
										//<script language='JScript'>alert('�׸� ���ϸ� �����Ҽ� �ֽ��ϴ�.\n\nȮ�� �ٶ���//��.');parent.document.all['File_Check'].value=1;parent.document.all['FileUploading_Box'].style.display='none';location.//href='Editor_InsertImage_FileSelect.htm';</script>";
										 
							}
							

							reName=uploadDate+"."+ext;

							// out.println(reName);
                            sFileName = fItem.getName().substring(fItem.getName().lastIndexOf("\\") + 1);

							//out.println(sFileName);
				
						 try {

								File file = new File(uploadDir + sFileName);
								File re_file = new File(uploadDir +reName);
                                
								fItem.write(file);// ���� ���� �Ѵ�����

								file.renameTo(re_file);//���� �̸� �ٲٱ�

								
							  } catch (IOException e) {}
                       
                    }//if--end

                }//while--end

           
        } catch (Exception e) {}

  
ReturnFileFullPath=uploadDir +reName;
ReturnFileFullPath=ReturnFileFullPath.replaceAll("S:/file_server","");
//ReturnFileFullPath=ReturnFileFullPath.replaceAll("\\","/");

String imgUrl="http://203.249.96.81:8080"+ReturnFileFullPath;

//out.println(ReturnFileFullPath);
//out.println(imgUrl);

%>


<br>
<center>���ε� �Ϸ�..</center>


<script language="javascript" for="window" event="onload">

	parent.document.all['Src'].value	= '<%=imgUrl%>';
	parent.document.all['Alt'].value	= '<%=rq_alt%>';
	
	parent.document.all['FileUploading_Box'].style.display	= 'none';
	parent.document.all['File_Check'].value	= 1;
		parent.FUN_Ok();
</script>









