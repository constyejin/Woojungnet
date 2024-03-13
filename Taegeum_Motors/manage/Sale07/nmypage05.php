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
    <td align="left"  style="padding-left: 20px;"><strong>* 낙찰차량</strong></td>
  </tr>
  <tr>
    <td height="8" align="left" style="padding-left: 10px;">&nbsp;</td>
  </tr>
  <tr>
    <td height="25" align="center" valign="top"><table width="950" border="0" cellspacing="1" cellpadding="0">
      <tbody>
        <tr>
          <td bgcolor="#ebebeb"><table width="100%" bgcolor="#ffffff" border="0" cellspacing="0" cellpadding="0">
            <form action="/mypage/nmypage02.php" method="post" name="searchForm" id="searchForm2">
              <tbody>
                <tr>
                  <td align="center"><table width="100%" class="join_form">
                    <!--추가 에러-->
                    <colgroup>
                      <col width="*" />
                      <col width="*" />
                      </colgroup>
                    <tr>
                      <th width="8%" height="25" align="center" ><strong>no</strong></th>
                      <th width="10%" align="center" ><strong>접수번호</strong></th>
                      <th width="11%" align="center" ><strong>접수일자</strong></th>
                      <th width="14%" align="center" ><strong>차량번호</strong></th>
                      <th width="13%" align="center"><strong>모델명</strong></th>
                      <th width="11%" align="center"><strong>입찰유형</strong></th>
                      <th width="11%" align="center"><strong>낙찰가격</strong></th>
                      <th width="11%" align="center"><strong>낙찰정산서</strong></th>
                      <th width="11%" align="center"><strong>낙찰일자</strong></th>
                    </tr>
        <?php
	$tb_name = "woojung_bid ";
	$view_article = 10; // 한화면에 나타날 게시물의 총 개수  
	if (!$page) $page = 1; // 현재 페이지 지정되지 않았을 경우 1로 지정  
	$start = ($page-1)*$view_article; 
	 
	$href = "&pop_id=$pop_id";  
                
		$where = " 1=1 ";	


		//echo $where;
		$query = "select count(*) from woojung_bid as a
							left join woojung_car as b on a.auct_key = b.wc_idx
							left join woojung_car_go c on a.auct_key = c.wcg_wcidx
					where  a.userId='$pop_id' 
							and a.bid_sort = 'Y'  
							and ( b.wc_gubun2='2' || b.wc_gubun2='3' )
							and  (b.wc_gubun4='4' || b.wc_gubun4='6'|| b.wc_gubun4='8'|| b.wc_gubun4='9'|| b.wc_gubun4='10' ) ";  
		//echo $query;
		$result = mysql_query($query);  
		//echo $result;
		$temp = mysql_fetch_array($result);  
		$total_article = $temp[0]; // 현재 쿼리한 게시물의 총 개수를 구함	

			$qry = "select * from woojung_bid as a
							left join woojung_car as b on a.auct_key = b.wc_idx
							left join woojung_car_go c on a.auct_key = c.wcg_wcidx
					where  a.userId='$pop_id' 
							and a.bid_sort = 'Y'  
							and ( b.wc_gubun2='2' || b.wc_gubun2='3' )
							and  (b.wc_gubun4='4' || b.wc_gubun4='6'|| b.wc_gubun4='8'|| b.wc_gubun4='9'|| b.wc_gubun4='10' )
							
					order by b.wc_auction_date desc LIMIT $start, $view_article";
			
		
		//echo $qry;

		$auctQuery = $db->query($qry);
		@mysql_close();

		 while($auctRow = mysql_fetch_object($auctQuery)) {

			 $num = $total_article-$i-(($page-1)*$view_article);
 ?>
                    <tr style="cursor: hand;" onmouseover="this.bgColor='#d9f3fb'" onmouseout="this.bgColor=''">
                      <td width="8%" height="25" align="center" valign="middle"><?=$num?></td>
                      <td width="10%" align="center" valign="middle"><?=$auctRow->wc_orderno?></td>
                      <td width="11%" align="center" valign="middle"><?=substr($auctRow->wc_regdate,0,10)?></td>
                      <td width="14%" align="center" valign="middle"><?=$auctRow->wc_no?></td>
                      <td width="13%" align="center" valign="middle"><?=$auctRow->wc_model?></td>
                      <td width="11%" align="center" valign="middle"><?=WriteArrHTML('checkbox', '', $ArrgoSale, $auctRow->sale_type, '', 0, 'direct', '', '', '');?></td>
                      <td width="11%" align="center" valign="middle"><?=number_format($auctRow->bid_price)?></td>
                      <td width="11%" align="center" valign="middle"><a onclick="window.open('/inc/my_popup_03.php?wc_idx=<?=$auctRow->wc_idx?>','jungsan','width=700, height=900, scrollbars=yes');"><img src="/images/icon1_2.png" border="0" /></a></td>
                      <td width="11%" align="center" valign="middle"><?=substr($auctRow->wc_auction_date,0,10)?></td>
                    </tr>
        <?

	$i++;
}?>
                    <!--tr style="cursor: hand;" onmouseover="this.bgColor='#d9f3fb'" onmouseout="this.bgColor=''">
                      <td width="8%" height="25" align="center" valign="middle">1</td>
                      <td width="10%" align="center" valign="middle">13-1000336</td>
                      <td width="11%" align="center" valign="middle">2013-08-26</td>
                      <td width="14%" align="center" valign="middle">서울 2자 1234</td>
                      <td width="13%" align="center" valign="middle">에쿠스3.3</td>
                      <td align="center" valign="middle">폐차</td>
                      <td align="center" valign="middle">10,000,000</td>
                      <td width="11%" align="center" valign="middle"><a href="#" style="border:none;"><img src="/images/icon1_2.png" border="0" /></a></td>
                      <td align="center" valign="middle">2013-08-26</td>
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
      </table></td>
  </tr>
</table>
