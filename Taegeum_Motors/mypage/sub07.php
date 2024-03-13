<?include "../inc/header.php" ?>
<?
	if(!$loginId){
		echo "<script>alert('로그인후 사용 가능합니다.');history.back();</script>";
	}
?>
<?
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
<!-- 회원가입독립 css -->
<style type="text/css">
.join_img_body td {text-align:left;}
.join_img_body { position:relative;  margin-top:40px; }
.join_img_body ul li { width:250px; float:left; }
.join_img_body table { }
.join_img_body table.join_form tr th { background:#f7f7f7; border:1px solid #949294; font-weight:normal; }
.join_img_body table.join_form tr td { text-align:left; padding:2px 2px 2px 2px; color:#000000; border:1px solid #949294;}
.join_img_body table.join_form tr td  table { padding:0; margin:0; }
.join_img_body table.join_form tr td  table tr td { padding:0; margin:0; border:none; padding:2px 2px 2px 2px; }
.div_title { text-align:left; margin-top:20px;padding-bottom:7px; }
input[type=text] { padding:1px 1px 1px 1px; border:1px solid #008ade; height:15x; }
input[type=password] { padding:1px 1px 1px 1px; border:1px solid #008ade; }
.div_con { width:759px; height:130px; overflow-y:scroll; text-align:left; white-space:pre-line; padding:10px; margin:0px;	border:1px solid #959595; line-height:150%; }
.confirm_area { margin:15px 0; }
.style1 {color: #0000FF}
button { cursor:pointer; }
</style>

<script>
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
		
function win_open(ret){
	window.open('/member/post.php?ret='+ret,'zipcode','width=550,height=500,scrollbars=yes');
}
	



	function join_submit(){
		var frm = document.join;

		if(!frm.userId.value){		
			alert("아이디를 입력해주세요");
			frm.userId.focus();
			return false;
		}
		if(frm.idchk_value.value == 0){
			alert("아이디 중복확인해주세요");
			return false;
		}
		if(!frm.userPw1.value){
			alert("비밀번호를 입력해주세요");
			frm.userPw1.focus();
			return false;
		}
		if(!frm.userPw2.value){
			alert("비밀번호 확인을 입력해주세요");
			frm.userPw2.focus();
			return false;
		}
		if(frm.userPw1.value != frm.userPw2.value){
			alert("비밀번호와 비밀번호 확인이 맞지 않습니다. 다시 확인해주세요!");
			return false;
		}

		
		if(!frm.pcs1.value || !frm.pcs2.value || !frm.pcs2.value){
			alert("휴대폰 번호를 입력해주세요");			
			frm.pcs1.focus();
			return false;
		}

		frm.action="/member/proc.php?Mode=<?=$mode?>";
		
	}

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
			alert("기존 비밀번호를 입력해주세요");
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

	function jumin_check(num1, num2){
		//alert(num1);alert(num2);
		var left_j = num1;
		var right_j = num2;
		var l1=left_j.substring(0,1); 
		var l2=left_j.substring(1,2); 
		var l3=left_j.substring(2,3); 
		var l4=left_j.substring(3,4); 
		var l5=left_j.substring(4,5); 
		var l6=left_j.substring(5,6); 
		var hap=l1*2+l2*3+l3*4+l4*5+l5*6+l6*7; 
		var r1=right_j.substring(0,1); 
		var r2=right_j.substring(1,2); 
		var r3=right_j.substring(2,3); 
		var r4=right_j.substring(3,4); 
		var r5=right_j.substring(4,5); 
		var r6=right_j.substring(5,6); 
		var r7=right_j.substring(6,7); 
		hap=hap+r1*8+r2*9+r3*2+r4*3+r5*4+r6*5; 
		hap=hap%11; 
		hap=11-hap; 
		hap=hap%10;
		
		if(hap != r7) { 			
			return 1; 
		} 
	}

function check_nicname_Window() {
	var f = document.join;
	if((f.userNick2.value.length < 2) || (f.userNick2.value.length > 12)){
		f.nicchk_value.value="0";
		document.getElementById("u_nicname_check").innerHTML="[사용불가]";
	}else{
		f.action="/login/join_nicname_chk1.php";
		f.target="iFrm";
		f.submit();
	}
} 

</script>

<div id="contents_basic">

     <div class="co_car_all">
  
		 <div class="sub-visual">
			<div class="sub-text">
				<p class="catch-phrase">
				마이페이지ㅣMypage
				</p>
				<p class="description-text">입찰 ㅣ낙찰 ㅣ관심 ㅣ접수현황 및 회원정보수정을 하실수 있습니다. </p>
		   </div>
		</div>

			  <div class="join_img_head sign-in" style="margin-top:0;" align="center">
					<div class="tab_type01">
						<ul>
							<li><a href="/mypage/sub04.php"><span>입찰현황</span></a></li>
							<li><a href="/mypage/sub05.php"><span>낙찰현황</span></a></li>
							<li><a href="/mypage/sub03.php"><span>관심차량</span></a></li>
							<li><a href="/mypage/sub01.php"><span>접수현황</span></a></li>
							<li class="on"><a href="/mypage/sub07.php"><span>회원정보수정</span></a></li>
                            <li><a href="/mypage/sub08.php"><span>회원탈퇴</span></a></li>
						</ul>
          
<form name="join" method="post">
<input type="hidden" name="nicchk_value" id="nicchk_value">
<input type="hidden" name="idx" value="<?=$row->idx?>">	

	<div class="div_title"><img src="/images/icon.jpg" /><strong> 기본인적사항</strong>
			      <!--img src="./images/t03.jpg" alt="필수정보입력" /--></div>
					     <table class="join_form" width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #D8D8D8;background:#FFF;">
                           <!--추가 에러-->
                           <colgroup>
                           <col width="20%" />
                           <col width="*" />
                           </colgroup>
                           <tr>
                             <th align="left" style="padding:5px 0 5px 20px; border-right:1px solid #D8D8D8;border-bottom:1px solid #D8D8D8;background:#EFEFEF">이름(담당자)</th>
                             <td align="left" style="padding:5px 0 5px 5px;border-bottom:1px solid #D8D8D8;"><input name="user_name2" id="user_name"  type="text"   hname="회원성명" value="<?=$row->name?>" class="form_control">
                               실무업무담당자명을 기록하여 주십시요.</td>
                           </tr>
                           <tr>
                             <th align="left" style="padding:5px 0 5px 20px; border-right:1px solid #D8D8D8;border-bottom:1px solid #D8D8D8;background:#EFEFEF">아이디</th>
                             <td align="left" style="padding:5px 0 5px 5px;border-bottom:1px solid #D8D8D8;"><b style="line-height:30px"><?=$loginId?></td>
                           </tr>
                           <tr>
                             <th align="left" style="padding:5px 0 5px 20px; border-right:1px solid #D8D8D8;border-bottom:1px solid #D8D8D8;background:#EFEFEF">닉네임(별명)</th>
                             <td align="left" style="padding:5px 0 5px 5px;border-bottom:1px solid #D8D8D8;"><input name="userNick2" id="userNick2" type="text" maxlength="10"  hname='닉네임' class="form_control" value="<?=$row->userNick?>"/>
							 <!-- <img align="absMiddle" style="cursor: pointer;" onclick="check_nicname_Window();" src="/member/images/bt03.gif" border="0"/> -->
							 &nbsp;&nbsp;
							 <button class="btn btn-round btn-secondary btn-sm" onclick="check_nicname_Window();">중복확인</button>
                            &nbsp;&nbsp;<font style="color:red"><strong id="u_nicname_check"></strong></font> 게시판이용시 사용됩니다. </td>
                           </tr>
                           <tr>
                             <th align="left" style="padding:5px 0 5px 20px; border-right:1px solid #D8D8D8;border-bottom:1px solid #D8D8D8;background:#EFEFEF">현재비밀번호</th>
                             <td align="left" style="padding:5px 0 5px 5px;border-bottom:1px solid #D8D8D8;"><input name="yuserPw" id="yuserPw" type="password"    hname='비밀번호' class="form_control"' value=""/> </td>
                           </tr>
                           <tr>
                             <th align="left" style="padding:5px 0 5px 20px; border-right:1px solid #D8D8D8;border-bottom:1px solid #D8D8D8;background:#EFEFEF">새비밀번호</th>
                             <td align="left" style="padding:5px 0 5px 5px;border-bottom:1px solid #D8D8D8;"><input name="userPw1" id="userPw1" type="password"    hname='비밀번호' class="form_control"' value=""/>
                             4~10자의 영문, 숫자만 사용할 수 있습니다.</td>
                           </tr>
                           <tr>
                             <th align="left" style="padding:5px 0 5px 20px; border-right:1px solid #D8D8D8;border-bottom:1px solid #D8D8D8;background:#EFEFEF">새비밀번호확인</th>
                             <td align="left" style="padding:5px 0 5px 5px;border-bottom:1px solid #D8D8D8;"><input name="userPw2" id="userPw2" type="password"    hname='비밀번호' class="form_control"' value=""/>
                            4~10자의 영문, 숫자만 사용할 수 있습니다.</td>
                           </tr>
                           <tr>
                             <th align="left" style="padding:5px 0 5px 20px; border-right:1px solid #D8D8D8;border-bottom:1px solid #D8D8D8;background:#EFEFEF">대표전화</th>
                             <td align="left" style="padding:5px 0 5px 5px;border-bottom:1px solid #D8D8D8;">
														 		<input name="tel1" type="text"  size="5" maxlength="4"  class="form_control" hname='일반전화' value="<?=$tel1?>"/>
																- 
																<input name="tel2" maxlength="4" type="text"  size="5"   class="form_control" hname='일반전화' value="<?=$tel2?>"/>
																- 
																<input name="tel3" maxlength="4" type="text"  size="5"  class="form_control" hname='일반전화'  value="<?=$tel3?>"/>
															</td>
                           </tr>
                           <tr>
															<th align="left" style="padding:5px 0 5px 20px; border-right:1px solid #D8D8D8;border-bottom:1px solid #D8D8D8;background:#EFEFEF">회사전화</th>
															<td align="left" style="padding:5px 0 5px 5px;border-bottom:1px solid #D8D8D8;">
																<input name="company_tel1"  type="text" size="5" maxlength="4"  class="form_control" value="<?=$company_tel1?>"/>
																- 
																<input name="company_tel2"  maxlength="4" type="text" size="5"   class="form_control" value="<?=$company_tel2?>"/>
																- 
																<input name="company_tel3"  maxlength="4" type="text" size="5"  class="form_control" value="<?=$company_tel3?>"/>  
															</td>
                           </tr>
                           <tr>
															<th align="left" style="padding:5px 0 5px 20px; border-right:1px solid #D8D8D8;border-bottom:1px solid #D8D8D8;background:#EFEFEF">휴대전화</th>
															<td align="left" style="padding:5px 0 5px 5px;border-bottom:1px solid #D8D8D8;">
																<input name="pcs1" type="text"  size="5" maxlength="4"  class="form_control" hname='일반전화'  value="<?=$pcs1?>"/>
																- 
																<input name="pcs2" maxlength="4" type="text"  size="5"  class="form_control" hname='일반전화'  value="<?=$pcs2?>"/>
																- 
																<input name="pcs3" maxlength="4" type="text"  size="5" class="form_control" hname='일반전화'  value="<?=$pcs3?>"/>  
															</td>
                           </tr>
                           <tr>
															<th align="left" style="padding:5px 0 5px 20px; border-right:1px solid #D8D8D8;border-bottom:1px solid #D8D8D8;background:#EFEFEF">팩스전화</th>
															<td align="left" style="padding:5px 0 5px 5px;border-bottom:1px solid #D8D8D8;">
																<input name="fax1" type="text"  id="fax1" value="<?=$fax1?>" size="5" maxlength="4" class="form_control"/>
																- 
																<input name="fax2" type="text"  id="fax2"   value="<?=$fax2?>" size="5" maxlength="4"  class="form_control"/>
																- 
																<input name="fax3" type="text" id="fax3" value="<?=$fax3?>" size="5" maxlength="4" class="form_control"/>   
															</td>
                           </tr>
                           <!-- <tr>
                             <th align="left" style="padding:15px 0 15px 20px; border-right:1px solid #D8D8D8;border-bottom:1px solid #D8D8D8;background:#EFEFEF">주소</th>
                             <td align="left" style="padding-left:0px;"><table class="join_form"width="100%" border="0" cellspacing="0" cellpadding="0">
                                 <tbody>
                                   <tr>
                                     <td height="25" align="left" style="padding:3px 0 3px 5px;"><input name="zipcode1" type="text" id="zipcode" size="10"  readonly="readonly" value="<?=$row->post1?>" class="form_control" style="background-color: #ffffff; color:#333;opacity:1;">
									 <a href="javascript:openDaumPostcode()"><img align="absmiddle" src="/member/images/bt04.gif" border="0"/></a></td>
                                   </tr>
                                   <tr>
                                     <td style="padding:3px 0 3px 5px;"><input name="address" id="address" type="text"  size="70" hname='주소'   value="<?=$row->addr1?>" readonly class="form_control" style="background-color: #ffffff; color:#333;opacity:1;"/></td>
                                   </tr>
                                   <tr>
                                     <td style="padding:3px 0 3px 5px;border-bottom:1px solid #D8D8D8;"><input name="address_ext" id="address_ext" type="text"  size="70" hname='나머지주소'  value="<?=$row->addr2?>" class="form_control"/>                                     </td>
                                   </tr>
                                 </tbody>
                             </table></td>
                           </tr> -->
                           <tr>
                             <th align="left" style="padding:8px 0 8px 20px; border-right:1px solid #D8D8D8;border-bottom:1px solid #D8D8D8;background:#EFEFEF">이메일</th>
                             <td style="padding:5px 0 5px 5px;border-bottom:1px solid #D8D8D8;">
														 <input name="email1" type="text"  size="50"  hname='이메일'  value="<?=$row->email?>" class="form_control"/>
														</td>
                           </tr>
                         </table>


                    <div class="div_title"><img src="/images/icon.jpg" /><strong> 사업자정보 </strong><font color="#DD3E0F">/ 입찰회원은 아래 내용을 빠짐없이 기록하여 주십시요.</font></div>
					<table class="join_form" width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #D8D8D8;background:#FFF;">

                      <colgroup>
							<col width="20%">
							<col width="*">
					  </colgroup>
							<tr>
								<th width="18%" align="left" style="padding:5px 0 5px 20px; border-right:1px solid #D8D8D8;border-bottom:1px solid #D8D8D8;background:#EFEFEF">업체명(상호)</th>
							  <td width="82%" style="padding:5px 0 5px 5px;border-bottom:1px solid #D8D8D8;"><input name="company_name" hname="상호(단체명)" required="required"  type="text" class="form_control" value="<?=$row->company_name?>" /></td>
		  </tr>
							<tr>
								<th align="left" style="padding:5px 0 5px 20px; border-right:1px solid #D8D8D8;border-bottom:1px solid #D8D8D8;background:#EFEFEF">사업자번호</th>
						  <td align="left" style="padding:5px 0 5px 5px;border-bottom:1px solid #D8D8D8;">
									<input name="company_no1" id="company_no1" maxlength="3" type="text" class="form_control" size="5" value="<?=$company_no1?>"/>-
									<input name="company_no2" id="company_no2" type="text" class="form_control" size="5" value="<?=$company_no2?>" maxlength="2"/>-
									<input name="company_no3" id="company_no3" type="text" class="form_control" size="8" value="<?=$company_no3?>" maxlength="5"/>
							  </td>
							</tr>
							<tr>
								<th align="left" style="padding:5px 0 5px 20px; border-right:1px solid #D8D8D8;border-bottom:1px solid #D8D8D8;background:#EFEFEF">대표자명</th>
							  <td align="left" style="padding:5px 0 5px 5px;border-bottom:1px solid #D8D8D8;"><input name="ceo_name" type="text" class="form_control" hname="대표자명" required="required" value="<?=$row->ceo_name?>"/>
							  </td>
							</tr>
							<tr>
								<th align="left" style="padding:5px 0 5px 20px; border-right:1px solid #D8D8D8;border-bottom:1px solid #D8D8D8;background:#EFEFEF">법인등록번호</th>
							  <td align="left" style="padding:5px 0 5px 5px;border-bottom:1px solid #D8D8D8;"><input name="ceo_ssn1"  type="text"  maxlength=6 size="10" value="<?=$ceo_ssn1?>"  hname="회사이메일" class="form_control"/>
								- 
								<input name="ceo_ssn2"  type="text"  size="15" maxlength=7  hname="회사이메일"  value="<?=$ceo_ssn2?>"  class="form_control">
							  </td>
							</tr>
							<tr>
								<th align="left" style="padding:5px 0 5px 20px; border-right:1px solid #D8D8D8;border-bottom:1px solid #D8D8D8;background:#EFEFEF">업태</th>
							  <td align="left" style="padding:5px 0 5px 5px;border-bottom:1px solid #D8D8D8;"><input name="company_sort" id="company_sort" type="text" class="form_control" hname="업태" required="required" value="<?=$company_sort?>"/>
							  </td>
							</tr>
							<tr>
								<th align="left" style="padding:5px 0 5px 20px; border-right:1px solid #D8D8D8;border-bottom:1px solid #D8D8D8;background:#EFEFEF">종목</th>
						  <td align="left" style="padding:5px 0 5px 5px;border-bottom:1px solid #D8D8D8;">
									<input name="company_subsort" id="company_subsort" type="text" class="form_control" hname="종목" required="required" value="<?=$company_subsort?>"/>
							  </td>
							</tr>
							<tr>
								<th align="left" style="padding:15px 0 15px 20px; border-right:1px solid #D8D8D8;border-bottom:1px solid #D8D8D8;background:#EFEFEF">사업장주소</th>
						  <td  align="left" style="padding-left:0px;">
									<table class="join_form2"width="100%" border="0" cellSpacing="0" cellPadding="0">
										<tbody>
											<tr>
												<td height="25" align="left" style="padding:3px 0 3px 5px;">
													<input name="czipcode" type="text" id="czipcode1" size="10" class="form_control" value="<?=$company_post1?>">
													<!-- <a href="javascript:openDaumPostcode2()" ><img align="absMiddle" src="/member/images/bt04.gif" border="0"/></a> -->
													&nbsp;&nbsp;
							 <button class="btn btn-round btn-secondary btn-sm" onclick="openDaumPostcode2();">우편번호 찾기</button>
												</td>
											</tr>
											<tr>
												<td style="padding:3px 0 3px 5px;">
													<input name="caddress" id="company_addr1" type="text" class="form_control" size="70" hname='주소' required="required" onclick="win_open('c')" readonly="readonly" value="<?=$row->company_addr1?>" style="background-color: #ffffff;color: #333333;opacity:1;"/>
												</td>
											</tr>
											<tr>
												<td style="padding:3px 0 3px 5px;">
													<input name="caddress_ext" id="company_addr2" type="text" class="form_control" size="70" hname='나머지주소' required="required" value="<?=$row->company_addr2?>"/>
												</td>
											</tr>
										</tbody>
									</table>
							  </td>
							</tr>
							<tr>
								<th align="left" style="padding:5px 0 5px 20px; border-right:1px solid #D8D8D8;border-bottom:1px solid #D8D8D8;background:#EFEFEF">업종구분</th>
						  <td align="left" style="padding:5px 0 5px 5px;border-bottom:1px solid #D8D8D8;"><select name="upjong" class="form_select">
                          <option value="">::업종구분::</option>
                <option value="폐차업자" <? if($row->upjong == '폐차업자'){?> selected="selected" <? } ?>>폐차업자</option>
                <option value="자동차정비" <? if($row->upjong == '자동차정비'){?> selected="selected" <? } ?>>자동차정비</option>
                <option value="중고부품업" <? if($row->upjong == '중고부품업'){?> selected="selected" <? } ?>>중고부품업</option>
                <option value="자동차무역" <? if($row->upjong == '자동차무역'){?> selected="selected" <? } ?>>자동차무역</option>
                <option value="매매상사" <? if($row->upjong == '매매상사'){?> selected="selected" <? } ?>>매매상사</option>
                <option value="딜러" <? if($row->upjong == '딜러'){?> selected="selected" <? } ?>>딜러</option>
                <option value="기타" <? if($row->upjong == '기타'){?> selected="selected" <? } ?>>기타</option></select>
				</td>
							</tr>							
						</tbody>
					

					</table>     
	<br />
	<br />
	<div class="ask-agree">
		<div class="question">
			<p>
			당사에서 발송하는 정보를 메일로 수신하시겠습니까?
			</p>
		</div>
		<div class="answer">
			<ul>
				<li>
					<input name="emailSend" type="radio" value="yes" id="agree" checked <?=$checkedyes?>/>
					<label for="agree">예</label>
				</li>
				<li>
					<input name="emailSend" type="radio" value="no" id="disAgree" <?=$checkedno?>/>
					<label for="disAgree">아니오</label>
				</li>
			</ul>
		</div>
	</div>
                    
				 <br />


			
				<div class="btn_area" style="margin-top:20px">
					<a href="javascript:void(0)" onclick="change_form()" style="display:inline-block; color:#fff"><div class="user-btn Scor-font-500">회원정보 수정</div></a>
				</div>
  </div>

			</div>
		</div>
	</div>
	<!-- footer -->
	<div class="cha_footer"><? include "../inc/bottom.php" ?></div>
</div>

</body>
</html>

<script type="text/javascript">
function auctionView(idx) {
	window.location.href="sub02_1_view.php?idx="+idx;
}
</script>

<script src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></script>
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

                // 우편번호와 주소 정보를 해당 필드에 넣는다.
                document.join.zipcode.value = data.zonecode; //5자리 새우편번호 사용
                document.join.address.value = fullAddr;
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

                // 우편번호와 주소 정보를 해당 필드에 넣는다.
                document.join.czipcode.value = data.zonecode; //5자리 새우편번호 사용
                document.join.caddress.value = fullAddr;
                document.join.caddress_ext.focus();
            }
        }).open();
    }
</script>
<iframe name="iFrm" id="iFrm" width=0 height=0 src="about:blank"></iframe>
