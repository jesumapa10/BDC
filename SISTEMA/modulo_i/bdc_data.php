<?
include ("../sesion.php");

include ("../conex.php");
?>

<HTML>

<HEAD>
<LINK REL="STYLESHEET" HREF="../style/normal.css" TYPE="text/css">
</HEAD>

<BODY LEFTMARGING="0" TOPMARGIN="0" MARGINWIDTH="0" MARGINHEIGHT="0">

<div align="center">
  <p><BR>
    </p>
  <p>&nbsp;</p>
  <p><img src="../images/logo_bdc.png" title="Logo BDC" width="496" height="178"></p>
  <p>&nbsp;<?php include ('../scripts/cierre.php'); ?>  </p>
</div>
<TABLE ALIGN="CENTER" BORDER="0">
        <TR>
        <TD><P class="mini">&Uacute;ltimo Acceso:</TD>
        <TD>
        <P CLASS="campo"><? echo substr($_SESSION['usuario_acceso'],8,2); ?>/<? echo substr ($_SESSION['usuario_acceso'],5,2); ?>/<? echo substr($_SESSION['usuario_acceso'],0,4); ?>&nbsp;a&nbsp;las&nbsp;<? echo substr($_SESSION['usuario_acceso'],11,8); ?></P>
        </TD>
        </TR>
</TABLE>

<p align="center">&nbsp;</p>
</BODY>

</HTML>
