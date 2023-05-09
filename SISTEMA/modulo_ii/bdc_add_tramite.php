<?
  include ("../sesion.php");
  include ("../conex.php");
  include ("../scripts/validar_campos.php");
?>
<HTML>
<HEAD>
<SCRIPT>
function agregar()
        {
         window.open("bdc_mini_add_datos_tramites.php?codg_per=<? echo $codg_per; ?>&codg_tip_mov=3","_blank","scrollbars=no,status=no,toolbar=no,directories=no,menubar=no,resizable=no,width=800,height=500")
        }

function buscar_personal()  {

  if (document.consulta.codg_per.value==""){
     alert("Introduzca una cédula")
     return false
  }

  else consulta.action.value="bus";
         consulta.submit();
}

</SCRIPT>
        <LINK REL="STYLESHEET" HREF="../style/normal.css" TYPE="text/css">

        <SCRIPT LANGUAGE="JavaScript" SRC="../scripts/validar.js" TYPE="text/javascript"></SCRIPT>
</HEAD>

<BR><BR>
<H2>Solicitudes de Tr&aacute;mites </H2>

<FORM method=post name="consulta" action="">
        <BR>
<TABLE BORDER=0 ALIGN=CENTER>
                <TR>
                <TD><P class="mini"><B>Introduzca la C&eacute;dula:</B></TD>
                <TD><INPUT TYPE="TEXT" NAME="codg_per" onKeyPress="return solo_numeros(this.form.numeexte, event)" class="campo" VALUE="<? echo $codg_per; ?>" SIZE="10" MAXLENGTH="8">
                  <input name="BUTTON" type="BUTTON" class="mini" onClick="buscar_personal()" value="Buscar"></TD>
                </TR>
        </TABLE>


        <INPUT TYPE="HIDDEN" NAME="action" VALUE="bus">

</FORM>

<p>
  <?
if ($action == "bus")
{
  echo '<TABLE ALIGN="CENTER">
                <TR>
                <TD COLSPAN="4">
                <DIV ALIGN="CENTER"><P class="cabecera">Datos Personales</P></DIV>
                </TD>
                </TR>

                <TR>
                <TD WIDTH="80"><p class="mini" ALIGN="CENTER">C&eacute;dula</P></TD>
                <TD WIDTH="150"><p class="mini" ALIGN="CENTER">Nombre(s)</P></TD>
                <TD WIDTH="150"><p class="mini" ALIGN="CENTER">Apellido(s)</P></TD>
                <TD WIDTH="100"><p class="mini" ALIGN="CENTER">Tipo de Trabajador</P></TD>
                </TR>';

     $consulta_personal = mysql_query("SELECT d.codg_per, d.nomb_per, d.apel_per, t.desc_tip_trab
                                       FROM bdc_datos_per d, bdc_tip_trab t
                                       WHERE d.codg_per=$codg_per and d.codg_tip_trab=t.codg_tip_trab ORDER BY 1");
          while ($resultados_consulta = mysql_fetch_array($consulta_personal))
          {
          echo '<TR>';
          echo '<TD><P class="campo" ALIGN="CENTER">'.$resultados_consulta["codg_per"]; echo '</P></TD>';
          echo '<TD><P class="campo" ALIGN="CENTER">'.$resultados_consulta["nomb_per"]; echo '</P></TD>';
          echo '<TD><P class="campo" ALIGN="CENTER">'.$resultados_consulta["apel_per"]; echo '</P></TD>';
          echo '<TD><P class="campo" ALIGN="CENTER">'.$resultados_consulta["desc_tip_trab"]; echo '</P></TD>';
          echo '<TD><P class="descripcion" ALIGN="CENTER">';
          echo '<A HREF="bdc_edit_datos_personales.php?codg_per='.$resultados_consulta["codg_per"]; echo '&id_tab=1"></A></P></TD>';
          echo '</TR>';
          }

          echo '<TR>';
          echo '<TD COLSPAN="4"><HR WIDTH="90%">';
		  echo '<p align="center">
  <INPUT name="BUTTON2" TYPE="BUTTON" class="mini" onclick="agregar()" VALUE="Agregar">
</p>';
          echo '</TD></TR>';
  echo '</TABLE>';

        if (mysql_num_rows($consulta_personal) == "0")
           {
                  echo '<CENTER><P><B class="rojo">Error:</B> No existen Registros</CENTER>';
           }

}
?>
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
?>
</p>

</HTML>
