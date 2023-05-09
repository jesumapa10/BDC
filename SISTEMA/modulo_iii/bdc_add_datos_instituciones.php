<?
  include ("../sesion.php");

  include ("../conex.php");
?>
<HTML>
<HEAD>
        <LINK REL="STYLESHEET" HREF="../style/normal.css" TYPE="text/css">

        <SCRIPT LANGUAGE="JavaScript" SRC="../scripts/validar.js" TYPE="text/javascript"></SCRIPT>

<?
  include ("tabs/tabs_insti_add.php");
?>

<SCRIPT>
function municipio()
{
        if (document.datos.codg_mun.selectedIndex == 100) {
        datos.codg_mun.value="$codg_mun";
        }
        datos.codg_parr.value="0";
        datos.submit();
}

function ingresar()
{
        datos.action.value="ins";

}
</SCRIPT>

</HEAD>

<BODY>

<BR><BR>
<H2>Agregar Instituci&oacute;n</H2>

<SCRIPT>do_tabs("Datos Institucion", "")</SCRIPT>

<BR>
<FORM METHOD="POST" NAME="datos" ACTION="bdc_add_datos_instituciones.php">

        <TABLE BORDER="0" ALIGN="CENTER">
                <TR>
                <TD COLSPAN="4">
                <DIV ALIGN="CENTER"><P class="cabecera">Datos Generales</P></DIV>
                </TD>
                </TR>

                <TR>
                <TD WIDTH="150"><P ALIGN="RIGHT" class="mini">Nombre de la Instituci&oacute;n:</P></TD>
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
                <OPTION VALUE="0">Seleccione...</OPTION>
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
                <OPTION VALUE="0">Seleccione...</OPTION>
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
                <TD COLSPAN="4"><HR></TD>
                </TR>

        </TABLE>

<CENTER><INPUT class="mini" TYPE="SUBMIT"  NAME="agregar" VALUE="Agregar" onClick="ingresar();"></CENTER>

<INPUT TYPE="HIDDEN" NAME="action" VALUE="">

</FORM>

<?
if ($action == "ins")
  {

          if ($codg_parr == "0") {($parroquia = " IS NULL");} else {($parroquia = "$codg_parr");}
          $verificar = mysql_query ("SELECT * FROM bdc_instituciones WHERE nomb_insti='$nomb_insti' and
                                     codg_pais=58 and codg_est=274 and codg_mun=$codg_mun and codg_parr=$codg_parr and
                                     codg_tip_insti=$codg_tip_insti");

          if (mysql_num_rows($verificar) != 0)
            {
                    echo "<SCRIPT>alert('La Institución ya Existe');</SCRIPT>";
            }

          else if (mysql_num_rows($verificar) == 0)
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

                    $tel_insti = "$codg_tel$tel";
                    $fax_insti = "$codg_fax$fax";

                    if ($codg_mun == "0") {($codg_mun = "NULL");}
                    if ($codg_parr == "0") {($codg_parr = "NULL");}
                    if ($dirc_insti == "") {($dirc_insti = "NULL");} else {($dirc_insti = "'$dirc_insti'");}
                    if ($telf_insti == "") {($telf_insti = "NULL");} else {($telf_insti = "'$telf_insti'");}
                    if ($fax_insti == "") {($fax_insti = "NULL");} else {($fax_insti = "'$fax_insti'");}
                    if ($org_insti == "") {($contenido = "NULL");} else {($contenido = "'$contenido'");}
                    if (!isset ($tip_arc_insti)) {($tip_arc_insti = "NULL");} else {($tip_arc_insti = "'$tip_arc_insti'");}

                    $qry = mysql_query ("INSERT INTO bdc_instituciones values (0, '$nomb_insti', 58, 274, $codg_mun,
                                         $codg_parr, $dirc_insti, $telf_insti, $fax_insti, $codg_tip_insti, $contenido, $tip_arc_insti)");

                    $codg_insti = mysql_insert_id();

                    echo "<SCRIPT>alert('Datos Agregados');</SCRIPT>";
                    echo '<SCRIPT>datos.action.value="";</SCRIPT>';

                    if ($codg_tip_insti == 1)
                      {
                              echo '<SCRIPT>location = "bdc_add_datos_plantel.php?codg_insti='.$codg_insti.'";</SCRIPT>';
                      }

                    else if ($codg_tip_insti != 1)
                      {
                              echo '<SCRIPT>location = "bdc_add_estructura.php?codg_insti='.$codg_insti.'";</SCRIPT>';
                      }

            }
  }
?>

<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">

  var frmvalidator  = new Validator("datos");

  frmvalidator.addValidation("nomb_insti","req","Ingrese el Nombre de la Institución");
  frmvalidator.addValidation("nomb_insti","alphanum");

  frmvalidator.addValidation("codg_tip_insti","dontselect=0","Seleccione el Tipo de Institución");

</SCRIPT>

</BODY>
</HTML>

