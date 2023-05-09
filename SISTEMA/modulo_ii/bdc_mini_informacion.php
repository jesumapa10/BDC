<?
  include ("../sesion.php");

  include ("../conex.php");
?>

<HTML>
<HEAD>
        <LINK REL="STYLESHEET" HREF="../style/normal.css" TYPE="text/css">

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
   $consulta_tipo_insti = mysql_query("SELECT codg_tip_insti, nomb_insti, dirc_insti, telf_insti, fax_insti FROM bdc_instituciones WHERE codg_insti=$codg_insti");

   $datos_institucion =  mysql_fetch_array($consulta_tipo_insti);
   $codg_tip_insti = $datos_institucion["codg_tip_insti"];
   $nomb_insti = $datos_institucion["nomb_insti"];
   $dirc_insti = $datos_institucion["dirc_insti"];
   $telf_insti = $datos_institucion["telf_insti"];
   $fax_insti = $datos_institucion["fax_insti"];


  if ($codg_tip_insti = "1")
  {
    echo '<H2>Breve Ficha del Plantel</H2>';

        echo '<TABLE BORDER="0" ALIGN="CENTER">';
        echo '  <TR>
                <TD WIDTH="505"><DIV ALIGN="CENTER"><P class="cabecera">Datos del Plantel</P></DIV></TD>
                </TR>
             </TABLE>';



         echo '<TABLE BORDER="0" ALIGN="CENTER">
                <TR>
                <TD WIDTH="115"><P ALIGN="RIGHT" class="mini">Plantel:</P></TD>
                <TD COLSPAN="3"><P ALIGN="LEFT" class="campo">'.$nomb_insti.'</TD>
                </TR>

                <TR>
                <TD><P ALIGN="RIGHT" class="mini">Municipio:</P></TD>';
                $consulta_municipio = mysql_query("SELECT m.nomb_mun
                                 FROM bdc_municipios m, bdc_instituciones i
                                 WHERE i.codg_insti=$codg_insti AND
                                 i.codg_pais=m.codg_pais AND i.codg_est=m.codg_est AND i.codg_mun=m.codg_mun");

                $municipio =  mysql_fetch_array($consulta_municipio);


         echo '<TD WIDTH="150"><P ALIGN="LEFT" class="campo">'.$municipio["nomb_mun"].'</TD>
                <TD WIDTH="100"><P ALIGN="RIGHT" class="mini">Parroquia:</TD>';
                $consulta_parroquia = mysql_query("SELECT p.nomb_parr
                                 FROM bdc_parroquias p, bdc_instituciones i
                                 WHERE i.codg_insti=$codg_insti AND
                                 i.codg_pais=p.codg_pais AND i.codg_est=p.codg_est AND i.codg_mun=p.codg_mun AND i.codg_parr=p.codg_parr");

                $parroquia =  mysql_fetch_array($consulta_parroquia);

         echo '<TD WIDTH="120"><P ALIGN="LEFT" class="campo">'.$parroquia["nomb_parr"].'</TD>
                </TR>

                <TR>
                <TD><P ALIGN="RIGHT" class="mini">Direcci&oacute;n:</P></TD>
                <TD COLSPAN="3"><P ALIGN="LEFT" class="campo">'.$dirc_insti.'</TD>
                </TR>

                <TR>
                <TD><P ALIGN="RIGHT" class="mini">C&eacute;dula del Director:</P></TD>';
                $consulta_ced_director = mysql_query("SELECT codg_dic_plantel FROM bdc_plantel WHERE codg_insti=$codg_insti");
                $director_ced =  mysql_fetch_array($consulta_ced_director);

           echo '<TD COLSPAN="3"><P ALIGN="LEFT" class="campo">'.$director_ced["codg_dic_plantel"].'</TD>

                </TR>

                <TR>
                <TD><P ALIGN="RIGHT" class="mini">Nombre del Director:</P></TD>';
                $consulta_director = mysql_query("SELECT d.apel_per, d.nomb_per
                                 FROM bdc_datos_per d, bdc_plantel p
                                 WHERE p.codg_insti=$codg_insti AND p.codg_dic_plantel=d.codg_per");

                if (mysql_num_rows($consulta_director) != 0)
                {
                  echo '<TD COLSPAN="3"><P ALIGN="LEFT" class="campo">'.$consulta_director["apel_per"].'&nbsp;'.$consulta_director["nomb_per"].'</TD>';
                }
                else
                {
                  $consulta_director = mysql_query("SELECT nomb_dic_plantel FROM bdc_plantel WHERE codg_insti=$codg_insti");
                  $director_plantel = mysql_fetch_array($consulta_director);
                  echo '<TD COLSPAN="3"><P ALIGN="LEFT" class="campo">'.$director_plantel["nomb_dic_plantel"].'</TD>';
                }

               echo '</TR>

                     <TR>
                     <TD><P ALIGN="RIGHT" class="mini">Tel&eacute;fono:</P></TD>';
               echo '<TD><P ALIGN="LEFT" class="campo">'.$telf_insti = substr($telf_insti,0,4)."&nbsp;".substr($telf_insti,5,7).'</TD>
                     <TD><P ALIGN="RIGHT" class="mini">Fax:</TD>';
               echo '<TD><P ALIGN="LEFT" class="campo">'.$fax_insti = substr($fax_insti,0,4)."&nbsp;".substr($fax_insti,5,7).'</TD>
                     </TR>';

               echo '<TR>
                     <TD><P ALIGN="RIGHT" class="mini">Tipo de Plantel:</P></TD>';
                $consulta = mysql_query("SELECT t.desc_tip_plantel
                                 FROM bdc_tip_plantel t, bdc_plantel i
                                 WHERE i.codg_insti=$codg_insti AND i.codg_tip_plantel=t.codg_tip_plantel");

                $tipo_plantel = mysql_fetch_array($consulta);

                echo '<TD><P ALIGN="LEFT" class="campo">'.$tipo_plantel["desc_tip_plantel"].'</TD>

                     <TD><P ALIGN="RIGHT" class="mini">Modalidad de Plantel:</TD>';
                         $consulta_modalidad = mysql_query("SELECT m.desc_mod_plantel
                                 FROM bdc_mod_plantel m, bdc_plantel i
                                 WHERE i.codg_insti=$codg_insti AND i.codg_mod_plantel=m.codg_mod_plantel");

                         $modalidad = mysql_fetch_array($consulta_modalidad);

                echo '<TD><P ALIGN="LEFT" class="campo">'.$modalidad["desc_mod_plantel"].'</TD>
                     </TR>';

                echo '</TABLE>';


               echo '<CENTER><INPUT TYPE="BUTTON" class="mini" VALUE="Cerrar Ventana" onClick="cerrar()"></CENTER>';
    }
else
    {
     echo '<H2>Breve Ficha del Instituto</H2>';

     echo '<TABLE BORDER="0" ALIGN="CENTER">
                <TR>
                <TD WIDTH="505"><DIV ALIGN="CENTER"><P class="cabecera">Datos del Instituto</P></DIV></TD>
                </TR>
           </TABLE>';

           $consulta_instituto = mysql_query("SELECT nomb_insti, dirc_insti, telf_insti, fax_insti
                         FROM bdc_instituciones
                         WHERE codg_insti=$codg_insti");
           $instituto = mysql_fetch_array($consulta_instituto);

              echo '<TABLE BORDER="0" ALIGN="CENTER">
                    <TR>
                    <TD WIDTH="50"><P ALIGN="RIGHT" class="mini">Instituto:</P></TD>
                    <TD COLSPAN="3"><P ALIGN="LEFT" class="campo">'.$instituto["nomb_insti"].'</TD>
                    </TR>

                    <TR>
                    <TD><P ALIGN="RIGHT" class="mini">Municipio:</P></TD>';
                     $consulta_municipio = mysql_query("SELECT m.nomb_mun
                                 FROM bdc_municipios m, bdc_instituciones i
                                 WHERE i.codg_insti=$codg_insti AND
                                 i.codg_pais=m.codg_pais AND i.codg_est=m.codg_est AND i.codg_mun=m.codg_mun");
                    $municipio = mysql_fetch_array($consulta_municipio);

              echo '<TD WIDTH="150"><P ALIGN="LEFT" class="campo">'.$municipio["nomb_mun"].'</TD>

                 <TD WIDTH="100"><P ALIGN="RIGHT" class="mini">Parroquia:</TD>';
                $consulta_parroquia = mysql_query("SELECT p.nomb_parr
                                 FROM bdc_parroquias p, bdc_instituciones i
                                 WHERE i.codg_insti=$codg_insti AND
                                 i.codg_pais=p.codg_pais AND i.codg_est=p.codg_est AND i.codg_mun=p.codg_mun AND i.codg_parr=p.codg_parr");

                $parroquia =  mysql_fetch_array($consulta_parroquia);

              echo '<TD WIDTH="120"><P ALIGN="LEFT" class="campo">'.$parroquia["nomb_parr"].'</TD>
                </TR>

                <TR>
                <TD><P ALIGN="RIGHT" class="mini">Direcci&oacute;n:</P></TD>
                <TD COLSPAN="3"><P ALIGN="LEFT" class="campo">'.$instituto["nomb_insti"].'</TD>
                </TR>

                </TABLE>

                <CENTER><INPUT TYPE="BUTTON" class="mini" VALUE="Cerrar Ventana" onClick="cerrar()"></CENTER>';
    }
?>

</HTML>
