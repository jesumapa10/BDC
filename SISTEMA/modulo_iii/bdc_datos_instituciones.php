<?
  include ("../sesion.php");

  include ("../conex.php");
?>
<HTML>
<HEAD>
 <LINK REL="STYLESHEET" HREF="../style/normal.css" TYPE="text/css">

<SCRIPT LANGUAGE="JavaScript" SRC="/bdc/scripts/validar.js" TYPE="text/javascript"></SCRIPT>

<?
  include ("tabs/tabs_insti_add_c.php");
?>

<SCRIPT>

function finalizar()
{
input_box=confirm("¿Está seguro que desea Finalizar?");
if (input_box==true)

        {
        location = "../modulo_i/bdc_data.php";
        }

}

</SCRIPT>

</HEAD>

<?
if ($pasada!=1)
 {
                                          
                                          
        $consulta_insti = mysql_query("SELECT bdc_instituciones.*, bdc_instituciones.codg_insti, bdc_instituciones.nomb_insti, bdc_municipios.nomb_mun, bdc_mod_plantel.desc_mod_plantel, bdc_tip_plantel.desc_tip_plantel, bdc_tip_insti.codg_tip_insti, bdc_tip_insti.desc_tip_insti FROM ((((bdc_plantel RIGHT JOIN bdc_instituciones ON bdc_plantel.codg_insti = bdc_instituciones.codg_insti) LEFT JOIN bdc_municipios ON (bdc_instituciones.codg_mun = bdc_municipios.codg_mun) AND (bdc_instituciones.codg_est = bdc_municipios.codg_est) AND (bdc_instituciones.codg_pais = bdc_municipios.codg_pais)) LEFT JOIN bdc_mod_plantel ON bdc_plantel.codg_mod_plantel = bdc_mod_plantel.codg_mod_plantel) LEFT JOIN bdc_tip_plantel ON bdc_plantel.codg_tip_plantel = bdc_tip_plantel.codg_tip_plantel) LEFT JOIN bdc_tip_insti ON bdc_instituciones.codg_tip_insti = bdc_tip_insti.codg_tip_insti WHERE (((bdc_instituciones.codg_insti) = $codg_insti))");
        
 
		 $datos1 = mysql_fetch_array($consulta_insti);
         $nomb_insti = $datos1["nomb_insti"];
         $codg_mun = $datos1["codg_mun"];
		 $nomb_mun = $datos1["nomb_mun"];
         $codg_parr = $datos1["codg_parr"];
         $dirc_insti = $datos1["dirc_insti"];
         $telf_insti = $datos1["telf_insti"];
         $fax_insti = $datos1["fax_insti"];
         $org_insti = $datos1["org_insti"];
         $codg_tip_insti = $datos1["codg_tip_insti"];
         $desc_tip_insti = $datos1["desc_tip_insti"];
		 $codg_tel= substr($telf_insti,0,4);
		 $tel= substr($telf_insti,4,7);
		 $codg_fax= substr($fax_insti,0,4);
		 $fax= substr($fax_insti,4,7);

 }

?>

<BODY>

<BR><BR>
<H2>Consulta Instituci&oacute;n
</H2>

<TABLE ALIGN="CENTER">
<TR>
<TD>
<P ALIGN="CENTER" class="mini">Instituci&oacute;n:</P>
</TD>

<TD>
<P ALIGN="CENTER" class="campo"><? echo $nomb_insti; ?>&nbsp;&nbsp;&nbsp;&nbsp;</P>
</TD>

<TD>
<P ALIGN="CENTER" class="mini">Municipio:</P>
</TD>

<TD>
<P ALIGN="CENTER" class="campo"><? echo $nomb_mun; ?>&nbsp;&nbsp;&nbsp;&nbsp;</P>
</TD>

<TD>
<P ALIGN="CENTER" class="mini">Tipo de Instituci&oacute;n:</P>
</TD>

<TD>
<P ALIGN="CENTER" class="campo"><? echo $desc_tip_insti; ?></P>
</TD>
</TR>
</TABLE>
<BR>
<SCRIPT>do_tabs("Datos Institución", "")</SCRIPT>

<BR><BR>

        <TABLE BORDER="0" ALIGN="CENTER">
                <TR>
                <TD COLSPAN="4">
                <DIV ALIGN="CENTER"><P class="cabecera">Datos Generales</P></DIV>
                </TD>
                </TR>

                <TR>
                <TD COLSPAN="1"><P ALIGN="RIGHT" class="mini">Nombre de la Instituci&oacute;n:</P></TD>
                <TD COLSPAN="3"><P align="left" class="campo"><? echo $nomb_insti; ?></P></TD>
                </TR>

                <TR>
                <TD><P ALIGN="RIGHT" class="mini">Municipio:</P></TD>
                <? $municipios = mysql_query("SELECT codg_mun, nomb_mun FROM bdc_municipios WHERE codg_mun=$codg_mun AND codg_pais=58 and codg_est=274 ORDER BY 2"); 
				if (mysql_num_rows($municipios) != 0){$municipio = mysql_fetch_array($municipios);}?>
               <TD WIDTH="150"><P align="left" class="campo"><? echo $municipio["nomb_mun"];?></P></TD>                            
                <TD WIDTH="150"><P ALIGN="RIGHT" class="mini">Parroquia:</P></TD>
                
               <?

                      $parroquias = mysql_query("SELECT codg_parr, nomb_parr FROM bdc_parroquias WHERE codg_parr=$codg_parr and codg_pais=58 and codg_est=274 and codg_mun=$codg_mun ORDER BY 2");
					   if (mysql_num_rows($parroquias) != 0){$parroquia = mysql_fetch_array($parroquias);}?>
				<TD WIDTH="150"><P align="left" class="campo"><? echo $parroquia["nomb_parr"];?></P></TD>                            
                </TR>

                <TR>
                <TD><P ALIGN="RIGHT" class="mini">Direcci&oacute;n:</P></TD>
                <TD COLSPAN="3"><P align="left" class="campo"><? echo $dirc_insti; ?></P></TD>
                </TR>

                <TR>
                <TD><P ALIGN="RIGHT" class="mini">Tipo de Instituci&oacute;n:</P></TD>
               
                 <? $tipos = mysql_query("SELECT codg_tip_insti, desc_tip_insti FROM bdc_tip_insti WHERE codg_tip_insti=$codg_tip_insti ORDER BY 2"); 
				  if (mysql_num_rows($tipos) != 0){$tipo = mysql_fetch_array($tipos);}?>
               <TD WIDTH="150"><P align="left" class="campo"><? echo $tipo["desc_tip_insti"]; ?></P></TD>
                </TR>

                <TR>
                <TD><P ALIGN="RIGHT" class="mini">Tel&eacute;fono:</P></TD>
                <TD><P ALIGN="LEFT" class="campo"><? echo $codg_tel."-".$tel; ?></P></TD>
                <TD><P ALIGN="RIGHT" class="mini">Fax:</P></TD>
                <TD><P ALIGN="LEFT" class="campo"><? echo $codg_fax."-".$fax; ?></P></TD>
                </TR>

                

                <TR>
                <TD COLSPAN="4"><HR></TD>
                </TR>

        </TABLE>




<INPUT TYPE="hidden" NAME="codg_insti" VALUE="<? echo $codg_insti; ?>">






</BODY>
</HTML>

