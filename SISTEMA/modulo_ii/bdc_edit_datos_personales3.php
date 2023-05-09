<?
  include ("../conex.php");
?>
<HTML>
<HEAD>
<LINK REL="STYLESHEET" HREF="../style/normal.css" TYPE="text/css">
<SCRIPT LANGUAGE="JavaScript" SRC="../scripts/validar.js" TYPE="text/javascript"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="/bdc/scripts/validar.js" TYPE="text/javascript"></SCRIPT>
<SCRIPT>
function estado_nacimiento()
{
        if (document.datos.codg_pais_nac_per.selectedIndex == 100) {
        datos.codg_pais_nac_per.value="$codg_pais_nac_per";
        }
        datos.submit();
}

function municipio_domicilio()
{
        if (document.datos.codg_est_dom_per.selectedIndex == 100) {
        datos.codg_est_dom_per.value="$codg_est_dom_per";
        }
        datos.submit();
}

function parroquia_domicilio()
{
        if (document.datos.codg_mun_dom_per.selectedIndex == 100) {
        datos.codg_est_mun_per.value="$codg_mun_dom_per";
        }
        datos.submit();
}

function finalizar()
{
input_box=confirm("¿Está seguro que desea Finalizar?");
if (input_box==true)

{
        location = "../modulo_i/bdc_data.php";
}

}

function siguiente()
        {
        location = "bdc_edit_datos_academicos.php?codg_per=<? echo $codg_per; ?>";
        }
function ingresar()
{
        datos.action.value="ins";
        datos.pasada.value="1";


}

</SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="../scripts/calendario.js" TYPE="text/javascript"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="../scripts/cal-barra.js" TYPE="text/javascript"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript"> var c1 = new CodeThatCalendar(caldef1); </SCRIPT>
</HEAD>

<BODY>
<p>
  <?

if ($pasada != 1)
 {

   $consulta = mysql_query("SELECT p.apel_per, p.nomb_per, p.sexo_per, p.fec_nac_per, p.naci_per, p.est_civ_per, p.codg_pais_nac_per,
                         p.codg_est_nac_per, p.codg_pais_dom_per, p.codg_est_dom_per, p.codg_mun_dom_per, p.codg_parr_dom_per,
                         p.dirc_per, p.tel_per, p.cel_per, p.email_per, p.codg_tip_trab,
                         t.desc_tip_trab, p.foto_per, p.tip_foto_per, p.fec_ing_per, p.activo_per, p.fec_reg_ivss, p.fec_ret_ivss, p.nomb_pat
                         FROM bdc_datos_per p, bdc_tip_trab t
                         WHERE p.codg_per=$codg_per and p.codg_tip_trab=t.codg_tip_trab");

   $datos = mysql_fetch_array($consulta);

   $apel_per = $datos["apel_per"];
   $nomb_per = $datos["nomb_per"];
   $sexo_per = $datos["sexo_per"];
   $fec_nac_per = $datos["fec_nac_per"];
   $fec_nac_per = substr($fec_nac_per,8,2)."-".substr($fec_nac_per,5,2)."-".substr($fec_nac_per,0,4);
   $codg_pais_nac_per = $datos["codg_pais_nac_per"];
   $codg_est_nac_per = $datos["codg_est_nac_per"];
   $codg_pais_dom_per = $datos["codg_pais_dom_per"];
   $codg_est_dom_per = $datos["codg_est_dom_per"];
   $codg_mun_dom_per = $datos["codg_mun_dom_per"];
   $codg_parr_dom_per = $datos["codg_parr_dom_per"];
   $codg_tip_trab = $datos["codg_tip_trab"];
   $naci_per = $datos["naci_per"];
   $est_civ_per = $datos["est_civ_per"];
   $dirc_per = $datos["dirc_per"];
   $tel_per = $datos["tel_per"];
   $codg_tel = substr($tel_per,0,4); $tel = substr($tel_per,4,7);
   $cel_per = $datos["cel_per"];
   $codg_cel = substr($cel_per,0,4); $cel = substr($cel_per,4,7);
   $email_per = $datos["email_per"];
   $desc_tip_trab = $datos["desc_tip_trab"];
   $foto_per = $datos["foto_per"];
   $tip_foto_per = $datos["tip_foto_per"];
   $fec_ing_per = $datos["fec_ing_per"];
   $fec_ing_per = substr($fec_ing_per,8,2)."-".substr($fec_ing_per,5,2)."-".substr($fec_ing_per,0,4);
   $activo_per = $datos["activo_per"];
   $fec_reg_ivss = $datos["fec_reg_ivss"];
   $fec_reg_ivss = substr($fec_reg_ivss,8,2)."-".substr($fec_reg_ivss,5,2)."-".substr($fec_reg_ivss,0,4);
   $fec_ret_ivss = $datos["fec_ret_ivss"];
   $fec_ret_ivss = substr($fec_ret_ivss,8,2)."-".substr($fec_ret_ivss,5,2)."-".substr($fec_ret_ivss,0,4);
   $nomb_pat = $datos["nomb_pat"];
 }
?>
</p>
<table width="100%" border="0">
  <tr>
    <td width="12%"><img src="../images/logo.jpg" width="80" height="62"></td>
    <td width="88%"><div align="center">
      <p class="cabecera"><strong>Ficha con Datos Peronales </strong></p>
    </div></td>
  </tr>
</table>
<table width="100%" border="1">
  <tr>
    <td><? echo $apel_per; ?></td>
    <td><? echo $nomb_per; ?></td>
    <td><? echo $sexo_per; ?></td>
    <td><? echo $fec_nac_per; ?></td>
  </tr>
  <tr>
    <td><? echo $fec_nac_per; ?></td>
    <td><? echo $codg_pais_nac_per; ?></td>
    <td><? echo $codg_est_nac_per; ?></td>
    <td><? echo $codg_pais_dom_per; ?></td>
  </tr>
  <tr>
    <td><? echo $codg_est_dom_per; ?></td>
    <td><? echo $codg_mun_dom_per; ?></td>
    <td><? echo $codg_parr_dom_per; ?></td>
    <td><? echo $codg_tip_trab; ?></td>


  </tr>
  <tr>
    <td><? echo $naci_per; ?></td>
    <td><? echo $est_civ_per; ?></td>
    <td><? echo $dirc_per; ?></td>
    <td><? echo $tel_per; ?></td>
  </tr>
  <tr>
    <td><? echo $codg_tel; ?></td>
    <td><? echo $cel_per; ?></td>
    <td><? echo $codg_cel; ?></td>
    <td><? echo $email_per; ?></td>
  </tr>
  <tr>
    <td><? echo $desc_tip_trab; ?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><? echo $fec_ing_per; ?></td>
  </tr>
  <tr>
    <td><? echo $fec_ing_per; ?></td>
    <td><? echo $activo_per; ?></td>
    <td><? echo $fec_reg_ivss; ?></td>
    <td><? echo $fec_reg_ivss; ?></td>
  </tr>
  <tr>
    <td><? echo $fec_ret_ivss; ?></td>
    <td><? echo $fec_ret_ivss; ?></td>
    <td><? echo $nomb_pat; ?></td>
    <td>&nbsp;</td>
  </tr>
</table>
<p>&nbsp;</p>
</BODY>

</HTML> 

