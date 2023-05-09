<?PHP 
session_start();
session_destroy();
?>

<HTML>
<HEAD>
        <LINK REL="STYLESHEET" HREF="style/normal.css" TYPE="text/css">
        <SCRIPT LANGUAGE="JavaScript" SRC="scripts/validar.js" TYPE="text/javascript"></SCRIPT>
        <TITLE>Intranet - Dirección de Educación, Cultura y Deportes del Estado Mérida</TITLE>
        <style type="text/css">
<!--
.Estilo2 {font-size: 12px}
-->
        </style>
</HEAD>
<BODY TOPMARGIN="0">

<?PHP 
if($log!="" AND $pas!=""){
?>
<script language="JavaScript" type="text/javascript">
	entrar();
</script>
<?PHP } ?>
<table width="100%" height="100%" border="0">
  <tr>
    <td><table width="600" height="450" border="3" align="center" bordercolor="#CC0000">
        <tr>
          <td align="center"><table width="100%" border="0">
              <tr>
                <td width="42%"><img src="images/logo.gif" title="Logo Direccion de Educaci&oacute;n Cultura y Deportes" width="240" height="145" border="0" align="CENTER"></td>
                <td width="58%"><div align="center">
                  <p><strong><span class="Inicio_Estilo1">Rep&uacute;blica Bolivariana de Venezuela</span><br>
                    <span class="Inicio_Estilo2">Gobierno del Estado M&eacute;rida</span><br>
                        <span class="Inicio_Estilo3">Direcci&oacute;n de Educaci&oacute;n, Cultura y Deportes</span></strong></p>
                  <p><strong>Bienvenido a:</strong><strong><br>
                    <img src="images/logo_bdc_tn.png" title="Logo BDC" width="198" height="71"></strong></p>
                  </div>                </td>
              </tr>
            </table>
            <table width="100%" border="0">
              <tr>
                <td height="130"><H1>Acesso al Sistema</H1>
                  <H1 align="center" class="vinotinto">Introduzca sus Datos</H1>
                  <div align="center">
                    <?
        // Mostrar error de Autentificaci&oacute;n.
        include ("errores.php");
        if (isset($_GET['error_login'])){
        $error=$_GET['error_login'];
        echo "<CENTER><B class='rojo'>Error:</B> $error_login_ms[$error]</CENTER>";
        }
        ?>
                </div></td>
              </tr>
              <tr>
                <td><FORM ACTION="frames.php" METHOD="POST" NAME="login">
                <table width="100%" border="0">
                    <tr>
                      <td width="29%"><div align="center">
                        <table border="0">
                          <tr>
                            <td class="Inicio_Estilo2"><div align="right"><span class="Inicio_Estilo3 Estilo2"><strong>Fecha:</strong></span></div></td>
                            <td><div align="center"><span class="Inicio_Estilo3"><strong><?PHP echo ' '.date(d.'/'.m.'/'.Y);?></strong></span></div></td>
                          </tr>
                          <tr>
                            <td class="Inicio_Estilo2"><div align="right"><strong><span class="Inicio_Estilo2 Inicio_Estilo3 Estilo2">Hora:</span></strong></div></td>
                            <td><div align="center"><span class="Inicio_Estilo3"><strong><?PHP echo ' '.date ("h:i:s a", time()); echo $hora;?></strong></span></div></td>
                          </tr>
                        </table>
                        </div></td>
                      <td><TABLE ALIGN="CENTER" CELLSPACING="2" CELLPADDING="2" BORDER="0">
                        <TR>
                          <TD ALIGN="RIGHT" class="mini"><B>Usuario:</B></TD>
                          <TD><input name="login_usr" type="TEXT" class="campo" id="login_usr" tabindex="1" size="12" maxlength="12" title="Ingrese el nombre de usuario del sistema"></TD>
                          <TD rowspan="2"><input name="SUBMIT" type="SUBMIT" class="botoninicio" id="SUBMIT" tabindex="3" value="Entrar" title="Haga click aquí para Entrar al Sistema"></TD>
                        </TR>
                        <TR>
                          <TD ALIGN="RIGHT" class="mini"><B>Contrase&ntilde;a:</B></TD>
                          <TD><input name="pass_usr" type="PASSWORD" class="campo" id="pass_usr" tabindex="2" size="12" maxlength="12" title="Ingrese la contraseña de ingreso al sistema"></TD>
                        </TR>
                      </TABLE></td>
                      <td width="29%"><div align="center"><img src="images/escudo.gif" title="Escudo del Estado M&eacute;rida" width="79" height="105" border="0" align="CENTER"></div></td>
                    </tr>
              </table>
                <SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">
  var frmvalidator  = new Validator("login");
  frmvalidator.addValidation("login_usr","req","Introduzca su Nombre de Usuario");
  frmvalidator.addValidation("login_usr","alphanum");
  frmvalidator.addValidation("pass_usr","req","Introduzca su Contraseña");
  frmvalidator.addValidation("pass_usr","alphanum");
                </SCRIPT>				
  </FORM></td>
              </tr>
            </table>  </td>
        </tr>
      </table>      </td>
  </tr>
</table>
</BODY>
</HTML>
