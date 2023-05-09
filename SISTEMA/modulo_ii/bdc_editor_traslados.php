<?
  include ("../sesion.php");
  include ("../conex.php");
	$codg_per=$_GET['codg_per'];
	$codg_mov=$_GET['codg_mov'];
?>
<HTML>
<HEAD>
<TITLE>Editar Traslado</TITLE>
        <LINK REL="STYLESHEET" HREF="../style/normal.css" TYPE="text/css">

        <SCRIPT LANGUAGE="JavaScript" SRC="../scripts/validar.js" TYPE="text/javascript"></SCRIPT>

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


function jerarquia()
{
        if (document.datos.codg_cat_cargo.selectedIndex == 100) {
        datos.codg_cat_cargo.value="$codg_cat_cargo";
        }
        datos.submit();
}
function actualizar()
        {
        datos.action.value="ins";
        datos.pasada.value="1";
        datos.submit()

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


<BR>
<H2>Editar Traslado</H2>

<?

   if ($pasada != 1)
    {

        $consulta_traslados = mysql_query("SELECT codg_plantel_desde, codg_plantel_hacia, fec_ing, fec_egr,
                         codg_cat_cargo, codg_jer_cargo, codg_cargo, codg_tip_traslado, obser_trasl
                         FROM bdc_traslado
                         WHERE codg_per=$codg_per AND codg_mov=$codg_mov");
         $traslado = mysql_fetch_array($consulta_traslados);

         $codg_plantel_desde = $traslado["codg_plantel_desde"];
         $codg_plantel_hacia = $traslado["codg_plantel_hacia"];
         $fec_ing = $traslado["fec_ing"];
         $fec_egr = $traslado["fec_egr"];
         $codg_cat_cargo = $traslado["codg_cat_cargo"];
         $codg_jer_cargo = $traslado["codg_jer_cargo"];
         $codg_cargo = $traslado["codg_cargo"];
         $codg_tip_traslado = $traslado["codg_tip_traslado"];
         $obser_trasl = $traslado["obser_trasl"];
         $fec_egr = substr($fec_egr,8,2)."-".substr($fec_egr,5,2)."-".substr($fec_egr,0,4);
         $fec_ing = substr($fec_ing,8,2)."-".substr($fec_ing,5,2)."-".substr($fec_ing,0,4);

        $consulta_municipio_desde = mysql_query("SELECT t.codg_plantel_desde, t.codg_plantel_hacia, t.fec_egr, i.nomb_insti, m.codg_mun FROM bdc_traslado t, bdc_instituciones i, bdc_municipios m WHERE t.codg_per=$codg_per AND
                i.codg_insti=$codg_plantel_desde AND i.codg_pais=m.codg_pais AND i.codg_est=m.codg_est AND i.codg_mun=m.codg_mun");

        $municipio_desde = mysql_fetch_array($consulta_municipio_desde);
        $codg_mun1 = $municipio_desde["codg_mun"];


        $consulta_municipio_hacia = mysql_query("SELECT t.codg_plantel_hacia, t.codg_plantel_desde, t.fec_egr, i.nomb_insti, m.codg_mun FROM bdc_traslado t, bdc_instituciones i, bdc_municipios m WHERE t.codg_per=$codg_per AND
                i.codg_insti=$codg_plantel_hacia AND i.codg_pais=m.codg_pais AND i.codg_est=m.codg_est AND i.codg_mun=m.codg_mun");

        $municipio_hacia = mysql_fetch_array($consulta_municipio_hacia);
        $codg_mun2 = $municipio_hacia["codg_mun"];
    }

   $consulta_datos_per=mysql_query("SELECT d.apel_per, d.nomb_per, d.naci_per, t.desc_tip_trab, d.codg_tip_trab
                 FROM bdc_datos_per d, bdc_tip_trab t
                 WHERE d.codg_per=$codg_per AND d.codg_tip_trab=t.codg_tip_trab");

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


        <FORM METHOD="post" NAME="datos" action="bdc_editor_traslados.php">

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
                <TD><SELECT class="campo" NAME="codg_plantel_desde_new">
                <OPTION value="0">Seleccione...</OPTION>
                 <?
                if (($codg_mun1 != 0) && ($codg_mun1 != ""))
                {
                   $instituciones_origen = mysql_query("SELECT codg_insti, nomb_insti FROM bdc_instituciones WHERE codg_pais=58 AND codg_est=274 AND codg_mun=$codg_mun1 ORDER BY 2");
                }
                else
                {
                   $instituciones_origen = mysql_query("SELECT codg_insti, nomb_insti FROM bdc_instituciones WHERE codg_pais=58 AND codg_est=274 ORDER BY 2");
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
                  <TD><INPUT TYPE="TEXT" NAME="fec_egr" class="campo" VALUE="<? echo $fec_egr; ?>" MAXLENGTH="10" SIZE="10" READONLY>
                  <A HREF="#"><IMG SRC="../images/cal.gif" ALT="Haz Click para Buscar la Fecha" WIDTH="16" HEUGHT="16" BORDER="0" onClick="c1.popup('fec_egr');"></A>
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
                <TD><SELECT class="campo" NAME="codg_plantel_hacia_new">
                <OPTION value="0">Seleccione...</OPTION>
                <?
                if (($codg_mun2 != 0) && ($codg_mun2 != ""))
                {
                   $instituciones_destino = mysql_query("SELECT codg_insti, nomb_insti FROM bdc_instituciones WHERE codg_pais=58 AND codg_est=274 AND codg_mun=$codg_mun2 ORDER BY 2");
                }
                else
                {
                   $instituciones_destino = mysql_query("SELECT codg_insti, nomb_insti FROM bdc_instituciones WHERE codg_pais=58 AND codg_est=274 ORDER BY 2");
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
                  <TD><INPUT TYPE="TEXT" NAME="fec_ing" class="campo" VALUE="<? echo $fec_ing; ?>" MAXLENGTH="10" SIZE="10" READONLY>
                  <A HREF="#"><IMG SRC="../images/cal.gif" ALT="Haz Click para Buscar la Fecha" WIDTH="16" HEUGHT="16" BORDER="0" onClick="c1.popup('fec_ing');"></A>
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

<INPUT TYPE="hidden" NAME="action" VALUE="">
<INPUT TYPE="hidden" NAME="codg_per" VALUE="<? echo $codg_per; ?>">
<INPUT TYPE="hidden" NAME="codg_plantel_desde" VALUE="<? echo $codg_plantel_desde; ?>">
<INPUT TYPE="hidden" NAME="codg_plantel_hacia" VALUE="<? echo $codg_plantel_hacia; ?>">
<INPUT TYPE="hidden" NAME="pasada" VALUE="1">

<CENTER><INPUT class="mini" TYPE="BUTTON" VALUE="Actualizar" onclick="actualizar()">&nbsp;<INPUT class="mini" TYPE="BUTTON" VALUE="Cerrar Ventana" onclick="cerrar()"></CENTER>

</FORM>

<?
if ($action == "ins")
{
   $fec_egr = substr($fec_egr,6,4)."-".substr($fec_egr,3,2)."-".substr($fec_egr,0,2);
   $fec_ing = substr($fec_ing,6,4)."-".substr($fec_ing,3,2)."-".substr($fec_ing,0,2);

   if (($codg_cat_cargo == "0") || ($codg_cat_cargo == "")){$codg_cat_cargo = "NULL";}
   if (($codg_jer_cargo == "0") || ($codg_jer_cargo == "")){$codg_jer_cargo = "NULL";}
   if ($codg_cargo == ""){$codg_cargo = "NULL";} else {$codg_cargo = "'$codg_cargo'";}
   if (($codg_tip_traslado == "0") || ($codg_tip_traslado == "")){$codg_tip_traslado = "NULL";}
   if ($obser_trasl == ""){$obser_trasl = "NULL";} else {$obser_trasl = "'$obser_trasl'";}

        $qry = ("UPDATE bdc_traslado SET codg_plantel_desde=$codg_plantel_desde_new,
                         codg_plantel_hacia=$codg_plantel_hacia_new, fec_ing='$fec_ing', fec_egr='$fec_egr',
                         codg_cat_cargo=$codg_cat_cargo, codg_jer_cargo=$codg_jer_cargo,
                         codg_cargo=$codg_cargo, codg_tip_traslado=$codg_tip_traslado, obser_trasl=$obser_trasl WHERE codg_per=$codg_per AND codg_plantel_desde=$codg_plantel_desde AND
                         codg_plantel_hacia=$codg_plantel_hacia");

         mysql_query ($qry);

         $qry=("UPDATE bdc_datos_lab SET codg_insti=$codg_plantel_hacia_new,
                         codg_cat_cargo=$codg_cat_cargo, codg_jer_cargo=$codg_jer_cargo,
                         codg_jer_plantel=$codg_cargo, fec_ingp_lab='$fec_ing'
                         WHERE codg_per=$codg_per AND codg_insti=$codg_plantel_desde_new");

         mysql_query ($qry);

   echo '<SCRIPT>alert("Datos Actualizados");</SCRIPT>';

}
?>

<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">

  var frmvalidator  = new Validator("datos");

  frmvalidator.addValidation("codg_plantel_desde","dontselect=0","Seleccione una Institución de Origen");

  frmvalidator.addValidation("fec_egr","req","Seleccione la Fecha de Egreso");

  frmvalidator.addValidation("codg_plantel_hacia","dontselect=0","Seleccione una Institución de Destino");

  frmvalidator.addValidation("fec_ing","req","Seleccione la Fecha de Ingreso");

</SCRIPT>

</HTML>
