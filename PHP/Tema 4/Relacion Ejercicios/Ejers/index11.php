<?php
$peliculas = [
    "El Padrino",
    "El Señor de los Anillos",
    "Matrix",
    "Los Vengadores",
    "Inception",
    "Pulp Fiction",
    "Gladiador",
    "El Caballero Oscuro",
    "Titanic",
    "Jurassic Park"
];

function colorAleatorio() {
    return '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
}

foreach ($peliculas as $indice => $pelicula) {
    echo "<p>Película " . ($indice + 1) . ": $pelicula</p>";
}

echo "<style>
        table {
            width: 50%;
            margin: 20px 0;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>";

echo "<table>";
echo "<tr><th>Posición</th><th>Película</th></tr>";
foreach ($peliculas as $indice => $pelicula) {
    $color = colorAleatorio();
    echo "<tr>";
    echo "<td>" . ($indice + 1) . "</td>";
    echo "<td style='color: $color;'>$pelicula</td>";
    echo "</tr>";
}
echo "</table>";
?>
