<?
echo "oCMenu.makeMenu('top2','','Académico','','');";
        if (($acad['1'] == "S") || ($acad['2'] == "S"))
          {
        echo "oCMenu.makeMenu('sub20','top2','Año Escolar','');";
                if ($acad['1'] == "S")
                  {
                echo "oCMenu.makeMenu('sub200','sub20','Agregar','BDC_Add_Anio_Escolar');";
                  }
                if ($acad['2'] == "S")
                  {
                echo "oCMenu.makeMenu('sub201','sub20','Editar','BDC_Admin_Anio_Escolar');";
                  }
          }

        if (($acad['3'] == "S") || ($acad['4'] == "S"))
          {
        echo "oCMenu.makeMenu('sub21','top2','Calendario Escolar','');";
                if ($acad['3'] == "S")
                  {
                echo "oCMenu.makeMenu('sub210','sub21','Agregar','BDC_Add_Calendario_Esc');";
                  }
                if ($acad['4'] == "S")
                  {
                echo "oCMenu.makeMenu('sub211','sub21','Editar','');";
                  }
          }

        if (($acad['5'] == "S") || ($acad['6'] == "S") || ($acad['7'] == "S") || ($acad['8'] == "S") || ($acad['9'] == "S") || ($acad['10'] == "S"))
          {
        echo "oCMenu.makeMenu('sub22','top2','Estadística','');";
                if (($acad['5'] == "S") || ($acad['6'] == "S") || ($acad['7'] == "S"))
                  {
                echo "oCMenu.makeMenu('sub220','sub22','Cuadro Mensual','');";
                        if ($acad['5'] == "S")
                          {
                        echo "oCMenu.makeMenu('sub2200','sub220','Agregar','BDC_Add_Cuadro_Mensual');";
                          }
                        if ($acad['6'] == "S")
                          {
                        echo "oCMenu.makeMenu('sub2201','sub220','Editar','BDC_Consulta_Edit_Cuadro');";
                          }
                        if ($acad['7'] == "S")
                          {
                        echo "oCMenu.makeMenu('sub2202','sub220','Consultar','BDC_Consulta_Cuadro_Mensual');";
                          }
                  }
                if (($acad['8'] == "S") || ($acad['9'] == "S") || ($acad['10'] == "S"))
                  {
                echo "oCMenu.makeMenu('sub221','sub22','Resumen Estadístico','');";
                        if ($acad['8'] == "S")
                          {
                        echo "oCMenu.makeMenu('sub2210','sub221','Agregar','BDC_Add_Resumen_Estadistico');";
                          }
                        if ($acad['9'] == "S")
                          {
                        echo "oCMenu.makeMenu('sub2211','sub221','Editar','BDC_Consulta_Edit_Resumen');";
                          }
                        if ($acad['10'] == "S")
                          {
                        echo "oCMenu.makeMenu('sub2212','sub221','Consultar','BDC_Consulta_Resumen_Est');";
                          }
                  }
          }

        if (($acad['11'] == "S") || ($acad['12'] == "S") || ($acad['13'] == "S"))
          {
        echo "oCMenu.makeMenu('sub23','top2','Bolivariana','');";
                if (($acad['11'] == "S") || ($acad['12'] == "S") || ($acad['13'] == "S"))
                  {
                echo "oCMenu.makeMenu('sub230','sub23','Evaluación','');";
                        if ($acad['11'] == "S")
                          {
                        echo "oCMenu.makeMenu('sub2300','sub230','Agregar','BDC_Add_Eval_Insti');";
                          }
                        if ($acad['12'] == "S")
                          {
                        echo "oCMenu.makeMenu('sub2301','sub230','Editar','BDC_Consulta_Eval_Insti');";
                          }
                        if ($acad['13'] == "S")
                          {
                        echo "oCMenu.makeMenu('sub2302','sub230','Consultar','BDC_Consulta_Eval_Insti');";
                          }
                  }
          }

        if (($acad['14'] == "S") || ($acad['15'] == "S") || ($acad['16'] == "S") || ($acad['17'] == "S") || ($acad['18'] == "S") || ($acad['19'] == "S"))
          {
        echo "oCMenu.makeMenu('sub24','top2','Especial','');";
                if (($acad['14'] == "S") || ($acad['15'] == "S") || ($acad['16'] == "S"))
                  {
                echo "oCMenu.makeMenu('sub240','sub24','Informe UCD Trimestral','');";
                        if ($acad['14'] == "S")
                          {
                        echo "oCMenu.makeMenu('sub2400','sub240','Agregar','../modulo_xviii/bdc_add_inf_ucd.php');";
                          }
                        if ($acad['15'] == "S")
                          {
                        echo "oCMenu.makeMenu('sub2401','sub240','Editar','../modulo_xviii/bdc_cons_edit_inf_ucd.php');";
                          }
                        if ($acad['16'] == "S")
                          {
                        echo "oCMenu.makeMenu('sub2402','sub240','Consultar','');";
                              echo "oCMenu.makeMenu('sub24020','sub2402','Por Municipio','../modulo_xviii/bdc_cons_mun_inf_ucd.php');";
                          }
                  }
                if (($acad['17'] == "S") || ($acad['18'] == "S") || ($acad['19'] == "S"))
                  {
                echo "oCMenu.makeMenu('sub241','sub24','Informe UCD Final','');";
                        if ($acad['17'] == "S")
                          {
                        echo "oCMenu.makeMenu('sub2410','sub241','Agregar','../modulo_xviii/bdc_add_inf_final_ucd.php');";
                          }
                        if ($acad['18'] == "S")
                          {
                        echo "oCMenu.makeMenu('sub2411','sub241','Editar','BDC_Consulta_Eval_Insti');";
                          }
                        if ($acad['19'] == "S")
                          {
                        echo "oCMenu.makeMenu('sub2412','sub241','Consultar','BDC_Consulta_Eval_Insti');";
                          }
                  }
				if (($acad['20'] == "S") || ($acad['21'] == "S") || ($acad['22'] == "S"))
                  {
                echo "oCMenu.makeMenu('sub242','sub24','Equipos Inter. Itinerantes','');";
                        if ($acad['20'] == "S")
                          {
                        echo "oCMenu.makeMenu('sub2421','sub242','Agregar','../modulo_xxi/bdc_add_datos_personales_eii.php');";
                          }
                        if ($acad['21'] == "S")
                          {
                        echo "oCMenu.makeMenu('sub2422','sub242','Editar','BDC_Consulta_Eval_Insti');";
                          }
                        if ($acad['22'] == "S")
                          {
                        echo "oCMenu.makeMenu('sub2423','sub242','Consultar','BDC_Consulta_Eval_Insti');";
                          }
                  }
		  }
		  
?>