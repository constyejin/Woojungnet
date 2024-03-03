<?
$data_noti=mysql_fetch_array(mysql_query("select * from js_webconfig where no=1"));
?>

<style type="text/css">

body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-color: #FFFFFF;
}


</style>

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">

<iframe name="HiddenFrm_noti" style="display:none;"></iframe>
<form name="cform_noti" method="post" enctype="multipart/form-data" target="HiddenFrm_noti" action="/manage/inc/noti_ok.php">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr align="left"> 
				<td height="10" valign="top"  colspan="4" class="bg-darkblue"></td>
			</tr>
			<tr>
				<td align="right" style="height:30px;padding-right:10px;" class="bg-darkblue"><font style="color: #ff0000; font-weight:700;">알림장</font> :  </td>
				<td width="120" class="bg-darkblue"><input name="noti" type="text" size="120" value="<?=$data_noti[noti]?>"/></td>
				<td width="50" align="center" style="color:#0066CC;cursor:pointer;" onclick="document.cform_noti.submit();"  class="bg-darkblue"><strong>등록</strong></td>
				<td  class="bg-darkblue">&nbsp;&nbsp;&nbsp;&nbsp;문자천국에 SMS 잔여건수 : <span style="color:red;font-weight:bold;"><?=number($data_noti[sms_count])?></span> 개 남았습니다</td>
			</tr>
			<tr align="left"> 
				<td height="1" valign="top"  colspan="4" style="background-color:#222;"></td>
			</tr>
		</table>
</form>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <!-- <tr> 
    <td height="23" align="center">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td align="right" style="padding:3 8 0 0; border-bottom:1px solid #0e4769; height:40px;" class="bg-darkblue">
            <a href="/index.php"></a>&nbsp;&nbsp;<a href="/member/loginProc.php?logMode=logout"></a>
          </td>
        </tr>
      </table>
    </td>
  </tr> -->
  <tr>
    <td height="41" align="center" valign="middle" class="bg-darkblue">
      <? include_once "$dir/manage/inc/menu.php";?></td>
  </tr>
   <tr>
    <td height="1" bgcolor="#78858c"></td>
  </tr> 
 <?
$tchkdir=explode("/",$PHP_SELF);
$chkdir2=basename($PHP_SELF);
$chkdir3=$_SERVER['QUERY_STRING'];
$chkdir=$tchkdir[sizeof($tchkdir)-2];
 ?> 
  <tr> 
    <td height="26" align="center"><table width="100%" height="26" border="0" cellspacing="0" cellpadding="0">
        <tr>
          
          <td align="center" style="padding:3 0 0 0">
          		  <? include_once "../".$chkdir."/sbmenu.php";?> 
		  </td> 
        </tr>
      </table></td>
  </tr>
    
   <tr>
          
        <td height="1" bgcolor="#a6a6a6"></td>
  </tr> 
  
  
  <tr>
    <td  align="center" valign="top">
<table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0">
        <tr> 
         
          <td width="100%"><table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td width="11" height="23"></td>
                <td></td>
                <td width="12"></td>
              </tr>
              <tr> 
                <td>&nbsp;</td>
                <td align="center" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr> 
                      <td height="5"> </td>
                    </tr>
                    <tr> 
                      <td align="center" valign="top"> 
                        <!-- &nbsp; -->