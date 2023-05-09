<?
  include ("../sesion.php");
?>

<HTML>
<HEAD>
        <LINK REL="STYLESHEET" HREF="../style/normal.css" TYPE="text/css">

        <SCRIPT LANGUAGE="JavaScript" SRC="../scripts/validar.js" TYPE="text/javascript"></SCRIPT>
</HEAD>

<?
  include ("../conex.php");

  $consulta_grupos = mysql_query ("SELECT codg_grp, nomb_grp FROM bdc_grupos ORDER BY 2");

?>

<BR><BR>
<H2>Agregar Usuario</H2>

         <FORM METHDO="POST" NAME="datos" ACTION="bdc_add_user.php">
         <TABLE BORDER="0" ALIGN=CENTER>
                 <TR>
                 <TD WIDTH="100"><P ALIGN="RIGHT" class="mini">C&eacute;dula:</P></TD>
                 <TD WIDTH="220"><INPUT TYPE="TEXT" NAME="codg_usr" class ="campo" SIZE="8" MAXLENGTH="8" value="<?PHP echo $codg_usr; ?>"></TD>
                 </TR>

                 <TR>
                 <TD><P ALIGN="RIGHT" class="mini">Nombre(s):</P></TD>
                 <TD><INPUT TYPE="TEXT" NAME="nomb_usr" class ="campo" SIZE="30" MAXLENGTH="30" value="<?PHP echo $nomb_usr; ?>"></TD>
                 </TR>

                 <TR>
                 <TD><P ALIGN="RIGHT" class="mini">Apellido(s):</P></TD>
                 <TD><INPUT TYPE="TEXT" NAME="apel_usr" class ="campo" SIZE="30" MAXLENGTH="30" value="<?PHP echo $apel_usr; ?>"></TD>
                 </TR>

                 <TR>
                 <TD><P ALIGN="RIGHT" class="mini">Grupo de Trabajo:</P></TD>
                 <TD><SELECT class="campo" NAME="codg_grp">
                         <OPTION VALUE="0" >Seleccione...</OPTION>
                         <?
                         while ($grupos = mysql_fetch_array($consulta_grupos))
                         {
                         echo '<OPTION VALUE="'.$grupos["codg_grp"].'" '; if($grupos["codg_grp"]==$codg_grp){ echo "selected"; } echo ' >'.$grupos["nomb_grp"]; echo '</OPTION>';
                         };
                         ?>
                         </SELECT>
                 </TD>
                 </TR>

                 <TR>
                 <TD><P ALIGN="RIGHT" class="mini">Usuario:</P></TD>
                 <TD><INPUT TYPE="TEXT" NAME="login_usr" class ="campo" SIZE="10" MAXLENGTH="10" value="<?PHP echo $login_usr; ?>"></TD>
                 </TR>

                 <TR>
                 <TD><P ALIGN="RIGHT" class="mini">Clave:</P></TD>
                 <TD><INPUT TYPE="PASSWORD" NAME="pass_usr" class ="campo" SIZE="10" MAXLENGTH="10" value="<?PHP echo $pass_usr; ?>"></TD>
                 </TR>

                 <TR>
                 <TD><P ALIGN="RIGHT" class="mini">Confirmar Clave:</P></TD>
                 <TD><INPUT TYPE="PASSWORD" NAME="pass_usr2" class ="campo" SIZE="10" MAXLENGTH="10" value="<?PHP echo $pass_usr2; ?>"></TD>
                 </TR>

                 <TR>
                 <TD></TD>
                 <TD><INPUT TYPE="SUBMIT" ALIGN="RIGHT" class="mini" VALUE="Agregar"></TD>
                 </TR>

         </TABLE>

         <INPUT TYPE="HIDDEN" NAME="action" VALUE="ins">

         </FORM>

<?
if ($action == "ins")
{

  $consulta = mysql_query("SELECT * FROM bdc_usuarios WHERE codg_usr=$codg_usr");

        if (mysql_num_rows($consulta) != 0)
        {
                echo "<SCRIPT>alert('La Cédula ya Existe');</SCRIPT>";
        }

        else

        {
                $consulta_login = mysql_query("SELECT * FROM bdc_usuarios WHERE login_usr='$login_usr'");

                if (mysql_num_rows($consulta_login) != 0)
                {
                        echo "<SCRIPT>alert('El Usuario ya Existe');</SCRIPT>";
                }

                else

                {
					if($pass_usr!=$pass_usr2){
						echo '<SCRIPT>alert("Clave y Clave de confirmacion son distintas");</SCRIPT>';
					}else{
						mysql_query("INSERT INTO bdc_usuarios VALUES ($codg_usr, '$apel_usr', '$nomb_usr', now(), $codg_grp, '$login_usr', md5('$pass_usr'), now(), 1)");
		
						echo '<SCRIPT>alert("Usuario Agregado");</SCRIPT>
		
							  <SCRIPT>datos.action.value="";</SCRIPT>
							  <SCRIPT>        input_box=confirm("¿Desea Agregar otro Usuario?")
											  if (input_box==true)
													  {
													  location = "bdc_add_user.php"
													  }
											   else
													  {
													  location = "../modulo_i/bdc_data.php"
													  }
							  </SCRIPT>';
					}
				}
        }
}
?>

<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">

  var frmvalidator  = new Validator("datos");

  frmvalidator.addValidation("codg_usr","req","Ingrese la Cédula del Usuario");
  frmvalidator.addValidation("codg_usr","num", "El Nro. de Cédula sólo acepta caracteres numéricos");

  frmvalidator.addValidation("login_usr","req","Ingrese el Nombre del Usuario");
  frmvalidator.addValidation("login_usr","alphanum");

  frmvalidator.addValidation("pass_usr","req","Ingrese la Contraseña del Usuario");
  frmvalidator.addValidation("pass_usr","alphanum");
  frmvalidator.addValidation("pass_usr","minlen=6","Contraseña debe tener un minimo de 6 caracteres");

  frmvalidator.addValidation("pass_usr2","req","Ingrese la Confirmacion de Contraseña");
  frmvalidator.addValidation("pass_usr2","alphanum");

</SCRIPT>

</HTML>