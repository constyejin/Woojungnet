<?
if($agree1!="Y"){
	echo "<script>location.href='/login/terms.php';</script>";
}
?>
<!DOCTYPE HTML>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<title>회원가입 | 정보입력</title>
    <!-- jquery  -->
    <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>

    <!-- incaron css -->
    <link rel="stylesheet" type="text/css" href="/common/css/incaron_style.css"/>

    <!-- 인카론 UI js -->
    <script src="/common/js/incaron_ui.js"></script>
	<script>
	function check_ID_Window() { 
		var f = document.join; 
		document.getElementById("u_id_check").innerHTML="";
		if((f.userId.value.length > 12) || (f.userId.value.length < 6)){
			f.idchk_value.value="0";
			document.getElementById("u_id_check").innerHTML="[사용불가]";
		}else{ 
			f.action="join_id_check.php";
			f.target="iFrm";
			f.submit();
		}
	} 
	function check_nicname_Window() {
		var f = document.join;
		if((f.userNick2.value.length < 2) || (f.userNick2.value.length > 12)){
			f.nicchk_value.value="0";
			document.getElementById("u_nicname_check").innerHTML="[사용불가]";
		}else{
			f.action="join_nicname_chk1.php";
			f.target="iFrm";
			f.submit();
		}
	} 
	function join_submit(){
		var frm = document.join;

		if(!frm.user_name2.value){
			alert("회원성명 입력해주세요");
			frm.user_name2.focus();
			return false;
		}else if(!frm.userId.value){		
			alert("아이디를 입력해주세요");
			frm.userId.focus();
			return false;
		}else if(frm.idchk_value.value == 0){
			alert("아이디 중복확인해주세요");
			return false;
		}else if(!frm.userNick2.value){
			alert("닉네임을 입력해주세요");
			frm.userNick2.focus();
			return false;
		}else if(frm.nicchk_value.value == 0){
			alert("닉네임 중복확인해주세요");
			return false;
		}else if(!frm.userPw1.value){
			alert("비밀번호를 입력해주세요");
			frm.userPw1.focus();
			return false;
		}else if(!frm.userPw2.value){
			alert("비밀번호 확인을 입력해주세요");
			frm.userPw2.focus();
			return false;
		}else if(frm.userPw1.value != frm.userPw2.value){
			alert("비밀번호와 비밀번호 확인이 맞지 않습니다. 다시 확인해주세요!");
			return false;
		}else if(!frm.pcs1.value || !frm.pcs2.value || !frm.pcs2.value){
			alert("휴대폰 번호를 입력해주세요");			
			frm.pcs1.focus();
			return false;
		}else if(!frm.company_name.value){
			alert("업체명(상호)을 입력해주세요");		
			frm.company_name.focus();
			return false;
		}else if(!frm.czipcode.value||!frm.caddress.value){
			alert("사업장주소를 입력해주세요");		
			frm.caddress.focus();
			return false;
		}else {
			frm.action="join_check.php";
			frm.submit();
		}
	}
	</script>
<script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
<script>
	function openDaumPostcode() {
       new daum.Postcode({
            oncomplete: function(data) {
                var fullAddr = ''; // 최종 주소 변수
                var extraAddr = ''; // 조합형 주소 변수
                if (data.userSelectedType === 'R') { // 사용자가 도로명 주소를 선택했을 경우
                    fullAddr = data.roadAddress;
                } else { // 사용자가 지번 주소를 선택했을 경우(J)
                    fullAddr = data.jibunAddress;
                }
                if(data.userSelectedType === 'R'){
                    if(data.bname !== ''){
                        extraAddr += data.bname;
                    }
                    if(data.buildingName !== ''){
                        extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
                    }
                    fullAddr += (extraAddr !== '' ? ' ('+ extraAddr +')' : '');
                }

				document.join.zipcode.value = data.zonecode; 
				document.join.address.value = data.address;
				document.join.address_ext.focus();
            }
        }).open();
    }
	function openDaumPostcode2() {
       new daum.Postcode({
            oncomplete: function(data) {
                var fullAddr = ''; // 최종 주소 변수
                var extraAddr = ''; // 조합형 주소 변수
                if (data.userSelectedType === 'R') { // 사용자가 도로명 주소를 선택했을 경우
                    fullAddr = data.roadAddress;
                } else { // 사용자가 지번 주소를 선택했을 경우(J)
                    fullAddr = data.jibunAddress;
                }
                if(data.userSelectedType === 'R'){
                    if(data.bname !== ''){
                        extraAddr += data.bname;
                    }
                    if(data.buildingName !== ''){
                        extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
                    }
                    fullAddr += (extraAddr !== '' ? ' ('+ extraAddr +')' : '');
                }

				document.join.czipcode.value = data.zonecode; 
				document.join.caddress.value = data.address;
				document.join.caddress_ext.focus();
            }
        }).open();
    }

</script>
  </head>
  <body>
<iframe name="AdminFrm" id="AdminFrm" style="display:none;"></iframe>
<iframe name="iFrm" id="iFrm" width=0 height=0 src="about:blank"></iframe>
    <div class="sign-in">
      <div class="container">
        <div class="gnb-header">
          <img src="/images/front/join_logo.png" alt="SKRCAUTO 로고" onClick="location.href='/';">
          <div class="step-wrap">
            <ul>
              <li>
                <span class="step">약관동의</span>
              </li>
              <li class="on">
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
		<form name="join"  method="post" target="AdminFrm">
		<input type='hidden' name='hiddenPost' id='hiddenPost'>
		<input type="hidden" value="0" name="idchk_value">
		<input type="hidden" value="0" name="nicchk_value">
		<input type="hidden" value="0" name="select_company_name">
		<input type="hidden" name="Mode" value="premium">
		<input type="hidden" name="idx" value="<?=$idx?>">
        <div class="header">
          <h2>기본정보</h2>
          <p class="sub-text">
            입찰회원은 아래 내용을 정확히 기록하여 주십시요.
          </p>
        </div>
        <div class="form-table">
          <ul>
            <li>
              <div class="label">이름(담당자)</div>
              <div class="data">
                <div class="input-wrap">
                  <input type="text" name="user_name2">
                </div>
                <p class="notice-text">실무업무담당자명을 기록하여 주십시요.</p>
              </div>
            </li>
            <li>
              <div class="label">아이디</div>
              <div class="data">
                <div class="input-wrap">
                  <input type="text" name="userId">
                </div>
                <button class="btn btn-round btn-secondary btn-sm" onClick="check_ID_Window();">중복확인</button>
                <p class="status-text" id="u_id_check"></p>
                <p class="notice-text">6~12자의 영문, 숫자만 가능.</p>
              </div>
            </li>
            <li>
              <div class="label">닉네임(별명)</div>
              <div class="data">
                <div class="input-wrap">
                  <input type="text" name="userNick2">
                </div>
                <button class="btn btn-round btn-secondary btn-sm" onClick="check_nicname_Window();">중복확인</button>
                <p class="status-text" id="u_nicname_check"></p>
                <p class="notice-text">게시판이용시 사용됩니다.</p>
              </div>
            </li>
            <li>
              <div class="label">비밀번호</div>
              <div class="data">
                <div class="input-wrap">
                  <input type="password" name="userPw1">
                </div>
                <p class="notice-text">4~18자 영어,숫자 특수기호 사용가능</p>
              </div>
            </li>
            <li>
              <div class="label">비밀번호확인</div>
              <div class="data">
                <div class="input-wrap">
                  <input type="password" name="userPw2">
                </div>
              </div>
            </li>
            <li>
              <div class="label">대표전화</div>
              <div class="data">
                <div class="input-group phone">
                  <div class="input-wrap">
                    <input type="text" name="tel1" maxlength="4">
                  </div>
                  <div class="dash">-</div>
                  <div class="input-wrap">
                    <input type="text" name="tel2" maxlength="4">
                  </div>
                  <div class="dash">-</div>
                  <div class="input-wrap">
                    <input type="text" name="tel3" maxlength="4">
                  </div>
                </div>
              </div>
            </li>
            <li>
              <div class="label">일반전화</div>
              <div class="data">
                <div class="input-group phone">
                  <div class="input-wrap">
                    <input type="text" name="company_tel1" maxlength="4">
                  </div>
                  <div class="dash">-</div>
                  <div class="input-wrap">
                    <input type="text" name="company_tel2" maxlength="4">
                  </div>
                  <div class="dash">-</div>
                  <div class="input-wrap">
                    <input type="text" name="company_tel3" maxlength="4">
                  </div>
                </div>
              </div>
            </li>
            <li>
              <div class="label">휴대전화</div>
              <div class="data">
                <div class="input-group phone">
                  <div class="input-wrap">
                    <input type="text" name="pcs1" maxlength="4">
                  </div>
                  <div class="dash">-</div>
                  <div class="input-wrap">
                    <input type="text" name="pcs2" maxlength="4">
                  </div>
                  <div class="dash">-</div>
                  <div class="input-wrap">
                    <input type="text" name="pcs3" maxlength="4">
                  </div>
                </div>
              </div>
            </li>
            <li>
              <div class="label">팩스번호</div>
              <div class="data">
                <div class="input-group phone">
                  <div class="input-wrap">
                    <input type="text" name="fax1" maxlength="4">
                  </div>
                  <div class="dash">-</div>
                  <div class="input-wrap">
                    <input type="text" name="fax2" maxlength="4">
                  </div>
                  <div class="dash">-</div>
                  <div class="input-wrap">
                    <input type="text" name="fax3" maxlength="4">
                  </div>
                </div>
              </div>
            </li>
            <li>
              <div class="label">이메일</div>
              <div class="data">
                <div class="input-wrap w-238">
                  <input type="text" name="email1">
                </div>
              </div>
            </li>
          </ul>
        </div>
        
        <div class="header">
          <h2>회사정보</h2>
          <p class="sub-text">
          </p>
        </div>
        <div class="form-table">
          <ul>
            <li>
              <div class="label">업체명(상호)</div>
              <div class="data">
                <div class="input-wrap w-238">
                  <input type="text" name="company_name">
                </div>
              </div>
            </li>
            <li>
              <div class="label">대표자명</div>
              <div class="data">
                <div class="input-wrap w-238">
                  <input type="text" name="ceo_name">
                </div>
              </div>
            </li>
            <li>
              <div class="label">사업자번호</div>
              <div class="data">
                <div class="input-group biz-number">
                  <div class="input-wrap">
                    <input type="text" name="company_no1" maxlength="3">
                  </div>
                  <div class="dash">-</div>
                  <div class="input-wrap">
                    <input type="text" name="company_no2" maxlength="2">
                  </div>
                  <div class="dash">-</div>
                  <div class="input-wrap">
                    <input type="text" name="company_no3" maxlength="5">
                  </div>
                </div>
              </div>
            </li>
            <li>
              <div class="label">법인등록번호</div>
              <div class="data">
                <div class="input-group corporation-number">
                  <div class="input-wrap">
                    <input type="text" name="ceo_ssn1" maxlength="6">
                  </div>
                  <div class="dash">-</div>
                  <div class="input-wrap">
                    <input type="text" name="ceo_ssn2" maxlength="7">
                  </div>
                </div>
              </div>
            </li>
            <li>
              <div class="label">업태</div>
              <div class="data">
                <div class="input-wrap w-238">
                  <input type="text" name="company_sort">
                </div>
              </div>
            </li>
            <li>
              <div class="label">종목</div>
              <div class="data">
                <div class="input-wrap w-238">
                  <input type="text" name="company_subsort">
                </div>
              </div>
            </li>
            <li>
              <div class="label">사업장주소</div>
              <div class="data">
                <div class="post-number">
                  <div class="input-wrap">
                    <input type="text" name="czipcode">
                  </div>
                  <button class="btn btn-round btn-secondary btn-sm" onClick="openDaumPostcode2()">우편번호 찾기</button>
                </div>
                <div class="address">
                  <div class="input-wrap">
                    <input type="text" name="caddress">
                  </div>
                  <div class="input-wrap">
                    <input type="text" name="caddress_ext">
                  </div>
                </div>
              </div>
            </li>
            <li>
              <div class="label">업종구분</div>
              <div class="data">
                <div class="input-wrap">
                  <select name="upjong" id="">
                    <option value="">::업종구분::</option>
					<option value="폐차업자" >폐차업자</option>
					<option value="자동차정비">자동차정비</option>
					<option value="중고부품업">중고부품업</option>
					<option value="자동차무역">자동차무역</option>
					<option value="매매상사">매매상사</option>
					<option value="딜러" >딜러</option>
					<option value="기타">기타</option>
                  </select>
                </div>
              </div>
            </li>
          </ul>
        </div>

        <div class="ask-agree">
          <div class="question">
            <p>
              당사에서 발송하는 정보를 문자나 이메일로 수신하시겠습니까?
            </p>
          </div>
          <div class="answer">
            <ul>
              <li>
                <input type="radio" name="emailSend" id="agree" value="yes" checked>
                <label for="agree">예</label>
              </li>
              <li>
                <input type="radio" name="emailSend" id="disAgree" value="no">
                <label for="disAgree">아니오</label>
              </li>
            </ul>
          </div>
        </div>

        <div class="btn-wrap submit">
          <button class="btn btn-md btn-wide btn-primary" onClick="join_submit()">회원가입 신청</button>
        </div>
</form>
      </div>
    </div>
    <?
      include $_SERVER['DOCUMENT_ROOT']."/inc/bottom.php";
    ?>
  </body>
</html>
