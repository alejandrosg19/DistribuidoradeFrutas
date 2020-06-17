<?php
if (isset($_POST["Actualizar"])) {
    $cliente = new Cliente($_SESSION["id"], $_POST["Nombre"], $_POST["Correo"]);
    $cliente->actualizarInfo();
} else {
    $cliente = new Cliente($_SESSION["id"]);
    $cliente->traerInfo();
}
?>

<div class="container">
    <div class="row mt-4">
        <div class="col-12">
            <div class="card text-center">
                <div class="card-header bg-light text-dark">
                    Actuliza tu Informacion
                </div>
                <div class="card-body">
                    <div class="row p-3">
                        <div class="col-3">
                        <img src="http://icons.iconarchive.com/icons/mahm0udwally/all-flat/128/User-icon.png" width="100%" class="img-thumbnail">
                        
                        </div>
                        <div class="col-9">
                            <form action="index.php?pid= <?php echo base64_encode("Vista/Cliente/actualizarInfo.php") ?>" method="POST">
                                <div class="form-group">
                                    <label for="Nombre">Nombres</label>
                                    <input type="text" class="form-control" name="Nombre" id="Nombre" value="<?php echo $cliente->getNombre() ?>">
                                </div>
                                <div class="form-group">
                                    <label for="Correo">Direccion de correo electrónico</label>
                                    <input type="email" class="form-control" name="Correo" id="Correo" value="<?php echo $cliente->getCorreo() ?>" aria-describedby="emailHelp">
                                    <small id="emailHelp" class="form-text text-muted">No compartiremos su correo con nadie más.</small>
                                </div>
                                <div class="form-group text-center">
                                    <input name="Actualizar" type="submit" class="btn btn-outline-dark" value="Actualizar">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php if (isset($_POST["Actualizar"])) {
    echo "<div class='modal fade' id='mostrarmodal' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>";
    echo "<div class='modal-dialog '>";
    echo "<div class='modal-content '>";
    echo "<div class='modal-header alert alert-success m-0'>";
    echo "<div class='text-center'>";
    echo "<h5 class='modal-title' id='exampleModalLabel'>La información se ha actualizado correctamente</h5>";
    echo "</div>";
    echo "<button type='button' class='close' data-dismiss='modal' aria-label='Close'>";
    echo "<span aria-hidden='true'>&times;</span>";
    echo "</button>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
} ?>