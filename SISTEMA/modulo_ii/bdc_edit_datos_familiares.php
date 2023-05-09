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
 $consulta_familiares = mysql_query("SELECT codg_per, codg_carga_fam FROM bdc_carga_fam WHERE codg_per=$codg_per");

           if (mysql_num_rows($consulta_familiares) != 0)
                {
                    while ($datos = mysql_fetch_array($consulta_familiares))
                  {

                             echo 'function eliminar'.$codg_per.$datos["codg_carga_fam"].'()
                                   {

                                   input_box=confirm("¿Está seguro que desea Eliminar este Registro?");
                                   if (input_box==true)
                                   {
                                          datos.action.value="elm";
                                          datos.codg_per.value="'.$datos["codg_per"].'";
                                          datos.codg_carga_fam.value="'.$datos["codg_carga_fam"].'";
                                          datos.submit();
                                   }
                                   }

                                   function editar'.$codg_per.$datos["codg_carga_fam"].'()
                                   {
                                         window.open("bdc_editor_datos_familiares.php?codg_per='.$datos["codg_per"].'&codg_carga_fam='.$datos["codg_carga_fam"].'","_blank","scrollbars=no,status=no,toolbar=no,directories=no,menubar=no,resizable=no,width=1000,height=480")

                                   }';
                  }
                }
?>

function agregar()
        {
         window.open("bdc_mini_add_datos_familiares.php?codg_per=<? echo $codg_per; ?>","_blank","scrollbars=no,status=no,toolbar=no,directories=no,menubar=no,resizable=no,width=800,height=500")
        }

function finalizar()
{
input_box=confirm("¿Está seguro que desea Finalizar?");
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

</SCRIPT>

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
                <TD WIDTH="770"><DIV ALIGN="center"><P class="cabecera">Datos Familiares</P></DIV></TD>
                </TR>
  </TABLE>


<?
   $consulta_familiares = mysql_query("SELECT * FROM bdc_carga_fam WHERE codg_per=$codg_per");

        
            echo '<TABLE BORDER="0" ALIGN="CENTER">';

 if (mysql_num_rows($consulta_familiares) != 0)
    {
               echo '<TR>
                   <TD WIDTH="70"><P ALIGN="CENTER" class="mini">C&eacute;dula</P></TD>

                   <TD WIDTH="70"><P ALIGN="CENTER" class="mini">Nombres</P></TD>

                   <TD WIDTH="70"><P ALIGN="CENTER" class="mini">Apellidos</P></TD>

                   <TD WIDTH="70"><P ALIGN="CENTER" class="mini">Fecha de<BR>Nacimiento</P></TD>

                   <TD WIDTH="70"><P ALIGN="CENTER" class="mini">Parentesco</P></TD>

                   <TD WIDTH="70"><P ALIGN="CENTER" class="mini">Sexo</P></TD>

                   <TD WIDTH="70"><P ALIGN="CENTER" class="mini">¿Estudia?</P></TD>

                   <TD WIDTH="70"><P ALIGN="CENTER" class="mini">Nivel de Instrucci&oacute;n</P></TD>

                  </TR>';
          while ($consulta = mysql_fetch_array($consulta_familiares))
              {
                 $fec_nac_carga_fam = $consulta['fec_nac_carga_fam'];
                 $fec_nac_carga_fam = substr($fec_nac_carga_fam,8,2)."-".substr($fec_nac_carga_fam,5,2)."-".substr($fec_nac_carga_fam,0,4);
                 echo '<TR>';
                 echo '<TD WIDTH="70"><P ALIGN="LETF" class="campo">'.$consulta['codg_carga_fam'].'</P></TD>';
                 echo '<TD WIDTH="70"><P ALIGN="LETF" class="campo">'.$consulta['nomb_carga_fam'].'</P></TD>';
                 echo '<TD WIDTH="70"><P ALIGN="LETF" class="campo">'.$consulta['apel_carga_fam'].'</P></TD>';
                 echo '<TD WIDTH="70"><P ALIGN="CENTER" class="campo">'.$fec_nac_carga_fam.'</P></TD>';
                 echo '<TD WIDTH="70"><P ALIGN="CENTER" class="campo">'; if($consulta['paren_carga_fam']=="C"){echo "Cónyugue";}
                                                            if($consulta['paren_carga_fam']=="P"){echo "Padre";}
                                                            if($consulta['paren_carga_fam']=="M"){echo "Madre";}
                                                            if($consulta['paren_carga_fam']=="H"){echo "Hijo";}
                echo '</P></TD>';

                echo '<TD WIDTH="70"><P ALIGN="CENTER" class="campo">'; if($consulta['sexo_carga_fam']=="M"){echo "Masculino";}
                                                            if($consulta['sexo_carga_fam']=="F"){echo "Femenino";}

                echo '</P></TD>';

                echo '<TD WIDTH="70"><P ALIGN="CENTER" class="campo">'; if($consulta['estudia_carga_fam']=="S"){echo "Si";}
                                                            if($consulta['estudia_carga_fam']=="N"){echo "No";}

                echo '</P></TD>';

                echo '<TD WIDTH="70"><P ALIGN="CENTER" class="campo">'; if($consulta['nivel_est_carga_fam']=="P"){echo "Primaria";}
                                                            if($consulta['nivel_est_carga_fam']=="B"){echo "Bachillerato";}
                                                            if($consulta['nivel_est_carga_fam']=="M"){echo "Media";}
                                                            if($consulta['nivel_est_carga_fam']=="U"){echo "Universitario";}
                                                            if($consulta['nivel_est_carga_fam']=="A"){echo "A";}
                                                            if($consulta['nivel_est_carga_fam']=="E"){echo "E";}

                echo '</P></TD>';

                echo '<TD>';
                echo '<CENTER><INPUT TYPE="BUTTON" class="mini" VALUE="Editar" onClick="editar'.$codg_per.$consulta["codg_carga_fam"].'()" title="Haga click para editar este registro">&nbsp;<INPUT TYPE="BUTTON" class="mini" VALUE="Eliminar" onClick="eliminar'.$codg_per.$consulta["codg_carga_fam"].'()" title="Haga click para eliminar este registro"></CENTER>';
                echo'</P></TD>';
                echo '</TR>';
               }
    }
        else
        {
            echo '<CENTER><P><B class="rojo">No Posee Registros</B></CENTER>';
        }

?>


                <TR>
                <TD COLSPAN="8"><HR></TD>
                </TR>


        </TABLE>


                <INPUT TYPE="HIDDEN" NAME="action" VALUE="">
                <INPUT TYPE="HIDDEN" NAME="codg_per" VALUE="<? echo $codg_per; ?>">
                <INPUT TYPE="HIDDEN" NAME="codg_carga_fam" VALUE="<? echo $codg_carga_fam; ?>">
<BR>
<CENTER><INPUT class="mini" TYPE="BUTTON" VALUE="Agregar" onclick="agregar()" title="Haga click para agregar un nuevo dato familiar">&nbsp;<INPUT class="mini" TYPE="BUTTON" VALUE="Actualizar" onclick="actualizar()" title="Haga click para regargar esta pantalla">&nbsp;<INPUT class="mini" TYPE="BUTTON" VALUE="<< Regresar" onclick="regresar()" title="Haga click para ir a la pestaña anterior">&nbsp;<INPUT class="mini" TYPE="BUTTON" VALUE="Siguiente >>" onclick="siguiente()" title="Haga click para ir a la siguiente pestaña">&nbsp;<INPUT class="mini" TYPE="BUTTON" VALUE="Finalizar" onclick="finalizar()" title="Haga click para finalizar la edición e ir a la pantalla inicial"></CENTER>
<BR>
</FORM>
<? if ($action == "elm")
    {
      $qry = ("DELETE FROM bdc_carga_fam WHERE codg_per=$codg_per AND codg_carga_fam=$codg_carga_fam");

                       mysql_query ($qry);

               echo " <SCRIPT> ";
               echo "   alert('Registro Eliminado');";
               echo '   datos.action.value="";';
               echo "   datos.submit();";
               echo "  </SCRIPT>";
      }
?>



</HTML>
