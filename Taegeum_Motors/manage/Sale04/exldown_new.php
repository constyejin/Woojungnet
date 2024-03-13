<?
header("Content-type: application/vnd.ms-excel; charset=euc-kr"); 	
header("Content-Disposition: attachment; filename=exel_".date("Y-m-d").".xls"); 
header("Expires: 0"); 
header("Content-Description: PHP4 Generated Data"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("Pragma: public");

@ini_set('memory_limit',-1);

@session_start();

function dbconn(){ 	
	$connect = mysql_connect("localhost","incaron","wjn6511!@#$") or die("에러 : 디비 연결 오류 입니다."); 
	mysql_select_db("incaron",$connect) or die("에러 : 데이터 베이스 선택 오류 입니다."); 
	return $connect; 
}

function dbclose(){
	mysql_close();
}

function Row_string($str){
	global $connect;
	//echo $str;
	$result = mysql_query($str, $connect);
	$row = mysql_fetch_assoc($result);
	return $row;
}
function Query_string($str){
	global $connect;
	//echo $str;
	$result = mysql_query($str, $connect);
	return $result;
}
function Fetch_string($str){
	global $connect;
	//echo $str;
	$result = mysql_query($str, $connect);
	for($i=0;$i<=$arr=mysql_fetch_array($result);$i++){		
		$ret_file[$i] = $arr;
	}		
	return $ret_file;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>incaron_admin</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<?
	include_once ($_SERVER['DOCUMENT_ROOT']."/lib/code.php");
	$connect = dbconn();
	$tb_name = "woojung_car";
		$nowDate = date("Y-m-d");

	$YesterDate = date("Y-m-d", mktime(0, 0, 0, date("m"), date("d")-1, date("Y") ));

	$exstart_date = $start_date;


	$href = "&gubun1=$gubun1&gubun2=$gubun2&gubun3=$gubun3&gubun4=$gubun4&admidx=$admidx&searchKey=$searchKey&tm=$tm&in_name=$in_name"; 
	$href .= "&start_date=$start_date&end_date=$end_date&car_cate=$car_cate";
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
		$where .= " and ( wc_no  like '%$searchKey%' or wc_mem_name like '%$searchKey%' or wc_model  like '%$searchKey%' or e.name like '%$searchKey%' or wc_model2  like '%$searchKey%' or bodam like '%$searchKey%' or e.name like '%$searchKey%' or e.bid_name like '%$searchKey%' or e.bid_company like '%$searchKey%' ) ";
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
<meta http-equiv="Content-Type" content="application/vnd.ms-excel;charset=euc-kr">

	   <table width="100%" border="0" cellspacing="1" cellpadding="0" style="word-break:break-all;">
          <tr align="center"> 
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
						left join woojung_member as m  on m.userId = e.userId 
						WHERE $where $where_chk order by wc_auction_date  desc ";
			//echo $Qry;
			//$ttt="a";
			//echo $ttt;
		
			
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
					$viewpage = "view.php";
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
            <td bgcolor="<?=$bgCol?>" class="hand" onclick="goUrl('/manage/Sale02/view.php?wc_idx=<?=$arr[$i][wc_idx]?><?=$href1?>');"><?if($arr[$i][wc_model2]) echo mb_substr($arr[$i][wc_model2],0,10,"utf-8");?></td>
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
<?
}
			}
?>
</table>