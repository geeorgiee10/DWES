<?php

namespace Repositories;

use Lib\BaseDatos;
use Models\Ruta;
use PDO;
use PDOException;

class RutaRepository {
    private BaseDatos $conexion;

    public function __construct() {
        $this->conexion = new BaseDatos();
    }

    // Método para guardar una nueva ruta en la base de datos
    public function guardarRuta(Ruta $ruta): bool|string {
        try {
            $stmt = $this->conexion->prepare(
                "INSERT INTO rutas (titulo, descripcion, desnivel, distancia, notas, dificultad)
                 VALUES (:titulo, :descripcion, :desnivel, :distancia, :notas, :dificultad)"
            );

            $stmt->bindValue(':titulo', $ruta->getTitulo(), PDO::PARAM_STR);
            $stmt->bindValue(':descripcion', $ruta->getDescripcion(), PDO::PARAM_STR);
            $stmt->bindValue(':desnivel', $ruta->getDesnivel(), PDO::PARAM_INT);
            $stmt->bindValue(':distancia', number_format($ruta->getDistancia(), 2, '.', ''), PDO::PARAM_STR);
            $stmt->bindValue(':notas', $ruta->getNotas(), PDO::PARAM_STR);
            $stmt->bindValue(':dificultad', $ruta->getDificultad(), PDO::PARAM_STR);

            $stmt->execute();
            return true;
        } 
        catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    // Método que obtiene todas las rutas de la base de datos
    public function obtenerRutas(): array {
        try {
            $stmt = $this->conexion->prepare("SELECT * FROM rutas");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
        } catch (PDOException $e) {
            error_log("Error al obtener las rutas: " . $e->getMessage());
            return [];
        }
    }

    // Método para obtener el total de rutas
    public function contarRutas(): int {
        try {
            $stmt = $this->conexion->prepare("SELECT COUNT(*) FROM rutas");
            return (int)$stmt->fetchColumn();
        } catch (PDOException $e) {
            error_log("Error al contar las rutas: " . $e->getMessage());
            return 0;
        }
    }

    // Método para obtener los km de la ruta más larga
    public function rutaMasLarga(): float {
        try {
            $stmt = $this->conexion->prepare("SELECT distancia FROM rutas ORDER BY distancia DESC limit 1");
            $stmt->execute();
            return $stmt->fetchColumn();
        } catch (PDOException $e) {
            error_log("Error al obtener las rutas: " . $e->getMessage());
            return [];
        }
    }

    // Método para buscar una ruta por campo y valor
    public function buscarRuta(string $campo, string $elementoABuscar): array {
        try {
            $campos = ["titulo", "descripcion", "desnivel", "distancia", "notas", "dificultad"];

            if(!in_array($campo , $campos)){
                error_log("Error, el campo introducido no se encuentra en la base de datos");
            }
            $stmt = $this->conexion->prepare("SELECT * FROM rutas WHERE $campo LIKE :elementoABuscar");
            $stmt->bindValue(":elementoABuscar", "%" . $elementoABuscar . "%", PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error al obtener las rutas: " . $e->getMessage());
            return [];
        }
    }

    // Método para obtener la ruta que se va a comentar
    public function rutaAComentar(int $idRuta): array {
        try {
            $stmt = $this->conexion->prepare("SELECT * FROM rutas WHERE id = :rutaID");
            $stmt->bindValue(":rutaID", $idRuta, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error al obtener la ruta: " . $e->getMessage());
            return [];
        }
    }

}