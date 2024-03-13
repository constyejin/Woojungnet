		<form name="form_login" action="<?=$_SERVER['PHP_SELF']?>" method="post" onSubmit="if(this.passwd.value==''){alert('비밀번호를 입력하세요.');this.passwd.focus();return false;}else{return;}">
		  <input type="hidden" name="page" value="<?=$page?>">
		  <input type="hidden" name="mode" value="pwconfirm">
		  <input type="hidden" name="no" value="<?=$no?>">
		  <input type="hidden" name="id" value="<?=$id?>">
		  <input type="hidden" name="passed" value="<?=$passed?>">
		  <table width="300" border="0" align="center" cellpadding="0" cellspacing="0" style="margin-top:100px; border:1px solid #655a4a;">
			<tr height="30">
			  <td colspan="2" align="center" style="background-color:#ad9d88; color:white;"><b>본 인 확 인</b></td>
			</tr>
			<tr style="background-color:#ffffff;">
			  <td width="130" height="50" align="right">비밀번호</td>
              <td width="168" align="left">&nbsp;<input type="password" name="confirm_pwd" class="input"></td>
			</tr>
			<tr>
			  <td height="40" colspan="2" align="center" style="background-color:#ffffff;">
					<div style="padding: 20px 0;">
						<a onclick="pass_c();" href="javascript:void(0)" class="btn-blue">
						확인
						</a>
						<a onclick="javascript:location.href='board.php?id=<?=$id?>';" href="javascript:void(0)" class="btn-blue" style="margin-left: 5px;">
						목록
						</a>
					</div>

					<!-- <img src='../board/img/btn/btn_ok.gif' class="imgbt1" onclick="pass_c();"/>

					<img src='../board/img/btn/btn_list.gif' class="imgbt1" onclick="javascript:location.href='board.php?id=<?=$id?>';" />			  -->
				</td>
			</tr>
		  </table></td>
			</tr>
		</table>
		</form>
<script>
	function pass_c(){
		f=document.form_login;
		if(f.confirm_pwd.value==''){
			alert('비밀번호를 입력하세요.');
			return;
		}
		f.submit();
	}
</script>


<!--<table width="711" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr>
	  <td>
		<form name="form_login" action="<?=$_SERVER['PHP_SELF']?>" method="post" onSubmit="if(this.passwd.value==''){alert('비밀번호를 입력하세요.');this.passwd.focus();return false;}else{return;}">
		  <input type="hidden" name="page" value="<?=$page?>">
		  <input type="hidden" name="mode" value="pwconfirm">
		  <input type="hidden" name="no" value="<?=$no?>">
		  <input type="hidden" name="id" value="<?=$id?>">
		  <input type="hidden" name="passed" value="<?=$passed?>">

		  <table border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#5d8ab9">
			<tr>
			  <td>
		  <table border="0" align=center cellpadding=0 cellspacing=0>
			<tr height=30>
			  <td colspan=2 align=center style="background:#5d8ab9;color:white; font-weight:bold"> 본 인 확 인 </td>
			</tr>
			<tr height=40 style="background:#EFEFEF;padding-top:10">
			  <td width=100 align=center> 비밀번호</td>
			  <td width=150><input type=password name="confirm_pwd" style="width=:100px"></td>
			</tr>
			<tr>
			  <td height="40" colspan=2 align=center style="background:#EFEFEF;">
			  <input type="hidden" value="" name="qno"><input type=submit value="확인" onFocus="blur()" style="width:70px; padding-top:2px;">&nbsp;<input type=button value="목록"  onFocus="blur()" style="width:70px; padding-top:2px;">
			  </td>
			</tr>
		  </table></td>
			</tr>
		</table>
		</form>
	  </td>
	</tr>
</table>-->