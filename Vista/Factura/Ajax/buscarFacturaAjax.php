<?php
$filtro = $_GET["filtro"];
$factura = new Factura();

$cantidad = 5;
if (isset($_GET["cantidad"])) {
    $cantidad = $_GET["cantidad"];
}
$pagina = 1;
if (isset($_GET["pagina"])) {
    $pagina = $_GET["pagina"];
}
$cant = $factura->cantidadPaginasFiltro($filtro);
$cantPagina = intval($cant[0] / $cantidad);

if (($cant[0] % $cantidad) != 0) {
    $cantPagina++;
}
#echo "cant " . $cant[0] . " cantidad " . $cantidad . " cantPagina " . $cantPagina . " pagina " . $pagina;
$listaFacturas = $factura->listarFiltro($filtro, $cantidad, $pagina);
?>

<div>
    <table class="table table-responsive-sm table-responsive-md table-hover table-striped">
        <tr>
            <th>idFactura</th>
            <th>Fecha</th>
            <th>Hora</th>
            <th>idCliente</th>
            <th>Valor</th>
            <th>Servicios</th>
        </tr>
        <tr>
            <?php
            $i = ($pagina - 1) * $cantidad;
            foreach ($listaFacturas  as $facturaActual) {
                echo "<tr>";
                /*PINTAR BUSQUEDA EDE NOMBRE EN TABLA*/
                /*strtipos -> stripos ( string $haystack , string $needle [, int $offset = 0 ] ) Encuentra la posición numérica de la primera aparición de needle (aguja) en el string haystack (pajar).*/
                $primeraPosicion = stripos($facturaActual->getIdFactura(), $filtro);
                if ($primeraPosicion === false) {
                    echo "<td>" . $facturaActual->getIdFactura() . "</td>";
                } else {
                    /*El siguiente codigo imprime primero la parte de la palabra hasta que encuentra el indice de $primeraPosicion, luego en negrila <mark> imprime desde el indice de primeraPosicion hasta el final de la palabra $filtro, y por ultimo imprime desde la primeraPosicion+la palabra del filtro, es decir el restante de la oracion*/
                    echo "<td>" . substr($facturaActual->getIdFactura(), 0, $primeraPosicion) . "<strong>" . substr($facturaActual->getIdFactura(), $primeraPosicion, strlen($filtro)) . "</strong>" . substr($facturaActual->getIdFactura(), $primeraPosicion + strlen($filtro)) . "</td>";
                }
                /**fecha */
                $fechaHora = explode(" ", $facturaActual->getFecha());
                $primeraPosicion = stripos($fechaHora[0], $filtro);
                if ($primeraPosicion === false) {
                    echo "<td>" . $fechaHora[0] . "</td>";
                } else {
                    echo "<td>" . substr($fechaHora[0], 0, $primeraPosicion) . "<strong>" . substr($fechaHora[0], $primeraPosicion, strlen($filtro)) . "</strong>" . substr($fechaHora[0], $primeraPosicion + strlen($filtro)) . "</td>";
                }
                /**hora */
                $primeraPosicion = stripos($fechaHora[1], $filtro);
                if ($primeraPosicion === false) {
                    echo "<td>" . $fechaHora[1] . "</td>";
                } else {
                    echo "<td>" . substr($fechaHora[1], 0, $primeraPosicion) . "<strong>" . substr($fechaHora[1], $primeraPosicion, strlen($filtro)) . "</strong>" . substr($fechaHora[1], $primeraPosicion + strlen($filtro)) . "</td>";
                }
                /**idCliente */
                $primeraPosicion = stripos($facturaActual->getIdCliente(), $filtro);
                if ($primeraPosicion === false) {
                    echo "<td>" . $facturaActual->getIdCliente() . "</td>";
                } else {
                    echo "<td>" . substr($facturaActual->getIdCliente(), 0, $primeraPosicion) . "<strong>" . substr($facturaActual->getIdCliente(), $primeraPosicion, strlen($filtro)) . "</strong>" . substr($facturaActual->getIdCliente(), $primeraPosicion + strlen($filtro)) . "</td>";
                }
                /**valor */
                $primeraPosicion = stripos($facturaActual->getValor(), $filtro);
                if ($primeraPosicion === false) {
                    echo "<td>" . $facturaActual->getValor() . "</td>";
                } else {
                    echo "<td>" . substr($facturaActual->getValor(), 0, $primeraPosicion) . "<strong>" . substr($facturaActual->getValor(), $primeraPosicion, strlen($filtro)) . "</strong>" . substr($facturaActual->getValor(), $primeraPosicion + strlen($filtro)) . "</td>";
                }
                echo "<td> <a href='#' class='detalle' data-idfactura='" . $facturaActual->getIdFactura() . "' data-toggle='modal' data-target='#exampleModal'><span class='fas fa-info-circle' data-toggle=tooltip ' data-placement='top' title='Información Producto'></span> </a>";
                echo "</tr>";
            }
            ?>
        </tr>
    </table>
    <div class="d-flex justify-content-between mt-4">
        <nav aria-label="...">
            <ul class="pagination">
                <?php if ($pagina > 1) {
                    echo '<li class="page-item"> <a class="page-link" href="index.php?pid=' . base64_encode("Vista/Factura/listaFacturas.php") . '&pagina=' . ($pagina - 1) . '&cantidad=' . $cantidad . '&filtro=' . $filtro . '" tabindex="0" aria-disabled="false">Previous</a></li>';
                } ?>
                <?php for ($i = 1; $i <= $cantPagina; $i++) {
                    if ($pagina == $i) {
                        echo "<li class='page-item active'>" .
                            "<a class='page-link'>$i</a>" .
                            "</li>";
                    } else {
                        echo "<li class='page-item'>" .
                            "<a class='page-link' href='index.php?pid=" . base64_encode("Vista/Factura/listaFacturas.php") . "&pagina=" . $i . "&cantidad=" . $cantidad . "&filtro=" . $filtro . "'>" . $i . "</a>" .
                            "</li>";
                    }
                } ?>
                <?php if ($pagina < $cantPagina) {
                    echo '<li class="page-item"> <a class="page-link" href="index.php?pid=' . base64_encode("Vista/Factura/listaFacturas.php") . '&pagina=' . ($pagina + 1) . '&cantidad=' . $cantidad . '&filtro=' . $filtro . '" tabindex="0" aria-disabled="false">Next</a></li>';
                } ?>
            </ul>
        </nav>
        <div class="text-center m-2">
            <span><?php echo (($pagina - 1) * $cantidad) ?> al <?php echo ((($pagina - 1) * $cantidad) + count($listaFacturas) - 1) ?> de <?php echo ($cant[0] - 1) ?> Registros Encontrados</span>
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
        url = "index.php?pid=<?php echo base64_encode("Vista/Factura/listaFacturas.php") ?>&cantidad=" + $(this).val() + "&filtro=" + $(this).data("filtro");
        location.replace(url);
    });

    /**Mostrar Info */
    $(function() {
        $(".detalle").on("click", function() {
            var id = $(this).data("idfactura");
            console.log("eyyyy" + id);
            var url = "indexAjax.php?pid=<?php echo base64_encode("Vista/Factura/Ajax/detalleFacturaAjax.php") ?>&idFactura=" + id;
            $("#mostrar").load(url);
        })
    })
</script>