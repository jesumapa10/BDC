<?
  include ("../sesion.php");

  include ("../conex.php");
  
  if($codg_tip_mov==""){$codg_tip_mov=1;}else{$codg_tip_mov=$_POST['codg_tip_mov'];}
  if($codg_mov==""){$codg_mov=1;}else{$codg_mov=$_POST['codg_mov'];}
?>

<HTML>
<HEAD>



        <LINK REL="STYLESHEET" HREF="../style/normal.css" TYPE="text/css">

        <SCRIPT LANGUAGE="JavaScript" SRC="../scripts/validar.js" TYPE="text/javascript"></SCRIPT>
<SCRIPT>
<?
 $consulta_movimientos1 = mysql_query("SELECT * FROM bdc_movimientos WHERE codg_per=$codg_per and codg_mov=$codg_mov");

           if (mysql_num_rows($consulta_movimientos1) != 0)
                {
                    while ($datos = mysql_fetch_array($consulta_movimientos1))
                  {

                             echo 'function eliminar'.$codg_per.$datos["codg_mov"].'()
                                   {

                                   input_box=confirm("¿Está seguro que desea Eliminar este Registro?");
                                   if (input_box==true)
                                   {
                                          datos.action.value="elm";
                                          datos.codg_mov.value="'.$datos["codg_mov"].'";
                                          datos.submit();
                                   }
                                   }';
                  }
                }

?>

function agregar()
        {
         window.open("bdc_mini_add_mov_redireccionar.php?codg_per=<? echo $codg_per; ?>&codg_tip_mov=<? echo $codg_tip_mov; ?>","_blank","scrollbars=yes,status=no,toolbar=no,directories=no,menubar=no,resizable=no,width=800,height=500")
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
function siguiente()
        {
        location = "bdc_edit_datos_personales.php?codg_per=<? echo $codg_per; ?>&id_tab=<? echo $id_tab+1; ?>&direccion=<? echo $tabs[$seccion][$id_tab+1][4]; ?>";
        }
function consultar()
{
 window.open("bdc_consulta_mov_redireccionar.php?codg_per=<? echo $codg_per; ?>&codg_mov=<? echo $codg_mov; ?>","_blank","scrollbars=yes,status=no,toolbar=no,directories=no,menubar=no,resizable=yes,width=800,height=500")
}

function actualizar()
        {
        datos.submit()
        }

</SCRIPT>
<SCRIPT>
function imprimir()
        {
         window.open("documentos_ficha_movimientos_trabajador.php?codg_per=<? echo $codg_per; ?>","_blank","scrollbars=yes,status=no,toolbar=no,directories=no,menubar=no,resizable=no,width=800,height=500")
        }
</SCRIPT>
</HEAD>

<FORM METHOD="post" NAME="datos" action="">
<TABLE ALIGN="CENTER">
  <TR>
    <TD COLSPAN="2"><DIV ALIGN="CENTER">
      <P class="cabecera">Men&uacute; de Movimientos</P>
    </DIV></TD>
  </TR>
  <TR>
 <?PHP 
 $sql="select * from bdc_tipo_movimiento order by descp_mov";
 $busq=mysql_query($sql);
 $i=1;
 if($reg=mysql_fetch_array($busq)){
 	do{
		echo "  <TD width='196' class='mini'>".$reg['descp_mov']."</TD>
				<TD width='29'><input name='codg_tip_mov' type='radio' value='".$i."' onChange='submit()'"; if($codg_tip_mov==$i){echo "checked";} echo " title='Haga click para seleccionar esta opción para agregar'></TD>
			  </TR>";
		$i++;
	}while($reg=mysql_fetch_array($busq)); 	
 }
 ?>
    
  <TR>
    <TD width="208" class="mini">&nbsp;</TD>
    <TD width="21">&nbsp;</TD>
  </TR>
</TABLE>
<CENTER><INPUT class="mini" TYPE="BUTTON" VALUE="Agregar" onclick="agregar()" title="Haga click para agregar un nuevo dato de Movimientos según la opción seleccionada">&nbsp;<INPUT class="mini" TYPE="BUTTON" VALUE="Actualizar" onclick="actualizar()" title="Haga click para regargar esta pantalla">&nbsp;<INPUT class="mini" TYPE="BUTTON" VALUE="<< Regresar" onclick="regresar()" title="Haga click para ir a la pestaña anterior">&nbsp;<INPUT class="mini" TYPE="BUTTON" VALUE="Siguiente >>" onclick="siguiente()" title="Haga click para ir a la siguiente pestaña">&nbsp;<INPUT class="mini" TYPE="BUTTON" VALUE="Finalizar" onclick="finalizar()" title="Haga click para finalizar la edición e ir a la pantalla inicial"></CENTER>

        <TABLE BORDER="0" ALIGN="CENTER">
        <p>
          <?
                $consulta_movimientos = mysql_query("SELECT m.codg_per, m.codg_mov, m.codg_tip_mov, m.fec_mov, t.descp_mov, t.dir_add, t.dir_con FROM bdc_movimientos m, bdc_tipo_movimiento t WHERE m.codg_per=$codg_per AND m.codg_tip_mov=t.codg_tip_mov order by codg_mov DESC");

                 if (mysql_num_rows($consulta_movimientos) != 0)
                 {
                    echo '<TABLE BORDER="0" ALIGN="CENTER">
                       <TR>
                       <TD WIDTH="650" COLSPAN="3">
                       <DIV ALIGN="CENTER"><P class="cabecera">Movimientos Registrados</P></DIV>
                       </TD>
                       </TR>

                       <TR>
                       <TD WIDTH="100"><P ALIGN="CENTER" class="mini">Tipo de Movimiento</P></TD>
                       <TD WIDTH="120"><P ALIGN="CENTER" class="mini">Fecha de Registro</P></TD><TD WIDTH="40">&nbsp;</TD>
                       </TR> ';
				if($consulta = mysql_fetch_array($consulta_movimientos)){
                    do{
						 $fec_mov = $consulta["fec_mov"];
						 $fec_mov = substr($fec_mov,8,2)."-".substr($fec_mov,5,2)."-".substr($fec_mov,0,4);
						 echo '<TR>
							   <TD WIDTH="180"><P ALIGN="CENTER" class="campo">'.$consulta['descp_mov'].'</P></TD>
							   <TD WIDTH="180"><P ALIGN="CENTER" class="campo">'.$fec_mov.'</P></TD>';
						 echo '<TD><p class="mini" ALIGN="CENTER"><input name="codg_mov" type="radio" value="'.$consulta['codg_mov'].'" onClick="submit()"'; if($codg_mov==$consulta['codg_mov']){ echo 'checked'; } echo' title="Haga click para seleccionar este registro"></P></TD>';
						 //echo '<TD WIDTH="180"><CENTER><INPUT TYPE="BUTTON" class="mini" VALUE="Consulta" onClick="consulta'.$codg_per.$consulta["codg_mov"].'()">&nbsp;<INPUT TYPE="BUTTON" class="mini" VALUE="Eliminar" onClick="eliminar'.$codg_per.$consulta["codg_mov"].'()"></CENTER></TD>';
						 echo '</TR>';
                     }while ($consulta = mysql_fetch_array($consulta_movimientos));
				}
                     echo   '<TR>
                            <TD COLSPAN="3"><HR></TD>
                            </TR>';
                     echo '</TABLE>';
                     echo '<INPUT TYPE="BUTTON" class="mini" onClick="consultar()" VALUE="Consultar" title="Haga click para consultar el registro seleccionado">&nbsp;';
					 echo '<INPUT TYPE="BUTTON" class="mini" VALUE="Eliminar" onClick="eliminar'.$codg_per.$codg_mov.'()" title="Haga click para eliminar el registro seleccionado">';

                  }
                   else
                    {
                      echo '<CENTER><P><B class="rojo">No Posee Registros</B></CENTER>';
                    }
     ?>
                <br><br>
                <table>
                <TR align="center">
                <TD COLSPAN="7">
                    <?PHP echo '<a href="#" onclick="imprimir()"><img border=0 src="../images/print_ico.png" title="Imprimir Ficha de Movimientos del Trabajador">'; ?><br>Imprimir Ficha de Movimientos del Trabajador</a><br><b>NOTA:</b> El reporte solo muestra: Comisiones de Servicio, Permisos, Translados</TD>
                </TR>
                </table>
          <INPUT TYPE="HIDDEN" NAME="action" VALUE="">
          <INPUT TYPE="HIDDEN" NAME="codg_per" VALUE="<? echo $codg_per; ?>">
         
        </p>
        <p align="center"><BR>
        </p>
</FORM>
       <?

        if ($action == "elm")
         {
              $qry =("DELETE FROM bdc_movimientos WHERE codg_mov=$codg_mov");
			  mysql_query ($qry);
			  echo "  <SCRIPT>";
               echo "   alert('Registro Eliminado');";
               echo '   datos.action.value="";';
			   echo 'datos.submit();';
			   echo "  </SCRIPT>";
          }
			   
  
      ?>

</HTML>
