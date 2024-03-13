<?
include $_SERVER['DOCUMENT_ROOT']."/inc/header.php";
include $_SERVER['DOCUMENT_ROOT']."/inc/menu.php";
if(!$loginId){
	echo "<script>alert('로그인후 사용 가능합니다.');history.back();</script>";
}
?>
<script>
function auctionView_pubauct(a,b,c){
	location.href="/sub02/sub02_1_view.php?idx="+a;
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
</script>

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
      <li class="tab active">
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
$view_article=10;
if(!$page)	 $page=1;
$start=($page-1)*$view_article;

                
	$href = "&id=$id&wc_go_type=$wc_go_type&wc_made=$wc_made&wc_model=$wc_model&Search_text=$Search_text&li=$li";  
	//echo $total_article;

	$where = "  ";
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

	$query = "select count(*) from  car_zzim as a 
	                                   left join woojung_car as b on a.no=b.wc_idx  
						   			   left join cate2 d on d.idx = b.wc_made
							left join woojung_car_go c on a.no = c.wcg_wcidx
									   where a.userid='".$_SESSION[loginId]."' and b.wc_gubun4='2' $where";
	$result = mysql_query($query);
	$temp = mysql_fetch_array($result);  
	$total_article = $temp[0]; // 현재 쿼리한 게시물의 총 개수를 구함	
	//echo $query;	
?>
  <section class="car-list-wrap mypage">
    <div class="count">
      <p><span class="fc-emphas"><?=$total_article?></span>개 매물 있음</p> 
      ㅣ 이전/다음은 좌우로 이동하세요
    </div>
    <div class="car-list swiper">
      <ul class="swiper-wrapper">
<?
		
	$qry = "select a.no,  b.wc_idx, b.wc_made, d.idx  , b.wc_gubun4, a.userid  from car_zzim as a 
	                    left join woojung_car as b on a.no=b.wc_idx 
							left join woojung_car_go c on a.no = c.wcg_wcidx
					    left join cate2 d on d.idx = b.wc_made
						where a.userid='".$_SESSION[loginId]."' and b.wc_gubun4='2' $where order by idx desc LIMIT $start, $view_article ";
	//echo $qry;	
	$auctQuery = $db->query($qry);
	$i=0;
	while($zzim_row = mysql_fetch_object($auctQuery)) {
	
		$num = $total_article-$i-(($page-1)*$view_article);
		$car_sql = "select * from woojung_car as a left join woojung_car_go as b on a.wc_idx = b.wcg_wcidx where a.wc_idx='".$zzim_row->no."'";
		$car_qry = $db->query($car_sql);
		$auctRow=mysql_fetch_object($car_qry);

		 	
	 		    $co = mysql_fetch_row(mysql_query("SELECT count(*) FROM woojung_bid  WHERE userId='$loginId' and auct_key='".$zzim_row->no."' " ));
  				if($co[0]=="2"){
					$sql="SELECT * FROM woojung_bid  WHERE userId='".$loginId."' and auct_key='".$auctRow->wc_idx."' and sale_type='2' ";
					$result=mysql_query($sql);
					$data1=mysql_fetch_array($result);
					$sql="SELECT * FROM woojung_bid  WHERE userId='".$loginId."' and auct_key='".$auctRow->wc_idx."' and sale_type='1' ";
					$result=mysql_query($sql);
					$data2=mysql_fetch_array($result);
				}else if($auctRow->sale_type=="1"){
					$sql="SELECT * FROM woojung_bid  WHERE userId='".$loginId."' and auct_key='".$auctRow->wc_idx."' and sale_type='1' ";
					$result=mysql_query($sql);
					$data2=mysql_fetch_array($result);
				}else if($auctRow->sale_type=="2"){
					$sql="SELECT * FROM woojung_bid  WHERE userId='".$loginId."' and auct_key='".$auctRow->wc_idx."' and sale_type='2' ";
					$result=mysql_query($sql);
					$data1=mysql_fetch_array($result);
				}	 	
		
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

			  	$car_img_arr = explode('/',$auctRow->wc_img_1);



$auctionTrue = $auctRow->wc_auction; //낙찰유무

$param_auct_idx = $auctRow->wc_idx;
$sale_type		= $auctRow->sale_type;
$end_time		= $auctRow->wc_go_end_date;
$year			= cutStr($auctRow->wc_go_end_date,0,4);
$month			= cutStr($auctRow->wc_go_end_date,5,2);
$day			= cutStr($auctRow->wc_go_end_date,8,2);
$hour			= $auctRow->wc_go_end_hh;
$min			= $auctRow->wc_go_end_mm;
$last_end_date2 = $year.'년 '.$month.'월 '.$day.'일  '.$hour.'시 '.$min.'분';
 

$date1=mktime($hour,$min,'00',$month,$day,$year);  
$date2=time(); //mktime은 초로 계산된 시간 125125212초 이런식 
 
$total_secs=$date1 - $date2;  
$diff_in_days = floor($total_secs / 86400); 
$rest_hours = $total_secs % 86400;  
 
$diff_in_hours = floor($rest_hours / 3600); 
$rest_mins = $rest_hours % 3600;  
$diff_in_mins = floor($rest_mins / 60); 
$diff_in_secs = floor($rest_mins % 60); 


		$qry = "select * from woojung_bid as a
							left join woojung_car as b on a.auct_key = b.wc_idx
							left join woojung_car_go c on a.auct_key = c.wcg_wcidx
					where  a.userId='$loginId' 
							and b.wc_gubun2 in ('1','2','3','4','5')
							and  b.wc_gubun3 in ( '2','3','4','5','6','7' )
							 and  auct_key =  '$auctRow->wc_idx'  ";
		
 //echo $qry ;

			$auctQuery2 = $db->query($qry);
			$auctQuery2 = mysql_fetch_object($auctQuery2)
 ?>
        <li class="swiper-slide" onClick="auctionView_pubauct('<?=$auctRow->wc_idx?>','<?=$auctRow->wc_gubun2?>','<?=$auctRow->wc_gubun3?>');">
          <div class="carbox">
            <span class="item-number">
              <?=$num?>
            </span>
            <div class="image-wrap"> 
              <img src="<?=$site_u[home_url]?>/data/<?=$car_img_arr[0]?>" alt="챠량이미지">
            </div>
            <div class="number">
              <div class="n_tit"><?=$auctRow->wc_orderno?></div>
              <div class="n_tit"><span class="fc-purple"><?=$auctRow->evalAmt_type?></span></div>
              <div class="n_tit"><span class="fc-blue"><?WriteArrHTML('radio', 'Arrgubun2', $ArrgoSale, $auctRow->wc_go_type, '', '' , 'direct', '');?></span></div>
            </div>
  
            <div class="carname">
              <div class="c_model">
			  <?=$auctRow->wc_model?>
              <?=$auctRow->wc_model2?$auctRow->wc_model2:""?></div>
              <p class="spec">
                <span><?=substr($auctRow->wc_age,0,4)?>-<?=substr($auctRow->wc_age,4,2)?></span> 
                |<span><?=$auctRow->wc_trans?></span>
                |<span><?=$auctRow->wc_fual?></span>
              </p>
              <p class="location">보관: <? WriteArrHTML('select', 'area1', $ArrcarPlace , $auctRow->wc_keep_area1, '', '' , 'direct', '' );?></p>
              <p class="bid-finish"><span class="fw-bold"><?=$auctRow->wc_go_end_date?> [<?=$auctRow->wc_go_end_hh?>:<?=$auctRow->wc_go_end_mm?>]</span> </p>
              <p class="message fw-bold fc-red">
				<span id="counter<?=$num?>"></span>
                      <script language="JavaScript" type="text/javascript"> 
					  <!-- 
					        // 자바스크립트 코드 
					  function Timer<?=$num?>(diff_in_secs, diff_in_mins, diff_in_hours, diff_in_days, mm,dd,yy, num){
					        //남은시간 실시간으로 보여지는 부분 
					        day<?=$num?>=diff_in_days;    //일단 남은 날짜와 시간을 받아온다음에 timer1을 호출한다 
					        hour<?=$num?>=diff_in_hours; 
					        min<?=$num?>=diff_in_mins; 
					        sec<?=$num?>=diff_in_secs; 
							dt<?=$num?> = new Date();
					        nyy<?=$num?> =dt<?=$num?>.getFullYear();
					        nmm<?=$num?> =dt<?=$num?>.getMonth()+1;
							ndd<?=$num?>=dt<?=$num?>.getDate();

							if(yy==nyy<?=$num?>&&mm==nmm<?=$num?>&&dd==ndd<?=$num?>){
								tda=1;
							}else{
								tda=0;
							} 
 						
					        if(day<?=$num?> >= 0 )
					      	{
							 Timer1<?=$num?>(<?=$num?>); 								
					        }  
					        else
					        { 
							document.getElementById('counter'+num).innerHTML = '입찰마감';  
					        } 
					} 
					function Timer1<?=$num?>(num) { 
					//if(tda == 1 )document.all.end_maker.value = '[금일마감]';  					        	 	
					sec<?=$num?>=sec<?=$num?>-1;        //1초식 감소 하다가 -1이되면 1분을 뺀다은 초를 59초로 초기화 
        				if(sec<?=$num?> == -1) { 
				        sec<?=$num?> = 59; 
				        min<?=$num?> = min<?=$num?>-1; 
				        } 
 
					if(min<?=$num?> == -1) {        //1분씩 감소 하다가 -1이되면 1시간을 뺀다음 분을 59분으로 초기화 
					        min<?=$num?>=59; 
					        hour<?=$num?> = hour<?=$num?> - 1; 
					        } 
					if(hour<?=$num?> == -1) {  //1시간씩 감소 하다가 -1이되면 1일을 뺀다음 날짜 초기화 
					        hour<?=$num?> = 23; 
					        day<?=$num?> = day<?=$num?> - 1; 
					        } 
					if(sec<?=$num?> == 0 && min<?=$num?> == 0 && hour<?=$num?> == 0 && day<?=$num?> == 0) { 
					        //일:0 시간:0 분:0 초:0 이라면 종료메세지 출력 
					    	document.getElementById('counter'+num).innerHTML = '입찰이 마감되었습니다.';   
						//	document.getElementById('sb_img').style.display = "none";
						//	document.all.end_maker.value = '';
					    	clearTimeout('Timer1<?=$num?>()');
					        return; 
					        } 
					if(day<?=$num?> < 0) { 
					        //일:0 시간:0 분:0 초:0 이라면 종료메세지 출력 
					    	document.getElementById('counter'+num).innerHTML = '입찰이 마감되었습니다.';   
							//document.getElementById('sb_img').style.display = "none";
							//document.all.end_maker.value = '';
					    	clearTimeout('Timer1<?=$num?>()');
					        return; 
					        } 
						document.getElementById('counter'+num).innerHTML= day<?=$num?> + '일 ' + hour<?=$num?> + '시간 ' + min<?=$num?> + '분 ' + sec<?=$num?> + '초 '; 
				        //1초당 한번씩 timer1()을 호출하여 실행 
						window.setTimeout('Timer1<?=$num?>(<?=$num?>)',1000); 
					} 
					
					//window.attachEvent( 'onload', Timer(42,35,11,0));
					//document.onload=Timer(42,35,11,0);
					
					
					document.onload=Timer<?=$num?>(<?=$diff_in_secs?>,<?=$diff_in_mins?>,<?=$diff_in_hours?>,<?=$diff_in_days?>,<?=$month?>,<?=$day?>,<?=$year?>, <?=$num?>);
					
					//--> 
					</script>
			  </p>
            </div>
            <div class="carcheck">
              <div>
                폐차입찰: <span class="price"><?=number_format($data2[bid_price])?>원</span>
              </div>
              <div>
                이전입찰: <span class="price"><?=number_format($data1[bid_price])?>원</span>
              </div>
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