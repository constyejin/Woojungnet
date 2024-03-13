<?
require "../lib/config.php";
require "$setup/dbconn.php";
require "$setup/lib.php";

function movepage($url,$memo="",$nam="") {
	global $connect;

		$memo=eregi_replace("<br>","\\n",$memo);
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


if($_POST["no"] && $_POST["id"] && $_POST["comment_memo"] && $_POST["comm_mode"]=="write"){
	if($_SESSION["login_nick"]){
		$_POST["comment_name"]=$_SESSION["login_nick"];
	}
	mysql_query("insert into ".$_POST["id"]."_comments values('','".$_POST["no"]."','".$_POST["comment_name"]."','".time()."','".$_POST["comment_memo"]."','".$_SERVER["REMOTE_ADDR"]."','".$_SESSION["login_id"]."','".$_POST["comment_pwd"]."','','');");
	movepage("/board/board.php?id=". $_POST["id"] ."&mode=view&no=".$_POST["no"],"댓글을 등록했습니다.");
}else if($c_idx && $no && $comm_mode=="delete"){
	mysql_query("delete from ".$id."_comments where c_idx='".$c_idx."' and board_idx='".$no."'");
	movepage("/board/board.php?id=". $id ."&mode=view&no=".$no,"삭제 하였습니다.");
} else {
	movepage("/board/board.php?id=". $id ."&mode=view&no=".$no,"등록된 내용이없습니다");
}
/*
c_idx           
board_idx   
name
date
content
ip
id
pwd
*/
?>