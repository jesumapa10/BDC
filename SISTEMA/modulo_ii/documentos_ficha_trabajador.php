<?php include ("../sesion.php");
      include ("../conex.php"); ?>
<HTML>
<HEAD>
<LINK REL="STYLESHEET" HREF="../style/normal.css" TYPE="text/css">
<SCRIPT LANGUAGE="JavaScript" SRC="../scripts/validar.js" TYPE="text/javascript"></SCRIPT>
</HEAD>
<BODY>
<?php
/// Para crear la Fecha Actual en que se genera el reporte
$dia = Date(d);
$mes = Date(m);   
$ano = Date(Y);
if ($mes == 1) {$mes='Enero';} 
if ($mes == 2) {$mes='Febrero';}
if ($mes == 3) {$mes='Marzo';}
if ($mes == 4) {$mes='Abril';}
if ($mes == 5) {$mes='Mayo';}
if ($mes == 6) {$mes='Junio';}
if ($mes == 7) {$mes='Julio';}
if ($mes == 8) {$mes='Agosto';}
if ($mes == 9) {$mes='Septiembre';}
if ($mes == 10) {$mes='Octubre';}
if ($mes == 11) {$mes='Noviembre';}
if ($mes == 12) {$mes='Diciembre';}
$fch_act = $dia.' de '.$mes.' del '.$ano;

////////////////////// Consulta de los datos Personales //////////////////////
$codg_per = $_GET['codg_per'];
$sql_per = "Select * FROM bdc_datos_per p, bdc_tip_trab t WHERE p.codg_per=$codg_per and p.codg_tip_trab=t.codg_tip_trab";
$res_per = mysql_query($sql_per);
$datos = mysql_fetch_array($res_per);
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
   
//////// Consulta de Pais, Estado, Municipios /////////////

$pais_nac = mysql_query("SELECT e.nomb_pais FROM bdc_paises e WHERE e.codg_pais = ".$codg_pais_nac_per);
$pais_nac = mysql_fetch_array($pais_nac);
$pais_nacimiento = $pais_nac["nomb_pais"];

$est_nac = mysql_query("SELECT e.nomb_est FROM bdc_estados e WHERE e.codg_est = ".$codg_est_nac_per);
$est_nac = mysql_fetch_array($est_nac);
$estado_nacimiento = $est_nac["nomb_est"];

$est_dom = mysql_query("SELECT e.nomb_est FROM bdc_estados e WHERE e.codg_est = ".$codg_est_dom_per);
$est_dom = mysql_fetch_array($est_dom);
$estado_domicilio = $est_dom["nomb_est"];

$mun_dom = mysql_query("SELECT e.nomb_mun FROM bdc_datos_per p, bdc_municipios e WHERE p.codg_per=$codg_per AND p.codg_pais_dom_per=e.codg_pais and p.codg_est_dom_per=e.codg_est and p.codg_mun_dom_per=e.codg_mun");
$mun_dom = mysql_fetch_array($mun_dom);
$municipio_domicilio = $mun_dom["nomb_mun"];

$parr_dom = mysql_query("SELECT e.nomb_parr FROM bdc_datos_per p, bdc_parroquias e WHERE p.codg_per=$codg_per AND p.codg_pais_dom_per=e.codg_pais and p.codg_est_dom_per=e.codg_est and p.codg_mun_dom_per=e.codg_mun and p.codg_parr_dom_per=e.codg_parr");
$parr_dom = mysql_fetch_array($parr_dom);
$parroquia_domicilio = $parr_dom["nomb_parr"];

$tip_trab = mysql_query("SELECT desc_tip_trab FROM bdc_tip_trab WHERE codg_tip_trab = '".$codg_tip_trab."'");
$tip_trab = mysql_fetch_array($tip_trab);
$tip_trab = $tip_trab["desc_tip_trab"];

?>
<TABLE ALIGN=CENTER width="98%">
    <tr>
        <td rowspan="2" width="1"><img src="../images/logo_documentos.png" width="101" height="78" title="Logo DEPPECD"></td>
        <td align="right">Mérida, <?php echo $fch_act; ?></td>
    </tr>
        <td colspan="2" align="center"><h1>FICHA DEL TRABAJADOR</h1></td>
</TABLE>
<table border="1" bordercolor="#000000" cellspacing="0" width="98%">
    <tr align="center">
        <td class="cabecera" colspan="4">D A T O S  &nbsp;&nbsp;&nbsp;&nbsp;P E R S O N A L E S</td>
    </tr>
    <tr align="center">
        <td class="ficha_etiqueta">Cédula</td>
        <td class="ficha_etiqueta">Nombres</td>
        <td class="ficha_etiqueta">Apellidos</td>
        <td rowspan="13" width="170" valign="top" align="center"> <br>
            <? if ($foto_per != "") {echo '<IMG WIDTH="150" HEIGHT="150" title="FOTO" SRC="bdc_ver_foto.php?codg_per='.$codg_per; echo '">';} else { echo 'FOTO'; }?>
        </td>
    </tr>
    <tr align="center" class="ficha_datos">
        <td><?php echo $naci_per.'-'.$codg_per;?></td>
        <td><?php echo $nomb_per;?></td>
        <td><?php echo $apel_per;?></td>
    </tr>    
    <tr align="center">
        <td class="ficha_etiqueta">Fecha Nac.</td>
        <td class="ficha_etiqueta">Pais Nac.</td>
        <td class="ficha_etiqueta">Estado Nac.</td>
    </tr>
    <tr align="center" class="ficha_datos">
        <td><?php echo $fec_nac_per;?></td>
        <td><?php echo $pais_nacimiento;?></td>
        <td><?php echo $estado_nacimiento;?></td>
    </tr>    
    <tr align="center">
        <td class="ficha_etiqueta">Sexo</td>
        <td class="ficha_etiqueta">Estado Civil</td>
        <td class="ficha_etiqueta">Tipo de Trabajador</td>
    </tr>
    <tr align="center" class="ficha_datos">
        <td><?php 
            if ($sexo_per == "F") {echo 'Femenino';}
            if ($sexo_per == "M") {echo 'Masculino';} ?>
        </td>
        <td><?php 
            if ($est_civ_per == "S") {echo 'Soltero';}
            if ($est_civ_per == "C") {echo 'Casado';}
            
            if ($est_civ_per == "D") {echo 'Divorciado';}
            if ($est_civ_per == "V") {echo 'Viudo';}
        ?>
        </td>
        <td><?php echo $tip_trab;?></td>
    </tr>
    <tr align="center">
        <td class="cabecera" colspan="3">D O M I C I L I O</td>
    </tr>   
    <tr align="center">
        <td class="ficha_etiqueta">Estado</td>
        <td class="ficha_etiqueta">Municipio</td>
        <td class="ficha_etiqueta">Parroquia</td>
    </tr>
    <tr align="center" class="ficha_datos">
        <td><?php echo $estado_domicilio;?></td>
        <td><?php echo $municipio_domicilio;?></td>
        <td><?php echo $parroquia_domicilio;?></td>
    </tr>
        <tr align="center">
        <td class="ficha_etiqueta" colspan="3">Dirección</td>
    </tr>
    <tr align="center" class="ficha_datos">
        <td colspan="3"><?php echo $dirc_per;?></td>
    </tr>
    <tr align="center">
        <td class="ficha_etiqueta">Teléfono</td>
        <td class="ficha_etiqueta">Celular</td>
        <td class="ficha_etiqueta">e-mail</td>
    </tr>
    <tr align="center" class="ficha_datos">
        <td><?php echo $codg_tel.' - '.$tel;?></td>
        <td><?php echo $codg_cel.' - '.$cel;?></td>
        <td><?php echo '<a href="mailto:'.$email_per.'" title="Enviar Correo">'.$email_per.'</a>';?></td>
    </tr>
</table>
<br>
<?php ////////////////////// Consulta de los datos Académicos ////////////////////// ?>
<table border="1" bordercolor="#000000" cellspacing="0" width="98%">
    <tr align="center">
        <td class="cabecera" colspan="5">D A T O S  &nbsp;&nbsp;&nbsp;&nbsp;A C A D É M I C O S</td>
    </tr>
    <tr align="center">
        <td class="ficha_etiqueta">Nivel de Instrucción</td>
        <td class="ficha_etiqueta">Carrera</td>
        <td class="ficha_etiqueta">Estudia Actualmente</td>
        <td class="ficha_etiqueta">Semestre/Año</td>
        <td class="ficha_etiqueta">Fecha de Grado</td>
    </tr>
    <?php 
    $sql_aca = "Select * FROM bdc_datos_acad a, bdc_niv_inst n, bdc_carreras c WHERE a.codg_per=$codg_per and a.codg_niv_inst=n.codg_niv_inst AND a.codg_car=c.codg_car order by fec_grado desc";
    $res_aca = mysql_query($sql_aca);
    while ($datos = mysql_fetch_array($res_aca)) { ?>
        <tr align="center" class="ficha_datos">
            <td><?php echo $datos['desc_niv_inst'];?></td>
            <td><?php echo $datos['desc_car'];?></td>
            <td>
                <?php if ($datos['estudia_act'] == 'N') { echo 'NO'; }?>
                <?php if ($datos['estudia_act'] == 'S') { echo 'SI'; }?>
            </td>
            <td>
                <?php if ($datos['estudia_sem'] != '') { echo $datos['desc_car']; } else {echo '&nbsp;';}?>
            </td>
            <td>
                <?php if ($datos['fec_grado'] != '0000-00-00') {
                        echo substr($datos['fec_grado'],8,2)."-".substr($datos['fec_grado'],5,2)."-".substr($datos['fec_grado'],0,4); 
                      } 
                      else 
                      {
                        echo '&nbsp;';
                      }?>
            </td>
        </tr> 
    <?php 
    }
    ?>
</table>
<br>
<?php ////////////////////// Consulta de los datos Laborales ////////////////////// ?>
<table border="1" bordercolor="#000000" cellspacing="0" width="98%">
    <tr align="center">
        <td class="cabecera" colspan="6">D A T O S  &nbsp;&nbsp;&nbsp;&nbsp;L A B O R A L E S</td>
    </tr>
    <tr align="center">
        <td class="ficha_etiqueta">Municipio</td>
        <td class="ficha_etiqueta">Parroquia</td>
        <td class="ficha_etiqueta">Institución</td>
        <td class="ficha_etiqueta">Cargo</td>
        <td class="ficha_etiqueta">Condición</td>
        <td class="ficha_etiqueta">Ingreso</td>
        
    </tr>
    <?php 
    $sql_lab = "Select * FROM bdc_datos_lab WHERE codg_per=$codg_per";
    $res_lab = mysql_query($sql_lab);
    while ($datos = mysql_fetch_array($res_lab)) {
        $fec_ingp_lab = substr($datos['fec_ingp_lab'],8,2)."-".substr($datos['fec_ingp_lab'],5,2)."-".substr($datos['fec_ingp_lab'],0,4);
        //// consultar los datos de la Institucion 
        $sql_insti = "Select * from bdc_instituciones i, bdc_paises pa, bdc_estados e, bdc_municipios m, bdc_parroquias p Where i.codg_insti=".$datos['codg_insti']." AND i.codg_pais=pa.codg_pais AND i.codg_est=e.codg_est AND i.codg_est=m.codg_est AND i.codg_mun=m.codg_mun AND i.codg_est=p.codg_est AND i.codg_mun=p.codg_mun AND i.codg_parr=p.codg_parr;";
        $res_insti = mysql_query($sql_insti);
        $datos_insti = mysql_fetch_array($res_insti);
        $nom_insti = $datos_insti['nomb_insti'];
        $nom_mun = $datos_insti['nomb_mun'];
        $nom_par = $datos_insti['nomb_parr'];
        ///// Consultar los datos del cargo
        $sql_car = "Select * from bdc_cargo where codg_cargo = ".$datos['codg_cargo'].";";
        $res_car = mysql_query($sql_car);
        $datos_car = mysql_fetch_array($res_car);
        $nom_car = $datos_car['desc_cargo'];   
        ///// Consultar los datos de la condición laboral
        $sql_cond = "Select * from bdc_cond_lab where codg_cond_lab = ".$datos['codg_cond_lab'].";";
        $res_cond = mysql_query($sql_cond);
        $datos_cond = mysql_fetch_array($res_cond);
        $nom_cond = $datos_cond['desc_cond_lab'];   
        
        
             
        ?>
        
        <tr align="center" class="ficha_datos">
            <td><?php echo $nom_mun;?></td>
            <td><?php echo $nom_par;?></td>
            <td><?php echo $nom_insti;?></td>
            <td><?php echo $nom_car;?></td>
            <td><?php echo $nom_cond;?></td>
            <td><?php echo $fec_ingp_lab;?></td>
        </tr>
   <?php } ?>
</table>
<br>
<?php ////////////////////// Consulta de los datos Familiares ////////////////////// ?>
<table border="1" bordercolor="#000000" cellspacing="0" width="98%">
    <tr align="center">
        <td class="cabecera" colspan="6">D A T O S  &nbsp;&nbsp;&nbsp;&nbsp;F A M I L I A R E S</td>
    </tr>
    <tr align="center">
        <td class="ficha_etiqueta">Nombres</td>
        <td class="ficha_etiqueta">Apellidos</td>
        <td class="ficha_etiqueta">Fec. Nac.</td>
        <td class="ficha_etiqueta">Sexo</td>
        <td class="ficha_etiqueta">Parentesco</td>
        <td class="ficha_etiqueta">Estudia</td>
    </tr>
    <?php 
    $sql_fam = "Select * FROM bdc_carga_fam where codg_per = $codg_per";
    $res_fam = mysql_query($sql_fam);
    while ($datos = mysql_fetch_array($res_fam)) { ?>
        <tr align="center" class="ficha_datos">
            <td><?php echo $datos['nomb_carga_fam'];?></td>
            <td><?php echo $datos['apel_carga_fam'];?></td>
            <td><?php if ($datos['fec_nac_carga_fam'] != '0000-00-00') {
                        echo substr($datos['fec_nac_carga_fam'],8,2)."-".substr($datos['fec_nac_carga_fam'],5,2)."-".substr($datos['fec_nac_carga_fam'],0,4); 
                      } 
                      else 
                      {
                        echo '&nbsp;';
                      }?>
            </td>
            <td>
                <?php 
                if ($datos['sexo_carga_fam'] == "F") {echo 'Femenino';}
                if ($datos['sexo_carga_fam'] == "M") {echo 'Masculino';} ?>
            </td>
            <td>
                <?php if ($datos['paren_carga_fam'] == "C") {echo 'Cónyugue';} ?>
                <?php if ($datos['paren_carga_fam'] == "H") {echo 'Hijo(a)';}?>
                <?php if ($datos['paren_carga_fam'] == "M") {echo 'Madre';}?>
                <?php if ($datos['paren_carga_fam'] == "P") {echo 'Padre';}?>
            </td>
            <td>
                <?php 
                if ($datos['estudia_carga_fam'] == "N") {echo 'NO';}
                else
                {
                    if ($datos['nivel_est_carga_fam'] == "P") {echo 'Primaria';}
                    if ($datos['nivel_est_carga_fam'] == "B") {echo 'Bachillerato';}
                    if ($datos['nivel_est_carga_fam'] == "M") {echo 'Media';}
                    if ($datos['nivel_est_carga_fam'] == "U") {echo 'Universitaria';}
                } ?>
            </td>
        </tr> 
    <?php 
    }
    ?>
</table>
<br>
<br>
<center>
<input type="button" name="bt_print" value="Imprimir Ficha" id="bt_print" onclick="this.style.visibility='hidden'; window.print();" title="Haga Click para Imprimir el presente documento"></center>
<P><CENTER><HR>
  <span class="descripcion"><FONT SIZE=2>Sector La Parroquia Av. 5 "Las Pe&ntilde;as", (detr&aacute;s del Liceo Caracciolo Parra y Olmedo) Edificio "Aguas Blancas" torre "A" 
  <br>
  M&eacute;rida, Estado M&eacute;rida.<BR>
  Tel&eacute;fonos: (0274) 271.22.33 - 271.56.34 - 271.59.83 - 271.32.22      www.decd-merida.gov.ve  e-mail: decd@decd-merida.gov.ve</span>
</CENTER></P>
</BODY>
</HTML>
