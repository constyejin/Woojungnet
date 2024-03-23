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
  <!-- <meta name="viewport" content="width=768"> -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?=$web_config[web_sitename]?></title>
  <?=$web_config[web_meta]?>
  <link rel="stylesheet" href="/inc/styles/reset.css">
  <link rel="stylesheet" href="/inc/styles/buttons.css">
  <link rel="stylesheet" href="/mobile/inc/styles/header.css">
  <link rel="stylesheet" href="/mobile/inc/styles/style.css">
  <link rel="stylesheet" href="/mobile/inc/styles/footer.css">

  <script src="https://kit.fontawesome.com/522c2b7a73.js" crossorigin="anonymous"></script>
  <script src="/inc/script.js"></script>
</head>
<body>
<iframe name="HiddenFrm" id="HiddenFrm" style="display:none;"></iframe>
  <div class="wrapper">
    <header class="global-header">
      <? if($_SESSION[login_idx]){ ?>
      <!-- NOTE : 로그인 한 경우 -->
        <ul class="auth user-info">
          <li class="admin">
            <a href="/manage/menu01/sub01.php">&#91;관리자모드&#93;</a>
          </li>
          <li class="user-name">
            <span>홍길동</span>님
          </li>
          <li>
            <a href="/mobile/inc/logout.php">로그아웃</a>
          </li>
        </ul>
        <? }else { ?>
        <!-- NOTE : 로그인 하지 않은 경우 -->
        <ul class="auth join"></ul>
      <? } ?>

      <div class="global-logo">
        <div class="sidebar-icon">
          <i class="fa-solid fa-bars"></i>
        </div>
        <h1 class="logo">
          <a href="/mobile/index.php">
            <p>&#40;주&#41;경기보링공업</p>
          </a>
        </h1>
        <div class="call-icon">
          <a href="tel:032-571-4117""><i class="fa-solid fa-phone-volume"></i></a>
        </div>
      </div>

      <nav class="global-menu">
        <h2 class="visually-hidden">메뉴</h2>
        <ul class="gnb-nav-list">
          <li class="gnb-nav-item">
            <a href="/mobile/menu01/intro.php">회사소개</a>
          </li>
          <li class="gnb-nav-item">
            <a href="/mobile/menu02/workStatus_list.php">작업현황</a>
          </li>
          <li class="gnb-nav-item">
            <a href="/mobile/menu03/estimate.php">견적신청</a>
          </li>
          <li class="gnb-nav-item">
            <a href="/mobile/menu04/notice_list.php">공지사항</a>
          </li>
        </ul>
      </nav>
    </header>
    
    <aside class="sidebar">
      <header class="sidebar-header">
        <button class="sidebar-close-icon">
          <i class="fa fa-close"></i>
        </button>
        <h1 class="sidebar-logo">
          <a href="/mobile/index.php">
            <p>&#40;주&#41;경기보링공업</p>
          </a>
        </h1>

        <? if($_SESSION[login_idx]){ ?>
        <!-- NOTE : 로그인 한 경우 -->
        <ul class="sidebar-auth">
          <li>
            <a href="/mobile/inc/logout.php">로그아웃</a>
          </li>
        </ul>
        <? }else { ?>
          
        <!-- NOTE : 로그인 하지 않은 경우 -->
        <ul class="sidebar-auth">
          <li>
            <a href="/mobile/inc/login.php">로그인</a>
          </li>
        </ul>
        <? } ?>
      </header>

      <nav class="sidebar-nav">
        <h2 class="visually-hidden">메뉴</h2>
        <ul>
          <li>
            <a href="/mobile/menu02/workStatus_list.php">- 작업현황</a>
          </li>
          <li>
            <a href="/mobile/menu03/estimate.php">- 견적신청</a>
          </li>
          <li>
            <a href="/mobile/menu04/notice_list.php">- 공지사항</a>
          </li>
          <li><a href="/mobile/menu01/intro.php">- 회사소개</a></li>
          <li><a href="/mobile/menu01/intro.php/#map-sec">- 오시는길</a></li>
        </ul>
      </nav>

      <footer class="sidebar-footer">
        <ul>
          <li>전화:032-571-4117/ 010-4598-8690</li>
          <li>팩스:032-571-4118</li>
          <li>주소:인천광역시 서구 거북로24번길22.2동(석남동)</li>
        </ul>
      </footer>
    </aside>

    <script src="/mobile/inc/js/sidebar.js"></script>
