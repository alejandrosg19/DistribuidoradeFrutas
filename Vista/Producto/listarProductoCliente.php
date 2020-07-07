<?php
$producto = new Producto();


/*Muestra informacion de los productos del carrito*/
$carrito;

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
    <!--Notificacion de añadir a carrito-->

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
            echo $productoActual->getImagen() . "' class='card-img-top shadow-none';>";
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
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <a class="btn btn-info showToast" data-span="<?php $carrito = unserialize($_SESSION["carrito"]);
                                                                echo count($carrito->getArrayProductos()) ?>">Añadir al Carrito</a>
            </div>
        </div>
    </div>
</div>


<!--Script Ajax Detalle Producto-->

<script>
    /*Mostrar Modal con Informacion del producto AJAX*/
    $(function() {
        $(".detalle").on("click", function() {
            var valor = $(this).data("idproducto");
            var url = "indexAjax.php?pid=<?php echo base64_encode("Vista/Producto/Ajax/detalleProductoAjax.php") ?>&idProducto=" + valor;
            $("#mostrar").load(url);
        });
    });

    function Selected() {
        var valor = document.getElementById("cantidad").value;
        url = "index.php?pid= <?php echo base64_encode("Vista/Producto/listarProductoCliente.php") ?> &cantidad=" + valor;
        location.replace(url);
    }

    /*Mostra Notificacion de añadir al carrito dentro del modal de detalle producto*/

    $(".showToast").click(function() {


        /*agregando producto a la variable de sesion carrito*/
        var cantidad = $(".cantidadProducto").val();
        var producto = $(".cantidadProducto").data("idproducto");
        var nombre = $(".cantidadProducto").data("nombre");
        var precio = $(".cantidadProducto").data("precio");
        var imagen = $(".cantidadProducto").data("imagen");

        var objJSON = {
            idProducto: producto,
            Cantidad: cantidad,
            Nombre: nombre,
            Precio: precio,
            Imagen: imagen,
        }

        url = "indexAjax.php?pid=<?php echo base64_encode("Vista/Producto/Ajax/agregarCarritoAjax.php") ?>";
        $.post(url, objJSON, function(info) {
            console.log(info);
            var res = JSON.parse(info);
            console.log(res);

            /*agregando cantidad de productos a la notificacion del carrito cuando se oprime el boton de agregar al carrito del modal*/
            $("#notificacion").text(res.cantidad);
            $("#notificacion").show()


            /*Mostrar div de mensaje "producto añadido al carrito" o "no hay producto en stock" */
            $(".divToast").css("display", "block");
            
            if (res.estado == true) {
                $("#divPtoast").addClass("alert alert-success m-0 border-0 text-center");
                $('#pToast').text("Producto añadido al carrito");
            } else {
                $("#divPtoast").addClass("alert alert-warning m-0 border-0 text-center");
                $('#pToast').text("No poseemos stock de este producto, intentalo mas tarde");
            }
            $('.toast').toast('show');

        })


    });
</script>