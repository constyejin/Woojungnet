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
      <li class="tab">
        <a href="./sub05.php">낙찰현황</a>
      </li>
      <li class="tab">
        <a href="./sub03.php">관심차량</a>
      </li>
      <li class="tab active">
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

	$where = " wc_mem_id='$loginId' ";


	if($sear2){
		$where .= " and wc_made = '$sear2' ";  	
	}
	if($sear5){		
		$where .= " and wc_model = '$sear5' ";
	}
	if($sear6){
		$where .= " and ( wc_no  like '%$sear6%'  or wc_orderno  like '%$sear6%') ";  	
	}
	

	$href = "&id=$id&wc_go_type=$wc_go_type&wc_made=$wc_made&wc_model=$wc_model&Search_text=$Search_text&li=$li";  
	//echo $total_article;
 
	if($Search_text){
		$where .= "and ( e.name like '%$Search_text%' or wc_model like '%$Search_text%' or wc_orderno like '%$Search_text%' )  ";
	}
   if($wc_made){
	   $where .= " and wc_made = '$wc_made' ";
   }
   if($wc_model){
		$where .= " and wc_model='$wc_model' ";	
   }
	if($area1){
		$where .= " and wc_keep_area1 = '$area1'";  
	}
$query = "select count(*) from woojung_car as a
                       left join cate2 e on e.idx = a.wc_made 
               where $where ";  
$result = mysql_query($query); 
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
	 <?
$view_article=10;
if(!$page)	 $page=1;
$start=($page-1)*$view_article;
// echo $total_article;

if($total_article > 0){

	$Qry = "SELECT * FROM woojung_car as a
					left join woojung_car_scrap as b on a.wc_idx = b.wc_sidx
					left join woojung_car_go as c on a.wc_idx = c.wcg_wcidx
					left join woojung_car_judgment as d on a.wc_idx = d.wcj_wcidx		
					                       left join cate2 e on e.idx = a.wc_made  
			WHERE $where order by wc_idx  desc LIMIT $start, $view_article";
	// echo $Qry;
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

		if($arr[$i][wc_gubun4]=="1"){
			$loca="alert('대기중입니다.');";

		}else{
			$loca="location.href='/sub02/sub02_1_view.php?idx=".$arr[$i][wc_idx]."';";
		}
    	$car_img_arr = explode('/',$arr[$i][wc_img_1]); 
	?>
        <li class="swiper-slide">
          <div class="carbox">
            <span class="item-number">
              <?=$num?>
            </span>
            <div class="image-wrap"> 
              <img src="<?=$site_u[home_url]?>/data/<?=$car_img_arr[0]?>" alt="챠량이미지">
            </div>
            <div class="number">
              <div class="n_tit"><?=$arr[$i][wc_orderno]?></div>
              <div class="n_tit"><span class="fc-purple"><?=$arr[$i][evalAmt_type]?></span></div>
              <div class="n_tit"><span class="fc-blue"><?WriteArrHTML('radio', 'Arrgubun2', $ArrgoSale, $arr[$i][wc_go_type], '', '' , 'direct', '');?></span></div>
            </div>
  
            <div class="carname success">
              <div class="c_model"><?=$arr[$i][wc_model2]?$arr[$i][wc_model2]:""?></div>
              <div class="car-number"><?=$arr[$i][wc_no]?></div>
              
              <p class="spec">
                <span><?=substr($arr[$i][wc_age],0,4)?>-<?=substr($arr[$i][wc_age],4,2)?></span> 
                |<span><?=$arr[$i][wc_trans]?></span>
                |<span><?=$arr[$i][wc_fual]?></span>
              </p>
              <p class="location">보관: <? WriteArrHTML('select', 'area1', $ArrcarPlace , $arr[$i][wc_keep_area1], '', '' , 'direct', '' );?></p>
              <p class="message fw-bold"><?=$arr[$i][wc_regdate]?></p>
              <button class="btn btn-secondary btn-wide btn-md success-bid" onClick="window.open('../inc/receive.php?wc_idx=<?=$arr[$i][wc_idx]?>&mode=outcar','Upload','width=620, height=650');">접수증출력</button>
<?if($arr[$i][ch_ok] == "1"){?> 
              <button class="btn btn-secondary btn-wide btn-md success-bid" onClick="window.open('../inc/my_popup_04.php?wc_idx=<?=$arr[$i][wc_idx]?>&mode=outcar','Upload','width=700, height=900');">출품정산서</button>
<?}?>
            </div>
          </div>
        </li>
 <? 
	}
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