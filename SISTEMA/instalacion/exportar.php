<?php 
include ('../sesion.php');
if (! $_POST['enviar']) 
{ $mensaje_inicial='Presione solo una vez el bot&oacute;n "Exportar Base de Datos" para iniciar el proceso.'; }
echo '<title>Exportar Base de Datos</title>';
echo '<link href="../style/normal.css" rel="stylesheet" type="text/css">';
?>
<form id="form1" name="form1" enctype="multipart/form-data" method="post" action="exportar2.php">
<center>
<img src="../images/logo_bdc.png" alt="Logo <?php echo $organizacion;  ?>" title="Logo <?php echo $organizacion;  ?>"><br>
<p class="inicio_titulo">Exportar Base de Datos</p>
<p class="inicio_mensaje"><?php echo $mensaje_inicial; ?><br></p>
<input type="submit" name="enviar" Value="Exportar Base de Datos">
</center></form>
