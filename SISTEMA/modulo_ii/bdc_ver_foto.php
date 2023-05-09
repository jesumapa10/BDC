<?
  include ("../conex.php");

      $sql = "SELECT foto_per, tip_foto_per FROM bdc_datos_per WHERE codg_per=$codg_per";

      $consulta = mysql_query($sql);

      $datos = mysql_result($consulta,0,"foto_per");
      $tipo = mysql_result($consulta,0,"tip_foto_per");

      header("Content-type: $tipo");
      echo $datos;

?>
