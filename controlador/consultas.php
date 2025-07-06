<?php  
// Verifica si el archivo del modelo existe
if (!is_file("modelo/".$pagina.".php")){
	echo "Falta definir la clase ".$pagina; // Mensaje de error si no se encuentra el modelo
	exit; // Termina la ejecución
}  
require_once("modelo/".$pagina.".php"); // Incluye el archivo del modelo
// Verifica si el archivo de vista existe
if(is_file("vista/".$pagina.".php")){	    
	if(!empty($_POST)){ // Comprueba si hay datos enviados por POST
		$o = new consultas(); // Crea una instancia de la clase clientes
		$accion = $_POST['accion']; // Obtiene la acción a realizar
		// Acción para consultar datos
		if($accion=='consultar'){
			echo  json_encode($o->consultar()); // Devuelve los datos en formato JSON
		}
		else{		  
			// Establece los datos del especialista
			$o->set_id_especialista($_POST['id_especialista']);
			// Establece los datos del paciente
            $o->set_id_paciente($_POST['id_paciente']);
			$o->set_tipo_documento($_POST['tipo_documento']);
			$o->set_cedula($_POST['cedula']);
			$o->set_nombre($_POST['nombre']);
			$o->set_apellido($_POST['apellido']);
            $o->set_fecha_nacimiento($_POST['fecha_nacimiento']);
            $o->set_genero($_POST['genero']);
			$o->set_email($_POST['email']);
			$o->set_telefono($_POST['telefono']);
            $o->set_contacto_emergencia($_POST['contacto_emergencia']);
			$o->set_direccion($_POST['direccion']);
            $o->set_ocupacion($_POST['ocupacion']);
            $o->set_alergias($_POST['alergias']);
            $o->set_antecedentes($_POST['antecedentes']);
            $o->set_medicamentos($_POST['medicamentos']);
			$o->set_cedula_representante($_POST['cedula_representante']);
			$o->set_nombre_representante($_POST['nombre_representante']);
            $o->set_fecha_registro($_POST['fecha_registro']);
			// Establece los datos de la consulta
			$o->set_tratamiento($_POST['tratamiento']);
			$o->set_observaciones($_POST['observaciones']);
			$o->set_fecha_consulta($_POST['fecha_consulta']);
			// Establece los datos de la cita
			$o->set_fecha_cita($_POST['fecha_cita']);
			$o->set_hora_cita($_POST['hora_cita']);
			
			// Acción para incluir un nuevo paciente
			if($accion=='incluir'){
				echo  json_encode($o->incluir()); // Incluye y devuelve el resultado en JSON
			}
		}
		exit; // Termina la ejecución después de procesar la acción
	}	  
	require_once("vista/".$pagina.".php"); // Incluye el archivo de vista
}
else{
	echo "ERROR 404"; // Mensaje de error si no se encuentra la vista
}
?>
