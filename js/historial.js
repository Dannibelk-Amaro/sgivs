var datos = new FormData();
datos.append("accion", "modalpaciente");
enviaAjax(datos);

$("#listadopaciente").on("click", function () {
  $("#modalpaciente").modal("show");
});
function colocapa(linea) {
  // Centra los valores en los campos de entrada
  $("#cedula").val($(linea).find("td:eq(0)").text()).css("text-align", "center");
  $("#nombre").val($(linea).find("td:eq(1)").text()).css("text-align", "center");
  $("#Apellido").val($(linea).find("td:eq(2)").text()).css("text-align", "center");
  $("#telefono").val($(linea).find("td:eq(3)").text()).css("text-align", "center");
  $("#modalpaciente").modal("hide");
}

function consultar() {
    var datos = new FormData();
    datos.append('accion', 'consultar'); // Se agrega la acción 'consultar' a los datos
    enviaAjax(datos); // Se envían los datos al servidor
}

function destruyeDT() {
    // Verifica si la tabla existe y la destruye
    if ($.fn.DataTable.isDataTable("#tablahistorial")) {
        $("#tablahistorial").DataTable().destroy();
    }
}


    
function crearDT() {
    // Crea la tabla solo si no existe
    if (!$.fn.DataTable.isDataTable("#tablahistorial")) {
        $("#tablahistorial").DataTable({
            language: {
                lengthMenu: "Mostrar _MENU_ por página",
                zeroRecords: "No se encontraron historial",
                info: "Mostrando página _PAGE_ de _PAGES_",
                infoEmpty: "No hay historial registradas",
                infoFiltered: "(filtrado de _MAX_ registros totales)",
                search: "<i class='bi bi-search'></i>",
                searchPlaceholder: "Buscar historia...",
                paginate: {
                    first: "Primera",
                    last: "Última",
                    next: "Siguiente",
                    previous: "Anterior",
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
    $(window).resize(function () {
        $('#tablahistorial').DataTable().columns.adjust().draw();
    });
}

$(document).ready(function () {
    consultar(); // Llama a la función consultar al cargar el documento

    // Validaciones para el campo nombre
    $("#nombre").on("keypress", function (e) {
        validarkeypress(/^[^"']*$/, e);
    });
    $("#nombre").on("keyup", function () {
        validarkeyup(/^[^"']{3,30}$/, $(this), $("#snombre"), "Debe tener entre 3 y 30 caracteres");
    });

    // Validaciones para el campo Apellido
    $("#Apellido").on("keypress", function (e) {
        validarkeypress(/^[^"']*$/, e); // Letras, números, espacios, comas y puntos
    });
    $("#Apellido").on("keyup", function () {
        validarkeyup(/^[^"']{0,100}$/, $(this), $("#sApellido"), "El Apellido debe tener un máximo de 100 caracteres");
    });
    

    // Manejo de clics en el botón de proceso
    $("#proceso").on("click", function () {
        if ($(this).text() == "INCLUIR") {
            if (validarenvio()) {
                // Confirmación para incluir una nueva historia
                Swal.fire({
                    title: "¿Estás seguro?",
                    text: "¿Deseas incluir esta nueva Historia?",
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
                            datos.append('accion', 'incluir'); // Acción para incluir
                            datos.append('nombre', $("#nombre").val());
                            datos.append('Apellido', $("#Apellido").val());
                            datos.append('telefono', $("#telefono").val());
                            datos.append('Sexo', $("#Sexo").val());
                            datos.append('Ocupacion', $("#Ocupacion").val());
                            datos.append('PersonaContacto', $("#PersonaContacto").val());
                            datos.append('Edad', $("#Edad").val());
                            datos.append('correo', $("#correo").val());
                            datos.append('motivo', $("#motivo").val());
                            datos.append('diagnostico', $("#diagnostico").val());
                            datos.append('tratamiento', $("#tratamiento").val());
                            datos.append('medicamentos', $("#medicamentos").val());
                            datos.append('dientesafectados', $("#dientesafectados").val());
                            datos.append('antecedentes', $("#antecedentes").val());
                            datos.append('fechaconsulta', $("#fechaconsulta").val());
                            datos.append('proximacita', $("#proximacita").val());
                            datos.append('observaciones', $("#observaciones").val());

                            /*   if ($("#imagen")[0].files[0]) {
                                   datos.append('imagen', $("#imagen")[0].files[0]); // Agrega imagen si existe
                               }*/
                            enviaAjax(datos); // Envía los datos
                        }
                    }
                });
            }
        }
        else if ($(this).text() == "MODIFICAR") {
            if (validarenvio()) {
                // Confirmación para modificar una historia
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: "btn btn-success",
                        cancelButton: "btn btn-danger"
                    },
                    buttonsStyling: false
                });

                swalWithBootstrapButtons.fire({
                    title: "¿Estás seguro?",
                    text: "¿Deseas modificar esta historia?",
                    icon: "question",
                    showCancelButton: true,
                    confirmButtonText: "Sí, modificar",
                    cancelButtonText: "No, cancelar",
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        if (validarenvio()) {
                            var datos = new FormData();
                            datos.append('accion', 'modificar');
                            datos.append('id', $("#id").val());
                            datos.append('nombre', $("#nombre").val());
                            datos.append('Apellido', $("#Apellido").val());
                            datos.append('telefono', $("#telefono").val());
                            datos.append('Sexo', $("#Sexo").val());
                            datos.append('Ocupacion', $("#Ocupacion").val());
                            datos.append('PersonaContacto', $("#PersonaContacto").val());
                            datos.append('Edad', $("#Edad").val());
                            datos.append('correo', $("#correo").val());
                            datos.append('diagnostico', $("#diagnostico").val());
                            datos.append('tratamiento', $("#tratamiento").val());
                            datos.append('medicamentos', $("#medicamentos").val());
                            datos.append('dientesafectados', $("#dientesafectados").val());
                            datos.append('antecedentes', $("#antecedentes").val());
                            datos.append('fechaconsulta', $("#fechaconsulta").val());
                            datos.append('proximacita', $("#proximacita").val());
                            datos.append('observaciones', $("#observaciones").val());
                            enviaAjax(datos);
                        }
                    } else if (result.dismiss === Swal.DismissReason.cancel) {
                        swalWithBootstrapButtons.fire({
                            title: "Cancelado",
                            text: "La historia no ha sido modificada",
                            icon: "error"
                        });
                    }
                });
            }
        }
        else if ($(this).text() == "ELIMINAR") {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: "btn btn-success",
                    cancelButton: "btn btn-danger"
                },
                buttonsStyling: false
            });
            swalWithBootstrapButtons.fire({
                title: "¿Estás seguro?",
                text: "No podrás revertir esto!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Sí, eliminar!",
                cancelButtonText: "No, cancelar!",
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    var datos = new FormData();
                    datos.append('accion', 'eliminar');
                    datos.append('nombre', $("#nombre").val());
                    datos.append('id', $("#id").val()); // Agregamos el ID si está disponible
                    enviaAjax(datos);
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    swalWithBootstrapButtons.fire({
                        title: "Cancelado",
                        text: "El registro no ha sido eliminado",
                        icon: "error"
                    });
                }
            });
        }


    });

   
    $("#incluir").on("click", function () {
        limpia(); // Limpia los campos antes de abrir el modal
        $("#proceso").text("INCLUIR"); // Cambia el texto del botón
        $("#modal1").modal("show"); // Muestra el modal
    });
});
// Manejo del clic en el botón incluir
$("#odontomodal").on("click", function () {
    $("#miModal").modal("show");
    $("#miModal").modal("hide"); // Muestra el modal
});
$("#cierrate").on("click", function () {
    $("#miModal").modal("hide");// Muestra el modal
});
document.addEventListener('DOMContentLoaded', function () {
    // Botón para generar imagen
    document.getElementById('generar-pdf').addEventListener('click', function () {
        const iframe = document.querySelector('#miModal iframe');
        const iframeDoc = iframe.contentDocument || iframe.contentWindow.document;

        html2canvas(iframeDoc.body, {
            scale: 4,
            useCORS: true,
            logging: true,
            backgroundColor: '#FFFFFF'
        }).then(canvas => {
            // Convierte el canvas a imagen PNG y la descarga
            const imgData = canvas.toDataURL('image/png');
            const link = document.createElement('a');
            link.href = imgData;
            link.download = 'odontograma.png';
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        }).catch(error => {
            console.error('Error al generar imagen:', error);
            alert('No se pudo generar la imagen. Ver consola para detalles.');
        });
    });
});
function validarenvio() {
    if ($("#nombre").val() == "") {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'El nombre es obligatorio'
        });
        return false;
    }
    if ($("#Apellido").val() == "") {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'El apellido es obligatorio'
        });
        return false;
    }
    if ($("#Sexo").val() == null || $("#Sexo").val() == "") {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Debe seleccionar el sexo del paciente'
        });
        return false;
    }
    if ($("#Ocupacion").val() == "") {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'La ocupación es obligatoria'
        });
        return false;
    }
    if ($("#PersonaContacto").val() == "") {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'El número de contacto de emergencia es obligatorio'
        });
        return false;
    }
    if ($("#dientesafectados").val() == null || $("#dientesafectados").val() == "") {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Debe seleccionar el diente afectado'
        });
        return false;
    }
    return true;
}

function validarkeypress(er, e) {
    key = e.keyCode;
    tecla = String.fromCharCode(key);
    a = er.test(tecla);
    if (!a) {
        e.preventDefault(); // Previene la entrada si no coincide con la expresión regular
    }
}

function validarkeyup(er, etiqueta, etiquetamensaje, mensaje) {
    // Valida el valor del campo al soltar la tecla
    a = er.test(etiqueta.val());
    if (a) {
        etiquetamensaje.text(""); // Limpia el mensaje si es válido
        return 1; // Retorna 1 si es válido
    } else {
        etiquetamensaje.text(mensaje); // Muestra el mensaje de error
        return 0; // Retorna 0 si no es válido
    }
}

function pone(pos, accion) {
    // Función para llenar el formulario con los datos del empleado seleccionado
    linea = $(pos).closest('tr');

    if (accion == 0) {
        $("#proceso").text(" MODIFICAR");
        $("#nombre").prop("disabled", false);
        $("#Apellido").prop("disabled", false);
        $("#Sexo").prop("disabled", true);
        $("#telefono").prop("disabled", false);
        $("#Ocupacion").prop("disabled", false);
        $("#PersonaContacto").prop("disabled", false);
        $("#Edad").prop("disabled", false);
        $("#correo").prop("disabled", false);
        $("#motivo").prop("disabled", false);
        $("#diagnostico").prop("disabled", false);
        $("#tratamiento").prop("disabled", false);
        $("#medicamentos").prop("disabled", false);
        $("#dientesafectados").prop("disabled", false);
        $("#antecedentes").prop("disabled", false);
        $("#fechaconsulta").prop("disabled", false);
        $("#proximacita").prop("disabled", false);
        $("#observaciones").prop("disabled", false);
    } 
    
    else {
        $("#proceso").text(" ELIMINAR");
        $("#nombre").prop("disabled", true);
        $("#Apellido").prop("disabled", true);
        $("#Sexo").prop("disabled", true);
        $("#telefono").prop("disabled", true);
        $("#Ocupacion").prop("disabled", true);
        $("#PersonaContacto").prop("disabled", true);
        $("#Edad").prop("disabled", true);
        $("#correo").prop("disabled", true);
        $("#motivo").prop("disabled", true);
        $("#diagnostico").prop("disabled", true);
        $("#tratamiento").prop("disabled", true);
        $("#medicamentos").prop("disabled", true);
        $("#dientesafectados").prop("disabled", true);
        $("#antecedentes").prop("disabled", true);
        $("#fechaconsulta").prop("disabled", true);
        $("#proximacita").prop("disabled", true);
        $("#observaciones").prop("disabled", true);
    }
    // Llena los campos del formulario con los datos de la fila seleccionada



    var nombreCompleto = $(linea).find("td:eq(3)").text().trim();
    var partes = nombreCompleto.split(" ");
    var nombre = partes[0];
    var apellido = partes[1];

    $("#nombre").val(nombre);
    $("#Apellido").val(apellido);
    $("#Sexo").val($(linea).find("td:eq(4)").text());
    $("#telefono").val($(linea).find("td:eq(8)").text());
    $("#Ocupacion").val($(linea).find("td:eq(9)").text());
    $("#PersonaContacto").val($(linea).find("td:eq(10)").text());
    $("#Edad").val($(linea).find("td:eq(11)").text());
    $("#correo").val($(linea).find("td:eq(12)").text());
    $("#motivo").val($(linea).find("td:eq(13)").text());
    $("#diagnostico").val($(linea).find("td:eq(14)").text());
    $("#tratamiento").val($(linea).find("td:eq(15)").text());
    $("#medicamentos").val($(linea).find("td:eq(16)").text());
    $("#dientesafectados").val($(linea).find("td:eq(17)").text());
    $("#antecedentes").val($(linea).find("td:eq(18)").text());
    $("#fechaconsulta").val($(linea).find("td:eq(19)").text());
    $("#proximacita").val($(linea).find("td:eq(20)").text());
    $("#observaciones").val($(linea).find("td:eq(21)").text());
    $("#modal1").modal("show"); // Muestra el modal
}

function enviaAjax(datos) {
    // Envía datos al servidor mediante AJAX
    $.ajax({
        async: true,
        url: "", // URL del servidor
        type: "POST",
        contentType: false,
        data: datos,
        processData: false,
        cache: false,
        beforeSend: function () {
            $("#loader").show(); // Mostrar loader 
        },
        timeout: 10000, // Tiempo de espera
        success: function (respuesta) {
            try {
                var lee = JSON.parse(respuesta);
                if (lee.resultado == "consultar") {
                    destruyeDT();
                    let filas = "";
                    (lee.mensaje || []).forEach(function(p,idx) {
                        filas += `<tr class='text-center'>
                            <td class='align-middle'>${idx+1}</td>
                            <td class='align-middle'>${p.nombre} ${p.apellido}</td>
                            <td class='align-middle'>${p.edad}</td>
                            <td class='align-middle'>${p.ocupacion}</td>
                            <td class='align-middle'>${p.persona_contacto}</td>
                            <td class='align-middle'>${p.diagnostico}</td>
                            <td class='align-middle'>${p.tratamiento}</td>
                            <td class='align-middle'>${p.medicamentos}</td>
                            <td class='align-middle'>${p.dientesafectados}</td>
                            <td class='align-middle'>${p.antecedentes}</td>
                            <td class='align-middle'>${p.fechaconsulta}</td>
                            <td class='align-middle'>${p.proximacita}</td>
                            <td class='align-middle'>${p.observaciones}</td>
                            <td class='align-middle'>${p.sexo}</td>
                            <td class='align-middle'>${p.telefono}</td>
                            <td class='align-middle' style='display: flex; justify-content: center;'>
                                <button type='button' class='btn-sm btn-primary w-50 small-width mb-1' onclick='verDetalle(this)' title='Ver detalle' style='margin:.2rem; width: 40px !important;'><i class='bi bi-eye-fill'></i></button><br/>
                                <button type='button' class='btn-sm btn-info w-50 small-width mb-1' onclick='pone(this,0)' title='Modificar rol' style='margin:.2rem; width: 40px !important;'><i class='bi bi-arrow-repeat'></i></button><br/>
                                <button type='button' class='btn-sm btn-danger w-50 small-width mt-1' onclick='pone(this,1)' title='Eliminar rol' style='margin:.2rem; width: 40px !important;'><i class='bi bi-trash-fill'></i></button><br/>
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
                            text: "El empleado ha sido incluido con éxito.",
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
                else if (lee.resultado == "modificar") {
                    Swal.fire({
                        title: lee.mensaje.includes('éxito') ? "¡Modificado!" : "Error",
                        text: lee.mensaje,
                        icon: lee.mensaje.includes('éxito') ? "success" : "error"
                    });
                    if(lee.mensaje.includes('éxito')){
                        $("#modal1").modal("hide");
                        consultar();
                    }
                }
                else if (lee.resultado == "eliminar") {
                    Swal.fire({
                        title: lee.mensaje == '¡Registro eliminado con exito!' ? "¡Eliminado!" : "Error",
                        text: lee.mensaje,
                        icon: lee.mensaje == '¡Registro eliminado con exito!' ? "success" : "error"
                    });
                    if(lee.mensaje == '¡Registro eliminado con exito!'){
                        $("#modal1").modal("hide");
                        consultar();
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
            // Manejo de errores en la solicitud AJAX
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
    // Limpia los campos del formulario
    // Limpia todos los campos del formulario y habilita los necesarios
    $("#nombre").val("").prop("disabled", false);
    $("#Apellido").val("").prop("disabled", false);
    $("#Ocupacion").val("").prop("disabled", false);
    $("#Sexo").prop("selectedIndex", 0).prop("disabled", false);
    $("#PersonaContacto").val("").prop("disabled", false);
    $("#telefono").val("").prop("disabled", false);
    $("#Edad").val("").prop("disabled", false);
    $("#correo").val("").prop("disabled", false);
    $("#motivo").val("").prop("disabled", false);
    $("#diagnostico").val("").prop("disabled", false);
    $("#tratamiento").val("").prop("disabled", false);
    $("#medicamentos").val("").prop("disabled", false);
    $("#dientesafectados").val("").prop("disabled", false);
    $("#antecedentes").val("").prop("disabled", false);
    $("#fechaconsulta").val("").prop("disabled", false);
    $("#proximacita").val("").prop("disabled", false);
    $("#observaciones").val("").prop("disabled", false);
    $("#cedula").val("").prop("disabled", true);



    // Limpia mensajes de error si existen
    $("#snombre").text("");
    $("#sApellido").text("");
    // Limpia el mensaje de error
    /*$("#descripcion").val("");
    $("#imagen").val("");
    $("#imagen_actual").attr("src", "").hide(); // Oculta la imagen actual
    $("#nombre").prop("disabled", false); // Habilita el campo nombre
    $("#descripcion").prop("disabled", false); // Habilita el campo descripción
    $("#imagen").prop("disabled", false); // Habilita el campo imagen*/
}

/*
$("#imagen").on("change", function () {
    const file = this.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
            $("#imagen_actual")
                .attr("src", e.target.result)
                .show();
        };
        reader.readAsDataURL(file);
    } else {
        $("#imagen_actual")
            .attr("src", "")
            .hide();
    }
});*/

document.getElementById('buscadorPacientes').addEventListener('keyup', function() {
    let filtro = this.value.toLowerCase();
    let filas = document.querySelectorAll('#resultadoconsulta tr');
    filas.forEach(function(fila) {
        let texto = fila.textContent.toLowerCase();
        fila.style.display = texto.includes(filtro) ? '' : 'none';
    });
});
// Espera a que el DOM esté listo
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('tablaPacientes').addEventListener('click', function(e) {
        let tr = e.target.closest('tr');
        // Solo continuar si el clic fue en una fila del tbody
        if (tr && tr.parentNode.tagName === 'TBODY') {
            // Si el clic fue en un botón o enlace dentro de la fila, NO abrir el modal
            if (
                e.target.tagName === 'BUTTON' ||
                e.target.tagName === 'A' ||
                e.target.closest('button') ||
                e.target.closest('a') ||
                e.target.classList.contains('btn-modificar') ||
                e.target.classList.contains('btn-eliminar')
            ) {
                return;
            }
            // Si el clic fue en la última columna (acciones), NO abrir el modal
            const accionesTd = tr.querySelector('td:last-child');
            if (accionesTd && (accionesTd.contains(e.target) || accionesTd === e.target)) {
                return;
            }
            // Mostrar el modal con los datos
            const tds = tr.querySelectorAll('td');
            if (tds.length > 0) {
                const campos = [
                    'Numero',
                    '',
                    'Nombre',
                    'Apellido',
                    'Teléfono',
                    'Correo',
                    'Edad',
                    'Sexo',
                    'Ocupación',
                    'Persona de Contacto',
                    'Diagnóstico',
                    'Tratamiento',
                    'Medicamentos',
                    'Dientes Afectados',
                    'Antecedentes',
                    'Fecha de Consulta',
                    'Próxima Cita',
                    'Observaciones'
                    
                    
                ];
                let html = '';
                tds.forEach((td, idx) => {
                    if (idx < campos.length) {
                        html += `<li class="list-group-item"><strong>${campos[idx]}:</strong> ${td.textContent}</li>`;
                    }
                });
                document.getElementById('camposModeloLista').innerHTML = html;
                const modal = new bootstrap.Modal(document.getElementById('modalModelo'));
                modal.show();
            }
        }
    });
});
