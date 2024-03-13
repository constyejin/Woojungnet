<?
include $_SERVER['DOCUMENT_ROOT'].'/manage/inc/header.php';


if ($eno) $data=mysql_fetch_array(mysql_query("select * from js_popup where pop_no='$eno'"));
$filename[0]=$data[pop_image1];

$updir=$_SERVER['DOCUMENT_ROOT']."/images/popup";

//파일삭제
for ($i=1;$i<=10;$i++){
	if (${"delete".$i}) {
		delfile($updir."/".${"delete".$i});
	}
}

//파일업로드

if($_FILES[pop_file1][tmp_name]) {
				$file1 = $_FILES[pop_file1][tmp_name];
				$file1_name = $_FILES[pop_file1][name];
				$file1_size = $_FILES[pop_file1][size];
				$file1_type = $_FILES[pop_file1][type];
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
						while (file_exists($_SERVER[DOCUMENT_ROOT]."/images/popup/".$copyname)) {
							$copyname=$copyday."_".$k.".".$extension;
							$k++;
						}
						if(!move_uploaded_file($file1,$_SERVER[DOCUMENT_ROOT]."/images/popup/".$copyname)) movepage("goback","파일업로드가 제대로 되지 않았습니다..");
						$filename[0]=$copyname;
						$file_org_name.=$file1_name;
					} else {
						movepage("goback","파일업로드가 제대로 되지 않았습니다...."); 
					}
				 } else { 
					 movepage("goback","파일업로드가 제대로 되지 않았습니다."); 
				 }
}
if (!$pop_x&&!$pop_y) {
   $size=@getimagesize("$updir/$filename[0]");
   $pop_x=$size[0];
   $pop_y=$size[1];
}

$pop_regdate=time();
$pop_subject=addslashes($pop_subject);
//$pop_link=eregi_replace("http://","",$pop_link);
$pop_link=addslashes($pop_link);

if ($eno) $sql="update js_popup set pop_app='$pop_app',pop_scroll='$pop_scroll',pop_y='$pop_y',pop_x='$pop_x',pop_left='$pop_left',pop_right='$pop_right',pop_subject='$pop_subject',pop_link='$pop_link',pop_oneday='$pop_oneday',pop_close='$pop_close',pop_image1='$filename[0]',pop_newwin='$pop_newwin' where pop_no='$eno'";
else $sql="insert into js_popup(pop_app,pop_scroll,pop_y,pop_x,pop_left,pop_right,pop_subject,pop_link,pop_oneday,pop_close,pop_image1,pop_regdate,pop_newwin,site_code) values('$pop_app','$pop_scroll','$pop_y','$pop_x','$pop_left','$pop_right','$pop_subject','$pop_link','$pop_oneday','$pop_close','$filename[0]','$pop_regdate','$pop_newwin','$site_code')";

mysql_query($sql) or die(mysql_error());
//foot();
//movepage("","적용되었습니다.");
?>
<SCRIPT LANGUAGE="JavaScript">
<!--
alert("적용되었습니다.");
top.location.href="./poplist.php";
//-->
</SCRIPT>