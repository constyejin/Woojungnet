<?php 
require_once "../lib/common.php";
//loginCheck();
include $_SERVER['DOCUMENT_ROOT'].'/lib/_class/phpfun.class.php';
$phpfun = new phpfun();
require_once('../nfupload/nfupload_conf.inc.php');		// NFUpload Config
$idx = $_GET['idx'];
if(!$idx)$mode = 'regist';
else $mode = 'modify';
if ($__NFUpload['limit_ext'] != ''){
	preg_match('/[.]+('.str_replace(';', '|', $__NFUpload['limit_ext']).')+/i', $_FILES['upfile']['name'], $mc);
}
$SID = session_id();
?>
<? $menuNow ="?pageNum=1&subNum=1"; ?>
	<? include "../inc/header.php" ?>

<!-- 회원가입독립 css -->
<style type="text/css">
.join_img_body { position:relative;  margin-top:40px; }
.join_area p {text-align:left; margin:10px 0;}
.join_img_body table.join_form tr th { background:#f7f7f7; border:1px solid #666666; font-weight:normal; }
.join_img_body table.join_form tr td { text-align:center; padding:2px 2px 2px 2px; color:#000000; border:1px solid #949294;}
input[type=text] { padding:2px 2px 2px 2px; border:1px solid #666666; }
.join_img_body table.join_form tr td  table { padding:0; margin:0; }
.join_img_body table.join_form tr td  table tr td { padding:0; margin:0; border:none; padding:2px 2px 2px 2px; }
.style1 {font-weight: bold}
</style>


  <div id="sub_contents">
		
		<div id="sub_L">
			<? include "../inc/left_mypage.php" ?>
		</div>
		<div id="sub_Con">
			<ul class="subTitBox" >
				<li class="left">▣ 낙찰차량  </li>
				<li class="right">HOME > 마이페이지 > 낙찰차량</li>
			</ul>
			
			
			
			
			<!--컨텐츠 부분-->
            <div class="join_area">
				<div class="join_img_body">
                
<div class="join_area">
				<p class="s_title">폐차, 경매, 공매/매매 접수내역입니다.</p>
				<table width="730" border="0" cellSpacing="1" cellPadding="0">
			  <tbody>
						<tr>
							<td bgColor="#ebebeb">
								<table width="100%" bgColor="#ffffff" border="0" cellSpacing="0" cellPadding="0">
									<form name="searchForm" action="/mypage/nmypage02.php" method="post">
										<tbody>
											<tr>
											  <td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                <!--추가 에러-->
                                                <colgroup>
                                                <col width="*" />
                                                <col width="*" />
                                                </colgroup>
                                                 
                                                 <tr>
                                                 <td align="right">일자&nbsp;</td>
                                                  <td width="70" height="25" align="right"><input name="start_date" class="input" id="start_date" type="text" size="10"/></td>
                                                  <td width="20" align="center"><a onclick="Calendar(end_date);" href="javascript:;"> <img src="/images/icon_calendar.gif" border="0" /></a></td>
                                                  <td width="15" align="center">~</td>
                                                  <td width="70" align="right"><span class="style1">
                                      <input name="end_date" class="input" id="end_date" type="text" size="10"/></span></td>
                                            <td width="30" align="left"><a onclick="Calendar(end_date);" href="javascript:;">&nbsp;<img src="/images/icon_calendar.gif" border="0" /></a></td>
                                            <td width="100" align="left"><span class="style1">
                                            <input name="end_date" class="input" id="end_date" type="text" size="15"/></span></td>
                    <td width="50" align="center"><span class="style1">
                    <img src="/images/search.jpg" /></span></td>
                                                </tr>
                                                 <tr>
                                                   <td height="7" colspan="8" align="right"></td>
                                                 </tr>
                                              </table>
									    <table class="join_form" width="100%" border="0" cellspacing="0" cellpadding="5">
                                                      <!--추가 에러-->
                                                  <colgroup>
                                                      <col width="*" />
                                                      <col width="*" />
                                                      </colgroup>
                                                      <tr>
                                                        <th width="8%" height="25" align="center" ><strong>no</strong></th>
                                                        <th width="10%" align="center" ><strong>접수번호</strong></th>
                                                        <th width="11%" align="center" ><strong>접수일자</strong></th>
                                                        <th width="11%" align="center" ><strong>차량번호</strong></th>
                                                        <th width="16%" align="center"><strong>모델명</strong></th>
                                                        <th width="11%" align="center"><strong>접수증</strong></th>
                                                        <th width="11%" align="center"><strong>감정평가</strong></th>
                                                        <th width="11%" align="center"><strong>출품정산서</strong></th>
                                                        <th width="11%" align="center"><strong>입찰자</strong></th>
                                                </tr>

                                                   
                                                      
                                                    </table>
                                                    <table width="100%" border="0" cellpadding="5" cellspacing="0">
                                              <tr>
                                                        <td width="8%" height="25" align="center" valign="middle">2</td>
                                                    <td width="10%" align="center" valign="middle">13-1000336</td>
                                                    <td width="11%" align="center" valign="middle">2013-08-26</td>
                                                    <td width="11%" align="center" valign="middle">서울 2자 1234</td>
                                                    <td width="16%" align="center" valign="middle">에쿠스3.3</td>
                                                    <td width="11%" align="center" valign="middle"><a href="#"><img src="/images/icon2.jpg" border="0" /></a></td>
                                                    <td width="11%" align="center" valign="middle"><a href="#"><img src="/images/icon3.jpg" border="0" /></a></td>
                                                    <td width="11%" align="center" valign="middle"><a href="#"><img src="/images/icon4.jpg" border="0" /></a></td>
                                                    <td width="11%" align="center" valign="middle"><a href="#"><img src="/images/icon5.jpg" border="0" /></a></td>
                                                </tr>
                                              <tr>
                                                <td height="1" colspan="9" bgcolor="#999999"></td>
                                                </tr>
                                              <tr>
                                                 <td width="8%" height="25" align="center" valign="middle">1</td>
                                                <td width="10%" align="center" valign="middle">13-1000336</td>
                                                    <td width="11%" align="center" valign="middle">2013-08-26</td>
                                                    <td width="11%" align="center" valign="middle">서울 2자 1234</td>
                                                    <td width="16%" align="center" valign="middle">에쿠스3.3</td>
                                                <td align="center" valign="middle"><a href="#"><img src="/images/icon2.jpg" border="0" /></a></td>
                                                    <td align="center" valign="middle"><a href="#"><img src="/images/icon3.jpg" border="0" /></a></td>
                                                    <td align="center" valign="middle"><a href="#"><img src="/images/icon4.jpg" border="0" /></a></td>
                                                    <td align="center" valign="middle"><a href="#"><img src="/images/icon5.jpg" border="0" /></a></td>
                                              </tr>
                                              <tr>
                                                <td height="1" colspan="9" bgcolor="#999999"></td>
                                              </tr>
                                                </table>
                                              </td>
											</tr>
										</tbody>									
									</form>
								</table>
						  </td>
						</tr>
				  </tbody>
		  </table>
				<br /><br />
				<table width="730" border="0" cellspacing="0" cellpadding="0">
                  <tr align="center">
                    <td align="center">[처음][이전] 1 2 3 [다음][끝]</td>
                  </tr>
                </table>
<td height="25" align="center" vAlign="top">
					<tbody>
						<tr align="center" bgColor="#e6e6e6">
							
						</tr>
						
					</tbody>
				</table>

			</div>





</div></div>
	</div>

	</div>
	<? include "../inc/bottom.php" ?>
</div>
</body>
</html>