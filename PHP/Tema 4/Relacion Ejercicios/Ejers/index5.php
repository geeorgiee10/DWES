<?php
function generarAnimalesAleatorios() {
    $numAnimales = rand(20, 30);
    $animales = [];

    for ($i = 0; $i < $numAnimales; $i++) {
        $animal = "&#" . rand(128000, 128060) . ";";
        $animales[] = $animal;
    }

    return $animales;
}

function seleccionarYEliminarAnimal(&$animales) {
    $indiceAleatorio = array_rand($animales);
    $animalSeleccionado = $animales[$indiceAleatorio];
    unset($animales[$indiceAleatorio]);
    $animales = array_values($animales);
    return $animalSeleccionado;
}

function eliminarCoincidencias(&$animales, $animalSuelto) {
    $animales = array_filter($animales, function($animal) use ($animalSuelto) {
        return $animal !== $animalSuelto;
    });
    $animales = array_values($animales);
}

$animales = generarAnimalesAleatorios();

echo "Grupo inicial de animales: <br>";
echo implode(" ", $animales) . "<br><br>";

$animalSuelto = seleccionarYEliminarAnimal($animales);
echo "Animal suelto: $animalSuelto<br><br>";

eliminarCoincidencias($animales, $animalSuelto);

echo "Grupo de animales tras eliminar las coincidencias:<br>";
echo implode(" ", $animales) . "<br><br>";

echo "Número total de animales restantes: " . count($animales) . "<br>";
?>
