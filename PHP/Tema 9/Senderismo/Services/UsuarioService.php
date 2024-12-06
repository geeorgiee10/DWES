<?php

namespace Services;

use Models\Usuario;
use Repositories\UsuarioRepository;

class UsuarioService {
    private UsuarioRepository $repository;

    public function __construct() {
        $this->repository = new UsuarioRepository();
    }

    // Método que llama al repository para guardar un usuario en la base de datos
    public function guardarUsuarios(array $userData): bool|string {
        try {
            $usuario = new Usuario(
                null,
                $userData['nombre'],
                $userData['apellidos'],
                $userData['correo'],
                $userData['direccion'],
                $userData['telefono'],
                $userData['fecha_nacimiento'],
                $userData['nombre_usuario'],
                $userData['contrasena'],
                $userData['rol']
            );

            return $this->repository->guardarUsuarios($usuario);
        } 
        catch (\Exception $e) {
            error_log("Error al guardar el usuario: " . $e->getMessage());
            return false;
        }
    }

    // Método que llama al repository y obtiene el nombre de usuario
    public function obtenerCorreo(string $correo): ?array {
        return $this->repository->obtenerCorreo($correo);
    }

    // Método que llama al repository para obtener el id del usuario
    public function obtenerUsuarioPorId(int $id): ?array {
        return $this->repository->obtenerUsuarioPorId($id);
    }

    // Método que llama al repository para actualizar los datos del usuario
    public function actualizar(array $userData): int|string {
        try {
            $usuario = new Usuario(
                $userData['id'],
                $userData['nombre'],
                $userData['apellidos'],
                $userData['correo'],
                $userData['direccion'],
                $userData['telefono'],
                $userData['fecha_nacimiento'],
                $userData['nombre_usuario']
            );

            return $this->repository->actualizar($usuario);
        } catch (\Exception $e) {
            error_log("Error al actualizar el usuario: " . $e->getMessage());
            return $e->getMessage();
        }
    }

    // Método para comprobar el usuario que se esta introduciendo esta en la base de datos para
    // poder loguearse
    public function iniciarSesion(string $correo, string $contrasena): ?array {
        $usuario = $this->obtenerCorreo($correo);
        
        if ($usuario && password_verify($contrasena, $usuario['contraseña'])) {
            return $usuario;
        }
        
        return null;
    }

    // Método que llama a repository para ver todos los usuarios
    public function obtenerTodosUsuarios(): ?array {
        return $this->repository->obtenerTodosUsuarios();
    }
}