<?
include "../inc/header.php";

if($del_idx){
	$query="delete from image_structure where idx=$del_idx ";
	mysql_query($query);
	parent_reload();
	exit;
}

if(!$idx){
	if($_FILES[upfile1][tmp_name]) {
		$file1 = $_FILES[upfile1][tmp_name];
		$file1_name = $_FILES[upfile1][name];
		$file1_size = $_FILES[upfile1][size];
		$file1_type = $_FILES[upfile1][type];
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
			$st_file1="st_file1='".$copyname."', ";
		}
	}
	if($_FILES[upfile2][tmp_name]) {
		$file1 = $_FILES[upfile2][tmp_name];
		$file1_name = $_FILES[upfile2][name];
		$file1_size = $_FILES[upfile2][size];
		$file1_type = $_FILES[upfile2][type];
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
			$st_file2="st_file2='".$copyname."', ";
		}
	}
	if($_FILES[upfile3][tmp_name]) {
		$file1 = $_FILES[upfile3][tmp_name];
		$file1_name = $_FILES[upfile3][name];
		$file1_size = $_FILES[upfile3][size];
		$file1_type = $_FILES[upfile3][type];
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
			$st_file3="st_file3='".$copyname."', ";
		}
	}

	$query="insert into image_structure set 
	$st_file1
	$st_file2
	$st_file3
	st_list='$st_list', 
	st_type1='$st_type1', 
	st_type2='$st_type2', 
	st_title='$st_title', 
	st_regdate=now() 
	";
	mysql_query($query);

	msg("등록완료");
	parent_reload();
}else{
	if($_FILES[upfile1][tmp_name]) {
		$file1 = $_FILES[upfile1][tmp_name];
		$file1_name = $_FILES[upfile1][name];
		$file1_size = $_FILES[upfile1][size];
		$file1_type = $_FILES[upfile1][type];
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
			$st_file1="st_file1='".$copyname."', ";
		}
	}
	if($_FILES[upfile2][tmp_name]) {
		$file1 = $_FILES[upfile2][tmp_name];
		$file1_name = $_FILES[upfile2][name];
		$file1_size = $_FILES[upfile2][size];
		$file1_type = $_FILES[upfile2][type];
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
			$st_file2="st_file2='".$copyname."', ";
		}
	}
	if($_FILES[upfile3][tmp_name]) {
		$file1 = $_FILES[upfile3][tmp_name];
		$file1_name = $_FILES[upfile3][name];
		$file1_size = $_FILES[upfile3][size];
		$file1_type = $_FILES[upfile3][type];
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
			$st_file3="st_file3='".$copyname."', ";
		}
	}

	$query="update image_structure set 
	$st_file1
	$st_file2
	$st_file3
	st_list='$st_list', 
	st_type1='$st_type1', 
	st_type2='$st_type2', 
	st_title='$st_title' 
	where idx=$idx
	";
	mysql_query($query);

	alert_p("수정완료","sub05.php");
}
?>