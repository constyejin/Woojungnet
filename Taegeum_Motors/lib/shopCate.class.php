<?php

class shopCate extends basicdb {

	function cateCount($var) {
		
		$var1 = substr($var,0,1);
		$var2 = substr($var,1,1);
		$var3 = substr($var,2,1);
		$var4 = substr($var,3,1);
	
		if($var4 == 'Z') {
			if($var3 == 'Z') {
				if($var2 == 'Z') {
					$var1 = $this->cateUp($var1);
				}
				$var2 = $this->cateUp($var2);
			}
			$var3 = $this->cateUp($var3);
		}
		$var4 = $this->cateUp($var4);
		$result = $var1.$var2.$var3.$var4;
	return $result;
	}
	
	function cateUp($var) {	
		switch($var) {
			case "A":
			$add = "B";
			break;
			case "B":
			$add = "C";
			break;
			case "C":
			$add = "D";
			break;
			case "D":
			$add = "E";
			break;
			case "E":
			$add = "F";
			break;
			case "F":
			$add = "G";
			break;
			case "G":
			$add = "H";
			break;
			case "H":
			$add = "I";
			break;
			case "I":
			$add = "J";
			break;
			case "J":
			$add = "K";
			break;
			case "K":
			$add = "L";
			break;
			case "L":
			$add = "M";
			break;
			case "M":
			$add = "N";
			break;
			case "N":
			$add = "O";
			break;
			case "O":
			$add = "P";
			break;
			case "P":
			$add = "Q";
			break;
			case "Q":
			$add = "R";
			break;
			case "R":
			$add = "S";
			break;
			case "S":
			$add = "T";
			break;
			case "T":
			$add = "U";
			break;
			case "U":
			$add = "V";
			break;
			case "V":
			$add = "W";
			break;
			case "W":
			$add = "X";
			break;
			case "X":
			$add = "Y";
			break;
			case "Y":
			$add = "Z";
			break;
			case "Z":
			$add = "A";
			break;
		}
	return $add;
	}
	
	function whereCode($code) {
		$cateLength = strlen($code);
		$depth = $cateLength/4 + 1;
					
		$cateCode = "and substring(cateCode,1,$cateLength) = '$code' and depth = '$depth'";
		
	return $cateCode;
	}

}


?>