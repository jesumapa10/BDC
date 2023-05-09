<?php
# función creada por luis marquez para convertir numeros a letras desde 0 hasta 999999
function unidad($numero){
    switch ($numero)
	{
		case 9: { $num = "nueve"; break; }
		case 8: { $num = "ocho"; break; }
		case 7: { $num = "siete"; break; }
		case 6: { $num = "seis"; break; }
		case 5: { $num = "cinco"; break; }
		case 4: { $num = "cuatro"; break; }
		case 3: { $num = "tres"; break; }
		case 2: { $num = "dos"; break; }
		case 1: { $num = "un"; break; }
		case 0: { $num = "cero"; break; }
	}
	return $num;
}

function decena($numero){
    if ($numero >= 90 && $numero <= 99){
        if ($numero == 90) return "noventa";
        else return "noventa y ".unidad($numero - 90);
    }
    if ($numero >= 80 && $numero <= 89){
        if ($numero == 80) return "ochenta";
        else return "ochenta y ".unidad($numero - 80);
    }
    if ($numero >= 70 && $numero <= 79){
        if ($numero == 70) return "setenta";
        else return "setenta y ".unidad($numero - 70);
    }
    if ($numero >= 60 && $numero <= 69){
        if ($numero == 60) return "sesenta";
        else return "sesenta y ".unidad($numero - 60);
    }
    if ($numero >= 50 && $numero <= 59){
        if ($numero == 50) return "cincuenta";
        else return "cincuenta y ".unidad($numero - 50);
    }
    if ($numero >= 40 && $numero <= 49){
        if ($numero == 40) return "cuarenta";
        else return "cuarenta y ".unidad($numero - 40);
    }
    if ($numero >= 30 && $numero <= 39){
        if ($numero == 30) return "treinta";
        else return "treinta y ".unidad($numero - 30);
    }
    if ($numero >= 20 && $numero <= 29){
        if ($numero == 20) return "veinte";
        else return "veinti".unidad($numero - 20);
    }
    if ($numero >= 10 && $numero <= 19)
    {
        if ($numero == 10) return "diez";
        else if ($numero == 11)	return "once";
        else if ($numero == 12) return "doce";
        else if ($numero == 13) return "trece";
        else if ($numero == 14) return "catorce";
        else if ($numero == 15) return "quince";
        else if ($numero == 16) return "dieciseis";
        else if ($numero == 17) return "diecisiete";
        else if ($numero == 18) return "dieciocho";
        else if ($numero == 19) return "diecinueve";
    }
    if ($numero >= 1 && $numero <= 9) { return unidad($numero);}
}

function centena($numero){
    if ($numero >= 900 & $numero <= 999){ $letras = "novecientos";
		if ($numero > 900) $letras .= ' '.decena($numero - 900);
    }
    if ($numero >= 800 & $numero <= 899){ $letras = "ochocientos";
		if ($numero > 800) $letras .= ' '.decena($numero - 800);
    }
    if ($numero >= 700 & $numero <= 799){ $letras = "setecientos";
		if ($numero > 700) $letras .= ' '.decena($numero - 700);
    }
    if ($numero >= 600 & $numero <= 699){ $letras = "seiscientos";
		if ($numero > 600) $letras .= ' '.decena($numero - 600);
    }
    if ($numero >= 500 & $numero <= 599){ $letras = "quinientos";
		if ($numero > 500) $letras .= ' '.decena($numero - 500);
    }
    if ($numero >= 400 & $numero <= 499){ $letras = "cuatrocientos";
		if ($numero > 400) $letras .= ' '.decena($numero - 400);
    }
    if ($numero >= 300 & $numero <= 399){ $letras = "trescientos";
		if ($numero > 300) $letras .= ' '.decena($numero - 300);
    }
    if ($numero >= 200 & $numero <= 299){ $letras = "doscientos";
		if ($numero > 200) $letras .= ' '.decena($numero - 200);
    }
    if ($numero >= 100 & $numero <= 199){ $letras = "cien";
		if ($numero > 100) $letras .= 'to '.decena($numero - 100);
    }
    if ($numero >= 1 & $numero <= 99){
		$letras = decena($numero);
    }
    return $letras;
}
function mil($numero){
    $car=0;
    $parte = "";
    if ($numero >= 1000 && $numero <= 9999) $car=1;
    if ($numero >= 10000 && $numero <= 99999) $car=2;
    if ($numero >= 100000 && $numero <= 999999) $car=3;
    $parte = substr($numero, 0, $car);
    $primera_parte = $parte.'000';
    if ($parte>1) $letras = centena($parte);
    $letras .= ' mil '.centena($numero - $primera_parte);
    return $letras;
}

function numero_enletras($numero){
    $numero_convertir = $numero;

    if ($numero_convertir > 999999) { echo 'Número por arriba del permitido. Por favor intente con un número <= 999999.99'; exit; }
    if ($numero_convertir >= 1000 && $numero_convertir <= 999999){ 
        $letras = mil($numero_convertir);
    }

    if ($numero_convertir >= 100 && $numero_convertir <= 999){ 
        $letras = centena($numero_convertir);
    }

    if ($numero_convertir >= 10 && $numero_convertir <= 99){ 
        $letras = decena($numero_convertir);
    }

    if ($numero_convertir >= 0 && $numero_convertir <= 9){
        $letras = unidad($numero_convertir);
    }

    return $letras;
}
function convertir_a_letras($numero){
    $numero = number_format($numero, 2, ".", "");
    $moneda = 'Bolívar';
    $decimal = 'céntimo';
    $datos = explode(".",$numero);
    $parte_1 = numero_enletras($datos[0]);
    if ($datos[1]>0){ $parte_2 = numero_enletras($datos[1]); }
    else { $parte_2 = 'cero'; $decimal .= 's'; }
    if ($datos[1]>1) { $decimal .= 's'; }
    if ($datos[0]>1) { $moneda.='es'; }
    $letras = $parte_1.' '.$moneda.' con '.$parte_2.' '.$decimal;
    return $letras;

}
#echo convertir_a_letras(50000);
#for ($i=999998;$i<=999999;$i++){ $i2=$i; echo $i2.' = '.numero_enletras($i2).'<br>'; } 
?>
