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
<H2>Cambio de Contraseña</H2>

<?
  $datos_usuario = mysql_query("SELECT nomb_usr, apel_usr, codg_grp, login_usr FROM bdc_usuarios WHERE codg_usr=$user");
  $usuario = mysql_fetch_array($datos_usuario);
  $codg_usr = $user;
  $nomb_usr = $usuario["nomb_usr"];
  $apel_usr = $usuario["apel_usr"];
  $codg_grp = $usuario["codg_grp"];
  $login_usr = $usuario["login_usr"];

  $nombre_grupo = mysql_query("SELECT nomb_grp FROM bdc_grupos WHERE codg_grp=$codg_grp");
  $grupo = mysql_fetch_array($nombre_grupo);
  $nomb_grp = $grupo["nomb_grp"];

if ($action == "ins")
  {
            {
            if ($pass_new1 == $pass_new2)
              {
                      mysql_query("UPDATE bdc_usuarios SET pass_usr=md5('$pass_new1') WHERE login_usr='$login_usr'");
                      echo "<SCRIPT>alert('Contraseña Modificada');</SCRIPT>";
              }

            else

              {
                      echo "<SCRIPT>alert('La Nueva Contraseña y la Confirmación no Coinciden');</SCRIPT>";
              }
            }
  }  
?>

<TABLE ALIGN="CENTER">
<TR>
<TD>
<P ALIGN="CENTER" class="mini">Nombre(s) y Apellido(s):</P>
</TD>

<TD>
<P ALIGN="CENTER" class="campo"><? echo $nomb_usr; ?>&nbsp;<? echo $apel_usr; ?>&nbsp;&nbsp;&nbsp;&nbsp;</P>
</TD>

<TD>
<P ALIGN="CENTER" class="mini">C&eacute;dula:</P>
</TD>

<TD>
<P ALIGN="CENTER" class="campo">V&nbsp;-&nbsp;<? echo number_format($codg_usr ,0 , "," ,"."); ?>&nbsp;&nbsp;&nbsp;&nbsp;</P>
</TD>

<TD>
<P ALIGN="CENTER" class="mini">Grupo:</P>
</TD>

<TD>
<P ALIGN="CENTER" class="campo"><? echo $nomb_grp; ?></P>
</TD>
</TR>
</TABLE>
<BR>

<FORM METHOD="POST" NAME="datos" ACTION="bdc_cambio_cont_user.php">

<TABLE BORDER="0" ALIGN="CENTER">

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

<INPUT TYPE="HIDDEN" NAME="pasada" VALUE="1">
<INPUT TYPE="HIDDEN" NAME="action" VALUE="ins">
<INPUT TYPE="HIDDEN" NAME="user" VALUE="<? echo $user ?>">

</FORM>

<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">

  var frmvalidator  = new Validator("datos");

  frmvalidator.addValidation("pass_new1","req","Ingrese la Nueva Contraseña");
  frmvalidator.addValidation("pass_new1","minlen=6","Contraseña debe tener un minimo de 6 caracteres");

  frmvalidator.addValidation("pass_new2","req","Ingrese la Confirmación para la Nueva Contraseña");

</SCRIPT>

</BODY>
</HTML>
