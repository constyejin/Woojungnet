<?
include "../inc/header.php";
?>

<? 
  $option_basic=sql_fetch("select * from option_basic where idx='$_POST[car_name]' ");
  $query = "select * from option_basic where del='N' and basic_name='".$option_basic[basic_name]."' and basic_price!='' order by basic_list asc"; 
  $result = mysql_query($query); 
  $total = mysql_affected_rows(); 
  $i=0; 
  while($data = mysql_fetch_array($result)){ 
	  if($i==0){
		  $bt.='<button type="button" id="btn_ch'.$data[idx].'" class="btn btn-round btn-outline-dark btn-sm" onclick="op_display('.$data[idx].')">'.$data[basic_price].'</button> ';
	  }else{
		  $bt.='<button type="button" id="btn_ch'.$data[idx].'" class="btn btn-round btn-outline-dark btn-sm" onclick="op_display('.$data[idx].')">'.$data[basic_price].'</button> ';
	  }
	  $i++;
  }
?> 

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