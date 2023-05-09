<?PHP
$codg_tip_mov=$_GET['codg_tip_mov'];

function guardar_mov($codg_per,$codg_tip_mov){
	$fec_mov = date("Y-m-d");
	$qry="INSERT INTO bdc_movimientos(codg_per,fec_mov,codg_tip_mov) VALUES($codg_per,'$fec_mov',$codg_tip_mov)";
	mysql_query($qry);
	//echo mysql_error();
	//echo $qry;
}

function gen_codg_mov(){
   $sql="SELECT codg_mov FROM bdc_movimientos ORDER BY codg_mov DESC LIMIT 0 , 1";
   $busq=mysql_query($sql);
   $reg=mysql_fetch_array($busq);
   $codg_mov=$reg["codg_mov"];
	return $codg_mov;
}

?>