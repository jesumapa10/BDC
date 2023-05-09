<script language="javascript">
function validaciondecampo(tipo)
{
	if (key == 13) 	{ window.event.keyCode=0; }
	document.form1.swith.value="2";
    document.form1.Submit.value="Verificar";
	if (tipo == 0)
	{
		var key=window.event.keyCode;
		if (key < 48 || key > 57)
		{
			window.event.keyCode=0;
		}
	}
	if (tipo == 1)
	{
		var key=window.event.keyCode;
		if (key > 47 && key < 58)
		{
			window.event.keyCode=0;
		}
	}
}
</script>