<?
	if($_GET['Mode'] == 'down'){
		$file_name=$_SERVER['DOCUMENT_ROOT']."/data/".$tmp_name;
				if (0) {
					Header("Content-type:application/octet-stream"); 
					Header("Content-Length:".filesize($file_name));
					Header("Content-Disposition:attachment;filename=".$nfiles[$num]);
					Header("Content-Transfer-Encoding:binary"); 
					Header("Pragma:no-cache"); 
					Header("Expires:0"); 
				} else {
					Header("Content-type:file/unknown"); 
					Header("Content-Length:".filesize($file_name));
					Header("Content-Disposition:attachment; filename=".$tmp_name);
					Header("Content-Description:PHP3 Generated Data"); 
					Header("Pragma: no-cache"); 
					Header("Expires: 0"); 
				}

				if (is_file($file_name)) { 
					$fp = fopen($file_name, "rb"); 
					if (!fpassthru($fp)) fclose($fp); 
					clearstatcache();
				} else { 
					echo "해당 파일이나 경로가 존재하지 않습니다."; 
		}
		exit;
	}

	include "$_SERVER[DOCUMENT_ROOT]/lib/common.php";
	$dir = $_SERVER['DOCUMENT_ROOT'];
	include $dir.'/lib/basicdb.class.php';
	include $dir.'/lib/scriptAlert.class.php';
	$script = new scriptAlert();
	$db		= new basicdb();
	$connect = dbconn();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>incaron_admin</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<?

	function thumbnail($file, $save_filename, $save_path, $max_width, $max_height)
	{
		// 전송받은 이미지 정보를 받는다
		$img_info = getImageSize($file);

		// 전송받은 이미지의 포맷값 얻기 (gif, jpg png)
		if($img_info[2] == 1) 
			$src_img = ImageCreateFromGif($file);
		else if($img_info[2] == 2)
			$src_img = ImageCreateFromJPEG($file);
		else if($img_info[2] == 3)
			$src_img = ImageCreateFromPNG($file);
		else
			return 0;

		// 전송받은 이미지의 실제 사이즈 값얻기
		$img_width = $img_info[0];
		$img_height = $img_info[1];

		if($img_width <= $max_width)
		{
			$max_width = $img_width;
			$max_height = $img_height;
		}

		if($img_width > $max_width)
			$max_height = ceil(($max_width / $img_width) * $img_height);

		// 새로운 트루타입 이미지를 생성
		$dst_img = imagecreatetruecolor($max_width, $max_height);

		// R255, G255, B255 값의 색상 인덱스를 만든다
		ImageColorAllocate($dst_img, 255, 255, 255);

		// 이미지를 비율별로 만든후 새로운 이미지 생성
		ImageCopyResampled($dst_img, $src_img, 0, 0, 0, 0, $max_width, $max_height, ImageSX($src_img),ImageSY($src_img));

		// 알맞는 포맷으로 저장
		if($img_info[2] == 1)
	 {
			ImageInterlace($dst_img);
			ImageGif($dst_img, $save_path.$save_filename);
		}
		else if($img_info[2] == 2)
	 {
			ImageInterlace($dst_img);
			ImageJPEG($dst_img, $save_path.$save_filename);
		}
	 else if($img_info[2] == 3)
	 {
			ImagePNG($dst_img, $save_path.$save_filename);
	 }

		// 임시 이미지 삭제
		ImageDestroy($dst_img);
		ImageDestroy($src_img);
		return true;
	}  

			function ftp_upload($files,$source_dir,$target_dir){ // files 에서 (,)로 구분 

				$ftp_host = "175.126.123.150"; 
				$ftp_user = "carway"; 
				$ftp_pass = "junggane6511"; 

				$result = 0; 

				$conn_id = ftp_connect($ftp_host); // FTP 서버 연결 
				$login_result = ftp_login($conn_id, $ftp_user, $ftp_pass); // 접속 
				ftp_pasv($conn_id, true);

				if(!$conn_id || !$login_result) return;  // 접속실패시 결과 반환 

				$dir = ftp_chdir($conn_id, $target_dir); // 해당 디렉토리로 이동 
				 
				$files = explode(',',$files); // 파일구분 
				 
				foreach($files as $file){ 

					$file = trim($file); 
					$d =  explode('/',$file); // 서브 디렉토리 
					 
					if(count($d)>1){ 
						 
						$dir_sub = ""; 

						for($i=0;$i<count($d)-1;$i++){ 

							if($dir_sub){ $dir_sub .= "/".$d[$i]; } 
							else{ $dir_sub = $d[$i]; } 

							@ftp_mkdir($conn_id, $dir_sub);  // 서브 디렉토리가 없을 경우 생성 
						}     
					} 

					$up = ftp_put($conn_id, $file, $source_dir."/".$file, FTP_BINARY); // 파일 전송 

					//echo "$up = $source_dir/$file -> $target_dir/$file<br>\n"; 

					if($up){ $result++; } 
				} 

				ftp_close($conn_id); //연결 끊기 

				return $result; 

			} 
			function ftp_upload2($files,$source_dir,$target_dir){ // files 에서 (,)로 구분 

				$ftp_host = "175.126.123.150"; 
				$ftp_user = "carway01"; 
				$ftp_pass = "junggane6511"; 

				$result = 0; 

				$conn_id = ftp_connect($ftp_host); // FTP 서버 연결 
				$login_result = ftp_login($conn_id, $ftp_user, $ftp_pass); // 접속 
				ftp_pasv($conn_id, true);

				if(!$conn_id || !$login_result) return;  // 접속실패시 결과 반환 

				$dir = ftp_chdir($conn_id, $target_dir); // 해당 디렉토리로 이동 
				 
				$files = explode(',',$files); // 파일구분 
				 
				foreach($files as $file){ 

					$file = trim($file); 
					$d =  explode('/',$file); // 서브 디렉토리 
					 
					if(count($d)>1){ 
						 
						$dir_sub = ""; 

						for($i=0;$i<count($d)-1;$i++){ 

							if($dir_sub){ $dir_sub .= "/".$d[$i]; } 
							else{ $dir_sub = $d[$i]; } 

							@ftp_mkdir($conn_id, $dir_sub);  // 서브 디렉토리가 없을 경우 생성 
						}     
					} 

					$up = ftp_put($conn_id, $file, $source_dir."/".$file, FTP_BINARY); // 파일 전송 

					//echo "$up = $source_dir/$file -> $target_dir/$file<br>\n"; 

					if($up){ $result++; } 
				} 

				ftp_close($conn_id); //연결 끊기 

				return $result; 

			} 



if(!$wc_idx){
	if($_GET['Mode'] == 'delete'){

		$arr_fname=explode("|:|" , $fname); 
		unlink($_SERVER['DOCUMENT_ROOT'].'/data/'.$arr_fname[$No]);
		unset($arr_fname[$No]);
		$fname=implode("|:|", $arr_fname); 

		$url="FileUpload3.php?fname=".$fname;
		$script->alertReplace("삭제 하였습니다",$url); 
		exit;
	}

	if($_GET['Mode'] == 'down'){
		$file_name=$_SERVER['DOCUMENT_ROOT']."/data/".$tmp_name;
				if (0) {
					Header("Content-type:application/octet-stream"); 
					Header("Content-Length:".filesize($file_name));
					Header("Content-Disposition:attachment;filename=".$nfiles[$num]);
					Header("Content-Transfer-Encoding:binary"); 
					Header("Pragma:no-cache"); 
					Header("Expires:0"); 
				} else {
					Header("Content-type:file/unknown"); 
					Header("Content-Length:".filesize($file_name));
					Header("Content-Disposition:attachment; filename=".$name);
					Header("Content-Description:PHP3 Generated Data"); 
					Header("Pragma: no-cache"); 
					Header("Expires: 0"); 
				}

				if (is_file($file_name)) { 
					$fp = fopen($file_name, "rb"); 
					if (!fpassthru($fp)) fclose($fp); 
					clearstatcache();
				} else { 
					echo "해당 파일이나 경로가 존재하지 않습니다."; 
		}
		exit;
	}
 
	
	if($fname){$kk=1;}else{$kk=0;}
	for ($i=0;$i<sizeof($upfile);$i++) {
		if($upfile[$i]&&in_array($i,$tmpfile)) {
			$file1 = $_FILES[upfile][tmp_name][$i];
			$file1_name = $_FILES[upfile][name][$i];
			$file1_size = $_FILES[upfile][size][$i];
			$file1_type = $_FILES[upfile][type][$i];

			$new_time=rand(10000000000,99999999999);
			$copyday=date("Ymd")."_".$new_time;
			$full_filename = explode(".", $file1_name);
			$extension = $full_filename[sizeof($full_filename)-1];
			$extension = strtolower($extension);
			$copyname = $copyday . $i . "." . $extension;
			$k=1;
			while (file_exists($_SERVER[DOCUMENT_ROOT]."/data/".$copyname)) {
				$copyname=$copyday."_".$k.".".$extension;
				$k++;
			}
			thumbnail($file1, $copyname, $_SERVER[DOCUMENT_ROOT]."/data/", 1280, 1000);

			if($kk){$fname=$fname."|:|".$copyname;}else{$fname=$copyname;}
	     	if($kk){$fnames=$fnames."<br>".$copyname;}else{$fnames=$copyname;}

			$kk++;$imgcnt++;
		}
	}
	//echo $fname."<br>";
	//echo $fnames;
	$url="FileUpload3.php?fname=".$fname;
	$script->alertReplace("등록 하였습니다",$url); 
}else{
	$row = Row_string("SELECT * FROM woojung_car WHERE wc_idx = '$wc_idx'");
	if($_GET['Mode'] == 'delete'){

		$sql_to = "update woojung_car set ";
		
		for($k=$No+1; $k<=100; $k++) {
			
			$s = $k+1;
			$imgName_to = 'wc_img_'.$k;
			if($k == 100){
				$sql_to.= $imgName_to." = '".$row[wc_img_.$s]."' ";		
			}else{
				$sql_to.= $imgName_to." = '".$row[wc_img_.$s]."',";		
			}
		}

		$sql_to.= "  where wc_idx='$wc_idx'";	
		
		
		$result_to = $db->query($sql_to);

		$url="FileUpload02.php?wc_idx=".$wc_idx;
		$script->alertReplace("삭제 하였습니다",$url); 
		exit;
	}

	if($_GET['Mode'] == 'down'){
		$file_name=$_SERVER['DOCUMENT_ROOT']."/data/".$tmp_name;
				if (0) {
					Header("Content-type:application/octet-stream"); 
					Header("Content-Length:".filesize($file_name));
					Header("Content-Disposition:attachment;filename=".$nfiles[$num]);
					Header("Content-Transfer-Encoding:binary"); 
					Header("Pragma:no-cache"); 
					Header("Expires:0"); 
				} else {
					Header("Content-type:file/unknown"); 
					Header("Content-Length:".filesize($file_name));
					Header("Content-Disposition:attachment; filename=".$name);
					Header("Content-Description:PHP3 Generated Data"); 
					Header("Pragma: no-cache"); 
					Header("Expires: 0"); 
				}

				if (is_file($file_name)) { 
					$fp = fopen($file_name, "rb"); 
					if (!fpassthru($fp)) fclose($fp); 
					clearstatcache();
				} else { 
					echo "해당 파일이나 경로가 존재하지 않습니다."; 
		}
		exit;
	}

	
	$kk=1;
	$sql = "update woojung_car set ";
	for ($i=0;$i<sizeof($upfile);$i++) {
		if($upfile[$i]&&in_array($i,$tmpfile)) {
			$file1 = $_FILES[upfile][tmp_name][$i];
			$file1_name = $_FILES[upfile][name][$i];
			$file1_size = $_FILES[upfile][size][$i];
			$file1_type = $_FILES[upfile][type][$i];

			$imgName = 'wc_img_'.($imgcnt+1);

			$new_time=rand(10000000000,99999999999);
			$copyday=date("Ymd")."_".$new_time;
			$full_filename = explode(".", $file1_name);
			$extension = $full_filename[sizeof($full_filename)-1];
			$extension = strtolower($extension);
			$copyname = $copyday . $i . "." . $extension;
			$k=1;
			while (file_exists($_SERVER[DOCUMENT_ROOT]."/data/".$copyname)) {
				$copyname=$copyday."_".$k.".".$extension;
				$k++;
			}
			thumbnail($file1, $copyname, $_SERVER[DOCUMENT_ROOT]."/data/", 1280, 1000);

			if($kk == 1){
				$sql.= $imgName." = '".$copyname."' ";	
			}else{
				$sql.= ", ". $imgName." =  '".$copyname."' ";	
			}


			$kk++;$imgcnt++;
		}
	}
	if($imgcnt>100){
		$url="FileUpload3.php?wc_idx=".$wc_idx;
		$script->alertReplace("사진은 100장까지 가능합니다.",$url); 
	}else{
		$sql.= "where wc_idx='$wc_idx'";	
		if($kk>1) $result = $db->query($sql);

		$url="FileUpload3.php?wc_idx=".$wc_idx;
		$script->alertReplace("등록 하였습니다",$url); 
	}
}
?>