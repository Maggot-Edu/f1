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
                        <td>NomCorto</td>
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
                        <input type="hidden" id="IdPiloto">
                        <div class="from-row">
                            <div class="from-group col-md-12">
                                <label>Nombre Corto:</label>
                                <input type="text" id="NomCorto" class="from-control" placeholder="">
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
<?php
    require_once "includes/footer.php";
?>