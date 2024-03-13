<?
	include $_SERVER['DOCUMENT_ROOT'].'/manage/inc/header.php';
	include $_SERVER['DOCUMENT_ROOT'].'/manage/inc/top_menu.php';
	include $_SERVER['DOCUMENT_ROOT'].'/manage/inc/global.php';

	$tb_name = "admin_log";
	$view_article = 15; // 한화면에 나타날 게시물의 총 개수  
	if (!$page) $page = 1; // 현재 페이지 지정되지 않았을 경우 1로 지정  
	$start = ($page-1)*$view_article; 


	$s_date = date("Y-m-d",strtotime(date("Y-m-d") . " -30 day"));
	$where = " regdate > '$s_date' ";

	$query = "select count(*) from $tb_name where $where ";  
	$result = mysql_query($query, $connect);  
	$temp = mysql_fetch_array($result);  
	$total_article = $temp[0]; // 현재 쿼리한 게시물의 총 개수를 구함

?>
<style>
  .table-topper{
    text-align:right;
    margin-bottom: 10px;
  }
</style>
<script>
	function all_check(){
		var lng =  document.getElementsByName('check[]');
		if(document.f.allcheck.checked == true){
			for(i=0;i<lng.length;i++){
				lng[i].checked = true;
			}
		} else {
			for(i=0;i<lng.length;i++){
				lng[i].checked = false;
			}
		}
	}
	function delete_member(){
		var j=0;
		var obj = document.getElementsByName('check[]');
		for(var i=0;i < obj.length ; i++){
			if(obj[i].checked == true){
				j++;
				break;
			}
		}
		if(j == 0){
			alert("선택된 자료가 없습니다.");
			return;
		}
		result = confirm("한번 삭제하신 자료는 복구 불가능 합니다.\n정말 삭제 하시겠습니까??");
		if(result){
			document.f.submit();
		}
	}
	function exl_down(){
		f=document.f;
		f.action="exldown.php";
		f.submit();
		f.action="proc.php";
	}
</script>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td height="30" align="left" class="title"><img src="/manage/img/icon02.gif" class="bullet"> 
      관리자접속정보</td>
  </tr>
  <tr> 
    <td>&nbsp;</td>
  </tr>
  <tr> 
    <td align="center">
      <div class="table-topper">
        <img src="../img/btnl_excel.gif" onclick="exl_down();" style="cursor:pointer;">
      </div>
      <table width="100%" border="0" cellspacing="1" cellpadding="0" style="word-break:break-all;" class="list-table-standard">
      <colgroup>
        <col style="width:80px"/>
        <col style="width:10%"/>
        <col style="min-width:15%"/>
        <col style="min-width:15%"/>
        <col style="min-width:15%"/>
        <col style="min-width:15%"/>
      </colgroup>
<iframe name="HiddenFrm" id="HiddenFrm" style="display:none;"></iframe>
<form name="f" action="proc.php" method="post" target="HiddenFrm">
<input type="hidden" name="mode" value="delete">
      <tr align="center" class="sbtitle">
        <td class="table-th-dark" background="/admin/img/titlebg01.gif" >
		<? if($_SESSION["login_id"]=="drg1038"){ ?>
        <input type="checkbox" name="allcheck" id="allcheck" onclick="all_check()" />
		<? } ?>
		</td>
        <td class="table-th-dark">NO</td>
        <td class="table-th-dark">IP</td>
        <td class="table-th-dark">접속일자</td>
        <td class="table-th-dark">아이디</td>
        <td class="table-th-dark">이름</td>
        </tr>
<?
if($total_article > 0){

	$qry = "SELECT * FROM $tb_name WHERE $where order by idx desc LIMIT $start, $view_article";
	$arr = Fetch_string($qry);
	for($i=0;$i<count($arr);$i++){	
?>
      <tr align="center" bgcolor="<?=$bgCol?>" style="cursor: pointer; padding:3 0 0 0;" onmouseover="this.bgColor='#d9f3fb'" onmouseout="this.bgColor=''" >
        <td bgcolor="<?=$bgCol?>" >
		<? if($_SESSION["login_id"]=="drg1038"){ ?>
		<input type="checkbox" name="check[]" id="check[]" value="<?=$arr[$i][idx]?>" />
		<? } ?>
		</td>
        <td height="25" bgcolor="<?=$bgCol?>"><?=$total_article-$i-(($page-1)*$view_article)?></td>
        <td bgcolor="<?=$bgCol?>" class="hand" ><?=$arr[$i][ip]?></td>
        <td bgcolor="<?=$bgCol?>" class="hand" ><?=$arr[$i][regdate]?></td>
        <td bgcolor="<?=$bgCol?>" class="hand" ><?=$arr[$i][userId]?></td>
        <td align="center" bgcolor="<?=$bgCol?>" class="hand" ><?=$arr[$i][userName]?></td>
      </tr>
<?
	}
}
?>
</form>
      <!-- 반복되는 줄 끝 -->
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="left" style="padding-bottom:5px">
		<? if($_SESSION["login_id"]=="drg1038"){ ?>
		<input type="button" value="선택삭제" class="button44" onclick="javascript:delete_member()" style="cursor:pointer; background-color:#FFFFFF; border:1px #636563 solid; padding:5 3 3 3; font-weight:bold">
		<? } ?>
	</td>
  </tr>
  <tr>
    <td align="center"><? include "../../inc/page.php";?>
      &nbsp;</td>
  </tr>
</table>

<? include_once "../inc/footer.php";?>
