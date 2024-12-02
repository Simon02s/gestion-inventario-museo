<?php

class Catalogacion {
    private $conn;
    private $table_name = "catalogacion";

    public $nombre_institucion;
    public $numero_inventario;
    public $numero_inventario_anterior;
    public $registro_provisorio;
    public $catalogacion_clasificacion;
    public $coleccion_tipologia;
    public $nombre_objeto;
    public $titulo;
    public $descripcion;
    public $autor_fabricante_cultura;
    public $marco_historico;
    public $lugar_ejecucion;
    public $fecha_ejecucion_periodo;
    public $material;
    public $tecnica;
    public $inscripciones_marcas;
    public $dimensiones;
    public $dimensiones_complementarias;
    public $peso;
    public $duracion;
    public $talla;
    public $bibliografia_referencia;
    public $estado_conservacion_objeto;
    public $estado_conservacion_complementarios;
    public $reparaciones_intervenciones;
    public $forma_ingreso;
    public $norma_legal_ingreso;
    public $norma_legal_baja;
    public $motivo_baja;
    public $fecha_baja;
    public $procedencia;
    public $numero_legal_ingreso;
    public $responsable_ingreso;
    public $restriccion_uso;
    public $marcaje;
    public $ubicacion;
    public $ubicacion_actual;
    public $fotografia;
    public $restriccion_imagen;

    // Constructor con la conexión
    public function __construct($db) {
        $this->conn = $db;
    }

    // Método para guardar un registro
    public function guardar() {
        $query = "INSERT INTO " . $this->table_name . " 
                  SET nombre_institucion=:nombre_institucion, 
                      numero_inventario=:numero_inventario,
                      numero_inventario_anterior=:numero_inventario_anterior,
                      registro_provisorio=:registro_provisorio,
                      catalogacion_clasificacion=:catalogacion_clasificacion,
                      coleccion_tipologia=:coleccion_tipologia,
                      nombre_objeto=:nombre_objeto,
                      titulo=:titulo,
                      descripcion=:descripcion,
                      autor_fabricante_cultura=:autor_fabricante_cultura,
                      marco_historico=:marco_historico,
                      lugar_ejecucion=:lugar_ejecucion,
                      fecha_ejecucion_periodo=:fecha_ejecucion_periodo,
                      material=:material,
                      tecnica=:tecnica,
                      inscripciones_marcas=:inscripciones_marcas,
                      dimensiones=:dimensiones,
                      dimensiones_complementarias=:dimensiones_complementarias,
                      peso=:peso,
                      duracion=:duracion,
                      talla=:talla,
                      bibliografia_referencia=:bibliografia_referencia,
                      estado_conservacion_objeto=:estado_conservacion_objeto,
                      estado_conservacion_complementarios=:estado_conservacion_complementarios,
                      reparaciones_intervenciones=:reparaciones_intervenciones,
                      forma_ingreso=:forma_ingreso,
                      norma_legal_ingreso=:norma_legal_ingreso,
                      norma_legal_baja=:norma_legal_baja,
                      motivo_baja=:motivo_baja,
                      fecha_baja=:fecha_baja,
                      procedencia=:procedencia,
                      numero_legal_ingreso=:numero_legal_ingreso,
                      responsable_ingreso=:responsable_ingreso,
                      restriccion_uso=:restriccion_uso,
                      marcaje=:marcaje,
                      ubicacion=:ubicacion,
                      ubicacion_actual=:ubicacion_actual,
                      fotografia=:fotografia,
                      restriccion_imagen=:restriccion_imagen";

        $stmt = $this->conn->prepare($query);

        // Vincular parámetros
        $stmt->bindParam(':nombre_institucion', $this->nombre_institucion);
        $stmt->bindParam(':numero_inventario', $this->numero_inventario);
        $stmt->bindParam(':numero_inventario_anterior', $this->numero_inventario_anterior);
        $stmt->bindParam(':registro_provisorio', $this->registro_provisorio);
        $stmt->bindParam(':catalogacion_clasificacion', $this->catalogacion_clasificacion);
        $stmt->bindParam(':coleccion_tipologia', $this->coleccion_tipologia);
        $stmt->bindParam(':nombre_objeto', $this->nombre_objeto);
        $stmt->bindParam(':titulo', $this->titulo);
        $stmt->bindParam(':descripcion', $this->descripcion);
        $stmt->bindParam(':autor_fabricante_cultura', $this->autor_fabricante_cultura);
        $stmt->bindParam(':marco_historico', $this->marco_historico);
        $stmt->bindParam(':lugar_ejecucion', $this->lugar_ejecucion);
        $stmt->bindParam(':fecha_ejecucion_periodo', $this->fecha_ejecucion_periodo);
        $stmt->bindParam(':material', $this->material);
        $stmt->bindParam(':tecnica', $this->tecnica);
        $stmt->bindParam(':inscripciones_marcas', $this->inscripciones_marcas);
        $stmt->bindParam(':dimensiones', $this->dimensiones);
        $stmt->bindParam(':dimensiones_complementarias', $this->dimensiones_complementarias);
        $stmt->bindParam(':peso', $this->peso);
        $stmt->bindParam(':duracion', $this->duracion);
        $stmt->bindParam(':talla', $this->talla);
        $stmt->bindParam(':bibliografia_referencia', $this->bibliografia_referencia);
        $stmt->bindParam(':estado_conservacion_objeto', $this->estado_conservacion_objeto);
        $stmt->bindParam(':estado_conservacion_complementarios', $this->estado_conservacion_complementarios);
        $stmt->bindParam(':reparaciones_intervenciones', $this->reparaciones_intervenciones);
        $stmt->bindParam(':forma_ingreso', $this->forma_ingreso);
        $stmt->bindParam(':norma_legal_ingreso', $this->norma_legal_ingreso);
        $stmt->bindParam(':norma_legal_baja', $this->norma_legal_baja);
        $stmt->bindParam(':motivo_baja', $this->motivo_baja);
        $stmt->bindParam(':fecha_baja', $this->fecha_baja);
        $stmt->bindParam(':procedencia', $this->procedencia);
        $stmt->bindParam(':numero_legal_ingreso', $this->numero_legal_ingreso);
        $stmt->bindParam(':responsable_ingreso', $this->responsable_ingreso);
        $stmt->bindParam(':restriccion_uso', $this->restriccion_uso);
        $stmt->bindParam(':marcaje', $this->marcaje);
        $stmt->bindParam(':ubicacion', $this->ubicacion);
        $stmt->bindParam(':ubicacion_actual', $this->ubicacion_actual);
        $stmt->bindParam(':fotografia', $this->fotografia);
        $stmt->bindParam(':restriccion_imagen', $this->restriccion_imagen);

        // Ejecutar consulta
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}
