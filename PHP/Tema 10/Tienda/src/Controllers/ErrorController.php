<?php 

namespace Controllers;
use Lib\Pages;

/**
 * Clase para mostrar un mensaje de error relacionado con las rutas
 */
class ErrorController{

    /**
     * Si no se encuentra la ruta muestra un mensaje de error
     *  y renderiza la vista
     * @return void
     */
    public static function error404(){
        $pages = new Pages();
        $pages->render('error/error404',['titulo' => 'Página no encontrada']);
    }

}