<html lang="ko"><head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=1200px; initial-scale=1.0">
  <meta name="naver-site-verification" content="ec621a9fa2c26312b2565d970588e994a761beb3">
  <title>(주)태금모터스</title>
  <meta property="og:type" content="website">
  <meta property="og:title" content="태금모터스">
  <meta property="og:description" content="보험사잔존물경공매,일반경매,중고부품,외제수입차전문수리">
  <meta property="og:image" content="http://www.taegeummotors.com/myimage.jpg">
  <meta property="og:url" content="http://www.taegeummotors.com">
  <meta name="robots" content="보험사잔존물경공매,일반경매,중고부품,외제수입차전문수리">
  <meta name="description" content="보험사잔존물경공매,일반경매,중고부품,외제수입차전문수리">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="robots" content="index">
  <link rel="canonical" href="http://www.taegeummotors.com" "="">
  <meta name="viewport" content="width=1280">
  
  <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
  <link rel="stylesheet" type="text/css" href="/common/css/base.css?v=221208">

   <link rel="stylesheet" type="text/css" href="/common/css/style.css">
   <link rel="stylesheet" type="text/css" href="/common/css/add_style.css?v=2212081209">  <!-- 2022.11.25 css추가  -->
   <link rel="stylesheet" type="text/css" href="/common/css/incaron_style.css">  <!-- 2022.11.25 css추가  -->
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
   
   <!-- swiper.js css-->
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css">
   <!-- swiper.js js-->
   <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>

   <script src="/common/js/incaron_ui.js"></script>
   <script src="/common/js/front.js"></script>

   <!-- 230228 -->
   <link rel="stylesheet" href="/common/js/jquery.bxslider.css">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
   <script src="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.min.js"></script>
   <script>
      $(document).ready(function() {
         $('.slider3').bxSlider({
            auto: true,
            autoControls: false,
            stopAutoOnClick: false,
            pager: false,
            controls: false,
            autoHover: false,
            mode: 'fade',
         });
      });
    <?include "../inc/header.php" ?>
<?
$idx=$wc_idx;
if($wc_idx){
   $qry = "select * from woojung_part where wc_idx = '$wc_idx'  ";
   $row = mysql_fetch_array(mysql_query($qry));
   $wc_car_img1 = explode("/",$row[wc_img_1]);
   $defaultFile = "/data1/".$wc_car_img1[0];
   $qry = "select * from woojung_member where userId = '$row[wc_mem_id]'  ";
   $row_m = mysql_fetch_array(mysql_query($qry));

   $cate1=mysql_fetch_array(mysql_query("select * from cate2 where idx='".$row[wc_made]."'"));
   $cate3=mysql_fetch_array(mysql_query("select * from cate3 where idx='".$row[wc_trans]."'"));

   // 오늘 본 상품 세션에 상품번호(p_no) 저장하기
   if(empty($_SESSION['VISIT'][0]) || is_null($_SESSION['VISIT'][0])) {
      $_SESSION['VISIT'][0] = $wc_idx;
   } elseif(!in_array($wc_idx, $_SESSION['VISIT'])) {
      $temp_p_no = $_SESSION['VISIT'][0];

      // 상품 밀기
      $_SESSION['VISIT'][0] = $wc_idx;
      $_SESSION['VISIT'][3] = $_SESSION['VISIT'][2];
      $_SESSION['VISIT'][2] = $_SESSION['VISIT'][1];
      $_SESSION['VISIT'][1] = $temp_p_no;
   }
}

?>

   </script>
  
</head>

<body>
<iframe name="AdminFrm" id="AdminFrm" style="display:none;"></iframe>

<!-- 퀵메뉴 -->
  <div class="quick-menu" style="top: 178px;">
    <p class="quick-title">
      Quick Menu
    </p>
    <!-- <a href="" class="menu-item">
        <div class="icon">
            <span class="icon-quick-dart"></span>
        </div>
        빠른메뉴
    </a> -->
    <a href="/mypage/sub04.php" class="menu-item">
        <div class="icon">
            <span class="icon-quick-docu"></span>
        </div>
        입찰현황
    </a>
    <a href="/mypage/sub05.php" class="menu-item">
        <div class="icon">
            <span class="icon-quick-chart"></span>
        </div>
        낙찰현황
    </a>
    <a href="/mypage/sub03.php" class="menu-item">
        <div class="icon">
            <span class="icon-quick-heart"></span>
        </div>
        관심차량
    </a>
    <a href="/mypage/sub01.php" class="menu-item">
        <div class="icon">
            <span class="icon-quick-checklist"></span>
        </div>
        접수현황
    </a>
    <a href="/sub01/sub01_3.php" class="menu-item">
        <div class="icon">
            <span class="icon-quick-notice"></span>
        </div>
        1:1상담
    </a>
  </div> 


  <div id="wrap" class="main">
<header class="global-header">
    <!-- <header class="bg-white"> SUB의 경우 -->
    <!-- <div class="dim"></div> -->

    <!-- gnb -->
    <div class="gnb">
        <div class="notice">
            <div class="prefix">
                <div class="gnb_notice">
                     홈페이지 새롭게 리뉴얼되었습니다 회원가입 및 차량상담은 고객센터로 문의부탁드립니다 ☎ 031-278-6111                </div>
            </div>
            <div class="suffix">
                                <a href="javascript:ad();" class="link-manage">[관리자모드]</a>
                                                <span class="user-name">
                    정진용님
                </span>
                                <ul class="login-wrap">
                                        <li>
                        <a href="/mypage/sub04.php" class="btn btn-sm btn-primary btn-round">마이페이지</a>
                    </li>
                    <li>
                        <a href="/login/loginProc.php?logMode=logout" class="btn btn-sm btn-outline-gray btn-round login">
                            로그아웃
                        </a>
                    </li>
                                    </ul>
            </div>
        </div>
    </div>
    <!-- // gnb -->
    <!-- nav -->
    <nav class="nav">
        <div class="nav-menu">
            <h1 class="logo">
                <img src="/images/front/main_logo.png" class="logo-black" alt="태금모터스 로고" onclick="location.href='/';">
            </h1>
            <ul class="nav-list depth-01">
                                <li><a href="/sub01/sub01_1.php"><span class="item">차량등록</span></a></li>
                <li><a href="/sub02/sub02_1.php?gubun2=2"><span class="item">보험경공매</span></a></li>
                <li><a href="/sub03/sub03_1.php?gubun2=3"><span class="item">스페셜매물</span></a></li>
                <li><a href="/sub04/sub04_1.php?gubun2=4"><span class="item">일반경공매</span></a></li>
                <li><a href="/sub05/sub05_1.php"><span class="item">종료차량</span></a></li>
                                <li><a href="/sub07/sub07_1.php"><span class="item">중고차량</span></a></li>
                <li><a href="/sub08/sub08_1.php"><span class="item">부품차량</span></a></li>
                <li><a href="/board/board.php?id=notice"><span class="item">고객센터</span></a></li>
            </ul>
        </div>
        
    </nav>
    <!-- //nav -->
</header>

<script language="JavaScript" type="text/JavaScript">
function out_submit(){

   f=document.outForm;
//   if(!f.wc_trans.value){
//      alert("차량명을 주세요.");
//   }else{
      f.action="car_info_update.php";
      submitContents();
      f.submit();
//   }
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
      var reader = new FileReader(); // FileReader 객체 사용
      reader.onload = function(rst){
       if(img_count==60){ 
      alert("등록갯수가 60개로 제한됩니다."); 
      img_count++; 
      }else{
        if(img_count<60){
         $('#img_box').append('<img src="' + rst.target.result + '"width="125" height="90" id="num'+num+'" data-image="tmp'+num+'" class="imgs"><input type=hidden name="tmpfile[]" value="'+ num +'"  id="tmp'+num+'" class="imgnames">'); // append 메소드를 사용해서 이미지 추가
         // 이미지는 base64 문자열로 추가
         // 이 방법을 응용하면 선택한 이미지를 미리보기 할 수 있음
         num++; img_count++; 
         document.getElementById("img_count").innerHTML=img_count;
        }
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
//      imgnum="img"+cnt;
//      document.getElementById(imgnum).style.display="none";
   }
}

</script>

<iframe name="gufrm" id="gufrm" style="display:none;" src=""></iframe>

<script language="JavaScript" src="/admin/inc/default.js"></script>
<script type="text/javascript" src="/lib/form.js"></script>

<div id="contents_basic">
 
    <div class="co_car_all">

     <div class="sub-visual">
         <div class="sub-text">
            <p class="catch-phrase">
               부품차량
            </p>
            <p class="description-text">
        수출,내수차량 및 부품차량을 다량 보유하고 있습니다.
            </p>
         </div>
      </div>
<!-- 추가 -->
<div class="div_basic">
    <!--<table style="width:1200px;heidght:50px; margin:10 auto;">

    <tbody>
    <?
$imgCnt = 0;
for($i=1; $i<=60; $i++) {

   $fim="wc_img_".$i;
   $fileName = $row[$fim];
   $real_name = explode('/', $fileName);   
   
   if(strlen($real_name[0]) == 0)
   {
      $fileName = '';
      $script = "";
      break;
   }
   else
   {
      $imgCnt++;
      $fileName = $site_u[home_url]."/data2/".$real_name[0];
      $script = " onClick=\"detailView($i)\" onmouseover=\"zoomView('$fileName', $i)\" style=\"cursor:pointer;\" ";
   }
?>
                <div data-hash="<?=$i?>" class="slide">
                  <img src="<?=$fileName?>" alt="차량이미지">
                </div> 
<?
   $cnt++;
}   
?>
              </div>
              <!-- <a href="javascript:void(0)" onclick="openLayerPop()" class="btn-zoom">더보기</a> -->
            </div>
            <!-- //차량이미지 -->

            <!-- 차량이미지 리스트 -->
            <div class="img-list-wrap view-thumb">
              <div class="img-list">
                <ul> 
<?
$imgCnt = 0;
for($i=1; $i<=60; $i++) {

   $fim="wc_img_".$i;
   $fileName = $row[$fim];
   $real_name = explode('/', $fileName);   
   
   if(strlen($real_name[0]) == 0)
   {
      $fileName = '';
      $script = "";
      break;
   }
   else
   {
      $imgCnt++;
      $fileName = $site_u[home_url]."/data2/".$real_name[0];
      $script = " onClick=\"detailView($i)\" onmouseover=\"zoomView('$fileName', $i)\" style=\"cursor:pointer;\" ";
   }
?>
                  <li data-thumb="<?=$i?>" <?=$i==1?'class="active"':''?>><img src="<?=$fileName?>" alt="차량이미지 썸네일"></li> 
<?
   $cnt++;
}   
?>2ajuy
                </ul>
              </div>
            </div>
          </td>
        </tr>

        <!--<tr style="display : block; margin-bottom : 10px"></tr>
      </thead>

      <tr>
        <td heigth="50" colspan="3" align="center">
            <table width="170" border="0" cellpadding="5" cellspacing="0" style=" width:170px;margin-bottom: 40px;margin-top: 20px;">
                  <tbody><tr>
                    <td width="65">
                      <!--<a href="sub08_1.php"><img src="/images/list_bt.jpg" /></a>-->
      <a href="sub08_1.php" style="display:inline-flex; justify-content: center; align-items:center;border: 2px solid #0066CC; border-radius: 20px; min-width: 80px; height: 32px;font-size: 12px;font-weight: 600;color:#0066CC; ">
                        목록보기</a>
                    <td width="65"></td>
      <a href="javascript:out_submit();" style="display:inline-flex; justify-content: center; align-items:center;border: 2px solid #cc3535; border-radius: 20px; min-width: 80px; height: 32px;font-size: 12px;font-weight: 600;color: #cc3535;margin-left: 10px; ">
            등록하기</a>
               </td>
               </tr></tbody></table><table>
        <input type="checkbox" id="scales" name="scales" checked /><label for="scales">1</label>
        <input type="checkbox" id="scales" name="scales" checked /><label for="scales">2</label>
        <input type="checkbox" id="scales" name="scales" checked /><label for="scales">3</label>
        <input type="checkbox" id="scales" name="scales" checked /><label for="scales">4</label>
        <input type="checkbox" id="scales" name="scales" checked /><label for="scales">5</label>
        <div class="news_wrap" style="margin-top:20px;">
         <div class="news">
				   <div class="news_100" style="display:inline-flex;">					
					  <div class="news_contents" style="margin-right:10px;">						
						 <img src="www/sub09/img/20240228_4.png"  width="230" height="200" alt=""/>

						  <div class="news_contents_letter">
							 <p class="news_contents_title">
								아반떼 A.D 1.6 GDI 스타일
							 </p>
							 <p class="news_contents_article">
								1,000만원 | 할부가능  | 수동  | 휘발유 
							 </p>
							<p class="news_contents_date">9</p>
						</div><!--news_contents_letter-->
					</div><!--news_contents-->

					<div class="news_contents" style="margin-right:10px;">
						<img src="www/sub09/img/20240228_4.png"  width="230" height="200" alt=""/>
						<div class="news_contents_letter">
							<p class="news_contents_title">
              아반떼 A.D 1.6 GDI 스타일
							</p>
							<p class="news_contents_article">
              | 수동  | 경유
							</p>
							<p class="news_contents_date">4</p>
						</div><!--news_contents_letter-->
					</div><!--news_contents-->

					<div class="news_contents" style="margin-right:10px;">
            <img src="www/sub09/img/20240228_4.png"  width="230" height="200" alt=""/>
						<div class="news_contents_letter">
							<p class="news_contents_title">
								엔카 
							</p>
							<p class="news_contents_article">
               1,000만원  | 할부가능
							</p>
							<p class="news_contents_date">7</p>
						</div><!--news_contents_letter-->
					</div><!--news_contents-->
          <div class="news_contents"style="margin-right:10px;">						
						<img src="www/sub09/img/20240228_4.png"  width="230" height="200" alt=""/>

						<div class="news_contents_letter">
							<p class="news_contents_title">
								1024-768 
							</p>
							<p class="news_contents_article">
              1,000만원  | 할부가능
							</p>
							<p class="news_contents_date">9</p>
						</div><!--news_contents_letter-->
					</div><!--news_contents-->
          <div class="news_contents">						
            <img src="www/sub09/img/20240228_4.png"  width="230" height="200" alt=""/>

						<div class="news_contents_letter">
							<p class="news_contents_title">
								현주소 미래 
							</p>
							<p class="news_contents_article">
								제3실무의 미래
							</p>
							<p class="news_contents_date">9</p>
						</div><!--news_contents_letter-->
					</div><!--news_contents-->
				</div><!--news_100-->
			</div><!--news--> 
     </div> 


</table>


<!--<form name="outForm" method="post" action="car_info_update.php" enctype="multipart/form-data">
<input type="hidden" name="mode" id="mode" value="regist">
<input type="hidden" name="wc_idx" value="">
<input type="hidden" name="wc_go_idx" value="">
<input type="hidden" name="aucidx" value="">
<input type="hidden" name="aucorderNo" value="">
<input type="hidden" name="href" value="">
<input type="hidden" name="gubun4" value="2">
<input type="hidden" name="hidFileName">
   <div class="div_information">
    <table style="width:1200px; margin: 10 auto; margin-top:0px;" border="0" cellspacing="0" cellpadding="0">
      <tbody style="border: 1px solid #cccccc"> 
      <!--차량 정보 표 -->
       <!-- <tr>
          <td width="140px" height="50" align="left" bgcolor="#f2f2f2" style="padding-left: 5px;  padding-top: 2px; border-right:1px solid #CCCCCC; border-bottom:1px solid #CCCCCC;color: #888888;font-size: 14px;font-weight: bold">고유번호 No.</td>
          <td width="230px" height="50" align="center" bgcolor="#FFFFFF" style="padding-left: 5px; padding-top: 2px; text-align:left; border-right:1px solid #CCCCCC;border-bottom:1px solid #CCCCCC; font-size: 15px;font-weight: bold"><?=$row['wc_orderno']?>24-0200000</td>
          <td width="140px" height="50" align="left" bgcolor="#f2f2f2" style="padding-left: 5px;  padding-top: 2px; border-right:1px solid #CCCCCC; border-bottom:1px solid #CCCCCC;color: #888888;font-size: 14px;font-weight: bold">판매상태 Sales status</td>


          <td width="230px" height="50" align="center" colspan="3" bgcolor="#FFFFFF" style="padding-top: 2px; padding-left:5px; text-align:left; border-right:1px solid #CCCCCC;border-bottom:1px solid #CCCCCC; font-size: 13px;font-weight: bold">

          <div class="btn-group" align="left">
          <ul class="radio-list">
                        <li style="display:inline-block">
                           <input type="radio" name="calltype" value="1" control-id="ControlID-1">
                  <span href="" class="btn btn-sm btn-red btn-round">sale</span>
                        </li>
                        <li style="display:inline-block;">
                           <input type="radio" name="calltype" value="2" control-id="ControlID-2">
                           <span href="" class="btn btn-sm btn-black btn-round">soldout</span>
                        </li>
                     </ul>
            
          </div></td>
        </tr>

        <tr>
          <td width="140px" height="50" align="left" bgcolor="#f2f2f2" style="padding-left: 5px;  padding-top: 2px; border-right:1px solid #CCCCCC; border-bottom:1px solid #CCCCCC;color: #888888;font-size: 14px;font-weight: bold">차량명 Vehicle name</td>
          <td width="230px" height="50" align="center" colspan="3" bgcolor="#FFFFFF" style="padding-left: 5px; padding-right: 5px; padding-top: 2px; text-align:left;border-bottom:1px solid #CCCCCC; font-size: 16px;font-weight: bold;"><?=$row['wc_mem_etc']?></td>
        </tr>

        <tr>
          <td width="140px" height="50" align="left" bgcolor="#f2f2f2" style="padding-left: 5px;  padding-top: 2px; border-right:1px solid #CCCCCC; border-bottom:1px solid #CCCCCC;color: #888888;font-size: 14px;font-weight: bold">차량번호 Registration number</td>
          <td width="230px" height="50" align="center" bgcolor="#FFFFFF" style="padding-left: 5px; padding-right: 5px; padding-top: 2px; border-right:1px solid #CCCCCC;border-bottom:1px solid #CCCCCC; font-size: 15px;font-weight: bold"><?=$cate1[name]?></td>
          <td width="140px" height="50" align="left" bgcolor="#f2f2f2" style="padding-left: 5px;  padding-top: 2px; border-right:1px solid #CCCCCC; border-bottom:1px solid #CCCCCC;color: #888888;font-size: 14px;font-weight: bold">사고이력 History of accidents</td>
          <td width="230px" height="50" align="left" bgcolor="#FFFFFF" style="padding-top: 2px; padding-left:5px; border-right:1px solid #CCCCCC;border-bottom:1px solid #CCCCCC; font-size: 15px;font-weight: bold"><?=$row['wc_mem_etc']?><div class="btn-group">
             <ul class="radio-list">
                        <li style="display:inline-block">
                           <input type="radio" name="calltype" value="1" control-id="ControlID-1">
                  <span href="" class="btn btn-sm btn-red btn-round">무사고</span>
                        </li>
                        <li style="display:inline-block;">
                           <input type="radio" name="calltype" value="2" control-id="ControlID-2">
                           <span href="" class="btn btn-sm btn-black btn-round">사고있음</span>
                        </li>
                     </ul></td>
        </tr>
        <tr>
          <td width="140" height="50" align="left" bgcolor="#f2f2f2" style="padding-left: 5px;  padding-top: 2px; border-right:1px solid #CCCCCC; border-bottom:1px solid #CCCCCC;color: #888888;font-size: 14px;font-weight: bold">제조사 Manufacturer</td>
          <td width="230" height="50" align="center" bgcolor="#FFFFFF" style="padding-left: 5px; padding-top: 2px; text-align:left; border-right:1px solid #CCCCCC;border-bottom:1px solid #CCCCCC; font-size: 15px;font-weight: bold">
          
          
          <select name="made" onchange="si_chk(this)" class="form_select bold fs-15" control-id="ControlID-4">
                                  <option value="" selected="selected">== 제조사 ==</option>
                                                                    <option value="5">
                                    기아                                </option>
                                                                    <option value="215">
                                    기타                                </option>
                                                                    <option value="332">
                                    렉카                                </option>
                                                                    <option value="92">
                                    르노삼성                                </option>
                                                                    <option value="322">
                                    부품                                </option>
                                                                    <option value="93">
                                    수입차                                </option>
                                                                    <option value="8">
                                    쉐보레                                </option>
                                                                    <option value="6">
                                    쌍용                                </option>
                                                                    <option value="343">
                                    에디슨                                </option>
                                                                    <option value="328">
                                    오토바이                                </option>
                                                                    <option value="265">
                                    제네시스                                </option>
                                                                    <option value="1">
                                    현대                                </option>
                                                                  </select>

                     
 
                                                                  <?=$cate1[name]?></td>
        
          <td width="140" height="50" align="left" bgcolor="#f2f2f2" style="padding-left: 5px;  padding-top: 2px; margin-left:20px; border-right:1px solid #CCCCCC; border-bottom:1px solid #CCCCCC;color: #888888;font-size: 14px;font-weight: bold">모델명 Model</td>
          <td width="230" height="50" align="center" bgcolor="#FFFFFF" style="padding-left: 5px; padding-top: 2px; text-align:left; border-right:1px solid #CCCCCC;border-bottom:1px solid #CCCCCC; font-size: 15px;font-weight: bold"><?=$row['wc_mem_etc']?>

                                  <select name="car_name" class="form_select bold fs-15" control-id="ControlID-5">
                                    <option value="" selected="selected">== 차명 ==</option>
                                                                      </select>                          

        </td>
        </tr>

        <tr>
          <td width="140" height="50" align="left" bgcolor="#f2f2f2" style="padding-left: 5px; padding-right: 0px; padding-top: 2px; border-right:1px solid #CCCCCC; border-bottom:1px solid #CCCCCC;color: #888888;font-size: 14px;font-weight: bold">년식 Model year</td>
          <td width="230" height="50" align="center" bgcolor="#FFFFFF" style="padding-left: 5px; padding-right: 0px; padding-top: 2px; text-align:left; border-right:1px solid #CCCCCC;border-bottom:1px solid #CCCCCC; font-size: 15px;">
          <input name="wc_age" type="text" size="5" value="" class="form_control bold fs-15" control-id="ControlID-6">
            <span>년</span>
          <input name="wc_age" type="text" size="5" value="" class="form_control bold fs-15" control-id="ControlID-7">
            <span>월</span>
            <?=$row['wc_mem_etc']?></td>
        
        
          <td width="140" height="50" align="left" bgcolor="#f2f2f2" style="padding-left: 5px; padding-right: 0px; padding-top: 2px; border-right:1px solid #CCCCCC; border-bottom:1px solid #CCCCCC;color: #888888;font-size: 14px;font-weight: bold">변속기 Transmission</td>
          <td width="230" height="50" align="center" bgcolor="#FFFFFF" style="padding-left: 5px; padding-right: 0px; padding-top: 2px; text-align:left; border-right:1px solid #CCCCCC;border-bottom:1px solid #CCCCCC; font-size: 15px;font-weight: bold"><?=$row['wc_mem_etc']?>
          <select name="trans" class="form_select bold fs-15" control-id="ControlID-8">
         <option value="" selected="">:: 변속기 ::</option>
         <option value="수동">수동</option>
         <option value="자동/오토">자동/오토</option>
         <option value="세미오토">세미오토</option>
         <option value="CVT">CVT</option>
         </select> 
        </td>
        </tr>

        <tr>
          <td width="140" height="50" align="left" bgcolor="#f2f2f2" style="padding-left: 5px;  padding-right: 0px; padding-top: 2px; border-right:1px solid #CCCCCC; border-bottom:1px solid #CCCCCC;color: #888888;font-size: 14px;font-weight: bold">연료 Fuel Type</td>
          <td width="230" height="50" align="center" bgcolor="#FFFFFF" style="padding-left: 5px; padding-right: 0px; padding-top: 2px; text-align:left; border-right:1px solid #CCCCCC;border-bottom:1px solid #CCCCCC; font-size: 15px;font-weight: bold"><?=$row['wc_mem_etc']?>
          <select name="fual" class="form_select bold fs-15" control-id="ControlID-9">
          <option value="" selected="">:: 연료 ::</option>
         <option value="경유">경유</option>
         <option value="휘발유">휘발유</option>
         <option value="LPG">LPG</option>
         <option value="휘발류+LPG">휘발류+LPG</option>
         <option value="휘발유+전기">휘발유+전기</option>
         <option value="기타">기타</option>
         <option value="CNG">CNG</option>
         <option value="전기">전기</option>
         <option value="하이브리드">하이브리드</option>
         <option value="플러그인하이브리드">플러그인하이브리드</option>
         </select> 
      </td>
          <td width="140" height="50" align="left" bgcolor="#f2f2f2" style="padding-left: 5px; padding-right: 0px;  padding-top: 2px; border-right:1px solid #CCCCCC; border-bottom:1px solid #CCCCCC;color: #888888;font-size: 14px;font-weight: bold">배기량 Displacement</td>
          <td width="230" height="50" align="center" bgcolor="#FFFFFF" style="padding-left: 5px; padding-right: 0px; padding-top: 2px; text-align:left; border-right:1px solid #CCCCCC;border-bottom:1px solid #CCCCCC; font-size: 15px;">
          <input type="text" name="carcc" style="width:100;" onkeyup="javascript:comma(this);" class="form_control bold fs-15" value="0" control-id="ControlID-10">
            cc </td>
        </tr>

        <tr>
          <td width="140" height="50" align="left" bgcolor="#f2f2f2" style="padding-left: 5px;  padding-top: 2px; border-right:1px solid #CCCCCC; border-bottom:1px solid #CCCCCC;color: #888888;font-size: 14px;font-weight: bold">주행거리 Odometer</td>
          <td width="230" height="50" align="center" bgcolor="#FFFFFF" style="padding-left: 5px; padding-top: 2px; text-align:left; border-right:1px solid #CCCCCC;border-bottom:1px solid #CCCCCC; font-size: 15px;">
          <input type="text" name="carmile" style="width:100;" onkeyup="javascript:comma(this);" class="form_control bold fs-15" value="0" control-id="ControlID-11">
            km</td>
        
          <td width="140" height="50" align="left" bgcolor="#f2f2f2" style="padding-left: 5px;  padding-top: 2px; border-right:1px solid #CCCCCC; border-bottom:1px solid #CCCCCC;color: #888888;font-size: 14px;font-weight: bold">판매가격 Price</td>
          <td width="230" height="50" align="center" bgcolor="#FFFFFF" style="padding-left: 5px; padding-top: 2px; text-align:left; border-right:1px solid #CCCCCC;border-bottom:1px solid #CCCCCC; font-size: 15px;">
          <input type="text" name="carcc" style="width:100;" onkeyup="javascript:comma(this);" class="form_control bold fs-15" value="0" control-id="ControlID-10">
            만원 &nbsp; &nbsp; <input type="checkbox" name="wc_cost" value="1" checked="checked"/>  
            &nbsp;<font color="#FF0000">할부가능</font></td>
                              
        
        
        </tr>

        <tr>
          <td width="100%" height="50" align="center" colspan="4" bgcolor="#f2f2f2" style="padding-left: 5px;  padding-top: 2px; border-right:1px solid #CCCCCC; border-bottom:1px solid #CCCCCC;color: #888888;font-size: 14px;font-weight: bold">상세설명 Sale Information</td>
        </tr>
</tbody>
</table>
</div>
<!-- 위에 상세설명 표  -->






  <!--<div class="div_basic">
       <table align="center" style="width: 1200px; margin: auto;">
     <tbody><tr>
      <td align="center">
                        </td></tr><tr>
                          <td height="200" colspan="5" bgcolor="#FFFFFF">
          <script type="text/javascript" src="../board/js/HuskyEZCreator.js" charset="utf-8"></script>
                    <textarea name="carOptionadd" id="ir1" rows="10" cols="100" style="width:100%; height:320px; display:none;" control-id="ControlID-14">                      </textarea><iframe frameborder="0" scrolling="no" style="width: 100%; height: 369px;" src="/board/smarteditor2/SmartEditor2Skin.html"></iframe>
                              <script type="text/javascript" src="/board/smarteditor2/js/HuskyEZCreator.js" charset="utf-8"></script>
                              <script type="text/javascript">
var oEditors = [];

// 추가 글꼴 목록
//var aAdditionalFontSet = [["MS UI Gothic", "MS UI Gothic"], ["Comic Sans MS", "Comic Sans MS"],["TEST","TEST"]];

nhn.husky.EZCreator.createInIFrame({
   oAppRef: oEditors,
   elPlaceHolder: "ir1",
   sSkinURI: "/board/smarteditor2/SmartEditor2Skin.html",   
   htParams : {
      bUseToolbar : true,            // 툴바 사용 여부 (true:사용/ false:사용하지 않음)
      bUseVerticalResizer : true,      // 입력창 크기 조절바 사용 여부 (true:사용/ false:사용하지 않음)
      bUseModeChanger : true,         // 모드 탭(Editor | HTML | TEXT) 사용 여부 (true:사용/ false:사용하지 않음)
      //aAdditionalFontList : aAdditionalFontSet,      // 추가 글꼴 목록
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
   oEditors.getById["ir1"].exec("UPDATE_CONTENTS_FIELD", []);   // 에디터의 내용이 textarea에 적용됩니다.
   
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
                        </script></td>
                        </tr>
 
      <tr> 
          <td colspan="4" align="center" bgcolor="ffffff" style=""><table width="100%" border="0" cellspacing="0" cellpadding="0">
           
            <tbody><tr>
              <td height="50" align="left">등록파일: <span id="img_count">0</span> / 60개</td>
              <td align="right"><input type="button" style="BORDER: #ff0000 1px solid; background-color : #ffe3e7; font-family:'맑은 고딕'; font-size: 9pt; color: #ff0000;  padding:0 6px 0 6px; height:26px; cursor:pointer;" value="파일찾기" onclick="file_click();" control-id="ControlID-15">
                  <input type="button" id="img_del" style="BORDER: #7FA8C4 1px solid; background-color : #edf1f6; font-family:'맑은 고딕'; font-size: 9pt; color: #165899; padding:0 6px 0 6px; height:26px; cursor:pointer;" value="초기화" control-id="ControlID-16">
                                    <input type="file" accept="image/*" multiple="multiple" onchange="fileInfo(this)" name="upfile[]" id="uf1" style="display:none;" control-id="ControlID-17">
                                    <input type="file" accept="image/*" multiple="multiple" onchange="fileInfo(this)" name="upfile[]" id="uf2" style="display:none;">
                                    <input type="file" accept="image/*" multiple="multiple" onchange="fileInfo(this)" name="upfile[]" id="uf3" style="display:none;">
                                    <input type="file" accept="image/*" multiple="multiple" onchange="fileInfo(this)" name="upfile[]" id="uf4" style="display:none;">
                                    <input type="file" accept="image/*" multiple="multiple" onchange="fileInfo(this)" name="upfile[]" id="uf5" style="display:none;">
                                    <input type="file" accept="image/*" multiple="multiple" onchange="fileInfo(this)" name="upfile[]" id="uf6" style="display:none;">
                                    <input type="file" accept="image/*" multiple="multiple" onchange="fileInfo(this)" name="upfile[]" id="uf7" style="display:none;">
                                    <input type="file" accept="image/*" multiple="multiple" onchange="fileInfo(this)" name="upfile[]" id="uf8" style="display:none;">
                                    <input type="file" accept="image/*" multiple="multiple" onchange="fileInfo(this)" name="upfile[]" id="uf9" style="display:none;">
                                    <input type="file" accept="image/*" multiple="multiple" onchange="fileInfo(this)" name="upfile[]" id="uf10" style="display:none;">
                                </td>
            </tr>

            <tr>
              <td height="100" colspan="2" align="left" style=""><div id="img_box" style="width:1200px; height:110px; overflow-y:scroll; padding:10px; border:1px solid #cccccc; margin-bottom:5px; "></div></td>
            </tr>
          </tbody></table></td>
        </tr>
                      </tbody></table></div></form></td>
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
                   <table style="width:1200px;margin:20px auto 40px;" border="0" cellspacing="0" cellpadding="0">
                      <tbody><tr> 
                        <td align="center" style="position:relative;">
                          <!--<img src='/images/bt09.jpg' style='vertical-align:middle;cursor:pointer;' onclick='out_submit();' />>
                          <a href="javascript:img_alldel()" class="btn-black" style="position:absolute; left: 0;">선택삭제</a-->
                    <a href="sub08_1.php" onclick="history.back();" class="btn-blue">목록보기</a>
                          <a href="javascript:void(0)" onclick="out_submit();" class="btn-red">등록하기</a>
                        </td>
                      </tr>
                    </tbody></table>                   </td>
                  </tr>
                  <tr>
                    <td height="5">&nbsp;</td>
                  </tr>
            </tbody></table> 

            
     </div>
        
        
   </div>

   <!-- footer -->
   <div class="cha_footer">
<!-- 풋터바 -->
<div class="comepanyinfor">
    <div class="cin_tit">
    <div class="list">
        <a href="../company/company.php">회사소개</a> |
        <a href="../login/sub_agree01.php">이용약관</a> |
        <a href="../login/sub_agree02.php">개인정보처리방침</a>    </div>
<div class="affiliates">
        <span>
        <img src="/mainimg/logo_alli_1.png" alt="국토교통부">
        <img src="/mainimg/logo_alli_2.png" alt="금융감독원">
        <img src="/mainimg/logo_alli_3.png" alt="손해보험협회">
        <img src="/mainimg/logo_alli_4.png" alt="보험개발원">
        <img src="/mainimg/logo_alli_5.png" alt="한국자동차해체재활용업협회">
        </span>           
    </div>
    </div>
</div>
<!-- //풋터바 -->
<!-- copyright -->
<div class="footer_copyright">
    <div class="logo">
        <div class="wrap">
        <img src="/images/front/footer_logo.png" alt="SKRC AUTO 로고">
        <!--span class="en">SKRCAUTO</span-->
        </div>

       <!-- <p>자동차경공매온라인서비스</p>-->
    </div>
    <div class="copy">
        <span>
        대표번호  :<strong> 031-278-6111</strong>   |   FAX :  031-278-6112   |   상호 : (주)태금모터스   |   대표자 :이형준   |   사업자등록번호 : 167-87-01230<br>
        개인정보관리책임자 : 이형준   |   주소 : 경기도 수원시 권선구 평동로79번길45 수원SKV1모터스 226호   |   이메일 : taegeum11@naver.com</span>
      <p>Copyright © (주)태금모터스 All Right Reserved.</p>
  </div>
</div>
<!-- //copyright --></div>
</div>


</div></body></html>