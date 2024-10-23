<?php
//8.a
$profesores = [
    [
        "num_registro" => "PR001",
        "nombre" => "Juan",
        "apellidos" => "Pérez",
        "telefono" => "123456789",
        "fecha_nacimiento" => "1985-06-15"
    ],
    [
        "num_registro" => "PR002",
        "nombre" => "María",
        "apellidos" => "Gómez",
        "telefono" => "987654321",
        "fecha_nacimiento" => "1992-10-08"
    ],
    [
        "num_registro" => "PR003",
        "nombre" => "Luis",
        "apellidos" => "Rodríguez",
        "telefono" => "654321987",
        "fecha_nacimiento" => "1978-12-30"
    ]
];
//8.b
function mostrarNumeroRegistro($profesores) {
    foreach ($profesores as $profesor) {
        echo "Número de registro: " . $profesor['num_registro'] . "<br>";
    }
}

mostrarNumeroRegistro($profesores);

//8.c
array_map(function($profesor) {
    echo "Número de registro: " . $profesor['num_registro'] . "<br>";
}, $profesores);

//8.d
$profesoresNacidosDespuesDe1990 = array_filter($profesores, function($profesor) {
    return strtotime($profesor['fecha_nacimiento']) >= strtotime('1990-01-01');
});

foreach ($profesoresNacidosDespuesDe1990 as $profesor) {
    echo $profesor['nombre'] . " " . $profesor['apellidos'] . " nació el " . $profesor['fecha_nacimiento'] . "<br>";
}

?>