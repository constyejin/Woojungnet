<? 	
	include $_SERVER['DOCUMENT_ROOT'].'/manage/inc/header.php';
	include $_SERVER['DOCUMENT_ROOT'].'/manage/inc/top_menu.php';
	include $_SERVER['DOCUMENT_ROOT'].'/manage/inc/global.php';
	
?>
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

		result = confirm("한번 삭제하신 자료는 복구 불가능 합니다.\n\n(페차,손상,특수,낙찰대장,감정 등의 정보까지 모두 삭제 됨)   \n\n정말 삭제 하시겠습니까??");
		if(result){
			
			document.f.submit();
		}
		
	}
</script>
<style type="text/css">
  .style1 {color: #FFFFFF}
</style>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="30" align="left" class="title"><img src="/manage/img/icon02.gif"> <strong>차량상담</strong></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellpadding="0" cellspacing="0" style="padding:3 0 0 0">
      <form action="<?=$PHP_SELF?>" method="get" name="Search" id="Search">
        <tr>
          <td height="30" align="right"><span style="padding-left:5px">
		  <!--
            <select name="code" size="1" onchange="document.Search.submit();"align="absmiddle">
              <option value="">====접수회원사====</option>
			   <?
			   $com_sql=mysql_query("select * from recruit where 1 ");
			   while($com=mysql_fetch_array($com_sql)){
			   ?>
				   <option value="<?=$com["code"]?>" <?if($com["code"]==$code){ echo "selected"; }?>><?=$com["company"]?></option>
			   <?}?>
            </select>
			-->
            <select name="sear" onchange="document.Search.submit();" class="no">
              <option value="" >=== 상태 ===</option>
              <option value="신규접수" <?if($sear=="신규접수") echo "selected";?>>신규접수</option>
              <option value="상담완료" <?if($sear=="상담완료") echo "selected";?>>상담완료</option>
            </select>
            </span>
            <input type="text" name="searchKey" value="<?=$searchKey?>" /></td>
          <td width="45" rowspan="2" align="center" bgcolor="#FFFFFF"><input type="submit" name="Submit222" value="검색" class="button33" style="cursor:pointer; background-color:#e7f1f9; color:#084573; border:#636563 1px solid; padding:1 3 0 3;" onclick="javascript:search_form()" /></td>
        </tr>
      </form>
    </table></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="1" cellpadding="0" class="list-table-standard">
      <colgroup>
        <col style="width:36px;" />
        <col style="width:55px;" />
        <col style="width:105px;" />
        <col style="width:141px;" />
        <col style="width:114px;" />
        <col style="width:125px;" />
        <col style="width:118px;" />
        <col style="width:127px;" />
        <col style="width:139px;" />
        <col style="width:145px;" />
      </colgroup>
        <form name="f" action="proc.php" method="post">
        <input type="hidden" name="mode" value="alldelete">
		    <input type="hidden" name="qcommon" value="page=">
        <tr align="center" class="sbtitle">
          <td class="table-th-dark"><input type="checkbox" name="allcheck" id="allcheck" onClick="all_check()" /> </td>
          <td class="table-th-dark">NO</td>
          <td class="table-th-dark">등록일</td>
          <!--td width="82">접수회원사</td-->
          <td class="table-th-dark">상담유형</td>
          <td class="table-th-dark">이름</td>
          <td class="table-th-dark">연락처</td>
          <td class="table-th-dark">차량번호</td>
          <td class="table-th-dark">보관장소</td>
          <td class="table-th-dark">이메일</td>
			    <td class="table-th-dark">진행상태</td>
        </tr>
		<?
		if(!$page)$page=1;
		$view_article=15;
		$start=($page-1)*$view_article;
		$href="&sear=$sear&searchKey=$searchKey";
		$wh=" 1 ";

		if($sear){
			$wh .= " and wcj_type = '$sear' ";
		}
		if($code){  		 
			$wh .= " and b.code  = '$code'";  
		}
		if($searchKey){
			$wh .= " and (wc_mem_name like '%$searchKey%' or wc_mem_phone like '%$searchKey%' or wc_mem_etc like '%$searchKey%' or wc_model like '%$searchKey%' or wc_model2 like '%$searchKey%') ";
		}

		$query = "SELECT count(*) FROM woojung_car_q as a left join woojung_member as b on a.wc_mem_idx=b.idx where $wh ";
		$result = mysql_query($query, $connect);  
		$temp = mysql_fetch_array($result);  
		$total_article = $temp[0]; // 현재 쿼리한 게시물의 총 개수를 구함
		if($total_article > 0){

		$Qry = mysql_query("SELECT * FROM woojung_car_q as a left join woojung_member as b on a.wc_mem_idx=b.idx where $wh order by wc_idx  desc LIMIT $start, $view_article");
		$num=$total_article-$start;
		while($row=mysql_fetch_array($Qry)){
			if($row[sal_state]=="Y"){
				$sal_state="처리완료";
			} else {
				$sal_state="미처리";
			}
		?>
        <tr align="center" bgcolor="<?=$bgCol?>" style="cursor: hand; padding:3 0 0 0;" onmouseover="this.bgColor='#d9f3fb'" onmouseout="this.bgColor=''" > 
          <td height="25"><input type="checkbox" name="check[]" id="check[]" value="<?=$row[wc_idx]?>" />
			<input type="hidden" name="checkout[]" id="checkout[]" value="<?=$row[wc_idx]?>" /></td>
          <td><?=$num?></td>
          <td class="hand" onclick="location.href='view.php?wc_idx=<?=$row[wc_idx]?>'"><?=substr($row[wc_regdate],0,10)?></td>
          <!--td class="hand" onclick="location.href='view.php?wc_idx=<?=$row[wc_idx]?>'"><?=$row[company]?></td-->
          <td onclick="location.href='view.php?wc_idx=<?=$row[wc_idx]?>'" class="hand"><?=$row[calltype]?></td>
          <td onclick="location.href='view.php?wc_idx=<?=$row[wc_idx]?>'" class="hand"><?=$row[wc_mem_name]?></td>
          <td onclick="location.href='view.php?wc_idx=<?=$row[wc_idx]?>'" class="hand"><?=$row[wc_mem_phone]?></a></td>
          <td onclick="location.href='view.php?wc_idx=<?=$row[wc_idx]?>'" class="hand"><?=$row[wc_model]?></td>
          <td onclick="location.href='view.php?wc_idx=<?=$row[wc_idx]?>'" class="hand"><?=$row[wc_model2]?></td>
          <td onclick="location.href='view.php?wc_idx=<?=$row[wc_idx]?>'" class="hand"><?=$row[wc_mem_etc]?></td>
          <td valign="middle" class="hand" onclick="goUrl('#');"><span style="padding-left:5px">
            <select name="wcj_type" onchange="location.href='update.php?wc_idx=<?=$row[wc_idx]?>&wcj_type='+this.value;" class="no">
              <option value="" >=== 상태 ===</option>
              <option value="신규접수" <?if($row[wcj_type]=="신규접수") echo "selected";?>>신규접수</option>
              <option value="상담완료" <?if($row[wcj_type]=="상담완료") echo "selected";?>>상담완료</option>
            </select>
          </span></td>
        </tr>
		<?
			$num--;
			}
		}
		?>
        </form>
        
    </table></td>
  </tr>
  
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="left" style="padding-bottom:5px">
<?if($loginUsort=="superadmin"){?>
	<input type="button" name="" value="선택삭제" class="button44" onClick="javascript:delete_member()" style="cursor:pointer; background-color:#FFFFFF; border:1px #636563 solid; padding:5 3 3 3; font-weight:bold">
<?}?>
	</td>
  </tr>
  <tr>
    <td><table width=100% border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td align=center >  <? include "../../inc/page.php";?> </td>
        </tr>
      </table></td>
  </tr>
</table>
<? include_once "../inc/footer.php";?>
