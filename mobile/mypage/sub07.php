<?
include $_SERVER['DOCUMENT_ROOT']."/inc/header.php";
include $_SERVER['DOCUMENT_ROOT']."/inc/menu.php";
if(!$loginId){
	echo "<script>alert('로그인후 사용 가능합니다.');history.back();</script>";
}

if($loginId && $loginPw) {
	

	$query = $db->query("select * from woojung_member where userId = '$loginId' limit 1");
	$row = mysql_fetch_object($query);
	
	if(!$mode)$usort_ins = $row->usort;
	else $usort_ins = $mode;
	

	$ssn_arr = explode('-',$row->ssn);
	$ssn1	 = $ssn_arr[0];
	$ssn2	 = $ssn_arr[1];
	
	$post = $row->post1.'-'.$row->post2;

	$tel_arr = explode('-',$row->tel);
	$tel1	 = $tel_arr[0];
	$tel2	 = $tel_arr[1];
	$tel3	 = $tel_arr[2];

	$pcs_arr = explode('-',$row->pcs);
	$pcs1	 = $pcs_arr[0];
	$pcs2	 = $pcs_arr[1];
	$pcs3	 = $pcs_arr[2];

	$dTel_arr = explode('-',$row->dTel);
	$dTel1	 = $dTel_arr[0];
	$dTel2	 = $dTel_arr[1];
	$dTel3	 = $dTel_arr[2];

	$email_arr = explode('@',$row->email);
	$email1	 = $email_arr[0];
	$email2	 = $email_arr[1];

	
	$idx = $row->idx;
	$usort = $row->usort;
	
	$team_name = $row->team_name;
	$team_subname = $row->team_subname;	 
	$team_code = $row->team_code;
	$company_name = $row->company_name;

	$company_no = $row->company_no;

	if($company_no){
		$company_no_arr = explode('-',$row->company_no);
		$company_no1	 = $company_no_arr[0];
		$company_no2	 = $company_no_arr[1];
		$company_no3	 = $company_no_arr[2];
	}

	$ceo_ssn = $row->ceo_ssn; // 대표 주민번호임

	if($ceo_ssn){
		$ceo_ssn_arr = explode('-',$row->ceo_ssn);
		$ceo_ssn1	 = $ceo_ssn_arr[0];
		$ceo_ssn2	 = $ceo_ssn_arr[1];
	
	}
	
	$company_sort = $row->company_sort;
	$company_subsort = $row->company_subsort; 

	
	
	$company_post = $row->company_post;

	if($company_post){
		$company_post_arr = explode('-',$row->company_post);
		$company_post1	 = $company_post_arr[0];
		$company_post2	 = $company_post_arr[1];
	
	}

	 

	
	if($row->emailSend == 'yes') $checkedyes = 'checked';
	else $checkedno = 'checked';
	$userMode = 'user_modify';
	$action = '../membership/user_regist.php';
	$nickCheck = 'yes';
	$idCheck = 'yes';
	
	$mode = $usort;
	$modes = substr($mode,0,4);

	
	$company_tel_arr = explode('-',$row->company_tel);
	$company_tel1	 = $company_tel_arr[0];
	$company_tel2	 = $company_tel_arr[1];
	$company_tel3	 = $company_tel_arr[2];

	$fax_arr = explode('-',$row->fax);
	$fax1	 = $fax_arr[0];
	$fax2	 = $fax_arr[1];
	$fax3	 = $fax_arr[2];


	
} else {
	$checkedyes = 'checked';
	$action = 'user_regist.php';
	$nickCheck = 'no';
	$idCheck = 'no';
	$userMode = 'user_regist';
	$usort_ins = $mode;
}
?>
<script>
	function change_form(){
		var frm = document.join;		
		if(!frm.userNick2.value){
			alert("닉네임을 입력해주세요");
			frm.userNick2.focus();
			return ;
		}
		
		if(frm.userNick2.value != '<?=$row->userNick?>'){
			if(frm.nicchk_value.value == 0){
				alert("닉네임 중복확인해주세요");
				return ;
			}
		}


		if(!frm.yuserPw.value){
			alert("현재 비밀번호를 입력해주세요");
			frm.yuserPw.focus();
			return ;
		}

		
		if(frm.userPw1.value){

			if(frm.userPw1.value != frm.userPw2.value){
				alert("새비밀번호와 새비밀번호 확인이 맞지 않습니다. 다시 확인해주세요!");
				frm.userPw1.focus();
				return ;
			}
		
		}

	
<? if($modes!='prem'){?>
		if(!frm.tel1.value || !frm.tel2.value || !frm.tel2.value){
			alert("전화번호를 입력해주세요");		
			frm.tel1.focus();
			return ;
		}

		if(!frm.email1.value){
			alert("이메일을 확인해주세요");		
			frm.email1.focus();
			return ;
		}

<?}?>

		frm.action="proc.php?Mode=<?=$mode?>";
		frm.submit();
		
	}

	function check_ID_Window(){		
		var frm = document.join;
		var id = frm.userId.value;
		
		if(!frm.userId.value){		
			alert("아이디를 입력해주세요");
			frm.userId.focus();
			return;
		}
		
		if(frm.userId.value.length <= 3 || frm.userId.value.length >= 15){
			alert("아이디는 3자 이상 15자 이하로 입력해주세요");
			frm.userId.focus();
			return;
		}	
		window.open("id_check.php?userId="+id,"","width=400, height=350");
	}
	
	function check_nicname_Window() {
		var f = document.join;
		if((f.userNick2.value.length < 2) || (f.userNick2.value.length > 12)){
			f.nicchk_value.value="0";
			document.getElementById("u_nicname_check").innerHTML="[사용불가]";
		}else{
			f.action="/member/join_nicname_chk1.php";
			f.target="iFrm";
			f.submit();
		}
	} 

</script>


  <section class="title-wrap">
    <h2>마이페이지</h2>
  </section>
  
  <section class="tab-wrap wide-type">
    <ul>
      <li class="tab">
        <a href="./sub04.php">입찰현황</a>
      </li>
      <li class="tab">
        <a href="./sub05.php">낙찰현황</a>
      </li>
      <li class="tab">
        <a href="./sub03.php">관심차량</a>
      </li>
      <li class="tab">
        <a href="./sub01.php">접수현황</a>
      </li>
      <li class="tab active">
        <a href="./sub07.php">회원정보수정</a>
      </li>
    </ul>
  </section>

<form name="join" method="post">
<input type="hidden" name="nicchk_value" id="nicchk_value">
<input type="hidden" name="idx" value="<?=$row->idx?>">	
<section class="mypage">
    <div class="user-info-modify">
      <div class="title">
        <h3>기본정보</h3>
        <p class="sub-text">
          입찰회원은 아래 내용을 정확히 기록하여 주십시요.
        </p>
      </div>
      <div class="table-style">
        <ul>
          <li>
            <div class="th">담당자</div>
            <div class="td">
              <div class="input-wrap">
                <input type="text" name="user_name2" value="<?=$row->name?>">
              </div>
              <p class="notice-text">실무업무담당자명을 기록하여 주십시요.</p>
            </div>
          </li>
          <li>
            <div class="th">아이디</div>
            <div class="td">
              <div class="flex-type id">
                <div class="input-wrap">
                  <?=$loginId?>
                </div>
                
              </div>
            </div>
          </li>
          <li>
            <div class="th">닉네임</div>
            <div class="td">
              <div class="flex-type nickname">
                <div class="input-wrap">
                  <input type="text" name="userNick2" value="<?=$row->userNick?>">
                </div>
                <button class="btn btn-round btn-secondary btn-sm" onclick="check_nicname_Window();">중복확인</button>
              </div>
              <p class="status-text" id="u_nicname_check"></p>
              <p class="notice-text">게시판이용시 사용됩니다.</p>
            </div>
          </li>
          <li>
            <div class="th">비밀번호</div>
            <div class="td">
              <div class="input-wrap">
                <input type="password" name="yuserPw">
              </div>
              <p class="notice-text">4~18자 영어,숫자 특수기호 사용가능</p>
            </div>
          </li>
          <li>
            <div class="th">새비밀번호</div>
            <div class="td">
              <div class="input-wrap">
                <input type="password" name="userPw1">
              </div>
            </div>
          </li>
          <li>
            <div class="th">새비번확인</div>
            <div class="td">
              <div class="input-wrap">
                <input type="password" name="userPw2">
              </div>
            </div>
          </li>
          <li>
            <div class="th">대표전화</div>
            <div class="td">
              <div class="input-group phone">
                <div class="input-wrap">
                  <input type="text" name="tel1" value="<?=$tel1?>">
                </div>
                <div class="dash">-</div>
                <div class="input-wrap">
                  <input type="text" name="tel2" value="<?=$tel2?>">
                </div>
                <div class="dash">-</div>
                <div class="input-wrap">
                  <input type="text" name="tel3" value="<?=$tel3?>">
                </div>
              </div>
            </div>
          </li>
          <li>
            <div class="th">일반전화</div>
            <div class="td">
              <div class="input-group phone">
                <div class="input-wrap">
                  <input type="text" name="company_tel1" value="<?=$company_tel1?>">
                </div>
                <div class="dash">-</div>
                <div class="input-wrap">
                  <input type="text" name="company_tel2" value="<?=$company_tel2?>">
                </div>
                <div class="dash">-</div>
                <div class="input-wrap">
                  <input type="text" name="company_tel3" value="<?=$company_tel3?>">
                </div>
              </div>
            </div>
          </li>
          <li>
            <div class="th">휴대전화</div>
            <div class="td">
              <div class="input-group phone">
                <div class="input-wrap">
                  <input type="text" name="pcs1" value="<?=$pcs1?>"> 
                </div>
                <div class="dash">-</div>
                <div class="input-wrap">
                  <input type="text" name="pcs2" value="<?=$pcs2?>">
                </div>
                <div class="dash">-</div>
                <div class="input-wrap">
                  <input type="text" name="pcs3" value="<?=$pcs3?>">
                </div>
              </div>
            </div>
          </li>
          <li>
            <div class="th">팩스번호</div>
            <div class="td">
              <div class="input-group phone">
                <div class="input-wrap">
                  <input type="text" name="fax1" value="<?=$fax1?>">
                </div>
                <div class="dash">-</div>
                <div class="input-wrap">
                  <input type="text" name="fax2" value="<?=$fax2?>">
                </div>
                <div class="dash">-</div>
                <div class="input-wrap">
                  <input type="text" name="fax3" value="<?=$fax3?>">
                </div>
              </div>
            </div>
          </li>
          <li>
            <div class="th">이메일</div>
            <div class="td">
              <div class="input-wrap">
                <input type="text" name="email1" value="<?=$row->email?>">
              </div>
            </div>
          </li>
        </ul>
      </div>
      <div class="title">
        <h3>회사정보</h3>
      </div>
      <div class="table-style">
        <ul>
          <li>
            <div class="th">업체명</div>
            <div class="td">
              <div class="input-wrap w-238">
                <input type="text" name="company_name" value="<?=$row->company_name?>">
              </div>
            </div>
          </li>
          <li>
            <div class="th">대표자명</div>
            <div class="td">
              <div class="input-wrap w-238">
                <input type="text" name="ceo_name" value="<?=$row->ceo_name?>">
              </div>
            </div>
          </li>
          <li>
            <div class="th">사업자번호</div>
            <div class="td">
              <div class="input-group biz-number">
                <div class="input-wrap">
                  <input type="text" name="company_no1" value="<?=$company_no1?>">
                </div>
                <div class="dash">-</div>
                <div class="input-wrap">
                  <input type="text" name="company_no2" value="<?=$company_no2?>">
                </div>
                <div class="dash">-</div>
                <div class="input-wrap">
                  <input type="text" name="company_no3" value="<?=$company_no3?>">
                </div>
              </div>
            </div>
          </li>
          <li>
            <div class="th">법인번호</div>
            <div class="td">
              <div class="input-group corporation-number">
                <div class="input-wrap">
                  <input type="text" name="ceo_ssn1" value="<?=$ceo_ssn1?>">
                </div>
                <div class="dash">-</div>
                <div class="input-wrap">
                  <input type="text" name="ceo_ssn2" value="<?=$ceo_ssn2?>">
                </div>
              </div>
            </div>
          </li>
          <li>
            <div class="th">업태</div>
            <div class="td">
              <div class="input-wrap w-238">
                <input type="text" name="company_sort" value="<?=$company_sort?>">
              </div>
            </div>
          </li>
          <li>
            <div class="th">종목</div>
            <div class="td">
              <div class="input-wrap w-238">
                <input type="text" name="company_subsort" value="<?=$company_subsort?>">
              </div>
            </div>
          </li>
          <li>
            <div class="th">사업장주소</div>
            <div class="td">
              <div class="flex-type post-number">
                <div class="input-wrap">
                  <input type="text" name="czipcode" value="<?=$company_post1?>">
                </div>
                <button class="btn btn-round btn-secondary btn-sm" onclick="openDaumPostcode2();">우편번호</button>
              </div>
              <div class="address">
                <div class="input-wrap">
                  <input type="text" name="caddress" value="<?=$row->company_addr1?>">
                </div>
                <div class="input-wrap">
                  <input type="text" name="caddress_ext" value="<?=$row->company_addr2?>">
                </div>
              </div>
            </div>
          </li>
          <li>
            <div class="th">업종구분</div>
            <div class="td">
              <div class="input-wrap">
                <select name="upjong" >
				<option value="">::업종구분::</option>
                <option value="폐차업자" <? if($row->upjong == '폐차업자'){?> selected="selected" <? } ?>>폐차업자</option>
                <option value="자동차정비" <? if($row->upjong == '자동차정비'){?> selected="selected" <? } ?>>자동차정비</option>
                <option value="중고부품업" <? if($row->upjong == '중고부품업'){?> selected="selected" <? } ?>>중고부품업</option>
                <option value="자동차무역" <? if($row->upjong == '자동차무역'){?> selected="selected" <? } ?>>자동차무역</option>
                <option value="매매상사" <? if($row->upjong == '매매상사'){?> selected="selected" <? } ?>>매매상사</option>
                <option value="딜러" <? if($row->upjong == '딜러'){?> selected="selected" <? } ?>>딜러</option>
                <option value="기타" <? if($row->upjong == '기타'){?> selected="selected" <? } ?>>기타</option></select>
              </div>
            </div>
          </li>
        </ul>
      </div>
      <div class="agree-email">
        <p class="notice">
          당사에서 발송하는 정보를 문자나 이메일로 수신하시겠습니까?
        </p>
        <ul class="radio-group">
          <li>
            <div class="radio-wrap">
              <input type="radio" name="emailSend" id="agreeEmail1" value="yes" <?=$checkedyes?>>
              <label class="radio-label" for="agreeEmail1">예</label>
            </div>
          </li>
          <li>
            <div class="radio-wrap">
              <input type="radio" name="emailSend" id="agreeEmail2" value="no" <?=$checkedno?>>
              <label class="radio-label" for="agreeEmail2">아니오</label>
            </div>
          </li>
        </ul>
      </div>
      <div class="btn-wrap">
        <button class="btn btn-wide btn-primary btn-md" onclick="change_form()">회원정보수정</button>
      </div>
    </div>
  </section>
</form>
<?
include $_SERVER['DOCUMENT_ROOT']."/inc/footer.php";
?>
</body>
</html>