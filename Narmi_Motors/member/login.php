<?
include "../inc/header.php";
include "../inc/menu_sub.php";

if($_SESSION[login_idx]){
	goto_url('/');
}
?>
  <div class="content-wrap sub login">
    <div class="login-wrap">
      <div class="metropolis">
        <h2>
          <img src="/front/src/image/icon_logo_login.png" alt="로고">
          관리자 로그인
        </h2>
<form name="wform" method="post" enctype="multipart/form-data" target="HiddenFrm" onsubmit="login_check();">
<input type="hidden" name="idx" value="<?=$idx?>">
<input type="hidden" name="p_url" value="<?=$_SERVER['HTTP_REFERER'] ?>">
        <div class="account-wrap">
          <div class="left-side"></div>
          <div class="right-side">
            <p class="notice">로그인을 하신 수 이용하실 수 있습니다.</p>
            <div class="vertical-group">
              <div class="input-wrap">
                <input type="text" placeholder="아이디를 입력해주세요" name="login_id">
              </div>
              <div class="input-wrap">
                <input type="password" placeholder="패스워드를 입력해주세요" name="login_pass">
              </div>
            </div>
            <button class="btn btn-gray wide" >로그인</button>
          </div>
        </div>
</form>
      </div>
    </div>
  </div>
<?
include "../inc/footer.php";
?>
