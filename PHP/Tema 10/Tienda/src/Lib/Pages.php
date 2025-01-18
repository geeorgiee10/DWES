<?php 

    namespace Lib;
    /**
     * Clase utilizada para renderizar las distintas vistas
     */
    class Pages{
        /**
         * Metodo que renderiza las vista que se le indica
         * @var string string con el nombre y ubicacion de la vista
         * @var array array con los parametros a pasarle a la vista
         * @return void
         */
        public function render (string $pageName, array $params = null): void{
            if($params != null){
                foreach($params as $name => $value){
                    $$name = $value;
                }
            }

            $arriba = dirname(__DIR__, 1);

            require_once $arriba . "/Views/layout/header.php";
            require_once $arriba . "/Views/$pageName.php";
            require_once $arriba . "/Views/layout/footer.php";
        }
    }

