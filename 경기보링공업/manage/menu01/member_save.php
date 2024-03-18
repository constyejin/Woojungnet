<?
include "../inc/header.php";

$query="update member_admin set 
admin_name='$admin_name', 
admin_id='$admin_id', 
admin_pass='$admin_pass', 
admin_level='$admin_level' 
where idx=$idx 
";
mysql_query($query);

msg("수정완료");
parent_reload();
?>