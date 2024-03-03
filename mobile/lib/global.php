<?php

#########################################################################################
#			변수설정 
#########################################################################################
$class_dir			= $_SERVER['DOCUMENT_ROOT'].'/lib';

$tableAuction = 'woojung_auction'; 
$tableMember  = 'woojung_member';
$tablePre	  = 'woojung_member_pre';
$tableOutcar  = 'woojung_car_out';

$view_article = 20; // 한화면에 나타날 게시물의 총 개수  
if (!$page) $page = 1; // 현재 페이지 지정되지 않았을 경우 1로 지정  
$start = ($page-1)*$view_article; 
 


$carGear_array	  = array('auto'=>'오토','hand'=>'수동','semi'=>'세미오토','cvt'=>'CVT'); //기어설정
$carOutSort_array = array('accident'=>'사고폐차','normal'=>'일반폐차');
$callLine_array	  = array("user"=>"본인","family"=>"가족","etc"=>"기타");



$user_sort_array  = array(
							'indi'=>'일반회원',
							'company1'=>'<font color=#0066CC>제휴회원</font>',
							'company2'=>'<font color=#0066CC>제휴회원</font>',
							'company3'=>'<font color=#0066CC>제휴회원</font>',
							'premium'=>'<font color=#336633>입찰회원</font>',
							'premium1'=>'<font color=#336633>입찰회원</font>',
							'premium2'=>'<font color=#336633>입찰회원</font>',
							'admin'=>'<font color=#FF0000>관리자</font>',
							'superAdmin'=>'<font color=#FF0000>최고관리자</font>'
						);




$loginAuth_array = array('indi'=>'일반회원',
	'company1'=>'제휴회원',
	'company2'=>'딜러회원',	
	'premium1'=>'입찰대기',
	'premium2'=>'입찰승인',
	'premium3'=>'입찰종료',
	'premium4'=>'입찰중지',
	'jisajang'=>'프리미엄',
	'jisajang2'=>'추천회원',
	'admin'=>'관리자',
	'admin2'=>'관리자2',
	'admin3'=>'관리자3',
	'superadmin'=>'최고관리자'
);



$search_sort_array = array('indi'=>'일반회원','company'=>'제휴회원','premium'=>'프리미엄','admin'=>'관리자');
$admin_sort_array  = array(
'indi'=>'일반회원',
'company_c'=>'제휴회원(일반)',
'company_a'=>'제휴회원(우대)',
'premium_b'=>'프리미엄(일반)',
'premium_a'=>'프리미엄(우대)',
'premium_c'=>'프리미엄(대기)',
'admin'=>'관리자');

$grade_array	   = array('a'=>'<font color=#999900>우대</font>','b'=>'일반','c'=>'<font color=#FF0000>대기</font>');

$company_grade_array = array('a'=>'<font color=#999900>우대</font>','c'=>'일반');

$resultSort_array  = array('regist'=>'폐차접수','apply'=>'폐차진행','complete'=>'폐차완료','end'=>'폐차종결','cancle'=>'취소');

$auct_method_array = array('auct'=>'경매','pubauct'=>'공매','special'=>'스페셜공매',);

$priceMethod_array = array('mix'=>'낙찰가정산','owner'=>'낙찰자부담','carowner'=>'차주부담');
$outCarPriceMethod_array= array('mix'=>'낙찰가정산','carowner'=>'차주처리');

$buy_type_array	   = array('mix'=>'구제/폐차가','out'=>'폐차대상');
$sale_type_array   = array('mix'=>'구제/폐차가','relif'=>'구제','out'=>'폐차');
$haveType_array   = array('indi'=>'개인','company'=>'법인','less'=>'리스','two'=>'차주2인이상','lent'=>'렌터카','etc'=>'기타'); 
$relation_array   = array('charge'=>'보상담당자','service'=>'정비업체','owner'=>'본인','family'=>'가족'); 
$auct_manager_array  = array('regist'=>'접수','wait'=>'대기','ing'=>'진행','end'=>'종료','success'=>'낙찰','fail'=>'유찰','complete'=>'종결');
$buy_sort_array	  = array('regist'=>'매입접수','apply'=>'매입진행','complete'=>'매입완료','end'=>'매입종결','cancle'=>'취소');
$buycars_method_array = array('hut'=>'손상차량','recover'=>'도난회수차량','normal'=>'일반차량','etc'=>'부품매각');
$fuel_array = array('oil'=>'휘발유','gasolin'=>'경유','gas'=>'LPG','gasoil'=>'LPG겸용');
$keep_where_array = array('a'=>'서울','b'=>'부산','c'=>'대구','d'=>'인천','e'=>'광주','f'=>'대전','g'=>'울산','h'=>'강원','i'=>'경기','j'=>'경남','k'=>'경북','l'=>'전남','m'=>'전북','n'=>'충남','o'=>'충북','p'=>'제주');



function selectHour($id,$choice) {
	if($choice > 12) {
		$stchoice = 'pm';
		$chHour = $choice - 12;
	} else {
		$stchoice = 'am';
		$chHour = $choice;
	}
	$result = "<select name='".$id."_hour_sort' id='".$id."_hour_sort'>";
	if($stchoice == 'am') $selectam = 'selected';
	else if($stchoice == 'pm') $selectpm = 'selected';
	$result.= "<option value='am' ".$selectam.">오전</option>";
	$result.= "<option value='pm' ".$selectpm.">오후</option>";
	$result.= "</select>";
	$result.= "<select name='".$id."' id='".$id."'>";
	for($h=0; $h<=11; $h++) {
		if($chHour == $h) $select = 'selected';
		else $select = '';
		$result.= "<option value='".$h."' ".$select.">".$h."시</option>";
	}
	$result.= "</select>";

return $result;
}

function selectMin($id,$choice) {
	
	$result = "<select name='".$id."' id='".$id."'>";
	for($h=0; $h<=59; $h++) {
		if($choice == $h) $select = 'selected';
		else $select = '';
		$result.= "<option value='".$h."' ".$select.">".$h."분</option>";
	}
	$result.= "</select>";
return $result;
}


//////////// 변수설정함수/////
function car_year($car_year) {
	$date_arr = explode('-',$car_year);
	$date = $date_arr[0].'년'.$date_arr[1].'월';
return $date;
}
#########################################################################################
#			기본클래스 인클루드 
#########################################################################################
include $class_dir.'/basicdb.class.php';
include $class_dir.'/scriptAlert.class.php';

$db		= new basicdb();
$script = new scriptAlert();

$pageMode	= $_GET['pageMode'];
$pg_ctrl	= $_GET['pg_ctrl'];
$subpg_ctrl = $_GET['subpg_ctrl'];


#########################################################################################
#			자바스크립트 및 css 
#########################################################################################
