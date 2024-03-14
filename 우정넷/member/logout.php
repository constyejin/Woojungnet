<?
include $_SERVER['DOCUMENT_ROOT']."/inc/header.php";

session_unregister("user_id");
session_unregister("user_name");
session_unregister("nick_name");
session_unregister("idx");
session_unregister("mb_type");
session_unregister("user_level");
session_unregister("company");
session_unregister("last_login");
session_unregister("is_admin");
session_unregister("change_ch");
session_unregister("company_group");

session_destroy();
?>
<script>
//alert("·Î±×¾Æ¿ô");
location.href="/";
</script>
