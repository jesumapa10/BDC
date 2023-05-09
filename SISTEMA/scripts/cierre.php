<?php
include ('../scripts/timeout.php');
echo '
<script language="JavaScript"> 
function mueveReloj(){ 
tiempo = document.form_reloj.reloj.value;
tiempo = eval(tiempo);
tiempo = tiempo - 1;
if (tiempo < 1) { alert("El sistema se cerrará por inactividad.\n\nHan transcurrido '.($timeout/60).' minutos sin actividad."); 
top.location = "../logout.php"; }
document.form_reloj.reloj.value = tiempo;
setTimeout("mueveReloj()",1000)
} 
</script> 
<form name="form_reloj"> 
<input border=0 type="hidden" name="reloj" size="10" class="reloj" value="'.$timeout.'"></form>  '; 
echo '<SCRIPT>mueveReloj();</SCRIPT>'; 
?>
