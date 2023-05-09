<?php 
include ('../sesion.php');
echo '<title>Importar de Base de Datos</title>';
echo '<link href="../comunes/estilo.css" rel="stylesheet" type="text/css">';
$mensaje_inicial='Seleccione el archivo ".sql" que contiene la base de datos<br>( IMPORTANTE: Solo archivos generados por MySqlDump o con &eacute;ste Sistema)';
if ($_POST['enviar']) 
{
   ////// inicio de cargar archivo
   if ($_FILES['archivo']['name'])
   { 			
      if ($_FILES['archivo']['type']=="text/x-sql")
      { 
	 
	 $destino="../instalacion/bdc.sql";
	 if (is_uploaded_file($_FILES['archivo']['tmp_name'])) 
	 { 
 	    if (copy($_FILES['archivo']['tmp_name'], $destino)) {  $subio = true; } 
	 } 
      }
      else
      {
         echo '<SCRIPT> alert ("No se pudo cargar el archivo formato incorrecto"); </SCRIPT>';
	 $subio = false; 
      }
   }
   else
   {
      echo '<SCRIPT> alert ("Debe seleccionar un archivo SQL"); </SCRIPT>';
      $subio = false; 
   }
   // fin de cargar archivo
   ////// Inicio de la instalación de base de datos
   if ($subio == true)
   {
        include('../datos.php');
        //conecto con la base de datos
	    $conn = mysql_connect($sql_host,$sql_usuario,$sql_pass);
      mysql_query("drop database bdc", $conn);
      $crear = @mysql_query ("CREATE DATABASE bdc DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;"); 
      if (! $crear)
      {
  	    echo '<SCRIPT> alert ("Base No Creada. Ya Existe"); </SCRIPT>';
	    $mensaje_inicial='La Instalaci&oacute;n ya fue efectuada con anterioridad.<br>Contacte al Administrador del Sistema';
      }
      else
      {
	 $archivo = "bdc.sql";
	 $executa = "mysql -u $sql_usuario --password=$sql_pass bdc < $archivo"; 
	 system($executa, $resultado); 
	 if ($resultado==0) { 
	    echo '<SCRIPT> alert ("La Base de datos fue Importada con éxito"); </SCRIPT>';
	    echo  '<SCRIPT LANGUAGE="javascript">location.href = "../modulo_i/bdc_data.php";</SCRIPT>';
	 }
	 else 
	 { 
	    mysql_query("drop database bdc", $conn); 
	    echo '<SCRIPT> alert ("La Base de Datos No fue Creada"); </SCRIPT>';
	    $mensaje_inicial='La Instalaci&oacute;n NO pudo efectuarse.<br>Contacte al Administrador del Sistema';
	 }
      }
   }
   // fin de instalación de base de datos 
}
?>
<form id="form1" name="form1" enctype="multipart/form-data" method="post" action="">
<center>
<img src="../images/logo_bdc.png" alt="Logo <?php echo $organizacion;  ?>" title="Logo <?php echo $organizacion;  ?>"><br>
<p class="inicio_titulo">Importar Base de Datos</p>
<p class="inicio_mensaje"><?php echo $mensaje_inicial; ?><br><input type="file" name="archivo" /></p>
<input type="submit" name="enviar" Value="Importar Base de Datos">
</center></form>
