<?
  include ("../sesion.php");

  include ("../conex.php");
?>
<HTML>
<HEAD>
        <LINK REL="STYLESHEET" HREF="../style/normal.css" TYPE="text/css">

        <SCRIPT LANGUAGE="JavaScript" SRC="../scripts/validar.js" TYPE="text/javascript"></SCRIPT>
</HEAD>

<BR><BR>
<SCRIPT>

function buscar_personal()  {

         consulta.action.value="bus";
         consulta.submit();
}

</SCRIPT>
</HEAD>

<BR>
<H2>Consulta de Personal</H2>

<?
if ($action == "bus")
{
  echo '<TABLE ALIGN="CENTER">
                <TR>
                <TD COLSPAN="4">
                <DIV ALIGN="CENTER"><P class="cabecera">Resultados de la B&uacute;squeda</P></DIV>
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
                                       WHERE d.apel_per LIKE '%$apel_per%' AND d.nomb_per LIKE '%$nomb_per%' AND d.codg_tip_trab=t.codg_tip_trab ORDER BY 2,3");
    
          while ($resultados_consulta = mysql_fetch_array($consulta_personal))
          {
          echo '<TR>';
          echo '<TD><P class="campo" ALIGN="CENTER">'.$resultados_consulta["codg_per"]; echo '</P></TD>';
          echo '<TD><P class="campo" ALIGN="CENTER">'.$resultados_consulta["nomb_per"]; echo '</P></TD>';
          echo '<TD><P class="campo" ALIGN="CENTER">'.$resultados_consulta["apel_per"]; echo '</P></TD>';
          echo '<TD><P class="campo" ALIGN="CENTER">'.$resultados_consulta["desc_tip_trab"]; echo '</P></TD>';
          echo '<TD><P class="descripcion" ALIGN="CENTER">';
          echo '<A HREF="bdc_datos_personales.php?codg_per='.$resultados_consulta["codg_per"]; echo '&id_tab=1">Ver Ficha</A></P></TD>';
          echo '</TR>';
          }

          echo '<TR>';
          echo '<TD COLSPAN="4"><HR WIDTH="90%"></TD>';
          echo '</TR>';
  echo '</TABLE>';

        if (mysql_num_rows($consulta_personal) == "0")
           {
                  echo '<CENTER><P><B class="rojo">Error:</B> No existen Registros</CENTER>';
           }

}
?>

        <FORM method=post name="consulta" action="bdc_consulta_personal_nomapel.php">
        <BR>
        <TABLE BORDER=0 ALIGN=CENTER>
                <TR>
                <TD><P class="mini"><B>Nombre(s):</B></TD>
                <TD><INPUT TYPE=TEXT NAME=nomb_per class="campo" VALUE="<? echo $nomb_per; ?>" SIZE="30" MAXLENGTH="30"></TD>
                </TR>

                <TR>
                <TD><P class="mini"><B>Apellido(s):</B></TD>
                <TD><INPUT TYPE=TEXT NAME=apel_per class="campo" VALUE="<? echo $apel_per; ?>" SIZE="30" MAXLENGTH="30"></TD>
                </TR>

                <TR>
                <TD></TD>
                <TD ALIGN="RIGHT"><INPUT TYPE=BUTTON VALUE="Buscar" class="mini" onClick="buscar_personal()"></TD>
                </TR>
        </TABLE>


        <INPUT TYPE="HIDDEN" NAME="action" VALUE="bus">

        </FORM>

</HTML>
