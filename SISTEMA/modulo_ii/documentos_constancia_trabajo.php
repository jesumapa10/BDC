<?
include ("../conex.php");
include ("../scripts/numerosaletras.php");
include ("../scripts/calcularanios.php");
$codg_per = $_GET["codg_per"];
$codg_mov = $_GET["codg_mov"];
$desc_tip_trab = $_GET["desc_tip_trab"];

$sql="SELECT bdc_datos_per.codg_per, bdc_datos_per.apel_per, bdc_datos_per.nomb_per, bdc_datos_per.fec_ing_per, bdc_datos_per.sexo_per, bdc_instituciones.nomb_insti, bdc_jer_cargo.desc_jer_cargo, bdc_municipios.nomb_mun, bdc_datos_lab.codg_mov, bdc_datos_lab.sueldo_integral, bdc_datos_lab.bono_bolivariano, bdc_datos_lab.bono_simoncito, bdc_datos_lab.cesta_ticket FROM (((bdc_datos_per LEFT JOIN bdc_datos_lab ON bdc_datos_per.codg_per = bdc_datos_lab.codg_per) LEFT JOIN bdc_instituciones ON bdc_datos_lab.codg_insti = bdc_instituciones.codg_insti) LEFT JOIN bdc_jer_cargo ON (bdc_datos_lab.codg_cat_cargo = bdc_jer_cargo.codg_cat_cargo) AND (bdc_datos_lab.codg_jer_cargo = bdc_jer_cargo.codg_jer_cargo)) LEFT JOIN bdc_municipios ON (bdc_instituciones.codg_pais = bdc_municipios.codg_pais) AND (bdc_instituciones.codg_est = bdc_municipios.codg_est) AND (bdc_instituciones.codg_mun = bdc_municipios.codg_mun) WHERE (((bdc_datos_lab.codg_mov)=$codg_mov))";
$busq=mysql_query($sql);
$reg=mysql_fetch_array($busq);
  
$apel_per=$reg['apel_per'];
$nomb_per=$reg['nomb_per'];
$nomb_mun=$reg['nomb_mun'];
$sexo_per=$reg['sexo_per'];
$nomb_insti=$reg['nomb_insti'];
$desc_jer_cargo=$reg['desc_jer_cargo'];
$fec_ing_per=$reg['fec_ing_per'];
$fec_ing_per=substr($fec_ing_per,8,2)."/".substr($fec_ing_per,5,2)."/".substr($fec_ing_per,0,4);
$sueldo_integral=$reg['sueldo_integral'];
$bono_bolivariano=$reg['bono_bolivariano'];
$bono_simoncito=$reg['bono_simoncito'];
$cesta_ticket=$reg['cesta_ticket'];


?>
<HTML>
<HEAD>
<LINK REL="STYLESHEET" HREF="../style/normal.css" TYPE="text/css">
<SCRIPT LANGUAGE="JavaScript" SRC="../scripts/validar.js" TYPE="text/javascript"></SCRIPT>
<style type="text/css">
<!--
.Estilo3 {font-size: xx-small}
.Estilo11 {font-size: 12pt}
.Estilo12 {font-size: 13px}
.Estilo13 {
	font-size: xx-small;
	font-weight: bold;
}
.Estilo14 {font-size: 10px}
-->
</style>
</HEAD>
<BODY>
<?PHP 
// funciones

$total=$sueldo_integral+$bono_bolivariano+$bono_simoncito;

$total_letras=convertir_a_letras($total);
$cesta_ticket_letras=convertir_a_letras($cesta_ticket);
$aniosmesesdias=calcularanios($fec_ing_per);


function cambiaf_a_normal($fecha){
    ereg( "([0-9]{2,4})-([0-9]{1,2})-([0-9]{1,2})", $fecha, $mifecha);
    $lafecha=$mifecha[3]."/".$mifecha[2]."/".$mifecha[1];
    return $lafecha;
} 

function cambiaf_a_mysql($fecha){
    ereg( "([0-9]{1,2})/([0-9]{1,2})/([0-9]{2,4})", $fecha, $mifecha);
    $lafecha=$mifecha[3]."-".$mifecha[2]."-".$mifecha[1];
    return $lafecha;
} 


?>
<TABLE ALIGN=CENTER><TR><TD WIDTH="1%"></TD>
<TD WIDTH="98%">
<TABLE width="100%" ALIGN=CENTER>
<TD height="87">
<div align="CENTER"><IMG SRC="../images/logo_documentos.png" NAME="gráficos1" ALIGN=BOTTOM WIDTH=109 HEIGHT=70 BORDER=0></div></TD>

    
</TABLE>
<HR>
<P align="center"><strong>QUIEN SUSCRIBE</strong></P>
<P align="center"><strong>HACE CONSTAR  </strong></P>
<div align="justify" class="Inicio_Estilo3 Estilo12">Que <?PHP if ($sexo_per="M"){echo "el ciudadano ";}else{echo "la ciudadana ";} echo '<strong>'.strtoupper($nomb_per).","." ".strtoupper($apel_per).'</strong>'; ?> titular de la c&eacute;dula de identidad N&deg; <?php echo '<strong>'.number_format($codg_per ,0 , "," ,".").'</strong>'; ?>,  presta sus servicios como <?php echo '<strong>'.strtoupper($desc_jer_cargo).'</strong>'; ?> en el (la) <?php echo '<strong>'.strtoupper($nomb_insti).'</strong>'; ?> que funciona en el Municipio <?php echo '<strong>'.strtoupper($nomb_mun).'</strong>'; ?> devengando un sueldo mensual de <?php echo '<strong>'.strtoupper($total_letras)." "."(Bs ".number_format($total ,2 , "," ,".").")".'</strong>'; ?></div> 
</p>
<p>
<div align="justify" class="Inicio_Estilo3 Estilo12">Adicional recibe un monto apoximado mensual de <?php echo '<strong>'.strtoupper($cesta_ticket_letras)." "."(Bs ".number_format($cesta_ticket ,2 , "," ,".").")".'</strong>'; ?> por concepto de Bono de Alimentaci&oacute;n de conformidad con lo establecido en el Art. 5 de la Ley de alimentaci&oacute;n, la cual se acredita mediante tarjeta electr&oacute;nica.</div> 
</p>
<p align="center" class="Estilo12">FECHA DE INGRESO: <?php echo '<strong>'.$fec_ing_per.'</strong>'; ?></p>
<p align="center" class="Estilo12">A&Ntilde;OS DE SERVICIO: <?php echo '<strong>'.$aniosmesesdias.'</strong>'; ?></p>
<p>
<div align="justify" class="Inicio_Estilo3 Estilo12">Constancia de INGRESO que se expide a petici&oacute;n de parte interesada, en la ciudad de M&eacute;rida a los <?PHP echo Date(d); ?> d&iacute;as del mes de
  <?PHP $mes=Date(m); 
if ($mes == 1) {$mes='Enero';} 
if ($mes == 2) {$mes='Febrero';}
if ($mes == 3) {$mes='Marzo';}
if ($mes == 4) {$mes='Abril';}
if ($mes == 5) {$mes='Mayo';}
if ($mes == 6) {$mes='Junio';}
if ($mes == 7) {$mes='Julio';}
if ($mes == 8) {$mes='Agosto';}
if ($mes == 9) {$mes='Septiembre';}
if ($mes == 10) {$mes='Octubre';}
if ($mes == 11) {$mes='Noviembre';}
if ($mes == 12) {$mes='Diciembre';}
echo $mes; ?>
&nbsp;de <?PHP echo Date(Y); ?>&nbsp;&nbsp;</div>
<p>

<p><br>
<p>
<p align="center"><span class="Inicio_Estilo3 Estilo11"><strong>PLTGA. JENNY RIVAS CAMACHO</strong><br>
    <strong>DIRECTORA&nbsp; ESTADAL DEL PODER POPULAR </strong><br>
    <strong>DE EDUCACI&Oacute;N, CULTURA&nbsp; Y DEPORTE. </strong></span><br><span class="Inicio_Estilo3 Estilo12">Designada seg&uacute;n Decreto N&deg; 027 de fecha 01/02/2011</span><br>
    <span class="Inicio_Estilo3 Estilo12">Gaceta Oficial del Estado M&eacute;rida N&deg; 2323 de fecha 01/02/2011</span><br>
</p>
<p align="center" class="Estilo13 Estilo14">&nbsp;</p>
<p align="left" class="Estilo13"><?PHP echo $siglas; ?></p>
<CENTER>
  <HR>
  <FONT SIZE=2><span class="descripcion Estilo3">Sector La Parroquia Av. 5 "Las Pe&ntilde;as", (detr&aacute;s del Liceo Caracciolo Parra y Olmedo) Edificio "Aguas Blancas" torre "A" 
    <br>
    M&eacute;rida, Estado M&eacute;rida.
    Tel&eacute;fonos: (0274) 271.22.33 - 271.56.34 - 271.59.83 - 271.32.22      www.decd-merida.gob.ve  e-mail: decd@merida.gob.ve</span></CENTER></TD>
<TD WIDTH="1%"></TD>
</TR></TABLE>
</BODY>
</HTML>
