<?
ini_set("session.gc_maxlifetime", "43200");

@session_start ();

extract($_POST) ;

extract($_GET) ;

extract($_SERVER) ;


extract($_FILES) ;


extract($_ENV) ;

extract($_COOKIE) ;

extract($_SESSION) ;

$dir=$_SERVER['DOCUMENT_ROOT'];
$DOCUMENT_ROOT=$_SERVER['DOCUMENT_ROOT'];

// multi-dimensional array�� ��������� �Լ�����
function array_map_deep($fn, $array)
{
    if(is_array($array)) {
        foreach($array as $key => $value) {
            if(is_array($value)) {
                $array[$key] = array_map_deep($fn, $value);
            } else {
                $array[$key] = call_user_func($fn, $value);
            }
        }
    } else {
        $array = call_user_func($fn, $array);
    }

    return $array;
}


// SQL Injection ���� ���ڿ� ���͸�
function sql_escape_string($str)
{
    if(defined('G5_ESCAPE_PATTERN') && defined('G5_ESCAPE_REPLACE')) {
        $pattern = G5_ESCAPE_PATTERN;
        $replace = G5_ESCAPE_REPLACE;

        if($pattern)
            $str = preg_replace($pattern, $replace, $str);
    }

    $str = call_user_func('addslashes', $str);

    return $str;
}

define('G5_ESCAPE_FUNCTION', 'sql_escape_string');

$_POST    = array_map_deep(G5_ESCAPE_FUNCTION,  $_POST);
$_GET     = array_map_deep(G5_ESCAPE_FUNCTION,  $_GET);
$_COOKIE  = array_map_deep(G5_ESCAPE_FUNCTION,  $_COOKIE);
$_REQUEST = array_map_deep(G5_ESCAPE_FUNCTION,  $_REQUEST);


$mysql_host='localhost';
$mysql_user='woojungnet';
$mysql_password='dnwjd6511';
$mysql_db='woojungnet';

$connect = sql_connect($mysql_host, $mysql_user, $mysql_password, $mysql_db);

//DB ���� �� ������ ���̽� ���� ����� �Լ�
function sql_connect($db_host, $db_user, $db_pass, $db_name)
{
    $result = mysql_connect($db_host, $db_user, $db_pass) or die(mysql_error());
    mysql_select_db($db_name) or die(mysql_error());
    return $result;
}

// ���� �Լ�
function sql_query($sql)
{
    global $connect;
    $result = @mysql_query($sql, $connect) or die("<p>$sql<p>" . mysql_errno() . " : " .  mysql_error() . "<p>error file : $_SERVER[PHP_SELF]");
    return $result;
}

// ���� ���ϴ� �Լ�
function sql_total($sql)
{
    global $connect;
    $result_total = sql_query($sql, $connect);
    $data_total = mysql_fetch_array($result_total);
    $total_count = $data_total[cnt];
    return $total_count;
}

// ������ ������ �� ��������� ������ ���ϴ� �Լ�
function sql_fetch($sql, $error=TRUE)
{
    $result = sql_query($sql);
    $row = mysql_fetch_array($result);
    return $row;
}

// ������ ���� �� �� ������� ����� �迭�� ���ϴ� �Լ�
function sql_list($sql)
{
    $sql_q = sql_query($sql);
    $sql_list = array();
    while($sql_r = mysql_fetch_array($sql_q)){
        $sql_list[]= $sql_r;
    }

    return $sql_list;
}

// ȸ������ ���ϴ� �Լ�
function get_member($uer_id)
{
    global $_cfg;
    $member = sql_fetch("select * from ".$_cfg[member_table]." where m_id = '".$uer_id."'");
    return $member;
}

// ���â ���� �̵���Ű�� �Լ�
function alert($msg='', $url='')
{
    if (!$msg) $msg = '�ùٸ� ������� �̿��� �ֽʽÿ�.';
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

// ���â ���� �θ� �̵���Ű�� �Լ�
function alert_p($msg='', $url='')
{
    if (!$msg) $msg = '�ùٸ� ������� �̿��� �ֽʽÿ�.';
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

// ������ �̵���Ű�� �Լ�
function goto_url($url)
{
    echo "<script language='JavaScript'> location.replace('$url'); </script>";
    exit;
}

// �θ� ������ �̵���Ű�� �Լ�
function parent_url($url)
{
    echo "<script language='JavaScript'> parent.location.href='$url'; </script>";
    exit;
}

// ���� �о ������ ���� �����ϱ�
function file_read($file)
{
    $handle = fopen($file, "r");
    $contents = fread($handle, filesize($file));
    fclose($handle);
    return $contents;
}

// ���� ���� üũ�ϴ� �Լ� $this_level = ��뷹��
function check_level($this_level)
{
    if($_SERVER[user_level] >= $this_level){
        $result = true;
    }else{
        $result = false;
    }
    return $result;
}

// ����¡2 ����� �Լ�
function paging2($page, $page_row, $page_scale, $total_count, $ext)
{
	if($ext==""){
		$ext=$_SERVER[PHP_SELF]."?";
	}else{
		$ext=$_SERVER[PHP_SELF]."?".$ext;
	}

	// 1. ��ü ������ ���
    $total_page  = ceil($total_count / $page_row);

    // 2. ����¡�� ����� ���� �ʱ�ȭ
    $paging_str = "";

    // 3. ó�� ������ ��ũ �����
    if ($page > 1) {
       $paging_str .= '<a class="first" href="'.$ext.'"page=1">&lt;&lt;</a>';
   }

    // 4. ����¡�� ǥ�õ� ���� ������ ���ϱ�
    $start_page = ( (ceil( $page / $page_scale ) - 1) * $page_scale ) + 1;

    // 5. ����¡�� ǥ�õ� ������ ������ ���ϱ�
    $end_page = $start_page + $page_scale - 1;
    if ($end_page >= $total_page) $end_page = $total_page;

    // 6. ���� ����¡ �������� ���� ��ũ �����
    if ($start_page > 1){
        $paging_str .= '<a class="prev" href="'.$ext."page=".($start_page - 1).'">&lt;</a>';
    }

    // 7. �������� ��� �κ� ��ũ �����
    if ($total_page >= 1) {
        for ($i=$start_page;$i<=$end_page;$i++) {
            // ���� �������� �ƴϸ� ��ũ �ɱ�
            if ($page != $i){
                $paging_str .= '<li><a href="'.$ext."pae=".$i.'">'.$i.'</a></li>';
            // ������������ ���� ǥ���ϱ�
            }else{
                $paging_str .= '<li class="on"><a href="'.$ext."page=".$i.'">'.$i.'</a></li>';
            }
        }
    }

    // 8. ���� ����¡ �������� ���� ��ũ �����
    if ($total_page > $end_page){
       $paging_str .= '<a class="next" href="'.$ext."page=".($end_page + 1).'">&gt;</a>';
    }

    // 9. ������ ������ ��ũ �����
    if ($page < $total_page) {
        $paging_str .= '<a class="last" href="'.$ext."page=".$total_page.'">&gt;&gt;</a>';
    }

    return $paging_str;
}


function paging($page, $page_row, $page_scale, $total_count, $ext)
{
	if($ext==""){
		$link_p=$_SERVER[PHP_SELF]."?";
	}else{
		$link_p=$ext;
	}

	// 1. ��ü ������ ���
    $total_page  = ceil($total_count / $page_row);

    // 2. ����¡�� ����� ���� �ʱ�ȭ
    $paging_str = "";

    // 3. ó�� ������ ��ũ �����
//    if ($page > 1) {
//       $paging_str .= "<a href='".$_SERVER[PHP_SELF]."?page=1&".$ext."'>ó��</a>";
//   }

    // 4. ����¡�� ǥ�õ� ���� ������ ���ϱ�
    $start_page = ( (ceil( $page / $page_scale ) - 1) * $page_scale ) + 1;

    // 5. ����¡�� ǥ�õ� ������ ������ ���ϱ�
    $end_page = $start_page + $page_scale - 1;
    if ($end_page >= $total_page) $end_page = $total_page;

    // 6. ���� ����¡ �������� ���� ��ũ �����
    if ($start_page > 1){
        $paging_str .= " &nbsp;<a href='".$ext."page2=".($start_page - 1)."' class='pre'>����</a>";
    }

    // 7. �������� ��� �κ� ��ũ �����
    if ($total_page >= 1) {
        for ($i=$start_page;$i<=$end_page;$i++) {
            // ���� �������� �ƴϸ� ��ũ �ɱ�
            if ($page != $i){
                $paging_str .= " &nbsp;<a href='".$ext."page2=".$i."'>$i</a>";
            // ������������ ���� ǥ���ϱ�
            }else{
                $paging_str .= " &nbsp;<strong>$i</strong> ";
            }
        }
    }

    // 8. ���� ����¡ �������� ���� ��ũ �����
    if ($total_page > $end_page){
       $paging_str .= " &nbsp;<a href='".$ext."page2=".($end_page + 1)."' class='next'>����</a>";
    }

    // 9. ������ ������ ��ũ �����
//    if ($page < $total_page) {
//        $paging_str .= " &nbsp;<a href='".$_SERVER[PHP_SELF]."?page=".$total_page."&".$ext."'>�ǳ�</a>";
//      //echo $ext;
//    }

    return $paging_str;
}

function imgSizeChange($file, $save_filename, $max_width, $max_height){
	if(eregi("jpg",$file) || eregi("gif",$file) || eregi("jpeg",$file) || eregi("png",$file)){
		$img_info = getimagesize($file);
		if($img_info[2] == 2){
			$src_img=imagecreatefromjpeg($file);
		}
		if($img_info[2] == 1){
			$src_img=imagecreatefromgif($file);
		}

		$img_width = $img_info[0];
		$img_height = $img_info[1];

		$im_height = imagesx($src_img)/$max_width*$max_height;
		$st_x = 0;
		$st_y = (imagesy($src_img)/2)-($im_height/2);

		$dst_img = imagecreatetruecolor($max_width, $max_height);
		$dst_img2 = imagecolorallocate($dst_img,255,255,255);
		imagefill($dst_img,0,0,$dst_img2);
		imagecopyresampled($dst_img, $src_img, 0, 0, $st_x, $st_y, $max_width, $max_height, imagesx($src_img), $im_height);

		imageinterlace($dst_img);

		if(ereg("gif",$file)){
			imagegif($dst_img, $save_filename);
		}else{
			imagejpeg($dst_img, $save_filename);
		}

		imagedestroy($dst_img);
		imagedestroy($src_img);
	}
}

function imgWater($file,$water_file,$save_filename){
	$img_info = getimagesize($file);
	if($img_info[2] == 2){
		$src_img=imagecreatefromjpeg($file);
	}
	if($img_info[2] == 1){
		$src_img=imagecreatefromgif($file);
	}

	$src_w = $img_info[0];
	$src_h = $img_info[1];

	$img_info2 = getimagesize($water_file);
	$mark_w = $img_info2[0];
	$mark_h = $img_info2[1];

	imagecopymerge($file, $water_file, 0, 0, 0, 0, $mark_w, $mark_h, 60);

	if(ereg("gif",$file)){
		imagegif($file, $save_filename);
	}else{
		imagejpeg($file, $save_filename);
	}

	imagedestroy($file);
	imagedestroy($water_file);


}

function newpaging($page, $page_row, $page_scale, $total_count, $ext)
{
	if($ext==""){
		$link_p=$_SERVER[PHP_SELF]."?";
	}else{
		$link_p=$ext;
	}

	// 1. ��ü ������ ���
    $total_page  = ceil($total_count / $page_row);

    // 2. ����¡�� ����� ���� �ʱ�ȭ
    $paging_str = "";

	$paging_str="<b>".$page."</b> / ".$total_page;

    return $paging_str;
}

function newpaging2($page, $page_row, $page_scale, $total_count, $ext)
{
	$k="";
	$k2=$page-1;
	if($page!=1){
		$k="<a href='".$ext."page=".$k2."'>";
	}
	return $k;
}

function newpaging3($page, $page_row, $page_scale, $total_count, $ext)
{
    $total_page  = ceil($total_count / $page_row);
	$j="";
	$j2=$page+1;

	if($page!=$total_page){
		$j="<a href='".$ext."page=".$j2."'>";
	}
	return $j;
}

function cut_str($msg,$cut_size,$dot=true) {
	if($cut_size<=0) return $msg;
	if ($dot) $odot="...";
	else $odot="";
	if(ereg("\[RE\]",$msg)) $cut_size=$cut_size+4;
	for($i=0;$i<$cut_size;$i++) if(ord($msg[$i])>127) $han++; else $eng++;
	$cut_size=$cut_size+(int)$han*0.6;
	$point=1;
	for ($i=0;$i<strlen($msg);$i++) {
		if ($point>$cut_size) return $pointtmp.$odot;
		if (ord($msg[$i])<=127) {
			$pointtmp.= $msg[$i];
			if ($point%$cut_size==0) return $pointtmp.$odot; 
		} else {
			if ($point%$cut_size==0) return $pointtmp.$odot;
			$pointtmp.=$msg[$i].$msg[++$i];
			$point++;
		}
		$point++;
	}
	return $pointtmp;
}

function login_check(){
	if(!$_SESSION[user_id]){
		alert('�α����� ��� �����մϴ�.','/member/login.php');
	}
}

function admin_check(){
	if($_SESSION[is_admin]!="Y"){
		alert('������ �����Դϴ�.','/');
	}
}

function img_v($url,$src,$w,$h){
	if($src){
		echo '<img src="'.$url.$src.'" style="width:'.$w.'px;height:'.$h.'px;">';
	}
}

function getNaverGeocode($addr, $cId, $cSecret) {
 $addr = urlencode($addr);
 $url = "https://openapi.naver.com/v1/map/geocode?encoding=utf-8&coord=latlng&output=json&query=".$addr;
 $headers = array();
 $headers[] = "GET https://openapi.naver.com/v1/map/geocode?".$addr;
 $headers[] ="Host: openapi.naver.com";
 $headers[] ="Accept: */*";
 $headers[] ="Content-Type: application/json";
 $headers[] ="X-Naver-Client-Id: ".$cId;
 $headers[] ="X-Naver-Client-Secret: ".$cSecret;
 $headers[] ="Connection: Close";
 $result = getHttp($url, $headers);
 return $result;
}

// curl ��� �ϱ� 

function getHttp($url, $headers=null)
{
 $ch = curl_init();
 curl_setopt($ch, CURLOPT_URL, $url);
 curl_setopt($ch, CURLOPT_HEADER, false);
 curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 $result = curl_exec($ch);
 curl_close($ch);
 return $result;
}

function number($num){
	if($num){
		return number_format($num);
	}else{
		return "0";
	}
}

function cate($v){
	if($v){
		$sql=sql_query("select * from config_category where code='$v' ");
		$data_c2=mysql_fetch_array($sql);
		return $data_c2[name];
	}
}

function checkup_cate($v){
	if($v){
		$sql=sql_query("select * from category_checkup where idx='$v' ");
		$data_c2=mysql_fetch_array($sql);
		$sql=sql_query("select * from category_checkup where cs_idx='$data_c2[cs_idx]' and code='$data_c2[code1]' ");
		$data_c1=mysql_fetch_array($sql);
		return $data_c1[name]."-".$data_c2[name];
	}
}

	//���� Ȯ���� ��������
	function get_extention($file_name) 
	{
		return substr(strrchr($file_name,"."),1);
	}

	//���� ���ε�
	function FileUpload($file_name,$file_tmp, $file_path, $file_size=0){				
		$ext_name = strtoupper(get_extention($file_name));
		
		//Ȯ���� üũ		
		/*if (in_array($ext_name, array("JPG" , "GIF" , "PNG" , "BMP", "JPEG"))) {
			$FileType = "IMG";			
		} else if (in_array($ext_name, array("AVI" , "WMV" , "WMA", "MP3", 'PDF', 'EXE'))) {
			$FileType = "MOV";			
		} else {
			err_msg("���� : ���ε� ������ Ȯ���ڰ� �ƴմϴ�.");
			exit;
		}*/
		/*
		if($file_size > 10000000){
			err_msg("���� : ���� ���ε� �ִ� �뷮�� 10MB�Դϴ�. Ȯ�����ּ���");
			exit;
		}*/
		$i=1;
		while(1){
			$file_name = substr(rand(),-6).substr(time(),-6).$i;
			$file_name .= ".".$ext_name;
			if(file_exists($file_path.$file_name)){
				
			}else break;
		$i++;
		}
		/*echo("
		\$file_tmp ==> $file_tmp <BR>
			\$file_path ==> $file_path <BR>
			\$file_name ==> $file_name <BR>
		");*/
		if(!move_uploaded_file($file_tmp,$file_path.$file_name)){		
			err_msg("���� : ���� ���ε��� ������ �߻��߽��ϴ�. ����� �ٽ� �õ����ּ���");			
			exit;
		}
		return $file_name;	
	}

function textout($str){
	if ($str) $ret="O";
	else $ret="��";
	return $ret;
}

// �迭

$array_pay=array("","����","�ⳳ","����","�ߴ�","����","�μ�");

$array_est_type1=array("","ȸ���","ȫ����","������","���θ�","��Ÿ","�������");
$array_est_type2=array("","Ȩ����������","��������","����ȣ����","��ȣ����");

$array_host_type=array("","����ȣ����","��ȣ����","������");
?>


