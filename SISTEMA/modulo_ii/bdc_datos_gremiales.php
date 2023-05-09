<?
  include ("../sesion.php");

  include ("../conex.php");
?>

<HTML>
<HEAD>
         <LINK REL="STYLESHEET" HREF="../style/normal.css" TYPE="text/css">
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


         <TABLE BORDER="0" ALIGN="center">
    <TR>
      <TD WIDTH="900"><DIV ALIGN="center">
        <P class="cabecera">Datos Gremiales </P>
      </DIV></TD>
    </TR>
	
	</TABLE>
    
                       <?
                          $consulta_datos_gremiales = mysql_query ("SELECT g.nomb_grem, d.fec_dgrem
                                         FROM bdc_gremios g, bdc_datos_grem d
                                         WHERE d.codg_per=$codg_per AND d.codg_grem=g.codg_grem");

                          if (mysql_num_rows($consulta_datos_gremiales) != 0)
                          {
                            while ($datos_grem = mysql_fetch_array($consulta_datos_gremiales))
                            {
                echo'<TABLE BORDER="0" ALIGN="CENTER">
                <TR>
                <TD WIDTH="200"><P ALIGN="CENTER" class="mini">Nombre de la Aosicaci&oacute;n</P></TD>
                <TD WIDTH="200"><P ALIGN="CENTER" class="mini">Fecha de Afiliación</P></TD>
                </TR>

                <TR>
                <TD COLSPAN="3"><HR></TD>
                </TR>';

							   $fec_dgrem = $datos_grem["fec_dgrem"];
                               echo '<TR>
                               <TD><P ALIGN="CENTER" class="campo">'.$datos_grem['nomb_grem']; echo '</P></TD>';
                               $fec_dgrem = substr($fec_dgrem,8,2)."-".substr($fec_dgrem,5,2)."-".substr($fec_dgrem,0,4);
                               echo'<TD><P ALIGN="CENTER" class="campo">';echo $fec_dgrem; echo '</P></TD>';
                               echo '</TR>';

                            }
                          }
                         else
                          {
                            echo '<CENTER><P><B class="rojo">No Posee Registros</B></CENTER>';
                          }
			
			
                       ?>


</HTML>
