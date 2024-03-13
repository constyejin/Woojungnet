<? 	
	include $_SERVER['DOCUMENT_ROOT'].'/manage/inc/header.php';
	include $_SERVER['DOCUMENT_ROOT'].'/manage/inc/top_menu.php';
	include $_SERVER['DOCUMENT_ROOT'].'/manage/inc/global.php';
		
	$tb_name = $tablecar;
	$nowDate = date("Y-m-d");
	$YesterDate = date("Y-m-d", mktime(0, 0, 0, date("m"), date("d")-1, date("Y") ));

	if($tm=="1"){
		$sql_tm="select * from woojung_car where 1 ";
		$result_tm=mysql_query($sql_tm);
		while($data_tm=mysql_fetch_array($result_tm)){
			$query_b = "select count(*) from woojung_bid where auct_key='$data_tm[wc_idx]' and rdate='".date("Y-m-d")."' ";  
			$result_b = mysql_query($query_b);  
			$temp_b = mysql_fetch_array($result_b);  
			$qu="update woojung_car set  today_ib='$temp_b[0]' where wc_idx='$data_tm[wc_idx]'";
			mysql_query($qu) or die(mysql_error()); 
		}
	}
	if($ed=="1"){
		$sql_tm="select * from woojung_car where end_da='' ";
		$result_tm=mysql_query($sql_tm);
		while($data_tm=mysql_fetch_array($result_tm)){
			$query_b = "select * from woojung_car_go where wcg_wcidx = '$data_tm[wc_idx]' ";  
			$result_b = mysql_query($query_b);  
			$temp_b = mysql_fetch_array($result_b);  
			$qu="update woojung_car set  end_da='$temp_b[wc_go_end_date]' where wc_idx='$data_tm[wc_idx]'";
			mysql_query($qu) or die(mysql_error()); 
		}
	}
	
	$exstart_date = $start_date;
	//if(!$start_date) $exstart_date = $nowDate;
	//else $exstart_date = $start_date;

	$href = "&gubun1=$gubun1&gubun2=$gubun2&gubun3=$gubun3&gubun4=$gubun4&p=$p&admidx=$admidx&searchKey=$searchKey&end_3=$end_3&tm=$tm&ed=$ed&wtime=$wtime&date_type=$date_type"; 
	$href .= "&start_date=$start_date&end_date=$end_date&car_cate=$car_cate&car_cate2=$car_cate2&wc_made=$wc_made&code=$code&in_name=$in_name&wc_go_type=$wc_go_type&set_page=$set_page&listpage=1";
	$href1 = "&page=$page".$href;
	if($tm=="1"){$where = " today_ib>0 ";}elseif($ed=="1"){$where=" end_da ='".date("Y-m-d")."' ";}else{$where = " 1=1 ";}


	if($loginUsort == "jisajang2"){
			$where .= " and car_cate  = '36' ";
	}


	#조회 버튼 입력시
	if($ed){
	}
	if($gubun1){  		 
		if($gubun1=="3"){
			$p=1;
			$where .= "";
		} else {
			$p = "";
			$where .= " and wc_gubun1  = '$gubun1'";
		}
	}

	if($wc_made){  		 
		$where .= " and wc_made   = '$wc_made'";  
	}  

	if($gubun2){  		 
		$where .= " and wc_gubun2   = '$gubun2'";  
	}  

	if($gubun3){  		 
		$where .= " and wc_gubun3  = '$gubun3'";  
	} 
	
	if($gubun4){  		 
		$where .= " and wc_gubun4  = '$gubun4'";  
	}  

	if($wc_go_type){  		 
		$where .= " and c.wc_go_type  = '$wc_go_type'";  
	}  

	if($p){  		 
		$where .= " and keeping  = '$p'";  
	}
	if($q){  		 
		$where .= " and keeping  = '$q'";  
	}

	if($admidx){  		 
		$where .= " and wc_adminidx  = '$admidx'";  
	}  

	if($loginUsort != "jisajang2"){
		if($searchKey){
			$where .= " and ( wc_no  like '%$searchKey%' or jnumber like '%$searchKey%' or wc_mem_name like '%$searchKey%' or wc_model  like '%$searchKey%' or wc_orderno like '%$searchKey%' or wc_model like '%$searchKey%' or wc_model2 like '%$searchKey%' or bodam like '%$searchKey%' or e.name like '%$searchKey%' or e.bid_name like '%$searchKey%' or e.bid_company like '%$searchKey%' ) ";  	
		}
	}else{
		if($searchKey){
			$where .= " and ( wc_no  like '%$searchKey%' or jnumber like '%$searchKey%' or wc_mem_name like '%$searchKey%' or wc_model like '%$searchKey%' or wc_model2 like '%$searchKey%' or bodam like '%$searchKey%' or e.name like '%$searchKey%' or e.bid_name like '%$searchKey%' or e.bid_company like '%$searchKey%' ) ";  	
		}
	}

	if($car_cate){
		$where .= " and car_cate  = '$car_cate'";
	}

	if($car_cate2){
		$where .= " and car_cate2  = '$car_cate2'";
	}

	if($code){
		$where .= " and code  = '$code'";
	}

	if($end_3){
		$where .= " and end_3  = '$end_3'";
	}

	if($in_name){
		$where .= " and in_name  = '$in_name'";
	}

	if($date_type=="1"){
		if($start_date && $end_date){		
			$where .= " and substring(wc_regdate, 1, 10)  >= '$start_date' and substring(wc_regdate, 1, 10) <= '$end_date'";
		}
		if($start_date && !$end_date){
			$where .= " and substring(wc_regdate, 1, 10) >= '$start_date' ";
		}
		if(!$start_date && $end_date){
			$where .= " and substring(wc_regdate, 1, 10) <= '$end_date' ";
		}
	}
	if($date_type=="2"){
		if($start_date && $end_date){		
			$where .= " and substring(wc_go_end_date, 1, 10)  >= '$start_date' and substring(wc_go_end_date, 1, 10) <= '$end_date'";
		}
		if($start_date && !$end_date){
			$where .= " and substring(wc_go_end_date, 1, 10) >= '$start_date' ";
		}
		if(!$start_date && $end_date){
			$where .= " and substring(wc_go_end_date, 1, 10) <= '$end_date' ";
		}
	}
	if($date_type=="3"){
		if($start_date && $end_date){		
			$where .= " and substring(bid_sort_date, 1, 10)  >= '$start_date' and substring(bid_sort_date, 1, 10) <= '$end_date'";
		}
		if($start_date && !$end_date){
			$where .= " and substring(bid_sort_date, 1, 10) >= '$start_date' ";
		}
		if(!$start_date && $end_date){
			$where .= " and substring(bid_sort_date, 1, 10) <= '$end_date' ";
		}
	}
	if($wtime=="1" ){
		$where .= " and wc_go_end_hh = '09' and wc_go_end_mm = '30' ";
	}
	if($wtime=="2" ){
		$where .= " and wc_go_end_hh = '10' and wc_go_end_mm = '30' ";
	}
	if($wtime=="3" ){
		$where .= " and wc_go_end_hh = '13' and wc_go_end_mm = '30' ";
	}
	if($wtime=="4" ){
		$where .= " and wc_go_end_hh = '15' and wc_go_end_mm = '30' ";
	}
	if($wtime=="5" ){
		$where .= " and wc_go_end_hh = '12' and wc_go_end_mm = '30' ";
	}
	//echo $where;
	$query = "select count(*) from woojung_car as a 
	left join woojung_member as b on a.wc_mem_id=b.userId 
	left join woojung_car_go as c on a.wc_idx = c.wcg_wcidx 
	left join woojung_bid as e on a.wc_idx = e.auct_key and e.bid_sort='Y' 
	where $where ";  
	//echo $query;
	$result = mysql_query($query, $connect);  
	//echo $result;
	$temp = mysql_fetch_array($result);  
	$total_article = $temp[0]; // 현재 쿼리한 게시물의 총 개수를 구함	
	
?>
<script>
	function search_form(){
		var frm = document.Search;
		frm.submit();
	}
	
	function show_etc(num){
		if(num == 0){
			document.getElementById('etc').style.display = '';
		} else {
			document.getElementById('etc').style.display = 'none';
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

	function saveexcel(){
		
		var frm = document.Search;		
		frm.target = "hiddenframe";
		frm.action = "excellist.php";
		frm.submit();

	}
	

	function SearchDate(f){
		var obj = document.Search;
		var YesterDay = "<?=$YesterDate ?>";
		var ToDay = "<?=$nowDate ?>";

		if(f == 'Y'){ // 어제라면
			document.getElementById('sdate').value = YesterDay;
			document.getElementById('edate').value = YesterDay;
		}else if(f == 'T'){ // 어제라면
			document.getElementById('sdate').value = ToDay;
			document.getElementById('edate').value = ToDay;
		}else{
			document.getElementById('sdate').value = '';
			document.getElementById('edate').value = '';
		}

		obj.submit();
		
	}

	function timeck(f){
		var obj = document.Search;
//		SearchDate('T');
		obj.wtime.value=f;
		obj.submit();
	}

function exl_down(que,s,e){
	sf=document.Search;
	sf.action="exldown.php";
	sf.target="hiddenframe";
	sf.submit();
	sf.action="";
	sf.target="";
}
</script>
<style type="text/css">
/* .style1 {color: #FFFFFF} */
</style>

<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script> 
<script language="javascript" type="text/javascript">
 $(document).ready(function() {

  //******************************************************************************
  // 상세검색 달력 스크립트
  //******************************************************************************
  var clareCalendar = {
   monthNamesShort: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
   dayNamesMin: ['일','월','화','수','목','금','토'],
   weekHeader: 'Wk',
   dateFormat: 'yy-mm-dd', //형식(20120303)
   autoSize: false, //오토리사이즈(body등 상위태그의 설정에 따른다)
   changeMonth: true, //월변경가능
   changeYear: true, //년변경가능
   showMonthAfterYear: true, //년 뒤에 월 표시
   buttonImageOnly: true, //이미지표시
   buttonText: '달력선택', //버튼 텍스트 표시
   buttonImage: '/images/icon_data.gif', //이미지주소
   showOn: "both", //엘리먼트와 이미지 동시 사용(both,button)
   yearRange: '2010:<?=date("Y")+1?>' //2010년부터 내년까지
  };
  $("#sdate").datepicker(clareCalendar);
  $("#edate").datepicker(clareCalendar);
  $("#adate").datepicker(clareCalendar);
  $("#bdate").datepicker(clareCalendar);
  $("img.ui-datepicker-trigger").attr("style","margin-left:5px; vertical-align:middle; cursor:pointer;"); //이미지버튼 style적용
  $("#ui-datepicker-div").hide(); //자동으로 생성되는 div객체 숨김  
 });
</script>
<style>
.ui-datepicker select.ui-datepicker-month{ width:30%;  }
.ui-datepicker select.ui-datepicker-year{ width:40%; }
</style>

 
<iframe name="HiddenFrm" id="HiddenFrm" style="display:none;"></iframe>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
 <form name="excel" method="post" action="excel.php" target="hiddenframe">
            <input type="hidden" name="wc_idx" value="">
	</form>
  <tr> 
    <td height="20" align="left" class="title"><img src="/manage/img/icon02.gif"> 
      <strong>접수대장</strong></td>
    <td align="right" class="title"></td>
  </tr>
  <tr> 
    <td height="10" colspan="2"></td>
  </tr>
  <tr> 
    <td colspan="2">


<?
// 동부 서치 삭제
if($loginUsort != "jisajang2"){
?>

	<table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="d1d1d1" class="table-style">
        <form name="Search" method="get" action="<?=$PHP_SELF?>">
		<input type="hidden" name="p" value="<?=$p?>">
		<input type="hidden" name="wtime" value="">
		
        <tr> 
					<td class="table-th" bgcolor="f6f6f6">진행구분1</td>
          <td bgcolor="#FFFFFF" style="padding-left:10px;" align="left">

<?

		//== /lib/code.php 안에 있음
		// WriteArrHTML(html형식, html파리미터명, 배열명, 선택될 밸류, 온스크립트, 
		// td col 사이즈, 값바로 리턴인지여부, 전체 필드 추가여부)
		$onscript = "onclick=\"if(this.checked == true)CallsubGubun('SearchGubun3','radio', 'gubun3', this.value, '{$gubun3}', '', '', '', '전체');\"";

		WriteArrHTML('radio', 'gubun2', $Arrgubun2, $gubun2, "{$onscript}", '', '', '전체');
?></td>
          <td  width="120" rowspan="6" align="center" bgcolor="#FFFFFF"><input type="submit" name="Submit222" value="조회" class="button33" style="height:50 cursor:pointer; background-color:#e7f5ff; color:#084573; border:#084573 1px solid; padding:20 10 20 10; height:60px; width:70px;"  /></td>
        </tr>
        <tr> 
					<td class="table-th" bgcolor="f6f6f6">진행구분2</td>
          <td bgcolor="#FFFFFF" style="padding-left:10px;" id="SearchGubun3" align="left">
			
		

<?	
		if( trim($gubun2) != "") WriteArrHTML('radio', 'gubun3', ${"Arrgubun3_".$gubun2."s"}, $gubun3, '', '', '', '전체');
		else echo "	* 진행구분 2를 선택해 주세요";

		//== /lib/code.php 안에 있음
		//WriteArrHTML('radio', 'gubun3', $Arrgubun3, $gubun3, '', '', '', '전체');
?></td>
          </tr>
 <tr> 
            <td class="table-th" bgcolor="f6f6f6">진행구분3</td>
            <td bgcolor="#FFFFFF" style="padding-left:10px;" id="SearchGubun3" align="left">
			
		

<?	
//		else echo "	* 진행구분 2를 선택해 주세요";
		//== /lib/code.php 안에 있음
		WriteArrHTML('radio', 'wc_go_type', $ArrgoSale, $wc_go_type, '', '', '', '전체');
		
?></td>
          </tr>
        <tr> 
            <td class="table-th" bgcolor="f6f6f6">진행구분4</td>
          <td bgcolor="#FFFFFF" style="padding-left:10px;" align="left">


<?
		//== /lib/code.php 안에 있음
		WriteArrHTML('radio', 'gubun4', $Arrgubun4, $gubun4, '', '', '', '전체');
?></td>
          </tr>


        <tr> 
          <td class="table-th" align="center" bgcolor="f6f6f6">일자선택</td>
            <td bgcolor="#FFFFFF" style="padding:0 0 0 10px;"  align="left"> 
                   <table width="100%" border="0" cellpadding="0" cellspacing="0">
                <tr>  
                  <td width="33%" align="left" style="padding:0 0 0 10; ">
				  <select name="date_type">
					<option value="1" <? if($date_type=="1") echo "selected"; ?>>접수일</option>
					<option value="2" <? if($date_type=="2") echo "selected"; ?>>마감일</option>
					<option value="3" <? if($date_type=="3") echo "selected"; ?>>낙찰일</option>
				  </select>
				  <input name="start_date" type="text" class="input" id="sdate" value="<?=$exstart_date?>" style="width:90px;">&nbsp;&nbsp;~&nbsp;&nbsp;<input name="end_date" type="text" class="input" id="edate" value="<?=$end_date?>" style="width:90px;"> 
				  </td>  
                  <td width="20%" align="left">
					
										<input type="button" value=" 어제 " onClick="SearchDate('Y')">
										<input type="button" value=" 오늘 " onClick="SearchDate('T')">
										<input type="button" value=" 전체 " onClick="SearchDate('')">
									</td>
									<td width="60%" align="left" valign="bottom">
										<table width="300" border="0" cellspacing="0" cellpadding="0">
											<tr>
												<td>
												<input type="button" value=" 09:30 " onClick="timeck(1);" class="btn-lightblue">
												<input type="button" value=" 10:30 " onClick="timeck(2);" class="btn-lightblue">
												<input type="button" value=" 12:30 " onClick="timeck(5);" class="btn-lightblue">
												<input type="button" value=" 13:30 " onClick="timeck(3);" class="btn-lightblue">
												<input type="button" value=" 15:30 " onClick="timeck(4);" class="btn-lightblue">
												</td>
											</tr>
										</table>
									</td>
                </tr>
              </table></td>
          </tr>
        <tr> 
          <td class="table-th" align="center" bgcolor="f6f6f6" >검색어</td>
          <td bgcolor="#FFFFFF" style="padding:0 0 0 10px; " align="left"><input type="text" name="searchKey" value="<?=$searchKey?>">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
<select name="wc_made" onchange="document.Search.submit();">
  <option value="">::제조사별::</option>
              <?
			   $com_sql=mysql_query("select * from cate2 where depth='1' ");
			   while($com=mysql_fetch_array($com_sql)){
			   ?>
              <option value="<?=$com["idx"]?>" <?if($com["idx"]==$wc_made){ echo "selected"; }?>>
              <?=$com["name"]?>
              </option>
              <?}?>
</select>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
 
			    <select name="car_cate" onchange="document.Search.submit();">
			  <option value="" selected>:: 보험사 ::</option>
			   <?
			   $team_cate_sql=mysql_query("select * from team_cate where depth='1'");
			   while($team_cate=mysql_fetch_array($team_cate_sql)){
			   ?>
			   <option value="<?=$team_cate["idx"]?>" <?if($team_cate["idx"]==$car_cate){ echo "selected"; }?>><?=$team_cate["name"]?></option>
			   <?}?>
			</select>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
			<select name="car_cate2" onchange="document.Search.submit();">
              <option value="" selected="selected">:: 팀명 ::</option>
              <?
			  if($car_cate){
				   $team_cate_sql=mysql_query("select * from team_cate where code='$car_cate'");
				   while($team_cate=mysql_fetch_array($team_cate_sql)){
			   ?>
              <option value="<?=$team_cate["idx"]?>" <?if($team_cate["idx"]==$car_cate2){ echo "selected"; }?>>
                <?=$team_cate["name"]?>
                </option>
              <?
				   }
			  }
			   ?>
            </select>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
			<select name="in_name" onchange="document.Search.submit();">
              <option value="" selected="selected">:: 내부담당자 ::</option>
<?
	    $qry = "SELECT * FROM woojung_admin order by orderval asc , waidx asc ";
  		$arr = Fetch_string($qry);
		for($i=0;$i<count($arr);$i++){	
?>
						<option value="<?=$arr[$i][waname]?>" <?if($arr[$i][waname]==$in_name) echo "selected";?>><?=$arr[$i][waname]?></option>
<?
		}
?>
            </select>			</td>
        </tr>
    </table>

<?
}
//동부 서치 삭제 끝
?>	
  </td>
  </tr>
		<tr> 
			  <td colspan="5" align="right" bgcolor="#FFFFFF" style="padding-top:10px;padding-bottom:5px;">
		
			  </td>
		</tr> 
  <tr> 
    <td colspan="2" style="text-align:right;height:35px;">
	<select name="set_page" onchange="document.Search.submit();">
			<option value="15" >15</option>
			<option value="100" <? if($set_page=="100") echo "selected"; ?>>100</option>
			<option value="200" <? if($set_page=="200") echo "selected"; ?>>200</option>
		</select>
	</td>
  </tr></form> 
  <tr> 
    <td colspan="2">
	<form name="f" action="proc.php" method="post" target="HiddenFrm">
        <input type="hidden" name="mode" value="delete">
        <input type="hidden" name="gubun4" value="<?=$gubun4?>">
        <input type="hidden" name="page" value="<?=$page?>">



		<table width="100%" style="word-break:break-all;" class="list-table-standard">
			<colgroup>
				<col style="width:41px"></col>
				<col style="width:60px"></col>
				<col style="width:105px"></col>
				<col style="width:113px"></col>
				<col style="width:127px"></col>
				<col style="width:142px"></col>
				<col style="width:111px"></col>
				<col style="width:90px"></col>
				<col style="width:90px"></col>
				<col style="width:90px"></col>
				<col style="width:80px"></col>
				<col style="width:80px"></col>
				<col style="width:75px"></col>
				<col style="width:75px"></col>
			</colgroup>
			<tr align="center" class="sbtitle"> 
				<td class="table-th-dark"> 
					<!-- 전체 선택 -->
					<input type="checkbox" name="allcheck" id="allcheck" onClick="all_check()" />
				</td>
				<td class="table-th-dark" width="5%" height="28"><span>NO</span></td>
				<td class="table-th-dark" width="60px"><span>접수번호</span></td>
				<td class="table-th-dark" width="6%"><span>접수일</span></td>
				<td class="table-th-dark" width="7%"><span>보험사</span></td>
				<td class="table-th-dark" width="7%"><span>차량번호</span></td>
				<td class="table-th-dark" width="9%"><span>모델명</span></td>
				<td class="table-th-dark" width="3%"><span>사진</span></td>
				<td class="table-th-dark" width="5%"><span>내부담당</span></td>
				<td class="table-th-dark" width="4%"><span>구분1</span></td>
				<td class="table-th-dark" width="5%"><span>구분2</span></td> 
				<td class="table-th-dark" width="5%"><span>구분3</span></td> 
				<td class="table-th-dark" width="5%"><span>구분4</span></td>
				<td class="table-th-dark" width="8%"><span>마감일자</span></td>
				<td class="table-th-dark" width="3%"><span>입찰</span></td>
				<td class="table-th-dark" width="5%"><span>최고입찰가</span></td>
				<td class="table-th-dark" width="5%"><span>낙찰유형</span></td>
				<td class="table-th-dark" width="5%"><span>낙찰일자</span></td> 
				<td class="table-th-dark" width="5%"><span>최종낙찰자</span></td>
			</tr>
		<!-- 반복되는 줄 시작 -->


 <?

		 

if($total_article > 0){
	$ppp=1;
	while($start>$total_article){
		$ppp++;
		$start = ($page-$ppp)*$view_article; 
	}
	$page=$start/$view_article+1;
	$Qry = "SELECT * FROM woojung_car as a left join woojung_member as b on a.wc_mem_id=b.userId left join woojung_car_go as c on a.wc_idx = c.wcg_wcidx left join woojung_bid as e on a.wc_idx = e.auct_key and e.bid_sort='Y'  WHERE $where order by wc_idx  desc LIMIT $start, $view_article";

	$arr = Fetch_string($Qry);
	
	for($i=0;$i<count($arr);$i++){

			$mem_info = Row_string("SELECT * FROM woojung_member WHERE userId  = '".$arr[$i][wc_mem_id]."'");
			$com = Row_string("SELECT * FROM recruit WHERE code  = '$mem_info[code]'");

			$aucSQL = "select  *  from woojung_bid where auct_key='".$arr[$i][wc_idx]."' and bid_sort='Y' ";
			$arow = Row_string($aucSQL);

			$aucidx	 = $arow[idx];
			$aucNo	 = $arow[auc_orderno];

			unset($nak);
			unset($info);

			if($aucidx){ // 낙찰자가 있을경우
				$aucDate = $arow[bid_sort_date];
				//mysql_query("update woojung_car set wc_auction_date='".$arow[bid_sort_date]."' where wc_idx='".$arr[$i][wc_idx]."' ");
				$info = Row_string("SELECT * FROM woojung_member WHERE userId  = '$arow[userId]'");
				$nak = Row_string("SELECT * FROM recruit WHERE code  = '$info[code]'");
			}

			$wcgSQL = "select  *  from woojung_car_go where wcg_wcidx='".$arr[$i][wc_idx]."'";
			$wcg = Row_string($wcgSQL);

			$num = $total_article-$i-(($page-1)*$view_article);
			
			($i%2 == 0) ? $bgCol = "#ffffff" : $bgCol = "#f4ecd1";
			
			$zzim=mysql_fetch_row(mysql_query("select count(idx) from car_zzim where no='".$arr[$i][wc_idx]."'"));
			$bohum=mysql_fetch_array(mysql_query("select * from team_cate where idx='".$arr[$i][car_cate]."'"));

			$bid_arr = mysql_fetch_row(mysql_query("SELECT count(*) FROM woojung_bid  WHERE auct_key = '".$arr[$i][wc_idx]."'" ));

			$max_arr[0]=0;
			if($bid_arr[0]>0){
				$max_arr = mysql_fetch_row(mysql_query("SELECT max(bid_price) FROM woojung_bid  WHERE auct_key = '".$arr[$i][wc_idx]."'" ));
			}

			$wc_car_img1 = explode("/",$arr[$i][wc_img_1]);
			$defaultFile = "/data/".$wc_car_img1[0];
		  ?>
          <tr align="center" bgcolor="<?=$bgCol?>" onmouseover="this.bgColor='#d9f3fb'" onmouseout="this.bgColor=''" > 
            <td bgcolor="<?=$bgCol?>" >
			<input type="checkbox" name="check[]" id="check[]" value="<?=$arr[$i][wc_idx]?>" />
			<input type="hidden" name="checkout[]" id="checkout[]" value="<?=$arr[$i][wc_idx]?>" />			</td>
            <td height="25" bgcolor="<?=$bgCol?>"><?=$num?></td>
            <td bgcolor="<?=$bgCol?>" class="hand" onclick="goUrl('./view.php?wc_idx=<?=$arr[$i][wc_idx]?><?=$href1?>');"><?=$arr[$i][wc_orderno]?></td>
            <td bgcolor="<?=$bgCol?>" class="hand" onclick="goUrl('./view.php?wc_idx=<?=$arr[$i][wc_idx]?><?=$href1?>');"><?=substr($arr[$i][wc_regdate],0,10)?></td>
			 <td bgcolor="<?=$bgCol?>"  class="hand" onclick="goUrl('./view.php?wc_idx=<?=$arr[$i][wc_idx]?><?=$href1?>');"><span style="padding-left: 5px;">
              <?=$bohum[name]?>
            </span></td>
            <td bgcolor="<?=$bgCol?>" class="hand" onclick="goUrl('./view.php?wc_idx=<?=$arr[$i][wc_idx]?><?=$href1?>');"><?=$arr[$i][wc_no]?></td>
		   <td align="left" bgcolor="<?=$bgCol?>" class="hand" onclick="goUrl('./view.php?wc_idx=<?=$arr[$i][wc_idx]?><?=$href1?>');" style="padding-left:10px;"><?=$arr[$i][wc_model]?> <?=mb_substr($arr[$i][wc_model2],0,12,"utf-8");?></td>

            <td bgcolor="<?=$bgCol?>" class="hand" onclick="goUrl('./view.php?wc_idx=<?=$arr[$i][wc_idx]?><?=$href1?>');"><?=$wc_car_img1[0]?"<img src='".$defaultFile."' style='width:30px;height:20px;'>":"";?></td>
    
            <td bgcolor="<?=$bgCol?>" class="hand" onclick="goUrl('./view.php?wc_idx=<?=$arr[$i][wc_idx]?><?=$href1?>');"><?=$arr[$i][in_name]?></td>

			<td bgcolor="<?=$bgCol?>" class="hand" onclick="goUrl('./view.php?wc_idx=<?=$arr[$i][wc_idx]?><?=$href1?>');">
			<?=WriteArrHTML('checkbox', '', $Arrgubun2, $arr[$i][wc_gubun2], '', 0, 'direct', '', '', '');?>&nbsp;</td>
            
			<td bgcolor="<?=$bgCol?>" class="hand" onclick="goUrl('./view.php?wc_idx=<?=$arr[$i][wc_idx]?><?=$href1?>');">
			<?
			if($arr[$i][wc_gubun2]){
				echo WriteArrHTML('checkbox', '', ${"Arrgubun3_".$arr[$i][wc_gubun2]}, $arr[$i][wc_gubun3], '', 0, 'direct', '', '', '');
			}
			?>			
			</td>
			<td bgcolor="<?=$bgCol?>" class="hand" onclick="goUrl('./view.php?wc_idx=<?=$arr[$i][wc_idx]?><?=$href1?>');"><?
			//== /lib/code.php 안에 있음
			WriteArrHTML('radio', 'wc_go_type', $ArrgoSale, $arr[$i][wc_go_type], '', '' , 'direct', '');
			?></td>
			<?
				switch($arr[$i][wc_gubun4]){
				case "1" :
					$gubun_color = "#aa2321";
					break;
				case "2":
					$gubun_color = "green";
					break;
				case "3":
					$gubun_color = "hotpink";
					break;
				case "4":
					$gubun_color = "#234dcc";
					break;
				case "5":
					$gubun_color = "#00aa9c";
					break;
				case "6":
					$gubun_color = "#84a09c";
					break;
				case "7":
					$gubun_color = "#234d9c";
					break;
				default:
					$gubun_color = "#239dcc";
					break;
				}

			?>

			<td bgcolor="<?=$gubun_color?>" class="hand" onclick="goUrl('./view.php?wc_idx=<?=$arr[$i][wc_idx]?><?=$href1?>');">
				<font color="white"><?=WriteArrHTML('checkbox', '', $Arrgubun4, $arr[$i][wc_gubun4], '', 0, 'direct', '', '', '');?></font>			</td>
            
			<td bgcolor="<?=$bgCol?>" class="hand"><?=$wcg[wc_go_end_date]?> <?=$wcg[wc_go_end_hh]?>:<?=$wcg[wc_go_end_mm]?></td>
<?
if($loginUsort == "superadmin"  ){
?>
			<td bgcolor="<?=$bgCol?>" onclick="window.open('/inc/popup_02.php?auct_idx=<?=$arr[$i][wc_idx]?>','auction','width=840, height=530, scrollbars=yes');" style="cursor:pointer;"><?=number_format($bid_arr[0])?></td>
<?
}else if($loginUsort == "admin1"||$loginUsort == "admin2"){
?>
			<td bgcolor="<?=$bgCol?>" onclick="window.open('/inc/popup_02.php?auct_idx=<?=$arr[$i][wc_idx]?>','auction','width=840, height=530, scrollbars=yes');" style="cursor:pointer;"><?=number_format($bid_arr[0])?></td>
<?
}else if($arr[$i][wc_gubun4]>"2"){
?>
			<td bgcolor="<?=$bgCol?>" onclick="window.open('/inc/popup_02.php?auct_idx=<?=$arr[$i][wc_idx]?>','auction','width=840, height=530, scrollbars=yes');" style="cursor:pointer;"><?=number_format($bid_arr[0])?></td>
<?
}else{
?>
			<td bgcolor="<?=$bgCol?>" ><?=number_format($bid_arr[0])?></td>
<?
}
?>
            <td bgcolor="<?=$bgCol?>">
			<? if($loginUsort == "superadmin"|| $loginUsort == "admin1" || $loginUsort == "admin2"  ){ ?>
			<?=number_format($max_arr[0])?>
			<? } ?>			</td>
			<td bgcolor="<?=$bgCol?>" class="hand"> 
	        <?=WriteArrHTML('select', 'Sale', $ArrgoSale, $arow[sale_type], '', '' , 'direct', '' );?>
			<!-- 낙찰유형  --> 
			</td>
		    <td bgcolor="<?=$bgCol?>" class="hand" >
				<?=substr($arow[bid_sort_date],0,10)?>
			</td> 
             <td bgcolor="<?=$bgCol?>" class="hand" ><?=$info[company_name]?><?// if($_SERVER['REMOTE_ADDR']=="220.127.126.235"){echo $arr[$i][orm2]; } ?></td>
 
          </tr>
					<!--
         <tr>
         <td height="1" colspan="19" bgcolor="#d1d1d1"></td>
         </tr>
				 -->
          <? }} else { ?>
          <tr align="center" bgcolor="DCD8D6"> 
            <td height="38" colspan="19"> <span class="style4">검색된 자료가 없습니다.</span></td>
          </tr>
          <? } ?>
          <!-- 반복되는 줄 끝 -->
        </table>

    </form>  </td>
  </tr>
    
  <tr> 
    <td height="40" colspan="2" align="left">
<?if($loginUsort=="superadmin"||$loginUsort=="admin2"){?>
	<input type="button" name="Submit2222" value="선택삭제" class="btn_blue" style="cursor:pointer; background-color:#FFFFFF; border:1px #636563 solid; padding:5 3 3 3; font-weight:bold" onclick="javascript:delete_member()" />
      <font color=red>* 모든 정보삭제됨</font>
<?}?>
	<!--<span style="padding-left:600px;">
    <input type="button" value="차량등록" class="button4444" onClick="location.href='new.php';"></span>  -->    </td>
  </tr>
    <tr> 
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr> 
    <td colspan="2" align="center"> 
      <? include "../../inc/page.php";?>
      &nbsp;</td>
  </tr>
    <tr> 
    <td colspan="2">&nbsp;</td>
  </tr>
</table>

<? include_once "../inc/footer.php";?>
