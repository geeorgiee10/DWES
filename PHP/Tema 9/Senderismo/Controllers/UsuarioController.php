<?php

namespace Controllers;

use Lib\Pages;
use Models\Usuario;
use Services\UsuarioService;



class UsuarioController {

    private Pages $pages;
    private UsuarioService $usuarioService;
    

    public function __construct() {
        $this->pages = new Pages();
        $this->usuarioService = new UsuarioService();
    }

    // Método que llama al formulario para registrar usuarios
    public function formularioRegistro() {
        $this->pages->render('Usuario/registro');
    }

    public function formularioRegistroAdmin() {
        $this->pages->render('Usuario/registroAdmin');
    }

    // Método para registrarse
    public function registrar() {
        //Obtener datos formularios, sanetizarlos y validarlos
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Crear instancia de Usuario con los datos del POST
            $usuario = new Usuario(
                null,
                $_POST['nombre'],
                $_POST['apellidos'],
                $_POST['email'],
                $_POST['direccion'],
                $_POST['telefono'],
                $_POST['fecha_nacimiento'],
                $_POST['nombre_usuario'],
                $_POST['contrasena'],
                "usur"
            );

            // Sanitizar datos
            $usuario->sanitizarDatos();

            // Validar datos
            $errores = $usuario->validarDatosRegistro();

            // Validar que las contraseñas coincidan
            if($_POST['contrasena'] !== $_POST['confirmar_contrasena']){
                $errores['confirmar_contrasena'] = "Las contraseñas no son iguales";
            }

            if (empty($errores)) {
                // Cifrar la contraseña
                $contrasena_segura = password_hash($usuario->getContrasena(), PASSWORD_BCRYPT, ['cost' => 10]);
                $usuario->setContrasena($contrasena_segura);

                $userData = [
                    'nombre' => $usuario->getNombre(),
                    'apellidos' => $usuario->getApellidos(),
                    'correo' => $usuario->getCorreo(),
                    'direccion' => $usuario->getDireccion(),
                    'telefono' => $usuario->getTelefono(),
                    'fecha_nacimiento' => $usuario->getFechaNacimiento(),
                    'nombre_usuario' => $usuario->getNombreUsuario(),
                    'contrasena' => $contrasena_segura,
                    'rol' => $usuario->getRol()
                ];

                $resultado = $this->usuarioService->guardarUsuarios($userData);

                if ($resultado === true) {
                    header("Location: " . BASE_URL);
                    exit;
                } else {
                    $errores['db'] = "Error al registrar al usuario: " . $resultado;
                    $this->pages->render('Usuario/registro', ["errores" => $errores]);
                }
            } else {
                $this->pages->render('Usuario/registro', ["errores" => $errores]);
            }
        }
    }

    public function registrarAdmin() {
        //Obtener datos formularios, sanetizarlos y validarlos
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Crear instancia de Usuario con los datos del POST
            $usuario = new Usuario(
                null,
                $_POST['nombre'],
                $_POST['apellidos'],
                $_POST['email'],
                $_POST['direccion'],
                $_POST['telefono'],
                $_POST['fecha_nacimiento'],
                $_POST['nombre_usuario'],
                $_POST['contrasena'],
                $_POST['rol']
            );

            // Sanitizar datos
            $usuario->sanitizarDatos();

            // Validar datos
            $errores = $usuario->validarDatosRegistro();

            // Validar que las contraseñas coincidan
            if($_POST['contrasena'] !== $_POST['confirmar_contrasena']){
                $errores['confirmar_contrasena'] = "Las contraseñas no son iguales";
            }

            if (empty($errores)) {
                // Cifrar la contraseña
                $contrasena_segura = password_hash($usuario->getContrasena(), PASSWORD_BCRYPT, ['cost' => 10]);
                $usuario->setContrasena($contrasena_segura);

                $userData = [
                    'nombre' => $usuario->getNombre(),
                    'apellidos' => $usuario->getApellidos(),
                    'correo' => $usuario->getCorreo(),
                    'direccion' => $usuario->getDireccion(),
                    'telefono' => $usuario->getTelefono(),
                    'fecha_nacimiento' => $usuario->getFechaNacimiento(),
                    'nombre_usuario' => $usuario->getNombreUsuario(),
                    'contrasena' => $contrasena_segura,
                    'rol' => $usuario->getRol()
                ];

                $resultado = $this->usuarioService->guardarUsuarios($userData);

                if ($resultado === true) {
                    header("Location: " . BASE_URL);
                    exit;
                } 
                else {
                    $errores['db'] = "Error al registrar al usuario: " . $resultado;
                    $this->pages->render('Usuario/registroAdmin', ["errores" => $errores]);
                }
            } 
            else {
                $this->pages->render('Usuario/registroAdmin', ["errores" => $errores]);
            }
        }
    }

    // Método que llama al formulario para iniciar sesión
    public function formularioInicioSesion() {
        $this->pages->render('Usuario/iniciaSesion');
    }

    // Método para iniciar sesión
    public function iniciarSesion() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        $errores = [];
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $correo = $_POST['correo'];
            $contrasenaInicioSesion = $_POST['contrasena'];

            // Crear objeto Usuario con los datos para iniciar sesión
            $usuario = new Usuario( null, "", "", $correo, "", "", "", "", $contrasenaInicioSesion, "");

            // Sanitizar datos
            $usuario->sanitizarDatos();

            // Validar datos
            $errores = $usuario->validarDatosLogin();

            // Si no hay errores volver a inicio si hay mostrarlos en el formulario
            if (empty($errores)) {
                $resultado = $this->usuarioService->iniciarSesion($usuario->getCorreo(), $usuario->getContrasena());
    
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
            $this->pages->render('Usuario/iniciaSesion', ["errores" => $errores]);
        }
        
        
    }


    // Método para cerrar sesión
    public function logout() {
        session_start();
        session_unset();
        session_destroy();
        header("Location: " .BASE_URL);
        exit;
    }

    // Método para ver los datos del usuario que esta logueado
    public function verTusDatos(){
        if(session_status() === PHP_SESSION_NONE){
            session_start();
        }
        // Pasar datos guardados en la sesión
        $usuActual = $_SESSION['usuario'];

        $this->pages->render("Usuario/datosUsuario", ["usuario" => $usuActual]);
    }

    // Método que llama al formulario para editar datos propios
    public function formularioMisDatos(){
        if(session_status() === PHP_SESSION_NONE){
            session_start();
        }
        $usuActual = $_SESSION['usuario'];

        $this->pages->render("Usuario/formEditDatos", ["usuario" => $usuActual]);
    }

    // Método para actualizar datos
    public function actualizarDatos() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Crear instancia de Usuario con los datos del POST
            $usuario = new Usuario(
                $_POST['id'],
                $_POST['nombre'],
                $_POST['apellidos'],
                $_POST['email'],
                $_POST['direccion'],
                $_POST['telefono'],
                $_POST['fecha_nacimiento'],
                $_POST['nombre_usuario'],
                "",
                ""
            );

            $origen = $_POST['origen'];

            // Sanitizar datos
            $usuario->sanitizarDatos();

            // Validar datos
            $errores = $usuario->validarDatosEdicion();

            if($origen != "formEditAdminDatos" && $origen != "formEditDatos"){
                $errores["origen"] = "El origen no es valido";
            }
    
            if (count($errores) > 0) {
                if($origen === "formEditAdminDatos") {
                    $this->pages->render('Usuario/formEditAdminDatos', ['usuario' => $_POST, 'errores' => $errores]);
                } 
                else {
                    $this->pages->render('Usuario/formEditDatos', ['usuario' => $_POST, 'errores' => $errores]);
                }
                return;
            }
    
            $userData = [
                'id' => $usuario->getId(),
                'nombre' => $usuario->getNombre(),
                'apellidos' => $usuario->getApellidos(),
                'correo' => $usuario->getCorreo(),
                'direccion' => $usuario->getDireccion(),
                'telefono' => $usuario->getTelefono(),
                'fecha_nacimiento' => $usuario->getFechaNacimiento(),
                'nombre_usuario' => $usuario->getNombreUsuario()
            ];

            $resultado = $this->usuarioService->actualizar($userData);
    
            if ($resultado > 0) {
                $usu = $this->usuarioService->obtenerUsuarioPorId($usuario->getId());
                $_SESSION['usuario'] = $usu;
                $usuModificado = $_SESSION["usuario"];

                if($origen === "formEditAdminDatos"){
                    $usuarios = $this->usuarioService->obtenerTodosUsuarios();
                    $this->pages->render("Usuario/verUsuarios", ["usuarios" => $usuarios]);
                }
                else{
                    $this->pages->render("Usuario/datosUsuario", ["usuario" => $usuModificado]);
                }
                exit;
            } 
            else {
                // Si no se pudo actualizar los datos te redirije a una pagina u otra dependiendo de donde vengas
                $error = 'No se ha podido actualizar los datos del usuario';
                if($origen === "formEditAdminDatos") {
                    $this->pages->render('Usuario/formEditAdminDatos', ['usuario' => $userData, 'error' => $error]);
                } 
                else {
                    $this->pages->render('Usuario/formEditDatos', ['usuario' => $userData, 'error' => $error]);
                }
            }
        }
    }

    // Método para mostrar todos los usuarios (solo administradores)
    public function verUsuarios() {
        if(session_status() === PHP_SESSION_NONE){
            session_start();
        }

        $usuarios = $this->usuarioService->obtenerTodosUsuarios();
        $this->pages->render('Usuario/verUsuarios', ["usuarios" => $usuarios]);
    }

    // Método que llama al formulario para editar datos desde el panel de administrador
    public function formDatosAdmin() {
        if(session_status() === PHP_SESSION_NONE){
            session_start();
        }
        
        if (isset($_POST['id'])) {
            $id = $_POST['id'];
            $usuario = $this->usuarioService->obtenerUsuarioPorId($id);
            
            if ($usuario) {
                $this->pages->render('Usuario/formEditAdminDatos', ['usuario' => $usuario]);
            } 
            else {
                header('Location: /Senderismo/Usuario/verUsuarios');
            }
        } 
        else {
            header('Location: /Senderismo/Usuario/verUsuarios');
        }
    }
}
