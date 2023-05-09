<?
  include ("../sesion.php");

  include ("../conex.php");
?>
<HTML>
<HEAD>
        <LINK REL="STYLESHEET" HREF="../style/normal.css" TYPE="text/css">

        <SCRIPT LANGUAGE="JavaScript" SRC="../scripts/validar.js" TYPE="text/javascript"></SCRIPT>
<script language='javascript' src="popcalendar.js"></script>
<SCRIPT>

function cerrar()

{
         window.close()
}



function cambiar()
{
        datos.submit();
}

function ingresar()
{
        datos.action.value="ins";
}

</SCRIPT>

<SCRIPT LANGUAGE="JavaScript" SRC="../scripts/calendario.js" TYPE="text/javascript"></SCRIPT>

<SCRIPT LANGUAGE="JavaScript" SRC="../scripts/cal-barra.js" TYPE="text/javascript"></SCRIPT>

<SCRIPT LANGUAGE="JavaScript">
        var c1 = new CodeThatCalendar(caldef1);
</SCRIPT>
<title>Agregar datos Gremiales</title>
</HEAD>

<BR>

<H2>Agregar Ficha de Personal</H2>
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

<BR>
<FORM METHOD="POST" NAME="datos" action="bdc_mini_add_datos_gremiales.php">

        <TABLE BORDER="0" ALIGN="CENTER">
                <TR>
                <TD COLSPAN="2">
                <DIV ALIGN="CENTER"><P class="cabecera">Datos Gremiales</P></DIV>
                </TD>
                </TR>

                <TR>
                <TD WIDTH="150"><P ALIGN="RIGHT" class="mini">Gremio:</P></TD>
                <TD WIDTH="250"><SELECT class="campo" NAME="codg_grem" title="Selecione de la lista el Gremio">
                <OPTION value="0">Seleccione...</OPTION>
                <?
                $gremios = mysql_query("SELECT codg_grem, nomb_grem FROM bdc_gremios");
                if (mysql_num_rows($gremios) != 0)
                {
                    while ($gremio = mysql_fetch_array($gremios))
                  {
                   echo '<OPTION VALUE="'.$gremio["codg_grem"];
                                       echo '"';
                                       if ($codg_mun == $gremio["codg_grem"])
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
                  <TD><INPUT TYPE="TEXT" NAME="fec_dgrem" class="campo" VALUE="<? echo $fec_dgrem; ?>" MAXLENGTH="10" SIZE="10" id="fecha" onClick="popUpCalendar(this, datos.fecha, 'dd-mm-yyyy');" READONLY title="Selecione con ayuda del calendario la fecha de afiliación al gremio"> 
            <IMG onClick="popUpCalendar(this, datos.fecha, 'dd-mm-yyyy');" SRC="../images/cal.gif" ALT="Haz Click para Buscar la Fecha" WIDTH="16" HEUGHT="16" BORDER="0">
                  </TD>
                </TR>
                <TR>
                <TD COLSPAN="2"><HR></TD>
                </TR>
        </TABLE>
<CENTER><INPUT class="mini" TYPE="SUBMIT" VALUE="Agregar" onClick="ingresar()" title="Haga click para almacenar los datos">&nbsp;<INPUT class="mini" TYPE="BUTTON" VALUE="Cerrar Ventana" onClick="cerrar()" title="Haga click para cerrar la ventana actual"></CENTER>

<INPUT TYPE="HIDDEN" NAME="action" VALUE="">
<INPUT TYPE="HIDDEN" NAME="codg_per" VALUE="<? echo $codg_per; ?>">

</FORM>

<?
if ($action == "ins")
{
   $fec_dgrem = substr($fec_dgrem,6,4)."-".substr($fec_dgrem,3,2)."-".substr($fec_dgrem,0,2);
   $qry="INSERT INTO bdc_datos_grem values ($codg_per, $codg_grem, '$fec_dgrem')";

   mysql_query($qry);

   echo "<SCRIPT>alert('Datos Agregados');</SCRIPT>";
   $codg_grem = "";
   $fec_dgrem = "";
   echo "<SCRIPT>window.opener.parent.DATA.actualizar();</SCRIPT>"; 
}
?>

<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">

  var frmvalidator  = new Validator("datos");

  frmvalidator.addValidation("codg_grem","dontselect=0","Seleccione un Gremio");

//  frmvalidator.setAddnlValidationFunction("actualizar");

</SCRIPT>

           <?
                $consulta_gremios = mysql_query("SELECT g.nomb_grem FROM bdc_datos_grem d, bdc_gremios g WHERE d.codg_per=$codg_per AND d.codg_grem=g.codg_grem");

                 if (mysql_num_rows($consulta_gremios) != 0)
                 {
                    echo '<TABLE BORDER="0" ALIGN="CENTER">
                       <TR>
                       <TD WIDTH="400">
                       <DIV ALIGN="CENTER"><P class="cabecera">Gremios Registrados</P></DIV>
                       </TD>
                       </TR>';
                    while ($consulta = mysql_fetch_array($consulta_gremios))
                    {
                     echo '<TR>
                           <TD><P ALIGN="CENTER" class="campo">'.$consulta['nomb_grem'];'</P></TD>
                           </TR>';
                     }
                     echo '</TABLE>';
                  }
                   else
                    {
                      echo '<CENTER><P><B class="rojo">No Posee Registros</B></CENTER>';
                    }
            ?>
</HTML>
