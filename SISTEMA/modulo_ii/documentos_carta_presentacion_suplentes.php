<?
  include ("../conex.php");
  $codg_mov = $_GET["codg_mov"];
?>
<HTML>
<HEAD>
<LINK REL="STYLESHEET" HREF="../style/normal.css" TYPE="text/css">
<SCRIPT LANGUAGE="JavaScript" SRC="../scripts/validar.js" TYPE="text/javascript"></SCRIPT>
</HEAD>
<BODY>
<?PHP 
//////Vista para consultar los suplentes
/* SELECT codg_mov, codg_per, (SELECT nomb_dic_plantel from bdc_plantel p where p.codg_insti=dl.codg_insti) AS nomb_dic_plantel, (SELECT i.nomb_insti from bdc_instituciones i where i.codg_insti=dl.codg_insti) AS nomb_insti, (Select pr.nomb_per from bdc_datos_per pr WHERE pr.codg_per=dl.codg_per) AS nomb_per, (Select pr.naci_per from bdc_datos_per pr WHERE pr.codg_per=dl.codg_per) AS naci_per, (Select pr.apel_per from bdc_datos_per pr WHERE pr.codg_per=dl.codg_per) AS apel_per, (select nomb_mun from bdc_instituciones ins, bdc_municipios mun where ins.codg_insti=dl.codg_insti AND mun.codg_pais=ins.codg_pais AND mun.codg_est=ins.codg_est AND mun.codg_mun=ins.codg_mun) AS nomb_mun, fec_ingp_lab, fec_ret FROM bdc_datos_lab dl */ 
///// final vista
$sql = "SELECT * FROM bdc_vistas_suplentes vs WHERE vs.codg_mov=$codg_mov";
$consulta_suplente = mysql_query ($sql);
$datos = mysql_fetch_array ($consulta_suplente);
                $codg_per = $datos["codg_per"];
                $naci_per = $datos["naci_per"];
                $codg_per = number_format($codg_per ,0 , "," ,".");
                if ($naci_per == "V") { $codg_per = 'V-'.$codg_per; } else { $codg_per = 'E-'.$codg_per;}
                $nomb_dic_plantel=$datos["nomb_dic_plantel"];
                $nomb_insti = $datos["nomb_insti"];
                $nomb_mun = $datos["nomb_mun"];
                $apel_per = $datos["apel_per"];
                $fec_ingp_lab = $datos["fec_ingp_lab"];
                $fec_ingp_lab = substr($fec_ingp_lab,8,2)."-".substr($fec_ingp_lab,5,2)."-".substr($fec_ingp_lab,0,4);
                $fec_ret = $datos["fec_ret"];
                $fec_ret = substr($fec_ret,8,2)."-".substr($fec_ret,5,2)."-".substr($fec_ret,0,4);
                $nomb_per = $datos["nomb_per"];
                

?>
<TABLE ALIGN=CENTER><TR><TD WIDTH="10%"></TD><TD WIDTH="80%">
<BR><BR><BR>
<CENTER>
  <img src="../images/logo_documentos.png" width="201" height="154">
</CENTER>
<P><B>DPPECD/AAP/MP/2395</B></P>
<P> <DIV ALIGN=right> M&Eacute;RIDA, <?PHP echo Date(d); ?> de <?PHP $mes=Date(m); 
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
echo $mes; ?> de <?PHP echo Date(Y); ?></DIV></P>
<P>
Ciudadano(a):<br>
Lic. <?PHP echo $nomb_dic_plantel; ?><br>
Director(a) (E) <?PHP echo $nomb_insti; ?> <br>
Municipio <?PHP echo $nomb_mun; ?><br>
</P>
<br><br><br><br>
<DIV STYLE="text-align:justify"> 
Con un saludo Bolivariano y Revolucionario, me dirijo a usted en la oportunidad de notificarle que esta Direcci&oacute;n designa a el (la) ciudadano(a) <b><?PHP echo $nomb_per.' '.$apel_per; ?></b>, titular de la c&eacute;dula de identidad N&ordm; <b><?PHP echo $codg_per; ?></b>, en condici&oacute;n de <b>suplente</b>, designaci&oacute;n que se hace en virtud que <b><?PHP echo $nomb_insti; ?></b>, Ubicada en el Municipio <b><?PHP echo $nomb_mun; ?></b> del Estado M&eacute;rida, desde el <b><?PHP echo $fec_ingp_lab; ?></b> hasta <b><?PHP echo $fec_ret; ?></b>. La presente designaci&oacute;n se hace de acuerdo a lo estipulado en el Art&iacute;culo 61 numeral 27 de la Ley de Administraci&oacute;n P&uacute;blica del Estado M&eacute;rida, en concordancia con el Art&iacute;culo 01 del Decreto 098, de fecha 20 de marzo 2009, publicada en Gaceta Oficial N&ordm; Extraordinario de la misma fecha.
</DIV>

<P><CENTER>
Atentamente,
</CENTER></P>

<BR><BR><BR>
<P><CENTER>
Dr. &Aacute;ngel Zuley Ant&uacute;nez P&eacute;rez<BR><BR>

DIRECTOR ESTADAL DEL PODER POPULAR<BR>
DE EDUCACI&Oacute;N, CULTURA Y DEPORTE
</CENTER></P>
<br><br><br><br>
<P><font size="2">AZAP/MAR/kg/sr</font></P>

<P><CENTER><HR>
  <span class="descripcion"><FONT SIZE=2>Sector La Parroquia Av. 5 "Las Pe&ntilde;as", (detr&aacute;s del Liceo Caracciolo Parra y Olmedo) Edificio "Aguas Blancas" torre "A" 
  <br>
  M&eacute;rida, Estado M&eacute;rida.<BR>
  Tel&eacute;fonos: (0274) 271.22.33 - 271.56.34 - 271.59.83 - 271.32.22      www.decd-merida.gov.ve  e-mail: decd@decd-merida.gov.ve</span>
</CENTER></P></TD>
<TD WIDTH="10%"></TD></TR></TABLE>
</BODY>
</HTML>
