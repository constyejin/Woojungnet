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
function picView2(pic) {
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
  <style type="text/css">
    
  </style>
  <link href="../common/css/style.css" rel="stylesheet" type="text/css" />
</head>

<body topmargin=0 leftmargin=0>
<iframe name="HiddenFrm" id="HiddenFrm" style="display:none;"></iframe>
<div class="zoom-image-wrap">
  <table border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC" class="header-summary">
    <colgroup>
      <col style="width: 15%">
      <col style="width: 10%">
      <col style="width: 15%">
      <col style="width: 10%">
      <col style="width: 15%">
      <col style="width: auto">
    </colgroup>
    <tr>
      <td align="center" valign="middle" bgcolor="f5f5f5" style="padding-right: 5px;  padding-top: 2px;"><span class="style1">접수번호</span></td>
      <td align="left" bgcolor="#FFFFFF" style="padding-left:3px;"><?=$info[wc_orderno]?></td>
      <td align="center" bgcolor="f5f5f5" style="padding-left:3px;"><span class="style1">모델명</span></td>
      <td align="left" bgcolor="#FFFFFF" style="padding-left:3px;"><?=$info[wc_model]?></td>
      <td align="center" bgcolor="f5f5f5" style="padding-left:3px;"><span class="style1">년식</span></td>
      <td align="left" bgcolor="#FFFFFF" style="padding-left:3px;"><?if($info[wc_age])?>
        <?=substr($info[wc_age],0,4)?>
        년
        <?=substr($info[wc_age],4,2)?>
        월 
      </td>
    </tr>
  </table>
  <!-- 이미지 -->
  <div class="img-main">
    <img src="" alt="">
  </div>
  <div class="img-list-wrap">
    <div class="img-list">
      <ul>
        <li class="active"><img src="https://picsum.photos/130/100?random=1" alt="차량이미지 썸네일"></li>
        <li><img src="https://picsum.photos/130/100?random=2" alt="차량이미지 썸네일"></li>
        <li><img src="https://picsum.photos/130/100?random=3" alt="차량이미지 썸네일"></li>
        <li><img src="https://picsum.photos/130/100?random=4" alt="차량이미지 썸네일"></li>
        <li><img src="https://picsum.photos/130/100?random=5" alt="차량이미지 썸네일"></li>
        <li><img src="https://picsum.photos/130/100?random=1" alt="차량이미지 썸네일"></li>
        <li><img src="https://picsum.photos/130/100?random=3" alt="차량이미지 썸네일"></li>
        <li><img src="https://picsum.photos/130/100?random=4" alt="차량이미지 썸네일"></li>
        <li><img src="https://picsum.photos/130/100?random=5" alt="차량이미지 썸네일"></li>
        <li><img src="https://picsum.photos/130/300?random=1" alt="차량이미지 썸네일"></li>
        <li><img src="https://picsum.photos/130/100?random=2" alt="차량이미지 썸네일"></li>
        <li><img src="https://picsum.photos/130/100?random=3" alt="차량이미지 썸네일"></li>
        <li><img src="https://picsum.photos/130/100?random=4" alt="차량이미지 썸네일"></li>
        <li><img src="https://picsum.photos/130/100?random=5" alt="차량이미지 썸네일"></li>
      </ul>
    </div>
    <p class="notice-small">
      더보기를 통해 더 많고 큰 이미지로 사진을 보실수 있습니다
    </p>
  </div>
</div>

</body>

</html>
