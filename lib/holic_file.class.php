<?php
#############################################################################################################
#					파일 처리 클래수 ~~~~~~~~~~ 
#############################################################################################################
class holic_file {
	
	var $file_size = 1048576; // 기본값 1M
	var $file_ext  = array('xls','hwp','txt','zip','ppt','doc');	// 파일확장자;
	var $path	   = "uploadImg/";
	var $oldpath   = "tempImg/";
	var $thum_dir  = "uploadImg/thumImg/";   

	function holic_file($file_size="",$file_ext="",$path="",$oldpath="") {
		if($file_size)$this->file_size = $file_size;
		if($file_ext) $this->file_ext = $file_ext; 
		if($path)	  $this->path = $path;
		if($oldpath)  $this->oldpath = $oldpath;
	}

	function fileDelete($imgName) {
		$return = @unlink($this->path.$imgName);
	return $return;
	}

	function fileName($fileName) {
		$file_name = mktime().$_FILES[$fileName]['name'];
	return $file_name;
	}
	

	function file_chk($fileName) {
		if($_FILES[$fileName]['size'] > $this->file_size) $this->alert_h('업로드 파일용량 초과입니다!');
		$this->file_extChk($fileName);					
	
	}

	function file_extChk($fileName) {
		$ext_arr = explode('.',$_FILES[$fileName]['name']);
		$extNum  = count($ext_arr)-1;
		$extName = $ext_arr[$extNum];
		
		$chk=1;
		for($i=0; $i<count($this->file_ext); $i++) {
			if($extName == $this->file_ext[$i]) {
				$chk = 2;
				break;
			}
		}
		
		if($chk == 1)$this->alert_h('업로드불가 파일입니다!');
	}

	function alert_h($msg) {
			$val.= "<script> ";
			$val.= "alert('".$msg."');";
			$val.= "history.go(-1);";
			$val.= " </script>";
			echo $val;
			exit();
	}
 
	function fileUpload($fileName) {
		
		$file_name = $this->fileName($fileName);
		$this->file_chk($fileName);
		
		if(move_uploaded_file($_FILES[$fileName]['tmp_name'],$this->path.$file_name)) {
			@unlink($_FILES[$fileName]['tmp_name']);
		} else {
			@unlink($_FILES[$fileName]['tmp_name']);
			$this->alert_h('파일업로드에 실패하였습니다!/n 다시시도해주세요!');
		}
	
	return $file_name;
	}
	
	function fileMove($fileName) {
		if(copy($this->oldpath.$fileName,$this->path.$fileName)) {
			@unlink($this->oldpath.$fileName);
		} else {
			$this->alert_h('파일업로드에 실패하였습니다!/n 다시시도해주세요!');
		}
	}
}
?>

