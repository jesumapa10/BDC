<?
  include ("../sesion.php");

  include ("../conex.php");
?>

<HTML>
<HEAD>
         <LINK REL="STYLESHEET" HREF="../style/normal.css" TYPE="text/css">

<?
  include ("tabs/tabs_per.php");
  $codg_mov=$_GET['codg_mov'];
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

<SCRIPT>do_tabs("Comisiones de Servicio", "")</SCRIPT>

<BR>

        <TABLE BORDER="0" ALIGN="CENTER">
                <TR>
                <TD WIDTH="725"><DIV ALIGN="CENTER"><P class="cabecera">Comisiones de Servicio</P></DIV></TD>
                </TR>
        </TABLE>

        <TABLE BORDER="0" ALIGN="CENTER">
         <?
             $consulta_com_serv_desde = mysql_query("SELECT c.codg_per, c.codg_plantel_desde, c.codg_plantel_insti_hacia_com_serv, c.fec_inicio_com_serv, c.fec_fin_com_serv, i.nomb_insti, c.codg_jer_plantel, c.func_desemp_com_serv
                                                     FROM bdc_com_serv c, bdc_instituciones i WHERE c.codg_per=$codg_per AND c.codg_mov=$codg_mov AND i.codg_insti=c.codg_plantel_desde");
             $consulta_com_serv_hacia = mysql_query("SELECT c.codg_per, c.codg_plantel_desde, c.codg_plantel_insti_hacia_com_serv, c.fec_inicio_com_serv, c.fec_fin_com_serv, i.nomb_insti, c.codg_jer_plantel, c.func_desemp_com_serv
                                                     FROM bdc_com_serv c, bdc_instituciones i WHERE c.codg_per=$codg_per AND c.codg_mov=$codg_mov AND i.codg_insti=c.codg_plantel_insti_hacia_com_serv");

            // $consulta_datos_traslados = mysql_query("SELECT t.fec_ing, t.fec_egr, i.nomb_insti,
            //        t.codg_cat_cargo, t.codg_jer_cargo, t.codg_insti_desde, t.codg_cargo, t.codg_insti_hacia
            //        FROM bdc_traslados t, bdc_instituciones i
            //        WHERE t.codg_per=$codg_per AND t.codg_insti_desde=i.codg_insti ORDER BY 1");

            if ((mysql_num_rows($consulta_com_serv_desde) != 0) || (mysql_num_rows($consulta_com_serv_hacia) != 0))
             {
                 while (($com_serv1 = mysql_fetch_array($consulta_com_serv_desde)) && ($com_serv2 = mysql_fetch_array($consulta_com_serv_hacia)))
                     {
                      $codg_plantel_desde1 = $com_serv1["codg_plantel_desde"];
                      $codg_plantel_insti_com_serv1 = $com_serv1["codg_plantel_insti_com_serv"];
                      $fec_inicio_com_serv = $com_serv1["fec_inicio_com_serv"];
                      $fec_fin_com_serv = $com_serv1["fec_fin_com_serv"];
                      $codg_jer_plantel = $com_serv1["codg_jer_plantel"];
                      $func_desemp_com_serv = $com_serv1["func_desemp_com_serv"];
                      $codg_plantel_desde2 = $com_serv2["codg_plantel_desde"];
                      $codg_plantel_insti_hacia_com_serv2 = $com_serv2["codg_plantel_insti_hacia_com_serv"];

                       echo '<TR>';
                      echo '<TD><P ALIGN="RIGHT" class="mini">Municipio:</P></TD>';
                      echo '<TD WIDTH="150">';

                      $consulta_municipio1 = mysql_query("SELECT m.nomb_mun FROM bdc_municipios m, bdc_instituciones i, bdc_com_serv c
                                 WHERE c.codg_per=$codg_per AND c.codg_plantel_insti_hacia_com_serv=$codg_plantel_insti_hacia_com_serv2 AND c.codg_plantel_desde=i.codg_insti AND
                                 i.codg_pais=m.codg_pais AND i.codg_est=m.codg_est AND i.codg_mun=m.codg_mun");

                      $municipio1 = mysql_fetch_array($consulta_municipio1);

                     echo '<P ALIGN="LEFT" class="campo">'.$municipio1['nomb_mun']; echo'</P>';
                     echo '</TD>
                           <TD WIDTH="150"><P ALIGN="RIGHT" class="mini">Parroquia:</P></TD>
                           <TD>';

                     $consulta_parroquia1 = mysql_query("SELECT p.nomb_parr FROM bdc_parroquias p, bdc_instituciones i, bdc_com_serv c
                                 WHERE c.codg_per=$codg_per AND c.codg_plantel_desde=i.codg_insti AND c.codg_plantel_insti_hacia_com_serv=$codg_plantel_insti_hacia_com_serv2 AND
                                 i.codg_pais=p.codg_pais AND i.codg_est=p.codg_est AND i.codg_mun=p.codg_mun and i.codg_parr=p.codg_parr");

                     $parroquia1 = mysql_fetch_array($consulta_parroquia1);

                     echo '<P ALIGN="LEFT" class="campo">'.$parroquia1['nomb_parr']; echo'</P>';
                     echo '</TD>';
                     echo '</TR>';

                      echo '<TR>';
                      echo '<TD WIDTH="150"><P ALIGN="RIGHT" class="mini">Plantel de Origen:</P></TD>';
                      echo '<TD COLSPAN="3"><P ALIGN="LEFT" class="campo">'.$com_serv1['nomb_insti'];echo'</P></TD>';
                      echo '</TR>';


                      echo '<TR>';

                     echo '<TD><P ALIGN="RIGHT" class="mini">Jerarqu&iacute;a en el <BR>Plantel de Origen:</P></TD>';
                $consulta_cargo1 = mysql_query("SELECT desc_jer_plantel FROM bdc_jer_plantel WHERE codg_jer_plantel='$codg_jer_plantel'");
                $cargo1 = mysql_fetch_array($consulta_cargo1);

                     echo '<TD COLSPAN="3"><P ALIGN="LEFT" class="campo">'.$cargo1['desc_jer_plantel'];echo'</P></TD>';

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


                      echo '<TR>';
                      echo '<TD WIDTH="150"><P ALIGN="RIGHT" class="mini">Plantel de Destino:</P></TD>';
                      echo '<TD COLSPAN="3"><P ALIGN="LEFT" class="campo">'.$com_serv2['nomb_insti'];echo'</P></TD>';
                      echo '</TR>';

                      echo '<TR>';
                      echo '<TD><P ALIGN="RIGHT" class="mini">Municipio:</P></TD>';
                      echo '<TD WIDTH="150">';

                $consulta_municipio2 = mysql_query("SELECT m.nomb_mun FROM bdc_municipios m, bdc_instituciones i, bdc_com_serv c
                                 WHERE c.codg_per=$codg_per AND c.codg_plantel_desde=$codg_plantel_desde1 AND c.codg_plantel_insti_hacia_com_serv=i.codg_insti AND
                                 i.codg_pais=m.codg_pais AND i.codg_est=m.codg_est AND i.codg_mun=m.codg_mun");

                $municipio2 = mysql_fetch_array($consulta_municipio2);

                     echo '<P ALIGN="LEFT" class="campo">'.$municipio2['nomb_mun']; echo'</P>';
                     echo '</TD>
                           <TD WIDTH="150"><P ALIGN="RIGHT" class="mini">Parroquia:</P></TD>
                           <TD>';

                $consulta_parroquia2 = mysql_query("SELECT p.nomb_parr FROM bdc_parroquias p, bdc_instituciones i, bdc_com_serv c
                                 WHERE c.codg_per=$codg_per AND c.codg_plantel_desde=$codg_plantel_desde1 AND c.codg_plantel_insti_hacia_com_serv=i.codg_insti AND
                                 i.codg_pais=p.codg_pais AND i.codg_est=p.codg_est AND i.codg_mun=p.codg_mun AND i.codg_parr=p.codg_parr");

                $parroquia2 = mysql_fetch_array($consulta_parroquia2);

                     echo '<P ALIGN="LEFT" class="campo">'.$parroquia2['nomb_parr']; echo'</P>';
                     echo '</TD>';
                     echo '</TR>';

                     echo '<TR>';

                     echo '<TD><P ALIGN="RIGHT" class="mini">Funciones que va a Desempeñar en la Comisión:</P></TD>';
                     echo '<TD COLSPAN="3"><P ALIGN="LEFT" class="campo">'.$func_desemp_com_serv;echo'</P></TD>';

                     echo '</TR>';

                     echo '<TR>';

                     echo '<TD><P ALIGN="RIGHT" class="mini">Fecha de Inicio <BR>de la Comisión:</P></TD>';
                     $fec_inicio_com_serv = substr($fec_inicio_com_serv,8,2)."-".substr($fec_inicio_com_serv,5,2)."-".substr($fec_inicio_com_serv,0,4);
                     echo '<TD><P ALIGN="LEFT" class="campo">'.$fec_inicio_com_serv; echo'</P></TD>';

                     echo '<TD><P ALIGN="RIGHT" class="mini">Fecha de Fin <BR>de la Comisión:</P></TD>';
                     $fec_fin_com_serv = substr($fec_fin_com_serv,8,2)."-".substr($fec_fin_com_serv,5,2)."-".substr($fec_fin_com_serv,0,4);
                     echo '<TD><P ALIGN="LEFT" class="campo">'.$fec_fin_com_serv; echo'</P></TD>';
                     echo '</TR>';

                     echo '<TR>';
                     echo '<TD COLSPAN="6"><HR></TD>';
                     echo '</TR>';
                 }
			echo '<a href=documentos_comision_servicio.php?codg_mov='.$codg_mov.'&codg_per='.$codg_per.'><img border=0 src="../images/print_ico.png" ALT="Imprimir Carta de Presentación"></a>';
              }else{
                    echo '<CENTER><P><B class="rojo">No Posee Registros</B></CENTER>';
              }

      ?>
        </TABLE>

</HTML>
