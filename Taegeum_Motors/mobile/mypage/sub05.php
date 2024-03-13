<?
include $_SERVER['DOCUMENT_ROOT']."/inc/header.php";
include $_SERVER['DOCUMENT_ROOT']."/inc/menu.php";
if(!$loginId){
	echo "<script>alert('로그인후 사용 가능합니다.');history.back();</script>";
}
?>
  <section class="title-wrap">
    <h2>마이페이지</h2>
  </section>
  
  <section class="tab-wrap wide-type">
    <ul>
      <li class="tab">
        <a href="./sub04.php">입찰현황</a>
      </li>
      <li class="tab active">
        <a href="./sub05.php">낙찰현황</a>
      </li>
      <li class="tab">
        <a href="./sub03.php">관심차량</a>
      </li>
      <li class="tab">
        <a href="./sub01.php">접수현황</a>
      </li>
      <li class="tab">
        <a href="./sub07.php">회원정보수정</a>
      </li>
    </ul>
  </section>

<form name="searchForm" method="get" style="padding:0px;margin:0px;">
  <section class="filter-wrap">
    <div class="filter my-bid">
      <ul>
        <li>
          <select name="wc_made" id="" onchange="document.searchForm.submit();">
            <option value="">==제조사==</option>
						<?
							$team_cate_sql=mysql_query("select * from cate2 where depth='1'");
							while($team_cate=mysql_fetch_array($team_cate_sql)){
						?>
						<option value="<?=$team_cate["idx"]?>" <?if($team_cate["idx"]==$wc_made){ echo "selected"; }?>>
							<?=$team_cate["name"]?>
						</option>
						<?}?> 
          </select>
        </li>
        <li>
		<?
		//== /lib/code.php 안에 있음
		WriteArrHTML('select', 'area1', $ArrcarPlace , $area1, 'onchange="document.searchForm.submit();"', '' , 'all', '==보관지역==' );
		?>
        </li>
        <li>
          <div class="search-input-wrap">
            <input type="text" class="search-input" name="Search_text" value="<?=$Search_text?>">
            <button class="btn-search">
              <img src="<?=$site_u[home_url]?>/images/front/icon_search.png" alt="검색아이콘">
            </button>
          </div>
        </li>
      </ul>
    </div>
  </section>
 </form>
<?
	$tb_name = "woojung_bid ";
	$view_article = 10; // 한화면에 나타날 게시물의 총 개수  
	if (!$page) $page = 1; // 현재 페이지 지정되지 않았을 경우 1로 지정  
	$start = ($page-1)*$view_article;  
                
	$href = "&id=$id&wc_go_type=$wc_go_type&wc_made=$wc_made&wc_model=$wc_model&Search_text=$Search_text&li=$li";  
	//echo $total_article;
 
	$where = "  ";
	if($Search_text){
		$where .= "and ( d.name like '%$Search_text%' or wc_model like '%$Search_text%' or wc_orderno like '%$Search_text%' )  ";
	}
   if($wc_made){
	   $where .= " and wc_made = '$wc_made' ";
   }
   if($wc_model){
		$where .= " and wc_model='$wc_model' ";	
   }
	if($wc_go_type){  		 
		$where .= " and c.wc_go_type  = '$wc_go_type'";  
	}   
	if($area1){
		$where .= " and b.wc_keep_area1 = '$area1'";  
	}

		//echo $where;
		$query = "select count(*) from woojung_bid as a
							left join woojung_car as b on a.auct_key = b.wc_idx
							left join woojung_car_go c on a.auct_key = c.wcg_wcidx
							left join cate2 d on d.idx = b.wc_made
					where  a.userId='$loginId' 
							and a.bid_sort = 'Y'  
							and ( b.wc_gubun2='2' || b.wc_gubun2='3' )
							and (b.wc_gubun4='4' || b.wc_gubun4='6'|| b.wc_gubun4='8'|| b.wc_gubun4='10' || b.wc_gubun4='11' || b.wc_gubun4='12' ) 
							$where
							";  
	 //echo $query;
		$result = mysql_query($query);  
		//echo $result;
		$temp = mysql_fetch_array($result);  
		$total_article = $temp[0]; // 현재 쿼리한 게시물의 총 개수를 구함	
?>
  <section class="car-list-wrap mypage">
    <div class="count">
      <p><span class="fc-emphas"><?=$total_article?></span>개 매물 있음</p> 
      ㅣ 이전/다음은 좌우로 이동하세요
    </div>
    <div class="car-list swiper">
      <ul class="swiper-wrapper">
 <?php

			$qry = "select * from woojung_bid as a
							left join woojung_car as b on a.auct_key = b.wc_idx
							left join woojung_car_go c on a.auct_key = c.wcg_wcidx
							left join cate2 d on d.idx = b.wc_made
					where  a.userId='$loginId' 
							and a.bid_sort = 'Y'  
							and ( b.wc_gubun2='2' || b.wc_gubun2='3' )
							and  (b.wc_gubun4='4' || b.wc_gubun4='6'|| b.wc_gubun4='8'|| b.wc_gubun4='10'|| b.wc_gubun4='11' || b.wc_gubun4='12'  ) 
							$where
					order by b.wc_auction_date desc LIMIT $start, $view_article";
			
		
		//echo $qry;

		$auctQuery = $db->query($qry);

		 while($auctRow = mysql_fetch_object($auctQuery)) {

			 $num = $total_article-$i-(($page-1)*$view_article);
	    	 $car_img_arr = explode('/',$auctRow->wc_img_1);
		
 ?>
        <li class="swiper-slide">
          <div class="carbox">
            <span class="item-number">
              <?=$num?>
            </span>
            <div class="image-wrap" onclick="location.href='/sub02/sub02_1_view.php?idx=<?=$auctRow->wc_idx?>';"> 
              <img src="<?=$site_u[home_url]?>/data/<?=$car_img_arr[0]?>" alt="챠량이미지">
            </div>
            <div class="number" onclick="location.href='/sub02/sub02_1_view.php?idx=<?=$auctRow->wc_idx?>';">
              <div class="n_tit"><?=$auctRow->wc_orderno?></div>
              <div class="n_tit"><span class="fc-purple"><?=$auctRow->evalAmt_type?></span></div>
              <div class="n_tit"><span class="fc-blue"><?WriteArrHTML('radio', 'Arrgubun2', $ArrgoSale, $auctRow->wc_go_type, '', '' , 'direct', '');?></span></div>
            </div>
  
            <div class="carname success">
              <div class="c_model" onclick="location.href='/sub02/sub02_1_view.php?idx=<?=$auctRow->wc_idx?>';"><?=$auctRow->wc_model?> <?if($row->wc_model2) echo $row->wc_model2;?></div>
              <div class="car-number" onclick="location.href='/sub02/sub02_1_view.php?idx=<?=$auctRow->wc_idx?>';"><?=$auctRow->wc_no?></div>
              
              <p class="spec" onclick="location.href='/sub02/sub02_1_view.php?idx=<?=$auctRow->wc_idx?>';">
                <span><?=substr($auctRow->wc_age,0,4)?>-<?=substr($auctRow->wc_age,4,2)?></span> 
                |<span><?=$auctRow->wc_trans?></span>
                |<span><?=$auctRow->wc_fual?></span>
              </p>
              <p class="location">보관: <? WriteArrHTML('select', 'area1', $ArrcarPlace , $auctRow->wc_keep_area1, '', '' , 'direct', '' );?></p>
              <p class="bid-finish"><span>입찰일:</span><span class="fw-bold "><?=substr($auctRow->bid_rcpt_sort_date,0,4).'-'.substr($auctRow->bid_rcpt_sort_date,4,2).'-'.substr($auctRow->bid_rcpt_sort_date,6,2)?></span> </p>
              <p class="message fc-red"><span>낙찰일:</span><span class="fw-bold"><?=substr($auctRow->wc_auction_date,0,10)?></span></p>
              <button class="btn btn-secondary btn-wide btn-md success-bid" onclick="window.open('/inc/my_popup_03.php?wc_idx=<?=$auctRow->wc_idx?>','jungsan','width=700, height=900, scrollbars=yes');">낙찰정산서</button>
            </div>
          </div>
        </li>
<? 
	$i++;
}
?>        
      </ul>
      <div class="swiper-button-next"></div>
      <div class="swiper-button-prev"></div>
    </div>
  </section>
<?
include $_SERVER['DOCUMENT_ROOT']."/inc/footer.php";
?>
</body>
</html>