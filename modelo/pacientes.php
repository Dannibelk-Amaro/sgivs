<?php
require_once('modelo/datos.php');
class pacientes extends datos{
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
    private $fecha_registro;

    // Métodos para establecer los valores de las     
	function set_id_paciente($valor){
		$this->id_paciente = $valor;
	}	    
	function set_tipo_documento($valor){
		$this->tipo_documento = $valor;
	}	    
	function set_cedula($valor){
		$this->cedula = $valor;
	}	
	function set_nombre($valor){
		$this->nombre = $valor;
	}	
	function set_apellido($valor){
		$this->apellido = $valor;
	}	
	function set_fecha_nacimiento($valor){
		$this->fecha_nacimiento = $valor;
	}	
	function set_genero($valor){
		$this->genero = $valor;
	}	
	function set_email($valor){
		$this->email = $valor;
	}	
	function set_telefono($valor){
		$this->telefono = $valor;
	}	
	function set_contacto_emergencia($valor){
		$this->contacto_emergencia = $valor;
	}	
	function set_direccion($valor){
		$this->direccion = $valor;
	}
	function set_ocupacion($valor){
		$this->ocupacion = $valor;
	}	
	function set_alergias($valor){
		$this->alergias = $valor;
	}	
	function set_antecedentes($valor){
		$this->antecedentes = $valor;
	}	
	function set_medicamentos($valor){
		$this->medicamentos = $valor;
	}	
	function set_fecha_registro($valor){
		$this->fecha_registro = $valor;
	}	

    // Métodos para obtener los valores de las propiedades		
	function get_id_paciente(){
		return $this->id_paciente;
	}
	function get_tipo_documento(){
		return $this->tipo_documento;
	}	
	function get_cedula(){
		return $this->cedula;
	}
	function get_nombre(){
		return $this->nombre;
	}
	function get_apellido(){
		return $this->apellido;
	}
	function get_fecha_nacimiento(){
		return $this->fecha_nacimiento;
	}	
	function get_genero(){
		return $this->genero;
	}	
	function get_email(){
		return $this->email;
	}	
	function get_telefono(){
		return $this->telefono;
	}	
	function get_contacto_emergencia(){
		return $this->contacto_emergencia;
	}	
	function get_direccion(){
		return $this->direccion;
	}
	function get_ocupacion(){
		return $this->ocupacion;
	}	
	function get_alergias(){
		return $this->alergias;
	}	
	function get_antecedentes(){
		return $this->antecedentes;
	}	
	function get_medicamentos(){
		return $this->medicamentos;
	}	
	function get_fecha_registro(){
		return $this->fecha_registro;
	}	

    // Método para incluir un nuevo empleado en la base de datos
	function incluir(){
		$r = array();
        // Verifica si el número de cedula ya existe		
		if(!$this->existe($this->cedula)){
			$co = $this->conecta();
			$co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			try {
                // Inserta el nuevo empleado en la base de datos			
				$co->query("Insert into pacientes (id_paciente, tipo_documento, cedula,nombre,apellido,fecha_nacimiento,genero,email,telefono,contacto_emergencia,direccion,ocupacion,alergias,antecedentes,medicamentos,fecha_registro)
					Values(
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
					'$this->fecha_registro'
					)");
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

    // Método para modificar un empleado existente	
	function modificar(){
		$co = $this->conecta();
		$co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$r = array();
        // Verifica si el número de cedula existe		
		if($this->existe($this->cedula)){
			try {
                // Actualiza los datos del empleado en la base de datos				
				$co->query("Update pacientes set 
                    tipo_documento = '$this->tipo_documento',
                    cedula = '$this->cedula',
					nombre = '$this->nombre',
					apellido = '$this->apellido',
                    fecha_nacimiento = '$this->fecha_nacimiento',
                    genero = '$this->genero',
					email = '$this->email',
					telefono = '$this->telefono',
					contacto_emergencia = '$this->contacto_emergencia',
					direccion = '$this->direccion',
                    ocupacion = '$this->ocupacion',
                    alergias = '$this->alergias',
                    antecedentes = '$this->antecedentes',
                    medicamentos = '$this->medicamentos',
                    fecha_registro = '$this->fecha_registro'
					where
					id_paciente = '$this->id_paciente'
					");
				$r['resultado'] = 'modificar';
				$r['mensaje'] =  '¡Registro modificado con éxito!';
			} catch(Exception $e) {
				$r['resultado'] = 'error';
				$r['mensaje'] =  $e->getMessage();
			}
		}
		else{
			$r['resultado'] = 'modificar';
			$r['mensaje'] =  'El codigo del pacientes no registrado';
		}
		$co = null;
		return $r;
	}

    // Método para eliminar un empleado	
	function eliminar(){
		$co = $this->conecta();
		$co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$r = array();
        // Verifica si el número de documento existe		
		if($this->existe($this->id_paciente)){
			try {
				// Elimina el empleado de la base de datos
				$co->query("delete from pacientes where	id_paciente = '$this->id_paciente'");
				$r['resultado'] = 'eliminar';
				$r['mensaje'] =  '¡Registro eliminado con exito!';
			} catch (Exception $e) {
				$r['resultado'] = 'error';
				if ($e->getCode() == 23000) {
					$r['mensaje'] = 'No se puede eliminar este empleado porque tiene movimientos asociados';
				} else {
					$r['mensaje'] = $e->getMessage();
				}
			}
		}
		else{
			$r['resultado'] = 'eliminar';
			$r['mensaje'] =  'No existe el codigo del paciente';
		}
		$co = null;
		return $r;
	}	

    // Método para consultar todos los empleado	
	function consultar(){
		$co = $this->conecta();
		$co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$r = array();
		try{
		    $resultado = $co->query("Select * from pacientes ORDER BY id_paciente DESC");
			$pacientes = [];
			foreach($resultado->fetchAll(PDO::FETCH_ASSOC) as $row){
				// Calcular edad y clasificación
				$fecha_nacimiento = new DateTime($row['fecha_nacimiento']);
				$hoy = new DateTime();
				$edad = $hoy->diff($fecha_nacimiento)->y;
				$row['edad'] = $edad;
				$pacientes[] = $row;
			}
			$r['resultado'] = 'consultar';
			$r['mensaje'] = $pacientes;
		}catch(Exception $e){
			$r['resultado'] = 'error';
			$r['mensaje'] =  $e->getMessage();
		}
		$co = null;
		return $r;
	}
	// Método privado para verificar si un número de documento ya existe
	private function existe($id_paciente){
		$co = $this->conecta();
		$co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		try{
			$resultado = $co->query("Select * from pacientes where id_paciente='$id_paciente'");
			$fila = $resultado->fetchAll(PDO::FETCH_BOTH);
			if($fila){
				return true;  
			}
			else{	
				return false;
			}	
		}catch(Exception $e){
			return false;
		}
		$co = null;
	}	
}
?>