<?include "../inc/header.php" ?>

<?
  if($loginUsort != "admin" && $loginUsort != "admin1" && $loginUsort != "admin2" && $loginUsort != "superadmin" && $loginUsort != "jisajang2"){
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
  //	if(!f.wc_trans.value){
  //		alert("차량명을 주세요.");
  //	}else{
      f.action="car_info_update.php";
      submitContents();
      f.submit();
  //	}
  }
  function si_chk(z){ 
    var tmp = z.options[z.selectedIndex].value; 
    document.outForm.car_name.options[0].selected="true";
    gufrm.location.href = "/manage/inc/gu.php?tmp="+tmp;  
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
      if(img_count==60) break;  
      
      var reader = new FileReader(); // FileReader 객체 사용
      reader.onload = function(rst){
        if(img_count<60){
        $('#img_box').append('<img src="' + rst.target.result + '"width="125" height="90" id="num'+num+'" data-image="tmp'+num+'" class="imgs"><input type=hidden name="tmpfile[]" value="'+ num +'"  id="tmp'+num+'" class="imgnames">'); // append 메소드를 사용해서 이미지 추가
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

  function img_del(cnt,wc_idx){
    if(confirm("사진을 삭제하겠습니까?")){
      document.getElementById("gufrm").src="image_update.php?Mode=delete&No="+cnt+"&wc_idx="+wc_idx;
    }
  }
</script>

<?
  if($row[wc_made]){
?>

<iframe name="gufrm" id="gufrm" style="display:none;" src="/manage/inc/gu.php?tmp=<?=$row[wc_made]?>"></iframe>
<?}else{?>
<iframe name="gufrm" id="gufrm" style="display:none;" src=""></iframe>
<?}?>

<script language="JavaScript" src="/admin/inc/default.js"></script>
<script type="text/javascript" src="/lib/form.js"></script>

<div id="contents_basic">
  <div class="co_car_all">
  	<div class="sub-visual">
			<div class="sub-text">
        <p class="catch-phrase">
            중고차 / 보유차량
        </p>
        <p class="description-text">
            중고차 / 사고차 / 수출차량을 다량 보유하고 있습니다.
        </p>
			</div>
		</div>

    <!-- 추가 -->
    <!-- 위에 상세설명 표  -->
    <div class="div_basic">
      <table style="width:1200px; margin:20 auto;">
        <tbody>
          <tr>
            <td colspan="3" align="center">
              <table width="140" border="0" cellpadding="5" cellspacing="0" style=" width:140px;margin-bottom: 40px;margin-top: 20px;">
                <tbody>
                  <tr>
                    <td width="65">
                      <a href="sub07_1.php" style="display:inline-flex; justify-content: center; align-items:center;border: 2px solid #0066CC; border-radius: 20px; min-width: 80px; height: 32px;font-size: 12px;font-weight: 600;color:#0066CC; ">
                        목록보기
                      </a>
                    </td>
                  
                    <td width="65">
                      <?
                      if($loginUsort == "admin" || $loginUsort == "admin2" || $loginUsort == "admin3" || $loginUsort == "superadmin" || $loginUsort == "jisajang2"){
                      ?>
                      <a href="javascript:out_submit();" style="display:inline-flex; justify-content: center; align-items:center;border: 2px solid #cc3535; border-radius: 20px; min-width: 80px; height: 32px;font-size: 12px;font-weight: 600;color: #cc3535;margin-left: 10px; ">
                        등록하기
                      </a>
                      <?
                      }
                      ?>
                    </td>
                  </tr>
                </tbody>
              </table>

              <form name='outForm' method='post' action='car_info_update.php' enctype="multipart/form-data" >
                <input type="hidden" name="mode" id="mode" value="<?=$mode?>">
                <input type="hidden" name="wc_idx" value="<?=$wc_idx?>">
                <input type="hidden" name="wc_go_idx" value="">
                <input type="hidden" name="aucidx" value="<?=$aucidx?>">
                <input type="hidden" name="aucorderNo" value="<?=$aucNo?>">
                <input type="hidden" name="href" value="<?=$href?>">
                <input type="hidden" name="gubun4" value="2">
                <input type="hidden" name="hidFileName"/>

                <div class="div_information">
                  <table style="width:1200px; height:50px; margin: 0 auto; font-weight: bold; background-color:#fff;" border="0" cellspacing="0" cellpadding="0">
                    <tbody style="border: 1px solid #ccc"> 
                      <!--차량 정보 표 -->
                      <tr height="50px">
                        <td width="198px" bgcolor="#f2f2f2" style="padding:12px; border-right:1px solid #ccc; border-bottom:1px solid #ccc;color:#888; box-sizing:border-box;">
                          고유번호 No.
                        </td>

                        <td style="padding:12px; border-right:1px solid #ccc; border-bottom:1px solid #ccc">
                          24-0200000
                        </td>

                        <td bgcolor="#f2f2f2" style="padding:12px; border-right:1px solid #ccc; border-bottom:1px solid #ccc;color: #888;">
                          판매상태 Sales status
                        </td>

                        <td style="padding:4px 12px; border-right:1px solid #ccc; border-bottom:1px solid #ccc;">
                          <div class="btn-group">
                            <ul class="radio-list">
                              <li style="display:inline-block">
                                <input type='radio' name='calltype' value='1' <?=$row[calltype]=="1"?"checked":""?>>
                                <span href class="btn btn-sm btn-red btn-round">sale</span>
                              </li>
                              <li style="display:inline-block; margin-left:5px;">
                                <input type='radio' name='calltype' value='2' <?=$row[calltype]=="2"?"checked":""?>>
                                <span href class="btn btn-sm btn-black btn-round" style="margin-left:5px;">soldout</span>
                              </li>
                            </ul>
                          </div>
                        </td>
                      </tr>

                      <tr height="50px">
                        <td bgcolor="#f2f2f2" style="padding:12px; border-right:1px solid #ccc; border-bottom:1px solid #ccc; color: #888;">
                          차량명 Vehicle name
                        </td>
                        <td colspan="3" style="padding:12px; border-right:1px solid #ccc; border-bottom:1px solid #ccc;">
                        <input type="text" name="wc_mem_etc" class="form_control bold" size="80" value="<?=$row[wc_mem_etc]?>"></td>
                      </tr>

                      <tr height="50px">
                        <td bgcolor="#f2f2f2" style="padding:12px; border-right:1px solid #ccc; border-bottom:1px solid #ccc; color: #888;">
                          차량번호 Registration number
                        </td>

                        <td style="padding:12px; border-right:1px solid #ccc; border-bottom:1px solid #ccc;"><?=$cate1[name]?>
                          <input type="text" class="form_control bold">
                        </td>

                        <td bgcolor="#f2f2f2" style="padding:12px; border-right:1px solid #ccc; border-bottom:1px solid #ccc; color: #888;">
                          사고이력 History of accidents
                        </td>

                        <td width="200" height="50"  align="left"  bgcolor="#FFFFFF" style="padding:12px; border-right:1px solid #ccc; border-bottom:1px solid #ccc;">
                          <span style="margin-right:8px;">
                            <input type="radio" name="" value="">
                            <span style="margin-left:2px;">무사고</span>
                          </span>
                          <span>
                            <input type="radio" name="" value="">
                            <span style="margin-left:2px;">사고있음</span>
                          </span>
                          <?=$row[wc_model]?>
                        </td>
                      </tr>

                      <tr height="50px">
                        <td bgcolor="#f2f2f2" style="padding:12px; border-right:1px solid #ccc; border-bottom:1px solid #ccc; color:#888;">
                          제조사 Manufacturer
                        </td>

                        <td style="padding:12px; border-right:1px solid #ccc; border-bottom:1px solid #ccc;">
                          <select name="made" onchange="si_chk(this)" class="form_select bold">
                          <option value="" selected="selected">== 제조사 ==</option>
                            <?
                              $sql="select * from cate2 where depth='1' order by name asc ";
                              $result_made=mysql_query($sql);
                              while($data_made=mysql_fetch_array($result_made)){
                            ?>
                              <option value="<?=$data_made[idx]?>" <?if($row[wc_made]==$data_made[idx]) echo "selected";?>><?=$data_made[name]?>
                              </option>
                            <?
                            }
                            ?>
                          </select>
                        </td>

                        <td bgcolor="#f2f2f2" style="padding:12px; border-right:1px solid #ccc; border-bottom:1px solid #ccc; color: #888888">
                          모델명 Model
                        </td>

                        <td style="padding:12px; border-right:1px solid #ccc; border-bottom:1px solid #ccc;">
                          <select name="car_name" class="form_select bold" >
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
                        </td>
                      </tr>

                      <tr height="50px">
                        <td bgcolor="#f2f2f2" style="padding:12px; border-right:1px solid #ccc; border-bottom:1px solid #ccc; color: #888;">
                          년식 Model year
                        </td>

                        <td style="padding:12px; border-right:1px solid #ccc; border-bottom:1px solid #ccc;">
                          <span style="margin-right:4px;">
                            <input name="wc_age" type="text" size="5" value="<?=$row[wc_age]?>" class="form_control bold"/>
                            <span>년</span>
                          </span>
                          <span>
                            <select class="month" name="month" style="display:inline-block; height:23px; border:1px solid #ccc; font-weight:bold">
                              <option value="">월</option>
                              <option value="1">1</option>
                              <option value="2">2</option>
                              <option value="3">3</option>
                              <option value="4">4</option>
                              <option value="5">5</option>
                              <option value="6">6</option>
                              <option value="7">7</option>
                              <option value="8">8</option>
                              <option value="9">9</option>
                              <option value="10">10</option>
                              <option value="11">11</option>
                              <option value="11">12</option>
                            </select>
                            <span>월</span>
                          </span>
                        </td>
                
                        <td bgcolor="#f2f2f2" style="padding:12px; border-right:1px solid #ccc; border-bottom:1px solid #ccc; color: #888;">
                          변속기 Transmission
                        </td>

                        <td style="padding:12px; border-right:1px solid #ccc; border-bottom:1px solid #ccc;">
                          <select name="trans" class="form_select bold">
                            <option value="" selected>:: 변속기 ::</option>
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
                        </td>
                      </tr>

                      <tr height="50px">
                        <td width="170" height="50" align="left" bgcolor="#f2f2f2" style="padding:12px; border-right:1px solid #ccc; border-bottom:1px solid #ccc; color: #888;">
                          연료 Fuel type
                        </td>

                        <td width="200" height="50"  align="left"  bgcolor="#FFFFFF" style="padding:12px; border-right:1px solid #ccc; border-bottom:1px solid #ccc;">
                          <select name="fual" class="form_select bold">
                            <option value="" selected>:: 연료 ::</option>
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
                        </td>

                        <td width="170" height="50" align="left" bgcolor="#f2f2f2" style="padding:12px; border-right:1px solid #ccc; border-bottom:1px solid #ccc; color: #888;">
                          배기량 Displacement
                        </td>

                        <td width="200" height="50"  align="left"  bgcolor="#FFFFFF" style="padding:12px; border-right:1px solid #ccc; border-bottom:1px solid #ccc;">
                        <input type="text" name="carcc" style='width:100;' onKeyup="javascript:comma(this);" class="form_control bold" value="<?=number($row[wc_cc])?>">
                          cc 
                        </td>
                      </tr>

                      <tr height="50px">
                        <td bgcolor="#f2f2f2" style="padding:12px; border-right:1px solid #ccc; border-bottom:1px solid #ccc; color:#888;">
                          주행거리 Odometer
                        </td>

                        <td style="padding:12px; border-right:1px solid #ccc; border-bottom:1px solid #ccc;">
                        <input type="text" name="carmile"  style='width:100;' onKeyup="javascript:comma(this);" class="form_control bold" value="<?=number($row[wc_mileage])?>">km
                        </td>

                        <td bgcolor="#f2f2f2" style="padding:12px; border-right:1px solid #ccc; border-bottom:1px solid #ccc; color:#888;">
                          가격 Price
                        </td>

                        <td style="padding:12px; border-right:1px solid #ccc; border-bottom:1px solid #ccc;">
                          <input name="wc_keep_tel1" type="text" size="25" value="<?=number($row[wc_keep_tel1])?>" onKeyup="javascript:comma(this);" class="form_control bold"/>
                          <input type="checkbox" name="wc_cost" value="1" checked="checked" />
                          <font color="#FF0000">전화문의</font>
                        </td>
                      </tr>

                      <tr height="50px">
                        <td align="center" colspan="4" bgcolor="#f2f2f2" style="border-right:1px solid #CCCCCC; border-bottom:1px solid #ccc;color: #888; font-size:15px;">
                          상세설명 Sale Information
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                
                <!-- 위에 상세 설명 표 -->
                <div class="div_basic">
                  <table align="center" style="width: 1200px; margin: auto;" >
                    <tbody>
                      <tr>
                        <td align="center" >
                          <tr>
                            <td height="200" colspan="5" bgcolor="#FFFFFF" >
                              <script type="text/javascript" src="/board/smarteditor2/js/HuskyEZCreator.js" charset="utf-8"></script>

                              <textarea name="carOptionadd" id="ir1" rows="10" cols="100" style="width:100%; height:320px; display:none;"><?=$row[wc_option_add]?>
                              </textarea>

                              <script type="text/javascript">
                                var oEditors = [];

                                // 추가 글꼴 목록
                                //var aAdditionalFontSet = [["MS UI Gothic", "MS UI Gothic"], ["Comic Sans MS", "Comic Sans MS"],["TEST","TEST"]];

                                nhn.husky.EZCreator.createInIFrame({
                                  oAppRef: oEditors,
                                  elPlaceHolder: "ir1",
                                  sSkinURI: "/board/smarteditor2/SmartEditor2Skin.html",	
                                  htParams : {
                                    bUseToolbar : true,				// 툴바 사용 여부 (true:사용/ false:사용하지 않음)
                                    bUseVerticalResizer : true,		// 입력창 크기 조절바 사용 여부 (true:사용/ false:사용하지 않음)
                                    bUseModeChanger : true,			// 모드 탭(Editor | HTML | TEXT) 사용 여부 (true:사용/ false:사용하지 않음)
                                    //aAdditionalFontList : aAdditionalFontSet,		// 추가 글꼴 목록
                                    fOnBeforeUnload : function(){
                                      //alert("완료!");
                                    }
                                  }, //boolean
                                  fOnAppLoad : function(){
                                    //예제 코드
                                    //oEditors.getById["ir1"].exec("PASTE_HTML", ["로딩이 완료된 후에 본문에 삽입되는 text입니다."]);
                                  },
                                  fCreator: "createSEditor2"
                                });

                                function pasteHTML() {
                                  var sHTML = "<span style='color:#FF0000;'>이미지도 같은 방식으로 삽입합니다.<\/span>";
                                  oEditors.getById["ir1"].exec("PASTE_HTML", [sHTML]);
                                }

                                function showHTML() {
                                  var sHTML = oEditors.getById["ir1"].getIR();
                                  alert(sHTML);
                                }
                                  
                                function submitContents(elClickedObj) {
                                  oEditors.getById["ir1"].exec("UPDATE_CONTENTS_FIELD", []);	// 에디터의 내용이 textarea에 적용됩니다.
                                  
                                  // 에디터의 내용에 대한 값 검증은 이곳에서 document.getElementById("ir1").value를 이용해서 처리하면 됩니다.
                                  
                                  try {
                                    elClickedObj.form.submit();
                                  } catch(e) {}
                                }

                                function setDefaultFont() {
                                  var sDefaultFont = '궁서';
                                  var nFontSize = 24;
                                  oEditors.getById["ir1"].setDefaultFont(sDefaultFont, nFontSize);
                                }
                              </script>
                            </td>
                          </tr>

                          <tr>
                            <td colspan="4"  align="center" bgcolor="ffffff" style="">
                              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tbody>
                                  <tr>
                                    <td height="50" align="left">등록파일: <span id="img_count">0</span> / 60개</td>

                                    <td align="right">
                                      <input type="button" style="BORDER: #ff0000 1px solid; background-color : #ffe3e7; font-family:'맑은 고딕'; font-size: 9pt; color: #ff0000;  padding:0 6px 0 6px; height:26px; cursor:pointer;" value="파일찾기" onclick="file_click();"/>
                                      <input type="button" id="img_del" style="BORDER: #7FA8C4 1px solid; background-color : #edf1f6; font-family:'맑은 고딕'; font-size: 9pt; color: #165899; padding:0 6px 0 6px; height:26px; cursor:pointer;" value="초기화" />
                                      <? for($i=1;$i<=10;$i++){ ?>
                                      <input type="file" accept="image/*" multiple="multiple" onchange="fileInfo(this)" name="upfile[]" id="uf<?=$i?>" style="display:none;"/>
                                      <? } ?>
                                    </td>
                                  </tr>
                                  
                                  <tr>
                                    <td height="100" colspan="2" align="left">
                                      <div id="img_box" style="width:1200px; height:110px; overflow-y:scroll; padding:10px; border:1px solid #cccccc; margin-bottom:5px; "></div>
                                    </td>
                                  </tr>

                                  <? if($wc_idx){ ?>
                                    <tr>
                                      <td height="130" colspan="4" bgcolor="#FFFFFF" style="padding:10px; border:1px solid #cccccc ">
                                        <tr>
                                          <td height="13" colspan="2" align="left">
                                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                              <?
                                                $imgCnt = 0;
                                                for($i=1; $i<=60; $i++) {
                                                  $fim="wc_img_".$i;
                                                  $fileName = $row[$fim];
                                                  $real_name = explode('/', $fileName);	
                                              
                                                  if(strlen($real_name[0]) == 0){
                                                    $fileName = '';
                                                    $script = "";
                                                    break;
                                                  }
                                                  else {
                                                    $imgCnt++;
                                                    $fileName = $site_u[home_url]."/data2/".$real_name[0];
                                                    $script = " onClick=\"detailView($i)\" onmouseover=\"zoomView('$fileName', $i)\" style=\"cursor:pointer;\" ";
                                                  }
                                                  
                                                  if($i%10==1) echo "</tr><tr>";
                                                ?>

                                                <td td width="10%" height="100" align="center" style="line-height:90%;padding: 5px">
                                                  <? if($fileName){ ?>
                                                    <img src="<?=$fileName?>" width="100" height="100"    <?=$script?> />
                                                  <? } ?>
                                                  <?if($fileName){?><br>
                                                    <a href="javascript:img_del('<?=$cnt+1?>','<?=$wc_idx?>');">
                                                    <span style="font-size:12px">삭제</span></a> <?}?>
                                                </td>

                                                <?
                                                  $cnt++;
                                                  }	
                                                ?>
                                          </tr>
                                        </table>
                                      </td>
                                    </tr>
                                  <? } ?>
                                </tbody>
                              </table>
                            </td>
                          </tr>


                        </td>
                      </tr>
                    </tbody>
                  </table>                     
                </div>
              </form>
            </td>
          </tr>

          <tr>
            <td height="2">&nbsp;</td>
          </tr>

          <tr>
            <td height="3" align="right"></td>
          </tr>

          <tr>
            <td height="5">&nbsp;</td>
          </tr>

          <tr>
            <td align="center">
              <table style="width:1200px;margin:20px auto 40px;"  border="0" cellspacing="0" cellpadding="0">
                <tr> 
                  <td align="center">
                    <a href="sub07_1.php" onclick="history.back();" class="btn-blue">목록보기</a>
                    <a href="javascript:void(0)" onclick="out_submit();" class="btn-red" style="margin-left: 10px">등록하기</a>
                  </td>
                </tr>
              </table>                   
            </td>
          </tr>

          <tr>
            <td height="5">&nbsp;</td>
          </tr>   
        </tbody>
      </table>
    </div>
	</div>
  <!-- footer -->
  <div class="cha_footer"><? include "../inc/bottom.php" ?></div>
</div>


<script type="text/javascript" src="../board/js/HuskyEZCreator.js" charset="utf-8"></script>


</body>
</html>
