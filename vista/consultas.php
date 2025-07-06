<?php
require_once("comunes/encabezado.php");
require_once('comunes/menu.php');
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO"
    crossorigin="anonymous"></script>
<br>
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800"><i class="bi bi-clipboard2-pulse me-2"></i> GESTIONAR CONSULTAS</h1>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-info">LISTADO DE CONSULTAS</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle table-sm" id="tablaconsulta">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>            
                            <th class="text-center d-none">ID ESPECIALISTA</th>
                            <th class="text-center d-none">DOCUMENTO DEL ESPECIALISTA</th>
                            <th class="text-center">ESPECIALISTA</th>
                            <th class="text-center d-none">ID PACIENTE</th>
                            <th class="text-center d-none">DOCUMENTO</th>
                            <th class="text-center">NOMBRE Y APELLIDO</th>
                            <th class="text-center d-none">FECHA DE NACIMIENTO</th>
                            <th class="text-center d-none">EDAD</th>
                            <th class="text-center d-none">CLASIFICACION</th>
                            <th class="text-center d-none">GENERO</th>
                            <th class="text-center d-none">EMAIL</th>
                            <th class="text-center d-none">TELEFONO</th>
                            <th class="text-center d-none">CONTACTO EMERGENCIA</th>
                            <th class="text-center d-none">DIRECCION</th>
                            <th class="text-center d-none">OCUPACION</th>
                            <th class="text-center d-none">ALERGIAS</th>
                            <th class="text-center d-none">ANTECEDENTES</th>
                            <th class="text-center d-none">MEDICAMENTOS</th>
                            <th class="text-center d-none">CEDULA DEL REPRESENTANTE</th>
                            <th class="text-center d-none">NOMBRE DEL REPRESENTANTE</th>
                            <th class="text-center d-none">FECHA DE REGISTRO</th>
                            <th class="text-center">FECHA Y HORA</th>
                            <th class="text-center">ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody id="resultadoconsulta">
                        <!-- Aquí se cargarán dinámicamente los datos de los consulta -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal para agregar o editar consulta -->
<div class="modal fade" tabindex="-1" role="dialog" id="modal1" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen" role="document">
        <div class="modal-content" style="width:100vw">
            <form method="post" id="f" autocomplete="off" enctype="multipart/form-data">
                <div class="modal-header bg-info text-black" id="hm">
                    <h5 class="modal-title bi bi-clipboard2-pulse me-2"> CONSULTA</h5>
                </div>
                <div class="modal-body" style="max-height: 75vh; overflow-y: auto;">
                    <input autocomplete="off" type="text" class="form-control" name="accion" id="accion" hidden>
                    <div class="card shadow row mb-4 ml-4 mr-4" id="pacientecard">
                        <div class="row mb-2 mt-2 ml-1">
                            <h6 class="text-center">DATOS DEL ESPECIALISTA</h6>
                            <input class="form-control" type="text" id="id_especialista" hidden>
                        </div>
                        <div class="row mb-3 ml-1">
                            <div class="col-md-1">
                                <label for="tipo_documento_especialista">TIPO</label>
                                <input autocomplete="off" class="form-control" type="text" id="tipo_documento_especialista" title="El número de cédula no puede ser modificado..." placeholder="Ejemplo: 12345678" minlength="7" maxlength="11"/>
                            </div>
                            <div class="col-md-3 pl-0">
                                <label for="cedula_especialista">DOCUMENTO</label>
                                <input autocomplete="off" class="form-control" type="text" id="cedula_especialista" title="El número de cédula no puede ser modificado..." placeholder="Ejemplo: 12345678" minlength="7" maxlength="11"/>
                            </div>
                            <div class="col-md-4">
                                <label for="nombre_especialista" class="form-label">NOMBRE</label>
                                <input autocomplete="off" class="form-control" type="text" id="nombre_especialista" name="nombre_especialista" required>
                            </div>
                            <div class="col-md-4">
                                <label for="apellido_especialista" class="form-label">APELLIDO</label>
                                <input autocomplete="off" class="form-control" type="text" id="apellido_especialista" name="apellido_especialista" required>
                            </div>
						</div>
                    </div>
                    <div class="card shadow row mb-4 ml-4 mr-4" id="pacientecard">
                        <div class="row mb-2 mt-2 ml-1">
                            <h6 class="text-center">DATOS DEL PACIENTE</h6>
                        </div>
                        <div class="row mb-3 ml-1">
                            <div class="col-md-2">
                                <label for="id_paciente">CODIGO</label>
                                <input class="form-control" autocomplete="off" type="text" id="id_paciente" style="text-align:center;color:black;">
                            </div>
                            <div class="col-md-1">
                                <label for="tipo_documento">TIPO</label>
                                <select class="form-control" id="tipo_documento">
									<option value="" selected disabled>SELECCIONE UNA OPCION</option>
									<option value="V" title="Cédula Venezolana">V</option>
									<option value="E" title="Cédula Extranjera">E</option>
								</select>
                            </div>
                            <div class="col-md-3" style="padding-left:0px;">
                                <label for="cedula">DOCUMENTO</label>
                                <input autocomplete="off" class="form-control" type="text" id="cedula" title="El número de cédula no puede ser modificado..." placeholder="Ejemplo: 12345678" minlength="7" maxlength="11"/>
                                <span id="scedula"></span>
                            </div>
                            <div class="col-md-3">
                                <label for="nombre" class="form-label">NOMBRE</label>
                                <input autocomplete="off" class="form-control" type="text" id="nombre" name="nombre" required>
                                <span id="snombre"></span>
                            </div>
                            <div class="col-md-3">
                                <label for="apellido" class="form-label">APELLIDO</label>
                                <input autocomplete="off" class="form-control" type="text" id="apellido" name="apellido" required>
                                <span id="sapellido"></span>
                            </div>
						</div>
                        <div class="row mb-3 ml-1">
                            <div class="col-md-4">
                                <label for="fecha_nacimiento">FECHA DE NACIMIENTO</label>
                                <input autocomplete="off" class="form-control" type="date" id="fecha_nacimiento" />
                            </div>
                            <div class="col-md-2">
                                <label for="edad" class="form-label">EDAD</label>
                                <input autocomplete="off" class="form-control" type="text" id="edad" name="edad" required>
                            </div>
                            <div class="col-md-3">
                                <label for="clasificacion" class="form-label">CLASIFICACION</label>
                                <input autocomplete="off" class="form-control" type="text" id="clasificacion" name="clasificacion" required>
                                <span id="sclasificacion"></span>
                            </div>
                            <div class="col-md-3">
                                <label for="genero" class="form-label">GENERO</label>
                                <select class="form-select" id="genero"required>
                                    <option value="" selected disabled>SELECCIONE UNA OPCION</option>
                                    <option value="M">MASCULINO</option>
                                    <option value="F">FEMENINO</option>
                                    <option value="O">OTRO</option>
                                </select>
                            </div>
						</div>
                        <div class="row mb-3 ml-1">
                            <div class="col-md-4">
                                <label for="email">CORREO</label>
                                <input autocomplete="off" class="form-control" type="email" id="email" />
                                <span id="semail"></span>
                            </div>
                            <div class="col-md-4">
                                <label for="telefono" class="form-label">TELEFONO</label>
                                <input autocomplete="off" class="form-control" type="text" id="telefono" name="telefono" required>
                                <span id="stelefono"></span>
                            </div>
                            <div class="col-md-4">
                                <label for="contacto_emergencia">CONTACTO DE EMERGENCIA</label>
                                <input autocomplete="off" class="form-control" type="text" id="contacto_emergencia" />
                                <span id="scontacto_emergencia"></span>
                            </div>
						</div>
                        <div class="row mb-3 ml-1">
                            <div class="col-md-12">
                                <label for="direccion" class="form-label">DIRECCION</label>
                                <input autocomplete="off" class="form-control" type="text" id="direccion" name="direccion" required>
                                <span id="sdireccion"></span>
                            </div>
						</div>
                        <div class="row mb-3 ml-1">
                            <div class="col-md-12">
                                <label for="ocupacion">OCUPACION</label>
                                <input autocomplete="off" class="form-control" type="text" id="ocupacion" />
                                <span id="socupacion"></span>
                            </div>
                        </div>
                        <div class="row mb-3 ml-1">
                            <div class="col-md-4">
                                <label for="alergias">ALERGIAS</label>
                                <input autocomplete="off" class="form-control" type="text" id="alergias" />
                                <span id="salergias"></span>
                            </div>
                            <div class="col-md-4">
                                <label for="antecedentes">ANTECEDENTES</label>
                                <input autocomplete="off" class="form-control" type="text" id="antecedentes" />
                                <span id="santecedentes"></span>
                            </div>
                            <div class="col-md-4">
                                <label for="medicamentos">MEDICAMENTOS</label>
                                <input autocomplete="off" class="form-control" type="text" id="medicamentos" />
                                <span id="smedicamentos"></span>
                            </div>
						</div>
                        <div class="row mb-3 ml-1">
                            <div class="col-md-3">
                                <label for="cedula_representante">CEDULA DE REPRESENTANTE</label>
                                <input autocomplete="off" class="form-control" type="text" id="cedula_representante" />
                                <span id="scedula_representante"></span>
                            </div>
                            <div class="col-md-5">
                                <label for="nombre_representante">NOMBRE DEL REPRESENTANTE</label>
                                <input autocomplete="off" class="form-control" type="text" id="nombre_representante" />
                                <span id="snombre_representante"></span>
                            </div>
                            <div class="col-md-4">
                                <label for="fecha_registro">FECHA DE REGISTRO</label>
                                <input autocomplete="off" class="form-control" type="date" id="fecha_registro" />
                                <span id="sfecha_registro"></span>
                            </div>
                        </div>
                    </div>
                    <div class="card shadow row mb-4 ml-4 mr-4" id="pacientecard">
                        <div class="row mb-2 mt-2 ml-1">
                            <h6 class="text-center">DATOS DE LA CONSULTA</h6>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-12">
                                <label for="tratamiento" class="form-label">TRATAMIENTO REALIZADO (Descripción Libre)</label>
                                <textarea class="form-control" id="tratamiento" name="tratamiento" rows="3" placeholder="Describa el tratamiento. Ej: 1 Restauración de resina en diente 3.6, 1 Extracción de cordal inferior." disabled></textarea>
                                <span class="text-danger" id="stratamiento"></span>
                            </div>
                        </div>
                        <div class="row mb-3 ml-1">
                            <div class="col-md-9">
                                <label for="select_tratamiento_add" class="form-label">AÑADIR A LA LISTA</label>
                                <select class="form-select" id="select_tratamiento_add" style="width: 100%;">
                                    <option value="">Buscar y añadir tratamiento de la lista...</option>
                                    <optgroup label="ORTODONCIA">
                                        <option value="INST. * LIMPIEZA">INST. * LIMPIEZA</option>
                                        <option value="MEDIA INSTALACION">MEDIA INSTALACION</option>
                                        <option value="DESINTAJACION">DESINTAJACION</option>
                                        <option value="CONTROL">CONTROL</option>
                                        <option value="TUBOS">TUBOS</option>
                                        <option value="REPOSICION BRACKETS">REPOSICION BRACKETS</option>
                                        <option value="RESORTE">RESORTE</option>
                                        <option value="BOTTONES">BOTTONES</option>
                                        <option value="TOPE 1">TOPE 1</option>
                                        <option value="TOPE 2">TOPE 2</option>
                                        <option value="LIGAS INTERMAXILARES">LIGAS INTERMAXILARES</option>
                                    </optgroup>
                                    <optgroup label="RX (Radiografías)">
                                        <option value="PENAPICAL">PENAPICAL</option>
                                        <option value="PERIAPICAL MILIMETRADA">PERIAPICAL MILIMETRADA</option>
                                        <option value="BITEWING">BITEWING</option>
                                        <option value="A.T.M">A.T.M</option>
                                        <option value="SENOS MAXILARES">SENOS MAXILARES</option>
                                        <option value="CEFALICA LATERAL">CEFALICA LATERAL</option>
                                        <option value="CEFALICA OBLICUA">CEFALICA OBLICUA</option>
                                        <option value="CEFALICA P.A">CEFALICA P.A</option>
                                    </optgroup>
                                    <optgroup label="GENERALES">
                                        <option value="CONSULTA">CONSULTA</option>
                                        <option value="LIMPIEZA SIMPLE">LIMPIEZA SIMPLE</option>
                                        <option value="LIMPIEZA PROFUNDA">LIMPIEZA PROFUNDA</option>
                                        <option value="PROVISIONAL">PROVISIONAL</option>
                                        <option value="RESTAURACION 1">RESTAURACION 1</option>
                                        <option value="RESTAURACION 2">RESTAURACION 2</option>
                                        <option value="RESTAURACION 3">RESTAURACION 3</option>
                                        <option value="RESTAURACION 4">RESTAURACION 4</option>
                                        <option value="RESTAURACION 5">RESTAURACION 5</option>
                                        <option value="CARILLA O RECONSTRUCCIÓN">CARILLA O RECONSTRUCCIÓN</option>
                                        <option value="EXTRACCIÓN DE LECHE O CON MOVILIDAD">EXTRACCIÓN DE LECHE O CON MOVILIDAD</option>
                                        <option value="EXTRACCIONES (1)">EXTRACCIONES (1)</option>
                                        <option value="EXTRACCIONES (2)">EXTRACCIONES (2)</option>
                                        <option value="EXTRACCIONES (3)">EXTRACCIONES (3)</option>
                                        <option value="EXTRACCIONES (4)">EXTRACCIONES (4)</option>
                                        <option value="PROTEST">PROTEST</option>
                                        <option value="DISEÑO DE SONRISA">DISEÑO DE SONRISA</option>
                                        <option value="FERULA DE BRUXIMO">FERULA DE BRUXIMO</option>
                                        <option value="BLANQUEAMIENTO">BLANQUEAMIENTO</option>
                                    </optgroup>
                                    <optgroup label="ENDODONCIA">
                                        <option value="MULTI (MUELAS)">MULTI (MUELAS)</option>
                                        <option value="MONO V (B) CENTRALES Y PREMOLARES">MONO V (B) CENTRALES Y PREMOLARES</option>
                                        <option value="RETRATAMIENTO DE CONDUCTO">RETRATAMIENTO DE CONDUCTO</option>
                                    </optgroup>
                                    <optgroup label="CIRUJANO MAXILOFACIAL">
                                        <option value="EXTRACCIONES DE CORDALES SIMPLES (1)">EXTRACCIONES DE CORDALES SIMPLES (1)</option>
                                        <option value="EXTRACCIONES DE CORDALES SIMPLES (2)">EXTRACCIONES DE CORDALES SIMPLES (2)</option>
                                        <option value="EXTRACCIONES DE CORDALES COMPLEJAS (1)">EXTRACCIONES DE CORDALES COMPLEJAS (1)</option>
                                        <option value="EXTRACCIONES DE CORDALES COMPLEJAS (2)">EXTRACCIONES DE CORDALES COMPLEJAS (2)</option>
                                        <option value="CANINOS O DIENTES RETENIDOS">CANINOS O DIENTES RETENIDOS</option>
                                        <option value="SEDACIÓN">SEDACIÓN</option>
                                        <option value="UDPAPAPADA">UDPAPAPADA</option>
                                        <option value="BICHEPTOMIA">BICHEPTOMIA</option>
                                        <option value="LESIONES DE TEJIDO BLANCO">LESIONES DE TEJIDO BLANCO</option>
                                        <option value="REGULARISACIÓN OSIA">REGULARISACIÓN OSIA</option>
                                        <option value="TORUS">TORUS</option>
                                    </optgroup>
                                    <optgroup label="ODONTOPEDIATRA">
                                        <option value="CONSULTA CON PROFILAXIS">CONSULTA CON PROFILAXIS</option>
                                        <option value="RESTAURACION (1)">RESTAURACION (1)</option>
                                        <option value="RESTAURACION (2)">RESTAURACION (2)</option>
                                        <option value="CORONAS ANTERIORES">CORONAS ANTERIORES</option>
                                        <option value="TERAPIAS PULPARES (1)">TERAPIAS PULPARES (1)</option>
                                        <option value="TERAPIAS PULPARES (2)">TERAPIAS PULPARES (2)</option>
                                        <option value="EKODONCIA">EKODONCIA</option>
                                        <option value="OJAL QUIRURJICO">OJAL QUIRURJICO</option>
                                        <option value="EMERGENCIA POR TRAUMATISMO A PARTIR DE:">EMERGENCIA POR TRAUMATISMO A PARTIR DE:</option>
                                        <option value="SELLANTES">SELLANTES</option>
                                        <option value="MANTENEDOR DE ESPACIOS A PARTIR DE:">MANTENEDOR DE ESPACIOS A PARTIR DE:</option>
                                        <option value="APAROTOLOGIA REMOVIBLE A PARTIR DE:">APAROTOLOGIA REMOVIBLE A PARTIR DE:</option>
                                        <option value="INCRUSTACIONES PARA MOLARES CON HIM">INCRUSTACIONES PARA MOLARES CON HIM</option>
                                    </optgroup>
                                </select>
                            </div>
                            <div class="col-md-3 d-flex align-items-end">
                                <button type="button"  class="btn btn-outline-info btn-sm me-2" id="btn_add_tratamiento">
                                    <i class="bi bi-plus-square"></i> AÑADIR
                                </button>
                                <button type="button" class="btn btn-outline-warning btn-sm" id="btn_clear_tratamiento" title="Limpiar tratamiento">
                                    <i class="bi bi-eraser"></i> LILMPIAR
                                </button>
                            </div>
                        </div>
                        <div class="row mb-3 ml-1">
                            <div class="col-md-8">
                                <label for="observaciones">OBSERVACIONES</label>
                                <input autocomplete="off" class="form-control" type="text" id="observaciones" />
                                <span id="sobservaciones"></span>
                            </div>
                            <div class="col-md-4">
                                <label for="fecha_consulta">FECHA DE CONSULRA</label>
                                <input autocomplete="off" class="form-control" type="date" id="fecha_consulta" />
                                <span id="sfecha_consulta"></span>
                            </div>
                        </div>
                    </div>
                    <div class="card shadow row mb-4 ml-4 mr-4" id="pacientecard">
                        <div class="row mb-2 mt-2 ml-1">
                            <h6 class="text-center">PROXIMA CITA</h6>
                        </div>
                        <div class="row mb-3 ml-1">
                            <div class="col-md-6">
                                <label for="fecha_cita" class="form-label">FECHA DE LA PROXIMA CITA</label>
                                <input autocomplete="off" class="form-control" type="date" id="fecha_cita" name="fecha_cita" required>
                                <span id="sfecha_cita"></span>
                            </div>
                            <div class="col-md-6">
                                <label for="hora_cita" class="form-label">HORA DE LA PROXIMA CITA</label>
                                <input autocomplete="off" class="form-control" type="time" id="hora_cita" name="hora_cita" required>
                                <span id="shora_cita"></span>
                            </div>
						</div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x-circle"></i> CERRAR</button>
                    <button type="button" class="btn btn-info bi bi-check-circle" id="proceso"></button>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript" src="js/consultas.js"></script>
<div id="loader" class="loader-container" style="display: none;">
    <div class="loader"></div>
    <p>Procesando solicitud...</p>
</div>
</body>
</html>