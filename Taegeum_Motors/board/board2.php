<? 
	session_start();	
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
function cut_str($msg,$cut_size,$dot=true) {
	if($cut_size<=0) return $msg;
	if ($dot) $odot="...";
	else $odot="";
	if(ereg("\[RE\]",$msg)) $cut_size=$cut_size+4;
	for($i=0;$i<$cut_size;$i++) if(ord($msg[$i])>127) $han++; else $eng++;
	$cut_size=$cut_size+(int)$han*0.6;
	$point=1;
	for ($i=0;$i<strlen($msg);$i++) {
		if ($point>$cut_size) return $pointtmp.$odot;
		if (ord($msg[$i])<=127) {
			$pointtmp.= $msg[$i];
			if ($point%$cut_size==0) return $pointtmp.$odot; 
		} else {
			if ($point%$cut_size==0) return $pointtmp.$odot;
			$pointtmp.=$msg[$i].$msg[++$i];
			$point++;
		}
		$point++;
	}
	return $pointtmp;
}
function sql_connect2($db_host, $db_user, $db_pass, $db_name)
{
    $result = mysql_connect($db_host, $db_user, $db_pass) or die(mysql_error());
    mysql_select_db($db_name) or die(mysql_error());
    return $result;
}
$dir=$_SERVER["DOCUMENT_ROOT"]; 
$mysql_host = 'localhost';
$mysql_user = 'wj13723';
$mysql_password = 'q1w2e3r4';
$mysql_db = 'wj13723';
$connect2 = sql_connect2($mysql_host, $mysql_user, $mysql_password, $mysql_db);

$sql="select * from admin_table where a_name='$id'";
$result=mysql_query($sql);
$data=mysql_fetch_array($result);

		include_once "../inc/header.php";
if($data[a_header2]){
	include "$dir/{$data[a_header2]}";
}
?>
	<div id="sub_contents">
		
		<div id="sub_L">
<?
		include_once "../inc/left05.php";
?>
		</div>
		<div id="sub_Con">
<?

//if ($_SESSION[login_level]==1) $u_admin=true;
if(!$_SESSION[login_level]){
	//로그인전 레벨세션이없으면 비회원 10으로 맞춰줌
	$_SESSION[login_level]=10;
}
$u_admin=true;
	$_SESSION[login_level]=1;

$skinDir="/board/skin/".$data[a_skinname]."/";
$table_width="100%";
?> 

                <!-- sub title -->
<?
	if($data[a_header]){
?>
		<div class="Tit"><img src="<?=$data[a_header]?>" /></div>
					
<? } ?>
<?
if($data[a_table]){
?>
<?=$data[a_table]?>
<?
}
?>

			
                <!-- 본문시작 -->
			


<style type="text/css">
#Gall .Pic {width:150px; height:140px; border:1px solid #efefef;}
#Gall td {vertical-align:top;}
td {height:-10px;}
</style>
			

<?

$a_insert="<a href='".$_SERVER['PHP_SELF']."?id=".$id."&mode=write'>";

if($_POST["mode"]=="pwconfirm" && !$passed){
	$pwd_ok=@mysql_fetch_row(mysql_query("select pwd,ridx,list from $id where no='".$_POST["no"]."'"));
	if($pwd_ok[1]=='1'){
		$pwd_ok=@mysql_fetch_row(mysql_query("select pwd,ridx from $id where list='".$pwd_ok[2]."'"));
	}
	
	if($_POST["confirm_pwd"]==$pwd_ok[0]){
		$mode="write";
		$sub_mode="edit";
	} else {
		echo "<script>alert('비밀번호가 틀렷습니다3');</script>";
		$mode="pwchk";
	}
}

if(!$_POST["confirm_pwd"] && $mode=="view" && !$u_admin){
	$passwChk = mysql_fetch_array(mysql_query("  select * from $id where no='$no' "));
	if($passwChk["security"]=="Y"){
		if($passwChk[userno]==$_SESSION[login_id]){
			$passed="";
		}else{
			$passed="pwview";
		}
	}
}

if($passed=="pwview" && $_POST["mode"]=="pwconfirm"){
	$pwd_ok=@mysql_fetch_row(mysql_query("select pwd,userno,ridx,list from $id where no='".$no."'"));
	if($pwd_ok[0]){
		if($_POST["confirm_pwd"]==$pwd_ok[0]){
			$mode="view";
			$passed="";
		} else {
			echo "<script>alert('비밀번호가 틀렷습니다1');</script>";
		}
	} else if($pwd_ok[2]=='1'){
		$pwd_ok2=@mysql_fetch_row(mysql_query("select pwd,ridx,userno from $id where list='".$pwd_ok[3]."' and ridx='0'"));
		if($pwd_ok2[0]){
			if($_POST["confirm_pwd"]==$pwd_ok2[0]){
				$mode="view";
				$passed="";
			} else {
				echo "<script>alert('비밀번호가 틀렷습니다');</script>";
			}
		} else {
			$pwd_user=@mysql_fetch_row(mysql_query("select user_pw from js_member where user_id='".$pwd_ok2[2]."'"));
			if($_POST["confirm_pwd"]==$pwd_user[0]){
				$mode="view";
				$passed="";
			} else {
				echo "<script>alert('비밀번호가 틀렷습니다2');</script>";
			}
		}
	} else {
		$pwd_ok=@mysql_fetch_row(mysql_query("select user_pw from js_member where user_id='".$pwd_ok[1]."'"));
		if($_POST["confirm_pwd"]==$pwd_ok[0]){
			$mode="view";
			$passed="";
		} else {
			echo "<script>alert('비밀번호가 틀렷습니다2');</script>";
		}
	}
}
$qcommon="id=".$id;
?>


<?
				if($data[a_skinname]=="gallery"){
					if($passed=="pwview"){
						include_once "$_SERVER[DOCUMENT_ROOT]/board/view_secret.php";
					} else if(!$mode || $mode=="list"){
						include_once "$_SERVER[DOCUMENT_ROOT]/board/skin/".$data[a_skinname]."/list_main2.php";
					} else if($mode=="write"){
						include_once "$_SERVER[DOCUMENT_ROOT]/board/skin/".$data[a_skinname]."/write.php";
					} else if($mode=="view"){
						include_once "$_SERVER[DOCUMENT_ROOT]/board/skin/$data[a_skinname]/view_main.php";
//						include_once "$_SERVER[DOCUMENT_ROOT]/board/skin/$data[a_skinname]/view_write_comment.php";
					} else if($mode=="pwchk"){
						include_once "$_SERVER[DOCUMENT_ROOT]/board/view_secret.php";
					}
				}elseif($data[a_skinname]=="bbs"){
					if($passed=="pwview"){
						include_once "$_SERVER[DOCUMENT_ROOT]/board/view_secret.php";
					} else if(!$mode || $mode=="list"){
						include_once "$_SERVER[DOCUMENT_ROOT]/board/skin/".$data[a_skinname]."/list_footer.php";
						include_once "$_SERVER[DOCUMENT_ROOT]/board/skin/".$data[a_skinname]."/list_header.php";
						include_once "$_SERVER[DOCUMENT_ROOT]/board/skin/".$data[a_skinname]."/list_main2.php";
						
					} else if($mode=="write"){
						include_once "$_SERVER[DOCUMENT_ROOT]/board/skin/".$data[a_skinname]."/write.php";
					} else if($mode=="view"){
						include_once "$_SERVER[DOCUMENT_ROOT]/board/skin/$data[a_skinname]/view_main.php";
//						include_once "$_SERVER[DOCUMENT_ROOT]/board/skin/$data[a_skinname]/view_write_comment.php";
					} else if($mode=="pwchk"){
						include_once "$_SERVER[DOCUMENT_ROOT]/board/view_secret.php";
					}
				}
?>

<br />			
			
			
			    <!-- 본문끝 -->
			</td>
		  </tr>
<?
if($data[a_footer]){
	include "$dir/inc/{$data[a_footer]}";
}
?>
		</div>
	</div>


<? include "$dir/inc/bottom.php"; ?> 
</div>
</body>
</html>