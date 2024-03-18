<?
include "../inc/header.php";

$web_number=implode("-", $web_number);
$web_phone=implode("-", $web_phone);
$web_fax=implode("-", $web_fax);

$query="update web_config set 
web_name='$web_name', 
web_domain='$web_domain', 
web_number='$web_number', 
web_owner='$web_owner', 
web_phone='$web_phone', 
web_fax='$web_fax', 
web_email='$web_email', 
web_sell='$web_sell', 
web_address='$web_address',
web_smskey='$web_smskey', 
web_smsid='$web_smsid', 
web_smspass='$web_smspass', 
web_bank='$web_bank', 
web_banknumber='$web_banknumber', 
web_bankowner='$web_bankowner' 
where idx=1 
";
mysql_query($query);

msg("수정완료");
parent_reload();
?>