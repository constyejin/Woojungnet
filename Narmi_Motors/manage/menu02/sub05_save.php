<?
include "../inc/header.php";

if($smart=="Y"){
	$query="update web_config set web_smart='$web_smart' where idx=1 ";
	mysql_query($query);
	msg("등록완료");
	parent_reload();
	exit;
}

if($del_idx){
	$query="delete from option_part where idx=$del_idx ";
	mysql_query($query);
	parent_reload();
	exit;
}

$part_price=str_replace(",","",$part_price);
$part_price2=str_replace(",","",$part_price2);

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
			$part_file="part_file='".$copyname."', ";
		}
	}

	$query="insert into option_part set 
	part_list='$part_list', 
	$part_file
	part_name='$part_name', 
	part_price='$part_price', 
	part_price2='$part_price2', 
	part_regdate=now() 
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
			$part_file="part_file='".$copyname."', ";
		}
	}

	$query="update option_part set 
	part_list='$part_list', 
	$part_file
	part_name='$part_name', 
	part_price='$part_price', 
	part_price2='$part_price2' 
	where idx=$idx
	";
	mysql_query($query);

	alert_p("수정완료","sub05.php");
}
?>