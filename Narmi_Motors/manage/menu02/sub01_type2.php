<?
include "../inc/header.php";
?>
<script> 
<? 
  if($_POST[car_type2]){
	  $wh=" and basic_type1='".$_POST[car_type1]."' and basic_type2='".$_POST[car_type2]."' ";
  }
  $query = "select * from option_basic where del='N' and basic_price='' $wh order by basic_list asc"; 
  $result = mysql_query($query); 
  $total = mysql_affected_rows(); 

?> 
   parent.wform.car_name.length = <?=$total+1?>; 

   parent.wform.car_name.options[0].text = '=== 차량명선택 ==='; 
   parent.wform.car_name.options[0].value = ''; 
   parent.wform.car_name.options[0].selected = true; 
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
