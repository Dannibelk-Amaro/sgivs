function consultar() {
    // Crea un nuevo objeto FormData y agrega la acción 'consultar'
	var datos = new FormData();
	datos.append('accion', 'consultar');
	enviaAjax(datos);	
}

function destruyeDT() {
    // Verifica si la tabla existe y la destruye si es así
	if ($.fn.DataTable.isDataTable("#tablaconsulta")) {
        $("#tablaconsulta").DataTable().destroy();
    }
}

function crearDT() {
    // Crea una nueva tabla si no existe
    if (!$.fn.DataTable.isDataTable("#tablaconsulta")) {
        $("#tablaconsulta").DataTable({
            language: {
                // Configuración de idioma para la tabla
                lengthMenu: "Mostrar _MENU_ por página",
                zeroRecords: "NO SE ENCONTRARON REGISTROS",
                info: "Mostrando página _PAGE_ de _PAGES_",
                infoEmpty: "NO HAY EMPLEADOS REGISTRADOS",
                infoFiltered: "(filtrado de _MAX_ registros totales)",
                search: "<i class='bi bi-search'></i>",
                searchPlaceholder: "BUSCAR...",
                paginate: {
                    first: "PRIMERA",
                    last: "ULTIMA",
                    next: "SIGUIENTE",
                    previous: "ANTERIOR",
                },
            },
            pageLength: 5, // Establece el número de registros por página a 5
            lengthMenu: [[5, 10, 25, 50, 100], [5, 10, 25, 50, 100]], // Opciones de número de registros por página
            autoWidth: false,
            scrollX: true,
            scrollCollapse: true,
            fixedHeader: false,
            order: [[0, "asc"]],
            responsive: true,
        });
    }
    $(window).resize(function() {
        $('#tablaconsulta').DataTable().columns.adjust().draw();
    });
}

function establecerFechaActual() {
    var fecha = new Date();
    var dia = fecha.getDate();
    var mes = fecha.getMonth() + 1;
    var anio = fecha.getFullYear();
    var fechaActual = anio + "-" + (mes < 10 ? "0" + mes : mes) + "-" + (dia < 10 ? "0" + dia : dia);
    $("#fecha_registro").val(fechaActual);
    $("#fecha_consulta").val(fechaActual); 
}

$(document).ready(function() {
    // Llama a la función consultar al cargar el número de cédula
	consultar();

    var hoy = new Date();
    var dia = String(hoy.getDate()).padStart(2, '0');
    var mes = String(hoy.getMonth() + 1).padStart(2, '0');
    var anio = hoy.getFullYear();
    var fechaHoy = anio + '-' + mes + '-' + dia;

    // Limitar fecha de nacimiento y contratación
    $("#fecha_nacimiento").attr("max", fechaHoy);
    $("#fecha_contratacion").attr("max", fechaHoy);

    // Limitar fecha de cita a hoy o posterior
    $("#fecha_cita").attr("min", fechaHoy);

    // Validaciones para el campo de cédula
    $("#cedula").on("keypress", function(e) {
        validarkeypress(/^[0-9-\b]*$/, e);
    });
    $("#cedula").on("keyup", function() {
        validarkeyup(/^[0-9]{7,8}$/, $(this), $("#scedula"), "El formato de CI debe ser 1234567 o 12345678");
    });
    // Validaciones para el campo de nombre
    $("#nombre").on("keypress", function(e) {
        validarkeypress(/^[A-Z\b\s\u00f1\u00d1\u00E0-\u00FC]*$/, e);
    });
    $("#nombre").on("keyup", function() {
        validarkeyup(/^[A-Z\b\s\u00f1\u00d1\u00E0-\u00FC]{2,30}$/, $(this), $("#snombre"), "Solo letras entre 2 y 30 caracteres");
    });
    // Validaciones para el campo de apellido
    $("#apellido").on("keypress", function(e) {
        validarkeypress(/^[A-Z\b\s\u00f1\u00d1\u00E0-\u00FC]*$/, e);
    });	
    $("#apellido").on("keyup", function() {
        validarkeyup(/^[A-Z\b\s\u00f1\u00d1\u00E0-\u00FC]{2,30}$/, $(this), $("#sapellido"), "Solo letras entre 2 y 30 caracteres");
    });
    //Validaciones para el campo de fecha de nacimiento y coloca la edad y clasificación automática
    $("#fecha_nacimiento").on("change", function() {
        var fecha = $(this).val();
        var fechaActual = new Date();
        var fechaNacimiento = new Date(fecha);
        var anios = fechaActual.getFullYear() - fechaNacimiento.getFullYear();
        var meses = fechaActual.getMonth() - fechaNacimiento.getMonth();
        var dias = fechaActual.getDate() - fechaNacimiento.getDate();
        if (dias < 0) {
            meses--;
            dias += new Date(fechaActual.getFullYear(), fechaActual.getMonth(), 0).getDate();
        }
        if (meses < 0) {
            anios--;
            meses += 12;
        }
        $("#edad").val(anios);
        // Clasificación automática
        var clasificacion = "";
        if (anios <= 12) {
            clasificacion = "Niño";
        } else if (anios <= 17) {
            clasificacion = "Adolescente";
        } else {
            clasificacion = "Adulto";
        }
        $("#clasificacion").val(clasificacion);
    });
    // Validaciones para el campo de email
    $("#email").on("keypress", function(e) {
        validarkeypress(/^[A-Z0-9\s,.\-@]*$/, e);
    });
    $("#email").on("keyup", function() {
        validarkeyup(/^[\w._%+-]+@[\w.-]+\.[\w]{2,100}$/, $(this), $("#semail"), "El formato de email electrónico debe ser ejemplo@email.com");
    });
    // Validaciones para el campo de teléfono
    $("#telefono").on("keypress", function(e) {
        validarkeypress(/^[0-9\b]*$/, e);
    });
    $("#telefono").on("keyup", function() {
        validarkeyup(/^0[0-9]{10}$/, $(this), $("#stelefono"), "El formato de teléfono debe ser 04120000000");
    });
    // Validaciones para el campo de contacto de emergencia
    $("#contacto_emergencia").on("keypress", function(e) {
        validarkeypress(/^[0-9\b]*$/, e);
    });
    $("#contacto_emergencia").on("keyup", function() {
        validarkeyup(/^0[0-9]{10}$/, $(this), $("#scontacto_emergencia"), "El formato de teléfono debe ser 04120000000");
    });
    // Validaciones para el campo de dirección
    $("#direccion").on("keypress", function(e) {
        validarkeypress(/^[^"']*$/, e);
    });
    $("#direccion").on("keyup", function() {
        validarkeyup(/^[^"']{1,100}$/, $(this), $("#sdireccion"), "La dirección debe tener entre 1 y 100 caracteres");
    });	
    // Validaciones para el campo de ocupación
    $("#ocupacion").on("keypress", function(e) {
        validarkeypress(/^[A-Z\s,.\-]*$/, e);
    });
    $("#ocupacion").on("keyup", function() {
        validarkeyup(/^[A-Z\s,.\-]{2,20}$/, $(this), $("#socupacion"), "La ocupación debe tener entre 2 y 20 caracteres");
    });
    // Validaciones para el campo de alergias
    $("#alergias").on("keypress", function(e) {
        validarkeypress(/^[A-Z\s,.\-]*$/, e);
    });
    $("#alergias").on("keyup", function() {
        validarkeyup(/^[A-Z\s,.\-]{2,20}$/, $(this), $("#salergias"), "Las alergias deben tener entre 2 y 20 caracteres");
    });
    // Validaciones para el campo de antecedentes médicos
    $("#antecedentes").on("keypress", function(e) {
        validarkeypress(/^[A-Z\s,.\-]*$/, e);
    });
    $("#antecedentes").on("keyup", function() {
        validarkeyup(/^[A-Z\s,.\-]{2,20}$/, $(this), $("#santecedentes"), "Los antecedentes médicos deben tener entre 2 y 20 caracteres");
    });
    // Validaciones para el campo de medicamentos
    $("#medicamentos").on("keypress", function(e) {
        validarkeypress(/^[A-Z\s,.\-]*$/, e);
    });
    $("#medicamentos").on("keyup", function() {
        validarkeyup(/^[A-Z\s,.\-]{2,20}$/, $(this), $("#smedicamentos"), "Los medicamentos deben tener entre 2 y 20 caracteres");
    });

    // Manejo de clic en el botón de proceso
    $("#proceso").on("click", function() {
        if ($(this).text() == " INCLUIR") {
            if (validarenvio()) {
            // Confirmación para incluir un nuevo consulta
                Swal.fire({
                    title: "¿Estás seguro?",
                    text: "¿Deseas incluir este nuevo consulta?",
                    icon: "question",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Sí, incluir",
                    cancelButtonText: "No, Cancelar"
                }).then((result) => {
                    if (result.isConfirmed) {
                        if (validarenvio()) {
                            var datos = new FormData();
                            datos.append('accion', 'incluir');
                            //datos del especialista
                            datos.append('id_especialista', $("#id_especialista").val());
                            //datos del pacientes
                            datos.append('id_paciente', $("#id_paciente").val());
                            datos.append('tipo_documento', $("#tipo_documento").val());
                            datos.append('cedula', $("#cedula").val());
                            datos.append('nombre', $("#nombre").val());
                            datos.append('apellido', $("#apellido").val());
                            datos.append('fecha_nacimiento', $("#fecha_nacimiento").val());
                            datos.append('genero', $("#genero").val());
                            datos.append('email', $("#email").val());
                            datos.append('telefono', $("#telefono").val());
                            datos.append('contacto_emergencia', $("#contacto_emergencia").val());
                            datos.append('direccion', $("#direccion").val());
                            datos.append('ocupacion', $("#ocupacion").val());
                            datos.append('alergias', $("#alergias").val());
                            datos.append('antecedentes', $("#antecedentes").val());
                            datos.append('medicamentos', $("#medicamentos").val());
                            datos.append('cedula_representante', $("#cedula_representante").val());
                            datos.append('nombre_representante', $("#nombre_representante").val());
                            datos.append('fecha_registro', $("#fecha_registro").val());
                            // datos de la consulta
                            datos.append('tratamiento', $("#tratamiento").val());
                            datos.append('observaciones', $("#observaciones").val());
                            datos.append('fecha_consulta', $("#fecha_consulta").val());
                            // datos de la proxima cita
                            datos.append('fecha_cita', $("#fecha_cita").val());
                            datos.append('hora_cita', $("#hora_cita").val());
                            enviaAjax(datos);
                        }
                    }
                });
            }
        }
    });
});

// Función para validar el envío de datos
function validarenvio() {
    // Validaciones para el campo de id del especialista
    if ($("#id_especialista").val().trim() === "") {
        Swal.fire({
            title: "Error",
            text: "El campo del id del especialista es obligatorio",
            icon: "error",
        });
        return false;
    }
    // Validaciones para el campo de codigo de paciente
    if ($("#id_paciente").val().trim() === "") {
        Swal.fire({
            title: "¡ERROR!",
            text: "El codigo de paciente es obligatorio",
            icon: "error",
            confirmButtonText: "Aceptar"
        });    
        return false;
    }
    // Validaciones para nombre
    if ($("#nombre").val().trim() === "") {
        Swal.fire({
            title: "¡ERROR!",
            text: "El nombre del paciente es obligatorio",
            icon: "error",
            confirmButtonText: "Aceptar"
        });    
        return false;
    }
    // Validaciones para el formato de apellido
    if ($("#apellido").val().trim() === "") {
        Swal.fire({
            title: "¡ERROR!",
            text: "El apellido del paciente es obligatorio",
            icon: "error",
            confirmButtonText: "Aceptar"
        });    
        return false;
    }
    // Validaciones para el fecha de nacimiento
    if ($("#fecha_nacimiento").val().trim() === "") {
        Swal.fire({
            title: "¡ERROR!",
            text: "La fecha de nacimiento del paciente es obligatoria",
            icon: "error",
            confirmButtonText: "Aceptar"
        });    
        return false;
    }
    //Validaciones para el género
    if ($("#genero").val() === "") {
        Swal.fire({
            title: "¡ERROR!",
            text: "El genero del paciente es obligatorio",
            icon: "error",
            confirmButtonText: "Aceptar"
        });    
        return false;
    }
    // Validaciones para el email
    if ($("#email").val().trim() === "") {
        Swal.fire({
            title: "¡ERROR!",
            text: "El correo del paciente es obligatorio",
            icon: "error",
            confirmButtonText: "Aceptar"
        });  
        return false;
    }
    // Validaciones para el teléfono
    if ($("#telefono").val().trim() === "") {
        Swal.fire({
            title: "¡ERROR!",
            text: "El telefono del paciente es obligatrorio",
            icon: "error",
            confirmButtonText: "Aceptar"
        });   
        return false;
    }
    // Validaciones para el contacto de emergencia
    if ($("#contacto_emergencia").val().trim() === "") {
        Swal.fire({
            title: "¡ERROR!",
            text: "El contacto de emergencia es obligatorio",
            icon: "error",
            confirmButtonText: "Aceptar"
        });   
        return false;
    }
    // Validaciones para la dirección
    if ($("#direccion").val().trim() === "") {
        Swal.fire({
            title: "¡ERROR!",
            text: "La dirección debe tener un máximo de 100 caracteres",
            icon: "error",
            confirmButtonText: "Aceptar"
        });   
        return false;
    }
    // Validaciones para la ocupación
    if ($("#ocupacion").val().trim() === "") {
        Swal.fire({
            title: "¡ERROR!",
            text: "La ocupación del paciente es obligatoria",
            icon: "error",
            confirmButtonText: "Aceptar"
        });    
        return false;
    }
    // Validaciones para alergias
    if ($("#alergias").val().trim() === "") {
        Swal.fire({
            title: "¡ERROR!",
            text: "Las alergias del paciente son obligatorias",
            icon: "error",
            confirmButtonText: "Aceptar"
        });    
        return false;
    }
    // Validaciones para antecedentes médicos
    if ($("#antecedentes").val().trim() === "") {
        Swal.fire({
            title: "¡ERROR!",
            text: "Los antecedentes médicos del paciente son obligatorios",
            icon: "error",
            confirmButtonText: "Aceptar"
        });    
        return false;
    }
    // Validaciones para medicamentos
    if ($("#medicamentos").val().trim() === "") {
        Swal.fire({
            title: "¡ERROR!",
            text: "Los medicamentos del paciente son obligatorios",
            icon: "error",
            confirmButtonText: "Aceptar"
        });    
        return false;
    }
    // Validaciones para fecha de registro
    if ($("#fecha_registro").val().trim() === "") {
        Swal.fire({
            title: "¡ERROR!",
            text: "La fecha de registro del paciente es obligatoria",
            icon: "error",
            confirmButtonText: "Aceptar"
        });    
        return false;
    }
    // Validaciones para el tratamiento
    if ($("#tratamiento").val().trim() === "") {
        Swal.fire({
            title: "¡ERROR!",
            text: "El tratamiento del paciente es obligatorio",
            icon: "error",
            confirmButtonText: "Aceptar"
        });
        return false;
    }
    // Validaciones para observaciones
    if ($("#observaciones").val().trim() === "") {
        Swal.fire({
            title: "¡ERROR!",
            text: "Las observaciones del paciente son obligatorias",
            icon: "error",
            confirmButtonText: "Aceptar"
        });
        return false;
    }
    // Validaciones para la fecha de consulta
    if ($("#fecha_consulta").val().trim() === "") {
        Swal.fire({
            title: "¡ERROR!",
            text: "La fecha de consulta es obligatoria",
            icon: "error",
            confirmButtonText: "Aceptar"
        });
        return false;
    }
    // Validaciones para la fecha de cita
    if ($("#fecha_cita").val().trim() === "") {
        Swal.fire({
            title: "¡ERROR!",
            text: "La fecha de la cita es obligatoria",
            icon: "error",
            confirmButtonText: "Aceptar"
        });
        return false;
    }
    // Validaciones para la hora de cita
    if ($("#hora_cita").val().trim() === "") {
        Swal.fire({
            title: "¡ERROR!",
            text: "La hora de la cita es obligatoria",
            icon: "error",
            confirmButtonText: "Aceptar"
        });
        return false;
    }
    return true; // Si todas las validaciones pasan, retorna verdadero
}

function validarkeypress(er, e) {
    // Función para validar la tecla presionada
	key = e.keyCode;
    tecla = String.fromCharCode(key);
    a = er.test(tecla);
    if (!a) {
        e.preventDefault(); // Previene la acción si no coincide con la expresión regular
    }    
}

function validarkeyup(er, etiqueta, etiquetamensaje, mensaje) {
    // Función para validar el valor al soltar la tecla
	a = er.test(etiqueta.val());
	if (a) {
		etiquetamensaje.text(""); // Limpia el mensaje de error
		return 1; // Retorna 1 si es válido
	} else {
		etiquetamensaje.text(mensaje); // Muestra el mensaje de error
		return 0; // Retorna 0 si no es válido
	}
}

// Función para limpiar valores nulos, undefined o NaN
function limpiarValor(valor) {
    if (valor === undefined || valor === null || valor === "null" || valor === "undefined" || valor === "NaN" || valor === NaN) {
        return "";
    }
    return valor;
}

// Modifica la función pone para usar limpiarValor
function pone(pos, accion) {
    linea = $(pos).closest('tr');
    var fechaNacimiento = new Date($(linea).find("td:eq(5)").text());
    var fechaActual = new Date();
    var anios = fechaActual.getFullYear() - fechaNacimiento.getFullYear();
    var meses = fechaActual.getMonth() - fechaNacimiento.getMonth();
    var dias = fechaActual.getDate() - fechaNacimiento.getDate();
    if (dias < 0) {
        meses--;
        dias += new Date(fechaActual.getFullYear(), fechaActual.getMonth(), 0).getDate();
    }
    if (meses < 0) {
        anios--;
        meses += 12;
    }
    // Clasificación automática
    var clasificacion = $(linea).find("td:eq(7)").text();
    if (accion == 0) {
        $("#proceso").text(" INCLUIR");
        // datos del especialista
        $("#id_especialista").prop("disabled", true);
        $("#tipo_documento_especialista").prop("disabled", true);
        $("#cedula_especialista").prop("disabled", true);
        $("#nombre_especialista").prop("disabled", true);
        $("#apellido_especialista").prop("disabled", true);
        // datos del paciente
        $("#id_paciente").prop("disabled", false);
        $("#tipo_documento").prop("disabled", false);
        $("#cedula").prop("disabled", false);
        $("#nombre").prop("disabled", false);
        $("#apellido").prop("disabled", false);
        $("#fecha_nacimiento").prop("disabled", false);
        $("#edad").prop("disabled", false);
        $("#edad").val(anios);
        $("#clasificacion").prop("disabled", false);
        $("#clasificacion").val(clasificacion);
        $("#genero").prop("disabled", false);
        $("#email").prop("disabled", false);
        $("#telefono").prop("disabled", false);
        $("#contacto_emergencia").prop("disabled", false);
        $("#direccion").prop("disabled", false);
        $("#ocupacion").prop("disabled", false);
        $("#alergias").prop("disabled", false);
        $("#antecedentes").prop("disabled", false);
        $("#medicamentos").prop("disabled", false);
        $("#cedula_representante").prop("disabled", true);
        $("#nombre_representante").prop("disabled", true);
        $("#fecha_registro").prop("disabled", true);
        // datos de la consulta
        $("#tratamiento").prop("disabled", true);
        $("#observaciones").prop("disabled", false);
        $("#fecha_consulta").prop("disabled", true);
        // datos de la proxima cita
        $("#fecha_cita").prop("disabled", false);
        $("#hora_cita").prop("disabled", false);
    }

    // Llena los campos del formulario con los datos de la fila

    // datos del especialista

    $("#id_especialista").val(limpiarValor($(linea).find("td:eq(1)").text()));

    var documentoEspecialista = limpiarValor($(linea).find("td:eq(2)").text().trim());
    var partesEspecialista = documentoEspecialista.split("-");
    var tipo_documento_especialista = limpiarValor(partesEspecialista[0]);
    var cedula_especialista = limpiarValor(partesEspecialista[1]);

    var nombreEspecialista = limpiarValor($(linea).find("td:eq(3)").text().trim());
    var partesNombreEspecialista = nombreEspecialista.split(" ");
    var nombre_especialista = limpiarValor(partesNombreEspecialista[0]);
    var apellido_especialista = limpiarValor(partesNombreEspecialista[1]);

    $("#tipo_documento_especialista").val(tipo_documento_especialista);
    $("#cedula_especialista").val(cedula_especialista);
    $("#nombre_especialista").val(nombre_especialista);
    $("#apellido_especialista").val(apellido_especialista);

    // datos del paciente

    $("#id_paciente").val(limpiarValor($(linea).find("td:eq(4)").text()));

    var documentoCompleto = limpiarValor($(linea).find("td:eq(5)").text().trim());
    var partes = documentoCompleto.split("-");
    var tipo_documento = limpiarValor(partes[0]);
    var cedula = limpiarValor(partes[1]);

    var nombreCompleto = limpiarValor($(linea).find("td:eq(6)").text().trim());
    var partesNombre = nombreCompleto.split(" ");
    var nombre = limpiarValor(partesNombre[0]);
    var apellido = limpiarValor(partesNombre[1]);

    $("#tipo_documento").val(tipo_documento);
    $("#cedula").val(cedula);
    $("#nombre").val(nombre);
    $("#apellido").val(apellido);

    $("#fecha_nacimiento").val(limpiarValor($(linea).find("td:eq(7)").text()));
    $("#edad").val(limpiarValor(anios));
    $("#clasificacion").val(limpiarValor(clasificacion));
    $("#genero").val(limpiarValor($(linea).find("td:eq(10)").text()));
    $("#email").val(limpiarValor($(linea).find("td:eq(11)").text()));
    $("#telefono").val(limpiarValor($(linea).find("td:eq(12)").text()));
    $("#contacto_emergencia").val(limpiarValor($(linea).find("td:eq(13)").text()));
    $("#direccion").val(limpiarValor($(linea).find("td:eq(14)").text()));
    $("#ocupacion").val(limpiarValor($(linea).find("td:eq(15)").text()));
    $("#alergias").val(limpiarValor($(linea).find("td:eq(16)").text()));
    $("#antecedentes").val(limpiarValor($(linea).find("td:eq(17)").text()));
    $("#medicamentos").val(limpiarValor($(linea).find("td:eq(18)").text()));
    $("#cedula_representante").val(limpiarValor($(linea).find("td:eq(19)").text()));
    $("#nombre_representante").val(limpiarValor($(linea).find("td:eq(20)").text()));
    $("#fecha_registro").val(limpiarValor($(linea).find("td:eq(21)").text()));
    establecerFechaActual();

    $("#modal1").modal("show"); // Muestra el modal
}

function enviaAjax(datos) {
    $.ajax({
        async: true,
        url: "",
        type: "POST",
        contentType: false,
        data: datos,
        processData: false,
        cache: false,
        beforeSend: function () {
            $("#loader").show(); // Mostrar loader
        },
        timeout: 10000, 
        success: function (respuesta) {
            try {
                var lee = JSON.parse(respuesta);
                if (lee.resultado == "consultar") {
                    destruyeDT();
                    let filas = "";
                    (lee.mensaje || []).forEach(function(p, idx) {
                        filas += `<tr class='text-center'>
                            <td class='align-middle'>${idx+1}</td>
                            <td class='align-middle d-none'>${limpiarValor(p.id_especialista)}</td>
                            <td class='align-middle d-none'>${limpiarValor(p.tipo_documento_especialista)}-${limpiarValor(p.cedula_especialista)}</td>
                            <td class='align-middle'>${limpiarValor(p.nombre_especialista)} ${limpiarValor(p.apellido_especialista)}</td>
                            <td class='align-middle d-none'>${limpiarValor(p.id_paciente)}</td>
                            <td class='align-middle d-none'>${limpiarValor(p.tipo_documento)}-${limpiarValor(p.cedula)}</td>
                            <td class='align-middle'>${limpiarValor(p.nombre)} ${limpiarValor(p.apellido)}</td>
                            <td class='align-middle d-none'>${limpiarValor(p.fecha_nacimiento)}</td>
                            <td class='align-middle d-none'>${limpiarValor(p.edad)}</td>
                            <td class='align-middle d-none'>${limpiarValor(p.clasificacion)}</td>
                            <td class='align-middle d-none'>${limpiarValor(p.genero)}</td>
                            <td class='align-middle d-none'>${limpiarValor(p.email)}</td>
                            <td class='align-middle d-none'>${limpiarValor(p.telefono)}</td>
                            <td class='align-middle d-none'>${limpiarValor(p.contacto_emergencia)}</td>
                            <td class='align-middle d-none'>${limpiarValor(p.direccion)}</td>
                            <td class='align-middle d-none'>${limpiarValor(p.ocupacion)}</td>
                            <td class='align-middle d-none'>${limpiarValor(p.alergias)}</td>
                            <td class='align-middle d-none'>${limpiarValor(p.antecedentes)}</td>
                            <td class='align-middle d-none'>${limpiarValor(p.medicamentos)}</td>
                            <td class='align-middle d-none'>${limpiarValor(p.cedula_representante)}</td>
                            <td class='align-middle d-none'>${limpiarValor(p.nombre_representante)}</td>
                            <td class='align-middle d-none'>${limpiarValor(p.fecha_registro)}</td>
                            <td class='align-middle'>${limpiarValor(p.fecha_cita)} ${limpiarValor(p.hora_cita)}</td>
                            <td class='align-middle' style='display: flex; justify-content: center;'>
                                <button type='button' class='btn btn-sm btn-outline-info w-50 small-width mb-1 bi bi-clipboard2-pulse' onclick='pone(this,0)' title='INCLUIR CONSULTA' style='margin:.2rem; width: 40px !important;'></button>
                            </td>

                        </tr>`;
                    });
                    $("#resultadoconsulta").html(filas);
                    crearDT();
                }
                else if (lee.resultado == "incluir") {
                    if (lee.mensaje == '¡Registro guardado con exito!') {
                        Swal.fire({
                            title: "¡Incluido!",
                            text: "El consulta ha sido incluido con éxito.",
                            icon: "success"
                        });
                        $("#modal1").modal("hide");
                        consultar();
                    } else {
                        Swal.fire({
                            title: "Error",
                            text: lee.mensaje,
                            icon: "error"
                        });
                    }
                }
                else if (lee.resultado == "error") {
                    Swal.fire({
                        title: "Error",
                        text: lee.mensaje,
                        icon: "error"
                    });
                }
            } catch (e) {
                Swal.fire({
                    title: "Error",
                    text: "Error en JSON: " + e.name,
                    icon: "error"
                });
            }
        },
        error: function (request, status, err) {
            if (status == "timeout") {
                Swal.fire({
                    title: "Error",
                    text: "Servidor ocupado, intente de nuevo",
                    icon: "error"
                });
            } else {
                Swal.fire({
                    title: "Error",
                    text: "ERROR: " + request + status + err,
                    icon: "error"
                });
            }
        },
        complete: function () {
            $("#loader").hide(); // Ocultar loader al completar
        }
        });
}

function limpia() {
    // Función para limpiar los campos del formulario
    // datos del especialista
    $("#id_especialista").val("");
    $("#tipo_documento_especialista").val("");
    $("#cedula_especialista").val("");
    $("#nombre_especialista").val("");
    $("#apellido_especialista").val("");
    // datos del paciente
    $("#id_paciente").val("");
    $("#tipo_documento").prop("selectedIndex", 0);
    $("#cedula").val("");
    $("#nombre").val("");
    $("#apellido").val("");
    $("#fecha_nacimiento").val("");
    $("#edad").val("");
    $("#clasificacion").val("");
    $("#genero").prop("selectedIndex", 0);
    $("#email").val("");
    $("#telefono").val("");
    $("#contacto_emergencia").val("");
    $("#direccion").val("");
    $("#ocupacion").val("");
    $("#alergias").val("");
    $("#antecedentes").val("");
    $("#medicamentos").val("");
    $("#cedula_representante").val("");
    $("#nombre_representante").val("");
    establecerFechaActual();

    // Habilita los campos del formulario
    // datos del especialista
    $("#id_especialista").prop("disabled", true); 
    $("#tipo_documento_especialista").prop("disabled", true); 
    $("#cedula_especialista").prop("disabled", true); 
    $("#nombre_especialista").prop("disabled", true);   
    $("#apellido_especialista").prop("disabled", true); 
    // datos del paciente
    $("#id_paciente").prop("disabled", false); 
    $("#tipo_documento").prop("disabled", false); 
    $("#cedula").prop("disabled", false); 
    $("#nombre").prop("disabled", false);   
    $("#apellido").prop("disabled", false); 
    $("#fecha_nacimiento").prop("disabled", false);
    $("#edad").prop("disabled", true);
    $("#clasificacion").prop("disabled", true);
    $("#genero").prop("disabled", false);
    $("#email").prop("disabled", false);   
    $("#telefono").prop("disabled", false); 
    $("#contacto_emergencia").prop("disabled", false);
    $("#direccion").prop("disabled", false);   
    $("#ocupacion").prop("disabled", false);
    $("#alergias").prop("disabled", false);
    $("#antecedentes").prop("disabled", false);
    $("#medicamentos").prop("disabled", false);
    $("#fecha_registro").prop("disabled", true); // Habilita el campo de fecha de registro               
}

// Función para añadir el tratamiento seleccionado al textarea
$("#btn_add_tratamiento").on("click", function () {
    var selectedTreatment = $("#select_tratamiento_add").val(); // Obtiene el valor del select
    var currentTreatmentText = $("#tratamiento").val(); // Obtiene el texto actual del textarea

    if (selectedTreatment) {
        // Añadir el tratamiento, con una nueva línea si ya hay texto
        if (currentTreatmentText.trim() !== "") {
            $("#tratamiento").val(currentTreatmentText + "\n- " + selectedTreatment);
        } else {
            $("#tratamiento").val("- " + selectedTreatment);
        }
        // Opcional: Limpiar la selección en el Select2 después de añadir
        $("#select_tratamiento_add").val(null).trigger("change");
    } else {
        alert("Por favor, seleccione un tratamiento de la lista.");
    }
});

// Evento para limpiar el Select2 y el textarea de tratamientos cuando se cierra el modal
$("#modal1").on("hidden.bs.modal", function () {
  // Limpiar el select de paciente si lo tienes y sus campos
  // $('#select_paciente').val(null).trigger('change');
  // $('#nombre_paciente').val(''); etc.

  // Limpiar el textarea de tratamiento y el select de añadir tratamientos
    $("#tratamiento").val("");
    $("#select_tratamiento_add").val(null).trigger("change");
});

// Función para limpiar el textarea de tratamientos y el select de tratamientos
$("#btn_clear_tratamiento").on("click", function () {
    $("#tratamiento").val("");
    $("#select_tratamiento_add").val(null).trigger("change");
});
