<?
  include ("../sesion.php");

  include ("../conex.php");

  $consulta_usuario = mysql_query("SELECT nomb_usr, apel_usr FROM bdc_usuarios WHERE login_usr='".$_SESSION['usuario_login']."'");
  $datos_usuario = mysql_fetch_array($consulta_usuario);

  $consulta_grupo = mysql_query("SELECT nomb_grp FROM bdc_grupos WHERE codg_grp='".$_SESSION['usuario_grupo']."'");
  $datos_grupo = mysql_fetch_array($consulta_grupo);
?>

<HTML>

<HEAD>
<LINK REL="STYLESHEET" HREF="../style/normal.css" TYPE="text/css">
</HEAD>

<BODY LEFTMARGING="0" TOPMARGIN="0" MARGINWIDTH="0" MARGINHEIGHT="0">
<TABLE BORDER="0" ALIGN="CENTER">
<TR>
<TD>
<P class="mini">Bienvenido(a):&nbsp;</P>
</TD>

<TD>
<P class="campo"><? echo $datos_usuario['nomb_usr'] ?>&nbsp;<? echo $datos_usuario['apel_usr'] ?></P>
</TD>

<TD>
<P class="mini">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Miembro del Grupo:&nbsp;</P>
</TD>

<TD>
<P class="campo"><? echo $datos_grupo['nomb_grp'] ?></P>
</TD>
</TR>
</TABLE>

</BODY>
</HTML>