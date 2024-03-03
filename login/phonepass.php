<?
require_once $_SERVER['DOCUMENT_ROOT']."/lib/common.php";
include $_SERVER['DOCUMENT_ROOT'].'/lib/global.php';
include $_SERVER['DOCUMENT_ROOT'].'/lib/phpfun.class.php';
$phpfun = new phpfun();

	if($rCode=="0000"){
	$query="update js_webconfig set	sms_count='$uCount' where no='1' ";
	mysql_query($query);
	}
?>
<!DOCTYPE HTML>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<title>SKRCAUTO 서울경기종합폐차장(주)</title>
    <!-- jquery  -->
    <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>

    <!-- incaron css -->
    <link rel="stylesheet" type="text/css" href="/common/css/incaron_style.css"/>

    <!-- 인카론 UI js -->
    <script src="/common/js/incaron_ui.js"></script>
	<script>

		function check_ID_Window(){		
			var frm = document.join;
			

			if(!frm.rand_n.value){
				alert("인증번호를 입력해 주세요.");
				return;
			}	

			frm.action="login_check_new.php";
			frm.submit();
		}
		
		function resend(){
			if(confirm("인증번호를 재발송 하시겠습니까? ")){
				document.join2.submit();
			}
		}

	var ti=180;
	function timer(){
		ti--;
		document.getElementById('t_time').innerHTML = ti;
		if(ti==0){
			location.href='/login/loginProc.php?logMode=logout';
		}
	}
	intid=setInterval("timer()",1000);
	</script>
  </head>
  <body>
<iframe name="HiddenFrm" id="HiddenFrm" style="display:none;"></iframe>
    <div class="login id-pw">
      <div class="container">
        <div class="logo">
          <img src="/images/front/login_logo.png" alt="인카온 로고" onClick="location.href='/';">
        </div>
<form name="join2"  method="post" target="HiddenFrm" action="rand_num_resend.php">
</form>
<form name="join"  method="post" target="HiddenFrm">
<input type="hidden" name="logMode" value="login">
        <div class="border-box">
          <h2>휴대전화 인증 <span class="en"></span></h2>
          <p class="sub-text">휴대전화로 발송된 인증번호를 입력하세요.</p>

          <div class="input-wrap">
            <input type="text" name="rand_n" placeholder="인증번호를 입력하세요">
          </div>

          남은시간: <span id="t_time" style="color:#FF0000"><strong id="t_time">180</strong></span> <strong style="color:#FF0000">초</strong>
          <span style="color:blue;cursor:pointer;margin-left:20px;" onclick="resend();">인증번호재발송</span>
          <button type="button" class="submit btn btn-primary btn-md btn-wide" onclick="check_ID_Window();">확인</button>

          <!--div class="link">
            <ul>
              <li>
                <a href="/login/terms.php" class="btn-link">회원가입</a>
              </li>
              <li>
                <a href="/login/find_id_pw.php" class="btn-link">아이디/비번찾기</a>
              </li>
            </ul>
          </div-->
        </div>
</form>
        <div class="footer">
          <p class="align-c">
            회원가입 및 상담 : TEL. 031-278-6111 (주말, 공휴일 휴무)<br>Copyright (c) (주)태금모터스 All rights reserved.
          </p>
        </div>
      </div>
    </div>
  </body>
</html>