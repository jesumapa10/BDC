<?
  include ("../sesion.php");

  include ("../conex.php");
?>

<HTML>
<HEAD>
        <LINK REL="STYLESHEET" HREF="../style/normal.css" TYPE="text/css">
        <SCRIPT LANGUAGE="JavaScript" SRC="../scripts/validar.js" TYPE="text/javascript"></SCRIPT>
</HEAD>

<BODY>
<BR><BR>
<H2>Agregar Especialidad</H2>

        <FORM METHOD="POST" NAME="datos" ACTION="bdc_add_especialidades.php">
        <TABLE ALIGN=CENTER BORDER="0">

                <TR>
                <TD WIDTH="150"><P class="mini" ALIGN="RIGHT">Nombre de la Especialidad:</P></TD>
                <TD WIDTH="200"><INPUT class="campo" TYPE="TEXT" NAME="desc_espec" MAXLENGTH="50" SIZE="20"></TD>
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
            mysql_query("INSERT INTO bdc_especialidades VALUES (0, '$desc_espec')");

                echo '<SCRIPT>alert("Especialidad Agregada");</SCRIPT>
                      <SCRIPT>datos.action.value="";</SCRIPT>
                      <SCRIPT>        input_box=confirm("¿Desea Agregar otra Especialidad?")
                                      if (input_box==true)
                                              {
                                              location = "bdc_add_especialidades.php"
                                              }
                                       else
                                              {
                                              location = "../modulo_i/data.php"
                                              }
                      </SCRIPT>';
  }
?>


<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">

  var frmvalidator  = new Validator("datos");

  frmvalidator.addValidation("desc_espec","req","Ingrese el Nombre de la Especialidad");
  frmvalidator.addValidation("desc_espec","alphanum");

</SCRIPT>

</BODY>
</HTML>
