<?
  include ("../sesion.php");

  include ("../conex.php");
?>
<HTML>
<HEAD>
        <LINK REL="STYLESHEET" HREF="../style/normal.css" TYPE="text/css">

        <SCRIPT LANGUAGE="JavaScript" SRC="../scripts/validar.js" TYPE="text/javascript"></SCRIPT>

<SCRIPT>

function agregar()
        {
          window.open("bdc_mini_add_datos_gremiales.php?codg_per=<? echo $codg_per; ?>","_blank","scrollbars=no,status=no,toolbar=no,directories=no,menubar=no,resizable=no,width=800,height=500")
        }

function finalizar()
{
input_box=confirm("�Est� seguro que desea Finalizar?");
if (input_box==true)

{
      location = "../modulo_i/bdc_data.php";
}

}

function siguiente()
        {
        location = "bdc_edit_datos_personales.php?codg_per=<? echo $codg_per; ?>&id_tab=<? echo $id_tab+1; ?>&direccion=<? echo $tabs[$seccion][$id_tab+1][4]; ?>";
        }

function regresar()
        {
        location = "bdc_edit_datos_personales.php?codg_per=<? echo $codg_per; ?>&id_tab=<? echo $id_tab-1; ?>&direccion=<? echo $tabs[$seccion][$id_tab-1][4]; ?>";
        }

function actualizar()
        {
        datos.submit()
        }
<?
 $consulta_gremios1 = mysql_query("SELECT codg_per, codg_grem FROM bdc_datos_grem WHERE codg_per=$codg_per");

           if (mysql_num_rows($consulta_gremios1) != 0)
                {
                    while ($datos = mysql_fetch_array($consulta_gremios1))
                  {

                             echo 'function eliminar'.$codg_per.$datos["codg_grem"].'()
                                   {

                                   input_box=confirm("�Est� seguro que desea Eliminar este Registro?");
                                   if (input_box==true)
                                   {
                                          datos.action.value="elm";
                                          datos.codg_per.value="'.$datos["codg_per"].'";
                                          datos.codg_grem.value="'.$datos["codg_grem"].'";
                                          datos.submit();
                                   }
                                   }

                                   function editar'.$codg_per.$datos["codg_grem"].'()
                                   {
                                         window.open("bdc_editor_datos_gremiales.php?codg_per='.$datos["codg_per"].'&codg_grem='.$datos["codg_grem"].'","_blank","scrollbars=no,status=no,toolbar=no,directories=no,menubar=no,resizable=no,width=1000,height=480")

                                   }';
                  }
                }

?>
</SCRIPT>
</HEAD>

<?
$consulta = mysql_query("SELECT d.apel_per, d.nomb_per, d.naci_per, t.desc_tip_trab
                 FROM bdc_datos_per d, bdc_tip_trab t
                 WHERE d.codg_per=$codg_per AND d.codg_tip_trab=t.codg_tip_trab");

$datos = mysql_fetch_array($consulta);

$apel_per = $datos["apel_per"];
$nomb_per = $datos["nomb_per"];
$naci_per = $datos["naci_per"];
$desc_tip_trab = $datos["desc_tip_trab"];

?>

<FORM METHOD="post" NAME="datos" action="">
  <TABLE BORDER="0" ALIGN="center">
    <TR>
      <TD WIDTH="900"><DIV ALIGN="center">
        <P class="cabecera">Datos Gremiales </P>
      </DIV></TD>
    </TR>
	</TABLE>
                        <?
                        $consulta_gremios = mysql_query("SELECT g.nomb_grem, d.codg_per, d.fec_dgrem, d.codg_grem
                                         FROM bdc_gremios g, bdc_datos_grem d
                                         WHERE d.codg_per=$codg_per AND d.codg_grem=g.codg_grem");


                         if (mysql_num_rows($consulta_gremios) != 0)
                         {
                         echo '<TABLE BORDER="0" ALIGN="CENTER">
                              <TR>
                               <TD WIDTH="150"><P ALIGN="CENTER" class="mini">Nombre de la Aosicaci&oacute;n:</P></TD>
                               <TD WIDTH="100"><P ALIGN="CENTER" class="mini">Fecha de Afiliaci&oacute;n:</P></TD>
                              </TR>';

                         while ($consulta = mysql_fetch_array($consulta_gremios))
                           {
                           $fec_dgrem = $consulta["fec_dgrem"];
                           $fec_dgrem = substr($fec_dgrem,8,2)."-".substr($fec_dgrem,5,2)."-".substr($fec_dgrem,0,4);

                           echo '<TR>';
                           echo '<TD><P ALIGN="CENTER" class="campo">'.$consulta['nomb_grem'];'</P></TD>';
                           echo '<TD><P ALIGN="CENTER" class="campo">'.$fec_dgrem;'</P></TD>';
                           echo '<TD><p class="mini" ALIGN="CENTER"><INPUT TYPE="BUTTON" class="mini" VALUE="Editar" onClick="editar'.$codg_per.$consulta["codg_grem"].'()" title="Haga click para editar este registro">&nbsp;<INPUT TYPE="BUTTON" class="mini" VALUE="Eliminar" onClick="eliminar'.$codg_per.$consulta["codg_grem"].'()" title="Haga click para eliminar este registro"></TD>';
                           echo '</TR>';
                           }
                           echo '<TR>
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
                <INPUT TYPE="HIDDEN" NAME="codg_grem" VALUE="<? echo $codg_grem; ?>">

<BR>
<CENTER><INPUT class="mini" TYPE="BUTTON" VALUE="Agregar" onclick="agregar()" title="Haga click para agregar un nuevo dato Gremial">&nbsp;<INPUT class="mini" TYPE="BUTTON" VALUE="Actualizar" onclick="actualizar()" title="Haga click para regargar esta pantalla">&nbsp;<INPUT class="mini" TYPE="BUTTON" VALUE="<< Regresar" onclick="regresar()" title="Haga click para ir a la pesta�a anterior">&nbsp;<INPUT class="mini" TYPE="BUTTON" VALUE="Siguiente >>" onclick="siguiente()" title="Haga click para ir a la siguiente pesta�a">&nbsp;<INPUT class="mini" TYPE="BUTTON" VALUE="Finalizar" onclick="finalizar()" title="Haga click para finalizar la edici�n e ir a la pantalla inicial"></CENTER>
</FORM>

        <?

        if ($action == "elm")
         {
                $qry =("DELETE FROM bdc_datos_grem WHERE codg_per=$codg_per AND codg_grem=$codg_grem");

                mysql_query ($qry);

               echo " <SCRIPT> ";
               echo "   alert('Registro Eliminado');";
               echo '   datos.action.value="";';
               echo "   datos.submit();";
               echo "  </SCRIPT>";
      }
      ?>
</HTML>
