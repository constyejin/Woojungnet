<?
include "../inc/header.php";

$j=0;
if(!$idx){
	for($i=0;$i<count($upfile);$i++){
		if($_FILES[upfile][tmp_name][$i]) {
			$file1 = $_FILES[upfile][tmp_name][$i];
			$file1_name = $_FILES[upfile][name][$i];
			$file1_size = $_FILES[upfile][size][$i];
			$file1_type = $_FILES[upfile][type][$i];
			$file1=eregi_replace("\\\\","\\",$file1);
			$s_file_name1=$file1_name;
			$s_file_name1=str_replace(" ","_",$s_file_name1);
			$s_file_name1=str_replace("-","_",$s_file_name1);
			$full_filename = explode(".", $s_file_name1);
			$extension = $full_filename[sizeof($full_filename)-1];
			$extension = strtolower($extension);
			$copyday=date("Ymd");
			$copyname = $copyday ."." . $extension;
			$k=1;
			while (file_exists("../images/board/".$copyname)) {
				$copyname=$copyday."_".$k.".".$extension;
				$k++;
			}
			if(!move_uploaded_file($file1,"../images/board/".$copyname)){
				msg("파일업로드 오류");
			}else{
				if($j==0){
					$board_file="board_file1='".$copyname;
					$j++;
				}else{
					$board_file.="||".$copyname;
					$j++;
				}
			}
		}
	}
	if($j>0) $board_file.="', ";

	$query="insert into board set 
	$board_file
	board_id='$id', 
	board_name='$board_name', 
	board_title='$board_title', 
	board_notice='$board_notice', 
	board_memo='$memo', 
	regdate=now();
	";
	mysql_query($query);
	alert_p("등록되었습니다.","notice_list.php?id=".$id);
}else{
	$web_table=sql_fetch("select * from web_table where table_id='$id' order by idx desc ");
	$j=0;
	$board_view=sql_fetch("select * from board where idx='$idx' ");
	if($board_view[board_file1]){
		$board_file="board_file1='".$board_view[board_file1];
		$board_file1=explode("||",$board_view[board_file1]);
		for($i=0;$i<count($board_file1);$i++){
			$j++;
		}
	}

	if($j<$web_table[table_file]){
		for($i=0;$i<count($upfile);$i++){
			if($_FILES[upfile][tmp_name][$i]) {
				$file1 = $_FILES[upfile][tmp_name][$i];
				$file1_name = $_FILES[upfile][name][$i];
				$file1_size = $_FILES[upfile][size][$i];
				$file1_type = $_FILES[upfile][type][$i];
				$file1=eregi_replace("\\\\","\\",$file1);
				$s_file_name1=$file1_name;
				$s_file_name1=str_replace(" ","_",$s_file_name1);
				$s_file_name1=str_replace("-","_",$s_file_name1);
				$full_filename = explode(".", $s_file_name1);
				$extension = $full_filename[sizeof($full_filename)-1];
				$extension = strtolower($extension);
				$copyday=date("Ymd");
				$copyname = $copyday ."." . $extension;
				$k=1;
				while (file_exists("../images/board/".$copyname)) {
					$copyname=$copyday."_".$k.".".$extension;
					$k++;
				}
				if(!move_uploaded_file($file1,"../images/board/".$copyname)){
					msg("파일업로드 오류");
				}else{
					if($j==0){
						$board_file="board_file1='".$copyname;
						$j++;
					}else{
						$board_file.="||".$copyname;
						$j++;
					}
				}
			}
			if($j==$web_table[table_file]) break;
		}
	}
	if($j>0) $board_file.="', ";

	$query="update board set 
	$board_file
	board_name='$board_name', 
	board_title='$board_title', 
	board_notice='$board_notice', 
	board_memo='$memo' 
	where idx=$idx
	";
	mysql_query($query);
	alert_p("수정되었습니다.","notice_list.php?id=".$id);
}
?>
