<?
  include ("../sesion.php");
  include ("../conex.php");
  include ("../scripts/validar_campos.php");
?>
<HTML>
<HEAD>
<SCRIPT>
function imprimir()
        {
         window.open("documentos_ficha_trabajador.php?codg_per=<? echo $codg_per; ?>","_blank","scrollbars=yes,status=no,toolbar=no,directories=no,menubar=no,resizable=no,width=800,height=500")
        }
</SCRIPT>
<SCRIPT>

function buscar_personal()  {

  if (document.consulta.codg_per.value==""){
     alert("Introduzca una c�dula")
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
                                       WHERE d.codg_per=$codg_per and d.codg_tip_trab=t.codg_tip_trab ORDER BY 1");
          while ($resultados_consulta = mysql_fetch_array($consulta_personal))
          {
          echo '<TR>';
          echo '<TD><P class="campo" ALIGN="CENTER">'.$resultados_consulta["codg_per"]; echo '</P></TD>';
          echo '<TD><P class="campo" ALIGN="CENTER">'.$resultados_consulta["nomb_per"]; echo '</P></TD>';
          echo '<TD><P class="campo" ALIGN="CENTER">'.$resultados_consulta["apel_per"]; echo '</P></TD>';
          echo '<TD><P class="campo" ALIGN="CENTER">'.$resultados_consulta["desc_tip_trab"]; echo '</P></TD>';
          echo '<TD><P class="descripcion" ALIGN="CENTER">';
          echo '<A HREF="bdc_edit_datos_personales.php?codg_per='.$resultados_consulta["codg_per"]; echo '&id_tab=1" title="Haga click para editar los datos del personal">Editar Ficha</A><br><br><a href="#" onclick="imprimir()" title="Haga click para abrir nueva ventana con la ficha lista para imprimir">Imprimir Ficha</a> </P></TD>';
          
          
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


        <FORM method=post name="consulta" action="bdc_edit_consulta_personal.php">
        <BR>
        <TABLE BORDER=0 ALIGN=CENTER>
                <TR>
                <TD><P class="mini"><B>C&eacute;dula:</B></TD>
                <TD><INPUT TYPE="TEXT" NAME="codg_per" onKeyPress="return solo_numeros(this.form.numeexte, event)" class="campo" VALUE="<? echo $codg_per; ?>" SIZE="10" MAXLENGTH="8" title="Ingrese el N�mero de c�dula del personal que desea buscar"></TD>
                </TR>

                <TR>
                <TD></TD>
                <TD ALIGN="RIGHT"><INPUT TYPE="BUTTON" VALUE="Buscar" class="mini" onClick="buscar_personal()" title="Haga Click para inciar busqueda..."></TD>
                </TR>
        </TABLE>


        <INPUT TYPE="HIDDEN" NAME="action" VALUE="bus">

        </FORM>

</HTML>
