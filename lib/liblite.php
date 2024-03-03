<?
if ($_lib) return;
$_lib=true;

# 파일 읽어오기
function rfile($filename) {
	if(!file_exists($filename)) return '';
	$f = fopen($filename,"r");
	$str = fread($f, filesize($filename));
	fclose($f);
	return $str;
}

# 문자열 끊기
function cut_str($msg,$cut_size,$dot=true) {
	if($cut_size<=0) return $msg;
	if ($dot) $odot="...";
	else $odot="";
	if(ereg("\[RE\]",$msg)) $cut_size=$cut_size+4;
	for($i=0;$i<$cut_size;$i++) if(ord($msg[$i])>127) $han++; else $eng++;
	$cut_size=$cut_size+(int)$han*0.6;
	$point=1;
	for ($i=0;$i<strlen($msg);$i++) {
		if ($point>$cut_size) return $pointtmp.$odot;
		if (ord($msg[$i])<=127) {
			$pointtmp.= $msg[$i];
			if ($point%$cut_size==0) return $pointtmp.$odot; 
		} else {
			if ($point%$cut_size==0) return $pointtmp.$odot;
			$pointtmp.=$msg[$i].$msg[++$i];
			$point++;
		}
		$point++;
	}
	return $pointtmp;
}

function show_time(){
	global $time_start;
	$time_end = getmicrotime(); // 실행 끝시각
    $time = $time_end - $time_start; //실행시간
	echo "<!-- 진행시간 : $time -->";
}

// 마이크로 타임 구함
	function getmicrotime() {
	$microtimestmp = split(" ",microtime());
	return $microtimestmp[0]+$microtimestmp[1];
	}
?>