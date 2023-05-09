<?
  include ("../sesion.php");

  include ("../conex.php");
?>
<HTML>
<HEAD>
        <LINK REL="STYLESHEET" HREF="../style/normal.css" TYPE="text/css">

        <SCRIPT LANGUAGE="JavaScript" SRC="../scripts/validar.js" TYPE="text/javascript"></SCRIPT>
</HEAD>

<BR><BR>
<H2>Editar Especialidad</H2>

<FORM METHOD="POST" NAME="datos" ACTION="bdc_edit_especialidades.php">

<?
if (!isset ($pasada))
  {
   $consulta = mysql_query("SELECT desc_espec FROM bdc_especialidades WHERE codg_espec=$codg_espec");
   $especialidad = mysql_fetch_array($consulta);
   $desc_espec = $especialidad["desc_espec"];
  }
?>

<TABLE BORDER="0" CELLPADDING="0" ALIGN=CENTER>

        <TR>
        <TD WIDTH="150"><P class="mini" ALIGN="RIGHT">Nombre de la Especialidad:</P></TD>
        <TD WIDTH="200"><INPUT class="campo" TYPE="TEXT" NAME="desc_espec" MAXLENGTH="50" SIZE="20" VALUE="<? echo $desc_espec; ?>"></TD>
        </TR>

        <TR>
        <TD COLSPAN="2"><CENTER><INPUT class="mini" TYPE="SUBMIT" VALUE="Actualizar"></CENTER></TD>
        </TR>

</TABLE>

<INPUT TYPE="HIDDEN" NAME="action" VALUE="ins">
<INPUT TYPE="HIDDEN" NAME="pasada" VALUE="1">
<INPUT TYPE="HIDDEN" NAME="codg_espec" VALUE="<? echo $codg_espec; ?>">

</FORM>

<?
if ($action == "ins")
  {
          $comprobar = mysql_query("SELECT * FROM bdc_especialidades WHERE desc_espec='$desc_espec'");

          if (mysql_num_rows($comprobar) != 0)
            {
                    echo "<SCRIPT>alert('La Especialidad ya Existe');</SCRIPT>";
            }

          else
            {
                    mysql_query ("UPDATE bdc_especialidades SET desc_espec='$desc_espec' WHERE codg_espec=$codg_espec");
                    echo "<SCRIPT>alert('Registro Actualizado');</SCRIPT>";
            }
  }
?>

<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">

  var frmvalidator  = new Validator("datos");

  frmvalidator.addValidation("desc_espec","req","Ingrese el Nombre de la Especialidad");
  frmvalidator.addValidation("desc_espec","alphanum");

</SCRIPT>

</BODY>
</HTML>
