<?php
$id = $_GET["idLog"];
$log = new Log($id);
$log->traerInfo();
$arrayDatos = explode(":", $log->getDatos());
$factura = new Factura($arrayDatos[1]);
$factura->traerInfo();
$fechaHora = explode(" ", $factura->getFecha());
$cliente = new Cliente($factura->getIdCliente());
$cliente->traerInfo();
$productoFactura = new ProductoFactura("", "", $factura->getIdFactura());
$arrayfacturaProductos = $productoFactura->traerfacturaProducto();
?>
<div class="row pt-3">
    <div class="col-4">
        <div class="border m-2">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 text-center mt-2">
                <h4 class="m-0">Información</h4>
            </div>
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mt-3">
                <div class="m-0">
                    <div class="card-body m-0 p-0">
                        <div class="d-flex justify-content-between pr-3">
                            <p class="m-0">Factura #: </p>
                            <p><small id="emailHelp" class="form-text text-muted mt-0 "><?php echo $factura->getIdFactura() ?></small></p>
                        </div>
                        <div class="d-flex justify-content-between pr-3">
                            <p class="m-0">Fecha: </p>
                            <p><small id="emailHelp" class="form-text text-muted mt-0 "><?php echo $fechaHora[0] ?></small></p>
                        </div>
                        <div class="d-flex justify-content-between pr-3">
                            <p class="m-0">Hora: </p>
                            <p><small id="emailHelp" class="form-text text-muted mt-0 "><?php echo $fechaHora[1] ?></small></p>
                        </div>
                        <div class="d-flex justify-content-between pr-3">
                            <p class="m-0">Cliente: </p>
                            <p><small id="emailHelp" class="form-text text-muted mt-0 "><?php echo $cliente->getNombre() ?></small></p>
                        </div>
                        <div class="d-flex justify-content-between pr-3">
                            <p class="m-0">Correo: </p>
                            <p><small id="emailHelp" class="form-text text-muted mt-0 "><?php echo $cliente->getCorreo() ?></small></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-8">
        <div class="m-2">
            <div class="card text-center border-0">
                <div class="card-header bg-dark text-white">
                    Productos
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <thead class="border-bottom">
                            <tr>
                                <th>idProducto</th>
                                <th>Nombre</th>
                                <th>Precio Unitario</th>
                                <th>Cantidad</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <?php
                                foreach ($arrayfacturaProductos  as $actual) {
                                    $producto = new Producto($actual->getidProducto());
                                    $producto->traerInfo();
                                    echo "<tr>";
                                    echo "<td>" . $actual->getidProducto() . "</td>";
                                    echo "<td>" . $producto->getNombre() . "</td>";
                                    echo "<td>$" . $producto->getPrecio() . "</td>";
                                    echo "<td>" . $actual->getCantidad() . "</td>";
                                    $subtotal = $actual->getCantidad() * $actual->getPrecio();
                                    echo "<td>$" . $subtotal . "</td>";
                                    echo "</tr>";
                                }
                                ?>
                            </tr>
                        </tbody>

                    </table>
                    <div class="d-flex justify-content-between pr-3 border-top pr-5">
                        <p class="m-0">Precio Total: </p>
                        <p class="pr-1">$<?php echo $factura->getValor() ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>