<?PHP include ("../sesion.php");
if($boton=='Descargar'){
	header("Content-type: application/vnd.ms-excel");
	header("Content-Disposition: attachment; filename=reporte_dinamico.xls"); 
}
  include ("../conex.php");
  include ("../scripts/validar_campos.php");
  

?>

<HTML>
<HEAD>
        <LINK REL="STYLESHEET" HREF="../style/normal.css" TYPE="text/css">

        <SCRIPT LANGUAGE="JavaScript" SRC="../scripts/validar.js" TYPE="text/javascript"></SCRIPT>
        <style type="text/css">
<!--
.Estilo23 {font-family: Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold; }
-->
        </style>
<Script>
function imprimir_ficha(codigo)
        {
         window.open("documentos_ficha_instituciones.php?codg_insti="+codigo,"_blank","scrollbars=yes,status=no,toolbar=no,directories=no,menubar=no,resizable=no,width=800,height=500")
        }
</Script>
</HEAD>

<BR><BR>
<H2>Consulta de instituciones por municipio</H2>

<FORM method="post" name="datos" action="">
<?PHP 	$codg_mun = $_POST['codg_mun']; 
		$codg_insti = $_POST['codg_insti'];
		$codg_cargo = $_POST['codg_cargo'];
		$codg_cond_lab = $_POST['codg_cond_lab'];
		$sexo_per = $_POST['sexo_per'];
		$activo_per = $_POST['activo_per'];
?>
<TABLE BORDER=0 ALIGN=CENTER><?PHP if($boton!="Descargar"){ ?>
  <TR>
    <TD width="158"><P ALIGN="RIGHT" class="mini">Municipio:</P></TD>
    <TD COLSPAN="5"><SELECT class="campo" NAME="codg_mun" onChange="submit();" title="Filtrar instituciones por municipio">
      <OPTION value="">Todos</OPTION>
      <? $municipios = mysql_query("SELECT codg_mun, nomb_mun FROM bdc_municipios WHERE codg_pais='58' AND codg_est='274' ORDER BY 2");
                if (mysql_num_rows($municipios) != 0)
                  {
                    while ($municipio = mysql_fetch_array($municipios))
                    {
                     echo '<OPTION VALUE="'.$municipio["codg_mun"];
                                         echo '"';
                                         if ($codg_mun == $municipio["codg_mun"])
                                           {
                                              echo 'SELECTED';
                                           }
                                         echo '>'.$municipio["nomb_mun"];
                                         echo '</OPTION>';
                    }
                  }
                ?>
    </SELECT>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="boton" value="Descargar" title="Haga click aqui para descargar documento e un archivo .xls">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" name="boton2" value="Imprimir" onClick="window.print();" title="Haga click aqui para imprimir el documento directamente"></TD>
  </TR>
  <TR>
    <TD><P ALIGN="RIGHT" class="mini">Instituto/Plantel:</P></TD>
    <TD COLSPAN="5"><SELECT class="campo" NAME="codg_insti" onChange="submit();" title="Filtrar institucion directamente">
      <OPTION value="">Seleccione...</OPTION>
      <?
                if (($codg_mun != 0) && ($codg_mun != ""))
                {
                   $instituciones = mysql_query("SELECT codg_insti, nomb_insti FROM bdc_instituciones WHERE codg_pais=58 AND codg_est=274 AND codg_mun=$codg_mun ORDER BY 2");
                }
                else
                {
                   $instituciones = mysql_query("SELECT codg_insti, nomb_insti FROM bdc_instituciones where codg_pais=58 AND codg_est=274 ORDER BY 2");
                }
                if (mysql_num_rows($instituciones) != 0)
                {
                    while ($institucion = mysql_fetch_array($instituciones))
                  {
                   echo '<OPTION VALUE="'.$institucion["codg_insti"];
                                       echo '"';
                                       if ($codg_insti == $institucion["codg_insti"])
                                       {
                                          echo 'SELECTED';
                                       }
                                       echo '>'.$institucion["nomb_insti"];
                                       echo '</OPTION>';
                  }
                }
                ?>
    </SELECT></TD>
  </TR>
  <TR>
    <TD class="mini"><div align="right"></div></TD>
    <TD width="199" ALIGN="RIGHT">&nbsp;</TD>
    <TD width="175" ALIGN="RIGHT">&nbsp;</TD>
    <TD width="175" ALIGN="RIGHT">&nbsp;</TD>
  </TR>
  <?PHP } ?>
</TABLE>
<table width="94%" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
  	<td width="6%" bgcolor="#999999" class="campo">Nro.</td>
    <td width="9%" bgcolor="#999999" class="campo">Codigo</td>
    <td width="13%" bgcolor="#999999" class="campo">Nombre</td>
    <td width="13%" bgcolor="#999999" class="campo">Direccion</td>
    <td width="7%" bgcolor="#999999" class="campo">Telefono</td>
    <td width="19%" bgcolor="#999999" class="campo">Fax</td>
    <td width="12%" bgcolor="#999999" class="campo">Municipio</td>
    <td width="12%" bgcolor="#999999" class="campo">Parroquia </td>
	<td width="9%" bgcolor="#999999" class="campo">Tipo</td>
    <td width="9%" bgcolor="#999999" class="campo">Ficha</td>
    </tr>
  <tr>
<?


	
	$sql="SELECT i.*, (select desc_tip_insti from bdc_tip_insti where codg_tip_insti=i.codg_tip_insti) AS desc_tip_insti, (select nomb_mun from bdc_municipios where codg_pais='58' AND codg_est='274' AND codg_mun=i.codg_mun) AS nomb_mun, (select nomb_parr from bdc_parroquias where codg_pais='58' AND codg_est='274' AND codg_mun=i.codg_mun AND codg_parr=i.codg_parr) AS nomb_parr FROM bdc_instituciones i WHERE codg_pais='58' AND codg_est='274'"; 
	if($codg_mun!=""){ $sql.=" AND i.codg_mun='$codg_mun'"; }
	if($codg_insti!=""){ $sql.=" AND codg_insti='$codg_insti'"; }
	if($codg_cargo!=""){ $sql.=" AND codg_cargo='$codg_cargo'"; }
	if($codg_cond_lab!=""){ $sql.=" AND codg_cond_lab='$codg_cond_lab'"; }
	if($sexo_per!=""){ $sql.=" AND sexo_per='$sexo_per'"; }
	if($activo_per!=""){ if($activo_per=="S"){$sql.=" AND activo_per='S'";}else{$sql.=" AND activo_per IS NULL OR activo_per!='S'";}}
	$sql.=" ORDER BY nomb_mun";
	$busq=mysql_query($sql);
	$i=0;
	if($reg=mysql_fetch_array($busq)){
		do{ $i++;
			echo "
				<td  class='descripcion' align='right'>".$i."&nbsp;</td>
			    <td  class='descripcion' align='right'>".$reg['codg_insti']."&nbsp;</td>
				<td  class='descripcion'>".$reg['nomb_insti']."&nbsp;</td>
				<td  class='descripcion'>".$reg['dirc_insti']."&nbsp;</td>
				<td  class='descripcion'>".$reg['telf_insti']."&nbsp;</td>
				<td  class='descripcion'>".$reg['fax_insti']."&nbsp;</td>
				<td  class='descripcion'>".$reg['nomb_mun']."&nbsp;</td>
				<td  class='descripcion'>".$reg['nomb_parr']."&nbsp;</td>
				<td  class='descripcion'>".$reg['desc_tip_insti']."&nbsp;</td>
				<td  class='descripcion' align='center'><A HREF='#' onclick='imprimir_ficha(".$reg[codg_insti].")'>Ver</a>&nbsp;</td>
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
