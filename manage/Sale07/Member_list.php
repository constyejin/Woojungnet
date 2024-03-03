<?
	include $_SERVER['DOCUMENT_ROOT'].'/manage/inc/header.php';
	include $_SERVER['DOCUMENT_ROOT'].'/manage/inc/top_menu.php';
	include $_SERVER['DOCUMENT_ROOT'].'/manage/inc/global.php';
	
	if($loginUsort != "superadmin" && $loginUsort != "admin" && $loginUsort != "admin1" && $loginUsort != "admin2" ){
		movepage("/index.php", "권한이 없습니다.");
		MsgMov("권한이 없습니다.","/index.php");
		exit;
	}

	$tb_name = "woojung_member";
	$view_article = 15; // 한화면에 나타날 게시물의 총 개수  
	if (!$page) $page = 1; // 현재 페이지 지정되지 않았을 경우 1로 지정  
	$start = ($page-1)*$view_article; 
	 
	$href = "&Search_mode=$Search_mode&Search_text=$Search_text&list_sort=$list_sort&upjong=$upjong";  
	$href1 = "&page=$page".$href;

	$where = " userId!='drg1038' ";	

	if($loginId!="drg1038"){
		$where .= " and usort!='superadmin' ";
	}

	if($loginUsort == "admin"){
		$where .= " and usort!='admin' and usort!='admin1' and usort!='admin2' ";
	}

	if($loginUsort == "admin1"){
		$where .= " and usort!='admin1' and usort!='admin2' ";
	}

	if($loginUsort == "admin2"){
		$where .= " and usort!='admin2' ";
	}

	if($code ){
		$where .= " AND code = '$code' ";
	} 

	if($list_sort == 'company'){
		$where .= " AND left(usort,4) = 'comp' ";
	} 

	if($list_sort == 'premium'){
		$where .= " AND left(usort,4) = 'prem' ";
	}


	if($list_sort == 'company1'){
		$where .= " AND usort = 'company1'";
	} 
	if($list_sort == 'company2'){
		$where .= " AND usort = 'company2'";
	} 

	if($reco_id){
		$where .= " AND reco_id = '".$reco_id."'";
	}


	if($list_sort == 'premium1'){
		$where .= " AND usort = 'premium1' ";
	}
	if($list_sort == 'premium2'){
		$where .= " AND usort = 'premium2' ";
	}
	if($list_sort == 'premium3'){
		$where .= " AND usort = 'premium3' ";
	}
	if($list_sort == 'premium4'){
		$where .= " AND usort = 'premium4' ";
	}
	if($list_sort == 'jisajang'){
		$where .= " AND usort = 'jisajang' ";
	}
	if($list_sort == 'jisajang2'){
		$where .= " AND usort = 'jisajang2' ";
	}





	if($list_sort == 'indi'){
		$where .= " AND usort='$list_sort' ";
	}
	if($list_sort == 'admin'||$list_sort == 'admin1'||$list_sort == 'admin2'||$list_sort == 'admin3'){
		$where .= " AND usort='$list_sort' ";
	}
	if($list_sort == 'superadmin'){
		$where .= " AND usort='$list_sort' ";
	}



	if($upjong == '폐차업자'){
		$where .= " AND upjong='$upjong' ";
	}
	if($upjong == '자동차정비'){
		$where .= " AND upjong='$upjong' ";
	}
	if($upjong == '중고부품업'){
		$where .= " AND upjong='$upjong' ";
	}
	if($upjong == '자동차무역'){
		$where .= " AND upjong='$upjong' ";
	}
	if($upjong == '매매상사'){
		$where .= " AND upjong='$upjong' ";
	}
	if($upjong == '딜러'){
		$where .= " AND upjong='$upjong' ";
	}
	if($upjong == '기타'){
		$where .= " AND upjong='$upjong' ";
	}

//	$where .= " AND userId!='drg1038' ";

	 
	// 검색 단어를 입력했을때   
	if($Search_text){  		
		$tmp1 = "name";  
		$tmp2 = "userNick";  
		$tmp3 = "ssn";  
		$tmp4 = "tel"; 
		$tmp5 = "pcs";  
		$tmp6 = "company_name"; 
	
		$where .= " and ( ($tmp1 like '%$Search_text%') or ($tmp2 like '%$Search_text%') or ($tmp3 like '%$Search_text%') or ($tmp4 like '%$Search_text%') or ($tmp5 like '%$Search_text%') or ($tmp6 like '%$Search_text%') ) ";  		
	}  
	

   // if(!$list_sort) {
		$where .= " ORDER BY idx DESC";
	//}








	$query = "select count(*) from $tb_name where $where ";  

	
	$result = mysql_query($query, $connect);  
	$temp = mysql_fetch_array($result);  
	$total_article = $temp[0]; // 현재 쿼리한 게시물의 총 개수를 구함




	function unixDateTime($var, $t)
	{

			$unix = "";
			if($var){
				//list($date, $time) = explode(" ", $var);
				list($year, $month, $day) = explode("-", $var);
				//echo $year."//". $month."//".$day."<BR>";

				if($t == "s"){
					$unix = mktime(0, 0, 0, $month, $day, $year);
				}else{
					$unix = mktime(23, 59, 59, $month, $day, $year);
				}
			}
			return $unix;
	}



?>
<script>
	
	function all_check(){
		var ff = document.f;
		if(document.f.allcheck.checked == true){
			for(i=0;i<30;i++){
				ff[i].checked = true;
			}
		} else {
			for(i=0;i<30;i++){
				ff[i].checked = false;
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
			alert("선택된 회원이 없습니다.");
			return;
		}

		result = confirm("한번 삭제하신 회원은 복구 불가능 합니다 \n\n정말 삭제 하시겠습니까??");
		if(result){
			document.f.action = "proc.php?Mode=member_delete";
			document.f.submit();
		}
		
	}
	
</script>

<script>
	function listsort(){
		document.list.submit();
	}
</script>

<script>
	function upjongs(){
		document.list.submit();
	}
</script>
<style type="text/css">

.style1 {color: #FFFFFF}

</style>


<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td height="30" align="left" class="title"><img src="/manage/img/icon02.gif"> <strong>전체회원</strong></td>
  </tr>
	 <form name="list" method="post" action="<?=$PHP_SELF?>">
  <tr> 
    <td height="20">
        <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="dadada">
          <tr> 
            <td height="20" align="right" valign="middle" bgcolor="#FFFFFF">
              <select name="list_sort" size="1" id="list_sort" onchange="listsort()"ALIGN=absmiddle>
                <option value="">====전체보기====</option>
                      <option value="indi" <? if($list_sort == 'indi'){?> selected="selected" <? } ?>>일반회원</option>
                      <option value="company1" <? if($list_sort == 'company1'){?> selected="selected" <? } ?>>제휴회원</option>
                      <option value="premium1" <? if($list_sort == 'premium1'){?> selected="selected" <? } ?>>입찰대기</option>
                      <option value="premium2" <? if($list_sort == 'premium2'){?> selected="selected" <? } ?>>입찰승인</option>
					  <option value="jisajang" <? if($list_sort == 'jisajang'){?> selected="selected" <? } ?>>프리미엄</option>
                      <option value="premium3" <? if($list_sort == 'premium3'){?> selected="selected" <? } ?>>입찰종료</option>
                      <option value="premium4" <? if($list_sort == 'premium4'){?> selected="selected" <? } ?>>입찰중지</option>
<?
if($loginUsort == "admin1"||$loginUsort == "admin2"||$loginUsort == "superadmin" ){
?>
                      <option value="admin" <? if($list_sort == 'admin'){?> selected="selected" <? } ?>>일반관리자</option>
<?
}
?>
<?
if($loginUsort == "admin2"||$loginUsort == "superadmin" ){
?>
                      <option value="admin1" <? if($list_sort == 'admin1'){?> selected="selected" <? } ?>>중간관리자</option>
<?
}
?>
<?
if($loginUsort == "superadmin" ){
?>
                      <option value="admin2" <? if($list_sort == 'admin2'){?> selected="selected" <? } ?>>최고관리자</option>
<?
}
?>
<?
if($loginUsort == "superadmin" ){
?>
                      <option value="superadmin" <? if($list_sort == 'superadmin'){?> selected="selected" <? } ?>>슈퍼관리자</option>
<?
}
?>
              </select>
		      <select name="upjong" size="1" id="upjong" onchange="upjongs()" ALIGN=absmiddle>
                <option value="">====업종보기====</option>
                <option value="폐차업자" <? if($upjong == '폐차업자'){?> selected="selected" <? } ?>>폐차업자</option>
                <option value="자동차정비" <? if($upjong == '자동차정비'){?> selected="selected" <? } ?>>자동차정비</option>
                <option value="중고부품업" <? if($upjong == '중고부품업'){?> selected="selected" <? } ?>>중고부품업</option>
                <option value="자동차무역" <? if($upjong == '자동차무역'){?> selected="selected" <? } ?>>자동차무역</option>
                <option value="매매상사" <? if($upjong == '매매상사'){?> selected="selected" <? } ?>>매매상사</option>
                <option value="딜러" <? if($upjong == '딜러'){?> selected="selected" <? } ?>>딜러</option>
                <option value="기타" <? if($upjong == '기타'){?> selected="selected" <? } ?>>기타</option>  
              </select>
		     
		      <input name="Search_text" type="text" id="Search_text" size="25" class="input0" style="height:20; padding-top:3px;" value="<?=$Search_text?>">
            </td>
            <td width="75" align="center" valign="middle" bgcolor="#FFFFFF">
              <input type="submit"  value="검색" class="button44" style="cursor:pointer; background-color:#e7f1f9; color:#084573; border:#636563 1px solid; padding:1 3 0 3; " />
            </td>
            <td width="120" align="center" valign="middle" bgcolor="#FFFFFF">
<?
if($loginUsort == "superadmin" ){
?>
			<img src="../img/btnl_excel.gif" onclick="exl_down('<?=base64_encode($where)?>','<?=$start?>','<?=$view_article?>')" style="cursor:hand;" />
<?
}
?>
			</td>
          </tr>
        </table>
   </td>
  </tr>
  </form>
	<script>
		function exl_down(que,s,e){
			if(!que){
				window.open('./exldown.php?querya=1&s='+s+'&e='+e,'exl_pop','width=500,height=500');
			} else {
				window.open('./exldown.php?querya='+que+'&s='+s+'&e='+e,'exl_pop','width=500,height=500');
			}
		}
	</script>

  <tr> 
    <td height="1"></td>
  </tr>
  <tr> 
    <td><form name="f" method="post" >
        <table width="100%" border="0" cellspacing="1" cellpadding="0" class="table-style list-style list-table-standard">
				<colgroup>
					<col style="width:1%"/>
					<col style="width:3%"/>
					<col style="width:7%"/>
					<col style="width:6%"/>
					<col style="width:7%"/>
					<col style="width:9%"/>
					<col style="width:9%"/>
					<col style="width:6%"/>
					<col style="width:9%"/>
					<col style="width:9%"/>
					<col style="width:9%"/>
					<col style="width:7%"/>
					<col style="width:7%"/>
					<col style="width:7%"/>
					<col style="width:7%"/>
				</colgroup>
          <tr align="center" class="sbtitle"> 
            <td class="table-th-dark" > 
              <!-- 전체 선택 -->
              <input type="checkbox" name="allcheck" id="allcheck" onclick="all_check()" />            </td>
            <td class="table-th-dark">NO</td>
			<td class="table-th-dark">가입일</td>
            <td class="table-th-dark" >이름</td>
            <td class="table-th-dark" >닉네임</td>
            <td class="table-th-dark">아이디</td>
            <td class="table-th-dark">비밀번호</td>
            <td class="table-th-dark">지역</td>
            <td class="table-th-dark">업체명</td>
            <td class="table-th-dark">대표전화</td>
            <td class="table-th-dark">휴대전화</td>
            <td class="table-th-dark">최근접속일</td>
            <td class="table-th-dark">등급일</td>
            <td class="table-th-dark">회원등급</td>
            <td class="table-th-dark">입찰권한</td>
         </tr>
          <!-- 반복되는 줄 시작 -->
          <?
		   if($total_article > 0){

		
		$qry = "SELECT * FROM $tb_name WHERE $where LIMIT $start, $view_article";
		
  		$arr = Fetch_string($qry);

		for($i=0;$i<count($arr);$i++){	
			
			$tmp = explode(" ",$arr[$i][company_addr1]);

			if( strpos($arr[$i][usort],'premium') !== false )  $pre_rdate = $arr[$i][pre_rdate];
			else $pre_rdate = $arr[$i][rdate];

		
		// 프리미엄 승인 회원이라면  종료 여부를 체크한다.
		// 프리미엄 승인 날짜가 종료 됐으면  종료 로 전환한다.
		if($arr[$i][usort] == "premium2"){

			
			$nowUnix = null;
			$prerUnix = null;
			$premUnix = null;


			$nowUnix = unixDateTime(Date("Y-m-d"), "s");	// 지금 날짜
			$prerUnix = unixDateTime($arr[$i][pre_rdate], "s");		// 프리미엄 시작일
			$premUnix = unixDateTime($arr[$i][pre_mdate], "e");		// 프리미엄 종료일
			
			
			if($premUnix < $nowUnix){
				$usql = "update  $tb_name SET  usort = 'premium3' WHERE idx='".$arr[$i][idx]."' ";
				mysql_query($usql);		
				
				$arr[$i][usort] = "premium3";
			}
		
			/*	echo $pw[usort]."<BR>";
				echo $loginUsort."<BR>";
				echo $nowUnix." - ".  $pre_rdate." - ". $pre_mdate."<BR>";
				echo $nowUnix." - ".  $prerUnix." - ". $premUnix."<BR>";
				echo date("Y-m-d H:i:s", $nowUnix)." - ".date("Y-m-d H:i:s", $prerUnix)." - ". date("Y-m-d H:i:s", $premUnix);
			*/				
		}
		
		$sql_br = "SELECT * FROM recruit WHERE code = '".$arr[$i][code]."'";	
		$row_br = Row_string($sql_br);
  ?>
          <tr align="center"  bgcolor="<?=$bgCol?>" style="cursor: hand; padding:3 0 0 0;" onmouseover="this.bgColor='#d9f3fb'" onmouseout="this.bgColor=''"> 
            <td class="hand" ><input type="checkbox" name="check[]" value="<?=$arr[$i][idx]?>"></td>
            <td class="hand" onclick="goUrl('view.php?No=<?=$arr[$i][idx]?><?=$href1?>');"><?=$total_article-$i-(($page-1)*$view_article)?></td>
			<td class="hand" onclick="goUrl('view.php?No=<?=$arr[$i][idx]?><?=$href1?>');"><?=$arr[$i][rdate]?></td>
<? if($loginUsort == "superadmin"){ ?>
            <td class="hand" onclick="goUrl('view.php?No=<?=$arr[$i][idx]?><?=$href1?>');"><?=$arr[$i][name]?></td>
            <td class="hand" onclick="goUrl('view.php?No=<?=$arr[$i][idx]?><?=$href1?>');"><?=$arr[$i][userNick]?></td>
            <td class="hand" onclick="goUrl('view.php?No=<?=$arr[$i][idx]?><?=$href1?>');"><?=$arr[$i][userId]?></td>
            <td class="hand" onclick="goUrl('view.php?No=<?=$arr[$i][idx]?><?=$href1?>');"><?=$arr[$i][userPw]?></td>
            <td class="hand" onclick="goUrl('view.php?No=<?=$arr[$i][idx]?><?=$href1?>');"><?=$tmp[0]?></td>
            <td class="hand" onclick="goUrl('view.php?No=<?=$arr[$i][idx]?><?=$href1?>');">&nbsp;<?=$arr[$i][company_name]?></td>
            <td class="hand" onclick="goUrl('view.php?No=<?=$arr[$i][idx]?><?=$href1?>');"><?=$arr[$i][tel]?></td>
            <td class="hand" onclick="goUrl('view.php?No=<?=$arr[$i][idx]?><?=$href1?>');"><?=$arr[$i][pcs]?></td>
            <td class="hand" onclick="goUrl('view.php?No=<?=$arr[$i][idx]?><?=$href1?>');" ><?=substr($arr[$i][loginTime],0,10)?></td>
            <td class="hand" onclick="goUrl('view.php?No=<?=$arr[$i][idx]?><?=$href1?>');"><?=$arr[$i][mdate]?></td>
            <td class="hand" onclick="goUrl('view.php?No=<?=$arr[$i][idx]?><?=$href1?>');"><?=grade_sort($arr[$i][usort])?></td>
            <td class="hand" onclick="goUrl('view.php?No=<?=$arr[$i][idx]?><?=$href1?>');"><?=$arr_power[$arr[$i][power]]?></td>
<? }else{ ?>
            <td class="hand" onclick="goUrl('view.php?No=<?=$arr[$i][idx]?><?=$href1?>');"><?=$arr[$i][name]?></td>
            <td class="hand" onclick="goUrl('view.php?No=<?=$arr[$i][idx]?><?=$href1?>');"><?=$arr[$i][userNick]?></td>
            <td class="hand" onclick="goUrl('view.php?No=<?=$arr[$i][idx]?><?=$href1?>');"><?=$arr[$i][userId]?></td>
            <td class="hand" onclick="goUrl('view.php?No=<?=$arr[$i][idx]?><?=$href1?>');">****</td>
            <td class="hand" onclick="goUrl('view.php?No=<?=$arr[$i][idx]?><?=$href1?>');"><?=$tmp[0]?></td>
            <td class="hand" onclick="goUrl('view.php?No=<?=$arr[$i][idx]?><?=$href1?>');">&nbsp;<?=$arr[$i][company_name]?></td>
            <td class="hand" onclick="goUrl('view.php?No=<?=$arr[$i][idx]?><?=$href1?>');"><?=$arr[$i][tel]?></td>
            <td class="hand" onclick="goUrl('view.php?No=<?=$arr[$i][idx]?><?=$href1?>');"><?=substr($arr[$i][pcs],0,-4)?>****</td>
            <td class="hand" onclick="goUrl('view.php?No=<?=$arr[$i][idx]?><?=$href1?>');" ><?=substr($arr[$i][loginTime],0,10)?></td>
            <td class="hand" onclick="goUrl('view.php?No=<?=$arr[$i][idx]?><?=$href1?>');" ><?=$arr[$i][mdate]?></td>
            <td class="hand" onclick="goUrl('view.php?No=<?=$arr[$i][idx]?><?=$href1?>');"><?=grade_sort($arr[$i][usort])?></td>
            <td class="hand" onclick="goUrl('view.php?No=<?=$arr[$i][idx]?><?=$href1?>');"><?=$arr_power[$arr[$i][power]]?></td>
<? } ?>
          </tr>
          <!-- 반복되는 줄 끝 -->
          <? } } ?>
        </table>
    </form></td>
  </tr>
  <tr> 
    <td height="40" align="left">
<?if($loginUsort=="superadmin"||$loginUsort=="admin2"){?>
	<input type="submit" name="Submit2222" value="선택삭제" class="button4444"  onClick="window.location='javascript:delete_member()'" style="cursor:pointer; background-color:#FFFFFF; border:1px #636563 solid; padding:5 3 3 3; font-weight:bold"> 
<?}?>
    </td>
  </tr>
  <tr> 
    <td>&nbsp;</td>
  </tr>
  <tr> 
    <td height="28" align="center" valign="bottom"> 
      <? include "page.php";?>
    </td>
  </tr>
  
  <tr> 
    <td>&nbsp;</td>
  </tr>
</table>

<? include_once "../inc/footer.php";?>
<?
/*  20221128 주석
$Qry = "SELECT * FROM woojung_member WHERE 1 ";
$arr = Fetch_string($Qry);

$connect = mysql_connect("175.125.94.172","kaic_r","q1w2e3r4") or die("에러 : 디비 연결 오류 입니다."); 
mysql_select_db("kaic",$connect) or die("에러 : 데이터 베이스 선택 오류 입니다."); 

$fields = mysql_list_fields("kaic", "woojung_member");
$columns = mysql_num_fields($fields);

for($i=0;$i<count($arr);$i++){
	for ($i2 = 0; $i2 < $columns; $i2++) {
		if($i2){
			$insert_list.= ", ".mysql_field_name($fields, $i2)." = '".$arr[$i][$i2]."'";
		}else{
			$insert_list=mysql_field_name($fields, $i2)." = '".$arr[$i][$i2]."'";
		}
	}

	$qry_backup = "select * from woojung_member where idx = '".$arr[$i][idx]."'  ";
	$row_backup = mysql_fetch_array(mysql_query($qry_backup));
	if(!$row_backup[idx]){
		$query="insert into woojung_member set $insert_list ";
		mysql_query($query);
	}else{
		$query="update woojung_member set $insert_list where idx='".$arr[$i][idx]."' ";
		mysql_query($query);
	}
}
*/
?>