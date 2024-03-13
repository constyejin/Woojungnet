<?
include "../inc/header.php";
?>
<script> 
<? 
  $query = "select * from category where cate_type1='".$_POST[car_type1]."' order by cate_list asc"; 
  $result = mysql_query($query); 
  $total = mysql_affected_rows(); 

?> 
   parent.wform.car_type2.length = <?=$total+1?>; 

   parent.wform.car_type2.options[0].text = '=소구분='; 
   parent.wform.car_type2.options[0].value = ''; 
   parent.wform.car_type2.options[0].selected = true; 
<? 
   
   $i = 1; 
  while($data = mysql_fetch_array($result)){ 
?> 
   parent.wform.car_type2.options[<?=$i?>].text = '<?=$data[cate_type2]?>'; 
   parent.wform.car_type2.options[<?=$i?>].value = '<?=$data[cate_type2]?>'; 
<? 
  $i++; 

 } ?> 

<? 
  if($_POST[car_type1]=="화물차"){
	  $wh=" and basic_type1='Y' ";
  }else if($_POST[car_type1]=="캠핑카"){
	  $wh=" and basic_type2='Y' ";
  }
  $query = "select * from option_basic where del='N' and basic_price='' $wh order by basic_list asc"; 
  $result = mysql_query($query); 
  $total = mysql_affected_rows(); 

?> 
   parent.wform.car_name.length = <?=$total+1?>; 

   parent.wform.car_name.options[0].text = '=== 차량명선택 ==='; 
   parent.wform.car_name.options[0].value = ''; 
<? 
   
   $i = 1; 
  while($data = mysql_fetch_array($result)){ 
?> 
   parent.wform.car_name.options[<?=$i?>].text = '<?=$data[basic_name]?>'; 
   parent.wform.car_name.options[<?=$i?>].value = '<?=$data[idx]?>'; 
<? 
  $i++; 

 } ?> 

</script> 
