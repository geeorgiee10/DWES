<?php 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $telefono = $_POST['telefono'];
    $codigo_postal = $_POST['codigo_postal'];
    
    $xml_file = 'empleados.xml';
    if (file_exists($xml_file)) {
        $xml = simplexml_load_file($xml_file);
        
        $empleado_encontrado = false;
        foreach ($xml->empleado as $empleado) {
            if ($empleado->nombre == $nombre) {
                // Si el empleado existe, agregar teléfono y código postal
                $empleado->addChild('telefono', $telefono);
                $empleado->addChild('codigo_postal', $codigo_postal);
                $empleado_encontrado = true;
                break;
            }
        }

        if ($empleado_encontrado) {
            $xml->asXML($xml_file);
            echo "Datos actualizados para el empleado $nombre.";
        } else {
            echo "No se encontró el empleado con el nombre $nombre.";
        }
    } else {
        echo "No se encontró el archivo empleados.xml.";
    }
}
?>