<?php

namespace Lib;

/**
 * Clase utilidades
 */
class Utils {
    /**
     * Metodo que comprueba si el usuario logueado es administrador o no
     * @return void
     */
    public static function isAdmin() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        return isset($_SESSION['usuario']) && $_SESSION["usuario"]["rol"] === 'admin';
    }

    /**
     * Metodo que comprueba si la sesion esta iniciada
     * @return void
     */
    public static function isSession() {
        return isset($_SESSION['usuario']) && !empty($_SESSION['usuario']);
    }
}