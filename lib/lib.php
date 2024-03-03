<?
if ($_lib) return;
$_lib=true;

//include_once("$_SERVER[DOCUMENT_ROOT]/Admin/counter/_AceMTcounter.php");
$time_start = getmicrotime(); // 실행 시작시각

if (!$_session) {
	session_start();
	$_session=true;
}

include "$setup/var_setup.php";
/*
function movepage($url,$memo="",$nam="") {
	global $connect;

		$memo=eregi_replace("<br>","\\n",$memo);
		if ($url=="goback") { 
			echo "<script language='javascript'>";
			if ($memo) echo "alert('$memo');";
			echo "history.back();</script>";
		} elseif ($url=="close") {
			echo "<script language='javascript'>";
			if ($memo) echo "alert('$memo');";
			echo "window.close();</script>";
		} elseif ($url=="goback2") {
			echo "<script language='javascript'>";
			if ($memo) echo "alert('$memo');";
			echo "history.go(-2);</script>";
		} elseif ($url=="alert") {
		} elseif ($memo!="") echo "<script language='javascript'> alert('$memo'); </script>";

		if($connect) @mysql_close($connect);

		if ($nam=="top") echo "<script language='javascript'> top.location.href='$url';</script>";
		elseif ($url&&$url!="goback"&&$url!="goback2") echo"<meta http-equiv=\"refresh\" content=\"0; url=$url\">";
		
		if ($nam=="close") echo "<script language='javascript'> window.close();</script>";
		exit;
}
*/
# 유저정보 가져오기
if ($cookie_user_no) $member=mysql_fetch_array(mysql_query("select * from woojung_member where idx='$cookie_user_no'"));
# 관리자 / B2B 체크
if ($member[user_level]<=3&&$member[user_level]) $u_Admin=true;
elseif ($member[user_level]==6) $u_b2b=true;
elseif ($member[user_level]==5) {
	$u_b2b=true;
	$u_b2bp=true;
}

//관리자 레벨이 10보다 큼
//if (!$member[user_level]) $user_level=10;
//else $user_level=$member[user_level];

# 사진정보가져오기
function radioimg($filename,$x_size,$y_size){
$size=@getimagesize($filename);
$x1=$size[0];
$y1=$size[1];
if ($x1>$y1) { // x기준
	if ($x1<=$x_size){
		$x=$x1;
		$y=$y1;
	} else {
		$radio=$y1/$x1;
		$y=$radio*$y_size;
		$x=$x_size;
	}
} else { // y 기준
	if ($y1<=$y_size){ //원래크기보다 작으면
		$x=$x1;
		$y=$y1;	
	} else {
		$radio=$x1/$y1;
		$x=$radio*$x_size;
		$y=$y_size;
	}
}

$size[0]=$x;
$size[1]=$y;
return $size;
}

/*
function error($msg,$url="") {

	global $setup, $connect, $p_root;

	if ($url=="window.close") {
		$msg=str_replace("<br>","\\n",$msg);
		$msg=str_replace("\"","\\\"",$msg);
		echo "<script> alert('".$msg."');	window.close();	</script>";
	} else {
	echo "<script> alert('".$msg."'); history.back();</script>";
	}
	if ($connect) @mysql_close($connect);
	exit;
}
*/

function show_pic($filename,$widthx=80,$widthy=80,$directory="data/",$domain="",$fwidthx="",$fwidthy="",$tools=0){
	global $dir;
	$skin_s="<table border=0 cellpadding=0 cellspacing=0><tr><td><img src='/images/left_top.gif'></td><td height='6' bgcolor='E7E7E7'></td><td><img src='/images/left_top1.gif'></td></tr><tr><td bgcolor=E7E7E7></td><td>";
	$skin_e="</td><td bgcolor=E7E7E7></td></tr><tr><td width=6 height=6><img src='/images/left_top2.gif'></td><td height=6 bgcolor=E7E7E7></td><td width=6 height=6><img src='/images/left_top3.gif'></td></tr></table>";
	$files=$directory.$filename;
	$filename2="$dir/$files";
//	echo $filename2;
	$extt=explode(".",$filename);
	$ext=$extt[1];
	if (file_exists($filename2)&&$filename) {
		if (eregi($ext,"swf")){
		  $ret="<embed src=\"/$files\" quality=\"high\" pluginspage=\"http://www.macromedia.com/go/getflashplayer\" type=\"application/x-shockwave-flash\" width=\"$fwidthx\" height=\"$fwidthy\"></embed>";
		} else {
			if ($fwidthx){
				$sizes[0]=$fwidthx;
				$sizes[1]=$fwidthy;
			}else $sizes=radioimg($filename2,$widthx,$widthy);
		$ret="<img src='$domain/$files' width='$sizes[0]' height='$sizes[1]' galleryimg=no align=absmiddle>";
		}
	} else {
	$files=$directory."noimg.gif";
	$filename2="$dir/$files";	
	if ($fwidthx){
		$sizes[0]=$fwidthx;
		$sizes[1]=$fwidthy;
	}else $sizes=radioimg($filename2,$widthx,$widthy);
	$ret="<img src='$domain/$files' width='$sizes[0]' height='$sizes[1]' galleryimg=no align=absmiddle>";
	}
	
	if ($tools) {
		$ret=$skin_s.$ret.$skin_e;
	}

	return $ret;	
}


# 문자열 끊기
	function str_cut($text,$num){
		$subject =mb_substr($text,0,$num,'utf-8');
		if($subject!=$text) $subject.="..";
		return $subject;
	}


# 사용자 체크
function ck_user($user_level,$agree_level=9,$msg="무료회원 가입을 하시면 이용이 가능합니다."){
	if ($user_level&&$user_level<=$agree_level) {
		if ($msg) echo "<script language='javascript'>alert('$msg');</script>";
		return true;
	} else return false;

}

//번호설정
function list_number(){

global $page,$qcommon,$first_page,$nperblock,$direct_page,$block,$last_page,$tblock,$tpage;

// 첫번째 블록에 대한 링크
if($block > 1 && $tblock>2) {
   echo "<a href=\"$PHP_SELF?$qcommon&page=1\" onMouseOver=\"status='load previous $nperblock pages';return true;\" onMouseOut=\"status=''\"><font color='#976302'>◀처음|</font></a>&nbsp;&nbsp;&nbsp;";
} 


// 이전블록에 대한 링크
if($block > 1) {
	$imsi=$page;
   $page = $first_page;
   echo "<a href=\"$PHP_SELF?$qcommon&page=$page\" onMouseOver=\"status='load previous $nperblock pages';return true;\" onMouseOut=\"status=''\">[이전]</a>&nbsp;&nbsp;&nbsp;";
   $page=$imsi;
} 

// 페이지이동(블록내)

for($direct_page = $first_page+1; $direct_page <= $last_page; $direct_page++) {
   if($page == $direct_page) {
      echo "<FONT SIZE=3 COLOR=red>$direct_page</FONT>";
   } else {
      echo "<a href=\"$PHP_SELF?$qcommon&page=$direct_page\" onMouseOver=\"status='jump to page $direct_page';return true;\" onMouseOut=\"status=''\">[$direct_page]</a>";
   }
}
//$list_bottom=str_replace("[number]",$tmp_list_bottom,$list_bottom);


// 다음블록에 대한 링크

if($block < $tblock) {
   $page = $last_page+1;
   echo "&nbsp;&nbsp;&nbsp;<a href=\"$PHP_SELF?$qcommon&page=$page\" onMouseOver=\"status='load next $nperblock pages';return true;\" onMouseOut=\"status=''\">[다음]</a>";
} 

//마지막 블록에 대한 링크
if($block < $tblock && $tblock>2) {
$final_page=($tblock*10)-9;
 echo "&nbsp;&nbsp;&nbsp;<a href=\"$PHP_SELF?$qcommon&page=$final_page\" onMouseOver=\"status='load next $nperblock pages';return true;\" onMouseOut=\"status=''\"><font color='#976302'>|마지막▶</font></a>";
}

}

# 카타고리 읽어오기
function scate($cate,$dbname="js_category"){
	global $connect;
	$sql="select name from $dbname where no='$cate'";
	//$res=mysql_query($sql,$connect);
	$ret=mysql_fetch_array(mysql_query($sql,$connect));
	return $ret[0];
}

# 자동링크
function autolink($contents) {
       $pattern = "/(http|https|ftp|mms):\/\/[0-9a-z-]+(\.[_0-9a-z-]+)+(:[0-9]{2,4})?\/?";       // domain+port
       $pattern .= "([\.~_0-9a-z-]+\/?)*";                                                                                                                                                                                             // sub roots
       $pattern .= "(\S+\.[_0-9a-z]+)?"       ;                                                                                                                                                                                                    // file & extension string
       $pattern .= "(\?[_0-9a-z#%&=\-\+]+)*/i";                                                                                                                                                                               // parameters
       $replacement = "<a href=\"\\0\" target=\"_blank\">\\0</a>";
       return preg_replace($pattern, $replacement, $contents, -1);
}



function p_step($no,$no2=0){
	switch($no){
		case 1:
			$ret="<FONT COLOR=#CC0000>결제중</FONT>";
		     if ($no2) $ret="<FONT COLOR=#CC0000>공동구매</FONT>";
		break;
		case 2:
			$ret="<FONT COLOR=#0000FF>결제완료</FONT>";
		break;
		case 3:
			$ret="배송중";
		break;
		case 4:
			$ret="휴지통";
		break;
		case 5:
			$ret="반품";
		break;
		case 6:
			$ret="상품준비중";
		break;

		case 7:
			$ret="거래완료";
		break;
		default:
	}
	
		return $ret;
}

function tselect2($name,$arr,$str="",$type=true,$str2="선택",$size=""){
	if ($type){
		if ($size) $osize=";width:$size";
	$k="<select name=".$name." style=\"vertical-align:middle;font-size:9pt;$osize\">";
	}

    if (sizeof($arr)>1){} else $arr=explode(",",$arr);
	if ($str2){
	$k.="<option value=''>$str2</option>";
	}
	for ($i=0;$i<sizeof($arr);$i++)
	{
	$tmpi=$i+1;
	$k.="<option value='".$tmpi."'";
	if ($str==$tmpi) $k.=" selected";
	$k.=">".$arr[$i]."</option>";
	}
	if ($type){
	$k.="</select>";
	}

	return $k;
}

function chk_level($olevel) {
switch ($olevel) {
	case 1 :
		$ostate="관리자";
	break;
	case 3 :
		$ostate="관리자";
	break;
	case 5 : 
		$ostate="우대회원";
	break;
	case 6 : 
		$ostate="B2B";
	break;
/*	case 8 : //중고차
		$ostate="딜러회원";
	break;
*/
	default :
		$ostate="일반회원";
}
	return $ostate;
}

function checkuser($checknum=0,$sw=0,$msg=0){
	global $connect,$member,$u_Admin,$cookie_user_no;
	switch ($checknum) {
		case 0:
	$now=time();
	if (($member[b2step]=="2")||($u_Admin)) {
		return true;
	} else {
		if ($msg){
			if ($sw) echo "javascript:alert('B2B회원만 이용이 가능한 서비스입니다.');";
				else echo "<script language='javascript'>alert('B2B회원만 이용이 가능한 서비스입니다.');</sciprt>";
		}
		return false;
	}
			break;
		case 1:
			if ($cookie_user_no) return true;
			else {
		if ($msg){
			if ($sw) echo "javascript:alert('로그인이 필요한 서비스입니다.');";
				else echo "<script language='javascript'>alert('로그인이 필요한 서비스입니다.');</sciprt>";
				return false;
		}
			}
		break;

		case 2:
		if (!$cookie_user_no){
		 if ($msg){
			 if ($sw) echo "javascript:alert('로그인이 필요한 서비스입니다.');";
		 }
			return false;
		}

		if ($member[b2step]=="2") {
		 if ($msg){
			 if ($sw) echo "javascript:alert('현재 B2B회원이십니다.');";
		 }
			return false;
		}

		if ($member[b2step]=="1") {
		 if ($msg){
			 if ($sw) echo "javascript:alert('현재 신청대기중입니다.');";
		 }
			return false;
		}

		return true;
		break;
		
		case 3:
			if (!$cookie_user_no) return true;
			else {
		if ($msg){
			if ($sw) echo "javascript:alert('이미 회원가입을 하셨습니다.');";
				else echo "<script language='javascript'>alert('이미 회원가입을 하셨습니다.');</sciprt>";
				return false;
		}
			}
		break;
	}
}


function memo($str){
$str=del_html($str);
//$str=addslashes($str);
$str=str_replace("  ","&nbsp;&nbsp;",$str);
$str=str_replace("\t","&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;",$str);
return $str;
}

// 파일을 삭제하는 함수
function delfile($filename) {
	@chmod($filename,0777);
	$handle = @unlink($filename);
	if(@file_exists($filename)) {
		@chmod($filename,0775);
		$handle=@unlink($filename);
	}
	return $handle;
}

function rdir($path) { 
	$directory = dir($path); 
	while($entry = $directory->read()) { 
		if ($entry != "." && $entry != "..") { 
			if (Is_Dir($path."/".$entry)) { 
				zRmDir($path."/".$entry); 
			} else { 
				@UnLink ($path."/".$entry); 
			} 
		} 
	} 
	$directory->close(); 
	@RmDir($path); 
}

function movepage_old($url,$memo="",$nam="") {
	global $connect;

	$memo=preg_replace("/<br>/","\\n",$memo);
	if ($url=="goback") { 
		echo "<script language='javascript'>";
		if ($memo) echo "alert('$memo');";
		echo "history.back();</script>";
	} elseif ($url=="close") {
		echo "<script language='javascript'>";
		if ($memo) echo "alert('$memo');";
		echo "window.close();</script>";
	} elseif ($url=="goback2") {
		echo "<script language='javascript'>";
		if ($memo) echo "alert('$memo');";
		echo "history.go(-2);</script>";
	} elseif ($url=="alert") {
	} elseif ($memo!="") echo "<script language='javascript'> alert('$memo'); </script>";

	if($connect) @mysql_close($connect);

	if ($nam=="top") echo "<script language='javascript'> top.location.href='$url';</script>";
	elseif ($url&&$url!="goback"&&$url!="goback2") echo"<meta http-equiv=\"refresh\" content=\"0; url=$url\">";
	
	if ($nam=="close") echo "<script language='javascript'> window.close();</script>";
	exit;
}

function RequestLogin($ref,$outmessage="로그인이 필요한 서비스입니다."){
	global $dir,$cookie_user_no,$MLel;
	//include "$dir/login/login.php";
	exit;
}

function Upload_old($Pvars,$updir,$size,$ofile="",$nu=0,$size2=0) {
$copyday = time();
for($i = 0; $i <sizeof($Pvars[uploadfile]); $i++) {
	if($Pvars[uploadfile][$i][name]) {
	if($Pvars[uploadfile][$i][size] > 2000*1024) movepage_old("goback","2M 이상의 파일은 업로드할 수 없습니다.");
	}
}
for($i = 0; $i <sizeof($Pvars[uploadfile]); $i++) {
	if($Pvars[uploadfile][$i][name]) {
	$full_filename = explode(".", $Pvars[uploadfile][$i][name]);
	$extension = $full_filename[sizeof($full_filename)-1];
	$extension = strtolower($extension);
	$copyname[$i] = $copyday . $i . "." . $extension;
//		if($i==0) {
			if($extension != "jpg") movepage_old("","사진은 jpg파일만 업로드가 가능합니다.");
			$resizename = $copyday.$i;
			} else {
//				if(!(strcmp($extension,"jpg") ^ strcmp($extension,"gif"))) $this->popup_msg("이미지 업로드시 ".$extension." 은 업로드가 안됩니다.", 1, 1);
			}
//		}
	}

	for($i = 0; $i <sizeof($Pvars[uploadfile]); $i++) {
		
		if($copyname[$i]) {
		if($size2>0) {
		if(!move_uploaded_file($Pvars[uploadfile][$i][tmp_name], $updir."/tmp2/".$copyname[$i])) movepage_old("goback","파일 업로드에 실패하였습니다.1");
		$getsize=imgsize($updir."/tmp2/".$copyname[$i],$size2);
		$rsize=explode(",",$getsize);
		GDImageResize($updir."/tmp2/$copyname[$i]", $updir."/tmp/$copyname[$i]", $rsize[0], $rsize[1], "jpg");
		delfile($updir."/tmp2/$copyname[$i]");
		} else {
		if(!move_uploaded_file($Pvars[uploadfile][$i][tmp_name], $updir."/".$copyname[$i])) movepage_old("goback","파일 업로드에 실패하였습니다.2");
		}
		$getsize=imgsize($updir."/tmp/".$copyname[$i],$size);
		$rsize=explode(",",$getsize);
		GDImageResize($updir."/tmp/$copyname[$i]", $updir."/$copyname[$i]", $rsize[0], $rsize[1], "jpg");
		if (!$nu) delfile($updir."/tmp/$copyname[$i]");
		if ($ofile[$i]){
		delfile($updir."/$ofile[$i]");
		}
		if ($ofile[$i]&&$nu){
		delfile($updir."/tmp/$ofile[$i]");
		}
//		if($i==0) $this->CreateResizeImg($resizename, "s".$resizename, 96, "", $dir."/", "jpg");
		} else $copyname[$i]=$ofile[$i];
	}
	return $copyname;
}

function imgsize($filename,$width){
	$size=getimagesize($filename);
	if ($size[0]<$width) $x=$size[0];
	else $x=$width;
	$y=floor($size[1]*$x/$size[0]);

	$ret="$x,$y";
	return $ret;
}

function GDImageResize($src_file, $dst_file, $width = NULL, $height = NULL, $type = NULL, $quality = 75)
{
       global $IsTrueColor, $Extension;
       $im = GDImageLoad($src_file,$type);


       if( !$im ) return false;

       if( !$width ) $width = imagesx($im);
       if( !$height ) $height = imagesy($im);

       if( $IsTrueColor && $type != "gif" ) $im2 = imagecreatetruecolor($width, $height);
       else $im2 = imagecreate($width, $height);

       if( !$type ) $type = $Extension;

       imagecopyresampled($im2, $im, 0, 0, 0, 0, $width, $height, imagesx($im), imagesy($im));

       if( $type == "gif" ) {
              //imagegif($im2, $dst_file);
       }
       else if( $type == "jpg" || $type == "jpeg" ) {
              imagejpeg($im2, $dst_file, $quality);
       }
       else if( $type == "png" ) {
              imagepng($im2, $dst_file);
       }

       imagedestroy($im);
       imagedestroy($im2);

       return true;
}

function GDImageLoad($filename,$type)
{
       global $IsTrueColor, $Extension;

       if( !file_exists($filename) ) return false;

//       $image_type = exif_imagetype($filename);

 
	   if ($type=="jpg")
		{ $im = imagecreatefromjpeg($filename);
          $Extension = "jpg";
		} elseif ($type=="gif") {
		  $im = imagecreatefromgif($filename);
		  $Extension = "gif";
		} elseif ($type=="png") {
          $im = imagecreatefrompng($filename);
          $Extension = "png";
		}

       $IsTrueColor = @imageistruecolor($im);

       return $im;
}

function sstar($no){
	switch($no){
		case 1:
		$ret="☆";
		break;
		case 2:
		$ret="★";
		break;
		case 3:
		$ret="★☆";
		break;
		case 4:
		$ret="★★";
		break;
		case 5:
		$ret="★★☆";
		break;
		case 6:
		$ret="★★★";
		break;
		case 7:
		$ret="★★★☆";
		break;
		case 8:
		$ret="★★★★";
		break;
		case 9:
		$ret="★★★★☆";
		break;
		case 10:
		$ret="★★★★★";
		break;

	}

return $ret;
}



function strs($msg,$cut_size) {
//	if($cut_size<=0) return $msg;

	for($i=0;$i<$cut_size;$i++) if(ord($msg[$i])>127) $han++; else $eng++;
	$cut_size=$cut_size+(int)$han*0.6;
	$point=1;
	for ($i=0;$i<strlen($msg);$i++) {
		if ($point>$cut_size) {
		  if (ord($msg[$i])<=127) {
			  $pointtmp.="*";
		  }else {			  
			  $pointtmp.="*";			  
			  $point++;
			  $i++;
		  }

		}elseif (ord($msg[$i])<=127) {
			$pointtmp.= $msg[$i];
		} else {
			$pointtmp.=$msg[$i].$msg[++$i];
			$point++;
		}

		$point++;
	}
	return $pointtmp;
}

function board_info() {

	global $cookie_user_no,$connect,$board,$_board_info_inc,$id, $loginUsort, $MLel;	
	if ($_board_info_inc) return $member;
	$_board_info_inc=true;

	if ($id) {			
		$board = mysql_fetch_array(mysql_query("select * from js_admin_board where a_name='$id'", $connect));
	}
	
	
	$board[super_comp_level] = 2;
	$board[com_level] = 5;

	if($loginUsort == "admin" || $loginUsort == "superadmin"){
		$MLel = "20";
		if(!$board[a_write_Glevel]) $board[a_write_Glevel]=10;
	}

	//echo "<pre>";
	//print_r($board);
	//echo "</pre>";
	return $board;
}

// 마이크로 타임 구함
	function getmicrotime() {
	$microtimestmp = explode(" ",microtime());
	return $microtimestmp[0]+$microtimestmp[1];
	}


function show_time(){
	global $time_start;
	$time_end = getmicrotime(); // 실행 끝시각
    $time = $time_end - $time_start; //실행시간
	echo "<!-- 진행시간 : $time -->";
}

?>