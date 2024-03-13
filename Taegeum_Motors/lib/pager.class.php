<?php
class pager {
	
	var $home_url = "http://jayeondri.com/";

function pager($scale,$page_scale) {

		 define("START1",(int)$_GET['start1']);  //출력시작 행
	     define("START2",(int)$_GET['start2']);  //출력시작 행
		 define("START3",(int)$_GET['start3']);  //출력시작 행
		 define("START4",(int)$_GET['start4']);  //출력시작 행
		 define("START5",(int)$_GET['start5']);  //출력시작 행
		 define("START6",(int)$_GET['start6']);  //출력시작 행
		 define("START7",(int)$_GET['start7']);  //출력시작 행
		 define("START8",(int)$_GET['start8']);  //출력시작 행
		 define("START",(int)$_GET['start']);    //출력시작 행
         define("SCALE",(int)$scale);            //페이지당 행수
         define("PAGE_SCALE",(int)$page_scale);  //페이지번호 묶음단위
         define("SELF",$_SEVER['PHP_SELF']);     //현재 페이지명

}

//$cnt 총 출력갯수   
//$qs get방식의 뒤에 붙을 변수들
function inner_cur($pos) {
	return "<font color='ff6600'> <b>".$pos."</b> </font>";
}
function inner_other($start_name2,$str,$qs="",$start_name3) {
	return "<a href='".SELF."?".$qs."&$start_name3=$start_name2'>$str</a>";
}

//$num 한페이지에서 2개 페이징 할 경우 $num="two" 값을 넘기면 된다.
function fPaging($cnt,$qs="",$num="") {
	
	switch($num) {
		case 'two':
		$start_name1 = START1;
		$start_name2 = $start1;
        $start_name3 = "start1";
		break;
	
		case 'three':
		$start_name1 = START2;
		$start_name2 = $start2;
        $start_name3 = "start2";
		break;
	
		case 'four':
		$start_name1 = START3;
		$start_name2 = $start3;
        $start_name3 = "start3";
		break;
	
		case 'five':
		$start_name1 = START4;
		$start_name2 = $start4;
        $start_name3 = "start4";
		break;
	
		case 'six':
		$start_name1 = START5;
		$start_name2 = $start5;
        $start_name3 = "start5";
		break;
	
		case 'seven':
		$start_name1 = START6;
		$start_name2 = $start6;
        $start_name3 = "start6";
		break;
	
		case 'eight':
		$start_name1 = START7;
		$start_name2 = $start7;
        $start_name3 = "start7";
		break;
	
		case 'nine':
		$start_name1 = START8;
		$start_name2 = $start8;
        $start_name3 = "start8";
		break;
	
		
		default:
		$start_name1 = START;
		$start_name2 = $start;
		$start_name3 = "start";
		break;
	}

	$contexture=SCALE*PAGE_SCALE;	
	//$a_division = array(all=> , offset=> , offsetMax=> , from=> , curSize=> ); 
	$a_division=array("all"=>ceil($cnt/SCALE), "offset"=>$start_name1==0? 0 : floor(($start_name1/SCALE)/PAGE_SCALE));
	$a_division[offsetMax]=floor($a_division[all]/PAGE_SCALE);	
	$a_division[from]=$a_division[offset]*$contexture;	
	$a_division[curSize]=($a_division[offset]==$a_division[offsetMax])? ceil(($cnt%$contexture)/SCALE) : PAGE_SCALE ;
	
	$pos=$a_division[offset]*PAGE_SCALE;

	if ($a_division[offset]>0) {
		$startStr=$this->inner_other(1,"<img src=$this->home_url/img/icon_first.gif>",$qs,$start_name3);
	}
	if ($a_division[offset]>0) {
		$prevStr=$this->inner_other($a_division[from]-SCALE,"<img src=$this->home_url/img/icon_back.gif>",$qs,$start_name3);
	}
	if ($a_division[offset]<$a_division[offsetMax] && SCALE*SCALE<=$cnt) {
		$nextStr=$this->inner_other($a_division[from]+$contexture,	"<img src=$this->home_url/img/icon_next.gif>",$qs,$start_name3);
	}
	if ($a_division[offset]<$a_division[offsetMax] && SCALE*SCALE<=$cnt) {
		$lastStr=$this->inner_other($a_division[all]*SCALE - SCALE,	"<img src=$this->home_url/img/icon_last.gif>",$qs,$start_name3);
	}
	for ($i=0;$i<$a_division[curSize];$i++) {
		$start_name2=$i*SCALE+$a_division[from];
		++$pos;
		$str.=($start_name2==$start_name1)? $this->inner_cur($pos) : $this->inner_other($start_name2,"&nbsp;".$pos."&nbsp;",$qs,$start_name3);
	}
	$pageTotal=ceil($cnt/SCALE);
	return  $startStr.$prevStr.$str.$nextStr.$lastStr;
}



##################################################################################
# 페이징 시킬 get방식 값들
##################################################################################

function paging($arrays) {

	foreach($arrays as $key=>$value)
		$values	.= ($value)?urlencode("$key=$value&"):"";
		

	return urldecode($values);
}


##################################################################################
# get방식으로 이용되다 post로 넘어올때 배열로 변환하여 변수이용하기
##################################################################################

function paging_change($val) {

	$val_arr	= explode("&",$val);

	foreach($val_arr as $key=>$value) {

		$val_arr2	= explode("=",$value);
		$vals[$val_arr2[0]]	= $val_arr2[1];
	}		

	return $vals;
}
}
?>