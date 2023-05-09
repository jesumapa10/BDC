<?
  include ("../sesion.php");

  include ("../conex.php");

  $consulta_desc_tram = mysql_query("SELECT desc_tram FROM bdc_tramites WHERE codg_tram=$codg_tram");
  $tramite = mysql_fetch_array($consulta_desc_tram);
?>

<HTML>
<HEAD>
        <LINK REL="STYLESHEET" HREF="../style/normal.css" TYPE="text/css">

        <SCRIPT LANGUAGE="JavaScript" SRC="../scripts/validar.js" TYPE="text/javascript"></SCRIPT>
</HEAD>

<BR><BR>
<H2>Editar Paso de un Tr&aacute;mite</H2>

<FORM METHOD="POST" NAME="datos" ACTION="bdc_edit_pasos.php">

<?
if ($action == "ins")
  {
       if ($dias_paso == "") {$dias_paso = "NULL";}

       $SQL = ("UPDATE bdc_pasos SET codg_paso=$new_codg_paso, desc_paso='$new_desc_paso', dias_paso=$dias_paso WHERE codg_tram=$codg_tram and codg_paso=$codg_paso");

       if (($new_codg_paso != $codg_paso) && ($new_desc_paso == $desc_paso))
             {
               $codg_paso_consulta = mysql_query("SELECT * FROM bdc_pasos WHERE codg_tram=$codg_tram and codg_paso=$new_codg_paso");
                    if (mysql_num_rows($codg_paso_consulta) != 0)
                     {
                          echo "<SCRIPT>alert('El Número de Paso ya Existe');</SCRIPT>";
                          $error = 1;

                     }
                  else
                     {
                          mysql_query ($SQL);
                          echo "<SCRIPT>alert('Registro Actualizado');</SCRIPT>";
                     }
             }

       else if (($new_codg_paso == $codg_paso) && ($new_desc_paso != $desc_paso))
             {
               $desc_paso_consulta = mysql_query("SELECT * FROM bdc_pasos WHERE codg_tram=$codg_tram and desc_paso='$new_desc_paso'");
                    if (mysql_num_rows($desc_paso_consulta) != 0)
                     {
                          echo "<SCRIPT>alert('La Descripción del Paso ya Existe');</SCRIPT>";
                          $error = 2;
                     }
                  else
                     {

                          mysql_query($SQL);
                          echo "<SCRIPT>alert('Registro Actualizado');</SCRIPT>";
                     }
             }

       else if (($new_codg_paso != $codg_paso) && ($new_desc_paso != $desc_paso))
             {
               $codg_paso_consulta = mysql_query("SELECT * FROM bdc_pasos WHERE codg_tram=$codg_tram and codg_paso=$new_codg_paso");
               $desc_paso_consulta = mysql_query("SELECT * FROM bdc_pasos WHERE codg_tram=$codg_tram and desc_paso='$new_desc_paso'");
                   if (mysql_num_rows($codg_paso_consulta) != 0)
                     {

                          echo "<SCRIPT>alert('El Número de Paso ya Existe');</SCRIPT>";
                          $error = 1;
                      }
                   else if (mysql_num_rows($desc_paso_consulta) !=0)
                      {

                          echo "<SCRIPT>alert('La Descripción del Paso ya Existe');</SCRIPT>";
                          $error = 2;
                      }
                   else
                      {
                          mysql_query($SQL);
                          echo "<SCRIPT>alert('Registro Actualizado');</SCRIPT>";
                      }
              }

       else if (($new_codg_paso == $codg_paso) && ($new_desc_paso == $desc_paso))
             {
                          mysql_query($SQL);
                          echo "<SCRIPT>alert('Registro Actualizado');</SCRIPT>";
             }

  }

if (!isset ($pasada))
  {
   $consulta = mysql_query("SELECT desc_paso, dias_paso FROM bdc_pasos WHERE codg_tram=$codg_tram AND codg_paso=$codg_paso");
   $paso = mysql_fetch_array($consulta);
   $new_codg_paso = $codg_paso;
   $new_desc_paso = $paso["desc_paso"];
   $dias_paso = $paso["dias_paso"];
   $desc_paso = $paso["desc_paso"];
  }
?>

<TABLE BORDER="0" CELLPADDING="0" ALIGN=CENTER>

        <TR>
        <TD WIDTH="150" HEIGHT="20"><P class="mini" ALIGN="RIGHT">Nombre del Tr&aacute;mite:</P></TD>
        <TD WIDTH="350"><P class="campo" ALIGN="LEFT"><? echo $tramite["desc_tram"];?></P></TD>
        </TR>

        <TR>
        <TD WIDTH="150"><P class="mini" ALIGN="RIGHT">N&uacute;mero de Paso:</P></TD>
                <TD><INPUT class="campo" TYPE="TEXT" NAME="new_codg_paso" SIZE="1" MAXLENGTH="2" VALUE="<? echo $new_codg_paso; ?>"></TD>
        </TD>
        </TR>

        <TR>
        <TD><P class="mini" ALIGN="RIGHT">Nombre del Paso:</P></TD>
        <TD><INPUT class="campo" TYPE="TEXT" NAME="new_desc_paso" MAXLENGTH="50" SIZE="50" VALUE="<? echo $new_desc_paso; ?>"></TD>
        </TR>

        <TR>
        <TD><P class="mini" ALIGN="RIGHT">D&iacute;as de Duraci&oacute;n del Tr&aacute;mite:</TD>
        <TD><INPUT class="campo" TYPE="TEXT" NAME="dias_paso" SIZE="1" MAXLENGTH="2" VALUE="<? if ($dias_paso != 'NULL') {echo $dias_paso;} ?>"></TD>
        </TR>

        <TR>
        <TD COLSPAN="2"><CENTER><INPUT class="mini" TYPE="SUBMIT" VALUE="Actualizar"></CENTER></TD>
        </TR>

</TABLE>

<INPUT TYPE="HIDDEN" NAME="action" VALUE="ins">
<INPUT TYPE="HIDDEN" NAME="pasada" VALUE="1">
<INPUT TYPE="HIDDEN" NAME="codg_tram" VALUE="<? echo $codg_tram; ?>">
<INPUT TYPE="HIDDEN" NAME="codg_paso" VALUE="<? if ($error == 1) {echo $codg_paso;} else {echo $new_codg_paso;} ?>">
<INPUT TYPE="HIDDEN" NAME="desc_paso" VALUE="<? if ($error == 2) {echo $desc_paso;} else {echo $new_desc_paso;} ?>">
</FORM>

<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">

  var frmvalidator  = new Validator("datos");

  frmvalidator.addValidation("codg_paso","req","Ingrese el Número del Paso");
  frmvalidator.addValidation("codg_paso","num","El Número del Paso solo acepta caracteres numéricos");

  frmvalidator.addValidation("desc_paso","req","Ingrese el Nombre del Trámite");
  frmvalidator.addValidation("desc_paso","alphanum");

  frmvalidator.addValidation("dias_paso","num","Los Días de Duración del Paso solo acepta caracteres numéricos");

</SCRIPT>

</BODY>
</HTML>
