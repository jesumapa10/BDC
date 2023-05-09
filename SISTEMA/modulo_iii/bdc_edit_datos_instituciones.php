<?
  include ("../sesion.php");

  include ("../conex.php");
?>
<HTML>
<HEAD>
 <LINK REL="STYLESHEET" HREF="../style/normal.css" TYPE="text/css">

<SCRIPT LANGUAGE="JavaScript" SRC="/bdc/scripts/validar.js" TYPE="text/javascript"></SCRIPT>

<?
  include ("tabs/tabs_insti_add_e.php");
?>

<SCRIPT>
function municipio()
{
        if (document.datos.codg_mun.selectedIndex == 100) {
        datos.codg_mun.value="$codg_mun";
        }
        datos.submit();
}

function cambiar()
{
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
function actualizar()
{
        datos.action.value="ins";
		
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
<H2>Editar Instituci&oacute;n
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
<FORM METHOD="post" ENCTYPE="multipart/form-data" NAME="datos" action="bdc_edit_datos_instituciones.php">

        <TABLE BORDER="0" ALIGN="CENTER">
                <TR>
                <TD COLSPAN="4">
                <DIV ALIGN="CENTER"><P class="cabecera">Datos Generales</P></DIV>
                </TD>
                </TR>

                <TR>
                <TD COLSPAN="1"><P ALIGN="RIGHT" class="mini">Nombre de la Instituci&oacute;n:</P></TD>
                <TD COLSPAN="3"><INPUT class="campo" TYPE="TEXT" NAME="nomb_insti" SIZE="70" MAXLENGTH="50" VALUE="<? echo $nomb_insti; ?>"></TD>
                </TR>

                <TR>
                <TD><P ALIGN="RIGHT" class="mini">Municipio:</P></TD>
                <TD WIDTH="150"><SELECT class="campo" NAME="codg_mun" onChange="municipio()">
                <OPTION value="0">Seleccione...</OPTION>
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

                <TD WIDTH="150"><P ALIGN="RIGHT" class="mini">Parroquia:</P></TD>
                <TD WIDTH="150"><SELECT class="campo" name=codg_parr>
                <OPTION value="0">Seleccione...</OPTION>
               <?
                 if ($codg_mun != "")
                 {
                      $parroquias = mysql_query("SELECT codg_parr, nomb_parr FROM bdc_parroquias WHERE codg_pais=58 and codg_est=274 and codg_mun=$codg_mun ORDER BY 2");
                   if (mysql_num_rows($parroquias) != 0)
                   {
                       while ($parroquia = mysql_fetch_array($parroquias))
                     {
                       echo '<OPTION VALUE="'.$parroquia["codg_parr"];
                                           echo '"';
                                           if ($codg_parr == $parroquia["codg_parr"])
                                           {
                                              echo 'SELECTED';
                                           }
                                           echo '>'.$parroquia["nomb_parr"];
                                           echo '</OPTION>';
                     }
                   }
                }
                ?>
                </SELECT></TD>
                </TR>

                <TR>
                <TD><P ALIGN="RIGHT" class="mini">Direcci&oacute;n:</P></TD>
                <TD COLSPAN="3"><INPUT class="campo" TYPE="TEXT" NAME="dirc_insti" SIZE="70" MAXLENGTH="200" VALUE="<? echo $dirc_insti; ?>"></TD>
                </TR>

                <TR>
                <TD><P ALIGN="RIGHT" class="mini">Tipo de Instituci&oacute;n:</P></TD>
                <TD><SELECT class="campo" NAME="codg_tip_insti">
                <OPTION value="0">Seleccione...</OPTION>
                 <? $tipos = mysql_query("SELECT codg_tip_insti, desc_tip_insti FROM bdc_tip_insti ORDER BY 2");
                if (mysql_num_rows($tipos) != 0)
                {
                       while ($tipo = mysql_fetch_array($tipos))
                  {
                   echo '<OPTION VALUE="'.$tipo["codg_tip_insti"];
                                       echo '"';
                                       if ($codg_tip_insti == $tipo["codg_tip_insti"])
                                       {
                                          echo 'SELECTED';
                                       }
                                       echo '>'.$tipo["desc_tip_insti"];
                                       echo '</OPTION>';
                  }
                }
                ?>
                </SELECT></TD>
                </TR>

                <TR>
                <TD><P ALIGN="RIGHT" class="mini">Tel&eacute;fono:</P></TD>
                <TD><P ALIGN="LEFT" class="campo">(<INPUT class="campo" TYPE="TEXT" NAME="codg_tel" MAXLENGTH="4" SIZE="2" VALUE="<? echo $codg_tel; ?>">)<INPUT class="campo" TYPE="TEXT" NAME="tel" MAXLENGTH="7" SIZE="5" VALUE="<? echo $tel; ?>"></P></TD>
                <TD><P ALIGN="RIGHT" class="mini">Fax:</P></TD>
                <TD><P ALIGN="LEFT" class="campo">(<INPUT class="campo" TYPE="TEXT" NAME="codg_fax" MAXLENGTH="4" SIZE="2" VALUE="<? echo $codg_fax; ?>">)<INPUT class="campo" TYPE="TEXT" NAME="fax" MAXLENGTH="7" SIZE="5" VALUE="<? echo $fax; ?>"></P></TD>
                </TR>

                <TR>
                <TD COLSPAN="4">
                <DIV ALIGN="CENTER"><P class="cabecera">Organigrama</P></DIV>
                </TD>
                </TR>

                <TR>
                <TD><P ALIGN="RIGHT" class="mini">Ubicaci&oacute;n:</P></TD>
                <TD COLSPAN="6"><INPUT class="campo" TYPE="FILE" name="org_insti" SIZE="50"></TD>
                </TR>

                <TR>
                <TD><P ALIGN="RIGHT" class="mini">¿Posee Organigrama?</P></TD>
                <TD><P ALIGN="LEFT" class="campo"><? if($org_insti != ""){echo "Si"; }else {echo "No";}?></P></TD>
                </TR>

                <TR>
                <TD COLSPAN="4"><HR></TD>
                </TR>

        </TABLE>



<CENTER><INPUT class="mini" TYPE="SUBMIT"  NAME="agregar" VALUE="Actualizar" onClick="actualizar()">&nbsp;<INPUT class="mini" TYPE="BUTTON" VALUE="Finalizar" onClick="finalizar()"></CENTER>

<INPUT TYPE="hidden" NAME="codg_insti" VALUE="<? echo $codg_insti; ?>">
<INPUT TYPE="hidden" NAME="telf_insti" VALUE="<? echo $telf_insti; ?>">
<INPUT TYPE="hidden" NAME="fax_insti" VALUE="<? echo $fax_insti; ?>">
<INPUT TYPE="hidden" NAME="pasada" VALUE="1">
<INPUT TYPE="HIDDEN" NAME="action" VALUE="">

</FORM>
<?

if ($action == "ins")
  {
  
   			if ( $org_insti != "" )
                    {
                       $tamanio = $_FILES["org_insti"]["size"];
                       $tip_arc_insti = $_FILES['org_insti']['type'];

                       $fp = fopen($org_insti, "rb");
                       $contenido = fread($fp, $tamanio);
                       $contenido = addslashes($contenido);
                       fclose($fp);
                    }
  $telf_insti = $codg_tel.$tel;
  $fax_insti = $codg_fax.$fax;

  if ($codg_mun == "0") {($codg_mun = "NULL");}
  if ($codg_parr == "0") {($codg_parr = "NULL");}
  if ($dirc_insti == "") {($dirc_insti = "NULL");} else {($dirc_insti = "'$dirc_insti'");}
  if ($telf_insti == "") {($telf_insti = "NULL");} else {($telf_insti = "'$telf_insti'");}
  if ($fax_insti == "") {($fax_insti = "NULL");} else {($fax_insti = "'$fax_insti'");}
  if ($codg_tip_insti == "0") {($codg_tip_insti = "NULL");}
  if ($org_insti == "") {($contenido = "NULL");} else {($contenido = "'$contenido'");}
  if (!isset ($tip_arc_insti)) {($tip_arc_insti = "NULL");} else {($tip_arc_insti = "'$tip_arc_insti'");}


       $qry = ("UPDATE bdc_instituciones SET nomb_insti='$nomb_insti', codg_mun=$codg_mun, codg_parr=$codg_parr, dirc_insti=$dirc_insti, telf_insti=$telf_insti,fax_insti=$fax_insti, codg_tip_insti=$codg_tip_insti, org_insti=$contenido, tip_arc_insti=$tip_arc_insti WHERE codg_insti=$codg_insti");
	   
        mysql_query($qry);

       echo '<SCRIPT>alert("Datos Actualizados");</SCRIPT>';
  }
?>

<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">

  var frmvalidator  = new Validator("datos");

  frmvalidator.addValidation("nomb_insti","req","Ingrese el Nombre de la Institución");
  frmvalidator.addValidation("nomb_insti","alphanum");

  frmvalidator.addValidation("codg_tip_insti","dontselect=0","Seleccione el Tipo de Institución");

  <? if (($codg_tel != "") or ($tel != ""))
  {
     echo 'frmvalidator.addValidation("codg_tel","num");';
     echo 'frmvalidator.addValidation("codg_tel","minlen=4","El Mínimo de Caracteres para el Código de Area del Teléfono es 4");';
     echo 'frmvalidator.addValidation("tel","num");';
     echo 'frmvalidator.addValidation("tel","minlen=7","El Mínimo de Caracteres para el Número de Teléfono es 7");';
  }
  ?>

   <? if (($codg_fax != "") or ($fax != ""))
  {
   echo 'frmvalidator.addValidation("codg_fax","num");';
   echo 'frmvalidator.addValidation("codg_fax","minlen=4","El Mínimo de Caracteres para el Código de Area del Fax es 4");';
   echo 'frmvalidator.addValidation("fax","num");';
   echo 'frmvalidator.addValidation("fax","minlen=7","El Mínimo de Caracteres para el Número del Fax es 7");';
  }
  ?>



</SCRIPT>

</BODY>
</HTML>

