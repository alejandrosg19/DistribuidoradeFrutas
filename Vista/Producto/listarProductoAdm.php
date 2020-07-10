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
$cant = $producto->cantidadPaginasFiltro($filtro);
$cantPagina = intval($cant[0] / $cantidad);
if (($cant[0] % $cantidad) != 0) {
    $cantPagina++;
}

$listaProductos = $producto->listarFiltro($filtro, $cantidad, $pagina);
?>

<div class="container">
    <div class="card mt-3">
        <div class="card-header text-white bg-dark text-center">
            <h4>Productos</h4>
        </div>
        <div class="d-flex text-center m-2 shadow-sm p-3 e rounded">
            <div class="col-xl-7 col-lg-7 col-md-7 col-sm-7 col-12">
                <form class="form-inline my-2 my-lg-0">
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
                        
                        echo "<td>";
                        echo "<select class='custom-select estado' data-idproducto='" . $productoActual->getidProducto() . "' style='width: 150px'>";
                        echo ">Bloqueado</option>";
                        echo "<option value='0'";
                        echo ($productoActual->getEstado() == 0) ? 'selected' : '';
                        echo ">Sin Stock</option>";
                        echo "<option value='1'";
                        echo ($productoActual->getEstado() == 1) ? 'selected' : '';
                        echo ">Stock</option>";
                        echo "</select>";
                        echo "</td>";

                        echo "<td> <a href='index.php?pid=" . base64_encode("Vista/Producto/listarProductoAdm.php") . "&idProducto=" . $productoActual->getIdProducto() . "&filtro=" . $filtro . "&cantidad=" . $cantidad . "&pagina=" . $pagina . "'><span class='fas fa-info-circle' data-toggle=tooltip' data-placement='top' title='Información Producto'></span> </a>";
                        echo        "<a href='index.php?pid=" . base64_encode("Vista/Producto/editarProducto.php") . "&idProducto=" . $productoActual->getIdProducto() . "'><span class='fas fa-edit' data-toggle=tooltip' data-placement='top' title='Editar Producto'></span> </a> </td>";
                        echo "</tr>";
                        $i++;
                    }
                    ?>
                </table>
                <div class="d-flex justify-content-between mt-4">
                    <nav aria-label="...">
                        <ul class="pagination">
                            <?php if ($pagina > 1) {
                                echo '<li class="page-item"> <a class="page-link" href="index.php?pid=' . base64_encode("Vista/Producto/listarProductoAdm.php") . '&pagina=' . ($pagina - 1) . '&cantidad=' . $cantidad . '&filtro=' . $filtro . '" tabindex="0" aria-disabled="false">Previous</a></li>';
                            } ?>
                            <?php for ($i = 1; $i <= $cantPagina; $i++) {
                                if ($pagina == $i) {
                                    echo "<li class='page-item active'>" .
                                        "<a class='page-link'>$i</a>" .
                                        "</li>";
                                } else {
                                    echo "<li class='page-item'>" .
                                        "<a class='page-link' href='index.php?pid=" . base64_encode("Vista/Producto/listarProductoAdm.php") . "&pagina=" . $i . "&cantidad=" . $cantidad . "&filtro=" . $filtro . "'>" . $i . "</a>" .
                                        "</li>";
                                }
                            } ?>
                            <?php if ($pagina < $cantPagina) {
                                echo '<li class="page-item"> <a class="page-link" href="index.php?pid=' . base64_encode("Vista/Producto/listarProductoAdm.php") . '&pagina=' . ($pagina + 1) . '&cantidad=' . $cantidad . '&filtro=' . $filtro . '" tabindex="0" aria-disabled="false">Next</a></li>';
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
<!--MODAL-->
<?php if (isset($_GET["idProducto"])) {
    echo "<div class='modal fade' id='mostrarmodal' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>";
    echo "<div class='modal-dialog '>";
    echo "<div class='modal-content '>";
    echo "<div class='card text-center'>";
    echo "<div class='card-header bg-dark text-white d-flex justify-content-between'>";
    echo "<h5 class='modal-title' id='exampleModalLabel'>Información Producto</h5>";
    echo "<button type='button' class='close' data-dismiss='modal' aria-label='Close'>";
    echo "<span aria-hidden='true'>&times;</span>";
    echo "</button>";
    echo "</div>";
    echo "<div class='card-body'>";
    echo "<div class='row p-3'>";
    echo "<div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12'>";
    echo "<img src='";
    echo $producto->getImagen() . "' width='100%' class='img-thumbnail'>";
    echo "</div>";
    echo "<div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mt-2'>";
    echo "<form>";
    echo "<div class='form-group '>";
    echo "<label for='idProducto'>ID Producto</label>";
    echo "<input type='text' class='form-control' name='idProducto' id='idProducto' value='";
    echo $producto->getidProducto() . "' readonly>";
    echo "</div>";
    echo "<div class='form-group m-2'>";
    echo "<label for='Nombre'>Nombre</label>";
    echo "<input type='text' class='form-control' name='Nombre' id='Nombre' value='";
    echo $producto->getNombre() . "' readonly>";
    echo "</div>";
    echo "<div class='form-group m-2'>";
    echo "<label for='Cantidad'>Cantidad</label>";
    echo "<input type='text' class='form-control' name='Cantidad' id='Cantidad' value='";
    echo $producto->getCantidad() . "' readonly>";
    echo "</div>";
    echo "<div class='form-group m-2'>";
    echo "<label for='Precio'>Precio</label>";
    echo "<input type='text' class='form-control' name='Precio' id='Precio' value='";
    echo $producto->getPrecio() . "' readonly>";
    echo "</div>";
    echo "</form>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
} ?>


<style>
    .contenedor:hover {
        -webkit-transform: scale(1.2);
        transform: scale(1.2);
    }

    .contenedor {
        overflow: hidden;
    }

    .sombra :hover {
        box-shadow: 2px 2px 5px #999;
    }
</style>

<script>
    $("#cantidad").on("change", function() {
        url = "index.php?pid=<?php echo base64_encode("Vista/Producto/listarProductoAdm.php") ?>&cantidad=" + $(this).val() + "&filtro=" + $(this).data("filtro");
        location.replace(url);
    });

    /*search filtro*/
    $(document).ready(function() {
        $("#search").keyup(function() {
            if ($(this).val().length >= 3 || $(this).val().length == 0) {
                var url = "indexAjax.php?pid=<?php echo base64_encode("Vista/Producto/Ajax/buscarProductoAjax.php") ?>&filtro=" + $(this).val() + "&cantidad=" + $(this).data("cantidad");
                $("#contenido").load(url);
            }
        });
    });

    /**Cambio Estado */
    $(".estado").change(function() {
        var objJSON = {
            idProducto: $(this).data("idproducto"),
            /*el this coge el elemento que activo el evento*/
            estado: $(this).val(),
        }

        url = "indexAjax.php?pid=<?php echo base64_encode("Vista/Producto/Ajax/cambioEstadoAjax.php") ?>";
        $.post(url, objJSON, function(info) {
            $res = JSON.parse(info);
            $("#vermodal").modal("show");
        })

    });
</script>