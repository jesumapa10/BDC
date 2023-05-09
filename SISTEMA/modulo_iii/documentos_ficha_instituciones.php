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

////////////////////// Consulta de los datos Instituciones //////////////////////
$codg_per = $_GET['codg_insti'];

$consulta_insti = mysql_query("SELECT bdc_instituciones.*, bdc_instituciones.codg_insti, bdc_instituciones.nomb_insti, bdc_municipios.nomb_mun, bdc_mod_plantel.desc_mod_plantel, bdc_tip_plantel.desc_tip_plantel, bdc_tip_insti.codg_tip_insti, bdc_tip_insti.desc_tip_insti FROM ((((bdc_plantel RIGHT JOIN bdc_instituciones ON bdc_plantel.codg_insti = bdc_instituciones.codg_insti) LEFT JOIN bdc_municipios ON (bdc_instituciones.codg_mun = bdc_municipios.codg_mun) AND (bdc_instituciones.codg_est = bdc_municipios.codg_est) AND (bdc_instituciones.codg_pais = bdc_municipios.codg_pais)) LEFT JOIN bdc_mod_plantel ON bdc_plantel.codg_mod_plantel = bdc_mod_plantel.codg_mod_plantel) LEFT JOIN bdc_tip_plantel ON bdc_plantel.codg_tip_plantel = bdc_tip_plantel.codg_tip_plantel) LEFT JOIN bdc_tip_insti ON bdc_instituciones.codg_tip_insti = bdc_tip_insti.codg_tip_insti WHERE (((bdc_instituciones.codg_insti) = $codg_insti))");
        
 
 $datos1 = mysql_fetch_array($consulta_insti);

         $nomb_insti = $datos1["nomb_insti"];
         $codg_mun = $datos1["codg_mun"];
	 	 $nomb_mun = $datos1["nomb_mun"];
         $codg_parr = $datos1["codg_parr"];
         $dirc_insti = $datos1["dirc_insti"];
         $telf_insti = $datos1["telf_insti"];
         $fax_insti = $datos1["fax_insti"];
         $org_insti = $datos1["org_insti"];
         $codg_tip_insti = $datos1["codg_tip_insti"];
         $desc_tip_insti = $datos1["desc_tip_insti"];
	 $codg_tel= substr($telf_insti,0,4);
	 $tel= substr($telf_insti,4,7);
	 $codg_fax= substr($fax_insti,0,4);
	 $fax= substr($fax_insti,4,7);

 $parroquias = mysql_query("SELECT codg_parr, nomb_parr FROM bdc_parroquias WHERE codg_parr=$codg_parr and codg_pais=58 and codg_est=274 and codg_mun=$codg_mun ORDER BY 2");
					   if (mysql_num_rows($parroquias) != 0){$parroquia = mysql_fetch_array($parroquias);}
				$nomb_parr=$parroquia["nomb_parr"];

$tipos = mysql_query("SELECT codg_tip_insti, desc_tip_insti FROM bdc_tip_insti WHERE codg_tip_insti=$codg_tip_insti ORDER BY 2"); 
				  if (mysql_num_rows($tipos) != 0){$tipo = mysql_fetch_array($tipos);}
               			$desc_tip_insti=$tipo["desc_tip_insti"];


//////// Consulta de los datos Plantel /////////////

$consulta_planel = mysql_query("SELECT codg_plantel, codg_ner_plantel, codg_dic_plantel, nomb_dic_plantel, codg_tip_plantel, codg_mod_plantel, ner_ppal_plantel
                         FROM bdc_plantel
                         WHERE codg_insti=$codg_insti");

          $plantel = mysql_fetch_array($consulta_planel);

          $codg_plantel = $plantel["codg_plantel"];
          $codg_ner_plantel = $plantel["codg_ner_plantel"];
          $codg_dic_plantel = $plantel["codg_dic_plantel"];
          $nomb_dic_plantel = $plantel["nomb_dic_plantel"];
          $codg_tip_plantel = $plantel["codg_tip_plantel"];
	  $codg_mod_plantel = $plantel["codg_mod_plantel"];
          $ner_ppal_plantel = $plantel["ner_ppal_plantel"];

$tipos_plantel = mysql_query("SELECT codg_tip_plantel, desc_tip_plantel FROM bdc_tip_plantel WHERE codg_tip_plantel=$codg_tip_plantel ORDER BY 2");
				if (mysql_num_rows($tipos_plantel) != 0)
				{
				  $tipo_plantel = mysql_fetch_array($tipos_plantel);
				  $desc_tip_plantel=$tipo_plantel["desc_tip_plantel"];
				}

$mods_plantel = mysql_query("SELECT codg_mod_plantel, desc_mod_plantel FROM bdc_mod_plantel WHERE codg_mod_plantel=$codg_mod_plantel ORDER BY 2");
				if (mysql_num_rows($mods_plantel) != 0)
				{
				  $mod_plantel = mysql_fetch_array($mods_plantel);
				  $desc_mod_plantel=$mod_plantel["desc_mod_plantel"];
				}


?>
<TABLE ALIGN=CENTER width="98%">
    <tr>
        <td rowspan="2" width="1"><img src="../images/logo_documentos.png" width="101" height="78" title="Logo DEPPECD"></td>
        <td align="right">Mérida, <?php echo $fch_act; ?></td>
    </tr>
        <td colspan="2" align="center"><h1>FICHA DE LA INSTITUCIÓN </h1></td>
</TABLE>
<table border="1" bordercolor="#000000" cellspacing="0" width="98%" ALIGN="CENTER">
    <tr align="center">
        <td class="cabecera" colspan="4">D A T O S  &nbsp;&nbsp;&nbsp;&nbsp;I N S T I T U C I Ó N </td>
    </tr>
    <tr align="center">
        <td colspan="2" class="ficha_etiqueta">Nombre de la Institución</td>
        <td colspan="2" class="ficha_datos"><?php echo $nomb_insti;?></td>
    </tr>
    <tr align="center">
        <td colspan="2" class="ficha_etiqueta">Dirección</td>
        <td colspan="2" class="ficha_datos"><?php echo $dirc_insti;?></td>
    </tr>
    <tr align="center">
        <td colspan="2" class="ficha_etiqueta">Tipo de Institución </td>
        <td colspan="2" class="ficha_datos"><?php echo $desc_tip_insti;?></td>
    </tr> 
    <tr align="center">
        <td class="ficha_etiqueta">Municipio</td>
        <td class="ficha_datos"><?php echo $nomb_mun;?></td>
	<td class="ficha_etiqueta">Parroquia</td>
        <td class="ficha_datos"><?php echo $nomb_parr;?></td>
    </tr>      
    <tr align="center">
        <td class="ficha_etiqueta">Teléfono</td>
        <td class="ficha_datos"><?php echo $tel;?></td>
        <td class="ficha_etiqueta">Fax</td>
        <td class="ficha_datos"><?php echo $fax;?></td>
    </tr>
    </table>
    <br>
    <table border="1" bordercolor="#000000" cellspacing="0" width="98%" ALIGN="CENTER">
    <tr align="center">
        <td class="cabecera" colspan="4"> D A T O S &nbsp;&nbsp;&nbsp;&nbsp P L A N T E L</td>
    </tr>   
    <tr align="center">
        <td colspan="2" class="ficha_etiqueta">Código del M.E</td>
        <td colspan="2" class="ficha_datos"><?php echo $codg_plantel;?></td>
    </tr>
    <tr align="center">
        <td class="ficha_etiqueta">Cédula del Director</td>
        <td class="ficha_datos"><?php echo $codg_dic_plantel;?></td>
	<td class="ficha_etiqueta">Nombre del Director</td>
        <td class="ficha_datos"><?php echo $nomb_dic_plantel;?></td>
    </tr>
    <tr align="center">
        <td class="ficha_etiqueta">Tipo de Plantel</td>
        <td class="ficha_datos"><?php echo $desc_tip_plantel;?></td>
	<td class="ficha_etiqueta">Modalidad del Plantel</td>
        <td class="ficha_datos"><?php echo $desc_mod_plantel;?></td>
    </tr>
    <tr align="center">
        <td class="ficha_etiqueta">Código de NER</td>
        <td class="ficha_datos"><?php echo $codg_ner_plantel;?></td>
	<td class="ficha_etiqueta">¿NER Principal?</td>
        <td class="ficha_datos"><?php echo $ner_ppal_plantel;?></td>
    </tr>
   
</table>
<br>
<TABLE border="1" bordercolor="#000000" cellspacing="0" width="98%" ALIGN="CENTER">
		<TR>
		<TD><DIV ALIGN="CENTER"><P class="cabecera">P E R S O N A L &nbsp;&nbsp;&nbsp;&nbsp D O C E N TE</P></DIV></TD>
		</TR>
		</TABLE>

		<TABLE border="1" bordercolor="#000000" cellspacing="0" width="98%" ALIGN="CENTER">
		<TR>
		<TD WIDTH="100"><P class="mini" ALIGN="CENTER">C&eacute;dula</P></TD>
		<TD WIDTH="300"><P class="mini" ALIGN="CENTER">Apellido(s) y Nombre(s)</P></TD>
		<TD WIDTH="150"><P class="mini" ALIGN="CENTER">Jerarquia en el Plantel</P></TD>
		<TD WIDTH="150"><P class="mini" ALIGN="CENTER">Condici&oacute;n Laboral</P></TD>
		</TR>

	<?  $docentes=mysql_query("SELECT p.codg_per, p.apel_per, p.nomb_per, c.desc_cond_lab, bdc_instituciones.nomb_insti, bdc_jer_plantel.desc_jer_plantel FROM ((bdc_datos_per AS p INNER JOIN bdc_datos_lab AS l ON p.codg_per = l.codg_per) LEFT JOIN bdc_cond_lab AS c ON l.codg_cond_lab = c.codg_cond_lab) INNER JOIN bdc_instituciones ON l.codg_insti = bdc_instituciones.codg_insti LEFT JOIN bdc_jer_plantel ON l.codg_jer_plantel = bdc_jer_plantel.codg_jer_plantel WHERE (((l.codg_insti)=$codg_insti) AND ((p.codg_tip_trab)='D') AND ((p.activo_per)='S')) ORDER BY 2");
	
	if (mysql_num_rows($docentes) != 0)
         {

           while ($datos = mysql_fetch_array($docentes))
            {
				
			 echo'<TR>';
			 echo'<TD><P class="campo" ALIGN="CENTER">'.$datos["codg_per"];echo'</TD>';
			 echo'<TD><P class="campo" ALIGN="LEFT">'.$datos["apel_per"];echo' '.$datos["nomb_per"];echo'</TD>';
			  echo'<TD><P class="campo" ALIGN="CENTER">'.$datos["desc_cargo"];echo'</TD>';
			 echo'<TD><P class="campo" ALIGN="CENTER">'.$datos["desc_cond_lab"];echo'</TD>';
			//echo'<TD><p class="descripcion" align=center><A HREF="../modulo_ii/bdc_datos_personales.php?codg_per='.$datos["codg_per"];echo'&id_tab=1">Ver Ficha</A></TD>';
	         }
			  echo '<TR>
                     <TD COLSPAN="4"><P class="mini" ALIGN="CENTER">Se han encontrado '.mysql_num_rows($docentes).' registro(s)</P></TD>
                     </TR>

                   </TABLE> ';
            }
           else
           {
            echo'    <CENTER><P><B class="rojo">Error:</B> No existen Registros</CENTER>';
           }
		 	 
		
  		?>

	</TABLE>
<BR>


		<TABLE border="1" bordercolor="#000000" cellspacing="0" width="98%" ALIGN="CENTER">
		<TR>
		<TD><DIV ALIGN="CENTER"><P class="cabecera">P E R S O N A L             &nbsp;&nbsp;&nbsp;&nbsp A D M I N I S T R A T I V O  &nbsp;&nbsp Y &nbsp;&nbsp O B R E R O</P></DIV></TD>
		</TR>
		</TABLE>

		<TABLE border="1" bordercolor="#000000" cellspacing="0" width="98%" ALIGN="CENTER">
		<TR>
		<TD WIDTH="100"><P class="mini" ALIGN="CENTER">C&eacute;dula</P></TD>
		<TD WIDTH="300"><P class="mini" ALIGN="CENTER">Apellido(s) y Nombre(s)</P></TD>
		<TD WIDTH="150"><P class="mini" ALIGN="CENTER">Cargo</P></TD>
		<TD WIDTH="150"><P class="mini" ALIGN="CENTER">Condici&oacute;n Laboral</P></TD>
		<TD WIDTH="100"><P class="mini" ALIGN="CENTER">Tipo de Personal</P></TD>
		</TR>
<?
	$administrativo=mysql_query("SELECT p.codg_per, p.apel_per, p.nomb_per, p.codg_tip_trab, c.desc_cond_lab, bdc_instituciones.nomb_insti, bdc_cargo.desc_cargo FROM ((bdc_datos_per AS p INNER JOIN bdc_datos_lab AS l ON p.codg_per = l.codg_per) LEFT JOIN bdc_cond_lab AS c ON l.codg_cond_lab = c.codg_cond_lab) INNER JOIN bdc_instituciones ON l.codg_insti = bdc_instituciones.codg_insti LEFT JOIN bdc_cargo ON l.codg_cargo = bdc_cargo.codg_cargo WHERE (((l.codg_insti)=$codg_insti) AND ((p.codg_tip_trab)<>'D') AND ((p.activo_per)='S')) ORDER BY 2");
		if (mysql_num_rows($administrativo) != 0)
         {

           while ($datos = mysql_fetch_array($administrativo))
            {
			 echo'<TR>';
			 echo'<TD><P class="campo" ALIGN="CENTER">'.$datos["codg_per"];echo'</TD>';
			 echo'<TD><P class="campo" ALIGN="LETF">'.$datos["apel_per"];echo' '.$datos["nomb_per"];echo'</TD>';
			echo'<TD><P class="campo" ALIGN="CENTER">'.$datos["desc_cargo"];echo'</TD>';
			 echo'<TD><P class="campo" ALIGN="CENTER">'.$datos["desc_cond_lab"];echo'</TD>';
			 echo'<TD><P class="campo" ALIGN="CENTER">';if ($datos["codg_tip_trab"]=="A"){ echo 'Administrativo';}else{ echo 'Obrero';}echo'</TD>';
		//echo'<TD><p class="descripcion" align=center><A HREF="../modulo_ii/bdc_datos_personales.php?codg_per='.$datos["codg_per"];echo'&id_tab=1';echo'">Ver Ficha</A></TD>';
	         }
			  echo '<TR>
                     <TD COLSPAN="5"><P class="mini" ALIGN="CENTER">Se han encontrado '.mysql_num_rows($administrativo).' registro(s)</P></TD>
                     </TR>

                   </TABLE> ';
            }
           else
           {
            echo'    <CENTER><P><B class="rojo">Error:</B> No existen Registros</CENTER>';
           }
		 	 
		
  		?>
<br>
<br>
<center>
<input type="button" name="bt_print" value="Imprimir Ficha" id="bt_print" onClick="this.style.visibility='hidden'; window.print();"></center>
<P><CENTER><HR>
  <span class="descripcion"><FONT SIZE=2>Sector La Parroquia Av. 5 "Las Pe&ntilde;as", (detr&aacute;s del Liceo Caracciolo Parra y Olmedo) Edificio "Aguas Blancas" torre "A" 
  <br>
  M&eacute;rida, Estado M&eacute;rida.<BR>
  Tel&eacute;fonos: (0274) 271.22.33 - 271.56.34 - 271.59.83 - 271.32.22      www.decd-merida.gov.ve  e-mail: decd@decd-merida.gov.ve</span>
</CENTER></P>
</BODY>
</HTML>
