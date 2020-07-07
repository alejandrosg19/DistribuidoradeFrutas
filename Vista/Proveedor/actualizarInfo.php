<?php
$infoLog = "";
$proveedorAux;
$proAux = new Proveedor($_SESSION["id"]);
$proAux->traerInfo();
$band = false;
if (isset($_POST["Actualizar"])) {
    if ($_FILES["imagen"]["name"] != "") {
        $rutaLocal = $_FILES["imagen"]["tmp_name"];
        $tipo = $_FILES["imagen"]["type"];
        $tiempo = new DateTime();
        $rutaRemota = "Vista/Img/Users/" . $tiempo->getTimestamp() . (($tipo == "image/png") ? ".png" : ".jpg");
        copy($rutaLocal, $rutaRemota);
        $proveedorAux = new Proveedor($_SESSION["id"]);
        $proveedorAux->traerInfo();

        if ($proveedorAux->getFoto() != "") {
            unlink($proveedorAux->getFoto());
        }
        $proveedor = new Proveedor($_SESSION["id"], $_POST["Nombre"], $_POST["Correo"], "", "", $rutaRemota);
        $proveedor->actualizarInfo();
        $band = true;
    } else if ($proAux->getNombre() != $_POST["Nombre"] or $proAux->getCorreo() != $_POST["Correo"]) { /*Se valida que haya cambiado algun campo*/
        $proveedorAux = new Proveedor($_SESSION["id"]);
        $proveedorAux->traerInfo();
        $proveedor = new Proveedor($_SESSION["id"], $_POST["Nombre"], $_POST["Correo"], "", "", $proveedorAux->getFoto());
        $proveedor->actualizarInfo();
        $band = true;
    }
    if ($band == true) {
        $infoLog = "Actor:Proveedor-Nombre:" . $proveedorAux->getNombre() . "-Correo:" . $proveedorAux->getCorreo(). "-id:" . $proveedorAux->getIdProveedor();
        date_default_timezone_set('America/Bogota');
        $date = date('Y-m-d');
        $hora = date('H:i:s');
        $log = new Log("", 'Actualizar Información', $infoLog, $date, $hora, "Proveedor", $proveedorAux->getIdProveedor());
        $log->insertarLog();
    } else {
        $proveedor = new Proveedor($_SESSION["id"]);
        $proveedor->traerInfo();
    }
} else {
    $proveedor = new Proveedor($_SESSION["id"]);
    $proveedor->traerInfo();
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
                            <img src="<?php echo ($proveedor->getFoto() != "" ? $proveedor->getFoto() : "https://upload.wikimedia.org/wikipedia/commons/e/e4/Elliot_Grieveson.png") ?>" width="100%" class="img-thumbnail">
                        </div>
                        <div class="col-9">
                            <form action="index.php?pid= <?php echo base64_encode("Vista/Proveedor/actualizarInfo.php") ?>" method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="Nombre">Nombres</label>
                                    <input type="text" class="form-control" name="Nombre" id="Nombre" value="<?php echo $proveedor->getNombre() ?>">
                                </div>
                                <div class="form-group">
                                    <label for="Correo">Direccion de correo electrónico</label>
                                    <input type="email" class="form-control" name="Correo" id="Correo" value="<?php echo $proveedor->getCorreo() ?>" aria-describedby="emailHelp">
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

<?php if (isset($_POST["Actualizar"])) {
    echo "<div class='modal fade' id='mostrarmodal' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>";
    echo "<div class='modal-dialog '>";
    echo "<div class='modal-content '>";
    echo "<div class='alert alert-success m-0 d-flex'>";
    echo "<h5 class='modal-title flex-grow-1' id='exampleModalLabel'>La información se ha actualizado correctamente</h5>";
    echo "<button type='button' class='close' data-dismiss='modal' aria-label='Close'>";
    echo "<span aria-hidden='true'>&times;</span>";
    echo "</button>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
} ?>