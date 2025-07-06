<?php
require_once('modelo/datos.php');

class citas extends datos {
    // Propiedades de la tabla citas
    private $id;
    private $cita_contacto_id;
    private $cedula;
    private $cedula_representante;
    private $nombre;
    private $apellido;
    private $telefono;
    private $id_especialista;
    private $fecha_cita;
    private $hora_cita;
    private $estado_cita;
    private $fecha_registro; // `fecha_registro` tiene un valor por defecto `current_timestamp()` en la base de datos.

    // Propiedades para validación
    private $errores = array();

    // --- Setters ---
    public function set_id($valor) { $this->id = $valor; }
    public function set_cita_contacto_id($valor) { $this->cita_contacto_id = $valor; }
    public function set_cedula($valor) { $this->cedula = $valor; }
    public function set_cedula_representante($valor) { $this->cedula_representante = $valor; }
    public function set_nombre($valor) { $this->nombre = $valor; }
    public function set_apellido($valor) { $this->apellido = $valor; }
    public function set_telefono($valor) { $this->telefono = $valor; }
    public function set_id_especialista($valor) { $this->id_especialista = $valor; }
    public function set_fecha_cita($valor) { $this->fecha_cita = $valor; }
    public function set_hora_cita($valor) { $this->hora_cita = $valor; }
    public function set_estado_cita($valor) { $this->estado_cita = $valor; }

    // --- Getters ---
    public function get_id() { return $this->id; }
    public function get_cita_contacto_id() { return $this->cita_contacto_id; }
    public function get_cedula() { return $this->cedula; }
    public function get_cedula_representante() { return $this->cedula_representante; }
    public function get_nombre() { return $this->nombre; }
    public function get_apellido() { return $this->apellido; }
    public function get_telefono() { return $this->telefono; }
    public function get_id_especialista() { return $this->id_especialista; }
    public function get_fecha_cita() { return $this->fecha_cita; }
    public function get_hora_cita() { return $this->hora_cita; }
    public function get_estado_cita() { return $this->estado_cita; }
    public function get_fecha_registro() { return $this->fecha_registro; }

    // --- Métodos de Validación ---
    private function validarDatosCita($esModificacion = false) {
        $this->errores = array();
        $valido = true;

        // Validación de campos obligatorios para citas
        if (empty($this->nombre)) {
            $this->errores[] = "El nombre del cliente es obligatorio.";
            $valido = false;
        } else if (!preg_match("/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]{3,30}$/", $this->nombre)) {
            $this->errores[] = "El nombre del cliente debe contener solo letras (3-30 caracteres).";
            $valido = false;
        }

        if (empty($this->apellido)) {
            $this->errores[] = "El apellido del cliente es obligatorio.";
            $valido = false;
        } else if (!preg_match("/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]{3,30}$/", $this->apellido)) {
            $this->errores[] = "El apellido del cliente debe contener solo letras (3-30 caracteres).";
            $valido = false;
        }

        if (empty($this->motivo_cita)) {
            $this->errores[] = "El motivo de la cita es obligatorio.";
            $valido = false;
        } else if (strlen($this->motivo_cita) < 5 || strlen($this->motivo_cita) > 200) {
            $this->errores[] = "El motivo de la cita debe tener entre 5 y 200 caracteres.";
            $valido = false;
        }

        if (empty($this->id_especialista)) {
            $this->errores[] = "El doctor que atenderá es obligatorio.";
            $valido = false;
        } else if (strlen($this->id_especialista) < 3 || strlen($this->id_especialista) > 50) {
            $this->errores[] = "El nombre del doctor debe tener entre 3 y 50 caracteres.";
            $valido = false;
        }

        if (empty($this->fecha_cita)) {
            $this->errores[] = "La fecha de la cita es obligatoria.";
            $valido = false;
        } else if (!preg_match("/^\d{4}-\d{2}-\d{2}$/", $this->fecha_cita)) {
            $this->errores[] = "Formato de fecha de cita incorrecto (AAAA-MM-DD).";
            $valido = false;
        } else {
            // Validar que la fecha no sea anterior a hoy
            $hoy = new DateTime();
            $hoy->setTime(0, 0, 0);
            $fechaCita = new DateTime($this->fecha_cita);
            $fechaCita->setTime(0, 0, 0);
            
            if ($fechaCita < $hoy) {
                $this->errores[] = "La fecha de la cita no puede ser anterior a la fecha actual.";
                $valido = false;
            }
        }

        if (empty($this->hora_cita)) {
            $this->errores[] = "La hora de la cita es obligatoria.";
            $valido = false;
        } else if (!preg_match("/^\d{2}:\d{2}(:\d{2})?$/", $this->hora_cita)) {
            $this->errores[] = "Formato de hora de cita incorrecto (HH:MM).";
            $valido = false;
        }

        // Validación de cédulas (opcionales, pero si se proporcionan, deben ser válidas)
        if (!empty($this->cedula) && !preg_match("/^[0-9]{7,8}$/", $this->cedula)) {
            $this->errores[] = "Formato de cédula de cliente incorrecto (7 u 8 dígitos numéricos).";
            $valido = false;
        }
        if (!empty($this->cedula_representante) && !preg_match("/^[0-9]{7,8}$/", $this->cedula_representante)) {
            $this->errores[] = "Formato de cédula de representante incorrecto (7 u 8 dígitos numéricos).";
            $valido = false;
        }

        // Validación de teléfono (opcional, pero si se proporciona, debe tener el formato internacional)
        if (!empty($this->telefono) && (!preg_match("/^\+58\d{10}$/", $this->telefono))) {
            $this->errores[] = "El teléfono del cliente debe tener el formato internacional: +58 seguido de 10 dígitos (ejemplo: +584128287690).";
            $valido = false;
        }

        // Para modificación, el ID es obligatorio
        if ($esModificacion && empty($this->id)) {
            $this->errores[] = "El ID de la cita es obligatorio para modificar.";
            $valido = false;
        }

        return $valido;
    }

    // --- Métodos de Negocio (CRUD y lógicas específicas) ---

    // Incluir una nueva cita
    public function incluir() {
        $r = array();
        if (!$this->validarDatosCita()) {
            $r['resultado'] = 'error';
            $r['mensaje'] = implode(", ", $this->errores);
            return $r;
        }

        $co = $this->conecta();
        $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        try {
            $co->beginTransaction();

            $stmt = $co->prepare("INSERT INTO citas (
                cita_contacto_id, cedula, cedula_representante,
                nombre, apellido, telefono,id_especialista, fecha_cita, hora_cita, estado_cita
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

            $stmt->execute([
                $this->cita_contacto_id,
                $this->cedula,
                $this->cedula_representante,
                $this->nombre,
                $this->apellido,
                $this->telefono,
                $this->id_especialista,
                $this->fecha_cita,
                $this->hora_cita,
                'Pendiente' // Estado inicial por defecto
            ]);

            $this->registrarBitacora('Citas', 'Incluir', 'Se ha registrado una nueva cita.', json_encode([
                'id_cita' => $co->lastInsertId(),
                'nombre' => $this->nombre,
                'fecha_cita' => $this->fecha_cita,
                'hora_cita' => $this->hora_cita
            ]));

            // Si la cita se registró desde una solicitud de contacto, borrar lógicamente la solicitud
            if (!empty($this->cita_contacto_id)) {
                $stmt_contacto = $co->prepare("UPDATE citas_contacto SET estado = 'Registrada' WHERE id = ?");
                $stmt_contacto->execute([$this->cita_contacto_id]);
                $this->registrarBitacora('Citas Contacto', 'Procesar', 'Solicitud de cita de contacto procesada y registrada.', json_encode([
                    'id_cita_contacto' => $this->cita_contacto_id
                ]));
            }

            $co->commit();
            $r['resultado'] = 'ok';
            $r['mensaje'] = '¡Cita registrada con éxito!';
        } catch (Exception $e) {
            $co->rollBack();
            $r['resultado'] = 'error';
            $r['mensaje'] = 'Error al registrar la cita: ' . $e->getMessage();
        } finally {
            $co = null;
        }
        return $r;
    }

    // Modificar datos de una cita existente
    public function modificar() {
        $r = array();
        
        // Verificar si la cita existe antes de intentar modificarla
        if (!$this->existeCita($this->id)) {
            $r['resultado'] = 'error';
            $r['mensaje'] = 'La cita que intenta modificar no existe.';
            return $r;
        }

        if (!$this->validarDatosCita(true)) { // Pasar true para indicar que es una modificación
            $r['resultado'] = 'error';
            $r['mensaje'] = implode(", ", $this->errores);
            return $r;
        }

        $co = $this->conecta();
        $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        try {
            $co->beginTransaction();

            // Verificar si la cita está cancelada
            $stmt_check = $co->prepare("SELECT estado_cita FROM citas WHERE id = ?");
            $stmt_check->execute([$this->id]);
            $estado_actual = $stmt_check->fetchColumn();

            if ($estado_actual === 'Cancelada') {
                $r['resultado'] = 'error';
                $r['mensaje'] = 'No se puede modificar una cita cancelada.';
                return $r;
            }

            $stmt = $co->prepare("UPDATE citas SET
                cedula = ?, cedula_representante = ?,
                nombre = ?, apellido = ?, telefono = ?, id_especialista = ?, fecha_cita = ?, hora_cita = ?
                WHERE id = ?");

            $stmt->execute([
                $this->cedula,
                $this->cedula_representante,
                $this->nombre,
                $this->apellido,
                $this->telefono,
                $this->id_especialista,
                $this->fecha_cita,
                $this->hora_cita,
                $this->id
            ]);

            $this->registrarBitacora('Citas', 'Modificar', 'Se han modificado los datos de una cita.', json_encode([
                'id_cita' => $this->id,
                'nombre' => $this->nombre,
                'fecha_cita' => $this->fecha_cita
            ]));

            $co->commit();
            $r['resultado'] = 'ok';
            $r['mensaje'] = '¡Cita modificada con éxito!';
        } catch (Exception $e) {
            $co->rollBack();
            $r['resultado'] = 'error';
            $r['mensaje'] = 'Error al modificar la cita: ' . $e->getMessage();
        } finally {
            $co = null;
        }
        return $r;
    }

    // Cambiar el estado de una cita (Pendiente, Confirmada, Cancelada)
    public function cambiarEstado() {
        $r = array();
        if (empty($this->id) || empty($this->estado_cita)) {
            $r['resultado'] = 'error';
            $r['mensaje'] = 'ID de cita y nuevo estado son obligatorios para cambiar el estado.';
            return $r;
        }
        if (!in_array($this->estado_cita, ['Pendiente', 'Confirmada', 'Cancelada'])) {
            $r['resultado'] = 'error';
            $r['mensaje'] = 'Estado de cita no válido. Los estados permitidos son: Pendiente, Confirmada, Cancelada.';
            return $r;
        }

        $co = $this->conecta();
        $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        try {
            $co->beginTransaction();

            $stmt = $co->prepare("UPDATE citas SET estado_cita = ? WHERE id = ?");
            $stmt->execute([$this->estado_cita, $this->id]);

            $this->registrarBitacora('Citas', 'Cambiar Estado', 'Se ha cambiado el estado de una cita.', json_encode([
                'id_cita' => $this->id,
                'nuevo_estado' => $this->estado_cita
            ]));

            $co->commit();
            $r['resultado'] = 'ok';
            $r['mensaje'] = '¡Estado de cita actualizado a "' . $this->estado_cita . '" con éxito!';
        } catch (Exception $e) {
            $co->rollBack();
            $r['resultado'] = 'error';
            $r['mensaje'] = 'Error al cambiar el estado de la cita: ' . $e->getMessage();
        } finally {
            $co = null;
        }
        return $r;
    }

    // Consultar todas las citas registradas (ordenadas por fecha de registro)
    public function consultarCitasRegistradas($criterio = null) {
        $co = $this->conecta();
        $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $r = array();

        try {
            // Se incluye cedula_representante en la consulta
            $sql = "SELECT id, cedula, cedula_representante, nombre, apellido, telefono, id_especialista, fecha_cita, hora_cita, estado_cita, fecha_registro
                    FROM citas";
            $params = [];

            if (!empty($criterio)) {
                $sql .= " WHERE nombre LIKE ? OR apellido LIKE ? OR cedula LIKE ? OR cedula_representante LIKE ? OR id_especialista LIKE ? ";
                $params = ["%$criterio%", "%$criterio%", "%$criterio%", "%$criterio%", "%$criterio%", "%$criterio%"];
            }
            $sql .= " ORDER BY fecha_registro DESC"; // Ordenar por fecha de creación

            $stmt = $co->prepare($sql);
            $stmt->execute($params);
            $r = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            $r['resultado'] = 'error';
            $r['mensaje'] = $e->getMessage();
        } finally {
            $co = null;
        }
        return $r;
    }

    // Consultar solicitudes de citas de contacto (activas, no registradas o borradas lógicamente)
    public function consultarSolicitudesCitasContacto() {
        $co = $this->conecta();
        $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $r = array();

        try {
            // Asumo que agregaremos un campo 'estado' a citas_contacto para borrado lógico, similar a 'servicios'
            // Por ahora, si no existe, solo consulto todo
            $stmt = $co->prepare("SELECT id, nombre, apellido, telefono, fecha_envio
                                  FROM citas_contacto WHERE estado IS NULL OR estado = 'Pendiente' ORDER BY fecha_envio DESC");
            $stmt->execute();
            $r = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            $r['resultado'] = 'error';
            $r['mensaje'] = $e->getMessage();
        } finally {
            $co = null;
        }
        return $r;
    }

    // Borrado lógico de una solicitud de cita de contacto
    public function eliminarSolicitudCitaContacto() {
        $r = array();
        if (empty($this->id)) {
            $r['resultado'] = 'error';
            $r['mensaje'] = 'ID de solicitud de cita de contacto es obligatorio para borrar.';
            return $r;
        }

        $co = $this->conecta();
        $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        try {
            $co->beginTransaction();

            // Actualizar el estado de la solicitud a 'Borrada'
            $stmt = $co->prepare("UPDATE citas_contacto SET estado = 'Borrada' WHERE id = ?");
            $stmt->execute([$this->id]);

            $this->registrarBitacora('Citas Contacto', 'Eliminar', 'Se ha borrado lógicamente una solicitud de cita de contacto.', json_encode([
                'id_cita_contacto' => $this->id
            ]));

            $co->commit();
            $r['resultado'] = 'ok';
            $r['mensaje'] = '¡Solicitud de cita de contacto borrada con éxito!';
        } catch (Exception $e) {
            $co->rollBack();
            $r['resultado'] = 'error';
            $r['mensaje'] = 'Error al borrar la solicitud de cita de contacto: ' . $e->getMessage();
        } finally {
            $co = null;
        }
        return $r;
    }

    // Método auxiliar para verificar si una cita existe por ID (útil para modificar y cambiar estado)
    private function existeCita($id) {
        $co = $this->conecta();
        $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        try {
            $stmt = $co->prepare("SELECT COUNT(*) FROM citas WHERE id = ?");
            $stmt->execute([$id]);
            return $stmt->fetchColumn() > 0;
        } catch (Exception $e) {
            return false;
        } finally {
            $co = null;
        }
    }
}
?>