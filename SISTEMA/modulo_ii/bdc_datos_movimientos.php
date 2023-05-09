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
         window.open("bdc_mini_add_mov_redireccionar.php?codg_per=<? echo $codg_per; ?>&codg_tip_mov=<? echo $codg_tip_mov; ?>","_blank","scrollbars=no,status=no,toolbar=no,directories=no,menubar=no,resizable=no,width=800,height=500")
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

function consultar(){

 window.open("bdc_consulta_mov_redireccionar.php?codg_per=<? echo $codg_per; ?>&codg_mov=<? echo $codg_mov; ?>","_blank","scrollbars=yes,status=no,toolbar=no,directories=no,menubar=no,resizable=yes,width=800,height=500")
}

function actualizar()
        {
        datos.submit()
        }

</SCRIPT>
</HEAD>



        <TABLE BORDER="0" ALIGN="CENTER">
                       <TR>
                       <TD WIDTH="900" COLSPAN="3">
                       <DIV ALIGN="CENTER"><P class="cabecera">Movimientos Registrados</P></DIV>
                       </TD>
                       </TR>
		</TABLE>
        <p>
          <?
                $consulta_movimientos = mysql_query("SELECT m.codg_per, m.codg_mov, m.codg_tip_mov, m.fec_mov, t.descp_mov, t.dir_add, t.dir_con FROM bdc_movimientos m, bdc_tipo_movimiento t WHERE m.codg_per=$codg_per AND m.codg_tip_mov=t.codg_tip_mov order by codg_mov DESC");

                 if (mysql_num_rows($consulta_movimientos) != 0)
                 {
                    echo '<TABLE BORDER="0" ALIGN="CENTER">
                       <TR>
                       <TD WIDTH="650" COLSPAN="3">
                 
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
						 //echo '<TD><p class="mini" ALIGN="CENTER"><input name="codg_mov" type="radio" value="'.$consulta['codg_mov'].'" onClick="submit()"'; if($codg_mov==$consulta['codg_mov']){ echo 'checked'; } echo'></P></TD>';
						 echo '</TR>';
                     }while ($consulta = mysql_fetch_array($consulta_movimientos));
				}
                     echo   '<TR>
                            <TD COLSPAN="3"><HR></TD>
                            </TR>';
                     echo '</TABLE>';
                  }
                   else
                    {
                      echo '<CENTER><P><B class="rojo">No Posee Registros</B></CENTER>';
                    }
     ?>

        </p>
        <p align="center"><BR>
        </p>

     
</HTML>
