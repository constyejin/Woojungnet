<div class="con_cs">
<table width="190" border="0" cellpadding="0" cellspacing="0" bordercolor="108e52">
  <tr>
    <td height="146" valign="top" bgcolor="#FFFFFF"><img src="/images/main_cs.jpg" class="content_boxLine"/></td>
  </tr><tr>
        <td height="10"></td>
      </tr>
</table>
<!--<p style="padding-top:15px"><img src="/images/img_bank.jpg">--></div>

<div  style=" margin-top:10px;">
<iframe name="HiddenFrm" style="display:none;"></iframe>
<form name="main_car" method="post" enctype="multipart/form-data" target="HiddenFrm" action="/sub01/sub01_2_save.php">
<input type="hidden" name="mode" value="regist">
<input type="hidden" name="mode2" value="regist2">
	<!-- <table border="0" cellspacing="0" cellpadding="0">
      
    </table>
	<table width="235" border="0" cellspacing="0" cellpadding="0">
		<tr>
		<td  style="border-top:1px solid #b6b6b7;border-left:1px solid #b6b6b7;border-right:1px solid #b6b6b7;"><img src="/images/main_sns.jpg" width="248" height="40" /></td>
		</tr>
		<tr>
		<td align="center" style="border:1px solid #b6b6b7;">
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
			<tr>
			<td width="25%" align="center" bgcolor="#f6f6f6"><strong>상담유형</strong></td>
			<td height="30" align="left" bgcolor="#ffffff" style="padding-left:5px;"><input name="calltype" type="radio" value="사고차량" /> 
			사고차 
			  <input name="calltype" type="radio" value="폐차차량" /> 
			  폐차 
			  <input name="calltype" type="radio"  value="중고차량" /> 
			  중고차</td>
			</tr>
			<tr>
			<td align="center" bgcolor="#f6f6f6"><strong>이름*</strong></td>
			<td height="30" align="left" bgcolor="#ffffff" style="padding-left:5px;"><input name="call_name" type="text" style=" width:88%" value="" /></td>
			</tr>
			<tr>
			<td height="30" align="center" valign="middle" bgcolor="#f6f6f6"><strong>휴대전화*</strong></td>
			<td height="30" align="left" bgcolor="#ffffff" style="padding-left:5px;"><input name="call_tel" required="required" type="text" size="2" maxlength="3" value="" hname="핸드폰번호" />
			-
			<input name="call_tel2" required="required" type="text" size="4" maxlength="4" value="" hname="핸드폰번호" />
			-
			<input name="call_tel3" required="required" type="text" size="4" maxlength="4" value="" hname="핸드폰번호" /></td>
			</tr>
			<tr>
			<td height="30" align="center" valign="middle" bgcolor="#f6f6f6"><strong>차량번호*</strong></td>
			<td height="30" align="left" bgcolor="#ffffff" style="padding-left:5px;"><input name="car_name" type="text" style=" width:88%"/></td>
			</tr>
			<tr>
			<td align="center" bgcolor="#f6f6f6"><strong>메모</strong></td>
			<td height="30" align="left" bgcolor="#ffffff" style="padding-left:5px; padding-bottom:5px;"><textarea name="wc_memo" rows="4" style="border:1px solid #008ad9; width:88%"></textarea></td>
			</tr>
			<tr>
			<td height="30" colspan="2" align="center" bgcolor="#FFFFFF" style="font-size:11px;">메모를 남겨두시면 전문상담원이 연락드립니다</td>
			</tr>
			<tr>
			<td height="30" align="center" bgcolor="#FFFFFF">&nbsp;</td>
			<td height="40" align="left" bgcolor="#FFFFFF">
				<table border="0" cellpadding="0" cellspacing="0">
				<tr>
				<td><input type="checkbox" name="checkbox" id="ch1" value="checkbox" /></td>
				<td>개인정보동의&nbsp;<img src="/images/main_sns02.jpg" onclick="main_car_ok();" style="cursor:pointer;"/></td>
				</tr>
				</table>			</td>
			</tr>
			</table>
		</td>
		</tr>
	</table> -->
</form>
</div>
<script>
function main_car_ok(){
	f=document.main_car;
	if(document.getElementById('ch1').checked==false){
		alert('개인정보동의해 주세요');
	}else if(f.call_name.value==""){
		alert('이름을 입력해 주세요.');
	}else if(f.call_tel.value==""||f.call_tel2.value==""||f.call_tel3.value==""){
		alert('휴대전화번호를 입력해 주세요.');
	}else if(f.car_name.value==""){
		alert('차량번호를 입력해 주세요.');
	}else{
		document.main_car.submit();
	}
}
</script>