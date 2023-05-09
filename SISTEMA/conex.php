<?
	include('datos.php');
	//conecto con la base de datos
	$conn = mysql_connect($sql_host,$sql_usuario,$sql_pass);
	//selecciono la BBDD
	mysql_select_db("bdc",$conn);
?>
