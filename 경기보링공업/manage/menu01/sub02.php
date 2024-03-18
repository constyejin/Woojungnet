<?
include "../inc/header.php";
include "../inc/menu.php";

$web_config=sql_fetch("select * from web_config where idx=1 ");
$web_number=explode("-" , $web_config[web_number]); 
$web_phone=explode("-" , $web_config[web_phone]); 
$web_fax=explode("-" , $web_config[web_fax]); 
?>
    <!-- 본문 -->
    <div class="container-fluid title">
      <h2>업체정보</h2>
    </div>
    <div class="content-container">

      <div class="container-fluid info-company">
        <!-- 기본정보 테이블 -->
        <div class="row mt-5">
          <div class="col-10">
            <h3>기본정보</span> </h3>

           <form name="wform" method="post" enctype="multipart/form-data" target="HiddenFrm" action="sub01_save.php">
            <table class="table table-layout border-type basic-info">
              <colgroup>
                <col style="width: 150px;">
                <col style="width: auto;">
                <col style="width: 150px;">
                <col style="width: auto;">
              </colgroup>
              <tbody class="table-light">
                <tr>
                  <th>업체명</th>
                  <td>
                    <input type="text" class="form-control" id="" placeholder="" name="web_name" value="<?=$web_config[web_name]?>">
                  </td>
                  <th>도메인</th>
                  <td>
                    <input type="text" class="form-control" id="" placeholder="" name="web_domain" value="<?=$web_config[web_domain]?>">
                  </td>
                </tr>
                <tr>
                  <th>사업자번호</th>
                  <td>
                    <div class="biz-no">
                      <input type="text" class="form-control" id="" placeholder="" name="web_number[]" value="<?=$web_number[0]?>">
                      <span>-</span>
                      <input type="text" class="form-control" id="" placeholder="" name="web_number[]" value="<?=$web_number[1]?>">
                      <span>-</span>
                      <input type="text" class="form-control" id="" placeholder="" name="web_number[]" value="<?=$web_number[2]?>">
                    </div>
                  </td>
                  <th>대표자</th>
                  <td>
                    <input type="text" class="form-control" id="" placeholder="" name="web_owner" value="<?=$web_config[web_owner]?>">
                  </td>
                </tr>
                <tr>
                  <th>전화번호</th>
                  <td>
                    <div class="phone-no">
                      <input type="text" class="form-control" id="" placeholder="" name="web_phone[]" value="<?=$web_phone[0]?>">
                      <span>-</span>
                      <input type="text" class="form-control" id="" placeholder="" name="web_phone[]" value="<?=$web_phone[1]?>">
                      <span>-</span>
                      <input type="text" class="form-control" id="" placeholder="" name="web_phone[]" value="<?=$web_phone[2]?>">
                    </div>
                  </td>
                  <th>팩스번호</th>
                  <td>
                    <div class="phone-no">
                      <input type="text" class="form-control" id="" placeholder="" name="web_fax[]" value="<?=$web_fax[0]?>">
                      <span>-</span>
                      <input type="text" class="form-control" id="" placeholder="" name="web_fax[]" value="<?=$web_fax[1]?>">
                      <span>-</span>
                      <input type="text" class="form-control" id="" placeholder="" name="web_fax[]" value="<?=$web_fax[2]?>">
                    </div>
                  </td>
                </tr>
                <tr>
                  <th>이메일</th>
                  <td>
                    <input type="text" class="form-control" id="" placeholder="" name="web_email" value="<?=$web_config[web_email]?>">
                  </td>
                  <th>통신판매번호</th>
                  <td>
                    <input type="text" class="form-control" id="" placeholder="" name="web_sell" value="<?=$web_config[web_sell]?>">
                  </td>
                </tr>
                <tr>
                  <th>주소</th>
                  <td colspan="3">
                    <input type="text" class="form-control" id="" placeholder="" name="web_address" value="<?=$web_config[web_address]?>">
                  </td>
                </tr>
                <tr>
                  <th>문자인증키값</th>
                  <td colspan="3">
                    <input type="text" class="form-control" id="" placeholder="" name="" value="">
                  </td>
                </tr>
                <tr>
                  <th>문자아이디</th>
                  <td>
                    <input type="text" class="form-control" id="" placeholder="" name="web_smsid" value="<?=$web_config[web_smsid]?>">
                  </td>
                  <th>문자비번</th>
                  <td>
                    <input type="text" class="form-control" id="" placeholder="" name="web_smspass" value="<?=$web_config[web_smspass]?>">
                  </td>
                </tr>
                <tr class="align-middle">
                  <th>계좌번호</th>
                  <td colspan="3">
                    <ul class="account-info">
                      <li>
                        <span class="label-sm">은행</span>
                        <div class="data-bank">
                          <input type="text" class="form-control" id="" placeholder="" name="web_bank" value="<?=$web_config[web_bank]?>">
                        </div>
                      </li>
                      <li>
                        <span class="label-sm">계좌</span>
                        <div class="data-account">
                          <input type="text" class="form-control" id="" placeholder="" name="web_banknumber" value="<?=$web_config[web_banknumber]?>">
                        </div>
                      </li>
                      <li>
                        <span class="label-sm">예금주</span>
                        <div class="data-owner">
                          <input type="text" class="form-control" id="" placeholder="" name="web_bankowner" value="<?=$web_config[web_bankowner]?>">
                        </div>
                      </li>
                    </ul>
                  </td>
                </tr>
              </tbody>
            </table>
</form>
            <div class="table-footer justify-content-center mt-5">
              <div class="center">
                <button type="button" class="btn btn-outline-secondary btn-sm" onclick="document.wform.submit();">등록하기</button>
              </div>
            </div>
          </div>
        </div>
        <!-- //기본정보 테이블 -->

        

        <!-- 관리자 테이블 -->
        <div class="row mt-5 mb-5">
          <div class="col-10">
            <h3>관리자설정</h3>
            <table class="table border-type manager-setting text-center table-layout">
              <colgroup>
                <col style="width:150px">
                <col style="width:20%">
                <col style="width:20%">
                <col style="width:20%">
                <col style="width:auto">
              </colgroup>
              <thead>
                <th>관리자번호</th>
                <th>이름</th>
                <th>아이디</th>
                <th>비밀번호</th>
                <th>회원레벨</th>
                <th>비고</th>
              </thead>
              <tbody class="table-light">
                <?
                $member_admin=sql_list("select * from member_admin where 1=1 ");
                for($i=0;$i<10;$i++){
                ?>
                <form name="adminform" method="post" enctype="multipart/form-data" target="HiddenFrm" action="member_save.php">
                <input type="hidden" name="idx" value="<?=$member_admin[$i][idx]?>">
                  <tr>
                    <th>관리자<?=$i+1?></th>
                    <td>
                      <input type="text" class="form-control" id="" placeholder="" name="admin_name" value="<?=$member_admin[$i][admin_name]?>">
                    </td>
                    <td>
                      <input type="text" class="form-control" id="" placeholder="" name="admin_id" value="<?=$member_admin[$i][admin_id]?>">
                    </td>
                    <td>
                      <input type="text" class="form-control" id="" placeholder="" name="admin_pass" value="<?=$member_admin[$i][admin_pass]?>">
                    </td>
                    <td>
                      <select class="form-select" name="" id="">
                        <option value="">=회원레벨=</option>
                        <option value="">일반회원</option>
                        <option value="">일반관리자</option>
                        <option value="">중간관리자</option>
                        <option value="">최고관리자</option>
                        <option value="">슈퍼관리자</option>
                      </select>
                    </td>
                    <td>
                    <button class="btn btn-outline-secondary btn-sm" onclick="this.submit();">등록</button>
                  </td>
                </tr>
                </form>
                <? } ?>
              </tbody>
            </table>
          </div>
        </div>
        <!-- //관리자 테이블 -->
      </div>
    </div>
  </div>
</body>
</html>
