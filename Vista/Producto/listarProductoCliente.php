<?php
$producto = new Producto();
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

<div class="container">
    <div class="text-center m-2">
        <span><?php echo (($pagina - 1) * $cantidad) ?> al <?php echo ((($pagina - 1) * $cantidad) + count($listaProductos) - 1) ?> de <?php echo ($cant[0] - 1) ?> Registros Encontrados</span>
        <select id="cantidad" class="custom-select" onchange="Selected();" style="width: 60px">
            <option value="6" <?php echo ($cantidad == 6) ? "selected" : "" ?>>6</option>
            <option value="9" <?php echo ($cantidad == 9) ? "selected" : "" ?>>9</option>
            <option value="12" <?php echo ($cantidad == 12) ? "selected" : "" ?>>12</option>
        </select>
    </div>
    <div class="row mt-3">
        <?php foreach ($listaProductos  as $productoActual) {
            echo "<div class='sombra col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12 p-0 mt-3 text-center'>";
            echo "<div class='card border-0' style='width: 18rem;'>";
            echo "<img src='";
            echo $productoActual->getImagen() . "' class='card-img-top';>";
            echo "<div class='card-body'>";
            echo "<h5 class='card-title shadow-none'>";
            echo $productoActual->getNombre() . "</h5>";
            echo "<p class='card-text shadow-none'> $";
            echo $productoActual->getPrecio() . "</p>";
            /*Javascrip
            echo "<a href='#' class='btn btn-dark' data-toggle='modal' data-target='#exampleModal' onclick='enviar(".
            $productoActual->getidProducto() . ")'> Añadir</a>";*/
            /* jquery*/
            echo "<a href='#' class='btn btn-dark detalle' data-toggle='modal' data-target='#exampleModal' data-idproducto='" . $productoActual->getidProducto() . "'> Añadir</a>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
        }  ?>

    </div>
    <div class="d-flex flex-row justify-content-center mt-4">
        <nav aria-label="...">
            <ul class="pagination">
                <?php if ($pagina > 1) {
                    echo '<li class="page-item"> <a class="page-link" href="index.php?pid=' . base64_encode("Vista/Producto/listarProductoCliente.php") . '&pagina=' . ($pagina - 1) . '&cantidad=' . $cantidad . '" tabindex="0" aria-disabled="false">Previous</a></li>';
                } ?>
                <?php for ($i = 1; $i <= $cantPagina; $i++) {
                    if ($pagina == $i) {
                        echo "<li class='page-item active'>" .
                            "<a class='page-link'>$i</a>" .
                            "</li>";
                    } else {
                        echo "<li class='page-item'>" .
                            "<a class='page-link' href='index.php?pid=" . base64_encode("Vista/Producto/listarProductoCliente.php") . "&pagina=" . $i . "&cantidad=" . $cantidad . "'>" . $i . "</a>" .
                            "</li>";
                    }
                } ?>
                <?php if ($pagina < $cantPagina) {
                    echo '<li class="page-item"> <a class="page-link" href="index.php?pid=' . base64_encode("Vista/Producto/listarProductoCliente.php") . '&pagina=' . ($pagina + 1) . '&cantidad=' . $cantidad . '" tabindex="0" aria-disabled="false">Next</a></li>';
                } ?>
            </ul>
        </nav>
    </div>
</div>

<!--Modal-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="text-center bg-dark text-white p-3">
                <h5 class="modal-title" id="exampleModalLabel">Detalles de Producto</h5>
            </div>
            <div class="modal-body p-0" id="mostrar">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-dark">Añadir al Carrito</button>
            </div>
        </div>
    </div>
</div>

<!--Script Ajax Detalle Producto-->

<script>
    var resultado = document.getElementById("mostrar");
    /* jquery*/
    $(function() {
        $(".detalle").on("click", function() {
            var valor = $(this).data("idproducto");
            var url = "indexAjax.php?pid=<?php echo base64_encode("Vista/Producto/Ajax/detalleProductoAjax.php") ?>&idProducto=" + valor;
            $("#mostrar").load(url);
        });
    });
    /*Javascrip
    function enviar(idProducto) {
        var xmlhttp;
        if (window.XMLHttpRequest) {
            xmlhttp = new XMLHttpRequest();
        } else {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            resultado.innerHTML = xmlhttp.responseText;
        }
        xmlhttp.open("GET", "indexAjax.php?pid= <?php echo base64_encode("Vista/Producto/Ajax/detalleProductoAjax.php") ?> &idProducto=" + idProducto, true);
        xmlhttp.send();
    }*/
</script>

<script>
    function Selected() {
        var valor = document.getElementById("cantidad").value;
        url = "index.php?pid= <?php echo base64_encode("Vista/Producto/listarProductoCliente.php") ?> &cantidad=" + valor;
        location.replace(url);
    }
</script>