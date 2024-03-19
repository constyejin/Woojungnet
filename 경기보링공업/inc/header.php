<?
include $_SERVER['DOCUMENT_ROOT']."/inc/lib.php";

// 카운터
include_once $_SERVER[DOCUMENT_ROOT]."/inc/counter.php";
if(!$_SESSION[counter_ip]){
	$_SESSION[counter_ip]=$_SERVER['REMOTE_ADDR'];
	$sql_ip="select * from counter where counter_ip='$_SESSION[counter_ip]' and counter_date='".date("Y-m-d")."' ";
	$result_ip=mysql_query($sql_ip);
	$data_ip=mysql_fetch_array($result_ip);
	if(!$data_ip[idx]){
		$query_ip="insert into counter set counter_ip='$_SESSION[counter_ip]' , counter_date='".date("Y-m-d")."'";
		mysql_query($query_ip);
	}
}

$web_config=sql_fetch("select * from web_config where idx=1 ");
?>
<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width:1200">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>&#40;주&#41;경기보링공업</title>
  <link rel="stylesheet" href="/inc/styles/reset.css">
  <link rel="stylesheet" href="/inc/styles/header.css">
  <link rel="stylesheet" href="/inc/styles/footer.css">
  <link rel="stylesheet" href="/inc/styles/quick.css">
  <link rel="stylesheet" href="/inc/styles/buttons.css">
  <link rel="stylesheet" href="/inc/styles/style.css">
  <!-- Slick Slide -->
  <link rel="stylesheet" type="text/css" href="http://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script type="text/javascript" src="http://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
  <!-- Font Awesome -->
  <script src="https://kit.fontawesome.com/522c2b7a73.js" crossorigin="anonymous"></script>
</head>
<body>
<iframe name="HiddenFrm" id="HiddenFrm" style="display:none;"></iframe>
  <div class="wrapper">
    <header class="global-header">
      <div>
        <h1 class="logo">
          <a href="/">
            <p>&#40;주&#41;경기보링공업</p>
          </a>
        </h1>

        <nav class="global-menu">
          <h2 class="visually-hidden">메뉴</h2>
          <ul class="gnb-nav-list">
            <li class="gnb-nav-item">
              <a href="/menu01/intro.php">회사소개</a>
            </li>
            <li class="gnb-nav-item">
              <a href="/menu02/workStatus_list.php">작업현황</a>
            </li>
            <li class="gnb-nav-item">
              <a href="/menu03/estimate.php">견적신청</a>
            </li>
            <li class="gnb-nav-item">
              <a href="/menu04/notice.php">공지사항</a>
            </li>
          </ul>
        </nav>
        
        <!-- NOTE : 로그인 한 경우 -->
        <!-- <ul class="auth user-info">
          <li class="admin">
            <a href="">&#91;관리자모드&#93;</a>
          </li>
          <li class="user-name">
            <span>관리자</span>님
          </li>
          <li>
            <button class="btn-blue-sm" href="">로그아웃</button>
          </li>
        </ul> -->

        <!-- NOTE : 로그인 하지 않은 경우 -->
        <ul class="auth join">
            <li>
              <a href="/inc/login.php" class="btn-blue-sm">로그인</a>
            </li>
          </ul>
      </div>
    </header>
