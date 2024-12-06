<?php

namespace Controllers;

use Lib\Pages;
use Models\RutaComentario;
use Services\RutaComentarioService;
use Services\RutaService;

class RutaComentarioController {
    private Pages $pages;
    private RutaComentarioService $rutaComentarioService;
    private RutaService $rutaService;
    
    public function __construct() {
        $this->pages = new Pages();
        $this->rutaComentarioService = new RutaComentarioService();
        $this->rutaService = new RutaService();
    }

    // Método para mostrar el formulario de comentario
    public function formularioComentario() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $idRuta = $_POST['idRuta'];
            $usuarioID = $_POST['idUsuario'];

            $comentario = new RutaComentario(
                null,
                $idRuta,
                $_POST['nombreUsuario'],
                '',
                '',
                $usuarioID
            );
            
            $comentario->sanitizarOcultos();
            $errores = $comentario->validarOcultos();

            $rutaActual = $this->rutaService->rutaAComentar($idRuta);
            $comentariosRutaActual = $this->rutaComentarioService->comentariosRutaAComentar($idRuta);

            $datosComentarios = $this->rutaComentarioService->comentarioDiario();
            foreach($datosComentarios as $datosComentario) {

                if($datosComentario["id_ruta"] == $idRuta && $datosComentario["fecha"] == date("Y-m-d") && $datosComentario["usuarioID"] == $usuarioID){
                    $this->pages->render('RutaComentarios/comentarioDiario');
                    exit;
                }
                
            }
            if (!empty($errores)) {
                $this->pages->render('RutaComentarios/formComentar', [
                    "errores" => $errores,
                    "usuarioActual" => $comentario->getNombre(),
                    "idActual" => $comentario->getIdUsuario(),
                    "idRuta" => $comentario->getIdRuta(),
                    "rutaActual" => $rutaActual,
                    "comentariosRutaActual" => $comentariosRutaActual
                ]);
                return;
            }
            
            $this->pages->render('RutaComentarios/formComentar', [
                "usuarioActual" => $comentario->getNombre(),
                "idActual" => $comentario->getIdUsuario(),
                "idRuta" => $comentario->getIdRuta(),
                "rutaActual" => $rutaActual,
                "comentariosRutaActual" => $comentariosRutaActual
            ]);
        }
    }

    // Método para añadir un comentario a una ruta
    public function añadirComentarioARuta() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $rutaComentario = new RutaComentario(null,
                $_POST['id_ruta'],
                $_POST['nombre'],
                $_POST['texto'],
                $_POST['fecha'],
                $_POST['id_usuario']
            );

            $rutaComentario->sanitizar();

            $errores = $rutaComentario->validar();

            if (empty($errores)) {
                $resultado = $this->rutaComentarioService->guardarComentario([
                    'id_ruta' => $rutaComentario->getIdRuta(),
                    'nombre' => $rutaComentario->getNombre(),
                    'texto' => $rutaComentario->getTexto(),
                    'fecha' => $rutaComentario->getFecha(),
                    'usuarioID' => $rutaComentario->getIdUsuario(),
                ]);

                if ($resultado === true) {
                    header("Location: " . BASE_URL);
                    exit;
                } 
                else {
                    $errores['db'] = "Error al añadir el comentario: " . $resultado;
                    $this->pages->render('RutaComentarios/formComentar', ["errores" => $errores]);
                }
            }
            else{
                $this->pages->render('RutaComentarios/formComentar', ["errores" => $errores]);
            }
        }
    } 
}