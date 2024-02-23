<?
include "../inc/Func.php";
$connect = dbconn();	

if(!$user_level && (!$loginId || $loginUsort=="indi" || $loginUsort=="company1" || $loginUsort=="company2" || $loginUsort=="premium1") ){
	echo "<script>alert('사용 권한이 없습니다.');history.back();</script>";
}

$idx = $_GET[idx];

$info = Row_string("SELECT * FROM woojung_car WHERE wc_idx = '$idx'");

/**
* NFUpload - 플래시 기반의 업로드 프로그래스바가 지원되는 멀티업로드 프로그램
*
* 라이센스 : 프리웨어 (개인/회사 구분없이 무료로 사용가능)
* 제작사 : 패스코리아넷 (http://passkorea.net/)
*
* 배포시 주의사항 : 제작사와 라이센스 정보를 삭제하시면 안됩니다.
*/


require_once('nfupload_conf.inc.php');		// NFUpload Config


// 파일명 보안 조치
function basename_fix($filename)
{
	return preg_replace('/^.+[\\\\\\/]/', '', $filename);
}	// function()


$i=$_GET[num];

	$fileName = $info["wc_img_".$i];
	$real_name = explode('/', $fileName);	

	if(strlen($real_name[0]) != 0){

$_GET['tmp_name']=$real_name[0];
$_GET['name']=$real_name[1];

$_GET['tmp_name'] = basename_fix(stripslashes($_GET['tmp_name']));
$_GET['name'] = basename_fix(stripslashes($_GET['name']));



// 파일 존재여부, 읽기 가능한지 검사
$file = $__NFUpload['dir'].DIRECTORY_SEPARATOR.$_GET['tmp_name'];
if (!file_exists($file))
{
	?>
		<script type="text/javascript">
			<!--
				alert("서버에 파일이 존재하지 않습니다.");
		   //-->
		</script>
	<?
} else if (!is_readable($file))
{
	?>
		<script type="text/javascript">
			<!--
				alert("서버에서 파일의 읽기권한이 없습니다.");
		   //-->
		</script>
	<?
} else 
{
	$file_size = filesize($file);
	$fp = fopen($file,"r");
	$contents = fread($fp,$file_size);
	fclose($fp);

	if (!function_exists('mime_content_type_simple')) {
	   function mime_content_type_simple($filename) {
		   $idx = strtolower(end( explode( '.', $filename )) );
		   $mimet = array(    
			   'ai' =>'application/postscript',
			   'aif' =>'audio/x-aiff',
			   'aifc' =>'audio/x-aiff',
			   'xyz' =>'chemical/x-xyz',
			   'zip' =>'application/zip',
			   'xls' =>'application/vnd.ms-excel',
			   'ppt' =>'application/mspowerpoint',
			   'doc' =>'application/msword',
			   'htm' =>'text/html',
			   'html' =>'text/html',
			   'eml' =>'message/rfc822',
			   'txt' =>'text/plain',
			   'pdf' =>'application/pdf',
			   'jpg' =>'image/jpeg',
			   'gif' =>'image/gif',
			   'png' =>'image/png',
			   'dwg' =>'application/acad',
			   'dxf' =>'application/dxf'
		   );

		   if (isset( $mimet[$idx] )) {
			   return $mimet[$idx];
		   } else {
			   return 'application/octet-stream';
		   }
	   }
	}
	$c_type = mime_content_type_simple($_GET['name']);

	if (strstr($_SERVER['HTTP_USER_AGENT'],"MSIE") && strtolower($__NFUpload['charset']) == 'utf-8')
	{
		$_GET['name'] = iconv('utf-8//IGNORE', 'cp949', $_GET['name']);
	} else if (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== false)
	{
		$_GET['name'] = str_replace(";", "%3B", $_GET['name']);
	}	// if()	

	$mtime = filemtime($file);
	if (!$mtime)
		$mtime = time();
	header('Last-Modified: '.date('r', $mtime));

	if ( strstr($_SERVER['HTTP_USER_AGENT'],"MSIE 5.5"))
	{
		header("Content-Type: doesn/matter\r\n");
		header("Content-Disposition: filename=\"".$_GET['name']."\"\r\n\r\n");
		header("Content-Length: ".$file_size."\r\n");
		header("Content-Transfer-Encoding: binary\r\n");
	}else
	{
		header("Content-Type: $c_type\r\n");
		header("Content-Disposition: attachment; filename=\"".$_GET['name']."\"\r\n\r\n");
		header("Content-Length: ".$file_size."\r\n");
		header("Content-Transfer-Encoding: binary\r\n");
	}	// if()

	echo $contents;

}	// if()



	}
?>