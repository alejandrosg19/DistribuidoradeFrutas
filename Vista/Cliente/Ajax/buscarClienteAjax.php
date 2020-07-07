<?php
$filtro = $_GET["filtro"];
$cliente = new Cliente();

$cantidad = 5;
if (isset($_GET["cantidad"])) {
    $cantidad = $_GET["cantidad"];
}
$pagina = 1;
if (isset($_GET["pagina"])) {
    $pagina = $_GET["pagina"];
}
$cant = $cliente->cantidadPaginasFiltro($filtro);
$cantPagina = intval($cant[0] / $cantidad);

if (($cant[0] % $cantidad) != 0) {
    $cantPagina++;
}
#echo "cant " . $cant[0] . " cantidad " . $cantidad . " cantPagina " . $cantPagina . " pagina " . $pagina;
$listaClientes = $cliente->listarFiltro($filtro, $cantidad, $pagina);
?>

<div>
    <table class="table table-hover table-striped">
        <tr>
            <th>idCliente</th>
            <th>Nombre</th>
            <th>Correo</th>
            <th>Estado</th>
            <th>Servicios</th>
        </tr>
        <tr>
            <?php
            foreach ($listaClientes  as $clienteActual) {
                echo "<tr>";
                echo "<td>" . $clienteActual->getidCliente() . "</td>";

                /*PINTAR BUSQUEDA EDE NOMBRE EN TABLA*/
                /*strtipos -> stripos ( string $haystack , string $needle [, int $offset = 0 ] ) Encuentra la posición numérica de la primera aparición de needle (aguja) en el string haystack (pajar).*/
                $primeraPosicion = stripos($clienteActual->getNombre(), $filtro);
                if ($primeraPosicion === false) {
                    echo "<td>" . $clienteActual->getNombre() . "</td>";
                } else {
                    /*El siguiente codigo imprime primero la parte de la palabra hasta que encuentra el indice de $primeraPosicion, luego en negrila <mark> imprime desde el indice de primeraPosicion hasta el final de la palabra $filtro, y por ultimo imprime desde la primeraPosicion+la palabra del filtro, es decir el restante de la oracion*/
                    echo "<td>" . substr($clienteActual->getNombre(), 0, $primeraPosicion) . "<strong>" . substr($clienteActual->getNombre(), $primeraPosicion, strlen($filtro)) . "</strong>" . substr($clienteActual->getNombre(), $primeraPosicion + strlen($filtro)) . "</td>";
                }

                echo "<td>" . $clienteActual->getCorreo() . "</td>";
                echo "<td>";
                echo "<select class='custom-select estado' data-idcliente='" . $clienteActual->getidCliente() . "' style='width: 150px'>";
                echo "<option value='-1'";
                echo ($clienteActual->getEstado() == -1) ? 'selected' : '';
                echo ">Bloqueado</option>";
                echo "<option value='0'";
                echo ($clienteActual->getEstado() == 0) ? 'selected' : '';
                echo ">Deshabilitado</option>";
                echo "<option value='1'";
                echo ($clienteActual->getEstado() == 1) ? 'selected' : '';
                echo ">Activo</option>";
                echo "</select>";
                echo "</td>";

                echo "<td> <a href='#' class='detalle' data-idcliente='" . $clienteActual->getidCliente() . "' data-toggle='modal' data-target='#exampleModal'><span class='fas fa-info-circle' data-toggle=tooltip ' data-placement='top' title='Información Producto'></span> </a>";
                echo  "<a href='index.php?pid=" . base64_encode("Vista/Cliente/editarInfo.php") . "&idCliente=" . $clienteActual->getidCliente() . "' class=''><span class='fas fa-edit' data-toggle=tooltip' data-placement='top' title='Editar Administrador'></span> </a> </td>";
                echo "</tr>";
            }
            ?>
        </tr>
    </table>
    <div class="d-flex justify-content-between mt-4">

        <nav aria-label="...">
            <ul class="pagination">
                <?php if ($pagina > 1) {
                    echo '<li class="page-item"> <a class="page-link" href="index.php?pid=' . base64_encode("Vista/Cliente/listarClientes.php") . '&pagina=' . ($pagina - 1) . '&cantidad=' . $cantidad . '&filtro=' . $filtro . '" tabindex="0" aria-disabled="false">Previous</a></li>';
                } ?>
                <?php for ($i = 1; $i <= $cantPagina; $i++) {
                    if ($pagina == $i) {
                        echo "<li class='page-item active'>" .
                            "<a class='page-link'>$i</a>" .
                            "</li>";
                    } else {
                        echo "<li class='page-item'>" .
                            "<a class='page-link' href='index.php?pid=" . base64_encode("Vista/Cliente/listarClientes.php") . "&pagina=" . $i . "&cantidad=" . $cantidad . "&filtro=" . $filtro . "'>" . $i . "</a>" .
                            "</li>";
                    }
                } ?>
                <?php if ($pagina < $cantPagina) {
                    echo '<li class="page-item"> <a class="page-link" href="index.php?pid=' . base64_encode("Vista/Cliente/listarClientes.php") . '&pagina=' . ($pagina + 1) . '&cantidad=' . $cantidad . '&filtro=' . $filtro . '" tabindex="0" aria-disabled="false">Next</a></li>';
                } ?>
            </ul>
        </nav>
        <div class="">
            <div class="text-center m-2">
                <span><?php echo (($pagina - 1) * $cantidad) ?> al <?php echo ((($pagina - 1) * $cantidad) + count($listaClientes) - 1) ?> de <?php echo ($cant[0] - 1) ?> Registros Encontrados</span>
                <select id="cantidad" class="custom-select" onchange="Selected();" style="width: 60px" data-filtro="<?php echo $filtro ?>">
                    <option value="5" <?php echo ($cantidad == 5) ? "selected" : "" ?>>5</option>
                    <option value="10" <?php echo ($cantidad == 10) ? "selected" : "" ?>>10</option>
                    <option value="15" <?php echo ($cantidad == 15) ? "selected" : "" ?>>15</option>
                </select>
            </div>
        </div>
    </div>
</div>

<script>
    $("#cantidad").on("change", function() {
        url = "index.php?pid=<?php echo base64_encode("Vista/Cliente/listarClientes.php") ?>&cantidad=" + $(this).val() + "&filtro=" + $(this).data("filtro");
        location.replace(url);
    });

    $(".estado").change(function() {
        var objJSON = {
            idCliente: $(this).data("idcliente"),
            /*el this coge el elemento que activo el evento*/
            estado: $(this).val(),
        }

        url = "indexAjax.php?pid=<?php echo base64_encode("Vista/Cliente/Ajax/clientesAjax.php") ?>";
        $.post(url, objJSON, function(info) {
            $res = JSON.parse(info);
            $("#vermodal").modal("show");
        })

    });

    /**Mostrar Info */
    $(function() {
        $(".detalle").on("click", function() {
            var id = $(this).data("idcliente");
            var url = "indexAjax.php?pid=<?php echo base64_encode("Vista/Ajax/infoUsuarios.php") ?>&idCliente=" + id + "&actor=2";
            $("#mostrar").load(url);
        })
    })
</script>