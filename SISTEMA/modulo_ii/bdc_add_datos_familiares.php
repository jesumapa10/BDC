<?
  include ("../sesion.php");

  include ("../conex.php");
?>
<HTML>
<HEAD>
        <LINK REL="STYLESHEET" HREF="../style/normal.css" TYPE="text/css">

        <SCRIPT LANGUAGE="JavaScript" SRC="../scripts/validar.js" TYPE="text/javascript"></SCRIPT>

<SCRIPT>
function finalizar()
{
input_box=confirm("¿Está seguro que desea Finalizar?");
if (input_box==true)

{
        location = "../modulo_i/bdc_data.php";
}

}

function siguiente()
       {
        location = "bdc_add_datos_permisos.php?codg_per=<? echo $codg_per; ?>";
        }

function regresar()
       {
        location = "bdc_add_datos_gremiales.php?codg_per=<? echo $codg_per; ?>";
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

<FORM METHOD="POST" NAME="datos" action="">

        <TABLE BORDER="0" ALIGN="CENTER">
                <TR>
                <TD COLSPAN="2">
                <DIV ALIGN="CENTER"><P class="cabecera">Datos Familiares</P></DIV>
                </TD>
                </TR>

                <TR>
                <TD WIDTH="150"><P ALIGN="RIGHT" class="mini">C&eacute;dula del Familiar:</P></TD>
                <TD WIDTH="250"><INPUT class="campo" TYPE="TEXT" NAME="codg_carga_fam" MAXLENGTH="9" SIZE="8" VALUE="<? echo $cogd_carga_fam; ?>"></TD>
                </TR>

                <TR>
                <TD><P ALIGN="RIGHT" class="mini">Nombre(s):</P></TD>
                <TD><INPUT class="campo" TYPE="TEXT" NAME="nomb_carga_fam" MAXLENGHT="30" SIZE="30"></TD>
                </TR>

                <TR>
                <TD><P ALIGN="RIGHT" class="mini">Apellido(s):</P></TD>
                <TD><INPUT class="campo" TYPE="TEXT" NAME="apel_carga_fam" MAXLENGHT="30" SIZE="30"></TD>
                </TR>

                <TR>
                <TD><P ALIGN="RIGHT" class="mini">Fecha de Nacimiento:</P></TD>
                <TD>
                <INPUT TYPE="TEXT" NAME="fec_nac_carga_fam" class="campo" VALUE="<? echo $fec_nac_carga_fam; ?>" MAXLENGTH="10" SIZE="10" READONLY>
                <A HREF="#"><IMG SRC="../images/cal.gif" ALT="Haz Click para Buscar la Fecha" WIDTH="16" HEIGHT="16" BORDER="0" onClick="c1.popup('fec_nac_carga_fam');"></A>
                </TD>
                </TR>

                <TR>
                <TD><P ALIGN="RIGHT" class="mini">Sexo:</P></TD>
                <TD><SELECT class="campo" NAME="sexo_carga_fam">
                <OPTION value="0" >Seleccione...</OPTION>
                <OPTION value="F" <? if ($sexo_carga_fam == "F") {echo 'SELECTED';}?>>Femenino</OPTION>
                <OPTION value="M" <? if ($sexo_carga_fam == "M") {echo 'SELECTED';}?>>Masculino</OPTION>
                </SELECT></TD>
                </TR>

                <TR>
                <TD><P ALIGN="RIGHT" class="mini">Parentesco:</P></TD>
                <TD><SELECT class="campo" NAME="paren_carga_fam">
                <OPTION value="0">Seleccione...</OPTION>
                <OPTION value="C" <? if ($paren_carga_fam == "C") {echo 'SELECTED';}?>>Cónyugue</OPTION>
                <OPTION value="H" <? if ($paren_carga_fam == "H") {echo 'SELECTED';}?>>Hijo</OPTION>
                <OPTION value="M" <? if ($paren_carga_fam == "M") {echo 'SELECTED';}?>>Madre</OPTION>
                <OPTION value="P" <? if ($paren_carga_fam == "P") {echo 'SELECTED';}?>>Padre</OPTION>
                </SELECT></TD>
                </TR>

                <TR>
                <TD><P ALIGN="RIGHT" class="mini">¿Estudia Actualmente?</P></TD>
                <TD><P ALIGN="LEFT" class="campo" VALIGN="CENTER">Si&nbsp;<INPUT NAME="estudia_carga_fam" TYPE="RADIO" VALUE="S" <? if ($estudia_carga_fam == "S") {echo 'SELECTED';}?>>&nbsp;No&nbsp;<INPUT NAME="estudia_carga_fam" TYPE="RADIO" VALUE="N" <? if ($estudia_carga_fam == "N") {echo 'SELECTED';}?>></P></TD>
                </TR>

                <TR>
                <TD WIDTH="150"><P ALIGN="RIGHT" class="mini">Nivel de Instrucci&oacute;n:</P></TD>
                <TD WIDTH="250"><SELECT class="campo" NAME="nivel_est_carga_fam">
                <OPTION value="0">Seleccione...</OPTION>
                <OPTION value="P" <? if ($nivel_est_carga_fam == "P") {echo 'SELECTED';}?>>Primaria</OPTION>
                <OPTION value="B" <? if ($nivel_est_carga_fam == "B") {echo 'SELECTED';}?>>Bachillerato</OPTION>
                <OPTION value="M" <? if ($nivel_est_carga_fam == "M") {echo 'SELECTED';}?>>Media</OPTION>
                <OPTION value="U" <? if ($nivel_est_carga_fam == "U") {echo 'SELECTED';}?>>Universitaria</OPTION>
                <OPTION value="A" <? if ($nivel_est_carga_fam == "A") {echo 'SELECTED';}?>>A</OPTION>
                <OPTION value="E" <? if ($nivel_est_carga_fam == "E") {echo 'SELECTED';}?>>E</OPTION>
                </SELECT></TD>
                </TR>

                <TR>
                <TD COLSPAN="2"><HR></TD>
                </TR>

        </TABLE>


<CENTER><INPUT class="mini" TYPE="SUBMIT" VALUE="Agregar" onClick="ingresar()">&nbsp;<INPUT class="mini" TYPE="BUTTON" VALUE="<< Regresar" onClick="regresar()">&nbsp;<INPUT class="mini" TYPE="BUTTON" VALUE="Siguiente >>" onClick="siguiente()">&nbsp;<INPUT class="mini" TYPE="BUTTON" VALUE="Finalizar" onClick="finalizar()"></CENTER>

<INPUT TYPE="HIDDEN" NAME="action" VALUE="">
<INPUT TYPE="HIDDEN" NAME="codg_per" VALUE="<? echo $codg_per; ?>">


</FORM>
<?
if ($action == "ins")
 {
  $consulta_familiar = mysql_query("SELECT * FROM bdc_carga_fam WHERE codg_per=$codg_per AND codg_carga_fam=$codg_carga_fam");
  if (mysql_num_rows($consulta_familiar) != 0)
     {
        echo "<SCRIPT>alert('La Cédula del Familiar ya Existe');</SCRIPT>";
     }
     else
       {
        $fec_nac_carga_fam = substr($fec_nac_carga_fam,6,4)."-".substr($fec_nac_carga_fam,3,2)."-".substr($fec_nac_carga_fam,0,2);
        if (($paren_carga_fam == "0") || ($paren_carga_fam == "")){$paren_carga_fam = "NULL";}
        if (($estudia_carga_fam == "0") || ($estudia_carga_fam == "")){$estudia_carga_fam = "NULL";}
        if (($nivel_est_carga_fam == "0") || ($nivel_est_carga_fam == "")){$nivel_est_carga_fam = "NULL";}

                $consulta_ver_familiar = mysql_query("SELECT * FROM bdc_carga_fam WHERE codg_per=$codg_per AND codg_carga_fam = $codg_carga_fam");
        if (mysql_num_rows($consulta_ver_familiar) != 0)
         {
                    echo "<SCRIPT>alert('Familiar ya Existe');</SCRIPT>";
                 }
            else
         {
            $qry="INSERT INTO bdc_carga_fam values ($codg_per, $codg_carga_fam,
                         '$apel_carga_fam', '$nomb_carga_fam', '$fec_nac_carga_fam',
                         '$sexo_carga_fam', '$paren_carga_fam',
                         '$estudia_carga_fam', '$nivel_est_carga_fam')";

            mysql_query($qry);

            echo "<SCRIPT>alert('Datos Agregados');</SCRIPT>";
            $fec_nac_carga_fam = "";
            $sexo_carga_fam = "";
            $paren_carga_fam = "";
            $nivel_est_carga_fam = "";
                  }
        }
  }

  //echo '<BR>';

   $consulta_familiares = mysql_query("SELECT * FROM bdc_carga_fam WHERE codg_per=$codg_per");

   if (mysql_num_rows($consulta_familiares) != 0)
    {
            echo '<TABLE BORDER="0" ALIGN="CENTER">';

            echo '<TR>
                 <TD COLSPAN="4">
                 <DIV ALIGN="CENTER"><P class="cabecera">Datos Familiares Registrados</P></DIV>
                 </TD>
                 </TR>

                 <TR>
                   <TD><P ALIGN="CENTER" class="mini">C&eacute;dula</P></TD>

                   <TD><P ALIGN="CENTER" class="mini">Nombres</P></TD>

                   <TD><P ALIGN="CENTER" class="mini">Apellidos</P></TD>

                   <TD><P ALIGN="CENTER" class="mini">Parentesco</P></TD>

                  </TR>';
          while ($consulta = mysql_fetch_array($consulta_familiares))
              {
                 echo '<TR>';
                 echo '<TD><P ALIGN="LETF" class="campo">'.$consulta['codg_carga_fam'].'</P></TD>';
                 echo '<TD><P ALIGN="LETF" class="campo">'.$consulta['nomb_carga_fam'].'</P></TD>';
                 echo '<TD><P ALIGN="LETF" class="campo">'.$consulta['apel_carga_fam'].'</P></TD>';
                 echo '<TD><P ALIGN="LETF" class="campo">'; if($consulta['paren_carga_fam']=="C"){echo "Cónyugue";}
                                                            if($consulta['paren_carga_fam']=="P"){echo "Padre";}
                                                            if($consulta['paren_carga_fam']=="M"){echo "Madre";}
                                                            if($consulta['paren_carga_fam']=="H"){echo "Hijo";}
                                                            echo'</P></TD>';
                 echo '</TR>';
               }
    }
        else
        {
            echo '<CENTER><P><B class="rojo">No Posee Registros</B></CENTER>';
        }

?>

<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">

  var frmvalidator  = new Validator("datos");

  frmvalidator.addValidation("codg_carga_fam","req","Ingrese la Cédula del Familiar");
  frmvalidator.addValidation("codg_carga_fam","num");
  frmvalidator.addValidation("codg_carga_fam","minlen=6","El Mínimo de Caracteres para la Cédula es 6");

  frmvalidator.addValidation("nomb_carga_fam","req","Ingrese el Nombre del Familiar");
  frmvalidator.addValidation("nomb_carga_fam","alphanum");

  frmvalidator.addValidation("apel_carga_fam","req","Ingrese el Apellido del Familiar");
  frmvalidator.addValidation("apel_carga_fam","alphanum");

  frmvalidator.addValidation("fec_nac_carga_fam","req","Seleccione la Fecha de Nacimietos del Familiar");

  frmvalidator.addValidation("sexo_carga_fam","dontselect=0","Seleccione el Sexo del Familiar");

 // frmvalidator.setAddnlValidationFunction("actualizar");

</SCRIPT>

</HTML>