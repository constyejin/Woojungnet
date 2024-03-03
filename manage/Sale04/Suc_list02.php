<?  	
	include $_SERVER['DOCUMENT_ROOT'].'/manage/inc/header.php';
	include $_SERVER['DOCUMENT_ROOT'].'/manage/inc/top_menu.php';
	include $_SERVER['DOCUMENT_ROOT'].'/manage/inc/global.php';

	$tb_name = $tablecar;
	$nowDate = date("Y-m-d");

	$YesterDate = date("Y-m-d", mktime(0, 0, 0, date("m"), date("d")-1, date("Y") ));

	$exstart_date = $start_date;


	//if(!$start_date) $exstart_date = $nowDate;
	//else $exstart_date = $start_date;


	$href = "&gubun1=$gubun1&gubun2=$gubun2&gubun3=$gubun3&gubun4=$gubun4&admidx=$admidx&searchKey=$searchKey&tm=$tm&in_name=$in_name"; 
	$href .= "&start_date=$start_date&end_date=$end_date&car_cate=$car_cate&listpage=3";
	$href1 = "&page=$page".$href;
	$where = " ( wc_gubun4 in ('4', '6', '8', '9','10','11','12') ) ";

	
	#조회 버튼 입력시
	if($tm){
		$where .= " and bid_sort_date  like '".date("Y-m-d")."%'  ";
	}
	if($gubun1){  		 
		$where .= " and wc_gubun1  = '$gubun1'";  
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


	if($admidx){  		 
		$where .= " and wc_adminidx  = '$admidx'";  
	}  
	
	if($car_cate){
		$where .= " and car_cate  = '$car_cate'";
	}

	if($end_3){
		$where .= " and end_3  = '$end_3'";
	}

	if($re_1){
		$where .= " and b.code  = '$re_1'";
	}

	if($re_2){
		$where .= " and m.code  = '$re_2'";
	}

	if($in_name){
		$where .= " and in_name  = '$in_name'";
	}

	if($searchKey){
		$where .= " and ( wc_no  like '%$searchKey%' or wc_mem_name like '%$searchKey%' or wc_model  like '%$searchKey%' or e.name like '%$searchKey%' or wc_model2  like '%$searchKey%' or e.name like '%$searchKey%' or e.bid_name like '%$searchKey%' or e.bid_company like '%$searchKey%' ) ";  	

	}



	if($gubun4=="4"){
		if($start_date && $end_date){		
			$where .= " and substring(bid_sort_date, 1, 10)  >= '$start_date' and substring(bid_sort_date, 1, 10) <= '$end_date'";
		}
		if($start_date && !$end_date){
			$where .= " and substring(bid_sort_date, 1, 10) >= '$start_date' ";
		}
		if(!$start_date && $end_date){
			$where .= " and substring(bid_sort_date, 1, 10) <= '$end_date' ";
		}
	}else if($gubun4=="6"){
		if($start_date && $end_date){		
			$where .= " and substring(wc_auction, 1, 10)  >= '$start_date' and substring(wc_auction, 1, 10) <= '$end_date'";
		}
		if($start_date && !$end_date){
			$where .= " and substring(wc_auction, 1, 10) >= '$start_date' ";
		}
		if(!$start_date && $end_date){
			$where .= " and substring(wc_auction, 1, 10) <= '$end_date' ";
		}
	}else{
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
	//echo $where;

	if ($michk == "T"){
		$where_chk = " and wc_mi_chk = 'T' ";
	}

	$query = "SELECT count(*) FROM $tb_name  as a
						left join woojung_member as b  on a.wc_mem_idx = b.idx 
						left join woojung_car_go as c on a.wc_idx = c.wcg_wcidx	
						left join woojung_car_scrap as d on a.wc_idx = d.wc_sidx 
						left join woojung_bid as e on a.wc_idx = e.auct_key and e.bid_sort='Y' 
						left join woojung_member as m  on m.userId = e.userId 
						WHERE $where $where_chk order by wc_auction_date  desc ";

	//$query = "select count(*) from $tb_name where $where";  
	$result = mysql_query($query, $connect);  
	//echo $query;
	$temp = mysql_fetch_array($result);  
	$total_article = $temp[0]; // 현재 쿼리한 게시물의 총 개수를 구함	
	
?>
<script>
	function search_form(){

		frm.submit();
	}
	
	function show_etc(num){
		if(num == 0){
			document.getElementById('etc').style.display = '';
		} else {
			document.getElementById('etc').style.display = 'none';
		}
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



</script>
<script>
function exl_down(que,s,e){
	sf=document.Search;
	sf.action="exldown_new.php";
	sf.target="hiddenframe";
	sf.submit();
	sf.action="";
	sf.target="";
}

function michk()
{
	document.location.href="Suc_list.php?michk=T";
}

</script>
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
<style type="text/css">
.style1 {color: #FFFFFF}
</style>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td height="30" align="left" class="title"><img src="/manage/img/icon_1.jpg" class="bullet"> 
      <strong>낙찰(경리용) </strong></td>
  </tr>
  <tr> 
    <td>
	<form name="Search" method="get" action="<?=$PHP_SELF?>">
	    <table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="d1d1d1" class="table-style">
				<colgroup>
					<col style="width: 120px;">
					<col style="width: auto;">
					<col style="width: 120px;">
				</colgroup>
          <tr> 
            <td class="table-th" bgcolor="f6f6f6">진행구분1</td>
            <td align="left" bgcolor="#FFFFFF" style="padding:3 0 0 10; padding-left:10px;"> 

<?
		//== /lib/code.php 안에 있음
		WriteArrHTML('radio', 'gubun2', $Arrgubun2, $gubun2, '', '', '', '전체');
?></td>
            <td rowspan="5"bgcolor="#FFFFFF"><input type="submit" name="Submit" value="조회" class="button33" style="height:50 cursor:pointer; background-color:#e7f5ff; color:#084573; border:#084573 1px solid; padding:20 10 20 10; height:60px; width:70px;"  /></td>
          </tr>
          <tr> 
            <td class="table-th" bgcolor="f6f6f6">진행구분2</td>
            <td align="left" bgcolor="#FFFFFF" style="padding:3 0 0 10; padding-left:10px;">


<?
		//== /lib/code.php 안에 있음
		WriteArrHTML('radio', 'gubun3', $Arrgubun3_2s, $gubun3, '', '', '', '전체');
?></td>
          </tr>
        <tr> 
            <td class="table-th" bgcolor="f6f6f6">진행구분4</td>
          <td bgcolor="#FFFFFF" style="padding:3 0 0 10; padding-left:10px;" align="left">


<?
		//== /lib/code.php 안에 있음
		WriteArrHTML('radio', 'gubun4', $Arrgubun4, $gubun4, '', '', '', '전체');
?></td>
          </tr>
          <tr>
            <td class="table-th" bgcolor="f6f6f6">낙찰일자</td>
            <td align="left" bgcolor="#FFFFFF" style="padding:3 0 0 10; padding-left:10px;">
			
			<table width="98%" border="0" cellpadding="0" cellspacing="0">
                <tr> 
                  <td width="25%">
										<input name="start_date" type="text" class="input"  id="sdate" value="<?=$exstart_date?>" style="width:90px;"><span>&nbsp;&nbsp;~&nbsp;&nbsp;</span><input name="end_date" type="text" class="input" id="edate" value="<?=$end_date?>" style="width:90px;">
									</td>
                  <td width="63%" align="left">
				   <input type="button" value=" 어제 " onclick="SearchDate('Y')">
					<input type="button" value=" 오늘 " onclick="SearchDate('T')">
					<input type="button" value=" 전체 " onclick="SearchDate('')"></td>
                </tr>
              </table>			  </td>
          </tr>
          <tr> 
            <td class="table-th" bgcolor="f6f6f6">검색어</td>
             <td align="left" bgcolor="#FFFFFF" style="padding:3 0 0 10; padding-left:10px;"><input type="text" name="searchKey" value="<?=$searchKey?>">
              (차번호, 신청자, 모델명)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;보험사:
              <select name="car_cate" onchange="document.Search.submit();">
                <option value="" selected>:: 선택 ::</option>
                <?
			   $team_cate_sql=mysql_query("select * from team_cate where depth='1'");
			   while($team_cate=mysql_fetch_array($team_cate_sql)){
			   ?>
                <option value="<?=$team_cate["idx"]?>" <?if($team_cate["idx"]==$car_cate){ echo "selected"; }?>>
                  <?=$team_cate["name"]?>
                </option>
                <?}?>
              </select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			내부담당:
			<select name="in_name" onchange="document.Search.submit();">
              <option value="" selected="selected">:: 담당자 ::</option>
<?
	    $qry = "SELECT * FROM woojung_admin order by waidx desc ";
  		$arr = Fetch_string($qry);

		for($i=0;$i<count($arr);$i++){	
?>
						<option value="<?=$arr[$i][waname]?>" <?if($arr[$i][waname]==$in_name) echo "selected";?>><?=$arr[$i][waname]?></option>
<?
		}
?>
            </select>			
&nbsp; </td>
          </tr>
        </table>
      </form></td>
  </tr>
    <tr> 
    <td height="5"></td>
  </tr>
   <tr> 
    <td align="right">&nbsp;&nbsp;<img src="../img/btnl_excel.gif" onclick="exl_down('<?=urlencode($where)?>','<?=$start?>','<?=$view_article?>')" style="cursor:hand;" align="absmiddle"></td>
  </tr>
  <tr> 
    <td height="1"></td>
  </tr>
  <tr> 
    <td>
	<form name="f" action="proc.php" method="post">
        <input type="hidden" name="CarNo" value="<?=$CarNo?>">
        <input type="hidden" name="mode" value="delete">
        <table width="100%" border="0" cellspacing="1" cellpadding="0" style="word-break:break-all;" class="list-table-standard">
				<colgroup>
					<col style="width:3%;">
					<!--
					<col style="width:4%;">
					<col style="width:5%;">
					<col style="width:4%;">
					<col style="width:5%;">
					<col style="width:6%;">
					<col style="width:3%;">
					<col style="width:4%;">
					<col style="width:4%;">
					<col style="width:4%;">
					<col style="width:4%;">
					<col style="width:4%;">
					<col style="width:4%;">
					<col style="width:4%;">
					<col style="width:4%;">
					<col style="width:4%;">
					<col style="width:4%;">
					<col style="width:4%;">
					<col style="width:4%;">
					<col style="width:4%;">
					<col style="width:3%;">
					<col style="width:4%;">
					<col style="width:4%;">
					<col style="width:5%;">
					-->
				</colgroup>
          <tr align="center" class="sbtitle">
		  <!--
            <td class="table-th-dark"> 
                <input type="checkbox" name="allcheck" id="allcheck" onclick="all_check()" />            </td> -->
            <td class="table-th-dark" height="28" >NO</td>
            <td class="table-th-dark" >접수일자</td>
            <td class="table-th-dark">출품사</td>
            <td class="table-th-dark">차량번호</td>
            <td class="table-th-dark">모델명</td>
            <td class="table-th-dark">낙찰자</td>
            <td class="table-th-dark">낙찰유형</td>
            <td class="table-th-dark">낙찰일자</td>
            <td class="table-th-dark">낙찰금액</td>
            <td class="table-th-dark">부가세</td>
            <td class="table-th-dark">수수료</td>
            <td class="table-th-dark">대지급금</td>
            <td class="table-th-dark">상사이전비</td>
            <td class="table-th-dark">서류대행비</td>
            <td class="table-th-dark">기타비용</td>
            <td class="table-th-dark">입금합계</td>
            <td class="table-th-dark">차대비</td> 
            <td class="table-th-dark">부가세</td>
            <td class="table-th-dark">기타비용</td>
            <td class="table-th-dark">대지급금</td>
            <td class="table-th-dark">추가비용</td>
            <td class="table-th-dark">지출합계</td>
            <td class="table-th-dark">담당자</td>
            <td class="table-th-dark">종결일자</td>
            <td class="table-th-dark">차액</td>
            <td class="table-th-dark">구분2</td>
          </tr>
          <?


		if($total_article > 0){

			$Qry = "SELECT * FROM $tb_name  as a
						left join woojung_member as b  on a.wc_mem_idx = b.idx 
						left join woojung_car_go as c on a.wc_idx = c.wcg_wcidx	
						left join woojung_car_scrap as d on a.wc_idx = d.wc_sidx 
						left join woojung_bid as e on a.wc_idx = e.auct_key and e.bid_sort='Y' 
						WHERE $where $where_chk order by wc_auction_date  desc LIMIT $start, $view_article";
			//echo $Qry;
		
			
			$arr = Fetch_string($Qry);
			
			for($i=0;$i<count($arr);$i++){

				$mem_info = Row_string("SELECT * FROM woojung_member WHERE userId  = '".$arr[$i][wc_mem_id]."'");
				$com = Row_string("SELECT * FROM recruit WHERE code  = '$mem_info[code]'");

				$num = $total_article-$i-(($page-1)*$view_article);
				
				($i%2 == 0) ? $bgCol = "#ffffff" : $bgCol = "#f4ecd1";
				
				if( $arr[$i][wc_gubun2] == "1" ){ // 폐차라면
					$viewpage = "view_scrap.php";
					$data1 = number($arr[$i][wc_scrap_totprice1]);
					$data2 = sReplace('date1', cutStr($arr[$i][wc_scrap_receipt_date], 2, 8)); // 입금일자
					$data3 = sReplace('date1', cutStr($arr[$i][wc_scrap_bank_date], 2, 8)); // 지급일자
					$data4 = number( $arr[$i][wc_scrap_rateC] ); // 대지급비용
					$data5 = number( $arr[$i][wc_scrap_totprice] ); // 입금금액
					$data6 = number( $arr[$i][wc_scrap_rateF] ); //지급금액F
					$data7 = number($arr[$i][wc_scrap_totprice] - $arr[$i][wc_scrap_rateF]); // 차액
					$data8 = number( $arr[$i][wc_scrap_rateB] ); //수수료B
				}else{
					$viewpage = "/manage/Sale02/view.php";
					$data1 = number($arr[$i][wc_accepted_priceA]);
					$data2 = sReplace('date1', cutStr($arr[$i][wc_accepted_real_date], 2, 8) ); // 입금일자
					$data3 = sReplace('date1', cutStr($arr[$i][wc_pay_date], 2, 8) ); // 지급일자
					$data4 = number( $arr[$i][wc_accepted_priceD] ); // 대지급비용
					$data6 = number( $arr[$i][wc_tot_priceK] ); //지급금액F
					$data7 = number($arr[$i][wc_accepted_priceF]) ; // 서류대행비
					$data8 = number($arr[$i][wc_accepted_priceC]); //수수료
					$data9 = number($arr[$i][wc_accepted_priceB]); //부가세
					$data10 = number($arr[$i][wc_accepted_priceG]); //기타비용
					$data11 = number($arr[$i][wc_accepted_priceE]); //상사이전비
					if($arr[$i][sale_type] == '1'){
						$data5 =  number($arr[$i][wc_accepted_priceA] + $arr[$i][wc_accepted_priceC] + $arr[$i][wc_accepted_priceB]+$arr[$i][wc_accepted_priceD] + $arr[$i][wc_accepted_priceE] + $arr[$i][wc_accepted_priceF] + $arr[$i][wc_accepted_priceG] ); // 입금금액
					}else{
						$data5 =  number($arr[$i][wc_accepted_priceA] + $arr[$i][wc_accepted_priceC] + $arr[$i][wc_accepted_priceB]+$arr[$i][wc_accepted_priceD] + $arr[$i][wc_accepted_priceE] + $arr[$i][wc_accepted_priceF] + $arr[$i][wc_accepted_priceG] ); // 입금금액
					}
				}
				
/*			if(!$arr[$i][wc_auction]){
				$sql="select auc_orderno from woojung_bid where auct_key='".$arr[$i][wc_idx]."'";
				$wc_ido = Fetch_string($sql);
				$arr[$i][wc_auction]=$wc_ido[0][auc_orderno];
			}
*/
			$aucSQL = "select  a.*,b.company_name  from woojung_bid as a left join woojung_member as b on a.userId=b.userId where a.auct_key='".$arr[$i][wc_idx]."' and a.bid_sort='Y' ";
			$arow = Row_string($aucSQL);
			$aucidx	 = $arow[idx];
			$aucNo	 = $arow[auc_orderno];

			if($aucidx){ // 낙찰자가 있을경우
				$aucDate = $arow[bid_sort_date];
				//mysql_query("update woojung_car set wc_auction_date='".$arow[bid_sort_date]."' where wc_idx='".$arr[$i][wc_idx]."' ");
				$info = Row_string("SELECT * FROM woojung_member WHERE userId  = '$arow[userId]'");
				$nak = Row_string("SELECT * FROM recruit WHERE code  = '$info[code]'");
				$sale_type = $arow[sale_type];
			}

			$bohum=mysql_fetch_array(mysql_query("select * from team_cate where idx='".$arr[$i][car_cate]."'"));
			$cha_price=$arr[$i][wc_accepted_priceA] + $arr[$i][wc_accepted_priceC] + $arr[$i][wc_accepted_priceB]+$arr[$i][wc_accepted_priceD] + $arr[$i][wc_accepted_priceE] + $arr[$i][wc_accepted_priceF] + $arr[$i][wc_accepted_priceG]-($arr[$i][wc_pay_cost1]+$arr[$i][wc_pay_cost2]+$arr[$i][wc_pay_cost3]+$arr[$i][wc_pay_cost4]+$arr[$i][wc_pay_cost5]+$arr[$i][wc_pay_cost7]);

		  ?>
          <tr align="center" bgcolor="<?=$bgCol?>" style="cursor: hand; padding:3 0 0 0;"  >
		  <!--
            <td bgcolor="<?=$bgCol?>" ><input type="checkbox" name="check[]" id="check[]" value="<?=$arr[$i][wc_idx]?>" />
                <input type="hidden" name="checkout[]" id="checkout[]" value="<?=$arr[$i][wc_idx]?>" />            </td>  -->
            <td height="25" bgcolor="<?=$bgCol?>"><a href="<?=$viewpage?>?wc_idx=<?=$arr[$i][wc_idx]?><?=$href1?>"><?=$total_article-$i-(($page-1)*$view_article)?></a></td>
            <td bgcolor="<?=$bgCol?>" class="hand" onclick="goUrl('/manage/Sale02/view.php?wc_idx=<?=$arr[$i][wc_idx]?><?=$href1?>');"><?=substr( $arr[$i][wc_regdate], 0, 10)?></td>
            <td bgcolor="<?=$bgCol?>" class="hand" onclick="goUrl('/manage/Sale02/view.php?wc_idx=<?=$arr[$i][wc_idx]?><?=$href1?>');"><?=$bohum[name]?></td>
            <td bgcolor="<?=$bgCol?>"  class="hand" onclick="goUrl('/manage/Sale02/view.php?wc_idx=<?=$arr[$i][wc_idx]?><?=$href1?>');"><?=$arr[$i][wc_no]?></td>
            <td bgcolor="<?=$bgCol?>" class="hand" onclick="goUrl('/manage/Sale02/view.php?wc_idx=<?=$arr[$i][wc_idx]?><?=$href1?>');"><?if($arr[$i][wc_model]) echo mb_substr($arr[$i][wc_model],0,10,"utf-8");?></td>
            <td bgcolor="<?=$bgCol?>" class="hand" onclick="goUrl('/manage/Sale02/view.php?wc_idx=<?=$arr[$i][wc_idx]?><?=$href1?>');"><?=$info[company_name]?></td>
            <td align="center" bgcolor="<?=$bgCol?>" class="hand" onclick="goUrl('/manage/Sale02/view.php?wc_idx=<?=$arr[$i][wc_idx]?><?=$href1?>');"><?=WriteArrHTML('select', 'Sale', $ArrgoSale, $sale_type, '', '' , 'direct', '' );?></td> <? // 낙찰유형 ?>
            <td bgcolor="<?=$bgCol?>" class="hand" onclick="goUrl('/manage/Sale02/view.php?wc_idx=<?=$arr[$i][wc_idx]?><?=$href1?>');"><?=date("Y-m-d",strtotime($aucDate))?></td>
            <td bgcolor="<?=$bgCol?>" class="hand" onclick="goUrl('/manage/Sale02/view.php?wc_idx=<?=$arr[$i][wc_idx]?><?=$href1?>');"><?=$data1?></td>
						<td bgcolor="<?=$bgCol?>" class="hand"><?=number($arr[$i][wc_accepted_priceB])?></td> <!--  부가세 -->
            <td bgcolor="<?=$bgCol?>" class="hand" onclick="goUrl('/manage/Sale02/view.php?wc_idx=<?=$arr[$i][wc_idx]?><?=$href1?>');"><?=$data8?></td><!--수수료-->
            <td bgcolor="<?=$gubun_color?>" class="hand" onclick="goUrl('/manage/Sale02/view.php?wc_idx=<?=$arr[$i][wc_idx]?><?=$href1?>');"><!--대지급금-->
			<?=$data4?>
            </td>
							
            <td bgcolor="<?=$bgCol?>" class="hand"><?=$data11?></td><!--  상사이전비 -->
            <td bgcolor="<?=$bgCol?>" class="hand"><?=$data7?></td><!--  서류대행비 -->
            <td bgcolor="<?=$bgCol?>" class="hand"><?=number($arr[$i][wc_accepted_priceG])?></td><!--  기타비용 -->
            
            <td bgcolor="<?=$bgCol?>" class="hand" style="color:#FF0000"><?=$data5?></td>
            <td bgcolor="<?=$bgCol?>" class="hand"><?=number($arr[$i][wc_pay_cost1])?></td> <? // 차대비 ?> 
            <td bgcolor="<?=$bgCol?>" class="hand"><?=number($arr[$i][wc_pay_cost5])?></td> <? // 구가세 ?> 
            <td bgcolor="<?=$bgCol?>" class="hand"><?=number($arr[$i][wc_pay_cost5])?></td>
            <td bgcolor="<?=$bgCol?>" class="hand"><?=number($arr[$i][wc_pay_cost2]+$arr[$i][wc_pay_cost3]+$arr[$i][wc_pay_cost4])?></td>
            <td bgcolor="<?=$bgCol?>" class="hand"><?=number($arr[$i][wc_pay_cost7])?></td>
            <td bgcolor="<?=$bgCol?>" class="hand" style="color:#0066CC"><?=number($arr[$i][wc_pay_cost1]+$arr[$i][wc_pay_cost2]+$arr[$i][wc_pay_cost3]+$arr[$i][wc_pay_cost4]+$arr[$i][wc_pay_cost5]+$arr[$i][wc_pay_cost7])?></td>
            <td bgcolor="<?=$bgCol?>" class="hand"><?=$arr[$i][in_name]?></td>
            <td bgcolor="<?=$bgCol?>" class="hand"><?=$arr[$i][wc_auction]?></td> <? // 종결일 ?>
            <td bgcolor="<?=$bgCol?>" class="hand"><?=number($cha_price)?></td>
            <td bgcolor="<?=$bgCol?>" class="hand"><? if($arr[$i][wc_gubun2]){ echo WriteArrHTML('checkbox', '', ${"Arrgubun3_".$arr[$i][wc_gubun2]}, $arr[$i][wc_gubun3], '', 0, 'direct', '', '', '');} ?></td>
          </tr>
          <!-- 반복되는 줄 끝 -->
          <? }} else { ?>
          <tr align="center"> 
            <td height="38" colspan="17" bgcolor="#FFFFFF"> <span class="style4">검색된 
              자료가 없습니다.</span></td>
          </tr>
          <? } ?>
        </table>
	</form></td>
  </tr>
  <tr> 
    <td height="40" align="left">&nbsp;</td>
  </tr>
  <tr> 
    <td>&nbsp;</td>
  </tr>
  <tr> 
    <td align="center"> 
      <? include "../../inc/page.php";?>
      &nbsp;</td>
  </tr>
  <tr> 
    <td>&nbsp;</td>
  </tr>
</table>

<? include_once "../inc/footer.php";?>
