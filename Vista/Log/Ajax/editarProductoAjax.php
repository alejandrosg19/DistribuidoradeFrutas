<?php
$id = $_GET["idLog"];
$log = new Log($id);
$log->traerInfo();
$arrayDatos = explode("-", $log->getDatos());
$info1 = explode(":", $arrayDatos[0]);
$info2 = explode(":", $arrayDatos[1]);
$info3 = explode(":", $arrayDatos[2]);
$info4 = explode(":", $arrayDatos[3]);
$idActor = $log->getIdUsuario();
$producto = new Producto($info1[1]);
$producto -> traerInfo();
$band = false;
if ($producto->getNombre() == $info2[1] and $producto->getCantidad() == $info3[1] and $producto->getPrecio() == $info4[1]) {
    $band = true;
}

?>


<div class="card text-center  border-0">
    <div class="card-body p-0">
        <div class="row p-3">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 text-center">
                <h4>Producto</h4>
                <img src="<?php echo ($producto->getImagen() != "" ? $producto->getImagen() : "https://upload.wikimedia.org/wikipedia/commons/e/e4/Elliot_Grieveson.png") ?>" width="40%" class="img-thumbnail">
            </div>
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mt-3">
                <div style="display: <?php echo($band==true?"block":"none !important")?>" class="alert alert-warning" style="min-height: 80px;">
                    <div class="text-center" role="alert" aria-live="assertive" aria-atomic="true" data-delay="2000">
                        <div>
                            <p  class="m-0">El usuario solo modifico la foto de perfil</p>
                        </div>
                    </div>
                </div>
                <div class="m-0">
                    <div class="card-body m-0 p-0">
                        <h5 class="border-bottom p-1">Datos Anteriores</h5>
                        <div class="d-flex justify-content-between pr-3">
                            <p class="m-0">Nombre: </p>
                            <p><small id="emailHelp" class="form-text text-muted mt-0 "><?php echo $info2[1] ?></small></p>
                        </div>
                        <div class="d-flex justify-content-between pr-3">
                            <p class="m-0">Cantidad: </p>
                            <p><small id="emailHelp" class="form-text text-muted mt-0 "><?php echo $info3[1] ?></small></p>
                        </div>
                        <div class="d-flex justify-content-between pr-3">
                            <p class="m-0">Precio: </p>
                            <p><small id="emailHelp" class="form-text text-muted mt-0 "><?php echo $info4[1] ?></small></p>
                        </div>
                    </div>
                    <div class="card-body m-0 p-0">
                        <h5 class="border-bottom p-1">Datos Modificados</h5>
                        <div class="d-flex justify-content-between pr-3">
                            <p class="m-0">Nombre: </p>
                            <p><small id="emailHelp" class="form-text text-muted mt-0 "><?php echo $producto->getNombre() ?></small></p>
                        </div>
                        <div class="d-flex justify-content-between pr-3">
                            <p class="m-0">Cantidad: </p>
                            <p><small id="emailHelp" class="form-text text-muted mt-0 "><?php echo $producto->getCantidad() ?></small></p>
                        </div>
                        <div class="d-flex justify-content-between pr-3">
                            <p class="m-0">Precio: </p>
                            <p><small id="emailHelp" class="form-text text-muted mt-0 "><?php echo $producto->getPrecio() ?></small></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>