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
	$mod_choice=sql_fetch("select * from option_choice where idx='$del_idx' ");
	$sale_car_trim=sql_list("select * from sale_car_trim where 1 ");
	for($i=0;$i<count($sale_car_trim);$i++){
		if($sale_car_trim[$i][trim_option3]) $trim_option3=explode("/",$sale_car_trim[$i][trim_option3]);
		if($sale_car_trim[$i][trim_option4]) $trim_option4=explode("/",$sale_car_trim[$i][trim_option4]);
		if(in_array($mod_choice[idx],$trim_option3)||in_array($mod_choice[idx],$trim_option4)){
			// 차량옵션에서 삭제
			$result_search = array_search ( $mod_choice[idx] , $trim_option3 );
			if($result_search){
				unset($trim_option3[$result_search]);
				$new_trim_option3=implode("/",$trim_option3);
			}else{
				$new_trim_option3=implode("/",$trim_option3);
			}

			// 특장옵션에서 삭제
			$result_search = array_search ( $mod_choice[idx] , $trim_option4 );
			if($result_search){
				unset($trim_option4[$result_search]);
				$new_trim_option4=implode("/",$trim_option4);
			}else{
				$new_trim_option4=implode("/",$trim_option4);
			}

			// 총가격에서 삭제옵션 가격 차감
			$new_trim_price=$sale_car_trim[$i][trim_price]-$mod_choice[ch_price];
			$query="update sale_car_trim set 
			trim_price='$new_trim_price', 
			trim_option3='$new_trim_option3', 
			trim_option4='$new_trim_option4' 
			where idx='".$sale_car_trim[$i][idx]."'  ";
			//echo $query."<br>";
			mysql_query($query);
		}
	}
	$query="update option_choice set del='Y' where idx=$del_idx ";
	mysql_query($query);
	parent_reload();
	exit;
}

$ch_price=str_replace(",","",$ch_price);

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
			$ch_file="ch_file='".$copyname."', ";
		}
	}

	$query="insert into option_choice set 
	ch_option='$ch_option', 
	$ch_file
	ch_type1='$ch_type1', 
	ch_type2='$ch_type2', 
	ch_name='$ch_name', 
	ch_price='$ch_price', 
	ch_explain='$ch_explain', 
	ch_regdate=now() 
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
			$ch_file="ch_file='".$copyname."', ";
		}
	}

	$query="update option_choice set 
	ch_option='$ch_option', 
	$ch_file
	ch_type1='$ch_type1', 
	ch_type2='$ch_type2', 
	ch_name='$ch_name', 
	ch_price='$ch_price', 
	ch_explain='$ch_explain' 
	where idx=$idx
	";
	mysql_query($query);

	alert_p("수정완료","sub04.php");
}
?>