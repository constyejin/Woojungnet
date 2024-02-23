<?
require "../lib/dbconn.php";
if (!$connect) $connect=dbconn();


if($rCode=="0000"){
$query="update js_webconfig set	sms_count='$uCount' where no='1' ";
mysql_query($query);
}


?>