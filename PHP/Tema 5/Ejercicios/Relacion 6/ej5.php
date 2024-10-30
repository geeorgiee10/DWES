<?php
$filename = "ejemplo1.txt";
$file2 = fopen($filename, "r");

if ($file2 === false){
	echo "El fichero no existe";
}
else{
	while(!feof($file2) ){
		$caracter = fgets($file2);			
		echo $caracter;
	}
}
fclose($file2); 
    
$file = fopen($filename, "a");

echo "<br>";
if ($file) {
    fwrite($file, "Línea 1\n");
    fwrite($file, "Línea 2\n");
    fwrite($file, "Línea 3\n");
    fclose($file);
    echo "Archivo creado y escrito.";
} else {
    echo "Error al crear el archivo.";
}
echo "<br>";
$file = fopen($filename, "r");

if ($file) {
    echo "Contenido del archivo:";
    while (($line = fgets($file)) !== false) {
        echo $line;
    }
    fclose($file);
} else {
    echo "Error al leer el archivo.\n";
}
echo "<br>";

$file = fopen($filename, "a");

if ($file) {
    fwrite($file, "Nueva línea añadida.");
    fclose($file);
    echo "Nueva línea añadida al archivo.";
} else {
    echo "Error al escribir en el archivo.";
}
echo "<br>";

$newFilename = "ejemplo2.txt";
if (copy($filename, $newFilename)) {
    echo "Archivo copiado como $newFilename.";
} else {
    echo "Error al copiar el archivo.";
}
echo "<br>";

$newName = "archivoRenombre.txt";
if (rename($filename, $newName)) {
    echo "Archivo renombrado de $filename a $newName";
} else {
    echo "Error al renombrar el archivo";
}
echo "<br>";

if (unlink($newName)) {
    echo "Archivo $newName eliminado";
} else {
    echo "Error al eliminar el archivo.";
}
?>
