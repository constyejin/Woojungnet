<?include "../inc/header.php" ?>

<?
$idx = $_GET['idx'];
if(!$idx)$mode = 'regist';
else $mode = 'modify';
if ($__lib['limit_ext'] != ''){
	preg_match('/[.]+('.str_replace(';', '|', $__lib['limit_ext']).')+/i', $_FILES['upfile']['name'], $mc);
}

if($loginId){
	$row = mysql_fetch_array(mysql_query("SELECT * FROM woojung_member WHERE userId='$loginId'"));
	if($row[idx]) {
		$call_line = 'user';
		$post = $row[post1].'-'.$row[post2];
	} else {
		$call_line = '';
		$post = '';
	}
	$telarr = explode('-',$row[tel]);
	$pcsarr = explode('-',$row[pcs]); 
	$faxarr = explode('-',$row[fax]); 
	$emailarr = explode('@',$row[email]);
	$zipcode1 = $row[post1];
	$zipcode2 = $row[post2];

	//dbclose($connect);
}else{
//	echo "<script>alert('로그인후 사용 가능합니다.');history.back();</script>";
}
?>
<script type="text/javascript">
function out_submit(){

	f=document.outForm;

	if(f.carno_c.value!='1'){
		alert('차량번호 중복확인을 해주세요');
		return false;
	}

/*	if(f.wc_go_type[0].checked==false && f.wc_go_type[1].checked==false && f.wc_go_type[2].checked==false){
		alert('매각유형은 필수 입력 사항입니다.');
		return false;
	}
*/
//	if(!validate(f)) return false;
	lib.FileUpload();
	return false;
}

function moveInput(sort) {
	if(sort == 'tel1') {
		$('call_tel2').focus();
	} else if(sort == 'tel2') {
		if($F('call_tel2').length >=4)$('call_tel3').focus();
	
	} else if(sort == 'pcs1') {
		$('call_pcs2').focus();
	} else if(sort == 'pcs2') {
		if($F('call_pcs2').length >=4)$('call_pcs3').focus();
	}
}

</script>
 

<style type="text/css">
.join_img_head { position:relative;  margin-top:70px; margin-bottom:50px;}
.join_img_body ul li { width:250px; float:left; }
</style>
			<div class="sub-visual">
				<div class="sub-text">
					<p class="catch-phrase">
					개인정보처리방침
					</p>
					<p class="description-text">
						공정하고 투명하며 신속, 정확한 정보를 제공합니다.
					</p>
				</div>
			</div>  
			  <div class="join_img_head" style="margin-top:0;" align="center">
					 <div class="tab_type01">
						<ul>
							<!-- <li><a href="/member/join.php"><span>회원가입</span></a></li>
							<li><a href="/member/login.php"><span>로그인</span></a></li>
							<li><a href="/member/cha_lost_id.php"><span>ID,비번찾기</span></a></li> -->
							<li><a href="/login/sub_agree01.php"><span>이용약관</span></a></li>
						  <li class="on"><a href="/member/sub_agree05.php"><span>개인정보처리방침</span></a></li>
						</ul>
					</div>
				  <table border="0" align="center" cellpadding="0" cellspacing="0" class="tbl_terms" style="border:1px solid #E6E6E6;  margin-top:30px; margin-bottom:70px;width:1200px;">
								<tr>
									<td>
										<table>
											<tr>
												<td class="list_u_title">▣ 개인정보처리방침</td>
											</tr>
										</table>
									</td>
								</tr>
								<tr>
									<td class="u_list_con">
										<table width="1200" border="0" align="center" cellpadding="0" cellspacing="0">
											<tr>
												<td height="10"><p> (주)태금모터스 (이하, &quot;당사&quot;라 함)은 회원님의 개인정보를 매우 중요하게 생각하며 당사에 제공한 소중한 개인정보가 보호받을 수 있도록 최선을 다하고 있습니다. <br>
										      이에 당사는 통신비밀보호법, 전기통신사업법, 정보통신망 이용촉진 및 정보보호 등에 관한 법률 등 정보통신 서비스제공자가 준수하여야 할 관련 법령상의 개인정보보호규정과 방송통신위원회의 개인정보보호지침을 준수하고 있습니다.<br>이 개인정보보호정책은 개인정보보호에 관련한 법률 또는 지침의 변경, 회사 정책의 변화에 따라 달라질 수 있으니 회원님께서는 당사 사이트 방문 시 수시로 확인하시기 바랍니다. <br>개인정보 보호법 제30조에 따라 정보주체의 개인정보를 보호하고 이와 관련한 고충을 신속하고 원활하게 처리하기 위하여 다음과 같이 개인정보 처리지침을 수립·공개합니다.</p></td>
											</tr>
											<tr>
												<td height="10">&nbsp;</td>
											</tr>
											<tr>
												<td height="2" bgcolor="#128D56"></td>
											</tr>
											<tr>
												<td height="25">제1조 개인정보의 수집목적 및 이용목적</td>
											</tr>
											<tr>
												<td height="1" valign="top" bgcolor="#128D56"></td>
											</tr>
											<tr>
												<td valign="top">&nbsp;</td>
											</tr>
											<tr>
												<td valign="top"><p>회사는 수집한 개인정보를 다음의 목적을 위해 활용합니다.<br>
○ 이용목적: <br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;가)서비스제공에 관한 계약이행및서비스제공에 따른 요금정산과 콘텐츠제공<br> 
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;나)회원제시비스이용에 따른 본인확인, 개인식별, 불량회원의 부정이용방지와 비인가사용방지, 가입의사확인, 연령확인 만 14세 미만<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  아동 개인정보수집시 법정 대리인동의여부 확인, 불만 처리 등 민원처리, 고지사항전달, 마케팅 및 광고에 활용</p>       </td>
											</tr>
											<tr>
												<td valign="top">&nbsp;</td>
											</tr>
											<tr>
												<td height="2" valign="top" bgcolor="#128D56"></td>
											</tr>
											<tr>
												<td height="25">제2조 개인정보 수집에 대한 동의</td>
											</tr>
											<tr>
												<td height="1" valign="top" bgcolor="#128D56"></td>
											</tr>
											<tr>
												<td valign="top">&nbsp;</td>
											</tr>
											<tr>
												<td valign="top"><p>회사는 회원가입, 상담, 서비스제공등을 위해 아래의 개인정보등을 수집하고 있습니다. <br>
○ 수집항목: 이름, 아이디, 비밀번호, 전화번호, 주소, 휴대전화번호, 이메일, 생년월일, 이용기록, 쿠키, 결제정보등<br> 
○ 수집방법: 홈페이지(회원가입) <br>
○ 동의방법:회사는 이용자들이 회사의 개인정보처리방침 또는 이용약관의 내용에 대하여 [동의] 또는 [동의하지 않음]을 선택할 수 있는<br>&nbsp;&nbsp;&nbsp;&nbsp절차를 마련하여 [동의]버튼을 클릭하면 개인정보수집에 대해 동의한 것으로 봅니다. 
</p>        </td>
											</tr>
											<tr>
												<td valign="top">&nbsp;</td>
											</tr>
											<tr>
												<td height="2" valign="top" bgcolor="#128D56"></td>
											</tr>
											<tr>
												<td height="25"><p>제3조 개인정보의 수집항목 및 수집방법
										</p></td>
											</tr>
											<tr>
												<td height="1" valign="top" bgcolor="#128D56"></td>
											</tr>
											<tr>
												<td valign="top">&nbsp;</td>
											</tr>
											<tr>
												<td valign="top"><p>당사는 회원 가입 시 성명, 주소, 전화번호, E-mail주소를 필수적으로 수집 하며 회원님에게 당사의 다양한 서비스를 제공하기 위하여<br>회원님의 선택에 따라 등록한 전화번호, 이동전화번호, 회원 아이디(ID), 직업 등의 정보를 수집할 수 있습니다. <br>또한 당사 서비스를 이용함에 따른 각종 대금결제와 관련하여 신용카드번호, 은행계좌번호 등의 추가정보를 회원님께 추가로 요구하여 수집합니다.
												   이 이외에 당사가 제공하는 특정한 서비스를 위하여 회원님께 추가정보를 요청하고 수집할 수 있습니다. <br>
										      그렇지만 회원님의 기본적 인권을 침해할 우려가 있는 인종 및 민족, 사상 및 신조, 출신지 및 본적지, 정치적 성향 및 범죄기록, 건강상태 및 성생활 등의 정보는 회원님의 동의 또는 법령에 규정에 의한 경우 이외에는 수집하지 않습니다.</p></td>
											</tr>
											<tr>
												<td valign="top">&nbsp;</td>
											</tr>
											<tr>
												<td height="2" valign="top" bgcolor="#128D56"></td>
											</tr>
											<tr>
												<td height="25"><p>제4조 개인정보의 목적 외 사용 및 제3자에 대한 제공</p></td>
											</tr>
											<tr>
												<td height="1" valign="top" bgcolor="#128D56"></td>
											</tr>
											<tr>
												<td valign="top">&nbsp;</td>
											</tr>
											<tr>
												<td valign="top"><p>가) 당사는 인터넷서비스화면을 통하여 공개된 정보를 제외하고는 회원님의 개인정보를 당사가 제공하는 인터넷서비스 외의 용도로 사용하거나 회원님의 동의 없이 제3자에게 제공하지 않습니다. 다만, 다음 각 호의 경우에는 예외로 합니다.</p>
													<p><span lang="EN-US" xml:lang="EN-US"> ① 금융실명거래 및 비밀보장에 관한 법률, 신용정보의 이용 및 보호에 관한 법률, 전기통</span><span lang="EN-US" xml:lang="EN-US">신기본법, 전기통신사업법, 지방세법, 소비자보호법, 한국은행법, 형사소송법 등 법령에 </span><span lang="EN-US" xml:lang="EN-US">특별한 규정이 있는 경우</span></p>
													<p><span lang="EN-US" xml:lang="EN-US"> ② 서비스제공에 따른 요금정산을 위하여 필요한 경우</span></p>
													<p><span lang="EN-US" xml:lang="EN-US"> ③ 통계작성, 학술연구 또는 시장조사를 위하여 필요한 경우로서 특정개인을 식별할 수 없</span><span lang="EN-US" xml:lang="EN-US">는 형태로 제공하는 경우</span></p>
													<p>나) 당사가 제공하는 경매서비스를 통하여 경매가 성사된 경우에는 쌍방 당사자 간에 물품<span lang="EN-US" xml:lang="EN-US">거래와 배송에 관련된 정보를 필요한 범위 내에서<br>쌍방 당사자에게 제공합니다.</span></p>
													<p>다) 당사 회원님에게 보다 더 나은 서비스를 제공하기 위하여 개인정보를 제휴사에게 제공<span lang="EN-US" xml:lang="EN-US">하거나 제휴사 등과 공유할 수 있습니다. 개인정보를 제공하거나 공유할 경우에는 사전</span><span lang="EN-US" xml:lang="EN-US">에 회원님께 제휴사 등이 누구인지, 제공 또는 공유되는 개인정보항목이 무엇인지, 왜</span><span lang="EN-US" xml:lang="EN-US">그러한 개인정보가 제공되거나 공유되어야 하는지, 언제까지 어떻게 보호 관리되는지에 </span><span lang="EN-US" xml:lang="EN-US">대해 개별적으로 고지하여 동의를 구하는 절차를 거치게 되며, 회원님께서 동의하지 않</span><span lang="EN-US" xml:lang="EN-US">은 경우에는 제휴사 등에게 제공하거나 제휴사 등과 공유하지 않습니다. 또한 회원님이 </span><span lang="EN-US" xml:lang="EN-US">일단 개인정보의 제공에 동의하더라도 언제든지 그 동의를 철회할 수 있습니다.</span>
												  </p>
													</p>      </td>
											</tr>
											<tr>
												<td valign="top">&nbsp;</td>
											</tr>
											<tr>
												<td height="2" valign="top" bgcolor="#128D56"></td>
											</tr>
											<tr>
												<td height="25"><p>제5조 개인정보의 열람, 정정, 동의철회</p></td>
											</tr>
											<tr>
												<td height="1" valign="top" bgcolor="#128D56"></td>
											</tr>
											<tr>
												<td valign="top">&nbsp;</td>
											</tr>
											<tr>
												<td valign="top"><p>가) 회원님은 언제든지 당사에 로그인하셔서 마이페이지&gt;회원정보수정 란에서 회원님의 개<span lang="EN-US" xml:lang="EN-US">인 정보를 열람하시거나 정정하실 수 있으며 당사의 개인정보관리책임자 에게 전자우편 </span><span lang="EN-US" xml:lang="EN-US">또는 서면으로 요청하신 경우 정정하여 드리겠습니다. 단, 회원 아이디(ID), 성명</span><span lang="EN-US" xml:lang="EN-US">은 정정이 불가능합니다.</span></p>
													<p>나) 회원님은 개인정보의 수집, 이용에 대한 동의철회(해지) 및 제3자에게 제공한 동의의 <span lang="EN-US" xml:lang="EN-US">철회는 E-mail, 전화, FAX, 기타의 방법을 통하여<br>할 수 있으며 이 경우, 회원님은 동일</span><span lang="EN-US" xml:lang="EN-US">성 증명을 위하여 반드시 회원 아이디(ID)를 밝히셔야 합니다.</span></p>      </td>
											</tr>
											<tr>
												<td valign="top">&nbsp;</td>
											</tr>
											<tr>
												<td height="2" valign="top" bgcolor="#128D56"></td>
											</tr>
											<tr>
												<td height="25"><p>제6조 개인정보 수집, 이용, 제공에 대한 동의철회(회원탈퇴)</p></td>
											</tr>
											<tr>
												<td height="1" valign="top" bgcolor="#128D56"></td>
											</tr>
											<tr>
												<td valign="top">&nbsp;</td>
											</tr>
											<tr>
												<td valign="top"><p>회원가입 등을 통해 개인정보의 수집, 이용, 제공에 대해 회원님께서 동의하신 내용을 회원님은 언제든지 철회하실 수 있습니다. 동의철회는<br>마이페이지&gt;회원탈퇴&gt;탈퇴하기 홈페이지를 클릭하거나 개인정보관리책임자에게 서면, 전화, E-mail 등으로 연락하시면 즉시 개인정보의<br>삭제 등 필요한 조치를 하겠습니다.</p>        </td>
											</tr>
											<tr>
												<td valign="top">&nbsp;</td>
											</tr>
											<tr>
												<td height="2" valign="top" bgcolor="#128D56"></td>
											</tr>
											<tr>
												<td height="25"><p>제7조 개인정보의 보유기간 및 이용기간</p></td>
											</tr>
											<tr>
												<td height="1" valign="top" bgcolor="#128D56"></td>
											</tr>
											<tr>
												<td valign="top">&nbsp;</td>
											</tr>
											<tr>
												<td valign="top">원칙적으로, 개인정보 수집 및 이용목적이 달성된 후에는 해당 정보를 지체 없이 파기합니다. <p>
단, 관계법령의 규정에 의하여 보존할 필요가 있는 경우 회사는 아래와 같이 관계법령에서 정한 일정한 기간 동안 회원정보를 보관합니다.<p><br>
○보존 항목 : 결제기록<br>
○보존 근거 : 주문 및 취소, 계약 또는 철회 등에 관한 기록 <br>
○보존 기간 : 3년 (이용자가 계속하여 이용중인 경우는 회원탈퇴시까지 보존됩니다.)<br>
○계약 또는 청약철회 등에 관한 기록 : 5년 (전자상거래등에서의 소비자보호에 관한 법률) <br>
○대금결제 및 재화 등의 공급에 관한 기록 : 5년 (전자상거래등에서의 소비자보호에 관한 법률) <br>
○소비자의 불만 또는 분쟁처리에 관한 기록 : 3년 (전자상거래등에서의 소비자보호에 관한 법률) </td>
											</tr>
											<tr>
												<td valign="top">&nbsp;</td>
											</tr>
											<tr>
												<td height="2" valign="top" bgcolor="#128D56"></td>
											</tr>
											<tr>
												<td height="25"><p>제8조 쿠키의 운영</p></td>
											</tr>
											<tr>
												<td height="1" valign="top" bgcolor="#128D56"></td>
											</tr>
											<tr>
												<td height="1" valign="top">&nbsp;</td>
											</tr>
											<tr>
												<td height="1" valign="top"><p>가) 쿠키란?</p>
														<p><span lang="EN-US" xml:lang="EN-US"> - 회사는 개인화되고 맞춤화된 서비스를 제공하기 위해서 이용자의 정보를 저장하고 수시</span><span lang="EN-US" xml:lang="EN-US">로 불러오는 '쿠키(cookie)'를 사용합니다.</span></p>
														<p><span lang="EN-US" xml:lang="EN-US"> - 쿠키는 웹사이트를 운영하는데 이용되는 서버가 이용자의 브라우저에게 보내는 아주 작</span><span lang="EN-US" xml:lang="EN-US">은 텍스트 파일로 이용자 컴퓨터의 하드디스크에 저장됩니다. 이후 이용자가 웹 사이트</span><span lang="EN-US" xml:lang="EN-US">에 방문할 경우 웹 사이트 서버는 이용자의 하드 디스크에 저장되어 있는 쿠키의 내용을 </span><span lang="EN-US" xml:lang="EN-US">읽어 이용자의 환경설정을 유지하고 맞춤화된 서비스를 제공하기 위해 이용됩니다.</span></p>
														<p><span lang="EN-US" xml:lang="EN-US"> - 쿠키는 개인을 식별하는 정보를 자동적/능동적으로 수집하지 않으며, 이용자는 언제든지 </span><span lang="EN-US" xml:lang="EN-US">이러한 쿠키의 저장을 거부하거나<br>&nbsp; 삭제할 수 있습니다.</span></p>
														<p>나) 회사의 쿠키 사용 목적</p>
														<p>이용자들이 방문한 네이버의 각 서비스와 웹 사이트들에 대한 방문 및 이용형태, 인기 검색어, 보안접속 여부, 뉴스편집, 이용자 규모 등을 파악하여 이용자에게 광고를 포함한 최적화된 맞춤형 정보를 제공하기 위해 사용합니다. </p>
														<p>다) 쿠키의 설치/운영 및 거부</p>
														<p><span lang="EN-US" xml:lang="EN-US"> - 이용자는 쿠키 설치에 대한 선택권을 가지고 있습니다. 따라서 이용자는 웹브라우저에서 </span><span lang="EN-US" xml:lang="EN-US">옵션을 설정함으로써 모든 쿠키를 허용하거나, <br>&nbsp;&nbsp;쿠키가 저장될 때마다 확인을 거치거나, </span><span lang="EN-US" xml:lang="EN-US">모든 쿠키의 저장을 거부할 수도 있습니다.</span></p>
														<p><span lang="EN-US" xml:lang="EN-US"> - 다만, 쿠키의 저장을 거부할 경우에는 로그인이 필요한 네이버 일부 서비스는 이용에 어</span><span lang="EN-US" xml:lang="EN-US">려움이 있을 수 있습니다.</span></p>
														<p><span lang="EN-US" xml:lang="EN-US"> - 쿠키 설치 허용 여부를 지정하는 방법(Internet Explorer의 경우)은 다음과 같습니다.</span></p>
														<p><span lang="EN-US" xml:lang="EN-US"> ① [도구] 메뉴에서 [인터넷 옵션]을 선택합니다.</span></p>
														<p><span lang="EN-US" xml:lang="EN-US"> ② [개인정보 탭]을 클릭합니다.</span></p>
														<p><span lang="EN-US" xml:lang="EN-US"> ③ [개인정보취급 수준]을 설정하시면 됩니다.</span></p></td>
											</tr>
											<tr>
												<td valign="top">&nbsp;</td>
											</tr>
											<tr>
												<td height="2" valign="top" bgcolor="#128D56"></td>
											</tr>
											<tr>
												<td height="25"><p><span lang="EN-US" xml:lang="EN-US">9조 개인정보보호를 위한 기술적 / 관리적 대책</span></p></td>
											</tr>
											<tr>
												<td height="1" valign="top" bgcolor="#128D56"></td>
											</tr>
											<tr>
												<td height="1" valign="top">&nbsp;</td>
											</tr>
											<tr>
												<td height="1" valign="top"><p>가) 당사는 회원님의 개인정보를 취급함에 있어 개인정보가 분실, 도난, 누출, 변조, 또는 <span lang="EN-US" xml:lang="EN-US">훼손되지 않도록 안전성 확보를 위하여 다음과 같은 기술적 대책을 강구하고 있습니다.</span></p>
														<p><span lang="EN-US" xml:lang="EN-US"> ① 회원님의 개인정보는 비밀번호에 의해 보호되고 있습니다. 그러나 회원</span><span lang="EN-US" xml:lang="EN-US">님의 비밀번호는 공공장소에서의 인터넷사용 등 여러 방법으로 타인에</span><span lang="EN-US" xml:lang="EN-US">게 알려질 가능성이 높으므로 이의 보호를 철저히 하는 것이 무엇보다 중요하다고 하겠</span><span lang="EN-US" xml:lang="EN-US">습니다. 그러므로 회원님께서도 개인의 정보를 타인에게 유출시키거나 제공하여서는 아</span><span lang="EN-US" xml:lang="EN-US">니 되며, 자신의 개인정보를 책임 있게 관리하여야 합니다. 이러한 비밀번호</span><span lang="EN-US" xml:lang="EN-US">의 유출에 대해서는 당사는 어떠한 책임도 지지 않습니다.</span></p>
														<p><span lang="EN-US" xml:lang="EN-US"> ② 회원님의 개인정보는 기본적으로 비밀번호에 의해 보호되며, 파</span><span lang="EN-US" xml:lang="EN-US">일 및 전송 데이터를 암호화하여 중요한 데이터는 별도의 보안기능을 통해<br>&nbsp;&nbsp;&nbsp; 보호되고 있</span><span lang="EN-US" xml:lang="EN-US">습니다.</span></p>
														<p>나) 당사는 회원님의 개인정보보호의 중요성을 인식하고 있으며 이를 위해 개인정보취급직<span lang="EN-US" xml:lang="EN-US">원을 최소한으로 제한하고 있으며 개인정보관리책임자가 취급직원을 대상으로 교육을 </span><span lang="EN-US" xml:lang="EN-US">주기적(주1회)으로 실시하여 개인정보보호를 위해 최선을 다하고 있습니다. 또한 본 정</span><span lang="EN-US" xml:lang="EN-US">책에 명시된 이행사항 및 관련 직원의 준수여부를 정기적으로 점검하여 위반내용이 있는 </span><span lang="EN-US" xml:lang="EN-US">경우 이를 시정 또는 개선하고 기타 필요한 조치를 취하도록 하고 있습니다.</span></p>        </td>
											</tr>
											<tr>
												<td valign="top">&nbsp;</td>
											</tr>
											<tr>
												<td height="2" valign="top" bgcolor="#128D56"></td>
											</tr>
											<tr>
												<td height="25"><p>제10조 링크사이트</p></td>
											</tr>
											<tr>
												<td height="1" valign="top" bgcolor="#128D56"></td>
											</tr>
											<tr>
												<td height="1" valign="top">&nbsp;</td>
											</tr>
											<tr>
												<td height="1" valign="top"><p>당사는 회원님께 다른 회사의 웹사이트 또는 자료에 대한 링크를 제공할 수 있습니다. 이 경우 당사는 외부 사이트 및 자료에 대한 아무런 통제권이 없으므로 그로부터 제공받는 서비스나 자료의 유용성에 대해 책임질 수 없으며 보증할 수 없습니다. 당사가 포함하고 있는 링크를 클릭(click)하여 타 사이트(site)의 페이지로 옮겨갈 경우 해당 사이트의 개인정보보호정책은 당사와 무관하므로 새로 방문한 사이트의 정책을 검토해 보시기 바랍니다.</p>      </td>
											</tr>
											<tr>
												<td valign="top">&nbsp;</td>
											</tr>
											<tr>
												<td height="2" valign="top" bgcolor="#128D56"></td>
											</tr>
											<tr>
												<td height="25"><p>제11조 이용자의 권리와 의무</p></td>
											</tr>
											<tr>
												<td height="1" valign="top" bgcolor="#128D56"></td>
											</tr>
											<tr>
												<td height="1" valign="top">&nbsp;</td>
											</tr>
											<tr>
												<td height="1" valign="top"><p>가) 회원님의 개인정보를 최신의 상태로 정확하게 입력하여 불의의 사고를 예방해 주시기 <span lang="EN-US" xml:lang="EN-US">바랍니다. 이용자가 입력한 부정확한 정보로 인해<br>발생하는 사고의 책임은 이용자 자신</span><span lang="EN-US" xml:lang="EN-US">에게 있으며 타인 정보의 도용 등 허위정보를 입력할 경우 회원자격이 상실될 수 있습니</span><span lang="EN-US" xml:lang="EN-US">다.</span></p>
													<p>나) 회원님은 개인정보를 보호받을 권리와 함께 스스로를 보호하고 타인의 정보를 침해하지 <span lang="EN-US" xml:lang="EN-US">않을 의무도 가지고 있습니다. 비밀번호를 포함한 회원님의 개인정보가 유출되지 않도록 </span><span lang="EN-US" xml:lang="EN-US">조심하시고 게시물을 포함한 타인의 개인정보를 훼손하지 않도록 유의해 주십시오. 만약 </span><span lang="EN-US" xml:lang="EN-US">이 같은 책임을 다하지 못하고 타인의 정보 및 존엄성을 훼손 할 시에는 『정보통신망 </span><span lang="EN-US" xml:lang="EN-US">이용촉진 및 정보보호 등에 관한 법률』 등에 의해 처벌받을 수 있습니다.</span></p>      </td>
											</tr>
											
											<tr>
												<td valign="top">&nbsp;</td>
											</tr>
											<tr>
												<td height="2" valign="top" bgcolor="#128D56"></td>
											</tr>
											<tr>
												<td height="25"><p>제12조 민원처리및신고</p></td>
											</tr>
											<tr>
												<td height="1" valign="top" bgcolor="#128D56"></td>
											</tr>
											<tr>
												<td height="1" valign="top">&nbsp;</td>
											</tr>
											<tr>
												<td height="1" valign="top"><p>기타 개인정보에 관한 상담이 필요한 경우에는 개인정보침해신고센터, 대검찰청 인터넷<span lang="EN-US" xml:lang="EN-US">범죄수사센터, 경찰청 사이버테러 대응센터 등으로 문의하실 수 있습니다.</span></p>
										      <p/><span lang="EN-US" xml:lang="EN-US">&lt;아래의 기관은 회사와는 별개의 기관으로서, 회사의 자체적인 개인정보 불만처리, 피해구제 결과에 만족하기 못하시거나 보다 자세한 도움이 필요하시면 문의하여 주시기 바랍니다.&gt;</span></p>
													<p/>▶ 개인정보 침해신고센터 (한국인터넷진흥원 운영) </p>
													<p><span lang="EN-US" xml:lang="EN-US"> - 소관업무 : 개인정보 침해사실 신고, 상담 신청 </span></p>
													<p><span lang="EN-US" xml:lang="EN-US"> - 홈페이지 : privacy.kisa.or.kr </span></p>
													<p><span lang="EN-US" xml:lang="EN-US"> - 전화 : (국번없이) 118 </span></p>
													<p><span lang="EN-US" xml:lang="EN-US"> - 주소 : </span><span lang="EN-US" xml:lang="EN-US">(138-950) 서울시 송파구 중대로 135 한국인터넷진흥원 개인정보침해신고센터</span></p>
													<p/>▶ 개인정보 분쟁조정위원회 (한국인터넷진흥원 운영) </p>
													<p><span lang="EN-US" xml:lang="EN-US"> - 소관업무 : 개인정보 분쟁조정신청, 집단분쟁조정 (민사적 해결) </span></p>
													<p><span lang="EN-US" xml:lang="EN-US"> - 홈페이지 : privacy.kisa.or.kr </span></p>
													<p><span lang="EN-US" xml:lang="EN-US"> - 전화 : (국번없이) 118 </span></p>
													<p><span lang="EN-US" xml:lang="EN-US"> - 주소 : </span><span lang="EN-US" xml:lang="EN-US">(138-950) 서울시 송파구 중대로 135 한국인터넷진흥원 개인정보침해신고센터</span></p>
													<p/>▶ 대검찰청 사이버범죄수사단 : 02-3480-3573 (www.spo.go.kr)</p>
													<p/>▶ 경찰청 사이버테러대응센터 : 1566-0112 (www.netan.go.kr) </p>      </td>
											</tr>
											
											<tr>
												<td valign="top">&nbsp;</td>
											</tr>
											<tr>
												<td height="2" valign="top" bgcolor="#128D56"></td>
											</tr>
											<tr>
												<td height="25"><p>제13조 아동의 개인정보 보호</p></td>
											</tr>
											<tr>
												<td height="1" valign="top" bgcolor="#128D56"></td>
											</tr>
											<tr>
												<td height="1" valign="top">&nbsp;</td>
											</tr>
											<tr>
												<td height="1" valign="top"><p>당사는 만 14세 미만 아동의 개인정보를 보호하기 위하여 당사 회원가입을 만 14세 이상이 되어야 가능하도록 하여 아동의 개인정보를<br> 수집하지 않습니다.</p></td>
											</tr>
											
											<tr>
												<td valign="top">&nbsp;</td>
											</tr>
											<tr>
												<td height="2" valign="top" bgcolor="#128D56"></td>
											</tr>
											<tr>
												<td height="25"><p>제14조 개인정보관리책임자</p></td>
											</tr>
											<tr>
												<td height="1" valign="top" bgcolor="#128D56"></td>
											</tr>
											<tr>
												<td height="1" valign="top">&nbsp;</td>
											</tr>
											<tr>
												<td height="1" valign="top"><p>당사는 회원님이 좋은 정보를 안전하게 이용할 수 있도록 최선을 다하고 있습니다.</p>
													<p>개인정보를 보호하는데 있어 회원님께 고지한 사항들에 반하는 사고가 발생할 시에 개인정보관리책임자가 모든 책임을 집니다. 그러나 기술적인 보완조치를 했음에도 불구하고, 해킹 등 기본적인 네트워크상의 위험성에 의해 발생하는 예기치 못한 사고로 인한 정보의 훼손 및 방문자가 작성한 게시물에 의한 각종 분쟁에 관해서 당사는 책임이 없습니다. 회원님의 개인정보를 취급하는 책임자는 다음과 같으며 개인정보 관련 문의사항에 신속하고 성실하게 답변해 드리고 있습니다.</p>
													<p/>▶ 개인정보 보호책임자 </p>
													<p><span lang="EN-US" xml:lang="EN-US"> 성명 : 이형준 </span></p>
												  <p><span lang="EN-US" xml:lang="EN-US"> 연락처 : 031-278-6111 </span></p>
												  <p><span lang="EN-US" xml:lang="EN-US"> 전자메일 :taegeum11@naver.com</span></p>
											  </td>
											</tr>
											
											<tr>
												<td valign="top">&nbsp;</td>
											</tr>
											<tr>
												<td height="2" valign="top" bgcolor="#128D56"></td>
											</tr>
											<tr>
												<td height="25"><p>제15조 개인정보 파기절차 및 방법</p></td>
											</tr>
											<tr>
												<td height="1" valign="top" bgcolor="#128D56"></td>
											</tr>
											<tr>
												<td height="1" valign="top">&nbsp;</td>
											</tr>
											<tr>
												<td height="1" valign="top"><p>이용자의 개인정보는 원칙적으로 개인정보의 수집 및 이용목적이 달성되면 지체 없이 파기합니다. 회사의 개인정보 파기절차 및 방법은 다음과 같습니다.</p>
													<p><span lang="EN-US" xml:lang="EN-US"> 가) 파기절차</span></p>
													<p><span lang="EN-US" xml:lang="EN-US"> - 이용자가 회원가입 등을 위해 입력한 정보는 목적이 달성된 후 별도의 DB로 옮겨져(종</span><span lang="EN-US" xml:lang="EN-US">이의 경우 별도의 서류함) 내부 방침 및 기타 관련 법령에 의한 정보보호 사유에 따라</span><span lang="EN-US" xml:lang="EN-US">(보유 및 이용기간 참조)일정 기간 저장된 후 파기됩니다.</span></p>
													<p><span lang="EN-US" xml:lang="EN-US"> - 동 개인정보는 법률에 의한 경우가 아니고서는 보유되는 이외의 다른 목적으로 이용되</span><span lang="EN-US" xml:lang="EN-US">지 않습니다.</span></p>
													<p><span lang="EN-US" xml:lang="EN-US"> 나) 파기방법</span></p>
													<p><span lang="EN-US" xml:lang="EN-US"> - 종이에 출력된 개인정보는 분쇄기로 분쇄하거나 소각을 통하여 파기합니다.</span></p>
													<p><span lang="EN-US" xml:lang="EN-US"> - 전자적 파일 형태로 저장된 개인정보는 기록을 재생할 수 없는 기술적 방법을 사용하</span>여 삭제합니다. </p>      </td>
											</tr>
											
											<tr>
												<td valign="top">&nbsp;</td>
											</tr>
											<tr>
												<td height="2" valign="top" bgcolor="#128D56"></td>
											</tr>
											<tr>
												<td height="25"><p>제16조 고지의 의무<span lang="EN-US" xml:lang="EN-US"> </span></p></td>
											</tr>
											<tr>
												<td height="1" valign="top" bgcolor="#128D56"></td>
											</tr>
											<tr>
												<td height="1" valign="top">&nbsp;</td>
											</tr>
											<tr>
												<td height="1" valign="top"><p>개인정보처리방침 내용 추가, 삭제 및 수정이 있을 시에는 개정 최소 7일전부터 홈페이지의 '공지사항'을 통해 고지할 것입니다. 다만, 개인정보의 수집 및 활용, 제3자 제공 등과 같이 이용자 권리의 중요한 변경이 있을 경우에는 최소 30일 전에 고지합니다.</p>
													<p/><span lang="EN-US" xml:lang="EN-US">- 공고일자 : 2014년 6월 1일</span></p>
													<p><span lang="EN-US" xml:lang="EN-US">- 시행일자 : 2014년 7월 1일</span></p></td>
											</tr>
									</table>
									</td>
								</tr>
						  </table>
						</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
	<!-- footer -->
 </div> 

	<? include "../inc/bottom.php" ?>
</div>
</body>
</html>

<script type="text/javascript">
function auctionView(idx) {
	window.location.href="sub02_1_view.php?idx="+idx;
}
</script>
