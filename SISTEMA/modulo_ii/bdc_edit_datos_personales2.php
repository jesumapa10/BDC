<? 	include ("../sesion.php");
	include ("../conex.php"); ?>
<HTML>
<HEAD>
<SCRIPT>
function imprimir()
        {
         window.open("documentos_ficha_trabajador.php?codg_per=<? echo $codg_per; ?>","_blank","scrollbars=yes,status=no,toolbar=no,directories=no,menubar=no,resizable=no,width=800,height=500")
        }
</SCRIPT>
<LINK REL="STYLESHEET" HREF="../style/normal.css" TYPE="text/css">
<SCRIPT LANGUAGE="JavaScript" SRC="../scripts/validar.js" TYPE="text/javascript"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="/bdc/scripts/validar.js" TYPE="text/javascript"></SCRIPT>
<SCRIPT>
function estado_nacimiento()
{
        if (document.datos.codg_pais_nac_per.selectedIndex == 100) {
        datos.codg_pais_nac_per.value="$codg_pais_nac_per";
        }
        datos.submit();
}

function municipio_domicilio()
{
        if (document.datos.codg_est_dom_per.selectedIndex == 100) {
        datos.codg_est_dom_per.value="$codg_est_dom_per";
        }
        datos.submit();
}

function parroquia_domicilio()
{
        if (document.datos.codg_mun_dom_per.selectedIndex == 100) {
        datos.codg_est_mun_per.value="$codg_mun_dom_per";
        }
        datos.submit();
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
		

function ingresar()
{
        datos.action.value="ins";
        datos.pasada.value="1";
}
</SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="../scripts/calendario.js" TYPE="text/javascript"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="../scripts/cal-barra.js" TYPE="text/javascript"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript"> var c1 = new CodeThatCalendar(caldef1); </SCRIPT>
</HEAD>
<BODY>
<?
if ($pasada != 1)
 {
   $consulta = mysql_query("SELECT p.apel_per, p.nomb_per, p.sexo_per, p.fec_nac_per, p.naci_per, p.est_civ_per, p.codg_pais_nac_per,
                         p.codg_est_nac_per, p.codg_pais_dom_per, p.codg_est_dom_per, p.codg_mun_dom_per, p.codg_parr_dom_per,
                         p.dirc_per, p.tel_per, p.cel_per, p.email_per, p.codg_tip_trab,
                         t.desc_tip_trab, p.foto_per, p.tip_foto_per, p.fec_ing_per, p.activo_per, p.fec_reg_ivss, p.fec_ret_ivss, p.nomb_pat
                         FROM bdc_datos_per p, bdc_tip_trab t
                         WHERE p.codg_per=$codg_per and p.codg_tip_trab=t.codg_tip_trab");
   $datos = mysql_fetch_array($consulta);
   $apel_per = $datos["apel_per"];
   $nomb_per = $datos["nomb_per"];
   $sexo_per = $datos["sexo_per"];
   $fec_nac_per = $datos["fec_nac_per"];
   $fec_nac_per = substr($fec_nac_per,8,2)."-".substr($fec_nac_per,5,2)."-".substr($fec_nac_per,0,4);
   $codg_pais_nac_per = $datos["codg_pais_nac_per"];
   $codg_est_nac_per = $datos["codg_est_nac_per"];
   $codg_pais_dom_per = $datos["codg_pais_dom_per"];
   $codg_est_dom_per = $datos["codg_est_dom_per"];
   $codg_mun_dom_per = $datos["codg_mun_dom_per"];
   $codg_parr_dom_per = $datos["codg_parr_dom_per"];
   $codg_tip_trab = $datos["codg_tip_trab"];
   $naci_per = $datos["naci_per"];
   $est_civ_per = $datos["est_civ_per"];
   $dirc_per = $datos["dirc_per"];
   $tel_per = $datos["tel_per"];
   $codg_tel = substr($tel_per,0,4); $tel = substr($tel_per,4,7);
   $cel_per = $datos["cel_per"];
   $codg_cel = substr($cel_per,0,4); $cel = substr($cel_per,4,7);
   $email_per = $datos["email_per"];
   $desc_tip_trab = $datos["desc_tip_trab"];
   $foto_per = $datos["foto_per"];
   $tip_foto_per = $datos["tip_foto_per"];
   $fec_ing_per = $datos["fec_ing_per"];
   $fec_ing_per = substr($fec_ing_per,8,2)."-".substr($fec_ing_per,5,2)."-".substr($fec_ing_per,0,4);
   $activo_per = $datos["activo_per"];
   $fec_reg_ivss = $datos["fec_reg_ivss"];
   $fec_reg_ivss = substr($fec_reg_ivss,8,2)."-".substr($fec_reg_ivss,5,2)."-".substr($fec_reg_ivss,0,4);
   $fec_ret_ivss = $datos["fec_ret_ivss"];
   $fec_ret_ivss = substr($fec_ret_ivss,8,2)."-".substr($fec_ret_ivss,5,2)."-".substr($fec_ret_ivss,0,4);
   $nomb_pat = $datos["nomb_pat"];
 }
?>
<script language='javascript' src="popcalendar.js"></script>
<FORM METHOD="post" ENCTYPE="multipart/form-data" NAME="datos" action="">
        <TABLE BORDER="0" ALIGN="CENTER">
                <TR>
                <TD ROWSPAN="8" WIDTH="90"><CENTER></TD><td colspan="7">
                  <DIV ALIGN="CENTER"><P class="cabecera">Datos Personales</P>
                  </DIV>
                </TR>
                <TR>
                  <TD aling="center" colspan="2" rowspan="6"><? if ($foto_per != "") {echo '<center><IMG WIDTH="150" HEIGHT="150" SRC="bdc_ver_foto.php?codg_per='.$codg_per; echo '" title="foto de '.$nomb_per.'"></center>';} ?>
                  <label></label></TD>
                  <TD><P ALIGN="RIGHT" class="mini">C&eacute;dula:</P></TD>
                  <TD><P ALIGN="LEFT" class="campo">
                  <INPUT class="campo" TYPE="TEXT" NAME="codg_per_new" SIZE="8" MAXLENGTH="8" VALUE="<? echo $codg_per; ?>" title="Introduzca el n�mero de c�dula del personal">
                  </P></TD>
                  <TD><P ALIGN="RIGHT" class="mini">Sexo:</P></TD>
                  <TD><SELECT class="campo" NAME="sexo_per" title="Seleccione un sexo de la lista...">
                      <OPTION value="0">Seleccione...</OPTION>
                      <OPTION VALUE="F" <? if ($sexo_per == "F") {echo 'SELECTED';}?> >Femenino</OPTION>
                      <OPTION VALUE="M" <? if ($sexo_per == "M") {echo 'SELECTED';}?> >Masculino</OPTION
                >
                  </SELECT></TD>
                </TR>
                <TR>
                  <TD WIDTH="105"><P ALIGN="RIGHT" class="mini">Nombre(s):</P></TD>
                <TD WIDTH="150"><INPUT class="campo" TYPE="TEXT" NAME="nomb_per" title="Introduzca el nombre del Personal" MAXLENGTH="30" SIZE="30" VALUE="<? echo $nomb_per; ?>"></TD>
                <TD WIDTH="105"><P ALIGN="RIGHT" class="mini">Apellido(s):</P></TD>
                <TD WIDTH="150"><INPUT class="campo" TYPE="TEXT" title="Introduzca el apellido del personal" NAME="apel_per" MAXLENGTH="30" SIZE="30" VALUE="<? echo $apel_per; ?>"></TD>
                </TR>
                <TR>
                <TD><P ALIGN="RIGHT" class="mini">Estado Civil:</P></TD>
                <TD><SELECT class="campo" NAME="est_civ_per" title="Seleccione de la lista el estado civil del personal">
                <OPTION value="0">Seleccione...</OPTION>
                <OPTION VALUE="S" <? if ($est_civ_per == "S") {echo 'SELECTED';}?> >Soltero</OPTION>
                <OPTION VALUE="C" <? if ($est_civ_per == "C") {echo 'SELECTED';}?> >Casado</OPTION>
                <OPTION VALUE="D" <? if ($est_civ_per == "D") {echo 'SELECTED';}?> >Divorciado</OPTION>
                <OPTION VALUE="V" <? if ($est_civ_per == "V") {echo 'SELECTED';}?> >Viudo</OPTION>
                </SELECT></TD>
                <TD><P ALIGN="RIGHT" class="mini">Fecha de Nacimiento:</P></TD>
                <TD>
                <INPUT TYPE="TEXT" title="Seleccione con ayuda del calendario la fecha de nacimiento" NAME="fec_nac_per" class="campo" VALUE="<? echo $fec_nac_per; ?>" MAXLENGTH="10" SIZE="10" id="fecha" onClick="popUpCalendar(this, datos.fecha, 'dd-mm-yyyy');" READONLY>
                <IMG onClick="popUpCalendar(this, datos.fecha, 'dd-mm-yyyy');" SRC="../images/cal.gif" title="Haz Click para Buscar la Fecha" WIDTH="16" HEUGHT="16" BORDER="0"></TD>
                </TR>
                <TR>
                  <TD><P ALIGN="RIGHT" class="mini">Pa&iacute;s de Nacimiento:</P></TD>
                  <TD><SELECT class="campo" NAME="codg_pais_nac_per" title ="Seleccione de la lista el pa�s donde naci� el personal" id="codg_pais_nac_per" onChange="cambo_anidado(this.value)">                      <OPTION value="0">Seleccione...</OPTION>
                      <? $paises = mysql_query("SELECT codg_pais, nomb_pais FROM bdc_paises ORDER BY 2");
                if (mysql_num_rows($paises) != 0)
                {
                    while ($pais = mysql_fetch_array($paises))
                  {
                   echo '<OPTION VALUE="'.$pais["codg_pais"];
                                       echo '"';
                                       if ($codg_pais_nac_per == $pais["codg_pais"])
                                        {
                                           echo 'SELECTED';
                                        }
                                       echo '>'.$pais["nomb_pais"];
                                       echo '</OPTION>';
                  }
                }
                ?>
                    </SELECT>                  </TD>
                  <TD><P ALIGN="RIGHT" class="mini">Tipo de Personal:</TD>
                  <TD><SELECT class="campo" NAME="codg_tip_trab" title="Seleccione de la lista el tipo de Personal a cual pertenece">
                      <OPTION value="0">Seleccione...</OPTION>
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
                    </SELECT>                  </TD>
                </TR>
                <TR>
                <TD><P ALIGN="RIGHT" class="mini">Estado de Nacimiento:</P></TD>
                <TD><SELECT class="campo"name="codg_est_nac_per" id="codg_est_nac_per" title="Seleccione de la lista el estado en que naci� el personal">
                <OPTION>Seleccione...</OPTION>
                 <?
                if ($codg_pais_nac_per != "")
                {
                      $estados = mysql_query("SELECT codg_est, nomb_est FROM bdc_estados WHERE codg_pais=$codg_pais_nac_per ORDER BY 2");
                  if (mysql_num_rows($estados) != 0)
                  {
                       while ($estado = mysql_fetch_array($estados))
                     {
                      echo '<OPTION VALUE="'.$estado["codg_est"];
                                          echo '"';
                                          if ($codg_est_nac_per == $estado["codg_est"])
                                          {
                                              echo 'SELECTED';
                                          }
                                          echo '>'.$estado["nomb_est"];
                                          echo '</OPTION>';
                     }
                  }
                }
                ?>
                </SELECT>                </TD>
                <TD><P ALIGN="RIGHT" class="mini">Nacionalidad:</TD>
                <TD><SELECT class="campo" NAME="naci_per" title="Seleccione de la lista la Nacionalidad del Personal">
                <OPTION value="0">Seleccione...</OPTION>
                <OPTION VALUE="V" <? if ($naci_per == "V") {echo 'SELECTED';}?> >Venezolano</OPTION>
                <OPTION VALUE="E" <? if ($naci_per == "E") {echo 'SELECTED';}?> >Extranjero</OPTION>
                </SELECT></TD>
                </TR>
                <TR>
                <TD><P ALIGN="RIGHT" class="mini">�Activo en el Sistema?:</TD>
                <TD>
                       <TABLE>
                        <TR>
                        <TD><P ALIGN="RIGHT" class="campo">Si</TD>
                        <TD VALIGN="TOP"><INPUT title="El seleccione esta opci�n si el personal se encuentra activo" class="campo" TYPE="RADIO" NAME="activo_per" VALUE="S" <? if ($activo_per == "S") {echo 'CHECKED';}?> ></TD>
                        <TD><P ALIGN="RIGHT" class="campo">No</TD>
                        <TD VALIGN="TOP"><INPUT class="campo" title="El seleccione esta opci�n si el personal NO se encuentra activo" TYPE="RADIO" NAME="activo_per" VALUE="N" <? if ($activo_per == "N") {echo 'CHECKED';}?> ></TD>
                        </TR>
                  </TABLE>                </TD>
             <TD><P ALIGN="RIGHT" class="mini">Fecha de Ingreso:</P></TD>
                <TD><INPUT TYPE="TEXT" NAME="fec_ing_per" class="campo" VALUE="<? echo $fec_ing_per; ?>" MAXLENGTH="10" SIZE="10" id="fecha2" onClick="popUpCalendar(this, datos.fecha2, 'dd-mm-yyyy');" READONLY  title="Seleccione con ayuda del calendario la fecha de ingreso a la DEPPECD" >
                  <IMG onClick="popUpCalendar(this, datos.fecha2, 'dd-mm-yyyy');" SRC="../images/cal.gif" title="Haz Click para Buscar la Fecha" WIDTH="16" HEUGHT="16" BORDER="0"></TD>
                </TR>
                <TR>
                <TD COLSPAN="6">
                <DIV ALIGN="CENTER"><P class="cabecera">Domicilio</P></DIV>                </TD>
                </TR>
                <TR>
                <TD>                </TD>
                <TD><P ALIGN="RIGHT" class="mini">Estado:</P></TD>
                <TD><SELECT class="campo" NAME="codg_est_dom_per" id="codg_est_dom_per" onChange="cambo_anidado2(this.value),cambo_anidado3(this.value)" title="Seleccione de la lista el Estado donde se encuentra domiciliado el personal">
                <OPTION value="0">Seleccione...</OPTION>
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
                <TD><SELECT class="campo" name="codg_mun_dom_per" id="codg_mun_dom_per" onChange="cambo_anidado3(this.value, codg_est_dom_per.value)" title="Seleccione de la lista el Municipio donde se encuentra domiciliado el personal">
                <OPTION value="0">Seleccione...</OPTION>
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
                </SELECT></TD>
                <TD><P ALIGN="RIGHT" class="mini">Parroquia:</P></TD>
                <TD><SELECT class="campo" name="codg_parr_dom_per"  id="codg_parr_dom_per" title="Seleccione de la lista la Parroquia donde se encuentra domiciliado el personal">
                <OPTION value="0">Seleccione...</OPTION>
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
                <TD>                </TD>
                <TD><P ALIGN="RIGHT" class="mini">Direcci&oacute;n:</P></TD>
                <TD COLSPAN="6"><INPUT class="campo" TYPE="TEXT" NAME="dirc_per" MAXLENGHT="200" SIZE="130" VALUE="<? echo $dirc_per; ?>" title="Escriba la direcci�n de domicilio del personal"></TD>
                </TR>

                <TR>
                <TD>                </TD>
                <TD><P ALIGN="RIGHT" class="mini">Tel&eacute;fono:</P></TD>

                <TD><P ALIGN="LEFT" class="campo">(<INPUT class="campo" TYPE="TEXT" NAME="codg_tel" MAXLENGHT="4" SIZE="1" VALUE="<? echo $codg_tel; ?>" title="Introduzca el c�digo de �rea del tel�fono del personal">
                )<INPUT class="campo" TYPE="TEXT" NAME="tel" MAXLENGHT="7" SIZE="7" VALUE="<? echo $tel; ?>" title="Introduzca el n�mero de tel�fono del personal"></P></TD>
                <TD><P ALIGN="RIGHT" class="mini">Celular:</P></TD>

                <TD><P ALIGN="LEFT" class="campo">(<INPUT class="campo" TYPE="TEXT" NAME="codg_cel" MAXLENGHT="4" SIZE="1" VALUE="<? echo $codg_cel; ?>" title="Introduzca el c�digo de la operadora del celular del personal">
                )<INPUT class="campo" TYPE="TEXT" NAME="cel" MAXLENGHT="7" SIZE="7" VALUE="<? echo $cel; ?>" title="Introduzca el n�mero de celular del personal"></P></TD>
                <TD><P ALIGN="RIGHT" class="mini">E-Mail:</P></TD>
                <TD><INPUT class="campo" TYPE="TEXT" NAME="email_per" MAXLENGHT="50" SIZE="30" VALUE="<? echo $email_per ?>" title="Introduzca el correo electr�nico del personal"></TD>
                </TR>

                <TR>
                <TD>                </TD>
                <TD COLSPAN="6">
                <DIV ALIGN="CENTER"><P class="cabecera">Seguro Social</P></DIV>                </TD>
                </TR>

                <TR>
                 <TD>                </TD>
                <TD><P ALIGN="RIGHT" class="mini">Fecha de Registro:</P></TD>
                <TD><INPUT TYPE="TEXT" NAME="fec_reg_ivss" class="campo" VALUE="<? if (($fec_reg_ivss != 'NULL') AND ($fec_reg_ivss != '00-00-0000')){echo $fec_reg_ivss;} ?>" MAXLENGTH="10" SIZE="10" id="fecha3" onClick="popUpCalendar(this, datos.fecha3, 'dd-mm-yyyy');" READONLY title="Seleccione con ayuda del calendario la fecha en que fue registrado en el IVSS">
                  <IMG onClick="popUpCalendar(this, datos.fecha3, 'dd-mm-yyyy');" SRC="../images/cal.gif" title="Haz Click para Buscar la Fecha" WIDTH="16" HEUGHT="16" BORDER="0"></TD>

                <TD><P ALIGN="RIGHT" class="mini">Fecha de Retiro:</P></TD>
                <TD><INPUT TYPE="TEXT" NAME="fec_ret_ivss" class="campo" VALUE="<? if (($fec_ret_ivss != 'NULL') AND ($fec_ret_ivss != '00-00-0000')){echo $fec_ret_ivss;} ?>" MAXLENGTH="10" SIZE="10" id="fecha4" onClick="popUpCalendar(this, datos.fecha4, 'dd-mm-yyyy');" READONLY title="Si es el caso, seleccione con ayuda del calendario la fecha de retiro de IVSS">
                  <IMG onClick="popUpCalendar(this, datos.fecha4, 'dd-mm-yyyy');" SRC="../images/cal.gif" title="Haz Click para Buscar la Fecha" WIDTH="16" HEUGHT="16" BORDER="0"></TD>

                <TD WIDTH="105"><P ALIGN="RIGHT" class="mini">Nombre del Patrono:</P></TD>
                <TD WIDTH="150"><INPUT class="campo" TYPE="TEXT" NAME="nomb_pat" MAXLENGTH="100" SIZE="30" VALUE="<? if (($nomb_pat != 'NULL') AND ($nomb_pat != '')) {echo $nomb_pat;} ?>" title="Introduzca el nombre del patrono al que pertenece el personal"></TD>
                </TR>



                <TR>
                <TD>                </TD>
                <TD COLSPAN="6">
                <DIV ALIGN="CENTER"><P class="cabecera">Foto</P></DIV>                </TD>
                </TR>

                <TR>
                <TD>                </TD>
                <TD><P ALIGN="RIGHT" class="mini">Ubicaci&oacute;n:</P></TD>
                <TD COLSPAN="3"><INPUT class="campo" TYPE="FILE" name="foto_per" SIZE="50" title="Haga click para buscar la foto que desea asignar"></TD>
                </TR>
                <TR>
                <TD>                </TD>
                <TD COLSPAN="6"><HR></TD>
                </TR>
                <TR align="center">
                <TD COLSPAN="7">
                    <?PHP echo '<a href="#" onclick="imprimir()"><img border=0 src="../images/print_ico.png" title="Imprimir Ficha del Trabajador">'; ?><br>Imprimir Ficha del Trabajador</a></TD>
                </TR>
                <TR>
                <TD>                </TD>
                <TD COLSPAN="6"><HR></TD>
                </TR>
                
        </TABLE>


<CENTER><INPUT title="Haga click para Actualizar los datos en pantalla" class="mini" TYPE="SUBMIT" VALUE="Actualizar" onClick="ingresar();">&nbsp;<INPUT class="mini" TYPE="BUTTON" VALUE="Siguiente >>" onClick="siguiente()" title="Haga click para ir a la siguiente pesta�a">&nbsp;<INPUT title="Haga click para finalizar la edici�n e ir a la pantalla inicial" class="mini" TYPE="BUTTON" VALUE="Finalizar" onClick="finalizar()"></CENTER>


<INPUT TYPE="hidden" NAME="action" VALUE="">
<INPUT TYPE="hidden" NAME="pasada" VALUE="1">
<INPUT TYPE="hidden" NAME="codg_per" VALUE="<? echo $codg_per; ?>">


</FORM>
<?
if ($action == "ins")
{

                $fec_nac_per = substr($fec_nac_per,6,4)."-".substr($fec_nac_per,3,2)."-".substr($fec_nac_per,0,2);
                $fec_ing_per = substr($fec_ing_per,6,4)."-".substr($fec_ing_per,3,2)."-".substr($fec_ing_per,0,2);
                $fec_reg_ivss = substr($fec_reg_ivss,6,4)."-".substr($fec_reg_ivss,3,2)."-".substr($fec_reg_ivss,0,2);
                $fec_ret_ivss = substr($fec_ret_ivss,6,4)."-".substr($fec_ret_ivss,3,2)."-".substr($fec_ret_ivss,0,2);
                $tel_per = "$codg_tel$tel";
                $cel_per = "$codg_cel$cel";
                if ($esta_civ_per == "0") {($est_civ_per = "NULL");} else {($est_civ_per = "'$est_civ_per'");}
                if ($codg_pais_nac_per == "0") {($codg_pais_nac_per = "NULL");}
                if ($codg_est_nac_per == "0") {($codg_est_nac_per = "NULL");}
                if ($codg_est_dom_per == "0") {($codg_est_dom_per = "NULL");}
                if ($codg_mun_dom_per == "0") {($codg_mun_dom_per = "NULL");}
                if ($codg_parr_dom_per == "0") {($codg_parr_dom_per = "NULL");}
                if ($dirc_per == "") {($dirc_per = "NULL");} else {($dirc_per = "'$dirc_per'");}
                if ($tel_per == "") {($tel_per = "NULL");} else {($tel_per = "'$tel_per'");}
                if ($cel_per == "") {($cel_per = "NULL");} else {($cel_per = "'$cel_per'");}
                if ($email_per == "") {($email_per = "NULL");} else {($email_per = "'$email_per'");}
                if ($activo_per == "") {($activo_per = "S");} else {($activo_per = "$activo_per");}
                if ($fec_reg_ivss == "--") {($fec_reg_ivss = "0000-00-00");} else {($fec_reg_ivss = "$fec_reg_ivss");}
                if ($fec_ret_ivss == "--") {($fec_ret_ivss = "0000-00-00");} else {($fec_ret_ivss = "$fec_ret_ivss");}
                if ($nomb_pat == "") {($nomb_pat = "NULL");} else {($nomb_pat = "$nomb_pat");}

                if ( $foto_per != "" )
                {
                   $tamanio = $_FILES["foto_per"]["size"];
                   $tip_foto_per = $_FILES['foto_per']['type'];

                   $fp = fopen($foto_per, "rb");
                   $contenido = fread($fp, $tamanio);
                   $contenido = addslashes($contenido);
                   fclose($fp);

                     if ($foto_per == "") {($contenido = "NULL");} else {($contenido = "'$contenido'");}
                     if (!isset ($tip_foto_per)) {($tip_foto_per = "NULL");} else {($tip_foto_per = "'$tip_foto_per'");}

                     $qry = ("UPDATE bdc_datos_per SET codg_per=$codg_per_new, apel_per='$apel_per', nomb_per='$nomb_per', sexo_per='$sexo_per', fec_nac_per='$fec_nac_per',
                                                          naci_per='$naci_per', est_civ_per=$est_civ_per, codg_pais_nac_per=$codg_pais_nac_per, codg_est_nac_per=$codg_est_nac_per,
                                                          codg_est_dom_per=$codg_est_dom_per, codg_mun_dom_per=$codg_mun_dom_per, codg_parr_dom_per=$codg_parr_dom_per,
                                                          dirc_per=$dirc_per, tel_per=$tel_per, cel_per=$cel_per, email_per=$email_per, codg_tip_trab='$codg_tip_trab',
                                                          foto_per=$contenido, tip_foto_per=$tip_foto_per, fec_ing_per='$fec_ing_per', activo_per='$activo_per', fec_reg_ivss='$fec_reg_ivss',
                                                          fec_ret_ivss='$fec_ret_ivss', nomb_pat='$nomb_pat'
                                                          WHERE codg_per=$codg_per");

                mysql_query ($qry);

                 }
               else
                {
                    $qry = ("UPDATE bdc_datos_per SET codg_per=$codg_per_new, apel_per='$apel_per', nomb_per='$nomb_per', sexo_per='$sexo_per', fec_nac_per='$fec_nac_per',
                                                          naci_per='$naci_per', est_civ_per=$est_civ_per, codg_pais_nac_per=$codg_pais_nac_per, codg_est_nac_per=$codg_est_nac_per,
                                                          codg_est_dom_per=$codg_est_dom_per, codg_mun_dom_per=$codg_mun_dom_per, codg_parr_dom_per=$codg_parr_dom_per,
                                                          dirc_per=$dirc_per, tel_per=$tel_per, cel_per=$cel_per, email_per=$email_per, codg_tip_trab='$codg_tip_trab',
                                                          fec_ing_per='$fec_ing_per', activo_per='$activo_per', fec_reg_ivss='$fec_reg_ivss',
                                                          fec_ret_ivss='$fec_ret_ivss', nomb_pat='$nomb_pat'
                                                          WHERE codg_per=$codg_per");

                mysql_query ($qry);
                }
               echo '<SCRIPT>alert("Datos Personales Actualizados");</SCRIPT>';
               echo '<SCRIPT>location = "bdc_edit_datos_personales.php?codg_per='.$codg_per_new.'&id_tab=1&direccion=bdc_edit_datos_personales2.php";</SCRIPT>' ;
              }
?>

<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">


  var frmvalidator  = new Validator("datos");

  frmvalidator.addValidation("codg_per_new","req","Ingrese la C�dula de la Persona");
  frmvalidator.addValidation("codg_per_new","num","La C�dula de la Persona s�lo acepta caracteres num�ricos");
  frmvalidator.addValidation("codg_per_new","minlen=6","El M�nimo de Caracteres para la C�dula es 6");

  frmvalidator.addValidation("nomb_per","req","Ingrese el Nombre de la Persona");
  frmvalidator.addValidation("nomb_per","alphanum");

  frmvalidator.addValidation("apel_per","req","Ingrese el Apellido de la Persona");
  frmvalidator.addValidation("apel_per","alphanum");

  frmvalidator.addValidation("sexo_per","dontselect=0","Seleccione el Sexo de la Persona");

  frmvalidator.addValidation("fec_nac_per","req","Seleccione la Fecha de Nacimiento");

  frmvalidator.addValidation("naci_per","dontselect=0","Seleccione la Nacionalidad de la Persona");

  frmvalidator.addValidation("codg_tip_trab","dontselect=0","Seleccione el Tipo de Trabajador");

  frmvalidator.addValidation("fec_ing_per","req","Seleccione la Fecha de Ingreso");
  
  frmvalidator.addValidation("cel","num","El numero celular de la Persona s�lo acepta caracteres num�ricos");

</SCRIPT>

</BODY>

</HTML>
<script> 
function cambo_anidado(cod_area){
	//alert(cod_area); 
	document.datos.codg_est_nac_per.length=0; 
	document.datos.codg_est_nac_per.options[0] = new Option("Seleccione...","","defaultSelected",""); 
	var indice=1; 
	<?
		$sql_nom_dep = "SELECT * from bdc_estados"; 
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

function cambo_anidado2(cod_area){ 
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

function cambo_anidado3(cod_area, cod_area2){ 
//alert(cod_area); 
	document.datos.codg_parr_dom_per.length=0; 
	document.datos.codg_parr_dom_per.options[0] = new Option("Seleccione...","","defaultSelected","");								 	var indice=1; 
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

