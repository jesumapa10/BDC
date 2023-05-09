<?
  include ("../sesion.php");

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
		
function ingresar()
{
        datos.action.value="ins";
        datos.pasada.value="1";


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
<H2>Editar Ficha de Personal</H2>
<?
$consulta = mysql_query("SELECT d.apel_per, d.nomb_per, d.naci_per, t.desc_tip_trab
                 FROM bdc_datos_per d, bdc_tip_trab t
                 WHERE d.codg_per=$codg_per AND d.codg_tip_trab=t.codg_tip_trab");

$datos = mysql_fetch_array($consulta);

$apel_per1 = $datos["apel_per"];
$nomb_per1 = $datos["nomb_per"];
$naci_per1 = $datos["naci_per"];
$desc_tip_trab1 = $datos["desc_tip_trab"];

?>

<TABLE ALIGN="CENTER">
<TR>
<TD>
<P ALIGN="CENTER" class="mini">Nombre(s) y Apellido(s):</P>
</TD>

<TD>
<P ALIGN="CENTER" class="campo"><? echo $nomb_per1; ?>&nbsp;<? echo $apel_per1; ?>&nbsp;&nbsp;&nbsp;&nbsp;</P>
</TD>

<TD>
<P ALIGN="CENTER" class="mini">C&eacute;dula:</P>
</TD>

<TD>
<P ALIGN="CENTER" class="campo"><? if ($naci_per1 == "V") {echo 'V - ';} else {echo 'E - ';} echo number_format($codg_per ,0 , "," ,"."); ?>&nbsp;&nbsp;&nbsp;&nbsp;</P>
</TD>

<TD>
<P ALIGN="CENTER" class="mini">Tipo de Trabajador:</P>
</TD>

<TD>
<P ALIGN="CENTER" class="campo"><? echo $desc_tip_trab1; ?></P>
</TD>
</TR>
</TABLE>
<br>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td><?  include ("../new_tabs/index.php"); ?></td>
  </tr>
</table>
<p>&nbsp;</p>
</BODY>

</HTML>
