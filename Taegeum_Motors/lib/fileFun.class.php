<?php

class fileFun {
	var $path;

	function fileFun($path) {
		$this->path = $_SERVER['DOCUMENT_ROOT'].'/'.$path.'/';
	}

	//다운로드 메소드 * $file은 반드시 배열이어야 한다
	function download($fileList) {
		if(!is_array($fileList))$this->alert('데이터는 반드시 배열형태이어야 합니다');
		
		$getfile = $this->path.$fileList['file'];
		if(!file_exists($getfile))$this->alert('파일이 존재하지 않습니다');
		else if(!is_readable($getfile))$this->alert('파일의 읽기권한이 없습니다');
		else { 
			$file_size = filesize($getfile);
			$fp = fopen($getfile,"r");
			$contents = fread($fp,$file_size);
			fclose($fp);
		
			$filename = str_replace(";", "%3B",$this->basename_fix($fileList['name']));
			$mtime = time();
			
			header('Last-Modified: '.date('r', $mtime));
			header("Content-Type: application/octet-stream\r\n");
			header("Content-Disposition: attachment; filename=\"".$filename."\"\r\n\r\n");
			header("Content-Length: ".$file_size."\r\n");
			header("Content-Transfer-Encoding: binary\r\n");
			echo $contents;
		}
	}	

	function alert($msg="",$url="") {
		if(!$msg)$msg = '잘못된 접근입니다';
		
		echo "<script>";
		echo "alert('".$msg."');";
		if($url)echo "location.replace('".$url."');";
		else echo "history.go(-1);";
		echo "</script>";
	return exit;
	}

	function basename_fix($filename) {
		return preg_replace('/^.+[\\\\\\/]/', '', $filename);
	}
}
?>