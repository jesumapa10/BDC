<?
  include ("../sesion.php");
  include ("../conex.php");
?>
<HTML>
<HEAD>
<LINK REL="STYLESHEET" HREF="../style/normal.css" TYPE="text/css">
<SCRIPT LANGUAGE="JavaScript" SRC="../scripts/validar.js" TYPE="text/javascript"></SCRIPT>
<script language='javascript' src="popcalendar.js"></script>
</HEAD>
<BODY>
<FORM METHOD="POST" ENCTYPE="multipart/form-data" NAME="datos" ACTION="">
<TABLE width="100%" BORDER="0" ALIGN="CENTER">
	<TR>
		<TD COLSPAN="6">
			<DIV ALIGN="CENTER"><P class="cabecera">Información Personal</P></DIV>		</TD>
    </TR>
    <TR>
		<TD WIDTH="92"><P ALIGN="RIGHT" class="mini">C&eacute;dula:</P></TD>
        <TD WIDTH="90"><INPUT class="campo" TYPE="TEXT" NAME="codg_per" SIZE="8" MAXLENGTH="8" VALUE="<? echo $codg_per; ?>" title="Introduzca la cédula de identidad del personal"></TD>
        <TD WIDTH="105"><P ALIGN="RIGHT" class="mini">Nombre(s):</P></TD>
        <TD WIDTH="150"><INPUT class="campo" TYPE="TEXT" NAME="nomb_per" MAXLENGTH="30" SIZE="30" VALUE="<? echo $nomb_per; ?>" title="Introduzca los nombres del personal"></TD>
        <TD WIDTH="103"><P ALIGN="RIGHT" class="mini">Apellido(s):</P></TD>
        <TD WIDTH="150"><INPUT class="campo" TYPE="TEXT" NAME="apel_per" MAXLENGTH="30" SIZE="30" VALUE="<? echo $apel_per; ?>" title="Introduzca los apellidos del personal"></TD>
	</TR>
    <TR>
		<TD><P ALIGN="RIGHT" class="mini">Sexo:</P></TD>
        <TD><SELECT class="campo" NAME="sexo_per" title="Seleccione de la lista el sexo del personal">
                <OPTION VALUE="0">Seleccione...</OPTION>
                <OPTION VALUE="F" <? if ($sexo_per == "F") {echo 'SELECTED';}?> >Femenino</OPTION>
                <OPTION VALUE="M" <? if ($sexo_per == "M") {echo 'SELECTED';}?> >Masculino</OPTION>
             </SELECT>		</TD>
        <TD><P ALIGN="RIGHT" class="mini">Estado Civil:</P></TD>
        <TD><SELECT class="campo" NAME="est_civ_per" title="Seleccione de las lista el estado civil del personal">
                <OPTION VALUE="0">Seleccione...</OPTION>
                <OPTION VALUE="S" <? if ($est_civ_per == "S") {echo 'SELECTED';}?> >Soltero</OPTION>
                <OPTION VALUE="C" <? if ($est_civ_per == "C") {echo 'SELECTED';}?> >Casado</OPTION>
                <OPTION VALUE="D" <? if ($est_civ_per == "D") {echo 'SELECTED';}?> >Divorciado</OPTION>
                <OPTION VALUE="V" <? if ($est_civ_per == "V") {echo 'SELECTED';}?> >Viudo</OPTION>
             </SELECT>		</TD>
        <TD><P ALIGN="RIGHT" class="mini">Fecha de Nacimiento:</P></TD>
        <TD><INPUT TYPE="TEXT" NAME="fec_nac_per" class="campo" VALUE="<? echo $fec_nac_per; ?>" MAXLENGTH="10" SIZE="10" id="fecha" onClick="popUpCalendar(this, datos.fecha, 'dd-mm-yyyy');" READONLY title="Seleccione con ayuda del calendario la fecha de nacimiento del personal"> 
            <IMG onClick="popUpCalendar(this, datos.fecha, 'dd-mm-yyyy');" SRC="../images/cal.gif" title="Haz Click para Buscar la Fecha" WIDTH="16" HEUGHT="16" BORDER="0">        </TD>
	</TR>
    <TR>
        <TD><P ALIGN="RIGHT" class="mini">Pa&iacute;s de Nacimiento:</P></TD>
        <TD><p><font size="2"><strong>
			<select class="campo" name="codg_pais_nac_per" id="codg_pais_nac_per" onChange="combo_anidado(this.value)" title="Seleccione de las lista el país de nacimiento del personal">
            <option value="" selected="selected">Seleccione...</option>
            <?PHP
				$sql="select * from bdc_paises";
				$busq=mysql_query($sql);
				if($reg = mysql_fetch_array($busq)){
					do{
						echo '<option value="'.$reg['codg_pais'].'">'.$reg['nomb_pais'].'</option>';
					}while($reg = mysql_fetch_array($busq));
				}
				mysql_free_result($busq);
			?>
            </select>
            </strong></font></p>		</TD>
        <TD><P ALIGN="RIGHT" class="mini">Estado de Nacimiento:</P></TD>
        <TD><p><font size="2"><strong>
        	<select class="campo" name="codg_est_nac_per" id="codg_est_nac_per" title="Seleccione de las lista el estado de nacimiento del personal">
            	<option selected="selected">Seleccione...</option>
			</select>
             </strong></font></p>		</TD>
        <TD><P ALIGN="RIGHT" class="mini">Nacionalidad:</TD>
        <TD><SELECT class="campo" NAME="naci_per" title="Seleccione de las lista la nacionalidad del personal">
            	<OPTION VALUE="0">Seleccione...</OPTION>
                <OPTION VALUE="V" <? if ($naci_per == "V") {echo 'SELECTED';}?> >Venezolano</OPTION>
                <OPTION VALUE="E" <? if ($naci_per == "E") {echo 'SELECTED';}?> >Extranjero</OPTION>
                </SELECT>		</TD>
	</TR>
	<TR>
    	<TD><P ALIGN="RIGHT" class="mini">Tipo de Personal:</TD>
		<TD><SELECT class="campo" NAME="codg_tip_trab" title="Seleccione de las lista el tipo de personal">
                <OPTION VALUE="0">Seleccione...</OPTION>
                <? $tipos_trab = mysql_query("SELECT codg_tip_trab, desc_tip_trab FROM bdc_tip_trab ORDER BY 2");
                if (mysql_num_rows($tipos_trab) != 0)
                {
                    while ($tipo_trab = mysql_fetch_array($tipos_trab))
                  	{
                   		echo '<OPTION VALUE="'.$tipo_trab["codg_tip_trab"];
                        echo '"';
						if ($codg_tip_trab == $tipo_trab["codg_tip_trab"])
                        {
                        	echo 'SELECTED';
						}
						echo '>'.$tipo_trab["desc_tip_trab"];
                        echo '</OPTION>';
					}
                }
                ?>
                </SELECT>			</TD>
            <TD><P ALIGN="RIGHT" class="mini">¿Activo en el Sistema?:</TD>
            <TD>
                        <TABLE>
                        <TR>
                        <TD><P ALIGN="RIGHT" class="campo">Si</TD>
                        <TD VALIGN="TOP"><INPUT class="campo" TYPE="RADIO" NAME="activo_per" VALUE="S" <? if ($activo_per == "S") {echo 'CHECKED';}?> title="Indique si el personal está activo" ></TD>
                        <TD><P ALIGN="RIGHT" class="campo">No</TD>
                        <TD VALIGN="TOP"><INPUT class="campo" TYPE="RADIO" NAME="activo_per" VALUE="N" <? if ($activo_per == "N") {echo 'CHECKED';}?> title="Indique si el personal NO está activo" ></TD>
                        </TR>
                        </TABLE>                </TD>

                <TD><P ALIGN="RIGHT" class="mini">Fecha de Ingreso:</P></TD>
                <TD><INPUT TYPE="TEXT" NAME="fec_ing_per" class="campo" VALUE="<? echo $fec_ing_per; ?>" MAXLENGTH="10" SIZE="10" id="fecha2" onClick="popUpCalendar(this, datos.fecha2, 'dd-mm-yyyy');" READONLY title="Seleccione con ayuda del calendario la fecha de ingreso del personal a la DEPPECD"> 
                <IMG onClick="popUpCalendar(this, datos.fecha2, 'dd-mm-yyyy');" SRC="../images/cal.gif" title="Haz Click para Buscar la Fecha" WIDTH="16" HEUGHT="16" BORDER="0">                </TD>
                </TR>

                <TR>
                <TD COLSPAN="6">
                <DIV ALIGN="CENTER"><P class="cabecera">Domicilio</P></DIV>                </TD>
                </TR>

                <TR>
                <TD><P ALIGN="RIGHT" class="mini">Estado:</P></TD>
                <TD><SELECT class="campo" NAME="codg_est_dom_per" id="codg_est_dom_per" onChange="combo_anidado2(this.value),combo_anidado3(this.value)" title="Seleccione el estado de domicilio del Personal">
                <OPTION VALUE="0">Seleccione...</OPTION>
                <? $estados_dom = mysql_query("SELECT codg_est, nomb_est FROM bdc_estados WHERE codg_pais=58 ORDER BY 2");
                if (mysql_num_rows($estados_dom) != 0)
                {
                       while ($estado_dom = mysql_fetch_array($estados_dom))
                  {
                   echo '<OPTION VALUE="'.$estado_dom["codg_est"];
                                       echo '"';
                                       if ($codg_est_dom_per == $estado_dom["codg_est"])
                                       {
                                          echo 'SELECTED';
                                       }
                                       echo '>'.$estado_dom["nomb_est"];
                                       echo '</OPTION>';
                  }
                }
                ?>
                </SELECT></TD>
                <TD><P ALIGN="RIGHT" class="mini">Municipio:</P></TD>
                <TD><select class="campo" name="codg_mun_dom_per" id="codg_mun_dom_per" onChange="combo_anidado3(this.value, codg_est_dom_per.value, dir.value)" title="Seleccione el municipio de domicilio del Personal">
                  <option>Seleccione...</option>
                  <?
                if (($codg_est_dom_per != "") && ($codg_est_dom_per != 0))
                {
                      $municipios_dom = mysql_query("SELECT codg_mun, nomb_mun FROM bdc_municipios WHERE codg_pais=58 and codg_est=$codg_est_dom_per ORDER BY 2");
                   if (mysql_num_rows($municipios_dom) != 0)
                   {
                       while ($municipio_dom = mysql_fetch_array($municipios_dom))
                     {
                       echo '<OPTION VALUE="'.$municipio_dom["codg_mun"];
                                           echo '"';
                                           if ($codg_mun_dom_per == $municipio_dom["codg_mun"])
                                           {
                                              echo 'SELECTED';
                                           }
                                           echo '>'.$municipio_dom["nomb_mun"];
                                           echo '</OPTION>';
                     }
                   }
                }
                ?>
                </select>
                  <input type="hidden" name="dir" value="codg_parr_dom_per" title="Seleccione la parroquia de domicilio del Personal"></TD>
                <TD><P ALIGN="RIGHT" class="mini">Parroquia:</P></TD>
                <TD><SELECT class="campo" NAME="codg_parr_dom_per" id="codg_parr_dom_per">
                <OPTION VALUE="0">Seleccione...</OPTION>
                <?
                 if ($codg_est_dom_per != "" && $codg_mun_dom_per != "")
                 {
                      $parroquias_dom = mysql_query("SELECT codg_parr, nomb_parr FROM bdc_parroquias WHERE codg_pais=58 and codg_est=$codg_est_dom_per and codg_mun=$codg_mun_dom_per ORDER BY 2");
                   if (mysql_num_rows($parroquias_dom) != 0)
                   {
                       while ($parroquia_dom = mysql_fetch_array($parroquias_dom))
                     {
                       echo '<OPTION VALUE="'.$parroquia_dom["codg_parr"];
                                           echo '"';
                                           if ($codg_parr_dom_per == $parroquia_dom["codg_parr"])
                                           {
                                              echo 'SELECTED';
                                           }
                                           echo '>'.$parroquia_dom["nomb_parr"];
                                           echo '</OPTION>';
                     }
                   }
                }
                ?>
                </SELECT></TD>
                </TR>

                <TR>
                <TD><P ALIGN="RIGHT" class="mini">Direcci&oacute;n:</P></TD>
                <TD COLSPAN="6"><INPUT class="campo" TYPE="TEXT" NAME="dirc_per" MAXLENGTH="200" SIZE="130" VALUE="<? echo $dirc_per; ?>" title="Introduzca la dirección de domicilio del Personal"></TD>
                </TR>

                <TR>
                <TD><P ALIGN="RIGHT" class="mini">Tel&eacute;fono:</P></TD>
                <TD><P ALIGN="LEFT" class="campo">(<INPUT class="campo" TYPE="TEXT" NAME="codg_tel" MAXLENGTH="4" SIZE="4" VALUE="<? echo $codg_tel; ?>" title="Introduzca el código de área del número de teléfono">)<INPUT class="campo" TYPE="TEXT" NAME="tel" MAXLENGTH="7" SIZE="7" VALUE="<? echo $tel; ?>" title="Introduzca el número de teléfono"></P></TD>
                <TD><P ALIGN="RIGHT" class="mini">Celular:</P></TD>
                <TD><P ALIGN="LEFT" class="campo">(<INPUT class="campo" TYPE="TEXT" NAME="codg_cel" MAXLENGTH="4" SIZE="4" VALUE="<? echo $codg_cel; ?>" title="Introduzca el código de operadora del número de celular">)<INPUT class="campo" TYPE="TEXT" NAME="cel" MAXLENGTH="7" SIZE="7" VALUE="<? echo $cel; ?>" title="Introduzca el número de celular"></P></TD>
                <TD><P ALIGN="RIGHT" class="mini">E-Mail:</P></TD>
                <TD><INPUT class="campo" TYPE="TEXT" NAME="email_per" MAXLENGTH="50" SIZE="30" VALUE="<? echo $email_per; ?>" title="Introduzca el correo electrónico del personal"></TD>
                </TR>

                <TR>
                <TD COLSPAN="6">
                <DIV ALIGN="CENTER"><P class="cabecera">Seguro Social</P></DIV>                </TD>
                </TR>

                <TR>
                <TD><P ALIGN="RIGHT" class="mini">Fecha de Registro:</P></TD>
                <TD><INPUT TYPE="TEXT" NAME="fec_reg_ivss" class="campo" VALUE="<? echo $fec_reg_ivss; ?>" MAXLENGTH="10" SIZE="10" id="fecha3" onClick="popUpCalendar(this, datos.fecha3, 'dd-mm-yyyy');" READONLY title="Seleccione con ayuda del calendario la fecha de registro en el IVSS">
                <IMG onClick="popUpCalendar(this, datos.fecha3, 'dd-mm-yyyy');" SRC="../images/cal.gif" title="Haz Click para Buscar la Fecha" WIDTH="16" HEUGHT="16" BORDER="0">                </TD>

                <TD><P ALIGN="RIGHT" class="mini">Fecha de Retiro:</P></TD>
                <TD><INPUT TYPE="TEXT" NAME="fec_ret_ivss" class="campo" VALUE="<? echo $fec_ret_ivss; ?>" MAXLENGTH="10" SIZE="10" id="fecha4" onClick="popUpCalendar(this, datos.fecha4, 'dd-mm-yyyy');" READONLY title="Seleccione con ayuda del calendario la fecha de retiro en el IVSS">
                <IMG onClick="popUpCalendar(this, datos.fecha4, 'dd-mm-yyyy');" SRC="../images/cal.gif" title="Haz Click para Buscar la Fecha" WIDTH="16" HEUGHT="16" BORDER="0">                </TD>

                <TD WIDTH="105"><P ALIGN="RIGHT" class="mini">Nombre del Patrono:</P></TD>
                <TD WIDTH="150"><INPUT class="campo" TYPE="TEXT" NAME="nomb_pat" MAXLENGTH="100" SIZE="30" VALUE="<? echo $nomb_pat; ?>" title="Introduzca el nombre del patrono registrado en el IVSS"></TD>
                </TR>

                <TR>
                <TD COLSPAN="6">
                <DIV ALIGN="CENTER"><P class="cabecera">Foto</P></DIV>                </TD>
                </TR>

                <TR>
                <TD><P ALIGN="RIGHT" class="mini">Ubicaci&oacute;n:</P></TD>
                <TD COLSPAN="6"><INPUT class="campo" TYPE="FILE" NAME="foto_per" SIZE="50" title="Haga click para seleccionar el archivo que contiene la foto del personal"></TD>
                </TR>

                <TR>
                <TD COLSPAN="6"><HR></TD>
                </TR>
  </TABLE>

<CENTER><INPUT class="mini" TYPE="SUBMIT"  NAME="agregar" VALUE="Agregar" onClick="ingresar();" title="Haga click para almacenar los datos del personal"></CENTER>

<INPUT TYPE="HIDDEN" NAME="tel_per" VALUE="<? echo $tel_per; ?>">
<INPUT TYPE="HIDDEN" NAME="cel_per" VALUE="<? echo $cel_per; ?>">
<INPUT TYPE="HIDDEN" NAME="action" VALUE="">

</FORM>
<?
if ($action == "ins")
{
  $consulta = mysql_query("SELECT * FROM bdc_datos_per WHERE codg_per=$codg_per");

        if (mysql_num_rows($consulta) != 0)
        {
                echo "<SCRIPT>alert('La Cédula ya Existe');</SCRIPT>";
        }

        else

        {

                $fec_nac_per = substr($fec_nac_per,6,4)."-".substr($fec_nac_per,3,2)."-".substr($fec_nac_per,0,2);
                $fec_ing_per = substr($fec_ing_per,6,4)."-".substr($fec_ing_per,3,2)."-".substr($fec_ing_per,0,2);
                $fec_reg_ivss = substr($fec_reg_ivss,6,4)."-".substr($fec_reg_ivss,3,2)."-".substr($fec_reg_ivss,0,2);
                $fec_ret_ivss = substr($fec_ret_ivss,6,4)."-".substr($fec_ret_ivss,3,2)."-".substr($fec_ret_ivss,0,2);
                $tel_per = "$codg_tel$tel";
                $cel_per = "$codg_cel$cel";

                if ( $foto_per != "" )
                {
                   $tamanio = $_FILES["foto_per"]["size"];
                   $tip_foto_per = $_FILES['foto_per']['type'];

                   $fp = fopen($foto_per, "rb");
                   $contenido = fread($fp, $tamanio);
                   $contenido = addslashes($contenido);
                   fclose($fp);
                }

                if ($esta_civ_per == "0") {($est_civ_per = "NULL");} else {($est_civ_per = "'$est_civ_per'");}
                if ($codg_pais_nac_per == "0") {($codg_pais_nac_per = "NULL");}
                if ($codg_est_nac_per == "0") {($codg_est_nac_per = "NULL");}
                if ($codg_est_dom_per == "Seleccione...") {($codg_est_dom_per = "NULL");}
                if ($codg_mun_dom_per == "Seleccione...") {($codg_mun_dom_per = "NULL");}
                if ($codg_parr_dom_per == "Seleccione...") {($codg_parr_dom_per = "NULL");}
                if ($dirc_per == "") {($dirc_per = "NULL");} else {($dirc_per = "'$dirc_per'");}
                if ($tel_per == "") {($tel_per = "NULL");} else {($tel_per = "'$tel_per'");}
                if ($cel_per == "") {($cel_per = "NULL");} else {($cel_per = "'$cel_per'");}
                if ($email_per == "") {($email_per = "NULL");} else {($email_per = "'$email_per'");}
                if ($foto_per == "") {($contenido = "NULL");} else {($contenido = "'$contenido'");}
                if (!isset ($tip_foto_per)) {($tip_foto_per = "NULL");} else {($tip_foto_per = "'$tip_foto_per'");}
                if ($activo_per == "") {($activo_per = "S");} else {($activo_per = "$activo_per");}
                if ($fec_reg_ivss == "--") {($fec_reg_ivss = "0000-00-00");} else {($fec_reg_ivss = "$fec_reg_ivss");}
                if ($fec_ret_ivss == "--") {($fec_ret_ivss = "0000-00-00");} else {($fec_ret_ivss = "$fec_ret_ivss");}
                if ($nomb_pat == "") {($nomb_pat = "NULL");} else {($nomb_pat = "$nomb_pat");}

                $qry = "INSERT INTO bdc_datos_per VALUES ($codg_per, '$apel_per', '$nomb_per', '$sexo_per', '$fec_nac_per',
                                                          '$naci_per', $est_civ_per, $codg_pais_nac_per, $codg_est_nac_per,
                                                          58, $codg_est_dom_per, $codg_mun_dom_per, $codg_parr_dom_per,
                                                          $dirc_per, $tel_per, $cel_per, $email_per, '$codg_tip_trab',
                                                          $contenido, $tip_foto_per, '$fec_ing_per', '$activo_per', '$fec_reg_ivss', '$fec_ret_ivss', '$nomb_pat')";
                mysql_query ($qry);
               echo '<SCRIPT>alert("Datos Personales Agregados");</SCRIPT>

                      <SCRIPT>datos.action.value="";</SCRIPT>
                      <SCRIPT>location = "'.$tab_direccion.'&id_tab=2&direccion=bdc_edit_datos_academicos.php";</SCRIPT>';

        }
}
?>

<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">

  var frmvalidator  = new Validator("datos");

  frmvalidator.addValidation("codg_per","req","Ingrese la Cédula de la Persona");
  frmvalidator.addValidation("codg_per","num","La Cédula de la Persona sólo acepta caracteres numéricos");
  frmvalidator.addValidation("codg_per","minlen=6","El Mínimo de Caracteres para la Cédula es 6");

  frmvalidator.addValidation("nomb_per","req","Ingrese el Nombre de la Persona");
  frmvalidator.addValidation("nomb_per","alphanum");

  frmvalidator.addValidation("apel_per","req","Ingrese el Apellido de la Persona");
  frmvalidator.addValidation("apel_per","alphanum");

  frmvalidator.addValidation("sexo_per","dontselect=0","Seleccione el Sexo de la Persona");

  frmvalidator.addValidation("fec_nac_per","req","Seleccione la Fecha de Nacimiento");

  frmvalidator.addValidation("naci_per","dontselect=0","Seleccione la Nacionalidad de la Persona");

  frmvalidator.addValidation("codg_tip_trab","dontselect=0","Seleccione el Tipo de Trabajador");

  frmvalidator.addValidation("fec_ing_per","req","Seleccione la Fecha de Ingreso");

</SCRIPT>

</BODY>
</HTML>
<script> 
function combo_anidado(cod_area){
	//alert(cod_area); 
	document.datos.codg_est_nac_per.length=0; 
	document.datos.codg_est_nac_per.options[0] = new Option("Seleccione...","","defaultSelected",""); 
	var indice=1; 
	<?
		$sql_nom_dep = "SELECT * from bdc_estados ORDER BY 3"; 
		$rs_nom_dep = mysql_query($sql_nom_dep); 
		if(mysql_num_rows($rs_nom_dep)>0){
			do{
				?> 
					if(cod_area=='<?=$row_nom_dep["codg_pais"]?>'){
						document.datos.codg_est_nac_per.options[indice] = new Option("<?=$row_nom_dep["nomb_est"]?>","<?=$row_nom_dep["codg_est"]?>"); 
						indice++;
					}
				<?
			}while($row_nom_dep = mysql_fetch_assoc($rs_nom_dep));
		} 
	?>
}

function combo_anidado2(cod_area){ 
//alert(cod_area); 
	document.datos.codg_mun_dom_per.length=0; 
	document.datos.codg_mun_dom_per.options[0] = new Option("Seleccione...","","defaultSelected",""); 
	var indice=1; 
	<? 
		$sql_nom_dep = "SELECT * from bdc_municipios ORDER BY 4"; 
		$rs_nom_dep = mysql_query($sql_nom_dep); 
		if(mysql_num_rows($rs_nom_dep)>0){
			do{
				?> 
					if(cod_area=='<?=$row_nom_dep["codg_est"]?>'){
						document.datos.codg_mun_dom_per.options[indice] = new Option("<?=$row_nom_dep["nomb_mun"]?>","<?=$row_nom_dep["codg_mun"]?>"); 
					indice++; 
					}
				<?
			}while($row_nom_dep = mysql_fetch_assoc($rs_nom_dep));
		}
	?>
}

function combo_anidado3(cod_area, cod_area2, dir){
var tabla="bdc_parroquias";
	document.datos.dir.length=0;
	document.datos.dir.options[0] = new Option("Seleccione...","","defaultSelected","");								 	var indice=1; 
	 <?
		$sql_nom_dep = "SELECT * from bdc_parroquias ORDER BY 5"; 
		$rs_nom_dep = mysql_query($sql_nom_dep); 
		if(mysql_num_rows($rs_nom_dep)>0){
			do{
				?>
					if(cod_area=='<?=$row_nom_dep["codg_mun"]?>' && cod_area2=='<?=$row_nom_dep["codg_est"]?>'){ 
						document.datos.codg_parr_dom_per.options[indice] = new Option("<?=$row_nom_dep["nomb_parr"]?>","<?=$row_nom_dep["codg_parr"]?>"); 
						indice++; 
					}
				<?
			}while($row_nom_dep = mysql_fetch_assoc($rs_nom_dep));
		}
	?>
}
</script>
