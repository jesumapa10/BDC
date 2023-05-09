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

        <TABLE BORDER="0" ALIGN="CENTER">
                <TR>
               <TD WIDTH="900"><DIV ALIGN="center"><P class="cabecera">Datos Academicos</P></DIV></TD>
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
                  <?  if ($codg_niv_inst!=NULL)
		      {
		      $consulta = mysql_query("SELECT codg_niv_inst, desc_niv_inst FROM bdc_niv_inst WHERE codg_niv_inst=$codg_niv_inst ORDER BY 2");
                      if (mysql_num_rows($consulta) != 0)
                              {
				  $datos = mysql_fetch_array($consulta);
				  echo $datos["desc_niv_inst"];
                               }
                      }
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
   					if (mysql_num_rows($carreras) != 0)
        	                         {
					 $datos = mysql_fetch_array($carreras);
					 echo $datos["desc_car"];
					 }
				     }
				  ?>				 
		 </TD>
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
		</TR>
		 <TR>
                <TD COLSPAN="3"><HR></TD>
                </TR>
	 </TABLE>
<?
		    }
          }
         else
           {
            echo '<CENTER><P><B class="rojo">No Posee Registros</B></P></CENTER>';
            }
        ?>


</HTML>
