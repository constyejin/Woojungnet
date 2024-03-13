<?php
include "../inc/Func.php";
$connect = dbconn();	



$pic = $_GET[pic];
$idx = $_GET[idx];

$info = Row_string("SELECT * FROM woojung_car2 WHERE wc_idx = '$idx'");

$site_u = mysql_fetch_array(mysql_query("select * from recruit as a left join woojung_member as b on a.code=b.code left join woojung_car2 as c on b.userId=c.wc_mem_id where c.wc_idx='".$info[wc_idx]."' "));

if($pic)
{
	$wc_car_img1 = explode("/",$info["wc_img_".$pic]);
	$defaultFile = $site_u[home_url]."/data/".$wc_car_img1[0];

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
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
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
<table width="802" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="left" valign="top"><table width="802" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="631" align="left" valign="top"><br><table width="619" border="0" cellpadding="0" cellspacing="0" background="../images/action_pop_bg.gif">
            <tr>
              <td width="619" height="482" align="center" valign="middle"><div id='picDisplay2'><img src="<?=$defaultFile?>" id="ZoomImg"  style="cursor:pointer" onload="ReSizeImg()" /></div></td>
            </tr>
        </table></td>
        <td align="left" valign="top"><br><table width="164" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
            <tr>
              <td width="65" height="27" align="center" valign="middle" bgcolor="f5f5f5" style="padding-right: 5px;  padding-top: 2px;"><span class="style1">No.</span></td>
              <td width="103" height="27" bgcolor="#FFFFFF" style="padding-left:3px;"><?=$info[wc_orderno]?></td>
            </tr>
          
            <tr>
              <td width="65" height="27" align="center" valign="middle" bgcolor="f5f5f5"><span class="style1">모델명</span></td>
              <td width="103" height="27" bgcolor="#FFFFFF" style="padding-left:3px;"><?=$info[wc_model]?></td>
            </tr>
            <tr>
              <td width="65" height="27" align="center" valign="middle" bgcolor="f5f5f5"><span class="style1">년식</span></td>
              <td width="103" height="27" bgcolor="#FFFFFF" style="padding-left:3px;">
			  
			  
			  <?if($info[wc_age])?>
            <?=substr($info[wc_age],0,4)?>
            년 
            <?=substr($info[wc_age],4,2)?>
            월
			
			</td>
            </tr>
          </table>
            <table width="168" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="4" align="left" valign="top"></td>
              </tr>
            </table>
          <table width="171" border="0" cellspacing="0" cellpadding="0">
          
          
              <tr>

<?
for($i=1; $i<=24; $i++) {

	$fileName = $info["wc_img_".$i];
	$real_name = explode('/', $fileName);	
	
	if(strlen($real_name[0]) == 0)
	{
		$fileName = '/images/bg01.jpg';
		$script = "";
		
	}
	else
	{
		$fileName = $site_u[home_url]."/data/".$real_name[0];
		$script = " onMouseOver=\"picView2('$fileName')\" class='hand'";
	}
?>
                <td width="84" height="53" align="center" valign="top"><img src="<?=$fileName?>" name="bt01" width="50" height="40" border="0" id="bt01" <?=$script?>></td>
                <td width="1px"></td>
  <?
		  if($i%3 == 0){
				echo "</tr>
					  <tr>";  
		  }
}	
?>             
			
              </tr>
           
          </table>
		  
		  
		  </td>
      </tr>
    </table>
      <table width="802" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="706" height="40" align="left" valign="middle" style="padding-left:3px;"><span class="style1">◈파손상태, 옵션, 부품(차키)의 분실, 기존사고유무등을 보관소를 방문 실차 확인 후 신중한 입찰바랍니다.</span></td>
          <td align="left" valign="middle"> <input type="submit" name="button" id="button" value="창닫기" class="button33" style="cursor:pointer; background-color:#FFFFFF; color:#084573; border:#636563 1px solid; padding:5 3 3 3; font-weight:bold" onClick="javascript:self.close();"/></td>
        </tr>
      </table></td>
  </tr>
</table>
</body>

</html>
