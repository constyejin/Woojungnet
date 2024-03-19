<? include $_SERVER['DOCUMENT_ROOT']."/inc/header.php"; ?>
<link rel="stylesheet" href="/inc/styles/login.css">

<main class="login">
  <div class="login-wrap">
    <div>
      <h2>로그인 <span>Login</span></h2>
      <p class="login-sub-txt">관리자전용 로그인페이지 입니다.</p>
      <form name="wform" method="post" enctype="multipart/form-data" target="HiddenFrm" onsubmit="login_check();">
        <input type="hidden" name="idx" value="<?=$idx?>">
        <input type="hidden" name="p_url" value="<?=$_SERVER['HTTP_REFERER'] ?>">
        <div>
          <div class="input-wrap">
            <input type="text" name="login_id" placeholder="아이디를 입력하세요">
          </div>
          <div class="input-wrap">
            <input type="password" name="login_pass" placeholder="비밀번호를 입력하세요">
          </div>
          <button class="btn-blue-lg" type="submit">로그인</button>
        </div>
      </form>
    </div>
  </div>
</main>

<? include $_SERVER['DOCUMENT_ROOT']."/inc/footer.php"; ?>
<? include $_SERVER['DOCUMENT_ROOT']."/inc/quick.php"; ?>
