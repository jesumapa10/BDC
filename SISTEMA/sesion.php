<?
  //  Autentificator
  //  Gesti�n de Usuarios PHP+Mysql+sesiones
  //  by Pedro Noves V. (Cluster)
  //  clus@hotpop.com
  // ------------------------------------------
  require("../verifica.php");
  $nivel_acceso=10; // Nivel de acceso para esta p�gina.
  // se chequea si el usuario tiene un nivel inferior
  // al del nivel de acceso definido para esta p�gina.
  // Si no es correcto, se manda a la p�gina que lo llamo con
  // la variable de $error_login definida con el n� de error segun el array de
  // aut_mensaje_error.inc.php
  if ($nivel_acceso <= $_SESSION['usuario_nivel']){
  header ("Location: $redir?error_login=5");
  exit;
  }
?>