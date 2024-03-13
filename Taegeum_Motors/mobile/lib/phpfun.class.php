<?php
########################################################################
#	자주 쓰는 함수 모음입니다 
########################################################################

class phpfun {
	

/////// 마지막 날 계산 함수 ////////////
function holic_lastDay($year,$month) {

	if($month == '1' || $month == '3' || $month == '5' || $month == '7' ||  $month == '8' ||  $month == '10' || $month == '12') { 
		$day = '31';
	} else if($month == '4' || $month == '6' || $month == '9' || $month == '11') {
		$day = '30';
	} else if($month == '2') {
		if(date('L',mktime('0','0','0','2','1',$year)))$day = '29';
		else $day = '28';
    }
return $day;
}

//////////////////////////////////////////////////////////////////
//   디비에 테이블 유무 검사 // 테이블이 존재하면 1을 리턴한다 
//////////////////////////////////////////////////////////////////
function holic_table_exist($dbname,$tbname) {
	$list = mysql_list_tables($dbname);
	
	$tbrows = mysql_num_rows($list);
	$tbcols = mysql_num_fields($list);
	$flag = 0;	
	for($i=0; $i<$tbrows; $i++) {
		for($k=0; $k<$tbcols; $k++) {
			$tb_result = mysql_result($list,$i,$k);
			
			if(!strcmp($tbname,$tb_result))$flag = 1;
		}
	}
	return $flag;
}

//////////////////////////////////////////////////////////////////
//   테이블에 필드 유무 검사 // 필드가 존재하면 1을 리턴한다 
//////////////////////////////////////////////////////////////////
function holic_field_exist($dbname,$tbname,$field) {
	$list = mysql_list_fields($dbname,$tbname);
	
	$tbrows = mysql_num_rows($list);
	$tbcols = mysql_num_fields($list);
	$flag = 0;	
	for($i=0; $i<$tbrows; $i++) {
		for($k=0; $k<$tbcols; $k++) {
			$tb_result = mysql_result($list,$i,$k);
			
			if(!strcmp($field,$tb_result))$flag = 1;
		}
	}
	return $flag;
}
////////////////////////////////////////////////////////////////////
//			배열에 저장된 값을 돌려주는 함수
/////////////////////////////////////////////////////////////////////
function foreachlist($var_name,$arraylist) {

	foreach ($arraylist as $key => $val) {
		if($var_name == $key) {
		return $val;
		}
		else
		{
		return "";
		}
	}
}



function holic_carfunyear($st_name,$start,$end,$select="",$funct="") {
	$result.="<select name=".$st_name." id=".$st_name;
	if($funct)$result.=" onchange='".$funct.";'";
	$result.=">";
	if(!$select)$select=date('Y');
	$result.="<option value=''>::선택::</option>";
	for($y=$start; $y<=$end; $y++) {
		if($y == date('Y'))$result.="<option value='Tm'";
		else $result.="<option value=".$y;
		if($select == 'Tm')$chk=date('Y');
		else $chk = $select;
		if($chk == $y) $result.=" selected ";
		if($y == date('Y'))$result.=">재직중</option>";
		else $result.=">".$y."년</option>";
	}
	$result.= "</select>";	
	return $result;
}

function holic_funyear($st_name,$start,$end,$select="",$funct="") {
	$result.="<select name=".$st_name." id=".$st_name;
	if($funct)$result.=" onchange='".$funct.";'";
	$result.=">";
	if(!$select)$select=date('Y');
	for($y=$start; $y<=$end; $y++) {
		$result.="<option value=".$y;
		if($select == $y) $result.=" selected ";
		$result.=">".$y."년</option>";
	}
	$result.= "</select>";	
	return $result;
}

function holic_LastFunyear($st_name,$start,$end,$select="",$funct="") {
	$result.="<select name=".$st_name." id=".$st_name;
	if($funct)$result.=" onchange='".$funct.";'";
	$result.=">";
	if(!$select)$select=date('Y');
	
	for($y=$start; $y<=$end; $y++) {
		$result.="<option value=".$y;
		if($select == $y) $result.=" selected ";
		$result.=">".$y."년</option>";
	}
	$result.= "</select>";	
	return $result;
}


function holic_year($st_name,$select="",$funct="") {
	$result.="<select name=".$st_name." id=".$st_name;
	if($funct)$result.=" onchange=javascript:".$funct.";";
	$result.=">";
	if(!$select)$select=date('Y');
	$result.="<option value=''>:: 선택 ::</option>";
	for($y=1984; $y<=date('Y')+1; $y++) {
		$result.="<option value=".$y;
		if($select == $y) $result.=" selected ";
		$result.=">".$y."</option>";
	}
	$result.= "</select>";	
	return $result;
}

function holic_searchyear($st_name,$select="",$funct="") {
	$result.="<select name=".$st_name." id=".$st_name;
	if($funct)$result.=" onchange='".$funct.";'";
	$result.=">";
	$result.="<option value=''>선택</option>";
	for($y=date('Y')-10; $y<=date('Y')+1; $y++) {
		$result.="<option value=".$y;
		if($select == $y) $result.=" selected ";
		$result.=">".$y."년</option>";
	}
	$result.= "</select>";	
	return $result;
}


function holic_searchmonth($st_name,$select="",$funct="") {
	$result.="<select name=".$st_name." id=".$st_name;
	if($funct)$result.=" onchange='".$funct.";'";
	$result.=">";
	$result.="<option value=''>선택</option>";
	for($m=1; $m<=12; $m++) {
		$result.="<option value=".$m;
		if($select == $m) $result.=" selected ";
		$result.=">".$m."월</option>";
	}
	$result.= "</select>";	
	return $result;
}

function holic_carmonth($st_name,$select="",$funct="") {
	$result.="<select name=".$st_name." id=".$st_name;
	if($funct)$result.=" onchange='".$funct.";'";
	$result.=">";
	if(!$select)$select=date('m');
	$result.="<option value=''>::선택::</option>";
	for($m=1; $m<=12; $m++) {
	
			if($m == date('m'))$result.="<option value='Tm'";
			else $result.="<option value=".$m;
			if($select == 'Tm')$chk=date('m');
			else $chk = $select;
			if($chk == $m) $result.=" selected ";
			if($m == date('m'))$result.=">재직중</option>";
			else $result.=">".$m."월</option>";
	}
	$result.= "</select>";	
	return $result;
}

function holic_month($st_name,$select="",$funct="") {
	$result.="<select name=".$st_name." id=".$st_name;
	if($funct)$result.=" onchange=javascript:".$funct.";";
	$result.=">";
	$result.="<option value=''>:: 선택 ::</option>";
	if(!$select)$select=date('m');
	for($m=1; $m<=12; $m++) {
		
		if(strlen($m) == 1)$k = '0'.$m; 		
		else $k = $m;
		
		$result.="<option value=".$k;
		//if($select == $m) $result.=" selected ";
		$result.=">".$m."</option>";
	}
	$result.= "</select>";	
	return $result;
}

function holic_month2($st_name,$select="",$funct="") {
	$result.="<select name=".$st_name." id=".$st_name;
	if($funct)$result.=" onchange=javascript:".$funct.";";
	$result.=">";
	$result.="<option value=''>:: 선택 ::</option>";
	if(!$select)$select=date('m');
	for($m=1; $m<=12; $m++) {
		
		if(strlen($m) == 1)$k = '0'.$m; 		
		else $k = $m;
		
		$result.="<option value=".$k;
		if($select == $m) $result.=" selected ";
		$result.=">".$m."</option>";
	}
	$result.= "</select>";	
	return $result;
}

function simple_day($st_name,$select="") {
	$result.="<select name=".$st_name." id=".$st_name.">";
	$result.="<option value=''>선택</option>";
	for($d=1; $d<=31; $d++) {
		$result.="<option value=".$d;
		if($select == $d) $result.=" selected ";
		$result.=">".$d."일</option>";
	}
	$result.= "</select>";	
	return $result;
}


function holic_day($st_name,$select="") {
	$result.="<select name=".$st_name." id=".$st_name.">";
	if(!$select)$select=date('d');
	for($d=1; $d<=31; $d++) {
		
		if(strlen($d) == 1)$k = '0'.$d; 		
		else $k = $d;
	
		$result.="<option value=".$k;
		if($select == $d) $result.=" selected ";
		if($funct) {
			$result.=$funct;
		}
		$result.=">".$d."일</option>";
	}
	$result.= "</select>";	
	return $result;
}


function holic_time_h($st_name,$select="") {
	$result.="<select name=".$st_name." id=".$st_name.">";
	if(!$select)$select=date('H');
	for($d=1; $d<=24; $d++) {
	
		if(strlen($d) == 1)$k = '0'.$d; 		
		else $k = $d;
	
		$result.="<option value=".$k;
		if($select == $d) $result.=" selected ";
		if($funct) {
			$result.=$funct;
		}
		$result.=">".$d."시</option>";
	}
	$result.= "</select>";	
	return $result;
}


function holic_time_m($st_name,$select="") {
	$result.="<select name=".$st_name." id=".$st_name.">";
	if(!$select)$select=date('i');
	for($d=0; $d<=59; $d++) {
		
		if(strlen($d) == 1)$k = '0'.$d; 		
		else $k = $d;
	
		$result.="<option value=".$k;
		if($select == $d) $result.=" selected ";
		if($funct) {
			$result.=$funct;
		}
		$result.=">".$d."분</option>";
	}
	$result.= "</select>";	
	return $result;
}


}

?>