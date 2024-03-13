<?
include $_SERVER['DOCUMENT_ROOT']."/inc/header.php";
include $_SERVER['DOCUMENT_ROOT']."/inc/menu.php";
?>
  <div class="login">
    <div class="visual">
      <p class="title">
        보험사잔존물경공매!! 매매!! 부품수출!!<br> 
        (주)태금모터스에서 입찰경매를 시작하세요!!
      </p>
      <p class="sub-text">
        보험사잔존물,사고차, 매매,가치평가! 신속하고  공정하게 안전한서비스를 제공합니다.
      </p>
    </div>
    <div class="container">
      <h2>로그인 <span class="en">Login</span></h2>
  
<form name="loginForm" method="post" action="/login/login_check.php" target="AdminFrm" >
<input type="hidden" name="logMode" value="login">
     <div class="input-wrap">
        <input type="text" name="userId" placeholder="아이디를 입력하세요">
      </div>
      <div class="input-wrap">
        <input type="password" name="userPw" placeholder="비밀번호를 입력하세요">
      </div>
      
      <button class="submit btn btn-primary btn-md btn-wide">로그인</button>
</form>  
  
      <div class="link">
        <ul>
          <li>
            <a href="/login/sign_in.php" class="btn-link">회원가입</a>
          </li>
          <li>
            <a href="/login/find_id_pw.php" class="btn-link">아이디/비번찾기</a>
          </li>
        </ul>
      </div>
    </div>
  </div>
<?
include $_SERVER['DOCUMENT_ROOT']."/inc/footer.php";
?>
</body>
</html>