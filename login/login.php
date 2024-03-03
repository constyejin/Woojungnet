<?
require_once $_SERVER['DOCUMENT_ROOT']."/lib/common.php";
include $_SERVER['DOCUMENT_ROOT'].'/lib/global.php';
include $_SERVER['DOCUMENT_ROOT'].'/lib/phpfun.class.php';
$phpfun = new phpfun();

$data_config=mysql_fetch_array(mysql_query("select * from js_webconfig where no=1"));
?>
<!DOCTYPE HTML>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta name="viewport" content="width=1280">
    <title>Login</title>
    <!-- jquery -->
    <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>

    <link rel="stylesheet" type="text/css" href="/common/css/incaron_style.css"/>

    <script src="/common/js/incaron_ui.js"></script>
  </head>
  <body>
    <?
      include $_SERVER['DOCUMENT_ROOT']."/inc/menu.php";
    ?>
    <iframe name="AdminFrm" id="AdminFrm" style="display:none;"></iframe>
    <div class="login id-pw">
      <div class="container">
      <? if($data_config[sms_certify]=="N"){ ?>
      <form name="loginForm" method="post" action="/login/login_check.php" target="AdminFrm" >
      <? }else if($data_config[sms_certify]=="Y"){ ?>
      <form name="loginForm" method="post" action="/login/login_new.php" >
      <? } ?>
        <input type="hidden" name="logMode" value="login">
          <div class="border-box">
            <h2>로그인 <span class="en">Login</span></h2>
            <p class="sub-text">로그인 후 이용가능합니다.</p>

            <div class="input-wrap">
              <input type="text" name="userId" placeholder="아이디를 입력하세요">
            </div>
            <div class="input-wrap">
              <input type="password" name="userPw" placeholder="비밀번호를 입력하세요">
            </div>

            
            <button class="submit btn btn-primary btn-md btn-wide">로그인</button>

            <div class="link">
              <ul>
                <li>
                  <a href="/login/terms.php" class="btn-link">회원가입</a>
                </li>
                <li>
                  <a href="/login/find_id_pw.php" class="btn-link">아이디/비번찾기</a>
                </li>
              </ul>
            </div>
          </div>

      </form>
        </div>
    </div>
    <?
      include $_SERVER['DOCUMENT_ROOT']."/inc/bottom.php";
    ?>
  </body>
</html>
