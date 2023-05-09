<?
  include ("../sesion.php");

  include ("../conex.php");

  $consulta_grupos = mysql_query ("SELECT codg_grp, nomb_grp FROM bdc_grupos ORDER BY 2");
?>

<HTML>
<HEAD>
        <LINK REL="STYLESHEET" HREF="../style/normal.css" TYPE="text/css">

        <SCRIPT LANGUAGE="JavaScript" SRC="../scripts/validar.js" TYPE="text/javascript"></SCRIPT>
</HEAD>

<BR><BR>
<H2>Editar Usuario</H2>

<FORM METHOD="POST" NAME="datos" ACTION="bdc_edit_user.php">

<?
  $SQL=("UPDATE bdc_usuarios SET codg_usr=$new_codg_usr, nomb_usr='$nomb_usr', apel_usr='$apel_usr', codg_grp='$codg_grp', login_usr='$new_login_usr', int_fal='$int_fal' WHERE codg_usr=$codg_usr");

if ($action == "ins")
  {
       if (($new_codg_usr != $codg_usr) && ($new_login_usr == $login_usr))
             {
               $codg_usr_consulta = mysql_query("SELECT * FROM bdc_usuarios WHERE codg_usr=$new_codg_usr");
                    if (mysql_num_rows($codg_usr_consulta) != 0)
                     {
                          echo "<SCRIPT>alert('Cédula ya Existe');</SCRIPT>";
                          $error = 1;

                     }
                  else
                     {
                          mysql_query($SQL);
                          echo "<SCRIPT>alert('Registro Actualizado');</SCRIPT>";
                     }
             }

       else if (($new_codg_usr == $codg_usr) && ($new_login_usr != $login_usr))
             {
               $login_usr_consulta = mysql_query("SELECT * FROM bdc_usuarios WHERE login_usr='$new_login_usr'");
                    if (mysql_num_rows($login_usr_consulta) != 0)
                     {
                          echo "<SCRIPT>alert('Usuario ya Existe');</SCRIPT>";
                          $error = 2;
                     }
                  else
                     {
                           mysql_query($SQL);
                           echo "<SCRIPT>alert('Registro Actualizado');</SCRIPT>";
                     }
             }

       else if (($new_codg_usr != $codg_usr) && ($new_login_usr != $login_usr))
             {
               $codg_usr_consulta = mysql_query("SELECT * FROM bdc_usuarios WHERE codg_usr=$new_codg_usr");
               $login_usr_consulta = mysql_query("SELECT * FROM bdc_usuarios WHERE login_usr='$new_login_usr'");
                   if (mysql_num_rows($codg_usr_consulta) != 0)
                     {

                           echo "<SCRIPT>alert('Cédula Existe');</SCRIPT>";
                           $error = 1;
                      }
                   else if (mysql_num_rows($login_usr_consulta) !=0)
                      {

                           echo "<SCRIPT>alert('Usuario ya Existe');</SCRIPT>";
                           $error = 2;
                      }
                   else
                      {
                            mysql_query($SQL);
                            echo "<SCRIPT>alert('Registro Actualizado');</SCRIPT>";
                      }
              }

       else if (($new_codg_usr == $codg_usr) && ($new_login_usr == $login_usr))
             {
                            mysql_query($SQL);
                            echo "<SCRIPT>alert('Registro Actualizado');</SCRIPT>";
             }

  }

   if (!isset ($pasada))
   {
      $consulta_usuario = mysql_query("SELECT codg_usr, apel_usr, nomb_usr, feci_usr, codg_grp, login_usr, pass_usr, int_fal FROM bdc_usuarios WHERE codg_usr=$user");
      $usuario = mysql_fetch_array($consulta_usuario);
      $new_codg_usr = $usuario["codg_usr"];
      $apel_usr = $usuario["apel_usr"];
      $nomb_usr = $usuario["nomb_usr"];
      $feci_usr = $usuario["feci_usr"];
      $codg_grp = $usuario["codg_grp"];
      $new_login_usr = $usuario["login_usr"];
      $pass_usr = $usuario["pass_usr"];
      $login_usr = $usuario["login_usr"];
      $codg_usr = $user;
	  $int_fal = $usuario["int_fal"];
   }

?>

   <TABLE BORDER="0" CELLPADDING="0" ALIGN=CENTER>

        <TR>
        <TD WIDTH="100"><P ALIGN="RIGHT" class="mini">C&eacute;dula:</P></TD>
        <TD WIDTH="220"><INPUT TYPE=TEXT NAME="new_codg_usr" VALUE="<? echo $new_codg_usr ?>" class ="campo" SIZE="8" MAXLENGTH="8"></TD>
        </TR>

        <TR>
        <TD><P class="mini" ALIGN="RIGHT">Nombre(s):</P></TD>
        <TD><INPUT TYPE=TEXT NAME=nomb_usr VALUE="<? echo $nomb_usr ?>" class="campo" SIZE="30" MAXLENGTH="30"></TD>
        </TR>

        <TR>
        <TD><P class="mini" ALIGN="RIGHT">Apellido(s):</P></TD>
        <TD><INPUT TYPE="TEXT" NAME="apel_usr" VALUE="<? echo $apel_usr ?>" class="campo" SIZE="30" MAXLENGTH="30"></TD>
        </TR>

        <TR>
        <TD HEIGHT="20" VALIGN="CENTER"><P class="mini" ALIGN="RIGHT">Fecha de Ingreso:</P></TD>
        <TD><P class="campo"><? echo $feci_usr ?></P></TD>
        </TR>

        <TR>
        <TD><P ALIGN="RIGHT" class="mini">Grupo de Trabajo:</P></TD>

                 <TD><?
                         echo '<SELECT class="campo" NAME="codg_grp">';
                         echo '<OPTION VALUE="0">Seleccione...</OPTION>';

                         while ($grupos = mysql_fetch_array($consulta_grupos))
                         {
                                                 echo '<OPTION VALUE="'.$grupos["codg_grp"];
                                                 echo '"';
                                                 if ($codg_grp == $grupos["codg_grp"])
                                                    {
                                                           echo 'SELECTED';
                                                        }
                                                 echo '>'.$grupos["nomb_grp"];
                                                 echo '</OPTION>';
                         };
                         echo '</SELECT>';
                      ?>                 </TD>
        </TR>

        <TR>
        <TD><P class="mini" ALIGN="RIGHT">Usuario:</P></TD>
        <TD><INPUT TYPE="TEXT" NAME="new_login_usr" VALUE="<? echo $new_login_usr ?>" class="campo" SIZE="10" MAXLENGTH="10"></TD>
        </TR>
        <TR>
          <TD><P class="mini" ALIGN="RIGHT">Intentos Fallidos :</P></TD>
          <TD><INPUT TYPE="TEXT" NAME="int_fal" VALUE="<? echo $int_fal ?>" class="campo" SIZE="10" MAXLENGTH="1"></TD>
        </TR>
        <TR>
        <TD></TD>
        <TD><INPUT TYPE="SUBMIT" VALUE="Actualizar" class="mini"></TD>
        </TR>
</TABLE>

<INPUT TYPE="HIDDEN" NAME="action" value="ins">
<INPUT TYPE="HIDDEN" NAME="pasada" value="1">
<INPUT TYPE="HIDDEN" NAME="feci_usr" value="<? echo $feci_usr; ?>">
<INPUT TYPE="HIDDEN" NAME="codg_usr" VALUE="<? if ($error == 1) {echo $codg_usr;} else {echo $new_codg_usr;} ?>">
<INPUT TYPE="HIDDEN" NAME="login_usr" VALUE="<? if ($error == 2) {echo $login_usr;} else {echo $new_login_usr;} ?>">
</FORM>

<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">

  var frmvalidator  = new Validator("datos");

  frmvalidator.addValidation("new_codg_usr","req","Ingrese la Cédula del Usuario");
  frmvalidator.addValidation("new_codg_usr","num", "El Nro. de Cédula sólo acepta caracteres numéricos");

  frmvalidator.addValidation("new_login_usr","req","Ingrese el Nombre del Usuario");
  frmvalidator.addValidation("new_login_usr","alphanum");
  frmvalidator.addValidation("int_fal","num", "Intentos Fallidos sólo acepta caracteres numéricos");

</SCRIPT>

</HTML>