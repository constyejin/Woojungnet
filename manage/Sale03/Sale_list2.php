<? 	
	include $_SERVER['DOCUMENT_ROOT'].'/manage/inc/header.php';
	include $_SERVER['DOCUMENT_ROOT'].'/manage/inc/top_menu.php';
	include $_SERVER['DOCUMENT_ROOT'].'/manage/inc/global.php';
	
	if($loginUsort != "admin1" &&$loginUsort != "admin2" &&$loginUsort != "superadmin"){
		echo "<script>alert('권한이 필요합니다.');history.go(-1);</script>";
	exit;
	}

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
		$sql_tm="select * from woojung_car where 1 ";
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

	$href = "&gubun1=$gubun1&gubun2=$gubun2&gubun3=$gubun3&gubun4=$gubun4&p=$p&admidx=$admidx&searchKey=$searchKey&end_3=$end_3&tm=$tm&ed=$ed&wtime=$wtime"; 
	$href .= "&start_date=$start_date&end_date=$end_date&car_cate=$car_cate&car_cate2=$car_cate2&wc_made=$wc_made&code=$code&in_name=$in_name&wc_go_type=$wc_go_type&listpage=4";
	$href1 = "&page=$page".$href;
	if($tm=="1"){$where = " today_ib>0 ";}elseif($ed=="1"){$where=" end_da ='".date("Y-m-d")."' ";}else{$where = " 1=1 ";}


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

	if($searchKey){
		$where .= " and ( wc_no  like '%$searchKey%' or wc_mem_name like '%$searchKey%' or wc_model  like '%$searchKey%' or wc_orderno like '%$searchKey%' or wc_model like '%$searchKey%' or wc_model2 like '%$searchKey%' or a.name like '%$searchKey%' ) ";  	
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
$start_date_n=str_replace("-","",$start_date);
$end_date_n=str_replace("-","",$end_date);
	if($start_date && $end_date){		
		$where .= " and substring(bid_rcpt_sort_date, 1, 8)  >= '$start_date_n' and substring(bid_rcpt_sort_date, 1, 8) <= '$end_date_n'";
	}
	if($start_date && !$end_date){
		$where .= " and substring(bid_rcpt_sort_date, 1, 10) >= '$start_date_n' ";
	}
	if(!$start_date && $end_date){
		$where .= " and substring(bid_rcpt_sort_date, 1, 10) <= '$end_date_n' ";
	}
	if($wtime=="1" ){
		$where .= " and wc_go_end_hh = '11' ";
	}
	if($wtime=="2" ){
		$where .= " and wc_go_end_hh = '14' ";
	}
	//echo $where;
	$query = "select count(*) from woojung_bid_log as a left join woojung_car as b on a.auct_key=b.wc_idx where $where ";  
	//echo $query;
	$result = mysql_query($query, $connect);  
	$temp = mysql_fetch_array($result);  
	$total_article = $temp[0]; // 현재 쿼리한 게시물의 총 개수를 구함	
	
?>
<script>
	function search_form(){
		var frm = document.Search;

		/*
		var cnt = 0;
		for(i=0;i< frm.nowtype.length; i++){
			if(frm.nowtype[i].checked == true){
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

		result = confirm("한번 삭제하신 자료는 복구 불가능 합니다.\n\n정말 삭제 하시겠습니까??");
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

function car_chk(z){ 
	var tmp = z.options[z.selectedIndex].value; 
	document.Search.car_cate2.options[0].selected="true";
	gufrm.location.href = "/admin/inc/car_se.php?tmp="+tmp;  
} 
	function timeck(f){
		var obj = document.Search;
//		SearchDate('T');
		obj.wtime.value=f;
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

 
<iframe name="HiddenFrm" id="HiddenFrm" style="display:none;"></iframe>
<iframe name="gufrm" style="display:none;" src="/admin/inc/car_se.php?tmp=<?=$car_cate?>"></iframe>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
 <form name="excel" method="post" action="excel.php" target="hiddenframe">
            <input type="hidden" name="wc_idx" value="">
	</form>
  <tr> 
    <td height="20" align="left" class="title"><img src="/manage/img/icon02.gif"> 
      <strong>입찰기록</strong></td>
  </tr>
  <tr> 
    <td height="10"></td>
  </tr>
<form name="Search" method="post" action="<?=$PHP_SELF?>">
  <tr> 
    <td><table border="0" align="right" cellpadding="3" cellspacing="0">
      <tr>
        <td>입찰일자</td>
        <td valign="top">
					<input name="start_date" type="text" class="input" id="sdate" value="<?=$exstart_date?>" style="width:90px;" />
					<span>&nbsp;&nbsp;~&nbsp;&nbsp;</span>
					<input name="end_date" type="text" class="input" id="edate" value="<?=$end_date?>" style="width:85px;" />
				</td>
        <td valign="top">
				</td>
        <td>
          <input name="button2" type="button" onclick="SearchDate('T')" value=" 오늘 " />
            <input name="button" type="button" onclick="SearchDate('Y')" value=" 어제 " />
          <input name="button" type="button" onclick="SearchDate('')" value=" 전체 " /></td>
        <td>검색어</td>
        <td><input type="text" name="searchKey" value="<?=$searchKey?>" /></td>
        <td><input type="submit" value="검색" class="button33" style="height:50 cursor:pointer; background-color:#e7f5ff; color:#084573; border:#084573 1px solid; height:22px; width:50px;"  /></td>
      </tr>
    </table>
    </td>
  </tr>
</form>
  <tr> 
    <td>
	<form name="f" action="proc.php" method="post" target="HiddenFrm">
        <input type="hidden" name="mode" value="delete">
        <input type="hidden" name="gubun4" value="<?=$gubun4?>">
        <input type="hidden" name="page" value="<?=$page?>">



	   <table width="100%" border="0" cellspacing="1" cellpadding="0" style="word-break:break-all;" class="list-table-standard">
		 <colgroup>
			<col style="width:1%"/>
			<col style="width:5%"/>
			<col style="width:7%"/>
			<col style="width:7%"/>
			<col style="width:7%"/>
			<col style="width:9%"/>
			<col style="width:5%"/>
			<col style="width:7%"/>
			<col style="width:5%"/>
			<col style="width:9%"/>
			<col style="width:9%"/>
			<col style="width:10%"/>
			<col style="width:7%"/>
			<col style="width:8%"/>
			<col style="width:8%"/>
		</colgroup>
		<tr align="center" class="sbtitle"> 
			<td class="table-th-dark"> 
				<!-- 전체 선택 -->
				<input type="checkbox" name="allcheck" id="allcheck" onClick="all_check()" />
			</td>
			<td class="table-th-dark">NO</td>
			<td class="table-th-dark">접수번호</td>
			<td class="table-th-dark">접수일</td>
			<td class="table-th-dark">차량번호</td>
			<td class="table-th-dark">모델명</td>
			<td class="table-th-dark">구분1</td>
			<td class="table-th-dark">구분2</td>
			<td class="table-th-dark">구분4</td>
			<td class="table-th-dark">마감일자</td>
			<td class="table-th-dark">입찰일시</td> 
			<td class="table-th-dark">회사명</td>
			<td class="table-th-dark">입찰자</td>
			<td class="table-th-dark">폐차</td>
			<td class="table-th-dark">명의이전</td>
		</tr>
		<!-- 반복되는 줄 시작 -->


 <?

		 

if($total_article > 0){

	$Qry = "SELECT * FROM woojung_bid_log as a left join woojung_car as b on a.auct_key=b.wc_idx WHERE $where order by idx desc LIMIT $start, $view_article";

	//echo $Qry;
	$arr = Fetch_string($Qry);
	
	for($i=0;$i<count($arr);$i++){
		$num = $total_article-$i-(($page-1)*$view_article);
		$wcgSQL = "select  *  from woojung_car_go where wcg_wcidx='".$arr[$i][wc_idx]."'";
		$wcg = Row_string($wcgSQL);
				$info = Row_string("SELECT * FROM woojung_member WHERE userId  = '".$arr[$i][userId]."'"); 

		  ?>
          <tr align="center" bgcolor="<?=$bgCol?>" style="cursor: hand; padding:3 0 0 0;" onmouseover="this.bgColor='#d9f3fb'" onmouseout="this.bgColor=''" > 
            <td bgcolor="<?=$bgCol?>" >
			<input type="checkbox" name="check[]" id="check[]" value="<?=$arr[$i][idx]?>" />
			<input type="hidden" name="checkout[]" id="checkout[]" value="<?=$arr[$i][wc_idx]?>" />			</td>
            <td height="25" bgcolor="<?=$bgCol?>"><?=$num?></td>
            <td bgcolor="<?=$bgCol?>" class="hand" onclick="goUrl('../Sale02/view.php?wc_idx=<?=$arr[$i][wc_idx]?><?=$href1?>');"><?=$arr[$i][wc_orderno]?></td>
            <td bgcolor="<?=$bgCol?>" class="hand" onclick="goUrl('../Sale02/view.php?wc_idx=<?=$arr[$i][wc_idx]?><?=$href1?>');"><?=substr( $arr[$i][wc_regdate], 0, 10)?></td>
		    <td bgcolor="<?=$bgCol?>" class="hand" onclick="goUrl('../Sale02/view.php?wc_idx=<?=$arr[$i][wc_idx]?><?=$href1?>');"><?=$arr[$i][wc_no]?></td>
		   <td align="left" bgcolor="<?=$bgCol?>" class="hand" style="padding-left:10px;" onclick="goUrl('../Sale02/view.php?wc_idx=<?=$arr[$i][wc_idx]?><?=$href1?>');"><?=$arr[$i][wc_model]?><?if($arr[$i][wc_model2]){echo mb_substr($arr[$i][wc_model2], 0, 10,"utf-8");}?></td>
          
            <td bgcolor="<?=$bgCol?>" class="hand" onclick="goUrl('../Sale02/view.php?wc_idx=<?=$arr[$i][wc_idx]?><?=$href1?>');">
			<?=WriteArrHTML('checkbox', '', $Arrgubun2, $arr[$i][wc_gubun2], '', 0, 'direct', '', '', '');?>&nbsp;</td>
            
			
			<td bgcolor="<?=$bgCol?>" class="hand" onclick="goUrl('../Sale02/view.php?wc_idx=<?=$arr[$i][wc_idx]?><?=$href1?>');">
			<?
			if($arr[$i][wc_gubun2]){
				echo WriteArrHTML('checkbox', '', ${"Arrgubun3_".$arr[$i][wc_gubun2]}, $arr[$i][wc_gubun3], '', 0, 'direct', '', '', '');
			}
			?>			</td>
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

			<td bgcolor="<?=$gubun_color?>" class="hand" onclick="goUrl('../Sale02/view.php?wc_idx=<?=$arr[$i][wc_idx]?><?=$href1?>');">
				<font color="white"><?=WriteArrHTML('checkbox', '', $Arrgubun4, $arr[$i][wc_gubun4], '', 0, 'direct', '', '', '');?></font>			</td>
            
			<td bgcolor="<?=$bgCol?>" class="hand" onclick="goUrl('../Sale02/view.php?wc_idx=<?=$arr[$i][wc_idx]?><?=$href1?>');"><?=$wcg[wc_go_end_date]?> <?=$wcg[wc_go_end_hh]?>:<?=$wcg[wc_go_end_mm]?></td>
			<td bgcolor="<?=$bgCol?>" style="cursor:pointer;" onclick="goUrl('../Sale02/view.php?wc_idx=<?=$arr[$i][wc_idx]?><?=$href1?>');"><?echo substr($arr[$i][bid_rcpt_sort_date],0,4).'-'.substr($arr[$i][bid_rcpt_sort_date],4,2).'-'.substr($arr[$i][bid_rcpt_sort_date],6,2).' '.substr($arr[$i][bid_rcpt_sort_date],8,2).':'.substr($arr[$i][bid_rcpt_sort_date],10,2).':'.substr($arr[$i][bid_rcpt_sort_date],12,2);?></td>
            <td bgcolor="<?=$bgCol?>" onclick="goUrl('../Sale02/view.php?wc_idx=<?=$arr[$i][wc_idx]?><?=$href1?>');"><?=$info[company_name]?></td>
            <td bgcolor="<?=$bgCol?>" onclick="goUrl('../Sale02/view.php?wc_idx=<?=$arr[$i][wc_idx]?><?=$href1?>');"><?=$arr[$i][name]?></td>
             <td bgcolor="<?=$bgCol?>" class="hand" onclick="goUrl('../Sale02/view.php?wc_idx=<?=$arr[$i][wc_idx]?><?=$href1?>');"><?=$arr[$i][sale_type]=="1"?number_format($arr[$i][bid_price]):""?></td>
             <td bgcolor="<?=$bgCol?>" class="hand" onclick="goUrl('../Sale02/view.php?wc_idx=<?=$arr[$i][wc_idx]?><?=$href1?>');"><?=$arr[$i][sale_type]=="2"?number_format($arr[$i][bid_price]):""?></td>
          </tr>
          <? }} else { ?>
          <tr align="center" bgcolor="DCD8D6"> 
            <td height="38" colspan="15"> <span class="style4">검색된 자료가 없습니다.</span></td>
          </tr>
          <? } ?>
          <!-- 반복되는 줄 끝 -->
        </table>
    </form>  </td>
  </tr>
    
  <tr> 
    <td height="40" align="left">
<?if($_SESSION["loginId"]=="drg1038"){?>
	<input type="button" name="Submit2222" value="선택삭제" class="btn_blue" style="cursor:pointer; background-color:#FFFFFF; border:1px #636563 solid; padding:5 3 3 3; font-weight:bold" onclick="javascript:delete_member()" />
<?}?>
	</td>
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
