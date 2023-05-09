<?
  include ("../sesion.php");

  include ("../conex.php");
?>
<HTML>
<HEAD>
        <LINK REL="STYLESHEET" HREF="../style/normal.css" TYPE="text/css">

<?
  include ("tabs/tabs_insti_add_e.php");
?>

<SCRIPT>
function adddir()

{
         window.open("bdc_mini_add_dir.php?codg_insti_desde=<? echo $codg_insti; ?>","_blank","scrollbars=no,status=no,toolbar=no,directories=no,menubar=no,resizable=no,width=600,height=250")
}

function addcoor()

{
         window.open("bdc_mini_add_coor.php?codg_insti_desde=<? echo $codg_insti; ?>","_blank","scrollbars=no,status=no,toolbar=no,directories=no,menubar=no,resizable=no,width=600,height=250")
}

function finalizar()
{
input_box=confirm("¿Está seguro que desea Finalizar?");
if (input_box==true)

        {
        location = "../modulo_i/bdc_data.php";
        }

}

function actualizar()
{
        datos.submit();
}

</SCRIPT>

</HEAD>

<?
  $consulta = mysql_query("SELECT i.nomb_insti, i.codg_tip_insti, t.desc_tip_insti
                          FROM bdc_instituciones i, bdc_tip_insti t
                          WHERE i.codg_insti=$codg_insti and i.codg_tip_insti=t.codg_tip_insti");

  $datos = mysql_fetch_array($consulta);

            $nomb_insti = $datos["nomb_insti"];
            $codg_tip_insti = $datos["codg_tip_insti"];
            $tipo = $datos["desc_tip_insti"];

  $datos_municipio = mysql_query("SELECT e.nomb_mun
                                  FROM bdc_instituciones p, bdc_municipios e
                                  WHERE p.codg_insti=$codg_insti and p.codg_pais=e.codg_pais and p.codg_est=e.codg_est and p.codg_mun=e.codg_mun");

  $cons_municipio = mysql_fetch_array($datos_municipio);

            $municipio = $cons_municipio["nomb_mun"];
?>

<BR><BR>
<H2>Ficha de la Instituci&oacute;n</H2>

<TABLE ALIGN="CENTER">
<TR>
<TD>
<P ALIGN="CENTER" class="mini">Instituci&oacute;n:</P>
</TD>

<TD>
<P ALIGN="CENTER" class="campo"><? echo $nomb_insti; ?>&nbsp;&nbsp;&nbsp;&nbsp;</P>
</TD>
<?
if ($municipio != "")
  {
    echo '<TD>';
    echo '<P ALIGN="CENTER" class="mini">Municipio:</P>';
    echo '</TD>';

    echo '<TD>';
    echo '<P ALIGN="CENTER" class="campo">'.$municipio.'&nbsp;&nbsp;&nbsp;&nbsp;</P>';
    echo '</TD>';
  }
?>
<TD>
<P ALIGN="CENTER" class="mini">Tipo de Instituci&oacute;n:</P>
</TD>

<TD>
<P ALIGN="CENTER" class="campo"><? echo $tipo; ?></P>
</TD>
</TR>
</TABLE>

<BR>

<SCRIPT>do_tabs("Estructura Organizativa", "")</SCRIPT>

<BR>
<FORM METHOD="POST" NAME="datos" action="bdc_add_estructura.php">

        <TABLE BORDER="0" ALIGN="CENTER">
                <TR>
                <TD WIDTH="550">
                <DIV ALIGN="CENTER"><P class="cabecera">Estructura Organizativa</P></DIV>
                </TD>
                </TR>
        </TABLE>

<BR>

<CENTER><INPUT class="mini" TYPE="BUTTON" VALUE="Actualizar" onclick="actualizar()">&nbsp;<INPUT class="mini" TYPE="BUTTON" VALUE="Agregar Dirección" onclick="adddir()">&nbsp;<INPUT class="mini" TYPE="BUTTON" VALUE="Agregar Coordinación" onclick="addcoor()">&nbsp;<INPUT class="mini" TYPE="BUTTON" VALUE="Finalizar" onclick="finalizar()"></CENTER>

<INPUT TYPE="HIDDEN" NAME="codg_insti" VALUE="<? echo $codg_insti; ?>">

</FORM>

</HTML>
