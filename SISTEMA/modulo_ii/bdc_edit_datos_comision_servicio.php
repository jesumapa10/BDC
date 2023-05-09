<?
  include ("../sesion.php");

  include ("../conex.php");
?>
<HTML>
<HEAD>
        <LINK REL="STYLESHEET" HREF="../style/normal.css" TYPE="text/css">

        <SCRIPT LANGUAGE="JavaScript" SRC="../scripts/validar.js" TYPE="text/javascript"></SCRIPT>

<?
  include ("tabs/tabs_per_edit.php");
?>

<SCRIPT LANGUAGE="JavaScript" SRC="/bdc/scripts/validar.js" TYPE="text/javascript"></SCRIPT>

<SCRIPT>

<?
 $consulta_com_serv_desde = mysql_query("SELECT c.codg_per, c.codg_plantel_desde, c.codg_plantel_insti_hacia_com_serv, c.fec_inicio_com_serv, c.fec_fin_com_serv, i.nomb_insti FROM bdc_com_serv c, bdc_instituciones i WHERE c.codg_per=$codg_per AND
                i.codg_insti=c.codg_plantel_desde");

           if (mysql_num_rows($consulta_com_serv_desde) != 0)
                {
                    while ($datos = mysql_fetch_array($consulta_com_serv_desde))
                  {

                             echo 'function eliminar'.$datos["codg_plantel_desde"].$datos["codg_plantel_insti_hacia_com_serv"].'()
                                   {

                                   input_box=confirm("¿Está seguro que desea Eliminar este Registro?");
                                   if (input_box==true)
                                   {
                                          datos.action.value="elm";
                                          datos.codg_per.value="'.$codg_per.'";
                                          datos.codg_plantel_desde.value="'.$datos["codg_plantel_desde"].'";
                                          datos.codg_plantel_insti_hacia_com_serv.value="'.$datos["codg_plantel_insti_hacia_com_serv"].'";
                                          datos.submit();
                                   }
                                   }

                                   function editar'.$datos["codg_plantel_desde"].$datos["codg_plantel_insti_hacia_com_serv"].'()
                                   {
                                         window.open("bdc_editor_comision_servicio.php?codg_per='.$datos["codg_per"].'&codg_plantel_desde='.$datos["codg_plantel_desde"].'&codg_plantel_insti_hacia_com_serv='.$datos["codg_plantel_insti_hacia_com_serv"].'","_blank","scrollbars=no,status=no,toolbar=no,directories=no,menubar=no,resizable=no,width=1000,height=480")

                                   }';
                  }
                }
?>

function agregar()
{
 window.open("bdc_mini_add_comision_servicio.php?codg_per=<? echo $codg_per; ?>","_blank","scrollbars=no,status=no,toolbar=no,directories=no,menubar=no,resizable=no,width=1000,height=580")
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
          location = "bdc_edit_archivos_digitales.php?codg_per=<? echo $codg_per; ?>";
        }

function regresar()
        {
        location = "bdc_edit_datos_permisos.php?codg_per=<? echo $codg_per; ?>";
        }

function actualizar()
        {
        datos.submit()
        }

</SCRIPT>
</HEAD>

<BR><BR>
<H2>Editar Ficha de Personal</H2>

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

<FORM METHOD="post" NAME="datos" action="bdc_edit_datos_comision_servicio.php">


                <TABLE BORDER="0" ALIGN="center">

               <?

                $consulta_com_serv_desde = mysql_query("SELECT c.codg_plantel_desde, c.codg_plantel_insti_hacia_com_serv, c.fec_inicio_com_serv, c.fec_fin_com_serv, i.nomb_insti FROM bdc_com_serv c, bdc_instituciones i WHERE c.codg_per=$codg_per AND
                i.codg_insti=c.codg_plantel_desde");

                 $consulta_com_serv_hacia = mysql_query("SELECT c.codg_plantel_desde, c.codg_plantel_insti_hacia_com_serv, c.fec_inicio_com_serv, c.fec_fin_com_serv, i.nomb_insti FROM bdc_com_serv c, bdc_instituciones i WHERE c.codg_per=$codg_per AND
                i.codg_insti=c.codg_plantel_insti_hacia_com_serv");
             if ((mysql_num_rows($consulta_com_serv_desde) != 0) || (mysql_num_rows($consulta_com_serv_hacia) != 0))
             {

                echo '<TABLE BORDER="0" ALIGN="CENTER">';
                echo '<TR>';
                echo '<TD COLSPAN="4" WIDTH="580">';
                echo '<DIV ALIGN="CENTER"><P class="cabecera">Comisiones de Servicio Registrados</P></DIV>';
                echo '</TD>';
                echo '</TR>';

                  echo '<TR>';
                  echo '<TD WIDTH="290"><P ALIGN="CENTER" class="mini">Instituci&oacute;n/Plantel de Origen</P></TD>';
                  echo '<TD WIDTH="290"><P ALIGN="CENTER" class="mini">Instituci&oacute;n/Plantel de Destino</P></TD>';
                  echo '<TD WIDTH="90"><P ALIGN="CENTER" class="mini">Fecha de Inicio</P></TD>';
                  echo '<TD WIDTH="90"><P ALIGN="CENTER" class="mini">Fecha Fin</P></TD>';
                  echo '</TR>';


                     while (($servicio1 = mysql_fetch_array($consulta_com_serv_desde)) && ($servicio2 = mysql_fetch_array($consulta_com_serv_hacia)))
                     {
                     $fec_inicio_com_serv = $servicio1['fec_inicio_com_serv'];
                     $fec_fin_com_serv = $servicio1['fec_fin_com_serv'];
                     $fec_inicio_com_serv = substr($fec_inicio_com_serv,8,2)."-".substr($fec_inicio_com_serv,5,2)."-".substr($fec_inicio_com_serv,0,4);
                     $fec_fin_com_serv = substr($fec_fin_com_serv,8,2)."-".substr($fec_fin_com_serv,5,2)."-".substr($fec_fin_com_serv,0,4);

                     echo '<TR>';
                         echo '<TD><P ALIGN="CENTER" class="campo">'.$servicio1['nomb_insti'];'</P></TD>';
                         echo '<TD><P ALIGN="CENTER" class="campo">'.$servicio2['nomb_insti'];'</P></TD>';
                         echo '<TD><P ALIGN="CENTER" class="campo">'.$fec_inicio_com_serv;'</P></TD>';
                         echo '<TD><P ALIGN="CENTER" class="campo">'.$fec_fin_com_serv;'</P></TD>';
                         echo '<TD><p class="mini" align=center><INPUT TYPE="BUTTON" class="mini" VALUE="Editar" onClick="editar'.$servicio1["codg_plantel_desde"].$servicio2["codg_plantel_insti_hacia_com_serv"].'()">&nbsp;<INPUT TYPE="BUTTON" class="mini" VALUE="Eliminar" onClick="eliminar'.$servicio1["codg_plantel_desde"].$servicio2["codg_plantel_insti_hacia_com_serv"].'()"></TD>';
                     echo '</TR>';

                     }
                    echo '<TR>
                           <TD COLSPAN="4"><HR></TD>
                           </TR>';
                    echo '</TABLE>';

              }
          else
              {
             echo '<CENTER><P><B class="rojo">No Posee Registros</B></CENTER>';
              }


           ?>


                <INPUT TYPE="HIDDEN" NAME="action" VALUE="">
                <INPUT TYPE="HIDDEN" NAME="codg_per" VALUE="<? echo $codg_per; ?>">
                <INPUT TYPE="HIDDEN" NAME="codg_plantel_desde" VALUE="<? echo $codg_plantel_desde; ?>">
                <INPUT TYPE="HIDDEN" NAME="codg_plantel_insti_hacia_com_serv" VALUE="<? echo $codg_plantel_insti_hacia_com_serv; ?>">
<BR>
<CENTER><INPUT class="mini" TYPE="BUTTON" VALUE="Agregar" onclick="agregar()">&nbsp;<INPUT class="mini" TYPE="BUTTON" VALUE="Actualizar" onclick="actualizar()">&nbsp;<INPUT class="mini" TYPE="BUTTON" VALUE="<< Regresar" onclick="regresar()">&nbsp;<INPUT class="mini" TYPE="BUTTON" VALUE="Siguiente >>" onclick="siguiente()">&nbsp;<INPUT class="mini" TYPE="BUTTON" VALUE="Finalizar" onclick="finalizar()"></CENTER>

</FORM>

<? if ($action == "elm")
    {
      $qry = ("DELETE FROM bdc_com_serv
                           WHERE codg_per=$codg_per AND codg_plantel_desde=$codg_plantel_desde AND codg_plantel_insti_hacia_com_serv=$codg_plantel_insti_hacia_com_serv");

                       mysql_query ($qry);

               echo " <SCRIPT> ";
               echo "   alert('Registro Eliminado');";
               echo '   datos.action.value="";';
               echo "   datos.submit();";
               echo "  </SCRIPT>";
      }
?>
</HTML>
