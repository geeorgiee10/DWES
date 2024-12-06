<?php

namespace Controllers;

use Lib\Pages;
use Models\Ruta;
use Services\RutaService;
use Services\RutaComentarioService;
use Zebra_Pagination;


class RutaController {
    private Pages $pages;
    private RutaService $rutaService;
    private RutaComentarioService $rutaComentarioService;

    
    public function __construct() {
        $this->pages = new Pages();
        $this->rutaService = new RutaService();
        $this->rutaComentarioService = new RutaComentarioService;
    }

    // Método que llama al formulario para crear una nueva ruta
    public function formularioRuta() {
        $this->pages->render('Ruta/formularioRuta');
    }

    // Método para crear una nueva ruta
    public function añadirRuta() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $ruta = new Ruta(null,
                $_POST['titulo'],
                $_POST['descripcion'],
                $_POST['desnivel'],
                $_POST['distancia'] ?? 0,
                $_POST['notas'] ?? '',
                $_POST['dificultad'] ?? ''
            );

            // Sanitizar datos
            $ruta->sanitizarDatos();

            // Validar datos
            $errores = $ruta->validarDatosRegistro();

            if (empty($errores)) {
                $resultado = $this->rutaService->guardarRuta([
                    'titulo' => $ruta->getTitulo(),
                    'descripcion' => $ruta->getDescripcion(),
                    'desnivel' => $ruta->getDesnivel(),
                    'distancia' => $ruta->getDistancia() ?: 0,
                    'notas' => $ruta->getNotas() ?: '',
                    'dificultad' => $ruta->getDificultad() ?: ''
                ]);

                if ($resultado === true) {
                    header("Location: " . BASE_URL);
                    exit;
                } 
                else {
                    $errores['db'] = "Error al crear la ruta: " . $resultado;
                    $this->pages->render('Ruta/formularioRuta', ["errores" => $errores]);
                }
            }
            else{
                $this->pages->render('Ruta/formularioRuta', ["errores" => $errores]);
            }
        }
    }

    // Método que muestra la página de inicio con los datos de las rutas y su paginación
    
    public function inicio() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Configurar la paginación
        $paginacion = new \Zebra_Pagination();
        $rutas = $this->rutaService->obtenerRutas();
        $numeroRutas = count($rutas);
        
        
        $numero_elementos_pagina = 3;
        
        $paginacion->records($numeroRutas);
        $paginacion->records_per_page($numero_elementos_pagina);

        $rutas_con_paginacion = array_slice(
            $rutas, 
            (($paginacion->get_page() - 1) * $numero_elementos_pagina), 
            $numero_elementos_pagina
        );

        $comentarios = $this->rutaComentarioService->obtenerComentarios();

        $this->pages->render('inicio', [
            'rutas' => $rutas_con_paginacion,
            'paginacion' => $paginacion,
            'comentarios' => $comentarios
        ]);
    }

    // Método para ver listar todas las rutas (lo que hace en realidad es poner 5 por página en vez de 3)
    public function listadoCompleto() {
        $paginacion = new \Zebra_Pagination();
        $rutas = $this->rutaService->obtenerRutas();
        $numeroRutas = count($rutas);
    
        $numero_elementos_pagina = 5;

        $paginacion->records($numeroRutas);
        $paginacion->records_per_page($numero_elementos_pagina);

        $rutas_con_paginacion = array_slice(
            $rutas, 
            (($paginacion->get_page() - 1) * $numero_elementos_pagina), 
            $numero_elementos_pagina
        );

        $rutaMasLarga = $this->rutaService->rutaMasLarga();

        $comentarios = $this->rutaComentarioService->obtenerComentarios();

        $this->pages->render('inicio', [
            'rutas' => $rutas_con_paginacion,
            'paginacion' => $paginacion,
            'numRutas' => $numeroRutas,
            'rutaMasLarga' => $rutaMasLarga,
            'comentarios' => $comentarios
        ]);
    }

    // Método para buscar una ruta por campo y valor
    public function buscarRuta() {
        $paginacion = new \Zebra_Pagination();
        
        if (isset($_GET['campo']) && isset($_GET['buscador'])) {
            $campo = $_GET['campo'];
            $elementoABuscar = $_GET['buscador'];

            $ruta = new Ruta();
            $ruta->setCampo($campo);
            $ruta->setElementoABuscar($elementoABuscar);

            $ruta->sanitizarDatosBusqueda();

            $errores = $ruta->validarDatosBusqueda();

            $rutas = $this->rutaService->buscarRuta($ruta->getCampo(), $ruta->getElementoABuscar());
    
            $numero_elementos_pagina = 3;

            $paginacion->records(count($rutas));
            $paginacion->records_per_page($numero_elementos_pagina);
            $paginacion->base_url(BASE_URL . 'Ruta/buscarRuta?campo=' . urlencode($campo) . '&buscador=' . urlencode($elementoABuscar));

            $rutas_con_paginacion = array_slice(
                $rutas, 
                (($paginacion->get_page() - 1) * $numero_elementos_pagina), 
                $numero_elementos_pagina
            );

            $comentarios = $this->rutaComentarioService->obtenerComentarios();


            $this->pages->render('inicio', [
                'rutas' => $rutas_con_paginacion,
                'paginacion' => $paginacion,
                'errores' => $errores,
                'comentarios' => $comentarios
            ]);
        }
    }

}