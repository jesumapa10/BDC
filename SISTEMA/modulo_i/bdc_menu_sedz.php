<?
echo "oCMenu.makeMenu('top4','','Sedes Zonales','','');";
        if (($sedz['1'] == "S") || ($sedz['2'] == "S") || ($sedz['3'] == "S"))
          {
        echo "oCMenu.makeMenu('sub40','top4','Becas','');";
                if ($sedz['1'] == "S")
                  {
                echo "oCMenu.makeMenu('sub400','sub40','Agregar','BDC_Beca_Add_Datos');";
                  }
                if ($sedz['2'] == "S")
                  {
                echo "oCMenu.makeMenu('sub401','sub40','Editar','');";
                  }
                if ($sedz['3'] == "S")
                  {
                echo "oCMenu.makeMenu('sub402','sub40','Consultar','');";
                  }
          }
?>
