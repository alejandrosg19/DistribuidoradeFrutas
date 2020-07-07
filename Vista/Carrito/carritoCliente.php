<?php
$carrito = $_SESSION["carrito"]; /*asignando variable sesion a variable carrito*/
$carrito = unserialize($carrito); /*es necesario deserializar por que es un objeto*/
$arrayProductos = $carrito->getArrayProductos();

$cliente = new Cliente($_SESSION["id"]);
$cliente->traerInfo();

$valor = $carrito->precioTotal();
date_default_timezone_set('America/Bogota');
?>

<div class="container mt-4">

    <div class="row">
        <div class="card-header text-center bg-white col-12 border-0">
            <h4>Carrito de Compras</h4>
        </div>
        <div class="col-8">
            <div class="card border-0   ">
                <div class="card-body p-0">
                    <table class="table m-0">
                        <tbody>
                            <table class="table table-hover table-striped">
                                <tr class="bg-white"></tr>
                                <?php
                                $fila = 0;
                                foreach ($arrayProductos  as $productoActual) {
                                    echo "<tr id='fila" . $fila . "'  class='filas' >";
                                    echo "<td><img src='" . $productoActual->getImagen() . "' width='100px'></td>";
                                    echo "<td> Producto: " . $productoActual->getNombre() . "<br>docena de producto</br></td>";
                                    echo "<td> <input  type='number' class='form-control cantidad' min='1' onkeydown='return false' data-idproducto='" . $productoActual->getidProducto() . "' value='" . $productoActual->getCantidad() . "'>
    
                                    </td>";
                                    echo "<td>$" . $productoActual->getPrecio() . "</td>";
                                    echo "<td class='btn-delete' data-idfila='" . $fila . "' data-idproducto='" . $productoActual->getidProducto() . "'> <a href='#'><span class='fas fa-times-circle' data-toggle=tooltip' data-placement='top' title='Información Producto'></span> </a>";
                                    echo "</tr>";
                                    $fila++;
                                }
                                ?>
                            </table>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-4 pt-4" style="background-color: #F8F9FA;">
            <div class="text-center">
                <h4>Información de Factura</h4>
            </div>
            <div class="mt-4">
                <div class="d-flex justify-content-between pr-3">
                    <p>Fecha: </p>
                    <p><small id="emailHelp" class="form-text text-muted mt-0"> <?php echo date("F j, Y, g:i a"); ?></small></p>
                </div>
                <div class="d-flex justify-content-between pr-3">
                    <p>Nombre: </p>
                    <p><small id="emailHelp" class="form-text text-muted mt-0"> <?php echo $cliente->getNombre(); ?></small></p>
                </div>
                <div class="d-flex justify-content-between pr-3">
                    <p>Sub Total: </p>
                    <p><small id="emailHelp" class="form-text text-muted mt-0 precio-subtotal"> $<?php echo $valor; ?></small></p>
                </div>
                <div class="d-flex justify-content-between pr-3">
                    <p>Iva: </p>
                    <p><small id="emailHelp" class="form-text text-muted mt-0">0%</small></p>
                </div>
                <div class="d-flex justify-content-between pr-3 mt-2 border-top">
                    <p>Total: </p>
                    <p><small id="emailHelp" class="form-text text-muted mt-0 precio-total"> $<?php echo $valor; ?></small></p>
                </div>
                <div class="">
                    <button id="btn-pagar" type="button" class="btn btn-primary form-control" data-toggle="modal" data-target="#exampleModal" <?php echo (count($arrayProductos) == 0 ? 'disabled' : '') ?>>Pagar</button>
                </div>

            </div>
        </div>
    </div>
</div>

<!--Modal-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: #F8F9FA;">
            <div class="d-flex justify-content-between">
                <div></div>
                <div class="text-center p-3 d-flex align-items-center">
                    <h5 class="modal-title" id="exampleModalLabel">Detalles de Pago</h5>
                </div>
                <div class="d-flex align-items-center mr-2">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
            <div class="modal-body">
                <div class="card mb-3" style="max-width: 540px;">
                    <div class="row no-gutters">
                        <div class="col-md-4">
                            <img src="Vista/Img/Gracias.png" class="card-img" alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body p-0 pl-2">
                                <div class="d-flex justify-content-between pr-3">
                                    <p class="m-0">Name on Card: </p>
                                    <p><small id="emailHelp" class="form-text text-muted mt-0 "><?php echo $cliente->getNombre() ?></small></p>
                                </div>
                                <div class="d-flex justify-content-between pr-3">
                                    <p class="m-0">Card Number: </p>
                                    <p><small id="emailHelp" class="form-text text-muted mt-0 ">xxxx xxxx xxx 9806</small></p>
                                </div>
                                <div class="pr-3 mb-2">
                                    <p class="m-0">Expiration Date: </p>
                                    <input type="date">
                                </div>
                                <div class="pr-3">
                                    <p class="m-0">CVC: </p>
                                    <input type="text" placeholder="CVC">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="">
                <a href="index.php?pid=<?php echo base64_encode("Vista/Carrito/carritoCliente.php") ?>&pago=1" type="button" id="pago" class="btn btn-primary form-control">Debitar de mi Tarjeta</a>
            </div>
        </div>
    </div>
</div>

<?php if (isset($_GET["pago"])) {
    echo "<div class='modal fade' id='mostrarmodal' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>";
    echo "<div class='modal-dialog '>";
    echo "<div class='modal-content '>";
    echo "<div class='alert alert-success m-0 text-center d-flex'>";
    echo "<h5 class='modal-title flex-grow-1' id='exampleModalLabel'>Pago realizado exitosamente</h5>";
    echo "<button type='button' class='close' data-dismiss='modal' aria-label='Close'>";
    echo "<span aria-hidden='true'>&times;</span>";
    echo "</button>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
} ?>
<script>
    /*Metodoencargado de actualizar cantidad de producto en el carrito y actualizar subtotal y total de factura*/
    $('.cantidad').focusout(function() {
        var x = $(this).val();
        var producto = $(this).data("idproducto");
        var objJSON = {
            idProducto: producto,
            cantidad: x,
        }
        url = "indexAjax.php?pid=<?php echo base64_encode("Vista/Carrito/Ajax/cantidadAjax.php") ?>";
        var $res;
        $.post(url, objJSON, function($info) {
            console.log($info);
            $res = JSON.parse($info);
            console.log($res);
            if ($res.estado == true) {
                $(function() {
                    /*sub total*/
                    var p1 = $('.precio-subtotal');
                    var c1 = p1.children();
                    p1.text("$" + ($res.precio));
                    p1.append(c1);

                    /*total*/
                    var p2 = $('.precio-total');
                    var c2 = p2.children();
                    p2.text("$" + ($res.precio));
                    p2.append(c2);
                });
            }
        })
    });

    /*Metodo encargado de eliminar fila de la tabla, actualizar carrito y actualizar subtotal y total de factura*/
    $(".btn-delete").click(function() {
        var fila = $(this).data("idfila");
        $("#fila" + fila).remove();


        var producto = $(this).data("idproducto");
        var objJSON = {
            idProducto: producto,
        }

        url = "indexAjax.php?pid=<?php echo base64_encode("Vista/Carrito/Ajax/eliminarAjax.php") ?>";
        $.post(url, objJSON, function($info) {
            console.log($info);
            $res = JSON.parse($info);
            console.log($res);

            if ($res.estado == true) {
                $(function() {
                    /*sub total*/
                    var p1 = $('.precio-subtotal');
                    var c1 = p1.children();
                    p1.text("$" + ($res.precio));
                    p1.append(c1);

                    /*total*/
                    var p2 = $('.precio-total');
                    var c2 = p2.children();
                    p2.text("$" + ($res.precio));
                    p2.append(c2);
                });
            }
            if ($res.precio == 0) {
                $('#btn-pagar').attr("disabled", true);
            }
        })

        /**Metodo encargado de mostrar u ocultar la notificacion de carrito e ir restando cuando se quite un producto */
        var numero = parseInt($("#notificacion").text());
        numero -= 1;
        $("#notificacion").text(numero);
        if (numero <= 0) {
            $("#notificacion").hide()
        } else {
            $("#notificacion").show()
        }
    })

    $("#pago").click(function() {
        var objJSON = {
            estado: true,
        }

        url = "indexAjax.php?pid=<?php echo base64_encode("Vista/Carrito/Ajax/pagoAjax.php") ?>";
        $.post(url, objJSON, function($data) {
            console.log($data);
        });
    });
</script>