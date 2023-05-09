<?
  include ("../sesion.php");

  include ("../conex.php");
  include ("bdc_mini_add_movimientos.php");
  
  
?>
<HTML>
<HEAD>
<TITLE>Agregar Comisiones de Servicio</TITLE>
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
<H2>Agregar Comisiones de Servicio</H2>

<?
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


        <FORM METHOD="post" NAME="datos" action="">

                 <TABLE BORDER="0" ALIGN="CENTER">
                <TR>
                <TD COLSPAN="4">
                <DIV ALIGN="CENTER"><P class="cabecera">Comisión de Servicio</P></DIV>
                </TD>
                </TR>
				
				<TR>
                <TD  width="109"><P ALIGN="RIGHT" class="mini">N&deg; de Oficio</P></TD>
                <TD  width="343"><P class="campo"><INPUT class="campo" NAME="n_oficio" MAXLENGTH="4" SIZE="4" VALUE="<? echo $n_oficio; ?>" ></INPUT></P></TD>
				<TD width="138"><P ALIGN="RIGHT" class="mini">Siglas del Oficio</P></TD>
                <TD width="233"><P class="campo"><INPUT class="campo" NAME="siglas" MAXLENGTH="14" SIZE="14" VALUE="<? echo $siglas; ?>" ></INPUT></P></TD>
				<TR>
				<TD><P ALIGN="RIGHT" class="mini">Encargadur&iacute;a</P> <P class="campo"></P></TD>
                <TD  COLSPAN="4"><input name="encargaduria" type="checkbox" value="S" <? if ($encargaduria == "S") { echo 'checked'; }?>></P></TD>
				</TR>
				</TR>
				
                <TR>
                <TD><P ALIGN="RIGHT" class="mini">Municipio de Origen:</P></TD>
                <TD COLSPAN="4"><SELECT class="campo" NAME="codg_mun1" onChange="municipio1()">
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
                <TD  COLSPAN="4"><SELECT class="campo" NAME="codg_plantel_desde">
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

                <?

                           echo '<TR>
                                <TD><P ALIGN="RIGHT" class="mini">Jerarqu&iacute;a en el Plantel de Origen:</P></TD>
                                <TD COLSPAN="3"><SELECT class="campo" NAME="codg_jer_plantel">
                                <OPTION value="0">Seleccione...</OPTION>';
                                    $jerrarquias_plant = mysql_query("SELECT codg_jer_plantel, desc_jer_plantel FROM bdc_jer_plantel ORDER BY 2");
                                    if (mysql_num_rows($jerrarquias_plant) != 0)
                                       {
                                         while ($jerrarquia_plant = mysql_fetch_array($jerrarquias_plant))
                                            {
                                               echo '<OPTION VALUE="'.$jerrarquia_plant["codg_jer_plantel"];
                                               echo '"';
                                               if ($codg_jer_plantel == $jerrarquia_plant["codg_jer_plantel"])
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

             ?>



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
                <TD><P ALIGN="RIGHT" class="mini">Institución/Plantel de Destino:</P></TD>
                <TD  COLSPAN="4"><SELECT class="campo" NAME="codg_plantel_insti_hacia_com_serv">
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
                                       if ($codg_plantel_insti_hacia_com_serv == $institucion_destino["codg_insti"])
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
                <TD><P ALIGN="RIGHT" class="mini">Funciones que va Desempeñar:</P></TD>
                <TD  COLSPAN="4"><P class="campo"><TEXTAREA class="campo" ROWS="5" COLS="100" NAME="func_desemp_com_serv" MAXLENGTH="250" SIZE="1" VALUE="<? echo $func_desemp_com_serv; ?>" ><? echo $func_desemp_com_serv; ?></TEXTAREA></P></TD>
                </TR>

                <TR>
                  <TD><P ALIGN="RIGHT" class="mini">Fecha de Inicio:</P></TD>
                  <TD  COLSPAN="4"><INPUT TYPE="TEXT" NAME="fec_inicio_com_serv" class="campo" VALUE="<? echo $fec_inicio_com_serv; ?>" MAXLENGTH="10" SIZE="10" id="fec_inicio_com_serv" onClick="popUpCalendar(this, datos.fec_inicio_com_serv, 'dd-mm-yyyy');" READONLY>
                <IMG onClick="popUpCalendar(this, datos.fec_inicio_com_serv, 'dd-mm-yyyy');" SRC="../images/cal.gif" ALT="Haz Click para Buscar la Fecha" WIDTH="16" HEUGHT="16" BORDER="0">
                  </TD>
                </TR>

                <TR>
                  <TD><P ALIGN="RIGHT" class="mini">Fecha Fin:</P></TD>
                  <TD COLSPAN="4"><INPUT TYPE="TEXT" NAME="fec_fin_com_serv" class="campo" VALUE="<? echo $fec_fin_com_serv; ?>" MAXLENGTH="10" SIZE="10" id="fec_fin_com_serv" onClick="popUpCalendar(this, datos.fec_fin_com_serv, 'dd-mm-yyyy');" READONLY>
                <IMG onClick="popUpCalendar(this, datos.fec_fin_com_serv, 'dd-mm-yyyy');" SRC="../images/cal.gif" ALT="Haz Click para Buscar la Fecha" WIDTH="16" HEUGHT="16" BORDER="0">
                  </TD>
                </TR>

                <TR>
                <TD COLSPAN="4"><HR></TD>
                </TR>

        </TABLE>

<INPUT TYPE="hidden" NAME="action" VALUE="">
<INPUT TYPE="hidden" NAME="codg_per" VALUE="<? echo $codg_per; ?>">
<INPUT TYPE="hidden" NAME="codg_mov" VALUE="<? echo $codg_mov; ?>">
<INPUT TYPE="hidden" NAME="pasada" VALUE="1">

<CENTER><INPUT class="mini" TYPE="BUTTON" VALUE="Agregar" onClick="actualizar()">&nbsp;<INPUT class="mini" TYPE="BUTTON" VALUE="Cerrar Ventana" onClick="cerrar()"></CENTER>

</FORM>

<?
if ($action == "ins")
{
   $fec_inicio_com_serv = substr($fec_inicio_com_serv,6,4)."-".substr($fec_inicio_com_serv,3,2)."-".substr($fec_inicio_com_serv,0,2);
   $fec_fin_com_serv = substr($fec_fin_com_serv,6,4)."-".substr($fec_fin_com_serv,3,2)."-".substr($fec_fin_com_serv,0,2);
  
   guardar_mov($codg_per,$codg_tip_mov);
   $codg_mov=gen_codg_mov();
   if ($encargaduria == "") {($encargaduria = "N");}

   
        $qry = "INSERT INTO bdc_com_serv VALUES ( $codg_per, $codg_plantel_desde,
                         $codg_plantel_insti_hacia_com_serv, '$codg_jer_plantel',
                         '$func_desemp_com_serv','$fec_inicio_com_serv', '$fec_fin_com_serv', $codg_mov,'$n_oficio','$encargaduria','$siglas')";
         mysql_query ($qry);


   echo '<SCRIPT>alert("Datos Agregados");</SCRIPT>';
   echo "<SCRIPT>window.opener.parent.DATA.actualizar();</SCRIPT>"; 

    $consulta_com_serv_desde = mysql_query("SELECT c.codg_plantel_desde, c.codg_plantel_insti_hacia_com_serv, c.fec_inicio_com_serv, c.fec_fin_com_serv, i.nomb_insti FROM bdc_com_serv c, bdc_instituciones i WHERE c.codg_per=$codg_per AND
                i.codg_insti=c.codg_plantel_desde");

                 $consulta_com_serv_hacia = mysql_query("SELECT c.codg_plantel_desde, c.codg_plantel_insti_hacia_com_serv, c.fec_inicio_com_serv, c.fec_fin_com_serv, i.nomb_insti FROM bdc_com_serv c, bdc_instituciones i WHERE c.codg_per=$codg_per AND
                i.codg_insti=c.codg_plantel_insti_hacia_com_serv");
             if ((mysql_num_rows($consulta_com_serv_desde) != 0) || (mysql_num_rows($consulta_com_serv_hacia) != 0))
             {

                echo '<TABLE BORDER="0" ALIGN="CENTER">';
                echo '<TR>';
                echo '<TD COLSPAN="4" WIDTH="580">';
                echo '<DIV ALIGN="CENTER"><P class="cabecera">Comisiones de Servicio Registrados</P></DIV>';
                echo '</TD>';
                echo '</TR>';

                  echo '<TR>';
                  echo '<TD WIDTH="290"><P ALIGN="CENTER" class="mini">Instituci&oacute;n/Plantel de Origen</P></TD>';
                  echo '<TD WIDTH="290"><P ALIGN="CENTER" class="mini">Instituci&oacute;n/Plantel de Destino</P></TD>';
                  echo '<TD WIDTH="90"><P ALIGN="CENTER" class="mini">Fecha de Inicio</P></TD>';
                  echo '<TD WIDTH="90"><P ALIGN="CENTER" class="mini">Fecha Fin</P></TD>';
                  echo '</TR>';


                     while (($servicio1 = mysql_fetch_array($consulta_com_serv_desde)) && ($servicio2 = mysql_fetch_array($consulta_com_serv_hacia)))
                     {
                     $fec_inicio_com_serv = $servicio1['fec_inicio_com_serv'];
                     $fec_fin_com_serv = $servicio1['fec_fin_com_serv'];
                     $fec_inicio_com_serv = substr($fec_inicio_com_serv,8,2)."-".substr($fec_inicio_com_serv,5,2)."-".substr($fec_inicio_com_serv,0,4);
                     $fec_fin_com_serv = substr($fec_fin_com_serv,8,2)."-".substr($fec_fin_com_serv,5,2)."-".substr($fec_fin_com_serv,0,4);

                     echo '<TR>';
                         echo '<TD><P ALIGN="CENTER" class="campo">'.$servicio1['nomb_insti'];'</P></TD>';
                         echo '<TD><P ALIGN="CENTER" class="campo">'.$servicio2['nomb_insti'];'</P></TD>';
                         echo '<TD><P ALIGN="CENTER" class="campo">'.$fec_inicio_com_serv;'</P></TD>';
                         echo '<TD><P ALIGN="CENTER" class="campo">'.$fec_fin_com_serv;'</P></TD>';
                         
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

}
?>

<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">

  var frmvalidator  = new Validator("datos");

  frmvalidator.addValidation("codg_plantel_desde","dontselect=0","Seleccione una Institución de Origen");

  frmvalidator.addValidation("codg_jer_plantel","dontselect=0","Seleccione la jerarquia del Plantel de Origen");

  frmvalidator.addValidation("codg_plantel_insti_hacia_com_serv","dontselect=0","Seleccione una Institución de Destino");

  frmvalidator.addValidation("func_desemp_com_serv","req","Indique las funciones del cargo a desempeñar");

  frmvalidator.addValidation("fec_inicio_com_serv","req","Seleccione la Fecha de Inicio de la Comisión de Servicio");

  frmvalidator.addValidation("fec_fin_com_serv","req","Seleccione la Fecha Fin de la Comisión de Servicio");

</SCRIPT>
</HTML>

