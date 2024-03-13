<?
include "../inc/header.php";

if($del_idx){
	$query="delete from sale_car where idx=$del_idx ";
	mysql_query($query);
	parent_reload();
	exit;
}

if($img_ad=="Y"){
	$mod_car=sql_fetch("select * from sale_car where idx='$idx' ");
	if($mod_car[car_img]) $mod_car_img=explode("|:|" , $mod_car[car_img]);
	for ($i=0;$i<sizeof($check_img);$i++) {
		unset($mod_car_img[$check_img[$i]]);
	}
	$sql=implode("|:|", $mod_car_img);
	$query="update sale_car set car_img='$sql' where idx=$idx ";
	mysql_query($query);
	exit;
}

$car_price=str_replace(",","",$car_price);
if($car_type1=="화물차"){ 
	$car_choice1=implode("/",$car_choice1);$car_choice2=implode("/",$car_choice3); 
	$car_basic=implode("/",$car_basic1);
	$car_color1=implode("/",$car_color1);
	$car_color2=implode("/",$car_color2);
	$car_check1=implode("/",$car_check1);
	$car_check2=implode("/",$car_check3);
	$car_check3=implode("/",$car_check5);
	$car_check4=implode("/",$car_check7);
}
if($car_type1=="캠핑카"){ 
	$car_choice1=implode("/",$car_choice2);$car_choice2=implode("/",$car_choice4); 
	$car_basic=implode("/",$car_basic2);
	$car_color1=implode("/",$car_color1_1);
	$car_color2=implode("/",$car_color2_1);
	$car_check1=implode("/",$car_check2);
	$car_check2=implode("/",$car_check4);
	$car_check3=implode("/",$car_check6);
	$car_check4=implode("/",$car_check8);
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

	$query="insert into sale_car set 
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
	car_color1='$car_color1', 
	car_color2='$car_color2', 
	car_check1='$car_check1', 
	car_check2='$car_check2', 
	car_basic='$car_basic', 
	car_choice1='$car_choice1', 
	car_choice2='$car_choice2', 
	car_check3='$car_check3', 
	car_check4='$car_check4', 
	car_view='$car_view', 
	car_regdate=now() 
	";
//	echo $query;
	mysql_query($query) or die(mysql_error()); 
	$mod_car=sql_fetch("select * from sale_car where 1 order by car_regdate desc ");

	$car_trim1=explode("/" , $car_choice1);  // 차량옵션 체크박스
	$car_trim2=explode("/" , $car_choice2);  // 특장옵션 체크박스
	$car_trim3=explode("/" , $car_check3);   // 차량옵션 이미지박스
	$car_trim4=explode("/" , $car_check4);   // 특장옵션 이미지박스
	
	if($car_type1=="화물차"){
		$sale_trim=sql_list("select * from option_basic where del='N' and basic_type1='Y' and basic_price!='' order by idx asc ");
	}
	if($car_type1=="캠핑카"){
		$sale_trim=sql_list("select * from option_basic where del='N' and basic_type2='Y' and basic_price!='' order by idx asc ");
	}

	
	for($i=0;$i<count($sale_trim);$i++){
		$j=0;$total_c1=0;
		for($k=0;$k<count($car_trim1);$k++){
			$trim1=explode("|" , $car_trim1[$k]);
			if($sale_trim[$i][idx]==$trim1[0]){
				$option_car=sql_fetch("select * from option_choice where idx='$trim1[1]' ");
				$total_c1+=$option_car[ch_price];
				if($j==0){
					$trim_option1=$trim1[1];
					if($car_type1=="화물차"){
						$trim_list1=$car_list1[$k];
					}else{
						$trim_list1=$car_list2[$k];
					}
				}else{
					$trim_option1.="/".$trim1[1];
					if($car_type1=="화물차"){
						$trim_list1.="/".$car_list1[$k];
					}else{
						$trim_list1.="/".$car_list2[$k];
					}
				}
				$j++;
			}
		}
		$j=0;$total_c2=0;
		for($k=0;$k<count($car_trim2);$k++){
			$trim2=explode("|" , $car_trim2[$k]);
			if($sale_trim[$i][idx]==$trim2[0]){
				$option_car=sql_fetch("select * from option_choice where idx='$trim2[1]' ");
				$total_c2+=$option_car[ch_price];
				if($j==0){
					$trim_option2=$trim2[1];
					if($car_type1=="화물차"){
						$trim_list2=$car_list3[$k];
					}else{
						$trim_list2=$car_list4[$k];
					}
				}else{
					$trim_option2.="/".$trim2[1];
					if($car_type1=="화물차"){
						$trim_list2.="/".$car_list3[$k];
					}else{
						$trim_list2.="/".$car_list4[$k];
					}
				}
				$j++;
			}
		}
		$j=0;$total_c3=0;
		for($k=0;$k<count($car_trim3);$k++){
			$trim3=explode("|" , $car_trim3[$k]);
			if($sale_trim[$i][idx]==$trim3[0]){
				$option_car=sql_fetch("select * from option_choice where idx='$trim3[1]' ");
				$total_c3+=$option_car[ch_price];
				if($j==0){
					$trim_option3=$trim3[1];
					$trim_list3=$car_list3[$k];
				}else{
					$trim_option3.="/".$trim3[1];
					$trim_list3.="/".$car_list3[$k];
				}
				$j++;
			}
		}
		$j=0;$total_c4=0;
		for($k=0;$k<count($car_trim4);$k++){
			$trim4=explode("|" , $car_trim4[$k]);
			if($sale_trim[$i][idx]==$trim4[0]){
				$option_car=sql_fetch("select * from option_choice where idx='$trim4[1]' ");
				$total_c4+=$option_car[ch_price];
				if($j==0){
					$trim_option4=$trim4[1];
					$trim_list4=$car_list4[$k];
				}else{
					$trim_option4.="/".$trim4[1];
					$trim_list4.="/".$car_list4[$k];
				}
				$j++;
			}
		}

		$trim_price=$total_c3+$total_c4;
		$query="insert into sale_car_trim set
		car_idx='$mod_car[idx]', 
		trim_idx='".$sale_trim[$i][idx]."', 
		trim_option1='$trim_option1', 
		trim_list1='$trim_list1', 
		trim_list2='$trim_list2', 
		trim_list3='$trim_list3', 
		trim_list4='$trim_list4', 
		trim_option2='$trim_option2', 
		trim_option3='$trim_option3', 
		trim_option4='$trim_option4', 
		trim_price='$trim_price', 
		trim_list='".$sale_trim[$i][basic_list]."'
		";
		mysql_query($query) or die(mysql_error());
		unset($trim_option1);unset($trim_option2);unset($trim_option3);unset($trim_option4);
		unset($trim_list1);unset($trim_list2);unset($trim_list3);unset($trim_list4);
	}
	
	alert_p("등록완료","sub01.php");
}else{
	$mod_car=sql_fetch("select * from sale_car where idx='$idx' ");
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

	$query="update sale_car set 
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
	car_color1='$car_color1', 
	car_color2='$car_color2',
	car_check1='$car_check1', 
	car_check2='$car_check2', 
	car_basic='$car_basic', 
	car_choice1='$car_choice1', 
	car_choice2='$car_choice2', 
	car_check3='$car_check3', 
	car_check4='$car_check4', 
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

	
	for($i=0;$i<count($sale_trim);$i++){
		$j=0;$total_c1=0;
		for($k=0;$k<count($car_trim1);$k++){
			$trim1=explode("|" , $car_trim1[$k]);
			if($sale_trim[$i][idx]==$trim1[0]){
				$option_car=sql_fetch("select * from option_choice where idx='$trim1[1]' ");
				$total_c1+=$option_car[ch_price];
				if($j==0){
					$trim_option1=$trim1[1];
					if($car_type1=="화물차"){
						$trim_list1=$car_list1[$k];
					}else{
						$trim_list1=$car_list2[$k];
					}
				}else{
					$trim_option1.="/".$trim1[1];
					if($car_type1=="화물차"){
						$trim_list1.="/".$car_list1[$k];
					}else{
						$trim_list1.="/".$car_list2[$k];
					}
				}
				$j++;
			}
		}
		$j=0;$total_c2=0;
		for($k=0;$k<count($car_trim2);$k++){
			$trim2=explode("|" , $car_trim2[$k]);
			if($sale_trim[$i][idx]==$trim2[0]){
				$option_car=sql_fetch("select * from option_choice where idx='$trim2[1]' ");
				$total_c2+=$option_car[ch_price];
				if($j==0){
					$trim_option2=$trim2[1];
					if($car_type1=="화물차"){
						$trim_list2=$car_list3[$k];
					}else{
						$trim_list2=$car_list4[$k];
					}
				}else{
					$trim_option2.="/".$trim2[1];
					if($car_type1=="화물차"){
						$trim_list2.="/".$car_list3[$k];
					}else{
						$trim_list2.="/".$car_list4[$k];
					}
				}
				$j++;
			}
		}
		$j=0;$total_c3=0;
		for($k=0;$k<count($car_trim3);$k++){
			$trim3=explode("|" , $car_trim3[$k]);
			if($sale_trim[$i][idx]==$trim3[0]){
				$option_car=sql_fetch("select * from option_choice where idx='$trim3[1]' ");
				$total_c3+=$option_car[ch_price];
				if($j==0){
					$trim_option3=$trim3[1];
					$trim_list3=$car_list3[$k];
				}else{
					$trim_option3.="/".$trim3[1];
					$trim_list3.="/".$car_list3[$k];
				}
				$j++;
			}
		}
		$j=0;$total_c4=0;
		for($k=0;$k<count($car_trim4);$k++){
			$trim4=explode("|" , $car_trim4[$k]);
			if($sale_trim[$i][idx]==$trim4[0]){
				$option_car=sql_fetch("select * from option_choice where idx='$trim4[1]' ");
				$total_c4+=$option_car[ch_price];
				if($j==0){
					$trim_option4=$trim4[1];
					$trim_list4=$car_list4[$k];
				}else{
					$trim_option4.="/".$trim4[1];
					$trim_list4.="/".$car_list4[$k];
				}
				$j++;
			}
		}

		$trim_price=$total_c3+$total_c4;
		$query="update sale_car_trim set
		trim_option1='$trim_option1', 
		trim_list1='$trim_list1', 
		trim_list2='$trim_list2', 
		trim_list3='$trim_list3', 
		trim_list4='$trim_list4', 
		trim_option2='$trim_option2', 
		trim_option3='$trim_option3', 
		trim_option4='$trim_option4', 
		trim_price='$trim_price', 
		trim_list='".$sale_trim[$i][basic_list]."'
		where 
		car_idx='$idx' and 
		trim_idx='".$sale_trim[$i][idx]."' 
		";
		echo $query."<br>";
		mysql_query($query) or die(mysql_error());
		unset($trim_option1);unset($trim_option2);unset($trim_option3);unset($trim_option4);
		unset($trim_list1);unset($trim_list2);unset($trim_list3);unset($trim_list4);
	}
	
	alert_p("수정완료","sub01.php");
}
?>