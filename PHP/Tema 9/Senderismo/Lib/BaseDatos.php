<?php 

namespace Lib;
use PDO;
use PDOException;
use PDOStatement;
// Clase para establecer la conexión con la base de datos y poder ejcutar consultas
class BaseDatos{
    private $conexion;
    private mixed $resultado;

    function __construct(
        private string $servidor = SERVERNAME,
        private string $usuario = USERNAME,
        private string $pass = PASSWORD,
        private string $base_datos = DATABASE
    )
    {
        $this->conexion = $this->conectar();
    }

    private function conectar(): PDO{
        try{
            $opciones = array(
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4",
                PDO::MYSQL_ATTR_FOUND_ROWS => true
            );
            $conexion = new PDO("mysql:host={$this->servidor};dbname={$this->base_datos}",$this->usuario,$this->pass,$opciones);
            return $conexion;
        }
        catch(PDOException $e){
            echo "Ha surgido un error y no se peude conectar a la base de datos. Detalle: " . $e->getMessage();
            exit;
        }
    }

    public function prepare(string $consultaSQL): PDOStatement {
        return $this->conexion->prepare($consultaSQL);
    }

    public function consulta(string $consultaSQL): void{
        $this->resultado = $this->conexion->query($consultaSQL);
    }
    public function extraer_registro(): mixed{
        return ($fila = $this->resultado->fetch(PDO::FETCH_ASSOC))? $fila:false;
    }
    public function extraer_todos(): array{
        return $this->resultado->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>