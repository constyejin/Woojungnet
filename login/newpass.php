<?include "../inc/header.php" ?>
<?
	if(!$_SESSION["login_id"]){
		echo "<script>alert('로그인후 사용 가능합니다.');history.back();</script>";
	}
?>
<script>

	function check_ID_Window(){		
		var frm = document.join;
		
		if(frm.yuserPw.value == "" ){
			alert("현재 비밀번호를 입력해주세요");
			frm.yuserPw.focus();
			return;
		}	

		if(frm.u_pw2.value == "" ){
			alert("변경 비밀번호를 입력해주세요");
			frm.u_pw2.focus();
			return;
		}	

		if(frm.u_pw_cf2.value == "" ){
			alert("변경 비밀번호 확인을 입력해주세요");
			frm.u_pw_cf2.focus();
			return;
		}	

		if(frm.u_pw2.value != frm.u_pw_cf2.value ){
			alert("변경 비밀번호와 변경 비밀번호 확인이 다릅니다.");
			return;
		}	

		if(frm.u_pw2.value == frm.yuserPw.value ){
			alert("현재 비밀번호와 변경 비밀번호를 다른게 입력해 주세요.");
			return;
		}	

		frm.action="proc.php";
		frm.submit();
	}	
</script>
<style type="text/css">
.join_img_body { position:relative;  margin-top:40px; }
.join_img_body ul li { width:250px; float:left; }
.join_img_body table { }
.join_img_body table.join_form tr th { background:#f7f7f7; border:1px solid #949294; font-weight:normal; }
.join_img_body table.join_form tr td { text-align:left; padding:2px 2px 2px 2px; color:#000000; border:1px solid #949294;}
.join_img_body table.join_form tr td  table { padding:0; margin:0; }
.join_img_body table.join_form tr td  table tr td { padding:0; margin:0; border:none; padding:2px 2px 2px 2px; }
.div_title { text-align:left; margin-top:20px; }
input[type=text] { padding:1px 1px 1px 1px; border:1px solid #008ade; }
input[type=password] { padding:1px 1px 1px 1px; border:1px solid #008ade; }
.div_con { width:759px; height:130px; overflow-y:scroll; text-align:left; white-space:pre-line; padding:10px; margin:0px;	border:1px solid #959595; line-height:150%; }
.confirm_area { margin:15px 0; }
.style1 {color: #0000FF}
</style>


<div id="new_wrap">

	<div id="main_wrap">
		<div id="cha_contents">
			<!-- login -->
			<div id="con_left">
<?include "../inc/login.php";?>
				<!-- 좌측 서브 메뉴 start -->
<?/*include "../mypage/mypage_menu.php";*/?>
				<!-- 좌측 서브 메뉴 end -->
			</div>
			<div id="con_right">
				<div class="sub-visual">
					<div class="sub-text">
						<p class="catch-phrase">
						비밀번호 변경
						</p>
						<p class="description-text">
							공정하고 투명하며 신속, 정확한 정보를 제공합니다.
						</p>
					</div>
				</div>
				<!-- <h1><img src="/images/img_sub1.jpg"></h1> -->
				<table width="760" border="0" cellspacing="0" cellpadding="0">
					<tr> 
						<td height="1"></td>
					</tr>
					<tr> 
						<td height="38" align="left" valign="bottom"><!--img src="/images/img_mypage_6_bar.gif" /--></td>
					</tr>
					<tr>
						<td>
							
						</td>
					</tr>
				</table>	
				<!---->
<form name="join"  method="post" >
<input type="hidden" name="Mode" value="newpass">
								  <table style="margin-bottom: 50px" width="100%" border="0" cellspacing="0" cellpadding="0">
                                      <tr>
                                        <td height="130" colspan="2" align="center" style="line-height:40px"><span style="font-size:26px; font-weight:bold"><font color="#0066CC">
                                          <?=$_SESSION[login_name]?>
                                          님</font>께서는 비밀번호를 변경하신지 3개월이 지났습니다.</span><br />
                                          서비스의 안전한 사용 및 개인정보보호를 위해 비밀번호를 변경 하시기 바랍니다.</td>
                                      </tr>
                                      <tr>
                                        <td height="70" align="center"><table border="0" cellspacing="0" cellpadding="0" style="width:420px;">
                                            <tr>
                                              <td width="130" style="border-bottom:1px solid #CCCCCC;">현재 비밀번호</td>
                                              <td valign="bottom"><input type="password" name="yuserPw"  maxlength="28" required="" style="border-bottom:1px solid #CCCCCC; height:40px; width:280px; border-top:0px;border-left:0px;border-right:0px;" /></td>
                                          </tr>
                                        </table></td>
                                      </tr>
                                      <tr>
                                        <td height="70" align="center" ><table border="0" cellspacing="0" cellpadding="0" style="width:420px;">
                                            <tr>
                                              <td width="130" style="border-bottom:1px solid #CCCCCC;">변경 비밀번호</td>
                                              <td valign="bottom"><input type="password" name="u_pw2"  style="border-bottom:1px solid #CCCCCC; height:40px; width:280px; border-top:0px;border-left:0px;border-right:0px;" maxlength="28" required="" /></td>
                                          </tr>
                                        </table></td>
                                      </tr>
                                      <tr>
                                        <td height="70" align="center" ><table border="0" cellspacing="0" cellpadding="0" style="width:420px;">
                                            <tr>
                                              <td width="130" style="border-bottom:1px solid #CCCCCC;">변경 비밀번호 확인</td>
                                              <td valign="bottom"><input type="password" name="u_pw_cf2"  style="border-bottom:1px solid #CCCCCC; height:40px; width:280px; border-top:0px;border-left:0px;border-right:0px;" maxlength="28" required="" /></td>
                                          </tr>
                                        </table></td>
                                      </tr>
                                      <tr>
                                        <td height="80" align="center" valign="bottom" ><table border="0" cellspacing="0" cellpadding="0" style="width:420px;">
                                          <tr>
                                            <td><img src="/images/newpass_bt.jpg"  onclick="check_ID_Window();" style="cursor:pointer;"/></td>
                                            <td>&nbsp;</td>
                                            <td><a href="/"><img src="/images/newpass_bt02.jpg" style="cursor:pointer;"/></a></td>
                                          </tr>
                                        </table>
                                        </td>
                                      </tr>
                                  </table>
</form>
  </div>

			</div>
		</div>
	</div>
	<!-- footer -->
	<div class="cha_footer"><? include "../inc/bottom.php" ?></div>
</div>

</body>
</html>

