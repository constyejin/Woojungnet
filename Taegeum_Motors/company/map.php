<? include $_SERVER['DOCUMENT_ROOT']."/inc/header.php"; ?> 

<div id="new_wrap">

<!-- 회원가입독립 css -->
<style type="text/css">
.join_img_body { position:relative;  margin-top:0px; }
.join_img_body ul li { width:250px; float:left; }

.style1 {
	font-size: 16px;
	font-weight: bold;
}
</style>



	<div id="main_wrap">
		<div id="cha_contents">
			<!-- login -->
			<div id="con_left">
			<?include"../inc/login.php";?>
				<!-- 좌측 서브 메뉴 start -->
				<?include "sub10_1_menu.php";?>
				<!-- 좌측 서브 메뉴 end -->
				<!--div class="con_ban"><img src="/new/images/img_banner_1.jpg"></div>
				<div class="con_cs"><img src="/new/images/img_cs.jpg"><p style="padding-top:15px"><img src="/new/images/img_bank.jpg"></div-->
			</div>
			<div id="con_right">
				<h1><img src="/new/images/img_sub1.jpg"></h1>
				<table border="0" cellspacing="0" cellpadding="0">
					<tr> 
						<td height="38" align="left" valign="bottom"><img src="/new/images/img_company_2_bar.gif" /></td>
					</tr>
					<tr>
						<td height="10"></td>
					</tr>
				</table>
				<!---->
				<table width="900" border="0" cellspacing="0" cellpadding="0" style="background:#FFF;border:1px solid #D8D8D8;">
					<!--
					<tr>
						<td style="padding-top:10px"><img src="/new/images/img_map_title.jpg"></td>
					</tr>
					-->
					<tr>
						<td align="center">
							<table width="880" class="tbl-list02 mt25" id="waytogo" summary="회사주소, 전화번호, 근무시간,">
								<colgroup>
									<col style="width:16%" />
									<col style="width:34%" />
									<col style="width:16%" />
									<col style="width:*" />
								</colgroup>
								<tbody>
									<tr>
										<th scope="row">회사주소</th>
										<td colspan="3" class="a_l br0">서울 용산구 한남대로 60, 금호리첸시아 에이동 311호</td>
									</tr>
									<tr>
										<th scope="row">전화번호</th>
										<td class="a_l">02-790-9531 </td>
										<th scope="row">근무시간</th>
										<td class="a_l br0">월~금 09:00 ~ 18:00 <span style="color:#D72823">(토/일 휴무)</span></td>
									</tr>
								</tbody>
						  </table>
							<div class="column_map">
							<table cellpadding="0" cellspacing="0" width="880"> 
							  <tr> <td height="500" style="border:1px solid #cecece;"><a href="http://map.naver.com/?menu=location&mapMode=0&lat=37.5342676&lng=127.0079352&dlevel=12&searchCoord=126.6960761%3B37.4758339&query=7ISc7Jq4IOyaqeyCsOq1rCDtlZzrgqjrjIDroZwgNjAsIOq4iO2YuOumrOyyuOyLnOyVhA%3D%3D&mpx=11237680%3A37.4758339%2C126.6960761%3AZ11%3A0.0268745%2C0.0192863&tab=1&enc=b64" target="_blank"><img src="/new/images/map.jpg" width="880" height="500" alt="지도 크게 보기" title="지도 크게 보기" border="0" style="vertical-align:top;"/></a></td> 
							  </tr> <tr> <td>  <table cellpadding="0" cellspacing="0" width="100%">  <tr>  <td height="30" bgcolor="#f9f9f9" align="left" style="padding-left:9px; border-left:1px solid #cecece; border-bottom:1px solid #cecece;">   <span style="font-family: tahoma; font-size: 11px; color:#666;">2016.5.28</span>&nbsp;<span style="font-size: 11px; color:#e5e5e5;">|</span>&nbsp;<a style="font-family: dotum,sans-serif; font-size: 11px; color:#666; text-decoration: none; letter-spacing: -1px;" href="http://map.naver.com/?menu=location&mapMode=0&lat=37.5342676&lng=127.0079352&dlevel=12&searchCoord=126.6960761%3B37.4758339&query=7ISc7Jq4IOyaqeyCsOq1rCDtlZzrgqjrjIDroZwgNjAsIOq4iO2YuOumrOyyuOyLnOyVhA%3D%3D&mpx=11237680%3A37.4758339%2C126.6960761%3AZ11%3A0.0268745%2C0.0192863&tab=1&enc=b64" target="_blank">지도 크게 보기</a>  </td>  <td width="98" bgcolor="#f9f9f9" align="right" style="text-align:right; padding-right:9px; border-right:1px solid #cecece; border-bottom:1px solid #cecece;">   <span style="float:right;"><span style="font-size:9px; font-family:Verdana, sans-serif; color:#444;">&copy;&nbsp;</span>&nbsp;<a style="font-family:tahoma; font-size:9px; font-weight:bold; color:#2db400; text-decoration:none;" href="http://www.nhncorp.com" target="_blank">NAVER Corp.</a></span>  </td>  </tr>  </table> </td> </tr>  </table>
						</div>
						</td>
					</tr>
			  </table>
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
