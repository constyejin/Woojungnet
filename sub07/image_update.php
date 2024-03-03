<?
	include "$_SERVER[DOCUMENT_ROOT]/lib/common.php";
	$dir = $_SERVER['DOCUMENT_ROOT'];
	include $dir.'/lib/basicdb.class.php';
	include $dir.'/lib/scriptAlert.class.php';
	$script = new scriptAlert();
	$db		= new basicdb();
	$connect = dbconn();
?>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
  <link rel="stylesheet" type="text/css" href="/common/css/base.css?v=221208"/>

	<link rel="stylesheet" type="text/css" href="/common/css/style.css"/>
	<link rel="stylesheet" type="text/css" href="/common/css/add_style.css?v=2212081209"/>  <!-- 2022.11.25 css추가  -->
	<link rel="stylesheet" type="text/css" href="/common/css/incaron_style.css"/>  <!-- 2022.11.25 css추가  -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
	
	<!-- swiper.js css-->
	<link
		rel="stylesheet"
		href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css"
	/>
	<!-- swiper.js js-->
	<script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>

  <script src="/common/js/incaron_ui.js"></script>
  <script src="/common/js/front.js"></script>
</head>
<?
	$wc_idx = $_POST[wc_idx];
	$imgcnt = $_POST[imgcnt];


	
	$sql = "update woojung_part set ";
	if($_GET['Mode'] == 'delete')
	{
		
		$wc_idx = $_GET[wc_idx];
		$No =  $_GET['No'];
		$imgName = 'wc_img_'.$No;
		
		
		$sql.= $imgName." = '".$car_imgarr[$k-1]."' ";	
		$sql.= " where wc_idx='$wc_idx'";	
		$result = $db->query($sql);	
		
		
		
		
		$row = Row_string("SELECT * FROM woojung_part WHERE wc_idx = '$wc_idx'");
		
		$sql_to = "update woojung_part set ";
		
		for($k=$No; $k<=72; $k++) {
			
			$s = $k+1;
			$imgName_to = 'wc_img_'.$k;
			if($k == 72){
				$sql_to.= $imgName_to." = '".$row[wc_img_.$s]."' ";		
			}else{
				$sql_to.= $imgName_to." = '".$row[wc_img_.$s]."',";		
			}
		}

		$sql_to.= "  where wc_idx='$wc_idx'";	
		
		
		$result_to = $db->query($sql_to);
		
		



		$msg = '수정';
		$url = "sub07_1_write.php?wc_idx=".$wc_idx;
		ParentReload();
		
	}
	
	if($_POST['mode'] == 'insert')
	{
	
		

		if($_POST['hidFileName']) {
		$car_imgarr = explode("|:|",$_POST['hidFileName']);
		
		
		$row = Row_string("SELECT * FROM woojung_part WHERE wc_idx = '$wc_idx'");
		
		$max = 0;
		for($s=1; $s<=24; $s++) {
		    if(strlen($row[car_img.$s]) == 0 )
		    {
		    	$max =  $s;
		    	break; 
		    }
		}
		
		
		if($max == 0 )
		{
		    $script->alert("사진은 72장이상 올릴수 없습니다"); 	
		}
		
		for($k=1; $k<=72; $k++) {
			
			
			if($max > 72 )
			{
			    $script->alert("사진은 72장이상 올릴수 없습니다"); 	
			}
			
			$imgName = 'wc_img_'.($imgcnt+1);
			if($car_imgarr[$k-1])
			{
				
				if($k == 1){
					$sql.= $imgName." = '".$car_imgarr[$k-1]."' ";	
				}else{
					$sql.= ", ". $imgName." =  '".$car_imgarr[$k-1]."' ";	
				}

				$max++;	
				$imgcnt++;
			}

		}
		
		
		
		
		$sql.= "where wc_idx='$wc_idx'";	
		$msg = '수정';
		
		
		$result = $db->query($sql);

		$url = "sub07_1_write.php?wc_idx=".$wc_idx;
		
	
	}
	
		
	}
	
	
	
?>