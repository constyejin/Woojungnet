<?
	include "../inc/header.php";
	$connect = dbconn();		
	
	$idx = $_GET[idx];
?>

<script type="text/javascript" src="/common/js/form.js"></script>

<link href="../../css/admin.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" type="text/javascript" src="/nfupload/NFUpload/nfupload.js?d=20081028"></script>
<script language="JavaScript" type="text/javascript">
function delete_member(){
		

		result = confirm("한번 삭제하신 자료는 복구 불가능 합니다 \n정말 삭제 하시겠습니까??");
		if(result){
			
			document.f.submit();
		}
		
	}	
	
	
	function all_check(){
		if(document.f.allcheck.checked == true){
			for(i=0;i<30;i++){
				document.f[i].checked = true;
			}
		} else {
			for(i=0;i<30;i++){
				document.f[i].checked = false;
			}
		}
	}
</script>



<style type="text/css">
	.style1 {font-size: 12px}
</style>
<link href="../css/style.css" rel="stylesheet" type="text/css" />
 
<table width="98%" border="0">
  <tr>
    <td height="63">
     
    
    
    
    
    </form>
    </td>
    
  
    <td><table width="217" border="0" align="left">
        <form name='f' method='post' action='image_update.php' enctype="multipart/form-data" >
							 <input type="hidden" name="mode" id="mode" value="insert">
							 <input type="hidden" name="idx" id="out_idx" value="<?=$idx?>">
							  <input type="hidden" name="hidFileName"/>
      <tr>
        
        
        
        
        <?	
        	$cnt = 0;
        	
        	
        	
	
	$info = Row_string("SELECT * FROM woojung_picture WHERE idx  = '$idx'");


	$site_u = mysql_fetch_array(mysql_query("select * from recruit where code='".$info[code]."' "));

	for($i=1; $i<=24; $i++) {
			
		
		$file_name = 'car_img'.$i;
		$real_name = explode('/',$info[$file_name]);
		$fileName = 'file'.$i;
		if(strlen($real_name[0]) == 0)
		{
			$fileName = 'noImage_auction.gif';
		}
		else
		{
			$fileName = $real_name[0];
		}

		$name = $real_name[1];
	
		if($cnt%6 == 0){ echo '</tr><tr>';}
        ?>
		
	        <td><!--이미지 시작 -->
	            <table border="0" width="126" cellpadding="0" cellspacing="0" align="center">           
	            
	               
	              <tr>
	                <td width="10%" align="center"><table border="0" width="120" height="100" cellpadding="2" cellspacing="5" bgcolor="#E6E6E6">
	                    <tr>
	                      <td bgcolor="white" align="center"><!--실제 사진 시작 -->
	                          <img src="/data/<?=$fileName?>" name="bt01" width="100" height="100" border="0" id="bt01" /> 
	                          <!--실제 사진 끝 -->
	                          <br />
	                      </td>
	                    </tr>
	                  </table>
	                    <table border="0" width="100%" cellpadding="5" cellspacing="0">
	                      <tr>
	                        
                      <td width="53%"> 
                        <input type="checkbox" name="check[<?=$i?>]" id="check[<?=$i?>]" value="1"  />
                        <span class="style1">
                        <?=$cnt+1?>번</span> <br />
	                        </td>
	                        <td width="47%" align="right">
					  
					  <a href="./fileDown.php?tmp_name=<?=$fileName?>&name=<?=$name?>" ><img src="../img/btn_down.gif" border="0" align="absmiddle" /></a>


                        </td>
	                      </tr>
	                  </table></td>
	              </tr>
	              <tr>
	                <td height="10"></td>
	              </tr>             
	            </table>
          <!--이미지 끝 --></td>
          
          <? $cnt++;}  
          ?>
        
      </tr>
    </table></td>
  </tr>
</table>



                          
                          	<tr>
        				
      				</tr>
			      <tr>
			        <td height="5"></td>
			      </tr>
<tr>
        
        <!-- [End] NFUpload 객체 생성 (폼태그안에 들어가면 안됨!) --></td>
  
    	<br>    	
    	<br>    	
    
 			
                            <td align="center">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td align="center" valign="top"><input type="button" name="button3" value="선택삭제" class="button33333"  style="cursor:pointer; background-color:#FFFFFF; color:#000000; border:#636563 1px solid; font-weight:bold" onclick="delete_member()"/>&nbsp;<input type="button" name="button" value="창닫기" class="button33333" onclick="javascript:self.close();" style="cursor:pointer; background-color:#000000; color:#ffffff; border:#636563 1px solid; font-weight:bold" /></td>
                              </tr>
                            </table></td>
                        
        
      </tr>
    </table>  		



