<?	header("Content-Type: text/html; charset=UTF-8"); 
	include_once "../../lib/code.php"; 
	// WriteArrHTML(html형식, html파리미터명, 배열명, 선택될 밸류, 온스크립트, 
	// td col 사이즈, 값바로 리턴인지여부, 전체 필드 추가여부)
	$type	= $_GET['type'];
	$name	= $_GET['name'];
	$Array	= $_GET['array'];
	$value	= $_GET['value'];
	$onscript = $_GET['onscript'];
	$col	= $_GET['col'];
	$ret	= $_GET['ret'];
	$write	= $_GET['write'];
	if($Array){
		if(count(${"Arrgubun3_".$Array."s"}) > 0){
			WriteArrHTML($type, $name, ${"Arrgubun3_".$Array."s"}, $value, $onscript, $col, $ret, $write);
		}else{
			$array = array();
			WriteArrHTML($type, $name, $array, $value, $onscript, $col, $ret, $write);
		}
	}else{
		$array = array();
		WriteArrHTML($type, $name, $array, $value, $onscript, $col, $ret, $write);
	}
?>