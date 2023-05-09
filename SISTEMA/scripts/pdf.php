<?php
$phpentra=$_GET["phpdoc"];
if ($phpentra)
{
	/*Incluimos el archivo de configuracion */
	require_once("../dompdf/dompdf_config.inc.php");
	/* creamos un nuevo objeto */
	$dompdf = new DOMPDF();
	/* Llamamos a nuestro archivo html */
	/* a través del método "load_html_file" */
	$dompdf->load_html_file("$phpentra");
	$dompdf->render();
	$dompdf->stream("constancia.pdf");
}
else
echo 'Disculpe no hemos recibido el nombre del documento a convertir';
?>