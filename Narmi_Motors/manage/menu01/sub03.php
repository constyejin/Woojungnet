<?
include "../inc/header.php";
include "../inc/menu.php";

$page_row=10;
$page_scale=10;
if(!$page) $page=1;
$page_start=($page-1)*$page_row;
$ext="car_type1=$car_type1&car_type2=$car_type2&car_name=$car_name&car_view=$car_view&";

if($car_type1){
	$mod_car_cate=sql_list("select * from category where cate_type1='$car_type1' order by cate_list asc ");
	$where.=" and car_type1='$car_type1' ";
}
if($car_type2) $where.=" and car_type2='$car_type2' ";
if($car_type1=="화물차"){
	$mod_car_trim=sql_list("select * from option_basic where del='N' and basic_type1='Y' and basic_price='' ");
}else if($car_type1=="캠핑카"){
	$mod_car_trim=sql_list("select * from option_basic where del='N' and basic_type2='Y' and basic_price='' ");
}
if($car_name) $where.=" and car_name='$car_name' ";
if($car_view) $where.=" and car_view='$car_view' ";
if($idx) $mod_st=sql_fetch("select * from image_structure where idx='$idx' ");
$sale_out=sql_list("select * from sale_out where car_state='1' $where order by idx desc limit $page_start, $page_row ");
$total_count=sql_total("select count(*) as cnt from sale_out where car_state='1' $where ");
$list_num=$total_count-$page_start;
?>
	<!-- 본문 -->
    <div class="container-fluid title">
      <h2>출고차량</h2>
    </div>
    <div class="content-container">
      <div class="container-fluid add-product mt-5">
<form name="cform" method="post" enctype="multipart/form-data" action="sub03_change.php" target="HiddenFrm">
<input type="hidden" name="idx" value="">
<input type="hidden" name="car_list" value="">
</form>
<form name="sform" method="get" enctype="multipart/form-data">
        <div class="table-topper select-filter-group" style="text-align:right;">
          
          <div class="prefix">
          <a href="./sub03_write.php" class="btn btn-outline-secondary btn-sm">등록하기</a>
            <select class="form-select" name="car_type1" onchange="document.sform.submit();">
              <option value="" selected>=대구분=</option>
              <option value="화물차" <?=$car_type1=="화물차"?"selected":""?>>화물차</option>
              <option value="캠핑카" <?=$car_type1=="캠핑카"?"selected":""?>>캠핑카</option>
            </select>
            <select class="form-select" name="car_type2" onchange="document.sform.submit();">
              <option value="" selected>=소구분=</option>
  <? for($i=0;$i<count($mod_car_cate);$i++){ ?>
      <option value="<?=$mod_car_cate[$i][cate_type2]?>" <?=$car_type2==$mod_car_cate[$i][cate_type2]?"selected":""?>><?=$mod_car_cate[$i][cate_type2]?></option>
  <? } ?>
            </select>
            <select class="form-select" name="car_name" onchange="document.sform.submit();">
              <option value="" selected>=차량명=</option>
  <? for($i=0;$i<count($mod_car_trim);$i++){ ?>
              <option value="<?=$mod_car_trim[$i][idx]?>" <?=$car_name==$mod_car_trim[$i][idx]?"selected":""?>><?=$mod_car_trim[$i][basic_name]?></option>
  <? } ?>
            </select>
            <select class="form-select" name="car_view" onchange="document.sform.submit();">
              <option value="" selected>=노출선택=</option>
              <option value="Y" <?=$car_view=="Y"?"selected":""?>>노출</option>
              <option value="N" <?=$car_view=="N"?"selected":""?>>감춤</option>
            </select>
            
          </div>
        </div>
</form>        

        <!-- 화물차 정보 테이블 -->
<form name="lform" method="post" enctype="multipart/form-data" target="HiddenFrm" action="/manage/inc/alldel.php">
<input type="hidden" name="db_name" value="sale_out">
        <div class="vehicle-list-wrap mt-3">
          <ul class="check-all-target">
<?
for($i=0;$i<count($sale_out);$i++){
	unset($car_img);
	if($sale_out[$i][car_img]) $car_img=explode("|:|" , $sale_out[$i][car_img]);
	$sale_out_trim=sql_fetch("select * from option_basic where idx='".$sale_out[$i][car_name]."' ");
	$mod_car_trim=sql_fetch("select * from sale_out_trim where car_idx='".$sale_out[$i][idx]."' order by trim_list asc ");
?>
            <li>
              <div class="check-wrap">
                <div class="prefix">
                  <input type="checkbox" class="form-check-input" value="<?=$sale_out[$i][idx]?>" name="checkidx[]"> <?=$list_num--;?>
                  <!--input type="number" name="car_list[]" value="<?=$sale_out[$i][car_list]?>" style="width:50px;" class="form-control">
				  <input type="hidden" name="car_idx[]" value="<?=$sale_out[$i][idx]?>" style="width:50px;" class="form-control">
				  <button type="button" onclick="list_ch(<?=$i?>);">변경</button-->
                </div>
                <div class="suffix">
				<? if($sale_out[$i][car_view]=="Y"){ ?>
                  <button class="btn btn-round btn-outline-secondary btn-sm">노출</button>
				  <? }else{ ?>
                  <button class="btn btn-round btn-outline-dark btn-sm">감춤</button>
				  <? } ?>
                </div>
              </div>
              <div class="img-wrap">
                <a href="./sub03_view.php?idx=<?=$sale_out[$i][idx]?>&trim_idx=<?=$mod_car_trim[idx]?>">
                  <img src="/data/<?=$car_img[0]?>" alt="차량이미지">
                </a>
              </div>
              <div class="vehicle-name">
                <a href="./sub03_view.php?idx=<?=$sale_out[$i][idx]?>&trim_idx=<?=$mod_car_trim[idx]?>">
                  <span class="category">
                    <?=$sale_out[$i][car_type1]?> > <?=$sale_out[$i][car_type2]?>
                  </span>
                  <span class="name">
                    <?=$sale_out_trim[basic_name]?>
                  </span>
                  <span class="price">
                    <?=number($mod_car_trim[trim_price])?>원
                  </span>
                </a>
              </div>
            </li>
<? } ?>
          </ul>
        </div>
        <div class="table-footer">
          <div class="prefix">
            <a class="btn btn-outline-primary btn-sm btn-check-all">전체선택</a>
            <a class="btn btn-outline-primary btn-sm btn-checkout-all">전체해제</a>
            <button class="btn btn-outline-dark btn-sm" onclick="all_del()">선택삭제</button>
          </div>
          <div class="center">
            <nav aria-label="Page navigation example">
              <ul class="pagination">
                    <? echo paging($page, $page_row, $page_scale, $total_count, $ext); ?>
              </ul>
            </nav>
          </div>
          <div class="suffix"></div>
        </div>
</form>
        <!-- //화물차 정보 테이블 -->
      </div>
    </div>
  </div>
</body>
</html>