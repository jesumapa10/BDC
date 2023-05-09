<?
  include ("../sesion.php");

  include ("../conex.php");
?>
<HTML>
<HEAD>
        <LINK REL="STYLESHEET" HREF="../style/normal.css" TYPE="text/css">
		<script language='javascript' src="popcalendar.js"></script>
<SCRIPT>
function buscar_institucion()  {

         datos.action.value="bus";
         datos.submit();
}
function municipio()
{
        if (document.datos.codg_mun.selectedIndex == 100) {
        datos.codg_mun.value="$codg_mun";
        }
        datos.submit();
}
function actualizar()
        {
        datos.pasada.value="1";
        datos.submit()

        }


</SCRIPT>
</HEAD>

<BR><BR>
<H2>Agregar Inasistencias</H2>

        <FORM METHOD="POST" NAME="datos" ACTION="">
        <BR>
        <TABLE BORDER=0 ALIGN=CENTER>
                <TR>
                <TD><P ALIGN="RIGHT" class="mini">Municipio:</P></TD>
                <TD COLSPAN="3"><SELECT class="campo" NAME="codg_mun" onChange="municipio()">
                <OPTION value="0">Todos</OPTION>
                <? $municipios = mysql_query("SELECT codg_mun, nomb_mun FROM bdc_municipios WHERE codg_pais=58 AND codg_est=274 ORDER BY 2");
                if (mysql_num_rows($municipios) != 0)
                  {
                    while ($municipio = mysql_fetch_array($municipios))
                    {
                     echo '<OPTION VALUE="'.$municipio["codg_mun"];
                                         echo '"';
                                         if ($codg_mun == $municipio["codg_mun"])
                                           {
                                              echo 'SELECTED';
                                           }
                                         echo '>'.$municipio["nomb_mun"];
                                         echo '</OPTION>';
                    }
                  }
                ?>
                </SELECT>                </TD>
                </TR>

                <TR>
                <TD><P ALIGN="RIGHT" class="mini">Instituto/Plantel:</P></TD>
                <TD COLSPAN="3"><SELECT class="campo" NAME="codg_insti">
                <OPTION value="0">Seleccione...</OPTION>
                <?
                if (($codg_mun != 0) && ($codg_mun != ""))
                {
                   $instituciones = mysql_query("SELECT codg_insti, nomb_insti FROM bdc_instituciones WHERE codg_pais=58 AND codg_est=274 AND codg_mun=$codg_mun ORDER BY 2");
                }
                else
                {
                   $instituciones = mysql_query("SELECT codg_insti, nomb_insti FROM bdc_instituciones where codg_pais=58 AND codg_est=274 ORDER BY 2");
                }
                if (mysql_num_rows($instituciones) != 0)
                {
                    while ($institucion = mysql_fetch_array($instituciones))
                  {
                   echo '<OPTION VALUE="'.$institucion["codg_insti"];
                                       echo '"';
                                       if ($codg_insti == $institucion["codg_insti"])
                                       {
                                          echo 'SELECTED';
                                       }
                                       echo '>'.$institucion["nomb_insti"];
                                       echo '</OPTION>';
                  }
                }
                ?>
                </SELECT></TD>
                </TR>

                <TR>
                <TD><div align="right"><span class="mini">Per&iacute;odo:</span></div></TD>
                <TD>		
				<? echo '<SELECT class="campo" NAME="mes_ina">';
				$mes_act=date('m');
				
				for($j=1;$j<13;$j++){
				echo '<OPTION value="'.$j.'"'; if ($_POST[mes_ina]) { if ($j==$_POST[mes_ina]) {echo 'selected'; } } else { if ($j==$mes_act-1){echo 'selected'; } } echo ' >'.$j.'</OPTION>';	
				}
				echo '</SELECT>'; ?>
				
				<? echo '<SELECT class="campo" NAME="ano_ina">';
				$ano_act=date('Y');
				for($j=2009;$j<$ano_act+2;$j++){
				echo '<OPTION value="'.$j.'"'; if ($_POST[ano_ina]) { if ($j==$_POST[ano_ina]) {echo 'selected'; } } else { if ($j==$ano_act){echo 'selected'; } } echo ' >'.$j.'</OPTION>';	
				}
				echo '</SELECT>'; ?>
				</TD>
                </TR>
                <TR>
                  <TD></TD>
                  <TD ALIGN="RIGHT"><input name="BUTTON" type=BUTTON class="mini" onClick="buscar_institucion()" value="Consultar"></TD>
                </TR>
        </TABLE>

        <INPUT TYPE="HIDDEN" NAME="action" VALUE="">
		<INPUT TYPE="hidden" NAME="pasada" VALUE="">

        
<?
if ($action == "bus")
{

$consulta_personal = mysql_query("SELECT d.codg_per, d.nomb_per, d.apel_per, t.desc_tip_trab, l.codg_insti FROM bdc_datos_per d, bdc_tip_trab t, bdc_datos_lab l WHERE d.codg_per=l.codg_per AND l.codg_insti=$codg_insti AND d.codg_tip_trab=t.codg_tip_trab ORDER BY 2,3");
    $i=0;
  if (mysql_num_rows($consulta_personal) != "0")
  {
  echo '<TABLE ALIGN="CENTER">
                <TR>
                <TD COLSPAN="5">
                <DIV ALIGN="CENTER"><P class="cabecera">Resultados de la B&uacute;squeda</P></DIV>
                </TD>
                </TR>

                <TR>
                <TD WIDTH="80"><p class="mini" ALIGN="CENTER">C&eacute;dula</P></TD>
                <TD WIDTH="150"><p class="mini" ALIGN="CENTER">Nombre(s)</P></TD>
                <TD WIDTH="150"><p class="mini" ALIGN="CENTER">Apellido(s)</P></TD>
                <TD WIDTH="100"><p class="mini" ALIGN="CENTER">Tipo de Trabajador</P></TD>
				<TD WIDTH="100"><p class="mini" ALIGN="CENTER">Días de Inasistencia</P></TD>
                </TR>';

     
          while ($resultados_consulta = mysql_fetch_array($consulta_personal))
          {
          echo '<TR>';
		  echo '<INPUT TYPE="HIDDEN" NAME="codg_insti'.$i.'" VALUE="'.$resultados_consulta["codg_insti"].'">';
		  echo '<INPUT TYPE="HIDDEN" NAME="codg_per'.$i.'" VALUE="'.$resultados_consulta["codg_per"].'">';
          echo '<TD><P class="campo" ALIGN="CENTER">'.$resultados_consulta["codg_per"]; echo '</P></TD>';
          echo '<TD><P class="campo" ALIGN="CENTER">'.$resultados_consulta["nomb_per"]; echo '</P></TD>';
          echo '<TD><P class="campo" ALIGN="CENTER">'.$resultados_consulta["apel_per"]; echo '</P></TD>';
          echo '<TD><P class="campo" ALIGN="CENTER">'.$resultados_consulta["desc_tip_trab"]; echo '</P></TD>';
		  echo '<TD><P class="campo" ALIGN="CENTER">';
		  
		 $consulta_ina = mysql_query("Select * from bdc_inasistencias WHERE codg_per=".$resultados_consulta['codg_per']." AND codg_insti=".$resultados_consulta['codg_insti']." AND mes_ina=$mes_ina AND ano_ina=$ano_ina");
		 
		 
		 if ($reg = mysql_fetch_array($consulta_ina))
		 { echo $reg["num_ins"]; }
		 else
		 {
				echo '<SELECT class="campo" NAME="num_ina'.$i.'">
                ';
				for($j=0;$j<24;$j++){
				echo '<OPTION value="'.$j.'" >'.$j.'</OPTION>';	
				}
				echo '</SELECT>';
		  }
				
				
				echo' </TD></P>';
		  $i++;
          echo '</TR>';
          }
			echo '<TR><TD></TD></TR>';		  
          
          echo '<TR>';
          echo '<TD COLSPAN="5"><HR WIDTH="90%"><BR><CENTER><INPUT class="mini" TYPE="BUTTON" VALUE="Agregar" onClick="actualizar()">&nbsp;</CENTER></TD>';
          echo '</TR>';
  echo '</TABLE>';
  }
        if (mysql_num_rows($consulta_personal) == "0")
           {
                  echo '<CENTER><P><B class="rojo">Error:</B> No existen Registros</CENTER>';
           }
}

?>
<INPUT TYPE="hidden" NAME="n" VALUE="<? echo $i;?>">
</FORM> 
<? 
if ($pasada == "1")
{ 
   $fec_inicio_ins = substr($fec_inicio_ins,6,4)."-".substr($fec_inicio_ins,3,2)."-".substr($fec_inicio_ins,0,2);

  for($i=0;$i<$n;$i++)
  {
     $num_ina=$_POST['num_ina'.$i];
	 $codg_insti=$_POST['codg_insti'.$i]; 
	 $codg_per=$_POST['codg_per'.$i];
	 
	 if ($num_ina!=0){
	    $qry = "INSERT INTO bdc_inasistencias VALUES( ".$codg_per.", ".$codg_insti.",
                         $mes_ina, $ano_ina, ".$num_ina.")";
         mysql_query ($qry);	 
	 }
  }
   echo '<SCRIPT>alert("Datos Actualizados");</SCRIPT>';
}   
?>

</HTML>
