<?
  include ("../sesion.php");

  include ("../conex.php");
  include ("bdc_mini_add_movimientos.php");
?>
<HTML>
<HEAD>
<TITLE>Agregar Traslado</TITLE>
        <LINK REL="STYLESHEET" HREF="../style/normal.css" TYPE="text/css">

        <SCRIPT LANGUAGE="JavaScript" SRC="../scripts/validar.js" TYPE="text/javascript"></SCRIPT>
<script language='javascript' src="popcalendar.js"></script>
<SCRIPT>
function municipio1()
{
        if (document.datos.codg_mun1.selectedIndex == 100) {
        datos.codg_mun1.value="$codg_mun1";
        }
        datos.submit();
}

function municipio2()
{
        if (document.datos.codg_mun2.selectedIndex == 100) {
        datos.codg_mun2.value="$codg_mun2";
        }
        datos.submit();
}

function tipo()
{
        if (document.datos.codg_plantel_desde.selectedIndex == 100) {
        datos.codg_plantel_desde.value="$codg_mun2";
        }
        datos.submit();
}

function jerarquia()
{
        if (document.datos.codg_cat_cargo.selectedIndex == 100) {
        datos.codg_cat_cargo.value="$codg_cat_cargo";
        }
        datos.submit();
}

function actualizar()
{
        datos.submit();
}

function ingresar()
{
        datos.action.value="ins";
}
function cerrar()

{
         window.close()
}
</SCRIPT>

<SCRIPT LANGUAGE="JavaScript" SRC="../scripts/calendario.js" TYPE="text/javascript"></SCRIPT>

<SCRIPT LANGUAGE="JavaScript" SRC="../scripts/cal-barra.js" TYPE="text/javascript"></SCRIPT>

<SCRIPT LANGUAGE="JavaScript">
        var c1 = new CodeThatCalendar(caldef1);
</SCRIPT>

</HEAD>

<BODY>

<BR>
<BR>
<H2>Agregar Traslado</H2>
<?
   $consulta_datos_per=mysql_query("SELECT d.apel_per, d.nomb_per, d.naci_per, t.desc_tip_trab, d.codg_tip_trab FROM bdc_datos_per d, bdc_tip_trab t WHERE d.codg_per=$codg_per AND d.codg_tip_trab=t.codg_tip_trab");

                $datos = mysql_fetch_array($consulta_datos_per);
                $apel_per = $datos["apel_per"];
                $nomb_per = $datos["nomb_per"];
                $naci_per = $datos["naci_per"];
                $desc_tip_trab = $datos["desc_tip_trab"];
                $codg_tip_trab = $datos["codg_tip_trab"];
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

<FORM METHOD="post" NAME="datos" action="">

        <TABLE BORDER="0" ALIGN="CENTER">
                <TR>
                <TD COLSPAN="2">
                <DIV ALIGN="CENTER"><P class="cabecera">Traslados</P></DIV>
                </TD>
                </TR>

                <TR>
                <TD><P ALIGN="RIGHT" class="mini">Municipio de Origen:</P></TD>
                <TD COLSPAN="3"><SELECT class="campo" NAME="codg_mun1" onChange="municipio1()">
                <OPTION value="0">Seleccione...</OPTION>
                <?
                $municipios_origen = mysql_query("SELECT codg_mun, nomb_mun FROM bdc_municipios WHERE codg_pais=58 and codg_est=274 ORDER BY 2");
                   if (mysql_num_rows($municipios_origen) != 0)
                   {
                       while ($municipio_origen = mysql_fetch_array($municipios_origen))
                     {
                       echo '<OPTION VALUE="'.$municipio_origen["codg_mun"];
                                           echo '"';
                                           if ($codg_mun1 == $municipio_origen["codg_mun"])
                                           {
                                              echo 'SELECTED';
                                           }
                                           echo '>'.$municipio_origen["nomb_mun"];
                                           echo '</OPTION>';
                     }
                   }

                 ?>
                </SELECT>
                </TD>
                </TR>


                <TR>
                <TD><P ALIGN="RIGHT" class="mini">Plantel de Origen:</P></TD>
                <TD><SELECT class="campo" NAME="codg_plantel_desde" onChange="tipo()">
                <OPTION value="0">Seleccione...</OPTION>
                 <?
                if (($codg_mun1 != 0) && ($codg_mun1 != ""))
                {
                   $instituciones_origen = mysql_query("SELECT codg_insti, nomb_insti FROM bdc_instituciones WHERE codg_pais=58 AND codg_est=274 AND codg_mun=$codg_mun1 ORDER BY 2");
                }
                else
                {
                   $instituciones_origen = mysql_query("SELECT codg_insti, nomb_insti FROM bdc_instituciones where codg_pais=58 AND codg_est=274 ORDER BY 2");
                }
                if (mysql_num_rows($instituciones_origen) != 0)
                {
                    while ($institucion_origen = mysql_fetch_array($instituciones_origen))
                  {
                   echo '<OPTION VALUE="'.$institucion_origen["codg_insti"];
                                       echo '"';
                                       if ($codg_plantel_desde == $institucion_origen["codg_insti"])
                                       {
                                          echo 'SELECTED';
                                       }
                                       echo '>'.$institucion_origen["nomb_insti"];
                                       echo '</OPTION>';
                 }
                }
               ?>
                </SELECT>
                </TD>
                </TR>

                 <TR>
                  <TD><P ALIGN="RIGHT" class="mini">Fecha de Egreso del Plantel de Origen:</P></TD>
                  <TD><input type="TEXT" name="fec_egr" class="campo" value="<? echo $fec_egr; ?>" maxlength="10" size="10" id="fec_egr" onClick="popUpCalendar(this, datos.fec_egr, 'dd-mm-yyyy');" readonly>
          <img onClick="popUpCalendar(this, datos.fec_egr, 'dd-mm-yyyy');" src="../images/cal.gif" alt="Haz Click para Buscar la Fecha" width="16" heught="16" border="0">
                  </TD>
                </TR>

                <TR>
                <TD><P ALIGN="RIGHT" class="mini">Municipio de Destino:</P></TD>
                <TD COLSPAN="3"><SELECT class="campo" NAME="codg_mun2" onChange="municipio2()">
                <OPTION value="0">Seleccione...</OPTION>
                <?
                $municipios_destino = mysql_query("SELECT codg_mun, nomb_mun FROM bdc_municipios WHERE codg_pais=58 AND codg_est=274 ORDER BY 2");
                   if (mysql_num_rows($municipios_destino) != 0)
                   {
                       while ($municipio_destino = mysql_fetch_array($municipios_destino))
                     {
                       echo '<OPTION VALUE="'.$municipio_destino["codg_mun"];
                                           echo '"';
                                           if ($codg_mun2 == $municipio_destino["codg_mun"])
                                           {
                                              echo 'SELECTED';
                                           }
                                           echo '>'.$municipio_destino["nomb_mun"];
                                           echo '</OPTION>';
                     }
                   }
                 ?>
                </SELECT>
                </TD>
                </TR>

                <TR>
                <TD><P ALIGN="RIGHT" class="mini">Plantel de Destino:</P></TD>
                <TD><SELECT class="campo" NAME="codg_plantel_hacia" onChange="actualizar()">
                <OPTION value="0">Seleccione...</OPTION>
                <?
                if (($codg_mun2 != 0) && ($codg_mun2 != ""))
                {
                   $instituciones_destino = mysql_query("SELECT codg_insti, nomb_insti FROM bdc_instituciones WHERE codg_pais=58 AND codg_est=274 AND codg_mun=$codg_mun2 ORDER BY 2");
                }
                else
                {
                   $instituciones_destino = mysql_query("SELECT codg_insti, nomb_insti FROM bdc_instituciones where codg_pais=58 AND codg_est=274 ORDER BY 2");
                }
                if (mysql_num_rows($instituciones_destino) != 0)
                {
                    while ($institucion_destino = mysql_fetch_array($instituciones_destino))
                  {
                   echo '<OPTION VALUE="'.$institucion_destino["codg_insti"];
                                       echo '"';
                                       if ($codg_plantel_hacia == $institucion_destino["codg_insti"])
                                       {
                                          echo 'SELECTED';
                                       }
                                       echo '>'.$institucion_destino["nomb_insti"];
                                       echo '</OPTION>';

                 }
                }
               ?>
                </SELECT>
                </TD>
                </TR>

                <TR>
                  <TD><P ALIGN="RIGHT" class="mini">Fecha de Ingreso al Plantel de Destino:</P></TD>
                  <TD><input type="TEXT" name="fec_ing" class="campo" value="<? echo $fec_ing; ?>" maxlength="10" size="10" id="fec_ing" onClick="popUpCalendar(this, datos.fec_ing, 'dd-mm-yyyy');" readonly>
          <img onClick="popUpCalendar(this, datos.fec_ing, 'dd-mm-yyyy');" src="../images/cal.gif" alt="Haz Click para Buscar la Fecha" width="16" heught="16" border="0">
                  </TD>
                </TR>
               <?

                if (($codg_plantel_hacia != 0) && ($codg_plantel_hacia != ""))
                    {
                          $consulta_tipo_insti = mysql_query("SELECT codg_tip_insti FROM bdc_instituciones WHERE codg_insti=$codg_plantel_hacia");
                          if (mysql_num_rows($consulta_tipo_insti) != 0)
                          {
                            $tipo = mysql_fetch_array($consulta_tipo_insti);
                            $codg_tipo_insti_new = $tipo["codg_tip_insti"];
                          }

                                        if (($codg_tipo_insti_new == 1) && ($codg_tip_trab == "D"))
                                        {
                                        echo '<TR>
                                                  <TD><P ALIGN="RIGHT" class="mini">Categor&iacute;a del Cargo al Plantel de Destino:</P></TD>
                                                  <TD COLSPAN="3"><SELECT class="campo" NAME="codg_cat_cargo" onChange="jerarquia()">
                                                  <OPTION value="0">Seleccione...</OPTION>';
                         $categorias = mysql_query("SELECT codg_cat_cargo, desc_cat_cargo FROM bdc_cat_cargo ORDER BY 2");
                         if (mysql_num_rows($categorias) != 0)
                                        {
                                            while ($categoria = mysql_fetch_array($categorias))
                                          {
                                     echo '<OPTION VALUE="'.$categoria["codg_cat_cargo"];
                                     echo '"';
                                       if ($codg_cat_cargo == $categoria["codg_cat_cargo"])
                                       {
                                          echo 'SELECTED';
                                       }
                                       echo '>'.$categoria["desc_cat_cargo"];
                                       echo '</OPTION>';
                                  }
                          }
                            echo '</SELECT>
                                                 </TD>
                                          </TR>';

                                        echo  '<TR>
                                              <TD><P ALIGN="RIGHT" class="mini">Jerarqu&iacute;a del Cargo al Plantel de Destino:</P></TD>
                                              <TD COLSPAN="3"><SELECT class="campo" NAME="codg_jer_cargo">
                                              <OPTION value="0">Seleccione...</OPTION>';
                                                   $jerrarquias = mysql_query("SELECT codg_jer_cargo, desc_jer_cargo FROM bdc_jer_cargo WHERE codg_cat_cargo=$codg_cat_cargo");
                                  if (mysql_num_rows($jerrarquias) != 0)
                                                {
                                            while ($jerrarquia = mysql_fetch_array($jerrarquias))
                                                  {
                                               echo '<OPTION VALUE="'.$jerrarquia["codg_jer_cargo"];
                                       echo '"';
                                       if ($codg_jer_cargo == $jerrarquia["codg_jer_cargo"])
                                       {
                                          echo 'SELECTED';
                                       }
                                       echo '>'.$jerrarquia["desc_jer_cargo"];
                                       echo '</OPTION>';
                                   }
                               }
                                         echo '</SELECT>
                                                   </TD>
                                       </TR>';


                                                  echo        '<TR>
                                                                <TD><P ALIGN="RIGHT" class="mini">Jerarqu&iacute;a en el Plantel de Destino:</P></TD>
                                                                <TD COLSPAN="3"><SELECT class="campo" NAME="codg_cargo">
                                                                <OPTION value="0">Seleccione...</OPTION>';
                                                                $jerrarquias_plant = mysql_query("SELECT codg_jer_plantel, desc_jer_plantel FROM bdc_jer_plantel ORDER BY 2");
                                                if (mysql_num_rows($jerrarquias_plant) != 0)
                                                   {
                                                    while ($jerrarquia_plant = mysql_fetch_array($jerrarquias_plant))
                                                             {
                                                                   echo '<OPTION VALUE="'.$jerrarquia_plant["codg_jer_plantel"];
                                                                   echo '"';
                                                                   if ($codg_cargo == $jerrarquia_plant["codg_jer_plantel"])
                                                                     {
                                                                       echo 'SELECTED';
                                                                     }
                                                                     echo '>'.$jerrarquia_plant["desc_jer_plantel"];
                                                                     echo '</OPTION>';
                                                              }
                                                   }
                                                   echo'</SELECT>
                                                         </TD>
                                                         </TR>';
                                          }
                                       }
       ?>

               <TR>
                <TD><P ALIGN="RIGHT" class="mini">Tipo de Traslado:</P></TD>
                <TD><SELECT class="campo" NAME="codg_tip_traslado">
                <OPTION value="0">Seleccione...</OPTION>
                <?

                   $tipo_traslado = mysql_query("SELECT codg_tip_traslado, desc_tip_traslado FROM bdc_tip_traslado ORDER BY 2");

                if (mysql_num_rows($tipo_traslado) != 0)
                {
                    while ($tipo_traslado1 = mysql_fetch_array($tipo_traslado))
                  {
                   echo '<OPTION VALUE="'.$tipo_traslado1["codg_tip_traslado"];
                                       echo '"';
                                       if ($codg_tip_traslado == $tipo_traslado1["codg_tip_traslado"])
                                       {
                                          echo 'SELECTED';
                                       }
                                       echo '>'.$tipo_traslado1["desc_tip_traslado"];
                                       echo '</OPTION>';

                 }
                }
               ?>
                </SELECT>
                </TD>
                </TR>

                <TR>
                <TD><P ALIGN="RIGHT" class="mini">Observación:</P></TD>
                <TD><P class="campo"><TEXTAREA class="campo" ROWS="5" COLS="100" NAME="obser_trasl" MAXLENGTH="250" SIZE="1" VALUE="<? echo $obser_trasl; ?>" ><? echo $obser_trasl; ?></TEXTAREA></P></TD>
                </TR>

                <TR>
                <TD COLSPAN="2"><HR></TD>
                </TR>

        </TABLE>

<CENTER><INPUT class="mini" TYPE="SUBMIT" VALUE="Agregar" onClick="ingresar()">&nbsp;<INPUT class="mini" TYPE="BUTTON" VALUE="Cerrar Ventana" onClick="cerrar()"></CENTER>

<INPUT TYPE="hidden" NAME="action" VALUE="">
<INPUT TYPE="hidden" NAME="codg_per" VALUE="<? echo $codg_per; ?>">
</FORM>

<?
if ($action == "ins")
{
   $fec_egr = substr($fec_egr,6,4)."-".substr($fec_egr,3,2)."-".substr($fec_egr,0,2);
   $fec_ing = substr($fec_ing,6,4)."-".substr($fec_ing,3,2)."-".substr($fec_ing,0,2);

   if (($codg_cat_cargo == "0") || ($codg_cat_cargo == "")){$codg_cat_cargo = "NULL";}
   if (($codg_jer_cargo == "0") || ($codg_jer_cargo == "")){$codg_jer_cargo = "NULL";}
   if ($codg_cargo == ""){$codg_cargo = "NULL";} else {$codg_cargo = "$codg_cargo";}
   if (($codg_tip_traslado == "0") || ($codg_tip_traslado == "")){$codg_tip_traslado = "NULL";}
   if ($obser_trasl == ""){$obser_trasl = "NULL";} else {$obser_trasl = "$obser_trasl";}

		guardar_mov($codg_per,$codg_tip_mov);
   		$codg_mov=gen_codg_mov();
		
	
$qry = "INSERT INTO bdc_traslado VALUES ($codg_per, $codg_plantel_desde,                         $codg_plantel_hacia, '$fec_egr', '$fec_ing', $codg_cat_cargo, $codg_jer_cargo, '$codg_cargo', $codg_tip_traslado, '$obser_trasl', $codg_mov)";
 mysql_query ($qry);
  
$qry=("UPDATE bdc_datos_lab SET codg_insti=$codg_plantel_hacia,
                         codg_cat_cargo=$codg_cat_cargo, codg_jer_cargo=$codg_jer_cargo,
                         codg_jer_plantel=$codg_cargo, fec_ingp_lab='$fec_ing'
                         WHERE codg_per=$codg_per AND codg_insti=$codg_plantel_desde");

 mysql_query($qry);
 
    echo '<SCRIPT>alert("Datos Agregados");</SCRIPT>';
	echo "<SCRIPT>window.opener.parent.DATA.actualizar();</SCRIPT>"; 
}

                $consulta_traslados_desde = mysql_query("SELECT t.codg_plantel_desde, t.codg_plantel_hacia, i.nomb_insti FROM bdc_traslado t, bdc_instituciones i WHERE t.codg_per=$codg_per AND i.codg_insti=t.codg_plantel_desde");

                 $consulta_traslados_hacia = mysql_query("SELECT t.codg_plantel_desde, t.codg_plantel_hacia, i.nomb_insti FROM bdc_traslado t, bdc_instituciones i WHERE t.codg_per=$codg_per AND i.codg_insti=t.codg_plantel_hacia");
				 
            if ((mysql_num_rows($consulta_traslados_desde) != 0) || (mysql_num_rows($consulta_traslados_hacia) != 0))
             {

                echo '<TABLE BORDER="0" ALIGN="CENTER">';
                echo '<TR>';
                echo '<TD COLSPAN="2" WIDTH="580">';
                echo '<DIV ALIGN="CENTER"><P class="cabecera">Traslados Registrados</P></DIV>';
                echo '</TD>';
                echo '</TR>';

                  echo '<TR>';
                  echo '<TD WIDTH="290"><P ALIGN="CENTER" class="mini">Plantel de Origen</P></TD>';
                  echo '<TD WIDTH="290"><P ALIGN="CENTER" class="mini">Plantel de Destino</P></TD>';
                  echo '</TR>';


                     while (($traslados1 = mysql_fetch_array($consulta_traslados_desde)) && ($traslados2 = mysql_fetch_array($consulta_traslados_hacia)))
                     {

                     echo '<TR>';
                         echo '<TD><P ALIGN="CENTER" class="campo">'.$traslados1['nomb_insti'];'</P></TD>';
                         echo '<TD><P ALIGN="CENTER" class="campo">'.$traslados2['nomb_insti'];'</P></TD>';
                     echo '</TR>';

                     }
                    echo '</TABLE>';

              }
          else
              {
             echo '<CENTER><P><B class="rojo">No Posee Registros</B></CENTER>';
              }


?>
<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">

  var frmvalidator  = new Validator("datos");

  frmvalidator.addValidation("codg_plantel_desde","dontselect=0","Seleccione una Institución de Origen");

  frmvalidator.addValidation("fec_egr","req","Seleccione la Fecha de Egreso");

  frmvalidator.addValidation("codg_plantel_hacia","dontselect=0","Seleccione una Institución de Destino");

  frmvalidator.addValidation("fec_ing","req","Seleccione la Fecha de Ingreso");

//  frmvalidator.setAddnlValidationFunction("actualizar");

</SCRIPT>



</BODY>
</HTML>

