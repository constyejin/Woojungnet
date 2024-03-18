<?
include "../inc/header.php";
include "../inc/menu.php";

$web_table=sql_list("select * from web_table where 1=1 order by idx desc ");
$total_count=sql_total("select count(*) as cnt from popup where 1=1 ");
?>
    <!-- 본문 -->
    <div class="container-fluid title">
      <h2>게시판설정</h2>
    </div>
    <div class="content-container">

      <div class="container-fluid board-setting mb-5">
        <!-- 게시판 등록 테이블 -->
        <div class="row mt-5">
          <div class="col-12">
            <div class="set-board border-box">
<form name="wform" method="post" enctype="multipart/form-data" target="HiddenFrm" action="sub04_save.php">
<input type="hidden" name="del_idx" value="">
              <div class="row align-items-center">
                <div class="col-4">
                  <div class="row align-items-center">
                    <div class="col-4">
                      <label class="label">게시판명(한글)</label>
                    </div>
                    <div class="col-auto">
                      <input type="text" class="form-control" required name="table_title">
                    </div>
                  </div>
                </div>
                <div class="col-4">
                  <div class="row align-items-center">
                    <div class="col-4">
                      <label class="label">아이디(영소문자)</label>
                    </div>
                    <div class="col-auto">
                      <input type="text" class="form-control" required name="table_id">
                    </div>
                  </div>
                </div>
                <div class="col-auto">
                  <button type="button" class="btn btn-outline-secondary btn-sm" onclick="document.wform.submit()">등록하기</button>
                </div>
              </div>
</form>
            </div>
          </div>
        </div>
        <!-- //게시판 등록 테이블 -->
        <!-- 게시판관리 테이블 -->
        <div class="row mt-5">
          <div class="col-12">
            <h3>게시판관리</h3>
            <table class="table board-list table-layout border-type text-center">
              <colgroup>
                <col style="width: auto">   <!--게시판명-->
                <col style="width: auto">  <!--ID-->
                <col style="width: 130px">  <!--SKIN-->
                <col style="width: 130px">  <!--에디터사용-->
                <col style="width: 120px">  <!--파일업로드-->
                <col style="width: 100px">  <!--리스트수-->
                <col style="width: 150px">  <!--쓰기권한-->
                <col style="width: 150px">  <!--보기권한-->
                <col style="width: 150px">  <!--답글권한-->
                <col style="width: 150px">  <!--댓글권한-->
                <col style="width: 150px">  <!--비밀글사용-->
                <col style="width: 80px">  <!--비고-->
              </colgroup>
              <thead class="table-light">
                <tr>
                  <th>게시판명</th>
                  <th>ID</th>
                  <th>SKIN</th>
                  <th>에디터사용</th>
                  <th>파일업로드</th>
                  <th>리스트수</th>
                  <th>쓰기권한</th>
                  <th>보기권한</th>
                  <th>답글권한</th>
                  <th>댓글권한</th>
                  <th>비밀글사용</th>
                  <th>비고</th>
                </tr>
              </thead>
              <tbody>
<? for($i=0;$i<count($web_table);$i++){ ?>
<form name="lform<?=$i?>" method="post" enctype="multipart/form-data" target="HiddenFrm" action="sub03_save.php">
<input type="hidden" name="idx" value="<?=$web_table[$i][idx]?>">
                <tr>
                  <td><?=$web_table[$i][table_title]?></td>
                  <td><a href=""><?=$web_table[$i][table_id]?></a></td>
                  <td>
                    <select class="form-select" aria-label="select" name="table_skin" onchange="lform<?=$i?>.submit();">
                      <option value="" selected>=skin=</option>
                      <option value="bbs" <?=$web_table[$i][table_skin]=="bbs"?"selected":""?>>bbs</option>
                      <option value="image" <?=$web_table[$i][table_skin]=="image"?"selected":""?>>image</option>
                    </select>
                  </td>
                  <td>
                    <select class="form-select" aria-label="select" name="table_editor" onchange="lform<?=$i?>.submit();">
                      <option value="" selected>=에디터=</option>
                      <option value="1" <?=$web_table[$i][table_editor]=="1"?"selected":""?>>사용</option>
                      <option value="2" <?=$web_table[$i][table_editor]=="2"?"selected":""?>>감춤</option>
                    </select>
                  </td>
                  <td>
                    <select class="form-select" aria-label="select" name="table_file" onchange="lform<?=$i?>.submit();">
                      <option value="" selected>=파일=</option>
                      <option value="1" <?=$web_table[$i][table_file]=="1"?"selected":""?>>1</option>
                      <option value="2" <?=$web_table[$i][table_file]=="2"?"selected":""?>>2</option>
                      <option value="3" <?=$web_table[$i][table_file]=="3"?"selected":""?>>3</option>
                      <option value="4" <?=$web_table[$i][table_file]=="4"?"selected":""?>>4</option>
                      <option value="5" <?=$web_table[$i][table_file]=="5"?"selected":""?>>5</option>
                      <option value="6" <?=$web_table[$i][table_file]=="6"?"selected":""?>>6</option>
                      <option value="7" <?=$web_table[$i][table_file]=="7"?"selected":""?>>7</option>
                      <option value="8" <?=$web_table[$i][table_file]=="8"?"selected":""?>>8</option>
                      <option value="9" <?=$web_table[$i][table_file]=="9"?"selected":""?>>9</option>
                    </select>
                  </td>
                  <td>
                    <select class="form-select" aria-label="select" name="table_list" id="" onchange="lform<?=$i?>.submit();">
                      <option value="5" <?=$web_table[$i][table_list]=="5"?"selected":""?>>5</option>
                      <option value="10" <?=$web_table[$i][table_list]=="10"?"selected":""?>>10</option>
                      <option value="15" <?=$web_table[$i][table_list]=="15"?"selected":""?>>15</option>
                      <option value="20" <?=$web_table[$i][table_list]=="20"?"selected":""?>>20</option>
                      <option value="25" <?=$web_table[$i][table_list]=="25"?"selected":""?>>25</option>
                      <option value="30" <?=$web_table[$i][table_list]=="30"?"selected":""?>>30</option>
                    </select>
                  </td>
                  <td>
                    <select class="form-select" aria-label="select" name="table_write" onchange="lform<?=$i?>.submit();">
                      <option value="" selected>=쓰기권한=</option>
                      <option value="2" <?=$web_table[$i][table_write]=="2"?"selected":""?>>일반회원</option>
                      <option value="1" <?=$web_table[$i][table_write]=="1"?"selected":""?>>비회원</option>
                      <option value="3" <?=$web_table[$i][table_write]=="3"?"selected":""?>>관리자</option>
                    </select>
                  </td>
                  <td>
                    <select class="form-select" aria-label="select" name="table_view" onchange="lform<?=$i?>.submit();">
                      <option value="" selected>=보기권한=</option>
                      <option value="2" <?=$web_table[$i][table_view]=="2"?"selected":""?>>일반회원</option>
                      <option value="1" <?=$web_table[$i][table_view]=="1"?"selected":""?>>비회원</option>
                      <option value="3" <?=$web_table[$i][table_view]=="3"?"selected":""?>>관리자</option>
                    </select>
                  </td>
                  <td>
                    <select class="form-select" aria-label="select" name="table_reply" onchange="lform<?=$i?>.submit();">
                      <option value="" selected>=답글권한=</option>
                      <option value="2" <?=$web_table[$i][table_reply]=="2"?"selected":""?>>일반회원</option>
                      <option value="1" <?=$web_table[$i][table_reply]=="1"?"selected":""?>>비회원</option>
                      <option value="3" <?=$web_table[$i][table_reply]=="3"?"selected":""?>>관리자</option>
                    </select>
                  </td>
                  <td>
                    <select class="form-select" aria-label="select" name="table_comment" onchange="lform<?=$i?>.submit();">
                      <option value="" selected>=댓글권한=</option>
                      <option value="2" <?=$web_table[$i][table_comment]=="2"?"selected":""?>>일반회원</option>
                      <option value="1" <?=$web_table[$i][table_comment]=="1"?"selected":""?>>비회원</option>
                      <option value="3" <?=$web_table[$i][table_comment]=="3"?"selected":""?>>관리자</option>
                    </select>
                  </td>
                  <td>
                    <select class="form-select" aria-label="select" name="table_secret" onchange="lform<?=$i?>.submit();">
                      <option value="" selected>=비밀글=</option>
                      <option value="Y" <?=$web_table[$i][table_secret]=="Y"?"selected":""?>>사용</option>
                      <option value="N" <?=$web_table[$i][table_secret]=="N"?"selected":""?>>감춤</option>
                    </select>
                  </td>
</form>
                  <td>
                    <button class="btn btn-outline-dark btn-sm" onclick="board_del('<?=$web_table[$i][idx]?>');">삭제</button>
                  </td>
                </tr>
<? } ?>
              </tbody>
            </table>
          </div>
        </div>
        <!-- //게시판관리 테이블 -->
      </div>
    </div>
  </div>
</body>
</html>