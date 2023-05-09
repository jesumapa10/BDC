<?
  include ("../sesion.php");

  include ("../conex.php");
?>

<HTML>
<HEAD>
         <LINK REL="STYLESHEET" HREF="../style/normal.css" TYPE="text/css">

<?
  include ("tabs/tabs_per_edit.php");
?>
<SCRIPT>

function agregar()
        {
          window.open("bdc_mini_add_datos_permisos.php?codg_per=<? echo $codg_per; ?>","_blank","scrollbars=no,status=no,toolbar=no,directories=no,menubar=no,resizable=no,width=1000,height=580")
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
        location = "bdc_edit_datos_comision_servicio.php?codg_per=<? echo $codg_per; ?>";
        }

function regresar()
        {
        location = "bdc_edit_datos_familiares.php?codg_per=<? echo $codg_per; ?>";
        }

function actualizar()
        {
        datos.submit()
        }
<?
 $consulta_permisos1 = mysql_query("SELECT codg_per, tip_perm, codg_perm, fec_inicio, fec_fin, motivo FROM bdc_datos_permisos WHERE codg_per=$codg_per");

           if (mysql_num_rows($consulta_permisos1) != 0)
                {
                    while ($datos = mysql_fetch_array($consulta_permisos1))
                  {

                             echo 'function eliminar'.$datos["codg_per"].$datos["codg_perm"].$datos["tip_perm"].'()
                                   {

                                   input_box=confirm("¿Está seguro que desea Eliminar este Registro?");
                                   if (input_box==true)
                                   {
                                          datos.action.value="elm";
                                          datos.codg_per.value="'.$datos["codg_per"].'";
                                          datos.codg_perm.value="'.$datos["codg_perm"].'";
                                          datos.tip_perm.value="'.$datos["tip_perm"].'";
                                          datos.submit();
                                   }
                                   }

                                   function editar'.$codg_per.$datos["codg_perm"].$datos["tip_perm"].'()
                                   {
                                         window.open("bdc_editor_datos_permisos.php?codg_per='.$datos["codg_per"].'&codg_perm='.$datos["codg_perm"].'&tip_perm='.$datos["tip_perm"].'","_blank","scrollbars=no,status=no,toolbar=no,directories=no,menubar=no,resizable=no,width=1000,height=480")

                                   }';
                  }
                }

?>
</SCRIPT>
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
<H2>Editar Ficha de Personal</H2>

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

<SCRIPT>do_tabs("Permisos", "")</SCRIPT>

<BR>
<FORM METHOD="post" NAME="datos" action="bdc_edit_datos_permisos.php">

        <TABLE BORDER="0" ALIGN="CENTER">

              <?
                $consulta_permisos = mysql_query("SELECT p.nomb_perm, d.codg_perm, d.tip_perm, d.fec_inicio, d.fec_fin, d.motivo FROM bdc_datos_permisos d, bdc_permisos p WHERE d.codg_per=$codg_per AND d.codg_perm=p.codg_perm AND d.tip_perm=p.tip_perm ORDER BY 4 DESC");

                 if (mysql_num_rows($consulta_permisos) != 0)
                 {


                      echo '<TR>
                             <TD COLSPAN="5"><DIV ALIGN="CENTER"><P class="cabecera">Permisos</P></DIV></TD>
                             </TR>

                        <TR>
                        <TD WIDTH="200"><P ALIGN="CENTER" class="mini">Tipo de Permiso</P></TD>
                        <TD WIDTH="200"><P ALIGN="CENTER" class="mini">Permiso</P></TD>
                        <TD WIDTH="70"><P ALIGN="CENTER" class="mini">Fecha de Inicio</P></TD>
                        <TD WIDTH="70"><P ALIGN="CENTER" class="mini">Fecha Fin</P></TD>
                        <TD WIDTH="200"><P ALIGN="CENTER" class="mini">Motivo</P></TD>
                        </TR>';



                     while ($consulta = mysql_fetch_array($consulta_permisos))
                    {
                     $fec_inicio = $consulta["fec_inicio"];
                     $fec_fin = $consulta["fec_fin"];
                     $tip_perm = $consulta["tip_perm"];
                      echo '<TR>';
                     echo '<TD><P ALIGN="CENTER" class="campo">';if ($tip_perm == "1") {echo 'Remunerado';}
                                                                if ($tip_perm == "2") {echo 'No Remunerado';}
                                                                if ($tip_perm == "3") {echo 'Postestativo';}
                                                                if ($tip_perm == "4") {echo 'IPAS Estadal';}
                                                                if ($tip_perm == "5") {echo 'Licencia Sabática';}

                     echo'</P></TD>';
                     echo '<TD><P ALIGN="CENTER" class="campo">'.$consulta['nomb_perm'];echo'</P></TD>';


                            $fec_inicio = substr($fec_inicio,8,2)."-".substr($fec_inicio,5,2)."-".substr($fec_inicio,0,4);
                      echo  '<TD><P ALIGN="CENTER" class="campo">'; echo $fec_inicio; echo'</P></TD>';


                            $fec_fin = substr($fec_fin,8,2)."-".substr($fec_fin,5,2)."-".substr($fec_fin,0,4);
                     echo  '<TD><P ALIGN="CENTER" class="campo">'; echo $fec_fin; echo'</P></TD>';

                     echo  '<TD><P ALIGN="CENTER" class="campo">'.$consulta['motivo'];'</P></TD>';
                     echo '<TD><p class="mini" ALIGN="CENTER"><INPUT TYPE="BUTTON" class="mini" VALUE="Editar" onClick="editar'.$codg_per.$consulta["codg_perm"].$consulta["tip_perm"].'()">&nbsp;<INPUT TYPE="BUTTON" class="mini" VALUE="Eliminar" onClick="eliminar'.$codg_per.$consulta["codg_perm"].$consulta["tip_perm"].'()"></TD>';
                     echo '</TR>';
                     }
                      echo '<TR>
                            <TD COLSPAN="5"><HR></TD>
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
                <INPUT TYPE="HIDDEN" NAME="codg_perm" VALUE="<? echo $codg_perm; ?>">
                <INPUT TYPE="HIDDEN" NAME="tip_perm" VALUE="<? echo $tip_perm ?>">

<BR>
<CENTER><INPUT class="mini" TYPE="BUTTON" VALUE="Agregar" onclick="agregar()">&nbsp;<INPUT class="mini" TYPE="BUTTON" VALUE="Actualizar" onclick="actualizar()">&nbsp;<INPUT class="mini" TYPE="BUTTON" VALUE="<< Regresar" onclick="regresar()">&nbsp;<INPUT class="mini" TYPE="BUTTON" VALUE="Siguiente >>" onclick="siguiente()">&nbsp;<INPUT class="mini" TYPE="BUTTON" VALUE="Finalizar" onclick="finalizar()"></CENTER>

</FORM>

        <?

        if ($action == "elm")
         {
                $qry =("DELETE FROM bdc_datos_permisos WHERE codg_per=$codg_per AND codg_perm=$codg_perm AND tip_perm='$tip_perm'");

                mysql_query ($qry);

               echo " <SCRIPT> ";
               echo "   alert('Registro Eliminado');";
               echo '   datos.action.value="";';
               echo "   datos.submit();";
               echo "  </SCRIPT>";
      }
      ?>
</TABLE>

</HTML>
