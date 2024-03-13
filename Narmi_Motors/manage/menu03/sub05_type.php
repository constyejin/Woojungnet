<?
include "../inc/header.php";
?>
<script> 
<? 
  $query = "select * from category where cate_type1='".$_POST[st_type1]."' order by cate_list asc"; 
  $result = mysql_query($query); 
  $total = mysql_affected_rows(); 

?> 
   parent.wform.st_type2.length = <?=$total+1?>; 

   parent.wform.st_type2.options[0].text = '=소구분='; 
   parent.wform.st_type2.options[0].value = ''; 
<? 
   
   $i = 1; 
  while($data = mysql_fetch_array($result)){ 
?> 
   parent.wform.st_type2.options[<?=$i?>].text = '<?=$data[cate_type2]?>'; 
   parent.wform.st_type2.options[<?=$i?>].value = '<?=$data[cate_type2]?>'; 
<? 
  $i++; 

 } ?> 

</script> 
