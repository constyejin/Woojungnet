<?
	include $_SERVER['DOCUMENT_ROOT'].'/manage/inc/header.php';
	include $_SERVER['DOCUMENT_ROOT'].'/manage/inc/top_menu.php';
	include $_SERVER['DOCUMENT_ROOT'].'/manage/inc/global.php';
	
	$view_article = 15; // 한화면에 나타날 게시물의 총 개수  
	if (!$page) $page = 1; // 현재 페이지 지정되지 않았을 경우 1로 지정  
	$start = ($page-1)*$view_article;  
	 
	$href = "&id=$id&Search_mode=$Search_mode&Search_text=$Search_text";  

	$where = " 1 ";		
	
	
	if($start_date && $end_date){		
		$where .= " and rdate >= '$start_date' and rdate <= '$end_date'";
	}
	if($start_date && !$end_date){
		$where .= " and rdate >= '$start_date' ";
	}
	if(!$start_date && $end_date){
		$where .= " and rdate <= '$end_date' ";
	}
	
	if($code){ 
		$where .= " and b.code='$code' ";  	 
	}
	 
	if($searchKey){ 
		$where .= " and ( name  like '%$searchKey%' or car_no   like '%$searchKey%') ";  
	}
	
	
	
	
	$info = Row_string("select count(*) as CNT from woojung_picture as a left join woojung_member as b on a.userIdx=b.idx where $where ");
	$total_article = $info[CNT]; // 현재 쿼리한 게시물의 총 개수를 구함	
	
	//echo "select count(*) as CNT from woojung_picture as a left join woojung_member as b on a.userIdx=b.idx where $where ";
?>	
<script>
	function search_form(){
		
		document.Search.submit();
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
			return false;
		}

		result = confirm("한번 삭제하신 자료는 복구 불가능 합니다 \n정말 삭제 하시겠습니까??");
		if(result){
			
			document.f.submit();
		}
		
	}	 
	
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
		
</script>
<style type="text/css">
	.style1 {color: #FFFFFF}
</style>


<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td height="30" align="left" class="title"><img src="/manage/img/icon02.gif">  
      <strong>사진추가</strong></td>
  </tr>
	<tr> 
    <td>
        <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="dadada" style="margin-bottom:10px;">
          <tr> 
            <td height="20" align="right" valign="middle" bgcolor="#FFFFFF">
		     			<input name="Search_text" type="text" id="Search_text" size="25" class="input0" style="height:20; padding-top:3px;" value="<?=$Search_text?>">
            </td>
            <td width="45" align="center" valign="middle" bgcolor="#FFFFFF">
              <input type="submit"  value="검색" class="button44" style="cursor:pointer; background-color:#e7f1f9; color:#084573; border:#636563 1px solid; padding:1 3 0 3; " />
            </td>
          </tr>
        </table>
   	</td>
  </tr>


  <tr> 
    <td><table width="100%" border="0" cellpadding="0" cellspacing="0" style="padding:3 0 0 0">
        <form name="Search" method="post" action="<?=$PHP_SELF?>">
			  <!--
		<tr> 
          <td height="30" align="right"><span style="padding-left:5px">
	
            <select name="code" onchange="document.Search.submit();" class="no">
              <option value="" >= 접수회원사 =</option>
			   <?
			   $com_sql=mysql_query("select * from recruit where 1 ");
			   while($com=mysql_fetch_array($com_sql)){
			   ?>
				   <option value="<?=$com["code"]?>" <?if($com["code"]==$code){ echo "selected"; }?>><?=$com["company"]?></option>
			   <?}?>
            </select>
			
            </span>
            <input type="text" name="searchKey" value="<?=$searchKey?>">&nbsp;</td>
          <td width="86" rowspan="2" align="center" bgcolor="#FFFFFF"><input type="submit" name="Submit222" value="조회" class="button33" style="height:20; width:60px cursor:pointer; background-color:#FFFFFF; color:#ff0000; border:#636563 1px solid; padding:2 3 3 5; font-weight:bold" onClick="javascript:search_form()"></td>
        </tr>
		-->
      </form>
      </table></td>
  </tr>
 
<iframe name="HiddenFrm" id="HiddenFrm" style="display:none;"></iframe>
  <form name="f" action="proc.php" method="post" onsubmit="return delete_member()" target="HiddenFrm">


  <tr> 
    <td>
	
        <input type="hidden" name="CarNo" value="<?=$CarNo?>">
        <input type="hidden" name="mode" value="delete">  
      
	    <table width="100%" border="0" cellspacing="1" cellpadding="0" class="list-table-standard">
          <tr align="center" class="sbtitle"> 
            <td class="table-th-dark" width="36" align="center"  > 
              <!-- 전체 선택 -->
            <input type="checkbox" name="allcheck" id="allcheck" onclick="all_check()" /> </td>
            <td class="table-th-dark" width="50" height="28" align="center"  >NO</td>
            <td class="table-th-dark" width="160" align="center" >등록일</td>
            <!--td width="126" align="center"  >접수회원사</td-->
            <td class="table-th-dark" width="97" align="center"  >신청자</td>
            <td class="table-th-dark" width="166" align="center" >회사</td>
            <td class="table-th-dark" width="127" align="center" >전화번호</td>
            <td class="table-th-dark" width="129" align="center" >휴대번호</td>
            <td class="table-th-dark" width="140" align="center">차량번호</td>
            <td class="table-th-dark" width="157" align="center" >사진</td>
          </tr>
		  <?
		  		if($total_article > 0){
				$Qry = "SELECT a.idx, a.rdate, a.tel, a.pcs,a.name,a.car_no,b.company,a.company as ac,a.sub_company FROM woojung_picture as a left join woojung_member as b on a.userIdx=b.idx WHERE $where order by a.rdate desc LIMIT $start, $view_article";

				//echo $Qry;
				$arr = Fetch_string($Qry);
				for($i=0;$i<count($arr);$i++){
				
			        $auct_sort_name = foreachlist($arr[$i][auct_sort],$auct_method_array) ;
			        $sale_type_name = foreachlist($arr[$i][sale_type],$sale_type_array) ;
				
		  ?>
          <!-- 반복되는 줄 시작 -->
          <tr align="center" style="cursor: hand; padding:3 0 0 0;" onmouseover="this.bgColor='#d9f3fb'" onmouseout="this.bgColor=''" >  
            <td ><input type="checkbox" name="check[]" id="check[]" value="<?=$arr[$i][idx]?>"  /></td>
            
            
            <td height="25"><?=$total_article-$i-(($page-1)*$view_article)?></td>
            <td><?=$arr[$i][rdate]?></td>
            <!--td><?=$arr[$i][company]?></td-->
            <td><?=$arr[$i][name]?></td>
            <td><?=$arr[$i][ac]?><?if($arr[$i][sub_company]){?>/<?}?><?=$arr[$i][sub_company]?></td>
            <td><?=$arr[$i][tel]?></td>
            <td><?=$arr[$i][pcs]?></td>
            <td><?=$arr[$i][car_no]?></td>
            <td><input type="button" name="button" value="이미지보기" class="button33333" onClick="window.open('FileUpload.php?idx=<?=$arr[$i][idx]?>','Upload','width=850, height=800,scrollbars=yes');" style="cursor:pointer; background-color:#FFFFFF; color:#084573; border:#636563 1px solid; padding:5 3 3 3; font-weight:bold"></td>
          </tr>
		   <? }} else { ?>
          <!-- 반복되는 줄 끝 -->
          <tr align="center" bgcolor="DCD8D6"> 
            <td height="38" colspan="10" align="center"><span class="style4">검색된 자료가 없습니다.</span></td>
          </tr><? } ?>
        </table>
    </td>
  </tr>


  <tr> 
    <td height="40" align="left"> 
<?if($loginUsort=="superadmin"){?>
	<input type="submit" name="Submit2222" value="선택삭제" class="button4444" style="cursor:pointer; background-color:#FFFFFF; border:1px #636563 solid; padding:5 3 3 3; font-weight:bold">
<?}?>
    </td>
  </tr>
  <tr> 
    <td colspan="2" align="center"> 
      <? include "../../inc/page.php";?>
      &nbsp;</td>
  </tr>
</table>
</form>
<? include_once "../inc/footer.php";?>
