<? include $_SERVER['DOCUMENT_ROOT']."/inc/header.php";?>
<script>
function login(){
	f=document.cform;
	if(f.user_id.value==""){
		alert('아이디를 입력해 주세요.');
	}else if(f.user_pass.value==""){
		alert('패스워드를 입력해 주세요.');
	}else{
		f.action="login_ok.php";
		f.submit();
	}
}
</script>

  <div class="login-wrap">
    <h1>
      <a href="../index.php">우정넷 WOOJUNGNET</a>
    </h1>
    <div class="login-box">
      <h2>로그인 Login</h2>
      <p class="description">로그인 후 이용가능합니다.</p>
      <form name="cform" method="post" enctype="multipart/form-data" target="HiddenFrm">
            <input type="text" class="input-custom" placeholder="아이디를 입력하세요" name="user_id">
            <input type="password" class="input-custom" placeholder="비밀번호를 입력하세요" name="user_pass">

            <div class="btn-wrap">
              <button type="button" onclick="login();">로그인</button>
            </div>
      </form>
    </div>
    <div class="copyright">
      홈페이지 상담 : TEL. 1899-3840/02-2601-6569~70 (주말, 공휴일 휴무)
    </div>

    <footer style="margin-top:60px;">
      <a href="/sub05" class="banner">
        <p>홈페이지제작 견적문의 
          <span class="tag">바로가기</span>
        </p>
      </a>
    </footer>
  </div>
</body>
</html>


