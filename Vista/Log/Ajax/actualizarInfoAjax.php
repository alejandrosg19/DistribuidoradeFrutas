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
$title;
$actor;
if ($info1[1] == "Cliente") {
    $actor = new Cliente($info4[1]);
    $actor->traerInfo();
    $title="Cliente";
} else if ($info1[1] == "Proveedor") {
    $actor = new Proveedor($info4[1]);
    $actor->traerInfo();
    $title="Proveedor";
} else {
    $actor = new Administrador($info4[1]);
    $actor->traerInfo();
    $title="Administrador";
}
$band = false;
if ($actor->getNombre() == $info2[1] and $actor->getCorreo() == $info3[1]) {
    $band = true;
}

?>


<div class="card text-center  border-0">
    <div class="card-body p-0">
        <div class="row p-3">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 text-center">
                <h4><?php echo $title ?></h4>
                <img src="<?php echo ($actor->getFoto() != "" ? $actor->getFoto() : "https://upload.wikimedia.org/wikipedia/commons/e/e4/Elliot_Grieveson.png") ?>" width="40%" class="img-thumbnail">
            </div>
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mt-3">
                <div style="display: <?php echo($band==true?"block":"none !important")?>" class="alert alert-warning" style="min-height: 80px;">
                    <div class="text-center" role="alert" aria-live="assertive" aria-atomic="true" data-delay="2000">
                        <div>
                            <p  class="m-0">Solo se modifico la foto de perfil</p>
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
                            <p class="m-0">Correo: </p>
                            <p><small id="emailHelp" class="form-text text-muted mt-0 "><?php echo $info3[1] ?></small></p>
                        </div>
                    </div>
                    <div class="card-body m-0 p-0">
                        <h5 class="border-bottom p-1">Datos Modificados</h5>
                        <div class="d-flex justify-content-between pr-3">
                            <p class="m-0">Nombre: </p>
                            <p><small id="emailHelp" class="form-text text-muted mt-0 "><?php echo $actor->getNombre() ?></small></p>
                        </div>
                        <div class="d-flex justify-content-between pr-3">
                            <p class="m-0">Correo: </p>
                            <p><small id="emailHelp" class="form-text text-muted mt-0 "><?php echo $actor->getCorreo() ?></small></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>