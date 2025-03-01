<?php

namespace Services;

use Models\User;
use Lib\Security;
use Repositories\UserRepository;

/**
 * Clase que recibe los datos de UserController
 * y se los pasa al repository
 */
class UserService {
    /**
     * Variable para establecer la conexion el repository
     */
    private UserRepository $repository;
    private Security $security;

    /**
     * Constructor que inicializa las variables
     */
    public function __construct() {
        $this->repository = new UserRepository();
        $this->security = new Security();
    }

    /**
     * Metodo que llama al repository para guardar un usuario
     * @var array con los datos del usuario a guardar
     * @return bool|string
     */
    public function guardarUsuarios(array $userData): bool|string {
        try {
            $usuario = new User(
                null,
                $userData['nombre'],
                $userData['apellidos'],
                $userData['correo'],
                $userData['contrasena'],
                $userData['rol'],
                $userData['confirmado'],
                $userData['token'],
                $userData['token_exp']

            );

            return $this->repository->guardarUsuarios($usuario);
        } 
        catch (\Exception $e) {
            error_log("Error al guardar el usuario: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Método que llama al repository y obtiene el correo del usuario
     * @var string con el correo a obtener
     * @return ?array
     */
    public function obtenerCorreo(string $correo): ?array {
        return $this->repository->obtenerCorreo($correo);
    }

    /**
     * Método que llama al repository y comprueba el correo
     * @var string con el correo a comprobar
     * @return ?bool
     */
    public function comprobarCorreo(string $correoUsu): ?bool {
        return $this->repository->comprobarCorreo($correoUsu);
    }


    /**
     * Método para comprobar el usuario que se esta introduciendo esta en la base de datos para
     * poder loguearse
     * @var string con el correo del usuario a comprobar
     * @var string con la contraseña del usuario a comprobar
     * @return ?array
     */
    public function iniciarSesion(string $correo, string $contrasena): ?array {
        $usuario = $this->obtenerCorreo($correo);
        
        if ($usuario && $this->security->validatePassw($contrasena, $usuario['password'])) {
            return $usuario;
        }
        
        return null;
    }

    /**
     * Metodo que llama al repository para confirmar la cuenta
     * @var string token que confirmar
     */
    public function confirm(string $token){
        return $this->repository->confirmarCuenta($token);
    }


    /**
      * Método que llama a repository para actualizar un usuario
      * @var array con los datos a actualizar
      * @var int con el id del usuario a actualizar
      * @return bool|string
      */
      public function updateUserPassword(array $userData, int $id): bool|string {
        try {
            $user = new User(
                null,
                $userData['nombre'],
                $userData['apellidos'],
                $userData['correo'],
                $userData['contrasena'],
                $userData['rol'],
                $userData['confirmado'],
                $userData['token'],
                $userData['token_exp']
            );

            return $this->repository->updateUserPassword($user, $id);
        } 
        catch (\Exception $e) {
            error_log("Error al actualizar el usuario: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Metodo que llama al repository para confirmar la cuenta
     * @var string token que confirmar
     */
    public function changePassword(string $token, string $password){
        return $this->repository->cambiarContraseña($token, $password);
    }

}