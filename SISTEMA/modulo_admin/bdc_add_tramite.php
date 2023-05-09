<?
  include ("../sesion.php");

  include ("../conex.php");
?>

<HTML>
<HEAD>
        <LINK REL="STYLESHEET" HREF="../style/normal.css" TYPE="text/css">
        <SCRIPT LANGUAGE="JavaScript" SRC="../scripts/validar.js" TYPE="text/javascript"></SCRIPT>
</HEAD>

<BODY>
<BR><BR>
<H2>Agregar Tr&aacute;mite</H2>

        <FORM METHOD="POST" NAME="datos" ACTION="bdc_add_tramite.php">
        <TABLE ALIGN=CENTER BORDER="0">

                <TR>
                <TD WIDTH="150"><P class="mini" ALIGN="RIGHT">Nombre del Tr&aacute;mite:</P></TD>
                <TD WIDTH="350"><INPUT class="campo" TYPE="TEXT" NAME="desc_tram" MAXLENGTH="50" SIZE="50" VALUE="<? echo $desc_tram; ?>"></TD>
                </TR>

                <TR>
                <TD><P class="mini" ALIGN="RIGHT">D&iacute;as de Duraci&oacute;n del Tr&aacute;mite:</TD>
                <TD><INPUT class="campo" TYPE="TEXT" NAME="dias_tram" SIZE="1" MAXLENGTH="2" VALUE="<? echo $dias_tram; ?>"></TD>
                </TR>

                <TR>
                <TD COLSPAN="2"><CENTER><INPUT class="mini" TYPE="SUBMIT" VALUE="Agregar"></CENTER></TD>
                </TR>

        </TABLE>

        <INPUT TYPE=hidden NAME="action" VALUE="ins">

        </FORM>

<?
if ($action == "ins")
  {
          $comprobar_desc_tram = mysql_query("SELECT * FROM bdc_tramites WHERE desc_tram='$desc_tram'");

          if (mysql_num_rows($comprobar_desc_tram) != 0)
            {
                    echo "<SCRIPT>alert('El Nombre del Trámite ya Existe');</SCRIPT>";
            }

          else
            {
                    if ($dias_tram == "") {($dias_tram = "NULL");}
                    mysql_query ("INSERT INTO bdc_tramites VALUES (0, '$desc_tram', $dias_tram)");
                    echo '<SCRIPT>alert("Trámite Agregado");</SCRIPT>
                          <SCRIPT>datos.action.value="";</SCRIPT>
                          <SCRIPT>        input_box=confirm("¿Desea Agregar otro Trámite?")
                                          if (input_box==true)
                                                  {
                                                  location = "bdc_add_tramite.php"
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

  frmvalidator.addValidation("desc_tram","req","Ingrese el Nombre del Trámite");
  frmvalidator.addValidation("desc_tram","alphanum");

  frmvalidator.addValidation("dias_tram","num","Los Días de Duración del Paso solo acepta caracteres numéricos");

</SCRIPT>

</BODY>
</HTML>
