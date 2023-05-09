<?
  include ("../sesion.php");

  include ("../conex.php");
?>
<HTML>
<HEAD>
<?
  include ("tabs/tabs_insti_add_c.php");
?>
<SCRIPT LANGUAGE="JavaScript" SRC="/bdc/scripts/validar.js" TYPE="text/javascript"></SCRIPT>

<SCRIPT>
function buscar_director()
{
       datos.buscar1.value="1";
	   datos.submit();
}
function actualizar()
{
        datos.action.value="ins";
		datos.pasada.value="1";

}
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
 <LINK REL="STYLESHEET" HREF="../style/normal.css" TYPE="text/css">


<? 
if ($pasada != 1)

{
       
          $consulta_planel = mysql_query("SELECT codg_plantel, codg_ner_plantel, codg_dic_plantel, nomb_dic_plantel, codg_tip_plantel, codg_mod_plantel, ner_ppal_plantel
                         FROM bdc_plantel
                         WHERE codg_insti=$codg_insti");

          $plantel = mysql_fetch_array($consulta_planel);
          $codg_plantel = $plantel["codg_plantel"];
          $codg_ner_plantel = $plantel["codg_ner_plantel"];
          $codg_dic_plantel = $plantel["codg_dic_plantel"];
          $nomb_dic_plantel = $plantel["nomb_dic_plantel"];
          $codg_tip_plantel = $plantel["codg_tip_plantel"];
		  $codg_mod_plantel = $plantel["codg_mod_plantel"];
          $ner_ppal_plantel = $plantel["ner_ppal_plantel"];


         $consulta_insti = mysql_query("SELECT bdc_instituciones.*, bdc_instituciones.codg_insti, bdc_instituciones.nomb_insti, bdc_municipios.nomb_mun, bdc_mod_plantel.desc_mod_plantel, bdc_tip_plantel.desc_tip_plantel, bdc_tip_insti.codg_tip_insti, bdc_tip_insti.desc_tip_insti FROM ((((bdc_plantel RIGHT JOIN bdc_instituciones ON bdc_plantel.codg_insti = bdc_instituciones.codg_insti) LEFT JOIN bdc_municipios ON (bdc_instituciones.codg_mun = bdc_municipios.codg_mun) AND (bdc_instituciones.codg_est = bdc_municipios.codg_est) AND (bdc_instituciones.codg_pais = bdc_municipios.codg_pais)) LEFT JOIN bdc_mod_plantel ON bdc_plantel.codg_mod_plantel = bdc_mod_plantel.codg_mod_plantel) LEFT JOIN bdc_tip_plantel ON bdc_plantel.codg_tip_plantel = bdc_tip_plantel.codg_tip_plantel) LEFT JOIN bdc_tip_insti ON bdc_instituciones.codg_tip_insti = bdc_tip_insti.codg_tip_insti WHERE (((bdc_instituciones.codg_insti) = $codg_insti))");
		 
		 $datos = mysql_fetch_array($consulta_insti);
         $nomb_insti = $datos["nomb_insti"];
         $codg_mun = $datos["codg_mun"];
		 $nomb_mun = $datos["nomb_mun"];
         $codg_parr = $datos["codg_parr"];
         $dirc_insti = $datos["dirc_insti"];
         $telf_insti = $datos["telf_insti"];
         $fax_insti = $datos["fax_insti"];
         $codg_tipo_insti = $datos["codg_tipo_insti"];
         $org_insti = $datos["org_insti"];
         $codg_tip_insti = $datos["codg_tip_insti"];
         $desc_tip_insti = $datos["desc_tip_insti"];
 }		 


?>

<BODY>

<BR><BR>
<H2>Consulta Instituci&oacute;n</H2>

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


<SCRIPT>do_tabs("Datos Plantel", "")</SCRIPT>




<BR><BR>

        <TABLE BORDER="0" ALIGN="CENTER">
                <TR>
                <TD COLSPAN="2">
                <DIV ALIGN="CENTER"><P class="cabecera">Datos Plantel</P></DIV>
                </TD>
                </TR>

                <TR>
                <TD WIDTH="150"><P ALIGN="RIGHT" class="mini">C&oacute;digo del M.E.:</P></TD>
                <TD WIDTH="300"><P ALIGN="LEFT" class="campo"><? echo $codg_plantel; ?></P></TD>
                </TR>

                <TR>
                <TD><P ALIGN="RIGHT" class="mini">C&eacute;dula del Director:</P></TD>
                <TD><P ALIGN="LEFT" class="campo"><? echo $codg_dic_plantel; ?></P>
                </TD>
                </TR>

                <TR>
                <TD><P ALIGN="RIGHT" class="mini">Nombre del Director:</P></TD>
                <TD><P ALIGN="LEFT" class="campo"><? echo $nomb_dic_plantel; ?></P></TD>
                </TR>

                <TR>
                <TD><P ALIGN="RIGHT" class="mini">Tipo de Plantel:</P></TD>
                
                <? $tipos_plantel = mysql_query("SELECT codg_tip_plantel, desc_tip_plantel FROM bdc_tip_plantel WHERE codg_tip_plantel=$codg_tip_plantel ORDER BY 2");
				if (mysql_num_rows($tipos_plantel) != 0)
				{
				  $tipo_plantel = mysql_fetch_array($tipos_plantel);
				  echo '<TD><P ALIGN="LEFT" class="campo">'.$tipo_plantel["desc_tip_plantel"];echo'</P></TD>';
				}
                
                                      
                ?>
               </TR>

                <TR>
                <TD><P ALIGN="RIGHT" class="mini">Modalidad del Plantel:</P></TD>
          		<? $mods_plantel = mysql_query("SELECT codg_mod_plantel, desc_mod_plantel FROM bdc_mod_plantel WHERE codg_mod_plantel=$codg_mod_plantel ORDER BY 2");
				if (mysql_num_rows($mods_plantel) != 0)
				{
				  $mod_plantel = mysql_fetch_array($mods_plantel);
				 echo '<TD><P ALIGN="LEFT" class="campo">'.$mod_plantel["desc_mod_plantel"];echo'</P></TD>';
				}
				
                 
                                       
                ?>
              
                </TR>

                <TR>
                <TD><P ALIGN="RIGHT" class="mini">C&oacute;digo de NER:</P></TD>
                <TD><P ALIGN="LEFT" class="campo"><? if ($codg_ner_plantel != 'NULL') {echo $codg_ner_plantel;} ?></P></TD>
                </TR>

                <TR>
                <TD><P ALIGN="RIGHT" class="mini">¿NER Principal?</P></TD>
                
                <TD><P ALIGN="LEFT" class="campo"><? if ($ner_ppal_plantel == "S") {echo "Sede";} else{echo "No";} ?></P>
                
                </TD>
                </TR>

                <TR>
                <TD COLSPAN="2"><HR></TD>
                </TR>

        </TABLE>




<INPUT TYPE="hidden" NAME="codg_insti" VALUE="<? echo $codg_insti; ?>">


</BODY>
</HTML>

