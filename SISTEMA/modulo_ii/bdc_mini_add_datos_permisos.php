<?
  include ("../sesion.php");

  include ("../conex.php");
  include ("bdc_mini_add_movimientos.php");
?>
<HTML>
<HEAD>
        <LINK REL="STYLESHEET" HREF="../style/normal.css" TYPE="text/css">

        <SCRIPT LANGUAGE="JavaScript" SRC="../scripts/validar.js" TYPE="text/javascript"></SCRIPT>
<script language='javascript' src="popcalendar.js"></script>

<SCRIPT>
function finalizar()
{
input_box=confirm("�Est� seguro que desea Finalizar?");
if (input_box==true)

{
        location = "../modulo_i/bdc_data.php";
}

}

function cerrar()
        {
        window.close()
        }

function cambiar()
{
        datos.submit();
}

function ingresar()
{
        datos.action.value="ins";
}

function tipo_permiso()
{
        if (document.datos.tip_perm.selectedIndex == 100) {
        datos.tip_perm.value="$tip_perm";
        }
        datos.submit();
}

</SCRIPT>

<SCRIPT LANGUAGE="JavaScript" SRC="../scripts/calendario.js" TYPE="text/javascript"></SCRIPT>

<SCRIPT LANGUAGE="JavaScript" SRC="../scripts/cal-barra.js" TYPE="text/javascript"></SCRIPT>

<SCRIPT LANGUAGE="JavaScript">
        var c1 = new CodeThatCalendar(caldef1);
</SCRIPT>

</HEAD>

<BR>
<BR>
<H2>Agregar Ficha de Personal</H2>
<?
         $consulta_datos_per=mysql_query("SELECT d.apel_per, d.nomb_per, d.naci_per, t.desc_tip_trab, d.codg_tip_trab
                 FROM bdc_datos_per d, bdc_tip_trab t
                 WHERE d.codg_per=$codg_per AND d.codg_tip_trab=t.codg_tip_trab");

                $datos = mysql_fetch_array($consulta_datos_per);
                $apel_per = $datos["apel_per"];
                $nomb_per = $datos["nomb_per"];
                $naci_per = $datos["naci_per"];
                $desc_tip_trab = $datos["desc_tip_trab"];
                $codg_tip_trab = $datos["codg_tip_trab"];

?>

<TABLE ALIGN="CENTER">
<TR>
<TD height="24">
<P ALIGN="CENTER" class="mini">Nombre(s) y Apellido(s):</P>
</TD>

<TD>
<P ALIGN="CENTER" class="campo"><? echo $nomb_per; ?>&nbsp;<? echo $apel_per; ?>&nbsp;&nbsp;&nbsp;&nbsp;</P>
</TD>

<TD>
<P ALIGN="CENTER" class="mini">C&eacute;dula:</P>
</TD>

<TD>
<P ALIGN="CENTER" class="campo"><? if ($naci_per == "V") {echo 'V - ';} else {echo 'E - ';} echo number_format($codg_per ,0 , "," ,"."); ?>&nbsp;&nbsp;&nbsp;&nbsp;</P>
</TD>

<TD>
<P ALIGN="CENTER" class="mini">Tipo de Trabajador:</P>
</TD>

<TD>
<P ALIGN="CENTER" class="campo"><? echo $desc_tip_trab; ?></P>
</TD>
</TR>
</TABLE>
<BR>


<BR>
<FORM METHOD="POST" NAME="datos" action="">
  <table border="0" align="CENTER">
    <tr>
      <td colspan="2"><div align="CENTER">
        <p class="cabecera">Datos de Permisos</p>
      </div></td>
    </tr>
    <tr>
      <td><p align="RIGHT" class="mini">Tipo Permiso:</td>
      <td><select class="campo" name="tip_perm" onChange="tipo_permiso()">
          <option value="0">Seleccione...</option>
          <option value="1" <? if ($tip_perm == "1") {echo 'SELECTED';}?> >Remunerado</option>
          <option value="2" <? if ($tip_perm == "2") {echo 'SELECTED';}?> >No Remunerado</option>
          <option value="3" <? if ($tip_perm == "3") {echo 'SELECTED';}?> >Postestativo</option>
          <option value="4" <? if ($tip_perm == "4") {echo 'SELECTED';}?> >IPAS Estadal</option>
          <option value="5" <? if ($tip_perm == "5") {echo 'SELECTED';}?> >Licencia Sab�tica</option>
      </select></td>
    </tr>
    <tr>
      <td width="150"><p align="RIGHT" class="mini">Permiso:</p></td>
      <td width="250"><select class="campo" name="codg_perm">
          <option value="0">Seleccione...</option>
          <?
                $permisos = mysql_query("SELECT codg_perm, tip_perm, nomb_perm FROM bdc_permisos WHERE tip_perm=$tip_perm");
                if (mysql_num_rows($permisos) != 0)
                {
                    while ($permiso = mysql_fetch_array($permisos))
                  {
                   echo '<OPTION VALUE="'.$permiso["codg_perm"];
                                       echo '"';
                                       if ($codg_perm == $permiso["codg_perm"])
                                       {
                                          echo 'SELECTED';
                                       }
                                       echo '>'.$permiso["nomb_perm"];
                                       echo '</OPTION>';
                  }
                }
                ?>
        </select>
    </tr>
    <tr>
      <td><p align="RIGHT" class="mini">Fecha de Inicio:</p></td>
      <td><input type="TEXT" name="fec_inicio" class="campo" value="<? echo $fec_inicio; ?>" maxlength="10" size="10" id="fec_inicio" onClick="popUpCalendar(this, datos.fec_inicio, 'dd-mm-yyyy');" readonly>
          <img onClick="popUpCalendar(this, datos.fec_inicio, 'dd-mm-yyyy');" src="../images/cal.gif" alt="Haz Click para Buscar la Fecha" width="16" heught="16" border="0"> </td>
    </tr>
    <tr>
      <td><p align="RIGHT" class="mini">Fecha Fin:</p></td>
      <td><input type="TEXT" name="fec_fin" class="campo" value="<? echo $fec_fin; ?>" maxlength="10" size="10" id="fec_fin" onClick="popUpCalendar(this, datos.fec_fin, 'dd-mm-yyyy');" readonly>
          <img onClick="popUpCalendar(this, datos.fec_fin, 'dd-mm-yyyy');" src="../images/cal.gif" alt="Haz Click para Buscar la Fecha" width="16" heught="16" border="0"> </td>
    </tr>
    <tr>
      <td><p align="RIGHT" class="mini">Motivo del Permiso:</p></td>
      <td><p class="campo">
        <textarea class="campo" rows="5" cols="100" name="motivo" maxlength="250" size="1" value="<? echo $motivo; ?>" > </textarea>
      </p></td>
    </tr>
    <tr>
      <td colspan="2"><hr></td>
    </tr>
  </table>
  <CENTER><INPUT class="mini" TYPE="SUBMIT" VALUE="Agregar" onClick="ingresar()">&nbsp;<INPUT class="mini" TYPE="BUTTON" VALUE="Cerrar Ventana" onClick="cerrar()"></CENTER>

<INPUT TYPE="HIDDEN" NAME="action" VALUE="">
<INPUT TYPE="HIDDEN" NAME="codg_per" VALUE="<? echo $codg_per; ?>">

</FORM>

<?
if ($action == "ins")
{
   if ($tip_perm == ""){$tip_perm = "NULL";} else {$tip_perm = "$tip_perm";}
   $fec_inicio = substr($fec_inicio,6,4)."-".substr($fec_inicio,3,2)."-".substr($fec_inicio,0,2);
   $fec_fin = substr($fec_fin,6,4)."-".substr($fec_fin,3,2)."-".substr($fec_fin,0,2);
   if ($motivo == ""){$motivo = "NULL";} else {$motivo = "$motivo";}
   
   guardar_mov($codg_per,$codg_tip_mov);
   $codg_mov=gen_codg_mov();

   $qry="INSERT INTO bdc_datos_permisos VALUES ($codg_per, '$tip_perm', $codg_perm, '$fec_inicio', '$fec_fin', '$motivo', $codg_mov)";

   mysql_query($qry);

   echo "<SCRIPT>alert('Datos Agregados');</SCRIPT>";
   echo "<SCRIPT>window.opener.parent.DATA.actualizar();</SCRIPT>";
	
}
?>

<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">

  var frmvalidator  = new Validator("datos");

  frmvalidator.addValidation("tip_perm","dontselect=0","Seleccione Tipo de Permiso");
  frmvalidator.addValidation("codg_perm","dontselect=0","Seleccione Permiso");
  frmvalidator.addValidation("fec_inicio","req","Seleccione la Fecha de Inicio del Permiso");
  frmvalidator.addValidation("fec_fin","req","Seleccione la Fecha de Fin del Permiso");


</SCRIPT>

           <?
                $consulta_permisos = mysql_query("SELECT g.nomb_perm, d.fec_inicio, d.fec_fin FROM bdc_datos_permisos d, bdc_permisos g WHERE d.codg_per=$codg_per AND d.codg_perm=g.codg_perm");

                 if (mysql_num_rows($consulta_permisos) != 0)
                 {
                    echo '<TABLE BORDER="0" ALIGN="CENTER">
                       <TR>
                       <TD COLSPAN="5">
                       <DIV ALIGN="CENTER"><P class="cabecera">Permisos Registrados</P></DIV>
                       </TD>
                       </TR>';
                    while ($consulta = mysql_fetch_array($consulta_permisos))
                    {

                     $fec_inicio = $consulta["fec_inicio"];
                     $fec_fin = $consulta["fec_fin"];

                     echo '<TR>
                           <TD><P ALIGN="CENTER" class="campo">'.$consulta['nomb_perm'];'</P></TD>';


                      echo '
                            <TD><P ALIGN="CENTER" class="mini">Fecha de Inicio:</P></TD>';
                            $fec_inicio = substr($fec_inicio,8,2)."-".substr($fec_inicio,5,2)."-".substr($fec_inicio,0,4);
                      echo  '<TD><P ALIGN="LEFT" class="campo">'; echo $fec_inicio; echo'</P></TD>';

                      echo '
                            <TD><P ALIGN="CENTER" class="mini">Fecha Fin:</P></TD>';
                            $fec_fin = substr($fec_fin,8,2)."-".substr($fec_fin,5,2)."-".substr($fec_fin,0,4);
                     echo  '<TD><P ALIGN="LEFT" class="campo">'; echo $fec_fin; echo'</P></TD>';
                     echo '</TR>';
                     }
                     echo '</TABLE>';
                  }
                   else
                    {
                      echo '<CENTER><P><B class="rojo">No Posee Registros</B></CENTER>';
                    }
            ?>
</HTML>