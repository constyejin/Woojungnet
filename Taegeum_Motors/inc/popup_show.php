<?
include "$_SERVER[DOCUMENT_ROOT]/lib/config.php";
include "$dir/lib/dbconn.php";
include "$dir/lib/lib.php";
$data=mysql_fetch_array(mysql_query("select * from js_popup where pop_no='$vno'"));
?>
<head>
  <meta charset="UTF-8">
<title><?=$data[pop_subject]?></title>

<script language="javascript">
function setCookie (name, value, expires) {
  document.cookie = name + "=" + escape (value) +
    "; path=/; expires=" + expires.toGMTString();
}

function Setting(form) {
  var expdate = new Date();
  expdate.setTime(expdate.getTime() + 1000 * 3600 * 24 * 1);
  if (form.neveropen.checked) {
    setCookie('<?=$data[pop_no]?>', "deny", expdate);
  }
  window.close();
}
</script>

</head>
<body leftmargin="0" topmargin="0">
<TABLE width="100%" border="0" cellSpacing=0 bordercolorlight="black" bordercolordark="white">
        <tr> 
<?if(!$data[pop_link]){?>
	<td ><a href="javascript:window.close();"><img src="/images/popup/<?=$data[pop_image1]?>" galleryimg=no border=0></a></td>
<?} elseif ($data[pop_newwin]){?>            
          <td ><a href="<?=$data[pop_link]?>" target="_blank" onclick="window.close();"><img src="/images/popup/<?=$data[pop_image1]?>" galleryimg=no border=0></a></td>
<?} else {?>
          <td ><a href="javascript:opener.location.href='<?=$data[pop_link]?>';window.close();"><img src="/images/popup/<?=$data[pop_image1]?>" galleryimg=no border=0></a></td>
<?}?>
		  </tr>
      </table>    </td>
  </tr>
  <tr> 
    <td class="text" align="center">      <div align="left"> 
        <TABLE cellSpacing=0 width="100%" border="0" bordercolordark="white" bordercolorlight="black" align="right">
          <tr> 
            <td height="23" align="center" bgcolor="#D8D5D5" style="font-size:9pt" width=100%> 
              <form name="notice">
                <p align="center"> 
                  <?if ($data[pop_oneday]) {?><input type="checkbox" name="neveropen">
                   하루동안 이 창을 열지 않음
                  <input type="submit" value="확 인" onClick="Setting(document.notice)" style="font-size:9pt;vertical-align:middle"> &nbsp;&nbsp;&nbsp;<?}?>
				  <?if ($data[pop_close]) {?><input type="button" value="창닫기" onClick="window.close();" style="font-size:9pt;vertical-align:middle"><?}?>
            </form>            </td>
          </tr>
        </table>
</div>
      
    </td>
  </tr>
</table>
</body>
<?foot();?>