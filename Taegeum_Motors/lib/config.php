<?
/*******************************************************/
/****												****/
/****	Define Directory							****/
/****	생성 : 2008-09-04 김은성					****/
/****	수정 :										****/ 
/****												****/
/*******************************************************/

ini_set("session.gc_maxlifetime", "43200");
# 위치정보
$dir=$_SERVER[DOCUMENT_ROOT];
$dir_image="/images";
$dir_shop="$dir/jshop";
$shop_dir="/jshop";
$setup="$dir/lib";


$site_code="branch00";



# 사이트정보
$shopping_title = ""; 
$bank_owner = $shop_name; // 은행정보
//$domain=eregi_replace("www.","",$_SERVER[HTTP_HOST]);
$domain=$_SERVER[HTTP_HOST];

#Setting
$unwidth=920;
$adwidth=130;

#결제정보
//$Mall_Id="H0545";
//$Mall_Id="S1154"; 혈압365
 
// 기본 디렉토리명
$DirFolderName = "wj14512";

// HTML ROOT
define(HTML_ROOT, $_SERVER[DOCUMENT_ROOT]);

// LIB ROOT
define(LIB_ROOT, $_SERVER[DOCUMENT_ROOT]."/lib");


?>

