<?php
require('fpdf/fpdf.php');
//Clase para generar el PDF
class ejercicio7FPDF extends FPDF {
    private $grupo;
    private $curso;
    private $logotipo;
    private $alumnos;
    //Constructor de la clase
    public function __construct($grupo, $curso, $logotipo, $alumnos) {
        parent::__construct();
        $this->grupo = $grupo;
        $this->curso = $curso;
        $this->logotipo = $logotipo;
        $this->alumnos = $alumnos;
    }

    public function crearPDF() {
        $this->AddPage();
        //Definir Titulo del PDF
        $this->SetFont('Arial', 'B', 16);
        $this->Cell(0, 10, 'Alumnos del Ayala', 0, 1, 'C');
        //Definir Imagen en la posicion 170 y 5 con una anchura de 30
        $this->Image($this->logotipo, 162, 5, 30); 

        //Poner el grupo y el curso
        $this->SetFont('Arial', 'I', 12);
        $this->Cell(0, 10, "Grupo: $this->grupo", 10, 1);
        $this->Cell(0, 10, "Curso: $this->curso", 10, 1);
        //Hacer un salto de linea de una altura de 25
        $this->Ln(25);
        //Definir el titulo de la tabla con las palabras nombres y apellidos con su fuente y tamaño
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(90, 10, 'Nombre', 1);
        $this->Cell(90, 10, 'Apellido', 1);
        $this->Ln();

        //Definir el nombre y los apellidos de cada uno de los 20 alumnos
        $this->SetFont('Arial', '', 12);
        foreach ($this->alumnos as $alumno) {
            list($nombre, $apellido) = explode(' ', $alumno, 2);
            $this->Cell(90, 10, $nombre, 1);
            $this->Cell(90, 10, $apellido, 1);
            $this->Ln();
        }
    }
    //Abrir el archivo al ejecutar el PHP
    public function mostrarPDF() {
        $this->Output('F', 'alumnosAyala.pdf');
    }
}
//Definir el contenido del grupo, del curso, la imagen y los alumnos a mostrar
$grupo = "Jorge y Eduardo";
$curso = "2 DAW Bilingue";
$logotipo = "images.jpg";
$alumnos = [
    "Raul Fernandez Lopez",
    "Maria Gutierrez Torres",
    "Candido Campos Torres",
    "Javi Campos Campos",
    "Aitor Del Campo Hernandez",
    "Jorge Jurado Perez",
    "Ruben Doblas Garcia",
    "Dolores Fuertes Gonzalez",
    "Aitor Robles Olmos",
    "Armando Lopez Molino",
    "Juana del Arco Lopez",
    "Leonardo Jackson Perez",
    "Francisco Ruiz de la Osa",
    "Cristina Mendoza Sanchez",
    "Gabriela Guerrero Ruiz",
    "Nicolas Vargas Ortega",
    "Camila Ruiz Morales",
    "Felipe Ortega Jimenez",
    "Teresa Salazar Herrera",
    "Martin Pineda Lopez"
];

//Llamar a la clase, crear el archivo y mostrarlo
$pdf = new ejercicio7FPDF($grupo, $curso, $logotipo, $alumnos);
$pdf->crearPDF();
$pdf->mostrarPDF();
?>
