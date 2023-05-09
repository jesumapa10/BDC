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

<SCRIPT>do_tabs("Concurso", "")</SCRIPT>

<BR>

<FORM METHOD="POST" ENCTYPE="multipart/form-data" NAME="datos" ACTION="bdc_add_concurso.php">

        <TABLE BORDER="0" ALIGN="CENTER">
                <TR>
                <TD COLSPAN="4">
                <DIV ALIGN="CENTER">
                  <P class="cabecera">Baremo de Concurso </P>
                </DIV>
                </TD>
                </TR>

                <TR>
                <TD WIDTH="300"><P ALIGN="CENTER" class="titulo">Titulo Obtenido:</P></TD>
				<TD WIDTH="150"><P ALIGN="CENTER" class="titulo">Puntos (MAX 4):</P></TD>
				<TD WIDTH="150"><P ALIGN="CENTER" class="titulo">Evaluaci&oacute;n:</P></TD>
				<TD WIDTH="150"><P ALIGN="CENTER" class="titulo">Observaciones:</P></TD>
                </TR>

                <TR>
                <TD><P ALIGN="RIGHT" class="mini">T.S.U Educaci&oacute;n:</P></TD>
               <TD><P ALIGN="CENTER" class="rojop">2</P></TD>
				<TD><P ALIGN="CENTER" class="rojop"><input type="checkbox" name="tsu" value="checkbox"></P></TD>
				<TD>
				  <textarea name="obs_tsu"></textarea>
				</TD>
        </TR>

                <TR>
                <TD><P ALIGN="RIGHT" class="mini">Licenciado en Educaci&oacute;n:</P></TD>
                <TD><P ALIGN="CENTER" class="rojop">4</P></TD>
				<TD><P ALIGN="CENTER" class="rojop"><input type="checkbox" name="lcdo" value="checkbox"></P></TD>
				<TD>
				  <textarea name="obs_lcdo"></textarea>
				</TD>
                </TR>
				
				<TR>
				<TD><P ALIGN="RIGHT" class="rojop">Total:</P></TD>
				<TD>&nbsp;</TD>
				</TR>
				
				 <TR>
                <TD WIDTH="300"><P ALIGN="CENTER" class="titulo">Experencia laboral en Direcci&oacute;n de Educaci&oacute;n:</P></TD>
				<TD WIDTH="150"><P ALIGN="CENTER" class="titulo">Puntos (MAX 8):</P></TD>
				<TD WIDTH="150"><P ALIGN="CENTER" class="titulo">Evaluaci&oacute;n:</P></TD>
				<TD WIDTH="150"><P ALIGN="CENTER" class="titulo">Observaciones:</P></TD>
                </TR>
				<TR>
                <TD><P ALIGN="RIGHT" class="mini">De 6 a 9 a&ntilde;os:</P></TD>
               <TD><P ALIGN="CENTER" class="rojop">3</P></TD>
				<TD><P ALIGN="CENTER" class="rojop"><input type="checkbox" name="de96" value="checkbox"></P></TD>
				<TD>
				  <textarea name="obs_de96"></textarea>
				</TD>
                </TR>
				
				<TR>
                <TD><P ALIGN="RIGHT" class="mini">De 6 a 12 a&ntilde;os:</P></TD>
                <TD><P ALIGN="CENTER" class="rojop">5</P></TD>
				<TD><P ALIGN="CENTER" class="rojop"><input type="checkbox" name="de512" value="checkbox"></P></TD>
				<TD>
				  <textarea name="de512"></textarea>
				</TD>
                </TR>

				<TR>
                <TD><P ALIGN="RIGHT" class="mini">De 12 a 15 a&ntilde;os:</P></TD>
                <TD><P ALIGN="CENTER" class="rojop">7</P></TD>
				<TD><P ALIGN="CENTER" class="rojop"><input type="checkbox" name="de1215" value="checkbox"></P></TD>
				<TD>
				  <textarea name="de1215"></textarea>
				</TD>
                </TR>
				
				<TR>
                <TD><P ALIGN="RIGHT" class="mini">De 15 a&ntilde;os en adelante:</P></TD>
                <TD><P ALIGN="CENTER" class="rojop">8</P></TD>
				<TD><P ALIGN="CENTER" class="rojop"><input type="checkbox" name="de15" value="checkbox"></P></TD>
				<TD>
				  <textarea name="de15"></textarea>
				</TD>
                </TR>
				<TR>
				<TD><P ALIGN="RIGHT" class="rojop">Total:</P></TD>
				<TD>&nbsp;</TD>
				</TR>
				
				 
								 <TR>
                <TD WIDTH="300"><P ALIGN="CENTER" class="titulo">Estudios de Cuarto Nivel :</P></TD>
				<TD WIDTH="150"><P ALIGN="CENTER" class="titulo">Puntos (MAX 4):</P></TD>
				<TD WIDTH="150"><P ALIGN="CENTER" class="titulo">Evaluaci&oacute;n:</P></TD>
				<TD WIDTH="150"><P ALIGN="CENTER" class="titulo">Observaciones:</P></TD>
                </TR>
				<TR>
                <TD><P ALIGN="RIGHT" class="mini">Especialista:</P></TD>
                <TD><P ALIGN="CENTER" class="rojop">1,5</P></TD>
				<TD><P ALIGN="CENTER" class="rojop"><input type="checkbox" name="esp" value="checkbox"></P></TD>
				<TD>
				  <textarea name="obs_esp"></textarea>
				</TD>
                </TR>
				
				<TR>
                <TD><P ALIGN="RIGHT" class="mini">Magister:</P></TD>
                <TD><P ALIGN="CENTER" class="rojop">2,5</P></TD>
				<TD><P ALIGN="CENTER" class="rojop"><input type="checkbox" name="mag" value="checkbox"></P></TD>
				<TD>
				  <textarea name="textarea"></textarea>
				</TD>
                </TR>
				
				<TR>
                <TD><P ALIGN="RIGHT" class="mini">Doctorado:</P></TD>
              <TD><P ALIGN="CENTER" class="rojop">4</P></TD>
				<TD><P ALIGN="CENTER" class="rojop"><input type="checkbox" name="mag" value="checkbox"></P></TD>
				<TD>
				  <textarea name="obs_mag"></textarea>
				</TD>
                </TR>
				<TR>
				<TD><P ALIGN="RIGHT" class="rojop">Total:</P></TD>
				<TD>&nbsp;</TD>
				</TR>
				
				<TR>
                <TD WIDTH="300"><P ALIGN="CENTER" class="titulo">Producciones:</P></TD>
				<TD WIDTH="150"><P ALIGN="CENTER" class="titulo">Puntos (MAX 2):</P></TD>
				<TD WIDTH="150"><P ALIGN="CENTER" class="titulo">Evaluaci&oacute;n:</P></TD>
				<TD WIDTH="150"><P ALIGN="CENTER" class="titulo">Observaciones:</P></TD>
                </TR>
				<TR>
                <TD><P ALIGN="RIGHT" class="mini">Art&iacute;culos de Prensa:</P></TD>
                <TD><P ALIGN="CENTER" class="rojop">0,25</P></TD>
				<TD><P ALIGN="CENTER" class="rojop"><input type="checkbox" name="art_pre" value="checkbox"></P></TD>
				<TD>
				  <textarea name="obs_art_pre"></textarea>
				</TD>
                </TR>
				
				<TR>
                <TD><P ALIGN="RIGHT" class="mini">Publicaciones en revistas educativas:</P></TD>
               <TD><P ALIGN="CENTER" class="rojop">0,4</P></TD>
				<TD><P ALIGN="CENTER" class="rojop"><input type="checkbox" name="pub_edu" value="checkbox"></P></TD>
				<TD>
				  <textarea name="obs_pub_edu"></textarea>
				</TD>
                </TR>
				
				<TR>
                <TD><P ALIGN="RIGHT" class="mini">Trabajos de Investigaci&oacute;n :</P></TD>
               <TD><P ALIGN="CENTER" class="rojop">2</P></TD>
				<TD><P ALIGN="CENTER" class="rojop"><input type="checkbox" name="tra_inv" value="checkbox"></P></TD>
				<TD>
				  <textarea name="obs_tra_inv"></textarea>
				</TD>
                </TR>
				<TR>
				<TD><P ALIGN="RIGHT" class="rojop">Total:</P></TD>
				<TD>&nbsp;</TD>
				</TR>

				<TR>
                <TD WIDTH="300"><P ALIGN="CENTER" class="titulo">Asistencia a Cursos:</P></TD>
				<TD WIDTH="150"><P ALIGN="CENTER" class="titulo">Puntos (MAX 2):</P></TD>
				<TD WIDTH="150"><P ALIGN="CENTER" class="titulo">Evaluaci&oacute;n:</P></TD>
				<TD WIDTH="150"><P ALIGN="CENTER" class="titulo">Observaciones:</P></TD>
                </TR>
				<TR>
                <TD><P ALIGN="RIGHT" class="mini">8 horas de Duraci&oacute;n :</P></TD>
               <TD><P ALIGN="CENTER" class="rojop">0,05</P></TD>
				<TD><P ALIGN="CENTER" class="rojop"><input type="checkbox" name="8h" value="checkbox"></P></TD>
				<TD>
				  <textarea name="obs_8h"></textarea>
				</TD>
                </TR>
				
				<TR>
                <TD><P ALIGN="RIGHT" class="mini">12 horas de Duraci&oacute;n :</P></TD>
               <TD><P ALIGN="CENTER" class="rojop">0,1</P></TD>
				<TD><P ALIGN="CENTER" class="rojop"><input type="checkbox" name="12h" value="checkbox"></P></TD>
				<TD>
				  <textarea name="obs_12h"></textarea>
				</TD>
                </TR>	
				<TR>
                <TD><P ALIGN="RIGHT" class="mini">16 horas de Duraci&oacute;n </P></TD>
               <TD><P ALIGN="CENTER" class="rojop">0,2</P></TD>
				<TD><P ALIGN="CENTER" class="rojop"><input type="checkbox" name="16h" value="checkbox"></P></TD>
				<TD>
				  <textarea name="obs_16h"></textarea>
				</TD>
                </TR>
				<TR>
				<TD><P ALIGN="RIGHT" class="rojop">Total:</P></TD>
				<TD>&nbsp;</TD>
				</TR>
				<TR>
				<TD><P ALIGN="RIGHT" class="rojop">Total General:</P></TD>
				<TD>&nbsp;</TD>
				</TR>
                <TR>
                <TD COLSPAN="4"><HR></TD>
                </TR>

        </TABLE>


<CENTER><INPUT class="mini" TYPE="SUBMIT" VALUE="Agregar" onClick="ingresar();">&nbsp;<INPUT class="mini" TYPE="BUTTON" VALUE="<< Regresar" onClick="regresar()">&nbsp;<INPUT class="mini" TYPE="BUTTON" VALUE="Finalizar" onClick="finalizar()"></CENTER>


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