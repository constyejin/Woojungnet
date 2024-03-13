<?
include "../inc/header.php";

if($del_idx){
	$query="delete from sale_est where idx=$del_idx ";
	mysql_query($query);
	parent_reload();
	exit;
}

if($out_idx){
	$query="insert into sale_out (car_type1,car_type2,car_name,car_price,car_explain,car_add,car_catalog1,car_catalog2,car_catalog3,car_file,car_color1,car_color2,car_check1,car_check2,car_img,car_basic,car_choice1,car_choice2,car_check3,car_check4) select car_type1,car_type2,car_name,car_price,car_explain,car_add,car_catalog1,car_catalog2,car_catalog3,car_file,car_color1,car_color2,car_check1,car_check2,car_img,car_basic,car_choice1,car_choice2,car_check3,car_check4 from sale_est where idx='$out_idx' ";
	mysql_query($query) or die(mysql_error()); 
	msg("등록되었습니다.");
	exit;
}

$car_price=0;
$mod_est=sql_fetch("select * from estimate where idx='$idx' ");
$mod_car=sql_fetch("select * from sale_est where idx='$mod_est[car_idx]' ");
$car_price+=$mod_car[car_price];
if($mod_car[car_type1]=="화물차"){ 
	for($i=0;$i<count($car_choice1);$i++){
		$mod_ch1=sql_fetch("select * from option_choice where idx='$car_choice1[$i]' ");
		$car_price+=$mod_ch1[ch_price];
	}
	for($i=0;$i<count($car_choice3);$i++){
		$mod_ch1=sql_fetch("select * from option_choice where idx='$car_choice3[$i]' ");
		$car_price+=$mod_ch1[ch_price];
	}
	$car_choice1=implode("/",$car_choice1);
	$car_choice2=implode("/",$car_choice3); 
	$car_basic=implode("/",$car_basic1);
}
if($mod_car[car_type1]=="캠핑카"){ 
	for($i=0;$i<count($car_choice1);$i++){
		$mod_ch1=sql_fetch("select * from option_choice where idx='$car_choice1[$i]' ");
		$car_price+=$mod_ch1[ch_price];
	}
	for($i=0;$i<count($car_choice3);$i++){
		$mod_ch1=sql_fetch("select * from option_choice where idx='$car_choice3[$i]' ");
		$car_price+=$mod_ch1[ch_price];
	}
	$car_choice1=implode("/",$car_choice2);
	$car_choice2=implode("/",$car_choice4); 
	$car_basic=implode("/",$car_basic2);
}

if(!$mod_car[idx]){
	if($_FILES[car_f][tmp_name]) {
		$file1 = $_FILES[car_f][tmp_name];
		$file1_name = $_FILES[car_f][name];
		$file1_size = $_FILES[car_f][size];
		$file1_type = $_FILES[car_f][type];
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
		while (file_exists("../../images/salecar/".$copyname)) {
			$copyname=$copyday."_".$k.".".$extension;
			$k++;
		}
		if(!move_uploaded_file($file1,"../../images/salecar/".$copyname)){
			msg("파일업로드 오류");
		}else{
			$car_file="car_file='".$copyname."', ";
		}
	}
	if($_FILES[car_catalog1][tmp_name]) {
		$file1 = $_FILES[car_catalog1][tmp_name];
		$file1_name = $_FILES[car_catalog1][name];
		$file1_size = $_FILES[car_catalog1][size];
		$file1_type = $_FILES[car_catalog1][type];
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
		while (file_exists("../../images/salecar/".$copyname)) {
			$copyname=$copyday."_".$k.".".$extension;
			$k++;
		}
		if(!move_uploaded_file($file1,"../../images/salecar/".$copyname)){
			msg("파일업로드 오류");
		}else{
			$car_catalog1="car_catalog1='".$copyname."', ";
		}
	}
	if($_FILES[car_catalog2][tmp_name]) {
		$file1 = $_FILES[car_catalog2][tmp_name];
		$file1_name = $_FILES[car_catalog2][name];
		$file1_size = $_FILES[car_catalog2][size];
		$file1_type = $_FILES[car_catalog2][type];
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
		while (file_exists("../../images/salecar/".$copyname)) {
			$copyname=$copyday."_".$k.".".$extension;
			$k++;
		}
		if(!move_uploaded_file($file1,"../../images/salecar/".$copyname)){
			msg("파일업로드 오류");
		}else{
			$car_catalog2="car_catalog2='".$copyname."', ";
		}
	}
	if($_FILES[car_catalog3][tmp_name]) {
		$file1 = $_FILES[car_catalog3][tmp_name];
		$file1_name = $_FILES[car_catalog3][name];
		$file1_size = $_FILES[car_catalog3][size];
		$file1_type = $_FILES[car_catalog3][type];
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
		while (file_exists("../../images/salecar/".$copyname)) {
			$copyname=$copyday."_".$k.".".$extension;
			$k++;
		}
		if(!move_uploaded_file($file1,"../../images/salecar/".$copyname)){
			msg("파일업로드 오류");
		}else{
			$car_catalog3="car_catalog3='".$copyname."', ";
		}
	}
	$kk=1;
	for ($i=0;$i<sizeof($_FILES[upfile][name]);$i++) {
		$mydir1="../../data/".date("Ymd");
		if(!is_dir($mydir1)){
			@mkdir($mydir1,0777);
			@chmod($mydir1, 0777);
		}
		if($_FILES[upfile][name][$i]&&in_array($i,$tmpfile)) {
			$file1 = $_FILES[upfile][tmp_name][$i];
			$file1_name = $_FILES[upfile][name][$i];
			$file1_size = $_FILES[upfile][size][$i];
			$file1_type = $_FILES[upfile][type][$i];

			$copyday=date("Ymd");
			$full_filename = explode(".", $file1_name);
			$extension = $full_filename[sizeof($full_filename)-1];
			$extension = strtolower($extension);
			$copyname = $copyday . "." . $extension;
			$k=1;
			while (file_exists($mydir1."/".$copyname)) {
				$copyname=$copyday."_".$k.".".$extension;
				$k++;
			}
			thumbnail($file1, $copyname, $mydir1."/", 1000, 1000);

			if($kk == 1){
				$sql.= $copyday."/".$copyname;	
			}else{
				$sql.= "|:|". $copyday."/".$copyname;	
			}
			$kk++;$imgcnt++;
		}
	}
	if($imgcnt>0) $car_img="car_img='".$sql."', ";

	$query="insert into sale_est set 
	car_state='3', 
	$car_file
	$car_catalog1
	$car_catalog2
	$car_catalog3
	$car_img
	car_type1='$car_type1', 
	car_type2='$car_type2', 
	car_name='$car_name', 
	car_price='$car_price', 
	car_explain='$car_explain', 
	car_add='$car_add', 
	car_catalog1='$car_catalog1', 
	car_catalog2='$car_catalog2', 
	car_catalog3='$car_catalog3', 
	car_color1='$car_color1', 
	car_color2='$car_color2', 
	car_basic='$car_basic', 
	car_choice1='$car_choice1', 
	car_choice2='$car_choice2', 
	car_regdate=now() 
	";
//	echo $query;
	mysql_query($query) or die(mysql_error()); 
	$insert_car=sql_fetch("select * from sale_est where 1=1 order by idx desc ");
	$query="update estimate set car_idx='$insert_car[idx]' where idx=$idx ";
	mysql_query($query) or die(mysql_error()); 

	alert_p("등록완료","sub02.php");
}else{
	if($mod_car[car_img]) $mod_car_img=explode("|:|" , $mod_car[car_img]);

	if($_FILES[car_f][tmp_name]) {
		$file1 = $_FILES[car_f][tmp_name];
		$file1_name = $_FILES[car_f][name];
		$file1_size = $_FILES[car_f][size];
		$file1_type = $_FILES[car_f][type];
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
		while (file_exists("../../images/salecar/".$copyname)) {
			$copyname=$copyday."_".$k.".".$extension;
			$k++;
		}
		if(!move_uploaded_file($file1,"../../images/salecar/".$copyname)){
			msg("파일업로드 오류");
		}else{
			$car_file="car_file='".$copyname."', ";
		}
	}
	if($_FILES[car_catalog1][tmp_name]) {
		$file1 = $_FILES[car_catalog1][tmp_name];
		$file1_name = $_FILES[car_catalog1][name];
		$file1_size = $_FILES[car_catalog1][size];
		$file1_type = $_FILES[car_catalog1][type];
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
		while (file_exists("../../images/salecar/".$copyname)) {
			$copyname=$copyday."_".$k.".".$extension;
			$k++;
		}
		if(!move_uploaded_file($file1,"../../images/salecar/".$copyname)){
			msg("파일업로드 오류");
		}else{
			$car_catalog1="car_catalog1='".$copyname."', ";
		}
	}
	if($_FILES[car_catalog2][tmp_name]) {
		$file1 = $_FILES[car_catalog2][tmp_name];
		$file1_name = $_FILES[car_catalog2][name];
		$file1_size = $_FILES[car_catalog2][size];
		$file1_type = $_FILES[car_catalog2][type];
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
		while (file_exists("../../images/salecar/".$copyname)) {
			$copyname=$copyday."_".$k.".".$extension;
			$k++;
		}
		if(!move_uploaded_file($file1,"../../images/salecar/".$copyname)){
			msg("파일업로드 오류");
		}else{
			$car_catalog2="car_catalog2='".$copyname."', ";
		}
	}
	if($_FILES[car_catalog3][tmp_name]) {
		$file1 = $_FILES[car_catalog3][tmp_name];
		$file1_name = $_FILES[car_catalog3][name];
		$file1_size = $_FILES[car_catalog3][size];
		$file1_type = $_FILES[car_catalog3][type];
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
		while (file_exists("../../images/salecar/".$copyname)) {
			$copyname=$copyday."_".$k.".".$extension;
			$k++;
		}
		if(!move_uploaded_file($file1,"../../images/salecar/".$copyname)){
			msg("파일업로드 오류");
		}else{
			$car_catalog3="car_catalog3='".$copyname."', ";
		}
	}

	for ($i=0;$i<sizeof($check_img);$i++) {
		unset($mod_car_img[$check_img[$i]]);
	}
	$sql=implode("|:|", $mod_car_img);

	$kk=1;$imgcnt=count($mod_car_img);
	for ($i=0;$i<sizeof($_FILES[upfile][name]);$i++) {
		$mydir1="../../data/".date("Ymd");
		if(!is_dir($mydir1)){
			@mkdir($mydir1,0777);
			@chmod($mydir1, 0777);
		}
		if($_FILES[upfile][name][$i]&&in_array($i,$tmpfile)) {
			$file1 = $_FILES[upfile][tmp_name][$i];
			$file1_name = $_FILES[upfile][name][$i];
			$file1_size = $_FILES[upfile][size][$i];
			$file1_type = $_FILES[upfile][type][$i];

			$copyday=date("Ymd");
			$full_filename = explode(".", $file1_name);
			$extension = $full_filename[sizeof($full_filename)-1];
			$extension = strtolower($extension);
			$copyname = $copyday . "." . $extension;
			$k=1;
			while (file_exists($mydir1."/".$copyname)) {
				$copyname=$copyday."_".$k.".".$extension;
				$k++;
			}
			thumbnail($file1, $copyname, $mydir1."/", 1000, 1000);
			if($imgcnt<10){
				if($imgcnt == 0){
					$sql.= $copyday."/".$copyname;	
				}else{
					$sql.= "|:|". $copyday."/".$copyname;	
				}
				$kk++;$imgcnt++;
			}
		}
	}
	if($imgcnt>0) $car_img="car_img='".$sql."', ";

	$query="update sale_est set 
	car_choice1='$car_choice1', 
	car_choice2='$car_choice2' 
	where idx=$mod_car[idx]
	";
	mysql_query($query);
	$query="update estimate set est_price='$car_price' where idx=$idx ";
	mysql_query($query);

	alert_p("수정완료","sub02.php");
}
?>