<?
  include ("../sesion.php");

  include ("../conex.php");

  $consulta_tramites = mysql_query ("SELECT codg_tram, desc_tram FROM bdc_tramites ORDER BY 2");
?>

<HTML>
<HEAD>
        <LINK REL="STYLESHEET" HREF="../style/normal.css" TYPE="text/css">
        <SCRIPT LANGUAGE="JavaScript" SRC="../scripts/validar.js" TYPE="text/javascript"></SCRIPT>
</HEAD>

<BODY>
<BR><BR>
<H2>Agregar Pasos a un Trámite</H2>

        <FORM METHOD="POST" NAME="datos" ACTION="bdc_add_pasos.php">
        <TABLE ALIGN=CENTER BORDER="0">

                <TR>
                <TD><P ALIGN="RIGHT" class="mini">Tr&aacute;mite:</P></TD>
                <TD><SELECT class="campo" NAME="codg_tram">
                         <OPTION VALUE="0">Seleccione...</OPTION>
                         <?
                         while ($tramites = mysql_fetch_array($consulta_tramites))
                         {
                         echo '<OPTION VALUE="'.$tramites["codg_tram"]; echo '">'.$tramites["desc_tram"]; echo '</OPTION>';
                         };
                         ?>
                         </SELECT>
                </TD>
                </TR>

                <TR>
                <TD><P class="mini" ALIGN="RIGHT">N&uacute;mero del paso:</TD>
                <TD><INPUT class="campo" TYPE="TEXT" NAME="codg_paso" SIZE="1" MAXLENGTH="2" VALUE="<? echo $codg_paso; ?>"></TD>
                </TR>

                <TR>
                <TD WIDTH="150"><P class="mini" ALIGN="RIGHT">Nombre del Paso:</P></TD>
                <TD WIDTH="350"><INPUT class="campo" TYPE="TEXT" NAME="nomb_paso" MAXLENGTH="50" SIZE="50" VALUE="<? echo $nomb_paso; ?>"></TD>
                </TR>

                <TR>
                <TD><P class="mini" ALIGN="RIGHT">D&iacute;as de Duraci&oacute;n del Paso:</TD>
                <TD><INPUT class="campo" TYPE="TEXT" NAME="dias_paso" SIZE="1" MAXLENGTH="2" VALUE="<? echo $dias_paso; ?>"></TD>
                </TR>

                <TR>
                <TD COLSPAN="2"><CENTER><INPUT class="mini" TYPE="SUBMIT" VALUE="Agregar"></CENTER></TD>
                </TR>

        </TABLE>

        <INPUT TYPE="HIDDEN" NAME="action" VALUE="ins">

        </FORM>

<?
if ($action == "ins")
  {
          $comprobar_codigo = mysql_query("SELECT * FROM bdc_pasos WHERE codg_tram=$codg_tram and codg_paso=$codg_paso");
          $comprobar_nombre = mysql_query("SELECT * FROM bdc_pasos WHERE codg_tram=$codg_tram and codg_paso=$codg_paso");

          if (mysql_num_rows($comprobar_codigo) != 0)
            {
                    echo "<SCRIPT>alert('El Número de Paso ya Existe');</SCRIPT>";
            }

          else if (mysql_num_rows($comprobar_nombre) != 0)
            {
                    echo "<SCRIPT>alert('El Nombre del Paso ya Existe');</SCRIPT>";
            }

          else
            {
                    if ($dias_paso == "") {($dias_paso = "NULL");}
                    mysql_query ("INSERT INTO bdc_pasos VALUES ($codg_tram, $codg_paso, '$nomb_paso', $dias_paso)");
                    echo '<SCRIPT>alert("Paso Agregado");</SCRIPT>
                          <SCRIPT>datos.action.value="";</SCRIPT>
                          <SCRIPT>        input_box=confirm("¿Desea Agregar otro Paso?")
                                          if (input_box==true)
                                                  {
                                                  location = "bdc_add_pasos.php"
                                                  }
                                           else
                                                  {
                                                  location = "../modulo_i/data.php"
                                                  }
                          </SCRIPT>';
            }
  }
?>

<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">

  var frmvalidator  = new Validator("datos");

  frmvalidator.addValidation("codg_tram","dontselect=0","Seleccione el Trámite");

  frmvalidator.addValidation("codg_paso","req","Ingrese el Número del Paso");
  frmvalidator.addValidation("codg_paso","num","El Número del Paso solo acepta caracteres numéricos");

  frmvalidator.addValidation("nomb_paso","req","Ingrese el Nombre del Paso");
  frmvalidator.addValidation("nomb_paso","alphanum");

  frmvalidator.addValidation("dias_paso","num","Los Días de Duración del Paso solo acepta caracteres numéricos");

</SCRIPT>

</BODY>
</HTML>
