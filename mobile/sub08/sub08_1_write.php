<?
include $_SERVER['DOCUMENT_ROOT']."/inc/header.php";
include $_SERVER['DOCUMENT_ROOT']."/inc/menu.php";
?>
<?
if($loginUsort != "admin" && $loginUsort != "admin2" && $loginUsort != "admin3" && $loginUsort != "superadmin" && $loginUsort != "jisajang2"){
	movepage("/index.php", "관리자 로그인이 필요합니다.");
	MsgMov("관리자 로그인이 필요합니다.","/index.php");
	exit;
}


$idx = $_GET['wc_idx'];
if(!$wc_idx)$mode = 'regist';
else $mode = 'modify';

if($wc_idx){
	$qry = "select * from woojung_part where wc_idx = '$wc_idx'  ";
	$row = mysql_fetch_array(mysql_query($qry));
}

?>
<script language="JavaScript" type="text/JavaScript">
function out_submit(){

	f=document.outForm;
	if(!f.wc_trans.value){
		alert("부품1을 선택해 주세요.");
	}else{
		f.submit();
	}
}
function si_chk(z){ 
	var tmp = z.options[z.selectedIndex].value; 
	document.outForm.car_name.options[0].selected="true";
	gufrm.location.href = "/inc/gu.php?tmp="+tmp;  
} 
function bu_chk(z){ 
	var tmp = z.options[z.selectedIndex].value; 
	document.outForm.wc_trans2.options[0].selected="true";
	gufrm.location.href = "/inc/bu.php?tmp="+tmp;  
} 

var upfile_num=1;
var num=0;
var img_count=0;

  function fileInfo(f){
    var file = f.files; // files 를 사용하면 파일의 정보를 알 수 있음
    // 파일의 갯수만큼 반복
    for(var i=0; i<file.length; i++){
       if(img_count==8) break;  
       
      var reader = new FileReader(); // FileReader 객체 사용
      reader.onload = function(rst){
		  if(img_count<8){
			$('#img_box').append('<div class="img-wrap"><img src="' + rst.target.result + '" id="num'+num+'" data-image="tmp'+num+'" class="imgs"><input type=hidden name="tmpfile[]" value="'+ num +'"  id="tmp'+num+'" class="imgnames"></div>'); // append 메소드를 사용해서 이미지 추가
			// 이미지는 base64 문자열로 추가
			// 이 방법을 응용하면 선택한 이미지를 미리보기 할 수 있음
			num++; img_count++; 
			document.getElementById("img_count").innerHTML=img_count;
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

<iframe name="gufrm" style="display:none;" src=""></iframe>
<form name='outForm' method='post' action='car_info_update.php' enctype="multipart/form-data" >
<input type="hidden" name="mode" id="mode" value="<?=$mode?>">
<input type="hidden" name="wc_idx" value="<?=$wc_idx?>">
<input type="hidden" name="wc_go_idx" value="">
<input type="hidden" name="aucidx" value="<?=$aucidx?>">
<input type="hidden" name="aucorderNo" value="<?=$aucNo?>">
<input type="hidden" name="href" value="<?=$href?>">
<input type="hidden" name="gubun4" value="2">
<input type="hidden" name="hidFileName"/>
 <div class="add-parts">
    <section class="title-wrap">
      <h2>부품차량</h2>
    </section>
    <section class="add-sale-list">
      <div class="table-style">
        <ul>
          <li>
            <div class="th">부품구분</div>
            <div class="td">
              <div class="input-wrap">
                <select name="wc_trans">
					<option value="" >== 부품1 ==</option>
					<?
					$sql="select * from cate3 where depth='1' ";
					$result_made=mysql_query($sql);
					while($data_made=mysql_fetch_array($result_made)){
					?>
					<option value="<?=$data_made[idx]?>" <?if($row[wc_trans]==$data_made[idx]) echo "selected";?>>
					<?=$data_made[name]?>
					</option>
					<?
					}
					?>
				</select>
              </div>
            </div>
          </li>
          <li>
            <div class="th">제조/차명</div>
            <div class="td">
              <div class="flex-type brand">
                <div class="input-wrap">
                  <select name="made" onchange="si_chk(this)">
					<option value="" selected="selected">== 제조사 ==</option>
					<?
					$sql="select * from cate2 where depth='1' order by name asc ";
					$result_made=mysql_query($sql);
					while($data_made=mysql_fetch_array($result_made)){
					?>
					<option value="<?=$data_made[idx]?>" <?if($row[wc_made]==$data_made[idx]) echo "selected";?>>
					<?=$data_made[name]?>
					</option>
					<?
					}
					?>
				  </select>
                </div>
                <div class="input-wrap">
                  <select name="car_name" class="form_select" >
					<option value="" selected="selected">== 차명 ==</option>
					<?
					if($row[wc_made]){
					$sql="select * from cate2 where code='$row[wc_made]' order by name asc";
					$result_made=mysql_query($sql);
					while($data_made=mysql_fetch_array($result_made)){
					?>
					<option value="<?=$data_made[name]?>" <?if($row[wc_model]==$data_made[name]) {echo "selected";}?>>
					<?=$data_made[name]?>
					</option>
					<?
					}
					}
					?>
				  </select>
                </div>
              </div>
            </div>
          </li>
          <li>
            <div class="th">년식</div>
            <div class="td">
              <div class="flex-type">
                <div class="input-wrap">
                  <input type="text" name="wc_age" value="<?=$row[wc_age]?>">
                </div>
                <span class="unit">년</span>
              </div>
            </div>
          </li>
          <li>
            <div class="th">재고</div>
            <div class="td">
              <div class="flex-type">
                <div class="input-wrap">
                  <input type="text" name="wc_cc">
                </div>
                <span class="unit">개</span>
                <div class="option">
                  <div class="checkbox-wrap">
                    <input type="checkbox" name="" id="hasStock">
                  </div>
                  <label for="hasStock" class="stock fc-red">재고있음</label>
                </div>
              </div>
            </div>
          </li>
          <li>
            <div class="th">등급</div>
            <div class="td">
              <div class="input-wrap">
				<select name="wc_kind" class="form_select">
				<option value="">== 등급 ==</option>
				<option value="1등급" <? if($row[wc_kind]=="1등급") echo "selected"; ?>selected>1등급</option>
				<option value="2등급" <? if($row[wc_kind]=="2등급") echo "selected"; ?>>2등급</option>
				<option value="3등급" <? if($row[wc_kind]=="3등급") echo "selected"; ?>>3등급</option>
				<option value="4등급" <? if($row[wc_kind]=="4등급") echo "selected"; ?>>4등급</option>
				<option value="5등급" <? if($row[wc_kind]=="5등급") echo "selected"; ?>>5등급</option>
				</select>
              </div>
            </div>
          </li>
          <li>
            <div class="th">가격</div>
            <div class="td">
              <div class="flex-type">
                <div class="input-wrap">
                  <input type="text" name="wc_keep_tel1" value="<?=$row[wc_keep_tel1]?>">
                </div>
                <div class="option">
                  <div class="checkbox-wrap">
                    <input type="checkbox" name="wc_cost" value="1" id="call">
                  </div>
                  <label for="call" class="call fc-red">전화문의</label>
                </div>
              </div>
            </div>
          </li>
        </ul>
      </div>

      <div class="fileupload-wrap">
        <div class="topper">
          <span>등록파일: <span id="img_count">0</span>/24</span>
          <div class="btn-wrap">
            <input type="file" hidden id="fileUpload">
            <button type="button" onclick="file_click();" class="btn btn-secondary btn-sm">파일찾기</button>
            <button type="button" class="btn btn-dark btn-sm">초기화</button>
                  <? for($i=1;$i<=10;$i++){ ?>
                  <input type="file" accept="image/*" multiple="multiple" onchange="fileInfo(this)" name="upfile[]" id="uf<?=$i?>" style="display:none;"/>
                  <? } ?>
          </div>
        </div>

        <div class="img-list" id="img_box">
          <!--div class="img-wrap">
            <img src="https://picsum.photos/200/300" alt="">
          </div>
          <div class="img-wrap">
            <img src="https://picsum.photos/200/300" alt="">
          </div>
          <div class="img-wrap">
            <img src="https://picsum.photos/200/300" alt="">
          </div>
          <div class="img-wrap">
            <img src="https://picsum.photos/200/300" alt="">
          </div>
          <div class="img-wrap">
            <img src="https://picsum.photos/200/300" alt="">
          </div>
          <div class="img-wrap">
            <img src="https://picsum.photos/200/300" alt="">
          </div>
          <div class="img-wrap">
            <img src="https://picsum.photos/200/300" alt="">
          </div>
          <div class="img-wrap">
            <img src="https://picsum.photos/200/300" alt="">
          </div>
          <div class="img-wrap">
            <img src="https://picsum.photos/200/300" alt="">
          </div-->
        </div>

        <p class="notice">
          * 신청접수의 각 항목을 기입 후 신청해주시면 업무담당자가 확인 후 연락을 드립니다.
        </p>
        <p class="notice">
          * 고객님께서 입력하신 내용은 경·공매 및 폐차진행을 위한 기본정보이며 안전하게 보호관리됨을 알려드립니다.
        </p>
      </div>

      <div class="btn-wrap">
        <button type="button" class="btn btn-primary btn-wide btn-md" onclick="out_submit()">등록하기</button>
      </div>
    </section>
  </div>
</form>
  
  <footer>
    <div class="btn-wrap install">
      <button class="btn btn-outline-gray btn-round">바탕아이콘설치(안드로이드)</button>
      <button class="btn btn-black btn-round">PC 버전보기</button>
    </div>
    <p class="copyright">
      상담 : TEL. 02-428-7723 (주말, 공휴일 휴무)<br>Copyright (c) (주)인카온 All rights reserved.
    </p>
  </footer>
</body>
</html>