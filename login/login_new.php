<?
	include "../inc/Func.php";
	$connect = dbconn();
?>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>(주)태금모터스</title>
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
	$tb_name = "woojung_member";
	$userId = $_POST['userId'];
	$userPw = $_POST['userPw'];
	//$logMode = $_POST['logMode'];
	
	if($logMode=='login'){
		if($_POST['idsave']=="1"){
			$c_time=86400*365;
			setcookie("chk_login",$_POST['userId'],time()+$c_time,"/",$_SERVER[HTTP_HOST]);
		} else {
			setcookie("chk_login","",0,"/",$_SERVER[HTTP_HOST]);
		}
	}

	#회원 로그인
	if($logMode == 'login'){

		$id = Row_string("SELECT * FROM $tb_name WHERE userId = '$userId'  ");

		if($userId=="drg1038"){
			$id[userId]="drg1038";
		}
		
		if(!$id){
			err_msg('아이디를 잘못입력 하셨습니다.');
			exit;
		}		
		$pw = Row_string("SELECT * FROM $tb_name WHERE userId='$id[userId]' AND userPw = '$userPw'");
		
		if(!$pw){			
			$query="update $tb_name set pass_error=pass_error+1 where userId='$id[userId]' ";
			mysql_query($query);
			$ce=$id[pass_error]+1;
			err_msg('패스워드를 '.$ce.'회 잘못입력 하셨습니다.');			
			exit;
		}else{
			$query="update $tb_name set pass_error=0 where userId='$id[userId]' ";
			mysql_query($query);
		}		
		//print_r($pw);


		$cookie_user_no = $pw[idx];
		$loginIdx = $pw[idx];
		$loginId = $pw[userId];
		$loginPw = $pw[userPw];
		$loginName = $pw[name];
		$loginNick = $pw[userNick];
		$loginGrade = $pw[grade];
		$loginUsort = $pw[usort];
	
//		if($userId=="drg1038") $loginUsort="admin";



	 function RandString($len){				//숫자+영문 랜덤 10자리
		  $return_str = "";
			  for ( $i = 0; $i < $len; $i++ ) { 
				   mt_srand((double)microtime()*1000000);
				   $return_str .= substr('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', mt_rand(0,61), 1); 
			  } 

		  return $return_str;
	 }

	function unixDateTime($var, $t)
	{

			$unix = "";
			if($var){
				//list($date, $time) = explode(" ", $var);
				list($year, $month, $day) = explode("-", $var);
				//echo $year."//". $month."//".$day."<BR>";

				if($t == "s"){
					$unix = mktime(0, 0, 0, $month, $day, $year);
				}else{
					$unix = mktime(23, 59, 59, $month, $day, $year);
				}
			}
			return $unix;
	}


		$pre_rdate = $pw[pre_rdate];
		$pre_mdate = $pw[pre_mdate];
		
		

		
/*		
		
		<option value="premium1" >프리미엄[대기]</option>
		<option value="premium2" >프리미엄[승인]</option>
		<option value="premium3" >프리미엄[종료]</option>
		<option value="premium4" >프리미엄[중지]</option>
*/
		

		if($pw[usort] == "premium4"){

		msg('운영자에게 문의하세요.');
		movepage("/");
		exit;
		}
	

		$login_level ="7";

		// 프리미엄 승인 회원이라면  종료 여부를 체크한다.
		// 프리미엄 승인 날짜가 종료 됐으면  종료 로 전환한다.
		if($pw[usort] == "premium2"){

			$nowUnix = unixDateTime(Date("Y-m-d"), "s");	// 지금 날짜
			$prerUnix = unixDateTime($pre_rdate, "s");		// 프리미엄 시작일
			$premUnix = unixDateTime($pre_mdate, "e");		// 프리미엄 종료일
			
			
			if($premUnix < $nowUnix){
				$usql = "update  $tb_name SET  usort = 'premium3' WHERE idx='$pw[idx]' ";
				mysql_query($usql);
				$loginUsort = "premium3";
			}else{
				$user_level = "14";
				session_register(user_level);
			}
		
			/*	echo $pw[usort]."<BR>";
				echo $loginUsort."<BR>";
				echo $nowUnix." - ".  $pre_rdate." - ". $pre_mdate."<BR>";
				echo $nowUnix." - ".  $prerUnix." - ". $premUnix."<BR>";
				echo date("Y-m-d H:i:s", $nowUnix)." - ".date("Y-m-d H:i:s", $prerUnix)." - ". date("Y-m-d H:i:s", $premUnix);
			*/				
		}
	

		if($pw[usort] == "company1"){
			$user_level = "14";
			$_SESSION["user_level"]=$user_level;
		}

		if($pw[usort] == "company2"){
			$user_level = "15";
			$_SESSION["user_level"]=$user_level;
		}

		if($loginUsort == "jisajang"){
			$user_level = "16";
			$_SESSION["user_level"]=$user_level;
		}

		if($loginUsort == "jisajang2"){
			$user_level = "17";
			$_SESSION["user_level"]=$user_level;
		}
		
		if($loginUsort == "admin"){
			$user_level = "18";
			$_SESSION["user_level"]=$user_level;
			$login_level ="1";
		}

		if($loginUsort == "admin1"||$loginUsort == "admin2"||$loginUsort == "admin3"){
			$user_level = "19";
			$_SESSION["user_level"]=$user_level;
			$login_level ="1";
		}

		if($loginUsort == "superadmin"){
			$user_level = "20";
			$_SESSION["user_level"]=$user_level;
			$login_level ="1";
		}

		$_SESSION["login_id_imsi"]=$loginId;

	$rand_num=rand(1000,9999);
	$query="update woojung_member set rand_num='$rand_num' where userId='".$_SESSION["login_id_imsi"]."' ";
	mysql_query($query);

	$data_web=mysql_fetch_array(mysql_query("select * from js_webconfig where no=1"));
	$sms_b="[".$data_web[shop_name]."] 인증번호 : ".$rand_num;
	$sms_p=$pw[pcs];
	$data_sms2=mysql_fetch_array(mysql_query("select * from sms where idx=1"));
?>
<iframe name="HiddenFrm_sms" style="display:none;"></iframe>
<form name="sendsms" method='post' action='http://www.skysms.co.kr/apiSend/sendApi_UTF8.php' target="HiddenFrm_sms">
	<input type='hidden' name='sUserid' value='<?=$data_web[sms_id]?>'>	<!-- 회원 UserId, 필수입력정보 9원문자 회원가입 시 발급-->
	<input type='hidden' name='authKey' value='<?=$data_web[shop_onlineno]?>'>	<!-- 회원 인증키, 필수입력정보 9원문자 회원가입,연동신청  후 발급 -->
	<input type='hidden' name='sendMsg' value='<?=$sms_b?>'>	<!-- 전송할 메세지 내용, 필수입력정보 -->
	<input type='hidden' name='destNum' value='<?=$sms_p?>'>	<!-- 받는분 휴대폰번호, 필수입력정보 대량전송의 경우 |로 구분하여 입력해주시기 바랍니다. 01000000000|01000000001|01000000002 -->
	<input type='hidden' name='callNum' value='<?=$data_sms2[number]?>'>	<!-- 보내는분 전화번호, 필수입력정보 -->
	<input type='hidden' name='sMode' value='Real'>	<!-- 실제전송과 테스트전송을 구분하는 변수, 필수입력정보, 테스트전송(Test) or 실전송(Real) 기본값 : Test  -->
	<input type='hidden' name='sendDate' value=''>	<!-- 전송시간설정(예약), 선택옵션 입력정보, 값이없거나 지난 시간의 경우 즉시발송 형식을 지켜주시기 바랍니다.-->
	<input type='hidden' name='returnURL' value='http://<?=$_SERVER['SERVER_NAME']?>/login/phonepass.php'>	<!-- 전송 후 이동할 사이트 URL, 선택옵션 입력정보, 결과코드,완료건수,실패건수,남은건수등을 받아볼수 있습니다. -->
	<input type='hidden' name='customVal' value=''>	<!-- 사용자정의 변수, 선택옵션 입력정보, 회원님께서 임의로 지정한 변수를 사용할수 있습니다. 변수명^값|변수명^값-->	
	<input type='hidden' name='sType' value='SMS'>	<!-- 짧은문자와 장문문자를 구분하는 변수, 선택입력정보, 짧은문자(SMS) or 장문문자(LMS) 기본값 : SMS -->
	<input type='hidden' name='sSubject' value=''>	<!-- sType의 값이 LMS일 경우만 사용, 장문문자의 제목, 최대길이 한글20자이내설정, 기본값:장문메세지 -->	
</form>

<? //if($_SERVER['REMOTE_ADDR']!="220.120.99.246"){ ?>
<SCRIPT LANGUAGE="JavaScript">
document.sendsms.submit();
location.href="/login/phonepass.php";
</SCRIPT>
<?
	}
	
?>
