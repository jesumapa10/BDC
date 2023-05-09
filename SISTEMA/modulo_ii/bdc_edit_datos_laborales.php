<?
  include ("../sesion.php");

  include ("../conex.php");
?>

<SCRIPT>
function imprimir_suplencia(codigo)
        {
         window.open("documentos_carta_presentacion_suplentes.php?codg_mov="+codigo,"_blank","scrollbars=yes,status=no,toolbar=no,directories=no,menubar=no,resizable=no,width=800,height=500")
        }
</SCRIPT>
</HEAD>
<LINK REL="STYLESHEET" HREF="../style/normal.css" TYPE="text/css">
<SCRIPT LANGUAGE="JavaScript" SRC="../scripts/validar.js" TYPE="text/javascript"></SCRIPT>
<SCRIPT>
<?
 $consulta_institucion1 = mysql_query("SELECT codg_per, codg_insti, codg_mov FROM bdc_datos_lab WHERE codg_per=$codg_per");

           if (mysql_num_rows($consulta_institucion1) != 0)
                {
                    while ($datos = mysql_fetch_array($consulta_institucion1))
                  {

                             echo 'function eliminar'.$codg_per.$datos["codg_mov"].'()
                                   {

                                   input_box=confirm("¿Está seguro que desea Eliminar este Registro?");
                                   if (input_box==true)
                                   {
                                          datos.action.value="elm";
                                          datos.codg_per.value="'.$datos["codg_per"].'";
                                          datos.codg_mov.value="'.$datos["codg_mov"].'";
                                          datos.submit();
                                   }
                                   }

                                   function editar'.$codg_per.$datos["codg_mov"].'()
                                   {
                                         window.open("bdc_editor_datos_laborales.php?codg_per='.$datos["codg_per"].'&codg_mov='.$datos["codg_mov"].'","_blank","scrollbars=no,status=no,toolbar=no,directories=no,menubar=no,resizable=no,width=800,height=500")

                                   }
                                   function imprimir'.$codg_per.$datos["codg_mov"].'()
                                   {
                                         window.open("documentos_constancia_trabajo.php?codg_per='.$datos["codg_per"].'&codg_mov='.$datos["codg_mov"].'","_blank","scrollbars=yes,status=no,toolbar=no,directories=no,menubar=no,resizable=no,width=800,height=500")

                                   }
                                   function mostrarventana'.$codg_per.$datos["codg_insti"].'()
                                   {
                                         window.open("bdc_mini_informacion.php?codg_per='.$datos["codg_per"].'&codg_insti='.$datos["codg_insti"].'","_blank","scrollbars=no,status=no,toolbar=no,directories=no,menubar=no,resizable=no,width=800,height=500")
                                   }
                                   ';
                  }
                }

?>

function agregar()
        {
         window.open("bdc_mini_add_datos_laborales.php?codg_per=<? echo $codg_per; ?>&codg_tip_mov=3","_blank","scrollbars=no,status=no,toolbar=no,directories=no,menubar=no,resizable=no,width=800,height=500")
        }

function actualizar()
        {
        datos.submit()
        }
function finalizar()
{
input_box=confirm("¿Está seguro que desea Finalizar?");
if (input_box==true)

{
        location = "../modulo_i/bdc_data.php";
}

}

function siguiente()
        {
        location = "bdc_edit_datos_personales.php?codg_per=<? echo $codg_per; ?>&id_tab=<? echo $id_tab+1; ?>&direccion=<? echo $tabs[$seccion][$id_tab+1][4]; ?>";
        }

function regresar()
        {
        location = "bdc_edit_datos_personales.php?codg_per=<? echo $codg_per; ?>&id_tab=<? echo $id_tab-1; ?>&direccion=<? echo $tabs[$seccion][$id_tab-1][4]; ?>";
        }
</SCRIPT>

<?
$consulta = mysql_query("SELECT d.apel_per, d.nomb_per, d.naci_per, d.codg_tip_trab, t.desc_tip_trab
                 FROM bdc_datos_per d, bdc_tip_trab t
                 WHERE d.codg_per=$codg_per AND d.codg_tip_trab=t.codg_tip_trab");

$datos = mysql_fetch_array($consulta);
$apel_per = $datos["apel_per"];
$nomb_per = $datos["nomb_per"];
$naci_per = $datos["naci_per"];
$codg_tip_trab = $datos["codg_tip_trab"];
$desc_tip_trab = $datos["desc_tip_trab"];

?>
<FORM METHOD="post" NAME="datos" action="">

                <TABLE BORDER="0" ALIGN="center">
                <TR>
                <TD WIDTH="900"><DIV ALIGN="center"><P class="cabecera">Datos Laborales</P></DIV></TD>
                </TR>
        </TABLE>

        <?
         	/// DATOS NOMINA ////
            $consulta_datos_laborales = mysql_query("SELECT codg_per, codg_insti, codg_dir, codg_uni, codg_coor, codg_cargo, codg_cat_cargo, codg_jer_cargo, codg_jer_plantel, codg_cond_lab, fec_ingp_lab, turno_lab, dedic_lab, horas_doc_lab, horas_adm_lab, codg_mov, sueldo_integral, bono_bolivariano, bono_simoncito, cesta_ticket
             FROM bdc_datos_lab
             WHERE codg_per =$codg_per");

           if (mysql_num_rows($consulta_datos_laborales) != 0)
             {
              while ($datos_laborales = mysql_fetch_array($consulta_datos_laborales))
              {


              $codg_mov = $datos_laborales["codg_mov"];
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
              
              /// DATOS NOMINA ////
			  $sueldo_integral = $datos_laborales["sueldo_integral"];
			  $bono_bolivariano = $datos_laborales["bono_bolivariano"];
			  $bono_simoncito = $datos_laborales["bono_simoncito"];
			  $cesta_ticket = $datos_laborales["cesta_ticket"];


              echo '<TABLE BORDER="0" ALIGN="center">

                   <TR>
                   <TD WIDTH="120"><P ALIGN="right" class="mini">Plantel:</P></TD>';
                   $consulta_datos_institucion = mysql_query("SELECT nomb_insti FROM bdc_instituciones WHERE codg_insti=$codg_insti");
                   $nomb_insti = mysql_fetch_array($consulta_datos_institucion);
                   $nomb_insti = $nomb_insti["nomb_insti"];

              echo '<TD COLSPAN="5"><P ALIGN="left" class="campo">'.$nomb_insti; echo'</P></TD>';

              echo '<TD WIDTH="140" rowspan="5"><input type="image" src="../images/info_escuela.png" ALT="Información del Plantel" onClick="mostrarventana'.$codg_per.$codg_insti.'()" title="Haga click para abrir una ventana con la información de la institución">'; if ($codg_cond_lab == 16){ echo '<a href="#" onclick="imprimir_suplencia('.$codg_mov.')"><img border=0 src="../images/print_ico.png" title="Haga click para abrir una ventana con Carta de Presentación lista para Imprimir">'; } echo ' </TD>
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
					 
					 /// DATOS NOMINA////
					 echo '<TR>';
                     echo '<TD><P ALIGN="RIGHT" class="mini">Sueldo Integral:</P></TD>';
                     echo '<TD><P class="campo">'.$sueldo_integral; echo'</P></TD>';
                     echo '<TD><P ALIGN="RIGHT" class="mini">Bono Bolivariano:</P></TD>';
                     echo '<TD><P class="campo">'.$bono_bolivariano.'</P></TD>';
                     echo '</TR>';
                
                	 echo '<TR>';
                	 echo '<TD><P ALIGN="RIGHT" class="mini">Bono Simoncito:</P></TD>';
                     echo '<TD><P class="campo">'.$bono_simoncito.'</P></TD>';
                     echo '<TD><P ALIGN="RIGHT" class="mini">Cesta Ticket:</P></TD>';
                     echo '<TD><P class="campo">'.$cesta_ticket.'</P></TD>';
                   echo'</TR>';
			
                     
                     echo '</TR>';
                     echo '<TR>
                          <TD COLSPAN="7"><HR></TD></TR>
                          <TR><TD COLSPAN="7"><CENTER><INPUT TYPE="BUTTON" class="mini" VALUE="Editar" onClick="editar'.$codg_per.$codg_mov.'()" title="Haga click para editar este registro">&nbsp;<INPUT TYPE="BUTTON" class="mini" VALUE="Eliminar" onClick="eliminar'.$codg_per.$codg_mov.'()" title="Haga click para eliminar este registro">&nbsp;<INPUT TYPE="BUTTON" class="mini" VALUE="Imprimir Constancia" onClick="imprimir'.$codg_per.$codg_mov.'()" title="Haga click para imprimir constancia de trabajo"></CENTER></TR></TD>


                          </TABLE>';

           }
          }
         else
           {
            echo '<CENTER><P><B class="rojo">No Posee Registros</B></P></CENTER>';
            }
        ?>



                <INPUT TYPE="HIDDEN" NAME="action" VALUE="">
                <INPUT TYPE="HIDDEN" NAME="codg_per" VALUE="<? echo $codg_per; ?>">
                <INPUT TYPE="HIDDEN" NAME="codg_mov" VALUE="<? echo $codg_mov; ?>">
<BR>
<CENTER><INPUT class="mini" TYPE="BUTTON" VALUE="Agregar" onclick="agregar()" title="Haga click para agregar un nuevo dato laboral">&nbsp;<INPUT class="mini" TYPE="BUTTON" VALUE="Actualizar" onclick="actualizar()" title="Haga click para regargar esta pantalla">&nbsp;<INPUT class="mini" TYPE="BUTTON" VALUE="<< Regresar" onclick="regresar()" title="Haga click para ir a la pestaña anterior">&nbsp;<INPUT class="mini" TYPE="BUTTON" VALUE="Siguiente >>" onclick="siguiente()" title="Haga click para ir a la siguiente pestaña">&nbsp;<INPUT class="mini" TYPE="BUTTON" VALUE="Finalizar" onclick="finalizar()" title="Haga click para finalizar la edición e ir a la pantalla inicial"></CENTER>

                </FORM>
  <?

        if ($action == "elm")
         {
                $qry =("DELETE FROM bdc_movimientos
                           WHERE codg_mov=$codg_mov");

                mysql_query ($qry);


                $qry =("DELETE FROM bdc_datos_lab
                           WHERE codg_per=$codg_per AND codg_mov=$codg_mov");

                mysql_query ($qry);

               echo " <SCRIPT> ";
               echo "   alert('Registro Eliminado');";
               echo '   datos.action.value="";';
               echo "   datos.submit();";
               echo "  </SCRIPT>";
      }
  ?>

</HTML>
