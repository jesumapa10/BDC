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
    if ($agr_bien_adminis == "") {($agr_bien_adminis = "N");}
    if ($edit_bien_adminis == "") {($edit_bien_adminis = "N");}
    if ($cons_bien_adminis == "") {($cons_bien_adminis = "N");}
    if ($resumen_bien_adminis == "") {($resumen_bien_adminis = "N");}
    if ($nom_alq == "") {($nom_alq = "N");}

    $permisologia = mysql_query("SELECT * FROM bdc_permisos_adminis WHERE codg_usr=$codg_usr");

                    if (mysql_num_rows($permisologia) != 0)
                      {
                              mysql_query("UPDATE bdc_permisos_adminis SET agr_bien_adminis='$agr_bien_adminis',
                                           edit_bien_adminis='$edit_bien_adminis', cons_bien_adminis='$cons_bien_adminis', resumen_bien_adminis='$resumen_bien_adminis',
                                           nom_alq='$nom_alq'
                                           WHERE codg_usr=$codg_usr");

                              echo "<SCRIPT>alert('Registro Actualizado');</SCRIPT>";
                      }

                    if (mysql_num_rows($permisologia) == 0)
                      {
                              $qry = "INSERT INTO bdc_permisos_adminis VALUES ($codg_usr, '$agr_bien_adminis',
                                           '$edit_bien_adminis', '$cons_bien_adminis', '$resumen_bien_adminis', '$nom_alq')";

                              echo $qry;
                              mysql_query ($qry);
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

  $permisos_usuario = mysql_query("SELECT * FROM bdc_permisos_adminis where codg_usr=$codg_usr");
  $permisos = mysql_fetch_array($permisos_usuario);
  $agr_bien_adminis = $permisos["agr_bien_adminis"];
  $edit_bien_adminis = $permisos["edit_bien_adminis"];
  $cons_bien_adminis = $permisos["cons_bien_adminis"];
  $resumen_bien_adminis = $permisos["resumen_bien_adminis"];
  $nom_alq = $permisos["nom_alq"];

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

<SCRIPT>do_tabs("Administración", "")</SCRIPT>

<BR>

<FORM METHOD="POST" NAME="datos" ACTION="bdc_permisos_user_adminis.php">

<TABLE BORDER="0" CELLPADDING="0" ALIGN=CENTER>

        <TR>
        <TD COLSPAN="6">
        <DIV ALIGN="CENTER"><P class="cabecera">M&oacute;dulo de Bienes</P></DIV>
        </TD>
        </TR>

        <TR>
        <TD COLSPAN="6">
        <DIV ALIGN="CENTER"><P class="rojo">Bienes</P></DIV>
        </TD>
        </TR>

        <TR>
        <TD WIDTH="75"><P ALIGN="RIGHT" class="mini">Agregar:</P></TD>
        <TD WIDTH="20"><INPUT TYPE="CHECKBOX" NAME="agr_bien_adminis" class="campo" VALUE="S" <? if ($agr_bien_adminis == "S"){echo 'CHECKED';} ?>></TD>
        <TD WIDTH="75"><P ALIGN="RIGHT" class="mini">Editar:</P></TD>
        <TD WIDTH="20"><INPUT TYPE="CHECKBOX" NAME="edit_bien_adminis" class="campo" VALUE="S" <? if ($edit_bien_adminis == "S"){echo 'CHECKED';} ?>></TD>
        <TD WIDTH="75"><P ALIGN="RIGHT" class="mini">Consultar:</P></TD>
        <TD WIDTH="20"><INPUT TYPE="CHECKBOX" NAME="cons_bien_adminis" class="campo" VALUE="S" <? if ($cons_bien_adminis == "S"){echo 'CHECKED';} ?>></TD>
        <TD WIDTH="75"><P ALIGN="RIGHT" class="mini">Resumen:</P></TD>
        <TD WIDTH="20"><INPUT TYPE="CHECKBOX" NAME="resumen_bien_adminis" class="campo" VALUE="S" <? if ($resumen_bien_adminis == "S"){echo 'CHECKED';} ?>></TD>
        </TR>

         <TR>
        <TD COLSPAN="6">
        <DIV ALIGN="CENTER"><P class="cabecera">Nomina Alquileres</P></DIV>
        </TD>
        </TR>

        <TR>
        <TD WIDTH="75"><P ALIGN="RIGHT" class="mini">Agregar:</P></TD>
        <TD WIDTH="20"><INPUT TYPE="CHECKBOX" NAME="nom_alq" class="campo" VALUE="S" <? if ($nom_alq == "S"){echo 'CHECKED';} ?>></TD>
        <TD WIDTH="75"><P ALIGN="RIGHT" class="mini">Editar:</P></TD>
        <TD WIDTH="20"><INPUT TYPE="CHECKBOX" NAME="edit_bien_adminis" class="campo" VALUE="S" <? if ($edit_bien_adminis == "S"){echo 'CHECKED';} ?>></TD>
        <TD WIDTH="75"><P ALIGN="RIGHT" class="mini">Consultar:</P></TD>
        <TD WIDTH="20"><INPUT TYPE="CHECKBOX" NAME="cons_bien_adminis" class="campo" VALUE="S" <? if ($cons_bien_adminis == "S"){echo 'CHECKED';} ?>></TD>
        <TD WIDTH="75"><P ALIGN="RIGHT" class="mini">Resumen:</P></TD>
        <TD WIDTH="20"><INPUT TYPE="CHECKBOX" NAME="resumen_bien_adminis" class="campo" VALUE="S" <? if ($resumen_bien_adminis == "S"){echo 'CHECKED';} ?>></TD>
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
