<?
include $_SERVER['DOCUMENT_ROOT'].'/inc/header.php';
loginCheck();
$db		= new basicdb();
$script = new scriptAlert();
 
$mode = $_POST['mode'];
if(!$mode)$script->alert('잘못된 접근입니다');


if($mode == 'pic_regist') {

	function thumbnail($file, $save_filename, $save_path, $max_width, $max_height)
	{
		// 전송받은 이미지 정보를 받는다
		$img_info = getImageSize($file);

		// 전송받은 이미지의 포맷값 얻기 (gif, jpg png)
		if($img_info[2] == 1) 
			$src_img = ImageCreateFromGif($file);
		else if($img_info[2] == 2)
			$src_img = ImageCreateFromJPEG($file);
		else if($img_info[2] == 3)
			$src_img = ImageCreateFromPNG($file);
		else
			return 0;

		// 전송받은 이미지의 실제 사이즈 값얻기
		$img_width = $img_info[0];
		$img_height = $img_info[1];

		if($img_width <= $max_width)
		{
			$max_width = $img_width;
			$max_height = $img_height;
		}

		if($img_width > $max_width)
			$max_height = ceil(($max_width / $img_width) * $img_height);

		// 새로운 트루타입 이미지를 생성
		$dst_img = imagecreatetruecolor($max_width, $max_height);

		// R255, G255, B255 값의 색상 인덱스를 만든다
		ImageColorAllocate($dst_img, 255, 255, 255);

		// 이미지를 비율별로 만든후 새로운 이미지 생성
		ImageCopyResampled($dst_img, $src_img, 0, 0, 0, 0, $max_width, $max_height, ImageSX($src_img),ImageSY($src_img));

		// 알맞는 포맷으로 저장
		if($img_info[2] == 1)
	 {
			ImageInterlace($dst_img);
			ImageGif($dst_img, $save_path.$save_filename);
		}
		else if($img_info[2] == 2)
	 {
			ImageInterlace($dst_img);
			ImageJPEG($dst_img, $save_path.$save_filename);
		}
	 else if($img_info[2] == 3)
	 {
			ImagePNG($dst_img, $save_path.$save_filename);
	 }

		// 임시 이미지 삭제
		ImageDestroy($dst_img);
		ImageDestroy($src_img);
		return true;
	}  

	
	$userQuery = $db->query("select * from woojung_member where userId='$loginId' limit 1");
	$userRow   = mysql_fetch_object($userQuery);
	if(!$userRow->userId)$script->alert('아이디가 존재하지 않습니다');

	if($userRow->team_name)$company = $userRow->team_name;	
	else if($userRow->company_name)$company = $userRow->company_name;	
	
	$userIdx		= $userRow->idx;
	$userId			= $userRow->userId;
	$name			= $userRow->name;	
	$sub_company	= $userRow->team_subname;
	$tel			= $userRow->tel;		
	$pcs			= $userRow->pcs;		
	$car_no			= str_replace(' ','',$_POST['car_no']);


	$sql = "insert into woojung_picture set ";
	$sql.= "userIdx			= '$userIdx',";
	$sql.= "userId			= '$userId',";
	$sql.= "name			= '$name',";
	$sql.= "company			= '$company',";
	$sql.= "sub_company		= '$sub_company',";
	$sql.= "tel				= '$tel',";
	$sql.= "pcs				= '$pcs',";
	$sql.= "car_no			= '$car_no',";
	$sql.= "code			= '$site_code',";



	for ($i=0;$i<sizeof($upfile);$i++) {
		if($imgcnt>23) break;
		if($upfile[$i]&&in_array($i,$tmpfile)) {
			$file1 = $_FILES[upfile][tmp_name][$i];
			$file1_name = $_FILES[upfile][name][$i];
			$file1_size = $_FILES[upfile][size][$i];
			$file1_type = $_FILES[upfile][type][$i];

			$imgName = 'car_img'.($imgcnt+1);

			$copyday=time();
			$full_filename = explode(".", $file1_name);
			$extension = $full_filename[sizeof($full_filename)-1];
			$extension = strtolower($extension);
			$copyname = $copyday . $i . "." . $extension;
			$k=1;
			while (file_exists($_SERVER[DOCUMENT_ROOT]."/data/".$copyname)) {
				$copyname=$copyday."_".$k.".".$extension;
				$k++;
			}
			thumbnail($file1, $copyname, $_SERVER[DOCUMENT_ROOT]."/data/", 800, 800);

			$sql.=  $imgName." =  '".$copyname."', ";	


			$kk++;$imgcnt++;
		}
	}


	$sql.= "rdate				= now()";


   //echo $sql;
	$result = $db->query($sql);

	$url = "/";
	$msg = '사진전송';
	if($result)	$script->alertReplace($msg."에 성공하였습니다",$url); 
	else $script->alert($msg."에 실패하였습니다");
	
}			


$db->dbclose();
?>