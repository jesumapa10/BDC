<?
  include ("../sesion.php");

  include ("../conex.php");
?>
<HTML>
<HEAD>
        <LINK REL="STYLESHEET" HREF="../style/normal.css" TYPE="text/css">

        <SCRIPT LANGUAGE="JavaScript" SRC="../scripts/validar.js" TYPE="text/javascript"></SCRIPT>

<?
  include ("tabs/tabs_insti_add_p.php");
?>

<SCRIPT>
function buscar_director()
{
        if (document.datos.codg_dic_plantel.selectedIndex == 100) {
        datos.codg_dic_plantel.value="$codg_dic_plantel";
        }
        datos.action.value="bus";
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

}
</SCRIPT>

</HEAD>

<?
  $consulta = mysql_query("SELECT i.nomb_insti, i.codg_tip_insti, t.desc_tip_insti
                          FROM bdc_instituciones i, bdc_tip_insti t
                          WHERE i.codg_insti=$codg_insti and i.codg_tip_insti=t.codg_tip_insti");

  $datos = mysql_fetch_array($consulta);

            $nomb_insti = $datos["nomb_insti"];
            $codg_tip_insti = $datos["codg_tip_insti"];
            $tipo = $datos["desc_tip_insti"];

  $datos_municipio = mysql_query("SELECT e.nomb_mun
                                  FROM bdc_instituciones p, bdc_municipios e
                                  WHERE p.codg_insti=$codg_insti and p.codg_pais=e.codg_pais and p.codg_est=e.codg_est and p.codg_mun=e.codg_mun");

  $cons_municipio = mysql_fetch_array($datos_municipio);

            $municipio = $cons_municipio["nomb_mun"];
?>

<BODY>

<BR><BR>
<H2>Agregar Instituci&oacute;n</H2>

<TABLE ALIGN="CENTER">
<TR>
<TD>
<P ALIGN="CENTER" class="mini">Instituci&oacute;n:</P>
</TD>

<TD>
<P ALIGN="CENTER" class="campo"><? echo $nomb_insti; ?>&nbsp;&nbsp;&nbsp;&nbsp;</P>
</TD>
<?
if ($municipio != "")
  {
    echo '<TD>';
    echo '<P ALIGN="CENTER" class="mini">Municipio:</P>';
    echo '</TD>';

    echo '<TD>';
    echo '<P ALIGN="CENTER" class="campo">'.$municipio.'&nbsp;&nbsp;&nbsp;&nbsp;</P>';
    echo '</TD>';
  }
?>
<TD>
<P ALIGN="CENTER" class="mini">Tipo de Instituci&oacute;n:</P>
</TD>

<TD>
<P ALIGN="CENTER" class="campo"><? echo $tipo; ?></P>
</TD>
</TR>
</TABLE>

<BR>

<SCRIPT>do_tabs("Datos Plantel", "")</SCRIPT>

<?
if ($action == "bus")
  {
          $director = mysql_query("SELECT nomb_per, apel_per FROM bdc_datos_per WHERE codg_per=$codg_dic_plantel");

          if ($director == 0)
            {
                    echo "<SCRIPT>alert('Director No Encontrado');</SCRIPT>";
            }

          else if ($director != 0)
            {
                    $datos_dir = (mysql_fetch_array($director));
                    $nombre = $datos_dir["nomb_per"];
                    $apellido = $datos_dir["apel_per"];
                    echo "<SCRIPT>alert('Director Encontrado');</SCRIPT>";
            }
  }

if ($action == "ins")
  {
          if ($codg_ner_plantel == "") {($codg_ner_plantel = "NULL");}
          if ($codg_dic_plantel == "") {($codg_dic_plantel = "NULL");}
          if ($nomb_dic_plantel == "") {($nomb_dic_plantel = "NULL");} else {($nomb_dic_plantel = "'$nomb_dic_plantel'");}
          if ($ner_ppal_plantel == "") {($ner_ppal_plantel = "NULL");} else {($ner_ppal_plantel = "'$ner_ppal_plantel'");}

          mysql_query ("INSERT INTO bdc_plantel VALUES ($codg_insti, $codg_plantel, $codg_ner_plantel, $codg_dic_plantel,
                        $nomb_dic_plantel, $codg_tip_plantel, $codg_mod_plantel, $ner_ppal_plantel)");

          echo "<SCRIPT>alert('Datos Agregados');</SCRIPT>";
  }

  $verificar_datos = mysql_query("SELECT * FROM bdc_plantel WHERE codg_insti=$codg_insti");

  if (mysql_num_rows($verificar_datos) == 0)
    {
            $boton = "ENABLED";
    }

  else if (mysql_num_rows($verificar_datos) != 0)
    {
            $boton = "DISABLED";

            $data = mysql_fetch_array($verificar_datos);
            $codg_plantel = $data['1'];
            $codg_dic_plantel = $data['2'];
            $nomb_dic_plantel = $data['3'];
            $codg_tip_plantel = $data['4'];
            $codg_mod_plantel = $data['5'];
            $codg_ner_plantel = $data['6'];
            $ner_ppal_plantel = $data['7'];
    }

?>

<BR>
<FORM METHOD="POST" NAME="datos" action="bdc_add_datos_plantel.php">

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
                <INPUT class="campo" TYPE="TEXT" NAME="codg_dic_plantel" SIZE="10" MAXLENGTH="9" VALUE="<? if ($codg_dic_plantel != 'NULL') {echo $codg_dic_plantel;} ?>">&nbsp;
                <INPUT class="mini" TYPE="BUTTON" NAME="buscar" VALUE="Buscar" onClick="buscar_director()">
                </TD>
                </TR>

                <TR>
                <TD><P ALIGN="RIGHT" class="mini">Nombre del Director:</P></TD>
                <TD><INPUT class="campo" TYPE="TEXT" NAME="nomb_dic_plantel" SIZE="40" MAXLENGTH="80" VALUE="<? if ($nomb_dic_plantel != 'NULL') {echo $nomb_dic_plantel;} ?>"></TD>
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

<CENTER><INPUT class="mini" TYPE="SUBMIT"  NAME="agregar" VALUE="Agregar" <? echo $boton; ?> onClick="ingresar();">&nbsp;<INPUT class="mini" TYPE="BUTTON" VALUE="Finalizar" onClick="finalizar()"></CENTER>

<INPUT TYPE="HIDDEN" NAME="codg_insti" VALUE="<? echo $codg_insti; ?>">
<INPUT TYPE="HIDDEN" NAME="action" VALUE="">

</FORM>

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

