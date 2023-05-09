<?
  include ("../sesion.php");

  include ("../conex.php");

  $consulta_tramites = mysql_query ("SELECT codg_tram, desc_tram FROM bdc_tramites ORDER BY 2");
?>

<HTML>
<HEAD>
        <LINK REL="STYLESHEET" HREF="../style/normal.css" TYPE="text/css">
</HEAD>

<SCRIPT>

function buscar_pasos()
{
  if (document.tramites.codg_tram.value=="0"){
     alert("Seleccione un Trámite")
     return false
  }

  else tramites.action.value="bus";
         tramites.submit();
}

</SCRIPT>

<BODY>

<BR><BR>
<H2>Editar Pasos de un Tr&aacute;mite</H1>

<?
if ($action == "elm")
{
     mysql_query("DELETE FROM bdc_pasos WHERE codg_tram=$codg_tram and codg_paso=$codg_paso");
         echo "<SCRIPT>alert('El Paso fue Eliminado');</SCRIPT>";
}

if ($action == "bus")
{
          $consulta_desc_tram = mysql_query("SELECT desc_tram FROM bdc_tramites WHERE codg_tram=$codg_tram");
          while ($resultado_desc_tram = mysql_fetch_array($consulta_desc_tram))
          {
                  echo '<H3>Tr&aacute;mite:&nbsp'.$resultado_desc_tram["desc_tram"];echo '</H3>';
          }
          echo '
                <TABLE BORDER="0" CELLPADDING="0" ALIGN=CENTER>
                <TR>
                <TD WIDTH="80"><P class="mini" ALIGN="CENTER">N° del Paso</P></TD>
                <TD WIDTH="300"><P class="mini" ALIGN="CENTER">Descripci&oacute;n del Paso</P></TD>
                </TR>
                <TR>
                <TD COLSPAN="4"><HR></TD>
                </TR>';

          $consulta_pasos = mysql_query("SELECT codg_paso, desc_paso FROM bdc_pasos WHERE codg_tram=$codg_tram ORDER BY 1");
          while ($resultado_pasos = mysql_fetch_array($consulta_pasos))
          {
          echo '<TR>';
          echo '<TD><P class="campo" ALIGN="CENTER">'.$resultado_pasos["codg_paso"]; echo '</P></TD>';
          echo '<TD><P class="campo" ALIGN="LEFT">'.$resultado_pasos["desc_paso"]; echo'</P></TD>';
          echo '<TD WIDTH="50"><P class="mini" ALIGN="CENTER">';
          echo '<A HREF="bdc_edit_pasos.php?codg_tram='; echo $codg_tram; echo'&codg_paso='.$resultado_pasos["codg_paso"]; echo '">Editar</A></P></TD>';
          echo '<TD WIDTH="50"><P class="mini" ALIGN="CENTER">';
          echo '<A HREF="bdc_admin_pasos.php?codg_tram='; echo $codg_tram; echo '&codg_paso='.$resultado_pasos["codg_paso"]; echo '&action=elm">Eliminar</A></P></TD>';
          echo '<TR>';
          }

          echo '<TR></TR>';
          echo '<TR>';
          echo '<TD COLSPAN="4"><P class="mini" ALIGN="CENTER">Se han encontrado '.mysql_num_rows($consulta_pasos); echo' registro(s)</P></TD>';
          echo '</TR>';
          echo '</TABLE>';

          if (mysql_num_rows($consulta_pasos) == "0")
             {
                    echo '<CENTER><P><B class="rojo">Error:</B> No existen Pasos Asignados al Tr&aacute;mite</CENTER>';
             }
}
?>

        <BR>
        <FORM METHOD="POST" NAME="tramites" ACTION="bdc_admin_pasos.php">
        <TABLE BORDER="0" CELLPADDING="0" ALIGN=CENTER>

                <TR>
                <TD WIDTH="50"><P class="mini" ALIGN="RIGHT">Tr&aacute;mite:</P></TD>
                <TD WIDTH="150"><SELECT NAME="codg_tram" class="campo">
                        <OPTION VALUE="0">Seleccione...</OPTION>
                        <?
                        while ($tramites = mysql_fetch_array($consulta_tramites))
                        {
                        echo '<OPTION VALUE="'.$tramites["codg_tram"]; echo '">'.$tramites["desc_tram"]; echo '</OPTION>';
                        };
                        ?>
                        </SELECT>
                </TD>
                </TR>

                <TR>
                <TD></TD>
                <TD><INPUT TYPE="BUTTON" VALUE="Buscar" class="mini" onclick="buscar_pasos()"></TD>
                </TR>

        </TABLE>

        <INPUT TYPE="HIDDEN" NAME="action" VALUE="">

        </FORM>

</HTML>
