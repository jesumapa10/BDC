<?
  include ("../sesion.php");

  include ("../conex.php");
?>
<HTML>
<HEAD>
<?
  include ("tabs/tabs_insti_add_e.php");
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

if ($buscar1 == "1") 
   {
        $datos_plantel = mysql_query("SELECT nomb_per, apel_per FROM bdc_datos_per WHERE codg_per=$codg_dic_plantel");

        if (mysql_num_rows($datos_plantel) != 0)
          {
             $datos = mysql_fetch_array($datos_plantel);
             $nomb_per = $datos["nomb_per"];
             $apel_per = $datos["apel_per"];
			 
             echo ' <SCRIPT>alert("Director Encontrado");</SCRIPT>';
         }
        else
         {
              echo'<SCRIPT>alert("Director No Encontrado");</SCRIPT>';
         }

   }
?>

<BODY>

<BR><BR>
<H2>Editar Instituci&oacute;n</H2>

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
<FORM METHOD="post" NAME="datos" action="bdc_edit_datos_plantel.php">

        <TABLE BORDER="0" ALIGN="CENTER">
                <TR>
                <TD COLSPAN="2">
                <DIV ALIGN="CENTER"><P class="cabecera">Datos Plantel</P></DIV>
                </TD>
                </TR>

                <TR>
                <TD WIDTH="150"><P ALIGN="RIGHT" class="mini">C&oacute;digo del M.E.:</P></TD>
                <TD WIDTH="300"><INPUT class="campo" TYPE="TEXT" NAME="codg_plantel" SIZE="10" MAXLENGTH="10" VALUE="<? echo $codg_plantel; ?>"></TD>
                </TR>

                <TR>
                <TD><P ALIGN="RIGHT" class="mini">C&eacute;dula del Director:</P></TD>
                <TD>
                <INPUT class="campo" TYPE="TEXT" NAME="codg_dic_plantel" SIZE="10" MAXLENGTH="9" VALUE="<? echo $codg_dic_plantel; ?>">&nbsp;
                <INPUT class="mini" TYPE="BUTTON" NAME="buscar" VALUE="Buscar" onClick="buscar_director()">
                </TD>
                </TR>

                <TR>
                <TD><P ALIGN="RIGHT" class="mini">Nombre del Director:</P></TD>
                <TD><INPUT class="campo" TYPE="TEXT" NAME="nomb_dic_plantel" SIZE="40" MAXLENGTH="80" VALUE="<? echo $nomb_dic_plantel; ?>"></TD>
                </TR>

                <TR>
                <TD><P ALIGN="RIGHT" class="mini">Tipo de Plantel:</P></TD>
                <TD><SELECT class="campo" NAME="codg_tip_plantel">
                <OPTION value="0">Seleccione...</OPTION>
                <? $tipos_plantel = mysql_query("SELECT codg_tip_plantel, desc_tip_plantel FROM bdc_tip_plantel ORDER BY 2");
                if (mysql_num_rows($tipos_plantel) != 0)
                {
                    while ($tipo_plantel = mysql_fetch_array($tipos_plantel))
                  {
                   echo '<OPTION VALUE="'.$tipo_plantel["codg_tip_plantel"];
                                       echo '"';
                                       if ($codg_tip_plantel == $tipo_plantel["codg_tip_plantel"])
                                       {
                                          echo 'SELECTED';
                                       }
                                       echo '>'.$tipo_plantel["desc_tip_plantel"];
                                       echo '</OPTION>';
                  }
                }
                ?>
                </SELECT></TD>
                </TR>

                <TR>
                <TD><P ALIGN="RIGHT" class="mini">Modalidad del Plantel:</P></TD>
                <TD><SELECT class="campo" NAME="codg_mod_plantel">
                <OPTION value="0">Seleccione...</OPTION>
                <? $mods_plantel = mysql_query("SELECT codg_mod_plantel, desc_mod_plantel FROM bdc_mod_plantel ORDER BY 2");
                if (mysql_num_rows($mods_plantel) != 0)
                {
                    while ($mod_plantel = mysql_fetch_array($mods_plantel))
                  {
                   echo '<OPTION VALUE="'.$mod_plantel["codg_mod_plantel"];
                                       echo '"';
                                       if ($codg_mod_plantel == $mod_plantel["codg_mod_plantel"])
                                       {
                                          echo 'SELECTED';
                                       }
                                       echo '>'.$mod_plantel["desc_mod_plantel"];
                                       echo '</OPTION>';
                  }
                }
                ?>
                </SELECT></TD>
                </TR>

                <TR>
                <TD><P ALIGN="RIGHT" class="mini">C&oacute;digo de NER:</P></TD>
                <TD><INPUT class="campo" TYPE="TEXT" NAME="codg_ner_plantel" SIZE="10" MAXLENGTH="10" VALUE="<? if ($codg_ner_plantel != 'NULL') {echo $codg_ner_plantel;} ?>"></TD>
                </TR>

                <TR>
                <TD><P ALIGN="RIGHT" class="mini">¿NER Principal?</P></TD>
                <TD><SELECT class="campo" NAME="ner_ppal_plantel">
                <OPTION value="0">Seleccione...</OPTION>
                <OPTION value="S" <? if ($ner_ppal_plantel == "S") {echo "SELECTED";} ?>>Si</OPTION>
                <OPTION value="N" <? if ($ner_ppal_plantel == "N") {echo "SELECTED";} ?>>No</OPTION>
                </SELECT></TD>
                </TR>

                <TR>
                <TD COLSPAN="2"><HR></TD>
                </TR>

        </TABLE>

<CENTER><INPUT class="mini" TYPE="SUBMIT"  NAME="agregar" VALUE="Actualizar" onClick="actualizar()">&nbsp;<INPUT class="mini" TYPE="BUTTON" VALUE="Finalizar" onClick="finalizar()"></CENTER>


<INPUT TYPE="hidden" NAME="codg_insti" VALUE="<? echo $codg_insti; ?>">
<INPUT TYPE="hidden" NAME="action" VALUE="">
<INPUT TYPE="hidden" NAME="buscar1" VALUE="">
<INPUT TYPE="hidden" NAME="pasada" VALUE="1">

</FORM>

<?
   if($action == "ins")
{
          if ($codg_ner_plantel == "") {($codg_ner_plantel = "NULL");}
          if ($codg_dic_plantel == "") {($codg_dic_plantel = "NULL");}
          if ($nomb_dic_plantel == "") {($nomb_dic_plantel = "NULL");} else {($nomb_dic_plantel = "'$nomb_dic_plantel'");}
          if ($ner_ppal_plantel == "") {($ner_ppal_plantel = "NULL");} else {($ner_ppal_plantel = "'$ner_ppal_plantel'");}

        $qry =("update bdc_plantel set codg_plantel=$codg_plantel, codg_ner_plantel='$codg_ner_plantel', codg_dic_plantel=$codg_dic_plantel, nomb_dic_plantel=$nomb_dic_plantel,                    codg_tip_plantel=$codg_tip_plantel, codg_mod_plantel=$codg_mod_plantel,                         ner_ppal_plantel=$ner_ppal_plantel where codg_insti=$codg_insti");
        mysql_query($qry);

        echo '<SCRIPT>alert("Datos Actualizados");</SCRIPT>';
}
?>

<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">

  var frmvalidator  = new Validator("datos");

  frmvalidator.addValidation("codg_plantel","req","Ingrese el Código del M.E.");
  frmvalidator.addValidation("codg_plantel","num");

  frmvalidator.addValidation("codg_tip_plantel","dontselect=0","Seleccione el Tipo de Plantel");

  frmvalidator.addValidation("codg_mod_plantel","dontselect=0","Seleccione la Modalidad del Plantel");

  frmvalidator.setAddnlValidationFunction("actualizar");

</SCRIPT>

</BODY>
</HTML>

