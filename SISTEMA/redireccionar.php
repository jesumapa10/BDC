<script language="JavaScript" type="text/javascript">
 function entrar(){
			window.open('login.php','window','toolbar=no,location=no'+'fullscreen=yes,directories=no,status=no,menubar=no,scrollbars=yes,pos=center' +
                            'winSize,resizable=yes,copyhistory=no');
							thewindow.moveTo(0,0);
     }
function sleep(milliseconds) {
  var start = new Date().getTime();
  for (var i = 0; i < 1e7; i++) {
    if ((new Date().getTime() - start) > milliseconds){
      break;
    }
  }
}
</script>

<body>
<script>
alert("La Sesión ha expirado por inactividad.\n\nSerá dirigido a la pagina de inicio.");
entrar();
</script>
</body>