<?
  include ("../sesion.php");

  include ("../conex.php");
?>
<HTML>
<HEAD>
  <LINK REL="STYLESHEET" HREF="../style/normal.css" TYPE="text/css">

<SCRIPT>
function municipio()
{
        if (document.datos.codg_mun.selectedIndex == 100) {
        datos.codg_mun.value="$codg_mun";
        }
        datos.submit();
}
function buscar_institucion()  {

  if (document.datos.codg_insti.value=="0"){
     alert("Seleccione una Institución")
     return false
  }

  else
  {
        alert("<? echo $codg_insti; ?>")
		datos.codg_insti.value="$codg_insti";
		location = "bdc_edit_datos_instituciones.php?codg_insti=<? echo $codg_insti; ?>";
  }
}

</SCRIPT>
</HEAD>

<BR>
<BR>
<H2>Consulta de Instituciones a Editar</H2>


        <FORM method="post" name="datos" action="bdc_edit_consulta_insti.php">
        <BR>
        <TABLE BORDER=0 ALIGN=CENTER>
                <TR>
                <TD><P ALIGN="RIGHT" class="mini">Municipio:</P></TD>
                <TD COLSPAN="3"><SELECT class="campo" NAME="codg_mun" onChange="municipio()">
                <OPTION value="0">Todos</OPTION>
                 <? $municipios = mysql_query("SELECT codg_mun, nomb_mun FROM bdc_municipios WHERE codg_pais=58 and codg_est=274 ORDER BY 2");
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
                </SELECT></TD>
                </TR>

                <TR>
                <TD><P ALIGN="RIGHT" class="mini">Instituto/Plantel:</P></TD>
                <TD COLSPAN="3"><SELECT class="campo" NAME="codg_insti">
                <OPTION value="0">Seleccione...</OPTION>
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
                <TD></TD>
                <TD ALIGN="RIGHT"><INPUT TYPE="BUTTON" VALUE="Editar" class="mini" onClick="buscar_institucion()"></TD>
                </TR>

        </TABLE>


        <INPUT TYPE="HIDDEN" NAME="action" VALUE="">
	

        </FORM>

</HTML>
