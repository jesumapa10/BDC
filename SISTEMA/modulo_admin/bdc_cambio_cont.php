<?
  include ("../sesion.php");

  include("../conex.php");
?>

<HTML>
<HEAD>
        <LINK REL="STYLESHEET" HREF="../style/normal.css" TYPE="text/css">
        <SCRIPT LANGUAGE="JavaScript" SRC="../scripts/validar.js" TYPE="text/javascript"></SCRIPT>
</HEAD>

<BODY>
<BR><BR>
<H2>Cambio de Contrase�a</H2>
<BR>

<?
if ($action == "ins")
  {
          $verificar_actual = mysql_query("SELECT * FROM bdc_usuarios WHERE login_usr='".$_SESSION['usuario_login']."' and pass_usr=md5('$pass_act')");

          if (mysql_num_rows($verificar_actual) == 0)
            {
                    echo "<SCRIPT>alert('Contrase�a Actual no V�lida');</SCRIPT>";
            }

          else

            {
                    if ($pass_new1 == $pass_new2)
                      {
                              mysql_query("UPDATE bdc_usuarios SET pass_usr=md5('$pass_new1') WHERE login_usr='".$_SESSION['usuario_login']."'");
                              echo "<SCRIPT>alert('Contrase�a Modificada');</SCRIPT>";
                      }

                    else

                      {
                              echo "<SCRIPT>alert('Su Nueva Contrase�a y su Confirmaci�n no Coinciden');</SCRIPT>";
                      }
            }
  }
?>

<FORM METHOD="POST" NAME="datos" ACTION="bdc_cambio_cont.php">

<TABLE BORDER="0" ALIGN="CENTER">

<TR>
<TD><P ALIGN="RIGHT" class="mini">Contrase&ntilde;a Actual:</P></TD>
<TD><INPUT TYPE="PASSWORD" class="campo" NAME="pass_act" SIZE="10" MAXLENGTH="10"></TD>
</TR>

<TR>
<TD><P ALIGN="RIGHT" class="mini">Nueva Contrase&ntilde;a:</P></TD>
<TD><INPUT TYPE="PASSWORD" class="campo" NAME="pass_new1" SIZE="10" MAXLENGTH="10"></TD>
</TR>

<TR>
<TD><P ALIGN="RIGHT" class="mini">Confirmar Nueva Contrase&ntilde;a:</P></TD>
<TD><INPUT TYPE="PASSWORD" class="campo" NAME="pass_new2" SIZE="10" MAXLENGTH="10"></TD>
</TR>

<TR>
  <TD></TD>
  <TD ALIGN="LEFT"><INPUT class="mini" TYPE="SUBMIT" VALUE="Cambiar"></TD>
</TR>

</TABLE>

<INPUT TYPE="HIDDEN" NAME="action" VALUE="ins">

</FORM>

<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">

  var frmvalidator  = new Validator("datos");

  frmvalidator.addValidation("pass_act","req","Ingrese su Contrase�a Actual");

  frmvalidator.addValidation("pass_new1","req","Ingrese su Nueva Contrase�a");
  frmvalidator.addValidation("pass_new1","minlen=6","Contrase�a debe tener un minimo de 6 caracteres");

  frmvalidator.addValidation("pass_new2","req","Ingrese su Confirmaci�n para la Nueva Contrase�a");

</SCRIPT>

</BODY>
</HTML>
