<?
include $_SERVER['DOCUMENT_ROOT'].'/manage/inc/header.php';

if($imgfile){
	
	$tmpfile = $_FILES["imgfile"]["tmp_name"];
	$imgfile = $_FILES["imgfile"]["name"];
	$file_size = $_FILES["imgfile"]["size"];	

	if($file_size>$tmpfile) {
		if(!is_uploaded_file($tmpfile)) {
			movepage("goback","정상적인 방법으로 업로드 해주세요");
		}

		if($file_size>0) {

			$s_file_name1=$file1_name;

			$tmpfile=eregi_replace("\\\\","\\",$tmpfile);			

			$full_filename = explode(".", $imgfile);
			$ext = $full_filename[sizeof($full_filename)-1];
			$ext = strtolower($ext);
			$imgsfile = time().".".$ext;

			if(!move_uploaded_file($tmpfile,"$dir/mainimg/".$imgsfile)) {
				movepage("goback","파일업로드가 제대로 되지 않았습니다3");
			}

		} 
		else { 
			movepage("goback","파일업로드가 제대로 되지 않았습니다2"); 
		}
	}
	else {
		movepage("goback","파일업로드가 제대로 되지 않았습니다1"); 
	}

} 
if(!$idx){
	$sql = "insert into home_main set view='$view', list_num='$list_num', imgfile='$imgsfile', imgurl='$imgurl', type='2' ";
	mysql_query($sql)or die(mysql_error());

} else{
	if($fd=="Y"){
		$sql = "select imgfile from home_main where idx = ".$idx;
		$r = mysql_query($sql);
		$data = mysql_fetch_assoc($r);

		@unlink("$dir/data/submain/".$data["imgfile"]);

		$sql = "delete from home_main where idx = ".$idx;
		mysql_query($sql)or die(mysql_error());
	}else{
		if($imgsfile){
			$sql = "update home_main set view='$view', imgurl = '".$imgUrl."', imgfile = '".$imgsfile."', list_num = '".$list_num."' where idx= ".$idx;
			mysql_query($sql)or die(mysql_error());
		}else{
			$sql = "update home_main set view='$view', imgurl = '".$imgUrl."', list_num = '".$list_num."' where idx= ".$idx;
			mysql_query($sql)or die(mysql_error());
		}
	}
}
movepage("mobile_main.php?qcommon=".$qcommon);
?>
