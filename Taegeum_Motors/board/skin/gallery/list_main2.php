<?

$dbname=$id;
$bir="./skin/gallery";



if ($cookie_user_no) $member=mysql_fetch_array(mysql_query("select * from js_member where seq_num='$cookie_user_no'"));
# 관리자 / B2B 체크
if ($member[user_level]<=3&&$member[user_level]) $u_admin=true;
elseif ($member[user_level]==6) $u_b2b=true;
elseif ($member[user_level]==5) {
	$u_b2b=true;
	$u_b2bp=true;
}
if(!$_SESSION[login_level]){
	//로그인전 레벨세션이없으면 비회원 10으로 맞춰줌
	$_SESSION[login_level]=10;
}

$sql="select * from admin_table where a_name='$id'";
$result=mysql_query($sql);
$board=mysql_fetch_array($result);
$skinDir="/board/skin/".$data[a_skinname]."/";
$table_width="100%";



# 버튼설정
if (($_SESSION[login_level]<=$board[a_write_level]) || $u_admin) { //쓰기권한 설정
	$bwrite="<a href=\"$PHP_SELF?id=$id&act1=input&$addlink\"><img src=\"$iir/img/btn/btn_write.gif\" border=0 align=absmiddle></a>";
	$Bdel="<img src='$iir/img/btn/btn_delete2.gif' border=0 onclick=\"javascript:if (confirm('정말로 삭제하시겠습니까? 삭제시 복구는 불가능합니다.')) {location.href='$PHP_SELF?$qcommon&dno=$vno&act1=delete_ok'} \" style='cursor:hand' align=absmiddle>"; //삭제하기
	$Bedit="<img src=\"$iir/img/b_modify.gif\" border=0 align=absmiddle onclick='check_mod();' style='cursor:hand'>";
}



if ((($member[user_level]< $board[super_comp_level] )) || $u_admin) {
	$bmove="<input type=image src=\"$iir/img/b_move.gif\" border=0 style='vertical-align:top'>";
	$bdelete="<img src=\"$iir/img/btn/btn_delete2.gif\" onclick='allDel();' style='cursor:hand' align=absmiddle>";
	$allchk="<input type='checkbox' name='allchk' style='vertical-align:middle' style='border:solid 0' onclick='chkall()'>";
}


if (!$page) $page=1;

$dbname=$id;

if (!$nperpage) $nperpage=15;

if($board[a_skinname] == "gallery") $nperpage=20;


$nperblock=10;
$dataname="bu";


if (file_exists("$bir/addquery".$at.".php")) include "$bir/addquery".$at.".php";


if(eregi("[^[:space:]]+",$key)){
	$encoded_key=urlencode($key);
	$add[]="$keyfield like '%$key%'";
}


$addq[]="notice desc";
$addq[]="no desc";
$addq[]="ridx asc";
$addq[]="date desc";


// 쿼리추가
for ($i=0;$i<sizeof($add);$i++){
	if ($i==0) $addon="where ";
	else $addon.=" and ";
	$addon.=$add[$i];
}

// 순서추가
for ($i=0;$i<sizeof($addq);$i++){
	if ($i==0) $addon2="order by $addq[0]";
	else $addon2.=",".$addq[$i];
}



if (!$otrecord) {
$sql="select count(*) from $dbname $joinon $addon $groupck $addon2";
//echo $sql;
$result=mysql_query($sql) or die(mysql_error());
$trecord=mysql_result($result,0);
} else $trecord=$otrecord;

if(2<strlen($status) && $trecord > 0){$bwrite = '';}

$tpage = ceil($trecord/$nperpage); //전체페이지

// 출력 레코드 범위
if($trecord==0) {
	$first=1;
	$last=0;
} else {
	$first=$nperpage*($page-1);
	$last=$nperpage*$page;
}


${"sql_".$dataname}="select * from $dbname $joinon $addon $groupck $addon2 LIMIT $first, $nperpage";
//echo ${"sql_".$dataname};
// 엑셀 다운을 위한 쿼리 
$exlqry =  "select * from $dbname $joinon $addon $groupck $addon2 ";

${"result_".$dataname}=mysql_query(${"sql_".$dataname}) or die(mysql_error());

$article_num = $trecord - $nperpage*($page-1); //가상번호 설정

// 각 페이지로 직접 이동할 수 있는 페이지 링크에 대한 설정을 한다.
$tblock = ceil($tpage/$nperblock);
$block = ceil($page/$nperblock);

$first_page = ($block-1)*$nperblock;

$last_page = $block*$nperblock;

if($tblock <= $block) {
   $last_page = $tpage;
}

?>

<SCRIPT LANGUAGE="JavaScript">
<!--
function countwin(no,id,d){
	if(d == 'count') window.open("/board/dcmod.php?no="+no+"&id="+id+"&d="+d,"","left=200,top=50,height=200,width=300");
	else window.open("/board/dcmod.php?no="+no+"&id="+id+"&d="+d,"","left=200,top=50,height=200,width=300");
}
//-->
</SCRIPT>
<form name="frmdel" method="post" >
<input type="hidden" name="id" value="<?=$id?>">
<table width="630" border="0" cellspacing="0" cellpadding="0" id="Gall">
<col width="150"></col>
<col width="10"></col>
<col width="150"></col>
<col width="10"></col>
<col width="150"></col>
<col width="10"></col>
<col width="150"></col>
<tr>
<?

//include "$bir/list_top".$at.".php";
$gall_count = 1;
$row_list_cnt = 4;//table col cnt control
while (${$dataname}=mysql_fetch_array(${"result_".$dataname})){  //리스트 반복 시작

$mysubject=$bu['subject'];
$spacer = $bu['level'];

$event_start_date = date("Y-m-d",$bu['event_start_date']);
$event_end_date = date("Y-m-d",$bu['event_end_date']);



# 길이 제한
if (!$xidx){
$title_limit = 24;
$mysubject=cut_str($mysubject,$title_limit); 
$mysubject=str_replace($key,"<font color=#FF6600>".$key."</font>",$mysubject);
}

if ($spacer > 0) {
	$space="";
	for ($i=0;$i<$spacer;$i++) $space.="&nbsp;";
	$mysubject="$space<img src=\"$iir/img/icon/icon_Re.gif\" border=0 style='vertical-align:middle'> ".$mysubject;
}


# 원글에 대한 답변글이 $reply_indent 값 이상이 되면 답변글의 출력 indent를 고정시킨다.
if($spacer > $reply_indent) $spacer = $reply_indent;
   for($j = 0; $j < $spacer; $j++) {
      $mysubject="<img src=\"$iir/img/icon/icon_Re.gif\" border=0 style='vertical-align:middle'>".$mysubject;
   }
//if (($member[mLel1]<=$board[a_level]&&$MLel>=$board[a_Glevel])||$u_admin) { //읽기 권한설정
	
//new icon today -3day	

		$check_date = strtotime(date("Y-m-d")."-3 day");
		if($bu['date'] > $check_date){
			$new_icon_img = "<img src=\"/board/img/ico_new.gif\" border=0 style='vertical-align:middle'>";
		}else $new_icon_img = "";

		$mysubject="<a href='$PHP_SELF?id=$id&no=$bu[no]&mode=view'>$mysubject</a> {$new_icon_img}";
	
	
	$mylink="";
//} else {
//	$mysubject="<a href=\"javascript:alert('사용권한이 없습니다.');\">$mysubject</a>";
//	$mylink="<a href=\"javascript:alert('사용권한이 없습니다.');\">";
//}

if($u_admin || ($member[user_level]<$board[super_comp_level])){
	$bdate="<a href=\"javascript:countwin('$bu[no]','$id','date');\">".date("Y-m-d",$bu['date'])."</a>";
}else{
	$bdate=date("Y-m-d",$bu['date']);
}


$bname=$bu[name];
$bemail=$bu[email];
$file_name=explode(",",$bu[files]);
if($file_name[0]){ $gallery_img ="<a href='$PHP_SELF?id=$id&no=$bu[no]&mode=view'><img src='data/$id/$file_name[0]' width=\"170\" height=\"170\"  border=0 style='vertical-align:middle'></a>";
}else $gallery_img ="";
$Bmemo=trim(stripslashes($bu['memo']));



	if($u_admin || ($member[user_level]<$board[super_comp_level])){
		$bchk="<input type='checkbox' name='chk[]' id='chk[]' value='".$bu[no]."' style='vertical-align:middle'  style='border:solid 0'>";
	}else $bchk="";


if($u_admin || ($member[user_level]<$board[super_comp_level])){
	$bref="<a href=\"javascript:countwin('$bu[no]','$id','count');\">".$bu['ref']."</a>";
}else $bref=$bu['ref'];
if ($bu[security]) $bsecurity="<img src='$iir/img/secret.gif' border=0 style='vertical-align:middle'>";
else $bsecurity="";

if ($bu[notice]) { 
	$bnumber='<span style="font-weight: bold">공지</span>';
	$list_bg = "#F7F7F7";
} else {
	$bnumber=$article_num;
	$list_bg = "";
}
$article_num--;
?>


<?

include "list_main3".$at.".php";

$gall_count ++;
$ii++;
}

$k=($gall_count-1)%4;
while($k%4!=0){
	echo "<td></td><td></td>";
	$k++;
}

?>
<tr>
  <td height="10" colspan="7"></td>
</tr>
</tr>
</table>
<table width="98%" border="0" cellspacing="0" cellpadding="0" style="border-top:1px solid #907c74;">
<tr>
    <td width="20%" height="40" align="left">
<?
if($_SESSION["login_level"]=="1"){
?>
	<img src="../board/img/btn/btn_delete2.gif" class="imgbt1" onclick="allDel()" style="cursor:pointer;"/>
<?
}
?>
	</td>
    <td width="60%" align="center"><?list_number();?></td>
    <td width="20%" align="right">
<?
if($_SESSION["login_level"]=="1"){
?>
	<img src="../board/img/btn/btn_write.gif" class="imgbt1" onclick="location.href='<?=$_SERVER['PHP_SELF']?>?mode=write&id=<?=$id?>'" style="cursor:pointer;"/>
<?
}
?>
	</td>
</tr>
</table>
</form>

<?
//echo $bir;
//include "$bir/list_footer2.php";


?>


<script>
function allDel(){
	var fobj = document.frmdel;
	var obj = document.getElementsByName('chk[]');
	var k=0;
	for(var i=0; i < obj.length ; i++){
		if (obj[i].checked == true) {
			k++;
			break;
		}
	}

	if(k > 0){
		if(confirm("선택된 게시물들을 모두 삭제 하시겠습니까?")){
			fobj.action = "alldel.php";
			fobj.submit();
		}
		return false;
	}else{
		alert("선택된 게시물이 없습니다.");
		return false;
	}
}
</script>
