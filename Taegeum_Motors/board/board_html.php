<? include $_SERVER['DOCUMENT_ROOT']."/inc/header_html.php"; ?> 
<? 

$dir=$_SERVER['DOCUMENT_ROOT'];
$id=$_GET[id];

function cut_str($msg,$cut_size,$dot=true) {
	if($cut_size<=0) return $msg;
	if ($dot) $odot="...";
	else $odot="";
	if(preg_match("/\[RE\]/",$msg)) $cut_size=$cut_size+4;
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

$sql="select * from admin_table where a_name='$id'";
$result=mysql_query($sql);
$data=mysql_fetch_array($result);

?>
<style type="text/css">  
a:hover { 
	color: #2F81CE; ;
}  
</style>
<div id="contents_basic">
    <!-- 1:자동차리스트 -->
    <div class="co_car_all">
			<div class="sub-visual">
				<div class="sub-text">
					<p class="catch-phrase">
						고객센터
					</p>
					<p class="description-text">
						공정하고 투명하며 신속, 정확한 정보를 제공합니다.
					</p>
				</div>
			</div>
<?
if($id=="notice"){
 $class1 ="class='on'";
}else if($id=="qna"){
 $class2 ="class='on'";
}else if($id=="data"){
 $class3 ="class='on'";
}else if($id=="news"){
 $class4 ="class='on'"; 
}

?>			
			  <div class="join_img_head" style="margin-top:0;" align="center">
					<div class="tab_type01">
						<ul>
							<li <?=$class1?>><a href="/board/board.php?id=notice"><span>공지사항</span></a></li>
							<li <?=$class2?>><a href="/board/board.php?id=qna"><span>질문과답변(Q&A)</span></a></li>
							<li <?=$class3?>><a href="/board/board.php?id=data"><span>자료실</span></a></li>
							<li <?=$class4?>><a href="/board/board.php?id=news"><span>자동차정보</span></a></li>
							<li><a href="/sub01/sub01_3.php"><span>차량상담</span></a></li>
						</ul>
			
<?

if($_SESSION[login_level]=="1"){$u_admin=true;}
if(!$_SESSION[login_level]){
	//로그인전 레벨세션이없으면 비회원 10으로 맞춰줌
	$_SESSION[login_level]=10;
}

$skinDir="/board/skin/".$data[a_skinname]."/";
$table_width="100%";
?> 

                <!-- sub title -->
<?
	if($data[a_header]){
?>
		<div class="Tit"><img src="<?=$data[a_header]?>" /></div>
					
<? } ?>

			
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
		if($passwChk[midx]==$cookie_user_no){
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


<?
include "$dir/inc/bottom.php";
?> 
</div>
</body>
</html>