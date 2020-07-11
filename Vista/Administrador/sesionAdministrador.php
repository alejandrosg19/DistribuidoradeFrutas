<?php
$adm = new Administrador($_SESSION["id"]);
$adm->traerInfo();
$log = new Log();
$fecha = $log->ultimaSesion("Administrador", $_SESSION["id"]);
$info = "eyyy";
if (count($fecha) == 1  || count($fecha)==0 ) {
    $info = $fecha[0]->getFecha() . " " . $fecha[0]->getHora();
} else {
    $valor = count($fecha) - 2;
    $info = $fecha[$valor]->getFecha() . " " . $fecha[$valor]->getHora();
}
?>
<div class="container-fluid" style="background-image: url(Vista/Img/prueba8.png); width:100%; height:75vh;">
    <div class="container pt-3">
        <div class="card text-center ">
            <div class="card-header">
                <h5>¡Bienvenido!</h5>
            </div>
            <div class="pb-0">
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 border-right">
                        <div class="card text-center  border-0">
                            <div class="card-body p-0">
                                <div class="row p-3">
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 text-center">
                                    <img src="<?php echo ($adm->getFoto() != "" ? $adm->getFoto() : "https://upload.wikimedia.org/wikipedia/commons/e/e4/Elliot_Grieveson.png") ?>" width="50%" class="img-thumbnail">
                                    </div>
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 pt-4 px-5">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td>Nombre:</td>
                                                    <td><?php echo $adm->getNombre() ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Correo:</td>
                                                    <td><?php echo $adm->getCorreo() ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 d-md-block d-sm-none d-none">
                        Información y Promociones
                        <div class="card-body">
                            <div id="carouselExampleFade" class="carousel slide carousel-fade" data-ride="carousel">
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img src="Vista/Img/10.png" class="d-block w-100" alt="...">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="Vista/Img/11.png" class="d-block w-100" alt="...">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="Vista/Img/12.png" class="d-block w-100" alt="...">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="Vista/Img/13.png" class="d-block w-100" alt="...">
                                    </div>
                                </div>
                                <a class="carousel-control-prev" href="#carouselExampleFade" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselExampleFade" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-muted">
                Ultima Sesion: <?php echo $info ?>
            </div>
        </div>
    </div>
</div>