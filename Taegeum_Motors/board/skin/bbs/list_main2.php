
<?
if(basename(__FILE__)==basename($_SERVER["PHP_SELF"])) die(__FILE__." ....");

if($_POST["search"] && $_POST["board_field"]){
	if($_POST["board_field"]=="date"){
		$where = " and from_unixtime(date,'%Y%m%d') like '%".$_POST["search"]."%' ";
	} else {
		$where = " and ".$_POST["board_field"]." like '%".$_POST["search"]."%'";
	}
}
?>

<?

$notice_qry=mysql_query("select * from $id where bdiv='0' and notice='Y' $where ORDER by list desc,ridx asc limit 3");
$notice_cnt=0;
while($notice_row=mysql_fetch_array($notice_qry)){
	$mem_qry = "  select * from woojung_member where idx='$notice_row[midx]' ";
	$mem_re = mysql_query($mem_qry) or die(mysql_error());
	$mem_info = mysql_fetch_array($mem_re);
?>

	<tr align="center" height="50px">
		<td class="left" >
		<?if($_SESSION[login_level]<=3){?>
		<input type='checkbox' name='chk[]' class="Chk" value="<?=$notice_row["no"]?>">
		<? } ?>
		</td>
		<td  style="font-size:15px;"><font color="red">공지</font></td>
		<td class="a_left" style="font-size:15px;"><?=$reply_gubun?>
		<a href="<?=$_SERVER['PHP_SELF']?>?id=<?=$id?>&mode=view&no=<?=$notice_row["no"]?>"><?=$notice_row["subject"]?></a></td>
		<td  style="font-size:15px;"><?=cut_str($mem_info[userNick],7)?></td>
		<td  style="font-size:15px;"><?=date("Y-m-d",$notice_row["date"])?></font></td>
		<td class="right" style="font-size:15px;"><font color='#545454'><?=$notice_row["ref"]?></font></td>
	</tr>
<?
$notice_cnt++;
}
?>
<?

if (!$page) $page=1; //초기 페이지 설정
$nperpage=20-$notice_cnt;
$nperblock=10;

$sql = "  select * from $id where bdiv='0' and notice!='Y' $where";
$result=@mysql_query($sql);
$trecord=@mysql_num_rows($result);
$tpage = ceil($trecord/$nperpage); //전체페이지
// 출력 레코드 범위
if($trecord==0) {
	$first=1;
	$last=0;
} else {
	$first=$nperpage*($page-1);
	$last=$nperpage*$page;
}
$p_qry = "  select * from $id where bdiv='0' and notice!='Y' $where ORDER by list desc,ridx asc LIMIT $first, $nperpage";
$p_res = mysql_query($p_qry) or die(mysql_error());
$num_row = mysql_num_rows($p_res);

$article_num = $trecord - $nperpage*($page-1); //가상번호 설정
// 각 페이지로 직접 이동할 수 있는 페이지 링크에 대한 설정을 한다.
$tblock = ceil($tpage/$nperblock);
$block = ceil($page/$nperblock);
$first_page = ($block-1)*$nperblock;
$last_page = $block*$nperblock;
if($tblock <= $block) {
   $last_page = $tpage;
}
if(!($num_row+$notice_cnt)){
?>
	<tr height="30px"> 
        <td colspan="15" align="center">게시글이 없습니다. </td>
    </tr>
<?
}else{
	$i=1;
	while($list = mysql_fetch_array($p_res)){
		$d_no=$list["no"]; //게시물고유번호
		$d_memo=$list["memo"]; //내용
		$d_name=$list["name"]; //작성자
		$d_subject=$list["subject"]; //제목
		$d_pwd=$list["pwd"]; //비밀번호
		$d_date=$list["date"]; //time()값
		$d_ref=$list["ref"]; //조회
		$d_list=$list["list"]; //게시물등록순서 / 등록시 max(no)+1
		$d_level=$list["level"]; // 0 - 원글 / 1 - 답글
		$d_ridx=$list["ridx"]; // 0 - 원글 / 1 - 답글
		$d_email=$list["email"]; // 이메일
		$d_userno=$list["midx"]; // 0 - ? / 2 - ?
		$d_html=$list["html"]; //html구분
		$d_security=$list["security"]; //비밀설정 Y,N
		$d_notice=$list["notice"]; //공지사항설정 Y,N
		$d_files=$list["files"]; 
		$d_files2=$list["files2"];

		$subject=cut_str(strip_tags($d_subject),57);

		$newdate=time()-60*60*24*1;
		if ($newdate < $d_date) $outnew="&nbsp; <img src='/board/img/ico_new.gif' border=0 style='vertical-align:middle'>";
		else $outnew="";
		if($d_security=="Y"){
			$icon_sec="<img src='/board/img/secret.gif' border='0'>";
			if($u_admin){
				$passed="";
			} elseif($cookie_user_no==$d_userno) {
				$passed="";
			} else {
				$passed="pwview";
			}
		} else {
			$icon_sec="";
			$passed="";
		}
		$number=$article_num--;
		if($d_ridx==1){
/*			if($u_admin){
				$passed="";
			} else {
				$passed="pwview";
			} */
			$reply_gubun=" &nbsp;<img src='".$skinDir."img/re.gif' border=0 style='vertical-align:middle'> ";
		} else {
			$reply_gubun="";
		}

		if($d_files){
			$dfiles="<img src='/board/img/ico_file.gif' border='0'>";
		}else{
			$dfiles="";
		}

		$qry_board = "select * from admin_table where a_name='$id' ";
		$res_board = mysql_query($qry_board) or die(mysql_error());
		$data_board = mysql_fetch_array($res_board);
		
		$mem_qry = "  select * from woojung_member where idx='$list[midx]' ";
		$mem_re = mysql_query($mem_qry) or die(mysql_error());
		$mem_info = mysql_fetch_array($mem_re);
?>
	<tr height="50px">
		<td class="left">
		<?if($_SESSION[login_level]<=3){?>
		<input type='checkbox' name='chk[]' class="Chk" value="<?=$d_no?>">
		<? } ?>
		</td>
		<td  style="font-size:15px;"><?=$number?></td>
		<td class="a_left" style="font-size:15px;"><?=$reply_gubun?>
<?
	if($_SESSION[login_level]<=$data_board[a_level]){
?>
		<a href="<?=$_SERVER['PHP_SELF']?>?id=<?=$id?>&mode=view&no=<?=$d_no?>&passed=<?=$passed?>"><?=$subject?></a>
<?
	}else{
?>
		<a href="javascript:alert('열람할 권한이 없습니다');"><?=$subject?></a>
<?
	}
?>
		&nbsp;<?=$dfiles?>&nbsp;<?=$outnew?>&nbsp;<?=$icon_sec?></td>
		<td  style="font-size:15px;"><?=cut_str($mem_info[userNick],7)?></td>
		<td  style="font-size:15px;"><?=date("Y-m-d",$d_date)?></td>
		<td class="right" style="font-size:15px;"><?=$d_ref?></td>
	</tr>
<?
	$i++;}
}
?>
</table>
<br />
<table width="96%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr> 
		<td align="left" width="33%">
			<?if($_SESSION[login_level]<=3){?>
				<!--<img src="../board/img/btn/btn_delete2.gif" border=0 onclick="allDel()"  style="cursor:pointer;">-->
				<a href="javascript:void(0)" onclick="allDel()" style="display:inline-flex; justify-content: center; align-items:center;border: 2px solid #000000; border-radius: 20px; min-width: 80px; height: 32px;font-size: 12px;font-weight: 600;color:#000000; ">
					선택삭제
				</a>
			<?}?>
		</td>
        <td align="center" width="33%"><CENTER><?list_number();?></CENTER></td>
        <td align="right"  width="33%;">
			<?
			if($data[a_write_level]>=$_SESSION[login_level]){
				?>
				<?=$a_insert ?><span style="display:inline-flex; justify-content: center; align-items:center;border: 2px solid #cc3535; border-radius: 20px; min-width: 80px; height: 32px;font-size: 12px;font-weight: 600;color:#cc3535; ">글쓰기</span></a>
			<?
			}
			?>
		</td>
    </tr>
</table>

<input type="hidden" name="id" value="<?=$id?>">
<input type="hidden" name="url" value="id=<?=$id?>&page=<?=$_GET[page]?>&board_field=<?=$board_field?>&key=<?=$key?>">

</form>

<?
function list_number(){

global $page,$qcommon,$first_page,$nperblock,$direct_page,$block,$last_page,$tblock,$tpage;

// 첫번째 블록에 대한 링크
if($block > 1 && $tblock>2) {
   echo "<a href=\"$PHP_SELF?$qcommon&page=1\" onMouseOver=\"status='load previous $nperblock pages';return true;\" onMouseOut=\"status=''\"><font color='#976302'>◀처음|</font></a>&nbsp;&nbsp;&nbsp;";
} 


// 이전블록에 대한 링크
if($block > 1) {
	$imsi=$page;
   $page = $first_page;
   echo "<a href=\"$PHP_SELF?$qcommon&page=$page\" onMouseOver=\"status='load previous $nperblock pages';return true;\" onMouseOut=\"status=''\">[이전]</a>&nbsp;&nbsp;&nbsp;";
   $page=$imsi;
} 

// 페이지이동(블록내)

for($direct_page = $first_page+1; $direct_page <= $last_page; $direct_page++) {
   if($page == $direct_page) {
      echo "<FONT SIZE=3 COLOR=red>$direct_page</FONT>";
   } else {
      echo "<a href=\"$PHP_SELF?$qcommon&page=$direct_page\" onMouseOver=\"status='jump to page $direct_page';return true;\" onMouseOut=\"status=''\">[$direct_page]</a>";
   }
}
//$list_bottom=str_replace("[number]",$tmp_list_bottom,$list_bottom);


// 다음블록에 대한 링크

if($block < $tblock) {
   $page = $last_page+1;
   echo "&nbsp;&nbsp;&nbsp;<a href=\"$PHP_SELF?$qcommon&page=$page\" onMouseOver=\"status='load next $nperblock pages';return true;\" onMouseOut=\"status=''\">[다음]</a>";
} 

//마지막 블록에 대한 링크
if($block < $tblock && $tblock>2) {
$final_page=($tblock*10)-9;
 echo "&nbsp;&nbsp;&nbsp;<a href=\"$PHP_SELF?$qcommon&page=$final_page\" onMouseOver=\"status='load next $nperblock pages';return true;\" onMouseOut=\"status=''\"><font color='#976302'>|마지막▶</font></a>";
}

}
?>