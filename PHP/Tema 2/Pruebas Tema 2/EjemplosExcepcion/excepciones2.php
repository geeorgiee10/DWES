<?php
/*otro ejemplo de manejo de excepciones
 * usamos una función dividir que recibe dos argumentos y
 * lanza una excepción si el segundo es cero
 */
	function dividir($a, $b){
		if ($b==0){
			throw new Exception('El segundo argumento es 0');
		}
		return $a/$b;
	}
	try{
		$resul1 = dividir(5, 0);//aqui se produce una excepción
		echo "Resul 1 $resul1". "<br>";// el resto del bloque try no se ejecuta
	}catch(Exception $e){  // se ejecuta el catch y el finally correspondiente
		echo "Excepción: ". $e->getMessage(). "<br>";
	}finally{
		echo "Primer finally<br>";		
	}
	try{
		$resul2 = dividir(5, 2); //aqui no se produce excepción
		echo "Resul 2: $resul2". "<br>";
	}catch(Exception $e){ //catch no se ejecuta
		echo "Excepción: ". $e->getMessage(). "<br>";
	}finally{
		echo "Segundo finally";		// el bloque finally se ejecuta.
	}