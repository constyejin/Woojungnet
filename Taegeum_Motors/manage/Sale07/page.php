<table width=100% border="0" cellpadding="0" cellspacing="0">
  <tr><td align=center > 
<? 

// 전페 페이지 구함. ceil() 올림함수  
$total_page    = ceil($total_article / $view_article);  

// 이전 페이지값 구함 (1보다 작을 경우 1로 지정)  
$prev_page = $page - 1;  
if ($prev_page < 1) $prev_page = 1;  

// 다음 페이지값 구함 (전체페이지값 넘으면 전체페이지값으로 지정)  
$next_page = $page + 1;  
if ($next_page > $total_page) $next_page = $total_page;  

// 페이지 인덱스의 시작과 종료 범위 구함  
if ($page%10) $start_page = $page - $page%10 + 1;  
else          $start_page = $page - 9;  
$end_page = $start_page + 10;  

// 이전 페이지 그룹을 지정  
$prev_group = $start_page - 1;  
if ($prev_group < 1) $prev_group = 1;  

// 다음 페이지 그룹을 지정  
$next_group = $end_page;  
if ($next_group > $total_page) $next_group = $total_page;  

// 처음 페이지, 이전 페이지 그룹, 이전 페이지 출력  
// 만약 현재 페이지가 1이라면 링크 없이 출력  
 
if ($page != 1)           echo "[<a href=".$PHP_SELF."?page=1".urlencode($href).">맨처음</a>] ";  
else                      echo "[맨처음] ";  
 
if ($page != 1)           echo "[<a href=".$PHP_SELF."?page=".$prev_group.urlencode($href).">이전</a>] ";  
// else                      echo "[<<] ";  
/* 
if ($page != 1)           echo "[<a href=$PHP_SELF?page=$prev_page$href><</a>]";  
else                      echo "[ < ] ";  
*/ 
// 페이지 인덱스의 일정 범위 출력  
for ($i=$start_page; $i<$end_page; $i++) {  
  if ($i>$total_page) break;  
  if ($i==$page) echo " <b>$i</b> ";  
  else           echo "[<a href=".$PHP_SELF."?page=".$i.$href.">$i</a>] ";
  //else           echo "[<a href=".$PHP_SELF."?page=".$i.$href.">$i</a>] ";
  //else			 echo $href;  
}  

/* 
// 다음 페이지, 다음 페이지 그룹, 마지막 페이지 출력  
if ($page != $total_page) echo "  [<a href=$PHP_SELF?page=$next_page$href>></a>]   ";  
else                      echo "  [>]   ";  
*/ 
if ($page != $total_page) echo "  [<a href=".$PHP_SELF."?page=".$next_group.$href.">다음</a>]   ";  
//else                      echo "  [>>]   ";  
 
if ($page != $total_page) echo "  [<a href=".$PHP_SELF."?page=".$total_page.$href.">마지막</a>]  ";  
else                      echo "  [마지막]   ";  
 
?>  

</td></tr></table> 

