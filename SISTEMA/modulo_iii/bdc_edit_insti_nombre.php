<?
  include ("../sesion.php");

  include ("../conex.php");
?>
<HTML>
<HEAD>
<LINK REL="STYLESHEET" HREF="../style/normal.css" TYPE="text/css">
<SCRIPT>
function imprimir_ficha(codigo)
        {
         window.open("documentos_ficha_instituciones.php?codg_insti="+codigo,"_blank","scrollbars=yes,status=no,toolbar=no,directories=no,menubar=no,resizable=no,width=800,height=500")
        }

function buscar_insti()  {

         consulta.action.value="bus";
         consulta.submit();
}

</SCRIPT>
</HEAD>

<BR>
<BR>
<H2>Consulta de Instituciones</H2>

<?

if($action =="bus")
{
       echo'<TABLE ALIGN="CENTER" BORDER="0">
                <TR>
                <TD COLSPAN="7">
                <DIV ALIGN="CENTER"><P class="cabecera">Resultados de la B&uacute;squeda</P></DIV>
                </TD>
                </TR>

                <TR>
                <TD WIDTH="400"><p class="mini" align=center>Nombre</TD>
                <TD WIDTH="130"><p class="mini" align=center>Municipio</TD>
                <TD WIDTH="130"><p class="mini" align=center>Tipo de Instituci&oacute;n</TD>
                <TD WIDTH="180"><p class="mini" align=center>Modalidad</TD>
                </TR>';

                $consulta_insti = mysql_query("SELECT bdc_instituciones.codg_insti, bdc_instituciones.nomb_insti, bdc_municipios.nomb_mun, bdc_mod_plantel.desc_mod_plantel, bdc_tip_plantel.desc_tip_plantel FROM (((bdc_plantel RIGHT JOIN bdc_instituciones ON bdc_plantel.codg_insti = bdc_instituciones.codg_insti) LEFT JOIN bdc_municipios ON (bdc_instituciones.codg_pais = bdc_municipios.codg_pais) AND (bdc_instituciones.codg_est = bdc_municipios.codg_est) AND (bdc_instituciones.codg_mun = bdc_municipios.codg_mun)) LEFT JOIN bdc_mod_plantel ON bdc_plantel.codg_mod_plantel = bdc_mod_plantel.codg_mod_plantel) LEFT JOIN bdc_tip_plantel ON bdc_plantel.codg_tip_plantel = bdc_tip_plantel.codg_tip_plantel WHERE (((bdc_instituciones.nomb_insti) Like '%$nomb_insti%')) ORDER BY 3,2;");

       if (mysql_num_rows($consulta_insti) != 0)
         {

               while ($datos2 = mysql_fetch_array($consulta_insti))
               {
                 				
              echo'<TR>';
			  echo'<TD><p class="campo" align="left">'.$datos2["nomb_insti"];echo'</TD>';
              echo'<TD><p class="campo" align="center">'.$datos2["nomb_mun"];echo'</TD>';
			  echo'<TD><p class="campo" align="center">'.$datos2["desc_tip_plantel"];echo'</TD>';
              echo'<TD><p class="campo" align="left">'.$datos2["desc_mod_plantel"];echo'</TD>';
              echo'<TD><p class="descripcion" align=center><A HREF="bdc_edit_datos_instituciones.php?codg_insti='.$datos2["codg_insti"];echo'">Ver Ficha</A></td>';
	      echo'<TD><p class="descripcion" align=center><A HREF="#" onclick="imprimir_ficha('.$datos2["codg_insti"].')">Imprimir Ficha</A></td>';
	      echo '<td class="descripcion"><A HREF="bdc_consulta_insti_nombre.php?codg_insti='.$datos2["codg_insti"]; echo '&action=elm">&nbsp;&nbsp;&nbsp;Eliminar</P></A></TD>';
          echo '<TR>';
              $codg_insti=$datos2["codg_insti"];

              }
               echo '<TR>
                     <TD COLSPAN="7"><HR WIDTH="90%"></TD>
                     </TR>

                     <TR>
                     <TD COLSPAN="4"><P class="mini" ALIGN="CENTER">Se han encontrado '.mysql_num_rows($consulta_insti).' registro(s)</P></TD>
                     </TR>

                   </TABLE> ';
             }
           else
           {
            echo'    <CENTER><P><B class="rojo">Error:</B> No existen Registros</CENTER>';
           }
     }
if ($action == "elm")
{
     mysql_query("DELETE FROM bdc_instituciones WHERE codg_insti=$codg_insti");
	 mysql_query("DELETE FROM bdc_plantel WHERE codg_insti=$codg_insti");
         echo "<SCRIPT>alert('La Institución fue Eliminada');</SCRIPT>";
}
?>
  <FORM method=post name="consulta" action="bdc_edit_insti_nombre.php">
        <BR>
        <TABLE BORDER=0 ALIGN=CENTER>
                <TR>
                <TD><P class="mini"><B>Nombre de la Instituci&oacute;n:</B></TD>
                <TD><INPUT TYPE=TEXT NAME=nomb_insti class="campo" VALUE="<? echo $nomb_insti; ?>" SIZE="30" MAXLENGTH="30"></TD>
                </TR>

                <TR>
                <TD></TD>
                <TD ALIGN="RIGHT"><INPUT TYPE=BUTTON VALUE="Buscar" class="mini" onClick="buscar_insti()"></TD>
                </TR>
        </TABLE>


        <INPUT TYPE=HIDDEN NAME="action" VALUE="">

        </FORM>

</HTML>
