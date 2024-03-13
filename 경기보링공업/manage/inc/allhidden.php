<?
include "../inc/header.php";

if($db_name){
	for($i=0;$i<count($checkidx);$i++){
		$query="update $db_name set del='Y' WHERE idx = '$checkidx[$i]' ";
		mysql_query($query);
	}
	parent_reload();
}
?>