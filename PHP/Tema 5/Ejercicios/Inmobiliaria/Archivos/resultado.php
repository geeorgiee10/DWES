<?php 
//Obtener el nombre de la foto para ponerla en la URL para direccionar a la pagina donde se muestra la foto
$nombreFoto = isset($_REQUEST['foto']) ? $_REQUEST['foto'] : '';
//Funcion para mostrar los resultados recogiendo los valores del formulario
function mostrarResultados (){

    global $nombreFoto;
    $tipo = isset($_REQUEST["tipo"]) ? $_REQUEST["tipo"] : "";
    $zona = isset($_REQUEST["zona"]) ? $_REQUEST["zona"] : "";
    $direccion = isset($_REQUEST["direccion"]) ? $_REQUEST["direccion"] : "";
    $dormitorios = isset($_REQUEST["dormitorios"]) ? $_REQUEST["dormitorios"] : "No se ha seleccionados ningun número de dormitorios";
    $precio = isset($_REQUEST["precio"]) ? $_REQUEST["precio"] : "";
    $tamaño = isset($_REQUEST["tamano"]) ? $_REQUEST["tamano"] : "";
    $extrasFormulario = isset($_REQUEST["extras"]) ? $_REQUEST["extras"] : []; 
    $observaciones = isset($_REQUEST["observaciones"]) ? $_REQUEST["observaciones"] : "No se ha realizado ninguna observación";

    $beneficio = 0;
    //Switch para caclcular el beneficio de la empresa en base al tamaño de la vivienda y el precio
    switch($zona){
        case "centro":
            if($tamaño < 100){
                $beneficio = ($precio * 30) /100; 
            }
            else if($tamaño > 100){
                $beneficio = ($precio * 35) /100; 
            }
            break;
        case "zaidin":
            if($tamaño < 100){
                $beneficio = ($precio * 25) /100; 
            }
            else if($tamaño > 100){
                $beneficio = ($precio * 28) /100; 
            }
            break;
        case "chana":
            if($tamaño < 100){
                $beneficio = ($precio * 22) /100; 
            }
            else if($tamaño > 100){
                $beneficio = ($precio * 25) /100; 
            }
            break;
        case "albaicin":
            if($tamaño < 100){
                $beneficio = ($precio * 20) /100; 
            }
            else if($tamaño > 100){
                $beneficio = ($precio * 35) /100; 
            }
            break;
        case "sacromonte":
            if($tamaño < 100){
                $beneficio = ($precio * 22) /100; 
            }
            else if($tamaño > 100){
                $beneficio = ($precio * 25) /100; 
            }
            break;
        case "realejo":
            if($tamaño < 100){
                $beneficio = ($precio * 25) /100; 
            }
            else if($tamaño > 100){
                $beneficio = ($precio * 28) /100; 
            }
            break;        
    }

    //Mostrar los resultados con codigo html mezclandolo con php
    ?>
    <h1>Inserción de vivienda</h1>
    <p>Estos son los datos introducidos</p>

    <ul>
        <li>Tipo: <?php echo $tipo?></li>
        <li>Zona: <?php echo $zona?></li>
        <li>Dirección: <?php echo $direccion?></li>
        <li>Número de dormitorios: <?php echo $dormitorios?></li>
        <li>Precio: <?php echo $precio?> €</li>
        <li>Tamaño: <?php echo $tamaño?> metros cuadrados</li>
        <li>Extras: 
            <?php foreach ($extrasFormulario as $extra) {
                print("·$extra"); 
            }?>
        </li>
        <li>Foto: 
        <a href="mostrarFoto.php?foto=<?php echo urlencode($nombreFoto); ?>">
            <?php echo htmlspecialchars($nombreFoto); ?>
        </a>
        </li>
        <li>Observaciones: <?php echo $observaciones?></li>
        <li>Beneficio de la empresa: <?php echo $beneficio?> €</li>
    </ul>
    <a href="./formulario.php">Insertar otra vivienda</a>
<?php
//LLamar a la funcion pasandole los parametros para guardar en el xml
guardarEnXML($tipo, $zona, $direccion, $dormitorios, $precio, $tamaño, $extrasFormulario, $observaciones, $nombreFoto);


}
//Funcion para guardar los datos recibidos del formulario en el archivo viviendas.xml
function guardarEnXML($tipo, $zona, $direccion, $dormitorios, $precio, $tamaño, $extras, $observaciones, $nombreFoto) {
    $ficheroXML = 'viviendas.xml';

    //Verificar si el archivo XML donde se van a guardar los datos existe
    if (file_exists($ficheroXML)) {
        //Cargar el contenido ya existente en el archivo viviendas.xml
        $xml = simplexml_load_file($ficheroXML);
    } 
    //Crear un nuevo archivo  XML si no existe
    else {
        $xml = new SimpleXMLElement('<viviendas/>');
    }
    
    // Crear un nuevo elemento con los subelementos para guardar los datos
    $nuevoElementoVivienda = $xml->addChild('vivienda');
    $nuevoElementoVivienda->addChild('tipo', $tipo);
    $nuevoElementoVivienda->addChild('zona', $zona);
    $nuevoElementoVivienda->addChild('direccion', $direccion);
    $nuevoElementoVivienda->addChild('dormitorios', $dormitorios);
    $nuevoElementoVivienda->addChild('precio', $precio);
    $nuevoElementoVivienda->addChild('tamano', $tamaño);
    $nuevoElementoVivienda->addChild('foto', htmlspecialchars($nombreFoto)); 
    $nuevoElementoVivienda->addChild('observaciones', $observaciones);
    
    $extrasContenedor = $nuevoElementoVivienda->addChild('extras');
    foreach ($extras as $extra) {
        $extrasContenedor->addChild('extra', $extra);
    }

    //Crear un objeto DOMDocument para formatear los elementos en el archivo viviendas.xml
    $objetoDOM = new DOMDocument('1.0', 'UTF-8');
    $objetoDOM->preserveWhiteSpace = false;
    $objetoDOM->formatOutput = true;
    
    //Cargar el contenido XML del SimpleXMLElement en el objeto DOMDocument
    $objetoDOM->loadXML($xml->asXML());

    //Guardar el contenido del XML teniendo formateados los elementos en el archivo viviendas.xml
    $objetoDOM->save($ficheroXML);
}
?>
 


