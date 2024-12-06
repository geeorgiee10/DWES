<?php

namespace Services;

use Models\Ruta;
use Repositories\RutaRepository;

class RutaService {
    private RutaRepository $repository;

    public function __construct() {
        $this->repository = new RutaRepository();
    }

    // Método que llama al repository para guardar una ruta en la base de datos
    public function guardarRuta(array $rutaDatos): bool|string {
        try {
            $ruta = new Ruta(null,
                $rutaDatos['titulo'],
                $rutaDatos['descripcion'],
                $rutaDatos['desnivel'],
                $rutaDatos['distancia'],
                $rutaDatos['notas'],
                $rutaDatos['dificultad']
            );

            return $this->repository->guardarRuta($ruta);
        } 
        catch (\Exception $e) {
            error_log("Error al guardar la ruta: " . $e->getMessage());
            return false;
        }
    }

    // Método que llama a repository para ver todas las rutas
    public function obtenerRutas(): array {
        return $this->repository->obtenerRutas();
    }

    // Método que llama a repository para obtener el número total de rutas
    public function contarRutas(): int {
        return $this->repository->contarRutas();
    }

    // Método que llama a repository para obtener la distancia de la ruta más larga
    public function rutaMasLarga(): int {
        return $this->repository->rutaMasLarga();
    }

    // Método que llama a repository para buscar una ruta por campo y valor
    public function buscarRuta(string $campo, string $elementoABuscar): array {
        return $this->repository->buscarRuta($campo, $elementoABuscar);
    }

    // Método que llama a repository para obtener la ruta a comentar
    public function rutaAComentar(int $id): array {
        return $this->repository->rutaAComentar($id);
    }

}