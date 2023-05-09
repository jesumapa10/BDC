<?
require("verifica.php");
$nivel_acceso=10;

    if ($nivel_acceso <= $_SESSION['usuario_nivel']){
header ("Location: $redir?error_login=5");
exit;
}
?>

<HTML>

<HEAD>
        <TITLE>Intranet - Direcci&oacute;n de Educaci&oacute;n, Cultura y Deportes del Estado M&eacute;rida</title>
</HEAD>

<!-- frames -->
<FRAMESET ROWS="25,25,*" FRAMESPACING="0" FRAMEDORDER="0" BORDER="0">
    <FRAME SRC="modulo_i/bdc_titulo.php" NAME="TITULO" ID="TITULO" FRAMEBORDER="0" SCROLLING="NO" NORESIZE MARGINWIDTH="0" MARGINHEIGHT="0">
    <FRAME SRC="modulo_i/bdc_menu.php" NAME="MENU" ID="MENU" FRAMEBORDER="0" SCROLLING="NO" NORESIZE MARGINWIDTH="0" MARGINHEIGHT="0">
    <FRAME SRC="modulo_i/bdc_data.php" NAME="DATA" ID="DATA" FRAMEBORDER="0" SCROLLING="AUTO" NORESIZE MARGINWIDTH="0" MARGINHEIGHT="0">
</FRAMESET>

</HTML>