<?php
class scriptAlert {
	var $MESSAGE = '잘못된 접근입니다!';
	
	function alert($msg="",$url="",$false="") {
	
		if(!$msg)$msg = $this->MESSAGE;
		$script = "<script>";
	
		if($false) {
			if($false=='thispage') {
				$script.= "if(confirm('".$msg."'))location.href='".$url."';";
		
			} else {
				$script.= "if(confirm('".$msg."'))location.href='".$url."';";
				$script.= "else location.href='".$false."';";			 
			}
		
		} else {
			$script.= "alert('".$msg."');";
			if($url)$script.= "location.href='".$url."';";
			else $script.= "history.go(-1);";
		}
		$script.= "</script>";
		echo $script;
		return exit;
	}
	
	function alertReplace($msg="",$url="",$false="") {
		if(!$msg)$msg = $this->MESSAGE;
		$script = "<script>";
	
		if($false) {
			if($false=='thispage') {
				$script.= "if(confirm('".$msg."'))location.replace('".$url."');";
		
			} else {
				$script.= "if(confirm('".$msg."'))location.replace('".$url."');";
				$script.= "else location.replace=('".$false."');";			 
			}
		
		} else {
			$script.= "alert('".$msg."');";
			if($url)$script.= "location.replace('".$url."');";
			else $script.= "history.go(-1);";
		}
		$script.= "</script>";
		echo $script;
		return exit;
	}
	
	function alertWin($msg="",$reload="",$self="") {
		if(!$msg)$msg = $this->MESSAGE;
		if(!$reload)$reload = "opener.window.document.location.reload();";
		if(!$self)$self = "window.self.close();";
		$script = "<script>";
		$script.= "alert('".$msg."');";  
		$script.= $reload;
		$script.= $self; 
		$script.= "</script>";
	
		echo $script;
		return exit;
	}
	function radioMake($array,$id,$choice="",$hname="",$func="") {

		foreach($array as $key=>$val) {
			if($hname)$hTag = "hname='".$hname."' required";
		
			if($choice == $key)$check = 'checked';
			else $check = '';
			$result.= "<input type='radio' name='".$id."' value='".$key."' ".$hTag." ".$check." ".$func.">".$val."&nbsp;";
		}
		return $result;
	}
	
	function selectMake($array,$id,$choice="",$func="",$hname="") {
		if($hname)$hTag = "hname='".$hname."' required";
		$result = "<select name='".$id."' id='".$id."' ".$func." ".$hTag.">";
		$result .= "<option value=''>==선택==</option>";
		foreach($array as $key=>$val) {
			if($choice == $key)$select = 'selected';
			else $select = '';
			$result.= "<option value='".$key."' ".$select."> ".$val."</option>";
		}
		$result.= "</select>";
		return $result;
	}
	
	function adminList() {
		$query = mysql_query("select idx,name from woojung_member where usort = 'admin'");
		while($row = mysql_fetch_object($query))$result[] = array('idx'=>$row->idx,'name'=>$row->name); 
		
		return $result;
	}
	
	function area($num,$post1="") {  
		if(($num >=200) && ($num <= 269)) {
			$result['name'] = '강원'; 
			$result['query'] = "(".$post1." >=200) and (".$post1." <= 269)"; 
	
		} else if(($num >=418) && ($num <= 487)) {
			$result['name'] = '경기'; 
			$result['query'] = "(".$post1." >=418) and (".$post1." <= 487)"; 
		
		} else if(($num >=621) && ($num <= 678)) {
			$result['name'] = '경남'; 
			$result['query'] = "(".$post1." >=621) and (".$post1." <= 678)"; 
	
		} else if(($num >=712) && ($num <= 799)) {
			$result['name'] = '경북'; 
			$result['query'] = "(".$post1." >=712) and (".$post1." <= 799)"; 
	
		} else if(($num >=500) && ($num <= 506)) {
			$result['name'] = '광주'; 
			$result['query'] = "(".$post1." >=500) and (".$post1." <= 506)"; 
		
		} else if(($num >=700) && ($num <= 711)) {
			$result['name'] = '대구'; 
			$result['query'] = "(".$post1." >=700) and (".$post1." <= 711)"; 
	
		} else if(($num >=300) && ($num <= 306)) {
			$result['name'] = '대전'; 
			$result['query'] = "(".$post1." >=300) and (".$post1." <= 306)"; 
		
		} else if(($num >=600) && ($num <= 619)) {
			$result['name'] = '부산'; 
			$result['query'] = "(".$post1." >=600) and (".$post1." <= 619)"; 
		
		} else if(($num >=100) && ($num <= 158)) {
			$result ['name']= '서울'; 
			$result['query'] = "(".$post1." >=100) and (".$post1." <= 158)"; 
		
		} else if(($num >=680) && ($num <= 689)) {
			$result['name'] = '울산'; 
			$result['query'] = "(".$post1." >=680) and (".$post1." <= 689)"; 
		
		} else if(($num >=400) && ($num <= 417)) {
			$result['name'] = '인천'; 
			$result['query'] = "(".$post1." >=400) and (".$post1." <= 417)"; 
	
		} else if(($num >=513) && ($num <= 556)) {
			$result['name'] = '전남'; 
			$result['query'] = "(".$post1." >=513) and (".$post1." <= 556)"; 
	
		} else if(($num >=560) && ($num <= 597)) {
			$result['name'] = '전북'; 
			$result['query'] = "(".$post1." >=560) and (".$post1." <= 597)"; 
		
		} else if(($num >=690) && ($num <= 699)) {
			$result['name'] = '제주'; 
			$result['query'] = "(".$post1." >=690) and (".$post1." <= 699)"; 
		
		} else if(($num >=312) && ($num <= 357)) {
			$result['name'] = '충남'; 
			$result['query'] = "(".$post1." >=312) and (".$post1." <= 357)"; 
		
		} else if(($num >=360) && ($num <= 395)) {
			$result['name'] = '충북'; 
			$result['query'] = "(".$post1." >=360) and (".$post1." <= 395)"; 
		}
		return $result;
	}
	
}
?>