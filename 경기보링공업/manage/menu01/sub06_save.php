<?
include "../inc/header.php";

$query="update web_config set 
web_sitename='$web_sitename', 
web_meta='$web_meta' 
where idx=1 
";
mysql_query($query);

msg("수정완료");
parent_reload();
?>