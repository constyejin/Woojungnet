<?
include "../inc/header.php";
include "../inc/menu.php";

$web_config=sql_fetch("select * from web_config where idx=1 ");

if($idx) $mod_part=sql_fetch("select * from option_part where idx='$idx' ");
$option_part=sql_list("select * from option_part where 1=1 $where order by part_list asc, idx desc ");
?>
    <!-- 본문 -->
    <div class="container-fluid title">
      <h2>부품구매</h2>
    </div>
    <div class="content-container">

      <div class="container-fluid smart-store mt-5">
        <!-- 부품구매 정보 테이블 -->
<form name="wform2" method="post" enctype="multipart/form-data" target="HiddenFrm" action="sub05_save.php">
<input type="hidden" name="smart" value="Y">
        <table class="table table-layout border-type store-link">
          <colgroup>
            <col style="width: 180px;">
          </colgroup>
          <tbody class="table-light">
            <tr>
              <th><span class="color-naver">네이버스마트스토어</span> 주소</th>
              <td>
                <div class="row">
                  <div class="col-8">
                    <input type="text" class="form-control" id="" placeholder="" name="web_smart" value="<?=$web_config[web_smart]?>">
                  </div>
                  <div class="col-auto">
                    <button type="button" class="btn btn-outline-secondary btn-sm" onclick="document.wform2.submit();">등록하기</button>
                  </div>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
</form>

        <h3>상품등록</h3>
<form name="wform" method="post" enctype="multipart/form-data" target="HiddenFrm" action="sub05_save.php">
<input type="hidden" name="idx" value="<?=$idx?>">
<input type="hidden" name="del_idx" value="">
        <table class="table table-layout border-type add-item">
          <colgroup>
            <col style="width: 90px;">
            <col style="width: 90px;">
            <col style="width: 300px">
            <col style="width: 180px;">
            <col style="width: auto">
            <col style="width: 100px">
          </colgroup>
          <tbody class="table-light">
            <tr>
              <th colspan="2">
                정렬
              </th>
              <td>
                <div class="row">
                  <div class="col-6">
                    <input type="text" class="form-control">
                  </div>
                </div>
              </td>
              <th>
                부품명
              </th>
              <td>
                <input type="text" class="form-control" name="part_name" value="<?=$mod_part[part_name]?>">
              </td>
              <td rowspan="3">
                <button type="button" class="btn btn-outline-secondary btn-sm" onclick="document.wform.submit();">등록하기</button>
              </td>
            </tr>
            <tr>
              <th rowspan="2">
                가격
              </th>
              <th>판매가격</th>
              <td>
                <div class="col-12">
                  <input type="text" class="form-control" name="part_price" id="number" value="<?=number($mod_part[part_price])?>">
                </div>
              </td>
              <th rowspan="2">
                이미지
              </th>
              <td rowspan="2">
                <input type="file" class="form-control" name="upfile">
              </td>
            </tr>
            <tr>
              <th>정상가격</th>
              <td>
                <div class="col-12">
                  <input type="text" class="form-control" name="part_price2" id="number2" value="<?=number($mod_part[part_price2])?>">
                </div>
              </td>
            </tr>
          </tbody>
        </table>
        <!-- //부품구매 정보 테이블 -->
</form>
        

        <!-- 등록상품 테이블 -->
        <div class="row mt-5 mb-5 ">
          <div class="col-12">
            <h3>등록상품</h3>
            <div class="vehicle-list-wrap">
              <ul>
<? for($i=0;$i<count($option_part);$i++){ ?>
                <li>
                  <div class="img-wrap">
                    <? if($option_part[$i][part_file]){ ?>
                    <img src="/images/opt/<?=$option_part[$i][part_file]?>" alt="차량이미지">
					<? } ?>
                  </div>
                  <div class="vehicle-name">
                    <div class="name">
                      <span class="number">
                        <?=$option_part[$i][part_list]?>.
                      </span>
                      <?=$option_part[$i][part_name]?>
                    </div>
                    <div class="price-wrap">
                      <span class="price">
                        <?=number($option_part[$i][part_price])?>원 
                      </span>
                      <span class="price-before">
                        <? if($option_part[$i][part_price2]){echo number($option_part[$i][part_price2])."원";} ?>
                      </span>
                    </div>
                    <div class="btn-wrap">
                      <button class="btn btn-outline-secondary btn-sm" onclick="location.href='sub05.php?idx=<?=$option_part[$i][idx]?>';">수정</button>
                      <button class="btn btn-outline-dark btn-sm" onclick="board_del('<?=$option_part[$i][idx]?>');">삭제</button>
                    </div>
                  </div>
                </li>
<? } ?>
              </ul>
            </div>
          </div>
        </div>
        <!-- //등록상품 테이블 -->
      </div>
    </div>
  </div>
</body>
</html>