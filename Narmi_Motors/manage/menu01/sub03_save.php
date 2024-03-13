<?
include "../inc/header.php";

if($del_idx){
	$query="delete from sale_out where idx=$del_idx ";
	mysql_query($query);
	parent_reload();
	exit;
}

if($img_ad=="Y"){
	$mod_car=sql_fetch("select * from sale_out where idx='$idx' ");
	if($mod_car[car_img]) $mod_car_img=explode("|:|" , $mod_car[car_img]);
	for ($i=0;$i<sizeof($check_img);$i++) {
		unset($mod_car_img[$check_img[$i]]);
	}
	$sql=implode("|:|", $mod_car_img);
	$query="update sale_out set car_img='$sql' where idx=$idx ";
	mysql_query($query);
	exit;
}

if(!$car_type1){ msg("대구분을 선택해 주세요.");exit; }
if(!$car_type2){ msg("소구분을 선택해 주세요.");exit; }
if(!$car_name){ msg("차량명을 선택해 주세요.");exit; }
if(!$select_trim){ msg("트림을 선택해 주세요.");exit; }

$car_price=str_replace(",","",$car_price);
if($car_type1=="화물차"){ 
	$car_choice1=implode("/",$car_choice1);$car_choice2=implode("/",$car_choice3); 
	$car_basic=implode("/",$car_basic1);
	$car_color=implode("/",$car_color);
	$car_color1=implode("/",$car_color1);
	$car_color2=implode("/",$car_color2);
	$car_color3=implode("/",$car_color3);
	$car_check1=implode("/",$car_check1);
	$car_check2=implode("/",$car_check3);
	$car_check3=implode("/",$car_check5);
	$car_check4=implode("/",$car_check7);
	$trim_list1=implode("/",$car_list1);
	$trim_list2=implode("/",$car_list3);
}
if($car_type1=="캠핑카"){ 
	$car_choice1=implode("/",$car_choice2);$car_choice2=implode("/",$car_choice4); 
	$car_basic=implode("/",$car_basic2);
	if(!$idx){
	$car_color=implode("/",$car_color_1);
	$car_color1=implode("/",$car_color1_1);
	$car_color2=implode("/",$car_color2_1);
	$car_color3=implode("/",$car_color3_1);
	}else{
	$car_color=implode("/",$car_color);
	$car_color1=implode("/",$car_color1);
	$car_color2=implode("/",$car_color2);
	$car_color3=implode("/",$car_color3);
	}
	$car_check1=implode("/",$car_check2);
	$car_check2=implode("/",$car_check4);
	$car_check3=implode("/",$car_check6);
	$car_check4=implode("/",$car_check8);
	$trim_list1=implode("/",$car_list1);
	$trim_list2=implode("/",$car_list3);
}

if(!$idx){
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
		$copyday=$full_filename[0];
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
		$copyday=$full_filename[0];
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
		$copyday=$full_filename[0];
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

	$query="insert into sale_out set 
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
	car_color='$car_color', 
	car_color1='$car_color1', 
	car_color2='$car_color2', 
	car_color3='$car_color3', 
	car_check1='$car_check1', 
	car_check2='$car_check2', 
	car_basic='$car_basic', 
	car_choice1='$car_choice1', 
	car_choice2='$car_choice2', 
	car_check3='$car_check3', 
	car_check4='$car_check4', 
	car_view='$car_view',
	car_list='$car_list', 
	car_regdate=now() 
	";
	mysql_query($query) or die(mysql_error()); 
	$mod_car=sql_fetch("select * from sale_out where 1 order by car_regdate desc ");

	$car_trim1=explode("/" , $car_choice1);  // 차량옵션 체크박스
	$car_trim2=explode("/" , $car_choice2);  // 특장옵션 체크박스
	$car_trim3=explode("/" , $car_check3);   // 차량옵션 이미지박스
	$car_trim4=explode("/" , $car_check4);   // 특장옵션 이미지박스


	if($mod_car[car_type1]=="화물차"){
		$option_choice1=sql_list("select * from option_choice where ch_option='1' and ch_type1='Y' and del='N' order by idx desc ");
		$option_choice3=sql_list("select * from option_choice where ch_option='2' and ch_type1='Y' and del='N' order by idx desc ");
	}
	if($mod_car[car_type1]=="캠핑카"){
		$option_choice1=sql_list("select * from option_choice where ch_option='1' and ch_type2='Y' and del='N' order by idx desc ");
		$option_choice3=sql_list("select * from option_choice where ch_option='2' and ch_type2='Y' and del='N' order by idx desc ");
	}

	for($i=0;$i<count($option_choice1);$i++){
		if($i==0){
			$new_trim_list1=$option_choice1[$i][idx]."|".$car_list1[$i];
		}else{
			$new_trim_list1.="/".$option_choice1[$i][idx]."|".$car_list1[$i];
		}
	}
	for($i=0;$i<count($option_choice3);$i++){
		if($i==0){
			$new_trim_list2=$option_choice3[$i][idx]."|".$car_list3[$i];
		}else{
			$new_trim_list2.="/".$option_choice3[$i][idx]."|".$car_list3[$i];
		}
	}



	$mod_trim=sql_fetch("select * from sale_out_trim where car_idx='$mod_car[idx]' and trim_idx='".$select_trim."' ");
	$option_trim_list=sql_fetch("select * from sale_out_trim where idx='$select_trim'  ");
	$option_basic=sql_fetch("select * from option_basic where idx='$select_trim'  ");
	if(!$mod_trim[idx])	{
		$query="insert into sale_out_trim set
		car_idx='$mod_car[idx]', 
		trim_idx='".$select_trim."', 
		trim_list1='$new_trim_list1', 
		trim_list2='$new_trim_list2', 
		trim_list3='$trim_list3', 
		trim_list4='$trim_list4', 
		trim_option1='$car_choice1', 
		trim_option2='$car_choice2', 
		trim_option3='$car_check3', 
		trim_option4='$car_check4', 
		trim_price='$trim_price', 
		trim_basic_price='$car_price', 
		trim_explain='$car_add', 
		trim_list='".$option_basic[basic_list]."'
		";
		mysql_query($query) or die(mysql_error());
		$mod_trim=sql_fetch("select * from sale_out_trim where car_idx='$mod_car[idx]' and trim_idx='".$select_trim."' ");
	}else{
		$query="update sale_out_trim set
		trim_list1='$new_trim_list1', 
		trim_list2='$new_trim_list2', 
		trim_list3='$trim_list3', 
		trim_list4='$trim_list4', 
		trim_option1='$car_choice1', 
		trim_option2='$car_choice2', 
		trim_option3='$car_check3', 
		trim_option4='$car_check4', 
		trim_price='$trim_price', 
		trim_basic_price='$car_price', 
		trim_explain='$car_add', 
		trim_list='".$option_basic[basic_list]."'
		where 
		car_idx='$idx' and 
		trim_idx='".$select_trim."' 
		";
		mysql_query($query) or die(mysql_error());
	}
	
//	alert_p("등록완료","sub03_write.php?car_type1=$car_type1&car_type2=$car_type2&car_name=$car_name");
	alert_p("등록완료","sub03_view.php?idx=$mod_car[idx]&trim_idx=$mod_trim[idx]");
}else{
	$mod_car=sql_fetch("select * from sale_out where idx='$idx' ");
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
		$copyday=$full_filename[0];
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
		$copyday=$full_filename[0];
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
		$copyday=$full_filename[0];
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
	$sql=$mod_car[car_img];

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

	$query="update sale_out set 
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
	car_color='$car_color', 
	car_color1='$car_color1', 
	car_color2='$car_color2',
	car_color3='$car_color3', 
	car_check1='$car_check1', 
	car_check2='$car_check2', 
	car_basic='$car_basic', 
	car_choice1='$car_choice1', 
	car_choice2='$car_choice2', 
	car_check3='$car_check3', 
	car_check4='$car_check4', 
	car_list='$car_list', 
	car_view='$car_view' 
	where idx=$idx
	";
	mysql_query($query);

	$car_trim1=explode("/" , $car_choice1);  //화물차 차량옵션
	$car_trim2=explode("/" , $car_choice2);
	$car_trim3=explode("/" , $car_check3);   //화물차 특장옵션
	$car_trim4=explode("/" , $car_check4);
	
	if($car_type1=="화물차"){
		$sale_trim=sql_list("select * from option_basic where del='N' and basic_type1='Y' and basic_price!='' order by idx asc ");
	}
	if($car_type1=="캠핑카"){
		$sale_trim=sql_list("select * from option_basic where del='N' and basic_type2='Y' and basic_price!='' order by idx asc ");
	}

	if($mod_car[car_type1]=="화물차"){
		$option_choice1=sql_list("select * from option_choice where ch_option='1' and ch_type1='Y' and del='N' order by idx desc ");
		$option_choice3=sql_list("select * from option_choice where ch_option='2' and ch_type1='Y' and del='N' order by idx desc ");
	}
	if($mod_car[car_type1]=="캠핑카"){
		$option_choice1=sql_list("select * from option_choice where ch_option='1' and ch_type2='Y' and del='N' order by idx desc ");
		$option_choice3=sql_list("select * from option_choice where ch_option='2' and ch_type2='Y' and del='N' order by idx desc ");
	}

	for($i=0;$i<count($option_choice1);$i++){
		if($i==0){
			$new_trim_list1=$option_choice1[$i][idx]."|".$car_list1[$i];
		}else{
			$new_trim_list1.="/".$option_choice1[$i][idx]."|".$car_list1[$i];
		}
	}
	for($i=0;$i<count($option_choice3);$i++){
		if($i==0){
			$new_trim_list2=$option_choice3[$i][idx]."|".$car_list3[$i];
		}else{
			$new_trim_list2.="/".$option_choice3[$i][idx]."|".$car_list3[$i];
		}
	}

	$option_trim_list=sql_fetch("select * from sale_out_trim where idx='$select_trim'  ");
	$option_basic=sql_fetch("select * from option_basic where idx='$option_trim_list[trim_idx]'  ");
	$query="update sale_out_trim set
	trim_idx='".$select_trim."', 
	trim_list1='$new_trim_list1', 
	trim_list2='$new_trim_list2', 
	trim_list3='$trim_list3', 
	trim_list4='$trim_list4', 
	trim_option1='$car_choice1', 
	trim_option2='$car_choice2', 
	trim_option3='$car_check3', 
	trim_option4='$car_check4', 
	trim_price='$trim_price', 
	trim_basic_price='$car_price', 
	trim_explain='$car_add', 
	trim_list='".$option_basic[basic_list]."'
	where 
	idx='$trim_idx' 
	";
	echo $query."<br>";
	mysql_query($query) or die(mysql_error());

	alert_p("수정완료","sub03.php");
}
?>