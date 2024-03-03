<?  	
	include $_SERVER['DOCUMENT_ROOT'].'/manage/inc/header.php';
	include $_SERVER['DOCUMENT_ROOT'].'/manage/inc/top_menu.php';
	include $_SERVER['DOCUMENT_ROOT'].'/manage/inc/global.php';

	if($loginUsort != "superadmin" && $loginUsort != "admin1" && $loginUsort != "admin2" && $loginUsort != "admin"){
		movepage("/index.php", "권한이 없습니다.");
		MsgMov("권한이 없습니다.","/index.php");
		exit;
	}


	$tb_name = $tablecar;
	$nowDate = date("Y-m-d");

	$YesterDate = date("Y-m-d", mktime(0, 0, 0, date("m"), date("d")-1, date("Y") ));

	$exstart_date = $start_date;


	//if(!$start_date) $exstart_date = $nowDate;
	//else $exstart_date = $start_date;


	$href = "&gubun1=$gubun1&gubun2=$gubun2&gubun3=$gubun3&gubun4=$gubun4&admidx=$admidx&searchKey=$searchKey&tm=$tm&in_name=$in_name&wc_go_type=$wc_go_type"; 
	$href .= "&start_date=$start_date&end_date=$end_date&car_cate=$car_cate&listpage=2";
	$href1 = "&page=$page".$href;
	$where = " ( wc_gubun4 in ('4', '6', '8', '10','11','12') ) ";

	
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

	if($wc_go_type){  		 
		$where .= " and c.wc_go_type  = '$wc_go_type'";  
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
		$where .= " and ( wc_no  like '%$searchKey%' or wc_mem_name like '%$searchKey%' or wc_model  like '%$searchKey%' or e.name like '%$searchKey%' or wc_model2  like '%$searchKey%' or bodam like '%$searchKey%' or e.name like '%$searchKey%' or e.bid_name like '%$searchKey%' or e.bid_company like '%$searchKey%' ) ";  	

	}




	
	if($start_date && $end_date){		
		$where .= " and substring(bid_sort_date, 1, 10)  >= '$start_date' and substring(bid_sort_date, 1, 10) <= '$end_date'";
	}
	if($start_date && !$end_date){
		$where .= " and substring(bid_sort_date, 1, 10) >= '$start_date' ";
	}
	if(!$start_date && $end_date){
		$where .= " and substring(bid_sort_date, 1, 10) <= '$end_date' ";
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

		/*
		var frm = document.Search;
		var cnt = 0;
		for(i=0;i<Search.SearchType.length;i++){
			if(Search.SearchType[i].checked == true){
				cnt = 1;
			}
		}
		//alert(cnt);
		if(cnt == 0 && !frm.start_date.value && !frm.end_date.value){
			alert("검색을 위해서는 조회구분 또는 조회일자를 선택하셔야 합니다.");
			return;
		}
		*/

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
		if(document.f.allcheck.checked == true){
			for(i=0;i<30;i++){
				document.f[i].checked = true;
			}
		} else {
			for(i=0;i<30;i++){
				document.f[i].checked = false;
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
//			alert("선택된 자료가 없습니다.");
			return;
		}

		result = confirm("한번 삭제하신 자료는 복구 불가능 합니다 \n정말 삭제 하시겠습니까??");
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
    <td height="30" align="left" class="title"><img src="/manage/img/icon02.gif"> 
      <strong>낙찰대장</strong></td>
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
            <td rowspan="6" align="center" bgcolor="#FFFFFF"><input type="submit" name="Submit" value="조회" class="button33" style="height:50 cursor:pointer; background-color:#e7f5ff; color:#084573; border:#084573 1px solid; padding:20 10 20 10; height:60px; width:70px;"  /></td>
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
            <td class="table-th" bgcolor="f6f6f6">진행구분3</td>
            <td bgcolor="#FFFFFF" style="padding:3 0 0 10; padding-left:10px;" id="SearchGubun3" align="left">
			
		

<?	
//		if( trim($gubun2) != "") WriteArrHTML('radio', 'gubun3', ${"Arrgubun3_".$gubun2}, $gubun3, '', '', '', '전체');
//		else echo "	* 진행구분 2를 선택해 주세요";

		//== /lib/code.php 안에 있음
		WriteArrHTML('radio', 'wc_go_type', $ArrgoSale, $wc_go_type, '', '', '', '전체');
		
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
                  <td width="25%" align="left" style="padding:0 0 0 0; ">
										<input name="start_date" type="text" class="input" id="sdate" value="<?=$exstart_date?>" style="width:90px;"><span>&nbsp;&nbsp;~&nbsp;&nbsp;</span><input name="end_date" type="text" class="input" id="edate" value="<?=$end_date?>" style="width:90px;">
									</td>  
                  <td width="73%" align="left">&nbsp; 
				  
				  
				  
				   
				   <input type="button" value=" 어제 " onclick="SearchDate('Y')">
					<input type="button" value=" 오늘 " onclick="SearchDate('T')">
					<input type="button" value=" 전체 " onclick="SearchDate('')"></td>
                </tr>
              </table>			  </td>
          </tr>
          <tr> 
            <td class="table-th" bgcolor="f6f6f6">검색어</td>
             <td align="left" bgcolor="#FFFFFF" style="padding:3 0 0 10; padding-left:10px;"><input type="text" name="searchKey" value="<?=$searchKey?>">
              (차번호, 신청자, 모델명)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <select name="car_cate" onchange="document.Search.submit();">
                <option value="" selected>:: 보험사선택 ::</option>
                <?
			   $team_cate_sql=mysql_query("select * from team_cate where depth='1'");
			   while($team_cate=mysql_fetch_array($team_cate_sql)){
			   ?>
                <option value="<?=$team_cate["idx"]?>" <?if($team_cate["idx"]==$car_cate){ echo "selected"; }?>>
                  <?=$team_cate["name"]?>
                </option>
                <?}?>
              </select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
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
            </select>			
&nbsp; </td>
          </tr>
        </table>
      </form></td>
  </tr>
    <tr> 
    <td height="5"></td>
  </tr>
  <script>
function exl_down(que,s,e){
/*	if(!que){
		window.open('./exldown.php?querya=1&s='+s+'&e='+e,'exl_pop','width=500,height=500');
	} else {
		window.open('./exldown.php?querya='+que+'&s='+s+'&e='+e,'exl_pop','width=500,height=500');
	}*/
	sf=document.Search;
	sf.action="exldown.php";
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
   <tr> 
    <td align="right"></td>
  </tr>
  <tr> 
    <td height="1"></td>
  </tr>
  <tr> 
    <td>
	<form name="f" action="proc.php" method="post">
        <input type="hidden" name="CarNo" value="<?=$CarNo?>">
        <input type="hidden" name="mode" value="delete">
	    	<table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#d1d1d1" class="list-table-standard">
					<colgroup>
						<col style="width:2%"/>
						<col style="width:10%"/>
						<col style="width:8%"/>
						<col style="width:7%"/>
						<col style="width:7%"/>
						<col style="width:6%"/>
						<col style="width:6%"/>
						<col style="width:6%"/>
						<col style="width:6%"/>
						<col style="width:6%"/>
						<col style="width:6%"/>
						<col style="width:6%"/>
						<col style="width:6%"/>
						<col style="width:6%"/>
						<col style="width:6%"/>
						<col style="width:6%"/>
						<col style="width:6%"/>
					</colgroup>
          <tr align="center"> 
            <td class="table-th-dark" rowspan="2" >NO</td>
            <td class="table-th-dark">차량번호</td>
            <td class="table-th-dark">낙찰자</td>
            <td class="table-th-dark">낙찰금액</td>
            <td class="table-th-dark">낙찰수수료</td>
            <td class="table-th-dark">부가세</td>
            <td class="table-th-dark">상사이전비</td>
            <td class="table-th-dark" rowspan="2">입금합계(A)</td>
            <td class="table-th-dark">차대비</td>
            <td class="table-th-dark">부가세</td>
            <td class="table-th-dark">기타비용</td>
            <td class="table-th-dark">대지급금</td>
            <td class="table-th-dark">대지급금2</td>
            <td class="table-th-dark">대지급금3</td>
            <td class="table-th-dark">추가비용</td>
            <td class="table-th-dark" rowspan="2">지출합계(B)</td>
            <td class="table-th-dark">차액(A-B)</td>
          </tr>
          <tr align="center">
            <td class="table-th-dark">모델명</td>
            <td class="table-th-dark">낙찰일자</td>
            <td class="table-th-dark">입금일자</td>
            <td class="table-th-dark">대지급금</td> 
            <td class="table-th-dark">기타비용</td>
            <td class="table-th-dark">서류대행비</td>
            <td class="table-th-dark">지급일자</td>
            <td class="table-th-dark">지급일자</td>
            <td class="table-th-dark">지급일자</td>
            <td class="table-th-dark">지급일자</td>
            <td class="table-th-dark">지급일자</td>
            <td class="table-th-dark">지급일자</td>
            <td class="table-th-dark">지급일자</td>
            <td class="table-th-dark">비고</td>
          </tr>
          <!-- 반복되는 줄 시작 -->
          <?


		if($total_article > 0){

			$Qry = "SELECT * FROM $tb_name  as a
						left join woojung_member as b  on a.wc_mem_idx = b.idx 
						left join woojung_car_go as c on a.wc_idx = c.wcg_wcidx	
						left join woojung_car_scrap as d on a.wc_idx = d.wc_sidx 
						left join woojung_bid as e on a.wc_idx = e.auct_key and e.bid_sort='Y' 
						left join woojung_member as m  on m.userId = e.userId 
						WHERE $where $where_chk order by wc_auction_date  desc LIMIT $start, $view_article";
			//echo $Qry; 
		
			
			$arr = Fetch_string($Qry);
			
			for($i=0;$i<count($arr);$i++){

				$mem_info = Row_string("SELECT * FROM woojung_member WHERE userId  = '".$arr[$i][wc_mem_id]."'");
				$com = Row_string("SELECT * FROM recruit WHERE code  = '$mem_info[code]'");

				$num = $total_article-$i-(($page-1)*$view_article);
				
				($i%2 == 0) ? $bgCol = "#ffffff" : $bgCol = "#f4ecd1";
                //echo $arr[$i][sale_type];
				if( $arr[$i][wc_gubun2] == "1" ){ // 폐차라면
					$viewpage = "view_scrap.php";
					$data1 = number($arr[$i][wc_scrap_totprice1]);
					$data2 = substr($arr[$i][im_date],0,10); // 입금일자
					$data3 = sReplace('date1', cutStr($arr[$i][wc_scrap_bank_date], 2, 8)); // 지급일자
					$data4 = number( $arr[$i][wc_scrap_rateC] ); // 대지급비용
					$data5 = number( $arr[$i][wc_scrap_totprice] ); // 입금금액
					$data6 = number( $arr[$i][wc_scrap_rateF] ); //지급금액F
					$data7 = number($arr[$i][wc_scrap_totprice] - $arr[$i][wc_scrap_rateF]); // 차액
					$data8 = number( $arr[$i][wc_scrap_rateB] ); //수수료B
				}else{
					$viewpage = "/manage/Sale02/view.php";
					$data1 = number($arr[$i][wc_accepted_priceA]);
					$data2 = substr($arr[$i][im_date],0,10); // 입금일자
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
				
			if(!$arr[$i][wc_auction]){
				$sql="select auc_orderno from woojung_bid where auct_key='".$arr[$i][wc_idx]."'";
				$wc_ido = Fetch_string($sql);
				$arr[$i][wc_auction]=$wc_ido[0][auc_orderno];
			}

			$aucSQL = "select  a.*,b.company_name  from woojung_bid as a left join woojung_member as b on a.userId=b.userId where a.auct_key='".$arr[$i][wc_idx]."' and a.bid_sort='Y' ";
			$arow = Row_string($aucSQL);
			$aucidx	 = $arow[idx];
			$aucNo	 = $arow[auc_orderno];

			if($aucidx){ // 낙찰자가 있을경우
				$aucDate = $arow[bid_sort_date];
				//mysql_query("update woojung_car set wc_auction_date='".$arow[bid_sort_date]."' where wc_idx='".$arr[$i][wc_idx]."' ");
				$info = Row_string("SELECT * FROM woojung_member WHERE userId  = '$arow[userId]'");
				$nak = Row_string("SELECT * FROM recruit WHERE code  = '$info[code]'");
			}

			$bohum=mysql_fetch_array(mysql_query("select * from team_cate where idx='".$arr[$i][car_cate]."'"));
			$cha_price=$arr[$i][wc_accepted_priceA] + $arr[$i][wc_accepted_priceC] + $arr[$i][wc_accepted_priceB]+$arr[$i][wc_accepted_priceD] + $arr[$i][wc_accepted_priceE] + $arr[$i][wc_accepted_priceF] + $arr[$i][wc_accepted_priceG]-($arr[$i][wc_pay_cost1]+$arr[$i][wc_pay_cost2]+$arr[$i][wc_pay_cost3]+$arr[$i][wc_pay_cost4]+$arr[$i][wc_pay_cost5]+$arr[$i][wc_pay_cost7]);
		  ?>
          
          <tr align="center" bgcolor="<?=$bgCol?>" style="cursor: hand; padding:3 0 0 0;" onmouseover="this.bgColor='#d9f3fb'" onmouseout="this.bgColor=''" height="25"> 

            <td rowspan="2" align="center" bgcolor="<?=$bgCol?>" class="hand" onclick="goUrl('/manage/Sale02/view.php?wc_idx=<?=$arr[$i][wc_idx]?><?=$href1?>');"><a href="<?=$viewpage?>?wc_idx=<?=$arr[$i][wc_idx]?><?=$href1?>"> 
              <?=$total_article-$i-(($page-1)*$view_article)?>
              </a></td>
            <!-- 보험사-->
            <td bgcolor="<?=$bgCol?>" class="hand" onclick="goUrl('/manage/Sale02/view.php?wc_idx=<?=$arr[$i][wc_idx]?><?=$href1?>');"><a href="<?=$viewpage?>?wc_idx=<?=$arr[$i][wc_idx]?><?=$href1?>"><?=$arr[$i][wc_no]?>
            </a></td><!-- 차량번호-->
            <td bgcolor="<?=$bgCol?>" class="hand" onclick="goUrl('/manage/Sale02/view.php?wc_idx=<?=$arr[$i][wc_idx]?><?=$href1?>');"><a href="<?=$viewpage?>?wc_idx=<?=$arr[$i][wc_idx]?><?=$href1?>">
              <?=$arow[company_name]?>
            </a></td><!-- 낙찰자-->
            <td bgcolor="<?=$bgCol?>" class="hand" onclick="goUrl('/manage/Sale02/view.php?wc_idx=<?=$arr[$i][wc_idx]?><?=$href1?>');"><?=$data1?></td><!-- 낙찰금액-->
            <td bgcolor="<?=$bgCol?>" class="hand" onclick="goUrl('/manage/Sale02/view.php?wc_idx=<?=$arr[$i][wc_idx]?><?=$href1?>');"><?=$data8?></td><!-- 낙찰수수료-->
            <td bgcolor="<?=$bgCol?>" class="hand" onclick="goUrl('/manage/Sale02/view.php?wc_idx=<?=$arr[$i][wc_idx]?><?=$href1?>');"><?=$data9?></td><!-- 부가세 -->
            <td bgcolor="<?=$bgCol?>" class="hand" onclick="goUrl('/manage/Sale02/view.php?wc_idx=<?=$arr[$i][wc_idx]?><?=$href1?>');"><?=$data11?></td><!-- 상사이전비 -->
            <td bgcolor="<?=$bgCol?>" rowspan="2" style="color:red"><?=$data5?></td><!-- 내부담당자-->
            <!-- 입금합계-->
            <td bgcolor="<?=$bgCol?>" class="hand" onclick="goUrl('/manage/Sale02/view.php?wc_idx=<?=$arr[$i][wc_idx]?><?=$href1?>');"><?=number($arr[$i][wc_pay_cost1])?></td><!-- 차대비-->
             <td bgcolor="<?=$bgCol?>" class="hand" onclick="goUrl('/manage/Sale02/view.php?wc_idx=<?=$arr[$i][wc_idx]?><?=$href1?>');"><?=number($arr[$i][wc_pay_cost6])?></td><!-- 부가세 -->
            <td bgcolor="<?=$bgCol?>" class="hand" onclick="goUrl('/manage/Sale02/view.php?wc_idx=<?=$arr[$i][wc_idx]?><?=$href1?>');"><?=number($arr[$i][wc_pay_cost5])?></td><!-- 기타비용-->
           <td bgcolor="<?=$bgCol?>" class="hand" onclick="goUrl('/manage/Sale02/view.php?wc_idx=<?=$arr[$i][wc_idx]?><?=$href1?>');"><?=number($arr[$i][wc_pay_cost2])?></td><!-- 대지급-->
             <td bgcolor="<?=$bgCol?>" class="hand" onclick="goUrl('/manage/Sale02/view.php?wc_idx=<?=$arr[$i][wc_idx]?><?=$href1?>');"><?=number($arr[$i][wc_pay_cost3])?></td>
             <!-- 상사이전-->
              <td bgcolor="<?=$bgCol?>" class="hand" onclick="goUrl('/manage/Sale02/view.php?wc_idx=<?=$arr[$i][wc_idx]?><?=$href1?>');"><?=number($arr[$i][wc_pay_cost4])?></td>
              <!-- 경매수수-->
             <td bgcolor="<?=$bgCol?>" class="hand" onclick="goUrl('/manage/Sale02/view.php?wc_idx=<?=$arr[$i][wc_idx]?><?=$href1?>');"><?=number($arr[$i][wc_pay_cost7])?></td>

            <td rowspan="2" bgcolor="<?=$bgCol?>"><a href="<?=$viewpage?>?wc_idx=<?=$arr[$i][wc_idx]?><?=$href1?>"><font color="#0033ff" class="hand"><?=number($arr[$i][wc_pay_cost1]+$arr[$i][wc_pay_cost2]+$arr[$i][wc_pay_cost3]+$arr[$i][wc_pay_cost4]+$arr[$i][wc_pay_cost5]+$arr[$i][wc_pay_cost7])?></font></a></td><!-- 지출합계-->
            <td bgcolor="<?=$bgCol?>" class="hand" onclick="goUrl('/manage/Sale02/view.php?wc_idx=<?=$arr[$i][wc_idx]?><?=$href1?>');"><?=number($cha_price)?></td><!-- 차액-->
          </tr>
          <tr align="center"  bgcolor="<?=$bgCol?>" style="cursor: hand; padding:3 0 0 0;" onmouseover="this.bgColor='#d9f3fb'" onmouseout="this.bgColor=''" height="25">
            <!-- 접수번호-->
            <td bgcolor="<?=$bgCol?>" class="hand" onclick="goUrl('/manage/Sale02/view.php?wc_idx=<?=$arr[$i][wc_idx]?><?=$href1?>');"><a href="<?=$viewpage?>?wc_idx=<?=$arr[$i][wc_idx]?><?=$href1?>">
            <?=$arr[$i][wc_model]?> <?if($arr[$i][wc_model2]) echo $arr[$i][wc_model2];?>
            </a></td>
            <!-- 모델명-->
            <td bgcolor="<?=$bgCol?>" class="hand" onclick="goUrl('/manage/Sale02/view.php?wc_idx=<?=$arr[$i][wc_idx]?><?=$href1?>');"><?//=str_replace("-", ".", cutStr($arr[$i][wc_auction_date], 2, 8) )?> <?=date("Y.m.d",strtotime($aucDate))?></td>
            <!-- 낙찰일자-->
            <td height="25" bgcolor="<?=$bgCol?>" class="hand" onclick="goUrl('/manage/Sale02/view.php?wc_idx=<?=$arr[$i][wc_idx]?><?=$href1?>');"><?=$data2?></td>
            <!-- 입금일자-->
            <td bgcolor="<?=$bgCol?>" class="hand" onclick="goUrl('/manage/Sale02/view.php?wc_idx=<?=$arr[$i][wc_idx]?><?=$href1?>');">
			<?=$data4?>
			</td>
            <!-- 대지급금-->
            <td bgcolor="<?=$bgCol?>" class="hand" onclick="goUrl('/manage/Sale02/view.php?wc_idx=<?=$arr[$i][wc_idx]?><?=$href1?>');">
		    <?=$data10?>
			</td>
            <!--기타비용-->
            <td bgcolor="<?=$bgCol?>" class="hand" onclick="goUrl('/manage/Sale02/view.php?wc_idx=<?=$arr[$i][wc_idx]?><?=$href1?>');">
		    <?=$data7?>
			</td>
            <td bgcolor="<?=$bgCol?>" class="hand" onclick="goUrl('/manage/Sale02/view.php?wc_idx=<?=$arr[$i][wc_idx]?><?=$href1?>');"><?=$arr[$i][wc_pay_date1]?></td>
            <!-- 지급일자-->
            <td bgcolor="<?=$bgCol?>" class="hand" onclick="goUrl('/manage/Sale02/view.php?wc_idx=<?=$arr[$i][wc_idx]?><?=$href1?>');"><?=$arr[$i][wc_pay_date2]?></td>
            <!-- 지급일자-->
            <td bgcolor="<?=$bgCol?>" class="hand" onclick="goUrl('/manage/Sale02/view.php?wc_idx=<?=$arr[$i][wc_idx]?><?=$href1?>');"><?=$arr[$i][wc_pay_date6]?></td>
            <!-- 지급일자-->
            <td bgcolor="<?=$bgCol?>" class="hand" onclick="goUrl('/manage/Sale02/view.php?wc_idx=<?=$arr[$i][wc_idx]?><?=$href1?>');"><?=$arr[$i][wc_pay_date5]?></td>
            <!-- 지급일자-->
            <td bgcolor="<?=$bgCol?>" class="hand" onclick="goUrl('/manage/Sale02/view.php?wc_idx=<?=$arr[$i][wc_idx]?><?=$href1?>');"><?=$arr[$i][wc_pay_date3]?></td>
            <!-- 지급일자-->
            <td bgcolor="<?=$bgCol?>" class="hand" onclick="goUrl('/manage/Sale02/view.php?wc_idx=<?=$arr[$i][wc_idx]?><?=$href1?>');"><?=$arr[$i][wc_pay_date7]?></td>
            <!-- 추가지급 지급일자-->
            <td bgcolor="<?=$bgCol?>" class="hand" onclick="goUrl('/manage/Sale02/view.php?wc_idx=<?=$arr[$i][wc_idx]?><?=$href1?>');"><?=$arr[$i][wc_pay_date4]?></td>
            <!-- 비고-->
            <td bgcolor="<?=$bgCol?>" class="hand" onclick="goUrl('/manage/Sale02/view.php?wc_idx=<?=$arr[$i][wc_idx]?><?=$href1?>');"> 
			<?=WriteArrHTML('select', 'Sale', $ArrgoSale, $arr[$i][sale_type], '', '' , 'direct', '' );?>
			</td>
            <!-- 상태-->
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
