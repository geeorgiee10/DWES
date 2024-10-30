<?php
	/*
         simplexml_load_file lee un fichero XML y devuelve un objeto de la clase
         SimpleXMLElement. El fichero se manipula a través de este objeto
         */
if (file_exists('empleados.xml')) {
    $datos = simplexml_load_file("empleados.xml");
    echo "<br>";
    if ($datos === false) {
        echo "Error al leer el fichero";
    } else {
        /**  Lo recorremos como un array y obtenemos los hijos del elemento raiz */

        echo("<pre>");
        foreach ($datos as $valor) {
            print_r($valor);
            echo "<br>";
        }
        echo("</pre>");

        /** Otro ejemplo para extraer un string   */
        echo $datos->empleado[0]->nombre;
    }
} else
{
   echo "Error abriendo empleados.xml" ;
}

$datos = simplexml_load_file("empleados.xml");	
        /*
         * el método xpath permite seleccionar elementos usando una expresión
         */
$edades = $datos->xpath("//edad");
foreach($edades as $valor){
	print_r($valor);
	echo "<br>";
}

/*
* con la clase DOMDocument validamos empleados.xml usando 
* el esquema departamento.xsd
*/
$dept = new DOMDocument();
$dept->load( 'empleados.xml' );
$res = $dept->schemaValidate('departamento.xsd');
if ($res){ 
    echo "El fichero es válido";
} 
else { 
    echo "Fichero no válido"; 
}