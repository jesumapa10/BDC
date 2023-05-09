<?
echo "oCMenu.makeMenu('top5','','Administración','','');";
        if (($adminis['1'] == "S") || ($adminis['2'] == "S") || ($adminis['3'] == "S") || ($adminis['4'] == "S") || ($adminis['5'] == "S") || ($adminis['6'] == "S"))
          {
        echo "oCMenu.makeMenu('sub50','top5','Bienes','');";
                if ($adminis['1'] == "S")
                  {
                echo "oCMenu.makeMenu('sub500','sub50','Agregar','');";
                  if ($adminis['1'] == "S")
                  {
                echo "oCMenu.makeMenu('sub5000','sub500','Bien Indivudual','../modulo_v/bdc_add_bienes.php');";
                echo "oCMenu.makeMenu('sub5001','sub500','Bien por Lote','../modulo_v/bdc_con_resumen_ver_bienes.php');";
                  }
                  }
                if ($adminis['2'] == "S")
                  {
                echo "oCMenu.makeMenu('sub501','sub50','Editar','');";
                  if ($adminis['2'] == "S")
                  {
                echo "oCMenu.makeMenu('sub5010','sub501','Editar Bien por Código','../modulo_v/bdc_edit_consul_bienes.php');";
                echo "oCMenu.makeMenu('sub5011','sub501','Editar Bien por Unidad','../modulo_v/bdc_edit_eli_consul_bienes.php');";
                  }
                  }
               if ($adminis['3'] == "S")
                  {
                echo "oCMenu.makeMenu('sub502','sub50','Consultar','../modulo_v/bdc_consulta_bienes.php');";
                  }
               if ($adminis['4'] == "S")
                  {
                echo "oCMenu.makeMenu('sub503','sub50','Resumen','../modulo_v/bdc_con_resumen_bienes.php');";
                  }
               if ($adminis['5'] == "S")
                  {
                echo "oCMenu.makeMenu('sub504','sub50','Reportes','../modulo_v/bdc_vreporte_bienes.php');";
                  }
              if ($adminis['6'] == "S")
                  {
                echo "oCMenu.makeMenu('sub505','sub50','Correlativo','../modulo_v/bdc_correlativo.php');";
                  }

          }
          if (($adminis['7'] == "S") )
          {
           echo "oCMenu.makeMenu('sub51','top5','Nomina Alquileres','');";
                if ($adminis['7'] == "S")
                  {
                echo "oCMenu.makeMenu('sub510','sub51','Locales','');";
                  if ($adminis['7'] == "S")
                  {
                   echo "oCMenu.makeMenu('sub5100','sub510','Agregar','../modulo_xviv/bdc_add_datos_alquileres.php');";
                   echo "oCMenu.makeMenu('sub5101','sub510','Editar','../modulo_v/bdc_add_bienes.php');";
                  }
                  }
           }
?>