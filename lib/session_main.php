<?
 
/*
======================================================
==  회원 세션 값 받기
==  2008-09-04  김은성

// 로그인 세션 설정
$connUser = array(
	"mno"               =>  $BCRs[0]["Mim_IDX"],
	"uid"               =>  $BCRs[0]["Mim_ID"],
	"name"              =>  $BCRs[0]["Mim_Name"],
	"email"             =>  $BCRs[0]["Mim_Email"]
);
======================================================
*/


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