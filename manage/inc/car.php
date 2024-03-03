<?
require "$_SERVER[DOCUMENT_ROOT]/lib/config.php"; 
include ($_SERVER['DOCUMENT_ROOT']."/lib/common.php");
?>

<script> 
<? 
  $query = "select * from team_cate where code='".$_GET[tmp]."' order by name asc"; 
  $result = mysql_query($query); 
  $total = mysql_affected_rows(); 

?> 
   parent.outForm.car_cate2.length = <?=$total+1?>; 

   parent.outForm.car_cate2.options[0].text = ':: 팀명 ::'; 
   parent.outForm.car_cate2.options[0].value = ''; 
<? 
   
   $i = 1; 
  while($data = mysql_fetch_array($result)){ 
?> 
   parent.outForm.car_cate2.options[<?=$i?>].text = '<?=$data[name]?>'; 
   parent.outForm.car_cate2.options[<?=$i?>].value = '<?=$data[idx]?>'; 
<? 
  $i++; 

 } ?> 

</script> 
