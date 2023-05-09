<?
echo "oCMenu.makeMenu('top3','','Utilidades','','');";
        if (($util['1'] == "S"))
          {
        echo "oCMenu.makeMenu('sub30','top3','Cambio de Contraseña','../modulo_admin/bdc_cambio_cont.php');";
          }
        if (($util['2'] == "S") || ($util['3'] == "S") || ($util['4'] == "S") || ($util['5'] == "S") || ($util['6'] == "S"))
          {
        echo "oCMenu.makeMenu('sub31','top3','Control de Acceso','','');";
                        if (($util['2'] == "S"))
                          {
                        echo "oCMenu.makeMenu('sub310','sub31','Registrar','../modulo_viii/bdc_registro_acceso.php');";
                          }
                        if (($util['3'] == "S"))
                          {
                        echo "oCMenu.makeMenu('sub311','sub31','Registrar','../modulo_viii/bdc_registro_acceso_old.php');";
                          }
                        if (($util['4'] == "S"))
                          {
                        echo "oCMenu.makeMenu('sub312','sub31','Verificar Acceso Usuario','../modulo_viii/bdc_verificar_acceso_user.php');";
                          }
                        if (($util['5'] == "S"))
                          {
                        echo "oCMenu.makeMenu('sub313','sub31','Agregar Observación','../modulo_viii/bdc_observacion_acceso.php');";
                          }
                        if (($util['6'] == "S"))
                          {
                        echo "oCMenu.makeMenu('sub314','sub31','Verificar Acceso Grupo','../modulo_viii/bdc_verificar_acceso.php');";
                          }

          }
        if (($util['7'] == "S") || ($util['8'] == "S") || ($util['9'] == "S") || ($util['10'] == "S") || ($util['11'] == "S"))
          {
        echo "oCMenu.makeMenu('sub32','top3','Agenda Telefonica','','');";
                        if (($util['7'] == "S"))
                          {
                        echo "oCMenu.makeMenu('sub320','sub32','Agregar','../modulo_xxii/bdc_agenda_add.php');";
                          }
                        if (($util['8'] == "S"))
                          {
                        echo "oCMenu.makeMenu('sub321','sub32','Editar','../modulo_xxii/bdc_registro_acceso_old.php');";
                          }
                        if (($util['9'] == "S"))
                          {
                        echo "oCMenu.makeMenu('sub322','sub32','Consultar','../modulo_xxii/bdc_agenda_consulta.php');";
                          }
                        if (($util['10'] == "S"))
                          {
                        echo "oCMenu.makeMenu('sub323','sub32','Reporte','../modulo_xxii/bdc_observacion_acceso.php');";
                          }
                        if (($util['11'] == "S"))
                          {
                        echo "oCMenu.makeMenu('sub324','sub32','Consultar Jefes','../modulo_xxii/bdc_verificar_acceso.php');";
                          }

          }
?>