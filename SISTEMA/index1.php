<?PHP 
session_start();
session_destroy();
$log = $_GET['login_usr'];
$pas = $_GET['pass_usr'];
?>

<HTML>
<HEAD>
        <LINK REL="STYLESHEET" HREF="style/normal.css" TYPE="text/css">
        <SCRIPT LANGUAGE="JavaScript" SRC="scripts/validar.js" TYPE="text/javascript"></SCRIPT>
        <TITLE>Intranet - Dirección de Educación, Cultura y Deportes del Estado Mérida</TITLE>
        <style type="text/css">
<!--
.Estilo2 {font-size: 12px}
.Estilo3 {font-size: 24pt}
.Estilo4 {
	color: #FF0000;
	font-weight: bold;
}
.Estilo6 {font-size: 10px}
-->
        </style>
</HEAD>
<script language="JavaScript" type="text/javascript">
 function entrar(){
			window.open('login.php','window','toolbar=no,location=no'+'fullscreen=yes,directories=no,status=no,menubar=no,scrollbars=yes,pos=center' +
                            'winSize,resizable=yes,copyhistory=no');
							thewindow.moveTo(0,0);
     }
function sleep(milliseconds) {
  var start = new Date().getTime();
  for (var i = 0; i < 1e7; i++) {
    if ((new Date().getTime() - start) > milliseconds){
      break;
    }
  }
}
</script>
<BODY TOPMARGIN="0">


<table width="100%" height="100%" border="0">
  <tr>
    <td><table width="600" height="450" border="3" align="center" bordercolor="#CC0000">
        <tr>
          <td align="center"><table width="100%" border="0">
              <tr>
                <td width="42%"><img src="images/logo.gif" alt="Logo Direccion de Educaci&oacute;n Cultura y Deportes" width="240" height="145" border="0" align="CENTER"></td>
                <td width="58%"><div align="center">
                  <p><strong><span class="Inicio_Estilo1">Rep&uacute;blica Bolivariana de Venezuela</span><br>
                    <span class="Inicio_Estilo2">Gobierno del Estado M&eacute;rida</span><br>
                        <span class="Inicio_Estilo3">Direcci&oacute;n de Educaci&oacute;n, Cultura y Deportes</span></strong></p>
                  <p><strong>Bienvenido a:</strong><span class="Inicio_Estilo2"><strong><br>
                    <img src="images/logo_bdc_tn.png" alt="Logo BDC" width="198" height="71"></strong></span></p>
                  </div>                </td>
              </tr>
            </table>
            <table width="100%" border="0">
              <tr>
                <td height="151"><table border="0" align="center" cellpadding="0" cellspacing="0">
                  <tr>
                    <td>&nbsp;</td>
                    <td width="278">&nbsp;</td>
                  </tr>
                  <tr>
                    <td width="32" valign="top"><img src="images/cargando.gif" alt="Cargando..." width="32" height="32"></td>
                    <td><H1>Redireccionando al Sistema&nbsp;</H1></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>

                </table>
                
                  <table border="1" align="center" bordercolor="#990000" bgcolor="#FFFF00">
                    <tr>
                      <td width="270" height="107" bgcolor="#FFFFEC"><table width="100%" border="0">
                          <tr>
                            <td colspan="3"><div align="center"><span class="Estilo4">IMPORTANTE: </span><br>
                              <span class="Estilo6">Este sistema se ha dise&ntilde;ado para el navegador: </span></div></td>
                          </tr>
                          <tr>
                            <td><span class="Estilo6"><strong><a href="http://www.mozilla-europe.org/es/firefox/">Mozilla Firefox</a></strong></span></td>
                            <td><span class="Estilo6"><a href="http://www.mozilla-europe.org/es/firefox/" target="_blank"><img src="images/firefox.png" alt="Click para Descargar Mozilla Firefox" width="31" height="31" border="0"></a></span></td>
                            <td><span class="Estilo6">con resolucion de<span class="Estilo2"><strong> 1024 x 768</strong></span></span></td>
                          </tr>
                          <tr>
                            <td colspan="3"><div align="center"><span class="Estilo6">y debes permitir las<span class="Estilo4"> Ventanas Emergentes</span></span></div></td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                  </table>
                  </td>
              </tr>
              <tr>
                <td><FORM ACTION="" METHOD="GET" NAME="login">
                <table width="100%" border="0">
                    <tr>
                      <td width="35%"><div align="center">
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
                      <td width="32%"><div align="center" class="Estilo3">
                        <p class="vinotinto"><strong>POR
                          FAVOR ESPERE </strong><strong>UN
                         MOMENTO </strong></p>
                        </div></td>
                      <td width="33%"><div align="center"><img src="images/escudo.gif" alt="Escudo del Estado M&eacute;rida" width="79" height="105" border="0" align="CENTER"></div></td>
                    </tr>
              </table>			
  </FORM></td>
              </tr>
            </table>  </td>
        </tr>
      </table>      </td>
  </tr>
</table>
</BODY>
</HTML>
<?PHP
$n=0;
while($n<6){
	$n++;
}
$a=1;
if($a==1){
?>
<script language="JavaScript" type="text/javascript">
	setTimeout("entrar()", 3000);
</script>
<?PHP } ?>