<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
    
	$fichero = fopen("ejemplo1.txt", "r");
	if ($fichero === false){
		echo "El fichero no existe";
	}else{
		while(!feof($fichero) ){
			$caracter = fgetc($fichero);			
			echo $caracter;
		}
	}
	fclose($fichero); 
    
    ?>
</body>
</html>