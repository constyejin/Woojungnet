<?
include $_SERVER['DOCUMENT_ROOT']."/admin/inc/header.php";

if($category == 'reg'){

				if($ccode) $sql="select code,sortno from config_category where (code >= '".$ccode."01' and code <= '".$ccode."99') and CHAR_LENGTH(code)=".(strlen($ccode)+2)." order by code desc limit 1";
				else $sql="select code,sortno from config_category where CHAR_LENGTH(code)=2 order by code desc limit 1";
				$row = mysql_fetch_array(mysql_query($sql));
				if(!$row[0]){
					if(!$ccode)$row[0]='00';
					else $row[0]=$ccode.'00';
				}
				$incr_code = substr($row[0],-2);
				$incr_len = strlen($row[0]);
				//var_dump($incr_code);
				if($incr_code >= '99') exit('max category');
				$incr_code_str = ++$incr_code;
				if(strlen($incr_code_str)==1){
					$incr_code_str = '0'.$incr_code;
				}
				$incr_rev_code = substr($row[0],0,$incr_len-2);
				$incr_rev_code.=$incr_code_str;

				if($code2){
					$code3=substr($incr_rev_code,4,2);
				}else if($code1){
					$code2=substr($incr_rev_code,2,2);
				}else{
					$code1=$incr_rev_code;
				}
				// 구버전 정렬번호 $row[1]+1
				mysql_query("insert into config_category(code,name,sortno,code1,code2,code3) values('$incr_rev_code','$cname','1','$code1','$code2','$code3')")or die(mysql_error()); 
				$gopage = "sub02.php&ccode=".$ccode."&".time();
				$bookm = "#cate";
				echo "<script>parent.top.document.location.reload();</script>";
				exit;
}
if($category == 'edit'){
	mysql_query("update config_category set name='".$name."',sortno='".$sortno."' where code ='$code'");
	echo "<script>parent.location.href='sub01.php?ccode=".$ccode."';</script>";
	exit;
}
if($category == "del"){
	mysql_query("delete from config_category where code ='$code'");
	echo "<script>parent.top.document.location.reload();</script>";
	exit;
}

if($category == "sort"){
	$sql="select * from config_category where code='$code'";
	$res=mysql_query($sql,$connect);
	$data=mysql_fetch_array($res);

	if ($down) {//증가
	$starts=$data[sortno]+1;
	$ends=$data[sortno];
	} elseif ($up) {//감소
	$starts=$data[sortno]-1;
	$ends=$data[sortno];
	}
	
	$sql="update config_category set sortno='$ends' where (code >= '".substr($code,0,-2)."01' and code <= '".substr($code,0,-2)."99') and CHAR_LENGTH(code)=".strlen($code)." and sortno='$starts'"; //대상업데이트
	//exit($sql);
	$res=mysql_query($sql,$connect);
	$sql="update config_category set sortno='$starts' where code='$code'"; //자기업데이트
	
	$res1=mysql_query($sql,$connect);

	echo "<script>parent.top.location.href='/admin/sub03/sub01.php?ccode=".$ccode."'</script>";
	exit;
}
dbclose();
?>
<script>
		parent.top.document.location.reload();
</script>