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
    <td align="left" style="padding-left: 20px;"><strong>* 관심차량보기</strong></td>
  </tr>
  <tr>
    <td height="8" align="left"><span class="style1"></span></td>
  </tr>
  <tr>
    <td height="25" align="center" valign="top"><table width="950" border="0" cellspacing="1" cellpadding="0">
      <tbody>
        <tr>
          <td bgcolor="#ebebeb"><table width="100%" bgcolor="#ffffff" border="0" cellspacing="0" cellpadding="0">
            <form action="/mypage/nmypage02.php" method="post" name="searchForm" id="searchForm">
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
                      <th width="13%" align="center" ><strong>차량번호</strong></th>
                      <th width="14%" align="center"><strong>모델명</strong></th>
                      <th width="11%" align="center"><strong>년식</strong></th>
                      <th width="11%" align="center"><strong>변속기</strong></th>
                      <th width="11%" align="center"><strong>구분</strong></th>
                      <th width="11%" align="center"><strong>진행상태</strong></th>
                    </tr>
<?
	$view_article=10;
	if(!$page)	 $page=1;
	$start=($page-1)*$view_article;
	$href = "&pop_id=$pop_id";  

	$query = "select count(*) from  car_zzim as a left join woojung_car as b on a.no=b.wc_idx where a.userid='$pop_id' and b.wc_gubun4='2' ";
	$result = mysql_query($query);
	$temp = mysql_fetch_array($result);  
	$total_article = $temp[0]; // 현재 쿼리한 게시물의 총 개수를 구함	
		
	$qry = "select * from car_zzim as a left join woojung_car as b on a.no=b.wc_idx where a.userid='$pop_id' and b.wc_gubun4='2' order by idx desc LIMIT $start, $view_article ";
	//echo $qry;	
	$auctQuery = $db->query($qry);
	$i=0;
	while($zzim_row = mysql_fetch_object($auctQuery)) {
	
		$num = $total_article-$i-(($page-1)*$view_article);
		$car_sql = "select * from woojung_car as a left join woojung_car_go as b on a.wc_idx = b.wcg_wcidx where a.wc_idx='".$zzim_row->no."'";
		$car_qry = $db->query($car_sql);
		$auctRow=mysql_fetch_object($car_qry);
		
		if(!$auctRow->wc_orderno){
			$car_del = "delete from car_zzim where idx='".$zzim_row->idx."'";
			$db->query($car_del);
		}

		$nacChk=$auctRow->bid_sort; 
		if($nacChk=="Y"){
			$nacPay=number_format($auctRow->bid_price);
		} else {
			$nacPay="";
		}
 ?>
                    <tr style="cursor: hand;" onmouseover="this.bgColor='#d9f3fb'" onmouseout="this.bgColor=''">
                      <td width="8%" height="25" align="center" valign="middle"><?=$num?></td>
                      <td width="10%" align="center" valign="middle"><a href="#"><?=$auctRow->wc_orderno?></a></td>
                      <td width="11%" align="center" valign="middle"><?=substr( $auctRow->wc_regdate, 0, 10)?></td>
                      <td width="13%" align="center" valign="middle"><?=$auctRow->wc_no?></td>
                      <td width="14%" align="center" valign="middle"><?=$auctRow->wc_model?></td>
                      <td width="11%" align="center" valign="middle"><?=substr($auctRow->wc_age,0,4)."년 ".substr($auctRow->wc_age,2,2)."월"?></td>
                      <td width="11%" align="center" valign="middle"><?=$auctRow->wc_trans?></td>
                      <td width="11%" align="center" valign="middle"><?=WriteArrHTML('radio', 'wc_go_type', $ArrgoSale, $auctRow->wc_go_type, '', '' , 'direct', '')?></td>
                      <td width="11%" align="center" valign="middle"><?=WriteArrHTML('select', 'gubun4', $Arrgubun4, $auctRow->wc_gubun4, '', '' , 'direct' , '')?></td>
                    </tr>
  <?
			$i++;
		}?>      
                    <!--tr style="cursor: hand;" onmouseover="this.bgColor='#d9f3fb'" onmouseout="this.bgColor=''">
                      <td width="8%" height="25" align="center" valign="middle">1</td>
                      <td width="10%" align="center" valign="middle"><a href="#">13-1000336</a></td>
                      <td width="11%" align="center" valign="middle">2013-08-26</td>
                      <td width="13%" align="center" valign="middle">서울 2자 1234</td>
                      <td width="14%" align="center" valign="middle">에쿠스3.3</td>
                      <td align="center" valign="middle">2008-01</td>
                      <td align="center" valign="middle">오토</td>
                      <td align="center" valign="middle">경매도난</td>
                      <td align="center" valign="middle">진행</td>
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
