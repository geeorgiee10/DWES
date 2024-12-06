<?php

namespace Repositories;

use Lib\BaseDatos;
use Models\RutaComentario;
use PDO;
use PDOException;

class RutaComentarioRepository {
    private BaseDatos $conexion;

    public function __construct() {
        $this->conexion = new BaseDatos();
    }

    // Método para guardar un comentario en la base de datos
    public function guardarComentario(RutaComentario $rutaComentario): bool|string {
        try {
            $stmt = $this->conexion->prepare(
                "INSERT INTO rutas_comentarios (id_ruta, nombre, texto, fecha, usuarioID)
                 VALUES (:id_ruta, :nombre, :texto, :fecha, :usuarioID)"
            );

            $stmt->bindValue(':id_ruta', $rutaComentario->getIdRuta(), PDO::PARAM_INT);
            $stmt->bindValue(':nombre', $rutaComentario->getNombre(), PDO::PARAM_STR);
            $stmt->bindValue(':texto', $rutaComentario->getTexto(), PDO::PARAM_STR);
            $stmt->bindValue(':fecha', $rutaComentario->getFecha(), PDO::PARAM_STR);
            $stmt->bindValue(':usuarioID', $rutaComentario->getIdUsuario(), PDO::PARAM_INT);

            $stmt->execute();
            return true;
        } 
        catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    // Método para obtrener campos para controlar que solo haya un comentario diario a una ruta
    public function comentarioDiario(): array {
        try {
            $stmt = $this->conexion->prepare("SELECT id_ruta, fecha, usuarioID FROM rutas_comentarios");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
        } catch (PDOException $e) {
            error_log("Error al obtener las rutas: " . $e->getMessage());
            return [];
        }
    }

    // Método para obtener los comentarios de la ruta que se va a comentar
    public function comentariosRutaAComentar(int $rutaID): array {
        try {
            $stmt = $this->conexion->prepare("SELECT * FROM rutas_comentarios WHERE id_ruta = :rutaID ORDER BY fecha DESC");
            $stmt->bindValue(":rutaID", $rutaID, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error al obtener la ruta: " . $e->getMessage());
            return [];
        }
    }

    // Método para obtener un comentario de la base de datos
    public function obtenerComentarios(): array {
        try {
            $stmt = $this->conexion->prepare("SELECT * FROM rutas_comentarios");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
        } catch (PDOException $e) {
            error_log("Error al obtener los comentarios: " . $e->getMessage());
            return [];
        }
    }

}