<?
  include ("../sesion.php");

  include ("../conex.php");
?>

<HTML>
<HEAD>
         <LINK REL="STYLESHEET" HREF="../style/normal.css" TYPE="text/css">

<?
  include ("tabs/tabs_per.php");
?>

</HEAD>


<?
$consulta = mysql_query("SELECT d.apel_per, d.nomb_per, d.naci_per, t.desc_tip_trab
                 FROM bdc_datos_per d, bdc_tip_trab t
                 WHERE d.codg_per=$codg_per AND d.codg_tip_trab=t.codg_tip_trab");

$datos = mysql_fetch_array($consulta);

$apel_per = $datos["apel_per"];
$nomb_per = $datos["nomb_per"];
$naci_per = $datos["naci_per"];
$desc_tip_trab = $datos["desc_tip_trab"];

?>
<BR><BR>
<H2>Ficha del Personal</H2>

<TABLE ALIGN="CENTER">
<TR>
<TD>
<P ALIGN="CENTER" class="mini">Nombre(s) y Apellido(s):</P>
</TD>

<TD>
<P ALIGN="CENTER" class="campo"><? echo $nomb_per; ?>&nbsp;<? echo $apel_per; ?>&nbsp;&nbsp;&nbsp;&nbsp;</P>
</TD>

<TD>
<P ALIGN="CENTER" class="mini">C&eacute;dula:</P>
</TD>

<TD>
<P ALIGN="CENTER" class="campo"><? if ($naci_per == "V") {echo 'V - ';} else {echo 'E - ';} echo number_format($codg_per ,0 , "," ,"."); ?>&nbsp;&nbsp;&nbsp;&nbsp;</P>
</TD>

<TD>
<P ALIGN="CENTER" class="mini">Tipo de Trabajador:</P>
</TD>

<TD>
<P ALIGN="CENTER" class="campo"><? echo $desc_tip_trab; ?></P>
</TD>
</TR>
</TABLE>

<BR>

<SCRIPT>do_tabs("Traslados", "")</SCRIPT>

<BR>

        <TABLE BORDER="0" ALIGN="CENTER">
                <TR>
                <TD WIDTH="725"><DIV ALIGN="CENTER"><P class="cabecera">Traslados</P></DIV></TD>
                </TR>
        </TABLE>

        <TABLE BORDER="0" ALIGN="CENTER">
         <?
             $consulta_traslados_desde = mysql_query("SELECT t.codg_plantel_desde, t.codg_plantel_hacia, t.fec_ing, t.fec_egr, i.nomb_insti, t.codg_cat_cargo, t.codg_jer_cargo, t.codg_cargo
                                                     FROM bdc_traslado t, bdc_instituciones i WHERE t.codg_per=$codg_per AND i.codg_insti=t.codg_plantel_desde");

             $consulta_traslados_hacia = mysql_query("SELECT t.codg_plantel_desde, t.codg_plantel_hacia, t.fec_ing, t.fec_egr, i.nomb_insti, t.codg_cat_cargo, t.codg_jer_cargo, t.codg_cargo
                                                     FROM bdc_traslado t, bdc_instituciones i WHERE t.codg_per=$codg_per AND i.codg_insti=t.codg_plantel_hacia");

            // $consulta_datos_traslados = mysql_query("SELECT t.fec_ing, t.fec_egr, i.nomb_insti,
            //        t.codg_cat_cargo, t.codg_jer_cargo, t.codg_insti_desde, t.codg_cargo, t.codg_insti_hacia
            //        FROM bdc_traslados t, bdc_instituciones i
            //        WHERE t.codg_per=$codg_per AND t.codg_insti_desde=i.codg_insti ORDER BY 1");

            if ((mysql_num_rows($consulta_traslados_desde) != 0) || (mysql_num_rows($consulta_traslados_hacia) != 0))
             {
                 while (($traslados1 = mysql_fetch_array($consulta_traslados_desde)) && ($traslados2 = mysql_fetch_array($consulta_traslados_hacia)))
                     {
                      $codg_plantel_desde1 = $traslados1["codg_plantel_desde"];
                      $codg_plantel_hacia1 = $traslados1["codg_plantel_hacia"];
                      $fec_ing = $traslados1["fec_ing"];
                      $fec_egr = $traslados1["fec_egr"];
                      $codg_cat_cargo1 = $traslados1["codg_cat_cargo"];
                      $codg_jer_cargo1 = $traslados1["codg_jer_cargo"];
                      $codg_cargo1 = $traslados1["codg_cargo"];

                      
                       echo '<TR>';
                      echo '<TD><P ALIGN="RIGHT" class="mini">Municipio:</P></TD>';
                      echo '<TD WIDTH="150">';

                      $consulta_municipio1 = mysql_query("SELECT m.nomb_mun FROM bdc_municipios m, bdc_instituciones i, bdc_traslado t
                                 WHERE t.codg_per=$codg_per AND t.codg_plantel_desde=i.codg_insti AND t.codg_plantel_hacia=$codg_plantel_hacia1 AND
                                 i.codg_pais=m.codg_pais AND i.codg_est=m.codg_est AND i.codg_mun=m.codg_mun");

                      $municipio1 = mysql_fetch_array($consulta_municipio1);

                     echo '<P ALIGN="LEFT" class="campo">'.$municipio1['nomb_mun']; echo'</P>';
                     echo '</TD>
                           <TD WIDTH="150"><P ALIGN="RIGHT" class="mini">Parroquia:</P></TD>
                           <TD>';

                     $consulta_parroquia1 = mysql_query("SELECT p.nomb_parr FROM bdc_parroquias p, bdc_instituciones i, bdc_traslado t
                                 WHERE t.codg_per=$codg_per AND t.codg_plantel_desde=i.codg_insti AND t.codg_plantel_hacia=$codg_plantel_hacia1 AND
                                 i.codg_pais=p.codg_pais AND i.codg_est=p.codg_est AND i.codg_mun=p.codg_mun and i.codg_parr=p.codg_parr");

                     $parroquia1 = mysql_fetch_array($consulta_parroquia1);

                     echo '<P ALIGN="LEFT" class="campo">'.$parroquia1['nomb_parr']; echo'</P>';
                     echo '</TD>';
                     echo '</TR>';

                      echo '<TR>';
                      echo '<TD WIDTH="150"><P ALIGN="RIGHT" class="mini">Plantel de Origen:</P></TD>';
                      echo '<TD COLSPAN="3"><P ALIGN="LEFT" class="campo">'.$traslados1['nomb_insti'];echo'</P></TD>';
                      echo '</TR>';

                     echo '<TR>';
                     echo '<TD><P ALIGN="RIGHT" class="mini">Fecha de Egreso del <BR>Plantel de Origen:</P></TD>';
                     $fec_egr = substr($fec_egr,8,2)."-".substr($fec_egr,5,2)."-".substr($fec_egr,0,4);
                     echo '<TD><P ALIGN="LEFT" class="campo">'.$fec_egr; echo'</P></TD>';
                     echo '</TR>';



                     //echo '<TR>';
                     //echo '<TD COLSPAN="1"><P ALIGN="RIGHT" class="mini">A&ntilde;os de Servicio en el Plantel:</P></TD>';
                     //      $tiempo_transcurrido = substr($fec_ing,0,4) - substr($fec_egr,0,4);
                     //        if ((substr($fec_ing,0,4)) > (substr($fec_egr,5,2)))
                    //         {
                    //            echo $tiempo_transcurrido; echo '&nbsp;'; echo 'Años';
                    //         }
                    //         else
                    //         {
                    //          if ((substr($fec_ing,0,4)) < (substr($fec_egr,5,2)))
                    //         {
                    //           echo $tiempo_transcurrido -1; echo '&nbsp;'; echo 'Años';
                    //         }
                    //         }
                    //          if ((substr($fec_ing,0,4)) == (substr($fec_egr,5,2)))
                    //          {
                    //               echo $tiempo_transcurrido; echo '&nbsp;'; echo 'Años';
                    //          }
                     echo ' </P></TD>';
                     echo '<TD></TD>';
                     echo '<TD></TD>';
                     echo '</TR>';


                      $codg_plantel_desde2 = $traslados2["codg_plantel_desde"];
                      $codg_plantel_hacia2 = $traslados2["codg_plantel_hacia"];
                      $codg_cat_cargo2 = $traslados2["codg_cat_cargo"];
                      $codg_jer_cargo2 = $traslados2["codg_jer_cargo"];
                      $codg_cargo2 = $traslados2["codg_cargo"];


                      echo '<TR>';
                      echo '<TD WIDTH="150"><P ALIGN="RIGHT" class="mini">Plantel de Destino:</P></TD>';
                      echo '<TD COLSPAN="3"><P ALIGN="LEFT" class="campo">'.$traslados2['nomb_insti'];echo'</P></TD>';
                      echo '</TR>';

                      echo '<TR>';
                      echo '<TD><P ALIGN="RIGHT" class="mini">Municipio:</P></TD>';
                      echo '<TD WIDTH="150">';

                $consulta_municipio2 = mysql_query("SELECT m.nomb_mun FROM bdc_municipios m, bdc_instituciones i, bdc_traslado t
                                 WHERE t.codg_per=$codg_per AND t.codg_plantel_hacia=i.codg_insti AND t.codg_plantel_desde=$codg_plantel_desde2 AND
                                 i.codg_pais=m.codg_pais AND i.codg_est=m.codg_est AND i.codg_mun=m.codg_mun");

                $municipio2 = mysql_fetch_array($consulta_municipio2);

                     echo '<P ALIGN="LEFT" class="campo">'.$municipio2['nomb_mun']; echo'</P>';
                     echo '</TD>
                           <TD WIDTH="150"><P ALIGN="RIGHT" class="mini">Parroquia:</P></TD>
                           <TD>';

                $consulta_parroquia2 = mysql_query("SELECT p.nomb_parr FROM bdc_parroquias p, bdc_instituciones i, bdc_traslado t
                                 WHERE t.codg_per=$codg_per AND t.codg_plantel_hacia=$codg_plantel_hacia2 AND t.codg_plantel_desde=i.codg_insti AND
                                 i.codg_pais=p.codg_pais AND i.codg_est=p.codg_est AND i.codg_mun=p.codg_mun and i.codg_parr=p.codg_parr");

                $parroquia2 = mysql_fetch_array($consulta_parroquia2);

                     echo '<P ALIGN="LEFT" class="campo">'.$parroquia2['nomb_parr']; echo'</P>';
                     echo '</TD>';
                     echo '</TR>';

                     echo '<TR>';
                     echo '<TD><P ALIGN="RIGHT" class="mini">Categor&iacute;a del Cargo <BR>al Plantel de Destino:</P></TD>';
                $consulta_categoria1 = mysql_query("SELECT desc_cat_cargo FROM bdc_cat_cargo WHERE codg_cat_cargo=$codg_cat_cargo1");
                $categoria1 = mysql_fetch_array($consulta_categoria1);
                     echo '<TD><P ALIGN="LEFT" class="campo">'.$categoria1['des_cat_cargo'];echo'</P></TD>';

                     echo '<TD><P ALIGN="RIGHT" class="mini">Jerarqu&iacute;a del Cargo <BR>al Plantel de Destino:</P></TD>';
                $consulta_jerarquia1 = mysql_query("SELECT desc_jer_cargo FROM bdc_jer_cargo WHERE codg_cat_cargo=$codg_cat_cargo1 AND codg_jer_cargo=$codg_jer_cargo1");
                $jerarquia1 = mysql_fetch_array($consulta_jerarquia1);

                     echo '<TD><P ALIGN="LEFT" class="campo">'.$jerarquia1['desc_jer_cargo'];echo'</P></TD>';


                     echo '<TD><P ALIGN="RIGHT" class="mini">Jerarqu&iacute;a en el <BR>Plantel de Destino:</P></TD>';
                $consulta_cargo1 = mysql_query("SELECT desc_jer_plantel FROM bdc_jer_plantel WHERE codg_jer_plantel='$codg_cargo1'");
                $cargo1 = mysql_fetch_array($consulta_cargo1);

                     echo '<TD COLSPAN="3"><P ALIGN="LEFT" class="campo">'.$cargo1['desc_jer_plantel'];echo'</P></TD>';

                     echo '</TR>';

                     echo '<TR>';
                     echo '<TD><P ALIGN="RIGHT" class="mini">Fecha de Ingreso <BR>al Plantel de Destino:</P></TD>';
                     $fec_ing = substr($fec_ing,8,2)."-".substr($fec_ing,5,2)."-".substr($fec_ing,0,4);
                     echo '<TD><P ALIGN="LEFT" class="campo">'.$fec_ing; echo'</P></TD>';
                     echo '</TR>';

                     echo '<TR>';
                     echo '<TD COLSPAN="6"><HR></TD>';
                     echo '</TR>';
                 }
              }
                else
                 {
                    echo '<CENTER><P><B class="rojo">No Posee Registros</B></CENTER>';
                 }

      ?>
        </TABLE>

</HTML>
