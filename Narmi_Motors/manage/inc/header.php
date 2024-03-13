<?
include $_SERVER['DOCUMENT_ROOT']."/inc/lib.php";
?>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>관리자</title>
  <!-- jquery -->
  <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
  <!-- bootstrap css -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
  <!-- bootstrap js -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <!-- swiper.js -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css"/>
  <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>

  <!-- admin css -->
  <link rel="stylesheet" href="/manage/src/css/style.css">

  <script src="/manage/src/js/script.js"></script>  
  <!-- add js  -->
  <script src="/manage/inc/script.js"></script>  

</head>
<body>
<iframe name="HiddenFrm" id="HiddenFrm" style="display:none;"></iframe>
<?
if($_SESSION[login_level]!="3"){ alert("관리자 권한이 필요합니다","/");exit; }
?>