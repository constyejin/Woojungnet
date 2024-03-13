<?
include "../inc/header.php";

  $option_basic=sql_fetch("select * from option_basic where idx='$_POST[car_name]' ");
  $query = "select * from option_basic where del='N' and basic_name='".$option_basic[basic_name]."' and basic_price!='' order by basic_list asc "; 
  $result = mysql_query($query); 
  $total = mysql_affected_rows(); 
?>

<script>
   parent.wform.select_trim.length = <?=$total+1?>; 

   parent.wform.select_trim.options[0].text = '=== 트림선택 ==='; 
   parent.wform.select_trim.options[0].value = ''; 
<? 
  $i = 1; 
  while($data = mysql_fetch_array($result)){ 
?> 
   parent.wform.select_trim.options[<?=$i?>].text = '<?=$data[basic_price]?>'; 
   parent.wform.select_trim.options[<?=$i?>].value = '<?=$data[idx]?>'; 
<? 
  $i++; 
  }
?> 

</script> 

<script>
	parent.document.getElementById("trim_bt").innerHTML='<?=$bt?>';
	parent.document.getElementById("float_write_1").innerHTML='<?=$option_basic[basic_name]?>';
	parent.btn_start();
</script> 
<?
  $result = mysql_query($query); 
  while($data = mysql_fetch_array($result)){
	  echo "<script>";
	  echo "parent.trim_name_save(".$data[idx].",'".$data[basic_price]."');";
	  echo "</script>";
  }
?>