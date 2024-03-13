<?
include "../inc/header.php";
include "../inc/menu.php";

if($idx) $mod_basic=sql_fetch("select * from option_basic where idx='$idx' ");
$option_basic=sql_list("select * from option_basic where del='N' $where order by basic_list asc ");
?>
    <!-- 본문 -->
    <div class="container-fluid title">
      <h2>차량명등록</h2>
    </div>
    <div class="content-container">
      <div class="container-fluid additional-options-form">
        <!-- 차량명등록 테이블 -->
<form name="wform" method="post" enctype="multipart/form-data" target="HiddenFrm" action="sub03_save.php">
<input type="hidden" name="idx" value="<?=$idx?>">
<input type="hidden" name="del_idx" value="">
        <div class="light-border-box mt-5">
          <div class="form-group">
            <span class="label">해당차량</span>
            <input type="checkbox" class="form-check-input check-md" id="vehicleOption1" name="basic_type1" value="Y" <?=$mod_basic[basic_type1]=="Y"?"checked":""?>>
		    <label class="form-check-label" for="vehicleOption1">
			화물차
		    </label>
		    <input type="checkbox" class="form-check-input check-md" id="vehicleOption2" name="basic_type2" value="Y" <?=$mod_basic[basic_type2]=="Y"?"checked":""?>>
		    <label class="form-check-label" for="vehicleOption2">
			캠핑카
		    </label>
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
            <span class="label">트림명</span>
            <input type="text" class="form-control price" name="basic_price"  value="<?=$mod_basic[basic_price]?>">
            
          </div>


          <div class="form-group">
            <button type="button" class="btn btn-outline-secondary btn-sm" onclick="document.wform.submit();">등록하기</button>
          </div>
        </div>
</form>
		<!-- //기본옵션 테이블 -->

        

      </div>
      <div class="container-fluid mb-5 mt-5 additional-options-list">
        <!-- 기본옵션 리스트 -->
        <!-- <h3>기본옵션</h3> -->
        <table class="table table-layout border-type text-center table-hover">
          <colgroup>
            <col style="width: 100px">
            <col style="width: auto">
            <col style="width: 600px">
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
              <td><?=$option_basic[$i][basic_type1]=="Y"&&$option_basic[$i][basic_type2]=="Y"?"화물차 | 캠핑카":""?>
                  <?=$option_basic[$i][basic_type1]=="Y"&&$option_basic[$i][basic_type2]==""?"화물차":""?>
                  <?=$option_basic[$i][basic_type1]==""&&$option_basic[$i][basic_type2]=="Y"?"캠핑카":""?></td>
              <td><?=$option_basic[$i][basic_name]?> / <?=$option_basic[$i][basic_price]?></td>
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