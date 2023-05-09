<?
  include ("../sesion.php");

  include ("../conex.php");
?>

<HTML>
<HEAD>
        <LINK REL="STYLESHEET" HREF="../style/normal.css" TYPE="text/css">
</HEAD>
<?
if ($action == "elm")
{
     mysql_query("DELETE FROM bdc_grupos WHERE codg_grp='$codg_grp'");
         echo "<SCRIPT>alert('El Grupo fue Eliminado');</SCRIPT>";
}
?>
<BR><BR>
<H2>Edici&oacute;n de Grupos</H2>

                <TABLE BORDER="0" CELLPADDING="0" ALIGN=CENTER>

                <TR>
                <TD WIDTH="100"><P class="mini" ALIGN="CENTER">C&oacute;digo del Grupo</P></TD>
                <TD WIDTH="200"><P class="mini" ALIGN="CENTER">Descripci&oacute;n del Grupo</P></TD>
                </TR>
                <TR>
                <TD COLSPAN="4"><HR></TD>
                </TR>

                <?
                $consulta_grupos = mysql_query("SELECT codg_grp, nomb_grp FROM bdc_grupos ORDER BY 1");
                while ($grupos = mysql_fetch_array($consulta_grupos))
                {
                echo '<TR>';
                echo '<TD><P class="campo" ALIGN="CENTER">'.$grupos["codg_grp"]; echo '</P></TD>';
                echo '<TD><P class="campo" ALIGN="LEFT">'.$grupos["nomb_grp"]; echo '</P></TD>';
                echo '<TD WIDTH="50"><P class="mini" ALIGN="CENTER">';
                echo '<A HREF="bdc_edit_grupo.php?codg_grp='.$grupos["codg_grp"]; echo'">Editar</A></P></TD>';
                echo '<TD WIDTH="50"><P class="mini" ALIGN="CENTER">';
                echo '<A HREF="bdc_admin_grupo.php?codg_grp='.$grupos["codg_grp"]; echo'&action=elm">Eliminar</A></P></TD>';
                echo '<TR>';
                };
                ?>

                <TR></TR>
                <TR>
                <TD COLSPAN="4"><P class="mini" ALIGN="CENTER">Se han encontrado <? echo mysql_num_rows($consulta_grupos); ?> registro(s)</P></TD>
                </TR>

                </TABLE>



</HTML>