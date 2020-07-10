<?php
$orden = new ProveedorProducto();
$cantidad = 5;
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

$cant = $orden->cantidadPaginasFiltro($filtro); /* se creo un nuevo metodo que trae la cantidad de paginas segun el filtro*/
$cantPagina = intval($cant[0] / $cantidad);
if (($cant[0] % $cantidad) != 0) {
    $cantPagina++;
}

$listaOrdenes = $orden->listarFiltro($filtro, $cantidad, $pagina); /*Nuevo metodo que trae los datos entre cantidad y pagina pero que tengas el filtro*/
?>
<div>
    <table class="table table-responsive-sm table-responsive-md table-hover table-striped">
        <tr>
            <th>Id Orden</th>
            <th>Id Producto</th>
            <th>Id Proveedor</th>
            <th>Cantidad</th>
            <th>Precio</th>
            <th>Fecha-Hora</th>
            <th>Servicios</th>
        </tr>
        <tr>
            <?php
            $i = ($pagina - 1) * $cantidad;
            foreach ($listaOrdenes  as $ordenActual) {
                echo "<tr>";

                /*PINTAR BUSQUEDA EDE NOMBRE EN TABLA*/
                /*strtipos -> stripos ( string $haystack , string $needle [, int $offset = 0 ] ) Encuentra la posición numérica de la primera aparición de needle (aguja) en el string haystack (pajar).*/
                $primeraPosicion = stripos($ordenActual->getIdProveedorProducto(), $filtro);
                if ($primeraPosicion === false) {
                    echo "<td>" . $ordenActual->getIdProveedorProducto() . "</td>";
                } else {
                    /*El siguiente codigo imprime primero la parte de la palabra hasta que encuentra el indice de $primeraPosicion, luego en negrila <mark> imprime desde el indice de primeraPosicion hasta el final de la palabra $filtro, y por ultimo imprime desde la primeraPosicion+la palabra del filtro, es decir el restante de la oracion*/
                    echo "<td>" . substr($ordenActual->getIdProveedorProducto(), 0, $primeraPosicion) . "<strong>" . substr($ordenActual->getIdProveedorProducto(), $primeraPosicion, strlen($filtro)) . "</strong>" . substr($ordenActual->getIdProveedorProducto(), $primeraPosicion + strlen($filtro)) . "</td>";
                }
                /**Id Producto */

                $primeraPosicion = stripos($ordenActual->getIdProducto(), $filtro);
                if ($primeraPosicion === false) {
                    echo "<td>" . $ordenActual->getIdProducto() . "</td>";
                } else {
                    echo "<td>" . substr($ordenActual->getIdProducto(), 0, $primeraPosicion) . "<strong>" . substr($ordenActual->getIdProducto(), $primeraPosicion, strlen($filtro)) . "</strong>" . substr($ordenActual->getIdProducto(), $primeraPosicion + strlen($filtro)) . "</td>";
                }

                /**idProveedor */
                $primeraPosicion = stripos($ordenActual->getIdProveedor(), $filtro);
                if ($primeraPosicion === false) {
                    echo "<td>" . $ordenActual->getIdProveedor() . "</td>";
                } else {
                    echo "<td>" . substr($ordenActual->getIdProveedor(), 0, $primeraPosicion) . "<strong>" . substr($ordenActual->getIdProveedor(), $primeraPosicion, strlen($filtro)) . "</strong>" . substr($ordenActual->getIdProveedor(), $primeraPosicion + strlen($filtro)) . "</td>";
                }
                echo "<td>" . $ordenActual->getCantidad() . "</td>";
                echo "<td>" . $ordenActual->getPrecio() . "</td>";

                /**Fecha */
                $primeraPosicion = stripos($ordenActual->getFecha(), $filtro);
                if ($primeraPosicion === false) {
                    echo "<td>" . $ordenActual->getFecha() . "</td>";
                } else {
                    echo "<td>" . substr($ordenActual->getFecha(), 0, $primeraPosicion) . "<strong>" . substr($ordenActual->getFecha(), $primeraPosicion, strlen($filtro)) . "</strong>" . substr($ordenActual->getFecha(), $primeraPosicion + strlen($filtro)) . "</td>";
                }
                echo "<td> <a href='#' class='detalle' data-idorden='" . $ordenActual->getIdProveedorProducto() . "' data-toggle='modal' data-target='#exampleModal'><span class='fas fa-info-circle' data-toggle='tooltip ' data-placement='top' title='Información Orden'></span> </a>";
                echo "</tr>";
            }
            ?>
        </tr>
    </table>
    <div class="d-flex justify-content-between mt-4">
        <nav aria-label="...">
            <ul class="pagination">
                <?php if ($pagina > 1) {
                    echo '<li class="page-item"> <a class="page-link" href="index.php?pid=' . base64_encode("Vista/Ordenes/listaOrdenes.php") . '&pagina=' . ($pagina - 1) . '&cantidad=' . $cantidad . '&filtro=' . $filtro . '" tabindex="0" aria-disabled="false">Previous</a></li>';
                } ?>
                <?php for ($i = 1; $i <= $cantPagina; $i++) {
                    if ($pagina == $i) {
                        echo "<li class='page-item active'>" .
                            "<a class='page-link'>$i</a>" .
                            "</li>";
                    } else {
                        echo "<li class='page-item'>" .
                            "<a class='page-link' href='index.php?pid=" . base64_encode("Vista/Ordenes/listaOrdenes.php") . "&pagina=" . $i . "&cantidad=" . $cantidad . "&filtro=" . $filtro . "'>" . $i . "</a>" .
                            "</li>";
                    }
                } ?>
                <?php if ($pagina < $cantPagina) {
                    echo '<li class="page-item"> <a class="page-link" href="index.php?pid=' . base64_encode("Vista/Ordenes/listaOrdenes.php") . '&pagina=' . ($pagina + 1) . '&cantidad=' . $cantidad . '&filtro=' . $filtro . '" tabindex="0" aria-disabled="false">Next</a></li>';
                } ?>
            </ul>
        </nav>
        <div class="text-center m-2">
            <span><?php echo (($pagina - 1) * $cantidad) ?> al <?php echo ((($pagina - 1) * $cantidad) + count($listaOrdenes) - 1) ?> de <?php echo ($cant[0] - 1) ?> Registros Encontrados</span>
            <select id="cantidad" class="custom-select" onchange="Selected();" style="width: 60px" data-filtro="<?php echo $filtro ?>">
                <option value="5" <?php echo ($cantidad == 5) ? "selected" : "" ?>>5</option>
                <option value="10" <?php echo ($cantidad == 10) ? "selected" : "" ?>>10</option>
                <option value="15" <?php echo ($cantidad == 15) ? "selected" : "" ?>>15</option>
            </select>
        </div>
    </div>
</div>

<script>
    $("#cantidad").on("change", function() {
        url = "index.php?pid=<?php echo base64_encode("Vista/Ordenes/listaOrdenes.php") ?>&cantidad=" + $(this).val() + "&filtro=" + $(this).data("filtro");
        location.replace(url);
    });

    /**Mostrar Info */
    $(function() {
        $(".detalle").on("click", function() {
            var id = $(this).data("idorden");
            console.log("eyyyy"+id);
            var url = "indexAjax.php?pid=<?php echo base64_encode("Vista/Ordenes/Ajax/detalleOrdenAjax.php") ?>&idOrden=" + id;
            $("#mostrar").load(url);
        })
    })
</script>