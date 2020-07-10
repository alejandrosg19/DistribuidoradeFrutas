<?php
$id = $_GET["idLog"];
$log = new Log($id);
$log->traerInfo();
$arrayDatos = explode("@", $log->getDatos());
$info1 = explode(":", $arrayDatos[0]);
$info2 = explode(":", $arrayDatos[1]);
$info3 = explode(":", $arrayDatos[2]);
$idActor = $info2[1];
$actor;

$mensaje = "";
if ($info1[1] == "cliente") {
    $actor = new Cliente($idActor);
    $actor->traerInfo();
    $mensaje = "cliente";
} else if ($info1[1] == "proveedor") {
    $actor = new Proveedor($idActor);
    $actor->traerInfo();
    $mensaje = "proveedor";
} else {
    $actor = new Administrador($idActor);
    $actor->traerInfo();
    $mensaje = "administrador";
}
?>


<div class="card text-center  border-0">
    <div class="card-body p-0">
        <div class="row p-3">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 text-center">
                <h4><?php echo $log->getActor() ?></h4>
                <img src="<?php echo ($actor->getFoto() != "" ? $actor->getFoto() : "https://upload.wikimedia.org/wikipedia/commons/e/e4/Elliot_Grieveson.png") ?>" width="40%" class="img-thumbnail">
            </div>
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mt-3">
                <p>El cambio de estado a sido a un <?php echo $mensaje ?></p>
                <div class="m-0 mx-3">
                    <div class="card-body m-0 p-0">
                        <h5 class="border-bottom p-1">Datos</h5>
                        <div class="d-flex justify-content-between pr-3">
                            <p class="m-0">Nombre: </p>
                            <p><small id="emailHelp" class="form-text text-muted mt-0 "><?php echo $actor->getNombre() ?></small></p>
                        </div>
                        <div class="d-flex justify-content-between pr-3">
                            <p class="m-0">Correo: </p>
                            <p><small id="emailHelp" class="form-text text-muted mt-0 "><?php echo $actor->getCorreo() ?></small></p>
                        </div>
                        <div class="d-flex justify-content-between ">
                            <div>
                                <h5 class="border-bottom p-1">Estado Anterior</h5>
                                <div class="d-flex align-items-center justify-content-between">
                                    <p class="m-0">Estado: </p>
                                    <p class="m-0"><small id="emailHelp" class="form-text text-muted mt-0 "><?php echo ($info3[1]==-1?"Bloqueado":($info3[1]==0?"Deshabilitado":"Habilitado")) ?></small></p>
                                </div>
                            </div>
                            <div>
                                <h5 class="border-bottom p-1">Nuevo Estado</h5>
                                <div class="d-flex align-items-center justify-content-between">
                                    <p class="m-0">Estado: </p>
                                    <p class="m-0"><small id="emailHelp" class="form-text text-muted mt-0 "><?php echo ($actor->getEstado()==-1?"Bloqueado":($actor->getEstado()==0?"Deshabilitado":"Habilitado"))?></small></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>