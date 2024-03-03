<?include "../inc/header.php" ?>
<?
	if(!$loginId){
		echo "<script>alert('로그인후 사용 가능합니다.');history.back();</script>";
	}
?>

<!-- 마이페이지독립 css -->
<style type="text/css">
.join_img_body { position:relative;  margin-top:40px; }
.join_area p {text-align:left; margin:10px 0;}
.join_img_body table.join_form tr th { background:#f7f7f7; border:1px solid #666666; font-weight:normal; }
.join_img_body table.join_form tr td { text-align:center; padding:2px 2px 2px 2px; color:#000000; border:1px solid #949294;}
input[type=text] { padding:1px 1px 1px 1px; border:1px solid #666666; height:17px; }
.join_img_body table.join_form tr td  table { padding:0; margin:0; }
.join_img_body table.join_form tr td  table tr td { padding:0; margin:0; border:none; padding:2px 2px 2px 2px; }
..join_area p.s_title { font-size:10pt; font-weight:bold; }
.style1 {font-weight: bold}
select.no{border:1px solid #666666;}
</style>
<SCRIPT LANGUAGE="JavaScript">
<!--
var myAnchors=document.all.tags("A"); 
function allBlur() 
{ 
for (i=0;i<myAnchors.length;i++) 
{ 
myAnchors[i].onfocus=new Function("myAnchors["+i+"].blur()"); 
} 
}

function userOut() {
	var f = document.userOutForm;
	if(confirm('정말 탈퇴하시겠습니까?'))f.submit();
	else return false;
}
//-->
</SCRIPT>

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
		
			  <div class="join_img_head" style="margin-top:0;" align="center">
					<div class="tab_type01">
						<ul>
							<li><a href="/mypage/sub04.php"><span>입찰현황</span></a></li>
							<li><a href="/mypage/sub05.php"><span>낙찰현황</span></a></li>
							<li><a href="/mypage/sub03.php"><span>관심차량</span></a></li>
							<li><a href="/mypage/sub01.php"><span>접수현황</span></a></li>
							<li><a href="/mypage/sub07.php"><span>회원정보수정</span></a></li>
                            <li class="on"><a href="/mypage/sub08.php"><span>회원탈퇴</span></a></li>
						</ul>
			<!--컨텐츠 부분-->
            <div class="join_area">
				<div class="join_img_body">
                
					<div class="join_area">							
					<table width="500" border="0" cellspacing="0" cellpadding="0">
						<tbody>
							<tr>
								<td height="20" align="center">
									<table width="500" border="0" cellspacing="0" cellpadding="0">
										<tbody>
											<tr>
												<td height="2" bgcolor="#78a5cd"></td>
											</tr>
											<tr>
												<td align="center" bgcolor="#fafafa" style="padding: 15px 0;">
													<strong style="font-size: 18px;">						 
										            <?=$loginName?>
													님 탈퇴를 하시겠습니까?
													</strong>
												</td>
											</tr>
											<tr>
												<td height="1" bgcolor="#78a5cd"></td>
											</tr>
											<tr>
												<td height="30"></td>
											</tr>
											<tr>
												<td style="padding-left:40px;font-size: 15px;">
													<strong>
													탈퇴를 하시면 고객님의 모든정보는 삭제되게 됩니다.   
													<br />
													<br />
													</strong>
													탈퇴를 하시더라도 추후 가입에 대한 제한은 없으며, 언제든 재가입이 가능합니다. 
													<br />
													<br />
													그동안 저희 사이트를 이용해 주셔서 대단히 감사합니다. 
													<br />														
													<br />														
													 *회원탈퇴시 개인정보가 모두 삭제 되므로 다시한번 확인해 주세요
												</td>
											</tr>
											<tr>
												<td height="30"></td>
											</tr>
											<tr>
												<td height="1" bgcolor="#78a5cd"></td>
											</tr>
										</tbody>
									</table>
								</td>							
							</tr>
						</tbody>
					</table>
  <?php
	$queryOut = mysql_query("select idx from woojung_member where userId='$loginId' limit 1");
	$rowOut	  = mysql_fetch_row($queryOut);
?>
  <form name='userOutForm' method="post" action='../member/member_out.php' onSubmit="return userOut()">
    <input type="hidden" name="mode" value="user_out">
    <input type="hidden" name="idx" value="<?=$rowOut[0]?>">
		<div class="btn_area" style="margin-top:20px">
			<a href="javascript:void(0)" onclick="userOut('<?=$rowOut[0]?>')" style="display:inline-block; color:#fff"><div class="user-btn Scor-font-500">탈퇴하기</div></a>
		</div>
  </form>





			</div>
</div></div>



			</div>
		</div>
	</div>
	<!-- footer -->
	<div class="cha_footer"><? include "../inc/bottom.php" ?></div>
</div>

</body>
</html>

