<?
include "../inc/header.php";
include "../inc/menu.php";

if($car_type1){
	$mod_car_cate=sql_list("select * from category where cate_type1='$car_type1' order by cate_list asc ");
	$where.=" and est_cartype1='$car_type1' ";
}
if($car_type2){
	$where.=" and est_cartype2='$car_type2' ";
}
if($car_type1=="화물차"){
	$mod_car_trim=sql_list("select * from option_basic where del='N' and basic_type1='Y' and basic_price='' ");
}else if($car_type1=="캠핑카"){
	$mod_car_trim=sql_list("select * from option_basic where del='N' and basic_type2='Y' and basic_price='' ");
}
if($car_name){
	$option_basic=sql_fetch("select * from option_basic where idx='$car_name' ");
	$mod_car_trim_bt=sql_list("select * from option_basic where del='N' and basic_name='".$option_basic[basic_name]."' and basic_price!='' order by basic_list asc ");
	$where.=" and est_car_name='$car_name' ";
}
if($trim_idx) $where.=" and trim_idx='$trim_idx' ";
if($est_state) $where.=" and est_state='$est_state' ";
if($s_text) $where.=" and (est_name like '%$s_text%' or est_phone like '%$s_text%') ";

$estimate=sql_list("select * from estimate where 1=1 $where order by idx desc limit $page_start, $page_row ");
$total_count=sql_total("select count(*) as cnt from estimate where 1=1 ");
$list_num=$total_count-$page_start;
?>
<form name="wform" method="post" enctype="multipart/form-data" target="HiddenFrm" action="sub02_change_save.php">
<input type="hidden" name="idx" value="">
<input type="hidden" name="val" value="">
</form>
    <!-- 본문 -->
    <div class="container-fluid title">
      <h2>견적신청</h2>
    </div>
    <div class="content-container">

      <div class="container-fluid estimate-list-wrap mb-5">
        <!-- 견적신청 테이블 -->
        <div class="row mt-5">
          <div class="col-12">
<form name="sform" method="get" enctype="multipart/form-data">
            <div class="table-topper mb-3 filter">
              <div class="suffix">
                <select class="form-select" aria-label="select" name="car_type1" onchange="document.sform.submit();">
                  <option value="" selected>=대구분=</option>
				  <option value="화물차" <?=$car_type1=="화물차"?"selected":""?>>화물차</option>
				  <option value="캠핑카" <?=$car_type1=="캠핑카"?"selected":""?>>캠핑카</option>
                </select>
                <select class="form-select" aria-label="select" name="car_type2" onchange="document.sform.submit();">
                  <option value="" selected>=소구분=</option>
<? for($i=0;$i<count($mod_car_cate);$i++){ ?>
				  <option value="<?=$mod_car_cate[$i][cate_type2]?>" <?=$car_type2==$mod_car_cate[$i][cate_type2]?"selected":""?>><?=$mod_car_cate[$i][cate_type2]?></option>
<? } ?>
                </select>
                <select class="form-select" aria-label="select" name="car_name" onchange="document.sform.submit();">
                  <option value="" selected>=차량명=</option>
<? for($i=0;$i<count($mod_car_trim);$i++){ ?>
				  <option value="<?=$mod_car_trim[$i][idx]?>" <?=$car_name==$mod_car_trim[$i][idx]?"selected":""?>><?=$mod_car_trim[$i][basic_name]?></option>
<? } ?>
                </select>
                <select class="form-select" aria-label="select" name="trim_idx" onchange="document.sform.submit();">
                  <option value="" selected>=트림명=</option>
<?
	for($i=0;$i<count($mod_car_trim_bt);$i++){ 
?>
				  <option value="<?=$mod_car_trim_bt[$i][idx]?>" <?=$trim_idx==$mod_car_trim_bt[$i][idx]?"selected":""?>><?=$mod_car_trim_bt[$i][basic_price]?></option>
<? } ?>
                </select>
                <select class="form-select" aria-label="select" name="est_state" onchange="document.sform.submit();">
                  <option value="" selected>=선택=</option>
                  <option value="1" <?=$est_state=="1"?"selected":""?>>신규</option>
                  <option value="2" <?=$est_state=="2"?"selected":""?>>확인</option>
                  <option value="3" <?=$est_state=="3"?"selected":""?>>취소</option>
                </select>
                <input type="text" class="form-control search-input me-1" name="s_text" value="<?=$s_text?>">
                <button class="btn btn-outline-primary btn-sm">검색</button>
              </div>
            </div>
</form>
<form name="lform" method="post" enctype="multipart/form-data" target="HiddenFrm" action="/manage/inc/alldel.php">
<input type="hidden" name="db_name" value="estimate">
            <table class="table table-layout border-type text-center table-hover estimate-list">
              <colgroup>
                <col style="width: 50px">
                <col style="width: auto"><!--No-->
                <col style="width: auto"><!--등록일-->
                <col style="width: auto"><!--일련번호-->
                <col style="width: auto"><!--신청자-->
                <col style="width: auto"><!--연락처-->
                <col style="width: auto"><!--차종-->
                <col style="width: auto"><!--차량명-->
                <col style="width: auto"><!--트림명-->
                <col style="width: auto"><!--총차량가격-->
                <col style="width: 120px"><!--비고-->
              </colgroup>
              <thead class="table-light">
                <tr>
                  <th>
                    <input type="checkbox" class="form-check-input" id="all-check">
                  </th>
                  <th>No</th>
                  <th>등록일</th>
                  <th>일련번호</th>
                  <th>신청자</th>
                  <th>연락처</th>
                  <th>차종</th>
                  <th>차량명</th>
                  <th>트림명</th>
                  <th>총차량가격</th>
                  <th>비고</th>
                </tr>
              </thead>
              <tbody>
<? for($i=0;$i<count($estimate);$i++){ ?>
<?
		$sale_car_trim=sql_fetch("select * from option_basic where idx='".$estimate[$i][trim_idx]."' ");
?>

				<tr style="cursor:pointer;">
                  <td>
                    <input type="checkbox" class="form-check-input" name="checkidx[]" value="<?=$estimate[$i][idx]?>">
                  </td>
                  <td onclick="window.location='./sub02_view.php?idx=<?=$estimate[$i][idx]?>'"><?=$list_num--;?></td>
                  <td onclick="window.location='./sub02_view.php?idx=<?=$estimate[$i][idx]?>'">
                    <?=substr($estimate[$i][est_regdate],0,10)?>[<?=substr($estimate[$i][est_regdate],11,2)?>:<?=substr($estimate[$i][est_regdate],14,2)?>]
                  </td>
                  <td onclick="window.location='./sub02_view.php?idx=<?=$estimate[$i][idx]?>'">
                    <a href="./sub02_view.php?idx=<?=$estimate[$i][idx]?>"><?=$estimate[$i][est_code]?></a>
                  </td>
                  <td onclick="window.location='./sub02_view.php?idx=<?=$estimate[$i][idx]?>'"><?=$estimate[$i][est_name]?></td>
                  <td onclick="window.location='./sub02_view.php?idx=<?=$estimate[$i][idx]?>'"><?=$estimate[$i][est_phone]?></td>
                  <td onclick="window.location='./sub02_view.php?idx=<?=$estimate[$i][idx]?>'"><?=$estimate[$i][est_cartype]?></td>
                  <td onclick="window.location='./sub02_view.php?idx=<?=$estimate[$i][idx]?>'"><?=$sale_car_trim[basic_name]?></td>
                  <td><?=$sale_car_trim[basic_price]?></td>
                  <td onclick="window.location='./sub02_view.php?idx=<?=$estimate[$i][idx]?>'"><?=number($estimate[$i][est_price])?></td>
                  <td>
                    <select class="form-select" aria-label="select" onchange="est_state_change('<?=$estimate[$i][idx]?>',this.value);">
                      <option value="" selected>=비고=</option>
                      <option value="1" <?=$estimate[$i][est_state]=="1"?"selected":""?>>신규</option>
                      <option value="2" <?=$estimate[$i][est_state]=="2"?"selected":""?>>확인</option>
                      <option value="3" <?=$estimate[$i][est_state]=="3"?"selected":""?>>취소</option>
                    </select>
                  </td>
                </tr>
<? } ?>
              </tbody>
            </table>
</form>
            <div class="table-footer">
              <div class="prefix">
                <button type="button" class="btn btn-outline-dark btn-sm" onclick="all_del()">선택삭제</button>
              </div>
              <div class="center">
                <nav aria-label="Page navigation example">
                  <ul class="pagination">
                    <? echo paging($page, $page_row, $page_scale, $total_count, $ext); ?>
                  </ul>
                </nav>
              </div>
              <div class="suffix">
                
              </div>
            </div>
          </div>
        </div>
        <!-- //견적신청 테이블 -->
      </div>
    </div>
  </div>
</body>
</html>