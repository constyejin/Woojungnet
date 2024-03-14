	<?php
include $_SERVER['DOCUMENT_ROOT']."/admin/inc/header.php";
	?>
<script> 
<? 
  $query = "select * from config_category where length(code)=6 and code like '$_GET[tmp]%' order by sortno "; 
  $result = mysql_query($query); 
  $total = mysql_affected_rows(); 

?> 
   parent.cform.type3.length = <?=$total+1?>; 

   parent.cform.type3.options[0].text = ':::æ∆¿Ã««:::'; 
   parent.cform.type3.options[0].value = ''; 
<? 
   
   $i = 1; 
  while($data = mysql_fetch_array($result)){ 
?> 
   parent.cform.type3.options[<?=$i?>].text = '<?=$data[name]?>'; 
   parent.cform.type3.options[<?=$i?>].value = '<?=$data[code]?>'; 
<? 
  $i++; 

 } ?> 
   parent.cform.type3.options[1].selected="true";

</script> 
