
<table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr> 

        <?=$show_admin_yn_s?><?// chk값은 어드민 계정을 이용한 자료 이동및 관리를 위해 사용됩니다.
                               // 1. checkbox 이름 ::> chk
                               // 2. value         ::> $no ?>
        <td width="5%" height="30" align="center"><input type="checkbox" name="chk" value="<?=$admin_no?>"></td>
        <?=$show_admin_yn_e?>

        <?=$hide_no_s      ?>
        <td width="40" align="center"><?=$print_no?></td>
        <?=$hide_no_e      ?>

        <td>

        &nbsp;&nbsp;
        <?=$hide_category_s     ?><?=$a_cat_search?>[<?=$cat_name?>]</a><?=$hide_category_e     ?>
        <?=$a_view?><?=$title?></a>
        <?=$total_comment?>
        <?=$hide_comment_icon_s?><?=$new_comment_tag?><?=$hide_comment_icon_e?>
        <?=$hide_new_s?><img src="<?=$skinDir?>images/ico_new.gif"><?=$hide_new_e?>
        <?=$hide_open_s?><img src='<?=$skinDir?>images/icon_sec.gif' border='0'><?=$hide_open_e?>

        </td>

        <?=$hide_name_s    ?>
        <td width="70" align="center" class=text_03><b>
            
        <?=$character?>
        <?=$a_e_mail?><?=$name?></a>
        <?
        //$a_e_mail
        //$a_member_layer_box
        //$a_member_view
        ?>

        </b></td>
        <?=$hide_name_e    ?>

        <?=$hide_reg_date_s?>
        <td width="70" align="center"><?=$reg_year?>.<?=$reg_month?>.<?=$reg_day?></td>
        <?=$hide_reg_date_e?>

        <?=$hide_file1_s?>
        <td width="40" align="center"><?=$a_file1?><img src="<?=$skinDir?>images/ico_file.gif" width="9" height="11" border='0'></a></td>
        <?=$hide_file1_e?>

        <?=$hide_down_hit1_s?>
        <td width="40" align="center"><?=$down_hit1?></td>
        <?=$hide_down_hit1_e?>

        <?=$hide_hit_s?>
        <td width="40" align="center"><?=$hit?></td>
        <?=$hide_hit_e?>

    </tr>
    <tr bgcolor="eeeeee"> 
        <td height="1" colspan="15" align="center"></td>
    </tr>
</table>