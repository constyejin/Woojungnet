<?
require "$_SERVER[DOCUMENT_ROOT]/lib/config.php"; 
include ($_SERVER['DOCUMENT_ROOT']."/lib/common.php");
?>

<script> 
<? 
  $query = "select * from cate3 where code='".$_GET[tmp]."' order by name asc"; 
  $result = mysql_query($query); 
  $total = mysql_affected_rows(); 

?> 
   parent.outForm.wc_trans2.length = <?=$total+1?>; 

   parent.outForm.wc_trans2.options[0].text = '::부품2::'; 
   parent.outForm.wc_trans2.options[0].value = ''; 
<? 
   
   $i = 1; 
  while($data = mysql_fetch_array($result)){ 
?> 
   parent.outForm.wc_trans2.options[<?=$i?>].text = '<?=$data[name]?>'; 
   parent.outForm.wc_trans2.options[<?=$i?>].value = '<?=$data[name]?>'; 
<? 
  $i++; 

 } ?> 

</script> 
