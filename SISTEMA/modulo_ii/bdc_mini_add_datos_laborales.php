<?
  include ("../sesion.php");

  include ("../conex.php");
  include ("bdc_mini_add_movimientos.php");
?>
<HTML>
<HEAD>
        <LINK REL="STYLESHEET" HREF="../style/normal.css" TYPE="text/css">

        <SCRIPT LANGUAGE="JavaScript" SRC="../scripts/validar.js" TYPE="text/javascript"></SCRIPT>
		<script language='javascript' src="popcalendar.js"></script>


<SCRIPT>
function municipio()
{
        if (document.datos.codg_mun.selectedIndex == 100) {
        datos.codg_mun.value="$codg_mun";
        }
        datos.submit();
}

function tipo()
{
        if (document.datos.codg_insti.selectedIndex == 100) {
        datos.codg_insti.value="$codg_insti";
        }
        datos.submit();
}
function condicion()
{
        if (document.datos.codg_cond_lab.selectedIndex == 100) {
        datos.codg_cond_lab.value="$codg_cond_lab";
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

function direccion()
{
        if (document.datos.codg_insti.selectedIndex == 100) {
        datos.codg_insti.value="$codg_insti";
        }
        datos.submit();
}

function unidad()
{
        if (document.datos.codg_dir.selectedIndex == 100) {
        datos.codg_dir.value="$codg_dir";
        }
        datos.submit();
}

function coordinacion()
{
        if (document.datos.codg_uni.selectedIndex == 100) {
        datos.codg_uni.value="$codg_uni";
        }
        datos.submit();
}

function cambiar()
{
        datos.submit();
}

function cerrar()

{
         window.close()
}
function ingresar()
{
        datos.action.value="ins";
}
function finalizar()
{
input_box=confirm("¿Está seguro que desea Finalizar?");
if (input_box==true)

{
        location = "../modulo_i/bdc_data.php";
}

}

function siguiente()
        {
        location = "bdc_edit_traslados.php?codg_per=<? echo $codg_per; ?>";
        }

function regresar()
        {
        location = "bdc_edit_datos_academicos.php?codg_per=<? echo $codg_per; ?>";
        }
</SCRIPT>

<SCRIPT LANGUAGE="JavaScript" SRC="../scripts/calendario.js" TYPE="text/javascript"></SCRIPT>

<SCRIPT LANGUAGE="JavaScript" SRC="../scripts/cal-barra.js" TYPE="text/javascript"></SCRIPT>

<SCRIPT LANGUAGE="JavaScript">
        var c1 = new CodeThatCalendar(caldef1);
</SCRIPT>
<title>Agregar datos Laborales</title>
</HEAD>
<?
if ($action == "ins")
{
    //$consulta_lab_insti = mysql_query("SELECT * FROM bdc_datos_lab WHERE codg_per=$codg_per AND codg_insti=$codg_insti");
    //if (mysql_num_rows($consulta_lab_insti) != 0)
    //    {
        $horas_doc_lab = "$hora1$decimal1";
        $horas_adm_lab = "$hora2$decimal2";
        $fec_ingp_lab = substr($fec_ingp_lab,6,4)."-".substr($fec_ingp_lab,3,2)."-".substr($fec_ingp_lab,0,2);
        if (($codg_dir == "0") || ($codg_dir == "")){$codg_dir = "NULL";}
        if (($codg_uni == "0") || ($codg_uni == "")){$codg_uni = "NULL";}
        if (($codg_coor == "0") || ($codg_coor == "")){$codg_coor = "NULL";}
        if (($codg_cargo == "0") || ($codg_cargo == "")){$codg_cargo = "NULL";}
        if (($codg_cat_cargo == "0") || ($codg_cat_cargo == "")){$codg_cat_cargo = "NULL";}
        if (($codg_jer_cargo == "0") || ($codg_jer_cargo == "")){$codg_jer_cargo = "NULL";}
        if (($codg_jer_plantel == "0") || ($codg_jer_plantel == "")){$codg_jer_plantel = "NULL"; }
        if (($turno_lab == "0") || ($turno_lab == "")){$turno_lab = "NULL";}
        if (($dedic_lab == "0") || ($dedic_lab == "")){$dedic_lab = "NULL";}
        if ($horas_doc_lab == ""){$horas_doc_lab = "NULL";} else {$horas_doc_lab = "'$horas_doc_lab'";}
        if ($horas_adm_lab == ""){$horas_adm_lab = "NULL";} else {$horas_adm_lab = "'$horas_adm_lab'";}

         if ($fec_ret != "")
        {
         $fec_ret = substr($fec_ret,6,4)."-".substr($fec_ret,3,2)."-".substr($fec_ret,0,2);
        }
        else
        {$fec_ret="0000-00-00";}
        if ($obser_ret == ""){$obser_ret = "NULL";} else {$obser_ret = "'$obser_ret'";}

		/// DATOS NOMINA ////		
		if ($sueldo_integral == ""){$sueldo_integral = 0;}
		if ($bono_bolivariano == ""){$bono_bolivariano = 0;} 
		if ($bono_simoncito == ""){$bono_simoncito = 0;} 
		if ($cesta_ticket == ""){$cesta_ticket = 0;}
		
		guardar_mov($codg_per,$codg_tip_mov);
   		$codg_mov=gen_codg_mov();


        // DATOS NOMINA ////
        $qry="INSERT INTO bdc_datos_lab VALUES ($codg_per, $codg_insti,
                         $codg_dir, $codg_uni, $codg_coor, $codg_cargo,
                         $codg_cat_cargo, $codg_jer_cargo,
                         '$codg_jer_plantel', $codg_cond_lab,
                         '$fec_ingp_lab', '$turno_lab', '$dedic_lab',
                         $horas_doc_lab, $horas_adm_lab, '$fec_ret', $obser_ret, $codg_mov, $sueldo_integral, $bono_bolivariano, $bono_simoncito, $cesta_ticket )";

//echo $qry;
        mysql_query($qry);
		//echo mysql_error();
        echo "<SCRIPT>alert('Datos Agregados');</SCRIPT>";
		echo "<SCRIPT>window.opener.parent.DATA.actualizar();</SCRIPT>"; 
		     	 
		
        $codg_mun = "";
        $codg_insti = "";
        $codg_dir = "";
        $codg_uni = "";
        $codg_coor = "";
        $codg_cargo = "";
        $codg_cat_cargo = "";
        $codg_jer_cargo = "";
        $codg_jer_plantel = "";
        $codg_cond_lab = "";
        $fec_ingp_lab = "";
        $turno_lab = "";
        $dedic_lab = "";
        $horas_doc_lab = "";
        $horas_adm_lab = "";
        $hora1 = "";
        $decimal1 = "";
        $hora2 = "";
        $decimal2 ="";
      //          }
      //          else
     //           {
     //            echo '<CENTER><P><B class="rojo">No Posee Registros</B></CENTER>';
     //           }
}

?>

<BR>
<BR>
<H2>Agregar Datos Laborales</H2>
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
<BR>

<FORM METHOD="POST" NAME="datos" action="">

        <TABLE BORDER="0" ALIGN="CENTER">
                <TR>
                <TD COLSPAN="4">
                <DIV ALIGN="CENTER"><P class="cabecera">Datos Laborales</P></DIV>
                </TD>
                </TR>

                <TR>
                <TD><P ALIGN="RIGHT" class="mini">Municipio:</P></TD>
                <TD COLSPAN="3"><SELECT class="campo" NAME="codg_mun" onChange="municipio()" title="Seleccione de la lista el Municipio">
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
                </SELECT>
                </TD>
                </TR>

                <TR>
                <TD><P ALIGN="RIGHT" class="mini">Instituto/Plantel:</P></TD>
                <TD COLSPAN="3"><SELECT class="campo" NAME="codg_insti" onChange="tipo()"  title="Seleccione de la lista la institución">
                <OPTION value="0">Seleccione...</OPTION>
                <?
                if (($codg_mun != 0) && ($codg_mun != ""))
                {
                   $instituciones = mysql_query("SELECT codg_insti, nomb_insti FROM bdc_instituciones WHERE codg_pais=58 AND codg_est=274 AND codg_mun=$codg_mun ORDER BY 2");
                }
                else
                {
                   $instituciones = mysql_query("SELECT codg_insti, nomb_insti FROM bdc_instituciones WHERE codg_pais=58 AND codg_est=274 AND codg_mun=$codg_mun ORDER BY 2");
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
                </SELECT>
                </TD>
                </TR>
                <?
                if (($codg_insti != 0) && ($codg_insti != ""))
                    {
                          $consulta_tipo_insti = mysql_query("SELECT codg_tip_insti FROM bdc_instituciones WHERE codg_insti=$codg_insti");
                          if (mysql_num_rows($consulta_tipo_insti) != 0)
                          {
                            $tipo = mysql_fetch_array($consulta_tipo_insti);
                            $codg_tipo_insti_new = $tipo["codg_tip_insti"];
                          }
                                if (($codg_tipo_insti_new != "") && (($codg_tip_trab == "A" ) || ($codg_tip_trab == "D") || ($codg_tip_trab == "O")))
                                  {
                                        $mostrar = "'fec_ingp_lab'";
                                        echo '<TR>';
                                        echo '<TD><P ALIGN="RIGHT" class="mini">Fecha de Ingreso Instituto/Plantel:</P></TD>';
										$formato_fecha = "'dd-mm-yyyy'";
                                    echo '<TD><INPUT TYPE="TEXT" NAME="fec_ingp_lab" class="campo" VALUE="'.$fec_ingp_lab.'" MAXLENGTH="10" SIZE="10" id="fec_ingp_lab" onClick="popUpCalendar(this, datos.fec_ingp_lab, '.$formato_fecha.');" READONLY title="Seleccione con ayuda del calendario la fecha de ingreso al plantel"> 
            <IMG onClick="popUpCalendar(this, datos.fec_ingp_lab, '.$formato_fecha.');" SRC="../images/cal.gif" ALT="Haz Click para Buscar la Fecha" WIDTH="16" HEUGHT="16" BORDER="0">';
                                        echo '</TR>';

                                        if (($codg_tipo_insti_new == 1) && ($codg_tip_trab == "D"))
                                        {
                                        echo '<TR>
                                                  <TD><P ALIGN="RIGHT" class="mini">Categor&iacute;a del Cargo:</P></TD>
                                              <TD COLSPAN="3"><SELECT class="campo" NAME="codg_cat_cargo" onChange="jerarquia()"  title="Seleccione de la lista la categoria del cargo">
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
                                              <TD><P ALIGN="RIGHT" class="mini">Jerarqu&iacute;a del Cargo:</P></TD>
                                              <TD COLSPAN="3"><SELECT class="campo" NAME="codg_jer_cargo"  title="Seleccione de la lista la jerarqui">
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
                                                                <TD><P ALIGN="RIGHT" class="mini">Jerarqu&iacute;a en el Plantel:</P></TD>
                                                                <TD COLSPAN="3"><SELECT class="campo" NAME="codg_jer_plantel"  title="Seleccione de la lista jerarquia">
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
                                          }
                                        }
                                         if ((($codg_tipo_insti_new != 1) && ($codg_tipo_insti_new != "")) && (($codg_tip_trab == "A")))
                                           {
                                                echo '<TR>
                                                      <TD><P ALIGN="RIGHT" class="mini">Direcci&oacute;n:</P></TD>
                                                     <TD COLSPAN="3"><SELECT class="campo" NAME="codg_dir" onChange="unidad()"  title="Seleccione de la lista la direccion">
                                          <OPTION value="0">Seleccione...</OPTION>';
                                                          $direcciones = mysql_query("SELECT codg_dir, desc_dir FROM bdc_direcciones WHERE codg_insti=$codg_insti");
                                          if (mysql_num_rows($direcciones) != 0)
                                             {
                                                     while ($direccion = mysql_fetch_array($direcciones))
                                                          {
                                                                   echo '<OPTION VALUE="'.$direccion["codg_dir"];
                                                     echo '"';
                                               if ($codg_dir == $direccion["codg_dir"])
                                                       {
                                                          echo 'SELECTED';
                                                               }
                                                       echo '>'.$direccion["desc_dir"];
                                                       echo '</OPTION>';
                                                                  }
                                                }

                                                echo '</SELECT>
                                                  </TD>
                                                  </TR>';


                                                echo  '<TR>
                                                       <TD><P ALIGN="RIGHT" class="mini">Unidad:</P></TD>
                                                       <TD COLSPAN="3"><SELECT class="campo" NAME="codg_uni" onChange="coordinacion()"  title="Seleccione de la lista la unidad">
                                           <OPTION value="0">Seleccione...</OPTION>';
                                               $unidades = mysql_query("SELECT codg_uni, desc_uni FROM bdc_unidad WHERE codg_insti=$codg_insti AND codg_dir=$codg_dir");
                                               if (mysql_num_rows($unidades) != 0)
                                                {
                                                    while ($unidad = mysql_fetch_array($unidades))
                                                     {
                                                         echo '<OPTION VALUE="'.$unidad["codg_uni"];
                                                         echo '"';
                                                         if ($codg_uni == $unidad["codg_uni"])
                                                          {
                                                            echo 'SELECTED';
                                                          }
                                                         echo '>'.$unidad["desc_uni"];
                                                         echo '</OPTION>';
                                                     }
                                                }
                                                echo '</SELECT>
                                                </TD>
                                                </TR>';



                                                echo '<TR>
                                                         <TD><P ALIGN="RIGHT" class="mini">Coordinaci&oacute;n:</P></TD>
                                                     <TD COLSPAN="3"><SELECT class="campo" NAME="codg_coor"  title="Seleccione de la lista la coordinación">
                                                     <OPTION value="0">Seleccione...</OPTION>';
                                                         $coordinaciones = mysql_query("SELECT codg_coor, desc_coor FROM bdc_coordinacion WHERE codg_insti=$codg_insti AND codg_dir=$codg_dir AND codg_uni=$codg_uni");
                                         if (mysql_num_rows($coordinaciones) != 0)
                                             {
                                      while ($coordinacion = mysql_fetch_array($coordinaciones))
                                                  {
                                                           echo '<OPTION VALUE="'.$coordinacion["codg_coor"];
                                       echo '"';
                                               if ($codg_coor == $coordinacion["codg_coor"])
                                               {
                                                  echo 'SELECTED';
                                               }
                                       echo '>'.$coordinacion["desc_coor"];
                                       echo '</OPTION>';
                                                  }
                                        }

                                                echo '</SELECT>
                                                      </TD>
                                                      </TR>';


                                }


                  }


        if ((($codg_tipo_insti_new != 1) || ($codg_tipo_insti_new == 1)) && (($codg_tip_trab == "O") || ($codg_tip_trab == "A")))
                {
                echo '<TR>
                     <TD><P ALIGN="RIGHT" class="mini">Cargo:</P></TD>
                     <TD COLSPAN="3"><SELECT class="campo" NAME="codg_cargo"  title="Seleccione de la lista el cargo">
                     <OPTION value="0">Seleccione...</OPTION>';
                 $cargos = mysql_query("SELECT codg_cargo, desc_cargo FROM bdc_cargo ORDER BY 2");
            if (mysql_num_rows($cargos) != 0)
                {
                    while ($cargo = mysql_fetch_array($cargos))
                  {
                   echo '<OPTION VALUE="'.$cargo["codg_cargo"];
                                       echo '"';
                                       if ($codg_cargo == $cargo["codg_cargo"])
                                       {
                                          echo 'SELECTED';
                                       }
                                       echo '>'.$cargo["desc_cargo"];
                                       echo '</OPTION>';
                  }
                }

                echo '</SELECT>
                     </TD>
                     </TR>';
                }
                ?>

                <TR>
                <TD><P ALIGN="RIGHT" class="mini">Condici&oacute;n Laboral:</P></TD>
                <TD COLSPAN="3"><SELECT class="campo" NAME="codg_cond_lab" onChange="condicion()"  title="Seleccione de la lista la condicion laboral">
                <OPTION value="0">Seleccione...</OPTION>

                <? $condiciones_lab = mysql_query("SELECT codg_cond_lab, desc_cond_lab FROM bdc_cond_lab ORDER BY 2");
                  if (mysql_num_rows($condiciones_lab) != 0)

                  {
                    while ($condicion_lab = mysql_fetch_array($condiciones_lab))
                  {
                   echo '<OPTION VALUE="'.$condicion_lab["codg_cond_lab"];
                                       echo '"';
                                       if ($codg_cond_lab == $condicion_lab["codg_cond_lab"])
                                       {
                                          echo 'SELECTED';
                                       }
                                       echo '>'.$condicion_lab["desc_cond_lab"];
                                       echo '</OPTION>';
                  }
                }
              ?>

               <?
                   if ($codg_cond_lab > 1)
                     {
                        $mostrar = "'fec_ret'";
                        echo '<TR>';
                        echo '<TD><P ALIGN="RIGHT" class="mini">Fecha de Egreso:</P></TD>';
                        echo '<TD><INPUT TYPE="TEXT" NAME="fec_ret" class="campo" VALUE="'.$fec_ret.'" MAXLENGTH="10" SIZE="10" id="fec_ret" onClick="popUpCalendar(this, datos.fec_ret, '.$formato_fecha.');" READONLY  title="Seleccione con ayuda del calendario la fecha de Egreso"> 
            <IMG onClick="popUpCalendar(this, datos.fec_ret, '.$formato_fecha.');" SRC="../images/cal.gif" ALT="Haz Click para Buscar la Fecha" WIDTH="16" HEUGHT="16" BORDER="0"></TD>';
                        echo '</TR>';

                        echo '<TR>';
                        echo '<TD><P ALIGN="RIGHT" class="mini">Observación del Egreso:</P></TD>';
                        echo '<TD><P class="campo"><TEXTAREA class="campo" ROWS="5" COLS="50" NAME="obser_ret" MAXLENGTH="250" SIZE="1" VALUE="'.$obser_ret.'" >'.$obser_ret.'</TEXTAREA></P></TD>';
                        echo '</TR>';
                      }
                ?>

                </SELECT>
                </TD>
                </TR>

                <TR>
                <TD WIDTH="135"><P ALIGN="RIGHT" class="mini">Turno:</P></TD>
                <TD WIDTH="135"><SELECT class="campo" NAME="turno_lab"  title="Seleccione de la lista el turno">
                <OPTION value="0">Seleccione...</OPTION>
                <OPTION value="M" <? if ($turno_lab == "M") {echo 'SELECTED';}?>>Mañana</OPTION>
                <OPTION value="T" <? if ($turno_lab == "T") {echo 'SELECTED';}?>>Tarde</OPTION>
                <OPTION value="N" <? if ($turno_lab == "N") {echo 'SELECTED';}?>>Noche</OPTION>
                <OPTION value="X" <? if ($turno_lab == "X") {echo 'SELECTED';}?>>Mixto</OPTION>
                </SELECT></TD>
                <TD WIDTH="135"><P ALIGN="RIGHT" class="mini">Dedicaci&oacute;n Laboral:</P></TD>
                <TD WIDTH="135"><SELECT class="campo" NAME="dedic_lab"  title="Seleccione de la lista la dedicación">
                <OPTION value="0">Seleccione...</OPTION>
                <OPTION value="TC" <? if ($dedic_lab == "TC") {echo 'SELECTED';}?>>Tiempo Completo</OPTION>
                <OPTION value="MT" <? if ($dedic_lab == "MT") {echo 'SELECTED';}?>>Medio Tiempo</OPTION>
                <OPTION value="TI" <? if ($dedic_lab == "TI") {echo 'SELECTED';}?>>Tiempo Integral</OPTION>
                <OPTION value="TV" <? if ($dedic_lab == "TV") {echo 'SELECTED';}?>>Tiempo Convencional</OPTION>
                </SELECT></TD>
                </TR>

                <TR>
                <TD><P ALIGN="RIGHT" class="mini">Horas Administrativas:</P></TD>
                <TD><P class="campo"><INPUT class="campo" TYPE="TEXT" NAME="hora2" MAXLENGTH="2" SIZE="1" VALUE="<? echo $hora2; ?>"  title="Introduzca las horas administrativas">.<INPUT class="campo" TYPE="TEXT" NAME="decimal2" MAXLENGTH="2" SIZE="1" VALUE="<? echo $decimal2; ?>" title="Introduzca las horas administrativas"></P></TD>
                <?
                  if ($codg_tip_trab == "D")
                    {
                           echo '<TD><P ALIGN="RIGHT" class="mini">Horas Docentes:</P></TD>
                                        <TD><P class="campo"><INPUT class="campo" TYPE="TEXT" NAME="hora1" MAXLENGTH="2" SIZE="1" VALUE="'.$hora1.'" title="Introduzca las horas docentes">.<INPUT class="campo" TYPE="TEXT" NAME="decimal1" MAXLENGTH="2" SIZE="1" VALUE="'.$decimal1.'" title="Introduzca las horas docentes"></P></TD>';
                        }
                ?>
                </TR>
                
                <?		/// DATOS NOMINA //// ?>
                <TR>
                <TD COLSPAN="4">
                <DIV ALIGN="CENTER"><P class="cabecera">Datos de Nómina</P></DIV>
                </TD>
                </TR>
				
                <TR>
                <TD><P ALIGN="RIGHT" class="mini">Sueldo Integral:</P></TD>
                <TD><P class="campo"><INPUT class="campo" TYPE="TEXT" NAME="sueldo_integral" MAXLENGTH="10" SIZE="10" VALUE="<? echo $sueldo_integral; ?>" title="Introduzca el sueldo integral"></P></TD>
                <TD><P ALIGN="RIGHT" class="mini">Bono Bolivariano:</P></TD>
                <TD><P class="campo"><INPUT class="campo" TYPE="TEXT" NAME="bono_bolivariano" MAXLENGTH="10" SIZE="10" VALUE="<? echo $bono_bolivariano; ?>" title="Introduzca el bono bolivariano"></P></TD>
                </TR>
                
                <TR>
                <TD><P ALIGN="RIGHT" class="mini">Bono Simoncito:</P></TD>
                <TD><P class="campo"><INPUT class="campo" TYPE="TEXT" NAME="bono_simoncito" MAXLENGTH="10" SIZE="10" VALUE="<? echo $bono_simoncito; ?>" title="Introduzca el bono simoncito"></P></TD>
                <TD><P ALIGN="RIGHT" class="mini">Cesta Ticket:</P></TD>
                <TD><P class="campo"><INPUT class="campo" TYPE="TEXT" NAME="cesta_ticket" MAXLENGTH="10" SIZE="10" VALUE="<? echo $cesta_ticket; ?>" title="Introduzca la cesta ticket"></P></TD>
                </TR>

                <TR>
                <TD COLSPAN="4"><HR></TD>
                </TR>


        </TABLE>


<CENTER><INPUT class="mini" TYPE="SUBMIT" VALUE="Agregar" onClick="ingresar()" title="Haga click para almacenar los datos">&nbsp;<INPUT class="mini" TYPE="BUTTON" VALUE="Cerrar Ventana" onClick="cerrar()" title="Haga click para cerrar la ventana actual"></CENTER>

<INPUT TYPE=hidden NAME="action" VALUE="">
<INPUT TYPE=hidden NAME="codg_per" VALUE="<? echo $codg_per; ?>">
<BR>
<?
   $consulta_lab = mysql_query("SELECT f.nomb_insti, g.desc_cond_lab
                                 FROM bdc_datos_lab d, bdc_instituciones f, bdc_cond_lab g
                                 WHERE d.codg_per=$codg_per AND d.codg_insti=f.codg_insti AND d.codg_cond_lab=g.codg_cond_lab");

   if (mysql_num_rows($consulta_lab) != 0)
    {
            echo '<TABLE BORDER="0" ALIGN="CENTER">';

            echo '<TR>
                 <TD COLSPAN="4">
                 <DIV ALIGN="CENTER"><P class="cabecera">Datos Laborales Registrados</P></DIV>
                 </TD>
                 </TR>

                 <TR>
                   <TD><P ALIGN="CENTER" class="mini">Instituci&oacute;n</P></TD>
                   <TD></TD>
                   <TD><P ALIGN="CENTER" class="mini">Condici&oacute;n Laboral</P></TD>
                   <TD></TD>
                  </TR>';
          while ($consulta = mysql_fetch_array($consulta_lab))
              {
                 echo '<TR>';
                 echo '<TD><P ALIGN="LETF" class="campo">'.$consulta['nomb_insti'];'</P></TD>';
                 echo '<TD></TD>';
                 echo '<TD><P ALIGN="CENTER" class="campo">'.$consulta['desc_cond_lab'];'</P></TD>';
                 echo '</TR>';
               }
         }
   else
     {
             echo '<CENTER><P><B class="rojo">No Posee Registros</B></CENTER>';
     }
?>

</FORM>


<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">

  var frmvalidator  = new Validator("datos");

  frmvalidator.addValidation("codg_insti","dontselect=0","Seleccione una Institución");

  <?
  if (($codg_tipo_insti_new != "") && (($codg_tip_trab == "A" ) || ($codg_tip_trab == "D") || ($codg_tip_trab == "O")))
  {
     
    echo 'frmvalidator.addValidation("fec_ingp_lab","req","Seleccione la Fecha de Ingreso al Plantel");';
   
  }
  ?>

  <?
  if ((($codg_tipo_insti_new != 1) || ($codg_tipo_insti_new != 1)) && (($codg_tip_trab == "A") || ($codg_tip_trab == "O")))
  {
  echo 'frmvalidator.addValidation("codg_cargo","dontselect=0","Seleccione un Cargo");';
  echo 'frmvalidator.addValidation("codg_cargo","dontselect=0","Seleccione un Cargo");';
  
  }
  ?>

  frmvalidator.addValidation("codg_cond_lab","dontselect=0","Seleccione una Condición Laboral");

  <?
  if (($hora1 != "") || ($decimal1 != "" ))
  {
    echo 'frmvalidator.addValidation("hora1","num");';
    echo 'frmvalidator.addValidation("hora1","minlen=2","El Mínimo de Caracteres para las Horas Administrativas es 2");';
    echo 'frmvalidator.addValidation("decimal1","num");';
    echo 'frmvalidator.addValidation("decimal1","minlen=2","El Mínimo de Caracteres para las fracciones de Horas Administrativas es 2");';
    
   }
  ?>

 <?
  if (($hora2 != "") || ($decimal2 != "" ))
  {
  echo 'frmvalidator.addValidation("hora2","num");';
  echo 'frmvalidator.addValidation("hora2","minlen=2","El Mínimo de Caracteres para las Horas Docentes es 2");';
  echo 'frmvalidator.addValidation("decimal2","num");';
  echo 'frmvalidator.addValidation("decimal2","minlen=2","El Mínimo de Caracteres para las fracciones de Horas Docentes es 2");';
   
 }
  ?>

  //frmvalidator.setAddnlValidationFunction("actualizar");

</SCRIPT>

</BODY>
</HTML>
