<?php
if (isset($_POST["Actualizar"])) {
    $producto = new Producto($_POST["idProducto"],$_POST["Nombre"],$_POST["Cantidad"],$_POST["Precio"],$_POST["Imagen"]);
    $producto -> actualizarProducto();
} else {
    $producto = new Producto($_GET["idProducto"]);
    $producto -> traerInfo();
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
                        <div class="col-3">
                            <img src="<?php echo $producto -> getImagen()?>" width="100%" class="img-thumbnail">
                        </div>
                        <div class="col-9">
                            <form action="index.php?pid= <?php echo base64_encode("Vista/Producto/editarProducto.php") ?>" method="POST">
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
                                <div class="form-group">
                                    <label for="Imagen">Direccion de Imagen</label>
                                    <input type="text" class="form-control" name="Imagen" id="Imagen" value="<?php echo $producto->getImagen() ?>">
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

<?php if (isset($_POST["Actualizar"]) == 1) {
    echo "<div class='modal fade' id='mostrarmodal' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>";
    echo "<div class='modal-dialog '>";
    echo "<div class='modal-content '>";
    echo "<div class='modal-header alert alert-success m-0'>";
    echo "<div class='text-center'>";
    echo "<h5 class='modal-title' id='exampleModalLabel'>Producto Actualizado Correctamente</h5>";
    echo "</div>";
    echo "<button type='button' class='close' data-dismiss='modal' aria-label='Close'>";
    echo "<span aria-hidden='true'>&times;</span>";
    echo "</button>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
}
?>