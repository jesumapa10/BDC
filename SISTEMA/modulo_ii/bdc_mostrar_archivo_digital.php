<?
  include ("../sesion.php");

  include ("../conex.php");
?>

<HTML>
<HEAD>
<TITLE>Vista de Archivos Digitales</TITLE>
</HEAD>
<BODY>
<center>
<?php 
    echo '<a href="#" border="1" onClick="window.close()"><b>Cerrar Ventana<br><IMG SRC="bdc_ver_archivos_digitales.php?codg_per='.$_GET["codg_per"].'&tip='.$_GET["tip"].'" title="Haga Click para CERRAR la Ventana"><br>Cerrar Ventana</a></b>';
?>
</center>
</BODY>
</HTML>
