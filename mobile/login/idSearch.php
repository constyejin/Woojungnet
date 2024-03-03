<?

require_once "../lib/config.php";
require_once "$setup/dbconn.php";
require_once "$setup/lib.php";
?>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title></title>
  <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
  <link rel="stylesheet" type="text/css" href="/common/css/base.css?v=221208"/>

	<link rel="stylesheet" type="text/css" href="/common/css/style.css"/>
	<link rel="stylesheet" type="text/css" href="/common/css/add_style.css?v=2212081209"/>  <!-- 2022.11.25 css추가  -->
	<link rel="stylesheet" type="text/css" href="/common/css/incaron_style.css"/>  <!-- 2022.11.25 css추가  -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
	
	<!-- swiper.js css-->
	<link
		rel="stylesheet"
		href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css"
	/>
	<!-- swiper.js js-->
	<script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>

  <script src="/common/js/incaron_ui.js"></script>
  <script src="/common/js/front.js"></script>
</head>
<?


$ujumin = trim($ujumin1) ."-". trim($ujumin2) ."-". trim($ujumin3);
$SQL = "Select userId, userPw, email, name,pcs From woojung_member Where name='".trim($uname)."' and  pcs='".trim($ujumin)."' and  email='".trim($uemail)."' ";
$result = mysql_query($SQL, $connect) or die(mysql_error());
$row = mysql_fetch_array($result);
if( $row[userId] == "" || $row[userId] == ""){
	 echo("
        <script>
         alert('일치하는 회원정보가 없습니다. 다시 시도해 주세요.');
         </script>
         ");
	exit;
}

//echo $SQL ;


// HTML Tag를 제거하는 함수
function del_html( $str ) {
	$str = str_replace( ">", "&gt;",$str );
	$str = str_replace( "<", "&lt;",$str );
	return $str;
}

// 지정된 파일의 내용을 읽어옴
function rfile($filename) {
	if(!file_exists($filename)) return '';
	$f = fopen($filename,"r");
	$str = fread($f, filesize($filename));
	fclose($f);
	return $str;
}


if ($answer=="1"){
	$sender_email="\"$shop_name\"<$admin_email>";
}


$userId = $row[userId];
$userPw = $row[userPw];
$email = $row[email];
$name = $row[name];
$pcs=$row[pcs];

$html = 1;
$subject = $name."님, 문의하신 내용입니다.";


		$data_web=mysql_fetch_array(mysql_query("select * from js_webconfig where no=1"));
		$data_sms=mysql_fetch_array(mysql_query("select * from sms where idx=1"));
		$sms_b=$data_sms[auto5];
		$sms_b=str_replace("(이름)",$name,$sms_b);
		$sms_b=str_replace("(아이디)",$userId,$sms_b);
		$sms_b=str_replace("(비밀번호)",$userPw,$sms_b);
?>
		<iframe name="HiddenFrm_sms" style="display:none;"></iframe>
<form name="sendsms" method='post' action='https://www.skysms.co.kr/apiSend/sendApi_UTF8.php' target="HiddenFrm_sms">
	<input type='hidden' name='sUserid' value='<?=$data_web[sms_id]?>'>	<!-- 회원 UserId, 필수입력정보 9원문자 회원가입 시 발급-->
	<input type='hidden' name='authKey' value='<?=$data_web[shop_onlineno]?>'>	<!-- 회원 인증키, 필수입력정보 9원문자 회원가입,연동신청  후 발급 -->
	<input type='hidden' name='sendMsg' value='<?=$sms_b?>'>	<!-- 전송할 메세지 내용, 필수입력정보 -->
	<input type='hidden' name='destNum' value='<?=$pcs?>'>	<!-- 받는분 휴대폰번호, 필수입력정보 대량전송의 경우 |로 구분하여 입력해주시기 바랍니다. 01000000000|01000000001|01000000002 -->
	<input type='hidden' name='callNum' value='<?=$data_sms[number]?>'>	<!-- 보내는분 전화번호, 필수입력정보 -->
	<input type='hidden' name='sMode' value='Real'>	<!-- 실제전송과 테스트전송을 구분하는 변수, 필수입력정보, 테스트전송(Test) or 실전송(Real) 기본값 : Test  -->
	<input type='hidden' name='sendDate' value=''>	<!-- 전송시간설정(예약), 선택옵션 입력정보, 값이없거나 지난 시간의 경우 즉시발송 형식을 지켜주시기 바랍니다.-->
	<input type='hidden' name='returnURL' value='http://<?=$_SERVER['SERVER_NAME']?>/inc/sms_count.php'>	<!-- 전송 후 이동할 사이트 URL, 선택옵션 입력정보, 결과코드,완료건수,실패건수,남은건수등을 받아볼수 있습니다. -->
	<input type='hidden' name='customVal' value=''>	<!-- 사용자정의 변수, 선택옵션 입력정보, 회원님께서 임의로 지정한 변수를 사용할수 있습니다. 변수명^값|변수명^값-->	
	<input type='hidden' name='sType' value='SMS'>	<!-- 짧은문자와 장문문자를 구분하는 변수, 선택입력정보, 짧은문자(SMS) or 장문문자(LMS) 기본값 : SMS -->
	<input type='hidden' name='sSubject' value=''>	<!-- sType의 값이 LMS일 경우만 사용, 장문문자의 제목, 최대길이 한글20자이내설정, 기본값:장문메세지 -->	
</form>

		<SCRIPT LANGUAGE="JavaScript">
		document.sendsms.submit();
		alert('회원정보가 문자로 전송되었습니다.');
//		parent.document.location.href='/';
		parent.document.frmSearch.uname.value='';
		parent.document.frmSearch.ujumin1.value='';
		parent.document.frmSearch.ujumin2.value='';
		parent.document.frmSearch.ujumin3.value='';
		parent.document.frmSearch.uemail.value='';
		</SCRIPT>
