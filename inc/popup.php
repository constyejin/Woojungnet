<?
$pop_result=mysql_query("select * from js_popup where pop_app='1' and site_code='branch00' ");
?>
<script language="JavaScript">
<!--
function getCookieVal (offset) {
   var endstr = document.cookie.indexOf (";", offset);
   if (endstr == -1)
      endstr = document.cookie.length;
   return unescape(document.cookie.substring(offset, endstr));
}

function getCookie (name) {
   var arg = name + "=";
   var alen = arg.length;
   var clen = document.cookie.length;
   var i = 0;
   while (i < clen) {
      var j = i + alen;
      if (document.cookie.substring(i, j) == arg)
         return getCookieVal (j);
      i = document.cookie.indexOf(" ", i) + 1;
      if (i == 0) 
         break; 
   }
   return null;
}


function main_pop_up(name,ref,option) {
  if (getCookie(name) != 'deny') {
    window.open(ref,name,option);
  }
}
<?
$i=1;
	while ($pop=mysql_fetch_array($pop_result)){
		if (!$pop[pop_oneday]&&!$pop[pop_close]) $addh=0;
		else $addh=15;
?>
main_pop_up('<?=$pop[pop_no]?>','/inc/popup_show.php?vno=<?=$pop[pop_no]?>','width=<?=$pop[pop_x]+2?>, height=<?=$pop[pop_y]+26+$addh?>, resizable=no, scrollbars=<?=$pop[pop_scroll]?>,left=<?=$pop[pop_left]?>, top=<?=$pop[pop_right]?>');
<?
$i++;
}?>
-->
</script>