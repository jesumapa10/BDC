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
</HEAD>
<?
if ($action == "ins")
{
		$fecha_sol_tram = date('Y-m-d');
        $qry="INSERT INTO bdc_tramites (codg_per, codg_tipo_tram, fecha_sol_tram, edo_tram) VALUES ($codg_per, $codg_tipo_tram, '$fecha_sol_tram', 'Por Procesar')";
        //echo $qry;
        mysql_query($qry);
		//echo mysql_error();
        echo "<SCRIPT>alert('Datos Agregados. Su solicitud será procesada en un máximo de 8 días hábiles');</SCRIPT>";
		echo "<SCRIPT>window.opener.parent.DATA.actualizar();</SCRIPT>"; 
		     	 		
        $codg_tipo_tram = "";
		
      //          }
      //          else
     //           {
     //            echo '<CENTER><P><B class="rojo">No Posee Registros</B></CENTER>';
     //           }
}

?>

<BR>
<BR>
<H2>Solicitud de Tr&aacute;mites  </H2>
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
                <DIV ALIGN="CENTER">
                  <P class="cabecera">Datos del Tr&aacute;mite </P>
                </DIV>                </TD>
                </TR>

                <TR>
                <TD width="135" class="mini"><div align="right"><span class="mini">Tipo de Solicitud :</span></div></TD>
                <TD width="405" COLSPAN="3"><SELECT NAME="codg_tipo_tram" class="campo" id="codg_tipo_tram">
                  <OPTION value="0">Seleccione...</OPTION>
                  <? $tipo_tramite = mysql_query("SELECT codg_tipo_tram, desc_tipo_tram FROM bdc_tipo_tramites ORDER BY 2");
                if (mysql_num_rows($tipo_tramite) != 0)
                {
                    while ($tipos_tramite = mysql_fetch_array($tipo_tramite))
                  {
                   echo '<OPTION VALUE="'.$tipos_tramite["codg_tipo_tram"];
                                       echo '"';
                                       if ($codg_tipo_tram == $tipos_tramite["codg_tipo_tram"])
                                       {
                                          echo 'SELECTED';
                                       }
                                       echo '>'.$tipos_tramite["desc_tipo_tram"];
                                       echo '</OPTION>';
                  }
                }
                ?>
                </SELECT></TD>
                </TR>
                <TR>
                  <TD colspan="4"><hr></TD>
                </TR>
        </TABLE>


<CENTER><INPUT class="mini" TYPE="SUBMIT" VALUE="Agregar" onClick="ingresar()">&nbsp;<INPUT class="mini" TYPE="BUTTON" VALUE="Cerrar Ventana" onClick="cerrar()"></CENTER>

<INPUT TYPE=hidden NAME="action" VALUE="">
<INPUT TYPE=hidden NAME="codg_per" VALUE="<? echo $codg_per; ?>">
<BR>
<?
   $consulta_tramites = mysql_query("SELECT t.fecha_sol_tram, t.edo_tram, p.desc_tipo_tram
                                 FROM bdc_tramites t, bdc_tipo_tramites p
                                 WHERE t.codg_per=$codg_per AND t.codg_tipo_tram=p.codg_tipo_tram order by fecha_sol_tram DESC");

   if (mysql_num_rows($consulta_tramites) != 0)
    {
            echo '<TABLE BORDER="0" ALIGN="CENTER">';

            echo '<TR>
                 <TD COLSPAN="4">
                 <DIV ALIGN="CENTER"><P class="cabecera">Solicitudes Efectuadas</P></DIV>
                 </TD>
                 </TR>

                 <TR>
                   <TD><P ALIGN="CENTER" class="mini">Fecha Solicitud</P></TD>
                   <TD></TD>
                   <TD><P ALIGN="CENTER" class="mini">Tipo Solicitud</P></TD>
                   <TD><P ALIGN="CENTER" class="mini">Estado</P></TD>
                  </TR>';
          while ($consulta = mysql_fetch_array($consulta_tramites))
              {
			  $fecha_sol_tram=$consulta['fecha_sol_tram'];
			  $fecha_sol_tram = substr($fecha_sol_tram,8,2)."-".substr($fecha_sol_tram,5,2)."-".substr($fecha_sol_tram,0,4);
						  
                 echo '<TR>';
                 echo '<TD><P ALIGN="LETF" class="campo">'.$fecha_sol_tram;'</P></TD>';
                 echo '<TD></TD>';
                 echo '<TD><P ALIGN="CENTER" class="campo">'.$consulta['desc_tipo_tram'];'</P></TD>';
				 echo '<TD><P ALIGN="CENTER" class="campo">&nbsp;&nbsp;'.$consulta['edo_tram'];'</P></TD>';
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

  frmvalidator.addValidation("codg_tipo_tram","dontselect=0","Seleccione el tipo de Trámite");
</SCRIPT>
</BODY>
</HTML>
