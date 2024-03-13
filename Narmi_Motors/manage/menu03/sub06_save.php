<?
include "../inc/header.php";

if($del_idx){
	$query="delete from image_certificate where idx=$del_idx ";
	mysql_query($query);
	parent_reload();
	exit;
}

if(!$idx){
	if($_FILES[upfile][tmp_name]) {
		$file1 = $_FILES[upfile][tmp_name];
		$file1_name = $_FILES[upfile][name];
		$file1_size = $_FILES[upfile][size];
		$file1_type = $_FILES[upfile][type];
		$file1=eregi_replace("\\\\","\\",$file1);
		$s_file_name1=$file1_name;
		$s_file_name1=str_replace(" ","_",$s_file_name1);
		$s_file_name1=str_replace("-","_",$s_file_name1);
		$full_filename = explode(".", $s_file_name1);
		$extension = $full_filename[sizeof($full_filename)-1];
		$extension = strtolower($extension);
		$copyday=date("Ymd");
		$copyname = $copyday ."." . $extension;
		$k=1;
		while (file_exists("../../images/img/".$copyname)) {
			$copyname=$copyday."_".$k.".".$extension;
			$k++;
		}
		if(!move_uploaded_file($file1,"../../images/img/".$copyname)){
			msg("파일업로드 오류");
		}else{
			$cer_file="cer_file='".$copyname."', ";
		}
	}

	$query="insert into image_certificate set 
	$cer_file
	cer_list='$cer_list', 
	cer_title='$cer_title', 
	cer_regdate=now() 
	";
	mysql_query($query);

	msg("등록완료");
	parent_reload();
}else{
	if($_FILES[upfile][tmp_name]) {
		$file1 = $_FILES[upfile][tmp_name];
		$file1_name = $_FILES[upfile][name];
		$file1_size = $_FILES[upfile][size];
		$file1_type = $_FILES[upfile][type];
		$file1=eregi_replace("\\\\","\\",$file1);
		$s_file_name1=$file1_name;
		$s_file_name1=str_replace(" ","_",$s_file_name1);
		$s_file_name1=str_replace("-","_",$s_file_name1);
		$full_filename = explode(".", $s_file_name1);
		$extension = $full_filename[sizeof($full_filename)-1];
		$extension = strtolower($extension);
		$copyday=date("Ymd");
		$copyname = $copyday ."." . $extension;
		$k=1;
		while (file_exists("../../images/img/".$copyname)) {
			$copyname=$copyday."_".$k.".".$extension;
			$k++;
		}
		if(!move_uploaded_file($file1,"../../images/img/".$copyname)){
			msg("파일업로드 오류");
		}else{
			$cer_file="cer_file='".$copyname."', ";
		}
	}

	$query="update image_certificate set 
	$cer_file
	cer_list='$cer_list', 
	cer_title='$cer_title' 
	where idx=$idx
	";
	mysql_query($query);

	alert_p("수정완료","sub06.php");
}
?>