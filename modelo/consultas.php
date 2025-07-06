<?php
require_once('modelo/datos.php');
class consultas extends datos{

	// propiedades del especialista
	private $id_especialista;
	// Propiedades del paciente
	private $id_paciente;
	private $tipo_documento;
	private $cedula;
	private $nombre;
	private $apellido;
	private $fecha_nacimiento;
	private $genero;
	private $email;
	private $telefono;
	private $contacto_emergencia;
	private $direccion;
    private $ocupacion;
    private $alergias;
    private $antecedentes;
    private $medicamentos;
	private $cedula_representante;
	private $nombre_representante;
    private $fecha_registro;
	// Propiedades de la consulta
	private $tratamiento;
	private $observaciones;
	private $fecha_consulta;
	// Propiedades de la cita
	private $fecha_cita;
	private $hora_cita;

    // Métodos para establecer los valores de las propiedades
	// Datos del especialista
	function set_id_especialista($valor){ $this->id_especialista = $valor; }     
	// Datos del paciente
	function set_id_paciente($valor){ $this->id_paciente = $valor; }	    
	function set_tipo_documento($valor){ $this->tipo_documento = $valor; }	    
	function set_cedula($valor){ $this->cedula = $valor; }	
	function set_nombre($valor){ $this->nombre = $valor; }	
	function set_apellido($valor){ $this->apellido = $valor; }	
	function set_fecha_nacimiento($valor){ $this->fecha_nacimiento = $valor; }	
	function set_genero($valor){ $this->genero = $valor; }	
	function set_email($valor){ $this->email = $valor; }	
	function set_telefono($valor){ $this->telefono = $valor; }	
	function set_contacto_emergencia($valor){ $this->contacto_emergencia = $valor; }	
	function set_direccion($valor){ $this->direccion = $valor; }
	function set_ocupacion($valor){ $this->ocupacion = $valor; }	
	function set_alergias($valor){ $this->alergias = $valor; }	
	function set_antecedentes($valor){ $this->antecedentes = $valor; }	
	function set_medicamentos($valor){ $this->medicamentos = $valor; }	
	function set_cedula_representante($valor){ $this->cedula_representante = $valor; }
	function set_nombre_representante($valor){ $this->nombre_representante = $valor; }
	function set_fecha_registro($valor){ $this->fecha_registro = $valor; }	
	// Propiedades de la consulta
	function set_tratamiento($valor){ $this->tratamiento = $valor; }
	function set_observaciones($valor){ $this->observaciones = $valor; }	
	function set_fecha_consulta($valor){ $this->fecha_consulta = $valor; }
	// Propiedades de la cita
	function set_fecha_cita($valor){ $this->fecha_cita = $valor; }
	function set_hora_cita($valor){ $this->hora_cita = $valor; }

    // Métodos para obtener los valores de las propiedades	
	// Datos del especialista
	function get_id_especialista(){ return $this->id_especialista; }
	// Datos del paciente
	function get_id_paciente(){ return $this->id_paciente; }
	function get_tipo_documento(){ return $this->tipo_documento; }	
	function get_cedula(){ return $this->cedula; }
	function get_nombre(){ return $this->nombre; }
	function get_apellido(){ return $this->apellido; }
	function get_fecha_nacimiento(){ return $this->fecha_nacimiento; }	
	function get_genero(){ return $this->genero; }	
	function get_email(){ return $this->email; }	
	function get_telefono(){ return $this->telefono; }	
	function get_contacto_emergencia(){ return $this->contacto_emergencia; }	
	function get_direccion(){ return $this->direccion; }
	function get_ocupacion(){ return $this->ocupacion; }	
	function get_alergias(){ return $this->alergias; }	
	function get_antecedentes(){ return $this->antecedentes; }	
	function get_medicamentos(){ return $this->medicamentos; }	
	function get_cedula_representante(){ return $this->cedula_representante; }
	function get_nombre_representante(){ return $this->nombre_representante; }
	function get_fecha_registro(){ return $this->fecha_registro; }
	// Propiedades de la consulta
	function get_tratamiento(){ return $this->tratamiento; }
	function get_observaciones(){ return $this->observaciones; }	
	function get_fecha_consulta(){ return $this->fecha_consulta; }
	// Propiedades de la cita
	function get_fecha_cita(){ return $this->fecha_cita; }
	function get_hora_cita(){ return $this->hora_cita; }

    // Método para incluir un nuevo empleado en la base de datos
	function incluir(){
		$r = array();
        // Verifica si el número de id paciente ya existe		
		if(!$this->existe($this->id_paciente)){
			$co = $this->conecta();
			$co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			try {
				$co->beginTransaction();

				// Insertar en la tabla paciente
				$co->query("INSERT INTO pacientes (id_especialista, id_paciente, tipo_documento, cedula, nombre, apellido, fecha_nacimiento, genero, email, telefono, contacto_emergencia, direccion, ocupacion, alergias, antecedentes, medicamentos, cedula_representante,nombre_representante,fecha_registro)
					VALUES(
					'$this->id_especialista',
					'$this->id_paciente',
					'$this->tipo_documento',
					'$this->cedula',
					'$this->nombre',
					'$this->apellido',
					'$this->fecha_nacimiento',
					'$this->genero',
					'$this->email',
					'$this->telefono',
					'$this->contacto_emergencia',
					'$this->direccion',
                    '$this->ocupacion',
					'$this->alergias',
					'$this->antecedentes',
					'$this->medicamentos',
					'$this->cedula_representante',
					'$this->nombre_representante',
					'$this->fecha_registro'
					)");

				// Insertar en la tabla consulta
				$co->query("INSERT INTO consultas (id_paciente, tratamiento, observaciones, fecha_consulta, id_especialista)
					VALUES(
					'$this->id_paciente',
					'$this->tratamiento',
					'$this->observaciones',
					'$this->fecha_consulta',
					'$this->id_especialista'
					)");

				// Insertar en la tabla cita
				$co->query("INSERT INTO citas (id_paciente, cedula_representante, nombre_representante, tipo_documento, cedula, nombre, apellido, telefono, fecha_cita, hora_cita, id_especialista, fecha_registro)
					VALUES(
					'$this->id_paciente',
					'$this->cedula_representante',
					'$this->nombre_representante',
					'$this->tipo_documento',
					'$this->cedula',
					'$this->nombre',
					'$this->apellido',
					'$this->telefono',
					'$this->fecha_cita',
					'$this->hora_cita',
					'$this->id_especialista',
					'$this->fecha_registro'
					)");

				$co->commit();
				$r['resultado'] = 'incluir';
				$r['mensaje'] =  '¡Registro guardado con exito!';
			} catch(Exception $e) {
				$r['resultado'] = 'error';
				$r['mensaje'] =  $e->getMessage();
			}
		}
		else{
			$r['resultado'] = 'incluir';
			$r['mensaje'] =  'Ya existe el codigo del paciente';
		}
		$co = null;
		return $r;
	}

	// Método para consultar todos los consultas	
	function consultar(){
		$co = $this->conecta();
		$co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$r = array();
		try{
			$resultado = $co->query("SELECT
										COALESCE(p.id_paciente, '') AS id_paciente,
										COALESCE(p.nombre, c.nombre) AS nombre,
										COALESCE(p.apellido, c.apellido) AS apellido,
										c.tipo_documento, 
										c.cedula, 
										c.nombre AS nombre_cita, 
										c.apellido AS apellido_cita,
										c.cedula_representante,
										c.nombre_representante, 
										c.telefono, 
										c.fecha_cita, 
										c.hora_cita,
										e.id_empleado AS id_especialista, 
										e.tipo_documento AS tipo_documento_especialista, 
										e.cedula AS cedula_especialista, 
										e.nombre AS nombre_especialista, 
										e.apellido AS apellido_especialista,
										CASE
											WHEN p.id_paciente IS NULL THEN 'Paciente no registrado'
											ELSE 'Paciente registrado'
										END AS estado_paciente
									FROM citas AS c
									INNER JOIN empleados AS e ON c.id_especialista = e.id_empleado
									LEFT JOIN pacientes AS p ON c.cedula = p.cedula  -- Usamos LEFT JOIN y relación por cédula
									WHERE 
										DATE(c.fecha_cita) = CURDATE() 
										AND c.estado_cita = 'confirmada'");
			$consultas = [];
			foreach($resultado->fetchAll(PDO::FETCH_ASSOC) as $row){
				$consultas[] = $row;
			}
			$r['resultado'] = 'consultar';
			$r['mensaje'] = $consultas;
		}catch(Exception $e){
			$r['resultado'] = 'error';
			$r['mensaje'] =  $e->getMessage();
		}
		$co = null;
		return $r;
	}

	function obtener($id){
        $co = $this->conecta();
        $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $r = array();
        try{
            $stmt = $co->prepare("SELECT * FROM citas WHERE id = ?");
            $stmt->execute([$id]);
            $consulta = $stmt->fetch(PDO::FETCH_ASSOC);
            $r['resultado'] = 'ok';
            $r['mensaje'] = $consulta;
        }catch(Exception $e){
            $r['resultado'] = 'error';
            $r['mensaje'] =  $e->getMessage();
        }
        $co = null;
        return $r;
    }

	private function existe($id_paciente){
		$co = $this->conecta();
		$co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		try {
			$resultado = $co->query("Select * from consultas where id_paciente='$id_paciente'");
			$fila = $resultado->fetchAll(PDO::FETCH_BOTH);
			if ($fila) {
				return true;
			} else {
				return false;;
			}
		} catch (Exception $e) {
			return false;
		}
	}
}