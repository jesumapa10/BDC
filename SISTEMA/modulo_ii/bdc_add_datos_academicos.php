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
function estudia()
{
       if (document.datos.estudia_acad.selectedIndex == 100) {
        datos.$estudia_acad.value="$estudia_acad";
        }
        datos.submit();
}
function siguiente()
        {
        location = "bdc_add_datos_laborales.php?codg_per=<? echo $codg_per; ?>";
        }
function ingresar()
{
        datos.action.value="ins";
                datos.pasada.value="1";

}
</SCRIPT>

<SCRIPT LANGUAGE="JavaScript" SRC="/bdc/scripts/validar.js" TYPE="text/javascript"></SCRIPT>

</HEAD>

<BODY>

<?
if ($action == "ins")
{
        if ($codg_car == 0){$codg_car = "NULL"; }
        if ($sem_acad == ""){$sem_acad = "NULL"; }
        if ($postgrado_acad == ""){$postgrado_acad = "NULL"; }
        if ($postgrado_men == ""){$postgrado_men = "NULL"; }
        if ($doctorado_acad == ""){$doctorado_acad = "NULL"; }
        if ($doctorado_men == ""){$doctorado_men = "NULL"; }

        $qry="INSERT INTO bdc_datos_acad VALUES ($codg_per, $codg_niv_inst,
                         $codg_men, '$estudia_acad', $codg_car, $sem_acad, '$postgrado_acad', '$postgrado_men',
                         '$doctorado_acad', '$doctorado_men')";

        mysql_query ($qry);
        echo "<SCRIPT>alert('Datos Agregados');</SCRIPT>";
}

        $consulta_acad = mysql_query("SELECT * FROM bdc_datos_acad WHERE codg_per=$codg_per");
   if (mysql_num_rows($consulta_acad) != 0)
    {
           $datos_acad = mysql_fetch_array($consulta_acad);
           $boton="DISABLED";
           $codg_niv_inst = $datos_acad['1'];
           $codg_men = $datos_acad['2'];
           $estudia_acad = $datos_acad['3'];
           $codg_car = $datos_acad['4'];
           $sem_acad = $datos_acad['5'];
           $postgrado_acad = $datos_acad['6'];
           $postgrado_men = $datos_acad['7'];
           $doctorado_acad = $datos_acad['10'];
           $doctorado_men = $datos_acad['11'];
    }
   else
   {
       $boton="ENABLED";
   }

?>
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

<FORM METHOD="POST" NAME="datos" action="">

        <TABLE BORDER="0" ALIGN="CENTER">
                <TR>
                <TD COLSPAN="4">
                <DIV ALIGN="CENTER"><P class="cabecera">Datos Acad&eacute;micos</P></DIV>
                </TD>
                </TR>

                <TR>
                <TD WIDTH="150"><P ALIGN="RIGHT" class="mini">Nivel de Instrucci&oacute;n:</P></TD>
                <TD WIDTH="250"><SELECT class="campo" NAME="codg_niv_inst">
                <OPTION value="0">Seleccione...</OPTION>
                 <? $niveles_inst = mysql_query("SELECT codg_niv_inst, desc_niv_inst FROM bdc_niv_inst ORDER BY 2");
                if (mysql_num_rows($niveles_inst) != 0)
                {
                    while ($nivel_inst = mysql_fetch_array($niveles_inst))
                  {
                   echo '<OPTION VALUE="'.$nivel_inst["codg_niv_inst"];
                                       echo '"';
                                       if ($codg_niv_inst == $nivel_inst["codg_niv_inst"])
                                       {
                                          echo 'SELECTED';
                                       }
                                       echo '>'.$nivel_inst["desc_niv_inst"];
                                       echo '</OPTION>';
                  }
                }
                ?>
                </SELECT>
                </TD>
                </TR>

                <TR>
                <TD><P ALIGN="RIGHT" class="mini">Menci&oacute;n:</P></TD>
                <TD><SELECT class="campo" NAME="codg_men">
                <OPTION value="0">Seleccione...</OPTION>
                <? $menciones = mysql_query("SELECT codg_men, desc_men FROM bdc_mencion ORDER BY 2");
                if (mysql_num_rows($menciones) != 0)
                {
                    while ($mencion = mysql_fetch_array($menciones))
                  {
                   echo '<OPTION VALUE="'.$mencion["codg_men"];
                                       echo '"';
                                       if ($codg_men == $mencion["codg_men"])
                                       {
                                          echo 'SELECTED';
                                       }
                                       echo '>'.$mencion["desc_men"];
                                       echo '</OPTION>';
                  }
                }
                ?>
                </SELECT>
                </TD>
                </TR>

                <TR>
                <TD><P ALIGN="RIGHT" class="mini">¿Estudia Actualmente?</P></TD>
                <TD><SELECT class="campo" NAME="estudia_acad" onChange="estudia()">
                <OPTION value="0">Seleccione...</OPTION>
                <OPTION VALUE="S" <? if ($estudia_acad == "S") {echo 'SELECTED';}?> >Si</OPTION>
                <OPTION VALUE="N" <? if ($estudia_acad == "N") {echo 'SELECTED';}?> >No</OPTION>
                </SELECT></TD>
                </TR>

                <?
                if ($estudia_acad == "S")
                  {
                        echo '<TR>';
                        echo '<TD><P ALIGN="RIGHT" class="mini">Carrera:</P></TD>';
                        echo '<TD><SELECT class="campo" NAME="codg_car">';
                        echo '<OPTION value="0">Seleccione...</OPTION>';
                           $carreras = mysql_query("SELECT codg_car, desc_car FROM bdc_carreras ORDER BY 2");
                if (mysql_num_rows($carreras) != 0)
                {
                    while ($carrera = mysql_fetch_array($carreras))
                  {
                   echo '<OPTION VALUE="'.$carrera["codg_car"];
                                       echo '"';
                                       if ($codg_car == $carrera["codg_car"])
                                       {
                                          echo 'SELECTED';
                                       }
                                       echo '>'.$carrera["desc_car"];
                                       echo '</OPTION>';
                  }
                }

            echo '</SELECT>';
                    echo '</TD>';
                        echo '</TR>';

                        echo '<TR>';
                        echo '<TD><P ALIGN="RIGHT" class="mini">Semestre / A&ntilde;o:</P></TD>';
                        echo '<TD><INPUT TYPE="TEXT" class="campo" VALUE="'.$sem_acad.'" NAME="sem_acad" SIZE="1" MAXLENGTH="2"></TD>';
                        echo '</TR>';
                  }
            ?>

                <TR>
                <TD><P ALIGN="RIGHT" class="mini">¿Tiene Postgrado?</P></TD>
                <TD><P ALIGN="LEFT" class="campo" VALIGN="CENTER">&nbsp;Si&nbsp;<INPUT NAME="postgrado_acad" TYPE="RADIO" VALUE="S" <? if ($postgrado_acad == "S") {echo 'CHECKED';}?>>&nbsp;&nbsp;No&nbsp;<INPUT NAME="postgrado_acad" TYPE="RADIO" VALUE="N" <? if ($postgrado_acad == "N") {echo 'CHECKED';}?>></P></TD>
                <TD><P ALIGN="RIGHT" class="mini">Mención ó Especialidad:</P></TD>
                <TD><INPUT class="campo" TYPE="TEXT" NAME="postgrado_men" MAXLENGHT="30" SIZE="30" VALUE="<? if ($postgrado_men != "NULL") {echo $postgrado_men;} ?>"></TD>
                </TR>


                <TR>
                <TD><P ALIGN="RIGHT" class="mini">¿Tiene Doctorado?</P></TD>
                <TD><P ALIGN="LEFT" class="campo" VALIGN="CENTER">&nbsp;Si&nbsp;<INPUT NAME="doctorado_acad" TYPE="RADIO" VALUE="S" <? if ($doctorado_acad == "S") {echo 'CHECKED';}?>>&nbsp;&nbsp;No&nbsp;<INPUT NAME="doctorado_acad" TYPE="RADIO" VALUE="N" <? if ($doctorado_acad == "N") {echo 'CHECKED';}?>></P></TD>
                <TD><P ALIGN="RIGHT" class="mini">Mención ó Especialidad:</P></TD>
                <TD><INPUT class="campo" TYPE="TEXT" NAME="doctorado_men" MAXLENGHT="30" SIZE="30" VALUE="<? if ($doctorado_men != "NULL") {echo $doctorado_men;} ?>"></TD>
                </TR>

                <TR>
                <TD COLSPAN="4"><HR></TD>
                </TR>

        </TABLE>

<CENTER>
    <INPUT name="Agregar" TYPE="SUBMIT" class="mini" onClick="ingresar();" VALUE="Agregar" <? echo $boton; ?>>
    &nbsp;<INPUT class="mini" TYPE="BUTTON" VALUE="Siguiente >>" onClick="siguiente()">&nbsp;<INPUT class="mini" TYPE="BUTTON" VALUE="Finalizar" onClick="finalizar()"></CENTER>

<INPUT TYPE="HIDDEN" NAME="action" VALUE="">
<INPUT TYPE="HIDDEN" NAME="codg_per" VALUE="<? echo $codg_per; ?>">

</FORM>

<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">

  var frmvalidator  = new Validator("datos");

  frmvalidator.addValidation("codg_niv_inst","dontselect=0","Seleccione el Nivel de Instruccion de la persona");

  frmvalidator.addValidation("codg_men","dontselect=0","Seleccione la Mención de la Persona");

  frmvalidator.addValidation("estudia_acad","dontselect=0","Seleccione ¿Estudia Actualmente?");

<?
if ($estudia_acad == "S")
  {
  echo 'frmvalidator.addValidation("codg_car","dontselect=0","Seleccione la Carrera");';

  echo 'frmvalidator.addValidation("sem_acad","req","El Semestre o Año es requerido");';
  echo 'frmvalidator.addValidation("sem_acad","num","El Semestre o Año, sólo acepta caracteres numérico");';
  }
?>

<?
  if ($postgrado_acad == "S")
   {
    echo 'frmvalidator.addValidation("postgrado_men","req","La mención o especialidad del postgrado es requerida");';
   }
?>

<?
  if ($doctorado_acad == "S")
   {
    echo 'frmvalidator.addValidation("doctorado_men","req","La mención o especialidad del doctorado es requerida");';
   }
?>

</SCRIPT>
</BODY>
</HTML>