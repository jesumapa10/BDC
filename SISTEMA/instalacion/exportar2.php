<?php 
include ('../sesion.php');
if ($_POST['enviar']) 
{
	//Crear Nombre de Archivo
	$Date =date(d."-".m."-".Y."_".H.":".i.":".s);
	$filename = "bdc-".$Date.".sql";

	//Datos BD
	include ('../datos.php');
    //conecto con la base de datos
	$conn = mysql_connect($sql_host,$sql_usuario,$sql_pass);
	//selecciono la BBDD
	mysql_select_db("bdc",$conn);

	//Cabeceras para generar el archivo y activar el guardado del archivo (NO BORRAR)
	header("Pragma: no-cache");
	header("Expires: 0");
	header("Content-Transfer-Encoding: binary");
	header("Content-type: application/force-download");
	header("Content-Disposition: attachment; filename=$filename");

	//Ejecutar el Mysqldump	
	$executa = "mysqldump --opt --password='$sql_pass' --user='$sql_usuario' bdc"; 
	system($executa, $resultado);
}
