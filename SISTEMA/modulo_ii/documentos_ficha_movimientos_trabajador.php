<?php include ("../sesion.php");
      include ("../conex.php"); ?>
<HTML>
<HEAD>
<LINK REL="STYLESHEET" HREF="../style/normal.css" TYPE="text/css">
<SCRIPT LANGUAGE="JavaScript" SRC="../scripts/validar.js" TYPE="text/javascript"></SCRIPT>
<TITLE>FICHA DE MOVIMIENTOS DEL TRABAJADOR</TITLE>
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

//////// Consulta de tipo de Trabajador /////////////

$tip_trab = mysql_query("SELECT desc_tip_trab FROM bdc_tip_trab WHERE codg_tip_trab = '".$codg_tip_trab."'");
$tip_trab = mysql_fetch_array($tip_trab);
$tip_trab = $tip_trab["desc_tip_trab"];

?>
<TABLE ALIGN=CENTER width="98%">
    <tr>
        <td rowspan="2" width="1"><img src="../images/logo_documentos.png" width="101" height="78" title="Logo DEPPECD"></td>
        <td align="right">Mérida, <?php echo $fch_act; ?></td>
    </tr>
        <td colspan="2" align="center"><h1>FICHA DE MOVIMIENTOS DEL TRABAJADOR</h1><b>NOTA:</b> El reporte solo muestra: Comisiones de Servicio, Permisos, Translados.</td>
</TABLE>
<table border="1" bordercolor="#000000" cellspacing="0" width="98%">
    <tr align="center">
        <td class="cabecera" colspan="3">D A T O S  &nbsp;&nbsp;&nbsp;&nbsp;P E R S O N A L E S</td>
    </tr>
    <tr align="center">
        <td class="ficha_etiqueta">Cédula</td>
        <td class="ficha_etiqueta">Nombres</td>
        <td class="ficha_etiqueta">Apellidos</td>
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
</table>
<br>
<?php ////////////////////// Consulta de los datos de comisiones de servicios ////////////////////// ?>
<table border="1" bordercolor="#000000" cellspacing="0" width="98%">
    <tr align="center">
        <td class="cabecera" colspan="6">C O M I S I O N E S&nbsp;&nbsp;&nbsp;&nbsp;D E&nbsp;&nbsp;&nbsp;&nbsp;S E R V I C I O</td>
    </tr>
    <tr align="center">
        <td class="ficha_etiqueta">Nº Oficio</td>
        <td class="ficha_etiqueta">Plantel Origen</td>
        <td class="ficha_etiqueta">Plantel Destino</td>
        <td class="ficha_etiqueta">Funciones a Desempeñar</td>
        <td class="ficha_etiqueta">Fecha Inicio</td>
        <td class="ficha_etiqueta">Fecha Fin</td>
    </tr>
    <?php 
    $sql_com = "SELECT c.n_oficio, (SELECT io.nomb_insti FROM bdc_instituciones io WHERE io.codg_insti=c.codg_plantel_desde) AS insti_ori, (SELECT id.nomb_insti FROM bdc_instituciones id WHERE id.codg_insti=c.codg_plantel_insti_hacia_com_serv)  AS insti_des, c.func_desemp_com_serv, c.fec_inicio_com_serv, c.fec_fin_com_serv FROM bdc_com_serv c WHERE c.codg_per=$codg_per ORDER BY c.fec_fin_com_serv desc";
    $res_com = mysql_query($sql_com);
    if (!$datos1 = mysql_fetch_array($res_com)) {
         echo '<tr><td colspan="6" align="center"><B class="rojo">No Posee Registros</B></td></tr>'; 
    }
    $res_com = mysql_query($sql_com);
    while ($datos = mysql_fetch_array($res_com)) { ?>
        <tr align="center" class="ficha_datos">
            <td><?php echo $datos['n_oficio'];?></td>
            <td><?php echo $datos['insti_ori'];?></td>
            <td><?php echo $datos['insti_des'];?></td>
            <td><?php echo $datos['func_desemp_com_serv'];?></td>
            <td>
                <?php if ($datos['fec_inicio_com_serv'] != '0000-00-00') {
                        echo substr($datos['fec_inicio_com_serv'],8,2)."-".substr($datos['fec_inicio_com_serv'],5,2)."-".substr($datos['fec_inicio_com_serv'],0,4); 
                      } 
                      else 
                      {
                        echo '&nbsp;';
                      }?>
            </td>
            <td>
                <?php if ($datos['fec_fin_com_serv'] != '0000-00-00') {
                        echo substr($datos['fec_fin_com_serv'],8,2)."-".substr($datos['fec_fin_com_serv'],5,2)."-".substr($datos['fec_fin_com_serv'],0,4); 
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
<?php ////////////////////// Consulta de los Permisos ////////////////////// ?>
<table border="1" bordercolor="#000000" cellspacing="0" width="98%">
    <tr align="center">
        <td class="cabecera" colspan="5">P E R M I S O S</td>
    </tr>
    <tr align="center">
        <td class="ficha_etiqueta">Tipo</td>
        <td class="ficha_etiqueta">Permiso</td>
        <td class="ficha_etiqueta">Fecha Inicio</td>
        <td class="ficha_etiqueta">Fecha Fin</td>
        <td class="ficha_etiqueta">Motivo</td>
        
    </tr>
    <?php 
    $sql_perm = "Select dp.tip_perm, (SELECT p.nomb_perm FROM bdc_permisos p WHERE p.codg_perm = dp.codg_perm ) AS nom_perm, dp.fec_inicio, dp.fec_fin, dp.motivo FROM bdc_datos_permisos dp WHERE dp.codg_per=$codg_per";
    $res_perm = mysql_query($sql_perm);
    if (!$datos1 = mysql_fetch_array($res_perm)) {
         echo '<tr><td colspan="5" align="center"><B class="rojo">No Posee Registros</B></td></tr>'; 
    }
    $res_perm = mysql_query($sql_perm);
    while ($datos = mysql_fetch_array($res_perm)) {
        ?>
        <tr align="center" class="ficha_datos">
            <td>
                <?php 
                    if ($datos['tip_perm']== "1") {echo 'Remunerado';}
                    if ($datos['tip_perm']== "2") {echo 'No Remunerado';}
                    if ($datos['tip_perm']== "3") {echo 'Postestativo';}
                    if ($datos['tip_perm']== "4") {echo 'IPAS Estadal';}
                    if ($datos['tip_perm']== "5") {echo 'Licencia Sabática';} 
                ?>
            </td>
            <td><?php echo $datos['nom_perm'];?></td><td>
                <?php if ($datos['fec_inicio'] != '0000-00-00') {
                        echo substr($datos['fec_inicio'],8,2)."-".substr($datos['fec_inicio'],5,2)."-".substr($datos['fec_inicio'],0,4); 
                      } 
                      else 
                      {
                        echo '&nbsp;';
                      }?>
            </td>
            <td>
                <?php if ($datos['fec_fin'] != '0000-00-00') {
                        echo substr($datos['fec_fin'],8,2)."-".substr($datos['fec_fin'],5,2)."-".substr($datos['fec_fin'],0,4); 
                      } 
                      else 
                      {
                        echo '&nbsp;';
                      }?>
            </td>
            <td><?php echo $datos['motivo'];?></td>
        </tr>
   <?php } ?>
</table>
<br>
<?php ////////////////////// Consulta de los datos de los traslados ////////////////////// ?>
<table border="1" bordercolor="#000000" cellspacing="0" width="98%">
    <tr align="center">
        <td class="cabecera" colspan="5">T R A S L A D O S</td>
    </tr>
    <tr align="center">
        <td class="ficha_etiqueta">Plantel Origen</td>
        <td class="ficha_etiqueta">Fecha Egreso</td>
        <td class="ficha_etiqueta">Plantel Destino</td>
        <td class="ficha_etiqueta">Fecha de Ingreso</td>
        <td class="ficha_etiqueta">Tipo</td>
    </tr>
    <?php 
    $sql_trs = "Select (SELECT io.nomb_insti FROM bdc_instituciones io WHERE io.codg_insti=t.codg_plantel_desde) AS insti_ori, fec_egr, (SELECT io.nomb_insti FROM bdc_instituciones io WHERE io.codg_insti=t.codg_plantel_hacia) AS insti_des, fec_ing, (SELECT tt.desc_tip_traslado FROM bdc_tip_traslado tt where codg_tip_traslado = t.codg_tip_traslado) AS tipo_traslado FROM bdc_traslado t where codg_per = $codg_per";
    $res_trs = mysql_query($sql_trs);
    if (!$datos1 = mysql_fetch_array($res_trs)) {
         echo '<tr><td colspan="5" align="center"><B class="rojo">No Posee Registros</B></td></tr>'; 
    }
    $res_trs = mysql_query($sql_trs);
    while ($datos = mysql_fetch_array($res_trs)) { ?>
        <tr align="center" class="ficha_datos">
            <td><?php echo $datos['insti_ori'];?></td>
            <td>
                <?php if ($datos['fec_egr'] != '0000-00-00') {
                        echo substr($datos['fec_egr'],8,2)."-".substr($datos['fec_egr'],5,2)."-".substr($datos['fec_egr'],0,4); 
                      } 
                      else 
                      {
                        echo '&nbsp;';
                      }?>
            </td>
            <td><?php echo $datos['insti_des'];?></td><td>
                <?php if ($datos['fec_ing'] != '0000-00-00') {
                        echo substr($datos['fec_ing'],8,2)."-".substr($datos['fec_ing'],5,2)."-".substr($datos['fec_ing'],0,4); 
                      } 
                      else 
                      {
                        echo '&nbsp;';
                      }?>
            </td>
            <td><?php echo $datos['tipo_traslado'];?></td>
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
