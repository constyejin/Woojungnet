<?php
include "../inc/Func.php";
$connect = dbconn();	



$pic = $_GET[pic];
$idx = $_GET[idx];

$info = Row_string("SELECT * FROM woojung_part WHERE wc_idx = '$idx'");

$cate1=mysql_fetch_array(mysql_query("select * from cate2 where idx='".$info[wc_made]."'"));
$cate3=mysql_fetch_array(mysql_query("select * from cate3 where idx='".$info[wc_trans]."'"));

if($pic)
{
	$wc_car_img1 = explode("/",$info["wc_img_".$pic]);
	$defaultFile = "/data/".$wc_car_img1[0];

}
?>


<script type="text/javascript">
function picView2(pic) {
	if(pic) {
		//picDisplay2.innerHTML = "<img src='"+pic+"'   onload=\"if(this.width > 600){this.style.width=600}else{this.style.width=this.width}\" onclick=\"self.close()\"  style=\"cursor:pointer;\"/>";

		document.getElementById('ZoomImg').src = pic;

	} else {
		picDisplay2.innerHTML = "<img src='../images/noImage_auction.gif'  onclick=\"self.close()\"  />";
		
	}

}



function ReSizeImg(){
	var obj = document.getElementById('zoomimg');
	var width = 600;
	var height = 500;

	if(obj.width > width){
		obj.style.width=width;
	}else{
		obj.style.width=obj.width;
	}

	if(obj.height > height){
		obj.style.height=height;
	}else{
		obj.style.height=obj.height;
	}
}




</script>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>확대보기</title>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.style1 {
	color: #666666;
	font-weight: bold;
}
-->

</style></head>
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<link rel='stylesheet' href='/admin/counter/_style.css' type='text/css'>
<body topmargin=0 leftmargin=0>
<table width="802" border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
<td height="25">위치 : <strong><?=$cate1[name]?></strong> &gt; <strong><?=$info[wc_model]?> / <?=$cate3[name]?></strong></td>
</tr>
<tr>
  <td><table width="800" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
    <tr>
      <td width="100" height="27" align="center" valign="middle" bgcolor="f5f5f5" style="padding-right: 5px;  padding-top: 2px;"><span class="style1">제목</span></td>
      <td width="300" height="27" align="left" bgcolor="#FFFFFF" style="padding-left:3px;"><?=$info[wc_mem_etc]?></td>
      <td width="100" align="center" bgcolor="f5f5f5" style="padding-left:3px;"><span class="style1">년식</span></td>
      <td width="300" align="left" bgcolor="#FFFFFF" style="padding-left:3px;"><?=$info[wc_age]?></td>
      </tr>
  </table></td>
</tr>
  <tr>
    <td align="left" valign="top"><table width="802" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="left" valign="top"><br>
            <table width="800" border="0" cellpadding="0" cellspacing="0" background="../images/action_pop_bg.gif">
              <tr>
                <td width="619" height="482" align="center" valign="middle"><div id='picDisplay2'><img src="<?=$defaultFile?>" id="ZoomImg"  style="cursor:pointer" onload="ReSizeImg()" /></div></td>
              </tr>
          </table><br></td>
        </tr>
      <tr>
        <td align="left" valign="top"><table width="800" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <?
for($i=1; $i<=8; $i++) {

	$fileName = $info["wc_img_".$i];
	$real_name = explode('/', $fileName);	
	
	if(strlen($real_name[0]) == 0)
	{
		$fileName = '/images/box02.jpg';
		$script = "";
		
	}
	else
	{
		$fileName = "/data/".$real_name[0];
		$script = " onMouseOver=\"picView2('$fileName')\" class='hand'";
	}
?>
            <td width="84" height="48" align="center" valign="top"><img src="<?=$fileName?>" name="bt01" width="50" height="40" border="0" id="bt01" <?=$script?>></td>
            <td width="1px"></td>
            <?
		  if($i%12 == 0){
				echo "</tr>
					  <tr>";  
		  }
}	
?>
          </tr>
        </table></td>
      </tr>
    </table>
    <table width="802" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="706" height="40" align="left" valign="middle" style="padding-left:3px;">&nbsp;</td>
          <td align="center" valign="top"> <input type="submit" name="button" id="button" value="창닫기" class="button33" style="cursor:pointer; background-color:#FFFFFF; color:#084573; border:#636563 1px solid; padding:5 3 3 3; font-weight:bold" onClick="javascript:self.close();"/></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td align="left" valign="top">&nbsp;</td>
  </tr>
</table>
</body>

</html>
