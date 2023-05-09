<?
  include ("../sesion.php");

  include ("../conex.php");
?>

<HTML>
<HEAD>
        <LINK REL="STYLESHEET" HREF="../style/normal.css" TYPE="text/css">

        <SCRIPT LANGUAGE="JavaScript" SRC="../scripts/validar.js" TYPE="text/javascript"></SCRIPT>
</HEAD>

<BR><BR>
<H2>Editar Tr&aacute;mite</H2>

<FORM METHODS="POST" NAME="datos" ACTION="bdc_edit_tramite.php">

<?
if ($action == "ins")
  {
       if ($dias_tram == "") {$dias_tram = "NULL";}

       $SQL=("UPDATE bdc_tramites SET desc_tram='$new_desc_tram', dias_tram=$dias_tram WHERE codg_tram=$codg_tram");

       if ($new_desc_tram != $desc_tram)
             {
               $desc_tram_consulta = mysql_query("SELECT * FROM bdc_tramites WHERE desc_tram='$new_desc_tram'");
                    if (mysql_num_rows($desc_tram_consulta) != 0)
                     {
                          echo "<SCRIPT>alert('La Descripción del Trámite ya Existe');</SCRIPT>";
                          $error = 1;

                     }
                  else
                     {
                          mysql_query ($SQL);
                          echo "<SCRIPT>alert('Registro Actualizado');</SCRIPT>";
                     }
             }

       else
             {
                          mysql_query($SQL);
                          echo "<SCRIPT>alert('Registro Actualizado');</SCRIPT>";
             }

  }

if (!isset ($pasada))
  {
   $consulta = mysql_query("SELECT desc_tram, dias_tram FROM bdc_tramites WHERE codg_tram=$codg_tram");
   $tramite = mysql_fetch_array($consulta);
   $new_desc_tram = $tramite["desc_tram"];
   $dias_tram = $tramite["dias_tram"];
   $desc_tram = $tramite["desc_tram"];
  }
?>

<TABLE BORDER="0" CELLPADDING="0" ALIGN=CENTER>

        <TR>
        <TD WIDTH="150"><P class="mini" ALIGN="RIGHT">Nombre del Tr&aacute;mite:</P></TD>
        <TD WIDTH="350"><INPUT class="campo" TYPE="TEXT" NAME="new_desc_tram" MAXLENGTH="50" SIZE="50" VALUE="<? echo $new_desc_tram; ?>"></TD>
        </TR>

        <TR>
        <TD><P class="mini" ALIGN="RIGHT">D&iacute;as de Duraci&oacute;n del Tr&aacute;mite:</TD>
        <TD><INPUT class="campo" TYPE="TEXT" NAME="dias_tram" SIZE="1" MAXLENGTH="2" VALUE="<? if ($dias_tram != 'NULL') {echo $dias_tram;} ?>"></TD>
        </TR>

        <TR>
        <TD COLSPAN="2"><CENTER><INPUT class="mini" TYPE="SUBMIT" VALUE="Actualizar"></CENTER></TD>
        </TR>

</TABLE>

<INPUT TYPE="HIDDEN" NAME="action" VALUE="ins">
<INPUT TYPE="HIDDEN" NAME="pasada" VALUE="1">
<INPUT TYPE="HIDDEN" NAME="codg_tram" VALUE="<? echo $codg_tram; ?>">
<INPUT TYPE="HIDDEN" NAME="desc_tram" VALUE="<? if ($error == 1) {echo $desc_tram;} else {echo $new_desc_tram;} ?>">

</FORM>

<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">

  var frmvalidator  = new Validator("datos");

  frmvalidator.addValidation("desc_tram","req","Ingrese el Nombre del Trámite");
  frmvalidator.addValidation("desc_tram","alphanum");

</SCRIPT>

</BODY>
</HTML>
