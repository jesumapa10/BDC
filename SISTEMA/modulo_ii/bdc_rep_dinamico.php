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
<script>
function imprimir_ficha(codigo)
        {
         window.open("documentos_ficha_trabajador.php?codg_per="+codigo,"_blank","scrollbars=yes,status=no,toolbar=no,directories=no,menubar=no,resizable=no,width=800,height=500")
        }
</script>
</HEAD><BR>
<BR>
<H2>Reporte Dinamico </H2>

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
    <TD COLSPAN="5"><select class="campo" name="codg_mun" onChange="submit();" title="Filtrar personal por municipio">
      <option value="">Todos</option>
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
    </select>      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <input type="submit" name="boton" value="Descargar" title="Haga click aqui para descargar documento e un archivo .xls">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <input type="button" name="boton2" value="Imprimir" onClick="window.print();" title="Haga click aqui para imprimir el documento directamente"></TD></TR>
  <TR>
    <TD><P ALIGN="RIGHT" class="mini">Instituto/Plantel:</P></TD>
    <TD COLSPAN="5"><SELECT class="campo" NAME="codg_insti" onChange="submit();" title="Filtrar personal por plantel">
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
    <TD><P ALIGN="RIGHT" class="mini">Cargo:</P></TD>
    <TD width="199" ALIGN="RIGHT"><div align="left">
      <select class="campo" name="codg_cargo" onChange="submit();" title="Filtrar personal por tipo de cargo">
        <option value="">Seleccione...</option>
        <?
                   $condiciones = mysql_query("SELECT * FROM bdc_cargo ORDER BY 1");
                if (mysql_num_rows($condiciones) != 0)
                {
                    while ($cond = mysql_fetch_array($condiciones))
                  {
                   echo '<OPTION VALUE="'.$cond["codg_cargo"];
                                       echo '"';
                                       if ($codg_cargo == $cond["codg_cargo"])
                                       {
                                          echo 'SELECTED';
                                       }
                                       echo '>'.$cond["desc_cargo"];
                                       echo '</OPTION>';
                  }
                }
                ?>
      </select>
    </div></TD>
    <TD width="175" ALIGN="RIGHT"><span class="mini">Condicion Laboral:</span></TD>
    <TD width="175" ALIGN="RIGHT"><div align="left">
      <select class="campo" name="codg_cond_lab" onChange="submit();"  title="Filtrar personal por condicion laboral">
        <option value="">Seleccione...</option>
        <?
                   $condiciones = mysql_query("SELECT * FROM bdc_cond_lab ORDER BY 1");
                if (mysql_num_rows($condiciones) != 0)
                {
                    while ($cond = mysql_fetch_array($condiciones))
                  {
                   echo '<OPTION VALUE="'.$cond["codg_cond_lab"];
                                       echo '"';
                                       if ($codg_cond_lab == $cond["codg_cond_lab"])
                                       {
                                          echo 'SELECTED';
                                       }
                                       echo '>'.$cond["desc_cond_lab"];
                                       echo '</OPTION>';
                  }
                }
                ?>
      </select>
    </div></TD>
  </TR>
  <TR>
    <TD><div align="right" class="mini">Sexo:</div></TD>
    <TD ALIGN="RIGHT"><div align="left">
      <label>
      <select class="campo" name="sexo_per"  onChange="submit();"  title="Filtrar personal por sexo">
	  	<OPTION value="">Seleccione...</OPTION>
        <option value="M" <? if($sexo_per=='M'){ echo "selected"; } ?>>M</option>
        <option value="F" <? if($sexo_per=='F'){ echo "selected"; } ?>>F</option>
      </select>
      </label>
    </div></TD>
    <TD ALIGN="RIGHT" class="mini">Estatus:</TD>
    <TD ALIGN="RIGHT"><div align="left">
      <select class="campo" name="activo_per"  onChange="submit();"  title="Filtrar personal por estatus, si esta o no activo">
        <OPTION value="">Seleccione...</OPTION>
        <option value="S" <? if($activo_per=='S'){ echo "selected"; } ?>>ACTIVO</option>
        <option value="N" <? if($activo_per=='N'){ echo "selected"; } ?>>NO ACTIVO</option>
      </select>
    </div></TD>
  </TR>
  <TR>
    <TD class="mini"><div align="right"></div></TD>
    <TD ALIGN="RIGHT">&nbsp;</TD>
    <TD ALIGN="RIGHT">&nbsp;</TD>
    <TD ALIGN="RIGHT">&nbsp;</TD>
  </TR>
  <?PHP } ?>
</TABLE>
<table width="94%" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
  	<td width="4%" bgcolor="#999999" class="campo">Nro.</td>
    <td width="6%" bgcolor="#999999" class="campo">Cedula  </td>
    <td width="11%" bgcolor="#999999" class="campo">Apellido</td>
    <td width="11%" bgcolor="#999999" class="campo">Nombre</td>
    <td width="5%" bgcolor="#999999" class="campo">Sexo</td>
    <td width="17%" bgcolor="#999999" class="campo">Institucion</td>
    <td width="12%" bgcolor="#999999" class="campo">Municipio</td>
    <td width="8%" bgcolor="#999999" class="campo">Condicion Laboral </td>
	<td width="6%" bgcolor="#999999" class="campo">Ingreso</td>
	<td width="10%" bgcolor="#999999" class="campo">Cargo</td>
	<td width="5%" bgcolor="#999999" class="campo">Horas Doc.</td>
	<td width="5%" bgcolor="#999999" class="campo">Horas Adm.</td>
	<td width="5%" bgcolor="#999999" class="campo">Ficha</td>
    </tr>
  <tr>
<?


	
	$sql="SELECT * FROM bdc_vista_rep_dinamic WHERE codg_per like '%%'"; 
	if($codg_mun!=""){ $sql.=" AND codg_mun2='$codg_mun'"; }
	if($codg_insti!=""){ $sql.=" AND codg_insti='$codg_insti'"; }
	if($codg_cargo!=""){ $sql.=" AND codg_cargo='$codg_cargo'"; }
	if($codg_cond_lab!=""){ $sql.=" AND codg_cond_lab='$codg_cond_lab'"; }
	if($sexo_per!=""){ $sql.=" AND sexo_per='$sexo_per'"; }
	if($activo_per!=""){ if($activo_per=="S"){$sql.=" AND activo_per='S'";}else{$sql.=" AND activo_per IS NULL OR activo_per!='S'";}}
	$busq=mysql_query($sql);
	$i=0;
	if($reg=mysql_fetch_array($busq)){
		do{ $i++;
			echo "
				<td  class='descripcion' align='right'>".$i."&nbsp;</td>
			    <td  class='descripcion' align='right'>".$reg['codg_per']."&nbsp;</td>
				<td  class='descripcion'>".$reg['apel_per']."&nbsp;</td>
				<td  class='descripcion'>".$reg['nomb_per']."&nbsp;</td>
				<td  class='descripcion' align='center'>".$reg['sexo_per']."&nbsp;</td>
				<td  class='descripcion'>".$reg['nomb_insti']."&nbsp;</td>
				<td  class='descripcion'>".$reg['nomb_mun']."&nbsp;</td>
				<td  class='descripcion'>".$reg['desc_cond_lab']."&nbsp;</td>
				<td  class='descripcion'>".$reg['fec_ingp_lab']."&nbsp;</td>
				<td  class='descripcion'>".$reg['desc_cargo']."&nbsp;</td>
				<td  class='descripcion'>".$reg['horas_doc_lab']."&nbsp;</td>
				<td  class='descripcion'>".$reg['horas_adm_lab']."&nbsp;</td>
				<td  class='descripcion'>"; ?>
				    <a href="#" onclick="imprimir_ficha('<?php echo $reg['codg_per']; ?>')">VER</a>&nbsp;
				<?php echo "</td>
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
