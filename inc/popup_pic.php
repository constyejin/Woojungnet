<?php
include "../inc/Func.php";
$connect = dbconn();	

if(!$user_level && (!$loginId || $loginUsort=="indi" || $loginUsort=="company1" || $loginUsort=="company2" || $loginUsort=="premium1") ){
	echo "<script>alert('사용 권한이 없습니다.');history.back();</script>";
}


$pic = $_GET[pic];
$idx = $_GET[idx];

$info = Row_string("SELECT * FROM woojung_car WHERE wc_idx = '$idx'");

$site_u = mysql_fetch_array(mysql_query("select * from recruit as a left join woojung_member as b on a.code=b.code left join woojung_car as c on b.userId=c.wc_mem_id where c.wc_idx='".$info[wc_idx]."' "));

if($pic)
{
	$wc_car_img1 = explode("/",$info["wc_img_".$pic]);
	$defaultFile = $site_u[home_url]."/data/".$wc_car_img1[0];

}
?>


<script type="text/javascript">
function picView2(pic, e) {
	console.log(e);
	$('.img-wrap').css('border', 'none');
	$(e).parent('span').css('border', '2px solid #00b5ff');
	if(pic) {
		//picDisplay2.innerHTML = "<img src='"+pic+"'   onload=\"if(this.width > 600){this.style.width=600}else{this.style.width=this.width}\" onclick=\"self.close()\"  style=\"cursor:pointer;\"/>";

		document.getElementById('ZoomImg').src = pic;

	} else {
		picDisplay2.innerHTML = "<img src='../images/noImage_auction.gif'  onclick=\"self.close()\"  />";
		
	}

}



function ReSizeImg(){
	var obj = document.getElementById('ZoomImg');
	var width = 800;
	var height = 600;

	if(obj.width != width){
		obj.style.width=width;
	}else{
		obj.style.width=obj.width;
	}

	if(obj.height != height){
		obj.style.height=height;
	}else{
		obj.style.height=obj.height;
	}
}

function p_d(idx,i){
	alert(i);
	for(k=1;k<=i;k++){
		var myVar = setInterval(myPic, 1000, k);
		clearInterval(myVar);
	}
}

function myPic(k){
	alert(k);
//		document.getElementById("HiddenFrm").src="/inc/popup_pic_down.php?idx="+idx+"&num="+k;
}
</script>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
	<title>확대보기</title>
	<link href="../common/css/style.css" rel="stylesheet" type="text/css" />
	<link href="../common/css/add_style.css" rel="stylesheet" type="text/css" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<style type="text/css">

	body {
		margin-left: 0px;
		margin-top: 0px;
		margin-right: 0px;
		margin-bottom: 0px;
		font-family:"SUIT","Malgun Gothic",sans-serif;
	}
	.style1 {
		color: #666666;
		font-weight: bold;
		font-size: 12px;
	}
	.topper{
		font-size: 13px;
	}
	.topper td{
		padding: 10px;
	}
	.summary{
		margin-top:20px;
		margin-bottom:0;
		padding: 10px 0;
	}
	</style>
	
</head>
<body topmargin=0 leftmargin=0>
<iframe name="HiddenFrm" id="HiddenFrm" style="display:none;"></iframe>
<table width="800" border="0" align="center" cellpadding="0" cellspacing="0" >
  <tr>
    <td height="40">
			<table width="800" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC" class="topper">
				<!-- <tr>
					<td width="93" height="27" align="center" valign="middle" bgcolor="f5f5f5" style="padding-right: 5px;  padding-top: 2px;"><span class="style1">접수번호</span></td>
					<td width="140" height="27" align="left" bgcolor="#FFFFFF" ><?=$info[wc_orderno]?></td>
					<td width="98" align="center" bgcolor="f5f5f5" ><span class="style1">모델명</span></td>
					<td width="161" align="left" bgcolor="#FFFFFF" ><?=$info[wc_model]?></td>
					<td width="105" align="center" bgcolor="f5f5f5" ><span class="style1">년식</span></td>
					<td width="174" align="left" bgcolor="#FFFFFF" ><?if($info[wc_age])?>
						<?=substr($info[wc_age],0,4)?>
	년
	<?=substr($info[wc_age],4,2)?>
	월 </td>
				</tr> -->
				<tr>
					<p class="summary">
						<span class="label">No :</span><span class="dd"><?=$info[wc_orderno]?></span> &nbsp;/&nbsp;
						<span class="dd"><?=$info[wc_model]?></span> &nbsp;/&nbsp;
						<span class="dd"><?if($info[wc_age])?> <?=substr($info[wc_age],0,4)?> 년 <?=substr($info[wc_age],4,2)?>월</span> &nbsp;/&nbsp;
						<span class="dd"><?=$info[wc_mem_name]=="동부"?$info[trans_dong]:$info[wc_trans] ?></span> &nbsp;/&nbsp;
						<span class="dd"><?=$info[wc_mem_name]=="동부"?$info[fual_dong]:$info[wc_fual] ?></span> &nbsp;/&nbsp;
						<span class="dd"><?=number_format($info[wc_cc])?>cc</span> &nbsp;/&nbsp;
						<span class="dd"><?=number_format($info[wc_mileage])?>km</span>
					</p>
				</tr>
			</table>
		</td>
  </tr>



  <tr>
    <td align="center" valign="top"><table width="802" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="left" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="1" background="../images/action_pop_bg.gif">
          <tr>
            <td width="700" height="300" align="center" valign="middle"><table width="800" height="600" border="0" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
              <tr>
                <td align="center" bgcolor="#FFFFFF"><div id='picDisplay'><img src="<?=$defaultFile?>" id="ZoomImg"  style="cursor:pointer" onload="ReSizeImg()" /></div></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td height="5" align="center" valign="middle"></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td align="center"><table width="800" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <?
for($i=1; $i<=48; $i++) {

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
		$script = " onMouseOver=\"picView2('$fileName', this)\" class='hand'";
		$k=$i;
	}
?>
            <td width="84" height="53" align="center" valign="top"><span style="position:relative;display: inline-block;width: 100%; height: 53px;overflow:hidden;box-sizing:border-box" class="img-wrap">
							<img src="<?=$fileName?>" name="bt01" border="0" id="bt" style="position:absolute;top:0;left:0;width: 100%;box-sizing:border-box;" <?=$script?>>
							</span>
<?
	if(strlen($real_name[0]) != 0){
?>
			
<? } ?>
			</td>
            <!-- <td width="1px"></td> -->
            <?
		  if($i%10 == 0){
				echo "</tr>
					  <tr>";  
		  }
}	
?>
          </tr>
        </table></td>
      </tr>
    </table>
        <table width="800" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="640" height="20" align="left" valign="middle" style="padding-left:3px;"></td>
            <td width="60" align="right" valign="middle"><a href="#">
              <input type="submit" name="button2" id="button2" value="창닫기" class="button33" style="cursor:pointer; background-color:#FFFFFF; color:#084573; border:#636563 1px solid; padding:5 3 3 3; font-weight:bold" onClick="javascript:self.close();"/>
            </a></td>
          </tr>
      </table></td>
  </tr>
</table>
</body>

</html>
