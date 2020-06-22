<?php
if (isset($_GET["idProducto"])) {
    $producto = new Producto($_GET["idProducto"]);
    $producto->traerInfo();
} else {
    $producto = new Producto();
}

$row = 1;
$cantidad = 6;
if (isset($_GET["cantidad"])) {
    $cantidad = $_GET["cantidad"];
}
$pagina = 1;
if (isset($_GET["pagina"])) {
    $pagina = $_GET["pagina"];
}
$cant = $producto->cantidadPaginas();
$cantPagina = intval($cant[0] / $cantidad);
if (($cant[0] % $cantidad) != 0) {
    $cantPagina++;
}
$listaProductos = $producto->listarProductos($cantidad, $pagina);
?>

<div class="container">
    <div class="card mt-3">
        <div class="card-header text-white bg-dark text-center">
            <h4>Productos</h4>
        </div>
        <div class="text-center m-2">
            <span><?php echo (($pagina - 1) * $cantidad) ?> al <?php echo ((($pagina - 1) * $cantidad) + count($listaProductos) - 1) ?> de <?php echo ($cant[0] - 1) ?> Registros Encontrados</span>
            <select id="cantidad" class="custom-select" onchange="Selected();" style="width: 60px">
                <option value="6" <?php echo ($cantidad == 6) ? "selected" : "" ?>>6</option>
                <option value="9" <?php echo ($cantidad == 9) ? "selected" : "" ?>>9</option>
                <option value="12" <?php echo ($cantidad == 12) ? "selected" : "" ?>>12</option>
            </select>
        </div>
        <div class="card-body ">
            <table class="table table-hover table-striped">
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>Servicios</th>
                </tr>
                <tr>
                    <?php
                    $i = ($pagina - 1) * $cantidad;
                    foreach ($listaProductos  as $productoActual) {
                        echo "<tr>";
                        echo "<td>" . $i . "</td>";
                        echo "<td>" . $productoActual->getNombre() . "</td>";
                        echo "<td>" . $productoActual->getCantidad() . "</td>";
                        echo "<td>" . $productoActual->getPrecio() . "</td>";
                        echo "<td> <a href='index.php?pid=" . base64_encode("Vista/Producto/listarProductoAdm.php") . "&idProducto=" . $productoActual->getIdProducto() . "'><span class='fas fa-info-circle' data-toggle=tooltip' data-placement='top' title='Información Producto'></span> </a>";
                        echo        "<a href='index.php?pid=" . base64_encode("Vista/Producto/editarProducto.php") . "&idProducto=" . $productoActual->getIdProducto() . "'><span class='fas fa-edit' data-toggle=tooltip' data-placement='top' title='Editar Producto'></span> </a> </td>";
                        echo "</tr>";
                        $i++;
                    }
                    ?>
                </tr>
            </table>
            <div class="d-flex flex-row justify-content-center mt-4">
                <nav aria-label="...">
                    <ul class="pagination">
                        <?php if ($pagina > 1) {
                            echo '<li class="page-item"> <a class="page-link" href="index.php?pid=' . base64_encode("Vista/Producto/listarProductoAdm.php") . '&pagina=' . ($pagina - 1) . '&cantidad=' . $cantidad . '" tabindex="0" aria-disabled="false">Previous</a></li>';
                        } ?>
                        <?php for ($i = 1; $i <= $cantPagina; $i++) {
                            if ($pagina == $i) {
                                echo "<li class='page-item active'>" .
                                    "<a class='page-link'>$i</a>" .
                                    "</li>";
                            } else {
                                echo "<li class='page-item'>" .
                                    "<a class='page-link' href='index.php?pid=" . base64_encode("Vista/Producto/listarProductoAdm.php") . "&pagina=" . $i . "&cantidad=" . $cantidad . "'>" . $i . "</a>" .
                                    "</li>";
                            }
                        } ?>
                        <?php if ($pagina < $cantPagina) {
                            echo '<li class="page-item"> <a class="page-link" href="index.php?pid=' . base64_encode("Vista/Producto/listarProductoAdm.php") . '&pagina=' . ($pagina + 1) . '&cantidad=' . $cantidad . '" tabindex="0" aria-disabled="false">Next</a></li>';
                        } ?>
                    </ul>
                </nav>
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
    function Selected() {
        var valor = document.getElementById("cantidad").value;
        url = "index.php?pid= <?php echo base64_encode("Vista/Producto/listarProductoAdm.php") ?> &cantidad=" + valor;
        location.replace(url);
    }
</script>