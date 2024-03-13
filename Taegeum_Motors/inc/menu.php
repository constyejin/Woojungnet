<header class="global-header">
    <!-- <header class="bg-white"> SUB의 경우 -->
    <!-- <div class="dim"></div> -->

    <!-- gnb -->
    <div class="gnb">
        <div class="notice">
            <div class="prefix">
                <div class="gnb_notice">
                    <?= $config[noti] ?>
                </div>
            </div>
            <div class="suffix">
                <?php if ($loginUsort == "admin" || $loginUsort == "admin1" || $loginUsort == "admin2" || $loginUsort == "admin3" || $loginUsort == "superadmin" || $loginUsort == "jisajang2") { ?>
                <a href="javascript:ad();" class="link-manage">[관리자모드]</a>
                <? } ?>
                <?php if ($loginId && $loginPw) {  ?>
                <span class="user-name">
                    <?= $loginName ?>님
                </span>
                <? } ?>
                <ul class="login-wrap">
                    <?php if ($loginId && $loginPw) {  ?>
                    <li>
                        <a href="/mypage/sub04.php" class="btn btn-sm btn-primary btn-round">마이페이지</a>
                    </li>
                    <li>
                        <a href="/login/loginProc.php?logMode=logout" class="btn btn-sm btn-outline-gray btn-round login">
                            로그아웃
                        </a>
                    </li>
                    <? } else { ?>
                    <li>
                        <a href="/login/terms.php" class="btn btn-sm btn-primary btn-round">회원가입</a>
                    </li>
                    <li>
                        <a href="/login/login.php" class="btn btn-sm btn-primary btn-round login">
                            로그인
                        </a>
                    </li>
                    <? } ?>
                </ul>
            </div>
        </div>
    </div>
    <!-- // gnb -->
    <!-- nav -->
    <nav class="nav">
        <div class="nav-menu">
            <h1 class="logo">
                <img src="/images/front/main_logo.png" class="logo-black" alt="태금모터스 로고" onClick="location.href='/';">
            </h1>
            <ul class="nav-list depth-01">
                <? if ($loginId) { ?>
                <li><a href="/sub01/sub01_1.php"><span class="item">차량등록</span></a></li>
                <li><a href="/sub02/sub02_1.php?gubun2=2"><span class="item">보험경공매</span></a></li>
                <li><a href="/sub03/sub03_1.php?gubun2=3"><span class="item">스페셜매물</span></a></li>
                <li><a href="/sub04/sub04_1.php?gubun2=4"><span class="item">일반경공매</span></a></li>
                <li><a href="/sub05/sub05_1.php"><span class="item">종료차량</span></a></li>
                <? } else { ?>
                <li><a href="javascript:alert('로그인후 사용 가능합니다.');location.href='/login/login.php';"><span
                            class="item">차량등록</span></a></li>
                <li><a href="javascript:alert('로그인후 사용 가능합니다.');location.href='/login/login.php';"><span
                            class="item">보험경공매</span></a></li>
                <li><a href="javascript:alert('로그인후 사용 가능합니다.');location.href='/login/login.php';"><span
                            class="item">스페셜매물</span></a></li>
                <li><a href="javascript:alert('로그인후 사용 가능합니다.');location.href='/login/login.php';"><span
                            class="item">일반경공매</span></a></li>
                <li><a href="javascript:alert('로그인후 사용 가능합니다.');location.href='/login/login.php';"><span
                            class="item">종료차량</span></a></li>
                <? } ?>
                <li><a href="/sub07/sub07_1.php"><span class="item">중고차량</span></a></li>
                <li><a href="/sub08/sub08_1.php"><span class="item">부품차량</span></a></li>
                <li><a href="/board/board.php?id=notice"><span class="item">고객센터</span></a></li>
            </ul>
        </div>
        
    </nav>
    <!-- //nav -->
</header>
