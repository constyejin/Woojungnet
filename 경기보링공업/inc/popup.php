<script>
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
</script>

<?
$popup=sql_list("select * from popup where pop_view='O' order by idx desc ");
for($i=0;$i<count($popup);$i++){
	if($popup[pop_scroll]=="yes"){
		$addw="17";
	}else{
		$addw="0";
	}
?>
<script>
main_pop_up('<?=$popup[$i][idx]?>','/inc/popup_show.php?vno=<?=$popup[$i][idx]?>','width=<?=$popup[$i][pop_width]+$addw?>, height=<?=$popup[$i][pop_height]+26+$addh?>, resizable=no, scrollbars=<?=$popup[$i][pop_scroll]?>,left=<?=$popup[$i][pop_left]?>, top=<?=$popup[$i][pop_top]?>');
</script>
<?
}
?>