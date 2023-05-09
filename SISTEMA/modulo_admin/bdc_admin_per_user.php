<?
  include ("../sesion.php");

  include ("../conex.php");

  $consulta_grupos = mysql_query ("SELECT codg_grp, nomb_grp FROM bdc_grupos ORDER BY 2");
?>

<HTML>
<HEAD>
        <LINK REL="STYLESHEET" HREF="../style/normal.css" TYPE="text/css">
</HEAD>

<SCRIPT>

function buscar_usuarios()
{
  if (document.grupos.codg_grp.value=="0"){
     alert("Seleccione un Grupo");
     return false;
  }

  else grupos.action.value="bus";
         grupos.submit();
}

</SCRIPT>

<BR><BR>
<H2>Permisos de Usuarios</H1>

<?
if ($action == "bus")
{
     $consulta_nomb_grp = mysql_query("SELECT nomb_grp FROM bdc_grupos WHERE codg_grp=$codg_grp");
          while ($resultado_nomb_grp = mysql_fetch_array($consulta_nomb_grp))
          {
                  echo '<H3>Grupo:&nbsp'.$resultado_nomb_grp["nomb_grp"];echo '</H3>';
          }
          echo '
                <TABLE BORDER="0" CELLPADDING="0" ALIGN=CENTER>
                <TR>
                <TD WIDTH="100"><p class="mini" align=center>C&eacute;dula</TD>
                <TD WIDTH="120"><p class="mini" align=center>Nombre(s)</TD>
                <TD WIDTH="120"><p class="mini" align=center>Apellido(s)</TD>
                <TD WIDTH="100"><p class="mini" align=center>Usuario</TD>
                </TR>
                <TR>
                <TD COLSPAN="4"><HR></TD>
                </TR>';

     $consulta_usuarios = mysql_query("SELECT codg_usr, apel_usr, nomb_usr, login_usr FROM bdc_usuarios WHERE codg_grp=$codg_grp ORDER BY 3,2");
          while ($resultado_usuarios = mysql_fetch_array($consulta_usuarios))
          {
          echo '<TR>';
          echo '<TD><P class="campo" ALIGN="CENTER">'.$resultado_usuarios["codg_usr"]; echo '</P></TD>';
          echo '<TD><P class="campo">'.$resultado_usuarios["nomb_usr"];echo '</P></TD>';
          echo '<TD><P class="campo">'.$resultado_usuarios["apel_usr"];echo '</P></TD>';
          echo '<TD><P class="campo" ALIGN="CENTER">';
                  echo '<A HREF="bdc_permisos_user_rrhh.php?codg_usr='.$resultado_usuarios["codg_usr"]; echo '">'.$resultado_usuarios["login_usr"]; echo '</A></P></TD>';
          echo '<TR>';
          }

          echo '<TR></TR>';
          echo '<TR>';
          echo '<TD COLSPAN="5"><P class="mini" ALIGN="CENTER">Se han encontrado '.mysql_num_rows($consulta_usuarios); echo ' registro(s)</P></TD>';
          echo '</TR>';
          echo ' </TABLE>';

        if (mysql_num_rows($consulta_usuarios) == "0")
           {
                  echo '<CENTER><P><B class="rojo">Error:</B> No existen Usuarios del Grupo</CENTER>';
           }
}

?>

        <BR>
        <FORM METHOD="POST" NAME="grupos" ACTION="bdc_admin_per_user.php">
        <TABLE BORDER="0" CELLPADDING="0" ALIGN="CENTER">

                <TR>
                <TD WIDTH="50"><P class="mini" ALIGN="RIGHT">Grupo:</P></TD>
                <TD WIDTH="150"><SELECT class="campo" NAME="codg_grp">
                        <OPTION VALUE="0">Seleccione...</OPTION>
                        <?
                        while ($grupos = mysql_fetch_array($consulta_grupos))
                        {
                        echo '<OPTION VALUE="'.$grupos["codg_grp"]; echo '">'.$grupos["nomb_grp"]; echo '</OPTION>';
                        };
                        ?>
                        </SELECT>
                </TD>
                </TR>

                <TR>
                <TD></TD>
                <TD><INPUT TYPE="BUTTON" VALUE="Buscar" class="mini" onClick="buscar_usuarios()"></TD>
                </TR>

        </TABLE>

        <INPUT TYPE="HIDDEN" NAME="action" VALUE="">

        </FORM>

</HTML>