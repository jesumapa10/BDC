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
 $consulta_traslados_desde = mysql_query("SELECT t.codg_per, t.codg_plantel_desde, t.codg_plantel_hacia, t.fec_egr, i.nomb_insti FROM bdc_traslado t, bdc_instituciones i WHERE t.codg_per=$codg_per AND
                i.codg_insti=t.codg_plantel_desde");

           if (mysql_num_rows($consulta_traslados_desde) != 0)
                {
                    while ($datos = mysql_fetch_array($consulta_traslados_desde))
                  {

                             echo 'function eliminar'.$datos["codg_plantel_desde"].$datos["codg_plantel_hacia"].'()
                                   {

                                   input_box=confirm("¿Está seguro que desea Eliminar este Registro?");
                                   if (input_box==true)
                                   {
                                          datos.action.value="elm";
                                          datos.codg_per.value="'.$codg_per.'";
                                          datos.codg_plantel_desde.value="'.$datos["codg_plantel_desde"].'";
                                          datos.codg_plantel_hacia.value="'.$datos["codg_plantel_hacia"].'";
                                          datos.submit();
                                   }
                                   }

                                   function editar'.$datos["codg_plantel_desde"].$datos["codg_plantel_hacia"].'()
                                   {
                                         window.open("bdc_editor_traslados.php?codg_per='.$datos["codg_per"].'&codg_plantel_desde='.$datos["codg_plantel_desde"].'&codg_plantel_hacia='.$datos["codg_plantel_hacia"].'","_blank","scrollbars=no,status=no,toolbar=no,directories=no,menubar=no,resizable=no,width=1000,height=580")

                                   }';
                  }
                }
?>

function agregar()
{
 window.open("bdc_mini_add_traslados.php?codg_per=<? echo $codg_per; ?>","_blank","scrollbars=no,status=no,toolbar=no,directories=no,menubar=no,resizable=no,width=1000,height=580")
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
          location = "bdc_edit_datos_gremiales.php?codg_per=<? echo $codg_per; ?>";
        }

function regresar()
        {
        location = "bdc_edit_datos_laborales.php?codg_per=<? echo $codg_per; ?>";
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
<SCRIPT>do_tabs("Traslados", "")</SCRIPT>

<BR>

<FORM METHOD="post" NAME="datos" action="bdc_edit_traslados.php">


                <TABLE BORDER="0" ALIGN="center">

               <?

                $consulta_traslados_desde = mysql_query("SELECT t.codg_plantel_desde, t.codg_plantel_hacia, t.fec_egr, i.nomb_insti FROM bdc_traslado t, bdc_instituciones i WHERE t.codg_per=$codg_per AND
                i.codg_insti=t.codg_plantel_desde");

                 $consulta_traslados_hacia = mysql_query("SELECT t.codg_plantel_desde, t.codg_plantel_hacia, t.fec_ing, i.nomb_insti FROM bdc_traslado t, bdc_instituciones i WHERE t.codg_per=$codg_per AND
                i.codg_insti=t.codg_plantel_hacia");
             if ((mysql_num_rows($consulta_traslados_desde) != 0) || (mysql_num_rows($consulta_traslados_hacia) != 0))
             {

                echo '<TABLE BORDER="0" ALIGN="CENTER">';
                echo '<TR>';
                echo '<TD COLSPAN="4" WIDTH="580">';
                echo '<DIV ALIGN="CENTER"><P class="cabecera">Traslados Registrados</P></DIV>';
                echo '</TD>';
                echo '</TR>';

                  echo '<TR>';
                  echo '<TD WIDTH="290"><P ALIGN="CENTER" class="mini">Plantel de Origen</P></TD>';
                  echo '<TD WIDTH="90"><P ALIGN="CENTER" class="mini">Fecha de Egreso</P></TD>';
                  echo '<TD WIDTH="290"><P ALIGN="CENTER" class="mini">Plantel de Destino</P></TD>';
                  echo '<TD WIDTH="90"><P ALIGN="CENTER" class="mini">Fecha de Ingreso</P></TD>';
                  echo '</TR>';


                     while (($traslados1 = mysql_fetch_array($consulta_traslados_desde)) && ($traslados2 = mysql_fetch_array($consulta_traslados_hacia)))
                     {
                     $fec_egr = $traslados1['fec_egr'];
                     $fec_ing = $traslados2['fec_ing'];
                     $fec_egr = substr($fec_egr,8,2)."-".substr($fec_egr,5,2)."-".substr($fec_egr,0,4);
                     $fec_ing = substr($fec_ing,8,2)."-".substr($fec_ing,5,2)."-".substr($fec_ing,0,4);

                     echo '<TR>';
                         echo '<TD><P ALIGN="CENTER" class="campo">'.$traslados1['nomb_insti'];'</P></TD>';
                         echo '<TD><P ALIGN="CENTER" class="campo">'.$fec_egr;'</P></TD>';
                         echo '<TD><P ALIGN="CENTER" class="campo">'.$traslados2['nomb_insti'];'</P></TD>';
                         echo '<TD><P ALIGN="CENTER" class="campo">'.$fec_ing;'</P></TD>';
                         echo '<TD><p class="mini" align=center><INPUT TYPE="BUTTON" class="mini" VALUE="Editar" onClick="editar'.$traslados1["codg_plantel_desde"].$traslados2["codg_plantel_hacia"].'()">&nbsp;<INPUT TYPE="BUTTON" class="mini" VALUE="Eliminar" onClick="eliminar'.$traslados1["codg_plantel_desde"].$traslados2["codg_plantel_hacia"].'()"></TD>';
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
                <INPUT TYPE="HIDDEN" NAME="codg_plantel_desde" VALUE="<? echo $codg_insti_desde; ?>">
                <INPUT TYPE="HIDDEN" NAME="codg_plantel_hacia" VALUE="<? echo $codg_insti_hacia; ?>">
<BR>
<CENTER><INPUT class="mini" TYPE="BUTTON" VALUE="Agregar" onclick="agregar()">&nbsp;<INPUT class="mini" TYPE="BUTTON" VALUE="Actualizar" onclick="actualizar()">&nbsp;<INPUT class="mini" TYPE="BUTTON" VALUE="<< Regresar" onclick="regresar()">&nbsp;<INPUT class="mini" TYPE="BUTTON" VALUE="Siguiente >>" onclick="siguiente()">&nbsp;<INPUT class="mini" TYPE="BUTTON" VALUE="Finalizar" onclick="finalizar()"></CENTER>

</FORM>

<? if ($action == "elm")
    {
      $qry = ("DELETE FROM bdc_traslado
                           WHERE codg_per=$codg_per AND codg_plantel_desde=$codg_plantel_desde AND codg_plantel_hacia=$codg_plantel_hacia");

                       mysql_query ($qry);

               echo " <SCRIPT> ";
               echo "   alert('Registro Eliminado');";
               echo '   datos.action.value="";';
               echo "   datos.submit();";
               echo "  </SCRIPT>";
      }
?>
</HTML>
