<?
  include ("../sesion.php");
?>

<HTML>
<HEAD>
        <LINK REL="STYLESHEET" HREF="../style/normal.css" TYPE="text/css">
        <SCRIPT LANGUAGE="JavaScript" SRC="../scripts/validar.js" TYPE="text/javascript"></SCRIPT>
</HEAD>

<BODY>
<BR><BR>
<H2>Agregar Grupo de Trabajo</H2>

        <FORM METHOD="POST" NAME="datos" ACTION="bdc_add_grupo.php">
        <TABLE ALIGN=CENTER BORDER="0">

                <TR>
                <TD><P class="mini" ALIGN="RIGHT">C&oacute;digo del Grupo:</TD>
                <TD><INPUT class="campo" TYPE=TEXT NAME=codg_grp SIZE="1" MAXLENGTH="2" VALUE="<? echo $codg_grp ?>"></TD>
                </TR>

                <TR>
                <TD WIDTH="150"><P class="mini" ALIGN="RIGHT">Nombre del Grupo:</P></TD>
                <TD WIDTH="200"><INPUT class="campo" TYPE=TEXT NAME=nomb_grp MAXLENGTH="20" SIZE="20" VALUE="<? echo $nomb_grp ?>"></TD>
                </TR>

                <TR>
                <TD COLSPAN="2"><CENTER><INPUT class="mini" TYPE="SUBMIT" VALUE="Agregar"></CENTER></TD>
                </TR>

        </TABLE>

        <INPUT TYPE=hidden NAME="action" VALUE="ins">

        </FORM>

<?
if ($action == "ins")
{
  include ("../conex.php");

  $consulta_1 = mysql_query("SELECT * FROM bdc_grupos WHERE codg_grp=$codg_grp");
  $consulta_2 = mysql_query("SELECT * FROM bdc_grupos WHERE nomb_grp='$nomb_grp'");

        if (mysql_num_rows($consulta_1) != 0)
        {
                echo "<SCRIPT>alert('El Código del Grupo ya fue Ingresado');</SCRIPT>";
        }

        else if (mysql_num_rows($consulta_2) != 0)
        {
                echo "<SCRIPT>alert('El Nombre del Grupo ya fue Ingresado');</SCRIPT>";
        }

        else

        {
                mysql_db_query("bdc", "INSERT INTO bdc_grupos VALUES ($codg_grp,'$nomb_grp')");

                echo '<SCRIPT>alert("Grupo Agregado");</SCRIPT>

                      <SCRIPT>datos.action.value="";</SCRIPT>
                      <SCRIPT>        input_box=confirm("¿Desea Agregar otro Grupo?")
                                      if (input_box==true)
                                              {
                                              location = "bdc_add_grupo.php"
                                              }
                                       else
                                              {
                                              location = "../modulo_i/bdc_data.php"
                                              }
                      </SCRIPT>';
        }
}
?>

<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">

  var frmvalidator  = new Validator("datos");

  frmvalidator.addValidation("codg_grp","req","Ingrese el Código del Grupo");
  frmvalidator.addValidation("codg_grp","num");

  frmvalidator.addValidation("nomb_grp","req","Ingrese el Nombre del Grupo");
  frmvalidator.addValidation("nomb_grp","alphanum");

</SCRIPT>

</BODY>
</HTML>