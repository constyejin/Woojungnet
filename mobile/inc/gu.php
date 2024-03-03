<?
require "$_SERVER[DOCUMENT_ROOT]/lib/config.php"; 
include ($_SERVER['DOCUMENT_ROOT']."/lib/common.php");
?>

<script> 
<? 
  $query = "select * from cate2 where code='".$_GET[tmp]."' order by name asc"; 
  $result = mysql_query($query); 
  $total = mysql_affected_rows(); 

?> 
   parent.outForm.car_name.length = <?=$total+1?>; 

   parent.outForm.car_name.options[0].text = ':: 모델명 ::'; 
   parent.outForm.car_name.options[0].value = ''; 
<? 
   
   $i = 1; 
  while($data = mysql_fetch_array($result)){ 
?> 
   parent.outForm.car_name.options[<?=$i?>].text = '<?=$data[name]?>'; 
   parent.outForm.car_name.options[<?=$i?>].value = '<?=$data[name]?>'; 
<? 
  $i++; 

 } ?> 

</script> 
