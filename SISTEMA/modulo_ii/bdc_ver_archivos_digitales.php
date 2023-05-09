<?
  include ("../conex.php");

      $sql = "SELECT imgn_arc_dig, tip_imgn_arc_dig FROM bdc_archivos WHERE codg_per=$codg_per";

      $consulta = mysql_query($sql);

      $datos = mysql_result($consulta,0,"imgn_arc_dig");
      $tipo = mysql_result($consulta,0,"tip_imgn_arc_dig");
      header("Content-type: $tipo");
      echo $datos;
?>
