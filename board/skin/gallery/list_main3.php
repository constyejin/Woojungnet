    <td>
	<a href='<?=$PHP_SELF?>?id=<?=$id?>&no=<?=$bu[no]?>&mode=view'><img src="/board/data/<?=$id?>/<?=$file_name[0]?>" class="Pic" /></a><br />
	<div class="mt5 a_C" align="center">
	<?
	if($_SESSION[login_level]=="1"){
	?>
	<input type="checkbox" class="Chk" name='chk[]' id='chk[]' value='<?=$bu[no]?>'> 
	<? } ?>
	 <?=$mysubject?></div>
	</td>
    <td></td>
<?if(!($gall_count%4)){?>
  </tr>
<tr>
  <td height="10" colspan="7"></td>
</tr>
<tr>
<?}?>
