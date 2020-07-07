<?php
$user = $_GET["actor"];
$actor;
$title;
if ($user == 1) {
    $actor = new Administrador($_GET["idAdm"]);
    $title = "Administrador";
} else if ($user == 2) {
    $actor = new Cliente($_GET["idCliente"]);
    $title = "Cliente";
} else if ($user == 3) {
    $actor = new Proveedor($_GET["idProveedor"]);
    $title = "Proveedor";
}
$actor->traerInfo();
?>

<div class="card text-center  border-0">
    <div class="card-body p-0">
        <div class="row p-3">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 text-center">
                <h4><?php echo $title ?></h4>
                <img src="<?php echo ($actor->getFoto() != "" ? $actor->getFoto() : "https://upload.wikimedia.org/wikipedia/commons/e/e4/Elliot_Grieveson.png") ?>" width="40%" class="img-thumbnail">
            </div>
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="m-0">
                    <div class="card-body m-0">
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