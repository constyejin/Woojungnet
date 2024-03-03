
<table width="100%" height="100%" border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
<td>
<br><br><br><br><br><br><br><br>
<table width="300" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr> 
        <td height="2" bgcolor="AC9855"></td>
    </tr>
</table>

<table width="300" border="0" align="center" cellpadding="0" cellspacing="0">
<form onSubmit='return askPassword(this);' name='deleteForm' method='POST'>
    <tr> 
        <td bgcolor="F5F5F5">&nbsp;</td>
    </tr>

    <tr> 
        <td align="center" bgcolor="F5F5F5">
            <table width="260" border="0" cellspacing="0" cellpadding="0">
                <tr> 
                    <td height="10"></td>
                </tr>
                <tr> 
                    <td height="1" bgcolor="E5E5E5"></td>
                </tr>
                <tr> 
                    <td height="1" bgcolor="#FFFFFF"></td>
                </tr>
                <tr> 
                    <td height="10"></td>
                </tr>
            </table>
        </td>
    </tr>
    <tr> 
        <td align="center" bgcolor="F5F5F5">
        <?=$hide_password_s?>
        <img src="<?=$skinDir?>images/pass.gif" width="36" height="11" align="absmiddle"> 
        <input type="password" name="password" class="textarea_01" size="15">
        <?=$hide_password_e?>
        <input type='image' src="<?=$skinDir?>images/button_ok_pass.gif" width="49" height="19" align="absmiddle">
        </td>
    </tr>
    <tr>
        <td bgcolor="F5F5F5">&nbsp;</td>
    </tr>
    <tr> 
        <td height="1" bgcolor="dddddd"></td>
    </tr>
    </form>
</table>

</td>
</tr>
</table>