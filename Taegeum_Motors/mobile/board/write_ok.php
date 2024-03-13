<?
// 공통 함수
require "../lib/config.php";
require "$setup/dbconn.php";
require "$setup/lib.php";


function movepage($url,$memo="",$nam="") {
	global $connect;

		$memo=str_replace("<br>","\\n",$memo);
		if ($url=="goback") { 
			echo "<script language='javascript'>";
			if ($memo) echo "alert('$memo');";
			echo "history.back();</script>";
		} elseif ($url=="close") {
			echo "<script language='javascript'>";
			if ($memo) echo "alert('$memo');";
			echo "window.close();</script>";
		} elseif ($url=="goback2") {
			echo "<script language='javascript'>";
			if ($memo) echo "alert('$memo');";
			echo "history.go(-2);</script>";
		} elseif ($url=="alert") {
		} elseif ($memo!="") echo "<script language='javascript'> alert('$memo'); </script>";

		if($connect) @mysql_close($connect);

		if ($nam=="top") echo "<script language='javascript'> top.location.href='$url';</script>";
		elseif ($url&&$url!="goback"&&$url!="goback2") echo"<meta http-equiv=\"refresh\" content=\"0; url=$url\">";
		
		if ($nam=="close") echo "<script language='javascript'> window.close();</script>";
		exit;
}

//if(!eregi($HTTP_HOST,$HTTP_REFERER)) Error("잘못된 접근입니다.");
if (!$connect) $connect=dbconn();

if($_SESSION["login_id"]){
	$userno=$_SESSION["login_id"];
} else {
	$userno="GUEST";
}

if ($no) {

	# 디비읽어오기
	$result=mysql_query("select * from $id where no=$no") or die(mysql_error());
	$bu=mysql_fetch_array($result) or die(mysql_error());

	# 본인글 체크
	/*if ((($member[user_level]< $board[super_comp_level] )) || $u_admin){
	} elseif ($bu[pwd]!=$pwd){
		err_msg("암호가 일치하지 않습니다.");
	}
*/
	$file_data=$bu[files];
	$tmp_file_num=explode(",",$file_data);
	$file_org_data=$bu[nfiles];
	$tmp_org_num=explode(",",$file_org_data);

	$k=0;
	for($i=0;$i<sizeof($tmp_file_num);$i++){
		if($tmp_file_num[$i] && !$chk_del[$i]){
			$chk_first=1;
			if($k==0){
				$k=1;
				$file_name.=$tmp_file_num[$i];
				$file_org_name.=$tmp_org_num[$i];
			}else{
				$file_name.=",".$tmp_file_num[$i];
				$file_org_name.=",".$tmp_org_num[$i];
			}
		}
	}
	
}
?>
<!DOCTYPE HTML>
<html>
<head>
	<title>incaron</title>
<meta property="og:type" content="website">
<meta property="og:title" content="incaron">
<meta property="og:description" content="자동차경공매전문, 폐차,중고차,자동차부품">
<meta property="og:image" content="http://www.incaron.co.kr/myimage.jpg">
<meta property="og:url" content="http://www.incaron.co.kr/">
<meta name="robots" content="자동차경공매전문, 폐차,중고차,자동차부품">
<meta name="description" content="자동차경공매전문, 폐차,중고차,자동차부품">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="robots" content="none" />
<meta name="naver-site-verification" content="276b09fe5dbf03dcaac31665e3fdf2dbd980d3c6"/>
<meta name="viewport" content="width=1280">
<?


if($mode=="write" && $sub_mode=="write"){//글등록
	if(!$_POST["id"]){
		echo "정상정인 입력이아님";
		exit;
	} else {
		$id=$_POST["id"];
		$name=$_POST["name"];
		$email=$_POST["email"];
		$subject=$_POST["subject"];
		$memo=$_POST["memo"];
		$pwd=$_POST["pwd"];
		for ($i=0;$i<sizeof($upfile);$i++) {
			if($upfile[$i]) {
				$file1 = $_FILES[upfile][tmp_name][$i];
				$file1_name = $_FILES[upfile][name][$i];
				$file1_size = $_FILES[upfile][size][$i];
				$file1_type = $_FILES[upfile][type][$i];
				if($file1_size>$file1) {
				if(!is_uploaded_file($file1)) movepage("goback","정상적인 방법으로 업로드 해주세요");
					if($file1_size>0) {
						$s_file_name1=$file1_name;
						$file1=str_replace("\\\\","\\",$file1);
						$s_file_name1=str_replace(" ","_",$s_file_name1);
						$s_file_name1=str_replace("-","_",$s_file_name1);
						$full_filename = explode(".", $s_file_name1);
						$extension = $full_filename[sizeof($full_filename)-1];
						$extension = strtolower($extension);
						$copyname = $copyday . $i . "." . $extension;
						// 중복파일이 있을때;; 
						$k=1;
						while (file_exists($_SERVER[DOCUMENT_ROOT]."/board/data/".$id."/".$copyname)) {
							$copyname=$copyday."_".$k.".".$extension;
							$k++;
						}
						if(!move_uploaded_file($file1,$_SERVER[DOCUMENT_ROOT]."/board/data/".$id."/".$copyname)) movepage("goback","파일업로드가 제대로 되지 않았습니다..");
						if ($chk_first!=0) {$file_name.=",";$file_org_name.=",";}
						$chk_first=1;
						$file_name.=$copyname;
						$file_org_name.=$file1_name;
					} else {
						movepage("goback","파일업로드가 제대로 되지 않았습니다...."); 
					}
				 } else { 
					 movepage("goback","파일업로드가 제대로 되지 않았습니다."); 
				 }
			} else {
//				if ($chk_first!=0) { $file_name.=","; $file_org_name.=",";}
//				$chk_first=1;
			}
		}
	/*	
		$d_level=$data["level"]; // 0 - 원글 / 1 - 답글
		$d_ridx=$data["ridx"]; // 0 - 원글 / 1 - 답글
		$d_userno=$data["userno"]; // 0 - ? / 2 - ?
		$d_files=$data["files"]; 
		$d_files2=$data["files2"];
	*/
		$max_sql="select max(list) as mlist from $id";
		$max_res=@mysql_fetch_row(mysql_query($max_sql));

		$mlist=$max_res[0]+1;
		$subject=strip_tags($subject);
		
		$add[]="name='$name'";
		$add[]="email='$email'";
		$add[]="subject='$subject'";
		$add[]="memo='$memo'";
		if($_POST["pwd"]){
			$add[]="pwd='$pwd'";
		}
		$add[]="date='".time()."'";
		$add[]="security='$security'";
		$add[]="notice='$notice'";
		$add[]="midx='$cookie_user_no'";
		$add[]="ridx='0'";
		$add[]="level='0'";
		$add[]="ref='0'"; //조회
		$add[]="files='$file_name'"; //조회
		$add[]="nfiles='$file_org_name'"; //조회
		$add[]="list='".$mlist."'"; //인서트 완료후 no값을 다시 업데이트 하기로함 
		$add[]="ip='".$_SERVER[REMOTE_ADDR]."'";
		for($i=0;$i<sizeof($add);$i++){
			if($i) $insert_list.=",$add[$i]";
			else $insert_list=$add[$i];
		}
		$sql="insert into $id set $insert_list";
		mysql_query($sql) or die(mysql_error());


		movepage("board.php?id=".$id,"등록이 완료되었습니다.");
	}
} else if($sub_mode=="edit" && $_POST[no]){
		for ($i=0;$i<sizeof($upfile);$i++) {
			if($upfile[$i]) {
				$file1 = $_FILES[upfile][tmp_name][$i];
				$file1_name = $_FILES[upfile][name][$i];
				$file1_size = $_FILES[upfile][size][$i];
				$file1_type = $_FILES[upfile][type][$i];
				if($file1_size>$file1) {
				if(!is_uploaded_file($file1)) movepage("goback","정상적인 방법으로 업로드 해주세요");
					if($file1_size>0) {
						$s_file_name1=$file1_name;
						$file1=str_replace("\\\\","\\",$file1);
						$s_file_name1=str_replace(" ","_",$s_file_name1);
						$s_file_name1=str_replace("-","_",$s_file_name1);
						$full_filename = explode(".", $s_file_name1);
						$extension = $full_filename[sizeof($full_filename)-1];
						$extension = strtolower($extension);
						$copyname = $copyday . $i . "." . $extension;
						// 중복파일이 있을때;; 
						$k=1;
						while (file_exists($_SERVER[DOCUMENT_ROOT]."/board/data/".$id."/".$copyname)) {
							$copyname=$copyday."_".$k.".".$extension;
							$k++;
						}
						if(!move_uploaded_file($file1,$_SERVER[DOCUMENT_ROOT]."/board/data/".$id."/".$copyname)) movepage("goback","파일업로드가 제대로 되지 않았습니다..");
						if ($chk_first!=0) {$file_name.=",";$file_org_name.=",";}
						$chk_first=1;
						$file_name.=$copyname;
						$file_org_name.=$file1_name;
					} else {
						movepage("goback","파일업로드가 제대로 되지 않았습니다...."); 
					}
				 } else { 
					 movepage("goback","파일업로드가 제대로 되지 않았습니다."); 
				 }
			} else {
//				if ($chk_first!=0) { $file_name.=","; $file_org_name.=",";}
//				$chk_first=1;
			}
		}


	$chk=@mysql_fetch_array(mysql_query("select * from $id where no='".$_POST["no"]."'"));
	$add[]="name='$name'";
	$add[]="email='$email'";
	$add[]="subject='$subject'";
	$add[]="memo='$memo'";
	if($_POST["pwd"]){
		$add[]="pwd='$pwd'";
	}
	$add[]="security='$security'";
	$add[]="notice='$notice'";
	$add[]="ip='".$_SERVER[REMOTE_ADDR]."'";
	$add[]="files='$file_name'"; //조회
	$add[]="nfiles='$file_org_name'"; //조회
	
	for ($i=0;$i<sizeof($add);$i++){
		if ($i) $update_list.=",$add[$i]";
		else $update_list=$add[$i];
	}
	$sql="update $id set $update_list where no='$no'";
	
	mysql_query($sql) or die(mysql_error());

	movepage("board.php?id=".$id,"수정이 완료되었습니다.");

	if($chk["no"]){
		
	} else {
		movepage($id.".php?id=".$id."&page=".$page,"수정할 글이 존재하지 안습니다.");
	}
} else if($sub_mode=="answer" && $_POST[no]){
	//답글
	$no=$_POST[no];
	$chk=@mysql_fetch_array(mysql_query("select * from $id where no='".$_POST["no"]."'"));
	
	$add[]="name='$name'";
	$add[]="email='$email'";
	$add[]="subject='$subject'";
	$add[]="memo='$memo'";
	if($_POST["pwd"]){
		$add[]="pwd='$pwd'";
	}
	$add[]="date='".time()."'";
	$add[]="security='$security'";
	$add[]="notice='$notice'";
	$add[]="midx='$cookie_user_no'";
	$add[]="ridx='1'";
	$add[]="level='1'";
	$add[]="ref='0'"; //조회
	$add[]="list='".$chk["list"]."'"; //인서트 완료후 no값을 다시 업데이트 하기로함 
	$add[]="ip='".$_SERVER[REMOTE_ADDR]."'";
	for($i=0;$i<sizeof($add);$i++){
		if($i) $insert_list.=",$add[$i]";
		else $insert_list=$add[$i];
	}
	$sql="insert into $id set $insert_list";
	mysql_query($sql) or die(mysql_error());

	movepage("board.php?id=".$id,"답글 등록이 완료되었습니다.");
}
?>