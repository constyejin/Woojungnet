<?php
	$dir = $_SERVER['DOCUMENT_ROOT'];
	include $dir."/inc/Func.php";
	include $dir."/lib/code.php";
	$connect = dbconn();


	function dloginCheck() {
		global $loginId,$loginPw;
			if(!$loginId || !$loginPw) {
				echo "<script>alert(' 로그인후 이용해주세요!  ');location.href='/';</script>";
			return exit;
		}
	}



/*$sessionDir = $_SERVER['DOCUMENT_ROOT'];

session_cache_limiter("nocache"); 
session_set_cookie_params(0,"/"); 
session_save_path($sessionDir.'/session_tmp'); 
session_start(); 

$loginId		= $_SESSION['userId']; 
$loginPw		= $_SESSION['userPw'];
$loginName		= $_SESSION['name'];
$loginNick		= $_SESSION['userNick'];
$loginUsort		= $_SESSION['usort'];
$loginGrade		= $_SESSION['grade'];

#########################################################################################
#			로그인체크 함수 
#########################################################################################

function loginCheck() {
	global $loginId,$loginPw;
	if(!$loginId || !$loginPw) {
		echo "<script>alert('먼저 로그인하세요!');history.go(-1);</script>";
	return exit;
	}
}

function premiumUpOnly() {
	loginCheck();
	global $loginUsort,$loginGrade;

	if(($loginUsort == 'premium' && ($loginGrade == 'a' || $loginGrade == 'b')) || $loginUsort == 'admin' || $loginUsort == 'superAdmin') { 
	} else {

		echo "<script>alert('접근불가등급입니다!');history.go(-1);</script>";
	return exit;
	} 
}

function companyUpOnly() {
	loginCheck();
	global $loginUsort;
	if($loginUsort == 'indi') {
		echo "<script>alert('접근불가등급입니다!');history.go(-1);</script>";
	return exit;
	} 
}*/



// 회원번호
Function SesUMNO(){
	global $connUser;
	if($connUser["mno"]){		
		return $connUser["mno"];
	}else{
		return false;
	}
}


// 아이디
Function SesUID(){
	global $connUser;
	if($connUser["uid"]){		
		return $connUser["uid"];
	}else{
		return false;
	}
}


// 이름
Function SesUNM(){
	global $connUser;
	if($connUser["name"]){		
		return $connUser["name"];
	}else{
		return false;
	}
}


// 이메일
Function SesUMAIL(){
	global $connUser;
	if($connUser["email"]){		
		return $connUser["email"];
	}else{
		return false;
	}
}


// 해당 회원 권한 값
Function SesLevel(){
	global $connUser;
	if($connUser["level"]){	
		return $connUser["level"];
	}else{
		return false;
	}
}


// 로그인 되었는지 체크한다.
Function LoginChk(){
	global $connUser;
	if($connUser["mno"]){	
		return true;
	}else{
		return false;
	}
}
?>