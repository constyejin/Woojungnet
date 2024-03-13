<?
include "./header_lib.php";

if($vno) $popup=sql_fetch("select * from popup where idx=$vno ");
if($popup[pop_link_type]=="1"){
	$tar='target="_self"';
}else if($popup[pop_link_type]=="2"){
	$tar='target="_blank"';
}
?>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- jquery -->
  <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
  <script src="/front/src/js/script.js"></script>
  <script src="/inc/script.js"></script>

  <!-- swiper.js -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css"/>
  <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
  
  <link rel="stylesheet" href="/front/src/css/style.css">
  <title><?=$web_config[web_sitename]?></title>
  <?=$web_config[web_meta]?>

<script language="javascript">
function setCookie (name, value, expires) {
  document.cookie = name + "=" + escape (value) +
    "; path=/; expires=" + expires.toGMTString();
}

function Setting(form,denyday) {
  var expdate = new Date();
  expdate.setTime(expdate.getTime() + 1000 * 3600 * 24 * denyday);
  setCookie('<?=$popup[idx]?>', "deny", expdate);
  window.close();
}
</script>

</head>
<body style="<?=$popup[pop_scroll]=="no"?"overflow:hidden;":""?>">

<TABLE width="100%" border="0" >
	<tr><td>
	<TABLE width="100%" border="0" >
        <tr> 
<?if($popup[pop_link]){?>
	<td ><a href="<?=$popup[pop_link]?>" <?=$tar?>><img src="/images/popup/<?=$popup[pop_file]?>" alt=""></a></td>
<?} else {?>
          <td ><img src="/images/popup/<?=$popup[pop_file]?>" alt=""></td>
<?}?>
		  </tr>
      </table>    </td>
  </tr>
  <tr> 
    <td class="text" align="center">      <div align="left"> 
        <TABLE cellSpacing=0 width="100%" border="0" bordercolordark="white" bordercolorlight="black" align="right">
          <tr> 
            <td height="23" align="center" bgcolor="#D8D5D5" style="font-size:9pt" width="100%"> 
              <form name="notice">
                <p align="center"> 
                  <?if ($popup[pop_etc]) {?><input type="checkbox" name="neveropen">
                   <?=$popup[pop_etc]?>일 이 창을 열지 않음
                  <input type="submit" value="확 인" onClick="Setting(document.notice,<?=$popup[pop_etc]?>)" style="font-size:9pt;vertical-align:middle"> &nbsp;&nbsp;&nbsp;<?}?>
				  <!--input type="button" value="창닫기" onClick="window.close();" style="font-size:9pt;vertical-align:middle"-->
            </form>            </td>
          </tr>
        </table>
</div>
      
    </td>
  </tr>
</table>
</body>
</html>