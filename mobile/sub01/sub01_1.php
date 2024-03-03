<?
include $_SERVER['DOCUMENT_ROOT']."/inc/header.php";
include $_SERVER['DOCUMENT_ROOT']."/inc/menu.php";
?>
<script language="JavaScript" src="/admin/inc/default.js"></script>
<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script> 
<script language="javascript" type="text/javascript">
 $(document).ready(function() {

  //******************************************************************************
  // 상세검색 달력 스크립트
  //******************************************************************************
  var clareCalendar = {
   monthNamesShort: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
   dayNamesMin: ['일','월','화','수','목','금','토'],
   weekHeader: 'Wk',
   dateFormat: 'yy-mm-dd', //형식(20120303)
   autoSize: false, //오토리사이즈(body등 상위태그의 설정에 따른다)
   changeMonth: true, //월변경가능
   changeYear: true, //년변경가능
   showMonthAfterYear: true, //년 뒤에 월 표시
   buttonImageOnly: true, //이미지표시
   buttonText: '달력선택', //버튼 텍스트 표시
   buttonImage: '/images/icon_data.gif', //이미지주소
   showOn: "both", //엘리먼트와 이미지 동시 사용(both,button)
   yearRange: '2010:<?=date("Y")+1?>' //1990년부터 2020년까지
  };
  $("#sdate").datepicker(clareCalendar);
  $("#edate").datepicker(clareCalendar);
  $("#adate").datepicker(clareCalendar);
  $("#bdate").datepicker(clareCalendar);
  $("#cdate").datepicker(clareCalendar);
  $("#jdate").datepicker(clareCalendar);
  $("#wc_pay_date1").datepicker(clareCalendar);
  $("#wc_pay_date2").datepicker(clareCalendar);
  $("#wc_pay_date3").datepicker(clareCalendar);
  $("#wc_pay_date4").datepicker(clareCalendar);
  $("#wc_pay_date5").datepicker(clareCalendar);
  $("#wc_pay_date6").datepicker(clareCalendar);
  $("#wc_pay_date7").datepicker(clareCalendar);

  $("#im_date").datepicker(clareCalendar);
  

  $("img.ui-datepicker-trigger").attr("style","margin-left:5px; vertical-align:middle; cursor:pointer;"); //이미지버튼 style적용
  $("#ui-datepicker-div").hide(); //자동으로 생성되는 div객체 숨김  
 });
</script>
<?
$idx = $_GET['idx'];
if(!$idx)$mode = 'regist';
else $mode = 'modify';
if ($__lib['limit_ext'] != ''){
	preg_match('/[.]+('.str_replace(';', '|', $__lib['limit_ext']).')+/i', $_FILES['upfile']['name'], $mc);
}

if($loginId){
	$row = mysql_fetch_array(mysql_query("SELECT * FROM woojung_member WHERE userId='$loginId'"));
	if($row[idx]) {
		$call_line = 'user';
		$post = $row[post1].'-'.$row[post2];
	} else {
		$call_line = '';
		$post = '';
	}
	$telarr = explode('-',$row[tel]);
	$pcsarr = explode('-',$row[pcs]); 
	$faxarr = explode('-',$row[fax]); 
	$emailarr = explode('@',$row[email]);
	$zipcode1 = $row[post1];
	$zipcode2 = $row[post2];

	//dbclose($connect);
}else{
	echo "<script>alert('로그인후 사용 가능합니다.');location.href='/member/login.php';</script>";
}
?>
<script type="text/javascript">
function out_submit(){

	f=document.outForm;

	if(f.carno_c.value!='1'){
		alert('차량번호 중복확인을 해주세요');
		return false;
	}else{
		f.action="car_info_update.php";
		f.target="";
		f.submit();
	}
}

function moveInput(sort) {
	if(sort == 'tel1') {
		$('call_tel2').focus();
	} else if(sort == 'tel2') {
		if($F('call_tel2').length >=4)$('call_tel3').focus();
	
	} else if(sort == 'pcs1') {
		$('call_pcs2').focus();
	} else if(sort == 'pcs2') {
		if($F('call_pcs2').length >=4)$('call_pcs3').focus();
	}
}

function check_num_Window(){		
	var frm = document.outForm;
	var id = frm.carno.value;
	
	if(!frm.carno.value){		
		alert("차량번호를 입력해주세요");
		frm.carno.focus();
		return;
	}else{
		document.getElementById("HiddenFrm").src="/inc/carnum_check.php?carno="+id;
	}
}	
</script>
<script>
 
var upfile_num=1;
var num=0;
var img_count=0;

  function fileInfo(f){
    var file = f.files; // files 를 사용하면 파일의 정보를 알 수 있음
    // 파일의 갯수만큼 반복
    for(var i=0; i<file.length; i++){
       if(img_count==10){ alert('사진은 10개까지 등록 가능합니다.');break;  }
       
      var reader = new FileReader(); // FileReader 객체 사용
      reader.onload = function(rst){
		  if(img_count<10){
			$('#img_box').append('<img src="' + rst.target.result + '"width="95" height="82" id="num'+num+'" data-image="tmp'+num+'" class="imgs"><input type=hidden name="tmpfile[]" value="'+ num +'"  id="tmp'+num+'" class="imgnames">'); // append 메소드를 사용해서 이미지 추가
			// 이미지는 base64 문자열로 추가
			// 이 방법을 응용하면 선택한 이미지를 미리보기 할 수 있음
		  num++; img_count++; 
		  document.getElementById("img_count").innerHTML=img_count;
		  }else{
			  alert('사진은 10개까지 등록 가능합니다.');
		  }
      }
       
      reader.readAsDataURL(file[i]); // 파일을 읽는다
 
    }
	upfile_num++;
  }
 
 
$(document).on("click","#img_box .imgs",function(){
      $(this).remove();
	  dataimg = $(this).data('image');
		$("#"+dataimg).remove();
		img_count--;
    document.getElementById("img_count").innerHTML=img_count;
}); 

$(document).on("click","#img_del",function(){
	$(".imgs").remove();
	$(".imgnames").remove();
	img_count=0;
    document.getElementById("img_count").innerHTML=0;
}); 

function file_click(){
	document.getElementById('uf'+upfile_num).click();
}
</script>
  
  
<iframe name="HiddenFrm" id="HiddenFrm" style="display:none;"></iframe>
<iframe name="gufrm" style="display:none;" src=""></iframe>
<form name='outForm' method='post' enctype="multipart/form-data" target="gufrm">
<input type="hidden" name="mode" id="mode" value="<?=$mode?>">
<input type="hidden" name="wc_idx" value="<?=$wc_idx?>">
<input type="hidden" name="wc_go_idx" value="">
<input type="hidden" name="aucidx" value="<?=$aucidx?>">
<input type="hidden" name="aucorderNo" value="<?=$aucNo?>">
<input type="hidden" name="href" value="<?=$href?>">
<input type="hidden" name="hidFileName"/>
 <div class="add-car">
    <section class="title-wrap">
      <h2>차량등록</h2>
    </section>
    <section class="tab-wrap wide-type">
      <ul>
        <li class="tab active">
          <a href="/sub01/sub01_1.php">차량등록</a>
        </li>
        <li class="tab">
          <a href="/sub01/sub01_2.php">사진추가</a>
        </li>
        <li class="tab">
          <a href="/sub01/sub01_3.php">1:1상담</a>
        </li>
      </ul>
    </section>
    <section class="user-info">
      <h3>출품자정보</h3>
      <div class="table-style">
        <ul>
          <li>
            <div class="th">신청구분</div>
            <div class="td">
              <ul class="radio-group">
                <li>
                  <div class="radio-wrap">
                    <input type="radio" name='calltype' value='폐차'>
                    <label class="radio-label" for="bidType1">폐차</label>
                  </div>
                </li>
                <li>
                  <div class="radio-wrap">
                    <input type="radio" name='calltype' value='명의이전'>
                    <label class="radio-label" for="bidType2">명의이전</label>
                  </div>
                </li>
                <li>
                  <div class="radio-wrap">
                    <input type="radio" name='calltype' value='폐차/이전'>
                    <label class="radio-label" for="bidType3">폐차/이전</label>
                  </div>
                </li>
              </ul>
            </div>
          </li>
          <li>
            <div class="th">신청자</div>
            <div class="td"><?=$row[wc_mem_name]?$row[wc_mem_name]:$loginName?></div>
          </li>
		  <?
		  if($wc_idx){
				if($row[company_tel] && $row[company_tel]!="--"){
					$tel = $row[company_tel];
				}else if($row[wc_mem_phone] && $row[wc_mem_phone]!="--"){
					$tel = $row[wc_mem_phone];
				}else if($row[wc_owner_tel] && $row[wc_owner_tel]!="--"){
					$tel = $row[wc_owner_tel];
				}
			}else {
				$tel = $row[tel];
			}
		  ?>
          <li>
            <div class="th">휴대전화</div>
            <div class="td"><?=$tel?></div>
          </li>
          <li>
            <div class="th">제휴사접수번호</div>
            <div class="td">
              <div class="input-wrap">
                <input type="text" name="jnumber">
              </div>
            </div>
          </li>
          <li>
            <div class="th">담보</div>
            <div class="td">
              <ul class="radio-group">
                <li>
                  <div class="radio-wrap">
                    <input type="radio" name='dambo1' value='자차'>
                    <label class="radio-label" for="guaranteeType1">자차</label>
                  </div>
                </li>
                <li>
                  <div class="radio-wrap">
                    <input type="radio" name='dambo1' value='대물'>
                    <label class="radio-label" for="guaranteeType2">대물</label>
                  </div>
                </li>
              </ul>
            </div>
          </li>
          <li>
            <div class="th">계좌번호</div>
            <div class="td">
              <div class="account-wrap">
                <div class="account-bank">
                  <span class="label">은행</span>
                  <div class="input-wrap">
                    <input type="text" name="dambo3_1">
                  </div>
                </div>
                <div class="account-holder">
                  <div class="label">계좌번호</div>
                  <div class="input-wrap">
                    <input type="text" name="dambo3_2">
                  </div>
                </div>
                <div class="account-number">
                  <div class="label">예금주</div>
                  <div class="input-wrap">
                    <input type="text" name="dambo3_3">
                  </div>
                </div>
              </div>
            </div>
          </li>
        </ul>
      </div>
    </section>
    <section class="car-info">
      <h3>차량정보</h3>
      <div class="table-style">
        <ul>
          <li>
            <div class="th">제휴/보험</div>
            <div class="td">
              <div class="input-wrap">
				<select name="car_cate">
				<option value="" selected>:: 선택 ::</option>
				<?
				$team_cate_sql=mysql_query("select * from team_cate where depth='1'");
				while($team_cate=mysql_fetch_array($team_cate_sql)){
				?>
				<option value="<?=$team_cate["idx"]?>" <?if($team_cate["idx"]==$row[car_cate]){ echo "selected"; }?>><?=$team_cate["name"]?></option>
				<?}?>
				</select>
              </div>
            </div>
          </li>
          <li>
            <div class="th">전손/분손</div>
            <div class="td">
              <ul class="radio-group">
                <li>
                  <div class="radio-wrap">
                    <input type="radio" name="evalAmt_type" value="전손" id="damageType1">
                    <label class="radio-label" for="damageType1">전손</label>
                  </div>
                </li>
                <li>
                  <div class="radio-wrap">
                    <input type="radio" name="evalAmt_type" value="분손" id="damageType2">
                    <label class="radio-label" for="damageType2">분손</label>
                  </div>
                </li>
                <li>
                  <div class="radio-wrap">
                    <input type="radio" name="evalAmt_type" value="미정" id="damageType2">
                    <label class="radio-label" for="damageType2">미정</label>
                  </div>
                </li>
              </ul>
            </div>
          </li>
          <li>
            <div class="th">차량번호</div>
            <div class="td">
              <div class="flex-type">
                <div class="input-wrap">
                  <input type="text" name="carno"><input type="hidden" name="carno_c" value="0">
                </div>
                <button class="btn btn-round btn-secondary btn-sm" onClick="check_num_Window();">확인</button>
              </div>
            </div>
          </li>
          <li>
            <div class="th">차대번호</div>
            <div class="td">
              <div class="input-wrap">
                <input type="text" name="wc_prog_area_price">
              </div>
            </div>
          </li>
          
          <li>
            <div class="th">차량명</div>
            <div class="td">
              <div class="input-wrap">
                <input type="text" name="car_name2">
              </div>
            </div>
          </li>
          <li>
            <div class="th">년식(등록일)</div>
            <div class="td">
              <div class="flex-type">
                <div class="input-wrap year">
                  <input type="text" name="car_year_yy">
                </div>
                <span class="unit">년</span>
                <div class="input-wrap month">
                  <input type="text">
                </div>
                <span class="unit" name="car_year_mm">월</span>
                </div>
            </div>
          </li>
          <li>
            <div class="th">변속기</div>
            <div class="td">
              <div class="flex-type select-input-group">
                <div class="input-wrap">
				<select name="trans" >
				<option value="" selected>==변속기==</option>
				<?
				$sql="select * from cate where code='1' ";
				$result_made=mysql_query($sql);
				while($data_made=mysql_fetch_array($result_made)){
				?>
				<option value="<?=trim($data_made[name])?>" <?if(trim($row[wc_trans])==trim($data_made[name])) echo "selected";?>><?=$data_made[name]?></option>
				<?
				}
				?>
				</select>
                </div>
              </div>
            </div>
          </li>
          <li>
            <div class="th">연료</div>
            <div class="td">
              <div class="flex-type select-input-group">
                <div class="input-wrap">
				<select name="fual" >
				<option value="" selected>==연료==</option>
				<?
				$sql="select * from cate where code='2' ";
				$result_made=mysql_query($sql);
				while($data_made=mysql_fetch_array($result_made)){
				?>
				<option value="<?=$data_made[name]?>" <?if($row[wc_fual]==$data_made[name]) echo "selected";?>><?=$data_made[name]?></option>
				<?
				}
				?>
				</select>
                </div>
              </div>
            </div>
          </li>
          <li>
            <div class="th">배기량</div>
            <div class="td">
              <div class="flex-type">
                <div class="input-wrap">
                  <input type="text" name="carcc">
                </div>
                <span class="unit">cc</span>
              </div>
            </div>
          </li>
          <li>
            <div class="th">주행거리</div>
            <div class="td">
              <div class="flex-type">
                <div class="input-wrap">
                  <input type="text" name="carmile">
                </div>
                <span class="unit">km</span>
              </div>
            </div>
          </li>
          <li>
            <div class="th">사고발생일</div>
            <div class="td">
              <div class="flex-type">
                <div class="input-wrap">
                  <input type="text" name="caraccdate">
                </div>
                <span class="icon-calendar"></span>
              </div>
            </div>
          </li>
          <li>
            <div class="th">발생비용</div>
            <div class="td">
              <div class="flex-type">
                <div class="input-wrap">
                  <input type="text" name="wc_go_cost">
                </div>
                <span class="unit">원</span>
              </div>
            </div>
          </li>
          <li>
            <div class="th">차량설명</div>
            <div class="td">
              <div class="input-wrap textarea-wrap">
                <textarea name="car_memo" id="" cols="30" rows="5"></textarea>
              </div>
            </div>
          </li>
          <li>
            <div class="th">보관장소</div>
            <div class="td">
              <div class="input-wrap">
                <input type="text" name="moveKeepReq">
              </div>
            </div>
          </li>
          <li>
            <div class="th">보관연락처</div>
            <div class="td">
              <div class="flex-type">
                <div class="input-wrap">
                  <input type="text" name="wc_keep_tel_1">
              </div>
          </li>
          <li>
            <div class="th">보관담당자</div>
            <div class="td">
              <div class="input-wrap">
                <input type="text" name="keep_name1">
              </div>
            </div>
          </li>
          <li>
            <div class="th">소유형태</div>
            <div class="td">
              <ul class="radio-group">
                <li>
                  <div class="radio-wrap">
                    <input type="radio" name="own-type" id="ownType1">
                    <label class="radio-label" for="ownType1">개인</label>
                  </div>
                </li>
                <li>
                  <div class="radio-wrap">
                    <input type="radio" name="own-type" id="ownType2">
                    <label class="radio-label" for="ownType2">법인</label>
                  </div>
                </li>
                <li>
                  <div class="radio-wrap">
                    <input type="radio" name="own-type" id="ownType3">
                    <label class="radio-label" for="ownType3">공동소유</label>
                  </div>
                </li>
                <li>
                  <div class="radio-wrap">
                    <input type="radio" name="own-type" id="ownType4">
                    <label class="radio-label" for="ownType4">리스</label>
                  </div>
                </li>
                <li>
                  <div class="radio-wrap">
                    <input type="radio" name="own-type" id="ownType5">
                    <label class="radio-label" for="ownType5">기타</label>
                  </div>
                </li>
              </ul>
            </div>
          </li>
          <li>
            <div class="th">차주명</div>
            <div class="td">
              <div class="input-wrap">
                <input type="text" name="owner_name">
              </div>
            </div>
          </li>
          <li>
            <div class="th">차주연락처</div>
            <div class="td">
              <div class="flex-type">
                <div class="input-wrap">
                  <input type="text" name="owner_tel1">
                </div>
                </div>
          </li>
          <li>
            <div class="th">사진등록</div>
            <div class="td">
              <button class="btn btn-secondary btn-sm layer-pop-toggle" type="button"><span class="icon-camera"></span> 사진등록 및 수정</button>
            </div>
          </li>
        </ul>
        <p class="notice">
          * 신청접수의 각 항목을 기입 후 신청해주시면, 업무당담자가 확인 후 연락을 드립니다.
        </p>
      </div>
      <div class="btn-wrap">
        <button type="button" class="btn btn-primary btn-wide btn-md" onclick="out_submit()">차량등록하기</button>
      </div>
    </section>
  </div>

  
  <footer>
    <div class="btn-wrap install">
      <button class="btn btn-outline-gray btn-round home-down-load" onclick="incaronUI.home_key()">
        바탕아이콘설치(안드로이드)</button>
      <button class="btn btn-black btn-round">PC 버전보기</button>
    </div>
    <p class="notice-for-install">
      *네이버가 설치된 경우만 가능합니다 
    </p>
    <p class="copyright">
      상담 : TEL. 02-428-7723 (주말, 공휴일 휴무)<br>Copyright (c) (주)인카온 All rights reserved.
    </p>
  </footer>

 <? for($i=1;$i<=10;$i++){ ?>
  <input type="file" accept="image/*" multiple onChange="fileInfo(this)" name="upfile[]" id="uf<?=$i?>" style="display:none;"/>
<? } ?>
 <div class="layer-pop add-car">
    <div class="pop-header">
      <div class="title">사진등록하기</div>
      <a href="" class="btn-close-pop"></a>
    </div>
    <div class="pop-body add-photo add-photo-pop">
      <div class="fileupload-wrap">
        <div class="topper">
          <span>등록파일: <span id="img_count">0</span>/24</span>
          <div class="btn-wrap">
            <input type="file" hidden="" id="fileUpload">
            <button type="button" onclick="file_click();" class="btn btn-secondary btn-sm">파일찾기</button>
            <button type="button" class="btn btn-dark btn-sm">초기화</button>
          </div>
        </div>

        <div class="img-list" id="img_box">
        </div>
      </div>
      <!--div class="btn-wrap">
        <button type="button" class="btn btn-submit-color btn-md">파일업로드</button>
      </div>

      <div class="img-checkbox-list">
        <div class="img-list">
          <div class="img-wrap">
            <img src="https://picsum.photos/200/300" alt="">
            <div class="check-wrap">
              <input type="checkbox" name="" id="">
              <span class="number">1</span>
            </div>
          </div>
          <div class="img-wrap">
            <img src="https://picsum.photos/200/300" alt="">
            <div class="check-wrap">
              <input type="checkbox" name="" id="">
              <span class="number">1</span>
            </div>
          </div>
          <div class="img-wrap">
            <img src="https://picsum.photos/200/300" alt="">
            <div class="check-wrap">
              <input type="checkbox" name="" id="">
              <span class="number">1</span>
            </div>
          </div>
          <div class="img-wrap">
            <img src="https://picsum.photos/200/300" alt="">
            <div class="check-wrap">
              <input type="checkbox" name="" id="">
              <span class="number">1</span>
            </div>
          </div>
          <div class="img-wrap">
            <img src="https://picsum.photos/200/300" alt="">
            <div class="check-wrap">
              <input type="checkbox" name="" id="">
              <span class="number">1</span>
            </div>
          </div>
          <div class="img-wrap">
            <img src="https://picsum.photos/200/300" alt="">
            <div class="check-wrap">
              <input type="checkbox" name="" id="">
              <span class="number">1</span>
            </div>
          </div>
          <div class="img-wrap">
            <img src="https://picsum.photos/200/300" alt="">
            <div class="check-wrap">
              <input type="checkbox" name="" id="">
              <span class="number">1</span>
            </div>
          </div>
          <div class="img-wrap">
            <img src="https://picsum.photos/200/300" alt="">
            <div class="check-wrap">
              <input type="checkbox" name="" id="">
              <span class="number">1</span>
            </div>
          </div>
          <div class="img-wrap">
            <img src="https://picsum.photos/200/300" alt="">
            <div class="check-wrap">
              <input type="checkbox" name="" id="">
              <span class="number">1</span>
            </div>
          </div>
        </div>
      </div>

      <div class="btn-group">
        <button class="btn btn-sm btn-secondary">전체선택</button>
        <button class="btn btn-sm btn-dark">전체해제</button>
        <button class="btn btn-sm btn-black">선택삭제</button>
      </div-->
    </div>

    <div class="pop-footer">
      <a href="" class="btn-close-pop">[닫기]</a>
    </div>
  </div>
 </form>
</body>
</html>