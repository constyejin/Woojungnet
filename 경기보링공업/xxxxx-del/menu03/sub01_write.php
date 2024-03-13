<?
include "../inc/header.php";
include "../inc/menu.php";

if($idx) $category=sql_fetch("select * from category where idx=$idx ");
?>
    <!-- 본문 -->
    <div class="container-fluid title">
      <h2>카테고리</h2>
    </div>
    <div class="content-container">
      <div class="container-fluid mt-5 mb-5 category-view">
        <!-- 카테고리 뷰페이지 -->
<form name="wform" method="post" enctype="multipart/form-data" target="HiddenFrm" action="sub01_save.php">
<input type="hidden" name="idx" value="<?=$idx?>">
        <table class="table table-layout border-type">
          <colgroup>
            <col style="width: 150px;">
            <col style="width: 450px;">
            <col style="width: 150px;">
            <col style="width: 450px;">
          </colgroup>
          <tbody class="table-light">
            <tr>
              <th>카테고리</th>
              <td>
                <input type="text" class="form-control" id="" placeholder="" value="<?=$category[cate_type1]?> > <?=$category[cate_type2]?>">
              </td>
              <th>메인노출</th>
              <td>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="cate_view" value="Y" id="exhibit1" checked>
                  <label class="form-check-label" for="exhibit1">
                    노출
                  </label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="cate_view" value="N" id="exhibit2" <?=$category[cate_view]=="N"?"checked":""?>
                  <label class="form-check-label" for="exhibit2">
                    감춤
                  </label>
                </div>
              </td>
            </tr>
            <tr>
              <th>중간타이틀1</th>
              <td colspan="3">
                <div class="mid-title1">
                  <input type="text" class="form-control" id="" placeholder="" name="cate_title1" value="<?=$category[cate_title1]?>" onkeyup="document.getElementById('p_title').innerHTML=this.value+'<br>'+document.wform.cate_title2.value;">
                </div>
              </td>
            </tr>
            <tr>
             <th>중간타이틀2</th>
              <td colspan="3">
                <div class="mid-title2">
                  <input type="text" class="form-control" id="" placeholder="" name="cate_title2" value="<?=$category[cate_title2]?>" onkeyup="document.getElementById('p_title').innerHTML=document.wform.cate_title1.value+'<br>'+this.value;">
                </div>
              </td>
            </tr>
            <tr>
              <th colspan="2" class="align-c">설명문구</th>
              <th colspan="2" class="align-c">이미지등록</th>
            </tr>
            <tr>
              <td colspan="2">
                <textarea name="cate_explain" id="" cols="30" rows="10" class="form-control description" onkeyup="document.getElementById('p_explain').innerHTML=this.value;"><?=$category[cate_explain]?></textarea>
              </td>
              <td colspan="2" class="align-c">
                <p class="mb-1">
                  메인에 노출되는 이미지입니다
                </p>
                <p class="mb-3 notice-emphas">
                  크기 600*450 (gif/jpg/png)
                </p>
                <input type="file" class="form-control" name="upfile">
                <p class="align-l mt-3"><span>등록파일: </span><span class="file-name"><?=$category[cate_file]?></span></p>
              </td>
            </tr>
          </tbody>
        </table>
        <!-- //카테고리 뷰페이지 -->
</form>
        <div class="table-footer mt-5 justify-content-center">
          <div class="center">
            <button type="button" class="btn btn-outline-secondary btn-sm" onclick="document.wform.submit();">수정하기</button>
            <button type="button" class="btn btn-outline-primary btn-sm ms-2" onclick="history.back();">목록보기</button>
          </div>
        </div>
      </div>

      <div class="container-fluid mt-5 mb-5 category-view">
        <h3>미리보기</h3>
        <div class="preview">
          <!-- 메인쪽 미리보기 -->
          <div class="item">
            <div class="desc">
              <div class="product-name">
                <span class="text">
                  <?=$category[cate_type2]?>
                </span>
                <a href="" class="arrow">
                  <span class="top"></span>
                  <span class="md"></span>
                  <span class="bottom"></span>
                </a>
              </div>
              <p class="sub-text" id="p_title"><?=$category[cate_title1]?><br><?=$category[cate_title2]?></p>
              <p class="content-text" id="p_explain">
                <?=nl2br($category[cate_explain])?>
              </p>
            </div>
            <div class="img-area">
              <span class="vertical-label">NARMI MOTORS</span>
              <div class="img-wrap">
			  <? if($category[cate_file]){ ?>
                <img src="/images/category/<?=$category[cate_file]?>" style="width:600px;height:450px;">
			  <? } ?>
              </div>
            </div>
          </div>
          <!-- //메인쪽 미리보기 -->
        </div>
      </div>
    </div>
  </div>
</body>
</html>