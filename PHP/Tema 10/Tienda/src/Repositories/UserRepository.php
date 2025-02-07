<?php

namespace Repositories;

use Lib\BaseDatos;
use Models\User;
use PDO;
use PDOException;
use DateTime;

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
                "INSERT INTO usuarios (nombre, apellidos, email, password, rol, confirmado, token, token_exp)
                 VALUES (:nombre, :apellidos, :correo, :contrasena, :rol, :confirmado, :token, :token_exp)"
            );

            $stmt->bindValue(':nombre', $usuario->getNombre(), PDO::PARAM_STR);
            $stmt->bindValue(':apellidos', $usuario->getApellidos(), PDO::PARAM_STR);
            $stmt->bindValue(':correo', $usuario->getCorreo(), PDO::PARAM_STR);
            $stmt->bindValue(':contrasena', $usuario->getContrasena(), PDO::PARAM_STR);
            $stmt->bindValue(':rol', $usuario->getRol(), PDO::PARAM_STR);
            $stmt->bindValue(':confirmado', $usuario->getConfirmado(), PDO::PARAM_BOOL);
            $stmt->bindValue(':token', $usuario->getToken(), PDO::PARAM_STR);
            $stmt->bindValue(':token_exp', $usuario->getToken_Exp(), PDO::PARAM_STR);

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

    /**
     * Metodo para confirmar la cuenta en la base de datos
     * @var string con el token
     * @return bool
     */
    public function confirmarCuenta(string $token): bool {
        try {
            $usuario = $this->obtenerUsuarioPorToken($token);
    
            if (!$usuario || $this->esTokenExpirado($usuario['token_exp'])) {
                return false;
            }
    
            if ($usuario['confirmado']) {
                return true;
            }
    
            return $this->actualizarConfirmacionUsuario($usuario['id'], $token);
        } catch (PDOException $e) {
            error_log("Error al confirmar la cuenta: " . $e->getMessage());
            return false;
        }
    }
    
    /**
     * Metodo para obtener el usuario dependiendo del token que le pases
     * @var string token del usuario a sacar
     * @return array
     */
    private function obtenerUsuarioPorToken(string $token): ?array {
        $stmt = $this->conexion->prepare(
            "SELECT id, confirmado, token_exp FROM usuarios WHERE token = :token"
        );
        $stmt->bindValue(':token', $token, PDO::PARAM_STR);
        $stmt->execute();
    
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
    
        $stmt->closeCursor();
    
        return $usuario ?: null;
    }
    
    /**
     * Metodo para comprobar si el token que se le pasa a expirado
     * @var string con la fecha de expiracion del token a comprobar
     * @return bool
     */
    private function esTokenExpirado(string $tokenExp): bool {
        $fechaExpiracion = new DateTime($tokenExp);
        $fechaActual = new DateTime();
    
        return $fechaActual > $fechaExpiracion;
    }
    
    /**
     * Metodo que actualiza los campos de confirmado del usuario confirmado
     */
    private function actualizarConfirmacionUsuario(int $id, string $token): bool {
        $stmt = $this->conexion->prepare(
            "UPDATE usuarios SET confirmado = 1, token = NULL, token_exp = NULL 
             WHERE id = :id AND token = :token"
        );
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->bindValue(':token', $token, PDO::PARAM_STR);
        $stmt->execute();
    
        $actualizado = $stmt->rowCount() > 0;
    
        $stmt->closeCursor();
    
        return $actualizado;
    }
    

    /**
     * Metodo que actualizar un usuario de la base de datos
     * @var Product datos a actualizar en la base de datos
     * @var int entero con el id del usuario a actualizar
     * @return bool|string
     */
    public function updateUserPassword (User $user, int $id): bool|string{
        try {
            $stmt = $this->conexion->prepare(
                "UPDATE usuarios SET token = :token, token_exp = :token_exp  WHERE id = :id");

            $stmt->bindValue(':token', $user->getToken(), PDO::PARAM_STR);
            $stmt->bindValue(':token_exp', $user->getToken_Exp(), PDO::PARAM_STR);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);

            $stmt->execute();
            return true;
        } 
        catch (PDOException $e) {
            return $e->getMessage();
        }
    }





    /**
     * Metodo para cambiar la contraseña de un usuario en la base de datos
     * @var string con el token
     * @var string con la contraseña a cambiar
     * @return bool
     */
    public function cambiarContraseña(string $token, string $password): bool {
        try {
            $usuario = $this->obtenerUsuarioPorTokenContraseña($token);
    
            if (!$usuario || $this->esTokenExpiradoContraseña($usuario['token_exp'])) {
                return false;
            }
    
            return $this->actualizarContraseñaUsuario($usuario['id'], $token, $password);
        } catch (PDOException $e) {
            error_log("Error al confirmar la cuenta: " . $e->getMessage());
            return false;
        }
    }
    
    /**
     * Metodo para obtener el usuario dependiendo del token que le pases
     * @var string token del usuario a sacar
     * @return array
     */
    private function obtenerUsuarioPorTokenContraseña(string $token): ?array {
        $stmt = $this->conexion->prepare(
            "SELECT id, confirmado, token_exp FROM usuarios WHERE token = :token"
        );
        $stmt->bindValue(':token', $token, PDO::PARAM_STR);
        $stmt->execute();
    
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
    
        $stmt->closeCursor();
    
        return $usuario ?: null;
    }
    
    /**
     * Metodo para comprobar si el token que se le pasa a expirado
     * @var string con la fecha de expiracion del token a comprobar
     * @return bool
     */
    private function esTokenExpiradoContraseña(string $tokenExp): bool {
        $fechaExpiracion = new DateTime($tokenExp);
        $fechaActual = new DateTime();
    
        return $fechaActual > $fechaExpiracion;
    }
    
    /**
     * Metodo que actualiza los campos de confirmado y contraseña del usuario que cambia
     * la contraseña
     */
    private function actualizarContraseñaUsuario(int $id, string $token, string $password): bool {
        $stmt = $this->conexion->prepare(
            "UPDATE usuarios SET password = :password, token = NULL, token_exp = NULL 
             WHERE id = :id AND token = :token"
        );
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->bindValue(':token', $token, PDO::PARAM_STR);
        $stmt->bindValue(':password', $password, PDO::PARAM_STR);
        $stmt->execute();
    
        $actualizado = $stmt->rowCount() > 0;
    
        $stmt->closeCursor();
    
        return $actualizado;
    }

}