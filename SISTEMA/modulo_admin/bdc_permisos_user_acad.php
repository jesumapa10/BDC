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
    if ($agr_anio_esc_acad == "") {($agr_anio_esc_acad = "N");}
    if ($edit_anio_esc_acad == "") {($edit_anio_esc_acad = "N");}
    if ($agr_cal_esc_acad == "") {($agr_cal_esc_acad = "N");}
    if ($edit_cal_esc_acad == "") {($edit_cal_esc_acad = "N");}
    if ($agr_cuad_men_acad == "") {($agr_cuad_men_acad = "N");}
    if ($edit_cuad_men_acad == "") {($edit_cuad_men_acad = "N");}
    if ($cons_cuad_men_acad == "") {($cons_cuad_men_acad = "N");}
    if ($agr_res_est_acad == "") {($agr_res_est_acad = "N");}
    if ($edit_res_est_acad == "") {($edit_res_est_acad = "N");}
    if ($cons_res_est_acad == "") {($cons_res_est_acad = "N");}
    if ($agr_insti_eval_acad == "") {($agr_insti_eval_acad = "N");}
    if ($edit_insti_eval_acad == "") {($edit_insti_eval_acad = "N");}
    if ($cons_insti_eval_acad == "") {($cons_insti_eval_acad = "N");}
    if ($agr_inf_ucd_acad == "") {($agr_inf_ucd_acad = "N");}
    if ($edit_inf_ucd_acad == "") {($edit_inf_ucd_acad = "N");}
    if ($cons_inf_ucd_acad == "") {($cons_inf_ucd_acad = "N");}
    if ($agr_inf_final_ucd_acad == "") {($agr_inf_final_ucd_acad = "N");}
    if ($edit_inf_final_ucd_acad == "") {($edit_inf_final_ucd_acad = "N");}
    if ($cons_inf_final_ucd_acad == "") {($cons_inf_final_ucd_acad = "N");}
        if ($agr_eii_acad == "") {($agr_eii_acad = "N");}
    if ($edit_eii_acad == "") {($edit_eii_acad = "N");}
    if ($cons_eii_acad == "") {($cons_eii_acad = "N");}

    $permisologia = mysql_query("SELECT * FROM bdc_permisos_acad WHERE codg_usr=$codg_usr");

                    if (mysql_num_rows($permisologia) != 0)
                      {
                              mysql_query("UPDATE bdc_permisos_acad SET agr_anio_esc_acad='$agr_anio_esc_acad',
                                           edit_anio_esc_acad='$edit_anio_esc_acad', agr_cal_esc_acad='$agr_cal_esc_acad',
                                           edit_cal_esc_acad='$edit_cal_esc_acad', agr_cuad_men_acad='$agr_cuad_men_acad',
                                           edit_cuad_men_acad='$edit_cuad_men_acad', cons_cuad_men_acad='$cons_cuad_men_acad',
                                           agr_res_est_acad='$agr_res_est_acad', edit_res_est_acad='$edit_res_est_acad',
                                           cons_res_est_acad='$cons_res_est_acad', agr_insti_eval_acad='$agr_insti_eval_acad',
                                           edit_insti_eval_acad='$edit_insti_eval_acad', cons_insti_eval_acad='$cons_insti_eval_acad',
                                           agr_inf_ucd_acad='$agr_inf_ucd_acad', edit_inf_ucd_acad='$edit_inf_ucd_acad',
                                           cons_inf_ucd_acad='$cons_inf_ucd_acad', agr_inf_final_ucd_acad='$agr_inf_final_ucd_acad',
                                           edit_inf_final_ucd_acad='$edit_inf_final_ucd_acad', cons_inf_final_ucd_acad='$cons_inf_final_ucd_acad',
                                                                                   agr_eii_acad='$agr_eii_acad', edit_eii_acad='$edit_eii_acad', cons_eii_acad='$cons_eii_acad'
                                           WHERE codg_usr=$codg_usr");

                              echo "<SCRIPT>alert('Registro Actualizado');</SCRIPT>";
                      }

                    if (mysql_num_rows($permisologia) == 0)
                      {
                              mysql_query("INSERT INTO bdc_permisos_acad VALUES ($codg_usr, '$agr_anio_esc_acad',
                                           '$edit_anio_esc_acad', '$agr_cal_esc_acad', '$edit_cal_esc_acad',
                                           '$agr_cuad_men_acad', '$edit_cuad_men_acad', '$cons_cuad_men_acad',
                                           '$agr_res_est_acad', '$edit_res_est_acad', '$cons_res_est_acad',
                                           '$agr_insti_eval_acad', '$edit_insti_eval_acad', '$cons_insti_eval_acad',
                                           '$agr_inf_ucd_acad', '$edit_inf_ucd_acad', '$cons_inf_ucd_acad',
                                           '$agr_inf_final_ucd_acad', '$edit_inf_final_ucd_acad',
                                           '$cons_inf_final_ucd_acad', '$agr_eii_acad', '$edit_eii_acad',
                                           '$cons_eii_acad')");

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

  $permisos_usuario = mysql_query("SELECT * FROM bdc_permisos_acad where codg_usr=$codg_usr");
  $permisos = mysql_fetch_array($permisos_usuario);
  $agr_anio_esc_acad = $permisos["agr_anio_esc_acad"];
  $edit_anio_esc_acad = $permisos["edit_anio_esc_acad"];
  $agr_cal_esc_acad = $permisos["agr_cal_esc_acad"];
  $edit_cal_esc_acad = $permisos["edit_cal_esc_acad"];
  $agr_cuad_men_acad = $permisos["agr_cuad_men_acad"];
  $edit_cuad_men_acad = $permisos["edit_cuad_men_acad"];
  $cons_cuad_men_acad = $permisos["cons_cuad_men_acad"];
  $agr_res_est_acad = $permisos["agr_res_est_acad"];
  $edit_res_est_acad = $permisos["edit_res_est_acad"];
  $cons_res_est_acad = $permisos["cons_res_est_acad"];
  $agr_insti_eval_acad = $permisos["agr_insti_eval_acad"];
  $edit_insti_eval_acad = $permisos["edit_insti_eval_acad"];
  $cons_insti_eval_acad = $permisos["cons_insti_eval_acad"];
  $agr_inf_ucd_acad = $permisos["agr_inf_ucd_acad"];
  $edit_inf_ucd_acad = $permisos["edit_inf_ucd_acad"];
  $cons_inf_ucd_acad = $permisos["cons_inf_ucd_acad"];
  $agr_inf_final_ucd_acad = $permisos["agr_inf_final_ucd_acad"];
  $edit_inf_final_ucd_acad = $permisos["edit_inf_final_ucd_acad"];
  $cons_inf_final_ucd_acad = $permisos["cons_inf_final_ucd_acad"];
  $agr_eii_acad = $permisos["agr_eii_acad"];
  $edit_eii_acad = $permisos["edit_eii_acad"];
  $cons_eii_acad = $permisos["cons_eii_acad"];

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

<SCRIPT>do_tabs("Académico", "")</SCRIPT>

<BR>

<FORM METHOD="POST" NAME="datos" ACTION="../modulo_admin/bdc_permisos_user_acad.php">

<TABLE BORDER="0" CELLPADDING="0" ALIGN=CENTER>

        <TR>
        <TD COLSPAN="6">
        <DIV ALIGN="CENTER"><P class="cabecera">M&oacute;dulo de Control de Matr&iacute;cula</P></DIV>
        </TD>
        </TR>

        <TR>
        <TD COLSPAN="6">
        <DIV ALIGN="CENTER"><P class="rojo">A&ntilde;o Escolar</P></DIV>
        </TD>
        </TR>

        <TR>
        <TD WIDTH="75"><P ALIGN="RIGHT" class="mini">Agregar:</P></TD>
        <TD WIDTH="20"><INPUT TYPE="CHECKBOX" NAME="agr_anio_esc_acad" class="campo" VALUE="S" <? if ($agr_anio_esc_acad == "S"){echo 'CHECKED';} ?>></TD>
        <TD WIDTH="75"><P ALIGN="RIGHT" class="mini">Editar:</P></TD>
        <TD WIDTH="20"><INPUT TYPE="CHECKBOX" NAME="edit_anio_esc_acad" class="campo" VALUE="S" <? if ($edit_anio_esc_acad == "S"){echo 'CHECKED';} ?>></TD>
        <TD WIDTH="75"></TD>
        <TD WIDTH="20"></TD>
        </TR>

        <TR>
        <TD COLSPAN="6">
        <DIV ALIGN="CENTER"><P class="rojo">Calendario Escolar</P></DIV>
        </TD>
        </TR>

        <TR>
        <TD WIDTH="75"><P ALIGN="RIGHT" class="mini">Agregar:</P></TD>
        <TD WIDTH="20"><INPUT TYPE="CHECKBOX" NAME="agr_cal_esc_acad" class="campo" VALUE="S" <? if ($agr_cal_esc_acad == "S"){echo 'CHECKED';} ?>></TD>
        <TD WIDTH="75"><P ALIGN="RIGHT" class="mini">Editar:</P></TD>
        <TD WIDTH="20"><INPUT TYPE="CHECKBOX" NAME="edit_cal_esc_acad" class="campo" VALUE="S" <? if ($edit_cal_esc_acad == "S"){echo 'CHECKED';} ?>></TD>
        <TD WIDTH="75"></TD>
        <TD WIDTH="20"></TD>
        </TR>

        <TR>
        <TD COLSPAN="6">
        <DIV ALIGN="CENTER"><P class="rojo">Cuadro Mensual</P></DIV>
        </TD>
        </TR>

        <TR>
        <TD WIDTH="75"><P ALIGN="RIGHT" class="mini">Agregar:</P></TD>
        <TD WIDTH="20"><INPUT TYPE="CHECKBOX" NAME="agr_cuad_men_acad" class="campo" VALUE="S" <? if ($agr_cuad_men_acad == "S"){echo 'CHECKED';} ?>></TD>
        <TD WIDTH="75"><P ALIGN="RIGHT" class="mini">Editar:</P></TD>
        <TD WIDTH="20"><INPUT TYPE="CHECKBOX" NAME="edit_cuad_men_acad" class="campo" VALUE="S" <? if ($edit_cuad_men_acad == "S"){echo 'CHECKED';} ?>></TD>
        <TD WIDTH="75"><P ALIGN="RIGHT" class="mini">Consultar:</P></TD>
        <TD WIDTH="20"><INPUT TYPE="CHECKBOX" NAME="cons_cuad_men_acad" class="campo" VALUE="S" <? if ($cons_cuad_men_acad == "S"){echo 'CHECKED';} ?>></TD>
        </TR>

        <TR>
        <TD COLSPAN="6">
        <DIV ALIGN="CENTER"><P class="rojo">Resumen Estad&iacute;stico</P></DIV>
        </TD>
        </TR>

        <TR>
        <TD WIDTH="75"><P ALIGN="RIGHT" class="mini">Agregar:</P></TD>
        <TD WIDTH="20"><INPUT TYPE="CHECKBOX" NAME="agr_res_est_acad" class="campo" VALUE="S" <? if ($agr_res_est_acad == "S"){echo 'CHECKED';} ?>></TD>
        <TD WIDTH="75"><P ALIGN="RIGHT" class="mini">Editar:</P></TD>
        <TD WIDTH="20"><INPUT TYPE="CHECKBOX" NAME="edit_res_est_acad" class="campo" VALUE="S" <? if ($edit_res_est_acad == "S"){echo 'CHECKED';} ?>></TD>
        <TD WIDTH="75"><P ALIGN="RIGHT" class="mini">Consultar:</P></TD>
        <TD WIDTH="20"><INPUT TYPE="CHECKBOX" NAME="cons_res_est_acad" class="campo" VALUE="S" <? if ($cons_res_est_acad == "S"){echo 'CHECKED';} ?>></TD>
        </TR>

        <TR>
        <TD COLSPAN="6">
        <DIV ALIGN="CENTER"><P class="cabecera">M&oacute;dulo de Escuelas Bolivarianas</P></DIV>
        </TD>
        </TR>

        <TR>
        <TD COLSPAN="6">
        <DIV ALIGN="CENTER"><P class="rojo">Evaluaci&oacute;n Institucional</P></DIV>
        </TD>
        </TR>

        <TR>
        <TD WIDTH="75"><P ALIGN="RIGHT" class="mini">Agregar:</P></TD>
        <TD WIDTH="20"><INPUT TYPE="CHECKBOX" NAME="agr_insti_eval_acad" class="campo" VALUE="S" <? if ($agr_insti_eval_acad == "S"){echo 'CHECKED';} ?>></TD>
        <TD WIDTH="75"><P ALIGN="RIGHT" class="mini">Editar:</P></TD>
        <TD WIDTH="20"><INPUT TYPE="CHECKBOX" NAME="edit_insti_eval_acad" class="campo" VALUE="S" <? if ($edit_insti_eval_acad == "S"){echo 'CHECKED';} ?>></TD>
        <TD WIDTH="75"><P ALIGN="RIGHT" class="mini">Consultar:</P></TD>
        <TD WIDTH="20"><INPUT TYPE="CHECKBOX" NAME="cons_insti_eval_acad" class="campo" VALUE="S" <? if ($cons_insti_eval_acad == "S"){echo 'CHECKED';} ?>></TD>
        </TR>

        <TR>
        <TD COLSPAN="6">
        <DIV ALIGN="CENTER"><P class="cabecera">M&oacute;dulo de Educaci&oacute;n Especial</P></DIV>
        </TD>
        </TR>

        <TR>
        <TD COLSPAN="6">
        <DIV ALIGN="CENTER"><P class="rojo">Informe Trimestral UCD</P></DIV>
        </TD>
        </TR>

        <TR>
        <TD WIDTH="75"><P ALIGN="RIGHT" class="mini">Agregar:</P></TD>
        <TD WIDTH="20"><INPUT TYPE="CHECKBOX" NAME="agr_inf_ucd_acad" class="campo" VALUE="S" <? if ($agr_inf_ucd_acad == "S"){echo 'CHECKED';} ?>></TD>
        <TD WIDTH="75"><P ALIGN="RIGHT" class="mini">Editar:</P></TD>
        <TD WIDTH="20"><INPUT TYPE="CHECKBOX" NAME="edit_inf_ucd_acad" class="campo" VALUE="S" <? if ($edit_inf_ucd_acad == "S"){echo 'CHECKED';} ?>></TD>
        <TD WIDTH="75"><P ALIGN="RIGHT" class="mini">Consultar:</P></TD>
        <TD WIDTH="20"><INPUT TYPE="CHECKBOX" NAME="cons_inf_ucd_acad" class="campo" VALUE="S" <? if ($cons_inf_ucd_acad == "S"){echo 'CHECKED';} ?>></TD>
        </TR>

        <TR>
        <TD COLSPAN="6">
        <DIV ALIGN="CENTER"><P class="rojo">Informe Final UCD</P></DIV>
        </TD>
        </TR>

        <TR>
        <TD WIDTH="75"><P ALIGN="RIGHT" class="mini">Agregar:</P></TD>
        <TD WIDTH="20"><INPUT TYPE="CHECKBOX" NAME="agr_inf_final_ucd_acad" class="campo" VALUE="S" <? if ($agr_inf_final_ucd_acad == "S"){echo 'CHECKED';} ?>></TD>
        <TD WIDTH="75"><P ALIGN="RIGHT" class="mini">Editar:</P></TD>
        <TD WIDTH="20"><INPUT TYPE="CHECKBOX" NAME="edit_inf_final_ucd_acad" class="campo" VALUE="S" <? if ($edit_inf_final_ucd_acad == "S"){echo 'CHECKED';} ?>></TD>
        <TD WIDTH="75"><P ALIGN="RIGHT" class="mini">Consultar:</P></TD>
        <TD WIDTH="20"><INPUT TYPE="CHECKBOX" NAME="cons_inf_final_ucd_acad" class="campo" VALUE="S" <? if ($cons_inf_final_ucd_acad == "S"){echo 'CHECKED';} ?>></TD>
        </TR>

                <TR>
        <TD COLSPAN="6">
        <DIV ALIGN="CENTER">
          <P class="rojo">Equipos Interdisciplinaros Itinerantes</P>
        </DIV>
        </TD>
        </TR>

        <TR>
        <TD WIDTH="75"><P ALIGN="RIGHT" class="mini">Agregar:</P></TD>
        <TD WIDTH="20"><INPUT TYPE="CHECKBOX" NAME="agr_eii_acad" class="campo" VALUE="S" <? if ($agr_eii_acad == "S"){echo 'CHECKED';} ?>></TD>
        <TD WIDTH="75"><P ALIGN="RIGHT" class="mini">Editar:</P></TD>
        <TD WIDTH="20"><INPUT TYPE="CHECKBOX" NAME="edit_eii_acad" class="campo" VALUE="S" <? if ($edit_eii_acad == "S"){echo 'CHECKED';} ?>></TD>
        <TD WIDTH="75"><P ALIGN="RIGHT" class="mini">Consultar:</P></TD>
        <TD WIDTH="20"><INPUT TYPE="CHECKBOX" NAME="cons_eii_acad" class="campo" VALUE="S" <? if ($cons_eii_acad == "S"){echo 'CHECKED';} ?>></TD>
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