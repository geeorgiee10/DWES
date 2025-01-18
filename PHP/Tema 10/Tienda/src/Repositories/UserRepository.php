<?php

namespace Repositories;

use Lib\BaseDatos;
use Models\User;
use PDO;
use PDOException;

/**
 * Clase que realiza las consultas a la tabla usuarios
 */
class UserRepository {
    /**
     * Variable para establecer la conexion con la base de datos
     */
    private BaseDatos $conexion;

    /**
     * Constructor que inicializa las variables
     */
    public function __construct() {
        $this->conexion = new BaseDatos();
    }

    /**
     * Metodo que guarda usuarios nuevos en la base de datos
     * @var User objeto con los datos del usuario a guardar
     * @return bool|string
     */
    public function guardarUsuarios(User $usuario): bool|string {
        try {
            $stmt = $this->conexion->prepare(
                "INSERT INTO usuarios (nombre, apellidos, email, password, rol)
                 VALUES (:nombre, :apellidos, :correo, :contrasena, :rol)"
            );

            $stmt->bindValue(':nombre', $usuario->getNombre(), PDO::PARAM_STR);
            $stmt->bindValue(':apellidos', $usuario->getApellidos(), PDO::PARAM_STR);
            $stmt->bindValue(':correo', $usuario->getCorreo(), PDO::PARAM_STR);
            $stmt->bindValue(':contrasena', $usuario->getContrasena(), PDO::PARAM_STR);
            $stmt->bindValue(':rol', $usuario->getRol(), PDO::PARAM_STR);

            $stmt->execute();
            return true;
        } 
        catch (PDOException $e) {
            return $e->getMessage();
        } finally{
            if(isset($stmt)){
                $stmt->closeCursor();
            }
        }
    }

    /**
     * Metodo que comprueba si esta un correo en la base de datos para 
     * poder loguearse
     * @var string correo a verificar si esta en la base de datos 
     * @return ?array
     */
    public function obtenerCorreo(string $correoUsu): ?array {
        try {
            $stmt = $this->conexion->prepare("SELECT * FROM usuarios WHERE email = :email");
            $stmt->bindValue(':email', $correoUsu, PDO::PARAM_STR);
            $stmt->execute();

            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
            return $usuario ?: null;
        } 
        catch (PDOException $e) {
            error_log("Error al obtener el usuario: " . $e->getMessage());
            return null;
        }
    }

    /**
     * Metodo que comprueba si ya existe el correo al registrarse
     * @var string con el correo a comprobar si esta en la base de datos
     * @return bool
     */
    public function comprobarCorreo(string $correoUsu): bool {
        try {
            $stmt = $this->conexion->prepare("SELECT COUNT(*) FROM usuarios WHERE email = :email");
            $stmt->bindValue(':email', $correoUsu, PDO::PARAM_STR);
            $stmt->execute();

            $result = $stmt->fetchColumn();
            return $result > 0;
        } 
        catch (PDOException $e) {
            error_log("Error al comprobar el correo: " . $e->getMessage());
            return null;
        }
    }


}