<?
echo "oCMenu.makeMenu('top0','','R.R.H.H.','','');";
        if (($rrhh['1'] == "S") || ($rrhh['2'] == "S") || ($rrhh['3'] == "S"))
          {
        echo "oCMenu.makeMenu('sub00','top0','Personal','');";
                if ($rrhh['1'] == "S")
                  {
                echo "oCMenu.makeMenu('sub000','sub00','Agregar','../modulo_ii/bdc_add_datos_personales.php');";
                  }
                if ($rrhh['2'] == "S")
                  {
                echo "oCMenu.makeMenu('sub001','sub00','Editar','../modulo_ii/bdc_edit_consulta_personal.php');";
                  }
                if ($rrhh['3'] == "S")
                  {
                echo "oCMenu.makeMenu('sub002','sub00','Consultar','');";
                        echo "oCMenu.makeMenu('sub0020','sub002','Por Cédula','../modulo_ii/bdc_consulta_personal.php');";
                        echo "oCMenu.makeMenu('sub0021','sub002','Por Nombre y Apellido','../modulo_ii/bdc_consulta_personal_nomapel.php');";
                  }
          }

        if (($rrhh['4'] == "S") || ($rrhh['5'] == "S") || ($rrhh['6'] == "S") || ($rrhh['7'] == "S") || ($rrhh['8'] == "S") || ($rrhh['9'] == "S") || ($rrhh['10'] == "S") || ($rrhh['11'] == "S") || ($rrhh['12'] == "S") || ($rrhh['13'] == "S") || ($rrhh['14'] == "S") || ($rrhh['15'] == "S"))
          {
        echo "oCMenu.makeMenu('sub01','top0','Instituciones','');";
                if ($rrhh['4'] == "S")
                  {
                echo "oCMenu.makeMenu('sub010','sub01','Agregar','../modulo_iii/bdc_add_datos_instituciones.php');";
                  }
                if ($rrhh['5'] == "S")
                  {
                echo "oCMenu.makeMenu('sub011','sub01','Editar','../modulo_iii/bdc_edit_insti_nombre.php');";
                  }
                if ($rrhh['6'] == "S")
                  {
                echo "oCMenu.makeMenu('sub012','sub01','Consultar','');";
                        echo "oCMenu.makeMenu('sub0120','sub012','Por Municipio','../modulo_iii/bdc_consulta_instituciones.php');";
                        echo "oCMenu.makeMenu('sub0121','sub012','Por Nombre','../modulo_iii/bdc_consulta_insti_nombre.php');";
                  }
                if (($rrhh['7'] == "S") || ($rrhh['8'] == "S") || ($rrhh['9'] == "S"))
                  {
                echo "oCMenu.makeMenu('sub013','sub01','Especialidades','');";
                        if ($rrhh['7'] == "S")
                          {
                        echo "oCMenu.makeMenu('sub0130','sub013','Agregar','bdc_add_rel_especialidades.php');";
                          }
                        if ($rrhh['8'] == "S")
                          {
                        echo "oCMenu.makeMenu('sub0131','sub013','Editar','bdc_admin_rel_especialidades.php');";
                          }
                        if ($rrhh['9'] == "S")
                          {
                        echo "oCMenu.makeMenu('sub0132','sub013','Consultar','bdc_consul_rel_especialidades.php');";
                          }
                  }
                if (($rrhh['10'] == "S") || ($rrhh['11'] == "S") || ($rrhh['12'] == "S"))
                  {
                echo "oCMenu.makeMenu('sub014','sub01','Grados','');";
                        if ($rrhh['10'] == "S")
                          {
                        echo "oCMenu.makeMenu('sub0140','sub014','Agregar','bdc_add_grados.php');";
                          }
                        if ($rrhh['11'] == "S")
                          {
                        echo "oCMenu.makeMenu('sub0141','sub014','Editar','bdc_admin_grados.php');";
                          }
                        if ($rrhh['12'] == "S")
                          {
                        echo "oCMenu.makeMenu('sub0142','sub014','Consultar','bdc_consulta_grados.php');";
                          }
                   }
                if (($rrhh['13'] == "S") || ($rrhh['14'] == "S") || ($rrhh['15'] == "S"))
                  {
                echo "oCMenu.makeMenu('sub015','sub01','Semestres','');";
                        if ($rrhh['13'] == "S")
                          {
                        echo "oCMenu.makeMenu('sub0150','sub015','Agregar','bdc_add_semestres.php');";
                          }
                        if ($rrhh['14'] == "S")
                          {
                        echo "oCMenu.makeMenu('sub0151','sub015','Editar','bdc_admin_semestres.php');";
                          }
                        if ($rrhh['15'] == "S")
                          {
                        echo "oCMenu.makeMenu('sub0152','sub015','Consultar','bdc_consulta_semestres.php');";
                          }
                  }
          }

        if (($rrhh['16'] == "S") || ($rrhh['17'] == "S") || ($rrhh['18'] == "S"))
          {
        echo "oCMenu.makeMenu('sub02','top0','Trámites','');";
                if ($rrhh['16'] == "S")
                  {
                echo "oCMenu.makeMenu('sub020','sub02','Agregar','../modulo_ii/bdc_add_tramite.php');";
                  }
                if ($rrhh['17'] == "S")
                  {
                echo "oCMenu.makeMenu('sub021','sub02','Editar','');";
                  }
                if ($rrhh['18'] == "S")
                  {
                echo "oCMenu.makeMenu('sub022','sub02','Consultar','');";
                  }
          }

        if (($rrhh['19'] == "S") || ($rrhh['20'] == "S") || ($rrhh['21'] == "S"))
          {
        echo "oCMenu.makeMenu('sub03','top0','Elegibles','');";
                echo "oCMenu.makeMenu('sub030','sub03','Curriculum','');";
                        if ($rrhh['19'] == "S")
                          {
                        echo "oCMenu.makeMenu('sub0300','sub030','Agregar','BDC_Add_Datos_Per_Ele');";
                          }
                        if ($rrhh['20'] == "S")
                          {
                        echo "oCMenu.makeMenu('sub0301','sub030','Editar','BDC_Edit_Consulta_Personal_Ele');";
                          }
                        if ($rrhh['21'] == "S")
                          {
                        echo "oCMenu.makeMenu('sub0302','sub030','Consultar','');";
                                echo "oCMenu.makeMenu('sub03000','sub0302','Por Cédula','BDC_Consulta_Personal_Ele');";
                                echo "oCMenu.makeMenu('sub03001','sub0302','Por Nombre y Apellido','BDC_Consulta_Per_Ele_Nombre');";
                                echo "oCMenu.makeMenu('sub03002','sub0302','Por Municipio','BDC_Consulta_Per_Ele_Mun');";
                                echo "oCMenu.makeMenu('sub03003','sub0302','Por Nivel de Instrucción','BDC_Consulta_Per_Ele_Niv');";
                          }
          }

        if (($rrhh['22'] == "S") || ($rrhh['23'] == "S") || ($rrhh['24'] == "S"))
          {
        echo "oCMenu.makeMenu('sub04','top0','Nómina','');";
                if ($rrhh['22'] == "S")
                  {
                echo "oCMenu.makeMenu('sub040','sub04','Crear','BDC_Add_Nomina');";
                  }
                if ($rrhh['23'] == "S")
                  {
                  }
                if ($rrhh['24'] == "S")
                  {
                  }
          }

        if (($rrhh['25'] == "S") || ($rrhh['26'] == "S") || ($rrhh['27'] == "S"))
          {
        echo "oCMenu.makeMenu('sub05','top0','Prestaciones Sociales','');";
                echo "oCMenu.makeMenu('sub050','sub05','Cálculos','');";
                        if ($rrhh['25'] == "S")
                          {
                        echo "oCMenu.makeMenu('sub0500','sub050','Agregar','BDC_Add_Prestaciones');";
                          }
                        if ($rrhh['26'] == "S")
                          {
                        echo "oCMenu.makeMenu('sub0501','sub050','Editar','');";
                          }
                        if ($rrhh['27'] == "S")
                          {
                        echo "oCMenu.makeMenu('sub0502','sub050','Consultar','');";

                          }
          }

        if (($rrhh['28'] == "S") || ($rrhh['29'] == "S") || ($rrhh['30'] == "S"))
          {
        echo "oCMenu.makeMenu('sub06','top0','Traslados','');";
                if ($rrhh['28'] == "S")
                  {
                  }
                if ($rrhh['29'] == "S")
                  {
                  }
                if ($rrhh['30'] == "S")
                  {
                  }
          }
		  
		 if (($rrhh['31'] == "S") || ($rrhh['32'] == "S") || ($rrhh['33'] == "S"))
          {
        echo "oCMenu.makeMenu('sub07','top0','Inasistencias','');";
                if ($rrhh['31'] == "S")
                  {
				  echo "oCMenu.makeMenu('sub070','sub07','Agregar','../modulo_ii/bdc_add_inasistencias.php');";
                  }
                if ($rrhh['32'] == "S")
                  {
				  // echo "oCMenu.makeMenu('sub071','sub07','Editar','BDC_Add_Nomina');";
				  //      echo "oCMenu.makeMenu('sub0710','sub071','Por Cédula','');";
                  //      echo "oCMenu.makeMenu('sub0711','sub071','Por Nombre y Apellido','');";
				  //  	  echo "oCMenu.makeMenu('sub0713','sub071','Por Institución','');";
                  }
                if ($rrhh['33'] == "S")
                  {
				  echo "oCMenu.makeMenu('sub072','sub07','Consultar','../modulo_ii/bdc_datos_inasistencias.php');";
				       // echo "oCMenu.makeMenu('sub0720','sub072','Por Cédula','');";
                       // echo "oCMenu.makeMenu('sub0721','sub072','Por Nombre y Apellido','');";
					   // echo "oCMenu.makeMenu('sub0723','sub072','Por Institución','');";
                  }
          }
		  
		  if (($rrhh['34'] == "S") || ($rrhh['35'] == "S") || ($rrhh['36'] == "S"))
          {
        echo "oCMenu.makeMenu('sub08','top0','Reportes','');";
                if ($rrhh['34'] == "S")
                  {
				  echo "oCMenu.makeMenu('sub080','sub08','Personal','../modulo_ii/bdc_rep_dinamico.php');";
				   echo "oCMenu.makeMenu('sub081','sub08','Comisiones de Servicio','../modulo_ii/bdc_rep_comisiones_servicio.php');";
                  }
          }
?>
