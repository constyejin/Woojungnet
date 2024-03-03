<?
	include "../inc/Func.php";
	$connect = dbconn();
?>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Incaron</title>
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
			err_msg('패스워드를 잘못입력 하셨습니다.');			
			exit;
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


		$_SESSION["cookie_user_no"]=$cookie_user_no;
		$_SESSION["loginIdx"]=$loginIdx;
		$_SESSION["loginId"]=$loginId;
		$_SESSION["loginPw"]=$loginPw;
		$_SESSION["loginName"]=$loginName;
		$_SESSION["loginNick"]=$loginNick;
		$_SESSION["loginGrade"]=$loginGrade;
		$_SESSION["loginUsort"]=$loginUsort;

		$_SESSION["login_id"]=$loginId;
		$_SESSION["login_name"]=$loginName;
		$_SESSION["login_level"]=$login_level;
		$_SESSION["login_user_no"]=$cookie_user_no;
		$_SESSION["user_company"]=$pw[company];

		$result = Query_string("UPDATE $tb_name SET loginTime = now(),logincnt=logincnt+1 WHERE idx = '$pw[idx]'");
		
//		msg($_SESSION[loginId]);
		$p_date=date("Y-m-d",strtotime("now" . " -3 month"));
		if($pw[pw_mod_date]<$p_date){
			echo '<script>parent.location.href="/member/newpass.php";</script>';
		}else{
			echo '<script>parent.location.href="/";</script>';
		}
	}
	
	#로그아웃
	if($logMode == 'logout'){
		Query_string("update woojung_member set logoutTime = now() where userId = '$_SESSION[loginId]'");
		
		session_destroy();
		
		msg('로그아웃 되셨습니다.');
		movepage("/");	
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<title>Untitled Document</title>
</head>

<body>
</body>
</html>
