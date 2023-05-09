<?
  include ("../sesion.php");

  include ("../conex.php");
?>

<HTML>
<HEAD>
         <LINK REL="STYLESHEET" HREF="../style/normal.css" TYPE="text/css">
<SCRIPT>
<?
 $consulta_archivos = mysql_query("SELECT codg_per, codg_tip_documento FROM bdc_archivos WHERE codg_per=$codg_per");

           if (mysql_num_rows($consulta_archivos) != 0)
                {
                    while ($datos = mysql_fetch_array($consulta_archivos))
                  {

                             echo'function ver'.$codg_per.$datos["codg_tip_documento"].'()
                                   {
                                         window.open("bdc_visual_archivos_digitales.php?codg_per='.$codg_per.'&codg_tip_documento='.$codg_tip_documento.'","_blank","scrollbars=no,status=no,toolbar=no,directories=no,menubar=no,resizable=no,width=1000,height=480")

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

        <TABLE BORDER="0" ALIGN="CENTER">
                <TR>
                <TD WIDTH="900"><DIV ALIGN="CENTER"><P class="cabecera">Archivos Digitales</P></DIV></TD>
                </TR>
		</TABLE>
              
                        <?
                          $consulta_archivos = mysql_query("SELECT a.imgn_arc_dig, a.fec_arc_dig, a.codg_tip_documento, d.desc_tip_documento
                                         FROM bdc_archivos a, bdc_tip_documento d
                                         WHERE a.codg_per=$codg_per AND a.codg_tip_documento=d.codg_tip_documento ORDER BY 3, 2");
       				 
                           if (mysql_num_rows($consulta_archivos) != 0)
                          {
						   echo'<TABLE BORDER="0" ALIGN="CENTER">
			  <TR>
                <TD WIDTH="200"><P ALIGN="CENTER" class="mini">Tipo de Documento</P></TD>
                <TD WIDTH="200"><P ALIGN="CENTER" class="mini">Fecha del Documento</P></TD>
                </TR>

                <TR>
                <TD COLSPAN="3"><HR></TD>
                </TR>';
		
                            while ($consulta = mysql_fetch_array($consulta_archivos))
                           {

                             $fec_arc_dig = $consulta["fec_arc_dig"];
                             $codg_tip_documento = $consulta["codg_tip_documento"];
                             echo '<TR>';
                             echo '<TD><P class="campo">'.$consulta['desc_tip_documento'];echo'</P></TD>';
                             $fec_arc_dig = substr($fec_arc_dig,8,2)."-".substr($fec_arc_dig,5,2)."-".substr($fec_arc_dig,0,4);
                             echo '<TD><P class="campo" ALIGN="CENTER">'.$fec_arc_dig.'</P></TD>';
                             echo '<TD><P class="descripcion">';
                          //   echo '<A HREF="bdc_visual_archivos_digitales.php?codg_per='.$codg_per.'&codg_tip_documento='.$codg_tip_documento.'">Ver Documento</A></TD>';
                            // echo '<TD><p class="mini" ALIGN="CENTER"><INPUT TYPE="BUTTON" class="mini" VALUE="Ver Documento" onClick="ver'.$codg_per.$consulta["codg_tip_documento"].'()"></P></TD>';

                             echo '</TR>';
                           }
                          }
                          else
                          {
                           echo '<CENTER><P><B class="rojo">No Posee Registros</B></CENTER>';
                          }
                        ?>



               


</HTML>
