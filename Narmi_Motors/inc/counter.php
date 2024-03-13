<?
$sn=$_SERVER['SERVER_NAME'];
if(substr($sn,0,3)=="www"){
	$sn=str_replace("www","",$sn);
}else{
	$sn=".".$sn;
}

$g5['visit_table']="g5_visit";
$g5['visit_sum_table']="g5_visit_sum";

define('G5_SERVER_TIME',    time());
define('G5_TIME_YMDHIS',    date('Y-m-d H:i:s', G5_SERVER_TIME));
define('G5_TIME_YMD',       substr(G5_TIME_YMDHIS, 0, 10));
define('G5_TIME_HIS',       substr(G5_TIME_YMDHIS, 11, 8));
define('G5_COOKIE_DOMAIN',  $sn);
define('G5_ESCAPE_FUNCTION', 'sql_escape_string');

function set_cookie2($cookie_name, $value, $expire)
{
    global $g5;
	if(headers_sent()){
		$cookie=$cookie_name.'='.urlencode($value).';';
		if($expire) $cookie.=' expires='.gmdate('D, d M Y H:i:s', $expire).' GMT';
//		echo '<script>document.cookie="'.$cookie.'";</script>';
	}else{
    setcookie(md5($cookie_name), base64_encode($value), G5_SERVER_TIME + $expire, '/', G5_COOKIE_DOMAIN);
	}
}


// 쿠키변수값 얻음
function get_cookie2($cookie_name)
{
    $cookie = md5($cookie_name);
    if (array_key_exists($cookie, $_COOKIE))
        return base64_decode($_COOKIE[$cookie]);
    else
        return "";
}

function escape_trim($field)
{
    $str = call_user_func(G5_ESCAPE_FUNCTION, $field);
    return $str;
}

// XSS 관련 태그 제거
function clean_xss_tags($str)
{
    $str = preg_replace('#</*(?:applet|b(?:ase|gsound|link)|embed|frame(?:set)?|i(?:frame|layer)|l(?:ayer|ink)|meta|object|s(?:cript|tyle)|title|xml)[^>]*+>#i', '', $str);

    return $str;
}
?>



<?

//set_cookie('ck_visit_ip', $_SERVER['REMOTE_ADDR'], -3600);
//echo get_cookie('ck_visit_ip');
//echo $_SERVER['REMOTE_ADDR'];
// 컴퓨터의 아이피와 쿠키에 저장된 아이피가 다르다면 테이블에 반영함
if (get_cookie2('ck_visit_ip') != $_SERVER['REMOTE_ADDR'])
{
    set_cookie2('ck_visit_ip', $_SERVER['REMOTE_ADDR'], 86400); // 하루동안 저장

    $tmp_row = mysql_fetch_array(mysql_query(" select max(vi_id) as max_vi_id from {$g5['visit_table']} "));
    $vi_id = $tmp_row['max_vi_id'] + 1;


    // $_SERVER 배열변수 값의 변조를 이용한 SQL Injection 공격을 막는 코드입니다. 110810
    $remote_addr = $_SERVER['REMOTE_ADDR'];
    $referer = "";
    if (isset($_SERVER['HTTP_REFERER']))
        $referer = $_SERVER['HTTP_REFERER'];
    $user_agent  = $_SERVER['HTTP_USER_AGENT'];
    $vi_browser = '';
    $vi_os = '';
    $vi_device = '';
    $sql = " insert {$g5['visit_table']} ( vi_id, vi_ip, vi_date, vi_time, vi_referer, vi_agent, vi_browser, vi_os, vi_device ) values ( '{$vi_id}', '".$_SERVER['REMOTE_ADDR']."', '".date("Y-m-d")."', '".date("H:i:s")."', '{$referer}', '{$user_agent}', '{$vi_browser}', '{$vi_os}', '{$vi_device}' ) ";
//	echo $sql;

    $result = mysql_query($sql);
	$result=true;

	// 정상으로 INSERT 되었다면 방문자 합계에 반영
    if ($result) {
        $sql = " select vs_count as cnt from {$g5['visit_sum_table']} where vs_date = '".G5_TIME_YMD."' ";
        $row = mysql_fetch_array(mysql_query($sql));
		if($row[vs_date]==""){
			$sql = " insert {$g5['visit_sum_table']} ( vs_count, vs_date) values ( 1, '".G5_TIME_YMD."' ) ";
			$result = mysql_query($sql);
		}else{
            $sql = " update {$g5['visit_sum_table']} set vs_count = vs_count + 1 where vs_date = '".G5_TIME_YMD."' ";
            $result = mysql_query($sql);
        }

		}

/*
        // DUPLICATE 오류가 발생한다면 이미 날짜별 행이 생성되었으므로 UPDATE 실행
        if (!$result) {
        // INSERT, UPDATE 된건이 있다면 기본환경설정 테이블에 저장
        // 방문객 접속시마다 따로 쿼리를 하지 않기 위함 (엄청난 쿼리를 줄임 ^^)

        // 오늘
        $sql = " select vs_count as cnt from {$g5['visit_sum_table']} where vs_date = '".G5_TIME_YMD."' ";
        $row = mysql_fetch_array(mysql_query($sql));
        $vi_today = $row['cnt'];

        // 어제
        $sql = " select vs_count as cnt from {$g5['visit_sum_table']} where vs_date = DATE_SUB('".G5_TIME_YMD."', INTERVAL 1 DAY) ";
        $row = mysql_fetch_array(mysql_query($sql));
        $vi_yesterday = $row['cnt'];

        // 최대
        $sql = " select max(vs_count) as cnt from {$g5['visit_sum_table']} ";
        $row = mysql_fetch_array(mysql_query($sql));
        $vi_max = $row['cnt'];

        // 전체
        $sql = " select sum(vs_count) as total from {$g5['visit_sum_table']} ";
        $row = mysql_fetch_array(mysql_query($sql));
        $vi_sum = $row['total'];

        $visit = '오늘:'.$vi_today.',어제:'.$vi_yesterday.',최대:'.$vi_max.',전체:'.$vi_sum;

        // 기본설정 테이블에 방문자수를 기록한 후
        // 방문자수 테이블을 읽지 않고 출력한다.
        // 쿼리의 수를 상당부분 줄임
        mysql_query(" update {$g5['config_table']} set cf_visit = '{$visit}' ");
    }
	*/
}
?>
