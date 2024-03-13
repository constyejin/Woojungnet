<?
include $_SERVER[DOCUMENT_ROOT]."/manage/inc/header.php";


$data_web=mysql_fetch_array(mysql_query("select * from js_webconfig where no=1"));
$data_sms=mysql_fetch_array(mysql_query("select * from sms where idx=1"));
$bankno=explode("/" , $data_web[bankno]);
$sms_b=str_replace("(은행명)",$bankno[0],$data_sms[auto3]);
$sms_b=str_replace("(계좌번호)",$bankno[1],$sms_b);
$sms_b=str_replace("(예금주)",$bankno[2],$sms_b);
?>

		<iframe name="HiddenFrm" style="display:none;"></iframe>
		<form name="sendsms" method='post' action='https://www.skysms.co.kr/apiSend/sendApi_UTF8.php' target="HiddenFrm">
			<input type='hidden' name='sUserid' value='<?=$data_web[sms_id]?>'>	<!-- 회원 UserId, 필수입력정보 9원문자 회원가입 시 발급-->
			<input type='hidden' name='authKey' value='<?=$data_web[shop_onlineno]?>'>	<!-- 회원 인증키, 필수입력정보 9원문자 회원가입,연동신청  후 발급 -->
			<input type='hidden' name='sendMsg' value='<?=$sms_b?>'>	<!-- 전송할 메세지 내용, 필수입력정보 -->
			<input type='hidden' name='destNum' value='<?=$hp?>'>	<!-- 받는분 휴대폰번호, 필수입력정보 대량전송의 경우 |로 구분하여 입력해주시기 바랍니다. 01000000000|01000000001|01000000002 -->
			<input type='hidden' name='callNum' value='<?=$data_sms[number]?>'>	<!-- 보내는분 전화번호, 필수입력정보 -->
			<input type='hidden' name='sMode' value='Real'>	<!-- 실제전송과 테스트전송을 구분하는 변수, 필수입력정보, 테스트전송(Test) or 실전송(Real) 기본값 : Test  -->
			<input type='hidden' name='sendDate' value=''>	<!-- 전송시간설정(예약), 선택옵션 입력정보, 값이없거나 지난 시간의 경우 즉시발송 형식을 지켜주시기 바랍니다.-->
			<input type='hidden' name='returnURL' value='http://<?=$_SERVER['SERVER_NAME']?>/inc/sms_count.php'>	<!-- 전송 후 이동할 사이트 URL, 선택옵션 입력정보, 결과코드,완료건수,실패건수,남은건수등을 받아볼수 있습니다. -->
			<input type='hidden' name='customVal' value=''>	<!-- 사용자정의 변수, 선택옵션 입력정보, 회원님께서 임의로 지정한 변수를 사용할수 있습니다. 변수명^값|변수명^값-->	
			<input type='hidden' name='sType' value='LMS'>	<!-- 짧은문자와 장문문자를 구분하는 변수, 선택입력정보, 짧은문자(SMS) or 장문문자(LMS) 기본값 : SMS -->
			<input type='hidden' name='sSubject' value=''>	<!-- sType의 값이 LMS일 경우만 사용, 장문문자의 제목, 최대길이 한글20자이내설정, 기본값:장문메세지 -->	
		</form>

<SCRIPT LANGUAGE="JavaScript">
	document.sendsms.submit();
	alert('발송완료');
</script>