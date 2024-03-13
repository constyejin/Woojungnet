<?
	if($_db_inc) return;
		$_db_inc = true;

	# 디비연결
	//$f=@file("$dir/config/dbconn.txt") or die("DB설정을 읽어 올수 없습니다.");

	//for($i=1;$i<=4;$i++) $f[$i]=trim(str_replace("\n","",$f[$i]));

	//if(!$connect) $connect = @mysql_connect("$f[1]","$f[2]","$f[3]") or die(mysql_error());
	//@mysql_select_db("$f[4]", $connect) or die(mysql_error());
 
	if(!$connect) $connect = mysql_connect("localhost","wjn2403","q1w2e3r4") or die(mysql_error()); 
     @mysql_select_db("wjn2403",$connect) or die(mysql_error()); 


# drg2614에서 가져온 소스들 START by 전상현 #
/*
if (!$_session) {
	session_start();
	$_session=true;
}
*/

# 회원정보

/*
if (!$member) {
		$member=member_info();

	if ($member[user_level]<=3&&$member[user_level]) $u_admin=true;
	if (!$member[user_level]) $user_level=10;
	else $user_level=$member[user_level];

	if (!$MLel) $MLel=0;
	else $member[user_level]=6;
}

*/

$nowtime=time();
$myip=$REMOTE_ADDR;
/*
# 기본값	


#실시간 체크
$query = "delete from js_now where uptime<$nowtime-120";
mysql_query($query) or die(mysql_error());
$query = "replace into js_now set session_id='" . session_id() . "', ip='$myip', uptime=unix_timestamp()";
mysql_query($query);	
*/

############## 기본사용 함수 #################

function error($message, $url="") {
	global $connect, $dir, $PHP_SELF,$incName,$incName_ext,$incTitle;

	if($url=="window.close") {
	$message=str_replace("<br>","\\n",$message);
	$message=str_replace("\"","\\\"",$message);
	?>
	<script>
	alert("<?=$message?>");
	window.close();
	</script>
	<?
	} else {
//	$incName="errpage"; // inc_guide.php
//	$incName_ext="errpage_left"; // inc_guide_left.php
//	$incTitle=""; // sub이미지
	
	//include "$dir/inc/header.php";
	include "$dir/incCmd/error.php";
	include "$dir/inc/footer.php";
	}

	if($connect) @mysql_close($connect);
	exit;
}

function member_info() {

	

	global $cookie_user_no,$connect,$member,$_member_info_inc,$MLel, $loginId, $loginUsort;

	if ($_member_info_inc&&$cookie_user_no) return $member;
	$_member_info_inc=true;

	if ($loginId) {

		if ($MLel) {
			$member=mysql_fetch_array(mysql_query("select * from js_Mgroup where mno='$cookie_user_no'"));
			$member[user_name]=$member[MName];
			$member[user_pw]=$member[MPwd];
			$member[user_id]=$member[Mid];
			$member[seq_num]=$member[mno];

		} else{
			$member=mysql_fetch_array(mysql_query("select * from woojung_member where userId='$loginId'"));		
		}
	
	}

		



	if (!$member[user_level]) $member[user_level]=10;
	else $user_level=$member[user_level];
/*
case "indi":$level = "일반회원";
case "company1":$level = "제휴회원";
case "company2":$level = "제휴팀장";
case "premium1":$level = "입찰회원[대기]";
case "premium2":$level = "입찰회원[승인]";
case "premium3":$level = "입찰회원[종료]";
case "premium4":$level = "입찰회원[중지]";
case "admin":$level = "관리자";
case "superadmin":$level = "최고관리자";

<option value="10" [level10]>비회원</option>
<option value="9" [level9]>일반회원</option>
<option value="6" [level5]>제휴회원</option>
<option value="4" [level4]>입찰회원</option>
<option value="3" [level3]>제휴팀장</option>
<option value="2" [level1]>관리자</option>
<option value="1" [level0]>최고관리자</option>
*/

	if($loginUsort == "admin"){
		$member[user_level] = "2";		
	}elseif($loginUsort == "superadmin"){
		$member[user_level] = "1";	
	}elseif($loginUsort == "company1"){
		$member[user_level] = "6";	
	}elseif($loginUsort == "company2"){
		$member[user_level] = "3";	
	}elseif($loginUsort == "indi"){
		$member[user_level] = "9";
	}elseif($loginUsort == "premium1" || $loginUsort == "premium2" || $loginUsort == "premium3" || $loginUsort == "premium4"){
		$member[user_level] = "4";
	}else{
		$member[user_level] = "10";	
	}

	return $member;	
}



# drg2614에서 가져온 소스들 END by 전상현 #




function foot(){
	global $connect;
	if ($connect){
		mysql_close();
		$connect=NULL;
		unset($connect);
	}
}
?>
