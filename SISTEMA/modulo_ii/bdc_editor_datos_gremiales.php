<?
  include ("../sesion.php");

  include ("../conex.php");
?>
<HTML>
<HEAD>
<TITLE>Editar Traslado</TITLE>
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

</SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="../scripts/calendario.js" TYPE="text/javascript"></SCRIPT>

<SCRIPT LANGUAGE="JavaScript" SRC="../scripts/cal-barra.js" TYPE="text/javascript"></SCRIPT>

<SCRIPT LANGUAGE="JavaScript">
        var c1 = new CodeThatCalendar(caldef1);
</SCRIPT>
</HEAD>
<?
         $consulta_datos_per=mysql_query("SELECT d.apel_per, d.nomb_per, d.naci_per, t.desc_tip_trab, d.codg_tip_trab
                 FROM bdc_datos_per d, bdc_tip_trab t
                 WHERE d.codg_per=$codg_per AND d.codg_tip_trab=t.codg_tip_trab");

                $datos = mysql_fetch_array($consulta_datos_per);
                $apel_per = $datos["apel_per"];
                $nomb_per = $datos["nomb_per"];
                $naci_per = $datos["naci_per"];
                $desc_tip_trab = $datos["desc_tip_trab"];
                $codg_tip_trab = $datos["codg_tip_trab"];

?>

<BR>
<H2>Editar Datos Gremiales</H2>
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
             $consulta_gremio = mysql_query("SELECT codg_grem, fec_dgrem FROM bdc_datos_grem
                         WHERE codg_per=$codg_per AND codg_grem=$codg_grem");

             $gremio = mysql_fetch_array($consulta_gremio);

             $codg_grem = $gremio["codg_grem"];
             $fec_dgrem = $gremio["fec_dgrem"];
             $fec_dgrem = substr($fec_dgrem,8,2)."-".substr($fec_dgrem,5,2)."-".substr($fec_dgrem,0,4);
           }
        ?>

        <FORM METHOD="post" NAME="datos" action="bdc_editor_datos_gremiales.php">

                <TABLE BORDER="0" ALIGN="center">

                 <TR>
                <TD COLSPAN="8"><DIV ALIGN="CENTER"><P class="cabecera">Datos Gremiales</P></DIV></TD>
                </TR>

                <TR>
                <TD WIDTH="100"><P ALIGN="right" class="mini">Gremio:</P></TD>
                <TD WIDTH="300"><SELECT class="campo" NAME="codg_grem_new">
                <OPTION value="0">Seleccione...</OPTION>
                <?
                $gremios = mysql_query("SELECT codg_grem, nomb_grem FROM bdc_gremios");
                if (mysql_num_rows($gremios) != 0)
                {
                    while ($gremio = mysql_fetch_array($gremios))
                  {
                   echo '<OPTION VALUE="'.$gremio["codg_grem"];
                                       echo '"';
                                       if ($codg_grem == $gremio["codg_grem"])
                                       {
                                          echo 'SELECTED';
                                       }
                                       echo '>'.$gremio["nomb_grem"];
                                       echo '</OPTION>';
                  }
                }
                ?>
                </TR>

                <TR>
                  <TD><P ALIGN="RIGHT" class="mini">Fecha de Afiliaci&oacute;n:</P></TD>
                  <TD><INPUT TYPE="TEXT" NAME="fec_dgrem" class="campo" VALUE="<? echo $fec_dgrem; ?>" MAXLENGTH="10" SIZE="10" READONLY>
                  <A HREF="#"><IMG SRC="../images/cal.gif" ALT="Haz Click para Buscar la Fecha" WIDTH="16" HEUGHT="16" BORDER="0" onClick="c1.popup('fec_dgrem');"></A>
                  </TD>
                </TR>

                <TR>
                <TD COLSPAN="2"><HR></TD>
                </TR>

                </TABLE>



<INPUT TYPE="hidden" NAME="action" VALUE="">
<INPUT TYPE="hidden" NAME="codg_per" VALUE="<? echo $codg_per; ?>">
<INPUT TYPE="hidden" NAME="codg_grem" VALUE="<? echo $codg_grem; ?>">
<INPUT TYPE="hidden" NAME="pasada" VALUE="1">

<CENTER><INPUT class="mini" TYPE="SUBMIT" VALUE="Actualizar" onClick="ingresar()">&nbsp;<INPUT class="mini" TYPE="BUTTON" VALUE="Cerrar Ventana" onClick="cerrar()"></CENTER>

        </FORM>

<?
    if ($action == "ins")
  {
        $fec_dgrem = substr($fec_dgrem,6,4)."-".substr($fec_dgrem,3,2)."-".substr($fec_dgrem,0,2);
        $qry=("UPDATE bdc_datos_grem SET codg_grem=$codg_grem_new, fec_dgrem='$fec_dgrem' WHERE codg_per=$codg_per AND codg_grem=$codg_grem");
       
       mysql_query($qry);

   echo "<SCRIPT>alert('Datos Actualizados');</SCRIPT>";
   $codg_grem = "";
   $fec_dgrem = "";
   echo "<SCRIPT>window.opener.parent.DATA.actualizar();</SCRIPT>"; 
}


?>

<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">

  var frmvalidator  = new Validator("datos");

  frmvalidator.addValidation("codg_grem_new","dontselect=0","Seleccione un Gremio");

</SCRIPT>

</HTML>
