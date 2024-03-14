<?
include $_SERVER['DOCUMENT_ROOT']."/admin/inc/header.php";
?>

<?

	if ($_POST[idx]) $data=mysql_fetch_array(mysql_query("select * from config_popup where idx='$_POST[idx]'"));

	$updir=$_SERVER['DOCUMENT_ROOT']."/images/popup/";

			//파일삭제
			for ($i=1;$i<=10;$i++){
				if (${"delete".$i}) {
					delfile($updir."/".${"delete".$i});
				}
			}
	
			if($_FILES[pop_file1][name])$file_name = FileUpload($_FILES[pop_file1][name],$_FILES[pop_file1][tmp_name],$updir);
			else{
				if(!$delete1)$file_name=$data[image1];
			}

			if (!$width&&!$height) {
			   $size=@getimagesize("$updir/$file_name");
			   $width=$size[0];
			   $height=$size[1];
			}
			$regdate=time();
			$subject=addslashes($subject);
			$link=addslashes($link);
			if($lno=='all'){$lno='';$allpage=1;}
			if ($_POST[idx]){
				$sql="update config_popup set application='$application',lno='$lno',allpage='$allpage',scroll='$scroll',height='$height',width='$width',pleft='$pleft',ptop='$ptop',subject='$subject',link='$link',oneday='$oneday',close='$close',image1='$file_name',new_win='$new_win',sdate='$sdate',edate='$edate' where idx='$_POST[idx]'";
				mysql_query($sql);
				alert_p("수정완료","sub03.php");
			}else{
				$sql="insert into config_popup(application,lno,allpage,scroll,height,width,pleft,ptop,subject,link,oneday,close,image1,regdate,new_win,sdate,edate) values('$application','$lno','$allpage','$scroll','$height','$width','$pleft','$ptop','$subject','$link','$oneday','$close','$file_name','$regdate','$new_win','$sdate','$edate')";
				mysql_query($sql);
				alert_p("등록완료","sub03.php");
			}

/*
if($_POST[idx]){
	$query="update user set 
	".$upfile_2."
	user_type1='$type1', 
	user_type2='$type2', 
	user_type3='$type3', 
	com_name='$_POST[com_name]', 
	mobile='$mobile', 
	co_date='$co_date', 
	op_date='$op_date', 
	ftp_id='$ftp_id', 
	ftp_pass='$ftp_pass', 
	db_id='$db_id', 
	db_pass='$db_pass', 
	virtual_url='$virtual_url', 
	memo='$memo', 
	portfolio='$portfolio', 
	host_type='$host_type', 
	pay_type='$pay_type', 
	tax_bill='$tax_bill', 
	pay_date='$pay_date', 
	cost1='$cost1', 
	cost2='$cost2', 
	cost3='$cost3', 
	cost4='$cost4', 
	cost5='$cost5'  
	where idx='$_POST[idx]'
	";
	mysql_query($query);
	msg("수정완료");
}else{
	$query="insert into user set 
	$upfile_2
	user_type1='$type1', 
	user_type2='$type2', 
	user_type3='$type3', 
	com_name='$_POST[com_name]', 
	mobile='$mobile', 
	co_date='$co_date', 
	op_date='$op_date', 
	ftp_id='$ftp_id', 
	ftp_pass='$ftp_pass', 
	db_id='$db_id', 
	db_pass='$db_pass', 
	virtual_url='$virtual_url', 
	memo='$memo', 
	portfolio='$portfolio', 
	host_type='$host_type', 
	pay_type='$pay_type', 
	tax_bill='$tax_bill', 
	pay_date='$pay_date', 
	cost1='$cost1', 
	cost2='$cost2', 
	cost3='$cost3', 
	cost4='$cost4', 
	cost5='$cost5', 
	user_id='$_SESSION[user_id]', 
	regdate=now()  
	";
	mysql_query($query);
	alert_p("등록완료","sub01.php");
}
*/
?>

