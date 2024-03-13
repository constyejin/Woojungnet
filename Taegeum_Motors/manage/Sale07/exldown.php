<?
header( "Content-type: application/vnd.ms-excel; charset=utf-8" ); 
header( "Content-Disposition: attachment; filename=exldown.xls" ); 
header( "Content-Description: PHP4 Generated Data" );

ini_set('memory_limit',-1);
@session_start();
if($_SESSION["loginUsort"]!="superadmin"){
	exit;
}

function dbconn(){ 	
	$connect = mysql_connect("localhost","incaron","wjn6511!@#$") or die("에러 : 디비 연결 오류 입니다."); 
	mysql_select_db("incaron",$connect) or die("에러 : 데이터 베이스 선택 오류 입니다."); 
  return $connect; 
}

function dbclose(){
	mysql_close();
}

function Row_string($str){
	global $connect;
	//echo $str;
	$result = mysql_query($str, $connect);
	$row = mysql_fetch_assoc($result);
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
//한글 깨짐 방지 및 글자 수 자르기
function str_cut($text,$num){
	$subject = substr($text,0,$num);
	preg_match('/^([\x00-\x7e]|.{2})*/', $subject, $z); 
	$subject = $z[0];
	return $subject;
}
//회원등급 관리
function grade_sort($str){
	switch($str){
		case "indi":		$level = "일반회원";		break;
		case "company1":	$level = "제휴회원";		break;
		case "company2":	$level = "중고차 딜러";		break;
		case "premium1":	$level = "입찰대기";	break;
		case "premium2":	$level = "입찰승인";	break;
		case "premium3":	$level = "입찰종료";	break;
		case "premium4":	$level = "입찰중지";	break;
		case "jisajang":	$level = "프리미엄";			break;
		case "jisajang2":	$level = "추천회원";			break;
		case "admin":		$level = "관리자";			break;
		case "superadmin":	$level = "최고관리자";		break;
	}
	return $level;
}
function unixDateTime($var, $t)
{
	$unix = "";
	if($var){
		list($year, $month, $day) = explode("-", $var);
		if($t == "s"){
			$unix = mktime(0, 0, 0, $month, $day, $year);
		}else{
			$unix = mktime(23, 59, 59, $month, $day, $year);
		}
	}
	return $unix;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>incaron_admin</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<?
include_once ($_SERVER['DOCUMENT_ROOT']."/lib/code.php");
$connect = dbconn();

$tb_name = "woojung_member";

if($querya=="1"){
	$where="";
} else {
	$where=base64_decode($querya);
}

$qr="SELECT * FROM $tb_name WHERE $where ";

?>
<html>
<head>
<title><?=$HP_TITLE?></title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
</head>
<body>
<table cellpadding="0" border="0" cellspacing="0">
	<tr>
		<td>NO</td>
		<td>가입일</td>
		<td>이름</td>
		<td>닉네임</td>
		<td>아이디</td>
		<td>비밀번호</td>
		<td>지역</td>
		<td>업체명</td>
		<td>전화번호</td>
		<td>휴대전화</td>
		<td>등급일</td>
		<td>회원등급</td>
		<td>회원등급</td>
	</tr>
<?
		$arr = Fetch_string($qr);
		for($i=0;$i<count($arr);$i++){	
			$tmp = explode(" ",$arr[$i][company_addr1]);
			if( strpos($arr[$i][usort],'premium') !== false )  $pre_rdate = $arr[$i][pre_rdate];
			else $pre_rdate = $arr[$i][rdate];
			if($arr[$i][usort] == "premium2"){
				$nowUnix = null;
				$prerUnix = null;
				$premUnix = null;
				$nowUnix = unixDateTime(Date("Y-m-d"), "s");	// 지금 날짜
				$prerUnix = unixDateTime($arr[$i][pre_rdate], "s");		// 프리미엄 시작일
				$premUnix = unixDateTime($arr[$i][pre_mdate], "e");		// 프리미엄 종료일
				if($premUnix < $nowUnix){
					$usql = "update  $tb_name SET  usort = 'premium3' WHERE idx='".$arr[$i][idx]."' ";
					mysql_query($usql);		
					$arr[$i][usort] = "premium3";
				}	
			}
		
  ?>
          <tr>
            <td height="25"><?=$i+1?></td>
            <td><?=$arr[$i][rdate]?></td>
            <td><?=$arr[$i][name]?></td>
            <td><?=$arr[$i][userNick]?></td>
            <td><?=$arr[$i][userId]?></td>
            <td><?=$arr[$i][userPw]?></td>
            <td><?=$tmp[0]?></td>
            <td><?=$arr[$i][company_name]?></td>
            <td><?=$arr[$i][tel]?></td>
            <td><?=$arr[$i][pcs]?></td>
            <td><?=$pre_rdate?></td>
            <td><?=grade_sort($arr[$i][usort])?></td>
            <td><?=$arr_power[$arr[$i][power]]?></td>
          </tr>
          <!-- 반복되는 줄 끝 -->
          <? } ?>
</table>
</body>
</html>