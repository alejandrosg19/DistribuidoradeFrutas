<?php
$log = new Log();
$cantidad = 10;
if (isset($_GET["cantidad"])) {
    $cantidad = $_GET["cantidad"];
}
$pagina = 1;
if (isset($_GET["pagina"])) {
    $pagina = $_GET["pagina"];
}
$cant = $log->cantidadPaginas();
$cantPagina = intval($cant[0] / $cantidad);
if (($cant[0] % $cantidad) != 0) {
    $cantPagina++;
}
$listaLog = $log->listarLog($cantidad, $pagina);
?>
<div class="container">
    <div class="card mt-3">
        <div class="card-header text-white bg-dark text-center">
            <h4>Actividad</h4>
        </div>
        <div class="card-body col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div id="contenido">
                <div class="table table-responsive-sm table-responsive-md">
                    <table class="table table-responsive-sm table-responsive-md table-hover table-striped">
                        <tr>
                            <th>Accion</th>
                            <th>Fecha</th>
                            <th>Hora</th>
                            <th>Actor</th>
                            <th>Detalles</th>
                        </tr>
                        <tr>
                            <?php
                            foreach ($listaLog  as $logActual) {
                                echo "<tr>";
                                echo "<td>" . $logActual->getAccion() . "</td>";
                                echo "<td>" . $logActual->getFecha() . "</td>";
                                echo "<td>" . $logActual->getHora() . "</td>";
                                if ($logActual->getActor() == "Cliente") {
                                    $cliente = new Cliente($logActual->getIdUsuario());
                                    $cliente->traerInfo();
                                    echo "<td>" . $logActual->getActor() . ": " . $cliente->getCorreo() . "</td>";
                                } else if ($logActual->getActor() == "Proveedor") {
                                    $proveedor = new Proveedor($logActual->getIdUsuario());
                                    $proveedor->traerInfo();
                                    echo "<td>" . $logActual->getActor() . ": " . $proveedor->getCorreo() . "</td>";
                                } else {
                                    $administrador = new Administrador($logActual->getIdUsuario());
                                    $administrador->traerInfo();
                                    echo "<td>" . $logActual->getActor() . ": " . $administrador->getCorreo() . "</td>";
                                }
                                echo "<td> <a href='#' class='detalle' data-toggle='modal' data-target='#exampleModal' data-function='" . $logActual->getAccion() . "' data-idlog='" . $logActual->getIdLog() . "' 
                                ><span class='fas fa-info-circle' data-toggle='tooltip' data-placement='top' title='Información Producto'>
                            </span> </a></td>";
                                echo "</tr>";
                            }
                            ?>
                        </tr>
                    </table>
                </div>
                <div class="d-flex justify-content-between mt-4">
                    <nav aria-label="...">
                        <ul class="pagination">
                            <?php if ($pagina > 1) {
                                echo '<li class="page-item"> <a class="page-link" href="index.php?pid=' . base64_encode("Vista/Log/Log.php") . '&pagina=' . ($pagina - 1) . '&cantidad=' . $cantidad . '" tabindex="0" aria-disabled="false">Previous</a></li>';
                            } ?>
                            <?php for ($i = 1; $i <= $cantPagina; $i++) {
                                if ($pagina == $i) {
                                    echo "<li class='page-item active'>" .
                                        "<a class='page-link'>$i</a>" .
                                        "</li>";
                                } else {
                                    echo "<li class='page-item'>" .
                                        "<a class='page-link' href='index.php?pid=" . base64_encode("Vista/Log/Log.php") . "&pagina=" . $i . "&cantidad=" . $cantidad . "'>" . $i . "</a>" .
                                        "</li>";
                                }
                            } ?>
                            <?php if ($pagina < $cantPagina) {
                                echo '<li class="page-item"> <a class="page-link " href="index.php?pid=' . base64_encode("Vista/Log/Log.php") . '&pagina=' . ($pagina + 1) . '&cantidad=' . $cantidad . '" tabindex="0" aria-disabled="false">Next</a></li>';
                            } ?>
                        </ul>
                    </nav>
                    <div class="text-center m-2">
                        <span><?php echo (($pagina - 1) * $cantidad) ?> al <?php echo ((($pagina - 1) * $cantidad) + count($listaLog) - 1) ?> de <?php echo ($cant[0] - 1) ?> Registros Encontrados</span>
                        <select id="cantidad" class="custom-select" onchange="Selected();" style="width: 60px">
                            <option value="10" <?php echo ($cantidad == 10) ? "selected" : "" ?>>10</option>
                            <option value="15" <?php echo ($cantidad == 15) ? "selected" : "" ?>>15</option>
                            <option value="20" <?php echo ($cantidad == 20) ? "selected" : "" ?>>20</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Modal-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" id="tamañoModal" style="overflow: hidden !important;">
        <div class="modal-content">
            <div class="text-center bg-dark text-white p-3">
                <h5 class="modal-title" id="title">Detalle</h5>
            </div>
            <div class="modal-body p-0">
                <div id="mostrar">
                    ...
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    function Selected() {
        var valor = document.getElementById("cantidad").value;
        url = "index.php?pid= <?php echo base64_encode("Vista/Log/Log.php") ?> &cantidad=" + valor;
        location.replace(url);
    }
    /*Mostrar Modal con Informacion del producto AJAX*/
    $(function() {
        $(".detalle").on("click", function() {
            var fun = $(this).data("function");
            var valor = $(this).data("idlog");
            $("#tamañoModal").removeClass("modal-xl")
            if (fun == "Inicio de Sesion" || fun == "Nuevo Usuario") {
                var url = "indexAjax.php?pid=<?php echo base64_encode("Vista/Log/Ajax/infoActorAjax.php") ?>&idLog=" + valor;
            } else if (fun == "Actualizar Información" || fun == "Editar Proveedor" || fun == "Editar Cliente") {
                var url = "indexAjax.php?pid=<?php echo base64_encode("Vista/Log/Ajax/actualizarInfoAjax.php") ?>&idLog=" + valor;
            } else if (fun == "Editar Producto") {
                var url = "indexAjax.php?pid=<?php echo base64_encode("Vista/Log/Ajax/editarProductoAjax.php") ?>&idLog=" + valor;
            } else if (fun == "Crear Producto") {
                var url = "indexAjax.php?pid=<?php echo base64_encode("Vista/Log/Ajax/crearProductoAjax.php") ?>&idLog=" + valor;
            } else if (fun == "Compra") {
                $("#tamañoModal").addClass("modal-dialog modal-xl")
                var url = "indexAjax.php?pid=<?php echo base64_encode("Vista/Log/Ajax/compraAjax.php") ?>&idLog=" + valor;
            } else if (fun == "Cambio Estado Usuario") {
                var url = "indexAjax.php?pid=<?php echo base64_encode("Vista/Log/Ajax/CambioEstadoAjax.php") ?>&idLog=" + valor;
            } else if (fun == "Cambio Estado Producto") {
                var url = "indexAjax.php?pid=<?php echo base64_encode("Vista/Log/Ajax/CambioEstadoProAjax.php") ?>&idLog=" + valor;
            } else if (fun == "Proveer Producto") {
                var url = "indexAjax.php?pid=<?php echo base64_encode("Vista/Log/Ajax/proveerProductoAjax.php") ?>&idLog=" + valor;
            }
            $("#title").text(fun);
            $("#mostrar").load(url);
        });
    });
</script>
<style>
    ::-webkit-scrollbar {
        display: none;
    }
</style>