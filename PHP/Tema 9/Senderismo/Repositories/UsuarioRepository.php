<?php

namespace Repositories;

use Lib\BaseDatos;
use Models\Usuario;
use PDO;
use PDOException;


class UsuarioRepository {
    private BaseDatos $conexion;

    public function __construct() {
        $this->conexion = new BaseDatos();
    }

    // Método para guardar un nuevo usuario en la base de datos
    public function guardarUsuarios(Usuario $usuario): bool|string {
        try {
            $stmt = $this->conexion->prepare(
                "INSERT INTO usuarios (nombre, apellidos, correo, direccion, telefono, fecha_nacimiento, usuario, contraseña, rol)
                 VALUES (:nombre, :apellidos, :correo, :direccion, :telefono, :fecha_nacimiento, :nombre_usuario, :contrasena, :rol)"
            );

            $stmt->bindValue(':nombre', $usuario->getNombre(), PDO::PARAM_STR);
            $stmt->bindValue(':apellidos', $usuario->getApellidos(), PDO::PARAM_STR);
            $stmt->bindValue(':correo', $usuario->getCorreo(), PDO::PARAM_STR);
            $stmt->bindValue(':direccion', $usuario->getDireccion(), PDO::PARAM_STR);
            $stmt->bindValue(':telefono', $usuario->getTelefono(), PDO::PARAM_STR);
            $stmt->bindValue(':fecha_nacimiento', $usuario->getFechaNacimiento(), PDO::PARAM_STR);
            $stmt->bindValue(':nombre_usuario', $usuario->getNombreUsuario(), PDO::PARAM_STR);
            $stmt->bindValue(':contrasena', $usuario->getContrasena(), PDO::PARAM_STR);
            $stmt->bindValue(':rol', $usuario->getRol(), PDO::PARAM_STR);

            $stmt->execute();
            return true;
        } 
        catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    // Método para obtener el nombre de usuario y poder verificar el logueo
    public function obtenerCorreo(string $correoUsu): ?array {
        try {
            $stmt = $this->conexion->prepare("SELECT * FROM usuarios WHERE correo = :email");
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

    // Método para obtener el usuario por su id
    public function obtenerUsuarioPorId(int $id): ?array {
        try {
            $stmt = $this->conexion->prepare("SELECT * FROM usuarios WHERE id = :id");
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                return $stmt->fetch(PDO::FETCH_ASSOC);
            }
            return null;
        } 
        catch (PDOException $e) {
            error_log("Error al obtener el usuario: " . $e->getMessage());
            return null;
        }
    }

    // Método para actualizar los datos de los usuarios
    public function actualizar(Usuario $usuario): int|string {
        try {
            $stmt = $this->conexion->prepare("UPDATE usuarios 
                                          SET nombre = :nombre, 
                                              apellidos = :apellidos, 
                                              correo = :correo, 
                                              direccion = :direccion, 
                                              telefono = :telefono, 
                                              fecha_nacimiento = :fecha_nacimiento, 
                                              usuario = :nomUsu
                                          WHERE id = :id");
            
            $stmt->bindValue(':id', $usuario->getId(), PDO::PARAM_INT);
            $stmt->bindValue(':nombre', $usuario->getNombre(), PDO::PARAM_STR);
            $stmt->bindValue(':apellidos', $usuario->getApellidos(), PDO::PARAM_STR);
            $stmt->bindValue(':correo', $usuario->getCorreo(), PDO::PARAM_STR);
            $stmt->bindValue(':direccion', $usuario->getDireccion(), PDO::PARAM_STR);
            $stmt->bindValue(':telefono', $usuario->getTelefono(), PDO::PARAM_STR);
            $stmt->bindValue(':fecha_nacimiento', $usuario->getFechaNacimiento(), PDO::PARAM_STR);
            $stmt->bindValue(':nomUsu', $usuario->getNombreUsuario(), PDO::PARAM_STR);
    
            $stmt->execute();
            return $stmt->rowCount();
        } 
        catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    // Método que obtiene todos los usuarios de la base de datos
    public function obtenerTodosUsuarios(): ?array {
        try {
            $stmt = $this->conexion->prepare("SELECT * FROM usuarios ORDER BY nombre");
            $stmt->execute();
            
            $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $usuarios ?: null;
        } 
        catch (PDOException $e) {
            error_log("Error al obtener todos los usuarios: " . $e->getMessage());
            return null;
        }
    }
}