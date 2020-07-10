<?php
$infoLog = "";
$productoAux;
$band = 0;
$proAux;
$proAux = new Producto($_GET["idProducto"]);
$proAux->traerInfo();

if (isset($_POST["Actualizar"])) {
    if ($_FILES["imagen"]["name"] != "") {
        if ($_FILES["imagen"]["type"] == "image/png" or $_FILES["imagen"]["type"] == "image/jpeg") {
            $rutaLocal = $_FILES["imagen"]["tmp_name"];
            $tipo = $_FILES["imagen"]["type"];
            $tiempo = new DateTime();
            $rutaRemota = "Vista/Img/imgProductos/" . $tiempo->getTimestamp() . (($tipo == "image/png") ? ".jpeg" : ".jpg");
            copy($rutaLocal, $rutaRemota);
            $productoAux = new Producto($_POST["idProducto"]);
            $productoAux->traerInfo();

            if ($productoAux->getImagen() != "") {
                unlink($productoAux->getImagen());
            }
            $producto = new Producto($_POST["idProducto"], $_POST["Nombre"], $_POST["Cantidad"], $_POST["Precio"], $rutaRemota);
            $producto->actualizarProducto();
            $band = 1;
        }
    } else if ($proAux->getNombre() != $_POST["Nombre"] or $proAux->getCantidad() != $_POST["Cantidad"] or $proAux->getPrecio() != $_POST["Precio"]) { /*Se valida que haya cambiado algun campo*/
        $productoAux = new Producto($_POST["idProducto"]);
        $productoAux->traerInfo();
        $producto = new Producto($_POST["idProducto"], $_POST["Nombre"], $_POST["Cantidad"], $_POST["Precio"], $productoAux->getImagen());
        $producto->actualizarProducto();
        $band = 1;
    }else{
        $band=2;
    }
    if ($band == 1) {
        $infoLog = "id:" . $productoAux->getidProducto() . "-Nombre:" . $productoAux->getNombre() . "-Cantidad:" . $productoAux->getCantidad() . "-Precio:" . $productoAux->getPrecio();
        date_default_timezone_set('America/Bogota');
        $date = date('Y-m-d');
        $hora = date('H:i:s');
        $log = new Log("", 'Editar Producto', $infoLog, $date, $hora, "Administrador", $_SESSION["id"]);
        $log->insertarLog();
    } else {
        $producto = new Producto($_GET["idProducto"]);
        $producto->traerInfo();
    }
} else {
    $producto = new Producto($_GET["idProducto"]);
    $producto->traerInfo();
}

?>

<div class="container">
    <div class="row mt-4">
        <div class="col-12">
            <div class="card text-center">
                <div class="card-header bg-dark text-white">
                    <h4>Editar Producto</h4>
                </div>
                <div class="card-body">
                    <div class="row p-3">
                        <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                            <img src="<?php echo ($producto->getImagen() != "" ? $producto->getImagen() : "https://icons.iconarchive.com/icons/xaml-icon-studio/agriculture/128/Fruits-Vegetables-icon.png") ?>" width="100%" class="img-thumbnail">
                        </div>
                        <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
                            <form action="index.php?pid= <?php echo base64_encode("Vista/Producto/editarProducto.php") ?>&idProducto=<?php echo $_GET["idProducto"] ?>" method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="idProducto">ID Producto</label>
                                    <input type="text" class="form-control" name="idProducto" id="idProducto" value="<?php echo $producto->getidProducto() ?> " readonly>
                                </div>
                                <div class="form-group">
                                    <label for="Nombre">Nombre</label>
                                    <input type="text" class="form-control" name="Nombre" id="Nombre" value="<?php echo $producto->getNombre() ?>">
                                </div>
                                <div class="form-group">
                                    <label for="Cantidad">Cantidad</label>
                                    <input type="number" class="form-control" name="Cantidad" id="Cantidad" value="<?php echo $producto->getCantidad() ?>">
                                </div>
                                <div class="form-group">
                                    <label for="Precio">Precio</label>
                                    <input type="number" class="form-control" name="Precio" id="Precio" value="<?php echo $producto->getPrecio() ?>">
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

<?php if ($band == 1){
    echo "<div class='modal fade' id='mostrarmodal' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>";
    echo "<div class='modal-dialog '>";
    echo "<div class='modal-content '>";
    echo "<div class='alert alert-success m-0 d-flex justify-content-between'>";
    echo "<div></div>";
    echo "<h5 class='modal-title' id='exampleModalLabel'>La información se ha actualizado correctamente</h5>";
    echo "<button type='button' class='close' data-dismiss='modal' aria-label='Close'>";
    echo "<span aria-hidden='true'>&times;</span>";
    echo "</button>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
} else if (isset($_POST["Actualizar"]) and $band == 0) {
    echo "<div class='modal fade' id='mostrarmodal' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>";
    echo "<div class='modal-dialog '>";
    echo "<div class='modal-content '>";
    echo "<div class='alert alert-danger m-0 d-flex justify-content-between'>";
    echo "<div></div>";
    echo "<h5 class='modal-title' id='exampleModalLabel'>Error en el tipo de archivo</h5>";
    echo "<button type='button' class='close' data-dismiss='modal' aria-label='Close'>";
    echo "<span aria-hidden='true'>&times;</span>";
    echo "</button>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
}else if($band== 2){
    echo "<div class='modal fade' id='mostrarmodal' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>";
    echo "<div class='modal-dialog '>";
    echo "<div class='modal-content '>";
    echo "<div class='alert alert-warning m-0 d-flex justify-content-between'>";
    echo "<div></div>";
    echo "<h5 class='modal-title' id='exampleModalLabel'>No se ha cambiado ningun dato</h5>";
    echo "<button type='button' class='close' data-dismiss='modal' aria-label='Close'>";
    echo "<span aria-hidden='true'>&times;</span>";
    echo "</button>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
} ?>