<?
//  Autentificator
//  Gesti�n de Usuarios PHP+Mysql
//  by Pedro Noves V. (Cluster)
//  clus@hotpop.com
//  ------------------------------

// Mensajes de error.

$error_login_ms[0]="No se pudo conectar con Base de Datos de Usuarios";
$error_login_ms[1]="No se pudo realizar consulta a la Base de Datos de Usuarios";
$error_login_ms[2]="Contrase�a � Usuario no existe";
$error_login_ms[3]="Contrase�a no v�lida";
if ( 3 - $_GET['int'] > 0 ) { $error_login_ms[3].="<br>Te quedan <b>".(3 - $_GET['int']). "</b> intentos"; }
else { $error_login_ms[3].="<br> El Usuario ha sido <b>Bloqueado</b> por exceder n�mero de intentos fallidos"; }
$error_login_ms[4]="Usuario no existe";
$error_login_ms[5]="No est� autorizado para realizar esta acci�n o entrar en esta p�gina";
$error_login_ms[6]="Acceso no autorizado! Contacte al Administrador del Sistema";
$error_login_ms[7]="<b>Usuario Bloqueado</b>. <br>El usuario ha superado el n�mero de intentos fallidos.";
?>
