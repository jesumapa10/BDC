<?
  include ("../sesion.php");

  include ("../conex.php");
?>

<HTML>
<HEAD>
        <LINK REL="STYLESHEET" HREF="../style/normal.css" TYPE="text/css">

</HEAD>

<?
$consulta = mysql_query("SELECT p.apel_per, p.nomb_per, p.sexo_per, p.fec_nac_per, p.naci_per, p.est_civ_per,
                         p.dirc_per, p.tel_per, p.cel_per, p.email_per,
                         t.desc_tip_trab, p.foto_per, p.tip_foto_per, p.fec_ing_per, p.activo_per, p.fec_reg_ivss, p.fec_ret_ivss, p.nomb_pat
                         FROM bdc_datos_per p, bdc_tip_trab t
                         WHERE p.codg_per=$codg_per and p.codg_tip_trab=t.codg_tip_trab");

$datos = mysql_fetch_array($consulta);

$apel_per = $datos["apel_per"];
$nomb_per = $datos["nomb_per"];
$sexo_per = $datos["sexo_per"];
$fec_nac_per = $datos["fec_nac_per"];
$naci_per = $datos["naci_per"];
$est_civ_per = $datos["est_civ_per"];
$dirc_per = $datos["dirc_per"];
$tel_per = $datos["tel_per"];
$cel_per = $datos["cel_per"];
$email_per = $datos["email_per"];
$desc_tip_trab = $datos["desc_tip_trab"];
$foto_per = $datos["foto_per"];
$tip_foto_per = $datos["tip_foto_per"];
$fec_ing_per = $datos["fec_ing_per"];
$activo_per = $datos["activo_per"];
$fec_reg_ivss = $datos["fec_reg_ivss"];
$fec_ret_ivss = $datos["fec_ret_ivss"];
$nomb_pat = $datos["nomb_pat"];


//$fec_nac = mysql_query("SELECT DATE_FORMAT('fec_nac_per', '%d/%m/%Y') as fecha_nac FROM bdc_datos_per WHERE codg_per=$codg_per");
//$row_fec_nac = mysql_fetch_object($fec_nac);
//$fec_nac_per = $row->fecha_nac;

$pais_nac = mysql_query("SELECT e.nomb_pais FROM bdc_datos_per p, bdc_paises e WHERE p.codg_per=$codg_per AND p.codg_pais_nac_per=e.codg_pais");
$pais_nac = mysql_fetch_array($pais_nac);
$pais_nacimiento = $pais_nac["nomb_pais"];

$est_nac = mysql_query("SELECT e.nomb_est FROM bdc_datos_per p, bdc_estados e WHERE p.codg_per=$codg_per AND p.codg_pais_nac_per=e.codg_pais and p.codg_est_nac_per=e.codg_est");
$est_nac = mysql_fetch_array($est_nac);
$estado_nacimiento = $est_nac["nomb_est"];

$est_dom = mysql_query("SELECT e.nomb_est FROM bdc_datos_per p, bdc_estados e WHERE p.codg_per=$codg_per AND p.codg_pais_dom_per=e.codg_pais and p.codg_est_dom_per=e.codg_est");
$est_dom = mysql_fetch_array($est_dom);
$estado_domicilio = $est_dom["nomb_est"];

$mun_dom = mysql_query("SELECT e.nomb_mun FROM bdc_datos_per p, bdc_municipios e WHERE p.codg_per=$codg_per AND p.codg_pais_dom_per=e.codg_pais and p.codg_est_dom_per=e.codg_est and p.codg_mun_dom_per=e.codg_mun");
$mun_dom = mysql_fetch_array($mun_dom);
$municipio_domicilio = $mun_dom["nomb_mun"];

$parr_dom = mysql_query("SELECT e.nomb_parr FROM bdc_datos_per p, bdc_parroquias e WHERE p.codg_per=$codg_per AND p.codg_pais_dom_per=e.codg_pais and p.codg_est_dom_per=e.codg_est and p.codg_mun_dom_per=e.codg_mun and p.codg_parr_dom_per=e.codg_parr");
$parr_dom = mysql_fetch_array($parr_dom);
$parroquia_domicilio = $parr_dom["nomb_parr"];

?>


        <TABLE BORDER="0" ALIGN="CENTER">
                <TR>
                <TD ROWSPAN="9"><CENTER></TD><td colspan="7">
                  <DIV ALIGN="CENTER"><P class="cabecera">Datos Personales
                  </DIV>
                </TR>

                <TR>
                  <TD colspan="2" rowspan="5"><div align="center">
                    <? if ($foto_per != "") {echo '<IMG WIDTH="86" HEIGHT="104" SRC="bdc_ver_foto.php?codg_per='.$codg_per; echo '">';} ?>
                  </div></TD>
                  <TD><P ALIGN="RIGHT" class="mini">C&eacute;dula:</P></TD>
                  <TD><P ALIGN="LEFT" class="campo">
                    <? if ($naci_per == "V") {echo 'V - ';} else {echo 'E - ';} echo number_format($codg_per ,0 , "," ,"."); ?>
                    
                  </P></TD>
                  <TD><P ALIGN="RIGHT" class="mini">Sexo:</P></TD>
                  <TD><P ALIGN="LEFT" class="campo">
                    <? if ($sexo_per == "M") {echo 'Masculino';} else {echo 'Femenino';} ?>
                  </P></TD>
                </TR>
                <TR>
                <TD WIDTH="107"><P ALIGN="RIGHT" class="mini">Nombre(s):</P></TD>
                <TD WIDTH="150"><P ALIGN="LEFT" class="campo"><? echo $nomb_per; ?></P></TD>
                <TD WIDTH="105"><P ALIGN="RIGHT" class="mini">Apellido(s):</P></TD>
                <TD WIDTH="150"><P ALIGN="LEFT" class="campo"><? echo $apel_per; ?></P></TD>
                </TR>

                <TR>
                <TD><P ALIGN="RIGHT" class="mini">Estado Civil:</P></TD>
                <TD><P ALIGN="LEFT" class="campo"><?
                                                       if ($est_civ_per == "S") {echo 'Soltero';}
                                                       if ($est_civ_per == "C") {echo 'Casado';}
                                                       if ($est_civ_per == "D") {echo 'Divorciado';}
                                                       if ($est_civ_per == "V") {echo 'Viudo';}
                                                      ?>
                </P></TD>
                <TD><P ALIGN="RIGHT" class="mini">Fecha de Nacimiento:</P></TD>
                <? $fec_nac_per = substr($fec_nac_per,8,2)."-".substr($fec_nac_per,5,2)."-".substr($fec_nac_per,0,4);?>
                <TD><P ALIGN="LEFT" class="campo"><? echo $fec_nac_per ?><br></P></TD>
                </TR>

                <TR>
                  <TD><P ALIGN="RIGHT" class="mini">Pa&iacute;s de Nacimiento:</P></TD>
                  <TD><P ALIGN="LEFT" class="campo">
                    <? if ($pais_nacimiento != "") {echo $pais_nacimiento;} ?>
                  </P></TD>
                  <TD><P ALIGN="RIGHT" class="mini">Edad:</p></TD>
                  <td><span class="campo">
                    <?
                    $fec_nac_per = substr($fec_nac_per,6,4)."-".substr($fec_nac_per,3,2)."-".substr($fec_nac_per,0,2);
                     //$sql_tiempo = "SELECT TO_DAYS(now())-TO_DAYS(fec_nac_per) as tiempo_nac FROM bdc_datos_per WHERE codg_per=$codg_per";

                    //$execute_sql = mysql_query($sql_tiempo);

                    //$row = mysql_fetch_object($execute_sql);

                    //$tiempo_capturado = $row->tiempo_nac;
                    $tiempo_transcurrido = date("Y", time()) - substr($fec_nac_per,0,4);
                    if ((date("m", time())) > (substr($fec_nac_per,5,2)))
                    {
                    echo $tiempo_transcurrido; echo '&nbsp;'; echo 'Años';
                    }
                    else
                    {
                      if ((date("m", time())) < (substr($fec_nac_per,5,2)))
                       {
                         echo $tiempo_transcurrido -1; echo '&nbsp;'; echo 'Años';
                       }
                    }
                    if ((date("m", time())) == (substr($fec_nac_per,5,2)))
                    {
                    echo $tiempo_transcurrido; echo '&nbsp;Años';
                    }
                    ?>
                  </span>                
                  <TD>&nbsp;</TD>
                </TR>

                <TR>
                  <TD><P ALIGN="RIGHT" class="mini">Estado de Nacimiento:</P></TD>
                  <TD><P ALIGN="LEFT" class="campo">
                      <? if ($estado_nacimiento != "") {echo $estado_nacimiento;} ?>
                  </P></TD>
                  <TD><P ALIGN="RIGHT" class="mini">&nbsp;</p></TD>
                  <td>                  
                <span class="campo">                </span>
                <TD><P ALIGN="LEFT" class="campo">&nbsp;</P></TD>
                </TR>

                <TR>
                <TD COLSPAN="6">
                <DIV ALIGN="CENTER"><P class="cabecera">Domicilio</P></DIV>                </TD>
                </TR>

                <TR>
                <TD><P ALIGN="RIGHT" class="mini">Estado:</P></TD>
                <TD><P ALIGN="LEFT" class="campo"><? echo $estado_domicilio; ?></P></TD>
                <TD><P ALIGN="RIGHT" class="mini">Municipio:</P></TD>
                <TD><P ALIGN="LEFT" class="campo"><? echo $municipio_domicilio; ?></P></TD>
                <TD><P ALIGN="RIGHT" class="mini">Parroquia:</P></TD>
                <TD><P ALIGN="LEFT" class="campo"><? echo $parroquia_domicilio; ?></P></TD>
                </TR>

                <TR>
                <TD><div align="right"><span class="mini">Direcci&oacute;n:</span></div></TD>
                <TD colspan="7"><P class="campo"><? if ($dirc_per != "NULL"){ echo $dirc_per;} ?>
                  </P></TD>
                </TR>

                <TR>
                <TD></TD>
                <TD><P ALIGN="RIGHT" class="mini">Tel&eacute;fono:</P></TD>
                <TD><P ALIGN="LEFT" class="campo"><? if (($tel_per != "NULL") AND ($cel_per != "")){ echo $codg_tel = substr($tel_per,0,4); echo '&nbsp;'; echo '-'; echo '&nbsp;'; echo $tel_per = substr($tel_per,4,7);} ?></P></TD>
                <TD><P ALIGN="RIGHT" class="mini">Celular:</P></TD>
                <TD><P ALIGN="LEFT" class="campo"><? if (($cel_per != "NULL") AND ($cel_per != "")){ echo $codg_cel = substr($cel_per,0,4); echo '&nbsp;'; echo '-'; echo '&nbsp;'; echo $cel_per = substr($cel_per,4,7);} ?></P></TD>
                <TD><P ALIGN="RIGHT" class="mini">E-Mail:</P></TD>
                <TD><P ALIGN="LEFT" class="campo"><? if($email_per != "NULL"){ echo $email_per; }?></P></TD>
                </TR>

                <TR>
                <TD></TD>
                <TD COLSPAN="6">
                <DIV ALIGN="CENTER"><P class="cabecera">Ingreso al Sistema de Educaci&oacute;n</P></DIV>                </TD>
                </TR>

                <TR>
                <TD></TD>
                <TD><P ALIGN="RIGHT" class="mini">Fecha de Ingreso:</P></TD>
                <? $fec_ing_per = substr($fec_ing_per,8,2)."-".substr($fec_ing_per,5,2)."-".substr($fec_ing_per,0,4);?>
                <TD><P ALIGN="LEFT" class="campo"><? echo $fec_ing_per ?></P></TD>
                <TD><P ALIGN="RIGHT" class="mini">Años de Servicio:</P></TD>
                <TD><P ALIGN="LEFT" class="campo">
                <? $fec_ing_per = substr($fec_ing_per,6,4)."-".substr($fec_ing_per,3,2)."-".substr($fec_ing_per,0,2);
                                                   $tiempo_transcurrido1 = date("Y", time()) - substr($fec_ing_per,0,4);

                                                   if ((date("m", time())) > (substr($fec_ing_per,5,2)))
                                                      {
                                                          echo $tiempo_transcurrido1; echo '&nbsp;'; echo 'Años';
                                                      }
                                                      else
                                                      {
                                                        if ((date("m", time())) < (substr($fec_ing_per,5,2)))
                                                          {
                                                            echo $tiempo_transcurrido1 -1; echo '&nbsp;'; echo 'Años';
                                                          }
                                                      }
                                                      if ((date("m", time())) == (substr($fec_ing_per,5,2)))
                                                         {
                                                           echo $tiempo_transcurrido1; echo '&nbsp;'; echo 'Años';
                                                         }
                                                   ?>
                </P></TD>
                <TD><P ALIGN="RIGHT" class="mini">¿Activo en el Sistema?:</P></TD>
                <TD><? if ($activo_per == "S") { echo '<P ALIGN="left" class="campo">Si</P>';} else { echo '<P ALIGN="left" class="rojop">No</P>';} ?></TD>
                </TR>

                <TR>
                <TD></TD>
                <TD COLSPAN="6">
                <DIV ALIGN="CENTER"><P class="cabecera">Seguro Social</P></DIV>                </TD>
                </TR>

                <TR>
                <TD></TD>
                <TD><P ALIGN="RIGHT" class="mini">Fecha de Registro:</P></TD>
                <TD><P ALIGN="LEFT" class="campo"><? if (($fec_reg_ivss != 'NULL') AND ($fec_reg_ivss != '0000-00-00')){echo $fec_reg_ivss = substr($fec_reg_ivss,8,2)."-".substr($fec_reg_ivss,5,2)."-".substr($fec_reg_ivss,0,4);}?></P></TD>

                <TD><P ALIGN="RIGHT" class="mini">Fecha de Retiro:</P></TD>
                <TD><P ALIGN="LEFT" class="campo"><? if (($fec_ret_ivss != 'NULL') AND ($fec_ret_ivss != '0000-00-00')){echo $fec_ret_ivss = substr($fec_ret_ivss,8,2)."-".substr($fec_ret_ivss,5,2)."-".substr($fec_ret_ivss,0,4);}?></P></TD>

                <TD><P ALIGN="RIGHT" class="mini">Nombre del Patrono:</P></TD>
                <TD><P ALIGN="LEFT" class="campo"><? if (($nomb_pat != 'NULL') AND ($nomb_pat != '')){echo $nomb_pat;} ?></P></TD>
                </TR>
        </TABLE>

</HTML>