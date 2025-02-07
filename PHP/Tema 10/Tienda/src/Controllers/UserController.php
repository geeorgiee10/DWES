<?php

namespace Controllers;

use Lib\Pages;
use Lib\Utils;
use Lib\Security;
use Lib\Email;
use Models\User;
use Services\UserService;
use Firebase\JWT\JWT;


/**
 * Clase para controlar el registro, inicio de sesion
 * y todo lo relacionado con el usuario
 */
class UserController {

    /**
     * Variables usadas en la clase
     */
    private Pages $pages;
    private Utils $utils;
    private Email $email;
    private Security $security;
    private User $user;
    private UserService $userService;
    

    /**
     * Constructor que inicializa las variables
     */
    public function __construct() {
        $this->pages = new Pages();
        $this->utils = new Utils();
        $this->email = new Email();
        $this->security = new Security();
        $this->user = new User();
        $this->userService = new UserService();
    }

    /**
     * Metodo que registra a un usuario si no hay errores
     * @return void
     */
    public function registrar() {
        //Obtener datos formularios, sanetizarlos y validarlos
        

        if ($_SERVER['REQUEST_METHOD'] === 'GET'){

            if($this->utils->isSession() && !$this->utils->isAdmin()){
                header("Location: " . BASE_URL ."");
            }
            else{

                unset($_SESSION['registrado']);
                $this->pages->render('User/registrar');
            }
        }

        else if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Crear instancia de Usuario con los datos del POST

            if($_POST['data']){

                
                $data = $_POST['data'];
                $usuario = $this->user = User::fromArray($data);
                
                /*die(var_dump($data));*/
                
                // Sanitizar datos
                $usuario->sanitizarDatos();

                // Validar datos
                $errores = $usuario->validarDatosRegistro();

                // Validar que las contraseñas coincidan
                if($data['contrasena'] !== $data['confirmar_contrasena']){
                    $errores['confirmar_contrasena'] = "Las contraseñas no son iguales";
                }

                if($this->userService->comprobarCorreo($data['email'])){
                    $errores['email'] = "El correo ya existe";
                }

                if (empty($errores)) {
                    // Cifrar la contraseña
                    $contrasena_segura = $this->security->encryptPassw($usuario->getContrasena());
                    $usuario->setContrasena($contrasena_segura);

                    $data = [
                        'id' => $usuario->getId(),
                        'correo' => $usuario->getCorreo()
                    ];

                    $token = $this->security->createToken($this->security->secretKey(), $data);
                    $key = $this->security->secretKey();
                    $token_exp = $this->security->generateEmailToken();

                    $userData = [
                        'nombre' => $usuario->getNombre(),
                        'apellidos' => $usuario->getApellidos(),
                        'correo' => $usuario->getCorreo(),
                        'contrasena' => $contrasena_segura,
                        'rol' => $usuario->getRol(),
                        'confirmado' => $usuario->getConfirmado(),
                        'token' => $token,
                        'token_exp' => $token_exp['expiration']
                    ];

                    $resultado = $this->userService->guardarUsuarios($userData);

                    if ($resultado === true) {
                        //header('Authorization: Bearer ' . $token);

                        $this->email->confirmacionCuenta($userData['correo'], $userData['nombre'], $userData['token']);
                        $_SESSION['registrado'] = true;
                        $this->pages->render('User/registrar');
                        exit;
                    } 
                    else {
                        $errores['db'] = "Error al registrar al usuario: " . $resultado;
                        $this->pages->render('User/registrar', [
                            "errores" => $errores,
                            "user" => $this->user
                        ]);
                    }
                } 
                else {
                    $this->pages->render('User/registrar', [
                        "errores" => $errores,
                        "user" => $this->user
                    ]);
                }
            }
            else{
                $_SESSION['falloDatos'] = 'fallo';
            }
            
        }
    }

   

    /**
     * Metodo que para iniciar sesion con un usuario
     * y contraseña
     * @return void
     */
    public function iniciarSesion() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'GET'){

            if($this->utils->isSession()){
                header("Location: " . BASE_URL ."");
            }
            else{

                $this->pages->render('User/iniciaSesion');
            }
        }

        else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
            $errores = [];
        
           
                $correo = $_POST['correo'];
                $contrasenaInicioSesion = $_POST['contrasena'];

                $datosUsuario = $this->userService->obtenerCorreo($correo);

                // Crear objeto Usuario con los datos para iniciar sesión
                $usuario = new User( null, "", "", $correo, $contrasenaInicioSesion, "", $datosUsuario['confirmado'], "", "");

                // Sanitizar datos
                $usuario->sanitizarDatos();

                // Validar datos
                $errores = $usuario->validarDatosLogin();

                // Si no hay errores volver a inicio si hay mostrarlos en el formulario
                if (empty($errores)) {
                    $resultado = $this->userService->iniciarSesion($usuario->getCorreo(), $usuario->getContrasena());
    
                    if ($resultado) {
                        $_SESSION['usuario'] = $resultado;

                        if (!isset($_SESSION['usuario'])) {
                            echo "Error: la sesión no se ha establecido";
                            exit;
                        }
                        header("Location: " . BASE_URL);
                        exit;
                    } 
                    else {
                        $errores['login'] = "Los datos introducidos son incorrectos";
                    }
                }

                // Redirigir la vista con los errores 
                $this->pages->render('User/iniciaSesion', ["errores" => $errores]);
            
        
        }
    }


    /**
     * Metodo que cierra la cesion y borra todas las variables 
     * de sesión
     * @return void
     */
    public function logout() {

        if(!$this->utils->isSession()){
            header("Location: " . BASE_URL ."");
        }
        else{

            session_start();
            session_unset();
            unset($_SESSION['carrito']);
            session_destroy();
            header("Location: " . BASE_URL);
            exit;
        }
    }

    /**
     * Metodo que para obtener los datos del usuario logueado 
     * y pasarselo a la vista
     * @return void
     */
    public function verTusDatos(){
        if(session_status() === PHP_SESSION_NONE){
            session_start();
        }
        if(!$this->utils->isSession()){
            header("Location: " . BASE_URL ."");
        }
        else{

            // Pasar datos guardados en la sesión
            $usuActual = $_SESSION['usuario'];

            $this->pages->render("User/datosUsuario", ["usuario" => $usuActual]);
        }
    }


    public function checkUser(){
        $token = $_GET['token'] ?? null;

        if (!$token) {
            $_SESSION['error'] = "Token no proporcionado";
            header("Location: " . BASE_URL);
            exit;
        }

        try {
            $resultado = $this->userService->confirm($token);
            if ($resultado) {
                $_SESSION['mensaje'] = "Cuenta confirmada exitosamente. Ya puedes iniciar sesión.";
            } else {
                $_SESSION['error'] = "No se pudo confirmar la cuenta. El token puede haber expirado o ser inválido.";
            }
        } catch (\Exception $e) {
            $_SESSION['error'] = "Error al confirmar la cuenta: " . $e->getMessage();
        }

        header("Location: " . BASE_URL);
        exit;
    }   


    public function password(){

        if ($_SERVER['REQUEST_METHOD'] === 'GET'){

            if($this->utils->isSession()){
                header("Location: " . BASE_URL ."");
            }
            else{

                $this->pages->render('User/cambiarContraseña');
            }
        }

        else if ($_SERVER['REQUEST_METHOD'] === 'POST') {

          if($_POST['correo']){

            $correo = $_POST['correo'] ?? '';
            $user = new User(null, "", "", $correo, "", "", false, "", "");
            $user->sanitizarDatos();
        
            $errores = $user->validarDatosRecuperar();

            if (!empty($errores)) {
                $this->pages->render('User/cambiarContraseña', ["errores" => $errores]);
                return;
            }

            $userToRecover = $this->userService->obtenerCorreo($correo);

            $data = [
                'id' => $userToRecover['id'],
                'correo' => $correo
            ];
    
            $token = $this->security->createToken($this->security->secretKey(), $data);
            $key = $this->security->secretKey();
            $token_exp = $this->security->generateEmailToken();

            $userData = [
                'nombre' => '',
                'apellidos' => '',
                'correo' => $correo,
                'contrasena' => '',
                'rol' => '',
                'confirmado' => '',
                'token' => $token,
                'token_exp' => $token_exp['expiration']
            ];


            $resultado = $this->userService->updateUserPassword($userData, $userToRecover['id']);

            if ($resultado === true) {
                $this->email->recuperarContrasela($userData['correo'], $userData['nombre'], $userData['token']);
                $_SESSION['cambio'] = true;
                $this->pages->render('User/cambiarContraseña');
                exit;
            } 
            else {
                $errores['db'] = "Error al actualizar el token en el usuario: " . $resultado;
                $this->pages->render('User/cambiarContraseña', [
                    "errores" => $errores,
                    "user" => $this->user
                ]);
            }

          }
          else{
            $_SESSION['falloDatos'] = 'fallo';
          }
        }

    }


    public function changePassword(string $token){

        if ($_SERVER['REQUEST_METHOD'] === 'GET'){

            if($this->utils->isSession()){
                header("Location: " . BASE_URL ."");
            }
            else{

                if (!$token) {
                    $_SESSION['error'] = "Token no proporcionado";
                    header("Location: " . BASE_URL);
                    exit;
                }
                else{
                    $this->pages->render('User/formCambiarContraseña', ["token" => $token]);
                }
                
            }
        }

        else if ($_SERVER['REQUEST_METHOD'] === 'POST') {

          if($_POST['data']){

                $data = $_POST['data'];
                $user = $this->user = User::fromArray($data);
                
                // Sanitizar datos
                $user->sanitizarDatos();

                // Validar datos
                $errores = $user->validarDatosCambioContraseña();

                if($data['contrasena'] !== $data['confirmar_contrasena']){
                    $errores['confirmar_contrasena'] = "Las contraseñas no son iguales";
                }

                if (!empty($errores)) {
                    $this->pages->render('User/formCambiarContraseña', ["errores" => $errores]);
                    return;
                }

                $contraseñaCambiar = $this->security->encryptPassw($user->getContrasena());

                //$token = $_GET['token'] ?? null;
                try {
                    $resultado = $this->userService->changePassword($token, $contraseñaCambiar);
                    if ($resultado) {
                        $_SESSION['mensaje'] = "Contraseña cambiada exitosamente. Ya puedes iniciar sesión.";
                    } else {
                        $_SESSION['error'] = "No se pudo cambiar la contraseña. El token puede haber expirado o ser inválido.";
                    }
                    header("Location: " . BASE_URL);
                } catch (\Exception $e) {
                    $_SESSION['error'] = "Error al cambiar la contraseña: " . $e->getMessage();
                }

          }
          else{
            $_SESSION['falloDatos'] = 'fallo';
          }
        }
    }
}
