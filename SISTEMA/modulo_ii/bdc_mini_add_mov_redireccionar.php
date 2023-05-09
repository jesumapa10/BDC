<?
  include ("../sesion.php");

  include ("../conex.php");

$codg_tip_mov=$_GET['codg_tip_mov'];
$codg_per=$_GET['codg_per'];

$sql="select * from bdc_tipo_movimiento where codg_tip_mov=$codg_tip_mov";
$busq=mysql_query($sql);
if($reg=mysql_fetch_array($busq)){
	$direccion=$reg['dir_add'];
	?>
		<script>window.location="<? echo $direccion; ?>?codg_per=<? echo $codg_per; ?>&codg_tip_mov=<? echo $codg_tip_mov; ?>"</script>
	<?	
}
/*
if($mov==1){
	?>
		<script>window.location="bdc_mini_add_comision_servicio.php?codg_per=<? echo $codg_per; ?>&codg_tip_mov=<? echo $mov; ?>"</script>
	<?
}elseif($mov==2){
	?>
		<script>window.location="bdc_add_datos_academicos.php?codg_per=<? echo $codg_per; ?>"</script>
	<?
}elseif($mov==3){
	?>
		<script>window.location="bdc_mini_add_datos_laborales.php?codg_per=<? echo $codg_per; ?>&codg_tip_mov=<? echo $mov; ?>"</script>
	<?
}elseif($mov==4){
	?>
		<script>window.location="bdc_mini_add_datos_laborales.php?codg_per=<? echo $codg_per; ?>"</script>
	<?
}elseif($mov==5){
	?>
		<script>window.location="bdc_mini_add_datos_permisos.php?codg_per=<? echo $codg_per; ?>&codg_tip_mov=<? echo $mov; ?>"</script>
	<?
}elseif($mov==6){
	?>
		<script>window.location="bdc_mini_add_traslados.php?codg_per=<? echo $codg_per; ?>&codg_tip_mov=<? echo $mov; ?>"</script>
	<?
}
*/
?>
