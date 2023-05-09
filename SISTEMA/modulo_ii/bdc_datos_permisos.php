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

<SCRIPT>do_tabs("Permisos", "")</SCRIPT>

<BR>

        <TABLE BORDER="0" ALIGN="CENTER">

              <?
                $consulta_permisos = mysql_query("SELECT p.nomb_perm, p.tip_perm, d.codg_perm, d.fec_inicio, d.fec_fin, d.motivo FROM bdc_datos_permisos d, bdc_permisos p WHERE d.codg_per=$codg_per AND d.codg_perm=p.codg_perm ORDER BY 4 DESC");

                 if (mysql_num_rows($consulta_permisos) != 0)
                 {


                      echo '<TR>
                             <TD COLSPAN="5"><DIV ALIGN="CENTER"><P class="cabecera">Permisos</P></DIV></TD>
                             </TR>

                        <TR>
                        <TD WIDTH="200"><P ALIGN="CENTER" class="mini">Tipo de Permiso</P></TD>
                        <TD WIDTH="200"><P ALIGN="CENTER" class="mini">Permiso</P></TD>
                        <TD WIDTH="200"><P ALIGN="CENTER" class="mini">Fecha de Inicio</P></TD>
                        <TD WIDTH="200"><P ALIGN="CENTER" class="mini">Fecha Fin</P></TD>
                        <TD WIDTH="200"><P ALIGN="CENTER" class="mini">Motivo</P></TD>
                        </TR>';

                      echo '<TR>
                            <TD COLSPAN="5"><HR></TD>
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

                     echo '</TR>';
                     }
                     echo '</TABLE>';
                  }
                   else
                    {
                      echo '<CENTER><P><B class="rojo">No Posee Registros</B></CENTER>';
                    }
            ?>

</TABLE>

</HTML>
