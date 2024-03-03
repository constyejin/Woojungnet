<?
require "../lib/config.php";
require "$setup/dbconn.php";
require "$setup/lib.php";

if($_SESSION[login_id]){$u_admin=true;}


if($no && $mode=="delete"){
	$p_qry = "  select * from $id where no='$no' ";
	$p_res = mysql_query($p_qry) or die(mysql_error());
	$view = mysql_fetch_array($p_res);

//	if(($_SESSION["login_id"]==$view["userno"]) || ($confirm_pwd && $confirm_pwd==$view[pwd]) || $u_admin ){
		//자기글이맞으므로 그냥 삭제 OR 관리자이거나
		
		$DelFileName=explode(",",$view[files]);
		for ($i=0;$i<sizeof($DelFileName);$i++){
			@unlink("./data/$id/$DelFileName[$i]");
		}

		@mysql_query("delete from $id where no='".$view["no"]."'") or die(mysql_error());

}

//	movepage("board.php?id=".$id,"삭제 되었습니다.");

?>
<script>
//	alert('삭제 되었습니다.');
	location.href='board.php?id=<?=$id?>';
</script>