<html>

<body >

<div class="menu" align="center">
	<h1>combinacion</h1>
	<div align="center">
<?php 
//defino las vaariables del numero de acertantres fuera de las funciones para que pueda usarlas en mas de una.
	$acertantes6=0;
	$acertantes5c=0;
	$acertantes5=0;
	$acertantes4=0;
	$acertantes3=0;
	$acertantes2=0;
	$acertantes1=0;
	$acertantes0=0;
	$acertantesR=0;


//funcion errores
function errores ($error_level,$error_message)
{
  echo "<b> TRANQUILO!! Codigo error: </b> $error_level  - <b> Mensaje: $error_message </b><br>";

}
//function
//genera 6 numeros aleatorios y los mete en un array. no se repiten los numeros
//retorna el array
function generarConbinacion(){
$cont=0;
$arrayconbinacion[0]="";
	while($cont<6){
		$numero=rand(1,49);
		if(!in_array($numero, $arrayconbinacion)){//si no existe en el array donde se esta guardando se guarda
		$arrayconbinacion[$cont]=$numero;	
		$cont++;
	}
	}
	
	return $arrayconbinacion;
}
//function
//genera un numero aleatorio entre 1 y 49. El complemento.
//retorna ese numero
function generarComplemento(){
	return rand(1,49);
}
//function
//genera un numero aleatorio entre 1 y 9. El reintegro.
//retorna ese numero
function generarReintegro(){
	return rand(1,9);
}
//funtcion
//pide una linea del txt , la trocea por el separador correspondiente y la guarda en un array.
//retorna el array
function trocearLinea($linea){

	$arraylinea=explode("-",$linea);

		//var_dump($arraylinea);

		return $arraylinea;
}
//function
//Se le pasa un array que correspondra con la linea del txt y separara la combinacion de el resto de datos guardandolos en otro array.
//retorna el array con la combinacion.
function sacarCombinacion($array){
	$arrayCombinacionApostador[0]="";
	$cont=0;
	for ($i=1; $i < count($array)-2 ; $i++) { //empiezo por 1 para que deje el primer valor hasta el total - 2 para que no coja los 																		dos ultimos
		$arrayCombinacionApostador[$cont]=$array[$i];
		$cont++;
	}
	return $arrayCombinacionApostador;

}
//function
//Se le pasa un array que correspondra con la linea del txt y separara el complemento de el resto de datos .
//retorna el complemento.
function sacarComplemento($array){
	 $complementoApostador=$array[7];//coje el de la posicion donde se encuentra el complemento
	return $complementoApostador;
}

//function
//Se le pasa un array que correspondra con la linea del txt y separara el reintegro de el resto de datos .
//retorna el complemento.
function sacarReintegro($array){
	 $reintegroApostador=$array[8];//coje el de la posicion donde se encuentra el reintegro
	return $reintegroApostador;
}
//function
//suma valores a las variables de los acertantes dependiendo del cont, si el cont = 5 comprobara tambien el complemento.
//no retorna nada.
function añadirAcertantes($cont,$complementog,$complementoa){

	global $acertantes6,$acertantes5c,$acertantes5,$acertantes4,$acertantes3,$acertantes2,$acertantes1,$acertantes0,$acertantesR;
		//dependiendo del valor del cont entra en uno o en otro
	if ($cont==0){
		$acertantes0=$acertantes0+1;
	}
	else if($cont==1){
		 $acertantes1=$acertantes1+1;
	}
	else if($cont==2){
		 $acertantes2=$acertantes2+1;
	}
	else if($cont==3){
		 $acertantes3=$acertantes3+1;
	}
	else if($cont==4){
		 $acertantes4=$acertantes4+1;
	}
	else if($cont==5){
		if($complementog==$complementoa){
			 $acertantes5c= $acertantes5c+1;
		}
		else{
			 $acertantes5=$acertantes5+1;
		}
	}
	else if($cont==6){
		 $acertantes6=$acertantes6+1;
	}
}
//function
//llama a las funciones para Generar la combinacion ganadora, y la comprueba el el txt a los ganadores.
//muestra por pantalla todos los datos.
function comprobarCombinacion($path){

	global $acertantes6,$acertantes5c,$acertantes5,$acertantes4,$acertantes3,$acertantes2,$acertantes1,$acertantes0,$acertantesR;

	$arrayCombinacionaux=generarConbinacion();//genero la combinacion,la imprimo a traves de las imagenes dadas
	echo "<div align='center'>";
	echo "<b>Combinacion ganadora</b>";
	echo "<br>";
		foreach ($arrayCombinacionaux as $key => $value) {
			echo "<img src='bolasprimitiva/$value.png'  align='center'>";
		}
		echo "<br>";
	$complemento=generarComplemento();//genero complemento
			echo "<b>Complemento</b>"."<br>";
			echo "<img src='bolasprimitiva/$complemento.png'  align='center'>";
			echo "<br>";
	$reintegro=generarReintegro();//genero reintegro
			echo " <b>Reintegro</b>"."<br>";
			echo "<img src='bolasprimitiva/$reintegro.png'  align='center'>";
			echo "</div>";
		//var_dump($arrayCombinacion);
		//echo $reintegro;
		//echo '<br>';
		//echo $complemento;

	sort($arrayCombinacionaux);//ordeno la combinacion generada

	$text=file($path);//leo el txt y lo transformo a file para recorrerlo
	$contapuestas=0;//cont de el numero de apuestas.
		foreach ($text as $key => $value) {
			$cont=0;//cont de aciertos por linea
			$arrayLineaaux=trocearLinea($value);//genero el array con los numeros de la linea
				$arrayCombinacionCliente=sacarCombinacion($arrayLineaaux);//a traves del array saco la combinacion de la apuesta.
				$complementoCliente=sacarComplemento($arrayLineaaux);//a traves del array saco el complemento de la apuesta
				$reintegroCliente=sacarReintegro($arrayLineaaux);//a traves del array saco el Reintegro de la apuesta

				sort($arrayCombinacionCliente);//ordeno la combinacion de la apuesta

			  // var_dump($arrayCombinacionCliente);
			  // echo $complementoCliente;
			  // echo $reintegroCliente;


				
				for ($i=0; $i < count($arrayCombinacionCliente) ; $i++) { //recorro uno de los dos array de la combinacion
					if((int)$arrayCombinacionCliente[$i]==(int)$arrayCombinacionaux[$i]){//como estan ordenados comparo la misma 
						$cont++;															//posicion y si son iguales	la cuento
						//echo $cont." ";
						//echo "<br>";
						//echo $acertantes0."---";
					}
				}
				añadirAcertantes($cont,$complemento,$complementoCliente);//mando a la funcion para que añada al numero de acertantes

				if($reintegroCliente==$reintegro){//si el reintegro generado es igual al de la apuesta 
					 $acertantesR++;			//sumo uno a acertantes del reintegro
				}
				$cont=0;
				$contapuestas++;//sumo 1 a la apuesta realizada
		}

		//Imprimo todo para verlo
		echo"<div align='center'>";
		echo "<br><br>";
		echo "<ul>";
			echo "<li><b>Apuestas realizadas</b> = ".($contapuestas-1)."</li>"; //elimino la primera linea que son los titulos .no cuenta
		echo "</ul>";
		echo "<br><br>";
		echo "<ul>";
	echo "<li><b>Apostadores que han acertado los 6 numeros</b> = ".$acertantes6."</li>";
	echo "<li><b>Apostadores que han acertado los 5 numeros y Complemento</b> = ".$acertantes5c."</li>";
	echo "<li><b>Apostadores que han acertado los 5 numeros Sin Complemento</b> = ".$acertantes5."</li>";
	echo "<li><b>Apostadores que han acertado los 4 numeros</b> = ". $acertantes4."</li>";
	echo "<li><b>Apostadores que han acertado los 3 numeros</b> = ".$acertantes3."</li>";
	echo "<li><b>Apostadores que han acertado los 2 numeros</b> = ". $acertantes2."</li>";
	echo "<li><b>Apostadores que han acertado los 1 numeros</b> = ".$acertantes1."</li>";
	echo "<li><b>Apostadores que han acertado los 0 numeros</b> = ".$acertantes0."</li>";
	echo "<li><b>Apostadores que han acertado el reintegro </b>= ". $acertantesR."</li>";
		echo "</ul>";
		echo "</div>";


}

?>
</div>
</div>

</body>
</html> 