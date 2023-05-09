<?
  include ("../sesion.php");
?>
<HTML>
<HEAD>
        <LINK REL="STYLESHEET" HREF="../style/normal.css" TYPE="text/css">

        <SCRIPT LANGUAGE="JavaScript" SRC="../scripts/validar.js" TYPE="text/javascript"></SCRIPT>
</HEAD>

<BR><BR>
<H2>Editar Grupo</H2>

<FORM METHOD="POST" NAME="datos" ACTION="bdc_edit_grupo.php">

<?
  include ("../conex.php");

  $SQL=("UPDATE bdc_grupos SET codg_grp=$new_codg_grp, nomb_grp='$new_nomb_grp' WHERE codg_grp=$codg_grp");

if ($action == "ins")
  {
       if (($new_codg_grp != $codg_grp) && ($new_nomb_grp == $nomb_grp))
             {
               $codg_grp_consulta = mysql_query("SELECT * FROM bdc_grupos WHERE codg_grp=$new_codg_grp");
                    if (mysql_num_rows($codg_grp_consulta) != 0)
                     {
                          echo "<SCRIPT>alert('Código de Grupo Existe');</SCRIPT>";
                          $error = 1;

                     }
                  else
                     {
                          mysql_query($SQL);
                          echo "<SCRIPT>alert('Registro Actualizado');</SCRIPT>";
                     }
             }

       if (($new_codg_grp == $codg_grp) && ($new_nomb_grp != $nomb_grp))
             {
               $codg_grp_consulta = mysql_query("SELECT * FROM bdc_grupos WHERE nomb_grp='$new_nomb_grp'");
                    if (mysql_num_rows($codg_grp_consulta) != 0)
                     {
                          echo "<SCRIPT>alert('Nombre de Grupo Existe');</SCRIPT>";
                          $error = 2;
                     }
                  else
                     {
                           mysql_query($SQL);
                           echo "<SCRIPT>alert('Registro Actualizado');</SCRIPT>";
                     }
             }

       if (($new_codg_grp != $codg_grp) && ($new_nomb_grp != $nomb_grp))
             {
               $codg_grp_consulta = mysql_query("SELECT * FROM bdc_grupos WHERE codg_grp=$new_codg_grp");
               $nomb_grp_consulta = mysql_query("SELECT * FROM bdc_grupos WHERE nomb_grp='$new_nomb_grp'");
                   if (mysql_num_rows($codg_grp_consulta) != 0)
                     {

                           echo "<SCRIPT>alert('Código de Grupo Existe');</SCRIPT>";
                           $error = 1;
                      }
                   else if (mysql_num_rows($nomb_grp_consulta) !=0)
                      {

                           echo "<SCRIPT>alert('Nombre de Grupo Existe');</SCRIPT>";
                           $error = 2;
                      }
                   else
                      {
                            mysql_query($SQL);
                            echo "<SCRIPT>alert('Registro Actualizado');</SCRIPT>";
                      }
              }
  }

if (!isset ($pasada))
  {
   $consulta = mysql_query("SELECT codg_grp, nomb_grp FROM bdc_grupos WHERE codg_grp=$codg_grp");
   $grupos = mysql_fetch_array($consulta);
   $new_codg_grp = $grupos["codg_grp"];
   $new_nomb_grp = $grupos["nomb_grp"];
   $nomb_grp = $grupos["nomb_grp"];
  }


?>
<TABLE BORDER="0" CELLPADDING="0" ALIGN=CENTER>

        <TR>
        <TD WIDTH="150"><P class="mini" ALIGN="RIGHT">C&oacute;digo del Grupo:</TD>
        <TD WIDTH="200"><INPUT class="campo" TYPE="TEXT" NAME="new_codg_grp" SIZE="1" MAXLENGTH="2" VALUE="<? echo $new_codg_grp ?>"></TD>
        </TR>

        <TR>
        <TD><P class="mini" ALIGN="RIGHT">Nombre del Grupo:</P></TD>
        <TD><INPUT class="campo" TYPE="TEXT" NAME="new_nomb_grp" MAXLENGTH="20" SIZE="20" VALUE="<? echo $new_nomb_grp ?>"></TD>
        </TR>

        <TR>
        <TD COLSPAN="2"><CENTER><INPUT class="mini" TYPE="SUBMIT" VALUE="Actualizar"></CENTER></TD>
        </TR>

</TABLE>

<INPUT TYPE="HIDDEN" NAME="action" VALUE="ins">
<INPUT TYPE="HIDDEN" NAME="pasada" VALUE="1">
<INPUT TYPE="HIDDEN" NAME="codg_grp" VALUE="<? if ($error == 1) {echo $codg_grp;} else {echo $new_codg_grp;} ?>">
<INPUT TYPE="HIDDEN" NAME="nomb_grp" VALUE="<? if ($error == 2) {echo $nomb_grp;} else {echo $new_nomb_grp;} ?>">
</FORM>

<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">

  var frmvalidator  = new Validator("datos");

  frmvalidator.addValidation("new_nomb_grp","req","Ingrese el Nombre del Grupo");
  frmvalidator.addValidation("new_nomb_grp","alphanum");

</SCRIPT>

</BODY>
</HTML>