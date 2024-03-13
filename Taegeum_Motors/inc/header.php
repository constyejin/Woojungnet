<?
require_once $_SERVER['DOCUMENT_ROOT']."/lib/common.php";
include $_SERVER['DOCUMENT_ROOT'].'/lib/global.php';
include $_SERVER['DOCUMENT_ROOT'].'/lib/phpfun.class.php';
$phpfun = new phpfun();

$config=mysql_fetch_array(mysql_query("select * from js_webconfig where no=1"));
?>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="naver-site-verification" content="9a6bfda547bb2faf5bfd9c65838f06585c1047d8" />
  <meta name="google-site-verification" content="VqhGFozTUdeTkCw_veKYf2OjPPw0tLMYr3ulNZwm8Iw" />
  <title>(주)태금모터스</title>
  <meta property="og:type" content="website">
  <meta property="og:title" content="태금모터스">
  <meta property="og:description" content="보험사잔존물경공매,폐차,수출,자동차부품">
  <meta property="og:image" content="www.taegeummotors.com/myimage.jpg">
  <meta property="og:url" content="www.taegeummotors.com">
  <meta name="robots" content="보험사잔존물경공매,폐차,수출,자동차부품">
  <meta name="description" content="보험사잔존물경공매,폐차,수출,자동차부품">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta name="robots" content="index" />
  <link rel="canonical" href="www.taegeummotors.com"">
  <meta name="viewport" content="width=1280">
  
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

	<!-- 230228 -->
	<link rel="stylesheet" href="/common/js/jquery.bxslider.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.min.js"></script>
	<script>
		$(document).ready(function() {
			$('.slider3').bxSlider({
				auto: true,
				autoControls: false,
				stopAutoOnClick: false,
				pager: false,
				controls: false,
				autoHover: false,
				mode: 'fade',
			});
		});
	</script>
</head>

<body>
<iframe name="AdminFrm" id="AdminFrm" style="display:none;"></iframe>

<?
$mobileBrower = '/(iPod|iPhone|Android|BlackBerry|SymbianOS|SCH-M\d+|Opera Mini|Windows CE|Nokia|SonyEricsson|webOS|PalmOS)/';
if(preg_match($mobileBrower, $_SERVER['HTTP_USER_AGENT'])) {
}else{
?>
<!-- 퀵메뉴 -->
  <div class="quick-menu" style="top: 178px;">
    <p class="quick-title">
      Quick Menu
    </p>
    <!-- <a href="" class="menu-item">
        <div class="icon">
            <span class="icon-quick-dart"></span>
        </div>
        빠른메뉴
    </a> -->
    <a href="/mypage/sub04.php" class="menu-item">
        <div class="icon">
            <span class="icon-quick-docu"></span>
        </div>
        입찰현황
    </a>
    <a href="/mypage/sub05.php" class="menu-item">
        <div class="icon">
            <span class="icon-quick-chart"></span>
        </div>
        낙찰현황
    </a>
    <a href="/mypage/sub03.php" class="menu-item">
        <div class="icon">
            <span class="icon-quick-heart"></span>
        </div>
        관심차량
    </a>
    <a href="/mypage/sub01.php" class="menu-item">
        <div class="icon">
            <span class="icon-quick-checklist"></span>
        </div>
        접수현황
    </a>
    <a href="/sub01/sub01_3.php" class="menu-item">
        <div class="icon">
            <span class="icon-quick-notice"></span>
        </div>
        1:1상담
    </a>
  </div> 
<?
}
?>


  <div id="wrap" class="main">
<?
include $_SERVER['DOCUMENT_ROOT']."/inc/menu.php";
?>