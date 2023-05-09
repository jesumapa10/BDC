<?
  include ("../sesion.php");

  include ("../conex.php");
?>

<HTML>
<HEAD>
        <LINK REL="STYLESHEET" HREF="../style/normal.css" TYPE="text/css">

</HEAD>


<SCRIPT>
<?
 $consulta_institucion1 = mysql_query("SELECT codg_per, codg_insti FROM bdc_datos_lab WHERE codg_per=$codg_per");

           if (mysql_num_rows($consulta_institucion1) != 0)
                {
                    while ($datos = mysql_fetch_array($consulta_institucion1))
                  {

                             echo'    function mostrarventana'.$codg_per.$datos["codg_insti"].'()
                                   {
                                         window.open("bdc_mini_informacion.php?codg_per='.$datos["codg_per"].'&codg_insti='.$datos["codg_insti"].'","_blank","scrollbars=no,status=no,toolbar=no,directories=no,menubar=no,resizable=no,width=580,height=280")
                                   }
                                   ';
                  }
                }

?>
</SCRIPT>

<?
$consulta = mysql_query("SELECT d.apel_per, d.nomb_per, d.naci_per, t.desc_tip_trab, d.codg_tip_trab
                 FROM bdc_datos_per d, bdc_tip_trab t
                 WHERE d.codg_per=$codg_per AND d.codg_tip_trab=t.codg_tip_trab");

$datos = mysql_fetch_array($consulta);

$apel_per = $datos["apel_per"];
$nomb_per = $datos["nomb_per"];
$naci_per = $datos["naci_per"];
$desc_tip_trab = $datos["desc_tip_trab"];
$codg_tip_trab = $datos["codg_tip_trab"];

?>


        <TABLE BORDER="0" ALIGN="center">
                <TR>
                <TD WIDTH="900"><DIV ALIGN="center"><P class="cabecera">Datos Laborales</P></DIV></TD>
                </TR>
        </TABLE>

        <?
            $consulta_datos_laborales = mysql_query("SELECT codg_per, codg_insti, codg_dir, codg_uni, codg_coor, codg_cargo, codg_cat_cargo, codg_jer_cargo, codg_jer_plantel, codg_cond_lab, fec_ingp_lab, turno_lab, dedic_lab, horas_doc_lab, horas_adm_lab
             FROM bdc_datos_lab
             WHERE codg_per =$codg_per");

           if (mysql_num_rows($consulta_datos_laborales) != 0)
             {
              while ($datos_laborales = mysql_fetch_array($consulta_datos_laborales))
              {


              $codg_insti = $datos_laborales["codg_insti"];
              $codg_dir = $datos_laborales["codg_dirr"];
              $codg_coor = $datos_laborales["codg_coor"];
              $codg_cargo = $datos_laborales["codg_cargo"];
              $codg_cat_cargo = $datos_laborales["codg_cat_cargo"];
              $codg_jer_cargo = $datos_laborales["codg_jer_cargo"];
              $codg_jer_plantel = $datos_laborales["codg_jer_plantel"];
              $codg_cond_lab = $datos_laborales["codg_cond_lab"];
              $fec_ingp_lab = $datos_laborales["fec_ingp_lab"];
              $turno_lab = $datos_laborales["turno_lab"];
              $dedic_lab = $datos_laborales["dedic_lab"];
              $horas_doc_lab = $datos_laborales["horas_doc_lab"];
              $horas_adm_lab = $datos_laborales["horas_adm_lab"];
              $codg_uni = $datos_laborales["codg_uni"];


              echo '<TABLE BORDER="0" ALIGN="center">

                   <TR>
                   <TD WIDTH="120"><P ALIGN="right" class="mini">Plantel:</P></TD>';
                   $consulta_datos_institucion = mysql_query("SELECT nomb_insti FROM bdc_instituciones WHERE codg_insti=$codg_insti");
                   $nomb_insti = mysql_fetch_array($consulta_datos_institucion);
                   $nomb_insti = $nomb_insti["nomb_insti"];

              echo '<TD COLSPAN="4"><P ALIGN="left" class="campo">'.$nomb_insti; echo'</P></TD>';

              echo '<TD WIDTH="140"><INPUT TYPE="IMAGE" SRC="../images/info_escuela.png" ALT="Informaci&oacute;n del Plantel" onClick="mostrarventana'.$codg_per.$codg_insti.'()"></TD>
                   </TR>';


                   $consulta_municipio = mysql_query("SELECT m.nomb_mun
                                 FROM bdc_municipios m, bdc_instituciones i
                                 WHERE i.codg_insti=$codg_insti AND
                                 i.codg_pais=m.codg_pais AND i.codg_est=m.codg_est AND i.codg_mun=m.codg_mun");
                   if (mysql_num_rows($consulta_municipio) != 0)
                   {
                   $nomb_mun = mysql_fetch_array($consulta_municipio);
                   $nomb_mun = $nomb_mun["nomb_mun"];

               echo'<TR>
                   <TD><P ALIGN="right" class="mini">Municipio:</P></TD>';

               echo'<TD WIDTH="210"><P ALIGN="left" class="campo">'.$nomb_mun; echo'</P></TD>';
                    }


                    $consulta_parroquia = mysql_query("SELECT p.nomb_parr
                                 FROM bdc_parroquias p, bdc_instituciones i
                                 WHERE i.codg_insti=$codg_insti AND
                                 i.codg_pais=p.codg_pais AND i.codg_est=p.codg_est AND i.codg_mun=p.codg_mun AND i.codg_parr=p.codg_parr");

                   if (mysql_num_rows($consulta_parroquia) != 0)
                    {
                   $nomb_parr = mysql_fetch_array($consulta_parroquia);
                   $nomb_parr = $nomb_parr["nomb_parr"];
               echo '<TD><P ALIGN="right" class="mini">Parroquia:</P></TD>
                    <TD WIDTH="120">';
               echo '<P ALIGN="left" class="campo">'.$nomb_parr; echo'</P>
                    </TD>';
                    }


               echo '<TD><P ALIGN="right" class="mini">Fecha de Ingreso al Plantel:</P></TD>';
                   $fec_ingp_lab = substr($fec_ingp_lab,8,2)."-".substr($fec_ingp_lab,5,2)."-".substr($fec_ingp_lab,0,4);
              echo '<TD><P ALIGN="left" class="campo">'.$fec_ingp_lab; echo'</P></TD>

                   </TR>

                   <TR>';

              if ($codg_tip_trab == "D")
                  {
                    echo '<TD><P ALIGN="right" class="mini">Categor&iacute;a del Cargo:</P></TD>';
                     if ($codg_cat_cargo != NULL)
                         {
                         $consulta_categoria_cargo = mysql_query("SELECT desc_cat_cargo FROM bdc_cat_cargo WHERE codg_cat_cargo=$codg_cat_cargo");
                         $desc_cat_cargo = mysql_fetch_array($consulta_categoria_cargo);
                         $desc_cat_cargo = $desc_cat_cargo["desc_cat_cargo"];
                         }
                     echo '<TD><P ALIGN="left" class="campo">'.$desc_cat_cargo; echo'</P></TD>';


                     echo '<TD><P ALIGN="right" class="mini">Jerarqu&iacute;a del Cargo:</P></TD>';
                     if ($codg_jer_cargo != NULL)
                         {
                          $consulta_categoria_cargo = mysql_query("SELECT desc_jer_cargo FROM bdc_jer_cargo WHERE codg_cat_cargo=$codg_cat_cargo AND codg_jer_cargo=$codg_jer_cargo");
                          $desc_jer_cargo = mysql_fetch_array($consulta_categoria_cargo);
                          $desc_jer_cargo = $desc_jer_cargo["desc_jer_cargo"];
                         }
                     echo '<TD><P ALIGN="left" class="campo">'.$desc_jer_cargo; echo'</P></TD>';


                     echo '<TD><P ALIGN="right" class="mini">Jerarqu&iacute;a en el Plantel:</P></TD>';
                     if ($codg_jer_plantel != NULL)
                         {
                          $consulta_jer_plantel=mysql_query("SELECT desc_jer_plantel FROM bdc_jer_plantel WHERE codg_jer_plantel='$codg_jer_plantel'");
                          $desc_jer_plantel = mysql_fetch_array($consulta_jer_plantel);
                          $desc_jer_plantel = $desc_jer_plantel["desc_jer_plantel"];
                         }
                     echo '<TD><P ALIGN="left" class="campo">'.$desc_jer_plantel; echo '</P></TD>';

                  }
              else
                  {

                     echo '<TD><P ALIGN="right" class="mini">Cargo:</P></TD>';
                     if ($codg_cargo != NULL)
                           {
                          $consulta_cargo=mysql_query("SELECT desc_cargo FROM bdc_cargo WHERE codg_cargo=$codg_cargo");
                          $desc_cargo = mysql_fetch_array($consulta_cargo);
                          $desc_cargo = $desc_cargo["desc_cargo"];
                           }
                     echo '<TD COLSPAN="5"><P ALIGN="left" class="campo">'.$desc_cargo; echo'</P></TD>';
                   }
                     echo '</TR>';

                     echo '<TR>';
                     if ($codg_cond_lab != NULL)
                         {
                          $consulta_cond_lab=mysql_query("SELECT desc_cond_lab FROM bdc_cond_lab WHERE codg_cond_lab=$codg_cond_lab");
                          $desc_cond_lab = mysql_fetch_array($consulta_cond_lab);
                          $desc_cond_lab = $desc_cond_lab["desc_cond_lab"];
                          }
                     echo '<TD><P ALIGN="right" class="mini">Condición Laboral:</P></TD>';
                     echo '<TD><P ALIGN="left" class="campo">'.$desc_cond_lab; echo'</P></TD>';

                     echo '<TD><P ALIGN="right" class="mini">Dedicación:</P></TD>';
                     echo '<TD><P ALIGN="left" class="campo">';if ($dedic_lab == "TC"){echo 'Tiempo Completo';}if ($dedic_lab == "MT"){echo 'Medio Tiempo';}if ($dedic_lab == "TI"){echo 'Tiempo Integral';}if ($dedic_lab == "TV"){echo 'Tiempo Convencional';} echo'</P></TD>';
                     echo '<TD><P ALIGN="right" class="mini">Horas Administrativas:</P></TD>';
                     echo '<TD><P ALIGN="left" class="campo">'.$horas_adm_lab = substr($horas_adm_lab,0,2).".".substr($horas_adm_lab,2,2); echo '</P></TD>';
                     echo '</TR>';

                     echo '<TR>';
                     if ($turno_lab == "NULL")
                       {
                       echo '<TD></TD><TD></TD>';
                       }
                     else
                       {
                     echo '<TD><P ALIGN="right" class="mini">Turno:</P></TD>';
                     echo '<TD><P ALIGN="left" class="campo">'; if($turno_lab == "M"){echo 'Mañana';}if($turno_lab == "T"){echo 'Tarde';}if($turno_lab == "N"){echo 'Noche';}if($turno_lab == "MT"){echo 'Mixto';} echo '</P></TD>';
                       }

                     if ($codg_tip_trab == "D")
                     {
                     echo '<TD WIDTH="140"><P ALIGN="right" class="mini">Horas Docentes:</P></TD>';
                     echo '<TD><P ALIGN="left" class="campo">'.$horas_doc_lab = substr($horas_doc_lab,0,2).".".substr($horas_doc_lab,2,2); echo'</P></TD>';
                     }
                     echo '</TR>';
                     echo '<TR>
                          <TD COLSPAN="6"><HR></TD>
                          </TR>

                          </TABLE>';

           }
          }
         else
           {
            echo '<CENTER><P><B class="rojo">No Posee Registros</B></P></CENTER>';
            }
        ?>
</HTML>
