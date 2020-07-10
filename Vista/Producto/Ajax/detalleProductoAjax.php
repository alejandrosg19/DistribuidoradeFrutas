<?php
$info="";
$producto = new Producto($_GET["idProducto"]);
$info = $producto->traerInfo();

if(isset($_GET["Proveedor"])){
    $info="Presupuesto de tienda para comprar por libra: $".intval($producto -> getPrecio()/2);
}
?>


<div class="card text-center  border-0">
    <div class="card-body p-0">
        <div class="row p-3">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 text-center">
                <h4><?php echo $producto->getNombre() ?></h4>
                <img src="<?php echo $producto->getImagen() ?>" width="80%" class="img-thumbnail">
            </div>
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <form action="#" method="POST">
                    <p><?php echo($info==""?"Libra de ".$producto->getNombre()." por un precio de $".$producto->getPrecio():$info)?></p>
                    <div class="form-group">
                        <label for="cantidadProducto">Cantidad</label>
                        <input type="number" class="form-control cantidadProducto" onkeydown="return false" min="1" value="1" data-idproducto="<?php echo $producto->getidProducto()?>" data-nombre="<?php echo $producto->getNombre()?>" data-precio="<?php echo $producto->getPrecio()?>" data-imagen="<?php echo $producto->getImagen()?>">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
