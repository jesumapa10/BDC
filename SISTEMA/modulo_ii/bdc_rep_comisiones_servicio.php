<?
  include ("../sesion.php");
  include ("../conex.php");
  include ("../scripts/validar_campos.php");
 
?>
<HTML>
<HEAD>
<SCRIPT LANGUAGE="JavaScript" SRC="../scripts/validar.js" TYPE="text/javascript"></SCRIPT>
<script language='javascript' src="popcalendar.js" TYPE="text/javascript"></script>

<SCRIPT>

function municipio()
{
        if (document.datos.nomb_mun.selectedIndex == 100) {
        datos.nomb_mun.value="$nomb_mun";
        }
        datos.submit();
}
function actualizar()
        {
        datos.submit()
        }

</SCRIPT>
        <LINK REL="STYLESHEET" HREF="../style/normal.css" TYPE="text/css">

        <SCRIPT LANGUAGE="JavaScript" SRC="../scripts/validar.js" TYPE="text/javascript"></SCRIPT>
        <style type="text/css">
<!--
.Estilo23 {font-family: Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold; }
-->
        </style>
</HEAD>

<BR><BR>
<H2>Reporte Comisiones de Servicio </H2>

<FORM method="post" name="datos" action="">

<TABLE BORDER=0 ALIGN=CENTER>
  <TR>
    <TD width="158"><P ALIGN="RIGHT" class="mini">Municipio:</P></TD>
    <TD width="158"><SELECT class="campo" NAME="nomb_mun" onChange="municipio()">
      <OPTION value="">Todos</OPTION>
      <? $municipios = mysql_query("SELECT codg_mun, nomb_mun FROM bdc_municipios WHERE codg_pais=58 AND codg_est=274 ORDER BY 2");
                if (mysql_num_rows($municipios) != 0)
                  {
                    while ($municipio = mysql_fetch_array($municipios))
                    {
                     echo '<OPTION VALUE="'.$municipio["nomb_mun"];
                                         echo '"';
                                         if ($nomb_mun == $municipio["nomb_mun"])
                                           {
                                              echo 'SELECTED';
                                           }
                                         echo '>'.$municipio["nomb_mun"];
                                         echo '</OPTION>';
                    }
                  }
                ?>
    </SELECT>    </TD>
	<TD width="158"><P ALIGN="RIGHT" class="mini">Encargaduria:</P></TD>
	<TD width="158"><input type="checkbox" name="encargaduria" VALUE="S" <? if ($encargaduria == "S") {echo 'CHECKED';}?> onClick="actualizar()">
	</TD>
  </TR>
  <TR>
    <TD><P ALIGN="RIGHT" class="mini">Fecha Inicio:</P></TD>
    <TD width="158"><INPUT TYPE="TEXT" NAME="fec_inicio_com_serv" class="campo" VALUE="<? echo $fec_inicio_com_serv; ?>" MAXLENGTH="10" SIZE="10" id="fec_inicio_com_serv" onClick="popUpCalendar(this, datos.fec_inicio_com_serv, 'yyyy-mm-dd');" READONLY>
                <IMG onClick="popUpCalendar(this, datos.fec_inicio_com_serv, 'yyyy-mm-dd');" SRC="../images/cal.gif" ALT="Haz Click para Buscar la Fecha" WIDTH="16" HEUGHT="16" BORDER="0"></TD>
	<TD><P ALIGN="RIGHT" class="mini">Fecha Fin:</P></TD>
	<TD width="158"><INPUT TYPE="TEXT" NAME="fec_fin_com_serv" class="campo" VALUE="<? echo $fec_fin_com_serv; ?>" MAXLENGTH="10" SIZE="10" id="fec_fin_com_serv" onClick="popUpCalendar(this, datos.fec_fin_com_serv, 'yyyy-mm-dd');" READONLY>
                <IMG onClick="popUpCalendar(this, datos.fec_fin_com_serv, 'yyyy-mm-dd');" SRC="../images/cal.gif" ALT="Haz Click para Buscar la Fecha" WIDTH="16" HEUGHT="16" BORDER="0"></TD>
 
   
    
  </TR>
</TABLE>
<p>&nbsp;</p>
<table width="620" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="52" bgcolor="#999999" class="campo">N° de Oficio</td>
	<td width="52" bgcolor="#999999" class="campo">C&eacute;dula  </td>
    <td width="56" bgcolor="#999999" class="campo">Apellidos</td>
    <td width="55" bgcolor="#999999" class="campo">Nombres</td>
    <td width="35" bgcolor="#999999" class="campo">Sexo</td>
    <td width="103" bgcolor="#999999" class="campo">Municipio Plantel de Origen</td>
    <td width="85" bgcolor="#999999" class="campo">Plantel de Origen</td>
    <td width="87" bgcolor="#999999" class="campo">Municipio Plantel de Destino</td>
	<td width="129" bgcolor="#999999" class="campo">Plantel de Destino</td>
	<td width="129" bgcolor="#999999" class="campo">Jerarquia en el Plantel</td>
	<td width="129" bgcolor="#999999" class="campo">Funciones que va desempeñar</td>	
	<td width="129" bgcolor="#999999" class="campo">Fecha Inicio</td>	
	<td width="129" bgcolor="#999999" class="campo">Fecha Fin</td>	
    </tr>
  <tr>
<?

$fec_fin=$fec_fin_com_serv;

if(($fec_inicio_com_serv!="") && ($fec_fin_com_serv=!""))
{
    $sql="SELECT * FROM bdc_vistas_com_serv WHERE nomb_mun_insti_hacia like '%$nomb_mun%' AND encargaduria like '%$encargaduria%' AND fec_inicio_com_serv >= '$fec_inicio_com_serv' AND fec_fin_com_serv <= '$fec_fin' order by nomb_mun_insti_hacia, apel_per";

}else{
	$sql="SELECT * FROM bdc_vistas_com_serv WHERE nomb_mun_insti_hacia like '%$nomb_mun%' AND encargaduria like '%$encargaduria%' AND fec_inicio_com_serv like '%$fec_inicio_com_serv%' AND fec_fin_com_serv like '%$fec_fin_com_serv%' order by nomb_mun_insti_hacia, apel_per";
}

	$busq=mysql_query($sql);
	if($reg=mysql_fetch_array($busq)){
		do{
			$fec_inicio_com_serv1 = substr($reg['fec_inicio_com_serv'],8,2)."-".substr($reg['fec_inicio_com_serv'],5,2)."-".substr($reg['fec_inicio_com_serv'],0,4);
            $fec_fin_com_serv1 = substr($reg['fec_fin_com_serv'],8,2)."-".substr($reg['fec_fin_com_serv'],5,2)."-".substr($reg['fec_fin_com_serv'],0,4);
			echo "
				<td>".$reg['n_oficio']."</td>
			    <td>".$reg['codg_per']."</td>
				<td>".$reg['apel_per']."</td>
				<td>".$reg['nomb_per']."</td>
				<td>".$reg['sexo_per']."</td>
				<td>".$reg['nomb_mun_insti_desde']."</td>
				<td>".$reg['nomb_plantel_desde']."</td>
				<td>".$reg['nomb_mun_insti_hacia']."</td>
				<td>".$reg['nomb_plantel_hacia']."</td>
				<td>".$reg['desc_jer_plantel']."</td>
				<td>".$reg['func_desemp_com_serv']."</td>
				<td>".$fec_inicio_com_serv1."</td>
				<td>".$fec_fin_com_serv1."</td>
				</tr>
			";			
		}while($reg=mysql_fetch_array($busq));
	};
?>
</table>
            <INPUT TYPE="HIDDEN" NAME="action" VALUE="bus">
            
            </p>
</FORM>

</HTML>
