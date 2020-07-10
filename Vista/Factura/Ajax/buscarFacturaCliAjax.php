<?php
$filtro = $_GET["filtro"];
$factura = new Factura("","",$_SESSION["id"]);

$cantidad = 5;
if (isset($_GET["cantidad"])) {
    $cantidad = $_GET["cantidad"];
}
$pagina = 1;
if (isset($_GET["pagina"])) {
    $pagina = $_GET["pagina"];
}
$cant = $factura->cantidadPaginasFiltroCiente($filtro); /* se creo un nuevo metodo que trae la cantidad de paginas segun el filtro*/
$cantPagina = intval($cant[0] / $cantidad);
if (($cant[0] % $cantidad) != 0) {
    $cantPagina++;
}

$listaFacturas = $factura->listarFiltroCliente($filtro, $cantidad, $pagina); /*Nuevo metodo que trae los datos entre cantidad y pagina pero que tengas el filtro*/
?>
<div>
    <table class="table table-responsive-sm table-responsive-md table-hover table-striped">
        <tr>
            <th>idFactura</th>
            <th>Fecha-Hora</th>
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

                $primeraPosicion = stripos($facturaActual->getFecha(), $filtro);
                if ($primeraPosicion === false) {
                    echo "<td>" . $facturaActual->getFecha() . "</td>";
                } else {
                    echo "<td>" . substr($facturaActual->getFecha(), 0, $primeraPosicion) . "<strong>" . substr($facturaActual->getFecha(), $primeraPosicion, strlen($filtro)) . "</strong>" . substr($facturaActual->getFecha(), $primeraPosicion + strlen($filtro)) . "</td>";
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
                    echo '<li class="page-item"> <a class="page-link" href="index.php?pid=' . base64_encode("Vista/Factura/listarFacturasCliente.php") . '&pagina=' . ($pagina - 1) . '&cantidad=' . $cantidad . '&filtro=' . $filtro . '" tabindex="0" aria-disabled="false">Previous</a></li>';
                } ?>
                <?php for ($i = 1; $i <= $cantPagina; $i++) {
                    if ($pagina == $i) {
                        echo "<li class='page-item active'>" .
                            "<a class='page-link'>$i</a>" .
                            "</li>";
                    } else {
                        echo "<li class='page-item'>" .
                            "<a class='page-link' href='index.php?pid=" . base64_encode("Vista/Factura/listarFacturasCliente.php") . "&pagina=" . $i . "&cantidad=" . $cantidad . "&filtro=" . $filtro . "'>" . $i . "</a>" .
                            "</li>";
                    }
                } ?>
                <?php if ($pagina < $cantPagina) {
                    echo '<li class="page-item"> <a class="page-link" href="index.php?pid=' . base64_encode("Vista/Factura/listarFacturasCliente.php") . '&pagina=' . ($pagina + 1) . '&cantidad=' . $cantidad . '&filtro=' . $filtro . '" tabindex="0" aria-disabled="false">Next</a></li>';
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
        url = "index.php?pid=<?php echo base64_encode("Vista/Factura/listarFacturasCliente.php") ?>&cantidad=" + $(this).val() + "&filtro=" + $(this).data("filtro");
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