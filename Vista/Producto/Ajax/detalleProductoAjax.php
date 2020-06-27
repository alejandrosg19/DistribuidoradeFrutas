<?php
$producto = new Producto($_GET["idProducto"]);
$info = $producto->traerInfo();
?>

<div class="card text-center">
    <div class="card-body p-0">
        <div class="row p-3">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 text-center">
                <h4><?php echo $producto->getNombre() ?></h4>
                <img src="<?php echo $producto->getImagen() ?>" width="100%" class="img-thumbnail">
            </div>
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <form action="index.php?pid= <?php echo base64_encode("Vista/Producto/editarProducto.php") ?>" method="POST">
                    <p>Docena de <?php echo $producto->getNombre() ?> por un precio de $<?php echo $producto->getPrecio() ?></p>
                    <div class="form-group">
                        <label for="Cantidad">Cantidad</label>
                        <input type="number" class="form-control" name="Cantidad" id="Cantidad" min="1">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>