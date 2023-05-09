<?
session_start();
$fechaOld= $_SESSION["ultimoAcceso"];
if (!$fechaOld) { $_SESSION["ultimoAcceso"]= date("Y-n-j H:i:s"); $fechaOld = $_SESSION["ultimoAcceso"]; }
$ahora = date("Y-n-j H:i:s");
$tiempo_transcurrido = (strtotime($ahora)-strtotime($fechaOld));
	if($tiempo_transcurrido>= 60000) { //comparamos el tiempo y verificamos si pasaron 10 minutos o más
		session_destroy(); // destruimos la sesión
		echo "<script>location='../redireccionar.php'</script>"; //enviamos al usuario a la página principal
    }else {       //sino, actualizo la fecha de la sesión
		$_SESSION["ultimoAcceso"] = $ahora;
   	}

//  Autentificator
//  Gestión de Usuarios PHP+Mysql+sesiones
//  by Pedro Noves V. (Cluster)
//  clus@hotpop.com
//  v1.0  - 17/04/2002 Versión inicial.
//  v1.01 - 24/04/2002 Solucionado error sintactico en aut_verifica.inc.php.
//  v1.05 - 17/05/2002 Optimización código aut_verifia.inc.php
//  v1.06 - 03/06/2002 Corrección de errores de la versión 1.05 y error con navegadores Netscape
//  v2.00 - 18/08/2002 Optimización código + Seguridad.
//                     Ahora funciona con la directiva registre_globals= OFF. (PHP > 4.1.x)
//                     Optimización Tablas SQL. (rangos de tipos).
//  v2.01 - 16/10/2002 Solucionado "despistes" de la versión 2.00 de Autentificator
//                     en aut_verifica.inc.php y aut_gestion_usuarios.php que ocasinavan errores al trabajar
//                     con la directiva registre_globals= OFF.
//                     Solucionado error definición nombre de la sessión.
//
// Descripción:
// Gestión de Páginas restringidas a Usuarios, con nivel de acceso
// y gestión de errores en el Login
// + administración de usuarios (altas/bajas/modificaciones)
//
// Licencia GPL con estas extensiones:
// - Uselo con el fin que quiera (personal o lucrativo).
// - Si encuentra el código de utilidad y lo usas, mandeme un mail si lo desea.
// - Si mejora el código o encuentra errores, hagamelo saber el mail indicado.
//
// Instalación y uso del Gestor de usuarios en:
// documentacion.htm
//  ----------------------------------------------------------------------------


// Motor autentificación usuarios.

// Cargar datos conexion y otras variables.
require ("conex_inicio.php");


// chequear página que lo llama para devolver errores a dicha página.

$url = explode("?",$_SERVER['HTTP_REFERER']);
$pag_referida=$url[0];
$redir=$pag_referida;
// chequear si se llama directo al script.
if ($_SERVER['HTTP_REFERER'] == ""){
die ("Error cod.:1 - Acceso incorrecto!");
exit;
}


// Chequeamos si se está autentificandose un usuario por medio del formulario
if (isset($_POST['login_usr']) && isset($_POST['pass_usr'])) {

// Conexión base de datos.
// si no se puede conectar a la BD salimos del scrip con error 0 y
// redireccionamos a la pagina de error.
$db_conexion= mysql_connect("$sql_host", "$sql_usuario", "$sql_pass") or die(header ("Location:  $redir?error_login=0"));
mysql_select_db("$sql_db");

// realizamos la consulta a la BD para chequear datos del Usuario.
$usuario_consulta = mysql_query("SELECT codg_usr, login_usr, pass_usr, codg_grp, niv_acs_usr, ulti_acs_usr, int_fal FROM $sql_tabla WHERE login_usr='".$_POST['login_usr']."'") or die(header ("Location:
$redir?error_login=1"));

 // miramos el total de resultado de la consulta (si es distinto de 0 es que existe el usuario)
 if (mysql_num_rows($usuario_consulta) != 0) {

    // eliminamos barras invertidas y dobles en sencillas
    $login = stripslashes($_POST['login_usr']);
    // encriptamos el password en formato md5 irreversible.
    $password = md5($_POST['pass_usr']);

    // almacenamos datos del Usuario en un array para empezar a chequear.
         $usuario_datos = mysql_fetch_array($usuario_consulta);

    // liberamos la memoria usada por la consulta, ya que tenemos estos datos en el Array.
    mysql_free_result($usuario_consulta);

    // chequeamos el nombre del usuario otra vez contrastandolo con la BD
    // esta vez sin barras invertidas, etc ...
    // si no es correcto, salimos del script con error 4 y redireccionamos a la
    // página de error.
    if ($login != $usuario_datos['login_usr']) {
               Header ("Location: $redir?error_login=4");
                exit;}
				
	// si la canidad de intentos fallidos es igual o mayor a 3 restringir acceso
	if ($usuario_datos['int_fal']>=3) {
               Header ("Location: $redir?error_login=7");
                exit;}

    // si el password no es correcto ..
    // salimos del script con error 3 y redireccinamos hacia la página de error
    if ($password != $usuario_datos['pass_usr']) {
	$intentos = $usuario_datos['int_fal']+1;
	mysql_query ("UPDATE bdc_usuarios SET int_fal=$intentos WHERE login_usr='".$_POST['login_usr']."'");
        Header ("Location: $redir?error_login=3&int=$intentos"); 
            exit;}

    // introducimos el acceso del usuario
	mysql_query ("UPDATE bdc_usuarios SET int_fal=0 WHERE login_usr='".$_POST['login_usr']."'");
    mysql_query ("UPDATE $sql_tabla SET ulti_acs_usr=now() WHERE login_usr='".$_POST['login_usr']."'");

    // cerramos la Base de datos.
    mysql_close($db_conexion);

    // Paranoia: destruimos las variables login y password usadas
    unset ($login);
    unset ($password);

    // En este punto, el usuario ya esta validado.
    // Grabamos los datos del usuario en una sesion.

     // le damos un mobre a la sesion.
    session_name($usuarios_sesion);

    // Paranoia: decimos al navegador que no "cachee" esta página.
    session_cache_limiter('nocache,private');

    // Asignamos variables de sesión con datos del Usuario para el uso en el
    // resto de páginas autentificadas.

    // definimos usuarios_id como IDentificador del usuario en nuestra BD de usuarios
    $_SESSION['usuario_id']=$usuario_datos['codg_usr'];

    // definimos usuario_nivel con el Nivel de acceso del usuario de nuestra BD de usuarios
    $_SESSION['usuario_nivel']=$usuario_datos['niv_acs_usr'];

    //definimos usuario_nivel con el Nivel de acceso del usuario de nuestra BD de usuarios
    $_SESSION['usuario_login']=$usuario_datos['login_usr'];

    //definimos usuario_password con el password del usuario de la sesión actual (formato md5 encriptado)
    $_SESSION['usuario_password']=$usuario_datos['pass_usr'];

    // definimos usuario_grupo con el grupo de trabajo del usuario de nuestra BD de usuarios
    $_SESSION['usuario_grupo']=$usuario_datos['codg_grp'];

    // definimos el ultimo acceso del usuario
    $_SESSION['usuario_acceso']=$usuario_datos['ulti_acs_usr'];

    // Hacemos una llamada a si mismo (scritp) para que queden disponibles
    // las variables de session en el array asociado $HTTP_...
    $pag=$_SERVER['PHP_SELF'];
    Header ("Location: $pag?");
    exit;

   } else {
      // si no esta el nombre de usuario en la BD o el password ..
      // se devuelve a pagina q lo llamo con error
      Header ("Location: $redir?error_login=2");
      exit;}
} else {

// -------- Chequear sesión existe -------

// usamos la sesion de nombre definido.
session_name($usuarios_sesion);

// Chequeamos si estan creadas las variables de sesión de identificación del usuario,
// El caso mas comun es el de una vez "matado" la sesion se intenta volver hacia atras
// con el navegador.

if (!isset($_SESSION['usuario_login']) && !isset($_SESSION['usuario_password'])){
// Borramos la sesion creada por el inicio de session anterior
session_destroy();
die ("Error cod.: 2 * Acceso incorrecto!");
echo $_POST['pass_usr']."<br>";
echo $_POST['pass_usr'];
exit;
}
}
?>
