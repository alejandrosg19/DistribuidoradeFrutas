<?php
$alert = 0;
$infoLog = "";
$log;
$mensaje=0;

if (isset($_POST["Crear"])) {
    date_default_timezone_set('America/Bogota');
    $date = date('Y-m-d');
    $hora = date('H:i:s');
    $proveedor = new Proveedor("", $_POST["Nombre"], $_POST["Correo"], $_POST["Password"], $_POST["Rol"]);
    $cliente = new Cliente("", $_POST["Nombre"], $_POST["Correo"], $_POST["Password"], $_POST["Rol"]);
    $administrador = new Administrador("", $_POST["Nombre"], $_POST["Correo"], $_POST["Password"], $_POST["Rol"]);
    $actor;

    if ($proveedor->validarCorreo() || $cliente->validarCorreo() || $administrador->validarCorreo()) {
        $mensaje = 1;
    } else {
        $mensaje = 2;
        if ($_POST["Rol"] == "Comprador") {
            $actor = new Cliente("", $_POST["Nombre"], $_POST["Correo"], $_POST["Password"], $_POST["Rol"]);
            $actor->registrarCliente();
            $actor->traerInfoCorreo();
            $infoLog = "Cliente:" . $actor->getidCliente();
        } else if ($_POST["Rol"] == "Proveedor") {
            $actor = new Proveedor("", $_POST["Nombre"], $_POST["Correo"], $_POST["Password"], $_POST["Rol"]);
            $actor->registrarProveedor();
            $actor->traerInfoCorreo();
            $infoLog = "Proveedor:" . $actor->getIdProveedor();
        } else {
            $actor = new Administrador("", $_POST["Nombre"], $_POST["Correo"], $_POST["Password"], $_POST["Rol"]);
            $actor->registrarAdm();
            $actor->traerInfoCorreo();
            $infoLog = "Adm:" . $actor->getIdAdministrador();
        }
        /**log */
        $log = new Log("", 'Nuevo Usuario', $infoLog, $date, $hora, "Administrador", $_SESSION["id"]);
        $log->insertarLog();
    }
}
?>

<div class="container">
    <div class="row mt-4">
        <div class="col-12">
            <div class="card text-center">
                <div class="card-header bg-light text-dark">
                    Crear Usuario
                </div>
                <div class="card-body">
                    <div class="row p-3">
                        <div class="col-3">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/e/e4/Elliot_Grieveson.png" width="100%" class="img-thumbnail">
                        </div>
                        <div class="col-9">
                            <form action="index.php?pid= <?php echo base64_encode("Vista/Administrador/nuevoUsuario.php") ?>" method="POST">
                                <div class="form-group">
                                    <label for="Nombre">Nombres</label>
                                    <input type="text" class="form-control" name="Nombre" id="Nombre">
                                </div>
                                <div class="form-group">
                                    <label for="Correo">Direccion de correo electrónico</label>
                                    <input type="email" class="form-control" name="Correo" id="Correo" aria-describedby="emailHelp">
                                    <small id="emailHelp" class="form-text text-muted">No compartiremos el correo con nadie más.</small>
                                </div>
                                <div class="form-group">
                                    <label for="Rol">Rol</label>
                                    <select class="form-control" name="Rol" id="Rol">
                                        <option>Comprador</option>
                                        <option>Proveedor</option>
                                        <option>Administrador</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="Password">Password</label>
                                    <input type="password" class="form-control" name="Password" id="Password">
                                </div>
                                <div class="form-group text-center">
                                    <input name="Crear" type="submit" class="btn btn-outline-dark">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php if ($mensaje==2) {
    echo "<div class='modal fade' id='mostrarmodal' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>";
    echo "<div class='modal-dialog '>";
    echo "<div class='modal-content '>";
    echo "<div class='alert alert-success m-0 d-flex justify-content-between'>";
    echo "<div></div>";
    echo "<h5 class='modal-title' id='exampleModalLabel'>Usuario creado correctamente</h5>";
    echo "<button type='button' class='close' data-dismiss='modal' aria-label='Close'>";
    echo "<span aria-hidden='true'>&times;</span>";
    echo "</button>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
} else if ($mensaje==1) {
    echo "<div class='modal fade' id='mostrarmodal' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>";
    echo "<div class='modal-dialog '>";
    echo "<div class='modal-content '>";
    echo "<div class='alert alert-danger m-0 d-flex justify-content-between'>";
    echo "<div></div>";
    echo "<h5 class='modal-title' id='exampleModalLabel'>Ya existe un usuario con ese correo</h5>";
    echo "<button type='button' class='close' data-dismiss='modal' aria-label='Close'>";
    echo "<span aria-hidden='true'>&times;</span>";
    echo "</button>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
} ?>