<!DOCTYPE HTML>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<title>회원가입 | 약관동의</title>
    <!-- jquery  -->
    <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>

    <!-- incaron css -->
    <link rel="stylesheet" type="text/css" href="/common/css/incaron_style.css"/>

    <!-- 인카론 UI js -->
    <script src="/common/js/incaron_ui.js"></script>
	<script>
	function join_submit(){
		f=document.join;
		if(join.agree1.checked==false){
			alert('개인정보처리방침에 동의해 주세요');
			return false;
		}else{
			f.action="sign_in.php";
			f.submit();
		}
	}
	</script>
  </head>
  <body>
    <?
      include $_SERVER['DOCUMENT_ROOT']."/inc/menu.php";
    ?>
    <div class="sign-in">
<form name="join"  method="post" onSubmit="return join_submit()">
	  <div class="container">
        <div class="gnb-header">
          <!--h1><span class="incaron-logo" onClick="location.href='/';"></span></h1-->
          <div class="step-wrap">
            <ul>
              <li class="on">
                <span class="step">약관동의</span>
              </li>
              <li>
                <span class="step">정보입력</span>
              </li>
              <li>
                <span class="step">가입완료</span>
              </li>
              <li>
                <span class="step">승인처리</span>
              </li>
            </ul>
          </div>
        </div>

        <div class="term-introduce">
          <p class="title">
            (주)태금모터스 회원으로 가입하시면<br>
            다양한 온라인 경·공매 서비스를 이용하실 수 있습니다.
          </p>
          <p class="description">
            손해보험사, 공제조합, 기타 제휴업체나 기관등 자동차취급 업종 종사자 및 사업자만 가능합니다. 경,공매에 참여하고자 하는 경우는 당사의 가입절차와 신청양식등에 필요한 서류를 우편,메일,팩스등으로 신청하시면 확인절차를 거쳐 승인됩니다.(입찰승인)    또한 폐차와 명의이전 또는 폐차/이전에 각각 권한이 부여됩니다.(당사 규정에 따라 보증금 및 입회비가 청구되는 경우도 있습니다.)
          </p>
        </div>

        <div class="term-wrap">
          
          <div class="terms-text">
            <p class="title">개인정보수집</p>
            <ul>
              <li>
                <div class="label">수집항목</div>
                <div class="data">이름, ID, 비밀번호, 이메일, 전화번호, 휴대폰번호, 주소, 회사정보 등</div>
              </li>
              <li>
                <div class="label">이용목적</div>
                <div class="data">
                  서비스이용에 대한 계약이행 및 요금정산, 회원서비스이용 및 본인확인, 개인식별, 불량회원의 부정이용방지, 가입의사확인, 만 14세미만 아동 개인정보수집시 법정대리인 동의여부 확인.
                </div>
              </li>
              <li>
                <div class="label">정보공개</div>
                <div class="data">법령에 의한것이 아닌 경우를 제외하고 일체의 외부공개나 위탁을 하지 않습니다.</div>
              </li>
              <li>
                <div class="label">보유기간</div>
                <div class="data">원칙적으로, 개인정보 수집 및 이용목적이 달성된 후에는 해당 정보를 지체 없이 파기합니다. 단, 관계법령의 규정에 의하여 보존할 필요가 있는 경우 회사는 아래와 같이 관계법령에서 정한 일정한 기간동안 회원정보를 보관합니다.
                  <ul class="circle-list">
                    <li>
                      보존기간: 3년(이용자가 계속하여 이용중인 경우는 회원탈퇴시까지 보존됩니다.)
                    </li>
                    <li>
                      계약 또는 청약철회 등에 관한 기록: 5년(전자상거래등에서의 소비자보호에 관한 법률)
                    </li>
                    <li>
                      대금결제 및 재화 등의 공급에 관한 기록: 5년(전자상거래등에서의 소비자보호에 관한 법률)
                    </li>
                    <li>
                      소비자의 불만 또는 분쟁처리에 관한 기록: 3년(전자상거래등에서의 소비자보호에 관한 법률)
                    </li>
                  </ul>
                </div>
              </li>
            </ul>
          </div>
          <div class="agree">
            <div class="checkbox-wrap">
              <input type="checkbox" id="agree" name="agree1" value="Y">
            </div>
            <label for="agree">
              개인정보처리방침에 동의합니다.
            </label>
            
          </div>
        </div>


        <div class="btn-wrap next">
          <button class="btn btn-md btn-wide btn-primary">다음</button>
        </div>
</form>
      </div>
    </div>
    <?
      include $_SERVER['DOCUMENT_ROOT']."/inc/bottom.php";
    ?>
  </body>
</html>
