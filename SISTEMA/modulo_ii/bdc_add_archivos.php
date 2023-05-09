<?
  include ("../sesion.php");

  include ("../conex.php");
?>
<HTML>
<HEAD>
                <LINK REL="STYLESHEET" HREF="../style/normal.css" TYPE="text/css">

        <SCRIPT LANGUAGE="JavaScript" SRC="../scripts/validar.js" TYPE="text/javascript"></SCRIPT>

<?
  include ("tabs/tabs_per_add.php");
?>

<SCRIPT>
function finalizar()
{
input_box=confirm("¿Está seguro que desea Finalizar?");
if (input_box==true)

        {
        location = "../modulo_i/bdc_data.php";
        }

}

function regresar()
{
        location = "bdc_add_datos_comision_servicio.php?codg_per=<? echo $codg_per; ?>";
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
</HEAD>

<BR>
<BR>
<H2>Agregar Ficha de Personal</H2>
<?
         $consulta_datos_per=mysql_query("SELECT d.apel_per, d.nomb_per, d.naci_per, t.desc_tip_trab
                 FROM bdc_datos_per d, bdc_tip_trab t
                 WHERE d.codg_per=$codg_per AND d.codg_tip_trab=t.codg_tip_trab");

                $datos = mysql_fetch_array($consulta_datos_per);
                $apel_per = $datos["apel_per"];
                $nomb_per = $datos["nomb_per"];
                $naci_per = $datos["naci_per"];
                $desc_tip_trab = $datos["desc_tip_trab"];

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

<SCRIPT>do_tabs("Archivo", "")</SCRIPT>

<BR>

<FORM METHOD="POST" ENCTYPE="multipart/form-data" NAME="datos" ACTION="bdc_add_archivos.php">

        <TABLE BORDER="0" ALIGN="CENTER">
                <TR>
                <TD COLSPAN="2">
                <DIV ALIGN="CENTER"><P class="cabecera">Archivo</P></DIV>
                </TD>
                </TR>

                <TR>
                <TD WIDTH="150"><P ALIGN="RIGHT" class="mini">Tipo de Documento:</P></TD>
                <TD WIDTH="450"><SELECT class="campo" NAME="codg_tip_documento">
                <OPTION value="0">Seleccione...</OPTION>
                <?
                $documentos = mysql_query("SELECT codg_tip_documento, desc_tip_documento FROM bdc_tip_documento");
                if (mysql_num_rows($documentos) != 0)
                {
                    while ($documento = mysql_fetch_array($documentos))
                  {
                   echo '<OPTION VALUE="'.$documento["codg_tip_documento"];
                                       echo '"';
                                       if ($codg_tip_documento == $documento["codg_tip_documento"])
                                       {
                                          echo 'SELECTED';
                                       }
                                       echo '>'.$documento["desc_tip_documento"];
                                       echo '</OPTION>';
                  }
                }
         ?>
        </SELECT>
                </TR>

                <TR>
                <TD><P ALIGN="RIGHT" class="mini">Fecha del Documento:</P></TD>
                <TD>
                <INPUT TYPE="TEXT" NAME="fec_arc_dig" class="campo" VALUE="<? echo $fec_arc_dig; ?>" MAXLENGTH="10" SIZE="10" READONLY>
                <A HREF="#"><IMG SRC="../images/cal.gif" ALT="Haz Click para Buscar la Fecha" WIDTH="16" HEIGHT="16" BORDER="0" onClick="c1.popup('fec_arc_dig');"></A>
                </TD>
        </TR>

                <TR>
                <TD><P ALIGN="RIGHT" class="mini">Ubicaci&oacute;n:</P></TD>
                <TD COLSPAN="6"><INPUT class="campo" TYPE="FILE" NAME="imgn_arc_dig" SIZE="50"></TD>
                </TR>

                <TR>
                <TD COLSPAN="2"><HR></TD>
                </TR>

        </TABLE>


<CENTER><INPUT class="mini" TYPE="SUBMIT" VALUE="Agregar" onClick="ingresar();">&nbsp;<INPUT class="mini" TYPE="BUTTON" VALUE="<< Regresar" onclick="regresar()">&nbsp;<INPUT class="mini" TYPE="BUTTON" VALUE="Finalizar" onclick="finalizar()"></CENTER>


<INPUT TYPE="HIDDEN" NAME="action" VALUE="">
<INPUT TYPE="HIDDEN" NAME="codg_per" VALUE="<? echo $codg_per; ?>">

</FORM>
<?
if ($action == "ins")
{
$fec_arc_dig = substr($fec_arc_dig,6,4)."-".substr($fec_arc_dig,3,2)."-".substr($fec_arc_dig,0,2);

                 if ( $imgn_arc_dig != "" )
                {
                   $tamanio = $_FILES["imgn_arc_dig"]["size"];
                   $tip_imgn_arc_dig = $_FILES['imgn_arc_dig']['type'];

                   $fp = fopen($imgn_arc_dig, "rb");
                   $contenido = fread($fp, $tamanio);
                   $contenido = addslashes($contenido);
                   fclose($fp);
                }
        $consulta_ver_archivos = mysql_query("SELECT * FROM bdc_archivos WHERE codg_per=$codg_per AND codg_tip_documento = $codg_tip_documento");

    if (mysql_num_rows($consulta_ver_archivos) != 0)
        {
                  echo "<SCRIPT>alert('Archivo ya Existe');</SCRIPT>";
                }
        else
            {
               $qry = "INSERT INTO bdc_archivos values ($codg_per, $codg_tip_documento, '$tip_imgn_arc_dig', '$contenido', '$fec_arc_dig')";
               mysql_query($qry);
               echo "<SCRIPT>alert('Archivo Agregado');</SCRIPT>";
                }
}
?>

<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">

  var frmvalidator  = new Validator("datos");

  frmvalidator.addValidation("codg_tip_documento","dontselect=0","Seleccione un Tipo de Documento");

  frmvalidator.addValidation("imgn_arc_dig","req","Seleccione un Archivo");

  frmvalidator.addValidation("fec_arc_dig","req","Seleccione la Fecha de Documento");

  frmvalidator.setAddnlValidationFunction("actualizar");

</SCRIPT>
<?
                $consulta_archivos = mysql_query("SELECT g.desc_tip_documento FROM bdc_archivos d, bdc_tip_documento g WHERE d.codg_per=$codg_per AND d.codg_tip_documento = g.codg_tip_documento");

                 if (mysql_num_rows($consulta_archivos) != 0)
                 {
                    echo '<TABLE BORDER="0" ALIGN="CENTER">
                       <TR>
                       <TD WIDTH="400">
                       <DIV ALIGN="CENTER"><P class="cabecera">Archivos Registrados</P></DIV>
                       </TD>
                       </TR>';
                    while ($consulta = mysql_fetch_array($consulta_archivos))
                    {
                     echo '<TR>
                           <TD><P ALIGN="LEFT" class="campo">'.$consulta['desc_tip_documento'];'</P></TD>
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