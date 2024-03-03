<? 	
	include $_SERVER['DOCUMENT_ROOT'].'/manage/inc/header.php';
	include $_SERVER['DOCUMENT_ROOT'].'/manage/inc/top_menu.php';
	include $_SERVER['DOCUMENT_ROOT'].'/manage/inc/global.php';
	
	if($loginUsort != "admin1" &&$loginUsort != "admin2" &&$loginUsort != "superadmin"){
		echo "<script>alert('권한이 필요합니다.');history.go(-1);</script>";
		exit;
	}

	if($sb=="2"){
		$sb_title="입찰일자순";
	}else{
		$sb_title="마감일자순";
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
	
	if(!$start_date) $start_date = $nowDate;
	if(!$end_date) $end_date = $nowDate;
	$exstart_date = $start_date;


	$href = "&gubun1=$gubun1&gubun2=$gubun2&gubun3=$gubun3&gubun4=$gubun4&p=$p&admidx=$admidx&searchKey=$searchKey&end_3=$end_3&tm=$tm&ed=$ed&time_type=$time_type&sb=$sb"; 
	$href .= "&start_date=$start_date&end_date=$end_date&car_cate=$car_cate&car_cate2=$car_cate2&wc_made=$wc_made&code=$code&in_name=$in_name&wc_go_type=$wc_go_type&mem_waidx=$mem_waidx&start_time=$start_time&listpage=3";
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
	if($wc_model){
		$where .= " and wc_model='$wc_model' ";	
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

	if($wc_go_type&&$wc_go_type<4){  		 
		$where .= " and wc_go_type  = '$wc_go_type'";  
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
		$where .= " and ( wc_no  like '%$searchKey%' or wc_mem_name like '%$searchKey%' or wc_model  like '%$searchKey%' or wc_orderno like '%$searchKey%' or wc_model like '%$searchKey%' or wc_model2 like '%$searchKey%' or a.name like '%$searchKey%' or c.company_name like '%$searchKey%' ) ";  	
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

	if($mem_waidx){
		$where .= " and c.team_code  = '$mem_waidx'";
	}

	$start_date_n=str_replace("-","",$start_date);
	$end_date_n=str_replace("-","",$end_date);

	if(0){
		if($start_date && $end_date){		
			$where .= " and substring(bid_rcpt_sort_date, 1, 8)  >= '$start_date_n' and substring(bid_rcpt_sort_date, 1, 8) <= '$end_date_n'";
		}
		if($start_date && !$end_date){
			$where .= " and substring(bid_rcpt_sort_date, 1, 10) >= '$start_date_n' ";
		}
		if(!$start_date && $end_date){
			$where .= " and substring(bid_rcpt_sort_date, 1, 10) <= '$end_date_n' ";
		}
	}else if(1){
		if($start_date ){
			$where .= " and d.wc_go_end_date >= '$start_date' ";
		}
		if($end_date){
			$where .= " and d.wc_go_end_date <= '$end_date' ";
		}
		if($start_time=="1"){
			$where .= " and d.wc_go_end_hh = '09' and d.wc_go_end_mm = '30' ";
		}
		if($start_time=="2"){
			$where .= " and d.wc_go_end_hh = '10' and d.wc_go_end_mm = '30' ";
		}
		if($start_time=="3"){
			$where .= " and d.wc_go_end_hh = '13' and d.wc_go_end_mm = '30' ";
		}
		if($start_time=="4"){
			$where .= " and d.wc_go_end_hh = '15' and d.wc_go_end_mm = '30' ";
		}
	}

	//echo $where;
	$query = "select count(*) from woojung_bid as a left join woojung_car as b on a.auct_key=b.wc_idx left join woojung_member as c on a.userId=c.userId left join woojung_car_go as d on a.auct_key=d.wcg_wcidx where $where ";  
	//echo $query;
	$result = mysql_query($query, $connect);  
	$temp = mysql_fetch_array($result);  
	$total_article = $temp[0]; // 현재 쿼리한 게시물의 총 개수를 구함	
?>
<script>
	function search_form(){
		var frm = document.Search;
		frm.submit();
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
	
	function timeck(f){
		var obj = document.Search;
		obj.start_time.value=f;
		obj.submit();
	}
	function detailView(idx) {	
		window.open('../Sale/popup.php?pic=1&'+'idx='+idx,'imageWin','top=100,left=100,width=910,height=800,scrollbars=yes');
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
.style5 {font-weight: bold}
.btn_blue {
	cursor: pointer;
	background-color: #e7f1f9;
	color: #084573;
	border: #636563 1px solid;
}
</style>

 
<iframe name="gufrm" style="display:none;" src="/admin/inc/car_se.php?tmp=<?=$car_cate?>"></iframe>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
 <form name="excel" method="post" action="excel.php" target="hiddenframe">
            <input type="hidden" name="wc_idx" value="">
	</form>
  <tr> 
    <td height="20" align="left" class="title"><img src="/manage/img/icon02.gif"> 
      <strong>입찰현황/ <?=$sb_title?></strong></td>
  </tr>
  <tr> 
    <td height="10"></td>
  </tr>
<form name="Search" method="get" action="<?=$PHP_SELF?>">
<input type="hidden" name="sb" value="<?=$sb?>">
<input type="hidden" name="start_time" value="">
  <tr> 
    <td><table border="0" align="right" cellpadding="3" cellspacing="0">
      <tr>
		<td>
            <select name="car_cate" onchange="document.Search.submit();">
			  <option value="" selected>:: 보험사 ::</option>
			   <?
			   $team_cate_sql=mysql_query("select * from team_cate where depth='1'");
			   while($team_cate=mysql_fetch_array($team_cate_sql)){
			   ?>
			   <option value="<?=$team_cate["idx"]?>" <?if($team_cate["idx"]==$car_cate){ echo "selected"; }?>><?=$team_cate["name"]?></option>
			   <?}?>
			</select>
            &nbsp; 
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
            &nbsp; 
            <select name="wc_go_type" onchange="document.Search.submit();">
			  <option value="" >:: 매각유형 ::</option>
			   <option value="4" <?if($wc_go_type=="4"){ echo "selected"; }?>>전체</option>
			   <option value="1" <?if($wc_go_type=="1"){ echo "selected"; }?>>폐차</option>
			   <option value="2" <?if($wc_go_type=="2"){ echo "selected"; }?>>구제</option>
			   <option value="3" <?if($wc_go_type=="3"){ echo "selected"; }?>>폐차/구제</option>
			</select>
            &nbsp; 
            <? WriteArrHTML('select', 'gubun4', $Arrgubun4, $gubun4, 'onchange="document.Search.submit();"',  '' , 'all', ':: 구분4 ::' ); ?>
		</td>
        <td>
		마감일자
		</td>
        <td valign="top"><input name="start_date" type="text" class="input" id="sdate" value="<?=$exstart_date?>" style="width:90px;" /></td>
        <td valign="top">~ <input name="end_date" type="text" class="input" id="edate" value="<?=$end_date?>" style="width:85px;" /></td>
		<td>
		<input type="button" name="btn_time" value=" 09:30 " onClick="timeck(1);" class="btn-lightblue">
		<input type="button" name="btn_time" value=" 10:30 " onClick="timeck(2);" class="btn-lightblue">
		<input type="button" name="btn_time" value=" 13:30 " onClick="timeck(3);" class="btn-lightblue">
		<input type="button" name="btn_time" value=" 15:30 " onClick="timeck(4);" class="btn-lightblue">
		</td>
		<td>검색어</td>
        <td><input type="text" name="searchKey" value="<?=$searchKey?>" /></td>
        <td><input type="submit" value="검색" class="btn_blue" /></td>
      </tr>
    </table>
    </td>
  </tr>
</form>
  <tr> 
    <td>
	<form name="f" action="" method="post">
        <input type="hidden" name="mode" value="delete">
        <input type="hidden" name="gubun4" value="<?=$gubun4?>">
        <input type="hidden" name="page" value="<?=$page?>">



					<table width="100%" border="1" cellpadding="1" cellspacing="0" bordercolor="#626262" frame="border or box " style="border-collapse:collapse;" class='pad_10 list-table-standard'>
					<colgroup>
						<col style="width:4%"/>
						<col style="width:7%"/>
						<col style="width:6%"/>
						<col style="width:5%"/>
						<col style="width:8%"/>
						<col style="width:7%"/>
						<col style="width:5%"/>
						<col style="width:7%"/>
						<col style="width:7%"/>
						<col style="width:7%"/>
						<col style="width:4%"/>
						<!--col style="width:7%"/-->
					</colgroup>
						<tr align="center" class="sbtitle"> 
							<td class="table-th-dark">NO</td>
							<td class="table-th-dark">접수/마감일자</td>
							<td class="table-th-dark">보험사</td>
							<td class="table-th-dark">사진</td>
							<td class="table-th-dark">차량정보</td>
							<td class="table-th-dark">보관장소</td>
							<td class="table-th-dark">구분</td>
							<td class="table-th-dark">최고입찰자</td>
							<td class="table-th-dark">폐차입찰/총액</td>
							<td class="table-th-dark">구제입찰/총액</td>
							<td class="table-th-dark">입찰</td>
							<!--td class="table-th-dark">최고입찰가</td-->
						</tr>
          <!-- 반복되는 줄 시작 -->


 <?

		$Qry = "SELECT * FROM woojung_bid as a left join woojung_car as b on a.auct_key=b.wc_idx left join woojung_member as c on a.userId=c.userId left join woojung_car_go as d on a.auct_key=d.wcg_wcidx WHERE $where group by a.auct_key ";
		$arr_c = Fetch_string($Qry);
		$total_article=count($arr_c);
		 

if($total_article > 0){

	if($sb=="2"){
		$Qry = "SELECT * FROM woojung_bid as a left join woojung_car as b on a.auct_key=b.wc_idx left join woojung_member as c on a.userId=c.userId left join woojung_car_go as d on a.auct_key=d.wcg_wcidx WHERE $where order by a.idx desc LIMIT $start, $view_article";
	}else{
		$Qry = "SELECT * FROM woojung_bid as a left join woojung_car as b on a.auct_key=b.wc_idx left join woojung_member as c on a.userId=c.userId left join woojung_car_go as d on a.auct_key=d.wcg_wcidx WHERE $where group by a.auct_key order by d.wc_go_end_date desc, d.wc_go_end_hh desc, d.wc_go_end_mm desc LIMIT $start, $view_article";
	}

	//echo $Qry;
	$arr = Fetch_string($Qry);
	
	for($i=0;$i<count($arr);$i++){
		$num = $total_article-$i-(($page-1)*$view_article);
		$wcgSQL = "select  *  from woojung_car_go where wcg_wcidx='".$arr[$i][wc_idx]."'";
		$wcg = Row_string($wcgSQL);
		$bohum=mysql_fetch_array(mysql_query("select * from team_cate where idx='".$arr[$i][car_cate]."'"));
		$wc_car_img1 = explode("/",$arr[$i][wc_img_1]);
		$defaultFile = $site_u[home_url]."/data/".$wc_car_img1[0];
		$mem_info = Row_string("SELECT * FROM woojung_member WHERE userId  = '".$arr[$i][userId]."'");
		unset($bid_arr);
		$bid_arr = mysql_fetch_row(mysql_query("SELECT count(*) FROM woojung_bid  WHERE auct_key = '".$arr[$i][wc_idx]."'" ));
		unset($max_arr);unset($info);
		if($bid_arr[0]>0){
			$max_arr = mysql_fetch_row(mysql_query("SELECT bid_price,userId,total_price,bid_rcpt_sort_date,sale_type FROM woojung_bid  WHERE auct_key = '".$arr[$i][wc_idx]."' order by bid_price desc limit 1 " ));
			$userid = $max_arr[1];
			$info = Row_string("SELECT * FROM woojung_member WHERE userId  = '$userid'");
		}

		  ?>
          <tr align="center" bgcolor="<?=$bgCol?>" style="padding:3 0 0 0;" onmouseover="this.bgColor='#d9f3fb'" onmouseout="this.bgColor=''" > 
            <td height="25" bgcolor="<?=$bgCol?>" onclick="location.href='/manage/Sale02/view.php?wc_idx=<?=$arr[$i][wc_idx]?><?=$href1?>';"><?=$num?></td>
            <td bgcolor="<?=$bgCol?>" class="hand" onclick="location.href='/manage/Sale02/view.php?wc_idx=<?=$arr[$i][wc_idx]?><?=$href1?>';"><?=$arr[$i][wc_orderno]?><br /><?=substr($arr[$i][wc_regdate],0,16)?><br><font style="color:red"><?=$wcg[wc_go_end_date]?> <?=$wcg[wc_go_end_hh]?>:<?=$wcg[wc_go_end_mm]?></font></td>
            <td bgcolor="<?=$bgCol?>" class="hand" onclick="location.href='/manage/Sale02/view.php?wc_idx=<?=$arr[$i][wc_idx]?><?=$href1?>';"><?=$bohum[name]?><br><? WriteArrHTML('radio', 'wc_go_type', $ArrgoSale, $arr[$i][wc_go_type], '', '' , 'direct', ''); ?><br><?=$arr[$i][wc_cost]?></td>
		    <td bgcolor="<?=$bgCol?>" class="hand" onclick="location.href='/manage/Sale02/view.php?wc_idx=<?=$arr[$i][wc_idx]?><?=$href1?>';"><img src="<?=$defaultFile?>" style="width:100px;height:100px;"></td>
		    <td bgcolor="<?=$bgCol?>"  ><font style="color:blue;font-weight:bold;"><?=$arr[$i][wc_no]?></font><br><?=$arr[$i][wc_model]?> <?if($arr[$i][wc_model2]){echo mb_substr($arr[$i][wc_model2], 0, 10,"utf-8");}?><br><?=substr($arr[$i][wc_age],0,4)?> 년 <?=substr($arr[$i][wc_age],4,2)?> 월<br><?=number_format($arr[$i][wc_mileage])  ?>km<br><?=$arr[$i][wc_mem_name]=="동부"?$arr[$i][fual_dong]:$arr[$i][wc_fual] ?><br><?=$arr[$i][wc_mem_name]=="동부"?$arr[$i][trans_dong]:$arr[$i][wc_trans] ?></td>

		    <td align="left" bgcolor="<?=$bgCol?>" style="padding-left:10px;" ><?=WriteArrHTML('select', 'area1', $ArrcarPlace , $arr[$i][wc_keep_area1], '', '' , 'direct', '' );?> <?=$arr[$i][moveKeepReq]?></td>
          
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

			<td bgcolor="<?=$gubun_color?>" class="hand" onclick="location.href='/manage/Sale02/view.php?wc_idx=<?=$arr[$i][wc_idx]?><?=$href1?>';">
				<font color="white"><?=WriteArrHTML('checkbox', '', $Arrgubun2, $arr[$i][wc_gubun2], '', 0, 'direct', '', '', '');?><br><?
			if($arr[$i][wc_gubun2]){
				echo WriteArrHTML('checkbox', '', ${"Arrgubun3_".$arr[$i][wc_gubun2]}, $arr[$i][wc_gubun3], '', 0, 'direct', '', '', '');
			}
			?><br><?=WriteArrHTML('checkbox', '', $Arrgubun4, $arr[$i][wc_gubun4], '', 0, 'direct', '', '', '');?></font>			</td>
            
            <td bgcolor="<?=$bgCol?>" onclick="location.href='/manage/Sale02/view.php?wc_idx=<?=$arr[$i][wc_idx]?><?=$href1?>';">
			<?=$info[name]?><br><?=$info[pcs]?><br><?=$info[company_name]?>
			<br>
			<?echo substr($max_arr[3],0,4).'-'.substr($max_arr[3],4,2).'-'.substr($max_arr[3],6,2).' '.substr($max_arr[3],8,2).':'.substr($max_arr[3],10,2).':'.substr($max_arr[3],12,2);?></td>
             <td bgcolor="<?=$bgCol?>" class="hand" onclick="location.href='/manage/Sale02/view.php?wc_idx=<?=$arr[$i][wc_idx]?><?=$href1?>';"><?=$arr[$i][sale_type]=="1"?number_format($arr[$i][bid_price])."<br><font style='color:red'>".number_format($arr[$i][total_price])."</font>":""?></td>
             <td bgcolor="<?=$bgCol?>" class="hand" onclick="location.href='/manage/Sale02/view.php?wc_idx=<?=$arr[$i][wc_idx]?><?=$href1?>';"><?=$arr[$i][sale_type]=="2"?number_format($arr[$i][bid_price])."<br><font style='color:red'>".number_format($arr[$i][total_price])."</font>":""?></td>
			<td bgcolor="<?=$bgCol?>" class="hand" onclick="window.open('/inc/popup_02.php?auct_idx=<?=$arr[$i][wc_idx]?>','auction','width=840, height=530, scrollbars=yes');"><?=number_format($bid_arr[0])?></td>
			<!--td bgcolor="<?=$bgCol?>" class="hand" onclick="location.href='/manage/Sale02/view.php?wc_idx=<?=$arr[$i][wc_idx]?><?=$href1?>';"><?=number_format($max_arr[0])?><br><font style="color:red"><?=number_format($max_arr[2])?></font><br><?=$info[company_name]?><br><?=$info[name]?></td-->
          </tr>
          <? }} else { ?>
          <tr align="center" bgcolor="DCD8D6"> 
            <td height="38" colspan="14"> <span class="style4">검색된 자료가 없습니다.</span></td>
          </tr>
          <? } ?>
          <!-- 반복되는 줄 끝 -->
        </table>
    </form>  </td>
  </tr>
    
  <tr> 
    <td height="40" align="left"><!--<span style="padding-left:600px;">
    <input type="button" value="차량등록" class="button4444" onClick="location.href='new.php';"></span>  -->    </td>
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
