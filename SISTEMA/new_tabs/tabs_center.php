<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="17" valign="top" background="<?PHP echo $imgsurl; ?>tab_left.png">&nbsp;</td>
    <td align="center" valign="middle" bgcolor="#FFFFFF"><?php if ($_GET[direccion]) { include($_GET[direccion]);} else { include ($tab_primera); } ?></td>
    <td width="17" valign="top" background="<?PHP echo $imgsurl; ?>tab_right.png">&nbsp;</td>
  </tr>
</table>