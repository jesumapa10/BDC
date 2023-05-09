<?
echo "
oCMenu.makeMenu('top0','','Grupos','','');
        oCMenu.makeMenu('sub00','top0','Agregar','../modulo_admin/bdc_add_grupo.php');
        oCMenu.makeMenu('sub01','top0','Editar','../modulo_admin/bdc_admin_grupo.php');

oCMenu.makeMenu('top1','','Usuarios','','');
        oCMenu.makeMenu('sub10','top1','Agregar','../modulo_admin/bdc_add_user.php');
        oCMenu.makeMenu('sub11','top1','Editar','../modulo_admin/bdc_admin_user.php');
        oCMenu.makeMenu('sub12','top1','Permisos','../modulo_admin/bdc_admin_per_user.php');

oCMenu.makeMenu('top2','','Mantenimiento','','');
        oCMenu.makeMenu('sub20','top2','R.R.H.H.','');
                oCMenu.makeMenu('sub200','sub20','Instituciones','');
                        oCMenu.makeMenu('sub2000','sub200','Especialidades','');
                                oCMenu.makeMenu('sub20000','sub2000','Agregar','../modulo_admin/bdc_add_especialidades.php');
                                oCMenu.makeMenu('sub20001','sub2000','Editar','../modulo_admin/bdc_admin_especialidades.php');
                oCMenu.makeMenu('sub201','sub20','Trámites','');
                        oCMenu.makeMenu('sub2010','sub201','Pasos de Trámites','');
                                oCMenu.makeMenu('sub20010','sub2010','Agregar','../modulo_admin/bdc_add_pasos.php');
                                oCMenu.makeMenu('sub20011','sub2010','Editar','../modulo_admin/bdc_admin_pasos.php');
                        oCMenu.makeMenu('sub2011','sub201','Trámites','');
                                oCMenu.makeMenu('sub20110','sub2011','Agregar','../modulo_admin/bdc_add_tramite.php');
                                oCMenu.makeMenu('sub20111','sub2011','Editar','../modulo_admin/bdc_admin_tramite.php');
oCMenu.makeMenu('top3','','Utilidades','','');
        oCMenu.makeMenu('sub30','top3','Cambio de Contraseña','../modulo_admin/bdc_cambio_cont.php');
        oCMenu.makeMenu('sub31','top3','Respaldo Base Datos','');
            oCMenu.makeMenu('sub310','sub31','Exportar','../instalacion/exportar.php');
            oCMenu.makeMenu('sub311','sub31','Importar','../instalacion/reinstalar.php');";
?>
