<?php
$dir = $_SERVER['DOCUMENT_ROOT'];
include $dir.'/lib/session.php';
include $dir.'/lib/basicdb.class.php';
include $dir.'/lib/scriptAlert.class.php';
?>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Incaron</title>
  <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
  <link rel="stylesheet" type="text/css" href="/common/css/base.css?v=221208"/>

	<link rel="stylesheet" type="text/css" href="/common/css/style.css"/>
	<link rel="stylesheet" type="text/css" href="/common/css/add_style.css?v=2212081209"/>  <!-- 2022.11.25 css추가  -->
	<link rel="stylesheet" type="text/css" href="/common/css/incaron_style.css"/>  <!-- 2022.11.25 css추가  -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
	
	<!-- swiper.js css-->
	<link
		rel="stylesheet"
		href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css"
	/>
	<!-- swiper.js js-->
	<script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>

  <script src="/common/js/incaron_ui.js"></script>
  <script src="/common/js/front.js"></script>
</head>
<?

$db		= new basicdb();
$script = new scriptAlert(); 

	if($mode == "delete"){
		
		if(count($check) == 0 ){MsgMov("선택된 자료가 없습니다.","Sale_list.php");exit;}
		for($i=0;$i<count($check);$i++){

			$sql="select * from woojung_part WHERE wc_idx = '$check[$i]' ";
			$result=mysql_query($sql);
			$data=mysql_fetch_array($result);
			for($im=1;$im<60;$im++){
				$imname="wc_img_".$im;
				if($data[$imname]){
					$delimg=explode("/" , $data[$imname]);
					unlink($_SERVER['DOCUMENT_ROOT'].'/data2/'.$delimg[0]);
				}
			}

			Query_string("DELETE FROM woojung_part WHERE wc_idx = '$check[$i]'");
		}	
				
		if($back_url=="o"){
		MsgMov("선택된 정보가 삭제 되었습니다.","/sub07/sub07_1.php?page=$page&gubun4=$gubun4");
		}else{
		MsgMov("선택된 정보가 삭제 되었습니다.","Sale_list.php?page=$page&gubun4=$gubun4");
		}
	}
	
	
?>