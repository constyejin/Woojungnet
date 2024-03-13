<?
include "../inc/header.php";

if($del_idx){
	$query="update option_color set del='Y' where idx=$del_idx ";
	mysql_query($query);
	parent_reload();
	exit;
}

$basic_price=str_replace(",","",$basic_price);

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
		while (file_exists("../../images/opt/".$copyname)) {
			$copyname=$copyday."_".$k.".".$extension;
			$k++;
		}
		if(!move_uploaded_file($file1,"../../images/opt/".$copyname)){
			msg("파일업로드 오류");
		}else{
			$color_file="color_file='".$copyname."', ";
		}
	}

	$query="insert into option_color set 
	$color_file
	color_type='$color_type', 
	color_type1='$color_type1', 
	color_type2='$color_type2', 
	color_name='$color_name', 
	color_regdate=now() 
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
		while (file_exists("../../images/opt/".$copyname)) {
			$copyname=$copyday."_".$k.".".$extension;
			$k++;
		}
		if(!move_uploaded_file($file1,"../../images/opt/".$copyname)){
			msg("파일업로드 오류");
		}else{
			$color_file="color_file='".$copyname."', ";
		}
	}

	$query="update option_color set 
	$color_file
	color_type='$color_type', 
	color_type1='$color_type1', 
	color_type2='$color_type2', 
	color_name='$color_name' 
	where idx=$idx
	";
	mysql_query($query);

	alert_p("수정완료","sub02.php");
}
?>