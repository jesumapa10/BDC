<?
  include ("../sesion.php");

  include ("../conex.php");
  
  if($_GET['codg_per']==""){
		$codg_per=$_POST['codg_per'];
		$codg_mov=$_POST['codg_mov'];   
  }else{
		$codg_per=$_GET['codg_per'];
		$codg_mov=$_GET['codg_mov']; 
  }
?>
<HTML>
<HEAD>
<TITLE>Editar Comisiones de Servicio</TITLE>
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
<script language='javascript' src="popcalendar.js"></script>
<SCRIPT LANGUAGE="JavaScript">
        var c1 = new CodeThatCalendar(caldef1);
</SCRIPT>

</HEAD>


<BR>
<H2>Editar Comisiones de Servicio</H2>

<?

   if ($pasada != 1)
    {

        $consulta_com_serv = mysql_query("SELECT codg_plantel_desde, codg_plantel_insti_hacia_com_serv, codg_jer_plantel, func_desemp_com_serv,
                         fec_inicio_com_serv, fec_fin_com_serv, n_oficio, encargaduria, siglas
                         FROM bdc_com_serv
                         WHERE codg_per=$codg_per AND codg_mov=$codg_mov");
         $com_serv = mysql_fetch_array($consulta_com_serv);

         $codg_plantel_desde = $com_serv["codg_plantel_desde"];
         $codg_plantel_insti_hacia_com_serv = $com_serv["codg_plantel_insti_hacia_com_serv"];
         $codg_jer_plantel = $com_serv["codg_jer_plantel"];
         $func_desemp_com_serv = $com_serv["func_desemp_com_serv"];
         $fec_inicio_com_serv = $com_serv["fec_inicio_com_serv"];
         $fec_fin_com_serv = $com_serv["fec_fin_com_serv"];
         $fec_inicio_com_serv = substr($fec_inicio_com_serv,8,2)."-".substr($fec_inicio_com_serv,5,2)."-".substr($fec_inicio_com_serv,0,4);
         $fec_fin_com_serv = substr($fec_fin_com_serv,8,2)."-".substr($fec_fin_com_serv,5,2)."-".substr($fec_fin_com_serv,0,4);
		 $n_oficio = $com_serv["n_oficio"];
         $encargaduria = $com_serv["encargaduria"];
		 $siglas= $com_serv["siglas"];

        $consulta_municipio_desde = mysql_query("SELECT c.codg_plantel_desde, c.codg_plantel_insti_hacia_com_serv, i.nomb_insti, m.codg_mun FROM bdc_com_serv c, bdc_instituciones i, bdc_municipios m WHERE c.codg_per=$codg_per AND
                i.codg_insti=$codg_plantel_desde AND i.codg_pais=m.codg_pais AND i.codg_est=m.codg_est AND i.codg_mun=m.codg_mun");

        $municipio_desde = mysql_fetch_array($consulta_municipio_desde);
        $codg_mun1 = $municipio_desde["codg_mun"];


        $consulta_municipio_hacia = mysql_query("SELECT c.codg_plantel_insti_hacia_com_serv, c.codg_plantel_desde, i.nomb_insti, m.codg_mun FROM bdc_com_serv c, bdc_instituciones i, bdc_municipios m WHERE c.codg_per=$codg_per AND
                i.codg_insti=$codg_plantel_insti_hacia_com_serv AND i.codg_pais=m.codg_pais AND i.codg_est=m.codg_est AND i.codg_mun=m.codg_mun");

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


        <FORM METHOD="post" NAME="datos" action="">

                 <TABLE BORDER="0" ALIGN="CENTER">
                <TR>
                <TD COLSPAN="4">
                <DIV ALIGN="CENTER"><P class="cabecera">Comisión de Servicio</P></DIV>                </TD>
                </TR>
				
				<TR>
                <TD width="109"><P ALIGN="RIGHT" class="mini">N&deg; de Oficio</P></TD>
                <TD width="343"><P class="campo"><INPUT class="campo" NAME="n_oficio" MAXLENGTH="4" SIZE="4" VALUE="<? echo $n_oficio; ?>" ></INPUT></P></TD>
				<TD width="138"><P ALIGN="RIGHT" class="mini">Siglas del Oficio</P></TD>
                <TD width="233"><P class="campo"><INPUT class="campo" NAME="siglas" MAXLENGTH="14" SIZE="14" VALUE="<? echo $siglas; ?>" ></INPUT></P></TD>
				<TR>
				<TD width="109"><P ALIGN="RIGHT" class="mini">Encargadur&iacute;a</P> <P class="campo"></P></TD>
                <TD COLSPAN="4"><input name="encargaduria" type="checkbox" value="S" <? if ($encargaduria == "S") { echo 'checked'; }?>></P></TD>
				</TR>
				
                <TR>
                <TD width="109"><P ALIGN="RIGHT" class="mini">Municipio de Origen:</P></TD>
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
                </SELECT>                </TD>
                </TR>


                <TR>
                <TD><P ALIGN="RIGHT" class="mini">Plantel de Origen:</P></TD>
                <TD colspan="3"><SELECT class="campo" NAME="codg_plantel_desde_new">
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
                </SELECT>                </TD>
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
                <TD COLSPAN="4"><SELECT class="campo" NAME="codg_mun2" onChange="municipio2()">
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
                </SELECT>                </TD>
                </TR>

                <TR>
                <TD><P ALIGN="RIGHT" class="mini">Institución/Plantel de Destino:</P></TD>
                <TD colspan="3"><SELECT class="campo" NAME="codg_plantel_insti_hacia_com_serv_new">
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
                </SELECT>                </TD>
                </TR>


                <TR>
                <TD><P ALIGN="RIGHT" class="mini">Funciones que va Desempeñar:</P></TD>
                <TD colspan="3"><P class="campo"><TEXTAREA class="campo" ROWS="5" COLS="100" NAME="func_desemp_com_serv" MAXLENGTH="250" SIZE="1" VALUE="<? echo $func_desemp_com_serv; ?>" ><? echo $func_desemp_com_serv; ?></TEXTAREA></P></TD>
                </TR>

                <TR>
                  <TD><P ALIGN="RIGHT" class="mini">Fecha de Inicio:</P></TD>
                  <TD width="343"></A><INPUT TYPE="TEXT" NAME="fec_inicio_com_serv" class="campo" VALUE="<? echo $fec_inicio_com_serv; ?>" MAXLENGTH="10" SIZE="10" id="fecha1" onClick="popUpCalendar(this, datos.fecha1, 'dd-mm-yyyy');" READONLY>
                <IMG onClick="popUpCalendar(this, datos.fecha1, 'dd-mm-yyyy');" SRC="../images/cal.gif" ALT="Haz Click para Buscar la Fecha" WIDTH="16" HEUGHT="16" BORDER="0"></TD>
                  <TD width="38" rowspan="2"><?PHP echo '<a href=documentos_comision_servicio.php?codg_mov='.$codg_mov.'&codg_per='.$codg_per.'&desc_tip_trab='.$desc_tip_trab.'><img border=0 src="../images/print_ico.png" ALT="Imprimir Carta de Presentación"></a>'; ?></TD>
                </TR>

                <TR>
                  <TD><P ALIGN="RIGHT" class="mini">Fecha Fin:</P></TD>
                  <TD></A><INPUT TYPE="TEXT" NAME="fec_fin_com_serv" class="campo" VALUE="<? echo $fec_fin_com_serv; ?>" MAXLENGTH="10" SIZE="10" id="fecha2" onClick="popUpCalendar(this, datos.fecha2, 'dd-mm-yyyy');" READONLY>
                <IMG onClick="popUpCalendar(this, datos.fecha2, 'dd-mm-yyyy');" SRC="../images/cal.gif" ALT="Haz Click para Buscar la Fecha" WIDTH="16" HEUGHT="16" BORDER="0"></TD>
                  </TR>

                <TR>
                <TD COLSPAN="4"><HR></TD>
                </TR>
        </TABLE>

<INPUT TYPE="hidden" NAME="action" VALUE="">
<INPUT TYPE="hidden" NAME="codg_per" VALUE="<? echo $codg_per; ?>">
<INPUT TYPE="hidden" NAME="codg_mov" VALUE="<? echo $codg_mov; ?>">
<INPUT TYPE="hidden" NAME="codg_plantel_desde" VALUE="<? echo $codg_plantel_desde; ?>">
<INPUT TYPE="hidden" NAME="codg_plantel_insti_hacia_com_serv" VALUE="<? echo $codg_plantel_insti_hacia_com_serv; ?>">
<INPUT TYPE="hidden" NAME="pasada" VALUE="1">

<CENTER><INPUT class="mini" TYPE="BUTTON" VALUE="Actualizar" onClick="actualizar()">&nbsp;<INPUT class="mini" TYPE="BUTTON" VALUE="Cerrar Ventana" onClick="cerrar()"></CENTER>

</FORM>

<?
if ($action == "ins")
{
   $fec_inicio_com_serv = substr($fec_inicio_com_serv,6,4)."-".substr($fec_inicio_com_serv,3,2)."-".substr($fec_inicio_com_serv,0,2);
   $fec_fin_com_serv = substr($fec_fin_com_serv,6,4)."-".substr($fec_fin_com_serv,3,2)."-".substr($fec_fin_com_serv,0,2);


        $qry = ("UPDATE bdc_com_serv SET codg_plantel_desde=$codg_plantel_desde_new,
                         codg_plantel_insti_hacia_com_serv=$codg_plantel_insti_hacia_com_serv_new, codg_jer_plantel='$codg_jer_plantel',
                         fec_inicio_com_serv='$fec_inicio_com_serv', fec_fin_com_serv='$fec_fin_com_serv',
                         func_desemp_com_serv='$func_desemp_com_serv',n_oficio='$n_oficio',encargaduria='$encargaduria',siglas='$siglas' WHERE codg_per=$codg_per AND codg_plantel_desde=$codg_plantel_desde AND
                         codg_plantel_insti_hacia_com_serv=$codg_plantel_insti_hacia_com_serv");

         mysql_query ($qry);

   echo '<SCRIPT>alert("Datos Actualizados");</SCRIPT>';

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
