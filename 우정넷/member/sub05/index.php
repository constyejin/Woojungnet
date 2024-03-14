<? include $_SERVER['DOCUMENT_ROOT']."/inc/header.php";?>
<?
$rand=mt_rand(1000000,9999999);
?>

<script>
function wr(){
	f=document.cform;
	if(f.spam_text.value!="<?=$rand?>"){
		alert("스팸방지 코드를 확인해 주세요.");
	}else if(f.ch1.checked==false){
		alert("개인정보 취급방침에 동의해 주세요.");
	}else{
		f.action="est_save.php";
		f.submit();
	}
}
</script>

  <div class="gnb">
    <div class="container">
      <div class="prefix">
        <h1><a href="../index.php">우정넷 WOOJUNGNET</a></h1>
      </div>
      <div class="suffix">
        <? if($_SESSION[user_id]){ ?>
                <a href="/admin/sub04/sub01.php" class="btn-manage">관리자모드</a>
        <? } ?>
        <? if($_SESSION[user_id]){ ?>
                <span class="user"><?=$_SESSION[user_name]?>님</span>
        <? } ?>
                <ul class="links">
                  <li><a href="/sub05/">견적문의</a></li>
        <? if($_SESSION[user_id]){ ?>
                  <li><a href="/member/logout.php">로그아웃</a></li>
        <? }else{ ?>
                  <li><a href="/member/login.php">로그인</a></li>
        <? } ?>
        </ul>
      </div>
    </div>
  </div>
  <div class="header">
    <div class="main-visaul">
      <img src="/img/main1.png" alt="메인 슬라이드 이미지">
    </div>
    <div class="nav">
      <ul>
        <li class="on"><a href="/">우정넷</a></li>
        <li><a href="">홈페이지제작</a></li>
        <li><a href="">유지보수</a></li>
        <li><a href="">웹호스팅</a></li>
        <li>언제든지 연락주세요 ☎ 1899-3840 / 02-2601-6569</li>
      </ul>
    </div>
  </div>
  <div class="content join">
    <div class="container">
      <h2>홈페이지제작 견적문의</h2>
      <p class="sub-phrase">아래 내용을 기재하시면 당사에서 신속하게 연락을 드리겠습니다 </p>

      <form name="cform" method="post" enctype="multipart/form-data" target="HiddenFrm">
            <div class="join-form">
              <ul>
                <li>
                  <div class="th">
                    이름
                  </div>
                  <div class="td">
                    <input type="text" class="input-custom md" name="est_name">
                  </div>
                </li>
                <li>
                  <div class="th">
                    휴대전화
                  </div>
                  <div class="td">
                    <div class="phone">
                      <input type="text" maxlength="3" class="input-custom" name="est_mobile1">
                      <span>-</span>
                      <input type="text"  maxlength="4" class="input-custom" name="est_mobile2">
                      <span>-</span>
                      <input type="text" maxlength="4" class="input-custom" name="est_mobile3">
                    </div>
                  </div>
                </li>
                <li>
                  <div class="th">
                    홈페이지용도
                  </div>
                  <div class="td">
                    <div class="radio-list">  
                      <ul>
                        <li>
                          <input type="radio" name="type1" value="1" id="category1" class="radio-custom" checked>
                          <label for="category1">회사용</label>
                        </li>
                        <li>
                          <input type="radio" name="type1" value="2" id="category2" class="radio-custom">
                          <label for="category2">홍보용</label>
                        </li>
                        <li>
                          <input type="radio" name="type1" value="3" id="category3" class="radio-custom">
                          <label for="category3">교육용</label>
                        </li>
                        <li>
                          <input type="radio" name="type1" value="4" id="category4" class="radio-custom">
                          <label for="category4">쇼핑몰</label>
                        </li>
                        <li>
                          <input type="radio" name="type1" value="5" id="category5" class="radio-custom">
                          <label for="category5">기타</label>
                        </li>
                      </ul>
                    </div>
                  </div>
                </li>
                <li>
                  <div class="th">
                    예상비용
                  </div>
                  <div class="td">
                    <input type="text" class="input-custom md" name="pay">
                    <span>원</span>
                  </div>
                </li>
                <li>
                  <div class="th">
                    질문유형
                  </div>
                  <div class="td">
                    <div class="radio-list">
                      <ul>
                        <li>
                          <input type="radio" name="type2" value="1" id="question1" class="radio-custom" checked>
                          <label for="question1">홈페이지제작</label>
                        </li>
                        <li>
                          <input type="radio" name="type2" value="2" id="question2" class="radio-custom">
                          <label for="question2">유지보수</label>
                        </li>
                        <li>
                          <input type="radio" name="type2" value="3" id="question3" class="radio-custom">
                          <label for="question3">서버호스팅</label>
                        </li>
                        <li>
                          <input type="radio" name="type2" value="4" id="question4" class="radio-custom">
                          <label for="question4">웹호스팅</label>
                        </li>
                      </ul>
                    </div>
                  </div>
                </li>
                <li>
                  <div class="th">
                    참고사이트1
                  </div>
                  <div class="td">
                    <input type="text" class="input-custom" name="site1">
                  </div>
                </li>
                <li>
                  <div class="th">
                    참고사이트2
                  </div>
                  <div class="td">
                    <input type="text" class="input-custom" name="site2">
                  </div>
                </li>
                <li>
                  <div class="th">
                    참고사이트3
                  </div>
                  <div class="td">
                    <input type="text" class="input-custom" name="site3">
                  </div>
                </li>
                <li>
                  <div class="th">
                    문의사항
                  </div>
                  <div class="td">
                    <textarea type="text" class="input-custom" rows="5" cols="20" name="memo"></textarea>
                  </div>
                </li>
                <li>
                  <div class="th">
                    <span>스팸방지</span>
                    <span style="float:right; color:red">좌측 숫자를 입력하여주세요.</span>
                  </div>
                  <div class="td">
                    <div class="spam">
                      <input type="text" class="input-custom" value="<?=$rand?>" disabled>
                      <input type="text" class="input-custom" name="spam_text">
                    </div>
                  </div>
                </li>
              </ul>
            </div>

            <div class="privacy">
              <h3>개인정보처리방침</h3>
              <div class="term-box">
                <div class="term-content">
                  당사는 원활한 고객상담,각종서비스의 제공을 위해 아래와 같은 개인정보를 수집하고 있습니다

                  [가]수집하는 개인정보의 항목 : 이름 , 연락처(휴대전화)

                  [나]수집하는 개인정보의 수집방법 : 자발적으로 온라인상에서 기재하는 방법으로 수집합니다
                  당사는 원활한 고객상담,각종서비스의 제공을 위해 아래와 같은 개인정보를 수집하고 있습니다

                  [가]수집하는 개인정보의 항목 : 이름 , 연락처(휴대전화)

                  [나]수집하는 개인정보의 수집방법 : 자발적으로 온라인상에서 기재하는 방법으로 수집합니다
                  당사는 원활한 고객상담,각종서비스의 제공을 위해 아래와 같은 개인정보를 수집하고 있습니다

                  [가]수집하는 개인정보의 항목 : 이름 , 연락처(휴대전화)

                  [나]수집하는 개인정보의 수집방법 : 자발적으로 온라인상에서 기재하는 방법으로 수집합니다
                </div>
                <div class="agree-wrap">
                  <input type="checkbox" name="ch1" id="ch1">
                  <label for="agree-chk">개인정보처리방침에 동의합니다.</label>
                </div>
              </div>
            </div>

            <div class="btn-wrap">
              <button type="button" onclick="wr()">견적문의</button>
            </div>
      </form>
	  </div>
  </div>
  
  <footer>
    <div class="container">
        <? if($_SESSION[user_id]){ ?>
      <p onclick="location.href='/admin/sub04/sub01.php';">[관리자모드]</p>
        <? } ?>
      <div class="logo">
        <h1>
          <span>우정넷</span>
          <span>WOOJUNGNET</span>
        <? if($_SESSION[user_id]){ ?>
          <a href="/member/logout.php" class="link-to-pc">로그아웃</a>
        <? }else{ ?>
          <a href="/member/login.php" class="link-to-pc">로그인</a>
        <? } ?>
        </h1>
      </div>
      <div class="info">
        <div>문의: 1899-3840/02-2601-6569~70  팩스: 02)2601-6691 | 이메일: drg1038@naver.com</div>
        <div>상호: 우정넷 ㅣ 사업자번호: 152-25-00212  |  대표: 권이수  ㅣ  주소: 서울 강서구 화곡로185 서안이지텔 505호</div>
      </div>
    </div>
  </footer>
  <div class="banner sm-only">
    <a href="/sub05">
      <p>홈페이지제작 견적문의
        <span class="tag">바로가기</span>
      </p>
    </a>
  </div>
</body>
</html>
