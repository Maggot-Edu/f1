<?php

    session_start();


    $titulo = "Nombre de la pagina";
    require_once "includes/cabecera.php";
    // Comprobamos si esta logueado o no
    if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
        if ($_SESSION["perfil"] == "admin") {
            require_once "includes/menu_admin.php";
        } else {
            require_once "includes/menu_user.php";
        }
    } else {
        require_once "includes/menu.php";
    }
?>

<div class="container mt-5">
    <div class="row">
        <div class="col-sm-12">
            <!-- tabla que mostrara todos los pilotos -->
            <table class="table table-striped table-bordered table-hover" id="tablaPilotos">
                <thead>
                    <tr>
                        <td>IdPiloto</td>
                        <td>NombrePiloto</td>
                        <td>FechaNaciPiloto</td>
                        <td>EdadPiloto</td>
                        <td>LugarNaciPiloto</td>
                        <td>NacionalidadPiloto</td>
                        <td>InfoPiloto</td>
                        <td>InstaPiloto</td>
                        <td>TwitterPiloto</td>
                        <td>FotoPiloto</td>
                    </tr>
                </thead>
            </table>
            <button class="btn btn-sm btn-primary" id="botonAgregar">Agregar piloto</button>
        </div>

        <!-- Formulario de Agregar y Modificar -->
        <div class="modal fade" id="formularioPiloto" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- <input type="hidden" id="IdPiloto"> -->
                        <div class="from-row">
                            <div class="from-group col-md-12">
                                <label>Nombre Corto:</label>
                                <input type="text" id="IdPiloto" class="from-control" placeholder="">
                            </div>
                        </div>
                        <div class="from-row">
                            <div class="from-group col-md-12">
                                <label>Nombre Piloto:</label>
                                <input type="text" id="NombrePiloto" class="from-control" placeholder="">
                            </div>
                        </div>
                        <div class="from-row">
                            <div class="from-group col-md-12">
                                <label>Fecha Nacimiento:</label>
                                <input type="text" id="FechaNaciPiloto" class="from-control" placeholder="">
                            </div>
                        </div>
                        <div class="from-row">
                            <div class="from-group col-md-12">
                                <label>Edad del Piloto:</label>
                                <input type="text" id="EdadPiloto" class="from-control" placeholder="">
                            </div>
                        </div>
                        <div class="from-row">
                            <div class="from-group col-md-12">
                                <label>Lugar Nacimineto:</label>
                                <input type="text" id="LugarNaciPiloto" class="from-control" placeholder="">
                            </div>
                        </div>
                        <div class="from-row">
                            <div class="from-group col-md-12">
                                <label>Nacionalidad:</label>
                                <input type="text" id="NacionalidadPiloto" class="from-control" placeholder="">
                            </div>
                        </div>
                        <div class="from-row">
                            <div class="from-group col-md-12">
                                <label>Informacion breve:</label>
                                <input type="text" id="InfoPiloto" class="from-control" placeholder="">
                            </div>
                        </div>
                        <div class="from-row">
                            <div class="from-group col-md-12">
                                <label>Instagram:</label>
                                <input type="text" id="InstaPiloto" class="from-control" placeholder="">
                            </div>
                        </div>
                        <div class="from-row">
                            <div class="from-group col-md-12">
                                <label>Twitter:</label>
                                <input type="text" id="TwitterPiloto" class="from-control" placeholder="">
                            </div>
                        </div>
                        <div class="from-row">
                            <div class="from-group col-md-12">
                                <label>Foto Piloto:</label>
                                <input type="text" id="FotoPiloto" class="from-control" placeholder="">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="confirmarAgregar" class="btn btn-success">Agregar</button>
                        <button type="button" id="confirmarModificar" class="btn btn-success">Modificar</button>
                        <button type="button" class="btn btn-success" data-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Script JQuery -->

<script>
    document.addEventListener("DOMContentLoaded", function() {
        let tabla1 = $("#tablaPilotos").DataTable({
            "ajax": {
                url: "datos_piloto.php?accion=mostrar",
                dataSrc: ""
            },
            "columns": [{
                    "data": "IdPiloto"
                },
                {
                    "data": "NombrePiloto"
                },
                {
                    "data": "FechaNaciPiloto"
                },
                {
                    "data": "EdadPiloto"
                },
                {
                    "data": "LugarNaciPiloto"
                },
                {
                    "data": "NacionalidadPiloto"
                },
                {
                    "data": "InfoPiloto"
                },
                {
                    "data": "InstaPiloto"
                },
                {
                    "data": "TwitterPiloto"
                },
                {
                    "data": "FotoPiloto"
                },
                {
                    "data": null,
                    "orderable": false
                },
                {
                    "data": null,
                    "orderable": false
                }
            ],
            "columnDefs": [{
                    targets: 3,
                    "defaultContent": "<button class='btn btn-sm btn-primary botonmodificar'>Modificar</button>",
                    data: null 
                },
                {
                    targets: 4,
                    "defaultContent": "<button class='btn btn-sm btn-primary botonborrar'>Borrar</button>",
                    data: null
                }
            ],
            "language": {
                    "url": "DataTables/spanish.json",
            },
        });

        // Evento de los botones
        $('#botonAgregar').click(function(){
            $('#confirmarAgregar').show();
            $('#confirmarModificar').hide();
            limpiarFormulario();
            $('#formularioPiloto').modal('show');
        });

        $('#confirmarAgregar').click(function() {
            $('#formularioPiloto').modal('hide');
            let registro = recuperarDatosFormulario();
            agregarRegistro(registro);
        });

        $('#confirmarModificar').click(function() {
            $('#formularioPiloto').modal('hide');
            let registro = recuperarDatosFormulario();
            modificarRegistro(registro);
        });

        $('#tablaPilotos tbody').on('click', 'button.botonmodificar', function() {
            $('#confirmarAgregar').hide();
            $('#confirmarModificar').show();
            let registro = tabla1.row($(this).parent('tr')).data();
            recuperarRegistro(registro.NomCorto);
        });

        $('#tablaPilotos tbody').on('click', 'button.botonborrar', function() {
            if (confirm("¿Realmente quiere borrar este piloto?")) {
                let registro = tabla1.row($(this).parents('tr')).data();
                borrarRegistro(registro.NomCorto);
            }
        });

        // Funciones 

        function limpiarFormulario() {
            $('#IdPiloto').val('');
            $('#NombrePiloto').val('');
            $('#FechaNaciPiloto').val('');
            $('#EdadPiloto').val('');
            $('#LugarNaciPiloto').val('');
            $('#NacionalidadPiloto').val('');
            $('#InfoPiloto').val('');
            $('#InstaPiloto').val('');
            $('#TwitterPiloto').val('');
            $('#FotoPiloto').val('');
        }

        function recuperarDatosFormulario() {
            let registro = {
                IdPiloto:           $('#IdPiloto').val(),
                NombrePiloto:       $('#NombrePiloto').val(),
                FechaNaciPiloto:    $('#FechaNaciPiloto').val(),
                EdadPiloto:         $('#EdadPiloto').val(),
                LugarNaciPiloto:    $('#LugarNaciPiloto').val(),
                NacionalidadPiloto: $('#NacionalidadPiloto').val(),
                InfoPiloto:         $('#InfoPiloto').val(),
                InstaPiloto:        $('#InstaPiloto').val(),
                TwitterPiloto:      $('#TwitterPiloto').val(),
                FotoPiloto:         $('#FotoPiloto').val()
            },
            return registro;
        }

        // Funcion para comunicarse con el servidor via ajax
        function agregarRegistro(registro) {
            $.ajax({
                type:       'POST',
                url:        'datos_pilotos.php?accion=insertar',
                dato:       'registro',
                success:    function(msg) {
                    tabla1.ajax.reload();
                },
                error:      function() {
                    alert("Hay problemas");
                }
            });
        }

        function borrarRegistro(IdPiloto) {
            $.ajax({
                type:       'GET',
                url:        'datos_pilotos.php?accion=borrar&IdPiloto=' + IdPiloto,
                data:       '',
                success:    function(msg) {
                    tabla1.ajax.reload();
                },
                error:      function() {
                    alert("Hay problemas");
                }
            });
        }

        function recuperarRegistro(IdPiloto) {
            $.ajax({
                type:       'GET',
                url:        'datos_pilotos.php?accion=consultar&IdPiloto=' + IdPiloto,
                data:       '',
                success:    function(datos) {
                    $('#IdPiloto').val(datos[0].IdPiloto);
                    $('#NombrePiloto').val(datos[0].NombrePiloto);
                    $('#FechaNaciPiloto').val(datos[0].FechaNaciPiloto);
                    $('#EdadPiloto').val(datos[0].EdadPiloto);
                    $('#LugarNaciPiloto').val(datos[0].LugarNaciPiloto);
                    $('#NacionalidadPiloto').val(datos[0].NacionalidadPiloto);
                    $('#InfoPiloto').val(datos[0].InfoPiloto);
                    $('#InstaPiloto').val(datos[0].InstaPiloto);
                    $('#TwitterPiloto').val(datos[0].TwitterPiloto);
                    $('#FotoPiloto').val(datos[0].FotoPiloto);
                    $('#formularioPiloto').modal('show');
                },
                error:      function() {
                    alert("Hay problemas");
                }
            });
        }

        function modificarRegistro(registro) {
            $.ajax({
                type:       'POST',
                url:        'datos_pilotos.php?accion=modificar&IdPiloto=' + registro.IdPiloto,
                data:       registro,
                success:    function(msg) {
                    tabla1.ajax.reload();
                },
                error:      function() {
                    alert("Hay problemas");
                }
            });
        }
    });
</script>

<?php
    require_once "includes/footer.php";
?>