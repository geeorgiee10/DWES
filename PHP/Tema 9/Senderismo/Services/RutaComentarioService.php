<?php

namespace Services;


use Models\RutaComentario;
use Repositories\RutaComentarioRepository;

class RutaComentarioService {
    private RutaComentarioRepository $repository;

    public function __construct() {
        $this->repository = new RutaComentarioRepository();
    }

    // Método que llama al repository para guardar un comentario en la base de datos
    public function guardarComentario(array $rutaComentarioDatos): bool|string {
        try {
            $rutaComentario = new RutaComentario(null,
                $rutaComentarioDatos['id_ruta'],
                $rutaComentarioDatos['nombre'],
                $rutaComentarioDatos['texto'],
                $rutaComentarioDatos['fecha'],
                $rutaComentarioDatos['usuarioID']
            );

            return $this->repository->guardarComentario($rutaComentario);
        } 
        catch (\Exception $e) {
            error_log("Error al guardar la ruta: " . $e->getMessage());
            return false;
        }
    }

    // Método que llama a repository para obtener los datos para comprobar el comentario diario
    public function comentarioDiario(): array {
        return $this->repository->comentarioDiario();
    }

    // Método que llama a repository para ver todos los comentarios
    public function obtenerComentarios(): array {
        return $this->repository->obtenerComentarios();
    }

    // Método que llama a repository para obtener los comentarios de la ruta a comentar
    public function comentariosRutaAComentar(int $id): array {
        return $this->repository->comentariosRutaAComentar($id);
    }
}