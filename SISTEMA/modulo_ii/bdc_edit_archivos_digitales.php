<?
  include ("../sesion.php");

  include ("../conex.php");
?>

<HTML>
<HEAD>



        <LINK REL="STYLESHEET" HREF="../style/normal.css" TYPE="text/css">

        <SCRIPT LANGUAGE="JavaScript" SRC="../scripts/validar.js" TYPE="text/javascript"></SCRIPT>
<SCRIPT>
<?
 $consulta_archivos1 = mysql_query("SELECT codg_per, codg_tip_documento FROM bdc_archivos WHERE codg_per=$codg_per");

           if (mysql_num_rows($consulta_archivos1) != 0)
                {
                    while ($datos = mysql_fetch_array($consulta_archivos1))
                  {

                             echo 'function eliminar'.$datos["codg_per"].$datos["codg_tip_documento"].'()
                                   {

                                   input_box=confirm("¿Está seguro que desea Eliminar este Registro?");
                                   if (input_box==true)
                                   {
                                          datos.action.value="elm";
                                          datos.codg_per.value="'.$datos["codg_per"].'";
                                          datos.codg_tip_documento.value="'.$datos["codg_tip_documento"].'";
                                          datos.submit();
                                   }
                                   }';
                  }
                }

?>

function agregar()
        {
         window.open("bdc_mini_add_archivos_digitales.php?codg_per=<? echo $codg_per; ?>","_blank","scrollbars=no,status=no,toolbar=no,directories=no,menubar=no,resizable=no,width=800,height=500")
        }

function finalizar()
{
input_box=confirm("¿Está seguro que desea Finalizar?");
if (input_box==true)

{
       location = "../modulo_i/bdc_data.php";
}

}

function regresar()
        {
        location = "bdc_edit_datos_personales.php?codg_per=<? echo $codg_per; ?>&id_tab=<? echo $id_tab-1; ?>&direccion=<? echo $tabs[$seccion][$id_tab-1][4]; ?>";
        }

function actualizar()
        {
        datos.submit()
        }

</SCRIPT>
<SCRIPT>
function Ver_archivo(cedula,tipo)
        {
         window.open("bdc_mostrar_archivo_digital.php?codg_per="+cedula+"&tip="+tipo,"_blank","scrollbars=yes,status=no,toolbar=no,directories=no,menubar=no,resizable=no,width=800,height=500")
        }
</SCRIPT>
</HEAD>

<FORM METHOD="post" NAME="datos" action="">
                    <TABLE BORDER="0" ALIGN="CENTER">
                       <TR>
                       <TD WIDTH="650" COLSPAN="3">
                       <DIV ALIGN="CENTER"><P class="cabecera">Archivos Registrados</P></DIV>
                       </TD>
		      </TR>
		    </TABLE>

        <?
                $consulta_archivos = mysql_query("SELECT a.codg_per, a.codg_tip_documento, a.fec_arc_dig, t.desc_tip_documento, a.imgn_arc_dig
                                         FROM bdc_archivos a, bdc_tip_documento t
                                         WHERE a.codg_per=$codg_per AND a.codg_tip_documento=t.codg_tip_documento");

                 if (mysql_num_rows($consulta_archivos) != 0)
                 {
                 echo'<TABLE BORDER="0" ALIGN="CENTER">

                       <TR>
                       <TD WIDTH="180"><P ALIGN="CENTER" class="mini">Tipo de Documento</P></TD>
                       <TD WIDTH="180"><P ALIGN="CENTER" class="mini">Fecha del Documento</P></TD><TD WIDTH="40">&nbsp;</TD>
                       </TR> ';
                    while ($consulta = mysql_fetch_array($consulta_archivos))
                    {
                     $fec_arc_dig = $consulta["fec_arc_dig"];
                     $fec_arc_dig = substr($fec_arc_dig,8,2)."-".substr($fec_arc_dig,5,2)."-".substr($fec_arc_dig,0,4);
                     echo '<TR>
                           <TD WIDTH="100"><P ALIGN="CENTER" class="campo">'.$consulta['desc_tip_documento'].'</P></TD>
                           <TD WIDTH="120"><P ALIGN="CENTER" class="campo">'.$fec_arc_dig.'</P></TD>';
                     echo '<TD><p class="mini" ALIGN="CENTER"><INPUT TYPE="BUTTON" class="mini" VALUE="Ver" onClick="Ver_archivo('.$codg_per.','.$consulta["codg_tip_documento"].')" title="Haga click para Ver este archivo"></td><td><INPUT TYPE="BUTTON" class="mini" VALUE="Eliminar" onClick="eliminar'.$codg_per.$consulta["codg_tip_documento"].'()" title="Haga click para eliminar este archivo"></P></TD>';
                     echo '</TR>';



                     }
                     echo   '<TR>
                            <TD COLSPAN="4"><HR></TD>
                            </TR>';
                     echo '</TABLE>';
                  }
                   else
                    {
                      echo '<CENTER><P><B class="rojo">No Posee Registros</B></CENTER>';
                    }
     ?>

                <INPUT TYPE="HIDDEN" NAME="action" VALUE="">
                <INPUT TYPE="HIDDEN" NAME="codg_per" VALUE="<? echo $codg_per; ?>">
                <INPUT TYPE="HIDDEN" NAME="codg_tip_documento" VALUE="<? echo $codg_tip_documento; ?>">
<BR>
<CENTER><INPUT class="mini" TYPE="BUTTON" VALUE="Agregar" onclick="agregar()" title="Haga click para agregar un nuevo archivo">&nbsp;<INPUT class="mini" TYPE="BUTTON" VALUE="Actualizar" onclick="actualizar()" title="Haga click para regargar esta pantalla">&nbsp;<INPUT class="mini" TYPE="BUTTON" VALUE="<< Regresar" onclick="regresar()" title="Haga click para ir a la pestaña anterior">&nbsp;<INPUT class="mini" TYPE="BUTTON" VALUE="Finalizar" onclick="finalizar()" title="Haga click para finalizar la edición e ir a la pantalla inicial"></CENTER>


</FORM>
       <?

        if ($action == "elm")
         {
                $qry =("DELETE FROM bdc_archivos WHERE codg_per=$codg_per AND codg_tip_documento=$codg_tip_documento");

                mysql_query ($qry);

               echo " <SCRIPT> ";
               echo "   alert('Registro Eliminado');";
               echo '   datos.action.value="";';
               echo "   datos.submit();";
               echo "  </SCRIPT>";
      }
      ?></HTML>
