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
    if ($cambio_cont_util == "") {($cambio_cont_util = "N");}
    if ($reg_acce_cen_util == "") {($reg_acce_cen_util = "N");}
    if ($reg_acce_uni_util == "") {($reg_acce_uni_util = "N");}
    if ($ver_acce_usr_util == "") {($ver_acce_usr_util = "N");}
    if ($agr_obsr_acce_util == "") {($agr_obsr_acce_util = "N");}
    if ($ver_acce_grp_util == "") {($ver_acce_grp_util = "N");}
    if ($agen_agr_util == "") {($agen_agr_util = "N");}
    if ($agen_con_util == "") {($agen_con_util = "N");}
    if ($agen_edi_util == "") {($agen_edi_util = "N");}
    if ($agen_rep_util == "") {($agen_rep_util = "N");}
    if ($agen_edij_util == "") {($agen_edij_util = "N");}

    $permisologia = mysql_query("SELECT * FROM bdc_permisos_util WHERE codg_usr=$codg_usr");

                    if (mysql_num_rows($permisologia) != 0)
                      {
                              mysql_query("UPDATE bdc_permisos_util SET cambio_cont_util='$cambio_cont_util',
                                           reg_acce_cen_util='$reg_acce_cen_util', reg_acce_uni_util='$reg_acce_uni_util',
                                           ver_acce_usr_util='$ver_acce_usr_util', agr_obsr_acce_util='$agr_obsr_acce_util',
                                           ver_acce_grp_util='$ver_acce_grp_util', agen_agr_util='$agen_agr_util',
                                           agen_con_util='$agen_con_util', agen_edi_util='$agen_edi_util',
                                           agen_rep_util='$agen_rep_util', agen_edij_util='$agen_edij_util'
                                           WHERE codg_usr=$codg_usr");

                              echo "<SCRIPT>alert('Registro Actualizado');</SCRIPT>";
                      }

                    if (mysql_num_rows($permisologia) == 0)
                      {
                              mysql_query("INSERT INTO bdc_permisos_util VALUES ($codg_usr, '$cambio_cont_util',
                                           '$reg_acce_cen_util', '$reg_acce_uni_util', '$ver_acce_usr_util',
                                           '$agr_obsr_acce_util', '$ver_acce_grp_util', '$agen_agr_util',
                                           '$agen_con_util', '$agen_edi_util', '$agen_rep_util', '$agen_edij_util')");

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

  $permisos_usuario = mysql_query("SELECT * FROM bdc_permisos_util where codg_usr=$codg_usr");
  $permisos = mysql_fetch_array($permisos_usuario);
  $cambio_cont_util = $permisos["cambio_cont_util"];
  $reg_acce_cen_util = $permisos["reg_acce_cen_util"];
  $reg_acce_uni_util = $permisos["reg_acce_uni_util"];
  $ver_acce_usr_util = $permisos["ver_acce_usr_util"];
  $agr_obsr_acce_util = $permisos["agr_obsr_acce_util"];
  $ver_acce_grp_util = $permisos["ver_acce_grp_util"];
  $agen_agr_util = $permisos["agen_agr_util"];
  $agen_con_util = $permisos["agen_con_util"];
  $agen_edi_util = $permisos["agen_edi_util"];
  $agen_rep_util = $permisos["agen_rep_util"];
  $agen_edij_util = $permisos["agen_edij_util"];
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

<SCRIPT>do_tabs("Utilidades", "")</SCRIPT>

<BR>

<FORM METHOD="POST" NAME="datos" ACTION="bdc_permisos_user_util.php">

<TABLE BORDER="0" CELLPADDING="0" ALIGN=CENTER>

        <TR>
        <TD COLSPAN="2">
        <DIV ALIGN="CENTER"><P class="cabecera">Utilidades</P></DIV>
        </TD>
        </TR>

        <TR>
        <TD WIDTH="190"><P ALIGN="RIGHT" class="mini">Cambio de Contraseña:</P></TD>
        <TD WIDTH="95"><INPUT TYPE="CHECKBOX" NAME="cambio_cont_util" class="campo" VALUE="S" <? if ($cambio_cont_util == "S"){echo 'CHECKED';} ?>></TD>
        </TR>

        <TR></TR>

        <TR>
        <TD COLSPAN="2">
        <DIV ALIGN="CENTER"><P class="cabecera">Control de Acceso</P></DIV>
        </TD>
        </TR>

        <TR>
        <TD WIDTH="190"><P ALIGN="RIGHT" class="mini">Registrar Acceso Central:</P></TD>
        <TD WIDTH="95"><INPUT TYPE="CHECKBOX" NAME="reg_acce_cen_util" class="campo" VALUE="S" <? if ($reg_acce_cen_util == "S"){echo 'CHECKED';} ?>></TD>
        </TR>

        <TR>
        <TD WIDTH="190"><P ALIGN="RIGHT" class="mini">Registrar Acceso por Usuario:</P></TD>
        <TD WIDTH="95"><INPUT TYPE="CHECKBOX" NAME="reg_acce_uni_util" class="campo" VALUE="S" <? if ($reg_acce_uni_util == "S"){echo 'CHECKED';} ?>></TD>
        </TR>

        <TR>
        <TD WIDTH="190"><P ALIGN="RIGHT" class="mini">Verificar Acceso por Usuario:</P></TD>
        <TD WIDTH="95"><INPUT TYPE="CHECKBOX" NAME="ver_acce_usr_util" class="campo" VALUE="S" <? if ($ver_acce_usr_util == "S"){echo 'CHECKED';} ?>></TD>
        </TR>

        <TR>
        <TD WIDTH="190"><P ALIGN="RIGHT" class="mini">Agregar Observaci&oacute;n:</P></TD>
        <TD WIDTH="95"><INPUT TYPE="CHECKBOX" NAME="agr_obsr_acce_util" class="campo" VALUE="S" <? if ($agr_obsr_acce_util == "S"){echo 'CHECKED';} ?>></TD>
        </TR>

        <TR>
        <TD WIDTH="190"><P ALIGN="RIGHT" class="mini">Verificar Acceso por Grupo:</P></TD>
        <TD WIDTH="95"><INPUT TYPE="CHECKBOX" NAME="ver_acce_grp_util" class="campo" VALUE="S" <? if ($ver_acce_grp_util == "S"){echo 'CHECKED';} ?>></TD>
        </TR>

        <TR>
        <TD COLSPAN="2">
        <DIV ALIGN="CENTER"><P class="cabecera">Agenda Telefonica</P></DIV>
        </TD>
        </TR>

        <TR>
        <TD WIDTH="190"><P ALIGN="RIGHT" class="mini">Agregar:</P></TD>
        <TD WIDTH="95"><INPUT TYPE="CHECKBOX" NAME="agen_agr_util" class="campo" VALUE="S" <? if ($agen_agr_util == "S"){echo 'CHECKED';} ?>></TD>
        </TR>

        <TR>
        <TD WIDTH="190"><P ALIGN="RIGHT" class="mini">Consultar:</P></TD>
        <TD WIDTH="95"><INPUT TYPE="CHECKBOX" NAME="agen_con_util" class="campo" VALUE="S" <? if ($agen_con_util == "S"){echo 'CHECKED';} ?>></TD>
        </TR>

        <TR>
        <TD WIDTH="190"><P ALIGN="RIGHT" class="mini">Editar:</P></TD>
        <TD WIDTH="95"><INPUT TYPE="CHECKBOX" NAME="agen_edi_util" class="campo" VALUE="S" <? if ($agen_edi_util == "S"){echo 'CHECKED';} ?>></TD>
        </TR>

        <TR>
        <TD WIDTH="190"><P ALIGN="RIGHT" class="mini">Reporte:</P></TD>
        <TD WIDTH="95"><INPUT TYPE="CHECKBOX" NAME="agen_rep_util" class="campo" VALUE="S" <? if ($agen_rep_util == "S"){echo 'CHECKED';} ?>></TD>
        </TR>

        <TR>
        <TD WIDTH="190"><P ALIGN="RIGHT" class="mini">Consulta Jefes:</P></TD>
        <TD WIDTH="95"><INPUT TYPE="CHECKBOX" NAME="agen_edij_util" class="campo" VALUE="S" <? if ($agen_edij_util == "S"){echo 'CHECKED';} ?>></TD>
        </TR>

        <TR></TR>

        <TR>
        <TD COLSPAN="2"><CENTER><INPUT TYPE="SUBMIT" VALUE="Actualizar" class="mini"></CENTER></TD>
        </TR>

</TABLE>

<INPUT TYPE="HIDDEN" NAME="action" VALUE="upd">
<INPUT TYPE="HIDDEN" NAME="codg_usr" VALUE="<? echo $codg_usr; ?>">

</FORM>

</HTML>
