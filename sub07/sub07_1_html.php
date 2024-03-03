<? include $_SERVER['DOCUMENT_ROOT']."/inc/header_html.php"; ?> 
<script language="JavaScript" src="/admin/inc/default.js"></script>
<script type="text/javascript" src="/common/js/form.js"></script> 

<?
	$tb_name = "woojung_part";

	$view_article = 15; // 한화면에 나타날 게시물의 총 개수  
	if (!$page) $page = 1; // 현재 페이지 지정되지 않았을 경우 1로 지정  
	$start = ($page-1)*$view_article; 

	$nowDate = date("YmdHi");

	$href = "&wc_made=$wc_made&wc_model=$wc_model&wc_model2=$wc_model2&wc_trans=$wc_trans&wc_trans2=$wc_trans2&gubun4=$gubun4&sear4=$sear4"; 

	$where=" 1 ";
	if($wc_made){
	   $where .= " and wc_made = '$wc_made' ";
	}
	if($wc_model){
		$where .= " and wc_model='$wc_model' ";	
	}
	if($wc_model2){
		$where .= " and wc_model2='$wc_model2' ";	
	}
	if($wc_trans){
	   $where .=" and wc_trans='$wc_trans' ";
	}
	if($wc_trans2){
	   $where .=" and wc_fual='$wc_trans2' ";
	}
	if($gubun4){
	   $where .=" and wc_gubun4='$gubun4' ";
	}
	if($sear4){
		$where .= " and ( wc_no  like '%$sear4%' or wc_mem_name like '%$sear4%' or wc_model  like '%$sear4%') ";	
	}

	$qry_cnt = mysql_query("SELECT count(*) FROM woojung_part  WHERE  $where ");
	$temp = mysql_fetch_row($qry_cnt);  
	$total_article = $temp[0]; // 현재 쿼리한 게시물의 총 개수를 구함	


function getImg($content) { 
	preg_match_all('/src=\"(.[^"]+)"/i', $content, $src_location); 
	//print_r($src_location); 
	$pat = str_replace("src=\"", "", $src_location[0][0]); 
	$pat = str_replace("\"", "", $pat); 
	return $pat; 
}
?>

<script>
	function delete_member(){
		

		var j=0;
		var obj = document.getElementsByName('check[]');
		for(var i=0;i < obj.length ; i++){
			if(obj[i].checked == true){
				j++;
				break;
			}
		}
		
		if(j == 0){
			alert("선택된 자료가 없습니다.");
			return;
		}

		result = confirm("한번 삭제하신 자료는 복구 불가능 합니다.\n\n(페차,손상,특수,낙찰대장,감정 등의 정보까지 모두 삭제 됨)   \n\n정말 삭제 하시겠습니까??");
		if(result){
			
			document.f.submit();
		}
		
	}

</script>

<script language="JavaScript" src="/admin/inc/default.js"></script>
<script type="text/javascript" src="/lib/form.js"></script>
<div id="contents_basic">
 
  <div class="co_car_all">

    <div class="sub-visual">
      <div class="sub-text">
        <p class="catch-phrase">
          차량등록
        </p>
        <p class="description-text">
          공정하고 투명하며 신속, 정확한 정보를 제공합니다.
        </p>
      </div>
    </div>
  	

        
    <div class="div_basic">
      <table width="100%" align="center" >

      <tr>
        <td align="center"><table style="width:1200px" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td valign="top">
        <table style="width:1200px"  border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td style="border-bottom:1px solid #979797;padding-bottom:15px;padding-top: 30px;">
                <table style="width:1200px" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td>
                      <div class="search-box">
                        <form name="cform" method="get" style="height:37px">
                          <table border="0" align="right" cellpadding="0" cellspacing="0" style="padding-top:3px; border:1px solid #CCCCCC;">
                            <tr>
                              <td align="right" height="37" style="padding-right: 30px;">
                                <select name="wc_made" onchange="document.cform.submit();" class="form_select">
                                  <option value="">==제조==</option>
                                  <?
                                  $sql="select * from cate2 where depth='1' order by name asc ";
                                  $result_made=mysql_query($sql);
                                  while($data_made=mysql_fetch_array($result_made)){
                                  ?>
                                  <option value="<?=$data_made[idx]?>" <?if($wc_made==$data_made[idx]) echo "selected";?>>
                                  <?=$data_made[name]?>
                                  </option>
                                  <?
                                  }
                                  ?>
                                </select>
                                <select name="wc_model" onchange="document.cform.submit();" class="form_select">
                                  <option value="">==차명1==</option>
                                  <?
                                  if($wc_made){
                                    $sql="select * from cate2 where code='$wc_made' and depth='2' order by name asc";
                                    $result_made=mysql_query($sql);
                                    while($data_made=mysql_fetch_array($result_made)){
                                  ?>
                                  <option value="<?=$data_made[name]?>" <?if($wc_model==$data_made[name]) {echo "selected";}?>>
                                    <?=$data_made[name]?>
                                    </option>
                                  <?
                                      }
                                    }
                                  ?>
                                </select>
                                <select name="wc_trans" onchange="document.cform.submit();" class="form_select">
                                  <option value="">==부품1==</option>
                                    <?
                                      $sql="select * from cate3 where depth='1' order by name asc";
                                      $result_made=mysql_query($sql);
                                      while($data_made=mysql_fetch_array($result_made)){
                                    ?>
                                    <option value="<?=$data_made[idx]?>" <?if($wc_trans==$data_made[idx]) echo "selected";?>>
                                      <?=$data_made[name]?>
                                      </option>
                                    <?
                                      }
                                    ?>
                                </select>
                                <input type="text" name="textfield" class="form_control" />
                                <input type="button" name="button2" value="검색" class="imgbt1" style="cursor:pointer; background-color:#e8eff7; color:#0e3b5d; border:#4e7ac1 1px solid; padding-bottom:3px; font-size:12px; height:25px; padding: 0 10px;"/>
                              </td>
                              <!--<td width="47"  align="right"><img src="/images/s_bt.jpg" width="44" height="21" ></ td>-->
                            </tr>
                          </table>
                        </form>
                      </div>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td height="5" colspan="2"><!--서브내용-->
                  <!--center start-->
              <table width="1200" height="350" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td width="20%"></td><td width="20%"></td><td width="20%"></td><td width="20%"></td><td width="20%"></td>
      </tr>
      <tr>
			  
	<form name="f" action="proc.php" method="post">
        <input type="hidden" name="mode" value="delete">
        <input type="hidden" name="back_url" value="o">
        <input type="hidden" name="gubun4" value="<?=$gubun4?>">
        <input type="hidden" name="page" value="<?=$page?>">
          <?
				$kk=1;
				$num=$total_article-(($page-1)*$view_article)+1;
				$query = mysql_query("SELECT * FROM woojung_part  WHERE  $where order by wc_regdate desc LIMIT $start, $view_article");
				while($row = mysql_fetch_array($query)) {	
					$car_img_arr = explode('/',$row[wc_img_1]);
					$cate1=mysql_fetch_array(mysql_query("select * from cate2 where idx='".$row[wc_made]."'"));
					$cate3=mysql_fetch_array(mysql_query("select * from cate3 where idx='".$row[wc_trans]."'"));
			  ?>
			  
			  <td width="210" height="300"  align="center" style="padding-top:20px;padding-bottom:20px;"><table width="200" border="0"  cellpadding="0" cellspacing="0">
			 
                <tr style="cursor:pointer;" >
                  <td valign="middle" ><table width="185" border="0" align="center" cellpadding="0" cellspacing="0">
                      <tr>
                        <td height="30" align="left" bgcolor="#FFFFFF"><input type="checkbox" name="check[]" id="check[]" value="<?=$row[wc_idx]?>" style="vertical-align:middle"/> 
                        NO : <?=$row[wc_orderno]?></td>
                      </tr>
                      <tr>
                        <td align="left" bgcolor="#FFFFFF" onclick="location.href='sub08_1_view.php?wc_idx=<?=$row[wc_idx]?>'">
						<?if($car_img_arr[0]){?>
						<img src="../data/<?=$car_img_arr[0]?>" width="200" height="160" border="0" />
						<?}else{?> 
						<img src="<?=getImg($row[wc_option_add])?>" width="200" height="160" border="0" />
						<?}?> 
						</td>
                      </tr>
                  </table></td>
                </tr>
                
                <tr style="cursor:pointer;" onclick="location.href='sub08_1_view.php?wc_idx=<?=$row[wc_idx]?>'">
                  <td valign="middle" style="padding-top:5px;">
				  <table width="200" align="left" cellpadding="2" cellspacing="0">
                    <!--tr><Td height="25" align="left"><strong><?=$row[wc_orderno]?></strong></Td>
					  </tr-->
			   <tr>
                      <td height="25" align="left" ><strong><?=$cate3[name]?></strong>                      </td>
                    </tr>
					 <tr>
                      <td height="25" align="left"><strong>
                          <font color="#0066CC"><?=$cate1[name]?>
                          <?if($row[wc_model]) echo "/ ".$row[wc_model];?>
                          </font>                          
						  </strong></td>
                    </tr>
                    <tr>
                      <td height="25" align="left"><strong>년식 : </strong><?=substr($row[wc_age],0,4)?> ㅣ
                        <?=number($row[wc_cc])?>
                        개</td>
                    </tr>
                    <tr>
                      <td height="25" align="left"><strong>가격 :</strong>
                          <font color="#FF0000">
						  <? if($row[wc_cost]=="1"){echo "전화문의";}else{echo number($row[wc_keep_tel1])."원";} ?>
						  </font></td>
                    </tr>
                  </table></td>
                  </tr>
              </table></td>
<?
					if($kk%5==0){
						echo "		<tr><td colspan='5' height='1' bgcolor='#d8d8d8'></td></tr>";
					}
					$kk++;
				}
?>
</form>
            <tr>
              <td colspan="5" height="1" bgcolor="#dedbde"></td>
              </tr>
            </table>
            
            <table width="1200" border="0" align="center" cellpadding="0" cellspacing="0">
            
  <tr>
    <td height="15" align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
  </tr>
        <tr>
          <td width="20%" align="left">
<?
if($loginUsort == "admin" || $loginUsort == "admin2" || $loginUsort == "admin3" || $loginUsort == "superadmin" || $loginUsort == "jisajang2"){
?>
		  <!--<img src="/images/d_bt.jpg" onClick="window.location='javascript:delete_member()'"/>-->
			<a href="javascript:void(0);" onclick="window.location='javascript:delete_member()'" style="display:inline-flex; justify-content: center; align-items:center;border: 2px solid #000000; border-radius: 20px; min-width: 80px; height: 32px;font-size: 12px;font-weight: 600; ">
				선택삭제
			</a>
<?
}
?>
		  </td>
          <td align="center"><table>
            <tr>
            <td>
            <? include "../inc/page.php";?></td>
</tr></table></td>
          <td width="20%" align="right">
<?
if($loginUsort == "admin" || $loginUsort == "admin2" || $loginUsort == "admin3" || $loginUsort == "superadmin" || $loginUsort == "jisajang2"){
?>
		  <!-- <a href="sub08_1_write.php"><img src="/images/w_bt.jpg" /></a> -->
			<a href="sub08_1_write.php" style="display:inline-flex; justify-content: center; align-items:center;border: 2px solid #cc3535; border-radius: 20px; min-width: 80px; height: 32px;font-size: 12px;font-weight: 600;color: #cc3535; ">
				등록하기
			</a>
<?
}
?>
</td>
        </tr>
  <tr>
    <td height="40" align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
  </tr>
</table>
		  <!--서브내용끝--></td>
          </tr>
        </table></td>
	</tr>
	  
      
    </table></td>
  </tr>
</table>
</div>
</div>
	<!-- footer -->
	<div class="cha_footer"><? include "../inc/bottom.php" ?></div>
</div>
</body>
</html>