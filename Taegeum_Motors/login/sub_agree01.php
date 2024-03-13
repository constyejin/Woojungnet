<?include "../inc/header.php" ?>
 
<?
$idx = $_GET['idx'];
if(!$idx)$mode = 'regist';
else $mode = 'modify';
if ($__NFUpload['limit_ext'] != ''){
	preg_match('/[.]+('.str_replace(';', '|', $__NFUpload['limit_ext']).')+/i', $_FILES['upfile']['name'], $mc);
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
	NfUpload.FileUpload();
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
					이용약관
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
							<li class="on"><a href="/login/sub_agree01.php"><span>이용약관</span></a></li>
						  <li><a href="/login/sub_agree02.php"><span>개인정보처리방침</span></a></li>
					  </ul>
					</div>
				  <table border="0" align="center" cellpadding="0" cellspacing="0" class="tbl_terms" style="border:1px solid #E6E6E6; margin-top:30px; margin-bottom:70px;width:1200px;">
					<tr>
						<td height="5"></td>
					</tr>
				  <!--출품자정보-->
				  <tr> 
						<td id="sub_use">
							<table cellpadding="0" cellspacing="0" class="use_list" width="1200">
								<tr>
									<td>
										<table>
											<tr>
												<td class="list_u_title">▣ 이용약관</td>
											</tr>
											<tr>
												<td class="list_u_stitle">제 1 장 총 칙</td>
											</tr>
										</table>
									</td>
								</tr>
								<tr>
									<td class="u_list_con">
										<table border="0" cellspacing="0" cellpadding="0" align="center">
											<tr>
												<td height="2" bgcolor="#128D56"></td>
											</tr>
											<tr>
												<td height="25">제1조【목적】</td>
											</tr>
											<tr>
												<td height="1" valign="top" bgcolor="#128D56"></td>
											</tr>
											<tr>
												<td valign="top">&nbsp;</td>
											</tr>
											<tr>
												<td valign="top"> 이 약관은 (주)태금모터스 이하 "회사"라 합니다)이 관리·운영하는 인터넷 사이트를 통하여 제공하는 자동차 경매서비스 및 기타 정보서비스(이하 "서비스"라 합니다)와 관련하여 회사와 모든 회원간의 권리와 의무, 책임사항 및 회원의 서비스이용 절차에 관한 사항을 규정함을 목적으로 합니다.
</td>
											</tr>
											<tr>
												<td valign="top">&nbsp;</td>
											</tr>
											<tr>
												<td height="2" valign="top" bgcolor="#128D56"></td>
											</tr>
											<tr>
												<td height="25">제 2 조 【약관의 효력 및 변경】</td>
											</tr>
											<tr>
												<td height="1" valign="top" bgcolor="#128D56"></td>
											</tr>
											<tr>
												<td valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
														<tr>
															<td width="20" valign="top">①</td>
															<td valign="top">① 본 약관은 서비스를 이용하고자 하는 회원이 인지할 수 있도록 회사가 제공하는 인터넷사이트 화면에 게시합니다.
<br /></td>
														</tr>
														<tr>
															<td width="20" valign="top">②</td>
															<td valign="top">② 회사가 이 약관을 개정하는 경우에는 개정된 약관의 적용일자 및 개정사유를 명시하여 회원이 인지할 수 있도록 그 적용일자 5일 이전부터 적용일자 전일까지 ①항의 방법으로 공지합니다. 
<br /></td>
														</tr>
														<tr>
															<td width="20" valign="top">③</td>
															<td valign="top">③ 약관의 효력은 회원등록신청(일반회원제외)에 대해 회사의 회원승낙이 이루어진 시점부터 발생하며 회사가 약관을 개정한 경우에는 소급적용을 하지 아니합니다. 
</td>
														</tr>
												</table></td>
											</tr>
											<tr>
												<td valign="top">&nbsp;</td>
											</tr>
											<tr>
												<td height="2" valign="top" bgcolor="#128D56"></td>
											</tr>
											<tr>
												<td height="25">제 3 조【관계법령과의 관계】</td>
											</tr>
											<tr>
												<td height="1" valign="top" bgcolor="#128D56"></td>
											</tr>
											<tr>
												<td valign="top">&nbsp;</td>
											</tr>
											<tr>
												<td valign="top">본 약관에 명시 되지 아니한 사항에 대해서는 전자거래기본법, 전기통신사업법, 정보통신망이용촉진 및 정보보호관련법률, 전자상거래 등에서의 소비자 보호에 관한 법률 및 기타 관련 법령의 규정과 일반적인 상거래에 의합니다. 
</td>
											</tr>
											<tr>
												<td valign="top">&nbsp;</td>
											</tr>
											<tr>
												<td height="2" valign="top" bgcolor="#128D56"></td>
											</tr>
											<tr>
												<td height="25">제 4조 【용어의 정의】</td>
											</tr>
											<tr>
												<td height="1" valign="top" bgcolor="#128D56"></td>
											</tr>
											<tr>
												<td valign="top">&nbsp;</td>
											</tr>
											<tr>
												<td valign="top">① 이 약관에서 사용하는 주요한 용어의 정의는 다음과 같습니다.
<br />
														<table width="100%"  border="0" cellspacing="0" cellpadding="0">
															<tr>
																<td width="20" valign="top">1.</td>
																<td valign="top"> 제휴회원: 보험자산(도난회수 및 손상차량등)을 매각할 목적으로 회사의 인터넷 사이트에 정보를 제공하는 손해보험회사, 할부금융사, 운송회사 및 공제조합 등을 말합니다.
<br /></td>
															</tr>
															<tr>
																<td width="20" valign="top">2</td>
																<td valign="top"> 입찰회원: 자동차정비, 폐차, 부품판매, 중고차매매, 무역업 등 자동차와 관련된 제반 업무에 종사하는 회사/회원으로 도난 및 손상차량을 구매할 목적으로 회사와 서비스이용계약을 체결하고 이용자 아이디(ID)를 부여 받은 회사/ 회원을 말합니다.
<br /></td>
															</tr>
															<tr>
																<td valign="top">3</td>
																<td valign="top"> 일반회원: 제휴사 및 정회원을 제외한 회원으로 회사의 인터넷사이트열람은 물론 손상차량 및 일반차량을 판매하고 중고부품매매를 위하여 접수할 수 있는 인터넷 일반 이용자를 말합니다.
<br /></td>
															</tr>
															<tr>
																<td valign="top">4</td>
																<td valign="top"> 아이디: 회원의 식별과 회원의 서비스 이용을 위하여 회원이 선정하고 회사가 승인한 문자나 숫자 혹은 그 조합을 말합니다.(이하 "ID"라 합니다).
<br /></td>
															</tr>
															<tr>
																<td valign="top">5</td>
																<td valign="top"> 비밀번호: 회원이 부여받은 ID와 일치된 회원임을 확인하고, 회원 자신의 비밀을 보호하기 위하여 회원이 정한 문자와 숫자의 조합을 말합니다.
<br /></td>
															</tr>
															<tr>
																<td valign="top">6</td>
																<td valign="top"> 접수: 제휴사와 일반회원이 도난차량 또는 손상차량 및 일반차량을 판매할 목적으로 경매사이트에 신청하는 것을 말합니다.
<br /></td>
															</tr>
															<tr>
																<td valign="top">7</td>
																<td valign="top"> 입찰: 회사경매사이트에 출품된 경매물품을 구매하기 위하여 원하는 매수가격을 제출하는 행위를 말합니다.
<br /></td>
															</tr>
															<tr>
																<td valign="top">8</td>
																<td valign="top"> 낙찰: 최고가 입찰에 의하여 회사와 정회원간의 경매물품거래가 성립되는 것을 말합니다.
<br /></td>
															</tr>
															<tr>
																<td valign="top">9</td>
																<td valign="top"> 경매: 출품된 경매물품의 시작가와 현재가(이하 내정가라 합니다)를 명시하여 입찰을 진행하며 입찰자 중 최고가격 입찰자에게 낙찰이 이루어지는 경매방식을 말합니다.
<br /></td>
															</tr>
															<tr>
																<td valign="top">10</td>
																<td valign="top"> 공매: 출품된 경매물품의 내정가를 명시하지 않으며 입찰자가 차량의 구입용도를 선택하여 희망 입찰가를 기재하고 정해진 기간에 최고가를 제시한 입찰자에게 거래가 이루어지는 방식입니다. 단, 경매와 달리 공매는 출품자의 특별한 사정에 따라 거래가 취소될 수 있습니다.
<br /></td>
															</tr>
															<tr>
																<td valign="top">11</td>
																<td valign="top"> 매매보호 서비스: 회사가 경매서비스를 통하여 회원 상호간에 이루어지는 거래의 안전을 위하여 물품대금의 입출금을 중개할 목적으로 마련한 절차를 말합니다. 
</td>
															</tr>
															<tr>
																<td valign="top">12</td>
																<td valign="top"> 해 지: 회사 또는 회원이 서비스 이용계약을 해약하는 것을 말합니다.
<br />
																</td>
															</tr>
													</table></td>
											</tr>
											<tr>
												<td valign="top">&nbsp;</td>
											</tr>
											<tr>
												<td valign="top">② ①항에서 정의되지 않은 이 약관상의 용어의 의미는 일반적인 상거래에 의합니다.</td>
											</tr>
											<tr>
												<td valign="top">&nbsp;</td>
											</tr>
											<tr>
												<td height="2" valign="top" bgcolor="#128D56"></td>
											</tr>
											<tr>
												<td height="25"><strong>제 2 장 서비스의 이용계약체결</strong></td>
											</tr>
											<tr>
												<td height="25">제 5 조 【경매서비스의 성질과 목적】 </td>
											</tr>
											<tr>
												<td height="1" valign="top" bgcolor="#128D56"></td>
											</tr>
											<tr>
												<td valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
														<tr>
															<td valign="top">경매서비스는 회사가 회원 각자의 의사결정에 의하여 제휴사와 회원 상호간에 매매거래가 이루어질 수 있도록 온라인상에 사이버 거래 장소(marketplace)를 제공하는 것을 말합니다. 회사는 경매서비스를 통하여 이루어지는 회원간의 판매 및 구매와 관련하여 판매의사 또는 구매의사의 존부 및 진정성, 등록물품의 품질, 완전성, 안전성, 적법성 및 타인의 권리에 대한 비침해성, 회원이 입력하는 정보 및 그 정보를 통하여 링크된 URL에 게재된 자료의 진실성 등 일체에 대하여 보증하지 아니하며, 이와 관련한 일체의 위험과 책임은 해당 회원이 부담해야 합니다.
</td>
														</tr>
												</table></td>
											</tr>
											<tr>
												<td valign="top">&nbsp;</td>
											</tr>
											<tr>
												<td height="2" valign="top" bgcolor="#128D56"></td>
											</tr>
											<tr>
												<td height="25">제 6 조 【서비스 이용계약의 성립】</td>
											</tr>
											<tr>
												<td height="1" valign="top" bgcolor="#128D56"></td>
											</tr>
											<tr>
												<td valign="top">&nbsp;</td>
											</tr>
											<tr>
												<td valign="top">회사가 제공하는 서비스를 이용하고자 하는 자의 회원가입 신청 후 회사가 회원가입신청에 대하여 승낙함으로써 이용계약이 성립하며 이와 동시에 서비스를 이용할 수 있습니다. 회사는 이용승낙의 의사를 해당 서비스화면에 게시하거나, email 또는 팩스, 문자서비스 등 기타 방법으로 이용신청자에게 통지합니다. 
</td>
											</tr>
											<tr>
												<td valign="top">&nbsp;</td>
											</tr>
											<tr>
												<td height="2" valign="top" bgcolor="#128D56"></td>
											</tr>
											<tr>
												<td height="25">제 7 조【이용신청】</td>
											</tr>
											<tr>
												<td height="1" valign="top" bgcolor="#128D56"></td>
											</tr>
											</tr>
											<tr>
												<td valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
														<tr>
															<td valign="top">① </td>
															<td valign="top">&nbsp;회원으로 가입하여 서비스를 이용하기를 희망하는 자는 회사가 정한 소정의 가입신청서를 작성하여 우편 및 FAX로 제출하거나, 온라인으로 신청합니다. 
</td>
														</tr>
														<tr>
															<td valign="top">② </td>
															<td valign="top">&nbsp;입찰회원으로 가입하고자 하는 자는 이용약관 동의 후 회사가 요구하는 필요서류를 다음과 같이 제출하고 회사가 확인절차를 거친 다음 이용 신청에 대하여 회사가 승낙함으로써 서비스이용계약이 성립합니다. 
</td>
														</tr>
														<tr>
															<td valign="top">&nbsp;</td>
															<td valign="top">1. 약관 준법서약서(인감날인요함)<br />
																2. 사업자등록증사본<br />
																3. 자동차 관리사업 등록증<br />
																4. 개인/법인 인감증명서원본(1개월 이내 발급된 것에 한함)<br />
																5. 법인의 경우 법인등기부등본<br>
																6. 주거래은행 통장 사본(법인회사는 법인통장, 개인사업자는 회사대표통장으로 함)<br />
																7. 입찰회원 보증금 납입증명서 사본(보증보험 가입 시, 보증증권 가입 증명서로 함)<br />
																8. 입찰회원 경매 담당자 등록신청서(인감날인요함)<br />
																9. 입찰회원 경매 담당자의 재직증명서 (인감날인요함)<br />
																</td>
														</tr>
														<tr>
															<td valign="top">③</td>
															<td valign="top">&nbsp;온라인 가입신청 양식에 기재하는 모든 회원 정보는 실제 데이터인 것으로 간주되므로 실명이나 실제 정보를 입력하지 않은 사용자는 법적인 보호를 받을 수 없으며, 서비스 이용의 제한을 받으실 수 있습니다. 
</td>
														</tr>
												</table></td>
											</tr>
											<tr>
												<td valign="top">&nbsp;</td>
											</tr>
											<tr>
												<td height="2" valign="top" bgcolor="#128D56"></td>
											</tr>
											<tr>
												<td height="25">제 8 조【이용신청에 대한 승낙의 제한】</td>
											</tr>
											<tr>
												<td height="1" valign="top" bgcolor="#128D56"></td>
											</tr>
											<tr>
												<td height="1" valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
														<tr>
															<td colspan="2" valign="top">① 회사는 다음 각 호에 해당하는 회원의 경우 이용신청에 대한 승낙을 제한할 수 있고, 그 사유가 해소될 때까지 승낙을 유보할 수 있습니다.
<br />
															</td>
														</tr>
														<tr>
															<td width="20" valign="top">&nbsp;</td>
															<td valign="top">1. 서비스 관련 설비에 여유가 없는 경우<br />
																2. 기술상 지장이 있는 경우<br />
																3. 기타 회사가 합리적인 판단에 의하여 필요하다고 인정하는 경우<br /></td>
														</tr>
														<tr>
															<td colspan="2" valign="top">② 회사는 다음 각 호에 해당하는 회원의 경우 이용신청에 대한 승낙을 거부할 수 있습니다. </td>
														</tr>
														<tr>
															<td width="20" valign="top">&nbsp;</td>
															<td valign="top">1. 본인의 실명으로 신청하지 않은 경우<br />
																2. 이미 가입된 회원과 이름 및 주민등록번호(또는 사업자등록번호, 법인등록번호)가 동일한 경우<br />
																3. 다른 사람의 명의를 도용하여 신청한 경우<br />
																4. 이용신청 시 필요 사항을 허위로 기재하여 신청한 경우<br />
																5. 본 약관 제 9조에 기하여 회사가 이용계약을 해지한 전(前)회원이 재이용신청을하는 경우<br />
																6. 이 약관 제 11조에 기하여 회사로부터 회원자격정지조치를 받은 회원이 이용정지 중에 이용 계약을 임의해지하고 재이용신청을 하는 경우
<br />
																7. 사회의 안녕과 질서 혹은 미풍양속을 저해한 사람 및 그 목적으로 신청한 경우<br>
																8. 회사에서의 기타 사유에 대한 결격사유로 판단되는 경우<br>
																</td>
														</tr>
														<tr>
															<td colspan="2" valign="top">③ 회사는 ①항 또는②항에 의하여 이용신청의 승낙을 유보하거나 승낙하지 아니하는 경우 이를 이용신청자에게 그 사실을 통보하여야 한다. 다만, 회사의 귀책사유 없이 이용신청자에게 통지할 수 없는 경우는 예외로 합니다.
</td>
														</tr>
												</table></td>
											</tr>
											<tr>
												<td valign="top">&nbsp;</td>
											</tr>
											<tr>
												<td height="2" valign="top" bgcolor="#128D56"></td>
											</tr>
											<tr>
												<td height="25">제 9 조【이용계약의 종료】</td>
											</tr>
											<tr>
												<td height="1" valign="top" bgcolor="#128D56"></td>
											</tr>
											<tr>
												<td valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
														<tr>
															<td width="20" valign="top">①</td>
															<td valign="top"> 회원 또는 회사는 이 약관에서 정한 절차에 따라 이용계약을 해지할 수 있습니다.<br /></td>
														</tr>
														<tr>
															<td width="20" valign="top">②</td>
															<td valign="top">회원의 해지<br /></td>
														</tr>
														<tr>
															<td valign="top">&nbsp;</td>
															<td valign="top">1. 회원은 언제든지 회사에게 해지의사를 통지함으로써 이용계약을 해지할 수 있으며 회사는 즉시 회원 탈퇴를 처리해야 합니다. 다만, 회원은 해지의사를 통지하기 전에 모든 구매 또는 판매중인 경매절차를 완료, 철회 또는 취소해야만 합니다. 이 경우 경매의 철회 또는 취소로 인한 불이익은 회원 본인이 부담하여야 합니다.
<br />
																2. 이용계약은 회원의 해지의사가 회사에 도달한 때에 종료됩니다.
<br />
																3. 본 항에 따라 해지를 한 회원은 이 약관이 정하는 회원가입절차와 관련조항에 따라 회원으로 재가입할 수 있습니다.
<br /></td>
														</tr>
														<tr>
															<td width="20" valign="top">③</td>
															<td valign="top">회사의 해지<br /></td>
														</tr>
														<tr>
															<td valign="top">&nbsp;</td>
															<td valign="top">1. 회사는 다음과 같은 사유가 있는 경우, 이용계약을 해지할 수 있습니다. 이 경우 회사는 회원에게 email, 전화, 팩스 기타의 방법을 통하여 해지사유를 밝혀 해지의사를 통지합니다. 다만, 회사는 해당 회원에게 사전에 해지사유에 대한 의견진술의 기회를 부여할 수 있습니다.
<br />
															⒜ 회원에게 제8조에서 정하고 있는 이용계약에 대한 승낙제한사유가 있음이 확인된 경우<br />
⒝ 회원이 매매부적합물품을 판매등록하거나, 기타 공공질서 및 미풍양속에 위배되는 물품거래 행위를 하거나 시도한 경우<br />
⒞ 회원이 회사나 다른 회원 기타 타인의 권리나 명예, 신용 등 정당한 이익을 침해하는 행위를 한 경우<br />
⒟ 회원이 직거래 등 회사가 제공하는 서비스의 원활한 진행을 방해하는 행위를 하거나 시도한 경우<br />
⒠ 회원이 실제로 물품을 판매하고자 하는 의사 없이 물품등록을 한 경우(이하 "판매가장등록"이라 합니다) 또는 이를 알고 낙찰 받은 것으로 인정되는 경우<br />
⒡ 기타, 회원이 이 약관과 정회원 준수서약서에 위배되는 행위를 한 경우<br />

																2. 이용계약은 회사의 해지의사가 회원에게 도달한 때에 종료되나, 회원이 제공한 연락처 정보의 오류로 인하여 회사가 해지의사를 통지할 수 없는 경우에는 회사가 MYPAGE에 해지의사를 공지하는 때에 종료됩니다.
<br />
																3. 회사가 이용계약을 해지하는 경우, 회사는 별도의 통지 없이 해당 회원과 관련된 경매를 취소할 수 있습니다.
<br />
																4. 이용계약의 종료와 관련하여 발생한 손해는 이용계약이 종료된 해당 회원이 책임을 부담하여야 하고, 회사는 일체의 책임을 지지않습니다.
<br /></td>
														</tr>
												</table></td>
											</tr>
											<tr>
												<td valign="top">&nbsp;</td>
											</tr>
											<tr>
												<td height="2" valign="top" bgcolor="#128D56"></td>
											</tr>
											<tr>
												<td height="25">제 10 조 【서비스 이용시간】</td>
											</tr>
											<tr>
												<td height="1" valign="top" bgcolor="#128D56"></td>
											</tr>
											<tr>
												<td height="1" valign="top">
													<table width="100%"  border="0" cellspacing="0" cellpadding="0">
															<tr>
																<td width="20" valign="top">①</td>
																<td valign="top"> 서비스의 이용은 회사의 업무상 또는 기술상 특별한 지장이 없는 한 연중무휴 1일 24시간 가능함을 원칙으로 합니다. 다만 정기 점검 등의 필요로 회사가 정한 날이나 시간은 그러하지 않습니다.
<br /></td>
															</tr>
															<tr>
																<td width="20" valign="top">② </td>
																<td valign="top"> 회사는 서비스를 일정범위로 분할하여 각 범위별로 이용가능 시간을 별도로 정할 수 있습니다. 이 경우 사전에 공지를 통해 그 내용을 알립니다. 
</td>
															</tr>
													</table></td>
											</tr>
											<tr>
												<td valign="top">&nbsp;</td>
											</tr>
											<tr>
												<td height="2" valign="top" bgcolor="#128D56"></td>
											</tr>
											<tr>
												<td height="25">제 11 조【서비스이용의 정지 및 제재】</td>
											</tr>
											<tr>
												<td height="1" valign="top" bgcolor="#128D56"></td>
											</tr>
											<tr>
												<td height="1" valign="top">
													<table width="100%"  border="0" cellspacing="0" cellpadding="0">
															<tr>
																<td>다음 각항에 해당할 경우 회사는 회원의 서비스이용을 제재할 수 있습니다.
</td>
															</tr>
															<tr>
																<td valign="top">&nbsp;</td>
															</tr>
															<tr>
																<td valign="top">① 차량낙찰시 특별한 사유 없이 차량인수를 회피하거나 계약사항을 위반 또는 미이행할 경우 거부한날로부터 경·공매 입찰참가 자격이 30일간 정지됩니다. 또한, 회사는 해당 차량의 추가보관료 및 과태료 경매지연손해배상금 등을 청구할 수 있습니다. 경공매 입찰자격 정지 1회 이후 추가 입찰자격 정지 사유 발생 시 입찰회원 계약이 해지됩니다.(단, 2순위, 3순위 낙찰승계 후 차액을 부담하는 경우는 해당되지 않습니다.)</td>
															</tr>
															<tr>
																<td valign="top">② 경매 입찰 시 업무 방해를 목적으로 고의로 고가 입찰 후 차량인수를 포기하는 경우에는 
 ①항의 제재와 더불어 회사가 지정하는 손해배상금을 예치한 보증금에서 공제합니다. 
<br /></td>
															</tr>
															<tr>
																<td valign="top">③ 고의 또는 특별한 사유 없이 회사가 지정한 기일까지 명의 이전을 지연시키는 경우 입찰회원사 자격이 정지됩니다. 
</td>
															</tr>
															<tr>
																<td valign="top">④ 매매부적합물품을 판매등록하거나 기타 공공질서파괴 및 미풍양속에 위배되는 비정상물품거래 행위를 하거나 시도함으로써 형사처벌을 받은 경우및 입찰회원의 아이디 비밀번호를 노출하여 타인이 사용는 경우 정회원사 자격이 영구히 박탈 될수 있습니다. 이때 회사는 홈페이지에 당 회원사에 대한 신상과 위법사실을 3개월 동안 공지할 수 있습니다.
</td>
															</tr>
															<tr>
																<td valign="top">⑤ 입찰회원 자격이 정지된 경우 1회에 한하여 회사의 재승인절차를 통하여 입찰회원은 서비스이용이 가능합니다. 이때 입찰회원은 회사가 제시하는 추가보증금 납입 및 확약서를 제출하여야 하며 추가보증금을 포함한 보증금전액은 인수차량의 귀책사유가 발생하는 경우 손해배상금으로 사용됩니다. 또한, 손해배상액이 보증금을 초과하는 경우 회사는 추가 배상액을 청구할 수 있으며, 입찰회원사 자격은 영구히 상실됩니다.
</td>
															</tr>
													</table></td>
											</tr>
											<tr>
												<td valign="top">&nbsp;</td>
											</tr>
											<tr>
												<td height="2" valign="top" bgcolor="#128D56"></td>
											</tr>
											<tr>
												<td height="25">제 12 조 【서비스제공의 중지 등】</td>
											</tr>
											<tr>
												<td height="1" valign="top" bgcolor="#128D56"></td>
											</tr>
											<tr>
												<td height="1" valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
														<tr>
															<td width="20" valign="top">①</td>
															<td valign="top"> 회사는 다음 각 호에 해당하는 경우 서비스 제공을 중지할 수 있습니다.
<br /></td>
														</tr>
														<tr>
															<td valign="top">&nbsp;</td>
															<td valign="top">1. 서비스용 설비의 보수 등 공사로 인한 부득이한 경우<br />
																2. 전기통신사업법에 규정된 기간통신사업자가 전기통신서비스를 중지했을 경우<br />
																3. 3.	기타 불가항력적 사유가 있는 경우<br /></td>
														</tr>
														<tr>
															<td width="20" valign="top">②</td>
															<td valign="top"> 회사는 국가비상사태, 정전, 서비스 설비의 장애 또는 서비스 이용의 폭주 등으로 정상적인 서비스 이용에 지장이 있는 때에는 서비스의 전부 또는 일부를 제한하거나 중지할 수 있습니다.
<br /></td>
														</tr>
														<tr>
															<td width="20" valign="top">③</td>
															<td valign="top"> 회사는 ①항 및 ②항의 규정에 의하여 서비스의 이용을 제한하거나 중지한 때에는 그 사유 및 제한기간 등을 지체 없이 회원에게 알려야 합니다. <br /></td>
														</tr>
												</table></td>
											</tr>
											<tr>
												<td valign="top">&nbsp;</td>
											</tr>
											<tr>
												<td height="2" valign="top" bgcolor="#128D56"></td>
											</tr>
											<tr>
												<td height="25">제 13 조 【계약사항의 변경】</td>
											</tr>
											<tr>
												<td height="1" valign="top" bgcolor="#128D56"></td>
											</tr>
											<tr>
												<td height="1" valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
														<tr>
															<td width="20" valign="top">①</td>
															<td valign="top"> 회원은 개인정보관리 를 통해 언제든지 본인의 개인정보를 열람하고 수정할 수 있습니다. 단, 아이디(ID), 주민등록번호(사업자등록 또는 법인등록번호) 및 성명은 수정할 수 없음을 원칙으로 합니다.
<br /></td>
														</tr>
														<tr>
															<td width="20" valign="top">②</td>
															<td valign="top"> 회원정보가 변경되었음에도 해당 사항을 수정하지 않음으로써 발생한 각종 손해와 잘못된 수정으로 인하여 발생한 손해는 당해 회원이 부담하여야 하며, 회사는 이에 대하여 아무런 책임을 지지 않습니다. 
</td>
														</tr>
												</table></td>
											</tr>
											<tr>
												<td valign="top">&nbsp;</td>
											</tr>
											<tr>
												<td height="2" valign="top" bgcolor="#128D56"></td>
											</tr>
											<tr>
												<td height="25">제 14 조【개인정보의 보호】</td>
											</tr>
											<tr>
												<td height="1" valign="top" bgcolor="#128D56"></td>
											</tr>
											<tr>
												<td height="1" valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
														<tr>
															<td width="20" valign="top">① </td>
															<td valign="top"> 회사는 회원의 개인정보를 보호하고 존중합니다.
 <br /></td>
														</tr>
														<tr>
															<td width="20" valign="top">②</td>
															<td valign="top"> 회사는 이용신청 시 회원이 제공하는 정보, 커뮤니티 활동, 각종 이벤트 참가를 위하여 회원이 제공하는 정보 등을 통하여 회원에 관한 정보를 수집하며, 회원의 개인정보는 본 이용계약의 이행과 이용계약상의 서비스제공을 위한 목적으로 사용됩니다.
<br /></td>
														</tr>
														<tr>
															<td valign="top">③</td>
															<td valign="top"> 회사는 서비스 제공과 관련하여 취득한 회원의 신상정보를 본인의 승낙 없이 제3자에게 누설 또는 배포할 수 없으며 상업적 목적으로 사용할 수 없습니다. 다만, 다음의 각 호에 해당하는 경우에는 그러하지 아니합니다.
<br /></td>
														</tr>
														<tr>
															<td valign="top">&nbsp;</td>
															<td valign="top">1. 관계 법령에 의하여 수사상의 목적으로 관계기관으로부터 요구가 있는 경우<br />
																2. 정보 통신 윤리위원회의 요청이 있는 경우<br />
																3. 기타 관계법령에서 정한 절차에 따른 요청이 있는 경우<br />
																4. 제휴사의 감사 시 감사목적으로 요청이 있는 경우</td>
														</tr>
														<tr>
															<td valign="top">④</td>
															<td valign="top"> ③항의 범위 내에서 회사는 업무와 회원 전체 또는 개인정보에 관한 집합적인 통계 자료를 작성하여 이를 사용할 수 있고, 서비스를 통하여 회원의 컴퓨터에 쿠키를 전송할 수 있습니다. 이 경우 회원은 쿠키의 수신을 거부하거나 쿠키의 수신에 대하여 경고 하도록 사용하는 컴퓨터의 브라우저의 설정을 변경할 수 있습니다. </td>
														</tr>
												</table></td>
											</tr>
											<tr>
												<td valign="top">&nbsp;</td>
											</tr>
											<tr>
												<td height="2" valign="top" bgcolor="#128D56"></td>
											</tr>
											<tr>
												<td height="25"><strong>제 3 장 당사자의 의무</strong></td>
											</tr>
											<tr>
												<td height="25">제 15 조【회사의 의무】</td>
											</tr>
											<tr>
												<td height="1" valign="top" bgcolor="#128D56"></td>
											</tr>
											<tr>
												<td height="1" valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
														<tr>
															<td width="20" valign="top">① </td>
															<td valign="top"> 회사는 이 약관에서 정한 바에 따라 지속적이고 안정적인 서비스의 제공을 위하여 최선을 다하여야 하며, 설비에 장애가 생기거나 멸실된 때에는 지체 없이 이를 수리 복구하여야 합니다. 다만, 천재지변, 비상사태 또는 그 밖에 부득이한 경우에는 그 서비스를 일시 중단 하거나 중지할 수 있습니다. 
<br /></td>
														</tr>
														<tr>
															<td width="20" valign="top">②</td>
															<td valign="top"> 회사는 회원으로부터 소정의 절차에 의해 제기되는 의견이나 불만이 정당하다고 인정할 경우에는 적절한 절차를 거처 처리하여야 합니다. 처리 시 일정 기간이 소요될 경우 회원에게 그 사유와 처리 일정을 알려주어야 합니다.
<br /></td>
														</tr>
														<tr>
															<td valign="top">③</td>
															<td valign="top"> 회사는 회원의 개인정보보호와 관련하여 제 14 조 ①, ②, ③ 항에 제시된 내용을 철저히 이행합니다.
<br /></td>
														</tr>
														<tr>
															<td valign="top">④</td>
															<td valign="top"> 회사는 회원승낙, 약관변경 및 해지 등 회원관리의 절차 및 내용 등에 있어 회원에게 편의를 제공하도록 노력합니다.
<br /></td>
														</tr>
												</table></td>
											</tr>
											<tr>
												<td valign="top">&nbsp;</td>
											</tr>
											<tr>
												<td height="2" valign="top" bgcolor="#128D56"></td>
											</tr>
											<tr>
												<td height="25">제 16 조 【회원의 의무】</td>
											</tr>
											<tr>
												<td height="1" valign="top" bgcolor="#128D56"></td>
											</tr>
											<tr>
												<td height="1" valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
														<tr>
															<td width="20" valign="top">① </td>
															<td valign="top"> 회원은 이 약관에서 규정하는 사항과 서비스 이용안내 또는 주의사항 등 회사가 공지 혹은 통지하는 사항을 준수하여야 하며, 기타 회사의 업무에 방해되는 행위를 하여서는 아니 됩니다. 
<br />
														</tr>
														<tr>
															<td width="20" valign="top">②</td>
															<td valign="top"> 회원의 ID와 비밀번호에 관한 모든 관리책임은 회원에게 있습니다. 회원에게 부여된 ID와 비밀번호의 관리 소홀, 부정사용에 의하여 발생하는 모든 결과에 대한 책임은 회원에게 있습니다.<br /></td>
														</tr>
														<tr>
															<td valign="top">③</td>
															<td valign="top"> 회원은 자신의 ID나 비밀번호가 부정하게 사용되었다는 사실을 발견한 경우에는 즉시 회사에 신고하여야 하며, 신고를 하지 않아 발생하는 모든 결과에 대한 책임은 회원에게 있습니다.
<br /></td>
														</tr>
														<tr>
															<td valign="top">④</td>
															<td valign="top"> 회원은 내용별로 회사가 서비스 공지사항에 게시하거나 별도로 공지한 이용제한 사항을 준수하여야 합니다.
<br /></td>
														</tr>
														<tr>
															<td valign="top">⑤</td>
															<td valign="top"> 회원은 회사의 사전승낙 없이는 본 서비스를 이용하여 영업활동을 할 수 없으며, 그 영업활동의 결과와 회원이 약관에 위반한 영업활동을 하여 발생한 결과에 대하여 회사는 책임을 지지 않습니다. 회원은 이와 같은 영업활동으로 회사에 손해를 입힌 경우 회원은 회사에 대하여 손해배상의무를 집니다.
<br /></td>
														</tr>
														<tr>
															<td valign="top">⑥</td>
															<td valign="top"> 회원은 회사의 명시적인 동의가 없는 한 서비스의 이용권한, 기타 이용계약상 지위를 타인에게 양도, 증여할 수 없으며, 이를 담보로 제공할 수 없습니다.
<br /></td>
														</tr>
														<tr>
															<td valign="top">⑦</td>
															<td valign="top"> 회원은 서비스 이용과 관련하여 다음 각 호에 해당되는 행위를 하여서는 안 됩니다.
<br />
1. 다른 회원의 ID와 비밀번호, 주민등록번호 등을 도용, 노출하는 행위<br />
2. 같은 사용자가 다른 ID로 이중등록을 한 경우<br />
3. 본 서비스를 통하여 얻은 정보를 회사의 사전승낙 없이 회원의 이용 이외 목적으로 복제하거나 이를 출판 및 방송 등에 사용하거나 제3자에게 제공하는 행위<br />
4. 타인의 특허, 상표, 영업비밀, 저작권 기타 지적재산권을 침해하는 내용을 게시, 전자메일 또는 기타의 방법으로 타인에게 유포하는 행위<br />
5. 공공질서 및 미풍양속에 위반되는 저속, 음란한 내용의 정보, 문장, 도형 등을 전송, 게시, 전자메일 또는 기타의 방법으로 타인에게 유포하는 행위<br />
6. 모욕적이거나 위협적이어서 타인의 프라이버시를 침해할 수 있는 내용을 전송, 게시, 전자메일 또는 기타의 방법으로 타인에게 유포하는 행위<br />
7. 회사의 승인을 받지 않고 다른 사용자의 개인정보를 수집 또는 저장하는 행위<br />
8. 실제로 물품을 판매하고자 하는 의사 없이 경매 접수등록을 한 경우 또는 이를 알고 낙찰 받은 것으로 인정되는 경우<br />
9. 회원이 국익 또는 사회적 공익을 저해할 목적으로 서비스이용을 계획 또는 실행하는 경우<br />
10. 서비스 운영을 고의로 방해한 경우<br />
11. 정보통신설비의 오작동이나 정보의 파괴를 유발시키는 컴퓨터 바이러스 프로그램 등을 유포하는 경우<br />
12. 정보 통신 윤리위원회 등 외부기관의 시정요구가 있거나 불법선거운동과 관련하여 선거관리위원회의 유권해석을 받은 경우<br />
13. 범죄와 결부된다고 객관적으로 판단되는 행위(불법 개·변조등)<br />
14. 본 약관을 포함하여 기타 회사가 정한 이용 조건에 위반한 경우<br />
15. 기타 관계법령에 위배되는 행위 
</td>
														</tr>
												</table></td>
											</tr>
											<tr>
												<td valign="top">&nbsp;</td>
											</tr>
											<tr>
												<td height="2" valign="top" bgcolor="#128D56"></td>
											</tr>
											<tr>
												<td height="25"><strong>제 4 장 경매 서비스의 이용</strong></td>
											</tr>
											<tr>
												<td height="25">제 17 조 【손상차량 보관 및 운반】</td>
											</tr>
											<tr>
												<td height="1" valign="top" bgcolor="#128D56"></td>
											</tr>
											<tr>
												<td height="1" valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
														<tr>
															<td width="20" valign="top">① </td>
															<td valign="top"> 경매기간 중 차량 보관 장소는 경매대상차량의 안전한 관리와 경비절감 및 입찰참가자의 업무수행 상 편리를 위해 다음 각호의 장소지정 우선순위에 의한다. <br />
1. 출품자 또는 보험회사 보상팀이 지정한 장소<br />
2. 회사가 지정한 제휴 회원사 및 회사의 지정 보관장소
</td>
														</tr>
														<tr>
															<td width="20" valign="top">②</td>
															<td valign="top"> 경매물건으로 확정하기 이전에 발생된 보관료 및 운반비는 출품자 또는 보험약관이 정한 바에 따라 보험회사에서 결정합니다. 단, 경매 시 기 발생된 비용에 관한 내용을 명시한 경우에는 그에 따라 정산합니다.
<br /></td>
														</tr>
												</table></td>
											</tr>
											<tr>
												<td valign="top">&nbsp;</td>
											</tr>
											<tr>
												<td height="2" valign="top" bgcolor="#128D56"></td>
											</tr>
											<tr>
												<td height="25">제 18 조 【공·경매 관련사항】 </td>
											</tr>
											<tr>
												<td height="1" valign="top" bgcolor="#128D56"></td>
											</tr>
											<tr>
												<td height="1" valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
														<tr>
															<td width="20" valign="top">① </td>
															<td valign="top"> 회원은 물품등록정보를 자세히 살펴본 후 구매의사가 있을 때 한하여 현물을 충분히 확인한 후 신중히 입찰하여야 합니다.
<br /></td>
														</tr>
														<tr>
															<td width="20" valign="top">②</td>
															<td valign="top"> 공·매기간은 경매 등록 시 회사가 기재한 시간까지 진행됩니다.
<br />
															</p></td>
														</tr>
														<tr>
															<td width="20" valign="top">③</td>
															<td valign="top"> 경매입찰은 지정된 마감일시까지 5회에 한하여 입찰이 가능합니다. 한번 입찰한 것은 경매 종료시까지는 임의로 수정 또는 철회할 수 없습니다. 단, 공매는 예외로 합니다
<br />
															</p></td>
														</tr>
														<tr>
															<td width="20" valign="top">④</td>
															<td valign="top"> 입찰가격은 현재가에서 최소 만원단위로 자유롭게 책정할 수 있습니다.
<br />
															</p></td>
														</tr>
														<tr>
															<td width="20" valign="top">⑤</td>
															<td valign="top"> 모든 공·경매 출품 차량은 출품당시의 주요 손상개소만을 공지하며 과거 사고경력은 공지하지 않을 수 있음을 원칙으로 합니다.
<br />
															</p></td>
														</tr>
														<tr>
															<td width="20" valign="top">⑥</td>
															<td valign="top"> 모든 공·경매의 낙찰결과는 회원이 입찰한 물건의 실물을 확인 후 입찰에 응한 것으로 간주하며 현물을 확인하지 않은 상태에서 과도한 금액으로 낙찰 받았을 경우 그로 인한 책임은 낙찰 받은 회원에게 있습니다.
<br />
															</p></td>
														</tr>
														<tr>
															<td width="20" valign="top">⑦</td>
															<td valign="top"> 회사는 제휴사 및 회원이 서비스에 게재한 정보, 자료, 사실의 정확성, 신뢰성 등 그 내용에 관하여는 어떠한 책임을 부담하지 아니하고, 회원은 자기의 책임아래 서비스를 이용하며, 서비스를 이용하여 게시 또는 전송한 자료 등에 관하여 손해가 발생하거나 자료의 취사 선택, 기타 서비스 이용과 관련하여 어떠한 불이익에 발생하더라도 이에 대한 모든 책임은 회원에게 있습니다.
<br />
															</p></td>
														</tr>
												</table></td>
											</tr>
											<tr>
												<td valign="top">&nbsp;</td>
											</tr>
											<tr>
												<td height="2" valign="top" bgcolor="#128D56"></td>
											</tr>
											<tr>
												<td height="25">제 19 조【낙찰 관련사항】</td>
											</tr>
											<tr>
												<td height="1" valign="top" bgcolor="#128D56"></td>
											</tr>
											<tr>
											<tr>
												<td height="1" valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
													<tr>
															<td valign="top" colspan="2"> 경매낙찰의 성립은 회사가 낙찰정산서를 발급한 시점에서 이루어진 것으로 봅니다. 
<br /></td>
														</tr>
														<tr>
															<td width="20" valign="top">① </td>
															<td valign="top"> 입찰회원은 경매종료 후 낙찰확인SMS 또는 유선 또는 My Page의 낙찰리스트화면에서 낙찰 여부를 확인할 수 있습니다. 
 <br /></td>
														</tr>
														<tr>
															<td width="20" valign="top">②</td>
															<td valign="top"> 낙찰자는 경락의 성립 후 익일12시 이내(토요일, 공휴일제외)에 낙찰금액을 입금하여야 하고 입금을 하지않을 경우 인수포기로 간주되어 차기 낙찰자에게 인수 권리가 자동 승계됩니다. 단, 회사의 귀책사유 없이 인수를 포기한 경우에는 본 약관 제11조 [서비스이용의 정지 및 제재]가 적용됩니다. 
 <br /></td>
														</tr>
													</table>
												</td>
											</tr>
											<tr>
												<td valign="top">&nbsp;</td>
											</tr>
											<tr>
												<td height="2" valign="top" bgcolor="#128D56"></td>
											</tr>
											<tr>
												<td height="25">제 20 조 【출고 관련사항】</td>
											</tr>
											<tr>
												<td height="1" valign="top" bgcolor="#128D56"></td>
											</tr>
											<tr>
												<td height="1" valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
														<tr>
															<td width="20" valign="top">① </td>
															<td valign="top"> 낙찰자는 입금 후 지체 없이 회사에서 발행되는 낙찰자 인수증명서를 소지한 후 분실품(도난품)등을 점검하여 이상 유무를 확인 후 차량을 출고하여야 하며, 만일 분실품(도난품)이 발생하였을 경우 현장에서 당사로 연락을 통해 조치를 받으셔야 합니다. 출고 후 어떠한 경우에도 물품의 하자에 대한 이의 제기는 인정치 아니하며 당사가 책임지지 않음을 유의해야 합니다. 
 <br /></td>
														</tr>
														<tr>
															<td width="20" valign="top">②</td>
															<td valign="top"> 출고 시 시간이나 인력부족으로 인해 출고를 하지 못할 경우 즉시 회사에 연락을 취하여야 합니다. 출고지연으로 발생한 추가보관료 및 이전지연 과태료는 모두 낙찰자에게 귀속되며 회사는 손해배상금을 청구할 수 있습니다.
<br /></td>
														</tr>
														<tr>
															<td valign="top">③</td>
															<td valign="top"> 출고에 관련된 모든 물류비(운임, 지게차비등)는 낙찰자가 부담합니다. 
 <br /></td>
														</tr>
														<tr>
															<td valign="top">④</td>
															<td valign="top"> 출고 이후에 발생되는 각종 상황 및 사고에 대해서는 전적으로 낙찰자가 책임을 집니다. 
 </td>
														</tr>
												</table></td>
											</tr>
											<tr>
												<td valign="top">&nbsp;</td>
											</tr>
											<tr>
												<td height="2" valign="top" bgcolor="#128D56"></td>
											</tr>
											<tr>
												<td height="25">제 21조【이전·폐차 관련사항】</td>
											</tr>
											<tr>
												<td height="1" valign="top" bgcolor="#128D56"></td>
											</tr>
											<tr>
												<td height="1" valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
														<tr>
															<td width="20" valign="top">① </td>
															<td valign="top"> 낙찰자는 소유권 이전의 경우 회사가 정해주는 날짜 안에 인수차량의 소유권이전 절차를 완료하고 낙찰차량의 등록증 및 등록원부와 관청에서 발급하는 등록완료 증명서류를 회사에 우편, FAX 등 기타의 방법으로 통지하여야 합니다.  <br /></td>
														</tr>
														<tr>
															<td width="20" valign="top">②</td>
															<td valign="top"> 폐차의 경우 인수차량의 폐차말소는 낙찰자의 의무사항입니다. 폐차인수증은 출고일로부터 최대 익일 이내에 발급해야 합니다. 폐차말소는 폐차인수증 발급일 익일(토요일, 공휴일제외)이내에 완료하며 말소증명원을 회사에 우편, FAX등 기타의 방법으로 통지하여야 합니다. 단, 출품 차량의 폐차말소 기일을 사전 고지한 경우에는 예외로 합니다.
 <br /></td>
														</tr>
														<tr>
															<td valign="top">③</td>
															<td valign="top"> 낙찰자가 이전등록 결과 통보를 지연하여 회사가 이전등록 결과를 확인하는데 소요된 비용에 대하여 회사는 낙찰자에게 청구할 수 있으며, 이전등록 및 폐차말소가 법정기일을 넘겨 지연된 경우에는 회사는 출품자를 대신하여 강제 이전등록 수속을 진행할 수 있고, 지연에 따른 피해금액(과태료와 공과금)과 소요비용은 낙찰자가 부담하여야 합니다.
 <br /></td>
														</tr>
														<tr>
															<td valign="top">④</td>
															<td valign="top"> 과태료 등, 대납지출이 발생하였을 경우 2일 이내 유선이나 FAX로 회사에 연락하고 영수증을 회사로 송부하여야 합니다. 
<br /></td>
														</tr>
														<tr>
															<td valign="top">⑤</td>
															<td valign="top"> 이전 및 말소를 고의 또는 특별한 사유 없이 지연시키는 경우에는 본 약관 11조가 적용됩니다.<br /></td>
														</tr>
												</table></td>
											</tr>
											<tr>
												<td valign="top">&nbsp;</td>
											</tr>
											<tr>
												<td height="2" valign="top" bgcolor="#128D56"></td>
											<tr>
												<td height="25">제 22 조【매매보호서비스】</td>
											</tr>
											<tr>
												<td height="1" valign="top" bgcolor="#128D56"></td>
											</tr>
											<tr>
												<td height="1" valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
														<tr>
															<td width="20" valign="top">① </td>
															<td valign="top"> 회사는 경매서비스를 제공하는 과정에서 대금의 수령, 보관 및 송금업무로 이루어지는 매매보호서비스를 제공합니다. 이러한 매매보호서비스는 경매서비스를 통하여 이루어지는 회원 상호간의 거래의 안전성과 신뢰성을 도모하고 낙찰자를 보호하기 위한 목적에서 제공하는 장치이므로 회사가 매매보호서비스를 통하여 출품자 또는 낙찰자를 대리, 대행하거나 그 이행을 보조하는 것은 아닙니다. 
 <br /></td>
														</tr>
														<tr>
															<td width="20" valign="top">②</td>
															<td valign="top"> 회사가 제공하는 매매보호서비스는 기본적인 경매서비스에 포함됩니다. 회원이 직거래가 허용되는 카테고리에 속하지 않는 물품에 대하여 매매보호서비스를 통하지 않는 직거래를 유도하는 경우, 회사는 경매 취소, 경매 중지 등 기타 필요한 조치를 취할 수 있습니다.
<br /></td>
														</tr>
														<tr>
															<td valign="top">③</td>
															<td valign="top"> 매매보호서비스의 일환으로 이루어지는 대금보관으로 인하여 회사가 취득하는 이자 등은 서비스 제공의 대가이므로 회원은 회사에 대하여 이자 등의 반환을 청구할 수 없고, 대금 송금으로 인하여 발생하는 수수료는 대금을 송금하는 회원이 부담하여야 합니다. 
 <br /></td>
														</tr>
														<tr>
															<td valign="top">④</td>
															<td valign="top"> 회사가 제공하는 매매보호서비스를 이용하지 않은 거래 및 물품 또는 매매보호 서비스를 이용한 거래 및 물품에 대하여 매매보호서비스가 종결된 경우 해당 거래와 관련하여 발생한 모든 사항은 출품자와 낙찰자가 상호협의를 통해 해결하여야 합니다. 
 <br /></td>
														</tr>
														<tr>
															<td valign="top">⑤</td>
															<td valign="top"> 출품자는 회사가 제공하는 서비스를 이용함에 있어서 매매보호서비스의 이용과 그 규칙에 동의하여야 합니다.
<br /></td>
														</tr>
														<tr>
															<td valign="top">⑥</td>
															<td valign="top"> 회사가 제공하는 매매보호서비스를 오용, 악용함으로써 사회질서, 미풍양속을 침해하거나 침해할 우려가 있다고 판단되는 경우 또는 회사가 매매보호서비스를 제공하지 못할 상황 또는 사유가 발생하는 경우 회사는 출품자의 물품 등록 시에 제공되는 매매보호서비스를 상품의 일부 또는 전부에 대하여 제공하지 않거나 제한할 수 있습니다.
<br /></td>
														</tr>
														<tr>
															<td valign="top">⑦</td>
															<td valign="top"> 매매보호서비스를 이용함에 있어 회원은 다음에 기재한 사유가 발생하지 않도록 유의하여야 합니다.
<br />
															1. 관리소홀, 대여, 양도, 보관, 이용위임, 담보제공, 불법대출 등으로 인한 부정사유 또는 위·변조사고<br>
															2. 회원의 가족, 동거인(사실상의 동거인 포함)에 의하거나 또는 이들이 관련하여 생긴 부정사용 또는 위·변조사고<br>
															3. 비밀번호 유출로 인한 부정사용 또는 위·변조사고 
</td>
														</tr>
												</table></td>
											</tr>
											<tr>
												<td valign="top">&nbsp;</td>
											</tr>
											<tr>
												<td height="2" valign="top" bgcolor="#128D56"></td>
											</tr>
											<tr>
												<td height="25"><strong>제 5 장 기타</strong></td>
											</tr>
											<tr>
												<td height="25">제 23 조【정보의 제공】 </td>
											</tr>
											<tr>
												<td height="1" valign="top" bgcolor="#128D56"></td>
											</tr>
											<tr>
												<td height="1" valign="top">회사는 회원이 서비스 이용 중 필요가 있다고 인정되는 다양한 정보를 공지사항이나 전자우편 등의 방법으로 회원에게 제공할 수 있습니다.
</td>
											</tr>
											<tr>
												<td valign="top">&nbsp;</td>
											</tr>
											<tr>
												<td height="2" valign="top" bgcolor="#128D56"></td>
											</tr>
											<tr>
												<td height="25">제 24 조【수수료 및 유료정보】&nbsp;</td>
											</tr>
											<tr>
												<td height="1" valign="top" bgcolor="#128D56"></td>
											</tr>
											<tr>
												<td height="1" valign="top">회사가 제공하는 서비스는 기본적으로 유료이며 수수료율은 다음과 같습니다. 단, 차후 회사가 필요하다고 판단된 경우 수수료를 신설, 변경할 수 있으며, 신설 또는 변경사항은 회사가 제공하는 서비스 화면의 [공지 사항]란을 통하여 공지합니다. </td>
											</tr>
											<tr>
												<td valign="top" align="right">
													<table width="101%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #D8D8D8;text-align:center;">
														<colgroup>
															<col width="15%">
															<col width="35%">
                                                            <col width="15%">
                                                            <col width="35%">
														</colgroup>
														<tr>
                                                        	
															
															<td style="border-right:1px solid #D8D8D8;border-bottom:1px solid #D8D8D8;">구분</td>
															<td style="border-bottom:1px solid #D8D8D8;"><span style="padding:3 10 0 10;">기준</span></td>
                                                            <td height="25" style="border-left:1px solid #D8D8D8;border-bottom:1px solid #D8D8D8;" role="3">내용</td>
														    <td style="border-left:1px solid #D8D8D8;border-bottom:1px solid #D8D8D8;" role="3"><span style="padding:3 10 0 10;padding-left:10px;">수수료 또는 금액(부가세포함)</span></td>
														</tr>
														<tr>
															
															<td height="25" style="border-right:1px solid #D8D8D8;border-bottom:1px solid #D8D8D8;">최저수수료</td>
															<td style="border-bottom:1px solid #D8D8D8;">&nbsp;</td>
                                                            <td height="25" style="border-left:1px solid #D8D8D8;border-bottom:1px solid #D8D8D8;">최저수수료</td>
														    <td style="border-left:1px solid #D8D8D8;border-bottom:1px solid #D8D8D8;">55,000원</td>
														</tr>
														<tr>
															
															<td rowspan="4" style="border-right:1px solid #D8D8D8;border-bottom:1px solid #D8D8D8;">손상차량</td>
															<td align="left" style="padding-left:10px;border-bottom:1px solid #D8D8D8;"><strong>낙찰금액 0 ~ 999,000원</strong></td>
                                                            <td height="25" style="border-left:1px solid #D8D8D8;border-bottom:1px solid #D8D8D8;">낙찰수수료</td>
														    <td style="border-left:1px solid #D8D8D8;border-bottom:1px solid #D8D8D8;">5.5%</td>
														</tr>
														<tr>
														  <td align="left" style="padding-left:10px;border-bottom:1px solid #D8D8D8;"><strong>낙찰금액 1,000,000 ~ 9,999,999원</strong></td>
														  <td height="25" style="border-left:1px solid #D8D8D8;border-bottom:1px solid #D8D8D8;">낙찰수수료</td>
                                                          <td style="border-left:1px solid #D8D8D8;border-bottom:1px solid #D8D8D8;">11%</td>
  </tr>
														<tr>
														  <td align="left" style="padding-left:10px;border-bottom:1px solid #D8D8D8;"><strong>낙찰금액 10,000,000 ~ 29,999,999원</strong></td>
														  <td height="25" style="border-left:1px solid #D8D8D8;border-bottom:1px solid #D8D8D8;">낙찰수수료</td>
														  <td style="border-left:1px solid #D8D8D8;border-bottom:1px solid #D8D8D8;">7.7%</td>
  </tr>
														<tr>
														  <td align="left" style="padding-left:10px;border-bottom:1px solid #D8D8D8;"><strong>낙찰금액 30,000,000<strong>원</strong> ~</strong></td>
														  <td height="25" style="border-left:1px solid #D8D8D8;border-bottom:1px solid #D8D8D8;">낙찰수수료</td>
														  <td style="border-left:1px solid #D8D8D8;border-bottom:1px solid #D8D8D8;">5.5%</td>
  </tr>
														<tr>
														  <td height="25" style="border-right:1px solid #D8D8D8;border-bottom:1px solid #D8D8D8;">도난 회수차량</td>
														  <td style="padding-left:10px;border-bottom:1px solid #D8D8D8;">&nbsp;</td>
														  <td height="25" style="border-left:1px solid #D8D8D8;border-bottom:1px solid #D8D8D8;">낙찰수수료</td>
														  <td style="border-left:1px solid #D8D8D8;border-bottom:1px solid #D8D8D8;">5.5%</td>
  </tr>
														<tr>
														  <td height="25" style="border-right:1px solid #D8D8D8;">최고수수료</td>
														  <td>&nbsp;</td>
														  <td height="25" style="border-left:1px solid #D8D8D8;">최고수수료</td>
														  <td style="border-left:1px solid #D8D8D8;">2,200,000원</td>
  </tr>
													</table>

												</td>
											</tr>
											<tr>
												<td valign="top">&nbsp;</td>
											</tr>
											<tr>
												<td height="2" valign="top" bgcolor="#128D56"></td>
											</tr>
											<tr>
												<td height="25">제 25조【회원의 게시물】</td>
											</tr>
											<tr>
												<td height="1" valign="top" bgcolor="#128D56"></td>
											</tr>
											<tr>
												<td height="1" valign="top">① 회사는 회원이 게시하거나 등록하는 서비스내의 내용물이 제 16조 ⑦항에 해당한다고 판단되는 경우에 사전통지 없이 삭제할 수 있습니다. 
													<p>② 서비스에 게재된 자료에 대한 권리는 다음 각 호와 같습니다. </p>
													1. 게시물에 대한 권리와 책임은 게시자에게 있으며 게시자의 동의 없이는 이를 서비스 내 게재 이외에 영리적 목적으로 사용할 수 없습니다. 단, 비영리적인 경우에는 그러하지 아니하며 또한 회사는 서비스내의 게재권을 갖습니다.<br>
													2. 회원은 서비스를 이용하여 얻은 정보를 가공, 판매하는 행위 등 서비스에 게재된 자료를 상업적으로 사용할 수 없습니다. 
</td>
											</tr>
											<tr>
												<td valign="top">&nbsp;</td>
											</tr>
											<tr>
												<td height="2" valign="top" bgcolor="#128D56"></td>
											</tr>
											<tr>
												<td height="25">제 26 조【광고게제 및 광고주와의 거래】</td>
											</tr>
											<tr>
												<td height="1" valign="top" bgcolor="#128D56"></td>
											</tr>
											<tr>
												<td height="1" valign="top">① 회사가 회사에게 서비스를 제공할 수 있는 서비스 투자기반의 일부는 광고게재를 통한 수익으로부터 나옵니다. 서비스를 이용하고자 하는 자는 서비스이용 시 노출되는 광고게제에 대해 동의하는 것으로 간주됩니다.
<br>
												② 회사는 본 서비스 상에 게재되어 있거나 본 서비스를 통한 광고주의 판촉활동에 회원이 참여하거나 교신 또는 거래의 결과로서 발생하는 모든 손실 또는 손해에 대해 책임을 지지 않습니다.
</td>
											</tr>
											<tr>
												<td valign="top">&nbsp;</td>
											</tr>
											<tr>
												<td height="2" valign="top" bgcolor="#128D56"></td>
											</tr>
											<tr>
												<td height="25">제 27 조 【회원보증금】</td>
											</tr>
											<tr>
												<td height="1" valign="top" bgcolor="#128D56"></td>
											</tr>
											<tr>
												<td height="1" valign="top">회원은 성실한 계약이행을 위하여 회원보증금은 회원이 서비스이용 시 거래상의 채무 및 거래와 관련하여 발생하는 기타 채무를 담보하는 것입니다.
 <br />
												① 회사는 회원이 채무를 이행하지 않을 경우 이를 회원보증금에서 임의공제, 충당할 수 있습니다. 이때 회원보증금이 채무금액보다 적을 경우에는 회원에게 별도 청구할 수 있습니다.
<br>
												② ①항에 의하여 회원보증금이 부족할 경우 회원은 회사에서 지정한 날까지 부족금을 납입하여야 합니다.<br>
												③ 회원이 자의로 탈퇴하거나 자격을 상실할 경우 회사는 회원 보증금을 30일 이내반환해야 하며, 이자는 정산하지 않습니다.<br>
												④ 단, 회원에게 제 20 조, 제 21 조 규정의 채무가 있는 경우에는 이 채무의 정산 후 잔금을 반환하는 것으로 합니다. </td>
											</tr>
											<tr>
												<td valign="top">&nbsp;</td>
											</tr>
											<tr>
												<td height="2" valign="top" bgcolor="#128D56"></td>
											</tr>
											<tr>
												<td height="25"><strong>제 6 장 부칙</strong></td>
											</tr>
											<tr>
												<td height="25">이 약관은 2024년 01월 01일부터 적용됩니다</td>
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
