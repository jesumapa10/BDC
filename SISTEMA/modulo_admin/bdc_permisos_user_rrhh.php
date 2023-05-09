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
    if ($agr_per_doc_rrhh == "") {($agr_per_doc_rrhh = "N");}
    if ($edit_per_doc_rrhh == "") {$edit_per_doc_rrhh = "N";}
    if ($cons_per_doc_rrhh == "") {$cons_per_doc_rrhh = "N";}
    if ($agr_insti_rrhh == "") {$agr_insti_rrhh = "N";}
    if ($edit_insti_rrhh == "") {$edit_insti_rrhh = "N";}
    if ($cons_insti_rrhh == "") {$cons_insti_rrhh = "N";}
    if ($agr_insti_espec_rrhh == "") {$agr_insti_espec_rrhh = "N";}
    if ($edit_insti_espec_rrhh == "") {$edit_insti_espec_rrhh = "N";}
    if ($cons_insti_espec_rrhh == "") {$cons_insti_espec_rrhh = "N";}
    if ($agr_insti_grados_rrhh == "") {$agr_insti_grados_rrhh = "N";}
    if ($edit_insti_grados_rrhh == "") {$edit_insti_grados_rrhh = "N";}
    if ($cons_insti_grados_rrhh == "") {$cons_insti_grados_rrhh = "N";}
    if ($agr_insti_sem_rrhh == "") {$agr_insti_sem_rrhh = "N";}
    if ($edit_insti_sem_rrhh == "") {$edit_insti_sem_rrhh = "N";}
    if ($cons_insti_sem_rrhh == "") {$cons_insti_sem_rrhh = "N";}
    if ($agr_tram_rrhh == "") {$agr_tram_rrhh = "N";}
    if ($edit_tram_rrhh == "") {$edit_tram_rrhh = "N";}
    if ($cons_tram_rrhh == "") {$cons_tram_rrhh = "N";}
    if ($agr_eleg_rrhh == "") {$agr_eleg_rrhh = "N";}
    if ($edit_eleg_rrhh == "") {$edit_eleg_rrhh = "N";}
    if ($cons_eleg_rrhh == "") {$cons_eleg_rrhh = "N";}
    if ($agr_nom_rrhh == "") {$agr_nom_rrhh = "N";}
    if ($edit_nom_rrhh == "") {$edit_nom_rrhh = "N";}
    if ($cons_nom_rrhh == "") {$cons_nom_rrhh = "N";}
    if ($agr_prest_rrhh == "") {$agr_prest_rrhh = "N";}
    if ($edit_prest_rrhh == "") {$edit_prest_rrhh = "N";}
    if ($cons_prest_rrhh == "") {$cons_prest_rrhh = "N";}
    if ($agr_tras_rrhh == "") {$agr_tras_rrhh = "N";}
    if ($edit_tras_rrhh == "") {$edit_tras_rrhh = "N";}
    if ($cons_tras_rrhh == "") {$cons_tras_rrhh = "N";}
	if ($agr_ins_rrhh == "") {$agr_ins_rrhh = "N";}
    if ($edit_ins_rrhh == "") {$edit_ins_rrhh = "N";}
    if ($cons_ins_rrhh == "") {$cons_ins_rrhh = "N";}
    if ($rep_dim_rrhh == "") {$rep_dim_rrhh = "N";}


    $permisologia = mysql_query("SELECT * FROM bdc_permisos_rrhh WHERE codg_usr=$codg_usr");

                    if (mysql_num_rows($permisologia) != 0)
                      {
                              mysql_query("UPDATE bdc_permisos_rrhh SET agr_per_doc_rrhh='$agr_per_doc_rrhh',
                                           edit_per_doc_rrhh='$edit_per_doc_rrhh', cons_per_doc_rrhh='$cons_per_doc_rrhh',
                                           agr_insti_rrhh='$agr_insti_rrhh', edit_insti_rrhh='$edit_insti_rrhh',
                                           cons_insti_rrhh='$cons_insti_rrhh', agr_insti_espec_rrhh='$agr_insti_espec_rrhh',
                                           edit_insti_espec_rrhh='$edit_insti_espec_rrhh', cons_insti_espec_rrhh='$cons_insti_espec_rrhh',
                                           agr_insti_grados_rrhh='$agr_insti_grados_rrhh', edit_insti_grados_rrhh='$edit_insti_grados_rrhh',
                                           cons_insti_grados_rrhh='$cons_insti_grados_rrhh', agr_insti_sem_rrhh='$agr_insti_sem_rrhh',
                                           edit_insti_sem_rrhh='$edit_insti_sem_rrhh', cons_insti_sem_rrhh='$cons_insti_sem_rrhh',
                                           agr_tram_rrhh='$agr_tram_rrhh', edit_tram_rrhh='$edit_tram_rrhh', cons_tram_rrhh='$cons_tram_rrhh',
                                           agr_eleg_rrhh='$agr_eleg_rrhh', edit_eleg_rrhh='$edit_eleg_rrhh', cons_eleg_rrhh='$cons_eleg_rrhh',
                                           agr_nom_rrhh='$agr_nom_rrhh', edit_nom_rrhh='$edit_nom_rrhh', cons_nom_rrhh='$cons_nom_rrhh',
                                           agr_prest_rrhh='$agr_prest_rrhh', edit_prest_rrhh='$edit_prest_rrhh', cons_prest_rrhh='$cons_prest_rrhh',
                                           agr_tras_rrhh='$agr_tras_rrhh', edit_tras_rrhh='$edit_tras_rrhh', cons_tras_rrhh='$cons_tras_rrhh', agr_ins_rrhh='$agr_ins_rrhh', edit_ins_rrhh='$edit_ins_rrhh', cons_ins_rrhh='$cons_ins_rrhh', rep_dim_rrhh='$rep_dim_rrhh'
                                           WHERE codg_usr=$codg_usr");

                              echo "<SCRIPT>alert('Registro Actualizado');</SCRIPT>";
                      }

                    if (mysql_num_rows($permisologia) == 0)
                      {
                              mysql_query("INSERT INTO bdc_permisos_rrhh VALUES ($codg_usr, '$agr_per_doc_rrhh', '$edit_per_doc_rrhh',
                                           '$cons_per_doc_rrhh', '$agr_insti_rrhh', '$edit_insti_rrhh', '$cons_insti_rrhh',
                                           '$agr_insti_espec_rrhh', '$edit_insti_espec_rrhh', '$cons_insti_espec_rrhh',
                                           '$agr_insti_grados_rrhh', '$edit_insti_grados_rrhh', '$cons_insti_grados_rrhh',
                                           '$agr_insti_sem_rrhh', '$edit_insti_sem_rrhh', '$cons_insti_sem_rrhh', '$agr_tram_rrhh',
                                           '$edit_tram_rrhh', '$cons_tram_rrhh', '$agr_eleg_rrhh', '$edit_eleg_rrhh', '$cons_eleg_rrhh',
                                           '$agr_nom_rrhh', '$edit_nom_rrhh', '$cons_nom_rrhh', '$agr_prest_rrhh', '$edit_prest_rrhh',
                                           '$cons_prest_rrhh', '$agr_tras_rrhh', '$edit_tras_rrhh', '$cons_tras_rrhh', '$agr_ins_rrhh', '$edit_ins_rrhh', '$cons_ins_rrhh', '$rep_dim_rrhh')");

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

  $permisos_usuario = mysql_query("SELECT * FROM bdc_permisos_rrhh where codg_usr=$codg_usr");
  $permisos = mysql_fetch_array($permisos_usuario);
  $agr_per_doc_rrhh = $permisos["agr_per_doc_rrhh"];
  $edit_per_doc_rrhh = $permisos["edit_per_doc_rrhh"];
  $cons_per_doc_rrhh = $permisos["cons_per_doc_rrhh"];
  $agr_insti_rrhh = $permisos["agr_insti_rrhh"];
  $edit_insti_rrhh = $permisos["edit_insti_rrhh"];
  $cons_insti_rrhh = $permisos["cons_insti_rrhh"];
  $agr_insti_espec_rrhh = $permisos["agr_insti_espec_rrhh"];
  $edit_insti_espec_rrhh = $permisos["edit_insti_espec_rrhh"];
  $cons_insti_espec_rrhh = $permisos["cons_insti_espec_rrhh"];
  $agr_insti_grados_rrhh = $permisos["agr_insti_grados_rrhh"];
  $edit_insti_grados_rrhh = $permisos["edit_insti_grados_rrhh"];
  $cons_insti_grados_rrhh = $permisos["cons_insti_grados_rrhh"];
  $agr_insti_sem_rrhh = $permisos["agr_insti_sem_rrhh"];
  $edit_insti_sem_rrhh = $permisos["edit_insti_sem_rrhh"];
  $cons_insti_sem_rrhh = $permisos["cons_insti_sem_rrhh"];
  $agr_tram_rrhh = $permisos["agr_tram_rrhh"];
  $edit_tram_rrhh = $permisos["edit_tram_rrhh"];
  $cons_tram_rrhh = $permisos["cons_tram_rrhh"];
  $agr_eleg_rrhh = $permisos["agr_eleg_rrhh"];
  $edit_eleg_rrhh = $permisos["edit_eleg_rrhh"];
  $cons_eleg_rrhh = $permisos["cons_eleg_rrhh"];
  $agr_nom_rrhh = $permisos["agr_nom_rrhh"];
  $edit_nom_rrhh = $permisos["edit_nom_rrhh"];
  $cons_nom_rrhh = $permisos["cons_nom_rrhh"];
  $agr_prest_rrhh = $permisos["agr_prest_rrhh"];
  $edit_prest_rrhh = $permisos["edit_prest_rrhh"];
  $cons_prest_rrhh = $permisos["cons_prest_rrhh"];
  $agr_tras_rrhh = $permisos["agr_tras_rrhh"];
  $edit_tras_rrhh = $permisos["edit_tras_rrhh"];
  $cons_tras_rrhh = $permisos["cons_tras_rrhh"];
  $agr_ins_rrhh = $permisos["agr_ins_rrhh"];
  $edit_ins_rrhh = $permisos["edit_ins_rrhh"];
  $cons_ins_rrhh = $permisos["cons_ins_rrhh"];
  $rep_dim_rrhh = $permisos["rep_dim_rrhh"];
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

<SCRIPT>do_tabs("R.R.H.H.", "");</SCRIPT>

<BR>

<FORM METHOD="POST" NAME="datos" ACTION="bdc_permisos_user_rrhh.php">

<TABLE BORDER="0" CELLPADDING="0" ALIGN=CENTER>

        <TR>
        <TD COLSPAN="6">
        <DIV ALIGN="CENTER"><P class="cabecera">M&oacute;dulo Personal</P></DIV>
        </TD>
        </TR>

        <TR>
        <TD WIDTH="75"><P ALIGN="RIGHT" class="mini">Agregar:</P></TD>
        <TD WIDTH="20"><INPUT TYPE=CHECKBOX NAME=agr_per_doc_rrhh class="campo" VALUE="S" <? if ($agr_per_doc_rrhh == "S"){echo 'CHECKED';} ?>></TD>
        <TD WIDTH="75"><P ALIGN="RIGHT" class="mini">Editar:</P></TD>
        <TD WIDTH="20"><INPUT TYPE=CHECKBOX NAME=edit_per_doc_rrhh class="campo" VALUE="S" <? if ($edit_per_doc_rrhh == "S"){echo 'CHECKED';} ?>></TD>
        <TD WIDTH="75"><P ALIGN="RIGHT" class="mini">Consultar:</P></TD>
        <TD WIDTH="20"><INPUT TYPE=CHECKBOX NAME=cons_per_doc_rrhh class="campo" VALUE="S" <? if ($cons_per_doc_rrhh == "S"){echo 'CHECKED';} ?>></TD>
        </TR>

        <TR></TR>

        <TR>
        <TD COLSPAN="6">
        <DIV ALIGN="CENTER"><P class="cabecera">M&oacute;dulo Instituciones</P></DIV>
        </TD>
        </TR>

        <TR>
        <TD WIDTH="75"><P ALIGN="RIGHT" class="mini">Agregar:</P></TD>
        <TD WIDTH="20"><INPUT TYPE=CHECKBOX NAME=agr_insti_rrhh class="campo" VALUE="S" <? if ($agr_insti_rrhh == "S"){echo 'CHECKED';} ?>></TD>
        <TD WIDTH="75"><P ALIGN="RIGHT" class="mini">Editar:</P></TD>
        <TD WIDTH="20"><INPUT TYPE=CHECKBOX NAME=edit_insti_rrhh class="campo" VALUE="S" <? if ($edit_insti_rrhh == "S"){echo 'CHECKED';} ?>></TD>
        <TD WIDTH="75"><P ALIGN="RIGHT" class="mini">Consultar:</P></TD>
        <TD WIDTH="20"><INPUT TYPE=CHECKBOX NAME=cons_insti_rrhh class="campo" VALUE="S" <? if ($cons_insti_rrhh == "S"){echo 'CHECKED';} ?>></TD>
        </TR>

        <TR>
        <TD COLSPAN="6">
        <DIV ALIGN="CENTER"><P class="rojo">Especialidades</P></DIV>
        </TD>
        </TR>

        <TR>
        <TD WIDTH="75"><P ALIGN="RIGHT" class="mini">Agregar:</P></TD>
        <TD WIDTH="20"><INPUT TYPE=CHECKBOX NAME=agr_insti_espec_rrhh class="campo" VALUE="S" <? if ($agr_insti_espec_rrhh == "S"){echo 'CHECKED';} ?>></TD>
        <TD WIDTH="75"><P ALIGN="RIGHT" class="mini">Editar:</P></TD>
        <TD WIDTH="20"><INPUT TYPE=CHECKBOX NAME=edit_insti_espec_rrhh class="campo" VALUE="S" <? if ($edit_insti_espec_rrhh == "S"){echo 'CHECKED';} ?>></TD>
        <TD WIDTH="75"><P ALIGN="RIGHT" class="mini">Consultar:</P></TD>
        <TD WIDTH="20"><INPUT TYPE=CHECKBOX NAME=cons_insti_espec_rrhh class="campo" VALUE="S" <? if ($cons_insti_espec_rrhh == "S"){echo 'CHECKED';} ?>></TD>
        </TR>

        <TR>
        <TD COLSPAN="6">
        <DIV ALIGN="CENTER"><P class="rojo">Grados</P></DIV>
        </TD>
        </TR>

        <TR>
        <TD WIDTH="75"><P ALIGN="RIGHT" class="mini">Agregar:</P></TD>
        <TD WIDTH="20"><INPUT TYPE=CHECKBOX NAME=agr_insti_grados_rrhh class="campo" VALUE="S" <? if ($agr_insti_grados_rrhh == "S"){echo 'CHECKED';} ?>></TD>
        <TD WIDTH="75"><P ALIGN="RIGHT" class="mini">Editar:</P></TD>
        <TD WIDTH="20"><INPUT TYPE=CHECKBOX NAME=edit_insti_grados_rrhh class="campo" VALUE="S" <? if ($edit_insti_grados_rrhh == "S"){echo 'CHECKED';} ?>></TD>
        <TD WIDTH="75"><P ALIGN="RIGHT" class="mini">Consultar:</P></TD>
        <TD WIDTH="20"><INPUT TYPE=CHECKBOX NAME=cons_insti_grados_rrhh class="campo" VALUE="S" <? if ($cons_insti_grados_rrhh == "S"){echo 'CHECKED';} ?>></TD>
        </TR>

        <TR>
        <TD COLSPAN="6">
        <DIV ALIGN="CENTER"><P class="rojo">Semestres</P></DIV>
        </TD>
        </TR>

        <TR>
        <TD WIDTH="75"><P ALIGN="RIGHT" class="mini">Agregar:</P></TD>
        <TD WIDTH="20"><INPUT TYPE=CHECKBOX NAME=agr_insti_sem_rrhh class="campo" VALUE="S" <? if ($agr_insti_sem_rrhh == "S"){echo 'CHECKED';} ?>></TD>
        <TD WIDTH="75"><P ALIGN="RIGHT" class="mini">Editar:</P></TD>
        <TD WIDTH="20"><INPUT TYPE=CHECKBOX NAME=edit_insti_sem_rrhh class="campo" VALUE="S" <? if ($edit_insti_sem_rrhh == "S"){echo 'CHECKED';} ?>></TD>
        <TD WIDTH="75"><P ALIGN="RIGHT" class="mini">Consultar:</P></TD>
        <TD WIDTH="20"><INPUT TYPE=CHECKBOX NAME=cons_insti_sem_rrhh class="campo" VALUE="S" <? if ($cons_insti_sem_rrhh == "S"){echo 'CHECKED';} ?>></TD>
        </TR>

        <TR></TR>

        <TR>
        <TD COLSPAN="6">
        <DIV ALIGN="CENTER"><P class="cabecera">M&oacute;dulo de Tr&aacute;mites</P></DIV>
        </TD>
        </TR>

        <TR>
        <TD WIDTH="75"><P ALIGN="RIGHT" class="mini">Agregar:</P></TD>
        <TD WIDTH="20"><INPUT TYPE=CHECKBOX NAME=agr_tram_rrhh class="campo" VALUE="S" <? if ($agr_tram_rrhh == "S"){echo 'CHECKED';} ?>></TD>
        <TD WIDTH="75"><P ALIGN="RIGHT" class="mini">Editar:</P></TD>
        <TD WIDTH="20"><INPUT TYPE=CHECKBOX NAME=edit_tram_rrhh class="campo" VALUE="S" <? if ($edit_tram_rrhh == "S"){echo 'CHECKED';} ?>></TD>
        <TD WIDTH="75"><P ALIGN="RIGHT" class="mini">Consultar:</P></TD>
        <TD WIDTH="20"><INPUT TYPE=CHECKBOX NAME=cons_tram_rrhh class="campo" VALUE="S" <? if ($cons_tram_rrhh == "S"){echo 'CHECKED';} ?>></TD>
        </TR>

        <TR></TR>

        <TR>
        <TD COLSPAN="6">
        <DIV ALIGN="CENTER"><P class="cabecera">M&oacute;dulo Personal Elegible</P></DIV>
        </TD>
        </TR>

        <TR>
        <TD WIDTH="75"><P ALIGN="RIGHT" class="mini">Agregar:</P></TD>
        <TD WIDTH="20"><INPUT TYPE=CHECKBOX NAME=agr_eleg_rrhh class="campo" VALUE="S" <? if ($agr_eleg_rrhh == "S"){echo 'CHECKED';} ?>></TD>
        <TD WIDTH="75"><P ALIGN="RIGHT" class="mini">Editar:</P></TD>
        <TD WIDTH="20"><INPUT TYPE=CHECKBOX NAME=edit_eleg_rrhh class="campo" VALUE="S" <? if ($edit_eleg_rrhh == "S"){echo 'CHECKED';} ?>></TD>
        <TD WIDTH="75"><P ALIGN="RIGHT" class="mini">Consultar:</P></TD>
        <TD WIDTH="20"><INPUT TYPE=CHECKBOX NAME=cons_eleg_rrhh class="campo" VALUE="S" <? if ($cons_eleg_rrhh == "S"){echo 'CHECKED';} ?>></TD>
        </TR>

        <TR></TR>

        <TR>
        <TD COLSPAN="6">
        <DIV ALIGN="CENTER"><P class="cabecera">M&oacute;dulo N&oacute;mina</P></DIV>
        </TD>
        </TR>

        <TR>
        <TD WIDTH="75"><P ALIGN="RIGHT" class="mini">Agregar:</P></TD>
        <TD WIDTH="20"><INPUT TYPE=CHECKBOX NAME=agr_nom_rrhh class="campo" VALUE="S" <? if ($agr_nom_rrhh == "S"){echo 'CHECKED';} ?>></TD>
        <TD WIDTH="75"><P ALIGN="RIGHT" class="mini">Editar:</P></TD>
        <TD WIDTH="20"><INPUT TYPE=CHECKBOX NAME=edit_nom_rrhh class="campo" VALUE="S" <? if ($edit_nom_rrhh == "S"){echo 'CHECKED';} ?>></TD>
        <TD WIDTH="75"><P ALIGN="RIGHT" class="mini">Consultar:</P></TD>
        <TD WIDTH="20"><INPUT TYPE=CHECKBOX NAME=cons_nom_rrhh class="campo" VALUE="S" <? if ($cons_nom_rrhh == "S"){echo 'CHECKED';} ?>></TD>
        </TR>

        <TR></TR>

        <TR>
        <TD COLSPAN="6">
        <DIV ALIGN="CENTER"><P class="cabecera">M&oacute;dulo Prestaciones Sociales</P></DIV>
        </TD>
        </TR>

        <TR>
        <TD WIDTH="75"><P ALIGN="RIGHT" class="mini">Agregar:</P></TD>
        <TD WIDTH="20"><INPUT TYPE=CHECKBOX NAME=agr_prest_rrhh class="campo" VALUE="S" <? if ($agr_prest_rrhh == "S"){echo 'CHECKED';} ?>></TD>
        <TD WIDTH="75"><P ALIGN="RIGHT" class="mini">Editar:</P></TD>
        <TD WIDTH="20"><INPUT TYPE=CHECKBOX NAME=edit_prest_rrhh class="campo" VALUE="S" <? if ($edit_prest_rrhh == "S"){echo 'CHECKED';} ?>></TD>
        <TD WIDTH="75"><P ALIGN="RIGHT" class="mini">Consultar:</P></TD>
        <TD WIDTH="20"><INPUT TYPE=CHECKBOX NAME=cons_prest_rrhh class="campo" VALUE="S" <? if ($cons_prest_rrhh == "S"){echo 'CHECKED';} ?>></TD>
        </TR>

        <TR></TR>

        <TR>
        <TD COLSPAN="6">
        <DIV ALIGN="CENTER"><P class="cabecera">M&oacute;dulo Traslados</P></DIV>
        </TD>
        </TR>

        <TR>
        <TD WIDTH="75"><P ALIGN="RIGHT" class="mini">Agregar:</P></TD>
        <TD WIDTH="20"><INPUT TYPE=CHECKBOX NAME=agr_tras_rrhh class="campo" VALUE="S" <? if ($agr_tras_rrhh == "S"){echo 'CHECKED';} ?>></TD>
        <TD WIDTH="75"><P ALIGN="RIGHT" class="mini">Editar:</P></TD>
        <TD WIDTH="20"><INPUT TYPE=CHECKBOX NAME=edit_tras_rrhh class="campo" VALUE="S" <? if ($edit_prest_rrhh == "S"){echo 'CHECKED';} ?>></TD>
        <TD WIDTH="75"><P ALIGN="RIGHT" class="mini">Consultar:</P></TD>
        <TD WIDTH="20"><INPUT TYPE=CHECKBOX NAME=cons_tras_rrhh class="campo" VALUE="S" <? if ($cons_prest_rrhh == "S"){echo 'CHECKED';} ?>></TD>
        </TR>
		
		<TR>
        <TD COLSPAN="6">
        <DIV ALIGN="CENTER"><P class="cabecera">M&oacute;dulo Inasistencia del Personal</P></DIV>
        </TD>
        </TR>

        <TR>
        <TD WIDTH="75"><P ALIGN="RIGHT" class="mini">Agregar:</P></TD>
        <TD WIDTH="20"><INPUT TYPE=CHECKBOX NAME=agr_ins_rrhh class="campo" VALUE="S" <? if ($agr_ins_rrhh == "S"){echo 'CHECKED';} ?>></TD>
        <TD WIDTH="75"><P ALIGN="RIGHT" class="mini">Editar:</P></TD>
        <TD WIDTH="20"><INPUT TYPE=CHECKBOX NAME=edit_ins_rrhh class="campo" VALUE="S" <? if ($edit_ins_rrhh == "S"){echo 'CHECKED';} ?>></TD>
        <TD WIDTH="75"><P ALIGN="RIGHT" class="mini">Consultar:</P></TD>
        <TD WIDTH="20"><INPUT TYPE=CHECKBOX NAME=cons_ins_rrhh class="campo" VALUE="S" <? if ($cons_ins_rrhh == "S"){echo 'CHECKED';} ?>></TD>
        </TR>

        <TR></TR>
<TR>
        <TD COLSPAN="6">
        <DIV ALIGN="CENTER"><P class="cabecera">M&oacute;dulo Reportes</P></DIV>
        </TD>
        </TR>

        <TR>
        <TD WIDTH="75"><P ALIGN="RIGHT" class="mini">Din&aacute;mico</P></TD>
        <TD WIDTH="20"><INPUT TYPE=CHECKBOX NAME=rep_dim_rrhh class="campo" VALUE="S" <? if ($rep_dim_rrhh == "S"){echo 'CHECKED';} ?>></TD>
        <TD WIDTH="75"><P ALIGN="RIGHT" class="mini"> </P></TD>
        <TD WIDTH="20"> </TD>
        <TD WIDTH="75"><P ALIGN="RIGHT" class="mini"> </P></TD>
        <TD WIDTH="20"> </TD>
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
