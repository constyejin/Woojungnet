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
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>incaron_admin</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<?
include_once ($_SERVER['DOCUMENT_ROOT']."/lib/code.php");
$connect = dbconn();

$tb_name = "admin_log";

$qr="SELECT * FROM $tb_name WHERE 1 order by idx desc";
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
		<td>IP</td>
		<td>접속일자</td>
		<td>아이디</td>
		<td>이름</td>
	</tr>
<?
		$arr = Fetch_string($qr);
		for($i=0;$i<count($arr);$i++){	
  ?>
          <tr>
            <td height="25"><?=$i+1?></td>
            <td><?=$arr[$i][ip]?></td>
            <td><?=$arr[$i][regdate]?></td>
            <td><?=$arr[$i][userId]?></td>
            <td><?=$arr[$i][userName]?></td>
          </tr>
          <!-- 반복되는 줄 끝 -->
          <? } ?>
</table>
</body>
</html>