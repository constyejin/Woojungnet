<?
include $_SERVER['DOCUMENT_ROOT']."/admin/inc/header.php";
?>

<?
$mobile=$mobile1."-".$mobile2."-".$mobile3;
$co_date=$co_date1."-".$co_date2."-".$co_date3;
$op_date=$op_date1."-".$op_date2."-".$op_date3;
$pay_date=$pay_date1."-".$pay_date2."-".$pay_date3;
if($secure_date1){$secure_date=$secure_date1."-".$secure_date2."-".$secure_date3;}else{$secure_date="";}

$cost1=str_replace(",","",$cost1);
$cost2=str_replace(",","",$cost2);
$cost3=str_replace(",","",$cost3);
$cost4=str_replace(",","",$cost4);
$cost5=$cost1+$cost2+$cost3+$cost4+$cost6;

if($del1){
	unlink("../../images/user/".$del1);
	$upfile_1="	file1='', ofile1='', ";
}
if($del2){
	unlink("../../images/user/".$del2);
	$upfile_2="	file2='', ofile2='', ";
}


	if($_FILES['upfile']['tmp_name']) {
		$file1 = $_FILES['upfile']['tmp_name'];
		$file1_name = $_FILES['upfile']['name'];
		$file1_size = $_FILES['upfile']['size'];
		$file1_type = $_FILES['upfile']['type'];

		$s_file_name1=$file1_name;
		$copyday = time();
		$file1=eregi_replace("\\\\","\\",$file1);
		$s_file_name1=str_replace(" ","_",$s_file_name1);
		$s_file_name1=str_replace("-","_",$s_file_name1);
		$full_filename = explode(".", $s_file_name1);
		$f_count=sizeof($full_filename)-1;
		$extension = $full_filename[$f_count];
		$extension = strtolower($extension);
		$copyname = $copyday ."." . $extension;
		$k=1;
		while (file_exists("../../images/portfolio/".$copyname)) {
		$copyname=$copyday."_".$k.".".$extension;
		$k++;
		}
		if(!move_uploaded_file($file1,"../../images/portfolio/".$copyname)){
			msg('업로드 실패');
		}
		$upfile_2="	p_file='$copyname', ";
	}

	if($_FILES['upfile1']['tmp_name']) {
		$file1 = $_FILES['upfile1']['tmp_name'];
		$file1_name = $_FILES['upfile1']['name'];
		$file1_size = $_FILES['upfile1']['size'];
		$file1_type = $_FILES['upfile1']['type'];

		$s_file_name1=$file1_name;
		$copyday = time();
		$file1=eregi_replace("\\\\","\\",$file1);
		$s_file_name1=str_replace(" ","_",$s_file_name1);
		$s_file_name1=str_replace("-","_",$s_file_name1);
		$full_filename = explode(".", $s_file_name1);
		$f_count=sizeof($full_filename)-1;
		$extension = $full_filename[$f_count];
		$extension = strtolower($extension);
		$copyname = $copyday ."." . $extension;
		$k=1;
		while (file_exists("../../images/user/".$copyname)) {
		$copyname=$copyday."_".$k.".".$extension;
		$k++;
		}
		if(!move_uploaded_file($file1,"../../images/user/".$copyname)){
			msg('업로드 실패');
		}
		$upfile_1="	file1='$copyname', ofile1='$file1_name', ";
	}

	if($_FILES['upfile2']['tmp_name']) {
		$file1 = $_FILES['upfile2']['tmp_name'];
		$file1_name = $_FILES['upfile2']['name'];
		$file1_size = $_FILES['upfile2']['size'];
		$file1_type = $_FILES['upfile2']['type'];

		$s_file_name1=$file1_name;
		$copyday = time();
		$file1=eregi_replace("\\\\","\\",$file1);
		$s_file_name1=str_replace(" ","_",$s_file_name1);
		$s_file_name1=str_replace("-","_",$s_file_name1);
		$full_filename = explode(".", $s_file_name1);
		$f_count=sizeof($full_filename)-1;
		$extension = $full_filename[$f_count];
		$extension = strtolower($extension);
		$copyname = $copyday ."." . $extension;
		$k=1;
		while (file_exists("../../images/user/".$copyname)) {
		$copyname=$copyday."_".$k.".".$extension;
		$k++;
		}
		if(!move_uploaded_file($file1,"../../images/user/".$copyname)){
			msg('업로드 실패');
		}
		$upfile_2="	file2='$copyname', ofile2='$file1_name', ";
	}


if($_POST[idx]){
	$query="update user set 
	".$upfile_2."
	".$upfile_1."
	".$upfile_2."
	user_type1='$type1', 
	user_type2='$type2', 
	user_type3='$type3', 
	com_name='$_POST[com_name]', 
	owner='$_POST[owner]', 
	mobile='$mobile', 
	co_date='$co_date', 
	op_date='$op_date', 
	dam_name='$_POST[dam_name]', 
	ftp_id='$ftp_id', 
	ftp_pass='$ftp_pass', 
	db_id='$db_id', 
	db_pass='$db_pass', 
	virtual_url='$virtual_url', 
	domain='$domain', 
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
	cost6='$cost6', 
	secure_date='$secure_date', 
	secure_etc='$secure_etc' 
	where idx='$_POST[idx]'
	";
	mysql_query($query);
	alert_p("수정완료","sub01.php?user_type2=".$user_type2."&pay_type=".$spay_type."&sear=".$sear);
}else{
	$query="insert into user set 
	$upfile_2 
	$upfile_1 
	$upfile_2 
	user_type1='$type1', 
	user_type2='$type2', 
	user_type3='$type3', 
	com_name='$_POST[com_name]', 
	owner='$_POST[owner]', 
	mobile='$mobile', 
	co_date='$co_date', 
	op_date='$op_date', 
	dam_name='$_POST[dam_name]', 
	ftp_id='$ftp_id', 
	ftp_pass='$ftp_pass', 
	db_id='$db_id', 
	db_pass='$db_pass', 
	virtual_url='$virtual_url', 
	domain='$domain', 
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
	cost6='$cost6',   
	secure_date='$secure_date', 
	secure_etc='$secure_etc', 
	user_id='$_SESSION[user_id]', 
	regdate=now()  
	";
	mysql_query($query)or die(mysql_error()); 
	alert_p("등록완료","sub01.php?user_type2=".$user_type2."&pay_type=".$pay_type."&sear=".$sear);
}
?>

