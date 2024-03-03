<?php
class ajaxCoder {

	function ajaxEncoder($post) {
		foreach($post as $key=>$val) {
			$result[$key] =rawurldecode(iconv("UTF-8","CP949",$val));
		}
	return $result;
	}

	function ajaxEncoderSingle($var) {
			$result =rawurldecode(iconv("UTF-8","CP949",$var));
	return $result;
	}

	function ajaxDecoder($getVar) {
		foreach($getVar as $key=>$val) {
			$result[$key] = rawurlencode(iconv("CP949","UTF-8",$val));
		}
	return $result;
	}

	function ajaxDecoderSingle($var) {
		$result = rawurlencode(iconv("CP949","UTF-8",$var));
		
	return $result;
	}
}
?>