<?php
$alert = 0;
if (isset($_POST["Crear"])) {
    $producto = new Producto("", $_POST["Nombre"], $_POST["Cantidad"],$_POST["Precio"],$_POST["Imagen"]);
    if($producto -> validarProducto()){
        $alert = 1;
    }else{
        $alert = 2;
        $producto->crearProducto();
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
                        <img src="https://upload.wikimedia.org/wikipedia/commons/e/e4/Elliot_Grieveson.png" width="100%" class="img-thumbnail">
                        </div>
                        <div class="col-9">
                            <form action="index.php?pid= <?php echo base64_encode("Vista/Producto/crearProducto.php") ?>" method="POST">
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
                                <div class="form-group">
                                    <label for="Imagen">Direccion de Imagen</label>
                                    <input type="text" class="form-control" name="Imagen" id="Imagen">
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

<?php if ($alert==1) {
    echo "<div class='modal fade' id='mostrarmodal' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>";
    echo "<div class='modal-dialog '>";
    echo "<div class='modal-content '>";
    echo "<div class='modal-header alert alert-danger m-0'>";
    echo "<div class='text-center'>";
    echo "<h5 class='modal-title' id='exampleModalLabel'>Ya existe un producto con ese nombre nombre</h5>";
    echo "</div>";
    echo "<button type='button' class='close' data-dismiss='modal' aria-label='Close'>";
    echo "<span aria-hidden='true'>&times;</span>";
    echo "</button>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
}else if($alert == 2){
    echo "<div class='modal fade' id='mostrarmodal' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>";
    echo "<div class='modal-dialog '>";
    echo "<div class='modal-content '>";
    echo "<div class='modal-header alert alert-succes m-0'>";
    echo "<div class='text-center'>";
    echo "<h5 class='modal-title' id='exampleModalLabel'>Producto creado correctamente</h5>";
    echo "</div>";
    echo "<button type='button' class='close' data-dismiss='modal' aria-label='Close'>";
    echo "<span aria-hidden='true'>&times;</span>";
    echo "</button>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
} ?>