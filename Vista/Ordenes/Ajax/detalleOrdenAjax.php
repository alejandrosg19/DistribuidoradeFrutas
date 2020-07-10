<?php
$id = $_GET["idOrden"];
$orden = new ProveedorProducto($id);
$orden->traerInfo();
$fechaHora = explode(" ", $orden->getFecha());
$producto = new Producto($orden->getIdProducto());
$producto->traerInfo();
$proveedor = new Proveedor($orden->getIdProveedor());
$proveedor->traerInfo();

?>
<div class="row pt-3">
    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
        <div class="border m-2">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 text-center mt-2">
                <h4 class="m-0">Información</h4>
            </div>
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mt-3">
                <div class="m-0">
                    <div class="card-body m-0 p-0">
                        <div class="d-flex justify-content-between pr-3">
                            <p class="m-0">Orden #: </p>
                            <p><small id="emailHelp" class="form-text text-muted mt-0 "><?php echo $orden->getIdProveedorProducto() ?></small></p>
                        </div>
                        <div class="d-flex justify-content-between pr-3">
                            <p class="m-0">Fecha: </p>
                            <p><small id="emailHelp" class="form-text text-muted mt-0 "><?php echo $fechaHora[0] ?></small></p>
                        </div>
                        <div class="d-flex justify-content-between pr-3">
                            <p class="m-0">Hora: </p>
                            <p><small id="emailHelp" class="form-text text-muted mt-0 "><?php echo $fechaHora[1] ?></small></p>
                        </div>
                        <div class="d-flex justify-content-between pr-3">
                            <p class="m-0">Proveedor: </p>
                            <p><small id="emailHelp" class="form-text text-muted mt-0 "><?php echo $proveedor->getNombre() ?></small></p>
                        </div>
                        <div class="d-flex justify-content-between pr-3">
                            <p class="m-0">Correo: </p>
                            <p><small id="emailHelp" class="form-text text-muted mt-0 "><?php echo $proveedor->getCorreo() ?></small></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
        <div class="border m-2">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 text-center mt-2">
                <h4 class="m-0">Producto</h4>
            </div>
            <div class="card-body p-0">
                <div class="row p-2">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="d-flex justify-content-between pr-3">
                            <p class="m-0">id Producto: </p>
                            <p><small id="emailHelp" class="form-text text-muted mt-0 "><?php echo $producto->getidProducto() ?></small></p>
                        </div>
                        <div class="d-flex justify-content-between pr-3">
                            <p class="m-0">Producto: </p>
                            <p><small id="emailHelp" class="form-text text-muted mt-0 "><?php echo $producto->getNombre() ?></small></p>
                        </div>
                        <div class="d-flex justify-content-between pr-3">
                            <p class="m-0">Cantidad: </p>
                            <p><small id="emailHelp" class="form-text text-muted mt-0 "><?php echo $orden->getCantidad() ?></small></p>
                        </div>
                        <div class="d-flex justify-content-between pr-3">
                            <p class="m-0">Precio Libra: </p>
                            <p><small id="emailHelp" class="form-text text-muted mt-0 ">$<?php echo $orden->getPrecio() ?></small></p>
                        </div>
                        <div class="d-flex justify-content-between pr-3">
                            <p class="m-0">Total: </p>
                            <p><small id="emailHelp" class="form-text text-muted mt-0 ">$<?php echo ($orden->getPrecio() * $orden->getCantidad()) ?></small></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    ::-webkit-scrollbar {
        display: none;
    }
</style>