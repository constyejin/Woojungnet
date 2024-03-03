<?
	include $_SERVER['DOCUMENT_ROOT'].'/manage/inc/header.php';
?>
<style>
  table.join_form{
    border-collapse: collapse;
  }
  table.join_form th, table.join_form td{
    border: 1px solid #b2b2b2;
  }
  table.join_form th{
    background-color: #f6f6f6;
  }
</style>
<table width="950" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td align="left" style="padding-left: 20px;"><strong>* 접수(경,공매)현황</strong></td>
  </tr>
  <tr> 
    <td colspan="2" align="center"><div id="outTable" style="display:<?=$outTable?>;">
	  <table width="950" border="0" cellspacing="1" cellpadding="0">
        <tbody>
          <tr>
            <td bgcolor="#ebebeb"><table width="100%" bgcolor="#ffffff" border="0" cellspacing="0" cellpadding="0">
                <form action="/mypage/nmypage02.php" method="post" name="searchForm" id="searchForm">
                  <tbody>
                    <tr>
                      <td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <!--추가 에러-->
                          <colgroup>
                          <col width="*" />
                          <col width="*" />
                          </colgroup>

                          <tr>
                            <td width="150" height="8" align="right">&nbsp;</td>
                          </tr>
                        </table>
                          <table width="100%" class="join_form">
                            <!--추가 에러-->
                            <colgroup>
                            <col width="*" />
                            <col width="*" />
                            </colgroup>
                            <tr>
                              <th width="8%" height="25" align="center" ><strong>no</strong></th>
                              <th width="10%" align="center" ><strong>접수번호</strong></th>
                              <th width="11%" align="center" ><strong>접수일자</strong></th>
                              <th width="13%" align="center" ><strong>차량번호</strong></th>
                              <th width="14%" align="center"><strong>모델명</strong></th>
                              <th width="11%" align="center"><strong>접수증</strong></th>
                              <th width="11%" align="center"><strong>감정평가</strong></th>
                              <th width="11%" align="center"><strong>출품정산서</strong></th>
                              <th width="11%" align="center"><strong>입찰자</strong></th>
                            </tr>
	 <?
	$where = " wc_mem_id='$pop_id' ";


	if($wc_no){
		$where .= " and ( wc_no  like '%$wc_no%'  or wc_model  like '%$wc_no%') ";  	

	}

	if($start_date && $end_date){		
		$where .= " and substring(wc_regdate, 1, 10)  >= '$start_date' and substring(wc_regdate, 1, 10) <= '$end_date'";
	}
	if($start_date && !$end_date){
		$where .= " and substring(wc_regdate, 1, 10) >= '$start_date' ";
	}
	if(!$start_date && $end_date){
		$where .= " and substring(wc_regdate, 1, 10) <= '$end_date' ";
	}
	

$query = "select count(*) from woojung_car where $where ";  
$result = mysql_query($query); 
$temp = mysql_fetch_array($result);  
$total_article = $temp[0]; // 현재 쿼리한 게시물의 총 개수를 구함	
//	echo $query ;
$view_article=10;
if(!$page)	 $page=1;
$start=($page-1)*$view_article;
$href = "&pop_id=$pop_id";  

if($total_article > 0){

	$Qry = "SELECT * FROM woojung_car as a
					left join woojung_car_scrap as b on a.wc_idx = b.wc_sidx
					left join woojung_car_go as c on a.wc_idx = c.wcg_wcidx
					left join woojung_car_judgment as d on a.wc_idx = d.wcj_wcidx					
			WHERE $where order by wc_idx  desc LIMIT $start, $view_article";
	//echo $Qry;
	$arr = Fetch_string($Qry);
	
	for($i=0;$i<count($arr);$i++){

		$num = $total_article-$i-(($page-1)*$view_article);
		($i%2 == 0) ? $bgCol = "#f3f3f3" : $bgCol = "#ffffff";
			
	
		/*
		$Arrgubun2 = array(
			"폐차"=>"1",
			"손상차"=>"2",
			"특수차"=>"3",
			"감정평가"=>"4",
			"기타"=>"5"
		);
		*/

		$viewBtn = "";
		if($arr[$i][wc_gubun2] == "1"){ // 폐차
			if($arr[$i][wc_scrap_view] == "Y"){
				$viewBtn = "<a href=\"javascript:;\" onclick=\"window.open('../inc/train_statement.php?wc_idx=".$arr[$i][wc_idx]."','jungsan','width=630, scrollbars=yes');\">보기</a>";
			}
		}elseif($arr[$i][wc_gubun2] == "2" || $arr[$i][wc_gubun2] == "3"){ // 손상차, 특수차
			if($arr[$i][wcg_view1] == "Y"){
				$viewBtn = "<a href=\"javascript:;\" onclick=\"window.open('../inc/search_train_statement.php?wc_idx=".$arr[$i][wc_idx]."','jungsan','width=630, scrollbars=yes');\">보기</a>";
			}
		}elseif($arr[$i][wc_gubun2] == "4"){ // 감정평가
			if($arr[$i][wcj_view] == "Y"){
				$viewBtn = "<a href=\"javascript:;\" onclick=\"window.open('../inc/jodgment_pop.php?wc_idx=".$arr[$i][wc_idx]."','jungsan','width=630, scrollbars=yes');\">보기</a>";
			}
		}
	?>
                          
                            <tr style="cursor: hand;" onmouseover="this.bgColor='#d9f3fb'" onmouseout="this.bgColor=''">
                              <td width="8%" height="25" align="center" valign="middle"><?=$num?></td>
                              <td width="10%" align="center" valign="middle"><?=$arr[$i][wc_orderno]?></td>
                              <td width="11%" align="center" valign="middle"><?=substr( $arr[$i][wc_regdate], 0, 10)?></td>
                              <td width="13%" align="center" valign="middle"><?=$arr[$i][wc_no]?></td>
                              <td width="14%" align="center" valign="middle"><?=$arr[$i][wc_model]?></td>
                              <td width="11%" align="center" valign="middle"><a onClick="window.open('/inc/receive.php?wc_idx=<?=$arr[$i][wc_idx]?>&mode=outcar','Upload','width=620, height=650');"><img src="/images/icon2_2.png" border="0" /></a></td>
                              <td width="11%" align="center" valign="middle"><a onClick="window.open('/inc/my_popup_05.php?wc_idx=<?=$arr[$i][wc_idx]?>&mode=outcar','Upload','width=700, height=900');"><img src="/images/icon3_2.png" border="0" /></a></td>
                              <td width="11%" align="center" valign="middle"><a onClick="window.open('/inc/my_popup_04.php?wc_idx=<?=$arr[$i][wc_idx]?>&mode=outcar','Upload','width=700, height=900');"><img src="/images/icon4_2.png" border="0" /></a></td>
                              <td width="11%" align="center" valign="middle"><a onClick="window.open('/mypage/auction_popup.php?auct_idx=<?=$arr[$i][wc_idx]?>','auction','width=830, height=530, scrollbars=yes');"><img src="/images/icon5_2.png" border="0" /></a></td>
                            </tr>
 <? 
		 }
	} 
 ?>
                            <!--tr style="cursor: hand;" onmouseover="this.bgColor='#d9f3fb'" onmouseout="this.bgColor=''">
                              <td width="8%" height="25" align="center" valign="middle">1</td>
                              <td width="10%" align="center" valign="middle">13-1000336</td>
                              <td width="11%" align="center" valign="middle">2013-08-26</td>
                              <td width="13%" align="center" valign="middle">서울 2자 1234</td>
                              <td width="14%" align="center" valign="middle">에쿠스3.3</td>
                              <td align="center" valign="middle"><a href="#"><img src="/images/icon2_2.png" border="0" /></a></td>
                              <td align="center" valign="middle"><a href="#"><img src="/images/icon3_2.png" border="0" /></a></td>
                              <td align="center" valign="middle"><a href="#"><img src="/images/icon4_2.png" border="0" /></a></td>
                              <td align="center" valign="middle"><a href="#"><img src="/images/icon5_2.png" border="0" /></a></td>
                            </tr-->
                        </table></td>
                    </tr>
                  </tbody>
                </form>
            </table></td>
          </tr>
        </tbody>
      </table>
	  <br />
	  <br />
      <table width="730" border="0" cellspacing="0" cellpadding="0">
        <tr align="center">
          <td align="center"><? include "../../inc/page.php";?></td>
        </tr>
      </table>
	</div></td>
  </tr>
  <tr> 
    <td height="25" colspan="2" align="center">&nbsp;</td>
  </tr>
</table>