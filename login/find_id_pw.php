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
<script language="javascript">
	
	function ChkSearch(){
		var obj = document.frmSearch;
		if(!obj.uname.value){
			alert("성명을 기입해 주세요");
			obj.uname.focus();
			return false;
		}
		if(!obj.ujumin1.value || !obj.ujumin2.value || !obj.ujumin3.value){
			alert("휴대폰번호를 기입해 주세요");
			obj.ujumin1.focus();
			return false;
		}
		if(!obj.uemail.value){
			alert("등록하신 이메일을 기입해 주세요");
			obj.uemail.focus();
			return false;
		}
		obj.target = "iFrm";
		obj.action = "idSearch.php";
		obj.submit();
	}
</script>
  </head>
  <body>
<iframe name="iFrm" id="iFrm" style="display:none;"></iframe>
    <?
      include $_SERVER['DOCUMENT_ROOT']."/inc/menu.php";
    ?>
    <div class="login id-pw">
      <div class="container">
<form name="frmSearch" method="post" onSubmit="return ChkSearch()">
        <div class="border-box">
          <h2>아이디/비번찾기</h2>
          <p class="sub-text">등록된 휴대전화로 가입내용이 전송됩니다.</p>

          <div class="input-wrap">
            <input type="text" placeholder="이름(담당자)명을 입력하세요" name="uname">
          </div>
          <div class="input-group phone">
            <div class="input-wrap">
              <input type="number" placeholder="휴대전화" name="ujumin1">
            </div>
            <div class="dash">
              -
            </div>
            <div class="input-wrap">
              <input type="number" name="ujumin2">
            </div>
            <div class="dash">
              -
            </div>
            <div class="input-wrap">
              <input type="number" name="ujumin3">
            </div>
          </div>
          <div class="input-wrap">
            <input type="text" placeholder="이메일" name="uemail">
          </div>
          <button class="submit btn btn-primary btn-md btn-wide">전송하기</button>
        </div>
</form>
        <div class="footer">
          <p class="align-c">
            회원가입 및 상담 : TEL.031-278-6111 (주말, 공휴일 휴무)<br>
            Copyright (c) (주)태금모터스 All rights reserved.
          </p>
        </div>
      </div>
    </div>
  </body>
</html>
