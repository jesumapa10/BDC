<?
  include ("../sesion.php");

  include ("../conex.php");
?>

<HTML>
<HEAD>
        <LINK REL="STYLESHEET" HREF="../style/normal.css" TYPE="text/css">
</HEAD>

<BODY>
<BR><BR>
<H2>Edici&oacute;n de Especialidades</H1>

<?
if ($action == "elm")
  {
          mysql_query("DELETE FROM bdc_especialidades WHERE codg_espec=$codg_espec");
          echo "<SCRIPT>alert('Registro Eliminado');</SCRIPT>";
  }
?>

                <TABLE BORDER="0" CELLPADDING="0" ALIGN=CENTER>
                <TR>
                <TD WIDTH="200"><P class="mini" ALIGN="CENTER">Descripci&oacute;n de la Especialidad</P></TD>
                </TR>
                <TR>
                <TD COLSPAN="3"><HR></TD>
                </TR>

                <?
                $consulta_espec = mysql_query("SELECT codg_espec, desc_espec FROM bdc_especialidades ORDER BY 2");
                while ($especialidades = mysql_fetch_array($consulta_espec))
                {
                echo '<TR>';
                echo '<TD><P class="campo" ALIGN="LEFT">&nbsp;&nbsp;'.$especialidades["desc_espec"];echo'</P></TD>';
                echo '<TD WIDTH="50"><P class="mini" ALIGN="CENTER">';
                echo '<A HREF="bdc_edit_especialidades.php?codg_espec='.$especialidades["codg_espec"]; echo'">Editar</A></P></TD>';
                echo '<TD WIDTH="50"><P class="mini" ALIGN="CENTER">';
                echo '<A HREF="bdc_admin_especialidades.php?codg_espec='.$especialidades["codg_espec"]; echo '&action=elm">Eliminar</A></P></TD>';
                echo '<TR>';
                }
                ?>

                <TR></TR>
                <TR>
                <TD COLSPAN="3"><P class="mini" ALIGN="CENTER">Se han encontrado <? echo mysql_num_rows($consulta_espec); ?> registro(s)</P></TD>
                </TR>

                </TABLE>

</HTML>
