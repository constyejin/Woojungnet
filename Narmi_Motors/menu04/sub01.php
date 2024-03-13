<?
include "../inc/header.php";
include "../inc/menu_sub.php";

if($s_type1) $where .= " and car_type1='$s_type1' ";
if($s_type2) $where .= " and car_type2='$s_type2' ";
$sale_out=sql_list("select * from sale_out where car_state='1' $where order by idx desc ");
$total_count=sql_total("select count(*) as cnt from sale_out where car_state='1' $where ");
$list_num=$total_count-$page_start;

$image_sub=sql_fetch("select * from image_sub where sub_type='sub' and sub_menu='출고차량' order by idx desc ");
if($s_type1) $category=sql_list("select * from category where cate_type1='$s_type1' order by cate_list asc ");
?>
  <div class="sub-visual">
    <!-- 서브비주얼 -->
    <img src="/images/img/<?=$image_sub[sub_file]?>" alt="">
    <!-- <div class="title">
      <p class="catch-phrase">대한민국의 운송장비의 성공신화 !!</p>
      <p class="sub-text">화물차! 특장차! 캠핑카! 책임있고 오랜경험을 고객님들과 함께 합니다. </p>
      <p class="third-text">TEL  1588-1277  , FAX  02-794-3300</p>
    </div> -->
  </div>
  <div class="content-wrap sub store-released">
    <div class="anchor-wrap">
      <a href="#" class="anchor"></a>
    </div>
    <section class="greeting-header">
      <div class="container">
        <div class="prefix">
        </div>
        <div class="suffix">
          <div class="home">
            <a href="./main.html" class="btn-home">
              <span class="icon-home"></span>
            </a>
          </div>
          <div class="location">
            <span>&gt;</span>
            <span>출고차량</span>
          </div>
        </div>
      </div>
    </section>
    <div class="container">


      <p class="h2">
        출고차량
      </p>
<form name="sform" method="get" enctype="multipart/form-data" action="sub01.php">
      <div class="search-box">
        <div class="select-wrap">
          <select name="s_type1" id="" onchange="document.sform.submit();">
            <option value="">구분1</option>
            <option value="화물차" <?=$s_type1=="화물차"?"selected":""?>>화물차</option>
            <option value="캠핑카" <?=$s_type1=="캠핑카"?"selected":""?>>캠핑카</option>
          </select>
        </div>
        <div class="select-wrap">
          <select name="s_type2" id="" onchange="document.sform.submit();">
            <option value="">구분2</option>
<? for($i=0;$i<count($category);$i++){ ?>
            <option value="<?=$category[$i][cate_type2]?>" <?=$s_type2==$category[$i][cate_type2]?"selected":""?>><?=$category[$i][cate_type2]?></option>
<? } ?>
          </select>
        </div>
        <div class="input-wrap has-btn">
          <input type="text" name="s_text"  value="<?=$s_text?>">
          <a href="" class="btn-search"></a>
        </div>
      </div>
</form>
      <div class="vehicle-list">
        <ul>
<?
for($i=0;$i<count($sale_out);$i++){
	unset($car_img);
	if($sale_out[$i][car_img]) $car_img=explode("|:|" , $sale_out[$i][car_img]);
	$sale_out_trim=sql_fetch("select * from option_basic where idx='".$sale_out[$i][car_name]."' ");
	$mod_car_trim=sql_fetch("select * from sale_out_trim where car_idx='".$sale_out[$i][idx]."' order by trim_list asc ");
?>
          <li>
            <a href="sub01_view.php?idx=<?=$sale_out[$i][idx]?>&trim_idx=<?=$mod_car_trim[idx]?>">
              <div class="tag"><?=$list_num--;?></div>
              <div class="border-wrap">
                <div class="img-wrap">
                  <img src="/data/<?=$car_img[0]?>" alt="차량썸네일">
                </div>
                <div class="title"><?=$sale_out_trim[basic_name]?></div>
                <div class="price"><?=number($mod_car_trim[trim_price])?>원</div>
              </div>
            </a>
          </li>
<? } ?>
        </ul>
      </div>
      <div class="pagination">
<? echo paging_f($page, $page_row, $page_scale, $total_count, $ext); ?>               
      </div>
<form name="sform2" method="get" enctype="multipart/form-data" action="sub01.php">
      <div class="search-box mb-80">
        <div class="select-wrap">
          <select name="s_type1" id="" onchange="document.sform.submit();">
            <option value="">구분1</option>
            <option value="화물차" <?=$s_type1=="화물차"?"selected":""?>>화물차</option>
            <option value="캠핑카" <?=$s_type1=="캠핑카"?"selected":""?>>캠핑카</option>
          </select>
        </div>
        <div class="select-wrap">
          <select name="s_type2" id="" onchange="document.sform.submit();">
            <option value="">구분2</option>
<? for($i=0;$i<count($category);$i++){ ?>
            <option value="<?=$category[$i][cate_type2]?>" <?=$s_type2==$category[$i][cate_type2]?"selected":""?>><?=$category[$i][cate_type2]?></option>
<? } ?>
          </select>
        </div>
        <div class="input-wrap has-btn">
          <input type="text" name="s_text" value="<?=$s_text?>">
          <a href="" class="btn-search"></a>
        </div>
      </div>
</form>
    </div>
  </div>
<?
include "../inc/consult_form.php";
include "../inc/footer.php";
?>
