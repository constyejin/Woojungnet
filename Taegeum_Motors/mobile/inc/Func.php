<?	
/*
session_start();
*/
	@session_start();

	include_once "$_SERVER[DOCUMENT_ROOT]/lib/config.php";  


	function xls_down(){
		header( "Content-type: application/vnd.ms-excel; charset=euc-kr" ); 
		header( "Content-Disposition: attachment; filename=sample.xls" ); 
		header( "Content-Description: PHP4 Generated Data" ); 
	}
	
	function dbconn(){ 
    
		$connect = mysql_connect("localhost","wjn2403","q1w2e3r4") or die("에러 : 디비 연결 오류 입니다."); 
		 mysql_select_db("wjn2403",$connect) or die("에러 : 데이터 베이스 선택 오류 입니다."); 
		return $connect; 
    }
	
	function Row_string($str){

		global $connect;
		//echo $str;
		$result = mysql_query($str, $connect);
		$row = mysql_fetch_array($result);
		return $row;
	}
	function Query_string($str){
		global $connect;
		//echo $str;
		$result = mysql_query($str, $connect);
		return $result;
	}
	function Fetch_string($str){
		global $connect;
		//echo $str;
		$result = mysql_query($str, $connect);
		for($i=0;$i<=$arr=mysql_fetch_array($result);$i++){		
			$ret_file[$i] = $arr;
		}		
		return $ret_file;
	}
	 // 게시판 관리자 정보를 읽어오는 함수 
  	function setup(){ 
     global $connect, $id; 
		 
     if(!$id) err_msg("게시판의 ID를 지정하셔야 합니다. 예 : list.php?id=test"); 
	 $query = "select * from board_setup where board_id='$id' "; 	
     $result = mysql_query($query, $connect); 
     $data = mysql_fetch_array($result); 
     return $data; 
  	} 
	
	function id_check($id){
		global $connect;
		$query = "select * from member where user_id='$id'";
		$result = mysql_query($query, $connect) or die(mysql_error());
		$row = mysql_fetch_array($result);
		return $row[user_id];
	}
	
	//메인 페이지로 가보자!!!
	function go_root($pg){
		$url = $_SERVER['DOCUMENT_ROOT'].'/'.$pg;
		msg($url);
		movepage($url);
	}
	
	//substr로 한글을 자를때 2바이트씩 자르기
	function trim_text($subject,$num){
		$subject = substr($subject,0,$num);
		preg_match('/^([\x00-\x7e]|.{2})*/', $subject, $z); 
		$subject = $z[0];		
		return $subject;
	}
	function IsMember(){
		if(!$_SESSION[s_id]){
			return $code = "Error";
		}
			return $s_id = $_SESSION[s_id];
	}
	//숫자인지 검사한다.
	function check_num($isnum){
		if(!ereg("([:digit:])",$isnum)){
			return false;
		}
		
	}
	//팝업창 닫기
	function popup_close(){
		echo "
			<script>
				self.close();
			</script>
		";
	}
	//한글 깨짐 방지 및 글자 수 자르기
	function str_cut($text,$num){
		
		$subject = substr($text,0,$num);
		preg_match('/^([\x00-\x7e]|.{2})*/', $subject, $z); 
		
		if(strlen($text) > $num){
			$subject = $z[0]."..";	
		}else{
			$subject = $z[0];
		}
		return $subject;
	}
	//문자 변경	
	function replace($text){
		$temp = urlencode(stripslashes($text));
		return $temp;
	}
	function unreplace($text){
		$temp = urldecode(stripslashes($text));		
		return $temp;
	}
	//숫자 필드에 값을 입력하지 않으면 null로 수정	
	function isnull($form_var) 
	{
		if ($form_var == "") {
			return true; 
		} else {
			return false; 
		}
	}
	//히든 프레임으로 부모창 새로고침
	function ParentReload(){
		echo "<script>parent.location.reload();</script>";
	}
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
	}
	//메세지 출력 함수
	function msg($msg){
		echo "
			<script>
				alert('$msg');				
			</script>			
		";
		
	}
	
	//페이지 이동
	function movepage($url){
		echo "
			<script>
				location.href='$url';
			</script>
		";
	}

	
	//메세지 띄우기
	function err_msg($msg){
		echo "
			<script>
				alert('$msg');
				history.back(1);
			</script>
		";
	}
	
	
	//메세지 띄우고 페이지 이동하기
	function MsgMov($msg,$url){
		msg($msg);
		movepage($url);
		exit;
	}

	//이메일 체크 함수
	function email_check($email){
		$ErrCode = "no";
		
		$size = strlen($email);
		if($size > 50){
			msg("사용가능한 최대의 메일 주소 길이는 50자 입니다.");
			return $ErrCode; 
		}
		//이메일 형식에서 @문자로 분리한다.
		$address = explode('@',$email);	
		
		//@문자가 있는지 확인 한다.
		if(strpos($email, '@') == false || strpos($email, '@') != strrpos($email, '@')){
			msg("에러 : @문자 사용이 잘못되었습니다.");
			return $ErrCode;
		}		
		//사용자 게정의 길이가 4-12인지 확인 
		if(!((strlen($address[0]) >= 4) && (strlen($address[0]) <= 20))){
			msg("에러 : 이메일 주소 기본 글자수는 4~50자 사이에 입력하셔야 합니다.");
			return $ErrCode;
		}
		if(ereg("[^-_a-zA-Z0-9]",$address[0], $temp)){
			msg("에러 : 사용자 계정은 영문자 숫자 '-','_' 문자 이외에는 사용할 수 없습니다.");
			return $ErrCode;
		}
		//서버 주소에'.'가 있는지 체크 한다.
		if(!ereg(".", $address[1],$temp)){
			msg("에러 : 서버 주소가 없습니다.");
			return $ErrCode;
		}			
		if(ereg("[^-_a-zA-Z0-9]",$address[1], $temp)){
			msg("에러 : 서버 주소에 영문자 숫자 '-','_' 문자 이외에는 사용할 수 없습니다.");
			return $ErrCode;
		}
		return $ErrCode = 'yes';
	}
	
	
	//파일 확장자 가져오기
	function get_extention($file_name) 
	{
		return substr(strrchr($file_name,"."),1);
	}
	function ErrCode($code,$no){
		if($code == 'same'){			
			ErrMov("에러 : 같은 이름의 파일 존재합니다.","upload_school.php?no=$no&mode=");
			exit;
		}
		if($code == 'move'){			
			ErrMov("에러 : 파일 업로드시 오류가 발생했습니다.","upload_school.php?no=$no&mode=");
			exit;
		}
		if($code == 'mdir'){			
			ErrMov("에러 : 서버에 디렉토리 생성에 실패했습니다.","upload_school.php?no=$no&mode=");
			exit;
		}		
		if($code == 'change'){			
			ErrMov("에러 : 서버에 디렉토리 권한변경에 실패했습니다.","upload_school.php?no=$no&mode=");
			exit;
		}
		if($code == 'limit'){			
			ErrMov("파일 업로드 최대 용량은 10MB입니다. 확인해주세요","upload_school.php?no=$no&mode=");
			exit;
		}
	}
	//파일 업로드
	function FileUpload($file_name, $file_tmp, $file_path, $file_size){				
		
		$ext_name = strtoupper(get_extention($file_name));
		
		//확장자 체크		
		/*if (in_array($ext_name, array("JPG" , "GIF" , "PNG" , "BMP", "JPEG"))) {
			$FileType = "IMG";			
		} else if (in_array($ext_name, array("AVI" , "WMV" , "WMA", "MP3", 'PDF', 'EXE'))) {
			$FileType = "MOV";			
		} else {
			err_msg("에러 : 업로드 가능한 확장자가 아닙니다.");
			exit;
		}*/
		
		if($file_size > 10000000){
			err_msg("에러 : 파일 업로드 최대 용량은 10MB입니다. 확인해주세요");
			exit;
		}
		$file_name = time();
		$file_name .= ".".$ext_name;
		if(file_exists($file_path.$file_name)){
			err_msg("에러 : 같은 이름의 파일이 존재 합니다.");			
			exit;
		}
		if(!move_uploaded_file($file_tmp,$file_path.$file_name)){		
			err_msg("에러 : 파일 업로드중 에러가 발생했습니다. 잠시후 다시 시도해주세요");			
			exit;
		}
		return $file_name;	
		
	}
	//파일 Upload
	function upload($file_temp, $file_name, $path, $no, $file_size){		
	
	
		$ext_name = strtoupper(get_extention($file_name));
		
		//확장자 체크
		
		if(in_array($ext_name, array('PHP3','HTML','PHP','PHTML','INC'))){				
			msg("에러 : 업로드 가능한 확장자가 아닙니다.");
			exit;
		}
		if ($file_type =="IMG") {
			if (!in_array($ext_name, array("JPG" , "GIF" , "PNG" , "BMP"))) {
				msg("에러 : 이미지 파일이 아닙니다.");
				exit;
			}
		}
		if ($file_type =="MOV") {
			if (!in_array($ext_name, array("AVI" , "WMV" , "WMA", "MP3"))){			
				msg("에러 : 동영상 파일이 아닙니다.");
				exit;
			}
		}	
		
		if($file_size > 10000000){
			msg("에러 : 파일 업로드 최대 용량은 10MB입니다. 확인해주세요");
			return $err_msg = "limit";
		}
		if($path == 'student'){
			$path = "/upstudent/$no";
		}
		if($path == 'school'){
			$path = "/upschool/$no";
		}
		$result = is_dir($_SERVER['DOCUMENT_ROOT'].$path);
		if(!$result){		
			$result = mkdir($_SERVER['DOCUMENT_ROOT'].$path,0777);
			if(!$result){				
				return $err_code = "mdir";
				exit;
			}
			$result = chmod($_SERVER['DOCUMENT_ROOT'].$path,0777);
			if(!$result){			
				return $err_code = "change";
				exit;
			}
		}
		if($path == 'student'){
			$path = "/upstudent/$no/";
		}
		if($path == 'school'){
			$path = "/upschool/$no/";
		}
		//msg($path);
		//파일 업로드
		if(file_exists($_SERVER['DOCUMENT_ROOT'].$path.$file_name)){
			//msg("에러 : 같은 이름의 파일이 존재 합니다.");
			//return $err_code = "same";
			exit;
		}
		if(!move_uploaded_file($file_temp,$_SERVER['DOCUMENT_ROOT'].$path."/".$file_name)){		
			//msg("에러 : 같은 이름의 파일이 존재 합니다.");
			return $err_code = 'move';
			exit;
		}		
		
		return $err_code = "ok";
	}	

//파일 Upload2
	function student_upload($file_name, $file_temp ,$upload_path){		
		if(!file_exists($upload_path.$file_name)){					
			move_uploaded_file($file_temp, $upload_path.$file_name);			
		}
	}
//이미지 가로 사이즈 가져오기
function get_image_width($file_name)
{	
	if (is_file($file_name)) {
		$info = getimagesize($file_name);		
		return $info[0];
	}

}

//이미지 세로 사이즈 가져오기
function get_image_height($file_name)
{
	if (is_file($file_name)) {
		list($width, $height, $type, $attr) = getImagesize($file_name);
		return $height;
	}
}



//이미지 가로 /세로 사이즈 비율에 맞도록 사이즈 가져오기
function get_image_wh_size($max_width, $max_height, $file_name)
{
 
	if (is_file($file_name)) {

		list($width, $height, $type, $attr) = getImagesize($file_name);


 
		// 이미지 가로 사이즈가 최대 가로 사이즈 보다 클 경우 
		if($width > $max_width) 
		{ 
			// 가로기준 비율 축소 ($width 변수가 활용 되므로 height 보다 후에 작업해야함) 
			$height = ceil($max_width / $width * $height); 
			$width = ceil($max_width / $width * $width); 

			return "width = ".$width. " "."height=".$height;
		} 
		
		if($height > $max_height) 
		{ 
			// 세로기준 비율 축소 ($height변수가 활용되므로 width 보다 후에 작업해야함) 
			$width = ceil($max_height / $height * $width); 
			$height = ceil($max_height / $height * $height); 

			return "width = ".$width. " "."height=".$height;
		} 

	} else {
		return "width = ".$max_width. " "."height=".$max_height;

	}

}


function is_imgfile($file_name)
{
	if ($file_name =="") {
		return false;
	} else {
		$ext_name = strtoupper(get_extention($file_name));

		if (($ext_name=="JPG" || $ext_name=="GIF" || $ext_name=="PNG" || $ext_name=="BMP")) {
			return true;
		} else {
			return false;
		}
	}
}
 
function is_mediafile($file_name)
{
	if ($file_name =="") {
		return false;
	} else {
		$ext_name = strtoupper(get_extention($file_name));

		if (($ext_name=="MP3" || $ext_name=="WAV" || $ext_name=="AVI" || $ext_name=="WMV" || $ext_name=="WMA")) {

			return true;
		} else {
			return false;
		}
	}
}

//파일 업로드  
 function upload1($file_name, $file_tmp){ 
 	sleep(1);   
    $upload_dir="upfile/";
    $tmp = explode(".",$file_name);
    $file_ext = $tmp[1];   
    $file_name = date("Ymdhis",time());
	$file_name = $file_name.".".$file_ext;
    $result = move_uploaded_file($file_tmp,$upload_dir.$file_name);    
	return $file_name;
} 

//파일 업로드  
 function upload2($file_name, $file_tmp){ 
 	sleep(1);   
    $upload_dir="../upfile/";
    $tmp = explode(".",$file_name);
    $file_ext = $tmp[1];   
    $file_name = date("Ymdhis",time());
	$file_name = $file_name.".".$file_ext;
    $result = move_uploaded_file($file_tmp,$upload_dir.$file_name);    
	return $file_name;
} 

//회원등급 관리
	function grade_sort($str){
		switch($str){
			case "indi":
			$level = "일반회원";
			//return $level;
			break;
			
			case "company1":
			$level = "제휴회원";
			//return $level;
			break;
			
			case "company2":
			$level = "제휴팀장";
			return $level;
			break;
			
			case "premium1":
			$level = "프리미엄회원[대기]";
			//return $level;
			break;
			
			case "premium2":
			$level = "프리미엄회원[승인]";
			//return $level;
			break;
			
			case "premium3":
			$level = "프리미엄회원[종료]";
			//return $level;
			break;
			
			case "premium4":
			$level = "프리미엄회원[중지]";
			//return $level;
			break;
			
			case "admin":
			$level = "관리자";
			//return $level;
			break;

			case "admin2":
			$level = "관리자2";
			//return $level;
			break;

			case "superadmin":
			$level = "최고관리자";
			//return $level;
			break;
		}
		return $level;
	}
	
	#프리미엄 회원 기간 체크 함수
	function premium_check($id){
		global $connect;
		$query = "SELECT * FROM woojung_member WHERE userId = '$id'";
		$result = mysql_query($query, $connect);
		$row = mysql_fetch_array($result);
		
		$today = date("Y-m-d",time()+60*60*24);
		if($today == $row[mdate]){
			$que = "UPDATE woojung_member SET usort = 'premium3' WHERE userId = '$id'";
			@mysql_query($que, $connect);
		}
	}
	
	
	// 이 함수는 업로드된 이미지를 썸네일이미지로 따로 저장시키는 함수이다. 
	// http://www.zend.net에서 공개된 함수를
	// 수정 변경하여 만든 함수이다.
	// $image_file_path : 변경전 이미지가 저장되어 있는 경로
	// $new_image_file_path : 썸네일 이미지가 저장될 디렉토리 경로
	// $max_width : 변경할 이미지의 폭
	// $max_height : 변경할 이미지의 높이
	function Resize_Jpeg( $image_file_path, $new_image_file_path, $max_width, $max_height )
	{
		$return_val = 1;
		
		$return_val = ( ($img = ImageCreateFromJPEG ( $image_file_path )) && $return_val == 1 ) ? "1" : "0";
		
		$FullImage_width = imagesx ($img); // Original image width 
		$FullImage_height = imagesy ($img); // Original image height 
		
		$ratio = ( $FullImage_width > $max_width ) ? (real)($max_width / $FullImage_width) : 1 ;
		$new_width = ((int)($FullImage_width * $ratio)); //full-size width 
		$new_height = ((int)($FullImage_height * $ratio)); //full-size height 
		
		$ratio = ( $new_height > $max_height ) ? (real)($max_height / $new_height) : 1 ;
		$new_width = ((int)($new_width * $ratio)); //mid-size width 
		$new_height = ((int)($new_height * $ratio)); //mid-size height 
		
		if ( $new_width == $FullImage_width && $new_height == $FullImage_height )
		copy ( $image_file_path, $new_image_file_path );
		
		// 
		$full_id = ImageCreate( $new_width , $new_height );
		ImageCopyResized( $full_id, $img, 0,0, 0,0, $new_width, $new_height, $FullImage_width, $FullImage_height );
		$return_val = ( $full = ImageJPEG( $full_id, $new_image_file_path, 100 ) && $return_val == 1 ) ? "1" : "0";
		ImageDestroy( $full_id );
		// 
		
		return ($return_val) ? TRUE : FALSE ;
	} 
	function MakeNo($mode){
		global $connect;
		//msg("실행");
		#각 모드별로 구분 한다 p 폐차 b 매입 s 사이버 경매
		if($mode == 'p'){
			$tmp = "OutCarMember";
		}
		if($mode == 'b'){
			$tmp = "OutCarMember";
		}
		if($mode == 's'){
			$tmp = "OutCarMember";
		}
		#현재 등록되어 있는 테이블의 갯수를 구한다.
		$que = "SELECT COUNT(*) FROM $tmp WHERE 1";
		//echo $que;
		$res = mysql_query($que, $connect);
		$row = mysql_fetch_array($res);
		$cnt = $row[0];
		$day = date("Y-m-d");
		$tmp = explode("-", $day);
		$fi = substr($tmp[0],2,2);
		$Serial = $mode.$fi."-".$tmp[1].$tmp[2].$cnt;
		return $Serial;
	}

if(!function_exists('session_register')) {
	foreach($_SESSION as $sKey => $sVal) {
		if(!isset(${$sKey})) {
			${$sKey} = $sVal;
		}
	}

	function session_register($key) {
		$_SESSION[$key] = $GLOBALS[$key];
	}
}


?>
