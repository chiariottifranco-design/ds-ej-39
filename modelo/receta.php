<?php
require_once __DIR__ . '/../core/Database.php';

class Receta {
    private const NOMBRE_CLASE = 'Receta';
    
    public $Id;
    public $Nombre;
    public $Ingrediente;
    public $TiempoPreparacion;
    public $Porciones;
    public $Dificultad;
    public $Calorias;

    public function __construct() {
        // Constructor vacío para que FETCH_CLASS funcione correctamente
    }

    /**
     * Obtener todas las personas desde la BD
     * Usando FETCH_CLASS para mapear automáticamente a objetos Persona (ORM)
     */
    public static function obtenerTodas() {
        try {
            $db = Database::getInstance()->getConnection();
            $stmt = $db->prepare('SELECT Id, Nombre, Ingrediente, TiempoPreparacion, Porciones, Dificultad, Calorias FROM recetas ORDER BY Id DESC');
            $stmt->execute();
            
            // PDO mapea automáticamente las columnas a las propiedades de la clase
            return $stmt->fetchAll(PDO::FETCH_CLASS, self::NOMBRE_CLASE);
        } catch (PDOException $e) {
            error_log("Error al obtener recetas: " . $e->getMessage());
            return [];
        }
    }

    /**
     * Obtener una persona por ID
     * Usando FETCH_CLASS para mapear automáticamente a objeto Persona (ORM)
     */
    public static function obtenerPorId($Id) {
        try {
            $db = Database::getInstance()->getConnection();
            $stmt = $db->prepare('SELECT Id, Nombre, Ingrediente, TiempoPreparacion, Porciones, Dificultad, Calorias FROM recetas WHERE Id = :id');
            $stmt->execute([':id' => $Id]);
            
            // PDO mapea automáticamente las columnas a las propiedades de la clase
            $stmt->setFetchMode(PDO::FETCH_CLASS, self::NOMBRE_CLASE);
            return $stmt->fetch();
        } catch (PDOException $e) {
            error_log("Error al obtener receta: " . $e->getMessage());
            return null;
        }
    }

    /**
     * Agregar una nueva persona
     */
    public static function agregar($Nombre, $Ingrediente, $TiempoPreparacion, $Porciones, $Dificultad, $Calorias) {
        try {
            $db = Database::getInstance()->getConnection();
            $stmt = $db->prepare('INSERT INTO recetas (Nombre, Ingrediente, TiempoPreparacion, Porciones, Dificultad, Calorias) VALUES (:nombre, :ingrediente, :tiempoPreparacion, :porciones, :dificultad, :calorias)');
            
            return $stmt->execute([
                ':nombre' => $Nombre,
                ':ingrediente' => $Ingrediente,
                ':tiempoPreparacion' => $TiempoPreparacion,
                ':porciones' => $Porciones,
                ':dificultad' => $Dificultad,
                ':calorias' => $Calorias
            ]);
        } catch (PDOException $e) {
            error_log("Error al agregar receta: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Editar una persona existente
     */
    public static function editar($Id, $Nombre, $Ingrediente, $TiempoPreparacion, $Porciones, $Dificultad, $Calorias) {
        try {
            $db = Database::getInstance()->getConnection();
            $stmt = $db->prepare('UPDATE recetas SET Nombre = :nombre, Ingrediente = :ingrediente, TiempoPreparacion = :tiempoPreparacion, Porciones = :porciones, Dificultad = :dificultad, Calorias = :calorias WHERE Id = :id');
            
            return $stmt->execute([
                ':id' => $Id,
                ':nombre' => $Nombre,
                ':ingrediente' => $Ingrediente,
                ':tiempoPreparacion' => $TiempoPreparacion,
                ':porciones' => $Porciones,
                ':dificultad' => $Dificultad,
                ':calorias' => $Calorias
            ]);
        } catch (PDOException $e) {
            error_log("Error al editar receta: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Eliminar una persona
     */
    public static function eliminar($Id) {
        try {
            $db = Database::getInstance()->getConnection();
            $stmt = $db->prepare('DELETE FROM recetas WHERE Id = :id');
            
            return $stmt->execute([':id' => $Id]);
        } catch (PDOException $e) {
            error_log("Error al eliminar receta: " . $e->getMessage());
            return false;
        }
    }
}
?>
