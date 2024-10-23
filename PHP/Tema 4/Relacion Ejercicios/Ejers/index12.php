<?php
// Array de asignaturas y notas
$notas = [
    ["asignatura" => "Matemáticas", "trimestre1" => 3, "trimestre2" => 10, "trimestre3" => 7],
    ["asignatura" => "Lengua", "trimestre1" => 8, "trimestre2" => 5, "trimestre3" => 3],
    ["asignatura" => "Física", "trimestre1" => 7, "trimestre2" => 2, "trimestre3" => 1],
    ["asignatura" => "Latín", "trimestre1" => 4, "trimestre2" => 7, "trimestre3" => 8],
    ["asignatura" => "Inglés", "trimestre1" => 6, "trimestre2" => 2, "trimestre3" => 3]
];

// Calcular la media por asignatura y la media total
$media_total = 0;
$total_asignaturas = count($notas);

foreach ($notas as $index => $nota) {
    $media_asignatura = ($nota['trimestre1'] + $nota['trimestre2'] + $nota['trimestre3']) / 3;
    $notas[$index]['media'] = round($media_asignatura, 1);
    $media_total += $notas[$index]['media'];
}

$media_total = round($media_total / $total_asignaturas, 1);

// Imprimir el boletín de notas
echo "<!DOCTYPE html>
<html lang='es'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Boletín de notas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #87CEFA;
            text-align: center;
        }
        table {
            margin: 20px auto;
            border-collapse: collapse;
            width: 50%;
        }
        th, td {
            border: 1px solid black;
            padding: 10px;
        }
        h1 {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <h1>Boletín de notas</h1>
    <table>
        <tr>
            <th>Asignatura</th>
            <th>Trimestre 1</th>
            <th>Trimestre 2</th>
            <th>Trimestre 3</th>
            <th>Media</th>
        </tr>";

foreach ($notas as $nota) {
    echo "<tr>
            <td>{$nota['asignatura']}</td>
            <td>{$nota['trimestre1']}</td>
            <td>{$nota['trimestre2']}</td>
            <td>{$nota['trimestre3']}</td>
            <td>{$nota['media']}</td>
          </tr>";
}

echo "</table>";
echo "<p>La media total es $media_total</p>";
echo "</body>
</html>";
?>
