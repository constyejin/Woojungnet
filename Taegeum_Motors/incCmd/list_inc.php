<?
// 쿼리추가
for ($i=0;$i<sizeof($add);$i++){
	if ($i==0) $addon="where ";
	else $addon.=" and ";
	$addon.=$add[$i];
}

// 순서추가
for ($i=0;$i<sizeof($addq);$i++){
	if ($i==0) $addon2="order by $addq[0]";
	else $addon2.=",".$addq[$i];
}


/*******************************************
				게시판 출력부분
********************************************/
if ($id=="B02"&&!$u_admin){ // 1:1
//	$joinon="left join $id as b on list=b.list";
}



$sql="select count(*) from $dbname $joinon $addon $addon2";



$result=mysql_query($sql) or die(mysql_error());

$trecord=mysql_result($result,0);

$tpage = ceil($trecord/$nperpage); //전체페이지

// 출력 레코드 범위
if($trecord==0) {
	$first=1;
	$last=0;
} else {
	$first=$nperpage*($page-1);
	$last=$nperpage*$page;
}


${"sql_".$dataname}="select $dbname.* from $dbname $joinon $addon $addon2 LIMIT $first, $nperpage";

${"result_".$dataname}=mysql_query(${"sql_".$dataname});

$article_num = $trecord - $nperpage*($page-1); //가상번호 설정

// 각 페이지로 직접 이동할 수 있는 페이지 링크에 대한 설정을 한다.
$tblock = ceil($tpage/$nperblock);
$block = ceil($page/$nperblock);

$first_page = ($block-1)*$nperblock;

$last_page = $block*$nperblock;

if($tblock <= $block) {
   $last_page = $tpage;
}
?>