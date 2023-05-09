<?
  include ("../sesion.php");

  include ("../conex.php");
?>

<HTML>
<HEAD>

<LINK REL="STYLESHEET" HREF="../style/normal.css" TYPE="text/css">

<SCRIPT LANGUAGE="JavaScript" SRC="/bdc/scripts/validar.js" TYPE="text/javascript"></SCRIPT>
<?
  include ("tabs/tabs_insti_add_e.php");
?>
</HEAD>

<?
if ($pasada!=1)
 {
                                          
                                          
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

 }

?>


<BR><BR>
<H2>Ficha de la Instituci&oacute;n</H2>

<TABLE ALIGN="CENTER">
<TR>
<TD>
<P ALIGN="CENTER" class="mini">Instituci&oacute;n:</P>
</TD>

<TD>
<P ALIGN="CENTER" class="campo"><? echo $nomb_insti; ?>&nbsp;&nbsp;&nbsp;&nbsp;</P>
</TD>

<TD>
<P ALIGN="CENTER" class="mini">Municipio:</P>
</TD>

<TD>
<P ALIGN="CENTER" class="campo"><? echo $nomb_mun; ?>&nbsp;&nbsp;&nbsp;&nbsp;</P>
</TD>

<TD>
<P ALIGN="CENTER" class="mini">Tipo de Instituci&oacute;n:</P>
</TD>

<TD>
<P ALIGN="CENTER" class="campo"><? echo $desc_tip_insti; ?></P>
</TD>
</TR>
</TABLE>

<BR>


<SCRIPT>do_tabs("Personal de la Institución", "")</SCRIPT>

<BR>

		<TABLE BORDER="0" ALIGN="CENTER">
		<TR>
		<TD WIDTH="750"><DIV ALIGN="CENTER"><P class="cabecera">Personal Docente</P></DIV></TD>
		</TR>
		</TABLE>

		<TABLE BORDER="0" ALIGN="CENTER">
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
			echo'<TD><p class="descripcion" align=center><A HREF="../modulo_ii/bdc_datos_personales.php?codg_per='.$datos["codg_per"];echo'&id_tab=1">Ver Ficha</A></TD>';
	         }
			  echo '<TR>
                     <TD COLSPAN="4"><HR WIDTH="90%"></TD>
                     </TR>

                     <TR>
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


		<TABLE BORDER="0" ALIGN="CENTER">
		<TR>
		<TD WIDTH="820"><DIV ALIGN="CENTER"><P class="cabecera">Personal Administrativo y Obrero</P></DIV></TD>
		</TR>
		</TABLE>

		<TABLE BORDER="0" ALIGN="CENTER">
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
		echo'<TD><p class="descripcion" align=center><A HREF="../modulo_ii/bdc_datos_personales.php?codg_per='.$datos["codg_per"];echo'&id_tab=1';echo'">Ver Ficha</A></TD>';
	         }
			  echo '<TR>
                     <TD COLSPAN="4"><HR WIDTH="90%"></TD>
                     </TR>

                     <TR>
                     <TD COLSPAN="4"><P class="mini" ALIGN="CENTER">Se han encontrado '.mysql_num_rows($administrativo).' registro(s)</P></TD>
                     </TR>

                   </TABLE> ';
            }
           else
           {
            echo'    <CENTER><P><B class="rojo">Error:</B> No existen Registros</CENTER>';
           }
		 	 
		
  		?>


</HTML>