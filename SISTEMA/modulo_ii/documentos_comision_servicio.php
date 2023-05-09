<?
include ("../conex.php");
$codg_mov = $_GET["codg_mov"]; 
$codg_per = $_GET["codg_per"];
$desc_tip_trab = $_GET["desc_tip_trab"];

$sql="SELECT * FROM bdc_vistas_com_serv WHERE codg_mov=".$codg_mov." AND codg_per=".$codg_per;
$busq=mysql_query($sql);
$reg=mysql_fetch_array($busq);
  
$apel_per=$reg['apel_per'];
$nomb_per=$reg['nomb_per'];
$nomb_mun_per=$reg['nomb_mun_per'];
$sexo_per=$reg['sexo_per'];
$nomb_plantel_desde=$reg['nomb_plantel_desde'];
$nomb_mun_inst_desde=$reg['nomb_mun_insti_desde'];
$desc_jer_plantel=$reg['desc_jer_plantel'];
$func_desemp_com_serv=$reg['func_desemp_com_serv'];
$nomb_plantel_hacia=$reg['nomb_plantel_hacia'];
$nomb_mun_inst_hacia=$reg['nomb_mun_insti_hacia'];
$fec_inicio_com_serv=$reg['fec_inicio_com_serv'];
$fec_fin_com_serv=$reg['fec_fin_com_serv'];
$n_oficio=$reg['n_oficio'];
$encargaduria=$reg['encargaduria'];
$siglas=$reg['siglas'];

if ($nomb_mun_per=="") { 
    echo '<SCRIPT>alert("El personal no tiene dirección de domicilio almacenada. \nPor favor solucione el problema y vuelva a intentarlo.");</SCRIPT>';
    echo '<script>window.close()</script>';
}

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
<div align="left"><IMG SRC="../images/logo_documentos.png" NAME="gráficos1" ALIGN=BOTTOM WIDTH=109 HEIGHT=70 BORDER=0></div></TD>
<TD WIDTH="80%"></TD>
    <TD><DIV ALING="RIGTH"><img src="../images/200bicentenario.jpeg" width="48" height="85"></div></TD>	
</TABLE>
<P><span class="descripcion Estilo3">DEPPECD/AAP/MP/<?PHP echo $n_oficio?></span></P>
<div align="justify" class="Inicio_Estilo3 Estilo12">Quien suscribe <strong>PLTGA. JENNY RIVAS CAMACHO</strong>, venezolana, mayor de edad, titular de la c&eacute;dula  de identidad N&ordm; V-<strong> 12.349.600</strong>, civilmente h&aacute;bil y domiciliada en la  ciudad de M&eacute;rida Estado M&eacute;rida, en su car&aacute;cter  de <strong>Directora Estadal del Poder Popular de  Educaci&oacute;n, Cultura </strong>y <strong>Deporte </strong>de  la Gobernaci&oacute;n del Estado M&eacute;rida, tal como consta en el  Decreto N&ordm; 027, de fecha 01 de Febrero del 2011, publicado en la Gaceta Oficial  N&ordm; 2323, de fecha 01 de Febrero&nbsp;  de 2011, de conformidad a lo establecido en el art&iacute;culo 1 del Decreto 125 publicado en Gaceta Oficial Extraordinario de fecha 24 de mayo de 2010, actuando en este acto en nombre y representaci&oacute;n de la Direcci&oacute;n Estadal del Poder Popular de Educaci&oacute;n, Cultura y Deporte de esta Entidad Federal.</div> 
</p>
<p align="center"><strong>NOTIFICO</strong></p>
<p>
<div align="justify" class="Inicio_Estilo3 Estilo12">A <?PHP if ($sexo_per=="M"){ echo "el ciudadano ";}else{ echo "la ciudadana ";} ?> <strong><?PHP echo $apel_per.", ".$nomb_per; ?>, </strong><?PHP if ($sexo_per=="M"){ echo "venezolano";}else{ echo "venezolana";} ?>,  mayor de edad, titular de la c&eacute;dula de identidad N&ordm; <strong>V- <?PHP echo number_format($codg_per ,0 , "," ,"."); ?>,</strong> <?PHP if ($sexo_per=="M"){ echo "domiciliado ";}else{ echo "domiciliada ";} ?> en la  jurisdicci&oacute;n del Municipio <strong><?PHP echo $nomb_mun_per; ?></strong> del Estado  M&eacute;rida y civilmente h&aacute;bil, quien presta sus servicios como <strong><?PHP echo $desc_jer_plantel; ?></strong>, en el plantel: <strong><?PHP echo $nomb_plantel_desde; ?></strong>, Municipio <strong><?PHP echo $nomb_mun_inst_desde; ?></strong> del Estado  M&eacute;rida, que ha sido <?PHP if ($sexo_per=="M"){ echo "declarado ";}else{ echo "declarada ";} ?> en:</div> 
</p>
<p align="center"><strong>COMISI&Oacute;N DE SERVICIO</strong></p>
<p>
<div align="justify" class="Inicio_Estilo3 Estilo12">Con el objeto de que cumpla funciones <?PHP if ($encargaduria=="S"){ echo "como "; echo '<strong>'.$func_desemp_com_serv.'</strong>'; echo "en la instituci&oacute;n "; echo '<strong>'.$nomb_plantel_hacia.',</strong>'; echo " ubicada en el Municipio "; echo '<strong>'.$nomb_mun_inst_hacia.'</strong>'; echo " del Estado M&eacute;rida, ";}else{ echo "de ";  echo '<strong>'.$func_desemp_com_serv. '</strong>';} ?>desde el <strong><?PHP echo cambiaf_a_normal($fec_inicio_com_serv); ?></strong> hasta el <strong><?PHP echo cambiaf_a_normal($fec_fin_com_serv); ?></strong>, lapso de  tiempo durante el cual queda <?PHP if ($sexo_per=="M"){ echo "autorizado el comisionado";}else{ echo "autorizada la comisionada";} ?>, para  separarse temporalmente de sus funciones como <strong><?PHP echo $desc_jer_plantel; ?></strong>, de  conformidad a lo establecido en los Art&iacute;culos del 71 al 76 de la Ley del  Estatuto de la Funci&oacute;n P&uacute;blica, siendo su supervisor inmediato para todos los  efectos legales el Director o Directora Estadal del Poder Popular de Educaci&oacute;n, Cultura y Deporte, todo  ello a los fines de dar cumplimiento al art&iacute;culo 22 ejusdem. Las facultades  aqu&iacute; conferidas son meramente declarativas y en ning&uacute;n caso constitutivas o  definitivas; queda establecido expresamente que al vencimiento de la presente  comisi&oacute;n, cesar&aacute; en el ejercicio de las funciones aqu&iacute; conferidas, debiendo  incorporarse al cargo que desempe&ntilde;aba en la dependencia a la cual est&aacute; adscrita u  otro cargo equivalente, reserv&aacute;ndose el Director o Directora Estadal de  Educaci&oacute;n el derecho de revocar unilateralmente en cualquier momento el  presente acto administrativo. Se emiten dos ejemplares uno para <?PHP if ($sexo_per=="M"){ echo "el comisionado";}else{ echo "la comisionada";} ?> y uno  reposa en el expediente de esta Direcci&oacute;n.</div>
<p><span class="Inicio_Estilo3 Estilo12">En M&eacute;rida a los <?PHP echo Date(d); ?> d&iacute;as del mes de 
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
&nbsp;de <?PHP echo Date(Y); ?>&nbsp;&nbsp; </span>
<p><br>
<p>

<p align="center"><span class="Inicio_Estilo3 Estilo11"><strong>PLTGA. JENNY RIVAS CAMACHO</strong><br>
    <strong>DIRECTORA&nbsp; ESTADAL DEL PODER POPULAR </strong><br>
    <strong>DE EDUCACI&Oacute;N, CULTURA&nbsp; Y DEPORTE. </strong></span><br>
</p>
<p align="center" class="Estilo13 Estilo14">"Independencia, Patria Socialista... Viviremos y Venceremos"</p>
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
