<?

// 신청구분 배열
$ArrcarRegType = array(
	"폐차접수"=>"1",
	"경매/공매접수"=>"2",
	"중고차접수"=>"3",
	"감정평가접수"=>"4",
	"기타"=>"5"
);


// 진행구분 배열
$Arrgubun1 = array(	
	"접수"=>"1",
	"취소"=>"2"
);

$Arrgubun1_new = array(	
	"가치평가"=>"1",
	"폐차"=>"2"
);

$Arrgubun1_sale = array(	
	"접수"=>"1",
	"취소"=>"2",
	"보관"=>"3"
);

$Arrgubun2 = array(
	"보험경공매"=>"2",
	"스페셜매물"=>"3",
	"일반경공매"=>"4"
);





/*
구분2가 폐차인 경우 - 구분3은 폐차 하나만 있고	
구분2가 손상차인경우- 구분3은 경매, 공매 , 도난경매, 도난공매 
구분2가 특수차인경우- 구분3은 경매, 공매
구분2가 감정평가인경우-구분3은  중고차싯가감정,손상차가치감정,경락손해감정,사고차손해감정 								*/

// 접수대장 경,공매 타입 배열
// 경매,공매 같은것이 있기때문에 아래 경매,공매에 ' ' 공백 추가함
$Arrgubun3 = array(	
	"폐차"=>"1",
	"경매파손"=>"2",
	"공매파손"=>"3",
	"경매도난회수"=>"4",
	"공매도난회수"=>"5",
	"경매파손 "=>"6",
	"공매파손 "=>"7",
	"중고차싯가감정"=>"8",
	"손상차가치감정"=>"9",
	"경락손해감정"=>"10",
	"사고차손해감정"=>"11"
);

$Arrgubun3_1 = array(	
	"폐차"=>"1"
);
$Arrgubun3_1s = array(	
	"폐차"=>"1"
);

$Arrgubun3_2 = array(	
	"공매(파손)"=>"3",
	"공매(도난)"=>"5",
	"공매(침수)"=>"6",
	"경매(파손)"=>"2",
	"경매(도난)"=>"4",
	"일반차량"=>"1"
);
$Arrgubun3_2s = array(	
	"공매(파손)"=>"3",
	"공매(도난)"=>"5",
	"공매(침수)"=>"6",
	"경매(파손)"=>"2",
	"경매(도난)"=>"4"
);

$Arrgubun3_7 = array(	
	"경매파손"=>"2",
	"공매파손"=>"3",
	"경매도난회수"=>"4",
	"공매도난회수"=>"5",
	"폐차"=>"1"
);
$Arrgubun3_7s = array(	
	"경매파손"=>"2",
	"공매파손"=>"3",
	"경매도난회수"=>"4",
	"공매도난회수"=>"5",
	"폐차"=>"1"
);

$Arrgubun3_special = array(	
	"경매"=>"2",
	"공매"=>"3",
	"경매도난회수"=>"4",
	"공매도난회수"=>"5"
);

$Arrgubun3_special_1 = array(	
	"경매"=>"2",
	"공매"=>"3"
);

$Arrgubun3_3 = array(	
	"공매물건"=>"1",
	"경매물건"=>"2"
);
$Arrgubun3_3s = array(	
	"공매물건"=>"1",
	"경매물건"=>"2"
);

$Arrgubun3_4 = array(	
	"공매물건"=>"1",
	"경매물건"=>"2"
);
$Arrgubun3_4s = array(	
	"공매물건"=>"1",
	"경매물건"=>"2"
);

$Arrgubun3_5 = array(
	"경매"=>"2",
	"공매"=>"3"
);
$Arrgubun3_5s = array(
	"경매"=>"2",
	"공매"=>"3"
);

$Arrgubun4 = array(	
	"대기"=>"1", 
	"진행"=>"2",
	"마감"=>"3", 
	"낙대"=>"9",
	"유찰"=>"5" , 
	"낙찰"=>"4",
	"입금완료"=>"10",
	"송금완료"=>"11",
	"미지급"=>"12",
	"미결" =>"8",  
	"종결" =>"6"  
);


$Arrjud = array(
	"폐차조건"=>"1",
	"명의이전조건"=>"2",
	"폐차명의이전조건"=>"3"
);



// 차량 제조사 배열
$ArrcarMakeCom = array(	
	"현대"=>"1",
	"GM대우"=>"2",
	"르노삼성"=>"3",
	"기아"=>"4",
	"쌍용"=>"5",
	"수입차"=>"6",
	"쉐보레"=>"7"
);

// 변속기 배열
$ArrcarTran = array(	
	"오토"=>"1",
	"수동"=>"2",
	"세미오트"=>"3",
	"CVT"=>"4"
);

// 연료 배열
$ArrcarFual = array(	
	"휘발류"=>"1",
	"경유"=>"2",
	"LPG"=>"3",
	"휘발유&LPG"=>"4",
	"하이브리드"=>"5",
	"기타"=>"6"
);

// 차량 기본옵션
$ArrcarOption = array(
	"2륜구동"=>"22",
	"4륜구동"=>"23",
	"파워스티어링"=>"18",
	"ABS"=>"14",
	"ECS"=>"16",
	"알루미늄휠"=>"21",
	"무선도어락"=>"24",
	"CD 체인저"=>"25",
	"네비게이션"=>"6", 
	"A/V시스템"=>"17",
	"CDP"=>"7", 
	"도난경보기"=>"30", 
	"싱글에어백"=>"11",
	"더불에어백"=>"12",
	"사이드에어백"=>"13",
	"풀오토에어컨"=>"3",
	"천연가죽시트"=>"26",
	"썬루프"=>"9",
	"루프캐리어"=>"28"
);

// 차량 기본옵션
$ArrcarAcc = array(
	"충돌사고"=>"1",
	"침수(담수)"=>"2",
	"침수(해수)"=>"3",
	"화재"=>"4",
	"도난"=>"5",
	"전복"=>"6",
	"전도"=>"7"
);

// 소유형태 배열
$ArrcarOwner_bak = array(
	"개인"=>"1",
	"법인"=>"2",
	"차주 2인이상"=>"3",
	"기타"=>"4"
);

// 신규 소유형태 배열
$ArrcarOwner = array(
	"개인"=>"1",
	"법인"=>"2",
	"공동소유"=>"3",
	"리스"=>"4",
	"기타"=>"5"
);

//담보구분
$ArrcarDambo = array(
	"자차보험"=>"40",
	"대물보험"=>"20"
);


// 차량보관장소 배열
$ArrcarPlace = array(
	"서울"=>"1",
	"부산"=>"2",
	"대구"=>"3",
	"인천"=>"4",
	"광주"=>"5",
	"대전"=>"6",
	"울산"=>"7",
	"강원"=>"8", 
	"경기"=>"9",
	"경남"=>"10",
	"경북"=>"11",
	"전남"=>"12", 
	"전북"=>"13",
	"충남"=>"14",
	"충북"=>"15",
	"제주"=>"16", 
	"세종"=>"17" 
);



// 손상차 매각유형
$ArrgoSale = array(	
	"폐차"=>"1",
	"명의이전"=>"2",
	"폐차/이전"=>"3"
);



// 손상차 비용정산
$ArrgoCost = array(	
	"낙찰자부담"=>"2",
	"차주부담"=>"3",
	"보험사부담"=>"4"
);

$ArrUpPage = array(
	"1"=>"Scrap/",
	"2"=>"Damage/",
	"3"=>"Special/",
	"4"=>"Suc/",
	"5"=>"Judgment/",
);



// get or post 값 찍어보기
function wRequest(){
	foreach ($_POST as $key => $value){
		echo $key ." = ". $value."<BR>";
	}
}


// 배열을 "배열명|배열값,배열명|배열값,배열명|배열값" 형식으로 리턴한다.
function ReturnArryJava($no, $choiceArray){
	global $Arrgubun3, $Arrgubun3_1,  $Arrgubun3_2,  $Arrgubun3_3,  $Arrgubun3_4,  $Arrgubun3_5;
	//$choiceArray = ${"Arrgubun3_".$no};
	$rArray = "";
	if(count($choiceArray) > 0){
		$i=0;
		foreach($choiceArray as $arrName => $arrVal){
			if($i==0) {
				$rArray = $arrName."|".$arrVal;
			}else{
				$rArray .= ",".$arrName."|".$arrVal;
			}
			$i++;
		}
	}
	return $rArray;
}



// 배열을 원하는 형태로 찍어준다.
// WriteArrHTML(html형식, html파리미터명, 배열명, 선택될 밸류, 온스크립트, td col 사이즈, 값바로 리턴인지여부, 전체 필드 추가여부)
function WriteArrHTML($type, $fieldName, $array, $value="", $onscript="", $colSize=0, $showtype='all', $alltype=":: 선택 ::"){
	
	$startTable = "<table border=0 cellspacing=0 cellpadding=0 width='100%'><tr>";
	$endTable = "</table>";
	
	if($type == "radio"){		
		$valueChk = " checked ";
		$basicHTML = "<input type='radio' name='$fieldName' value='[:val:]' [:chk:]  {$onscript} > [:name:] ";
	
	}elseif($type == "checkbox"){
		
		$valueChk = " checked ";
		$basicHTML = "<input type='checkbox' name='$fieldName' value='[:val:]' [:chk:]  {$onscript}> [:name:] ";
		
		if($colSize > 0){
			$wi=round(100/$colSize);
			$firstHTML = $startTable;
			$EndHTML = $endTable;
			$basicHTML = "<td align='left' style='border:0px;width:".$wi."%'><input type='checkbox' name='$fieldName' value='[:val:]' [:chk:]  {$onscript}> [:name:] </td>";
		}

		
		
	}elseif($type == "select"){
		$valueChk = " selected ";
		$firstHTML = "<select name='$fieldName' {$onscript} class='form_select'>  ";
		$basicHTML = "<option value='[:val:]' [:chk:]>[:name:]</option>";
		$EndHTML = "</select>";
	}
	


	//if( count($array) > 0 ){

		$i=0;
		if($firstHTML && ($showtype == "all") ) echo $firstHTML."\n";	
		
		$allSelect = false;

		//전체 필드 추가여부확인
		if( $alltype != "") {

			$ReturnHTML = str_replace("[:val:]", "", $basicHTML);
			
			if(!$value || trim($value) == ''){
				$ReturnHTML = str_replace("[:chk:]", $valueChk, $ReturnHTML);
			}else{
				$ReturnHTML = str_replace("[:chk:]", "", $ReturnHTML);
			}

			$ReturnHTML = str_replace("[:name:]", $alltype, $ReturnHTML);
			echo $ReturnHTML;
		}
		
		

		foreach($array as $arrName => $arrVal){

			// 값 바로 리턴이라면 
			if($showtype == "direct"){

				if( trim($arrVal) == trim($value) ) {
					$ReturnHTML = $arrName;
					echo $ReturnHTML;
					break;
				}

			}else{ // html 형식 리턴이라면
				
				$ReturnHTML = str_replace("[:val:]", $arrVal, $basicHTML);
				$ReturnHTML = str_replace("[:name:]", $arrName, $ReturnHTML);
							
				$arrayValue = explode(",", trim($value) );
				
				if(count($arrayValue) > 0){ // value 값이 , 구분으로 여러개 넘어온다

						$chkVal = false;
						for($v = 0 ; $v < count($arrayValue) ; $v++){
							if( trim($arrVal) == trim($arrayValue[$v]) ){					
								$chkVal = true;
								break;
							}
						}


						if( $chkVal == true ){							
							$ReturnHTML = str_replace("[:chk:]", $valueChk, $ReturnHTML);
						}else{
							$ReturnHTML = str_replace("[:chk:]", "", $ReturnHTML);
						}


				}else{  // 아니다 1개만 넘어온다.

					if( trim($arrVal) == trim($value) ){
						$ReturnHTML = str_replace("[:chk:]", $valueChk, $ReturnHTML);
					}else{
						$ReturnHTML = str_replace("[:chk:]", "", $ReturnHTML);
					}

				}
				
				if( $colSize > 0 && ($i%$colSize == 0) ) echo"</tr><tr>";
				if(trim($arrVal)=="9"&&$fieldName=="carOption[]") {echo "</tr><tr>";$i++;}
			}

			$i++;
			echo $ReturnHTML."\n";
		}


		if($EndHTML && ($showtype == "all") ) echo $EndHTML."\n";
		
	//}else{
	//	echo ' ';
	//}
}


// 배열을 원하는 형태로 찍어준다.
// WriteArrHTML(html형식, html파리미터명, 배열명, 선택될 밸류, 온스크립트, td col 사이즈, 값바로 리턴인지여부, 전체 필드 추가여부)
function search_m($type, $fieldName, $array, $value="", $onscript="", $colSize=0, $showtype='all', $alltype=":: 선택 ::"){
	
	$startTable = "<table border=0 cellspacing=0 cellpadding=0 width='100%'><tr>";
	$endTable = "</table>";
	
	if($type == "radio"){		
		$valueChk = " checked ";
		$basicHTML = "<input type='radio' name='$fieldName' value='[:val:]' [:chk:]  {$onscript} > [:name:] ";
	
	}elseif($type == "checkbox"){
		
		$valueChk = " checked ";
		$basicHTML = "<input type='checkbox' name='$fieldName' value='[:val:]' [:chk:]  {$onscript}> [:name:] ";
		
		if($colSize > 0){
			$firstHTML = $startTable;
			$EndHTML = $endTable;
			$basicHTML = "<td><input type='checkbox' name='$fieldName' value='[:val:]' [:chk:]  {$onscript}> [:name:] </td>";
		}

		
		
	}elseif($type == "select"){
		$valueChk = " selected ";
		$firstHTML = "<select name='$fieldName' {$onscript}>  ";
		$basicHTML = "<option value='[:val:]' [:chk:]>[:name:]</option>";
		$EndHTML = "</select>";
	}
	


	//if( count($array) > 0 ){

		$i=0;
		if($firstHTML && ($showtype == "all") ) echo $firstHTML."\n";	
		
		$allSelect = false;

		//전체 필드 추가여부확인
		if( $alltype != "") {

			$ReturnHTML = str_replace("[:val:]", "", $basicHTML);
			
			if(!$value || trim($value) == ''){
				$ReturnHTML = str_replace("[:chk:]", $valueChk, $ReturnHTML);
			}else{
				$ReturnHTML = str_replace("[:chk:]", "", $ReturnHTML);
			}

			$ReturnHTML = str_replace("[:name:]", $alltype, $ReturnHTML);
			echo $ReturnHTML;
		}
		
		

		foreach($array as $arrName => $arrVal){

			// 값 바로 리턴이라면 
			if($showtype == "direct"){

				if( trim($arrVal) == trim($value) ) {
					$ReturnHTML = $arrName;
					echo $ReturnHTML;
					break;
				}

			}else{ // html 형식 리턴이라면
				
				$ReturnHTML = str_replace("[:val:]", $arrVal, $basicHTML);
				$ReturnHTML = str_replace("[:name:]", $arrName, $ReturnHTML);
							
				$arrayValue = explode(",", trim($value) );
				
				if(count($arrayValue) > 0){ // value 값이 , 구분으로 여러개 넘어온다

						$chkVal = false;
						for($v = 0 ; $v < count($arrayValue) ; $v++){
							if( trim($arrVal) == trim($arrayValue[$v]) ){					
								$chkVal = true;
								break;
							}
						}


						if( $chkVal == true ){							
							$ReturnHTML = str_replace("[:chk:]", $valueChk, $ReturnHTML);
						}else{
							$ReturnHTML = str_replace("[:chk:]", "", $ReturnHTML);
						}


				}else{  // 아니다 1개만 넘어온다.

					if( trim($arrVal) == trim($value) ){
						$ReturnHTML = str_replace("[:chk:]", $valueChk, $ReturnHTML);
					}else{
						$ReturnHTML = str_replace("[:chk:]", "", $ReturnHTML);
					}

				}
				
				if( $colSize > 0 && ($i%$colSize == 0) ) echo"</tr><tr>";
			}

			$i++;
			echo $ReturnHTML."\n";
		}


		if($EndHTML && ($showtype == "all") ) echo $EndHTML."\n";
		
	//}else{
	//	echo ' ';
	//}
}


// 담당자를 배열로 리턴한다.
function SaleAdmin($type = "", $admidx = ""){
	$qry = "SELECT waidx, waname FROM woojung_admin order by orderval asc  ";
  		$arr = Fetch_string($qry);
	$arr = Fetch_string($qry);	
	$return = array();
	for($i=0 ; $i < count($arr) ; $i++){
		if($type != ""){
			if( $admidx == $arr[$i][0] ){
				return $arr[$i][1];
				break;
			}
		}else{
			$return[$arr[$i][1]] = $arr[$i][0];
		}
	}
	return $return;
}

// 해당 쿼리를 배열로 리턴한다.
function TableQuery($table, $tablecol = "*", $where){
	$qry = "select $tablecol  from $table  $where ";
	$arr = Fetch_string($qry);	
	return $arr;
}


$arr_power=array('','폐차','이전','폐차/이전');
$arr_wc_damage=array('','무사고','사고있음');


function cutStr($str, $s=0, $e){
	return mb_strcut($str, $s, $e, 'euc-kr');
}


function foreachlist($var_name,$arraylist) {
	foreach ($arraylist as $key => $val) {
		if($var_name == $key)	return $val;
	}
}


function number($val){
	if($val){
		return number_format($val);
	}else{
		return "0";
	}
}


function sReplace($type, $val){
	if($type == "date1"){
		$v = "-";
		$r = ".";
		return str_replace($v, $r, $val);
	}

	if($type == 'date2'){
		list($yy, $mm, $dd) = explode('-', $val);
		return $yy."년 ".$mm."월 ".$dd."일 ";
		
	}

	if($type == "date3"){
		return substr($val,0,4)."-".substr($val,4,2)."-".substr($val,6,2);
	}
	
}
?>