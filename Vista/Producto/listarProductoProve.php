<?php
if (isset($_GET["idProducto"])) {
    $producto = new Producto($_GET["idProducto"]);
    $producto->traerInfo();
} else {
    $producto = new Producto();
}

$cantidad = 6;
if (isset($_GET["cantidad"])) {
    $cantidad = $_GET["cantidad"];
}
$pagina = 1;
if (isset($_GET["pagina"])) {
    $pagina = $_GET["pagina"];
}
$filtro = "";
if (isset($_GET["filtro"])) {
    $filtro = $_GET["filtro"];
}
$cant = $producto->cantidadPaginasProve($filtro);
$cantPagina = intval($cant[0] / $cantidad);
if (($cant[0] % $cantidad) != 0) {
    $cantPagina++;
}

$listaProductos = $producto->listarFiltroProve($filtro, $cantidad, $pagina);
?>

<div class="container">
    <div class="card mt-3">
        <div class="card-header text-white bg-dark text-center">
            <h4>Productos</h4>
        </div>
        <div class="d-flex text-center m-2 shadow-sm p-3 e rounded">
            <div class="col-xl-7 col-lg-7 col-md-7 col-sm-7 col-12">
                <form class="form-inline my-2 my-lg-0" action="#">
                    <input class="form-control mr-sm-2" id="search" type="search" placeholder="Search" aria-label="Search" data-cantidad="<?php echo $cantidad ?>" value="<?php echo ($filtro != null ? $filtro : "") ?>">
                </form>
            </div>
        </div>

        <div class="card-body col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div id="contenido">
                <table class="table table-responsive-sm table-responsive-md table-hover table-striped">
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Cantidad en Stock</th>
                        <th>Precio Libra</th>
                        <th>Estado en Bodega</th>
                        <th>Servicios</th>
                    </tr>
                    <?php
                    $i = ($pagina - 1) * $cantidad;
                    foreach ($listaProductos  as $productoActual) {
                        echo "<tr>";
                        echo "<td>" . $i . "</td>";

                        /*PINTAR BUSQUEDA DE NOMBRE EN TABLA*/
                        /*strtipos -> stripos ( string $haystack , string $needle [, int $offset = 0 ] ) Encuentra la posición numérica de la primera aparición de needle (aguja) en el string haystack (pajar).*/
                        $primeraPosicion = stripos($productoActual->getNombre(), $filtro);
                        if ($primeraPosicion === false) {
                            echo "<td>" . $productoActual->getNombre() . "</td>";
                        } else {
                            /*El siguiente codigo imprime primero la parte de la palabra hasta que encuentra el indice de $primeraPosicion, luego en negrila <mark> imprime desde el indice de primeraPosicion hasta el final de la palabra $filtro, y por ultimo imprime desde la primeraPosicion+la palabra del filtro, es decir el restante de la oracion*/
                            echo "<td>" . substr($productoActual->getNombre(), 0, $primeraPosicion) . "<strong>" . substr($productoActual->getNombre(), $primeraPosicion, strlen($filtro)) . "</strong>" . substr($productoActual->getNombre(), $primeraPosicion + strlen($filtro)) . "</td>";
                        }
                        echo "<td>" . $productoActual->getCantidad() . "</td>";
                        echo "<td>" . $productoActual->getPrecio() . "</td>";
                        echo "<td>Sin Stock</td>";
                        echo "<td><a href='#' class='detalle' data-toggle='modal' data-target='#exampleModal' data-idproducto='" . $productoActual->getidProducto() . "'><span class='fas fa-info-circle' data-toggle='tooltip' data-placement='top' title='Información Producto'></span> </a> </td>";
                        echo "</tr>";
                        $i++;
                    }
                    ?>
                </table>
                <div class="d-flex justify-content-between mt-4">
                    <nav aria-label="...">
                        <ul class="pagination">
                            <?php if ($pagina > 1) {
                                echo '<li class="page-item"> <a class="page-link" href="index.php?pid=' . base64_encode("Vista/Producto/listarProductoProve.php") . '&pagina=' . ($pagina - 1) . '&cantidad=' . $cantidad . '&filtro=' . $filtro . '" tabindex="0" aria-disabled="false">Previous</a></li>';
                            } ?>
                            <?php for ($i = 1; $i <= $cantPagina; $i++) {
                                if ($pagina == $i) {
                                    echo "<li class='page-item active'>" .
                                        "<a class='page-link'>$i</a>" .
                                        "</li>";
                                } else {
                                    echo "<li class='page-item'>" .
                                        "<a class='page-link' href='index.php?pid=" . base64_encode("Vista/Producto/listarProductoProve.php") . "&pagina=" . $i . "&cantidad=" . $cantidad . "&filtro=" . $filtro . "'>" . $i . "</a>" .
                                        "</li>";
                                }
                            } ?>
                            <?php if ($pagina < $cantPagina) {
                                echo '<li class="page-item"> <a class="page-link" href="index.php?pid=' . base64_encode("Vista/Producto/listarProductoProve.php") . '&pagina=' . ($pagina + 1) . '&cantidad=' . $cantidad . '&filtro=' . $filtro . '" tabindex="0" aria-disabled="false">Next</a></li>';
                            } ?>
                        </ul>
                    </nav>
                    <div class="text-center m-2">
                        <span><?php echo (($pagina - 1) * $cantidad) ?> al <?php echo ((($pagina - 1) * $cantidad) + count($listaProductos) - 1) ?> de <?php echo ($cant[0] - 1) ?> Registros Encontrados</span>
                        <select id="cantidad" class="custom-select" onchange="Selected();" style="width: 60px" data-filtro="<?php echo $filtro ?>">
                            <option value="6" <?php echo ($cantidad == 6) ? "selected" : "" ?>>6</option>
                            <option value="9" <?php echo ($cantidad == 9) ? "selected" : "" ?>>9</option>
                            <option value="12" <?php echo ($cantidad == 12) ? "selected" : "" ?>>12</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Modal-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="text-center bg-dark text-white p-3">
                <h5 class="modal-title" id="exampleModalLabel">Detalles de Producto</h5>
            </div>
            <div class="modal-body p-0">
                <div style="display: none !important" aria-live="polite" aria-atomic="true" class="d-flex justify-content-center align-items-center divToast" style="min-height: 80px;">
                    <div class="toast text-center" role="alert" aria-live="assertive" aria-atomic="true" data-delay="2000">
                        <div id="divPtoast" class="">
                            <p id="pToast" class="m-0"></p>
                        </div>
                    </div>
                </div>
                <div id="mostrar">
                    ...
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <a class="btn btn-info showToast" data-span="">Proveer Producto</a>
            </div>
        </div>
    </div>
</div>
<!--MODAL-->
<div class='modal fade' id='vermodal' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
    <div class='modal-dialog '>
        <div class='modal-content '>
            <div class='alert alert-success p-3 m-0 text-center d-flex'>
                <h5 class='modal-title flex-grow-1' id='exampleModalLabel'>Registro actualizado correctamente</h5>
                <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    $("#cantidad").on("change", function() {
        url = "index.php?pid=<?php echo base64_encode("Vista/Producto/listarProductoProve.php") ?>&cantidad=" + $(this).val() + "&filtro=" + $(this).data("filtro");
        location.replace(url);
    });

    /*search filtro*/
    $(document).ready(function() {
        $("#search").keyup(function() {
            if ($(this).val().length >= 2 || $(this).val().length == 0) {
                var url = "indexAjax.php?pid=<?php echo base64_encode("Vista/Producto/Ajax/buscarProductoProveAjax.php") ?>&filtro=" + $(this).val() + "&cantidad=" + $(this).data("cantidad");
                $("#contenido").load(url);
            }
        });
    });

    /**Mostrar Modal Con Info de Producto */
    $(function() {
        $(".detalle").on("click", function() {
            console.log("EYYY ");
            var valor = $(this).data("idproducto");
            console.log("EYYY " + valor);
            var url = "indexAjax.php?pid=<?php echo base64_encode("Vista/Producto/Ajax/detalleProductoAjax.php") ?>&idProducto=" + valor + "&Proveedor";
            $("#mostrar").load(url);
        });
    });

    $(".showToast").click(function() {


        /*agregando producto a la variable de sesion carrito*/
        var cantidad = $(".cantidadProducto").val();
        var producto = $(".cantidadProducto").data("idproducto");
        var precio = $(".cantidadProducto").data("precio");

        var objJSON = {
            idProducto: producto,
            Cantidad: cantidad,
            Precio: precio,
        }

        url = "indexAjax.php?pid=<?php echo base64_encode("Vista/Producto/Ajax/proveerProductoAjax.php") ?>";
        $.post(url, objJSON, function(info) {
            console.log(info);
            var res = JSON.parse(info);
            console.log(res);

            /*Mostrar div de mensaje pequeño */
            $(".divToast").css("display", "block");

            if (res.estado == true) {
                $("#divPtoast").addClass("alert alert-success m-0 border-0 text-center");
                $('#pToast').text("Producto suministrado correctamente");
            }
            $('.toast').toast('show');

        })


    });
</script>