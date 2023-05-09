<?  //inicio de los datos de los Tabs
	$imgsurl = "../images/tabs/";		// Directorio relatibo donde se encuentran las imagenes
	$tabs_main = "#FFFFEA";				// Color del fondo de la pagina    
	$tabs_font = "tahoma";				// tipo de letra para las tabs
	$tabs_font_size = "1px";			// tamaño de letra para las tabs
	$tabs_font_color1 = "NAVY";			// color de letra para tabs
	$tabs_font_color2 = "RED";			// color de letra para tabs activos
	$tabs_height = "25px";				// altura para las tabs
	$ntabs = 7; 						// numero de tabs
// Variables para la sección de agregar
// nombre de las tabs
	$tabs[0][0][1] = "Datos Personales";	
	$tabs[0][1][1] = "Datos Personales";	
   	$tabs[0][2][1] = "Datos Academicos";
   	$tabs[0][3][1] = "Datos Laborales";
	$tabs[0][4][1] = "Gremiales";
	$tabs[0][5][1] = "Familiares";
    $tabs[0][6][1] = "Movimientos";
	$tabs[0][7][1] = "Archivos";
// direcciones de las tabs para GET
	$tabs[0][0][2] = "bdc_edit_datos_personales.php?codg_per=".$codg_per;	
   	$tabs[0][1][2] = "bdc_edit_datos_personales.php?codg_per=".$codg_per;
   	$tabs[0][2][2] = "bdc_edit_datos_personales.php?codg_per=".$codg_per;
   	$tabs[0][3][2] = "bdc_edit_datos_personales.php?codg_per=".$codg_per;
  	$tabs[0][4][2] = "bdc_edit_datos_personales.php?codg_per=".$codg_per;
	$tabs[0][5][2] = "bdc_edit_datos_personales.php?codg_per=".$codg_per;
	$tabs[0][7][2] = "bdc_edit_datos_personales.php?codg_per=".$codg_per;

// imagenes de las tabs (24 pix altura)
	$tabs[0][0][3] = "personal.png"; 
	$tabs[0][1][3] = "personal.png"; 
	$tabs[0][2][3] = "estudios.png";
	$tabs[0][3][3] = "laborales.png";
	$tabs[0][4][3] = "gremiales.png";
	$tabs[0][5][3] = "familiares.png";
	$tabs[0][6][3] = "movimientos.png";
	$tabs[0][7][3] = "archivo.png";
// direcciones de las tabs para mostrar
	$tabs[0][0][4] = "bdc_add_datos_personales2.php";
	$tabs[0][1][4] = "bdc_edit_datos_personales2.php";
	$tabs[0][2][4] = "bdc_edit_datos_academicos.php";
	$tabs[0][3][4] = "bdc_edit_datos_laborales.php";
	$tabs[0][4][4] = "bdc_edit_datos_gremiales.php";
	$tabs[0][5][4] = "bdc_edit_datos_familiares.php";
	$tabs[0][6][4] = "bdc_edit_datos_movimientos.php";	
	$tabs[0][7][4] = "bdc_edit_archivos_digitales.php";

// Variables para la sección de Edición
// nombre de las tabs
	$tabs[1][1][1] = "Datos Personales";	
   	$tabs[1][2][1] = "Datos Academicos";
   	$tabs[1][3][1] = "Datos Laborales";
	$tabs[1][4][1] = "Gremiales";
	$tabs[1][5][1] = "Familiares";
    $tabs[1][6][1] = "Movimientos";
	$tabs[1][7][1] = "Archivos";
// direcciones de las tabs para GET
	$tabs[1][1][2] = "bdc_edit_datos_personales.php?codg_per=".$codg_per;	
   	$tabs[1][2][2] = "bdc_edit_datos_personales.php?codg_per=".$codg_per;
   	$tabs[1][3][2] = "bdc_edit_datos_personales.php?codg_per=".$codg_per;
   	$tabs[1][4][2] = "bdc_edit_datos_personales.php?codg_per=".$codg_per;
  	$tabs[1][5][2] = "bdc_edit_datos_personales.php?codg_per=".$codg_per;
	$tabs[1][6][2] = "bdc_edit_datos_personales.php?codg_per=".$codg_per;
	$tabs[1][7][2] = "bdc_edit_datos_personales.php?codg_per=".$codg_per;
// imagenes de las tabs (24 pix altura)
	$tabs[1][1][3] = "personal.png"; 
	$tabs[1][2][3] = "estudios.png";
	$tabs[1][3][3] = "laborales.png";
	$tabs[1][4][3] = "gremiales.png";
	$tabs[1][5][3] = "familiares.png";
	$tabs[1][6][3] = "movimientos.png";
	$tabs[1][7][3] = "archivo.png";
// direcciones de las tabs para mostrar
	$tabs[1][1][4] = "bdc_edit_datos_personales2.php";
	$tabs[1][2][4] = "bdc_edit_datos_academicos.php";
	$tabs[1][3][4] = "bdc_edit_datos_laborales.php";
	$tabs[1][4][4] = "bdc_edit_datos_gremiales.php";
	$tabs[1][5][4] = "bdc_edit_datos_familiares.php";
	$tabs[1][6][4] = "bdc_edit_datos_movimientos.php";	
	$tabs[1][7][4] = "bdc_edit_archivos_digitales.php";

// Variables para la sección de consultar
// nombre de las tabs
	$tabs[2][0][1] = "Datos Personales";	
	$tabs[2][1][1] = "Datos Personales";	
   	$tabs[2][2][1] = "Datos Academicos";
   	$tabs[2][3][1] = "Datos Laborales";
	$tabs[2][4][1] = "Gremiales";
	$tabs[2][5][1] = "Familiares";
    $tabs[2][6][1] = "Movimientos";
	$tabs[2][7][1] = "Archivos";
// direcciones de las tabs para GET
	$tabs[2][1][2] = "bdc_datos_personales.php?codg_per=".$codg_per;	
   	$tabs[2][2][2] = "bdc_datos_personales.php?codg_per=".$codg_per;
   	$tabs[2][3][2] = "bdc_datos_personales.php?codg_per=".$codg_per;
   	$tabs[2][4][2] = "bdc_datos_personales.php?codg_per=".$codg_per;
  	$tabs[2][5][2] = "bdc_datos_personales.php?codg_per=".$codg_per;
	$tabs[2][6][2] = "bdc_datos_personales.php?codg_per=".$codg_per;
	$tabs[2][7][2] = "bdc_datos_personales.php?codg_per=".$codg_per;
// imagenes de las tabs (24 pix altura)
	$tabs[2][1][3] = "personal.png"; 
	$tabs[2][2][3] = "estudios.png";
	$tabs[2][3][3] = "laborales.png";
	$tabs[2][4][3] = "gremiales.png";
	$tabs[2][5][3] = "familiares.png";
	$tabs[2][6][3] = "movimientos.png";
	$tabs[2][7][3] = "archivo.png";
// direcciones de las tabs para mostrar
	$tabs[2][1][4] = "bdc_datos_personales2.php";
	$tabs[2][2][4] = "bdc_datos_academicos.php";
	$tabs[2][3][4] = "bdc_datos_laborales.php";
	$tabs[2][4][4] = "bdc_datos_gremiales.php";
	$tabs[2][5][4] = "bdc_datos_familiares.php";
	$tabs[2][6][4] = "bdc_datos_movimientos.php";	
	$tabs[2][7][4] = "bdc_archivos_digitales.php";
?>
