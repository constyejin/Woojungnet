<?

$file_name="../images/board/".$files;
 if (0) {
            Header("Content-type:application/octet-stream"); 
            Header("Content-Length:".filesize($file_name));
            Header("Content-Disposition:attachment;filename=".$files);
            Header("Content-Transfer-Encoding:binary"); 
            Header("Pragma:no-cache"); 
            Header("Expires:0"); 
        } else {
            Header("Content-type:file/unknown"); 
            Header("Content-Length:".filesize($file_name));
            Header("Content-Disposition:attachment; filename=".$files);
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


	if($connect) {
		@mysql_close($connect);
		unset($connect);
	}
?>