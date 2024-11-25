<?php
namespace Controllers;

class FrontController {
    public static function main(): void {
        $nombre_controlador = isset($_GET['controller']) 
            ? 'Controllers\\' . $_GET['controller'] . 'Controller' 
            : 'Controllers\\' . CONTROLLER_DEFAULT;

        if (class_exists($nombre_controlador)) {
            $controlador = new $nombre_controlador();

            if (isset($_GET['action']) && method_exists($controlador, $_GET['action'])) {
                $action = $_GET['action'];
                $controlador->$action();
            } 
            else {
                echo "Bienvenido al sitio web. Selecciona una acción.";
            }
        } else {
            echo ErrorController::show_error404();
        }
    }
}
