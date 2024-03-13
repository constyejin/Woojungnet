<?php

function mail_fsend($tos,$subject,$message='',$addtion_header='',$files='',$top='',$sub=''){ 
//첨부파일 가능용 
/* 
추천 해더설정 
$addtion_header['content_type']  ='text/html'; 
$addtion_header['char_set']='UTF-8'; or $addtion_header['char_set']='EUC-KR'; 
*/ 
// $files: 는 서버내의 파일을 지목할 때 사용 
    //============================================== 기초 설정 
    $boundary = "----=b".md5(uniqid(time())); 
     
    $content_type= $addtion_header['content_type'];    //기본내용형식 : 일반 text 
    if(empty($content_type)) $content_type='text/plain';            //기본문자셋 : utf-8     
    $char_set = $addtion_header['char_set']; 
    if(empty($char_set)) $char_set='UTF-8';            //기본문자셋 : utf-8 
    //=====================================================to 설정 
    if(is_string($tos)){ 
        $to = $tos; 
    }else if(is_array($tos)){ 
        $to = implode(', ',$tos); 
    } 
    //=====================================================subject 설정 
    if(empty($subject)){ 
    $subject = 'No title '.date('Y-m-d H:i:s'); 
    } 
    //$subject = '=?EUC-KR?B?'.base64_encode($subject).'?='; 
    //$subject = '=?'.$char_set.'?B?'.base64_encode($subject).'?=';      
    //=====================================================해더 설정 
    $headers=array(); 
    $headers['mime_version']='MIME-Version: 1.0'; 
    //$headers['content_type']="Content-type: multipart/alternative; boundary=\"{$boundary}\""; 
    $headers['content_type']="Content-type: multipart/mixed; boundary=\"{$boundary}\""; 

    if(!empty($addtion_header['from'])){        $headers[]= "From: ".$addtion_header['from'];    } 
    else{        $headers[]= "From: webmaster@{$_SERVER['SERVER_NAME']}";    }     
    if(!empty($addtion_header['cc'])){        $headers[]= "cc: ".$addtion_header['cc'];    } 
    if(!empty($addtion_header['bcc'])){        $headers[]= "Bcc: ".$addtion_header['bcc'];    }             

    if(!empty($headers)){        $header = implode("\r\n",$headers)."\r\n";    } 
    else{        $header ='';    } 
    //======================================================== 메세지 인코딩 
    $msg_content_type = "Content-type: {$content_type}; charset={$char_set}"; 
     
    $msg = ''; 
    $msg .= mail_fsend_enc_msg($boundary,$message,$msg_content_type,$top,$sub); //본문 메세지 처리 
   	
	//======================================================== 첨부파일 인코딩 
   
   if($files) $msg .= mail_fsend_enc_file($boundary,$_FILES['file1'][tmp_name],$_FILES['file1'][name]); //첨부파일 처리 
    /*
	//======================================================== 업로드 되는 첨부파일 인코딩     
    if(!empty($_FILES)){ 
        foreach($_FILES as $key=> $value){            $t = $key; break;        } 
       $t_files = $_FILES[$t]['tmp_name']; 
        $t_filenames = $_FILES[$t]['name']; 
        $t_error = $_FILES[$t]['error']; 
        if(!is_array($t_files)){$t_files=array($t_files);} 
        if(!is_array($t_filenames)){$t_filenames=array($t_filenames);} 
        if(!is_array($t_error)){$t_error=array($t_error);} 
        for($i =0,$m=count($t_files);$i<$m;$i++){ 
            if($t_error[$i]==0){ 
                $msg .= mail_fsend_enc_file($boundary,$t_files[$i],$t_filenames[$i]); //첨부파일 처리 
            } 
        }     
    } 
	*/
    //========================================================= 메세지 닫기 
    $msg .='--'.$boundary."--"; 
    //===================================================== 메일 보내기 
    //===================================================== 릴레이션 설정이 필요한 경우는 알아서... 
	
	$result = mail($to,$subject,$msg,$header); 
    return $result;     
} 
function mail_fsend_enc_msg($boundary,$msg='',$content_type='Content-type: text/plain; charset=utf-8',$top,$sub){ 
//본문문자열 인코딩 
    $re_str = ''; 
    $re_str = '--'.$boundary."\r\n"; //바운드리 설정 
    $re_str .= $content_type."\r\n"; 
    $re_str .= 'Content-Transfer-Encoding: base64'."\r\n"."\r\n";     
    // RFC 2045 에 맞게 $data를 형식화 
  
	$msg = mail_skin($subject,$msg,$top,$sub);
	$new_msg = chunk_split(base64_encode($msg)); 
    $re_str .=$new_msg."\r\n"; 
    return $re_str; 
} 
function mail_fsend_enc_file($boundary,$file,$filename=''){ 
//첨부파일 인코딩 

    $content_type = 'Content-Type: application/octet-stream; charset=UTF8'; 
    $re_str = ''; 
    $re_str = '--'.$boundary."\r\n"; //바운드리 설정 
    $re_str .= $content_type."\r\n"; 
    $re_str .= 'Content-Transfer-Encoding: base64'."\r\n";     
    if(strlen($filename)==0){        $filename = basename($file);    } 
    $re_str .= "Content-Disposition: attachment; filename=\"".$filename."\""."\r\n"."\r\n";         
     
    // RFC 2045 에 맞게 $data를 형식화     
    $fp = @fopen($file, "r"); 
    if($fp){  $msg = fread($fp,filesize($file));    fclose($fp);    }     
     
    $new_msg = chunk_split(base64_encode($msg)); 
    $re_str .=$new_msg."\r\n"; 
     
    return $re_str; 
} 

function mail_skin($subject,$messages,$top,$sub) {
	
$tag = "<html>
<head>
<title>알려드립니다.</title>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=euc-kr\">
<link rel=\"stylesheet\" type=\"text/css\" href=\"[domain]/css/admin.css\">
</head>

<body bgcolor=\"#FFFFFF\" text=\"#000000\" leftmargin=\"0\" marginwidth=\"0\" topmargin=\"0\" marginheight=\"0\">
<table width=\"600\" border=\"0\" cellspacing=\"1\" cellpadding=\"0\" bgcolor=\"#B0904A\">
<tr>
<td bgcolor=\"#F6F3EC\"><a href=\"http://carmain.co.kr/\" target=_blank><img src=\"http://".$_SERVER[HTTP_HOST]."/image/mall_title_1.gif\"  border=0></a></td>
</tr>
<tr>
<td bgcolor=\"#FFFFFF\">
<table border=\"0\">
<tr>
<td width=\"588\"></td>
</tr>
</table><table border=\"0\" bgcolor=\"#B0904A\" width=\"95%\" align=\"center\" cellspacing=\"1\" height=\"30\">
<tr>
<td width=\"588\" bgcolor=\"#F7F3EF\"><span style=\"font-size:9pt;\">&nbsp;&nbsp;<b><font color=\"#003366\">제목 : ".$subject."</font></b></span></td>
</tr>
</table>
<table border=\"0\">
<tr>
<td width=\"588\"></td>
</tr>
</table>
<table width=\"95%\" border=\"0\" cellspacing=\"1\" cellpadding=\"0\" bgcolor=\"#B0904A\" align=\"center\">
<tr height=\"180\">
<td bgcolor=\"#F6F3EC\" style=\"padding:10 10 10 10\" valign=\"top\">".$messages."</td>
</tr>
</table>
<br>
</td>
</tr>
<tr>
<td style=\"padding:5px;\" bgcolor=\"ffffff\">
<span style=\"font-size:9pt;\">&nbsp;&nbsp;".$top."
</td>
</tr>
<tr>
<td bgcolor=\"#C7BCA2\" style=\"padding:10 10 10 10\"><span style=\"font-size:9pt;\">".$sub."</span></td>
</tr>
</table>
</body>
</html>";

return $tag;
}
?>	