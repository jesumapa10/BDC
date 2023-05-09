<?
  include ("../sesion.php");
  include ("../conex.php");
  include ("../scripts/validar_campos.php");
?>
<HTML>
<HEAD>
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

        <FORM METHOD="POST" NAME="consulta" ACTION="bdc_consulta_personal.php">
        <BR>
        <TABLE BORDER="0" ALIGN="CENTER">
                <TR>
                <TD><P class="mini"><B>C&eacute;dula:</B></TD>
                <TD><INPUT TYPE="TEXT" onKeyPress="return solo_numeros(this.form.numeexte, event)" NAME="codg_per" class="campo" VALUE="<? echo $codg_per; ?>" SIZE="10" MAXLENGTH="8"></TD>
                </TR>

                <TR>
                <TD></TD>
                <TD ALIGN="RIGHT"><INPUT TYPE="SUBMIT" VALUE="Buscar" class="mini"></TD>
                </TR>
        </TABLE>

        <INPUT TYPE="HIDDEN" NAME="action" VALUE="bus">

        </FORM>

<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">

  var frmvalidator  = new Validator("consulta");

  frmvalidator.addValidation("codg_per","req","Ingrese la Cédula de la Persona a Consultar");

  frmvalidator.setAddnlValidationFunction("actualizar");

</SCRIPT>

</HTML>
