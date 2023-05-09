<?
  include ("../sesion.php");

  include ("../conex.php");
?>
</HEAD>

        <LINK REL="STYLESHEET" HREF="../style/normal.css" TYPE="text/css">

        <SCRIPT LANGUAGE="JavaScript" SRC="../scripts/validar.js" TYPE="text/javascript"></SCRIPT>

<SCRIPT>
<?
 $consulta_institucion1 = mysql_query("SELECT codg_per, codg_mov FROM bdc_datos_acad WHERE codg_per=$codg_per");

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
                                         window.open("bdc_editor_datos_academicos.php?codg_per='.$datos["codg_per"].'&codg_mov='.$datos["codg_mov"].'","_blank","scrollbars=no,status=no,toolbar=no,directories=no,menubar=no,resizable=no,width=800,height=500")

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
         window.open("bdc_mini_add_datos_academicos.php?codg_per=<? echo $codg_per; ?>&codg_tip_mov=2","_blank","scrollbars=no,status=no,toolbar=no,directories=no,menubar=no,resizable=no,width=800,height=500")
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
                <TD WIDTH="900"><DIV ALIGN="center">
                  <P class="cabecera">Datos Acad&eacute;micos </P>
                </DIV></TD>
                </TR>
        </TABLE>

        <?
            $consulta_datos_academicos = mysql_query("SELECT codg_per, codg_niv_inst, estudia_act, codg_car, estudia_sem, fec_grado, codg_mov
             FROM bdc_datos_acad
             WHERE codg_per =$codg_per");

           if (mysql_num_rows($consulta_datos_academicos) != 0)
             {
              while ($datos_academicos = mysql_fetch_array($consulta_datos_academicos))
              {
              $codg_mov = $datos_academicos["codg_mov"];
			  $codg_per = $datos_academicos["codg_per"];
			  $codg_niv_inst = $datos_academicos["codg_niv_inst"];
			  $estudia_act = $datos_academicos["estudia_act"];
			  $codg_car = $datos_academicos["codg_car"];
			  $estudia_sem = $datos_academicos["estudia_sem"];
			  $fec_grado = $datos_academicos["fec_grado"];
			  $fec_grado = substr($fec_grado,8,2)."-".substr($fec_grado,5,2)."-".substr($fec_grado,0,4);
			  $odg_mov = $datos_academicos["odg_mov"];
			  
              echo '<TABLE BORDER="0" ALIGN="center">
			  

                   <TR>'; ?>
				   
				   <TD width="135" class="mini"><span class="mini">Nivel de Instrucci&oacute;n:</span></TD>
                <TD width="405" COLSPAN="3" class="campo">
                  <? $consulta = mysql_query("SELECT codg_niv_inst, desc_niv_inst FROM bdc_niv_inst WHERE codg_niv_inst=$codg_niv_inst ORDER BY 2");
				  $datos = mysql_fetch_array($consulta);
				  echo $datos["desc_niv_inst"];
				   ?>
                </TD>
                </TR>

                <TR>
                  <TD class="mini">Carrera:</TD>
                  <TD COLSPAN="3" class="campo">
				  <?PHP
				     if ($codg_car!=NULL)
				    {
				     $carreras = mysql_query("SELECT codg_car, desc_car FROM bdc_carreras  WHERE codg_car=$codg_car");
					 $datos = mysql_fetch_array($carreras);
					 echo $datos["desc_car"];
				    }
				    
				  ?>				  </TD>
                </TR>
                <TR>
                  <TD class="mini">Estudia Actualmente: </TD>
                  <TD COLSPAN="3" class="campo">
                    <? if ($estudia_act == "S") {echo 'SI';}?> 
                    <? if ($estudia_act == "N") {echo 'NO';}?></TD>
                </TR>
                <TR>
                  <TD class="mini">Semestre / A&ntilde;o</TD>
                  <TD COLSPAN="3" class="campo">
                    <? if ($estudia_sem == "0") {echo '';}?>
                    <? if ($estudia_sem == "1") {echo '1er';}?>
                    <? if ($estudia_sem == "2") {echo '2do';}?>
                    <? if ($estudia_sem == "3") {echo '3er';}?>
                    <? if ($estudia_sem == "4") {echo '4to';}?>
                    <? if ($estudia_sem == "5") {echo '5to';}?>
                    <? if ($estudia_sem == "6") {echo '6to';}?>
                    <? if ($estudia_sem == "7") {echo '7mo';}?>
                    <? if ($estudia_sem == "8") {echo '8vo';}?>
                    <? if ($estudia_sem == "9") {echo '9no';}?>
                    <? if ($estudia_sem == "10") {echo '10mo';}?>
                  </TD>
                </TR>
                <TR>
                  <TD class="mini">Fecha de Grado </TD>
                  <TD COLSPAN="3" class="campo">
				  <?PHP echo $fec_grado; ?>				  </TD>
			
                   <?
                     echo '</TR>';
                     echo '<TR>
                          <TD COLSPAN="6"><HR></TD></TR>
                          <TR><TD COLSPAN="6"><CENTER><INPUT TYPE="BUTTON" class="mini" VALUE="Editar" onClick="editar'.$codg_per.$codg_mov.'()" title="Haga click para editar este registro">&nbsp;<INPUT TYPE="BUTTON" class="mini" VALUE="Eliminar" onClick="eliminar'.$codg_per.$codg_mov.'()" title="Haga click para eliminar este registro"></CENTER></TR></TD>


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
<CENTER><INPUT class="mini" TYPE="BUTTON" VALUE="Agregar" onclick="agregar()" title="Haga click para agregar un nuevo dato académico">&nbsp;<INPUT class="mini" TYPE="BUTTON" VALUE="Actualizar" onclick="actualizar()" title="Haga click para regargar esta pantalla">&nbsp;<INPUT class="mini" TYPE="BUTTON" VALUE="<< Regresar" onclick="regresar()" title="Haga click para ir a la pestaña anterior">&nbsp;<INPUT class="mini" TYPE="BUTTON" VALUE="Siguiente >>" onclick="siguiente()" title="Haga click para ir a la siguiente pestaña">&nbsp;<INPUT class="mini" TYPE="BUTTON" VALUE="Finalizar" onclick="finalizar()" title="Haga click para finalizar la edición e ir a la pantalla inicial"></CENTER>

                </FORM>
  <?

        if ($action == "elm")
         {
                $qry =("DELETE FROM bdc_movimientos
                           WHERE codg_mov=$codg_mov");

                mysql_query ($qry);

                $qry =("DELETE FROM bdc_datos_acad
                           WHERE codg_mov=$codg_mov");

                mysql_query ($qry);


               echo " <SCRIPT> ";
               echo "   alert('Registro Eliminado');";
               echo '   datos.action.value="";';
               echo "   datos.submit();";
               echo "  </SCRIPT>";
      }
  ?>

</HTML>
