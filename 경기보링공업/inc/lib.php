<?
session_start ();

$mysql_host='localhost';
$mysql_user='wjn2312';
$mysql_password='q1w2e3r4';
$mysql_db='wjn2312';

$array_pop_link_type=array("","바로","새창");

$g5[visit_table]="g5_visit";
$g5[visit_sum_table]="g5_visit_sum";

define('G5_SERVER_TIME',    time());
define('G5_TIME_YMDHIS',    date('Y-m-d H:i:s', G5_SERVER_TIME));
define('G5_TIME_YMD',       substr(G5_TIME_YMDHIS, 0, 10));

$page_row=20;
$page_scale=10;
if(!$page) $page=1;
$page_start=($page-1)*$page_row;

$connect = sql_connect($mysql_host, $mysql_user, $mysql_password, $mysql_db);

//DB 접속 및 데이터 베이스 선택 사용자 함수
function sql_connect($db_host, $db_user, $db_pass, $db_name)
{
    $result = mysql_connect($db_host, $db_user, $db_pass) or die(mysql_error());
    mysql_select_db($db_name) or die(mysql_error());
    return $result;
}

// 쿼리 함수
function sql_query($sql)
{
    global $connect;
    $result = @mysql_query($sql, $connect) or die("<p>$sql<p>" . mysql_errno() . " : " .  mysql_error() . "<p>error file : $_SERVER[PHP_SELF]");
    return $result;
}

// 갯수 구하는 함수
function sql_total($sql)
{
    global $connect;
    $result_total = sql_query($sql, $connect);
    $data_total = mysql_fetch_array($result_total);
    $total_count = $data_total[cnt];
    return $total_count;
}

// 쿼리를 실행한 후 결과값에서 한행을 구하는 함수
function sql_fetch($sql, $error=TRUE)
{
    $result = sql_query($sql, $error);
    $row = mysql_fetch_array($result);
    return $row;
}

// 쿼리를 실행 한 후 결과값의 목록을 배열로 구하는 함수
function sql_list($sql)
{
    $sql_q = sql_query($sql);
    $sql_list = array();
    while($sql_r = mysql_fetch_array($sql_q)){
        $sql_list[]= $sql_r;
    }

    return $sql_list;
}
// 경고창 띄우고 이동시키는 함수
function alert($msg='', $url='')
{
    if (!$msg) $msg = '올바른 방법으로 이용해 주십시오.';
    echo "<script language='javascript'>alert('$msg');";
    echo "</script>";
    if($url){
        goto_url($url);
    }else{
        echo "<script language='javascript'>history.back();";
        echo "</script>";
    }
    exit;
}

// 경고창 띄우고 부모 이동시키는 함수
function alert_p($msg='', $url='')
{
    if (!$msg) $msg = '올바른 방법으로 이용해 주십시오.';
    echo "<script language='javascript'>alert('$msg');";
    echo "</script>";
    if($url){
        parent_url($url);
    }else{
        echo "<script language='javascript'>history.back();";
        echo "</script>";
    }
    exit;
}

function msg($msg)
{
    echo "<script language='javascript'>alert('$msg');";
    echo "</script>";
}

// 페이지 이동시키는 함수
function goto_url($url)
{
    echo "<script language='JavaScript'> location.replace('$url'); </script>";
    exit;
}

// 페이지 이동시키는 함수
function parent_url($url)
{
    echo "<script language='JavaScript'> parent.location.href='$url'; </script>";
    exit;
}

// 부모 새로고침
function parent_reload()
{
    echo "<script language='JavaScript'> parent.document.location.reload(); </script>";
    exit;
}

function paging($page, $page_row, $page_scale, $total_count, $ext)
{
	if($ext==""){
		$ext=$_SERVER[PHP_SELF]."?";
	}else{
		$ext=$_SERVER[PHP_SELF]."?".$ext;
	}

	// 1. 전체 페이지 계산
    $total_page  = ceil($total_count / $page_row);

    // 2. 페이징을 출력할 변수 초기화
    $paging_str = "";

    // 3. 처음 페이지 링크 만들기
    if ($page > 1) {
       $paging_str .= '<li class="page-item"><a class="page-link" href="'.$ext.'"page=1">&lt;&lt;</a></li>';
   }

    // 4. 페이징에 표시될 시작 페이지 구하기
    $start_page = ( (ceil( $page / $page_scale ) - 1) * $page_scale ) + 1;

    // 5. 페이징에 표시될 마지막 페이지 구하기
    $end_page = $start_page + $page_scale - 1;
    if ($end_page >= $total_page) $end_page = $total_page;

    // 6. 이전 페이징 영역으로 가는 링크 만들기
    if ($start_page > 1){
        $paging_str .= '<li class="page-item"><a class="page-link" href="'.$ext."page=".($start_page - 1).'">&lt;</a></li>';
    }

    // 7. 페이지들 출력 부분 링크 만들기
    if ($total_page >= 1) {
        for ($i=$start_page;$i<=$end_page;$i++) {
            // 현재 페이지가 아니면 링크 걸기
            if ($page != $i){
                $paging_str .= '<li class="page-item"><a class="page-link" href="'.$ext."page=".$i.'">'.$i.'</a></li>';
            // 현재페이지면 굵게 표시하기
            }else{
                $paging_str .= '<li class="page-item active"><a class="page-link" href="'.$ext."page=".$i.'">'.$i.'</a></li>';
            }
        }
    }

    // 8. 다음 페이징 영역으로 가는 링크 만들기
    if ($total_page > $end_page){
       $paging_str .= '<li class="page-item"><a class="page-link" href="'.$ext."page=".($end_page + 1).'">&gt;</a></li>';
    }

    // 9. 마지막 페이지 링크 만들기
    if ($page < $total_page) {
        $paging_str .= '<li class="page-item"><a class="page-link" href="'.$ext."page=".$total_page.'">&gt;&gt;</a></li>';
    }

    return $paging_str;
}

function paging_f($page, $page_row, $page_scale, $total_count, $ext)
{
	if($ext==""){
		$ext=$_SERVER[PHP_SELF]."?";
	}else{
		$link_p=$ext;
	}

	// 1. 전체 페이지 계산
    $total_page  = ceil($total_count / $page_row);

    // 2. 페이징을 출력할 변수 초기화
    $paging_str = "";

    // 3. 처음 페이지 링크 만들기
    if ($page > 1 && $total_page>10) {
       $paging_str .= '<a href="'.$ext.'page=1 "class="to-first"></a>';
    }else if($page==1) {
    //   $paging_str .= '<a href="'.$ext.'page=1 "class="to-first disabled"></a>';
	}

    // 4. 페이징에 표시될 시작 페이지 구하기
    $start_page = ( (ceil( $page / $page_scale ) - 1) * $page_scale ) + 1;

    // 5. 페이징에 표시될 마지막 페이지 구하기
    $end_page = $start_page + $page_scale - 1;
    if ($end_page >= $total_page) $end_page = $total_page;

    // 6. 이전 페이징 영역으로 가는 링크 만들기
    if ($start_page > 10){
        $paging_str .= '<a href="'.$ext."page=".($start_page - 1).'" class="prev"></a>';
    }else if ($start_page == 1){
    //    $paging_str .= '<a href="'.$ext."page=".($start_page - 1).'" class="prev disabled"></a>';
	}

	$paging_str .= "<ul>";
    // 7. 페이지들 출력 부분 링크 만들기
    if ($total_page >= 1) {
        for ($i=$start_page;$i<=$end_page;$i++) {
            // 현재 페이지가 아니면 링크 걸기
            if ($page != $i){
                $paging_str .= '<li><a href="'.$ext."page=".$i.'">'.$i.'</a></li>';
            // 현재페이지면 굵게 표시하기
            }else{
                $paging_str .= '<li><a class="current" href="'.$ext."page=".$i.'">'.$i.'</a></li>';
            }
        }
    }
	$paging_str .= "</ul>";

    // 8. 다음 페이징 영역으로 가는 링크 만들기
    if ($total_page > $end_page+10){
       $paging_str .= '<a href="'.$ext."page=".($end_page + 1).'" class="next"></a>';
    }else{
    //   $paging_str .= '<a href="'.$ext."page=".($end_page + 1).'" class="next disabled"></a>';
	}

    // 9. 마지막 페이지 링크 만들기
    if ($page+10 < $total_page) {
        $paging_str .= '<a href="'.$ext."page=".$total_page.'" class="to-last"></a>';
    }else{
    //    $paging_str .= '<a href="'.$ext."page=".$total_page.'" class="to-last disabled"></a>';
	}

    return $paging_str;
}

function number($val){
	if($val){return number_format($val);}else{return 0;}
}

function thumbnail($file, $save_filename, $save_path, $max_width, $max_height)
{
	// 전송받은 이미지 정보를 받는다
	$img_info = getImageSize($file);

	// 전송받은 이미지의 포맷값 얻기 (gif, jpg png)
	if($img_info[2] == 1) 
		$src_img = ImageCreateFromGif($file);
	else if($img_info[2] == 2)
		$src_img = ImageCreateFromJPEG($file);
	else if($img_info[2] == 3)
		$src_img = ImageCreateFromPNG($file);
	else
		return 0;

	// 전송받은 이미지의 실제 사이즈 값얻기
	$img_width = $img_info[0];
	$img_height = $img_info[1];

	if($img_width <= $max_width)
	{
		$max_width = $img_width;
		$max_height = $img_height;
	}

	if($img_width > $max_width)
		$max_height = ceil(($max_width / $img_width) * $img_height);

	// 새로운 트루타입 이미지를 생성
	$dst_img = imagecreatetruecolor($max_width, $max_height);

	// R255, G255, B255 값의 색상 인덱스를 만든다
	ImageColorAllocate($dst_img, 255, 255, 255);

	// 이미지를 비율별로 만든후 새로운 이미지 생성
	ImageCopyResampled($dst_img, $src_img, 0, 0, 0, 0, $max_width, $max_height, ImageSX($src_img),ImageSY($src_img));

	// 알맞는 포맷으로 저장
	if($img_info[2] == 1)
 {
		ImageInterlace($dst_img);
		ImageGif($dst_img, $save_path.$save_filename);
	}
	else if($img_info[2] == 2)
 {
		ImageInterlace($dst_img);
		ImageJPEG($dst_img, $save_path.$save_filename);
	}
 else if($img_info[2] == 3)
 {
		ImagePNG($dst_img, $save_path.$save_filename);
 }

	// 임시 이미지 삭제
	ImageDestroy($dst_img);
	ImageDestroy($src_img);
	return true;
}  

function file_down($file_path, $type,$filename="file",$filesize=0) {

       if($type == "file") {       // 파일다운로드의 경우
		   $filesize=filesize($file_path);
              if(eregi("(MSIE 5.5|MSIE 6.0)", $HTTP_USER_AGENT)) { // 브라우져 구분
                     $filename= urlencode($filename); // 파일명이나 경로에 한글이나 공백이 포함될 경우를 고려
                     Header("Content-Type: doesn/matter");
                     Header("Content-Length: $filesize");   // 이부분을 넣어 주어야지 다운로드 진행 상태가 표시 됩니다.
                     Header("Content-Disposition: inline; filename=$filename");
                     Header("Content-Transfer-Encoding: binary");
                     Header("Pragma: no-cache");
                     Header("Expires: 0");
              } else {
                     Header("Content-type: file/unknown");
                     Header("Content-Length: $filesize");
                     Header("Content-Disposition: attachment; filename=$filename");
                     Header("Content-Description: PHP3 Generated Data");
                     Header("Pragma: no-cache");
                     Header("Expires: 0");
              }
       } else {
              header("Content-type: $type");
              header("Pragma: no-cache");
              header("Expires: 0");
       }
		//exit($file_path);
       if (is_file("$file_path")) {
              $fp = fopen("$file_path", "rb");
              if (!fpassthru($fp))  // 서버부하를 줄이려면 print 나 echo 또는 while 문을 이용한 기타 보단 이방법이...
                     fclose($fp);
       } else {
              echo "해당 파일이나 경로가 존재하지 않습니다.";
       }
}

function price_refresh(){
	$sale_car_trim=sql_list("select * from sale_car_trim where 1 ");
	for($i=0;$i<count($sale_car_trim);$i++){
		$new_price=$sale_car_trim[$i][trim_basic_price];
		if($sale_car_trim[$i][trim_option3]){
			$trim_option3=explode("/",$sale_car_trim[$i][trim_option3]);
			for($j=0;$j<count($trim_option3);$j++){
				$mod_choice=sql_fetch("select * from option_choice where idx='".$trim_option3[$j]."' and del='N' ");
				if($mod_choice[ch_price]) $new_price+=$mod_choice[ch_price];
			}
		}
		if($sale_car_trim[$i][trim_option4]){
			$trim_option4=explode("/",$sale_car_trim[$i][trim_option4]);
			for($j=0;$j<count($trim_option4);$j++){
				$mod_choice=sql_fetch("select * from option_choice where idx='".$trim_option4[$j]."' and del='N' ");
				if($mod_choice[ch_price]) $new_price+=$mod_choice[ch_price];
			}
		}
		$query="update sale_car_trim set trim_price='$new_price' where idx=".$sale_car_trim[$i][idx];
		mysql_query($query);
	}
}


$array_structure1=array("","섀시캡","카고트럭","윙바디탑차","내장탑차","냉동탑차","저상탑차");
?>