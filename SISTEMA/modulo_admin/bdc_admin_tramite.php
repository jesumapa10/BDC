<?
  include ("../sesion.php");

  include ("../conex.php");

  $consulta_tramites = mysql_query ("SELECT codg_tram, desc_tram FROM bdc_tramites ORDER BY 2");
?>

<HTML>
<HEAD>
        <LINK REL="STYLESHEET" HREF="../style/normal.css" TYPE="text/css">
</HEAD>

<BODY>

<BR><BR>
<H2>Edici&oacute;n de Tr&aacute;mites</H1>

<?
if ($action == "elm")
{
     mysql_query("DELETE FROM bdc_tramites WHERE codg_tram=$codg_tram");
         echo "<SCRIPT>alert('El Trámite fue Eliminado');</SCRIPT>";
}
?>

                <TABLE BORDER="0" CELLPADDING="0" ALIGN=CENTER>
                <TR>
                <TD WIDTH="300"><P class="mini" ALIGN="CENTER">Descripci&oacute;n del Tr&aacute;mite</P></TD>
                </TR>
                <TR>
                <TD COLSPAN="3"><HR></TD>
                </TR>

                <?
                $consulta_tramites = mysql_query("SELECT codg_tram, desc_tram FROM bdc_tramites ORDER BY 1");
                while ($resultado_tramites = mysql_fetch_array($consulta_tramites))
                {
                echo '<TR>';
                echo '<TD><P class="campo" ALIGN="LEFT">'.$resultado_tramites["desc_tram"]; echo '</P></TD>';
                echo '<TD WIDTH="50"><P class="mini" ALIGN="CENTER">';
                echo '<A HREF="bdc_edit_tramite.php?codg_tram='.$resultado_tramites["codg_tram"]; echo '">Editar</A></P></TD>';
                echo '<TD WIDTH="50"><P class="mini" ALIGN="CENTER">';
                echo '<A HREF="bdc_admin_tramite.php?codg_tram='.$resultado_tramites["codg_tram"]; echo '&action=elm">Eliminar</A></P></TD>';
                echo '<TR>';
                }
                ?>

                <TR></TR>
                <TR>
                <TD COLSPAN="3"><P class="mini" ALIGN="CENTER">Se han encontrado <? echo mysql_num_rows($consulta_tramites); ?> registro(s)</P></TD>
                </TR>

                </TABLE>

                <?
                if (mysql_num_rows($consulta_tramites) == "0")
                {
                      echo '<CENTER><P><B class="rojo">Error:</B> No existen Tr&aacute;mite Cargados</CENTER>';
                }
                ?>

</HTML>
