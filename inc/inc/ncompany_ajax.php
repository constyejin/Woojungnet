<?php 
	require_once "../lib/common.php";
	$connect = dbconn();
	$arridx = explode("|", $idx);
	$sql = "select * from team_cate where code='".$arridx[1]."' and depth=2 order by name asc";
	$arr2 = Fetch_string($sql);
	$k=0;
	for($i=0;$i<count($arr2);$i++){
		if($arr2[$i][idx]){
			if($k == 0){
				$list= iconv("euc-kr","utf-8", $arr2[$i][name]); 
			}else{
				$list.= ",".iconv("euc-kr","utf-8", $arr2[$i][name]);	
			}
			$k++;
		}
	}
	echo $list;
	dbclose($connect);
	exit;
?>