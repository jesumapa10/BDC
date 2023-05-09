<?
  include ("../sesion.php");
  include ("../conex.php");
	$codg_per=$_GET['codg_per'];
	$codg_mov=$_GET['codg_mov'];
?>
<HTML>
<HEAD>
<TITLE>Editar Permisos</TITLE>
        <LINK REL="STYLESHEET" HREF="../style/normal.css" TYPE="text/css">

        <SCRIPT LANGUAGE="JavaScript" SRC="../scripts/validar.js" TYPE="text/javascript"></SCRIPT>

<SCRIPT>
function ingresar()
{
        datos.action.value="ins";
		datos.pasada.value="1";
}
function cerrar()

{
         window.close()
}
function tipo_permiso()
{
        if (document.datos.tip_perm_new.selectedIndex == 100) {
        datos.tip_perm_new.value="$tip_perm_new";
        datos.pasada.value="1";
        }
        datos.submit();
}
</SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="../scripts/calendario.js" TYPE="text/javascript"></SCRIPT>

<SCRIPT LANGUAGE="JavaScript" SRC="../scripts/cal-barra.js" TYPE="text/javascript"></SCRIPT>

<SCRIPT LANGUAGE="JavaScript">
        var c1 = new CodeThatCalendar(caldef1);
</SCRIPT>
</HEAD>
<?
         $consulta_datos_per=mysql_query("SELECT d.apel_per, d.nomb_per, d.naci_per, t.desc_tip_trab, d.codg_tip_trab FROM bdc_datos_per d, bdc_tip_trab t WHERE d.codg_per=$codg_per and t.codg_tip_trab=d.codg_tip_trab");

                $datos = mysql_fetch_array($consulta_datos_per);
                $apel_per = $datos["apel_per"];
                $nomb_per = $datos["nomb_per"];
                $naci_per = $datos["naci_per"];
                $desc_tip_trab = $datos["desc_tip_trab"];
                $codg_tip_trab = $datos["codg_tip_trab"];

?>

<BR>
<H2>Editar Permisos</H2>
<BR>
<TABLE ALIGN="CENTER">
<TR>
<TD>
<P ALIGN="CENTER" class="mini">Nombre(s) y Apellido(s):</P>
</TD>

<TD>
<P ALIGN="CENTER" class="campo"><? echo $nomb_per; ?>&nbsp;<? echo $apel_per; ?>&nbsp;&nbsp;&nbsp;&nbsp;</P>
</TD>

<TD>
<P ALIGN="CENTER" class="mini">C&eacute;dula:</P>
</TD>

<TD>
<P ALIGN="CENTER" class="campo"><? if ($naci_per == "V") {echo 'V - ';} else {echo 'E - ';} echo number_format($codg_per ,0 , "," ,"."); ?>&nbsp;&nbsp;&nbsp;&nbsp;</P>
</TD>

<TD>
<P ALIGN="CENTER" class="mini">Tipo de Trabajador:</P>
</TD>

<TD>
<P ALIGN="CENTER" class="campo"><? echo $desc_tip_trab; ?></P>
</TD>
</TR>
</TABLE>

        <?
           if ($pasada !=1)
           {
           
             $consulta_permiso = mysql_query("SELECT p.nomb_perm, d.codg_perm, d.tip_perm, d.fec_inicio, d.fec_fin, d.motivo FROM bdc_datos_permisos d, bdc_permisos p WHERE d.codg_per=$codg_per AND d.codg_mov=$codg_mov ORDER BY 4 DESC");

             $permiso = mysql_fetch_array($consulta_permiso);

             $tip_perm = $permiso["tip_perm"];
     	     $tip_perm_new = $tip_perm; 
             $codg_perm = $permiso["codg_perm"];
			 $fec_inicio = $permiso["fec_inicio"];
             $fec_inicio = substr($fec_inicio,8,2)."-".substr($fec_inicio,5,2)."-".substr($fec_inicio,0,4);
             $fec_fin = $permiso["fec_fin"];
             $fec_fin = substr($fec_fin,8,2)."-".substr($fec_fin,5,2)."-".substr($fec_fin,0,4);
             $motivo = $permiso["motivo"];
           }
        ?>

        <FORM METHOD="post" NAME="datos" action="">

                <TABLE BORDER="0" ALIGN="center">

                 <TR>
                <TD COLSPAN="8"><DIV ALIGN="CENTER"><P class="cabecera">Permisos</P></DIV></TD>
                </TR>

                <TR>
                <TD><P ALIGN="RIGHT" class="mini">Tipo Permiso:</TD>
                <TD><SELECT class="campo" NAME="tip_perm_new" onChange="tipo_permiso()">
                <OPTION VALUE="0">Seleccione...</OPTION>
                <OPTION VALUE="1" <? if ($tip_perm_new == "1") {echo 'SELECTED';}?> >Remunerado</OPTION>
                <OPTION VALUE="2" <? if ($tip_perm_new == "2") {echo 'SELECTED';}?> >No Remunerado</OPTION>
                <OPTION VALUE="3" <? if ($tip_perm_new == "3") {echo 'SELECTED';}?> >Postestativo</OPTION>
                <OPTION VALUE="4" <? if ($tip_perm_new == "4") {echo 'SELECTED';}?> >IPAS Estadal</OPTION>
                <OPTION VALUE="5" <? if ($tip_perm_new == "5") {echo 'SELECTED';}?> >Licencia Sabática</OPTION>
                </SELECT></TD>
                </TR>

                <TR>
                <TD WIDTH="150"><P ALIGN="RIGHT" class="mini">Permiso:</P></TD>
				<TD WIDTH="250"><SELECT class="campo" NAME="codg_perm_new">
                <OPTION value="0">Seleccione...</OPTION>
                <?
                $permisos = mysql_query("SELECT codg_perm, tip_perm, nomb_perm FROM bdc_permisos WHERE tip_perm=$tip_perm_new");
                if (mysql_num_rows($permisos) != 0)
                {
                    while ($permiso = mysql_fetch_array($permisos))
                  {
                   echo '<OPTION VALUE="'.$permiso["codg_perm"];
                                       echo '"';
                                       if ($codg_perm == $permiso["codg_perm"])
                                       {
                                          echo 'SELECTED';
                                       }
                                       echo '>'.$permiso["nomb_perm"];
                                       echo '</OPTION>';
                  }
                }
                ?>
				  </SELECT>
                </TR>

                <TR>
                  <TD><P ALIGN="RIGHT" class="mini">Fecha de Inicio:</P></TD>
                  <TD><INPUT TYPE="TEXT" NAME="fec_inicio" class="campo" VALUE="<? echo $fec_inicio; ?>" MAXLENGTH="10" SIZE="10" READONLY>
                  <A HREF="#"><IMG SRC="../images/cal.gif" ALT="Haz Click para Buscar la Fecha" WIDTH="16" HEUGHT="16" BORDER="0" onClick="c1.popup('fec_inicio');"></A>
                  </TD>
                </TR>

                <TR>
                  <TD><P ALIGN="RIGHT" class="mini">Fecha Fin:</P></TD>
                  <TD><INPUT TYPE="TEXT" NAME="fec_fin" class="campo" VALUE="<? echo $fec_fin; ?>" MAXLENGTH="10" SIZE="10" READONLY>
                  <A HREF="#"><IMG SRC="../images/cal.gif" ALT="Haz Click para Buscar la Fecha" WIDTH="16" HEUGHT="16" BORDER="0" onClick="c1.popup('fec_fin');"></A>
                  </TD>
                </TR>

                <TR>
                  <TD><P ALIGN="RIGHT" class="mini">Motivo del Permiso:</P></TD>
                  <TD><P class="campo"><TEXTAREA class="campo" ROWS="5" COLS="100" NAME="motivo" MAXLENGTH="250" SIZE="1" VALUE="<? echo $motivo; ?>" ><? echo $motivo; ?></TEXTAREA></P></TD>
                </TR>

                <TR>
                <TD COLSPAN="2"><HR></TD>
                </TR>

                </TABLE>



<INPUT TYPE="HIDDEN" NAME="action" VALUE="">
<INPUT TYPE="HIDDEN" NAME="codg_per" VALUE="<? echo $codg_per; ?>">
<INPUT TYPE="HIDDEN" NAME="codg_perm" VALUE="<? echo $codg_perm; ?>">
<INPUT TYPE="HIDDEN" NAME="tip_perm" VALUE="<? echo $tip_perm; ?>">
<INPUT TYPE="HIDDEN" NAME="pasada" VALUE="1">

<CENTER><INPUT class="mini" TYPE="SUBMIT" VALUE="Actualizar" onClick="ingresar()">&nbsp;<INPUT class="mini" TYPE="BUTTON" VALUE="Cerrar Ventana" onClick="cerrar()"></CENTER>

        </FORM>

<?
    if ($action == "ins")
  {
        if ($tip_perm == ""){$tip_perm = "NULL";} else {$tip_perm = "$tip_perm";}
       $fec_inicio = substr($fec_inicio,6,4)."-".substr($fec_inicio,3,2)."-".substr($fec_inicio,0,2);
       $fec_fin = substr($fec_fin,6,4)."-".substr($fec_fin,3,2)."-".substr($fec_fin,0,2);
       if ($motivo == ""){$motivo = "NULL";} else {$motivo = "$motivo";}


        $qry=("UPDATE bdc_datos_permisos SET codg_perm=$codg_perm_new, tip_perm='$tip_perm_new', fec_inicio='$fec_inicio', fec_fin='$fec_fin', motivo='$motivo'
                WHERE codg_per=$codg_per AND codg_mov=$codg_mov");

       mysql_query($qry);

   echo "<SCRIPT>alert('Datos Actualizados');</SCRIPT>";

}


?>

<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">

  var frmvalidator  = new Validator("datos");

  frmvalidator.addValidation("tip_perm_new","dontselect=0","Seleccione Tipo de Permiso");
  frmvalidator.addValidation("codg_perm_new","dontselect=0","Seleccione Permiso");
  frmvalidator.addValidation("fec_inicio","req","Seleccione la Fecha de Inicio del Permiso");
  frmvalidator.addValidation("fec_fin","req","Seleccione la Fecha de Fin del Permiso");



</SCRIPT>

</HTML>
