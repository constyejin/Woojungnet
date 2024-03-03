<?
	include_once "../inc/header.php"; 
	$connect = dbconn();
	include $dir.'/lib/basicdb.class.php';
	include $dir.'/lib/scriptAlert.class.php';
	$script = new scriptAlert();
	$db		= new basicdb();
	
	
	
	$idx = $_POST[idx];
	$imgcnt = $_POST[imgcnt];

		$row = Row_string("SELECT * FROM woojung_picture WHERE idx = '$idx'");

		$sql_to = "update woojung_picture set ";

		$i=1;
		for($k=1; $k<=24; $k++) {
			$imgName_to = 'car_img'.$i;
			if($check[$k]!="1"){
				if($i == 24){
					$sql_to.= $imgName_to." = '".$row[car_img.$k]."' ";		
				}else{
					$sql_to.= $imgName_to." = '".$row[car_img.$k]."',";		
				}
				$i++;
			}
		}
		while($i<=24){
			$imgName_to = 'car_img'.$i;
			if($i == 24){
				$sql_to.= $imgName_to." = '' ";		
			}else{
				$sql_to.= $imgName_to." = '',";		
			}
			$i++;
		}


		$sql_to.= "  where idx='$idx'";	
		//echo $sql_to;
		
		
		$result_to = $db->query($sql_to);
		
		
/*


		$msg = '선택삭제';
		$url = "FileUpload.php?idx=".$idx;
		
		if($result_to)
		{
		    
		    if($result){$script->alertReplace($msg."에 성공하였습니다",$url); }
		}
		else
		{
		    $script->alert($msg."에 실패하였습니다");
		}
	*/	
	
?>
<script>
history.back();
</script>