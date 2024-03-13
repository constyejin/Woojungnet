<?
include "../inc/header.php";

if($agree!="Y"){
	msg('나르미에게도 견적서가 제출됨에 동의해 주세요.');
	exit;
}
if(!$est_name){
	msg('이름을 입력해 주세요.');
	exit;
}

if(preg_match('/[0-9]/',$est_name)>0 || preg_match('/[a-zA-Z]/',$est_name) > 0){
	msg('이름은 한글로 입력해 주세요.');
	exit;
}

if(!$est_phone){
	msg('연락처를 입력해 주세요.');
	exit;
}

$car_choice1=implode("/",$car_check5);
$car_choice2=implode("/",$car_check7); 

$query="insert into sale_est (car_type1,car_type2,car_name,car_price,car_explain,car_add,car_catalog1,car_catalog2,car_catalog3,car_file,car_color1,car_color2,car_check1,car_check2,car_img,car_basic,car_choice1,car_choice2,car_check3,car_check4) select car_type1,car_type2,car_name,car_price,car_explain,car_add,car_catalog1,car_catalog2,car_catalog3,car_file,car_color1,car_color2,car_check1,car_check2,car_img,car_basic,car_choice1,car_choice2,car_check3,car_check4 from sale_car where idx='$idx' ";
mysql_query($query) or die(mysql_error()); 

$sale_car=sql_fetch("select * from sale_car where idx='$idx' order by idx desc ");
$sale_car_trim=sql_fetch("select * from sale_car_trim where idx='$trim_idx' ");
$sale_basic=sql_fetch("select * from option_basic where idx='".$sale_car_trim[trim_idx]."' ");
$sale_basic_name=sql_fetch("select * from option_basic where basic_name='".$sale_basic[basic_name]."' and basic_price='' ");
$mod_car=sql_fetch("select * from sale_est where 1 order by idx desc ");
$e_code="N".date("Y-m")."-";
$estimate=sql_fetch("select * from estimate where est_code like '%".$e_code."%' order by idx desc ");
if($estimate[idx]){
	$est_c1=(int)substr($estimate[est_code],9,4);
	$est_c1++;
	$est_code=$e_code.sprintf("%04d",$est_c1);
}else{
	$est_code=$e_code."0001";
}

for($i=0;$i<count($car_check5);$i++){ 
	$mod_choice1=sql_fetch("select * from option_choice where idx='$car_check5[$i]' ");
	$tot_c1+=$mod_choice1[ch_price];
}
for($i=0;$i<count($car_check7);$i++){ 
	$mod_choice2=sql_fetch("select * from option_choice where idx='$car_check7[$i]' ");
	$tot_c2+=$mod_choice2[ch_price];
}
$est_price=$sale_car[car_price]+$tot_c1+$tot_c2;


$query="insert into estimate set 
est_code='$est_code', 
car_idx='$mod_car[idx]', 
car_trim_idx='$trim_idx', 
trim_idx='$sale_car_trim[trim_idx]', 
est_color1='$car_color1', 
est_color2='$car_color2', 
est_choice1='$car_choice1', 
est_choice2='$car_choice2', 
est_name='$est_name', 
est_phone='$est_phone', 
est_car_name='$sale_basic_name[idx]', 
est_cartype='".$sale_car[car_type1].">".$sale_car[car_type2]."', 
est_cartype1='".$sale_car[car_type1]."', 
est_cartype2='".$sale_car[car_type2]."', 
est_carname='$sale_car[car_name]', 
est_price='$est_price', 
est_regdate=now()
";
mysql_query($query) or die(mysql_error()); 

$query="update sale_est set 
car_regdate=now() 
where idx='$mod_car[idx]'
";
mysql_query($query) or die(mysql_error()); 

$estimate=sql_fetch("select * from estimate where 1 order by idx desc ");
?>
<script>
parent.window.open("/inc/estimate_popup.php?idx=<?=$estimate[idx]?>", '_blank', 'height=1000, width=840');
</script>