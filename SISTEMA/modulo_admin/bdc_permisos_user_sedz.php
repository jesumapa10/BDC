<?
  include ("../sesion.php");

  include ("../conex.php");
?>

<HTML>
<HEAD>
        <LINK REL="STYLESHEET" HREF="../style/normal.css" TYPE="text/css">

        <SCRIPT LANGUAGE="JavaScript" SRC="../scripts/validar.js" TYPE="text/javascript"></SCRIPT>

<?
  include ("tabs/tabs_permisos.php");
?>
</HEAD>

<BR><BR>
<H2>Permisos de Usuario</H2>

<?
if ($action == "upd")
  {
    if ($agr_beca_sedz == "") {($agr_beca_sedz = "N");}
    if ($edit_beca_sedz == "") {($edit_beca_sedz = "N");}
    if ($cons_beca_sedz == "") {($cons_beca_sedz = "N");}

    $permisologia = mysql_query("SELECT * FROM bdc_permisos_sedz WHERE codg_usr=$codg_usr");

                    if (mysql_num_rows($permisologia) != 0)
                      {
                              mysql_query("UPDATE bdc_permisos_sedz SET agr_beca_sedz='$agr_beca_sedz',
                                           edit_beca_sedz='$edit_beca_sedz', cons_beca_sedz='$cons_beca_sedz'
                                           WHERE codg_usr=$codg_usr");

                              echo "<SCRIPT>alert('Registro Actualizado');</SCRIPT>";
                      }

                    if (mysql_num_rows($permisologia) == 0)
                      {
                              mysql_query("INSERT INTO bdc_permisos_sedz VALUES ($codg_usr, '$agr_beca_sedz',
                                           '$edit_beca_sedz', '$cons_beca_sedz')");

                              echo "<SCRIPT>alert('Registro Actualizado');</SCRIPT>";
                      }
  }

  $datos_usuario = mysql_query("SELECT nomb_usr, apel_usr, codg_grp FROM bdc_usuarios WHERE codg_usr=$codg_usr");
  $usuario = mysql_fetch_array($datos_usuario);
  $nomb_usr = $usuario["nomb_usr"];
  $apel_usr = $usuario["apel_usr"];
  $codg_grp = $usuario["codg_grp"];

  $nombre_grupo = mysql_query("SELECT nomb_grp FROM bdc_grupos WHERE codg_grp=$codg_grp");
  $grupo = mysql_fetch_array($nombre_grupo);
  $nomb_grp = $grupo["nomb_grp"];

  $permisos_usuario = mysql_query("SELECT * FROM bdc_permisos_sedz where codg_usr=$codg_usr");
  $permisos = mysql_fetch_array($permisos_usuario);
  $agr_beca_sedz = $permisos["agr_beca_sedz"];
  $edit_beca_sedz = $permisos["edit_beca_sedz"];
  $cons_beca_sedz = $permisos["cons_beca_sedz"];

?>


<TABLE ALIGN="CENTER">
<TR>
<TD>
<P ALIGN="CENTER" class="mini">Nombre(s) y Apellido(s):</P>
</TD>

<TD>
<P ALIGN="CENTER" class="campo"><? echo $nomb_usr; ?>&nbsp;<? echo $apel_usr; ?>&nbsp;&nbsp;&nbsp;&nbsp;</P>
</TD>

<TD>
<P ALIGN="CENTER" class="mini">C&eacute;dula:</P>
</TD>

<TD>
<P ALIGN="CENTER" class="campo">V&nbsp;-&nbsp;<? echo number_format($codg_usr ,0 , "," ,"."); ?>&nbsp;&nbsp;&nbsp;&nbsp;</P>
</TD>

<TD>
<P ALIGN="CENTER" class="mini">Grupo:</P>
</TD>

<TD>
<P ALIGN="CENTER" class="campo"><? echo $nomb_grp; ?></P>
</TD>
</TR>
</TABLE>

<BR>

<SCRIPT>do_tabs("Sedes Zonales", "")</SCRIPT>

<BR>

<FORM METHOD="POST" NAME="datos" ACTION="bdc_permisos_user_sedz.php">

<TABLE BORDER="0" CELLPADDING="0" ALIGN=CENTER>

        <TR>
        <TD COLSPAN="6">
        <DIV ALIGN="CENTER"><P class="cabecera">M&oacute;dulo de Becas</P></DIV>
        </TD>
        </TR>

        <TR>
        <TD COLSPAN="6">
        <DIV ALIGN="CENTER"><P class="rojo">Becas</P></DIV>
        </TD>
        </TR>

        <TR>
        <TD WIDTH="75"><P ALIGN="RIGHT" class="mini">Agregar:</P></TD>
        <TD WIDTH="20"><INPUT TYPE="CHECKBOX" NAME="agr_beca_sedz" class="campo" VALUE="S" <? if ($agr_beca_sedz == "S"){echo 'CHECKED';} ?>></TD>
        <TD WIDTH="75"><P ALIGN="RIGHT" class="mini">Editar:</P></TD>
        <TD WIDTH="20"><INPUT TYPE="CHECKBOX" NAME="edit_beca_sedz" class="campo" VALUE="S" <? if ($edit_beca_sedz == "S"){echo 'CHECKED';} ?>></TD>
        <TD WIDTH="75"><P ALIGN="RIGHT" class="mini">Consultar:</P></TD>
        <TD WIDTH="20"><INPUT TYPE="CHECKBOX" NAME="cons_beca_sedz" class="campo" VALUE="S" <? if ($cons_beca_sedz == "S"){echo 'CHECKED';} ?>></TD>
        </TR>

        <TR></TR>

        <TR>
        <TD COLSPAN="6"><CENTER><INPUT TYPE="SUBMIT" VALUE="Actualizar" class="mini"></CENTER></TD>
        </TR>

</TABLE>

<INPUT TYPE="HIDDEN" NAME="action" VALUE="upd">
<INPUT TYPE="HIDDEN" NAME="codg_usr" VALUE="<? echo $codg_usr; ?>">

</FORM>

</HTML>
