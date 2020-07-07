<?php
$alert = 0;
$infoLog = "";

if (isset($_POST["Crear"])) {
    if ($_FILES["imagen"]["name"] != "") {
        $rutaLocal = $_FILES["imagen"]["tmp_name"];
        $tipo = $_FILES["imagen"]["type"];
        $tiempo = new DateTime();
        $rutaRemota = "Vista/Img/imgProductos/" . $tiempo->getTimestamp() . (($tipo == "image/png") ? ".png" : ".jpg");
        copy($rutaLocal, $rutaRemota);

        $producto = new Producto("", $_POST["Nombre"], $_POST["Cantidad"], $_POST["Precio"], $rutaRemota);
    } else {
        $producto = new Producto("", $_POST["Nombre"], $_POST["Cantidad"], $_POST["Precio"]);
    }
    if ($producto->validarProducto()) {
        $alert = 1;
    } else { /*se crea el producto y se asigna al log */
        $alert = 2;
        $producto -> crearProducto();
        $producto -> traerInfoNombre();
        $infoLog = "id:".$producto->getidProducto();
        date_default_timezone_set('America/Bogota');
        $date = date('Y-m-d');
        $hora = date('H:i:s');
        $log = new Log("", 'Crear Producto', $infoLog, $date, $hora, "Administrador", $_SESSION["id"]);
        $log->insertarLog();
    }
}
?>

<div class="container">
    <div class="row mt-4">
        <div class="col-12">
            <div class="card text-center">
                <div class="card-header bg-dark text-white">
                    <h4>Crear Producto</h4>
                </div>
                <div class="card-body">
                    <div class="row p-3">
                        <div class="col-3">
                            <img src="https://icons.iconarchive.com/icons/xaml-icon-studio/agriculture/128/Fruits-Vegetables-icon.png" width="100%" class="img-thumbnail">
                        </div>
                        <div class="col-9">
                            <form action="index.php?pid= <?php echo base64_encode("Vista/Producto/crearProducto.php") ?>" method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="Nombre">Nombre</label>
                                    <input type="text" class="form-control" name="Nombre" id="Nombre">
                                </div>
                                <div class="form-group">
                                    <label for="Cantidad">Cantidad</label>
                                    <input type="number" class="form-control" name="Cantidad" id="Cantidad">
                                </div>
                                <div class="form-group">
                                    <label for="Precio">Precio</label>
                                    <input type="number" class="form-control" name="Precio" id="Precio">
                                </div>
                                <div class="form-group border-0">
                                    <label for="foto">Cargar Imagen</label>
                                    <div class="row">
                                        <div class="col-3"></div>
                                        <div class="col-9 border-0">
                                            <input type="file" class="form-control border-0" name="imagen">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group text-center">
                                    <input name="Crear" type="submit" class="btn btn-outline-dark" value="Crear">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php if ($alert == 1) {
    echo "<div class='modal fade' id='mostrarmodal' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>";
    echo "<div class='modal-dialog '>";
    echo "<div class='modal-content '>";
    echo "<div class='alert alert-danger m-0 d-flex'>";
    echo "<h5 class='modal-title flex-grow-1' id='exampleModalLabel'>Ya existe un producto con ese nombre nombre</h5>";
    echo "<button type='button' class='close' data-dismiss='modal' aria-label='Close'>";
    echo "<span aria-hidden='true'>&times;</span>";
    echo "</button>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
} else if ($alert == 2) {
    echo "<div class='modal fade' id='mostrarmodal' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>";
    echo "<div class='modal-dialog '>";
    echo "<div class='modal-content '>";
    echo "<div class='modal-header alert alert-success m-0 d-flex'>";
    echo "<h5 class='modal-title flex-grow-1' id='exampleModalLabel'>Producto creado correctamente</h5>";
    echo "<button type='button' class='close' data-dismiss='modal' aria-label='Close'>";
    echo "<span aria-hidden='true'>&times;</span>";
    echo "</button>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
} ?>