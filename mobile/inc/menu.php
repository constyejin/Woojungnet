  <header class="sub">
      <?php if ($loginId) {  ?>
      <div class="topper">
          <div class="user-name"><?= $_SESSION["company_name"] ?> | <?= $loginName ?></div>
          <div class="login-wrap">
              <button class="btn btn-primary btn-round" onclick="location.href='/mypage/sub04.php';">마이페이지</button>
              <button class="btn btn-gray btn-round login"
                  onclick="location.href='/login/loginProc.php?logMode=logout';">로그아웃</button>
          </div>
      </div>
      <?php } ?>
      <div class="align-c logo">
          <a href="" class="btn-all-menu"></a>
          <h1>
      <?php if ($loginId) {  ?>
              <img src="/images/m_logo.png" class=" taegeum-logo" alt="태금모터스로고"
                  onclick="location.href='/sub02/sub02_1.php';">
      <?php }else{  ?>
              <img src="/images/m_logo.png" class="taegeum-logo" alt="태금모터스로고"
                  onclick="location.href='/';">
      <?php }  ?>
          </h1>
      </div>
  </header>
  <nav class="all-menu">
      <div class="header">
          <span class="logo">(주)태금모터스</span>
          <a href="" class="btn-close-menu"></a>
      </div>
      <ul class="menu-list">
          <li><a href="/sub02/sub02_1.php?gubun2=2">보험경공매</a></li>
          <li><a href="/sub03/sub03_1.php?gubun2=3">스페셜매물</a></li>
          <li><a href="/sub04/sub04_1.php?gubun2=4">일반경공매</a></li>
          <li><a href="/sub07/sub07_1.php">중고차량</a></li>
          <li><a href="/sub08/sub08_1.php">부품차량</a></li>
          <!--li><a href="/sub01/sub01_1.php">차량등록</a></li-->
          <li><a href="/sub01/sub01_2.php">사진추가</a></li>
          <li><a href="/sub01/sub01_3.php">상담신청</a></li>
          <li><a href="/board/board.php">공지사항</a></li>
          <!--li><a href="/mypage/sub04.php">마이페이지</a></li> 
      <li><a href="/mypage/sub07.php">회원정보수정</a></li> 
      <li><a href="/company/company.php">인사말</a></li-->
      </ul>
  </nav>
  <nav class="nav">
      <ul>
          <li><a href="/sub02/sub02_1.php?gubun2=2">보험경공매</a></li>
          <li><a href="/sub03/sub03_1.php?gubun2=3">스페셜매물</a></li>
          <li><a href="/sub04/sub04_1.php?gubun2=4">일반경공매</a></li>
          <li><a href="/sub07/sub07_1.php">중고차량</a></li>
          <li><a href="/sub08/sub08_1.php">부품차량</a></li>
          <!--li><a href="/board/board.php">고객센터</a></li-->
      </ul>
  </nav>