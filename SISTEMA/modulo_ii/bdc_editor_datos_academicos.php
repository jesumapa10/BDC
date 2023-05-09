<?
  include ("../sesion.php");

  include ("../conex.php");
?>
<HTML>
<HEAD>
<TITLE>Editar Datos Académicos</TITLE>
 <LINK REL="STYLESHEET" HREF="../style/normal.css" TYPE="text/css">

        <SCRIPT LANGUAGE="JavaScript" SRC="../scripts/validar.js" TYPE="text/javascript"></SCRIPT>
		<script language='javascript' src="popcalendar.js"></script>
<SCRIPT>
function cambiar()
{
        datos.submit();
}
function cerrar()

{
         window.close()
}
function finalizar()
{
input_box=confirm("¿Está seguro que desea Finalizar?");
if (input_box==true)

{
        location = "../modulo_i/bdc_data.php";
}

}


function ingresar()
{
        datos.action.value="ins";
        datos.pasada.value="1";

}
</SCRIPT>

<SCRIPT LANGUAGE="JavaScript" SRC="../scripts/calendario.js" TYPE="text/javascript"></SCRIPT>

<SCRIPT LANGUAGE="JavaScript" SRC="../scripts/cal-barra.js" TYPE="text/javascript"></SCRIPT>

<SCRIPT LANGUAGE="JavaScript">
        var c1 = new CodeThatCalendar(caldef1);
</SCRIPT>

</HEAD>


<BR>
<H2>Editar Datos Acad&eacute;micos</H2>
<?
if ($pasada != 1)
  {
     $consulta_datos_acad=mysql_query("SELECT *
                 FROM bdc_datos_acad
                 WHERE codg_per=$codg_per AND codg_mov=$codg_mov");

                $datos = mysql_fetch_array($consulta_datos_acad);
			  $codg_mov = $datos["codg_mov"];
			  $codg_per = $datos["codg_per"];
			  $codg_niv_inst = $datos["codg_niv_inst"];
			  $estudia_act = $datos["estudia_act"];
			  $codg_car = $datos["codg_car"];
			  $estudia_sem = $datos["estudia_sem"];
			  $fec_grado = $datos["fec_grado"];
			  $fec_grado = substr($fec_grado,8,2)."-".substr($fec_grado,5,2)."-".substr($fec_grado,0,4);
			  $odg_mov = $datos["odg_mov"];
  }

if ($action == "ins")
{
        if ($estudia_sem == 0){$estudia_sem = "NULL"; }
         if ($fec_grado != "")
        {
         $fec_grado = substr($fec_grado,6,4)."-".substr($fec_grado,3,2)."-".substr($fec_grado,0,2);
        }
        else
        {$fec_grado="0000-00-00";}
		
        $qry=("UPDATE bdc_datos_acad SET codg_niv_inst=$codg_niv_inst, estudia_act='$estudia_act', codg_car=$codg_car, estudia_sem=$estudia_sem, fec_grado='$fec_grado'  WHERE codg_mov=$codg_mov");

         mysql_query($qry);
            echo "<SCRIPT>alert('Datos Actualizados');</SCRIPT>";
			echo "<SCRIPT>window.opener.parent.DATA.actualizar();</SCRIPT>";
			echo "<SCRIPT>cerrar();</SCRIPT>";
}

?>

<BR>

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
<FORM METHOD="POST" NAME="datos" action="">

        <TABLE BORDER="0" ALIGN="CENTER">
                <TR>
                <TD COLSPAN="4">
                <DIV ALIGN="CENTER">
                  <P class="cabecera">Datos Acad&eacute;micos </P>
                </DIV>
                </TD>
                </TR>

                <TR>
<TD width="135" class="mini"><span class="mini">Nivel de Instrucci&oacute;n:</span></TD>
                <TD width="405" COLSPAN="3"><SELECT class="campo" NAME="codg_niv_inst">
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
                </SELECT></TD>
                </TR>

                <TR>
                  <TD class="mini">Carrera:</TD>
                  <TD COLSPAN="3">
				  <?PHP
				  echo '<SELECT class="campo" NAME="codg_car">';
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
				  ?>				  </TD>
                </TR>
                <TR>
                  <TD class="mini">Estudia Actualmente: </TD>
                  <TD COLSPAN="3"><SELECT NAME="estudia_act" class="campo" id="estudia_act">
                    <OPTION value="0">Seleccione...</OPTION>
                    <OPTION VALUE="S" <? if ($estudia_act == "S") {echo 'SELECTED';}?> >Si</OPTION>
                    <OPTION VALUE="N" <? if ($estudia_act == "N") {echo 'SELECTED';}?> >No</OPTION>
                  </SELECT></TD>
                </TR>
                <TR>
                  <TD class="mini">Semestre / A&ntilde;o</TD>
                  <TD COLSPAN="3"><select name="estudia_sem" class="campo" id="estudia_sem">
                    <option value="0" <? if ($estudia_sem == "0") {echo 'SELECTED';}?>>Seleccione...</option>
                    <option value="1" <? if ($estudia_sem == "1") {echo 'SELECTED';}?>>1er </option>
                    <option value="2" <? if ($estudia_sem == "2") {echo 'SELECTED';}?>>2do</option>
                    <option value="3" <? if ($estudia_sem == "3") {echo 'SELECTED';}?>>3er</option>
                    <option value="4" <? if ($estudia_sem == "4") {echo 'SELECTED';}?>>4to</option>
                    <option value="5" <? if ($estudia_sem == "5") {echo 'SELECTED';}?>>5to</option>
                    <option value="6" <? if ($estudia_sem == "6") {echo 'SELECTED';}?>>6to</option>
                    <option value="7" <? if ($estudia_sem == "7") {echo 'SELECTED';}?>>7mo</option>
                    <option value="8" <? if ($estudia_sem == "8") {echo 'SELECTED';}?>>8vo</option>
                    <option value="9" <? if ($estudia_sem == "9") {echo 'SELECTED';}?>>9no</option>
                    <option value="10" <? if ($estudia_sem == "10") {echo 'SELECTED';}?>>10mo</option>
                  </select></TD>
                </TR>
                <TR>
                  <TD class="mini">Fecha de Grado </TD>
                  <TD COLSPAN="3">
				  <?PHP $formato_fecha = "'dd-mm-yyyy'"; echo '<INPUT TYPE="TEXT" NAME="fec_grado" class="campo" VALUE="'.$fec_grado.'" MAXLENGTH="10" SIZE="10" id="fec_grado" onClick="popUpCalendar(this, datos.fec_grado, '.$formato_fecha.');" READONLY> 
            <IMG onClick="popUpCalendar(this, datos.fec_grado, '.$formato_fecha.');" SRC="../images/cal.gif" ALT="Haz Click para Buscar la Fecha" WIDTH="16" HEUGHT="16" BORDER="0">'; ?>				  </TD>
                </TR>

                <TR>
                <TD COLSPAN="4"><HR></TD>
                </TR>


        </TABLE>


<CENTER><INPUT class="mini" TYPE="SUBMIT" VALUE="Actualizar" onClick="ingresar()">
&nbsp;<INPUT class="mini" TYPE="BUTTON" VALUE="Cerrar Ventana" onClick="cerrar()"></CENTER>

<INPUT TYPE="hidden" NAME="action" VALUE="">
<INPUT TYPE="hidden" NAME="codg_per" VALUE="<? echo $codg_per; ?>">
<INPUT TYPE="hidden" NAME="codg_insti" VALUE="<? echo $codg_insti; ?>">
<INPUT TYPE="hidden" NAME="pasada" VALUE="1">

</FORM>
<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">

  var frmvalidator  = new Validator("datos");

  frmvalidator.addValidation("codg_niv_inst","dontselect=0","Seleccione el Nivel de Instruccion de la persona");
  frmvalidator.addValidation("codg_car","dontselect=0","Seleccione la Carrera");
  frmvalidator.addValidation("estudia_act","dontselect=0","Seleccione ¿Estudia Actualmente?");
</SCRIPT>

</BODY>
</HTML>
