<?
  include ("../sesion.php");

  include ("../conex.php");
?>

<HTML>
<HEAD>
        <LINK REL="STYLESHEET" HREF="../style/normal.css" TYPE="text/css">

</HEAD>

<?
$consulta = mysql_query("SELECT p.apel_per, p.nomb_per, p.sexo_per, p.fec_nac_per, p.naci_per, p.est_civ_per,
                         p.dirc_per, p.tel_per, p.cel_per, p.email_per,
                         t.desc_tip_trab, p.foto_per, p.tip_foto_per, p.fec_ing_per, p.activo_per, p.fec_reg_ivss, p.fec_ret_ivss, p.nomb_pat
                         FROM bdc_datos_per p, bdc_tip_trab t
                         WHERE p.codg_per=$codg_per and p.codg_tip_trab=t.codg_tip_trab");

$datos = mysql_fetch_array($consulta);

$apel_per = $datos["apel_per"];
$nomb_per = $datos["nomb_per"];
$sexo_per = $datos["sexo_per"];
$fec_nac_per = $datos["fec_nac_per"];
$naci_per = $datos["naci_per"];
$est_civ_per = $datos["est_civ_per"];
$dirc_per = $datos["dirc_per"];
$tel_per = $datos["tel_per"];
$cel_per = $datos["cel_per"];
$email_per = $datos["email_per"];
$desc_tip_trab = $datos["desc_tip_trab"];
$foto_per = $datos["foto_per"];
$tip_foto_per = $datos["tip_foto_per"];
$fec_ing_per = $datos["fec_ing_per"];
$activo_per = $datos["activo_per"];
$fec_reg_ivss = $datos["fec_reg_ivss"];
$fec_ret_ivss = $datos["fec_ret_ivss"];
$nomb_pat = $datos["nomb_pat"];


//$fec_nac = mysql_query("SELECT DATE_FORMAT('fec_nac_per', '%d/%m/%Y') as fecha_nac FROM bdc_datos_per WHERE codg_per=$codg_per");
//$row_fec_nac = mysql_fetch_object($fec_nac);
//$fec_nac_per = $row->fecha_nac;

$pais_nac = mysql_query("SELECT e.nomb_pais FROM bdc_datos_per p, bdc_paises e WHERE p.codg_per=$codg_per AND p.codg_pais_nac_per=e.codg_pais");
$pais_nac = mysql_fetch_array($pais_nac);
$pais_nacimiento = $pais_nac["nomb_pais"];

$est_nac = mysql_query("SELECT e.nomb_est FROM bdc_datos_per p, bdc_estados e WHERE p.codg_per=$codg_per AND p.codg_pais_nac_per=e.codg_pais and p.codg_est_nac_per=e.codg_est");
$est_nac = mysql_fetch_array($est_nac);
$estado_nacimiento = $est_nac["nomb_est"];

$est_dom = mysql_query("SELECT e.nomb_est FROM bdc_datos_per p, bdc_estados e WHERE p.codg_per=$codg_per AND p.codg_pais_dom_per=e.codg_pais and p.codg_est_dom_per=e.codg_est");
$est_dom = mysql_fetch_array($est_dom);
$estado_domicilio = $est_dom["nomb_est"];

$mun_dom = mysql_query("SELECT e.nomb_mun FROM bdc_datos_per p, bdc_municipios e WHERE p.codg_per=$codg_per AND p.codg_pais_dom_per=e.codg_pais and p.codg_est_dom_per=e.codg_est and p.codg_mun_dom_per=e.codg_mun");
$mun_dom = mysql_fetch_array($mun_dom);
$municipio_domicilio = $mun_dom["nomb_mun"];

$parr_dom = mysql_query("SELECT e.nomb_parr FROM bdc_datos_per p, bdc_parroquias e WHERE p.codg_per=$codg_per AND p.codg_pais_dom_per=e.codg_pais and p.codg_est_dom_per=e.codg_est and p.codg_mun_dom_per=e.codg_mun and p.codg_parr_dom_per=e.codg_parr");
$parr_dom = mysql_fetch_array($parr_dom);
$parroquia_domicilio = $parr_dom["nomb_parr"];

?>

<BR><BR>
<H2>Ficha del Personal</H2>

<TABLE ALIGN="CENTER">
<TR>
<TD>
<P ALIGN="CENTER" class="mini">Nombre(s) y Apellido(s):</P>
</TD>

<TD>
<P ALIGN="CENTER" class="campo"><? echo $nomb_per; ?>&nbsp;<? echo $apel_per; ?>&nbsp;&nbsp;&nbsp;&nbsp;</P>
</TD>

<TD>
<P ALIGN="CENTER" class="mini">C&eacute;dula:</P>
</TD>

<TD>
<P ALIGN="CENTER" class="campo"><? if ($naci_per == "V") {echo 'V - ';} else {echo 'E - ';} echo number_format($codg_per ,0 , "," ,"."); ?>&nbsp;&nbsp;&nbsp;&nbsp;</P>
</TD>

<TD>
<P ALIGN="CENTER" class="mini">Tipo de Trabajador:</P>
</TD>

<TD>
<P ALIGN="CENTER" class="campo"><? echo $desc_tip_trab; ?></P>
</TD>
</TR>
</TABLE>

<BR>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td><?  include ("../new_tabs/index.php"); ?></td>
  </tr>
</table>
<p>&nbsp;</p>
</HTML>