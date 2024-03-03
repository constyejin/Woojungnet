<?
	include "$_SERVER[DOCUMENT_ROOT]/lib/common.php";
	$dir = $_SERVER['DOCUMENT_ROOT'];
	include $dir.'/lib/basicdb.class.php';
	include $dir.'/lib/scriptAlert.class.php';
	$script = new scriptAlert();
	$db		= new basicdb();
	$connect = dbconn();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>incaron_admin</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<?
	
if($wc_idx){
		$row = Row_string("SELECT * FROM woojung_car WHERE wc_idx = '$wc_idx'");

		$sql_to = "update woojung_car set ";

		$i=1;
		for($k=1; $k<=100; $k++) {
			$imgName_to = 'wc_img_'.$i;
			$rowimg="wc_img_".$k;
			$chna="ch_".$k;
			if($_POST[$chna]!="1"){
				if($i == 100){
					$sql_to.= $imgName_to." = '".$row[$rowimg]."' ";		
				}else{
					$sql_to.= $imgName_to." = '".$row[$rowimg]."',";		
				}
				$i++;
			}
		}
		while($i<=100){
			$imgName_to = 'wc_img_'.$i;
			if($i == 100){
				$sql_to.= $imgName_to." = '' ";		
			}else{
				$sql_to.= $imgName_to." = '',";		
			}
			$i++;
		}


		$sql_to.= "  where wc_idx='$wc_idx'";	
		$result_to = $db->query($sql_to);
	
?>
<script>
history.back();
</script>
<?
}else{
		$arr_fname=explode("|:|" , $fname); 

		for($k=1; $k<=100; $k++) {
			$chna="ch_".$k;
			if($_POST[$chna]=="1"){
				unlink($_SERVER['DOCUMENT_ROOT'].'/data/'.$arr_fname[$k-1]);
				unset($arr_fname[$k-1]);
			}
		}

		$fname=implode("|:|", $arr_fname); 
		$url="FileUpload3.php?fname=".$fname;
		$script->alertReplace("삭제 하였습니다",$url); 
		exit;
}
?>