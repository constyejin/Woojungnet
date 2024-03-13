<?
include "../inc/header.php";

if($del_idx){
	$query="delete from category where idx=$del_idx ";
	mysql_query($query);
	parent_reload();
	exit;
}

if($mod_idx){
	$query="update category set 
	cate_type1='$cate_type1', 
	cate_type2='$cate_type2', 
	cate_list='$cate_list'  
	where idx=$mod_idx ";
	mysql_query($query);
	alert_p("수정완료","sub01.php");
	exit;
}

if(!$idx){
	$category=sql_fetch("select * from category where cate_type1='$cate_type1' order by idx desc ");
	if($cate_type1=="화물차"){
		if(!$category[idx]){
			$cate_code="T01";
		}else{
			$cate_c1=(int)substr($category[cate_code],1,2);
			$cate_c1++;
			$cate_code="T".sprintf("%02d",$cate_c1);
		}
	}else if($cate_type1=="캠핑카"){
		if(!$category[idx]){
			$cate_code="C01";
		}else{
			$cate_c1=(int)substr($category[cate_code],1,2);
			$cate_c1++;
			$cate_code="C".sprintf("%02d",$cate_c1);
		}
	}
	$query="insert into category set 
	cate_code='$cate_code', 
	cate_type1='$cate_type1', 
	cate_type2='$cate_type2', 
	cate_list='$cate_list', 
	cate_regdate=now() 
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
		while (file_exists("../../images/category/".$copyname)) {
			$copyname=$copyday."_".$k.".".$extension;
			$k++;
		}
		if(!move_uploaded_file($file1,"../../images/category/".$copyname)){
			msg("파일업로드 오류");
		}else{
			$cate_file="cate_file='".$copyname."', ";
		}
	}

	$query="update category set 
	$cate_file
	cate_view='$cate_view', 
	cate_title1='$cate_title1', 
	cate_title2='$cate_title2', 
	cate_explain='$cate_explain' 
	where idx=$idx
	";
	mysql_query($query);

	msg("수정완료");
	parent_reload();
}
?>