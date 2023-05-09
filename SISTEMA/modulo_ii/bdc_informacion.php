<?
  include ("../sesion.php");

  include ("../conex.php");
?>

<HTML>
<HEAD>
        <LINK REL="STYLESHEET" HREF="../style/normal.css" TYPE="text/css">

</HEAD>
<TITLE>Breve Informaci&oacute;n</TITLE>

<SCRIPT>
function cerrar()

{
         window.close()
}

</SCRIPT>

</HEAD>
<BR>

<?

$consulta_tipo_insti = mysql_query("SELECT codg_tipo_insti FROM bdc_instituciones WHERE codg_insti=$codg_insti");
$codg_tipo_insti = mysql_fetch_array($consulta_tipo_insti);
$codg_tipo_insti = $codg_tipo_insti["codg_tipo_insti"];
if ($codg_tipo_insti == 1)
 {

  echo '<H2>Breve Ficha del Plantel</H2>

        <TABLE BORDER="0" ALIGN="CENTER">
                <TR>
                <TD WIDTH="505"><DIV ALIGN="CENTER"><P class="cabecera">Datos del Plantel</P></DIV></TD>
                </TR>
        </TABLE>';

        $consulta_institucion = mysql_query("SELECT nomb_insti, dirc_insti, telf_insti, fax_insti
                         FROM bdc_instituciones
                         WHERE codg_insti=$codg_insti");
        $datos_institucion = mysql_fetch_array($consulta_institucion);
        $nomb_insti = $datos_institucion["nomb_insti"];
        $dirc_insti = $datos_institucion["dirc_insti"];
        $telf_insti = $datos_institucion["telf_insti"];
        $fax_insti = $datos_institucion["fax_insti"];

        echo' <TABLE BORDER="0" ALIGN="CENTER">
                <TR>
                <TD WIDTH="115"><P ALIGN="RIGHT" class="mini">Plantel:</P></TD>
                <TD COLSPAN="3"><P ALIGN="LEFT" class="campo">'$nomb_insti; echo'</TD>
                </TR>

                <TR>
                <TD><P ALIGN="RIGHT" class="mini">Municipio:</P></TD>';
                <?MISQL SQL="select m.nomb_mun
                                 from bdc_municipios m, bdc_instituciones i
                                 where i.codg_insti=$codg_insti and
                                 i.codg_pais=m.codg_pais and i.codg_est=m.codg_est and i.codg_mun=m.codg_mun">
                <TD WIDTH="150"><P ALIGN="LEFT" class="campo">$1</TD>
                <?/MISQL>
                <TD WIDTH="100"><P ALIGN="RIGHT" class="mini">Parroquia:</TD>
                <?MISQL SQL="select p.nomb_parr
                                 from bdc_parroquias p, bdc_instituciones i
                                 where i.codg_insti=$codg_insti and
                                 i.codg_pais=p.codg_pais and i.codg_est=p.codg_est and i.codg_mun=p.codg_mun and i.codg_parr=p.codg_parr">
                <TD WIDTH="120"><P ALIGN="LEFT" class="campo">$1</TD>
                <?/MISQL>
                </TR>

                <TR>
                <TD><P ALIGN="RIGHT" class="mini">Direcci&oacute;n:</P></TD>
                <TD COLSPAN="3"><P ALIGN="LEFT" class="campo">$2</TD>
                </TR>

                <TR>
                <TD><P ALIGN="RIGHT" class="mini">C&eacute;dula del Director:</P></TD>
                <?MISQL SQL="select codg_dic_plantel from bdc_plantel where codg_insti=$codg_insti">
                <TD COLSPAN="3"><P ALIGN="LEFT" class="campo">$1</TD>
                <?/MISQL>
                </TR>

                <TR>
                <TD><P ALIGN="RIGHT" class="mini">Nombre del Director:</P></TD>
                <?MISQL SQL="select d.apel_per, d.nomb_per
                                 from bdc_datos_per d, bdc_plantel p
                                 where p.codg_insti=$codg_insti and p.codg_dic_plantel=d.codg_per">
                                <?MIVAR NAME=nombre>$2<?/MIVAR>
                                <?MIVAR NAME=apellido>$1<?/MIVAR>
                <?/MISQL>
                <?MIBLOCK COND="$(NE,$MI_ROWCOUNT,0)">
                <TD COLSPAN="3"><P ALIGN="LEFT" class="campo"><?MIVAR>$nombre&nbsp;$apellido<?/MIVAR></TD>
                <?/MIBLOCK>
                <?MIBLOCK COND="$(EQ,$MI_ROWCOUNT,0)">
                <?MISQL SQL="select nomb_dic_plantel from bdc_plantel where codg_insti=$codg_insti">
                <TD COLSPAN="3"><P ALIGN="LEFT" class="campo">$1</TD>
                <?/MISQL>
                <?/MIBLOCK>

                </TR>

                <TR>
                <TD><P ALIGN="RIGHT" class="mini">Tel&eacute;fono:</P></TD>
                <TD><P ALIGN="LEFT" class="campo"><?MIBLOCK COND="$(NE,$3,NULL)"><?MIVAR>($(SUBSTR,$3,1,4))&nbsp;$(SUBSTR,$3,5,7)<?/MIVAR><?/MIBLOCK></TD>
                <TD><P ALIGN="RIGHT" class="mini">Fax:</TD>
                <TD><P ALIGN="LEFT" class="campo"><?MIBLOCK COND="$(NE,$4,NULL)"><?MIVAR>($(SUBSTR,$4,1,4))&nbsp;$(SUBSTR,$4,5,7)<?/MIVAR><?/MIBLOCK></TD>
                </TR>

                <TR>
                <TD><P ALIGN="RIGHT" class="mini">Tipo de Plantel:</P></TD>
                <?MISQL SQL="select t.desc_tip_plantel
                                 from bdc_tip_plantel t, bdc_plantel i
                                 where i.codg_insti=$codg_insti and i.codg_tip_plantel=t.codg_tip_plantel">
                <TD><P ALIGN="LEFT" class="campo">$1</TD>
                <?/MISQL>
                <TD><P ALIGN="RIGHT" class="mini">Modalidad de Plantel:</TD>
                <?MISQL SQL="select m.desc_mod_plantel
                                 from bdc_mod_plantel m, bdc_plantel i
                                 where i.codg_insti=$codg_insti and i.codg_mod_plantel=m.codg_mod_plantel">
                <TD><P ALIGN="LEFT" class="campo">$1</TD>
                <?/MISQL>
                </TR>

                </TABLE>

<CENTER><INPUT TYPE="BUTTON" class="mini" VALUE="Cerrar Ventana" onClick="cerrar()"></CENTER>

        <?/MISQL>
<?/MIBLOCK>

<?MIBLOCK COND="$(NE,$tipo,1)">
<H2>Breve Ficha del Instituto</H2>

        <TABLE BORDER="0" ALIGN="CENTER">
                <TR>
                <TD WIDTH="505"><DIV ALIGN="CENTER"><P class="cabecera">Datos del Instituto</P></DIV></TD>
                </TR>
        </TABLE>

        <?MISQL SQL="select nomb_insti, dirc_insti, telf_insti, fax_insti
                         from bdc_instituciones
                         where codg_insti=$codg_insti">

                <TABLE BORDER="0" ALIGN="CENTER">
                <TR>
                <TD WIDTH="50"><P ALIGN="RIGHT" class="mini">Instituto:</P></TD>
                <TD COLSPAN="3"><P ALIGN="LEFT" class="campo">$1</TD>
                </TR>

                <TR>
                <TD><P ALIGN="RIGHT" class="mini">Municipio:</P></TD>
                <?MISQL SQL="select m.nomb_mun
                                 from bdc_municipios m, bdc_instituciones i
                                 where i.codg_insti=$codg_insti and
                                 i.codg_pais=m.codg_pais and i.codg_est=m.codg_est and i.codg_mun=m.codg_mun">
                <TD WIDTH="150"><P ALIGN="LEFT" class="campo">$1</TD>
                <?/MISQL>
                <TD WIDTH="100"><P ALIGN="RIGHT" class="mini">Parroquia:</TD>
                <?MISQL SQL="select p.nomb_parr
                                 from bdc_parroquias p, bdc_instituciones i
                                 where i.codg_insti=$codg_insti and
                                 i.codg_pais=p.codg_pais and i.codg_est=p.codg_est and i.codg_mun=p.codg_mun and i.codg_parr=p.codg_parr">
                <TD WIDTH="120"><P ALIGN="LEFT" class="campo">$1</TD>
                <?/MISQL>
                </TR>

                <TR>
                <TD><P ALIGN="RIGHT" class="mini">Direcci&oacute;n:</P></TD>
                <TD COLSPAN="3"><P ALIGN="LEFT" class="campo">$2</TD>
                </TR>

                </TABLE>

<CENTER><INPUT TYPE="BUTTON" class="mini" VALUE="Cerrar Ventana" onClick="cerrar()"></CENTER>

        <?/MISQL>
<?/MIBLOCK>

</HTML>
