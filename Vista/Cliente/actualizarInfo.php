<?php
$infoLog = "";
$clienteAux;
$cliAux = new Cliente($_SESSION["id"]);
$cliAux->traerInfo();
$band = false;
if (isset($_POST["Actualizar"])) {
    if ($_FILES["imagen"]["name"] != "") {
        $rutaLocal = $_FILES["imagen"]["tmp_name"];
        $tipo = $_FILES["imagen"]["type"];
        $tiempo = new DateTime();
        $rutaRemota = "Vista/Img/Users/" . $tiempo->getTimestamp() . (($tipo == "image/png") ? ".png" : ".jpg");
        copy($rutaLocal, $rutaRemota);
        $clienteAux = new Cliente($_SESSION["id"]);
        $clienteAux->traerInfo();

        if ($clienteAux->getFoto() != "") {
            unlink($clienteAux->getFoto());
        }
        $cliente = new Cliente($_SESSION["id"], $_POST["Nombre"], $_POST["Correo"], "", "", $rutaRemota);
        $cliente->actualizarInfo();
        $band = true;
    } else if ($cliAux->getNombre() != $_POST["Nombre"] or $cliAux->getCorreo() != $_POST["Correo"]) { /*Se valida que haya cambiado algun campo*/
        $clienteAux = new Cliente($_SESSION["id"]);
        $clienteAux->traerInfo();
        $cliente = new Cliente($_SESSION["id"], $_POST["Nombre"], $_POST["Correo"], "", "", $clienteAux->getFoto());
        $cliente->actualizarInfo();
        $band = true;
    }
    if ($band == true) {
        $infoLog = "Actor:Cliente-Nombre:" . $clienteAux->getNombre() . "-Correo:" . $clienteAux->getCorreo()."-id:" . $clienteAux->getidCliente();
        date_default_timezone_set('America/Bogota');
        $date = date('Y-m-d');
        $hora = date('H:i:s');
        $log = new Log("", 'Actualizar Información', $infoLog, $date, $hora, "Cliente", $clienteAux->getidCliente());
        $log->insertarLog();
    } else {
        $cliente = new Cliente($_SESSION["id"]);
        $cliente->traerInfo();
    }
} else {
    $cliente = new Cliente($_SESSION["id"]);
    $cliente->traerInfo();
}
?>

<div class="container">
    <div class="row mt-4">
        <div class="col-12">
            <div class="card text-center">
                <div class="card-header bg-light text-dark">
                    Actuliza tu Informacion
                </div>
                <div class="card-body">
                    <div class="row p-3">
                        <div class="col-3">
                            <img src="<?php echo ($cliente->getFoto() != "" ? $cliente->getFoto() : "https://upload.wikimedia.org/wikipedia/commons/e/e4/Elliot_Grieveson.png") ?>" width="100%" class="img-thumbnail">
                        </div>
                        <div class="col-9">
                            <form action="index.php?pid= <?php echo base64_encode("Vista/Cliente/actualizarInfo.php") ?>" method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="Nombre">Nombres</label>
                                    <input type="text" class="form-control" name="Nombre" id="Nombre" value="<?php echo $cliente->getNombre() ?>">
                                </div>
                                <div class="form-group">
                                    <label for="Correo">Direccion de correo electrónico</label>
                                    <input type="email" class="form-control" name="Correo" id="Correo" value="<?php echo $cliente->getCorreo() ?>" aria-describedby="emailHelp">
                                    <small id="emailHelp" class="form-text text-muted">No compartiremos su correo con nadie más.</small>
                                </div>
                                <div class="form-group border-0">
                                    <label for="foto">Cargar Foto</label>
                                    <div class="row">
                                        <div class="col-3"></div>
                                        <div class="col-9 border-0">
                                            <input type="file" class="form-control border-0" name="imagen">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group text-center">
                                    <input name="Actualizar" type="submit" class="btn btn-outline-dark" value="Actualizar">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php if ($band == true and isset($_POST["Actualizar"])) {
    echo "<div class='modal fade' id='mostrarmodal' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>";
    echo "<div class='modal-dialog '>";
    echo "<div class='modal-content '>";
    echo "<div class='alert alert-success m-0 d-flex justify-content-between'>";
    echo "<div></div>";
    echo "<h5 class='modal-title flex-grow-1' id='exampleModalLabel'>La información se ha actualizado correctamente</h5>";
    echo "<button type='button' class='close' data-dismiss='modal' aria-label='Close'>";
    echo "<span aria-hidden='true'>&times;</span>";
    echo "</button>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
} else if ($band == false and isset($_POST["Actualizar"])) {
    echo "<div class='modal fade' id='mostrarmodal' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>";
    echo "<div class='modal-dialog '>";
    echo "<div class='modal-content '>";
    echo "<div class='alert alert-warning m-0 d-flex justify-content-between'>";
    echo "<div></div>";
    echo "<h5 class='modal-title' id='exampleModalLabel'>No se ha modificado ningún dato</h5>";
    echo "<button type='button' class='close' data-dismiss='modal' aria-label='Close'>";
    echo "<span aria-hidden='true'>&times;</span>";
    echo "</button>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
} ?>