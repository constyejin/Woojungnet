<?
include "../inc/header.php";
include "../inc/menu.php";

if($car_type1){
	$mod_car_cate=sql_list("select * from category where cate_type1='$car_type1' order by cate_list asc ");
}
if($car_type1){
	$where.=" and basic_type1='$car_type1' ";
}
if($car_type2){
	$mod_car_trim=sql_list("select * from option_basic where del='N' and basic_type1='$car_type1' and basic_type2='$car_type2' and basic_price='' ");
	$where.=" and basic_type2='$car_type2' ";
}
if($car_name) $where.=" and basic_name='$car_name' ";

if($idx){
	$mod_basic=sql_fetch("select * from option_basic where idx='$idx' ");
	$mod_car_cate2=sql_list("select * from category where cate_type1='$mod_basic[basic_type1]' order by cate_list asc ");
}
$option_basic=sql_list("select * from option_basic where del='N' $where order by basic_list desc ");
$option_basic2=sql_list("select * from option_basic where del='N' and basic_price='' order by basic_list asc ");
?>
<script>
function wr1(){
	f=document.wform;
	if(!f.car_type1.value){
		alert("구분을 선택해 주세요.");
	}else if(!f.basic_name.value){
		alert("차량명을 입력해 주세요.");
	}else{
		f.submit();
	}
}
</script>

    <!-- 본문 -->
    <div class="container-fluid title">
      <h2>차량명/트림</h2>
    </div>
    <div class="content-container">
      <div class="container-fluid additional-options-form">
        <!-- 트림등록 테이블 -->
<form name="wform" method="post" enctype="multipart/form-data" target="HiddenFrm" action="sub03_save.php">
<input type="hidden" name="idx" value="<?=$idx?>">
<input type="hidden" name="del_idx" value="">
        <div class="light-border-box mt-5">
          <div class="form-group">
            <span class="label">차량명등록</span>
                        <select class="form-select" aria-label="select" name="car_type1" onchange="ch_type(this.value,'3');">
                          <option value="" selected="">=대구분=</option>
                          <option value="화물차" <?=$mod_basic[basic_type1]=="화물차"?"selected":""?>>화물차</option>
                          <option value="캠핑카" <?=$mod_basic[basic_type1]=="캠핑카"?"selected":""?>>캠핑카</option>
                        </select>
                        <select class="form-select" aria-label="select" name="car_type2">
                          <option value="" selected="">=소구분=</option>
<? for($i=0;$i<count($mod_car_cate2);$i++){ ?>
                          <option value="<?=$mod_car_cate2[$i][cate_type2]?>" <?=$mod_basic[basic_type2]==$mod_car_cate2[$i][cate_type2]?"selected":""?>><?=$mod_car_cate2[$i][cate_type2]?></option>
<? } ?>
						</select>
          </div>
          <div class="form-group">
            <span class="label">정렬</span>
            <input type="text" class="form-control arrange-number" name="basic_list" value="<?=$mod_basic[basic_list]?>">
            <p class="form-text">예: 01</p>
          </div>

          <div class="form-group">
            <span class="label">차량명</span>
            <input type="text" class="form-control option-title" name="basic_name" value="<?=$mod_basic[basic_name]?>">
          </div>
          <div class="form-group">
            <button type="button" class="btn btn-outline-secondary btn-sm" onclick="wr1();">등록하기</button>
          </div>
        </div>
</form>

<form name="wform2" method="post" enctype="multipart/form-data" target="HiddenFrm" action="sub03_save2.php">
<input type="hidden" name="idx" value="<?=$idx?>">
<input type="hidden" name="del_idx" value="">
        <div class="light-border-box mt-3">
          <div class="form-group">
            <span class="label">트림명등록</span>
            <span class="label">차량명</span>
            <select name="basic_name" class="form-select">
				<option value="">=차량명선택=</option>
<? for($i=0;$i<count($option_basic2);$i++){ ?>
				<option value="<?=$option_basic2[$i][basic_name]?>" <?=$option_basic2[$i][basic_name]==$mod_basic[basic_name]&&$mod_basic[basic_price]?"selected":"";?>><?=$option_basic2[$i][basic_name]?></option>
<? } ?>
			</select>
          </div>

          <div class="form-group">
            <span class="label">트림명</span>
            <input type="text" class="form-control price" name="basic_price"  value="<?=$mod_basic[basic_price]?>">
          </div>
          <div class="form-group">
            <span class="label">정렬</span>
            <input type="text" class="form-control arrange-number" name="basic_list" value="<?=$mod_basic[basic_price]?$mod_basic[basic_list]:"";?>">
            <p class="form-text">예: 01</p>
          </div>
          <div class="form-group">
            <button type="button" class="btn btn-outline-secondary btn-sm" onclick="if(document.wform2.basic_name.value){document.wform2.submit();}else{alert('차량명을 선택해 주세요');}">등록하기</button>
          </div>
        </div>
</form>
		<!-- //기본옵션 테이블 -->

      </div>
      <div class="container-fluid mb-5 mt-5 additional-options-list">
        <!-- 기본옵션 리스트 -->
        <!-- <h3>기본옵션</h3> -->
<div class="table-topper filter mb-3">
  <div class="prefix">
    <form name="sform" method="get" enctype="multipart/form-data">
      <select name="car_type1" onchange="document.sform.submit();" class="form-select">
        <option value="" selected>=대구분=</option>
        <option value="화물차" <?=$car_type1=="화물차"?"selected":""?>>화물차</option>
        <option value="캠핑카" <?=$car_type1=="캠핑카"?"selected":""?>>캠핑카</option>
      </select>
      <select name="car_type2" onchange="document.sform.submit();" class="form-select">
        <option value="" selected>=소구분=</option>
<? for($i=0;$i<count($mod_car_cate);$i++){ ?>
		<option value="<?=$mod_car_cate[$i][cate_type2]?>" <?=$car_type2==$mod_car_cate[$i][cate_type2]?"selected":""?>><?=$mod_car_cate[$i][cate_type2]?></option>
<? } ?>
      </select>
      <select name="car_name" onchange="document.sform.submit();" class="form-select">
        <option value="" selected>=차량명=</option>
      <? for($i=0;$i<count($mod_car_trim);$i++){ ?>
        <option value="<?=$mod_car_trim[$i][basic_name]?>" <?=$car_name==$mod_car_trim[$i][basic_name]?"selected":""?>><?=$mod_car_trim[$i][basic_name]?></option>
      <? } ?>
      </select>
    </form>
  </div>
</div>
		<table class="table table-layout border-type text-center table-hover">
          <colgroup>
            <col style="width: 100px">
            <col style="width: 400px">
            <col style="width: auto">
            <col style="width: 200px">
          </colgroup>
          <thead class="table-light">
            <tr>
              <th>No</th>
              <th>해당차량</th>
              <th>차량명 / 트림명</th>
              <th>비고</th>
            </tr>
          </thead>
          <tbody>
<? for($i=0;$i<count($option_basic);$i++){ ?>
            <tr>
              <td><?=$option_basic[$i][basic_list]?></td>
              <td><?=$option_basic[$i][basic_type1]?> > <?=$option_basic[$i][basic_type2]?></td>
              <td><?=$option_basic[$i][basic_name]?>  <?=$option_basic[$i][basic_price]?" / ".$option_basic[$i][basic_price]:"";?></td>
              <td>
                <button class="btn btn-outline-secondary btn-sm" onclick="location.href='sub03.php?idx=<?=$option_basic[$i][idx]?>';">수정</button>
                <button class="btn btn-outline-dark btn-sm" onclick="board_del('<?=$option_basic[$i][idx]?>');">삭제</button>
              </td>
            </tr>
<? } ?>
          </tbody>
        </table>
        <!-- //기본옵션 리스트 -->
      </div>
    </div>
  </div>

</body>
</html>