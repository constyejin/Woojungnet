<?
include $_SERVER[DOCUMENT_ROOT]."/manage/inc/header.php";

for ($i=0;$i<sizeof($upfile);$i++) {
if($upfile[$i]&&in_array($i,$tmpfile)) {
	$file1 = $_FILES[upfile][tmp_name][$i];
	$file1_name = $_FILES[upfile][name][$i];
	$file1_size = $_FILES[upfile][size][$i];
	$file1_type = $_FILES[upfile][type][$i];


	$full_filename = explode(".", $file1_name);
	$extension = $full_filename[sizeof($full_filename)-1];

	$f_n=$file1_name;
	
	if($file1){
		$mydir1="../file/".date("Ymd");
		if(!is_dir($mydir1)){
			@mkdir($mydir1,0777);
			@chmod($mydir1, 0777);
		}
		move_uploaded_file($file1,$mydir1."/".$f_n);
		$new_fn=date("Ymd")."/".$f_n;
		$query="insert into dongbu2 set filename='$new_fn', wc_idx='$wc_idx', title='$title', user_id='$loginId', user_name='$loginName', regdate=now() ";
		mysql_query($query);

	}


}
}

?>


<script>
alert('등록완료');
parent.document.location.reload(); 
</script>