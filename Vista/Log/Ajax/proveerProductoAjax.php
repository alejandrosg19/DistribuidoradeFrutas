<?php
$id = $_GET["idLog"];
$log = new Log($id);
$log->traerInfo();
$arrayDatos = explode("-", $log->getDatos());
$info1 = explode(":", $arrayDatos[0]);
$info2 = explode(":", $arrayDatos[1]);
$producto = new Producto($info1[1]);
$producto -> traerInfo();

?>


<div class="card text-center  border-0">
    <div class="card-body p-0">
        <div class="row p-3">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 text-center">
                <h4><?php echo $producto->getNombre() ?></h4>
                <img src="<?php echo ($producto->getImagen() != "" ? $producto->getImagen() : "https://upload.wikimedia.org/wikipedia/commons/e/e4/Elliot_Grieveson.png") ?>" width="40%" class="img-thumbnail">
            </div>
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mt-3">
                <div class="m-0 mx-3">
                    <div class="card-body m-0 p-0">
                        <h5 class="border-bottom p-1">Datos</h5>
                        <div class="d-flex justify-content-between pr-3">
                            <p class="m-0">Nombre: </p>
                            <p><small id="emailHelp" class="form-text text-muted mt-0 "><?php echo $producto->getNombre() ?></small></p>
                        </div>
                        <div class="d-flex justify-content-between pr-3">
                            <p class="m-0">Precio: </p>
                            <p><small id="emailHelp" class="form-text text-muted mt-0 "><?php echo $producto->getPrecio() ?></small></p>
                        </div>
                        <div class="d-flex justify-content-between ">
                            <div>
                                <h5 class="border-bottom p-1">Cantidad Anterior</h5>
                                <div class="d-flex align-items-center justify-content-between">
                                    <p class="m-0">Cantidad: </p>
                                    <p class="m-0"><small id="emailHelp" class="form-text text-muted mt-0 "><?php echo $info2[1]?></small></p>
                                </div>
                            </div>
                            <div>
                                <h5 class="border-bottom p-1">Cantidad Actualizada</h5>
                                <div class="d-flex align-items-center justify-content-between">
                                    <p class="m-0">Cantidad: </p>
                                    <p class="m-0"><small id="emailHelp" class="form-text text-muted mt-0 "><?php echo $producto -> getCantidad()?></small></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>