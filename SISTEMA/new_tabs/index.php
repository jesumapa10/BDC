<?php include('constructor.php'); ?>
<style type="text/css">
<!--
body {
	background-color: <?PHP echo $tabs_main; ?>;
}
-->
</style>
<table cellpadding="0" cellspacing="0" border="0"><tr>
<? 	// reconocemos en que pagina nos encontramos
	$file = $_SERVER['PHP_SELF'];
	$file = basename($file, ".php");
	//->
	if ($file == 'bdc_edit_datos_personales')
	{
		$seccion = 1;
		$tabs_counter = 1;
		while ($tabs_counter <= $ntabs)
		{
			echo '<td>';
			$tab_name = $tabs[$seccion][$tabs_counter][1];
			$tab_direccion = $tabs[$seccion][$tabs_counter][2];
			$tab_img = $tabs[$seccion][$tabs_counter][3];
			$tab_muestra = $tabs[$seccion][$tabs_counter][4];
			$tab_primera = $tabs[$seccion][1][4];
			include ('tabs.php');
			echo '</td>';
			$tabs_counter = $tabs_counter + 1;
		}
	}
	if ($file == 'bdc_add_datos_personales')
	{		
		$seccion = 0;
		$tabs_counter = 1;
		if (!$_GET['id_tab']){ $tabs_counter = 0 ; $ntabs = 0; }
		while ($tabs_counter <= $ntabs)
		{
			echo '<td>';
			$tab_name = $tabs[$seccion][$tabs_counter][1];
			$tab_direccion = $tabs[$seccion][$tabs_counter][2];
			$tab_img = $tabs[$seccion][$tabs_counter][3];
			$tab_muestra = $tabs[$seccion][$tabs_counter][4];
			$tab_primera = $tabs[$seccion][0][4];
			include ('tabs.php');
			echo '</td>';
			$tabs_counter = $tabs_counter + 1;
		}
	}
	if ($file == 'bdc_datos_personales')
	{
		$seccion = 2;
		$tabs_counter = 1;
		while ($tabs_counter <= $ntabs)
		{
			echo '<td>';
			$tab_name = $tabs[$seccion][$tabs_counter][1];
			$tab_direccion = $tabs[$seccion][$tabs_counter][2];
			$tab_img = $tabs[$seccion][$tabs_counter][3];
			$tab_muestra = $tabs[$seccion][$tabs_counter][4];
			$tab_primera = $tabs[$seccion][1][4];
			include ('tabs.php');
			echo '</td>';
			$tabs_counter = $tabs_counter + 1;
		}
	}
?>
</tr>
</table>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
<? include ('tabs_center_top.php'); ?>
</table>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
<? include ('tabs_center.php'); ?>
</table>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
<? include ('tabs_end.php'); ?>
</table>
