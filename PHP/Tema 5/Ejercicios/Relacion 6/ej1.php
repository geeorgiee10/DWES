<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
    
    $fichero = fopen("./ejemplo1.txt","r");
    if($fichero === false){
        echo "El fichero ejemplo1 no existe";
    }
	else{
		echo "ejemplo1.txt se abrió con éxito";
	}
    echo "<br>";
	$fichero = fopen("./ejemplo2.txt","r");
	if ($fichero === false){
        echo "El fichero ejemplo2 no existe";
	}else{
		echo "ejemplo2.txt se abrió con éxito";
	} 
    ?>
</body>
</html>