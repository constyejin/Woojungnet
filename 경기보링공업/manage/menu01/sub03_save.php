<?
include "../inc/header.php";

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
		while (file_exists("../../images/popup/".$copyname)) {
			$copyname=$copyday."_".$k.".".$extension;
			$k++;
		}
		if(!move_uploaded_file($file1,"../../images/popup/".$copyname)){
			msg("파일업로드 오류");
		}else{
			$pop_file=$copyname;
		}
	}

	$query="insert into popup set 
	pop_title='$pop_title', 
	pop_view='$pop_view', 
	pop_scroll='$pop_scroll', 
	pop_view_type='$pop_view_type', 
	pop_startday='$pop_startday', 
	pop_endday='$pop_endday', 
	pop_width='$pop_width', 
	pop_height='$pop_height', 
	pop_position='$pop_position', 
	pop_left='$pop_left', 
	pop_top='$pop_top', 
	pop_file='$pop_file', 
	pop_link='$pop_link', 
	pop_link_type='$pop_link_type', 
	pop_etc='$pop_etc', 
	pop_regdate=now() 
	";
	mysql_query($query);

	alert_p("등록완료","sub03.php");
}else{
	$popup=sql_fetch("select * from popup where idx=$idx ");
	if($pop_file_del=="Y"){
		$pop_file="pop_file='', ";
		unlink("../../images/popup/".$popup[pop_file]);
	}
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
		while (file_exists("../../images/popup/".$copyname)) {
			$copyname=$copyday."_".$k.".".$extension;
			$k++;
		}
		if(!move_uploaded_file($file1,"../../images/popup/".$copyname)){
			msg("파일업로드 오류");
		}else{
			$pop_file="pop_file='".$copyname."', ";
		}
	}

	$query="update popup set 
	pop_title='$pop_title', 
	pop_view='$pop_view', 
	pop_scroll='$pop_scroll', 
	pop_view_type='$pop_view_type', 
	pop_startday='$pop_startday', 
	pop_endday='$pop_endday', 
	pop_width='$pop_width', 
	pop_height='$pop_height', 
	pop_position='$pop_position', 
	pop_left='$pop_left', 
	pop_top='$pop_top',
	$pop_file
	pop_link='$pop_link', 
	pop_link_type='$pop_link_type', 
	pop_etc='$pop_etc' 
	where idx=$idx
	";
	mysql_query($query);

	alert_p("수정완료","sub03.php");
}
?>