<?
include $_SERVER['DOCUMENT_ROOT']."/inc/header.php";
include $_SERVER['DOCUMENT_ROOT']."/inc/menu.php";
?>
<script language="javascript">
	
	function ChkSearch(){
		var obj = document.frmSearch;
		if(!obj.uname.value){
			alert("성명을 기입해 주세요");
			obj.uname.focus();
			return false;
		}else if(!obj.ujumin1.value || !obj.ujumin2.value || !obj.ujumin3.value){
			alert("휴대폰번호를 기입해 주세요");
			obj.ujumin1.focus();
			return false;
		}else if(!obj.uemail.value){
			alert("등록하신 이메일을 기입해 주세요");
			obj.uemail.focus();
			return false;
		}else{
			obj.target = "iFrm";
			obj.action = "idSearch.php";
			obj.submit();
		}
	}
</script>
  <div class="login">
    <!--header>
      <h1>
        <img src="http://www.skrcauto.co.kr/images/front/main_logo_m.png" alt="SKRCAUTO로고" onclick="location.href='/';">
      </h1>
    </header-->
    <div class="visual">
      <p class="title">
        보험사 경공매 온라인 서비스<br>SKRC AUTO에서 입찰경매를 시작하세요!!
      </p>
      <p class="sub-text">
        보험사잔존물,사고차, 폐차등의 가치평가! 공정하고 투명하게 안전한서비스를 제공합니다.
      </p>
    </div>
<iframe name="iFrm" id="iFrm" style="display:none;"></iframe>
<form name="frmSearch" method="post" onSubmit="return ChkSearch()">
    <div class="container">
      <h2>아이디/비번찾기</h2>
      <p class="sub-description">등록된 휴대전화로 가입내용이 전송됩니다.</p>
      <div class="input-wrap">
        <input type="text" placeholder="이름(담당자)명을 입력하세요" name="uname">
      </div>
      <div class="input-group phone">
        <div class="input-wrap">
          <input type="text" placeholder="휴대전화" name="ujumin1">
        </div>
        <div class="dash">-</div>
        <div class="input-wrap">
          <input type="text" placeholder="" name="ujumin2">
        </div>
        <div class="dash">-</div>
        <div class="input-wrap">
          <input type="text" placeholder="" name="ujumin3">
        </div>
      </div>
      <div class="input-wrap">
        <input type="text" placeholder="이메일" name="uemail">
      </div>
  
      
      <button class="submit btn btn-primary btn-md btn-wide">전송하기</button>
  
    </div>
</form>
  </div>
  <?
include $_SERVER['DOCUMENT_ROOT']."/inc/footer.php";
?>  
</body>
</html>