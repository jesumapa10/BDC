<?
  include ("../sesion.php");

  include ("../conex.php");
?>
<HTML>
<HEAD>
        <LINK REL="STYLESHEET" HREF="../style/normal.css" TYPE="text/css">

        <SCRIPT LANGUAGE="JavaScript" SRC="../scripts/validar.js" TYPE="text/javascript"></SCRIPT>

<SCRIPT>
function estado_nacimiento()
{
        if (document.datos.codg_pais_nac_per.selectedIndex == 100) {
        datos.codg_pais_nac_per.value="$codg_pais_nac_per";
        }
        datos.codg_est_nac_per.value="0";
        datos.submit();
}

function municipio_domicilio()
{
        if (document.datos.codg_est_dom_per.selectedIndex == 100) {
        datos.codg_est_dom_per.value="$codg_est_dom_per";
        }
        datos.codg_mun_dom_per.value="0";
        datos.codg_parr_dom_per.value="0";
        datos.submit();
}

function parroquia_domicilio()
{
        if (document.datos.codg_mun_dom_per.selectedIndex == 100) {
        datos.codg_mun_dom_per.value="$codg_mun_dom_per";
        }
        datos.codg_parr_dom_per.value="0";
        datos.submit();
}

function ingresar()
{
        datos.action.value="ins";

}
</SCRIPT>

<SCRIPT LANGUAGE="JavaScript" SRC="../scripts/calendario.js" TYPE="text/javascript"></SCRIPT>

<SCRIPT LANGUAGE="JavaScript" SRC="../scripts/cal-barra.js" TYPE="text/javascript"></SCRIPT>

<SCRIPT LANGUAGE="JavaScript">
        var c1 = new CodeThatCalendar(caldef1);
</SCRIPT>

</HEAD>


<BODY>
<BR>
<BR>
<H2>Agregar Ficha de Personal</H2>
<br>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td><?  include ("../new_tabs/index.php"); ?></td>
  </tr>
</table>
<p>&nbsp;</p>
</BODY>
</HTML>