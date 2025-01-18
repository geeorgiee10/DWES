<?php 

namespace Lib;
use PDO;
use PDOException;
use PDOStatement;

/**
 * Clase que establece la conexion con la base de taos y usa metodos 
 * relacionados con la base de datos
 */
class BaseDatos{
    /**
     * Variables necesarias para establecer la conexion con la base de datos
     */
    private $conexion;
    private mixed $resultado;
    private string $servidor;
    private string $usuario;
    private string $pass;
    private string $base_datos;

    /**
     * Constructor que inicializa las variables
     */
    function __construct()
    {
        $this->servidor = $_ENV['SERVERNAME'];
        $this->usuario = $_ENV['USERNAME'];
        $this->pass = $_ENV['PASSWORD'];
        $this->base_datos = $_ENV['DATABASE'];
        $this->conexion = $this->conectar();
    }

    /**
     * Metodo que establece la conexion con la base de datos
     * @return PDO devuelve la variable con la conexion a la base de datos 
     */
    private function conectar(): PDO{
        try{
            $opciones = array(
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4",
                PDO::MYSQL_ATTR_FOUND_ROWS => true,
                PDO::ATTR_ERRMODE => true,
                PDO::ERRMODE_EXCEPTION => true
            );
            $conexion = new PDO("mysql:host={$this->servidor};dbname={$this->base_datos}",$this->usuario,$this->pass,$opciones);
            return $conexion;
        }
        catch(PDOException $e){
            echo "Ha surgido un error y no se peude conectar a la base de datos. Detalle: " . $e->getMessage();
            exit;
        }
    }

    /**
     * Metodo que permite realizar consultas preparadas
     * @var string recibe un string con la consulta preparada a realizar
     * @return PDOStatement devuelve la consulta preparada hecha
     */
    public function prepare(string $consultaSQL): PDOStatement {
        return $this->conexion->prepare($consultaSQL);
    }

    /**
     * Metodo que permite guardar consultas 
     * @var string recibe un string con la consulta a guardada
     * @return void
     */
    public function consulta(string $consultaSQL): void{
        $this->resultado = $this->conexion->query($consultaSQL);
    }

    /**
     * Metodo que extraer registros
     * @return mixed devuelve el registro extraido
     */
    public function extraer_registro(): mixed{
        return ($fila = $this->resultado->fetch(PDO::FETCH_ASSOC))? $fila:false;
    }

    /**
     * Metodo que permite extraer todos los registros coincidentes con la consulta
     * @return array array con todos los registros
     */
    public function extraer_todos(): array{
        return $this->resultado->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Metodo que permite saber las filas afectadas por las consultas
     * @return int devuelve el número de filas afectadas
     */
    public function filasAfectadas(): int{
        return $this->resultado->rowCount();
    }
    
    /**
     * Metodo que permite conoces el ultimo id insertado 
     * en la base de datos
     * @return int id entero con el ultimo id insertado
     */
    public function ultimoIDInsertado(): int{
        return $this->conexion->lastInsertId();
    }

    /**
     * Metodo que permite cerrar la conexion con la base de datos
     * @return void cierra la conexion con la base de datos
     */
    public function cierraConexion():void{
        $this->conexion = null;
    }

    /**
     * Metodo para iniciar una transaccion
     * @return bool devuelve true si se inicia y false sino
     */
    public function beginTransaction(): bool {
        return $this->conexion->beginTransaction();
    }

    /**
     * Metodo para realizar un commit dentro de una transaccion
     * @return bool devulve true si se realizar y false sino
     */
    public function commit(): bool {
        return $this->conexion->commit();
    }

    /**
     * Metodo que deshace todo lo que haya dentro de una transaccion
     * si hay algun error
     * @return bool devuelve true si no hay errores y false si los hay 
     */
    public function rollBack(): bool {
        return $this->conexion->rollBack();
    }
}

?>