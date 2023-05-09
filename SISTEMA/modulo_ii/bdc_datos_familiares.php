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
                <TD WIDTH="900"><DIV ALIGN="center"><P class="cabecera">Datos Familiares</P></DIV></TD>
                </TR>
  </TABLE>

              
                     <?
                        $consulta_familiares = mysql_query("SELECT codg_carga_fam, apel_carga_fam, nomb_carga_fam, fec_nac_carga_fam,
                                         sexo_carga_fam, paren_carga_fam, estudia_carga_fam, nivel_est_carga_fam
                                         FROM bdc_carga_fam
                                         WHERE codg_per=$codg_per");
               if (mysql_num_rows($consulta_familiares) != 0)
                   {
				    echo '<TABLE BORDER="0" ALIGN="CENTER">';
					 echo '<TR>
                   <TD WIDTH="70"><P ALIGN="CENTER" class="mini">C&eacute;dula</P></TD>

                   <TD WIDTH="70"><P ALIGN="CENTER" class="mini">Nombres</P></TD>

                   <TD WIDTH="70"><P ALIGN="CENTER" class="mini">Apellidos</P></TD>

                   <TD WIDTH="70"><P ALIGN="CENTER" class="mini">Fecha de<BR>Nacimiento</P></TD>

                   <TD WIDTH="70"><P ALIGN="CENTER" class="mini">Parentesco</P></TD>

                   <TD WIDTH="70"><P ALIGN="CENTER" class="mini">Sexo</P></TD>

                   <TD WIDTH="70"><P ALIGN="CENTER" class="mini">¿Estudia?</P></TD>

                   <TD WIDTH="70"><P ALIGN="CENTER" class="mini">Nivel de Instrucci&oacute;n</P></TD>

                  </TR>';	
                         echo $fec_nac_carga_fam;
                 while ($consulta = mysql_fetch_array($consulta_familiares))
                   {

                $fec_nac_carga_fam = $consulta['fec_nac_carga_fam'];
                echo '<TR>';
                echo '<TD><P ALIGN="CENTER" class="campo">'.$consulta['codg_carga_fam']; echo'</P></TD>';
                echo '<TD><P class="campo">'.$consulta['nomb_carga_fam']; echo'</P></TD>';
                echo '<TD><P class="campo">'.$consulta['apel_carga_fam']; echo'</P></TD>';
                $fec_nac_carga_fam = substr($fec_nac_carga_fam,8,2)."-".substr($fec_nac_carga_fam,5,2)."-".substr($fec_nac_carga_fam,0,4);
                echo '<TD><P ALIGN="CENTER" class="campo">'.$fec_nac_carga_fam; echo'</P></TD>';
                echo '<TD><P ALIGN="CENTER" class="campo">';if($consulta['sexo_carga_fam']=="M"){echo "Masculino";}
                                                            if($consulta['sexo_carga_fam']=="F"){echo "Femenino";}
                                                            echo'</P></TD>';
                echo '<TD><P ALIGN="CENTER" class="campo">';if($consulta['paren_carga_fam']=="C"){echo "Cónyugue";}
                                                            if($consulta['paren_carga_fam']=="P"){echo "Padre";}
                                                            if($consulta['paren_carga_fam']=="M"){echo "Madre";}
                                                            if($consulta['paren_carga_fam']=="H"){echo "Hijo";}
                                                            echo'</P></TD>';
                echo '<TD><P ALIGN="CENTER" class="campo">';if($consulta['estudia_carga_fam']=="S"){echo "Si";}
                                                           if($consulta['estudia_carga_fam']=="N"){echo "No";}
                                                           echo'</P></TD>';
                echo '<TD><P ALIGN="CENTER" class="campo">';if($consulta['nivel_est_carga_fam']=="B"){echo "Bachillerato";}
                                                           if($consulta['nivel_est_carga_fam']=="M"){echo "Media";}
                                                           if($consulta['nivel_est_carga_fam']=="P"){echo "Primaria";}
                                                           if($consulta['nivel_est_carga_fam']=="U"){echo "Universitaria";}
                                                           if($consulta['nivel_est_carga_fam']=="A"){echo "A";}
                                                           if($consulta['nivel_est_carga_fam']=="E"){echo "E";}
                                                           echo'</P></TD>';

                echo'</TR>';
                }
               }
                   else
                     {
                       echo '<CENTER><P><B class="rojo">No Posee Registros</B></CENTER>';
                     }

            ?>

</HTML>
