<?
  include ("../sesion.php");

  include ("../conex.php");

$codg_mov=$_GET['codg_mov'];
$codg_per=$_GET['codg_per'];

$sq2="select * from bdc_movimientos where codg_mov=$codg_mov";
$busq2=mysql_query($sq2);
if($reg2=mysql_fetch_array($busq2)){
	$codg_tip_mov=$reg2['codg_tip_mov'];
}

$sql="select * from bdc_tipo_movimiento where codg_tip_mov=$codg_tip_mov";
$busq=mysql_query($sql);
if($reg=mysql_fetch_array($busq)){
	$direccion=$reg['dir_con'];
	?>
		<script>window.location="<? echo $direccion; ?>?codg_per=<? echo $codg_per; ?>&codg_mov=<? echo $codg_mov; ?>"</script>
	<?	
}
?>
