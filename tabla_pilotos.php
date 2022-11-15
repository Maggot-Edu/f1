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
<div class="container">
    <div class="row">
        <div class="col-12">
            <hr>
            <table class="table table-striped table-bordered table-hover" id="tablaarticulos">
                <thead>
                    <tr>
                        <td>IdPiloto</td>
                        <td>NombrePiloto</td>
                        <td>LugarNaciPiloto</td>
                        <td>NacionalidadPiloto</td>
                        <td>InfoPiloto</td>
                    </tr>
                </thead>
            </table>
            <button class="btn btn-sm btn-primary" id="BotonAgregar">Agregar artículo</button>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="FormularioPilotos" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="Codigo">
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label>NombrePiloto:</label>
                        <input type="text" id="NombrePiloto" class="form-control" placeholder="">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label>LugarNaciPiloto:</label>
                        <input type="text" id="LugarNaciPiloto" class="form-control" placeholder="">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label>NacionalidadPiloto:</label>
                        <input type="text" id="NacionalidadPiloto" class="form-control" placeholder="">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label>InfoPiloto:</label>
                        <input type="text" id="InfoPiloto" class="form-control" placeholder="">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="ConfirmarAgregar" class="btn btn-success">Agregar</button>
                    <button type="button" id="ConfirmarModificar" class="btn btn-success">Modificar</button>
                    <button type="button" class="btn btn-success" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    window.addEventListener("DOMContentLoaded", function() {
        
        let tabla1 = $("#tablaarticulos").DataTable({
            "ajax": {
                url: "datos_pilotos.php?accion=listar",
                dataSrc: "tableData"
            },
            "columns": [{
                    "data": "IdPiloto"
                },
                {
                    "data": "NombrePiloto"
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
                "defaultContent": "<button class='btn btn-sm btn-primary botonmodificar'>Modifica?</button>",
                data: null
            }, {
                targets: 4,
                "defaultContent": "<button class='btn btn-sm btn-primary botonborrar'>Borra?</button>",
                data: null
            }],
            "language": {
                "url": "assets/js/spanish.json",
            },
        });

        //Eventos de botones de la aplicación
        $('#BotonAgregar').click(function() {
            $('#ConfirmarAgregar').show();
            $('#ConfirmarModificar').hide();
            limpiarFormulario();
            $("#FormularioPilotos").modal('show');
        });

        $('#ConfirmarAgregar').click(function() {
            $("#FormularioPilotos").modal('hide');
            let registro = recuperarDatosFormulario();
            agregarRegistro(registro);
        });

        $('#ConfirmarModificar').click(function() {
            $("#FormularioPilotos").modal('hide');
            let registro = recuperarDatosFormulario();
            modificarRegistro(registro);
        });

        $('#tablaarticulos tbody').on('click', 'button.botonmodificar', function() {
            $('#ConfirmarAgregar').hide();
            $('#ConfirmarModificar').show();
            let registro = tabla1.row($(this).parents('tr')).data();
            recuperarRegistro(registro.IdPiloto);
        });

        $('#tablaarticulos tbody').on('click', 'button.botonborrar', function() {
            if (confirm("¿Realmente quiere borrar al piloto?")) {
                let registro = tabla1.row($(this).parents('tr')).data();
                borrarRegistro(registro.IdPiloto);
            }
        });

        // funciones que interactuan con el formulario de entrada de datos
        function limpiarFormulario() {
            $('#IdPiloto').val('');
            $('#NombrePiloto').val('');
            $('#LugarNaciPiloto').val('');
            $('#NacionalidadPiloto').val('');
            $('#InfoPiloto').val('');
        }

        function recuperarDatosFormulario() {
            let registro = {
                IdPiloto: $('#IdPiloto').val(),
                NombrePiloto: $('#NombrePiloto').val(),
                LugarNaciPiloto: $('#LugarNaciPiloto').val(),
                NacionalidadPiloto: $('#NacionalidadPiloto').val(),
                InfoPiloto: $('#InfoPiloto').val()
            };
            return registro;
        }


        // funciones para comunicarse con el servidor via ajax
        function agregarRegistro(registro) {
            $.ajax({
                type: 'POST',
                url: 'datos_pilotos.php?accion=agregar',
                data: registro,
                success: function(msg) {
                    tabla1.ajax.reload();
                },
                error: function() {
                    alert("Hay un problema");
                }
            });
        }

        function borrarRegistro(IdPiloto) {
            $.ajax({
                type: 'GET',
                url: 'datos_pilotos.php?accion=borrar&IdPiloto=' + IdPiloto,
                data: '',
                success: function(msg) {
                    tabla1.ajax.reload();
                },
                error: function() {
                    alert("Hay un problema");
                }
            });
        }

        function recuperarRegistro(IdPiloto) {
            $.ajax({
                type: 'GET',
                url: 'datos_pilotos.php?accion=consultar&IdPiloto=' + IdPiloto,
                data: '',
                success: function(datos) {
                    $('#IdPiloto').val(datos[0].IdPiloto);
                    $('#NombrePiloto').val(datos[0].NombrePiloto);
                    $('#LugarNaciPiloto').val(datos[0].LugarNaciPiloto);
                    $('#NacionalidadPiloto').val(datos[0].NacionalidadPiloto);
                    $('#InfoPiloto').val(datos[0].InfoPiloto);
                    $("#FormularioPilotos").modal('show');
                },
                error: function() {
                    alert("Hay un problema");
                }
            });
        }

        function modificarRegistro(registro) {
            $.ajax({
                type: 'POST',
                url: 'datos_pilotos.php?accion=modificar&IdPiloto=' + registro.IdPiloto,
                data: registro,
                success: function(msg) {
                    tabla1.ajax.reload();
                },
                error: function() {
                    alert("Hay un problema");
                }
            });
        }

    });
</script>
<?php
    require_once "includes/footer.php";
?>