<?
include "../inc/header.php";
  if(!$_SESSION[login_level]||$_SESSION[login_level]>"40"){
	  alert("권한이 없습니다.","/");
	  exit;
  }

	$row = mysql_fetch_array(mysql_query("SELECT * FROM woojung_part WHERE wc_idx = '$wc_idx'"));

	$sql_to = "update woojung_part set ";
	
	$i=1;
	for($k=1; $k<=60; $k++) {
		while(in_array($i,$img_num)) {
			$l="wc_img_".$i;
			unlink($_SERVER['DOCUMENT_ROOT'].'/data/'.$row[$l]);
			$i++;
		}
		$imgName_to = 'wc_img_'.$k;
		if($i>60) {
			$l="wc_img_".$i;
			$j="";
		}else{
			$l="wc_img_".$i;
			$j=$row[$l];
		}
		if($k==60){
			$sql_to.= $imgName_to." = '".$j."' ";		
		}else{
			$sql_to.= $imgName_to." = '".$j."', ";		
		}
		$i++;
	}
	$sql_to.= "  where wc_idx='$wc_idx'";
	mysql_query($sql_to);
	parent_reload();

?>
