<script language="JavaScript" type="text/javascript">

	function solo_numeros(numericos, e, dec){
		var key;
		var keychar;
		if (window.event)
			key = window.event.keyCode;
		else if (e)
			key = e.which;
		else
			return true;
		keychar = String.fromCharCode(key);
		if  ((key==null)   ||  (key==9)  || (key==27))		
			return false;
			
		else if (((("0123456789").indexOf(keychar) > -1)) || (key==13) ||  (key==8) ||  (key==0))
			return true;
		else if (dec && (keychar == ",")){
			numericos.form[0].focus();
			return false;
		}
		else{
			alert('Solo puede Introducir Numeros en este Campo');
		return false;
		}
	}
	

	function numberdouble(numericos, e, dec){
		var key;
		var keychar;
		if (window.event)
			key = window.event.keyCode;
		else if (e)
			key = e.which;
		else
			return true;
		keychar = String.fromCharCode(key);
		if  ((key==null)   ||  (key==9)  || (key==27))		
			return false;
			
		else if (((("0123456789").indexOf(keychar) > -1)) || (key==13) ||  (key==8) ||  (key==0) ||  (key==46))
			return true;
		else if (dec && (keychar == ",")){
			numericos.form[0].focus();
			return false;
		}
		else{
			alert('Solo puede Introducir Numeros');
		return false;
		}
	}
	

		 function no_teclado(numericos, e, dec){
				var key;
				var keychar;
				if (window.event)
				key = window.event.keyCode;
				else if (e)
					key = e.which;
				else
					return true;
				keychar = String.fromCharCode(key);
				if  ((key==null)   ||  (key==9)  || (key==27))		
					return false;
				
				else if ((key==13) ||  (key==0))
					return true;
				
				else if (dec && (keychar == ",")){
					numericos.form[0].focus();
					return false;
				}else{	alert('No puede cambiar este campo usando el teclado!');
				return false;
				}
		  }
</script>