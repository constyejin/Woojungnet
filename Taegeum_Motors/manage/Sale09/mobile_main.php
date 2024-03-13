<?
	include $_SERVER['DOCUMENT_ROOT'].'/manage/inc/header.php';
	include $_SERVER['DOCUMENT_ROOT'].'/manage/inc/top_menu.php';
	include $_SERVER['DOCUMENT_ROOT'].'/manage/inc/global.php';

$tr_height=30;

if($idx)
{
	if (!$connect) $connect=dbconn();
	$sql = "select * from home_main where idx = ".$idx;
	$r = mysql_query($sql,$connect)or die(mysql_error());
	$data_mo = mysql_fetch_assoc($r);
}
?>
<link href="/css/admin.css" rel="stylesheet" type="text/css" />


<form name="subMain" method="post" action="mobile_main_ok.php"  enctype="multipart/form-data">
<input type="hidden" name="qcommon" value="<?=$qcommon?>">
<input type="hidden" name="idx" value="<?=$data_mo["idx"]?>">
<table width="920"  cellspacing="0" border="1" bordercolor=#a0a0a0 align="center" style="border-collapse:collapse">
</table>
<table  width="1400"  cellspacing="0" border="1" bordercolor=#a0a0a0 align="center" style="border-collapse:collapse" class="table-style">
<colgroup>
	<col style="width:130px" />
</colgroup>
<tr>
	<td class="table-th" style="padding-left:10px;">노출</td>
	<td style="padding-left:10px;"><input type="radio" name="view" value="Y" <?if($data_mo[view]=="Y")echo "checked"?>> 노출 &nbsp;&nbsp;&nbsp;<input type="radio" name="view" value="N" <?if($data_mo[view]=="N")echo "checked"?>> 감춤</td>
</tr>
<tr>
	<td class="table-th" style="padding-left:10px;">정렬순서</td>
	<td style="padding-left:10px;"><table width="200" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="24"><input type="radio" name="list_num" value="1" <?if($data_mo[list_num]=="1")echo "checked";?>/></td>
        <td width="15"><span class="style4">1</span></td>
        <td width="23"><input type="radio" name="list_num" value="2" <?if($data_mo[list_num]=="2")echo "checked";?>/></td>
        <td width="16"><span class="style4">2</span></td>
        <td width="23"><input type="radio" name="list_num" value="3" <?if($data_mo[list_num]=="3")echo "checked";?>/></td>
        <td width="16"><span class="style4">3</span></td>
        <td width="22"><input type="radio" name="list_num" value="4" <?if($data_mo[list_num]=="4")echo "checked";?>/></td>
        <td width="17"><span class="style4">4</span></td>
        <td width="22"><input type="radio" name="list_num" value="5" <?if($data_mo[list_num]=="5")echo "checked";?>/></td>
        <td width="22"><span class="style4">5</span></td>
      </tr>
    </table></td>
</tr>
<tr>
	<td class="table-th" style="padding-left:10px;">이미지 파일</td>
	<td style="padding-left:10px;">
	<input type="file" name="imgfile" size="130">
	
      <span class="style3"> *  크기: 600 * 400  </span></td>
</tr>
<tr>
	<td class="table-th" style="padding-left:10px;">이미지 링크주소</td>
	<td style="padding-left:10px;"><input type="text" size="80" value="<?=$data_mo["imgurl"]?>" name="imgUrl"><span class="style3">ex)http://naver.com</span></td>
</tr>
<?if($data_mo["imgfile"]){?>
<tr>
	<td class="table-th" style="padding-left:10px;">현재 이미지</td>
	<td style="padding-left:10px;"><?=$data_mo["imgfile"]?> <input type="checkbox" name="fd" value="Y">삭제<br>
		<img src="/mainimg/<?=$data_mo["imgfile"]?>" width="800">	</td>
</tr>
<?}?>
<tr>
	<td height="30" colspan="2" align="center"><input type="submit" value="등록하기" class="button44 btn-red-sm"></td>
</tr>
</table><br /><br />
</form>

<table width="1400" cellspacing="0" border="1" bordercolor=#a0a0a0 align="center" style="border-collapse:collapse" class="table-style">
	<colgroup>
		<col style="width:75px"/>
		<col style="width:1200px"/>
		<col style="width:70px"/>
		<col style="width:103px"/>
	</colgroup>
<tr class="subject">
	<td class="table-th">정렬번호</td>
	<td class="table-th">이미지</td>
	<td class="table-th">노출</td>
	<td class="table-th">관리</td>
</tr>
<?
$sql="select * from home_main where type='2' order by list_num asc";
$result=mysql_query($sql);
while ($data=mysql_fetch_array($result)){

?>
<tr height=25 align=center onmouseover="this.bgColor='#F4FCFF'" onmouseout="this.bgColor=''">
<td height="25"><?=$data[list_num]?></td>
<td height="320"><img src="/mainimg/<?=$data[imgfile]?>" width="800"/></td>
<td><?=$data[view]?></td>
<td><a href="mobile_main.php?idx=<?=$data[idx]?>">수정</a> / <a href="home_main_del.php?idx=<?=$data[idx]?>">삭제</a></td>
</tr>
<?
}
?>
</table>
<p>&nbsp;</p>
<?foot();?>

<script>
function main_del_ok(a){
	if(confirm('정말 삭제하시겠습니까?')){
		location.href="home_main_del.php?idx="+a;
	}
}
</script>
